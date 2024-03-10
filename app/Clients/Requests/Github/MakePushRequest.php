<?php

namespace App\Clients\Requests\Github;

use App\Clients\Requests\Github\Contract\GithubRequest;
use App\Enums\RestRequest;
use App\SourceCode\Traits\GetGithubAccessToken;

class MakePushRequest extends GithubRequest
{
    use GetGithubAccessToken;
    
    public function __construct(
        private string $repositoryOwner,
        private string $repository,
        private string $branch,
        private string $commitSHA
    ){}

    public function getMethod(): string
    {
        return RestRequest::PATCH->value;
    }

    public function getUri(): string
    {
        return "/repos/{$this->repositoryOwner}/{$this->repository}/git/refs/heads/{$this->branch}";
    }

    public function transformResponse(array $response): array
    {
        return $response;
    }

    public function getBody(): ?array
    {
        return [
            'sha' => $this->commitSHA,
            'force' => false,
        ];
    }
}
