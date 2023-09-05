<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => 'Error al logear el usuario usuario',
                'errors' => $validator->errors()
            ], 422);
        }

        if(Auth::attempt($request->only('email', 'password'))) {
            //            $permissionName = array();
            //            $request->session()->regenerate();
            $user = User::where('email', '=', $request['email'])->firstOrFail();
            //            //                $token = $user->createToken('auth_token')->plainTextToken;
            //            $permissions = $user->getAllPermissions();
            //            foreach($permissions as $permission) {
            //                $permissionName[] = $permission->name;
            //            }
            $user->tokens()->delete();
            //            $token = $user->createToken('auth_token', $permissionName)->plainTextToken;
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'result' => true,
                'message' => 'Sesión Iniciada',
                'token' => $token,
                'token_type' => 'Bearer',
                'data' => $user,
            ], 200);
        }

        return response()->json([
            'result' => false,
            'massage' => 'Usuario no autorizado',
            'data' => ''
        ], 401);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        //        Auth::logout();
        //        $request->session()->invalidate();
        //        $request->session()->regenerateToken();

        return response()->json([
            'result' => true,
            'message' => 'Sesión cerrada',
            'data' => ''
        ]);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);
        if($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => 'Error al registrar usuario',
                'errors' => $validator->errors()
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //        Auth::login($user);

        $account = $user->account()->create([
            'total_incomes' => 0,
            'total_expenses' => 0,
            'budget' => 0,
        ]);

        $subCategories = SubCategory::all();

        foreach($subCategories as $subCategory) {
            $results[] = array(
                "sub_category_id" => $subCategory->id,
                "amount" => 0,
            );
        }

        $account->accountTransactions()->createMany($results);
        Setting::create([
            'user_id' => $user->id,
            'interest_rate' => 12,
            'down_payment_available' => 0,
            'loan_term' => 20
        ]);

        //        $request->session()->regenerate();

        //        $token = $user->createToken('auth_token', ['products.index'])->plainTextToken;
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'result' => true,
            'message' => 'Usuario Regstrado',
            'token' => $token,
            'token_type' => 'Bearer',
            'data' => $user,
        ]);
    }
}
