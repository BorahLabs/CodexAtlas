<?php

namespace App\Actions\Gitlab\Auth;

use App\Models\SourceCodeAccount;
use Gitlab\Client;
use GrahamCampbell\GitLab\Facades\GitLab;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAuthenticatedAccountGitlabClient
{
    use AsAction;

    public function handle(SourceCodeAccount $account): Client
    {
        $config = config('gitlab.connections.main');
        $config['token'] = $account->access_token;
        $client = GitLab::getFactory()->make($config);

        return $client;
    }
}
