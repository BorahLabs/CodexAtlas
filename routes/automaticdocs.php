<?php

use App\Actions\Autodoc\HandleStripeWebhook;
use App\Actions\Autodoc\ShowStatus;
use App\Http\Middleware\ConfigureRequestsFromAutodoc;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.autodoc_domain'))
    ->middleware(ConfigureRequestsFromAutodoc::class)
    ->group(function () {
        Route::view('/', 'autodoc.welcome');
        Route::view('/terms', 'autodoc.terms')->name('autodoc.terms');
        Route::view('/privacy', 'autodoc.privacy')->name('autodoc.privacy');
        Route::get('/success/{autodocLead}', ShowStatus::class)
            ->name('autodoc.success')
            ->middleware('signed');
        Route::post('/autodoc/stripe/webhook', HandleStripeWebhook::class);
    });
