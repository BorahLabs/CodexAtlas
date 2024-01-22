<?php

use App\Atlas\Frameworks\Angular;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new Angular())->name())->toBe('Angular');
});

it('uses the right context', function () {
    expect((new Angular())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new Angular())->usesFramework($folder))->toBeFalse();

    $files = ['angular.json', 'package.json'];
    collect($files)->each(fn (string $file) => $folder->addFile(new File(name: $file, path: $file, sha: '', downloadUrl: '')));
    expect((new Angular())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new Angular())->relevant())->toBe([
        '*.ts',
        '*.html',
        '*.scss',
        '*.css',
        '*.js',
    ]);
});

it('has the right ignorable files', function () {
    expect((new Angular())->ignorable())->toBe([
        '*.spec.*',
        '*.e2e-spec.*',
        'karma.conf.*',
    ]);
});
