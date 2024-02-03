<?php

namespace App\Actions\Codex;

use App\Actions\Codex\Architecture\SystemComponents\ProcessSystemComponent;
use App\Atlas\DependencyFiles;
use App\Enums\FileChange;
use App\Models\Branch;
use App\SourceCode\DTO\Diff;
use App\SourceCode\DTO\DiffItem;
use App\SourceCode\DTO\File;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateDocumentationFromDiff
{
    use AsAction;

    public function handle(Branch $branch, Diff $diff): void
    {
        $alreadyTechDocumentationGenerated = false;
        $order = ($branch->systemComponents()->max('order') ?? 0) + 1;
        $itemsToDelete = collect($diff->changes)
            ->filter(fn (DiffItem $item) => $item->change === FileChange::Removed)
            ->values()
            ->pluck('path');

        if ($itemsToDelete->isNotEmpty()) {
            $branch->systemComponents()
                ->whereIn('path', $itemsToDelete)
                ->delete();
        }

        foreach ($diff->changes as $item) {
            if ($item->change === FileChange::Removed) {
                continue;
            }

            if($this->isDependencyFile($branch, $item) && !$alreadyTechDocumentationGenerated) {
                GenerateTechStackDocumentation::dispatch($branch->repository, $branch);
                $alreadyTechDocumentationGenerated = true;
                continue;
            }

            $file = new File(
                name: basename($item->path),
                path: $item->path,
                sha: '',
                downloadUrl: '',
            );
            ProcessSystemComponent::dispatch($branch, $file, $order);
            $order += 1;
        }
    }

    private function isDependencyFile(Branch $branch, DiffItem $diff): bool
    {
        $dependencyFiles = DependencyFiles::getDependencyFilesFromBranch($branch);
        foreach($dependencyFiles as $dependencyFile) {
            if($dependencyFile->path === $diff->path) {
                return true;
            }
        }
        return false;
    }
}
