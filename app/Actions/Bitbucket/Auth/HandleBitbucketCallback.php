<?php

namespace App\Actions\Bitbucket\Auth;

use App\Actions\Bitbucket\GetToken;
use App\Actions\Github\GetInstallationToken;
use App\Enums\SourceCodeProvider;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleBitbucketCallback
{
    use AsAction;

    public function handle($bitbucketUser, Team $team): SourceCodeAccount
    {
        [$token, $refreshToken, $expiresAt] = GetToken::run($bitbucketUser);

        return SourceCodeAccount::updateOrCreate([
            'team_id' => $team->id,
            'provider' => SourceCodeProvider::Bitbucket,
            'external_id' => str_replace(['{', '}'], '', $bitbucketUser->id),
        ], [
            'name' => $bitbucketUser->nickname,
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'installation_id' => null,
            'expires_at' => $expiresAt,
        ]);
    }

    public function asController(Request $request)
    {
        $this->handle(Socialite::driver('bitbucket')->user(), $request->user()->currentTeam);

        return redirect()->route('dashboard');
    }
}
