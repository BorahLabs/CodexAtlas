<?php

use App\Actions\Atlassian\Auth\HandleAuthCallback;
use App\Actions\Bitbucket\RegisterWebhook;
use App\Actions\Github\Auth\HandleGithubInstallation;
use App\Actions\Platform\DownloadDocsAsMarkdown;
use App\Actions\Platform\Projects\ShowProject;
use App\Actions\Platform\Projects\StoreProject;
use App\Actions\Platform\Repositories\StoreRepository;
use App\Actions\Platform\ShowDocs;
use App\Actions\Platform\ShowReadme;
use App\Actions\Platform\SourceCodeAccounts\StoreAccountPersonalAccessToken;
use App\Actions\Platform\Webhook\HandleWebhook;
use App\ContentPlatform\ConfluenceContentPlatform;
use App\Http\Controllers\AtlassianController;
use App\Http\Middleware\ControlRequestsFromPlatform;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome')->name('homepage');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/projects', StoreProject::class)->name('projects.store');
    Route::get('/projects/{project}', ShowProject::class)->name('projects.show');

    Route::post('/projects/{project}/repositories', StoreRepository::class)->name('repositories.store');

    Route::post('/accounts/pat', StoreAccountPersonalAccessToken::class)->name('source-code-accounts.pat.store');
    Route::prefix('github')->group(function () {
        Route::get('redirect', fn () => redirect()->to('https://github.com/apps/codexatlas/installations/select_target'))->name('github.redirect');
        Route::get('installation', HandleGithubInstallation::class)->middleware('throttle:3,1');

        Route::get('webhook', function () {
            logger(request()->all());

            return response()->json([
                'message' => 'ok',
            ]);
        });
    });

    Route::prefix('gitlab')->group(function () {
        Route::get('webhook', function () {
            logger(request()->all());

            return response()->json([
                'message' => 'ok',
            ]);
        });
    });

    Route::prefix('bitbucket')->group(function () {
        Route::get('redirect', function () {
            return Socialite::driver('bitbucket')->redirect();
        })->name('bitbucket.redirect');
        Route::get('test/webhook', RegisterWebhook::class);

        Route::get('webhook', function () {
            logger(request()->all());

            return response()->json([
                'message' => 'ok',
            ]);
        });
    });

    Route::prefix('atlassian')->group(function () {
        Route::get('redirect', function () {
            return Socialite::driver('atlassian')->redirect();
        })->name('atlassian.redirect');

        Route::get('callback', HandleAuthCallback::class)->name('atlassian.callback');
        Route::get('test/webhook', RegisterWebhook::class);

        Route::get('webhook', function () {
            logger(request()->all());

            return response()->json([
                'message' => 'ok',
            ]);
        });
    });
});

// Webhook providers (no auth)
Route::post('webhook/{sourceCodeAccount}', HandleWebhook::class)
    ->withoutMiddleware(VerifyCsrfToken::class)
    ->name('webhook');

Route::middleware(ControlRequestsFromPlatform::class)->group(function () {
    Route::get('/docs/{project}/{repository}/{branch}', ShowDocs::class)
        ->scopeBindings()
        ->name('docs.show');
    Route::get('/docs/{project}/{repository}/{branch}/download', DownloadDocsAsMarkdown::class)
        ->scopeBindings()
        ->name('docs.download');
    Route::get('/docs/{project}/{repository}/{branch}/readme', ShowReadme::class)
        ->scopeBindings()
        ->name('docs.show-readme');
    Route::get('/docs/{project}/{repository}/{branch}/{systemComponent}', ShowDocs::class)
        ->scopeBindings()
        ->name('docs.show-component');
});


Route::get('testing/confluence', [ConfluenceContentPlatform::class, 'testingAll'])->name('testing.confluence');
