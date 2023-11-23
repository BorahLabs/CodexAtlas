<?php

namespace App\Actions\Github;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class GetBranches
{
    use AsAction;

    /**
     * @return Branch[]
     */
    public function handle(SourceCodeAccount $account, RepositoryName $repository)
    {
        $client = GetAuthenticatedAccountGithubClient::make()->handle($account);
        /**
         * @var \Github\Api\GitData $api
         */
        $api = $client->api('gitData');

        return collect($api->references()->branches($repository->username, $repository->name))
            ->map(fn ($branch) => $branch['name'] ?? $branch['ref'])
            ->map(fn ($branch) => str_replace('refs/heads/', '', $branch))
            ->mapInto(Branch::class)
            ->toArray();
    }
}
