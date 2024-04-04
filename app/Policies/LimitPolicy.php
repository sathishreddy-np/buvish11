<?php

namespace App\Policies;

use App\Models\Limit;
use App\Models\User;

class LimitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Limit $limit): bool
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Limit $limit): bool
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Limit $limit): bool
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Limit $limit): bool
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }


    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Limit $limit): bool
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }
}
