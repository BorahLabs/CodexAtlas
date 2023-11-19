<?php

namespace App\SourceCode;

use App\Actions\Github;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;

class GitHubProvider implements SourceCodeProvider {
    public function repositories(): array
    {
        return Github\GetAllRepositories::make()->handle();
    }

    public function repository(RepositoryName $repository): Repository
    {
        return Github\GetRepository::make()->handle($repository);
    }

    public function branches(RepositoryName $repository): array
    {
        return Github\GetBranches::make()->handle($repository);
    }

    public function files(RepositoryName $repository, Branch $branch, string $path): array
    {
        return Github\GetAllFiles::make()->handle($repository, $branch, $path);
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        return Github\GetFile::make()->handle($repository, $branch, $path);
    }
}
