<?php

use App\Atlas\Languages\Html;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Html())->name())->toBe('HTML');
});

test('custom context is null', function () {
    expect((new Html())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Html())->isOwnFile($file))->toBeTrue();
})->with([
    'test.html',
    'test2.HTML',
    'FILE.hTmL',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Html())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.css',
]);
