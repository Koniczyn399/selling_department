<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Commission;
use App\Enums\Auth\PermissionType;
use Illuminate\Auth\Access\Response;

class CommissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::COMMISSION_ACCESS->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Commission $commision): bool
    {
        return $user->can(PermissionType::COMMISSION_ACCESS->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionType::COMMISSION_MANAGE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Commission $commision): bool
    {
        return $user->can(PermissionType::COMMISSION_MANAGE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Commission $commision): bool
    {
        return $user->can(PermissionType::COMMISSION_MANAGE->value);
    }

    /**
     * Determine whether the user can restore the model.
     
    *public function restore(User $user, Commission $commision): bool
    *{
     *   //
    *}

    **
     * Determine whether the user can permanently delete the model.
     
    *public function forceDelete(User $user, Commission $commision): bool
    *{
    *    //
    *}
    */
}
