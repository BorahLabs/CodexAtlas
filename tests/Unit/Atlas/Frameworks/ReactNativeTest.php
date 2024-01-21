<?php

use App\Atlas\Frameworks\ReactNative;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new ReactNative())->name())->toBe('React Native');
});

it('uses the right context', function () {
    expect((new ReactNative())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new ReactNative())->usesFramework($folder))->toBeFalse();

    $files = ['app.json', 'package.json'];
    collect($files)->each(fn (string $file) => $folder->addFile(new File(name: $file, path: $file, sha: '', downloadUrl: '')));
    expect((new ReactNative())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new ReactNative())->relevant())->toBe([
        '*.js',
        '*.ts',
        '*.tsx',
        '*.jsx',
    ]);
});

it('has the right ignorable files', function () {
    expect((new ReactNative())->ignorable())->toBe([
        '*.spec.js',
        '*.spec.ts',
        '*.spec.tsx',
        '*.spec.jsx',
    ]);
});
