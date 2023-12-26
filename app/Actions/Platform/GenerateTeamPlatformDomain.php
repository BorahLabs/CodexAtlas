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
        $suffix = '';
        while (true) {
            $domain = str($team->name)
                ->slug()
                ->append($suffix)
                ->append('.'.config('app.main_domain'))
                ->lower()
                ->toString();
            $platform = Platform::where('domain', $domain)->exists();
            if (! $platform) {
                return $domain;
            }

            $suffix = '-'.Str::random(4);
        }
    }
}
