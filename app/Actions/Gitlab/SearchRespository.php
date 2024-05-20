<?php

namespace App\Actions\Gitlab;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchRespository
{
    use AsAction;

    public function handle(SourceCodeAccount $account, string $query)
    {
        $response = array();

        collect(GetAllRepositories::make()->handle($account))->each(function($repo) use (&$response){
            array_push($response, $repo->fullName);
        });

        return $response;
    }
}
