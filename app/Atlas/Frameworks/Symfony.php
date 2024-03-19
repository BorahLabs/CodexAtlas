<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Symfony extends Framework
{
    public function name(): string
    {
        return 'Symfony';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/symfony.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('composer.json') && $folder->hasFile('symfony.lock');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            'src/*.php',
            'templates/*.php',
            'config/*.php',
        ];
    }

    public function ignorable(): array
    {
        return [
            'var/cache',
            'var/logs'
        ];
    }
}
