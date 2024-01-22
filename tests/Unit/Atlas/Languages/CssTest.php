<?php

use App\Atlas\Languages\Css;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Css())->name())->toBe('CSS');
});

test('custom context is null', function () {
    expect((new Css())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Css())->isOwnFile($file))->toBeTrue();
})->with([
    'test.css',
    'test2.CSS',
    'FILE.scSS',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Css())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.js',
]);
