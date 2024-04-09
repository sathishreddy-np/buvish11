<?php

namespace App\Policies;

use App\Models\Availability;
use App\Models\User;

class AvailabilityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Availability::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Availability $Availability): bool
    {
        return $user->hasPermissionTo('Availability::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Availability::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Availability $Availability): bool
    {
        return $user->hasPermissionTo('Availability::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Availability $Availability): bool
    {
        return $user->hasPermissionTo('Availability::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Availability::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Availability $Availability): bool
    {
        return $user->hasPermissionTo('Availability::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('Availability::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Availability $Availability): bool
    {
        return $user->hasPermissionTo('Availability::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Availability::forceDeleteAny');
    }
}
