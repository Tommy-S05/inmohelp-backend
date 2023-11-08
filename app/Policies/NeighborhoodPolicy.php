<?php

namespace App\Policies;

use App\Models\Neighborhood;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NeighborhoodPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['ver_todos:Sectores'], 'web');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Neighborhood $neighborhood): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['mostrar:Sectores'], 'web');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['crear:Sectores'], 'web');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Neighborhood $neighborhood): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['actualizar:Sectores'], 'web');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Neighborhood $neighborhood): bool
    {
        return $user->hasAnyRole(['Super Admin', 'web']) || $user->hasAnyPermission(['eliminar:Sectores'], 'web');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Neighborhood $neighborhood): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Neighborhood $neighborhood): bool
    {
        //
    }
}
