<?php

namespace App\SourceCode\Contracts;

interface ReceivesZipFile
{
    public function downloadZipFile(string $zipFile): string;

    public function usingZipFile(string $zipFile): static;
}
