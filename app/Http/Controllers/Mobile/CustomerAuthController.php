<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerAuthController extends Controller
{
    public function __construct(){
        return $this->middleware('auth:api')->except('login', 'register');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (! $token = Auth::guard('api')->attempt([$fieldType => $credentials['email'], 'password' => $credentials['password']])) {
            return response()->json(['error' => 'Credentials is invalid!'], 401);
        }
        return $this->respond_with_token($token);
    }


    public function register(Request $request){

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'status' => 1,
        ]);

        // Generate JWT token for the user
        $token = Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password]);

        // Return the token in the response
        return $this->respond_with_token($token);

    }

    public function respond_with_token($token){
        $user = Auth::guard('api')->user();
        return response()->json([
            'user_id' => $user->id,
            'email' => $user->email,
            'status' => $user->status,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60  // 60 min
        ],200);
    }

}
