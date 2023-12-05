<?php

namespace App\SourceCode;

use App\SourceCode\Contracts\SourceCodeProvider;
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
        return Github\GetRepository::make()->handle($this->credentials(), $repository);
    }

    public function branches(RepositoryName $repository): array
    {
        return Github\GetBranches::make()->handle($this->credentials(), $repository);
    }

    public function files(RepositoryName $repository, Branch $branch, string $path = null): array
    {
        return Github\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path);
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        return Github\GetFile::make()->handle($this->credentials(), $repository, $branch, $path);
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
