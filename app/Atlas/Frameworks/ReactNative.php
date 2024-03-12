<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class ReactNative extends Framework
{
    public function name(): string
    {
        return 'React Native';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/expo.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('app.json') && $folder->hasFile('package.json');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            '*.js',
            '*.ts',
            '*.tsx',
            '*.jsx',
        ];
    }

    public function ignorable(): array
    {
        return [
            '*.spec.js',
            '*.spec.ts',
            '*.spec.tsx',
            '*.spec.jsx',
        ];
    }
}
