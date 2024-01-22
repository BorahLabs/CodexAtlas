<?php

namespace App\Actions\Platform\Guides;

use App\Models\Branch;
use App\Models\CustomGuide;
use App\Models\Project;
use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteGuide
{
    use AsAction;

    public function handle(User $user, Project $project, Repository $repository, Branch $branch, CustomGuide $customGuide): \Illuminate\Http\RedirectResponse
    {
        $customGuide->delete();

        return redirect()->route('docs.show', [
            'project' => $project,
            'repository' => $repository,
            'branch' => $branch,
        ]);
    }

    public function asController(Request $request, Project $project, Repository $repository, Branch $branch, CustomGuide $customGuide): \Illuminate\Http\RedirectResponse
    {
        return $this->handle($request->user(), $project, $repository, $branch, $customGuide);
    }
}
