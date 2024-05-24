<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\Services\GetUuidFromJson;
use App\SourceCode\DTO\Repository;
use Bitbucket\ResultPager;
use Illuminate\Http\Request;
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

        $paginator = new ResultPager($client);

        $api = $client->currentUser();

        $workspaces = collect($paginator->fetchAll($api, 'listWorkspaces'));

        $repos = [];

        $workspaces->each(function (array $item) use (&$repos, $client, $paginator) {
            $api = $client->repositories()->workspaces($item['slug']);
            $actuals = collect($paginator->fetchAll($api, 'list'));

            $actuals->each(function (array $item) use (&$repos) {
                $repos[] = $item;
            });
        });

        return collect($repos)
            ->map(fn (array $repo) => new Repository(
                id: GetUuidFromJson::getUuid($repo['uuid']),
                name: isset($repo['owner']['username']) ? $repo['slug'] : $repo['full_name'],
                owner: $repo['owner']['username'] ?? '',
                workspace: $repo['workspace']['slug'],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }

    public function asController(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->handle(SourceCodeAccount::first());

        return redirect()->route('dashboard');
    }
}
