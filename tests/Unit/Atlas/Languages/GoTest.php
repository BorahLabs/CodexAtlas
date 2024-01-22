<?php

use App\Atlas\Languages\Go;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Go())->name())->toBe('Go');
});

test('custom context is null', function () {
    expect((new Go())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Go())->isOwnFile($file))->toBeTrue();
})->with([
    'test.go',
    'test2.GO',
    'FILE.Go',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Go())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
