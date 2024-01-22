<?php

use App\Atlas\Languages\Swift;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Swift())->name())->toBe('Swift');
});

test('custom context is null', function () {
    expect((new Swift())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Swift())->isOwnFile($file))->toBeTrue();
})->with([
    'test.swift',
    'test2.Swift',
    'FILE.sWift',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Swift())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
