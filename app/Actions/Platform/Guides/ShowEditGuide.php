<?php

namespace App\Actions\Platform\Guides;

use App\Models\Branch;
use App\Models\CustomGuide;
use App\Models\Project;
use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowEditGuide
{
    use AsAction;

    public function handle(User $user, Project $project, Repository $repository, Branch $branch, CustomGuide $customGuide): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('guides.edit-guide', [
            'project' => $project,
            'repository' => $repository,
            'branch' => $branch,
            'customGuide' => $customGuide,
            'lastModifiedAt' => $customGuide->updated_at,
        ]);
    }

    public function asController(Request $request, Project $project, Repository $repository, Branch $branch, CustomGuide $customGuide): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return $this->handle($request->user(), $project, $repository, $branch, $customGuide);
    }
}
