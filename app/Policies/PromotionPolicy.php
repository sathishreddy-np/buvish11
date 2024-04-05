<?php

namespace App\Policies;

use App\Models\Promotion;
use App\Models\User;

class PromotionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Promotion::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Promotion $promotion): bool
    {
        return $user->hasPermissionTo('Promotion::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Promotion::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Promotion $promotion): bool
    {
        return $user->hasPermissionTo('Promotion::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Promotion $promotion): bool
    {
        return $user->hasPermissionTo('Promotion::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Promotion::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Promotion $promotion): bool
    {
        return $user->hasPermissionTo('Promotion::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('Promotion::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Promotion $promotion): bool
    {
        return $user->hasPermissionTo('Promotion::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Promotion::forceDeleteAny');
    }
}
