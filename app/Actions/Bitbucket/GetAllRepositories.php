<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthApiHeaders;
use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\Services\GetUuidFromJson;
use App\SourceCode\DTO\Repository;
use Bitbucket\ResultPager;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;

class GetAllRepositories
{
    use AsAction;

    /**
     * @return Repository[]
     */
    public function handle(SourceCodeAccount $account): array
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

        $paginator = new ResultPager($client);

        $api = $client->currentUser();

        $workspaces = collect($paginator->fetchAll($api, 'listWorkspaces'));

        $repos = [];

        $workspaces->each(function($item) use (&$repos, $client, $paginator){
            // Quitar if. Está para no coger un repo real que tengo
            if($item['slug'] != 'bamboo-workspace'){
                $api = $client->repositories()->workspaces($item['slug']);
                $actuals = collect($paginator->fetchAll($api, 'list'));

                $actuals->each(function ($item) use (&$repos) {
                    $repos[] = $item;
                });
            }

        });

        return collect($repos)
            ->map(fn ($repo) => new Repository(
                id: GetUuidFromJson::getUuid($repo['uuid']),
                name: $repo['name'],
                owner: $repo['owner']['username'],
                workspace: $repo['workspace']['slug'],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }

    public function asController(Request $request)
    {
        $this->handle(SourceCodeAccount::first());

        return redirect()->route('dashboard');
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
                'id' => GetUuidFromJson::getUuid($value['uuid']),
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
                'id' => GetUuidFromJson::getUuid($value['uuid']),
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
