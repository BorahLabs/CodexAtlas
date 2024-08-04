<?php

namespace App\Filament\Onboarding\Pages;

use Filament\Pages\Page;

class Welcome extends Page
{
    protected static string $view = 'filament.onboarding.pages.welcome';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Welcome to Digital Onboarding';

    public function getStarted()
    {
        request()->user()->currentTeam->update([
            'has_configured_onboarding' => true,
        ]);

        return redirect()->route('filament.onboarding.resources.projects.create');
    }
}
