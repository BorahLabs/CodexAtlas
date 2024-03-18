<?php

namespace App\Actions\Github\Auth;

use App\Actions\Github\GetInstallationToken;
use App\Enums\SourceCodeProvider;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use GrahamCampbell\GitHub\Facades\GitHub;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleGithubInstallation
{
    use AsAction;

    public function handle(string $installationId, string $code, ?Team $team): SourceCodeAccount
    {
        // TODO: Uninstall if user not logged in
        $impersonateToken = $this->getImpersonateToken($code);
        [$token, $expiresAt] = GetInstallationToken::run($installationId);
        $installation = GitHub::apps()->getInstallation($installationId);

        return SourceCodeAccount::updateOrCreate([
            'team_id' => $team?->id,
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
    }

    public function asController(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'installation_id' => 'required|string',
            'code' => 'required|string'
        ]);
        $this->handle($request->input('installation_id'), $request->input('code'), $request->user()?->currentTeam);

        return redirect()->route('dashboard');
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
