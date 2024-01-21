<?php

use App\Atlas\Languages\Kotlin;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Kotlin())->name())->toBe('Kotlin');
});

test('custom context is null', function () {
    expect((new Kotlin())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Kotlin())->isOwnFile($file))->toBeTrue();
})->with([
    'test.ktl',
    'test2.KTL',
    'FILE.Ktl',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Kotlin())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
