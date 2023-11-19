<?php

namespace App\Atlas\Languages;

use App\Atlas\Languages\Contracts\Language;
use App\SourceCode\DTO\File;

class Kotlin implements Language {
    public function name(): string
    {
        return 'Kotlin';
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function isOwnFile(File $file): bool
    {
        // TODO:
        $path = mb_strtolower($file->path);
        return str_ends_with($path, '.ktl');
    }
}
