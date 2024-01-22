<?php

use App\Atlas\Frameworks\Laravel;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

it('has the right name', function () {
    expect((new Laravel())->name())->toBe('Laravel');
});

it('uses the right context', function () {
    expect((new Laravel())->customContext())->toBeNull();
});

it('detects the framework correctly', function () {
    $folder = new Folder('', '', '');
    expect((new Laravel())->usesFramework($folder))->toBeFalse();

    $files = ['composer.json', 'artisan'];
    collect($files)->each(fn (string $file) => $folder->addFile(new File(name: $file, path: $file, sha: '', downloadUrl: '')));
    expect((new Laravel())->usesFramework($folder))->toBeTrue();
});

it('has the right relevant files', function () {
    expect((new Laravel())->relevant())->toBe([
        'app/*.php',
        'routes/*.php',
        'resources/*.blade.php',
    ]);
});

it('has the right ignorable files', function () {
    expect((new Laravel())->ignorable())->toBe([
        'app/Providers/AppServiceProvider.php',
        'app/Providers/AuthServiceProvider.php',
        'app/Providers/BroadcastServiceProvider.php',
        'app/Providers/EventServiceProvider.php',
        'app/Providers/RouteServiceProvider.php',
        'app/Http/Middleware/Authenticate.php',
        'app/Http/Middleware/EncryptCookies.php',
        'app/Http/Middleware/PreventRequestsDuringMaintenance.php',
        'app/Http/Middleware/RedirectIfAuthenticated.php',
        'app/Http/Middleware/TrimStrings.php',
        'app/Http/Middleware/TrustHosts.php',
        'app/Http/Middleware/TrustProxies.php',
        'app/Http/Middleware/ValidateSignature.php',
        'app/Http/Kernel.php',
    ]);
});
