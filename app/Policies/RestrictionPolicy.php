<?php

namespace App\Policies;

use App\Models\Restriction;
use App\Models\User;

class RestrictionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Restriction::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Restriction $Restriction): bool
    {
        return $user->hasPermissionTo('Restriction::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Restriction::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Restriction $Restriction): bool
    {
        return $user->hasPermissionTo('Restriction::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Restriction $Restriction): bool
    {
        return $user->hasPermissionTo('Restriction::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Restriction::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Restriction $Restriction): bool
    {
        return $user->hasPermissionTo('Restriction::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('Restriction::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Restriction $Restriction): bool
    {
        return $user->hasPermissionTo('Restriction::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Restriction::forceDeleteAny');
    }
}
