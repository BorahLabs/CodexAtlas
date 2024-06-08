<?php

namespace App\Actions\Platform;

use App\Actions\Codex\GenerateTechStackDocumentation;
use App\Models\Branch;
use App\Models\Repository;
use App\SourceCode\DTO\File;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTechStack
{
    use AsAction;

    public string $commandSignature = 'get:tech-stack';

    public function handle(Repository $repository, Branch $branch): ?File
    {

        $branchDocument = $branch->branchDocuments()->where('path', 'Tech Stack')->first();

        if (! $branchDocument || empty($branchDocument->formatToFile()->contents())) {
            $branchDocument = GenerateTechStackDocumentation::run($repository, $branch);
        }

        return $branchDocument->formatToFile();
    }
}
