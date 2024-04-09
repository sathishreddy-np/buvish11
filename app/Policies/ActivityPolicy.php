<?php

namespace App\Policies;

use App\Models\Activity;
use App\Models\User;

class ActivityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Activity::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Activity $Activity): bool
    {
        return $user->hasPermissionTo('Activity::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Activity::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Activity $Activity): bool
    {
        return $user->hasPermissionTo('Activity::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Activity $Activity): bool
    {
        return $user->hasPermissionTo('Activity::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Activity::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Activity $Activity): bool
    {
        return $user->hasPermissionTo('Activity::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('Activity::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Activity $Activity): bool
    {
        return $user->hasPermissionTo('Activity::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Activity::forceDeleteAny');
    }
}
