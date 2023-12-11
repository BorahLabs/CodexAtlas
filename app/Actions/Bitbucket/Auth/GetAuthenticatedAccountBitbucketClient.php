<?php

namespace App\Actions\Bitbucket\Auth;

use App\Models\SourceCodeAccount;
use Bitbucket\Client;
use GrahamCampbell\Bitbucket\Facades\Bitbucket;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAuthenticatedAccountBitbucketClient
{
    use AsAction;

    public function handle(SourceCodeAccount $account): Client
    {
        $config = config('bitbucket.connections.main');
        $config['token'] = $account->access_token;
        $client = Bitbucket::getFactory()->make($config);

        return $client;
    }
}
