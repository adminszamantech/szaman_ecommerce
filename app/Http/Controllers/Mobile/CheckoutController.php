<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CheckoutController extends Controller
{

    public function get_customer_address($user_id){
        $user = User::where('id', $user_id)->select('address_line_one', 'post_office', 'thana', 'postal_code', 'district')->first();
        return response()->json($user, 200);
    }

    public function update_customer_address(Request $request, $user_id){
        $user = User::find($user_id);
        $user->address_line_one = $request->address_line_one;
        $user->post_office = $request->post_office;
        $user->thana = $request->thana;
        $user->postal_code = $request->postal_code;
        $user->district = $request->district;
        $user->save();
        return response()->json(['success' => 'Address updated!'], 200);
    }

    public function get_customer_detail($user_id){
        $customer = User::find($user_id);
        return response()->json($customer, 200);
    }

}
