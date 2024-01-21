<?php

use App\Atlas\Languages\Rust;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Rust())->name())->toBe('Rust');
});

test('custom context is null', function () {
    expect((new Rust())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Rust())->isOwnFile($file))->toBeTrue();
})->with([
    'test.rust',
    'test2.RUST',
    'FILE.rUsT',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Rust())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
