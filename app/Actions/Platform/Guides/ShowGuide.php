<?php

namespace App\Actions\Platform\Guides;

use App\Models\Branch;
use App\Models\CustomGuide;
use App\Models\Project;
use App\Models\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowGuide
{
    use AsAction;

    public function handle(Project $project, Repository $repository, Branch $branch, CustomGuide $customGuide): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('guides.show-guide', [
            'project' => $project,
            'repository' => $repository,
            'branch' => $branch,
            'customGuide' => $customGuide,
            'lastModifiedAt' => $customGuide->updated_at,
        ]);
    }

    public function asController(Project $project, Repository $repository, Branch $branch, CustomGuide $customGuide): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return $this->handle($project, $repository, $branch, $customGuide);
    }
}
