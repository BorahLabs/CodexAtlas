<?php

use App\Atlas\Languages\DotNet;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new DotNet())->name())->toBe('.NET');
});

test('custom context is null', function () {
    expect((new DotNet())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new DotNet())->isOwnFile($file))->toBeTrue();
})->with([
    'test.cs',
    'test2.CS',
    'FILE.cS',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new DotNet())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
