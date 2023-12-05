<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthApiHeaders;
use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRepository
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository): Repository
    {
        $response = Http::withHeaders(GetAuthApiHeaders::run($account))->get('https://api.bitbucket.org/2.0/' . $repository->workspace . '/' . $repository->name);

        $response = json_decode($response->body(), true);

        return new Repository(
            id: $response['uuid'],
            name: $response['name'],
            owner: $response['owner']['type'],
            workspace: $repository->workspace,
            description: $response['description'] ?? null,
        );
    }
}
