<?php

namespace App\Policies;

use App\Models\SubscriptionType;
use App\Models\User;

class SubscriptionTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('SubscriptionType::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubscriptionType $SubscriptionType): bool
    {
        return $user->hasPermissionTo('SubscriptionType::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('SubscriptionType::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubscriptionType $SubscriptionType): bool
    {
        return $user->hasPermissionTo('SubscriptionType::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubscriptionType $SubscriptionType): bool
    {
        return $user->hasPermissionTo('SubscriptionType::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('SubscriptionType::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubscriptionType $SubscriptionType): bool
    {
        return $user->hasPermissionTo('SubscriptionType::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('SubscriptionType::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubscriptionType $SubscriptionType): bool
    {
        return $user->hasPermissionTo('SubscriptionType::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('SubscriptionType::forceDeleteAny');
    }
}
