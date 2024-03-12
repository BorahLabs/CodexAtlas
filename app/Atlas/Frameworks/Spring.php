<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Spring extends Framework
{
    public function name(): string
    {
        return 'Spring';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/spring.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('pom.xml');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            '*.java',
        ];
    }

    public function ignorable(): array
    {
        return [];
    }
}
