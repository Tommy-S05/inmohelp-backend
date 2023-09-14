<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    //get user roles
    public function userRoles(User $user)
    {
        /*Obtener todos los permisos directos e indirectos del usuario*/
//        $roles = $user->getAllPermissions();
        /*Dice si un usuario tiene un permiso en especifico*/
//        $roles = $user->hasPermissionTo('create:User', 'web');
        /*Obtener cuantos usuarios tienen un role en especifico*/
//        $superAdminCount = User::with('roles')->get()->filter(
//            fn($user) => $user->roles->where('name', 'super_admin')->toArray()
//        )->count();
        $permission = Permission::where('name', 'view:User')->first();
        $userCount = User::whereHas('roles.permissions', function ($query) use ($permission) {
            $query->where('permissions.id', $permission->id);
        })->orWhereHas('permissions', function ($query) use ($permission) {
            $query->where('permissions.id', $permission->id);
        })->distinct()->count();
        return response()->json($userCount);
    }

    public function userAuth(Request $request)
    {
        //        $data = $request->user();
        //        //        $data = auth()->user();
        //        return response()->json([
        //            'success' => true,
        //            'message' => 'User Authenticated',
        //            'data' => $data
        //        ]);
        return UserResource::make(auth()->user());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
