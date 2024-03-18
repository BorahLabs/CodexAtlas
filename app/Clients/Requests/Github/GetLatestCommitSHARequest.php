<?php

namespace App\Clients\Requests\Github;

use App\Clients\Requests\Github\Contract\GithubRequest;
use App\Enums\RestRequest;
use App\SourceCode\Traits\GetGithubAccessToken;

class GetLatestCommitSHARequest extends GithubRequest
{
    use GetGithubAccessToken;
    
    public function __construct(
        private string $repository,
        private string $branch,
        private string $repositoryOwner
    ){}

    public function getMethod(): string
    {
        return RestRequest::GET->value;
    }

    public function getUri(): string
    {
        return "repos/{$this->repositoryOwner}/{$this->repository}/commits?sha={$this->branch}&per_page=1";
    }

    public function transformResponse(array $response): string
    {
        return $response[0]['commit']['tree']['sha'];
    }
}
