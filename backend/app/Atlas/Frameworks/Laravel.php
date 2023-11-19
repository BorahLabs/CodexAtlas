<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Laravel implements Framework {
    public function name(): string
    {
        return 'Laravel';
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('composer.json') && $folder->hasFile('artisan');
    }

    public function customContext(): ?string
    {
        return null;
    }
}
