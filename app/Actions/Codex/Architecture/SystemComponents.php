<?php

namespace App\Actions\Codex\Architecture;

use App\Actions\Codex\Architecture\SystemComponents\ProcessSystemComponent;
use App\Atlas\FileWhitelist;
use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Guesser;
use App\Models\Branch;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\Folder;
use Lorisleiva\Actions\Concerns\AsAction;

class SystemComponents
{
    use AsAction;

    public int $jobTimeout = 300;

    public function handle(Branch $branch)
    {
        $repository = $branch->repository;
        $sourceCodeAccount = $repository->sourceCodeAccount;
        $team = $repository->project->team;
        /**
         * @var \App\Enums\SubscriptionType
         */
        $subscriptionType = $team->subscriptionType();

        /**
         * @var SourceCodeProvider
         */
        $provider = $sourceCodeAccount->getProvider();
        $repoName = $repository->nameDto();
        logger()->debug('[Codex] Getting files for branch '.$branch->id);
        $filesAndFolders = $provider->files(
            repository: $repoName,
            branch: new DTOBranch(name: $branch->name),
            path: null,
        );

        logger()->debug('[Codex] Detecting framework for branch '.$branch->id);
        $framework = $this->detectFramework(Folder::makeWithFiles($filesAndFolders, $repoName->name, $repoName->username, sha1($repoName->fullName)));
        logger()->debug('[Codex] Framework detected: '.$framework->name().' for branch '.$branch->id);
        $files = $this->filterFiles($filesAndFolders, $framework);

        if (! is_null($subscriptionType->maxFilesPerRepository())) {
            $files = array_slice($files, 0, $subscriptionType->maxFilesPerRepository());
        }

        $order = 1;
        logger()->debug('[Codex] Dispatching components processing for branch '.$branch->id);
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
            } elseif ($framework->mightBeRelevant($file->path) && FileWhitelist::whitelisted($file->path)) {
                $filtered[] = $file;
            }
        }

        return $filtered;
    }
}
