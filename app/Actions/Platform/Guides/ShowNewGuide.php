<?php

namespace App\Actions\Platform\Guides;

use App\Models\Branch;
use App\Models\Project;
use App\Models\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowNewGuide
{
    use AsAction;

    public function handle(Project $project, Repository $repository, Branch $branch): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('guides.new-guide', [
            'project' => $project,
            'repository' => $repository,
            'branch' => $branch,
            'lastModifiedAt' => null,
        ]);
    }

    public function asController(Project $project, Repository $repository, Branch $branch): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return $this->handle($project, $repository, $branch);
    }
}
