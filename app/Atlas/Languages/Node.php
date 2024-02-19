<?php

namespace App\Atlas\Languages;

use App\Atlas\Languages\Contracts\Language;
use App\SourceCode\DTO\File;

class Node implements Language
{
    public function name(): string
    {
        return 'NodeJS';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/node.png');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function isOwnFile(File $file): bool
    {
        $path = mb_strtolower($file->path);

        return str_ends_with($path, '.js') || str_ends_with($path, '.ts');
    }
}
