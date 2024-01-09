<?php

namespace App\Actions\Atlassian\Auth;

use App\Enums\ContentPlatform;
use App\Models\ContentPlatformAccount;
use App\Models\Project;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Lorisleiva\Actions\Concerns\AsController;

class HandleAuthCallback
{
    use AsController;

    public function handle()
    {
        $atlassianUser = Socialite::driver('atlassian')->user();

        $contentPlatform = ContentPlatformAccount::firstOrCreate([
            'external_id' => $atlassianUser->id,
        ], [
            'id' => Str::uuid(),
            'team_id' => auth()->user()->currentTeam->id,
            'platform' => ContentPlatform::Confluence,
            'access_token' => $atlassianUser->token,
            'refresh_token' => $atlassianUser->refreshToken,
            'expires_at' => now()->addSeconds($atlassianUser->expiresIn)->toDateTimeString(),
        ]);

        // TESTING ELIMINAR CUANDO SE TERMINE UI

        if ($contentPlatform->projects->count() == 0 && Project::count() > 0) {
            $contentPlatform->projects()->attach(Project::first()->id);
        }

        return redirect()->route('dashboard');
    }

    public function asController()
    {
        return $this->handle();
    }
}
