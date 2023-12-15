<?php

namespace App\SourceCode;

use App\Actions\Github;
use App\Exceptions\ExceededProviderRateLimit;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Github\Exception\ApiLimitExceedException;
use Illuminate\Support\Facades\Cache;

class GitHubProvider extends SourceCodeProvider
{
    public function repositories(): array
    {
        try {
            return Github\GetAllRepositories::make()->handle($this->credentials());
        } catch (ApiLimitExceedException $e) {
            throw new ExceededProviderRateLimit($e->getResetTime());
        }
    }

    public function repository(RepositoryName $repository): Repository
    {
        try {
            return Github\GetRepository::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceedException $e) {
            throw new ExceededProviderRateLimit($e->getResetTime());
        }
    }

    public function branches(RepositoryName $repository): array
    {
        try {
            return Github\GetBranches::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceedException $e) {
            throw new ExceededProviderRateLimit($e->getResetTime());
        }
    }

    public function files(RepositoryName $repository, Branch $branch, string $path = null): array
    {
        try {
            return Github\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path);
        } catch (ApiLimitExceedException $e) {
            throw new ExceededProviderRateLimit($e->getResetTime());
        }
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        try {
            return Github\GetFile::make()->handle($this->credentials(), $repository, $branch, $path);
        } catch (ApiLimitExceedException $e) {
            throw new ExceededProviderRateLimit($e->getResetTime());
        }
    }

    public function icon(): string
    {
        return 'codex.icons.github';
    }

    public function name(): string
    {
        return 'GitHub';
    }

    public function url(RepositoryName $repository): string
    {
        return 'https://github.com/'.$repository->fullName;
    }
}
