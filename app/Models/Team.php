<?php

namespace App\Models;

use App\Actions\Platform\GenerateTeamPlatformDomain;
use App\Enums\SubscriptionType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;
use Spark\Billable;

class Team extends JetstreamTeam
{
    use Billable;
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'personal_team' => 'boolean',
        'trial_ends_at' => 'datetime',
        'openai_key' => 'encrypted',
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

    public static function booted(): void
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

    public function repositories(): HasManyThrough
    {
        return $this->hasManyThrough(Repository::class, Project::class);
    }

    public function platforms(): HasMany
    {
        return $this->hasMany(Platform::class);
    }

    public function currentPlatform(): Platform
    {
        return $this->platforms->first();
    }

    public function stripeEmail(): ?string
    {
        return $this->owner->email;
    }

    public function subscriptionType(): SubscriptionType
    {
        /**
         * @var User $owner
         */
        $owner = $this->owner;
        if ($owner->emailIsFromCodex()) {
            return SubscriptionType::Unlimited;
        }

        if (paymentIsWithAws()) {
            if ($owner->isSubscribedOnAws()) {
                return SubscriptionType::PayAsYouGo;
            }

            return SubscriptionType::FreeTrial;
        }

        if ($plan = $this->sparkPlan()) {
            return $this->openai_key && config('codex.pay_as_you_go') ? SubscriptionType::UnlimitedCompanyPlan : SubscriptionType::LimitedCompanyPlan;
        }

        if ($this->openai_key && config('codex.pay_as_you_go')) {
            return SubscriptionType::PayAsYouGo;
        }

        return SubscriptionType::FreeTrial;
    }

    public function purge(): void
    {
        // TODO: Delete all projects, repositories, and source code accounts
        // here
        parent::purge();
    }
}
