<?php

namespace App\Atlas\Languages\Contracts;

use App\SourceCode\DTO\File;

interface Language
{
    public function name(): string;

    public function imageUrl(): ?string;

    public function isOwnFile(File $file): bool;

    public function customContext(): ?string;
}
