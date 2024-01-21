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
    'test.kt',
    'test2.KT',
    'FILE.Kt',
    'test.kts',
    'test2.KTS',
    'FILE.KtS',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Kotlin())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
