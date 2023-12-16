<?php

namespace App\SourceCode;

use App\Actions\Bitbucket;
use App\Exceptions\ExceededProviderRateLimit;
use App\SourceCode\Contracts\AccountInfoProvider;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Account;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Bitbucket\Exception\ApiLimitExceededException;

class BitbucketProvider extends SourceCodeProvider implements AccountInfoProvider
{
    public function repositories(): array
    {
        try {
            return Bitbucket\GetAllRepositories::make()->handle($this->credentials());
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function repository(RepositoryName $repository): Repository
    {
        try {
            return Bitbucket\GetRepository::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function branches(RepositoryName $repository): array
    {
        try {
            return Bitbucket\GetBranches::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function files(RepositoryName $repository, Branch $branch, string $path = null): array
    {
        try {
            return Bitbucket\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        try {
            return Bitbucket\GetFile::make()->handle($this->credentials(), $repository, $branch, $path);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function icon(): string
    {
        return 'codex.icons.bitbucket';
    }

    public function name(): string
    {
        return 'Bitbucket';
    }

    public function url(RepositoryName $repository): string
    {
        return 'https://bitbucket.com/'.$repository->fullName;
    }

    public function account(): Account
    {
        return Bitbucket\GetAccount::make()->handle($this->credentials());
    }
}
