<?php

namespace App\Clients\Requests\Github;

use App\Clients\Requests\Github\Contract\GithubRequest;
use App\Enums\RestRequest;
use App\SourceCode\Traits\GetGithubAccessToken;

class MakeCommitRequest extends GithubRequest
{
    use GetGithubAccessToken;
    
    public function __construct(
        private string $repositoryOwner,
        private string $repository,
        private string $commitMessage,
        private string $treeSHA,
        private array $parentCommits
    ){}

    public function getMethod(): string
    {
        return RestRequest::POST->value;
    }

    public function getUri(): string
    {
        return "repos/{$this->repositoryOwner}/{$this->repository}/git/commits";
    }

    public function transformResponse(array $response): string
    {
        return $response['sha'];
    }

    public function getBody(): ?array
    {
        return [
            'message' => $this->commitMessage,
            'tree' => $this->treeSHA,
            'parents' => $this->parentCommits,
        ];
    }
}
