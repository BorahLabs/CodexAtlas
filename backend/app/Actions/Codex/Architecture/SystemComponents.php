<?php

namespace App\Actions\Codex\Architecture;

use App\Actions\Codex\Architecture\SystemComponents\ProcessSystemComponent;
use App\Models\Branch;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class SystemComponents
{
    use AsAction;

    public function handle(Branch $branch)
    {
        $repository = $branch->repository;
        $project = $repository->project;
        $sourceCodeAccount = $repository->sourceCodeAccount;

        /**
         * @var SourceCodeProvider
         */
        $provider = $sourceCodeAccount->provider->provider();
        $filesAndFolders = $provider->files(
            repository: new RepositoryName(username: $repository->username, name: $repository->name),
            branch: new DTOBranch(name: $branch->name),
            path: null,
        );

        $files = $this->filterFilesAccordingToPreset($filesAndFolders, $project->projectPreset);
        $order = 1;
        foreach ($files as $file) {
            ProcessSystemComponent::dispatch($branch, $file, $order);
            $order += 1;
        }
    }

    private function filterFilesAccordingToPreset(array $files, ?ProjectPreset $preset): array
    {
        if (is_null($preset)) {
            return $files;
        }

        $filtered = [];
        foreach ($files as $file) {
            if ($preset->fileIsIgnored($file->path)) {
                continue;
            }

            if ($file instanceof Folder) {
                $filtered = [
                    ...$filtered,
                    ...$this->filterFilesAccordingToPreset($file->files, $preset),
                    ...$this->filterFilesAccordingToPreset($file->folders, $preset),
                ];
            } else {
                if ($preset->hasFile($file->path)) {
                    $filtered[] = $file;

                    continue;
                }
            }
        }

        return $filtered;
    }
}
