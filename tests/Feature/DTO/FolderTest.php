<?php

use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

test('Can add file', function () {
    $folder = new Folder('', '', '');
    $file = new File(name:'test', path: 'test', sha:'', downloadUrl: '');
    expect($folder->hasFile('test'))->toBe(false);
    $folder->addFile($file);
    expect($folder->hasFile('test'))->toBe(true);
});

test('Can remove file', function () {
    $folder = new Folder('', '', '');
    $file = new File(name:'test', path: 'test', sha:'', downloadUrl: '');
    $folder->addFile($file);
    expect($folder->hasFile('test'))->toBe(true);
    $folder->removeFile($file);
    expect($folder->hasFile('test'))->toBe(false);
});

test('Can add folder', function () {
    $folder = new Folder('', '', '');
    $secondFolder = new Folder('test', 'test', '');
    expect($folder->hasFolder($secondFolder->path))->toBe(false);
    $folder->addFolder($secondFolder);
    expect($folder->hasFolder($secondFolder->path))->toBe(true);
});

test('Can remove folder', function () {
    $folder = new Folder('', '', '');
    $secondFolder = new Folder('test', 'test', '');
    $folder->addFolder($secondFolder);
    expect($folder->hasFolder($secondFolder->path))->toBe(true);
    $folder->removeFolder($secondFolder);
});

test('Folder getter working', function () {
    $folder = new Folder('', '', '');
    $secondFolder = new Folder('test', 'test', '');
    expect($folder->getFolders())->toBeEmpty();
    $folder->addFolder($secondFolder);
    expect($folder->getFolders())->not->toBeEmpty();
});

test('Files getter working', function () {
    $folder = new Folder('', '', '');
    $file = new File(name:'test', path: 'test', sha:'', downloadUrl: '');
    expect($folder->getFiles())->toBeEmpty();
    $folder->addFile($file);
    expect($folder->getFiles())->not->toBeEmpty();
});

test('Can get file from folder', function () {
    $folder = new Folder('', '', '');
    $file = new File(name:'test', path: 'test', sha:'', downloadUrl: '');
    expect($folder->getFile($file->path))->toBe(null);
    $folder->addFile($file);
    expect($folder->getFile($file->path))->toBe($file);
});

test('Can check if a file exists recursively', function () {
    $folder = new Folder('', '', '');
    $secondFolder = new Folder('folder', 'folder', '');
    $folder->addFolder($secondFolder);
    $file = new File(name:'test', path: 'test', sha:'', downloadUrl: '');
    expect($folder->hasFile($file->path, true))->toBe(false);
    $secondFolder->addFile($file);
    expect($folder->hasFile($file->path, true))->toBe(true);
});

test('Can check if a folder exists recursively', function () {
    $folder = new Folder('firstFolder', 'firstFolder', '');
    $secondFolder = new Folder('secondFolder', 'firstFolder/secondFolder', '');
    $thirdFolder = new Folder('thirdFolder', 'firstFolder/secondFolder/thirdFolder', '');
    
    $secondFolder->addFolder($thirdFolder);
    expect($folder->hasFolder($thirdFolder->path, true))->toBe(false);
    $folder->addFolder($secondFolder);
    expect($folder->hasFolder($thirdFolder->path, true))->toBe(true);
});

