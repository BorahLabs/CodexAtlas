<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Next extends Framework
{
    public function name(): string
    {
        return 'Next';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/nextjs.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('next.config.js') || $folder->hasFile('next.config.ts');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            '*.js',
            '*.jsx',
            '*.ts',
            '*.tsx',
            '*.css',
            '*.scss',
        ];
    }

    public function ignorable(): array
    {
        return [];
    }
}
