<?php

namespace App\Actions\Github;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchRepository
{
    use AsAction;

    public function handle(SourceCodeAccount $account, string $query)
    {
        $client = GetAuthenticatedAccountGithubClient::make()->handle($account);

        /**
         * @var \Github\Api\Search $api
         */
        $api = $client->search();

        return  [];
        if ($query) {
            $q = $query . ' in:name user:' . $account->name;
        } else {
            $q = 'user:' . $account->name;
        }

        return collect($api->repositories($q, 'full_name', 'asc')['items'])
            ->take(10)
            ->map(fn (array $repo) => new Repository(
                id: $repo['id'],
                name: $repo['name'],
                owner: $repo['owner']['login'],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }
}
