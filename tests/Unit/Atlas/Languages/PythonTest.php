<?php

use App\Atlas\Languages\Python;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Python())->name())->toBe('Python');
});

test('custom context is null', function () {
    expect((new Python())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Python())->isOwnFile($file))->toBeTrue();
})->with([
    'test.py',
    'test2.PY',
    'FILE.pY',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Python())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
