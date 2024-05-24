<?php

namespace App\Actions\Github;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllRepositories
{
    use AsAction;

    /**
     * @return Repository[]
     */
    public function handle(SourceCodeAccount $account): array
    {
        $client = GetAuthenticatedAccountGithubClient::make()->handle($account);

        /**
         * @var \Github\Api\User $api
         */
        $api = $client->user();

        return collect($api->repositories($account->name))
            ->map(fn (array $repo) => new Repository(
                id: $repo['id'],
                name: $repo['name'],
                owner: $repo['owner']['login'],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }
}
