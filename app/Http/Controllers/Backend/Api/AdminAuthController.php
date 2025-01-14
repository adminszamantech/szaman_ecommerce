<?php

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function __construct(){
        return $this->middleware('auth:admin')->except('login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Credentials is invalid!'], 200);
        }
        return response()->json([
            'success' => 'You are logged in success',
            'data' => $this->respond_with_token($token)
        ],200);
    }


    public function respond_with_token($token){
        $admin = Auth::guard('admin')->user();
        return response()->json([
            'user_id' => $admin->id,
            'email' => $admin->email,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60  // 60 min
        ],200);
    }




}
