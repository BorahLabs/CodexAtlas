<?php

use App\Atlas\Languages\Java;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Java())->name())->toBe('Java');
});

test('custom context is null', function () {
    expect((new Java())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Java())->isOwnFile($file))->toBeTrue();
})->with([
    'test.java',
    'test2.JAVA',
    'FILE.JaVa',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Java())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
