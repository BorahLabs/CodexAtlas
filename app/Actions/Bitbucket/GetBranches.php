<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Bitbucket\ResultPager;
use Lorisleiva\Actions\Concerns\AsAction;

class GetBranches
{
    use AsAction;

    /**
     * @return Branch[]
     */
    public function handle(SourceCodeAccount $account, RepositoryName $repository): array
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

        $paginator = new ResultPager($client);

        $api = $client->repositories()
            ->workspaces($repository->workspace)
            ->refs($repository->name)
            ->branches();

        $branches = $paginator->fetchAll($api, 'list');

        return collect($branches)
            ->map(fn (array $item) => $item['name'])
            ->mapInto(Branch::class)
            ->toArray();
    }
}
