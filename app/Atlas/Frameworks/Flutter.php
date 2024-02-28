<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\FrameworkWithDependencyFiles;
use App\SourceCode\DTO\Folder;

class Flutter extends FrameworkWithDependencyFiles
{
    public function name(): string
    {
        return 'Flutter';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/flutter.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('pubspec.yaml') && $this->hasDependencies($folder);
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            'lib/*.dart',
        ];
    }

    public function ignorable(): array
    {
        return [];
    }

    public function getDependencies(): array
    {
        return [
            'flutter',
        ];
    }

    public function getDependencyFilePath(): string
    {
        return 'pubspec.yaml';
    }
}
