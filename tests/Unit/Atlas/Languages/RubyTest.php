<?php

use App\Atlas\Languages\Ruby;
use App\SourceCode\DTO\File;

test('name is correct', function () {
    expect((new Ruby())->name())->toBe('Ruby');
});

test('custom context is null', function () {
    expect((new Ruby())->customContext())->toBeNull();
});

test('detects language files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Ruby())->isOwnFile($file))->toBeTrue();
})->with([
    'test.rb',
    'test2.erb',
    'FILE.Rb',
]);

test('detects wrong files', function (string $path) {
    $file = new File(name: $path, path: $path, sha: '', downloadUrl: '');
    expect((new Ruby())->isOwnFile($file))->not->toBeTrue();
})->with([
    'test.npm',
    'test2.',
    'FILE.js',
]);
