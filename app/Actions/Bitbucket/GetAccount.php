<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Account;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAccount
{
    use AsAction;

    public function handle(SourceCodeAccount $account): Account
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);
        $user = $client->currentUser()->show();

        return new Account(
            id: $user['account_id'],
            name: $user['username'],
        );
    }
}
