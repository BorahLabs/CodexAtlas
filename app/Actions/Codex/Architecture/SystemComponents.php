<?php

namespace App\Actions\Codex\Architecture;

use App\Actions\Codex\Architecture\SystemComponents\ProcessSystemComponent;
use App\Actions\Codex\GenerateTechStackDocumentation;
use App\Models\Branch;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch as DTOBranch;
use Lorisleiva\Actions\Concerns\AsAction;

class SystemComponents
{
    use AsAction;

    public int $jobTimeout = 300;

    public function handle(Branch $branch): void
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

        [$framework, $files] = FilterFilesByFramework::make()->handle($filesAndFolders, $repoName);

        //TODO: add framework to json column
        $branch->update(['frameworks' => [$framework->name()]]);

        if (! is_null($subscriptionType->maxFilesPerRepository())) {
            $files = array_slice($files, 0, $subscriptionType->maxFilesPerRepository());
        }

        $order = 1;
        logger()->debug('[Codex] Dispatching components processing for branch '.$branch->id);
        foreach ($files as $file) {
            ProcessSystemComponent::dispatch($branch, $file, $order);
            $order += 1;
        }

        GenerateTechStackDocumentation::dispatch($repository, $branch);
    }
}
