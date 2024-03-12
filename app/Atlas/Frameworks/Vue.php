<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\FrameworkWithDependencyFiles;
use App\SourceCode\DTO\Folder;

class Vue extends FrameworkWithDependencyFiles
{
    public function name(): string
    {
        return 'Vue';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/vue.svg');
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
            '*.vue',
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
            '"vue"',
        ];
    }

    public function getDependencyFilePath(): string
    {
        return 'package.json';
    }
}
