<?php

use App\Atlas\Languages\Node;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Node())->name())->toBe('NodeJS');
});

test('custom context is null', function () {
    expect((new Node())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Node())->isOwnFile($file))->toBeTrue();
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
    expect((new Node())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
