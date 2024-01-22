<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\Services\GetUuidFromJson;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRepository
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository): Repository
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

        $api = $client->repositories()->workspaces($repository->workspace)->show($repository->name);

        return new Repository(
            id: GetUuidFromJson::getUuid($api['uuid']),
            name: $api['name'],
            owner: $api['owner']['username'],
            workspace: $api['workspace']['slug'],
            description: $api['description'] ?? null,
        );
    }
}
