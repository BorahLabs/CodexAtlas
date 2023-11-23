<?php

namespace App\Actions\Platform;

use App\Models\Branch;
use App\Models\Project;
use App\Models\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowReadme
{
    use AsAction;

    public function handle(Project $project, Repository $repository, Branch $branch)
    {
        try {
            $file = $repository->sourceCodeAccount->getProvider()->file(
                repository: $repository->nameDto(),
                branch: $branch->dto(),
                path: 'README.md',
            );
        } catch (\Exception $e) {
            $file = null;
        }

        return view('docs-homepage', [
            'project' => $project,
            'repository' => $repository,
            'branch' => $branch,
            'file' => $file,
            'lastModifiedAt' => now(),
        ]);
    }

    public function asController(Project $project, Repository $repository, Branch $branch)
    {
        return $this->handle($project, $repository, $branch);
    }
}
