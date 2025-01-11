<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\Auth\PermissionType;
use App\Models\CommissionKomponent;
use Illuminate\Auth\Access\Response;

class CommissionKomponentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::COMMISSION_KOMPONENT_ACCESS->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CommissionKomponent $commisionKomponent): bool
    {
        return $user->can(PermissionType::COMMISSION_KOMPONENT_ACCESS->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionType::COMMISSION_KOMPONENT_MANAGE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CommissionKomponent $commissionKomponent): bool
    {
        return $user->can(PermissionType::COMMISSION_KOMPONENT_MANAGE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CommissionKomponent $commissionKomponent): bool
    {
        return $user->can(PermissionType::COMMISSION_KOMPONENT_MANAGE->value);
    }

    /**
     * Determine whether the user can restore the model.
    
    *public function restore(User $user, CommissionKomponent $commissionKomponent): bool
    *{
     *   //
    *}

    **
     * Determine whether the user can permanently delete the model.
    
    *public function forceDelete(User $user, CommissionKomponent $commissionKomponent): bool
    *{
    *    //
    *}
    */
}
