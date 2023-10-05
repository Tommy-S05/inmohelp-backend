<?php

namespace App\Policies;

use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PropertyTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['Super Admin']) || $user->hasPermissionTo('view_any:PropertyType', 'web');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PropertyType $propertyType): bool
    {
        return $user->hasRole(['Super Admin']) || $user->hasPermissionTo('view:PropertyType', 'web');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['Super Admin']) || $user->hasPermissionTo('create:PropertyType', 'web');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PropertyType $propertyType): bool
    {
        return $user->hasRole(['Super Admin']) || $user->hasPermissionTo('update:PropertyType', 'web');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PropertyType $propertyType): bool
    {
        return $user->hasRole(['Super Admin']) || $user->hasPermissionTo('delete:PropertyType', 'web');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PropertyType $propertyType): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PropertyType $propertyType): bool
    {
        //
    }
}
