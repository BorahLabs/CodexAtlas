<?php

namespace App\Actions\Platform;

use App\Models\Branch;
use App\Models\Project;
use App\Models\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowTechStack
{
    use AsAction;

    public function handle(Project $project, Repository $repository, Branch $branch): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $file = GetTechStack::make()->handle($repository, $branch);
        return view('docs-homepage', [
            'project' => $project,
            'repository' => $repository,
            'branch' => $branch,
            'file' => $file,
            'lastModifiedAt' => now(),
        ]);
    }

    public function asController(Project $project, Repository $repository, Branch $branch): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return $this->handle($project, $repository, $branch);
    }
}
