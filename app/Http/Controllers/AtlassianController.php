<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AtlassianController extends Controller
{
    public function handleCallback()
    {
        $user = Socialite::driver('atlassian')->user();

        dd($user, auth()->user());

    }
}
