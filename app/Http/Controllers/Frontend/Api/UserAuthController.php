<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{

    public function __construct(){
        return $this->middleware('auth:api')->except('login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (! $token = Auth::guard('api')->attempt([$fieldType => $credentials['login'], 'password' => $credentials['password']])) {
            return response()->json(['error' => 'Credentials is invalid!'], 401);
        }
        return $this->respond_with_token($token);
    }


    public function respond_with_token($token){
        $user = Auth::guard('api')->user();
        return response()->json([
            'user_id' => $user->id,
            'email' => $user->email,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60  // 60 min
        ],200);
    }

}
