<?php

namespace App\Actions\Github;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use GrahamCampbell\GitHub\Facades\GitHub;
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
         * @var \Github\Api\CurrentUser $api
         */
        $api = $client->api('me');
        return collect($api->repositories())
            ->map(fn ($repo) => new Repository(
                id: $repo['id'],
                name: $repo['name'],
                owner: $repo['owner']['login'],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }
}
