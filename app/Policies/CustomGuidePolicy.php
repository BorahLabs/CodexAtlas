<?php

namespace App\Policies;

use App\Models\CustomGuide;
use App\Models\Platform;
use App\Models\User;

class CustomGuidePolicy
{
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
    public function view(?User $user, CustomGuide $customGuide): bool
    {
        $team = $customGuide->branch->repository->project->team;
        $platform = $team->currentPlatform();

        return $platform->is_public || $user?->belongsToTeam($team) ?? false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $platform = Platform::current();
        if (is_null($platform)) {
            return false;
        }

        return $user->belongsToTeam($platform->team);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, CustomGuide $customGuide): bool
    {
        if (is_null($user)) {
            return false;
        }

        $platform = Platform::current();
        if (is_null($platform)) {
            return false;
        }

        return $user->belongsToTeam($platform->team);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, CustomGuide $customGuide): bool
    {
        if (is_null($user)) {
            return false;
        }

        $platform = Platform::current();
        if (is_null($platform)) {
            return false;
        }

        return $user->belongsToTeam($platform->team);
    }
}
