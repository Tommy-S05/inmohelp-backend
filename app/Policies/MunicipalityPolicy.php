<?php

namespace App\Policies;

use App\Models\Municipality;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MunicipalityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['ver_todos:Municipios'], 'web');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Municipality $municipality): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['mostrar:Municipios'], 'web');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['crear:Municipios'], 'web');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Municipality $municipality): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['actualizar:Municipios'], 'web');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Municipality $municipality): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['eliminar:Municipios'], 'web');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Municipality $municipality): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Municipality $municipality): bool
    {
        //
    }
}
