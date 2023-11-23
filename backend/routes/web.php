<?php

use App\Actions\Codex\GenerateProjectDocumentation;
use App\Actions\Github\Auth\HandleGithubInstallation;
use App\Actions\Platform\Projects\ShowProject;
use App\Actions\Platform\Projects\StoreProject;
use App\Actions\Platform\Repositories\StoreRepository;
use App\Actions\Platform\ShowDocs;
use App\Actions\Platform\ShowReadme;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/projects', StoreProject::class)->name('projects.store');
    Route::get('/projects/{project}', ShowProject::class)->name('projects.show');

    Route::post('/projects/{project}/repositories', StoreRepository::class)->name('repositories.store');
    Route::post('/projects/{project}/generate-docs', GenerateProjectDocumentation::class)->name('projects.generate-docs');

    Route::get('/docs/{project}/{repository}/{branch}', ShowDocs::class)->name('docs.show');
    Route::get('/docs/{project}/{repository}/{branch}/readme', ShowReadme::class)->name('docs.show-readme');
    Route::get('/docs/{project}/{repository}/{branch}/{systemComponent}', ShowDocs::class)->name('docs.show-component');

    Route::prefix('github')->group(function () {
        Route::get('redirect', function () {
            return redirect()->to('https://github.com/apps/codexatlas');
        })->name('github.redirect');

        Route::get('installation', HandleGithubInstallation::class)->middleware('throttle:3,1');

        Route::get('webhook', function () {
            logger(request()->all());

            return response()->json([
                'message' => 'ok',
            ]);
        });
    });
});

Route::domain('{platform:domain}', function () {
});
