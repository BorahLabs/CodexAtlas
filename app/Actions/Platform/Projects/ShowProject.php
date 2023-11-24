<?php

namespace App\Actions\Platform\Projects;

use App\Models\Project;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowProject
{
    use AsAction;

    public function handle(Project $project)
    {
        return view('project-details', [
            'project' => $project,
        ]);
    }
}
