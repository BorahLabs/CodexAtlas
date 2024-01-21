<?php

use App\Atlas\Frameworks;
use App\Atlas\Guesser;
use App\Atlas\Languages;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

test('Laravel is supported', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'composer.json', path: 'composer.json', sha: '', downloadUrl: ''));
    $folder->addFile(new File(name: 'artisan', path: 'artisan', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\Laravel::class);
});

test('Spring is supported', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'pom.xml', path: 'pom.xml', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBeClass(Frameworks\Spring::class);
});

test('Django is supported', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'manage.py', path: 'manage.py', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBeClass(Frameworks\Django::class);
});

test('Ionic+Angular is supported', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'ionic.config.json', path: 'ionic.config.json', sha: '', downloadUrl: ''));
    $folder->addFile(new File(name: 'angular.json', path: 'angular.json', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\IonicAngular::class);
});

test('Next is supported', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'next.config.ts', path: 'next.config.ts', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\Next::class);

    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'next.config.js', path: 'next.config.js', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\Next::class);
});

test('Nuxt is supported', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'nuxt.config.ts', path: 'nuxt.config.ts', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\Nuxt::class);

    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'nuxt.config.js', path: 'nuxt.config.js', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\Nuxt::class);
});

test('React Native is supported', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'app.json', path: 'app.json', sha: '', downloadUrl: ''));
    $folder->addFile(new File(name: 'package.json', path: 'package.json', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\ReactNative::class);
});

test('Angular is supported', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'angular.json', path: 'angular.json', sha: '', downloadUrl: ''));
    $folder->addFile(new File(name: 'package.json', path: 'package.json', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\Angular::class);
});

test('React is supported', function () {
})->skip('TODO');

test('Vue is supported', function () {
})->skip('TODO');

test('Fallbacks to general framework', function () {
    $folder = new Folder('', '', '');
    $folder->addFile(new File(name: 'index.php', path: 'index.php', sha: '', downloadUrl: ''));
    expect(get_class(Guesser::make()->guessFramework($folder)))->toBe(Frameworks\GeneralFramework::class);
});

test('Cobol is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Cobol::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Cobol::class);
})->with([
    'file.cbl',
]);

test('Css is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Css::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Css::class);
})->with([
    'style.css',
    'style.scss',
]);

test('DotNet is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\DotNet::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\DotNet::class);
})->with([
    'Program.cs',
]);

test('Go is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Go::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Go::class);
})->with([
    'main.go',
]);

test('Html is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Html::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Html::class);
})->with([
    'index.html',
]);

test('Java is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Java::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Java::class);
})->with([
    'Main.java',
]);

test('Javascript is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Javascript::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Javascript::class);
})->with([
    'app.js',
    'app.ts',
]);

test('Kotlin is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Kotlin::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Kotlin::class);
})->with([
    'Main.kt',
    'Main.kts',
]);

test('Node is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Node::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Node::class);
})->with([
    'app.js',
    'app.ts',
])->skip('TODO: no difference with JS?');

test('PHP is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\PHP::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\PHP::class);
})->with([
    'index.php',
]);

test('Python is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Python::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Python::class);
})->with([
    'app.py',
]);

test('Rust is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Rust::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Rust::class);
})->with([
    'main.rs',
]);

test('Swift is supported', function (string $fileName) {
    $file = new File(name: $fileName, path: $fileName, sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Swift::class);
    $file = new File(name: mb_strtoupper($fileName), path: mb_strtoupper($fileName), sha: '', downloadUrl: '');
    expect(get_class(Guesser::make()->guessLanguage($file)))->toBe(Languages\Swift::class);
})->with([
    'main.swift',
]);

test('Cannot detect unknown language', function () {
    $file = new File(name: 'another-file.md', path: 'another-file.md', sha: '', downloadUrl: '');
    Guesser::make()->guessLanguage($file);
})->expectException(\App\Exceptions\CouldNotDetectLanguage::class);
