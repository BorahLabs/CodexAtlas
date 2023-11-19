<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Next implements Framework {
    public function name(): string
    {
        return 'Next';
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('next.config.js') || $folder->hasFile('next.config.ts');
    }

    public function customContext(): ?string
    {
        return null;
    }
}
