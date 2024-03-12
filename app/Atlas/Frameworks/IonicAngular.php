<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class IonicAngular extends Framework
{
    public function name(): string
    {
        return 'Ionic + Angular';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/ionic.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('ionic.config.json') && $folder->hasFile('angular.json');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            'src/*.ts',
            'src/*.html',
            'src/*.scss',
        ];
    }

    public function ignorable(): array
    {
        return [
            '*/environments/*',
            '*/polyfills.ts',
            '*/test.ts',
            '*/zone-flags.ts',
            '*.spec.ts',
        ];
    }
}
