<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class React extends Framework {
    public function name(): string
    {
        return 'React';
    }

    public function usesFramework(Folder $folder): bool
    {
        // TODO:
        return $folder->hasFile('composer.json') && $folder->hasFile('artisan');
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
