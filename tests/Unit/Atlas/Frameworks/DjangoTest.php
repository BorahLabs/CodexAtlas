<?php

use App\Atlas\Frameworks\Django;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new Django())->name())->toBe('Django');
});

it('uses the right context', function () {
    expect((new Django())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new Django())->usesFramework($folder))->toBeFalse();

    $files = ['manage.py'];
    collect($files)->each(fn (string $file) => $folder->addFile(new File(name: $file, path: $file, sha: '', downloadUrl: '')));
    expect((new Django())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new Django())->relevant())->toBe([
        '*.py',
        '*.html',
        '*.scss',
        '*.css',
        '*.js',
    ]);
});

it('has the right ignorable files', function () {
    expect((new Django())->ignorable())->toBe([]);
});
