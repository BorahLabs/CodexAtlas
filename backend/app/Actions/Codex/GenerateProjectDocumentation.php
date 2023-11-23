<?php

namespace App\Actions\Codex;

use App\Models\Project;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateProjectDocumentation
{
    use AsAction;

    public function handle(Project $project)
    {
        foreach ($project->repositories as $repository) {
            foreach ($repository->branches as $branch) {
                GenerateBranchDocumentation::dispatch($branch);
            }
        }
    }

    public function asController(Project $project)
    {
        $this->handle($project);

        return redirect()->back();
    }
}
