<?php

namespace App\Actions\PullRequestAssistant\Github;

use App\Services\GithubService;
use Lorisleiva\Actions\Concerns\AsAction;

class GetOriginalFileFromRepository
{
    use AsAction;

    public function __construct(
        private GithubService $githubService
    )
    {}

    public function handle(string $repositoryOwner, string $repository, string $branch, string $filePath)
    {
        return $this->githubService->getFileFromRepository($repositoryOwner, $repository, $branch, $filePath);
    }
}
