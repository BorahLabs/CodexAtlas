<?php

namespace App\SourceCode;

use App\Actions\Gitlab;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Cache;

class GitLabProvider extends SourceCodeProvider
{
    public function repositories(): array
    {
        return Gitlab\GetAllRepositories::make()->handle($this->credentials());
    }

    public function repository(RepositoryName $repository): Repository
    {
        return Gitlab\GetRepository::make()->handle($this->credentials(), $repository);
    }

    public function branches(RepositoryName $repository): array
    {
        return Gitlab\GetBranches::make()->handle($this->credentials(), $repository);
    }

    public function files(RepositoryName $repository, Branch $branch, string $path = null, bool $cached = true): array
    {
        if ($cached) {
            $key = 'repository:'.$repository->fullName.':'.$branch->name.':'.($path ?? '/');

            return Cache::remember($key, now()->addMinutes(10), fn () => Gitlab\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path));
        }

        return Gitlab\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path);
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        return Gitlab\GetFile::make()->handle($this->credentials(), $repository, $branch, $path);
    }

    public function icon(): string
    {
        return 'codex.icons.gitlab';
    }

    public function name(): string
    {
        return 'Gitlab';
    }

    public function url(RepositoryName $repository): string
    {
        return 'https://gitlab.com/'.$repository->fullName;
    }
}
