<?php

namespace App\SourceCode\DTO;

use App\Enums\FileChange;
use Illuminate\Contracts\Support\Arrayable;

class DiffItem implements Arrayable
{
    public function __construct(
        public string $path,
        public FileChange $change,
    ) {
        //
    }

    public function toArray(): array
    {
        return [
            'path' => $this->path,
            'change' => $this->change->value,
        ];
    }
}
