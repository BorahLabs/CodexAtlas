<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Nuxt implements Framework {
    public function name(): string
    {
        return 'NuxtJS';
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('nuxt.config.ts') || $folder->hasFile('nuxt.config.js');
    }

    public function customContext(): ?string
    {
        return null;
    }
}
