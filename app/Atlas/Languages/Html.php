<?php

namespace App\Atlas\Languages;

use App\Atlas\Languages\Contracts\Language;
use App\SourceCode\DTO\File;

class Html implements Language
{
    public function name(): string
    {
        return 'HTML';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/html.svg');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function isOwnFile(File $file): bool
    {
        $path = mb_strtolower($file->path);

        return str_ends_with($path, '.html');
    }
}
