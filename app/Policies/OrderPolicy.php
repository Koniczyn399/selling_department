<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use App\Enums\Auth\PermissionType;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::ORDER_ACCESS->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->can(PermissionType::ORDER_ACCESS->value);
    }

    public function show(User $user, Order $order): bool
    {
        return $user->can(PermissionType::ORDER_DETAIL_ACCESS->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionType::ORDER_MANAGE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->can(PermissionType::ORDER_MANAGE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): bool
    {
        return $user->can(PermissionType::ORDER_MANAGE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */

}
