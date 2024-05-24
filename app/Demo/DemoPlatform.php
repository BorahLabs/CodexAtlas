<?php

namespace App\Demo;

final class DemoPlatform
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $url,
        public readonly string $imageUrl,
    ) {

    }

    public static function make(string $name, string $description, string $url, string $imageUrl): static
    {
        return new self($name, $description, $url, $imageUrl);
    }
}
