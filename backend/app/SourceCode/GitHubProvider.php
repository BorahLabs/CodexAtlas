<?php

namespace App\SourceCode;

use App\Actions\Github;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Cache;

class GitHubProvider extends SourceCodeProvider
{
    public function repositories(): array
    {
        return Github\GetAllRepositories::make()->handle($this->credentials());
    }

    public function repository(RepositoryName $repository): Repository
    {
        return Github\GetRepository::make()->handle($this->credentials(), $repository);
    }

    public function branches(RepositoryName $repository): array
    {
        return Github\GetBranches::make()->handle($this->credentials(), $repository);
    }

    public function files(RepositoryName $repository, Branch $branch, string $path = null, bool $cached = true): array
    {
        if ($cached) {
            $key = 'repository:'.$repository->fullName.':'.$branch->name.':'.($path ?? '/');

            return Cache::remember($key, now()->addMinutes(10), fn () => Github\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path));
        }

        return Github\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path);
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        return Github\GetFile::make()->handle($this->credentials(), $repository, $branch, $path);
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
        return 'https://github.com/' . $repository->fullName;
    }
}
