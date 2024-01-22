<?php

use App\Atlas\Frameworks\Nuxt;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new Nuxt())->name())->toBe('NuxtJS');
});

it('uses the right context', function () {
    expect((new Nuxt())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new Nuxt())->usesFramework($folder))->toBeFalse();

    $files = ['nuxt.config.ts', 'nuxt.config.js'];
    collect($files)->each(fn (string $file) => $folder->addFile(new File(name: $file, path: $file, sha: '', downloadUrl: '')));
    expect((new Nuxt())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new Nuxt())->relevant())->toBe([
        '*.vue',
        '*.ts',
        '*.js',
        '*.jsx',
        '*.tsx',
        '*.css',
        '*.scss',
    ]);
});

it('has the right ignorable files', function () {
    expect((new Nuxt())->ignorable())->toBe([]);
});
