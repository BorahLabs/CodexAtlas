<?php

namespace App\Atlas\Languages;

use App\Atlas\Languages\Contracts\Language;
use App\SourceCode\DTO\File;

class PHP implements Language
{
    public function name(): string
    {
        return 'Python';
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function isOwnFile(File $file): bool
    {
        return str_ends_with(mb_strtolower($file->path), '.py');
    }
}
