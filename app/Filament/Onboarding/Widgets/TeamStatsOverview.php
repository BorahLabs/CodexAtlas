<?php

namespace App\Filament\Onboarding\Widgets;

use App\Models\Repository;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TeamStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Projects', auth()->user()->currentTeam->projects->count())
                ->icon('heroicon-o-cube-transparent'),
            Stat::make('Repositories', Repository::query()->whereIn('project_id', auth()->user()->currentTeam->projects->pluck('id'))->get()->count())
                ->icon('heroicon-o-document'),
            Stat::make('Source Code Accounts', auth()->user()->currentTeam->sourceCodeAccounts->count())
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
