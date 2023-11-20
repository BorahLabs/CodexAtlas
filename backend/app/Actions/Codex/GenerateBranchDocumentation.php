<?php

namespace App\Actions\Codex;

use App\Actions\AsAction;
use App\Actions\Codex\Architecture\SystemComponents;
use App\Models\Branch;

// use Lorisleiva\Actions\Concerns\AsAction;

class GenerateBranchDocumentation
{
    use AsAction;

    public function handle(Branch $branch)
    {
        SystemComponents::dispatch($branch);
    }
}
