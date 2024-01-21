<?php

use App\Atlas\Frameworks\GeneralFramework;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new GeneralFramework())->name())->toBe('Default');
});

it('uses the right context', function () {
    expect((new GeneralFramework())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new GeneralFramework())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new GeneralFramework())->relevant())->toBe([
        '*.*',
    ]);
});

it('has the right ignorable files', function () {
    expect((new GeneralFramework())->ignorable())->toBe([
        '.*',
        '*/.*',
        '*.md',
        '.git*',
        'vendor/*',
        'node_modules/*',
        '__pycache__/*',
        'build/*',
        'dist/*',
        'public/*',
        'storage/*',
        'bootstrap/*',
        'tests/*',
        '*/vendor/*',
        '*/node_modules/*',
        '*/__pycache__/*',
        '*/build/*',
        '*/dist/*',
        '*/public/*',
        '*/storage/*',
    ]);
});
