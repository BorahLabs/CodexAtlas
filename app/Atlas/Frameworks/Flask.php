<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\FrameworkWithDependencyFiles;
use App\SourceCode\DTO\Folder;

class Flask extends FrameworkWithDependencyFiles
{
    public function name(): string
    {
        return 'Flask';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/flask.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('requirements.txt') && $this->hasDependencies($folder);
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            '*.py',
            '*.html',
            '*.scss',
            '*.css',
            '*.js',
        ];
    }

    public function ignorable(): array
    {
        return [];
    }

    public function getDependencies(): array
    {
        return [
            '"Flask"',
        ];
    }

    public function getDependencyFilePath(): string
    {
        return 'requirements.txt';
    }
}
