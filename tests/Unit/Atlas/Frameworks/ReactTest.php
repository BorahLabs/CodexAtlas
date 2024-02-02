<?php

use App\Atlas\Frameworks\React;

it('has the right name', function () {
    expect((new React())->name())->toBe('React');
});

it('uses the right context', function () {
    expect((new React())->customContext())->toBeNull();
});

it('uses the right dependencies', function () {
    expect((new React())->getDependencies())->toBe([
        '"react"',
    ]);
});

it('has the right dependency file path', function () {
    expect((new React())->getDependencyFilePath())->toBe('package.json');
});

it('has the right relevant files', function () {
    expect((new React())->relevant())->toBe([
        '*.ts',
        '*.html',
        '*.scss',
        '*.css',
        '*.js',
        '*.jsx',
    ]);
});

it('has the right ignorable files', function () {
    expect((new React())->ignorable())->toBe([
        '*.spec.*',
        '*.test.*',
        'jest.config.*',
    ]);
});
