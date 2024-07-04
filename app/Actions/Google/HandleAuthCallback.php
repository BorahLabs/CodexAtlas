<?php

namespace App\Actions\Google;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Lorisleiva\Actions\Concerns\AsController;

class HandleAuthCallback
{
    use AsController;

    public function handle()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $userData = [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'external_auth' => 'google',
            'external_id' => $googleUser->id,
        ];

        $user = User::query()->where('email', $googleUser->email)->first();

        if(!$user){
            $user = CreateNewGoogleUser::run($userData);
        }

        Auth::login($user);

        return redirect()->route('homepage');
    }

    public function asController()
    {
        return $this->handle();
    }
}
