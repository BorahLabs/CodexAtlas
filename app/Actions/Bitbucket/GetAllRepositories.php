<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthApiHeaders;
use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Actions\Gitlab\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllRepositories
{
    use AsAction;

    /**
     * @return Repository[]
     */
    public function handle(SourceCodeAccount $account): array
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);
        /**
         * @var \Github\Api\CurrentUser $api
         */

         return collect($client->repositories())
            ->map(fn ($repo) => new Repository(
                id: $repo['id'],
                name: $repo['name'],
                owner: $repo['owner']['login'],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }

    private function getAllWorkspaces($content, &$workspaces, $headers)
    {
        foreach($content['values'] as $value)
        {
            $repositories = [];
            $response = Http::withHeaders($headers)->get('https://api.bitbucket.org/2.0/repositories/' . $value['slug']);
            $repo_content = json_decode($response->body(), true);

            $response = Http::withHeaders($headers)->get('https://api.bitbucket.org/2.0/workspaces/' . $value['slug']. '/members');
            // TODO: can be multiple owners
            $members = json_decode($response->body(), true);

            $workspaces[] = [
                'id' => str_replace(['{', '}'], '', $value['uuid']),
                'slug' => $value['slug'],
                'name' => $value['name'],
                'repos' => $this->getAllRepos($repo_content, $repositories, $headers, $members['values'][0]['user']['display_name']),
            ];
        }

        if(isset($content['next']) && $content['next'] != ''){
            $content = Http::withHeaders($headers)->get($content['next']);
            $this->getAllWorkspaces($content, $workspaces, $headers);
        }
    }

    private function getAllRepos($content, &$repositories, $headers, $owner)
    {
        foreach($content['values'] as $value)
        {
            $repositories[] = [
                'id' => str_replace(['{', '}'], '', $value['uuid']),
                'owner' => $owner,
                'name' => $value['name'],
                'description' => $value['description'],
            ];
        }

        if(isset($content['next']) && $content['next'] != ''){
            $content = Http::withHeaders($headers)->get($content['next']);
            $this->getAllRepos($content, $repositories, $headers, $owner);
        }
    }
}
