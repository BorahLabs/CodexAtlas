<?php

use App\Http\Middleware\ConfigureRequestsFromOnboarding;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.digital_onboarding_domain'))
    ->middleware(ConfigureRequestsFromOnboarding::class)
    ->name('digitalonboarding.')
    ->group(function () {
        Route::get('/{project}/onboarding', function (Project $project) {
            return view('digitalonboarding.onboarding', [
                'project' => $project,
            ]);
        })->name('onboarding');
    });
