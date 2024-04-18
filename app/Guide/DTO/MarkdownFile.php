<?php

namespace App\Guide\DTO;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\File;

class MarkdownFile implements Arrayable
{
    protected array $metadata;

    public readonly string $contents;

    public function __construct(
        public readonly string $folder,
        public readonly string $path,
    ) {
        $file = $this->fetchFile();
        $this->contents = $file['contents'];
        $this->metadata = $file['meta'];
    }

    public function folderId(): string
    {
        return str($this->folder)
            ->after('_')
            ->camel()
            ->kebab()
            ->toString();
    }

    public function id(): string
    {
        return $this->meta('id') ?? str($this->path)
            ->basename('.md')
            ->after('_')
            ->camel()
            ->kebab()
            ->toString();
    }

    public function name(): string
    {
        return $this->meta('name') ?? str($this->path)
            ->basename('.md')
            ->after('_')
            ->headline()
            ->toString();
    }

    public function url(bool $absolute = true): string
    {
        return route('guide.show', [
            'folder' => $this->folderId(),
            'file' => $this->id(),
        ], absolute: $absolute);
    }

    public function isComingSoon(): bool
    {
        return $this->meta('coming_soon') == 1;
    }

    public function meta(string $key): ?string
    {
        return $this->metadata[$key] ?? null;
    }

    public function toArray()
    {
        return [
            'id' => $this->id(),
            'folder' => $this->folderId(),
            'name' => $this->name(),
        ];
    }

    protected function fetchFile(): array
    {
        $fileContents = trim(File::get($this->path));
        if (str_starts_with($fileContents, '---')) {
            $contents = str($fileContents)
                ->after('---')
                ->trim()
                ->after('---')
                ->toString();
            $meta = str($fileContents)
                ->after('---')
                ->before('---')
                ->trim()
                ->explode("\n")
                ->mapWithKeys(fn (string $line) => [
                    str($line)->before(':')->trim()->toString() => str($line)->after(':')->trim()->toString(),
                ])
                ->toArray();
        }

        return [
            'meta' => $meta ?? [],
            'contents' => $contents ?? $fileContents,
        ];
    }
}
