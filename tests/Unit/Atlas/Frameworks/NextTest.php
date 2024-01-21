<?php

use App\Atlas\Frameworks\Next;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new Next())->name())->toBe('Next');
});

it('uses the right context', function () {
    expect((new Next())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new Next())->usesFramework($folder))->toBeFalse();

    $files = ['next.config.ts', 'next.config.js'];
    collect($files)->each(fn (string $file) => $folder->addFile(new File(name: $file, path: $file, sha: '', downloadUrl: '')));
    expect((new Next())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new Next())->relevant())->toBe([
        '*.js',
        '*.jsx',
        '*.ts',
        '*.tsx',
        '*.css',
        '*.scss',
    ]);
});

it('has the right ignorable files', function () {
    expect((new Next())->ignorable())->toBe([]);
});
