<?php

use App\Atlas\Frameworks\Flutter;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new Flutter())->name())->toBe('Flutter');
});

it('uses the right context', function () {
    expect((new Flutter())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new Flutter())->usesFramework($folder))->toBeFalse();

    $folder->addFile(new File(name: 'pubspec.yaml', path: 'pubspec.yaml', sha: '', downloadUrl: '', contents: 'flutter'));
    expect((new Flutter())->usesFramework($folder))->toBeTrue();

    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'pubspec.yaml', path: 'pubspec.yaml', sha: '', downloadUrl: '', contents: ''));
    expect((new Flutter())->usesFramework($folder))->toBeFalse();
});

it('has the right relevant files', function () {
    expect((new Flutter())->relevant())->toBe([
        'lib/*.dart',
    ]);
});

it('has the right ignorable files', function () {
    expect((new Flutter())->ignorable())->toBe([]);
});
