<?php

namespace App\Clients\Requests\Github\Contract;

use App\Models\SourceCodeAccount;

abstract class GithubRequest
{
    public abstract function getMethod(): string;
    public abstract function getUri(): string;
    public abstract function getAccessToken(): ?string;

    public function transformResponse(array $response): array|string
    {
        return $response;
    }
    public function getBody(): ?array
    {
        return null;
    }

    public function getQueryParams(): ?array
    {
        return null;
    }

}
