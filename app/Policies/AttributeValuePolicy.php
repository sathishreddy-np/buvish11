<?php

namespace App\Policies;

use App\Models\AttributeValue;
use App\Models\User;

class AttributeValuePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('AttributeValue::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AttributeValue $attributeValue): bool
    {
        return $user->hasPermissionTo('AttributeValue::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('AttributeValue::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AttributeValue $attributeValue): bool
    {
        return $user->hasPermissionTo('AttributeValue::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AttributeValue $attributeValue): bool
    {
        return $user->hasPermissionTo('AttributeValue::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('AttributeValue::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AttributeValue $attributeValue): bool
    {
        return $user->hasPermissionTo('AttributeValue::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('AttributeValue::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AttributeValue $attributeValue): bool
    {
        return $user->hasPermissionTo('AttributeValue::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('AttributeValue::forceDeleteAny');
    }
}
