<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('User::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $userModel): bool
    {
        return $user->hasPermissionTo('User::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('User::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $userModel): bool
    {
        return $user->hasPermissionTo('User::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $userModel): bool
    {
        return $user->hasPermissionTo('User::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('User::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $userModel): bool
    {
        return $user->hasPermissionTo('User::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('User::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $userModel): bool
    {
        return $user->hasPermissionTo('User::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('User::forceDeleteAny');
    }
}
