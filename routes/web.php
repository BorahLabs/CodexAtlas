<?php

use App\Actions\Autodoc\HandleStripeWebhook;
use App\Actions\Autodoc\ShowStatus;
use App\Actions\Github\Auth\HandleGithubInstallation;
use App\Actions\Platform\DownloadDocsAsMarkdown;
use App\Actions\Platform\Guides\DeleteGuide;
use App\Actions\Platform\Guides\ShowEditGuide;
use App\Actions\Platform\Guides\ShowGuide;
use App\Actions\Platform\Guides\ShowNewGuide;
use App\Actions\Platform\Projects\ShowProject;
use App\Actions\Platform\Projects\StoreProject;
use App\Actions\Platform\Repositories\StoreRepository;
use App\Actions\Platform\ShowDocs;
use App\Actions\Platform\ShowReadme;
use App\Actions\Platform\ShowTechStack;
use App\Actions\Platform\SourceCodeAccounts\StoreAccountPersonalAccessToken;
use App\Actions\Platform\Webhook\HandleWebhook;
use App\Http\Middleware\ConfigureRequestsFromAutodoc;
use App\Http\Middleware\ControlRequestsFromPlatform;
use App\Http\Middleware\OnlyFromCodexAtlas;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

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


Route::middleware(OnlyFromCodexAtlas::class)->group(function () {
    Route::view('/', 'welcome')
        ->middleware('central-domain')
        ->name('homepage');

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::middleware('team-domain')->group(function () {
            Route::view('/dashboard', 'dashboard')->name('dashboard');
            Route::post('/projects', StoreProject::class)->name('projects.store');
            Route::get('/projects/{project}', ShowProject::class)->name('projects.show');

            Route::post('/projects/{project}/repositories', StoreRepository::class)->name('repositories.store');
        });

        Route::post('/accounts/pat', StoreAccountPersonalAccessToken::class)->name('source-code-accounts.pat.store');
        Route::prefix('github')->group(function () {
            Route::get('redirect', fn () => redirect()->to('https://github.com/apps/codexatlas/installations/select_target'))->name('github.redirect');
            Route::get('installation', HandleGithubInstallation::class)->name('github.installation')->middleware('throttle:3,1');
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
        Route::get('/docs/{project}/{repository}/{branch}/guides/new', ShowNewGuide::class)
            ->scopeBindings()
            ->can('create', \App\Models\CustomGuide::class)
            ->name('docs.guides.new');
        Route::get('/docs/{project}/{repository}/{branch}/guides/{customGuide}/edit', ShowEditGuide::class)
            ->scopeBindings()
            ->can('update', 'customGuide')
            ->name('docs.guides.edit');
        Route::post('/docs/{project}/{repository}/{branch}/guides/{customGuide}/destroy', DeleteGuide::class)
            ->scopeBindings()
            ->can('delete', 'customGuide')
            ->name('docs.guides.destroy');
        Route::get('/docs/{project}/{repository}/{branch}/guides/{customGuide}', ShowGuide::class)
            ->scopeBindings()
            ->can('view', 'customGuide')
            ->name('docs.guides.show');
        Route::get('/docs/{project}/{repository}/{branch}/readme', ShowReadme::class)
            ->scopeBindings()
            ->name('docs.show-readme');
        Route::get('/docs/{project}/{repository}/{branch}/tech-stack', ShowTechStack::class)
            ->scopeBindings()
            ->name('docs.show-tech-stack');
        Route::get('/docs/{project}/{repository}/{branch}/{systemComponent}', ShowDocs::class)
            ->scopeBindings()
            ->name('docs.show-component');
    });

    Route::any('/secret-auth', function () {
        abort_unless(config('app.password_protected.enabled'), 404);

        return view('password-protection');
    })->name('password-protected')->middleware('throttle:5,1');
});
