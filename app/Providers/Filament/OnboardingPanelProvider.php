<?php

namespace App\Providers\Filament;

use App\Http\Middleware\ConfigureRequestsFromOnboarding;
use App\Models\Team;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class OnboardingPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('onboarding')
            ->path('/')
            ->domain(config('app.digital_onboarding_domain'))
            ->login()
            ->darkMode(isForced: true)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Onboarding/Resources'), for: 'App\\Filament\\Onboarding\\Resources')
            ->discoverPages(in: app_path('Filament/Onboarding/Pages'), for: 'App\\Filament\\Onboarding\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->topNavigation()
            ->discoverWidgets(in: app_path('Filament/Onboarding/Widgets'), for: 'App\\Filament\\Onboarding\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                ConfigureRequestsFromOnboarding::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
