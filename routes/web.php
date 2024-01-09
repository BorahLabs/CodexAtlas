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
use App\Enums\ContentPlatform;
use App\Http\Middleware\ControlRequestsFromPlatform;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\ContentPlatformAccount;
use App\Models\ContentPlatformAccountProject;
use App\Models\Project;
use App\Models\Team;
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

Route::get('testing/confluence', function(){
    $team = Team::first();

    $contentPlatform = ContentPlatformAccount::create([
        'team_id' => $team->id,
        'platform' => ContentPlatform::Confluence,
        'access_token' => env('CONFLUENCE_RAUL_XIQUITO_API_TOKEN'),
        'domain' => 'borah.atlassian.net',
        'email' => 'raul.sanchez@borah.agency'
    ]);

    $accountProject = ContentPlatformAccountProject::create([
        'content_platform_account_id' => $contentPlatform->id,
        'project_id' => Project::first()->id,
        'space_id' => '524290',
        'parent_id' => '1376294',
    ]);
});
Route::any('/secret-auth', function () {
    abort_unless(config('app.password_protected.enabled'), 404);

    return view('password-protection');
})->name('password-protected')->middleware('throttle:5,1');
