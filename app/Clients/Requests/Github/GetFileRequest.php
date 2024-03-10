<?php

namespace App\Clients\Requests\Github;

use App\Clients\Requests\Github\Contract\GithubRequest;
use App\Enums\RestRequest;
use App\SourceCode\Traits\GetGithubAccessToken;

class GetFileRequest extends GithubRequest
{
    use GetGithubAccessToken;
    
    public function __construct(
        private string $repositoryOwner,
        private string $repository,
        private string $branch,
        private string $filePath
    ){}

    public function getMethod(): string
    {
        return RestRequest::GET->value;
    }

    public function getUri(): string
    {
        return "/repos/{$this->repositoryOwner}/{$this->repository}/contents/{$this->filePath}?ref=$this->branch";
    }

    public function transformResponse(array $response): array
    {
        $fileContent = base64_decode($response['content']);
        $file = preg_split('/(?<=\n)/', $fileContent);
        return $file;
    }
}
