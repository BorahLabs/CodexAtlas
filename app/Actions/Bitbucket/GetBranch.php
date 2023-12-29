<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class GetBranch
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository, Branch $branch): Branch
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

        $response = $client->repositories()
            ->workspaces($repository->workspace)
            ->refs($repository->name)
            ->branches()
            ->show($branch->name);

        return new Branch(
            name: $response['name'],
            sha: $response['target']['hash'],
        );
    }
}
