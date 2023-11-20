<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Angular extends Framework
{
    public function name(): string
    {
        return 'Angular';
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('angular.json') && $folder->hasFile('package.json');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        // TODO:
        return [];
    }

    public function ignorable(): array
    {
        // TODO:
        return [];
    }
}
