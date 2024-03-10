<?php

use App\Actions\PullRequestAssistant\Github\AddImpersonateToken;
use App\Actions\PullRequestAssistant\Github\HandleWebhookNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('source-code/webhook/github', HandleWebhookNotification::class)->name('webhook.github');
Route::get('github-installation/callback', AddImpersonateToken::class);
