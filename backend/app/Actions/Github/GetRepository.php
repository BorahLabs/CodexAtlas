<?php

namespace App\Actions\Github;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use GrahamCampbell\GitHub\Facades\GitHub;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRepository
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository): Repository
    {
        $client = GetAuthenticatedAccountGithubClient::make()->handle($account);
        /**
         * @var \Github\Api\Repo $api
         */
        $api = $client->api('repo');
        $repo = $api->show($repository->username, $repository->name);

        return new Repository(
            id: $repo['id'],
            name: $repo['name'],
            owner: $repo['owner']['login'],
            description: $repo['description'] ?? null,
        );
    }
}
