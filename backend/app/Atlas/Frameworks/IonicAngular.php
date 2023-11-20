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

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('ionic.config.json');
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
