<?php

namespace App\Actions\Github\Auth;

use App\Actions\Github\GetInstallationToken;
use App\Models\SourceCodeAccount;
use Github\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAuthenticatedAccountGithubClient
{
    use AsAction;

    public function handle(SourceCodeAccount $account): Client
    {
        abort_if(is_null($account->installation_id), 404, 'Account is not installed on GitHub');
        [$token, $expiresAt] = GetInstallationToken::run($account->installation_id);
        if ($account->access_token != $token) {
            $account->update([
                'access_token' => $token,
                'expires_at' => $expiresAt,
            ]);
        }

        $config = config('github.connections.jwt');
        $config['token'] = $token;
        $client = GitHub::getFactory()->make($config);

        return $client;
    }
}
