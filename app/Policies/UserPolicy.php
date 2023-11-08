<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin'], 'web') || $user->hasAnyPermission(['ver_todos:Usuarios'], 'web');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasAnyRole(['Super Admin'], 'web') || $user->hasAnyPermission(['mostrar:Usuarios'], 'web');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin'], 'web') || $user->hasAnyPermission(['crear:Usuarios'], 'web');
        //        return $user->hasRole(['super_admin']) || $user->hasPermissionTo('create:User', 'web');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasAnyRole(['Super Admin'], 'web') || $user->hasAnyPermission(['actualizar:Usuarios'], 'web');
        //        return $user->hasRole(['super_admin']) || $user->hasPermissionTo('update:User', 'web');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasAnyRole(['Super Admin'], 'web') || $user->hasAnyPermission(['eliminar:Usuarios'], 'web');
        //        return $user->hasRole(['super_admin']) || $user->hasPermissionTo('delete:User', 'web');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
