<?php

namespace App\Actions\PullRequestAssistant\Github;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Actions\Github\GetInstallationToken;
use App\Enums\SourceCodeProvider;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use GrahamCampbell\GitHub\Facades\GitHub;

class AddImpersonateToken
{
    use AsAction;

    public function handle(Request $request)
    {
        if(!$request->input('code')) {
            return ;
        }
        $impersonateToken = $this->getImpersonateToken($request->input('code'));
        $installationId = $request->input('installation_id');

        [$token, $expiresAt] = GetInstallationToken::run($installationId);
        $installation = GitHub::apps()->getInstallation($installationId);

        //todo: get team_id from url

        return SourceCodeAccount::updateOrCreate([
            'team_id' => auth()?->user()?->currentTeam->id ?? '9b22f325-525a-4cf5-a8ce-53e5ffd27c18',
            'provider' => SourceCodeProvider::GitHub,
            'external_id' => data_get($installation, 'account.id'),
        ], [
            'name' => data_get($installation, 'account.login'),
            'access_token' => $token,
            'refresh_token' => null,
            'installation_id' => $installationId,
            'expires_at' => $expiresAt,
            'impersonate_token' => $impersonateToken
        ]);

        logger($impersonateToken);
    }

    private function getImpersonateToken(string $code): string
    {
        $client = new Client([
            'base_uri' => 'https://github.com/',
            'headers' => [
                'Accept' => 'application/vnd.github.v3+json',
            ],
        ]);

        $clientId = config('services.github.client_id');
        $clientSecret = config('services.github.client_secret');
        $response = $client->post("login/oauth/access_token?client_id={$clientId}&client_secret={$clientSecret}&code={$code}");
        $impersonateToken = json_decode($response->getBody()->getContents(), true)['access_token'];
        return $impersonateToken;
    }
}
