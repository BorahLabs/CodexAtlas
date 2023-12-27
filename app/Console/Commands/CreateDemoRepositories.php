<?php

namespace App\Console\Commands;

use App\Actions\Platform\Repositories\StoreRepository;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Console\Command;

class CreateDemoRepositories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:create {projectId} {sourceAccountId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the demo repositories in the specified project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sourceAccount = SourceCodeAccount::query()->findOrFail($this->argument('sourceAccountId'));
        $project = Project::query()->findOrFail($this->argument('projectId'));
        $repositories = [
            new RepositoryName('animate-css', 'animate.css'),
            new RepositoryName('laravel', 'framework'),
            new RepositoryName('langchain-ai', 'langchain'),
            new RepositoryName('SwiftyJSON', 'SwiftyJSON'),
            new RepositoryName('square', 'leakcanary'),
            new RepositoryName('filamentphp', 'demo'),
            new RepositoryName('mattermost', 'focalboard'),
            new RepositoryName('siyuan-note', 'siyuan'),
        ];

        foreach ($repositories as $repository) {
            StoreRepository::make()->handle($project, $sourceAccount->id, $repository->fullName);
        }
    }
}
