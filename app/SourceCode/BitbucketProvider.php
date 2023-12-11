<?php

namespace App\SourceCode;

use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use App\Actions\Bitbucket;

class BitbucketProvider extends SourceCodeProvider
{
    public function repositories(): array
    {
        return Bitbucket\GetAllRepositories::make()->handle($this->credentials());
    }

    public function repository(RepositoryName $repository): Repository
    {
        return Bitbucket\GetRepository::make()->handle($this->credentials(), $repository);
    }

    public function branches(RepositoryName $repository): array
    {
        return Bitbucket\GetBranches::make()->handle($this->credentials(), $repository);
    }

    public function files(RepositoryName $repository, Branch $branch, string $path = null): array
    {
        return Bitbucket\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path);
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        return Bitbucket\GetFile::make()->handle($this->credentials(), $repository, $branch, $path);
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
}
