<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CommissionService;
use App\Enums\Auth\PermissionType;
use Illuminate\Auth\Access\Response;

class CommissionServicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::COMMISSION_SERVICE_ACCESS->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CommissionService $commisionService): bool
    {
        return $user->can(PermissionType::COMMISSION_SERVICE_ACCESS->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionType::COMMISSION_SERVICE_MANAGE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CommissionService $commissionService): bool
    {
        return $user->can(PermissionType::COMMISSION_SERVICE_MANAGE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CommissionService $commissionService): bool
    {
        return $user->can(PermissionType::COMMISSION_SERVICE_MANAGE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CommissionService $commissionService): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CommissionService $commissionService): bool
    {
        //
    }
}
