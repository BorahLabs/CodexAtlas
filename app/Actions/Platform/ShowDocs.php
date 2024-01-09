<?php

namespace App\Actions\Platform;

use App\Models\Branch;
use App\Models\Project;
use App\Models\Repository;
use App\Models\SystemComponent;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowDocs
{
    use AsAction;

    public function handle(Project $project, Repository $repository, Branch $branch, SystemComponent $systemComponent): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('docs-homepage', [
            'project' => $project,
            'repository' => $repository,
            'branch' => $branch,
            'systemComponent' => $systemComponent,
            'lastModifiedAt' => $systemComponent->updated_at,
        ]);
    }

    public function asController(Project $project, Repository $repository, Branch $branch, ?SystemComponent $systemComponent = null):\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
    {
        if (is_null($systemComponent)) {
            return redirect()->route('docs.show-readme', [
                'project' => $project,
                'repository' => $repository,
                'branch' => $branch,
            ]);
        }

        return $this->handle($project, $repository, $branch, $systemComponent);
    }
}
