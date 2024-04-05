<?php

namespace App\Policies;

use App\Models\InvoiceItem;
use App\Models\User;

class InvoiceItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('InvoiceItem::viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InvoiceItem $invoiceItem): bool
    {
        return $user->hasPermissionTo('InvoiceItem::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('InvoiceItem::create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InvoiceItem $invoiceItem): bool
    {
        return $user->hasPermissionTo('InvoiceItem::update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InvoiceItem $invoiceItem): bool
    {
        return $user->hasPermissionTo('InvoiceItem::delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('InvoiceItem::deleteAny');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InvoiceItem $invoiceItem): bool
    {
        return $user->hasPermissionTo('InvoiceItem::restore');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('InvoiceItem::restoreAny');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InvoiceItem $invoiceItem): bool
    {
        return $user->hasPermissionTo('InvoiceItem::forceDelete');
    }

    /**
     * Determine whether the user can bulk permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('InvoiceItem::forceDeleteAny');
    }
}
