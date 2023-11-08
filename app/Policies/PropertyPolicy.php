<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PropertyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyRole(['Admin', 'web'])) {
            return true;
        } else {
            return $user->hasAnyPermission(['ver_todos:Propiedades'], 'web');
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Property $property): bool
    {
        if($user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyRole(['Admin', 'web'])) {
            return true;
        } else {
            return $user->hasAnyPermission(['mostrar:Propiedades'], 'web') && $user->id === $property->user_id;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyRole(['Admin', 'web'])) {
            return true;
        } else {
            return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['crear:Propiedades'], 'web');
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Property $property): bool
    {
        if($user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyRole(['Admin', 'web'])) {
            return true;
        } else {
            return $user->hasAnyPermission(['actualizar:Propiedades'], 'web') && $user->id === $property->user_id;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Property $property): bool
    {
        if($user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyRole(['Admin', 'web'])) {
            return true;
        } else {
            return $user->hasAnyPermission(['eliminar:Propiedades'], 'web') && $user->id === $property->user_id;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Property $property): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Property $property): bool
    {
        //
    }
}
