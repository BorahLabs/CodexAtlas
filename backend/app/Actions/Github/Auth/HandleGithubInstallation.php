<?php

namespace App\Actions\Github\Auth;

use App\Actions\Github\GetInstallationToken;
use App\Enums\SourceCodeProvider;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleGithubInstallation
{
    use AsAction;

    public function handle(string $installationId, Team $team): SourceCodeAccount
    {
        // TODO: Uninstall if user not logged in
        [$token, $expiresAt] = GetInstallationToken::run($installationId);
        $installation = GitHub::apps()->getInstallation($installationId);

        return SourceCodeAccount::updateOrCreate([
            'team_id' => $team->id,
            'provider' => SourceCodeProvider::GitHub,
            'external_id' => data_get($installation, 'account.id'),
        ], [
            'name' => data_get($installation, 'account.login'),
            'access_token' => $token,
            'refresh_token' => null,
            'installation_id' => $installationId,
            'expires_at' => $expiresAt,
        ]);
    }

    public function asController(Request $request)
    {
        $request->validate([
            'installation_id' => 'required|string',
        ]);
        $this->handle($request->input('installation_id'), $request->user()->currentTeam);

        return redirect()->route('dashboard');
    }
}
