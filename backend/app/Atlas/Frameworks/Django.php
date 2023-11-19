<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Django implements Framework {
    public function name(): string
    {
        return 'Django';
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
}
