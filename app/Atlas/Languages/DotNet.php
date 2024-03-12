<?php

namespace App\Atlas\Languages;

use App\Atlas\Languages\Contracts\Language;
use App\SourceCode\DTO\File;

class DotNet implements Language
{
    public function name(): string
    {
        return '.NET';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/dotnet.svg');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function isOwnFile(File $file): bool
    {
        $path = mb_strtolower($file->path);

        return str_ends_with($path, '.cs');
    }
}
