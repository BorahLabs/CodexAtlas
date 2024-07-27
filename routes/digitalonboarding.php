<?php

use App\Http\Middleware\ConfigureRequestsFromOnboarding;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.digital_onboarding_domain'))
    ->middleware(ConfigureRequestsFromOnboarding::class)
    ->group(function () {
        //
    });
