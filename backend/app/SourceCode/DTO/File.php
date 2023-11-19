<?php

namespace App\SourceCode\DTO;

class File
{
    public function __construct(
        public readonly string $name,
        public readonly string $path,
        public readonly string $sha,
        public readonly string $downloadUrl,
        private ?string $contents = null,
    ) {
    }

    public static function from(array $data): self
    {
        return new self(
            $data['name'],
            $data['path'],
            $data['sha'],
            $data['download_url'],
            isset($data['content']) ? base64_decode($data['content']) : null,
        );
    }

    public function contents(): mixed
    {
        if (! is_null($this->contents)) {
            return $this->contents;
        }

        return file_get_contents($this->downloadUrl);
    }
}
