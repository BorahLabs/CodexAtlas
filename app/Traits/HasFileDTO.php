<?php

namespace App\Traits;

use App\SourceCode\DTO\File;

trait HasFileDTO
{
    public ?File $file = null;

    public function setFile(File $file): void
    {
        $this->file = $file;
    }

    public function file(): File
    {
        return $this->file;
    }
}
