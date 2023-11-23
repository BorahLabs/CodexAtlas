<?php

namespace App\Actions\Codex;

use App\Actions\Codex\Architecture\SystemComponents;
use App\Models\Branch;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateBranchDocumentation
{
    use AsAction;

    public function handle(Branch $branch)
    {
        logger()->debug('[Codex] Dispatching System Components for branch ' . $branch->name . ' on repository ' . $branch->repository->name . ' on project ' . $branch->repository->project->name);
        SystemComponents::dispatch($branch);
    }
}
