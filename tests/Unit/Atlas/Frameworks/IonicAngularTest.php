<?php

use App\Atlas\Frameworks\IonicAngular;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new IonicAngular())->name())->toBe('Ionic + Angular');
});

it('uses the right context', function () {
    expect((new IonicAngular())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new IonicAngular())->usesFramework($folder))->toBeFalse();

    $files = ['ionic.config.json', 'angular.json'];
    collect($files)->each(fn (string $file) => $folder->addFile(new File(name: $file, path: $file, sha: '', downloadUrl: '')));
    expect((new IonicAngular())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new IonicAngular())->relevant())->toBe([
        'src/*.ts',
        'src/*.html',
        'src/*.scss',
    ]);
});

it('has the right ignorable files', function () {
    expect((new IonicAngular())->ignorable())->toBe([
        '*/environments/*',
        '*/polyfills.ts',
        '*/test.ts',
        '*/zone-flags.ts',
        '*.spec.ts',
    ]);
});
