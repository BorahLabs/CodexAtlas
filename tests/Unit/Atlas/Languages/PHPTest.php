<?php

use App\Atlas\Languages\PHP;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new PHP())->name())->toBe('PHP');
});

test('custom context is null', function () {
    expect((new PHP())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new PHP())->isOwnFile($file))->toBeTrue();
})->with([
    'test.php',
    'test2.PHP',
    'FILE.pHp',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new PHP())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
