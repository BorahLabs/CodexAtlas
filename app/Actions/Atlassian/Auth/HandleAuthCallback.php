<?php

namespace App\Actions\Atlassian\Auth;

use App\Enums\ContentPlatform;
use App\Models\ContentPlatformAccount;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;
use Illuminate\Support\Str;

class HandleAuthCallback
{
    use AsController;

    public function handle()
    {
        $atlassianUser = Socialite::driver('atlassian')->user();

        ContentPlatformAccount::firstOrCreate( [
            'external_id' => $atlassianUser->id,
        ] ,[
            'id' => Str::uuid(),
            'team_id' => auth()->user()->currentTeam->id,
            'platform' => ContentPlatform::Confluence,
            'access_token' => $atlassianUser->token,
            'refresh_token' => $atlassianUser->refreshToken,
            'expires_at' => now()->addSeconds($atlassianUser->expiresIn)->toDateTimeString(),
        ]);

        return redirect()->route('dashboard');
    }

    public function asController()
    {
        return $this->handle();
    }
}
