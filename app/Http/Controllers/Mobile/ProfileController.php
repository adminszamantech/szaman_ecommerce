<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{

    public function password_update(Request $request){
        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['success' => 'Password has been updated!'], 200);
    }

    public function address_update(Request $request){
        $user = User::find($request->user_id);
        $user->address_line_one = $request->address_line_one;
        $user->post_office = $request->post_office;
        $user->thana = $request->thana;
        $user->postal_code = $request->postal_code;
        $user->district = $request->district;
        $user->save();
        return response()->json(['success' => 'Address has been updated!'], 200);
    }

}
