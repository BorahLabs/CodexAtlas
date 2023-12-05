<?php

namespace App\Actions\Bitbucket;

use App\Models\SourceCodeAccount;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Cache;
use Lorisleiva\Actions\Concerns\AsAction;

class GetToken
{
    use AsAction;

    public function handle($user): array
    {
        $sourceAccount = SourceCodeAccount::where('external_id', str_replace(['{', '}'], '', $user->id))->first();

        return [
            $sourceAccount ? $sourceAccount->access_token : $user->token,
            $sourceAccount ? $sourceAccount->refresh_token : $user->refreshToken,
            $sourceAccount ? $sourceAccount->expires_at : now()->addSeconds($user->expiresIn),
        ];
    }
}
