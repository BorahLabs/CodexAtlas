<?php

namespace App\Actions\Platform;

use App\Models\Platform;
use App\Models\Team;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateTeamPlatformDomain
{
    use AsAction;

    public function handle(Team $team): string
    {
        $domain = str($team->name)->slug()->toString() . '.' . config('app.main_domain');
        $suffix = '';
        while (true) {
            $platform = Platform::where('domain', $domain . $suffix)->exists();
            if (!$platform) {
                return $domain . $suffix;
            }

            $suffix = '-' . Str::random(4);
        }
    }
}
