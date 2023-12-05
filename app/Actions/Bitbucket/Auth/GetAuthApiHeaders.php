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

class GetAuthApiHeaders
{
    use AsAction;

    public function handle(SourceCodeAccount $account): array
    {
        return array(
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $account->token,
        );
    }
}
