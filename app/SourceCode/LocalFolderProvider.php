<?php

namespace App\SourceCode;

use App\Actions\LocalFolder;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File as FacadesFile;

class LocalFolderProvider extends SourceCodeProvider
{
    public function repositories(): array
    {
        return collect(FacadesFile::directories($this->credentials()->name))
            ->filter(fn ($path) => in_array(basename($path), config('codex.dev.repositories')))
            ->map(fn (string $path) => new Repository(
                id: $path,
                name: basename($path),
                owner: config('app.name'),
                description: null,
            ))
            ->values()
            ->toArray();
    }

    public function repository(RepositoryName $repository): Repository
    {
        $path = $this->credentials()->name.'/'.$repository->name;

        return new Repository(
            id: $path,
            name: basename($path),
            owner: config('app.name'),
            description: null,
        );
    }

    public function branches(RepositoryName $repository): array
    {
        return [
            new Branch(name: 'main'),
        ];
    }

    public function files(RepositoryName $repository, Branch $branch, string $path = null): array
    {
        return (new LocalFolder\GetAllFiles())->handle($repository, $branch, $path);
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        return (new LocalFolder\GetFile())->handle($repository, $branch, $path);
    }

    public function icon(): string
    {
        throw new \Exception('This should not be displayed in the UI');
    }

    public function name(): string
    {
        throw new \Exception('This should not be displayed in the UI');
    }

    public function url(RepositoryName $repository): string
    {
        throw new \Exception('This should not be displayed in the UI');
    }
}
