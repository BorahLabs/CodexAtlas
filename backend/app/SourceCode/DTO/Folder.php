<?php

namespace App\SourceCode\DTO;

class Folder
{
    public array $folders = [];

    public array $files = [];

    public function __construct(
        public readonly string $name,
        public readonly string $path,
        public readonly string $sha,
    ) {
    }

    public static function from(array $data): self
    {
        return new self(
            $data['name'],
            $data['path'],
            $data['sha'],
        );
    }

    public static function makeWithFiles(array $files, string $name, string $path, string $sha): static
    {
        $folder = new static($name, $path, $sha);
        foreach ($files as $file) {
            if ($file instanceof Folder) {
                $folder->addFolder($file);
            } else {
                $folder->addFile($file);
            }
        }

        return $folder;
    }

    public function addFile(File $file)
    {
        $this->files[] = $file;
    }

    public function removeFile(File $file)
    {
        $this->files = array_filter($this->files, fn ($f) => $f->path !== $file->path);
    }

    public function addFolder(Folder $folder)
    {
        $this->folders[] = $folder;
    }

    public function removeFolder(Folder $folder)
    {
        $this->folders = array_filter($this->folders, fn ($f) => $f->path !== $folder->path);
    }

    public function getFolders(): array
    {
        return $this->folders;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function hasFile(string $path, bool $recursive = false): bool
    {
        if (! $recursive) {
            return in_array($path, array_map(fn ($f) => basename($f->path), $this->files));
        }

        foreach ($this->folders as $folder) {
            if ($folder->hasFile($path, true)) {
                return true;
            }
        }

        return in_array($path, array_map(fn ($f) => $f->path, $this->files));
    }
}
