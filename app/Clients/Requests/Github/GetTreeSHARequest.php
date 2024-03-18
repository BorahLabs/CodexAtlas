<?php

namespace App\Clients\Requests\Github;

use App\Clients\Requests\Github\Contract\GithubRequest;
use App\Enums\RestRequest;
use App\SourceCode\Traits\GetGithubAccessToken;

class GetTreeSHARequest extends GithubRequest
{
    use GetGithubAccessToken;
    
    public function __construct(
        private string $repositoryOwner,
        private string $repository,
        private string $filePath,
        private string $newContent,
        private string $lastCommitSHA
    ){}

    public function getMethod(): string
    {
        return RestRequest::POST->value;
    }

    public function getUri(): string
    {
        return "repos/{$this->repositoryOwner}/{$this->repository}/git/trees";
    }

    public function transformResponse(array $response): string
    {
        return $response['sha'];
    }

    public function getBody(): ?array
    {
        return
        [
            'base_tree' => $this->lastCommitSHA,
            'tree' => [[
                'path' => $this->filePath,
                'mode' => '100644',
                'type' => 'blob',
                'content' => $this->newContent,
            ]]
        ];
    }
}
