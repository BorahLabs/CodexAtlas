<?php

namespace App\Alexandria\DTO;

class GuidePage
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
    ) {
        //
    }
}
