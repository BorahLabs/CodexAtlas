<?php

use App\Actions\Autodoc\HandleStripeWebhook;
use App\Actions\Autodoc\ShowStatus;
use App\Http\Middleware\ConfigureRequestsFromOnboarding;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.digital_onboarding'))
    ->middleware(ConfigureRequestsFromOnboarding::class)
    ->group(function () {
    });
