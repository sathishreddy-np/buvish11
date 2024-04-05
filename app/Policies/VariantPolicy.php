<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Variant;

class VariantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Variant::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Variant $variant): bool
    {
        return $user->hasPermissionTo('Variant::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Variant::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Variant $variant): bool
    {
        return $user->hasPermissionTo('Variant::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Variant $variant): bool
    {
        return $user->hasPermissionTo('Variant::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Variant::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Variant $variant): bool
    {
        return $user->hasPermissionTo('Variant::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('Variant::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Variant $variant): bool
    {
        return $user->hasPermissionTo('Variant::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Variant::forceDeleteAny');
    }
}
