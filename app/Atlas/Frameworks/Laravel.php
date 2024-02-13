<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Laravel extends Framework
{
    public function name(): string
    {
        return 'Laravel';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/laravel.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('composer.json') && $folder->hasFile('artisan');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            'app/*.php',
            'routes/*.php',
            'resources/*.blade.php',
        ];
    }

    public function ignorable(): array
    {
        return [
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
        ];
    }
}
