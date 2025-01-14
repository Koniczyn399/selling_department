<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use App\Enums\Auth\PermissionType;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::CATEGORY_ACCESS->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return $user->can(PermissionType::CATEGORY_ACCESS->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionType::CATEGORY_MANAGE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $category->deleted_at ===null &&
        $user->can(PermissionType::CATEGORY_MANAGE->value);
    }

    /**
     * Determine whether the user can delete the model.
     
     */
    public function delete(User $user, Category $category): bool
    {
        return $category->deleted_at ===null &&
        $user->can(PermissionType::CATEGORY_MANAGE->value);
    }

    /**
     * Determine whether the user can restore the model.
     
    *public function restore(User $user, Category $category): bool
    *{
    *    //
   * }
*/
    /**
     * Determine whether the user can permanently delete the model.
    
    *public function forceDelete(User $user, Category $category): bool
    *{
    *    //
    *}
         */
}
