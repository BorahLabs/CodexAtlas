<?php

use App\Atlas\Languages\Cobol;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Cobol())->name())->toBe('COBOL');
});

test('custom context is null', function () {
    expect((new Cobol())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Cobol())->isOwnFile($file))->toBeTrue();
})->with([
    'test.cbl',
    'test2.CBL',
    'FILE.cBl',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Cobol())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.js',
]);
