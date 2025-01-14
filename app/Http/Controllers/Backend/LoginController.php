<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function login_form(){
        if (Auth::guard('admin')->check()){
            return redirect()->route('backend.dashboard');
        }
        return view('backend.auth.login');
    }

    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        if ( $auth_user = Auth::guard('admin')->attempt($credentials) ) {
            toastr()->success('Success', 'You are logged in successfully!');
            return redirect()->route('backend.dashboard');
        }else{
            toastr()->error('Invalid username or password!','error');
            return redirect()->back();
        }
    }

}
