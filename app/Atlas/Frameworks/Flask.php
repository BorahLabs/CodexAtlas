<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Flask extends Framework
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
        return $folder->hasFile('requirements.txt');
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
