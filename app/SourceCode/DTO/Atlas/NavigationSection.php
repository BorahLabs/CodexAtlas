<?php

namespace App\SourceCode\DTO\Atlas;

class NavigationSection
{
    public function __construct(
        public readonly string $name,
        public array $children = [],
    ) {
        //
    }

    public function addItem(NavigationItem $item): void
    {
        $this->children[] = $item;
    }
}
