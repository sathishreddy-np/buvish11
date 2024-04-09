<?php

namespace App\Policies;

use App\Models\Timing;
use App\Models\User;

class TimingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Timing::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Timing $Timing): bool
    {
        return $user->hasPermissionTo('Timing::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Timing::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Timing $Timing): bool
    {
        return $user->hasPermissionTo('Timing::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Timing $Timing): bool
    {
        return $user->hasPermissionTo('Timing::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Timing::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Timing $Timing): bool
    {
        return $user->hasPermissionTo('Timing::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('Timing::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Timing $Timing): bool
    {
        return $user->hasPermissionTo('Timing::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Timing::forceDeleteAny');
    }
}
