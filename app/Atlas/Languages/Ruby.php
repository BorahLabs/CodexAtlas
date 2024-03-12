<?php

namespace App\Atlas\Languages;

use App\Atlas\Languages\Contracts\Language;
use App\SourceCode\DTO\File;

class Ruby implements Language
{
    public function name(): string
    {
        return 'Ruby';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/ruby.png');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function isOwnFile(File $file): bool
    {
        $path = mb_strtolower($file->path);

        return str_ends_with($path, '.rb') || str_ends_with($path, '.erb');
    }
}
