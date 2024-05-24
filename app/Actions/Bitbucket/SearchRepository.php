<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\Services\GetUuidFromJson;
use App\SourceCode\DTO\Repository;
use Bitbucket\ResultPager;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchRepository
{
    use AsAction;

    public function handle(SourceCodeAccount $account, string $query)
    {
        try {
            $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

            $paginator = new ResultPager($client);
            /**
             * @var \Bitbucket\Api\Repositories\Workspaces
             */
            $api = $client->repositories()->workspaces($query);

            $repos = collect($paginator->fetch($api, 'list', [['pagelen' => 10]])['values']);

            return collect($repos)
                ->map(fn (array $repo) => new Repository(
                    id: GetUuidFromJson::getUuid($repo['uuid']),
                    name: isset($repo['owner']['username']) ? $repo['slug'] : $repo['full_name'],
                    owner: $repo['owner']['username'] ?? '',
                    workspace: $repo['workspace']['slug'],
                    description: $repo['description'] ?? null,
                ))
                ->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
