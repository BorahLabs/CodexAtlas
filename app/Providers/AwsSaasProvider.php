<?php

namespace App\Providers;

use App\Models\Branch;
use App\Models\ProcessingLogEntry;
use App\Models\Project;
use App\Models\Repository;
use App\Models\SystemComponent;
use App\Models\User;
use BorahLabs\AwsMarketplaceSaas\DTO\AwsSaasCustomer;
use BorahLabs\AwsMarketplaceSaas\Facades\AwsMarketplaceSaas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AwsSaasProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        AwsMarketplaceSaas::addDimension(
            name: 'BRANCH',
            model: ProcessingLogEntry::class,
            query: function (Builder $query, User $user) {
                $teams = $user->ownedTeams->pluck('id')->toArray();
                $query->whereIn('team_id', $teams);
            }
        );
    }
}
