<?php

use App\Atlas\Frameworks\Vue;

it('has the right name', function () {
    expect((new Vue())->name())->toBe('Vue');
});

it('uses the right context', function () {
    expect((new Vue())->customContext())->toBeNull();
});

it('uses the right dependencies', function () {
    expect((new Vue())->getDependencies())->toBe([
        '"vue"',
    ]);
});

it('has the right dependency file path', function () {
    expect((new Vue())->getDependencyFilePath())->toBe('package.json');
});

it('has the right relevant files', function () {
    expect((new Vue())->relevant())->toBe([
        '*.ts',
        '*.html',
        '*.scss',
        '*.css',
        '*.js',
        '*.vue',
    ]);
});

it('has the right ignorable files', function () {
    expect((new Vue())->ignorable())->toBe([
        '*.spec.*',
        '*.test.*',
        'jest.config.*',
    ]);
});
