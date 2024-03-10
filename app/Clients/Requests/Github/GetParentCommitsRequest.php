<?php

namespace App\Clients\Requests\Github;

use App\Clients\Requests\Github\Contract\GithubRequest;
use App\Enums\RestRequest;
use App\SourceCode\Traits\GetGithubAccessToken;

class GetParentCommitsRequest extends GithubRequest
{
    use GetGithubAccessToken;
    
    public function __construct(
        private string $repositoryOwner,
        private string $repository,
        private string $branch
    ){}

    public function getMethod(): string
    {
        return RestRequest::GET->value;
    }

    public function getUri(): string
    {
        return "repos/{$this->repositoryOwner}/{$this->repository}/commits?sha={$this->branch}";
    }

    public function transformResponse(array $response): array
    {
        $parents = [];
        if (! empty($response) && is_array($response)) {
            $commits = array_slice($response, 0, 2);

            $parents = array_map(function ($commit) {
                return $commit['sha'];
            }, $commits);
        }

        return $parents;
    }
}
