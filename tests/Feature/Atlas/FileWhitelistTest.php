<?php

use App\Atlas\FileWhitelist;

test('invalid paths are blocked', function (string $path) {
    expect(FileWhitelist::whitelisted($path))->toBeFalse();
})->with([
    'node_modules/file',
    'vendor/file',
    'Pods/file',
    'Carthage/file',
    'build/file',
    'dist/file',
    'out/file',
    'target/file',
    'bin/file',
    '__pycache__/file',
]);

test('valid paths are not blocked', function () {
    expect(FileWhitelist::whitelisted('README.md'))->toBeTrue();
    expect(FileWhitelist::whitelisted('src/app.js'))->toBeTrue();
});
