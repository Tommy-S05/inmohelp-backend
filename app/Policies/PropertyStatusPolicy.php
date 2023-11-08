<?php

namespace App\Policies;

use App\Models\PropertyStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PropertyStatusPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['ver_todos:Estados de propiedad'], 'web');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PropertyStatus $propertyStatus): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['mostrar:Estados de propiedad'], 'web');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['crear:Estados de propiedad'], 'web');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PropertyStatus $propertyStatus): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['actualizar:Estados de propiedad'], 'web');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PropertyStatus $propertyStatus): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['eliminar:Estados de propiedad'], 'web');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PropertyStatus $propertyStatus): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PropertyStatus $propertyStatus): bool
    {
        //
    }
}
