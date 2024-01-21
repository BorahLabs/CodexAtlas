<?php

use App\Atlas\Frameworks\Spring;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new Spring())->name())->toBe('Spring');
});

it('uses the right context', function () {
    expect((new Spring())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new Spring())->usesFramework($folder))->toBeFalse();

    $files = ['pom.xml'];
    collect($files)->each(fn (string $file) => $folder->addFile(new File(name: $file, path: $file, sha: '', downloadUrl: '')));
    expect((new Spring())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new Spring())->relevant())->toBe([
        '*.java',
    ]);
});

it('has the right ignorable files', function () {
    expect((new Spring())->ignorable())->toBe([]);
});
