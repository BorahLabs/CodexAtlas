<?php

use App\Actions\Github\Auth\HandleGithubInstallation;
use App\Actions\Platform\DownloadDocsAsMarkdown;
use App\Actions\Platform\Glossary\ShowGlossary;
use App\Actions\Platform\Projects\ShowNewProject;
use App\Actions\Platform\Projects\ShowProject;
use App\Actions\Platform\Projects\ShowProjectList;
use App\Actions\Platform\Projects\StoreProject;
use App\Actions\Platform\Repositories\StoreRepository;
use App\Actions\Platform\ShowDocs;
use App\Actions\Platform\ShowReadme;
use App\Actions\Platform\ShowTechStack;
use App\Actions\Platform\SourceCodeAccounts\StoreAccountPersonalAccessToken;
use App\Actions\Platform\Tools\ShowCodeConversion;
use App\Actions\Platform\Tools\ShowDocumentFiles;
use App\Actions\Platform\Tools\ShowFixMyCode;
use App\Actions\Platform\Tools\ShowReadmeGenerator;
use App\Actions\Platform\Webhook\HandleWebhook;
use App\Http\Controllers\Website\BlogController;
use App\Http\Controllers\Website\CodeConvertionController;
use App\Http\Controllers\Website\GuideController;
use App\Http\Controllers\Website\SitemapController;
use App\Http\Controllers\Website\Tools\CodeDocumentationToolController;
use App\Http\Controllers\Website\Tools\CodeFixerToolController;
use App\Http\Controllers\Website\Tools\ReadmeGeneratorToolController;
use App\Http\Middleware\ControlRequestsFromPlatform;
use App\Http\Middleware\ForceNoIndex;
use App\Http\Middleware\OnlyFromCodexAtlas;
use App\Http\Middleware\VerifyCsrfToken;
use BorahLabs\AwsMarketplaceSaas\Facades\AwsMarketplaceSaas;
use Illuminate\Support\Facades\Route;

// codexatlas.app has now changed to codedocumentation.app
Route::domain('codexatlas.app')->group(function () {
    Route::get('{any?}', fn ($any = null) => redirect()->to('https://codedocumentation.app/'.$any, 301))->where(['any' => '.*']);
});

Route::middleware(OnlyFromCodexAtlas::class)->group(function () {

    Route::middleware('central-domain')->group(function () {
        Route::view('/', 'welcome')
            ->name('homepage');

    Route::view('/enterprise-code-documentation', 'enterprise')
        ->middleware('central-domain')
        ->name('enterprise');

    Route::get('/blog', [BlogController::class, 'index'])
        ->middleware('central-domain')
        ->name('blog.index');

    Route::get('/blog/{blog}', [BlogController::class, 'detail'])
        ->middleware('central-domain')
        ->name('blog.detail');

    Route::get('/tools/code-documentation-{language}', CodeDocumentationToolController::class)
        ->middleware('central-domain')
        ->name('tools.code-documentation');

        Route::view('/enterprise-code-documentation', 'enterprise')
            ->name('enterprise');

        Route::get('/tools/code-documentation-{language}', CodeDocumentationToolController::class)
            ->name('tools.code-documentation');

        Route::get('/tools/fix-my-code-with-ai', CodeFixerToolController::class)
            ->name('tools.code-fixer');

        Route::get('/tools/readme-generator', ReadmeGeneratorToolController::class)
            ->name('tools.readme-generator');

        Route::get('/{from}-to-{to}-code-converter', CodeConvertionController::class)
            ->name('tools.code-converter')
            ->where(['from' => '[a-z\-]+', 'to' => '[a-z\-]+']);

        Route::get('/guide', [GuideController::class, 'index'])->name('guide.index');
        Route::get('/guide/{folder}/{file}', [GuideController::class, 'show'])->name('guide.show');

        Route::view('/book-a-demo', 'book-a-demo')
            ->name('book-a-demo')
            ->middleware(ForceNoIndex::class);
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::middleware('team-domain')->group(function () {
            Route::get('/projects', ShowProjectList::class)->name('dashboard');
            Route::post('/projects', StoreProject::class)->name('projects.store');
            Route::get('/projects/new', ShowNewProject::class)->name('projects.new')->can('create-project');
            Route::get('/projects/{project}', ShowProject::class)->name('projects.show');

            Route::post('/projects/{project}/repositories', StoreRepository::class)->name('repositories.store');

            Route::get('/glossary/{project}', ShowGlossary::class)->name('glossary.show');

            Route::get('/app-tools/code-conversion', ShowCodeConversion::class)->name('app.tools.code-conversion');
            Route::get('/app-tools/document-files', ShowDocumentFiles::class)->name('app.tools.document-files');
            Route::get('/app-tools/fix-my-code', ShowFixMyCode::class)->name('app.tools.fix-my-code');
            Route::get('/app-tools/readme-generator', ShowReadmeGenerator::class)->name('app.tools.readme-generator');
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

    Route::middleware([ControlRequestsFromPlatform::class, ForceNoIndex::class])->group(function () {
        Route::get('/docs/{project}/{repository}/{branch}', ShowDocs::class)
            ->scopeBindings()
            ->name('docs.show');
        Route::get('/docs/{project}/{repository}/{branch}/download', DownloadDocsAsMarkdown::class)
            ->scopeBindings()
            ->name('docs.download');
        // Route::get('/docs/{project}/{repository}/{branch}/guides/new', ShowNewGuide::class)
        //     ->scopeBindings()
        //     ->can('create', \App\Models\CustomGuide::class)
        //     ->name('docs.guides.new');
        // Route::get('/docs/{project}/{repository}/{branch}/guides/{customGuide}/edit', ShowEditGuide::class)
        //     ->scopeBindings()
        //     ->can('update', 'customGuide')
        //     ->name('docs.guides.edit');
        // Route::post('/docs/{project}/{repository}/{branch}/guides/{customGuide}/destroy', DeleteGuide::class)
        //     ->scopeBindings()
        //     ->can('delete', 'customGuide')
        //     ->name('docs.guides.destroy');
        // Route::get('/docs/{project}/{repository}/{branch}/guides/{customGuide}', ShowGuide::class)
        //     ->scopeBindings()
        //     ->can('view', 'customGuide')
        //     ->name('docs.guides.show');
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

    Route::get('sitemap.xml', SitemapController::class);
    AwsMarketplaceSaas::registerRoutes();
});
