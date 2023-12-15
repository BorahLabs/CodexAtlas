<?php

namespace App\Actions\Codex;

use App\Actions\Codex\Architecture\SystemComponents;
use App\Models\Branch;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateBranchDocumentation
{
    use AsAction;

    public string $commandSignature = 'codex:document-branch {branch}';

    public function handle(Branch $branch)
    {
        logger()->debug('[Codex] Dispatching System Components for branch '.$branch->name.' on repository '.$branch->repository->name.' on project '.$branch->repository->project->name);
        SystemComponents::dispatch($branch);
    }

    public function asCommand(Command $command)
    {
        $branch = $command->argument('branch');
        $branch = Branch::where('id', $branch)->firstOrFail();

        $this->handle($branch);
    }
}
