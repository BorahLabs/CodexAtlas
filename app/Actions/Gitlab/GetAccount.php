<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Account;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAccount
{
    use AsAction;

    public function handle(SourceCodeAccount $account): Account
    {
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);
        $user = $client->users()->me();

        return new Account(
            id: $user['id'],
            name: $user['username'],
        );
    }
}
