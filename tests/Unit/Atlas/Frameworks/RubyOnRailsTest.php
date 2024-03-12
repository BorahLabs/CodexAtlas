<?php

use App\Atlas\Frameworks\RubyOnRails;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new RubyOnRails())->name())->toBe('Ruby on Rails');
});

it('uses the right context', function () {
    expect((new RubyOnRails())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new RubyOnRails())->usesFramework($folder))->toBeFalse();

    $folder->addFile(new File(name: 'Rakefile', path: 'Rakefile', sha: '', downloadUrl: ''));
    expect((new RubyOnRails())->usesFramework($folder))->toBeFalse();

    $folder->addFile(new File(name: 'Gemfile', path: 'Gemfile', sha: '', downloadUrl: ''));
    expect((new RubyOnRails())->usesFramework($folder))->toBeFalse();

    $folder->addFolder(new Folder(name: 'app', path: 'app', sha: ''));
    expect((new RubyOnRails())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new RubyOnRails())->relevant())->toBe([
        'app/*.rb',
        'app/*.erb',
    ]);
});

it('has the right ignorable files', function () {
    expect((new RubyOnRails())->ignorable())->toBe([]);
});
