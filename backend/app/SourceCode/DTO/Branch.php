<?php

namespace App\SourceCode\DTO;

class Branch
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}
