<?php

namespace App\Console\Commands;

use App\Actions\Codex\GenerateProjectDocumentation as CodexGenerateProjectDocumentation;
use App\Models\Project;
use Illuminate\Console\Command;

class GenerateProjectDocumentation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'codex:project {projectId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $project = Project::query()->findOrFail($this->argument('projectId'));
        (new CodexGenerateProjectDocumentation())->handle($project);
    }
}
