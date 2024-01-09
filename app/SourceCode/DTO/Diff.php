<?php

namespace App\SourceCode\DTO;

use Illuminate\Contracts\Support\Arrayable;

class Diff implements Arrayable
{
    public function __construct(
        public array $changes = [],
    ) {
        //
    }

    public function add(DiffItem $item): static
    {
        $this->changes[$item->path] = $item;

        return $this;
    }

    public function toArray(): array
    {
        return collect($this->changes)
            ->map(fn (DiffItem $item) => $item->toArray())
            ->toArray();
    }
}
