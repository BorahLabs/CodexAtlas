<?php

namespace App\Models;

use App\Actions\Platform\GenerateTeamPlatformDomain;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;
use Spark\Billable;

class Team extends JetstreamTeam
{
    use HasFactory;
    use HasUuids;
    use Billable;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'personal_team' => 'boolean',
        'trial_ends_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public static function booted()
    {
        parent::booted();

        static::created(function (Team $team) {
            $team->platforms()->create([
                'domain' => GenerateTeamPlatformDomain::run($team),
            ]);
        });
    }

    public function sourceCodeAccounts(): HasMany
    {
        return $this->hasMany(SourceCodeAccount::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function platforms(): HasMany
    {
        return $this->hasMany(Platform::class);
    }

    public function currentPlatform(): Platform
    {
        return $this->platforms->first();
    }

    public function stripeEmail(): string|null
    {
        return $this->owner->email;
    }
}
