<?php

namespace App\Policies;

use App\Enums\SubscriptionType;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return $user->belongsToTeam($team);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // A user can have a maximum of one team with a free plan
        /**
         * @var Team $team
         */
        foreach ($user->ownedTeams as $team) {
            if ($team->subscriptionType() === SubscriptionType::FreeTrial) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can add team members.
     */
    public function addTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can update team member permissions.
     */
    public function updateTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can remove team members.
     */
    public function removeTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function createProject(User $user): bool
    {
        /**
         * @var Team $team
         */
        $team = $user->currentTeam;
        $subscriptionType = $team->subscriptionType();

        return $subscriptionType->maxProjects() === null || $subscriptionType->maxProjects() > $team->projects()->count();
    }

    public function createRepository(User $user): bool
    {
        /**
         * @var Team $team
         */
        $team = $user->currentTeam;
        $subscriptionType = $team->subscriptionType();

        return $subscriptionType->maxRepositories() === null || $subscriptionType->maxRepositories() > $team->repositories()->count();
    }
}
