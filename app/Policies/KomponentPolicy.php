<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Komponent;
use App\Enums\Auth\PermissionType;
use Illuminate\Auth\Access\Response;

class KomponentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::KOMPONENT_ACCESS->value);
        
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Komponent $komponent): bool
    {
        return $user->can(PermissionType::KOMPONENT_ACCESS->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionType::KOMPONENT_MANAGE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Komponent $komponent): bool
    {
        return $user->can(PermissionType::KOMPONENT_MANAGE->value);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Komponent $komponent): bool
    {
        return $user->can(PermissionType::KOMPONENT_MANAGE->value);

    }
    

    /**
     * Determine whether the user can restore the model.
     
    *public function restore(User $user, Component $component): bool
    *{
    *    //
    *}
    */
    /**
     * Determine whether the user can permanently delete the model.
   
    *public function forceDelete(User $user, Component $component): bool
    *{
    *    //
    *}
    */
}
