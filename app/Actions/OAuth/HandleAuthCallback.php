<?php

namespace App\Actions\OAuth;

use App\Actions\OAuth\CreateNewOAuthUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Lorisleiva\Actions\Concerns\AsController;

class HandleAuthCallback
{
    use AsController;

    public function handle(string $driver)
    {
        $oauthUser = Socialite::driver($driver)->stateless()->user();

        $userData = [
            'name' => $oauthUser->name ?? $oauthUser->nickname,
            'email' => $oauthUser->email,
            'external_auth' => $driver,
            'external_id' => $oauthUser->id,
        ];

        $user = User::query()->with('externalAuthAccounts')->where('email', $oauthUser->email)->first();

        if(!$user){
            $user = CreateNewOAuthUser::run($userData);
        }

        if(!$user->externalAuthAccounts()->where('external_auth', $driver)->exists()){
            $user->externalAuthAccounts()->create([
                'external_id' => $oauthUser->id,
                'external_auth' => $driver,
            ]);
        }

        Auth::login($user);

        return redirect()->route('homepage');
    }

    public function asController(string $driver)
    {
        return $this->handle($driver);
    }
}
