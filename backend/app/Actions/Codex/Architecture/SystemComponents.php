<?php

namespace App\Actions\Codex\Architecture;

use App\Actions\AsAction;
use App\Actions\Codex\Architecture\SystemComponents\ProcessSystemComponent;
use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Guesser;
use App\Models\Branch;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;

// use Lorisleiva\Actions\Concerns\AsAction;

class SystemComponents
{
    use AsAction;

    public function handle(Branch $branch)
    {
        $repository = $branch->repository;
        $sourceCodeAccount = $repository->sourceCodeAccount;

        /**
         * @var SourceCodeProvider
         */
        $provider = $sourceCodeAccount->getProvider();
        $repoName = $repository->nameDto();
        $filesAndFolders = $provider->files(
            repository: $repoName,
            branch: new DTOBranch(name: $branch->name),
            path: null,
        );

        $framework = $this->detectFramework(Folder::makeWithFiles($filesAndFolders, $repoName->name, $repoName->username, sha1($repoName->fullName)));
        $files = $this->filterFiles($filesAndFolders, $framework);
        $order = 1;
        foreach ($files as $file) {
            ProcessSystemComponent::dispatch($branch, $file, $order);
            $order += 1;
        }
    }

    private function detectFramework(Folder $folder): Framework
    {
        // First, we will try to see if there's one framework in the whole project
        $framework = Guesser::make()->guessFramework($folder);

        // TODO: Detect mulitple frameworks in subfolders. Monorepos? Inertia (maybe Inertia and Livewire should be their own framework?
        return $framework;
    }

    private function filterFiles(array $files, ?Framework $framework): array
    {
        if (is_null($framework)) {
            return $files;
        }

        $filtered = [];
        foreach ($files as $file) {
            if ($framework->shouldBeIgnored($file->path)) {
                continue;
            }

            if ($file instanceof Folder) {
                $filtered = [
                    ...$filtered,
                    ...$this->filterFiles($file->files, $framework),
                    ...$this->filterFiles($file->folders, $framework),
                ];
            } else if ($framework->mightBeRelevant($file->path)) {
                $filtered[] = $file;
            }
        }

        return $filtered;
    }
}
