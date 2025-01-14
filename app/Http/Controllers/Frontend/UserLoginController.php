<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{

    public function login(Request $request){
        if ($request->isMethod('post')) {
            $user = User::where('email', $request->email)->orWhere('phone', $request->email)->first();
            if($user){
                if ($user && Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    return redirect()->route('frontend.myaccount.page')->with('success', "Login Successfully");
                } else {
                    return redirect()->route('login')->with('error', "Credentials Invalid Try Again");
                }
            }else{
                $credential = [
                    'name' => ucfirst(Str::before($request->email, '@')),
                    'email' => $request->email,
                    'password' => $request->password,
                ];
                $user = User::create($credential);
                if($user){
                    if ($user && Hash::check($request->password, $user->password)) {
                        Auth::login($user);
                        return redirect()->route('frontend.myaccount.page')->with('success', "Login Successfully");
                    } else {
                        return redirect()->route('login')->with('error', "Credentials Invalid Try Again");
                    }
                }else{
                    return redirect()->route('login')->with('error', "Credentials Invalid Try Again");
                }
            }
        }
        return view('frontend.auth.login');
    }
    public function customer_logout(){
        Auth::guard('web')->logout();
        return redirect()->route('frontend.home_page')->with('success', 'Logout Successfully');
    }
    public function update_customer_address(Request $request){
        $user = User::find(Auth::guard('web')->user()->id);
        $user->address_line_one = $request->address_line_one;
        $user->post_office = $request->post_office;
        $user->thana = $request->thana;
        $user->postal_code = $request->postal_code;
        $user->district = $request->district;
        $user->save();
        return response()->json(['success' => 'Address updated!'], 200);
    }
    public function get_customer_address(){
        $user = User::where('id', Auth::guard('web')->user()->id)->select('phone','address_line_one', 'post_office', 'thana', 'postal_code', 'district')->first();
        return response()->json($user, 200);
    }
}
