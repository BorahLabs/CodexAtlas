<?php

namespace App\SourceCode\DTO;

class Account
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
    ) {
    }
}
