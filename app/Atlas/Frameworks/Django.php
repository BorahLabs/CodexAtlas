<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Django extends Framework
{
    public function name(): string
    {
        return 'Django';
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('manage.py');
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
}
