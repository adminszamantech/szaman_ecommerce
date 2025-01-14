<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function change_password_view(){
        return view('backend.profile.change_password');
    }

    public function update_change_password(Request $request){
        $validate = $request->validate([
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6',
        ]);

        $admin = Admin::find(Auth::guard('admin')->user()->id);

        if ($request->password === $request->password_confirmation){
            if (Hash::check($request->old_password, $admin->password)){
                $admin->password = Hash::make($request->password);
                $admin->save();
                toastr()->success('Password updated successfully!', 'Success!');
                return redirect()->back();
            }else{
                toastr()->error('Incorrect old password!', 'Error');
                return redirect()->back();
            }
        }else{
            toastr()->error('Confirm password not match!', 'Error');
            return redirect()->back();
        }

    }

    public function edit_profile_view(){
        $user = Auth::guard('admin')->user();
        return view('backend.profile.edit_profile', compact('user'));
    }

    public function update_edit_profile_view(Request $request){

        $validate = $request->validate([
            'name' => 'required|string'
        ]);
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $admin->name = $request->name;
        $admin->save();
        toastr()->success('Profile updated successfully!', 'Success');
        return redirect()->back();
    }

    public function admin_logout(){
        Auth::guard('admin')->logout();
        toastr()->success('You have logged out successfully!', 'Success');
        return redirect()->route('admin.form');
    }


}
