<?php

use App\Atlas\Languages\Javascript;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Javascript())->name())->toBe('Javascript');
});

test('custom context is null', function () {
    expect((new Javascript())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Javascript())->isOwnFile($file))->toBeTrue();
})->with([
    'test.js',
    'test2.JS',
    'FILE.jS',
    'test.ts',
    'test2.TS',
    'FILE.tS',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Javascript())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
