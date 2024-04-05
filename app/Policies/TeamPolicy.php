<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;

class TeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Team::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('Team::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Team::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('Team::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('Team::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Team::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('Team::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('Team::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('Team::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Team::forceDeleteAny');
    }
}
