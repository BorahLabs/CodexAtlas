<?php

namespace App\Actions\PullRequestAssistant\Github;

use App\Services\GithubService;
use Lorisleiva\Actions\Concerns\AsAction;

class PushNewFileToGithub
{
    use AsAction;

    public function __construct(
        private GithubService $githubService
    ){}

    public function handle(string $repository, string $branch, string $filePath, string $owner, string $newContent, string $commitMessage)
    {
        $this->githubService->pushNewContentToRepository($repository, $branch, $filePath, $owner, $newContent, $commitMessage);
    }
}
