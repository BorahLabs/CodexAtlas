<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Frameworks\Contracts\FrameworkWithDependencyFiles;
use App\SourceCode\DTO\Folder;

class React extends FrameworkWithDependencyFiles
{
    public function name(): string
    {
        return 'React';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/react.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('package.json') && $this->hasDependencies($folder);
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            '*.ts',
            '*.html',
            '*.scss',
            '*.css',
            '*.js',
            '*.jsx',
        ];
    }

    public function ignorable(): array
    {
        return [
            '*.spec.*',
            '*.test.*',
            'jest.config.*',
        ];
    }

    public function getDependencies(): array
    {
        return [
            '"react"'
        ];
    }

    public function getDependencyFilePath(): string
    {
        return 'package.json';
    }
}
