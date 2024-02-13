<?php

namespace App\Actions\Codex\Architecture;

use App\Atlas\FileWhitelist;
use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Guesser;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class FilterFilesByFramework
{
    use AsAction;

    public int $jobTimeout = 300;

    public function handle(array $filesAndFolders, RepositoryName $repoName): array
    {
        $framework = $this->detectFramework(Folder::makeWithFiles(
            files: $filesAndFolders,
            name: $repoName->name,
            path: $repoName->username,
            sha: sha1($repoName->fullName)
        ));
        $files = $this->filterFiles($filesAndFolders, $framework);

        return [$framework, $files];
    }

    private function detectFramework(Folder $folder): Framework
    {
        // First, we will try to see if there's one framework in the whole project
        $framework = Guesser::make()->guessFramework($folder);

        // TODO: Detect mulitple frameworks in subfolders. Monorepos? Inertia (maybe Inertia and Livewire should be their own framework?
        return $framework;
    }

    private function filterFiles(array $files, Framework $framework): array
    {
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
            } elseif ($framework->mightBeRelevant($file->path) && FileWhitelist::whitelisted($file->path)) {
                $filtered[] = $file;
            }
        }

        return $filtered;
    }
}
