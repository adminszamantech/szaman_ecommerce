<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MyAccountController extends Controller
{

    public function my_account_page(){
        if (auth('web')->check()){
            $orders = Order::where('user_id', auth('web')->user()->id)->orderBy('id', 'asc')->get();
            return view('frontend.my-account.dashboard', compact('orders'));
        }else{
            return redirect()->route('user_login_page')->with('error','!Please Login First');
        }
    }

    public function view_address(){
        $address = User::where('id', auth('web')->user()->id)->select('address_line_one', 'post_office', 'thana', 'postal_code', 'district')->first();
        return view('frontend.my-account.address', compact('address'));
    }

    public function view_profile(){
        if (auth('web')->check()){
            $user = User::find(auth()->id());
            return view('frontend.my-account.profile',compact('user'));
        }else{
            return redirect()->route('user_login_page')->with('error','!Please Login First');
        }
    }

    public function edit_profile(){
        if (auth('web')->check()){
            $profile = User::find(auth('web')->user()->id);
            return view('frontend.my-account.edit-profile', compact('profile'));
        }else{
            return redirect()->route('user_login_page')->with('error','!Please Login First');
        }
    }

    public function change_password(){
        if (auth('web')->check()){
            return view('frontend.my-account.change-password');
        }else{
            return redirect()->route('user_login_page')->with('error','!Please Login First');
        }
    }

    public function update_edit_profile(Request $request, $user_id){
        $validated = $request->validate([
            'phone' => 'required|unique:users,phone,'.$user_id,
            'email' => 'required|unique:users,email,'.$user_id,
        ]);



        if ($request->file('image')){
            $file = $request->file('image');
            $image = 'profile'.'-'.rand(999999,100000).'.'.$file->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }

            $imgResize = Image::make($request->image)->resize('300', '300')->stream();
            Storage::disk('public')->put('profile/'.$image,$imgResize);
        }

        $user = User::find($user_id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->image = $image ?? null;
        $user->save();
        return redirect()->back()->with('success','Profile Updated Successfully');
    }

    public function update_password(Request $request, $user_id){
        $validated = $request->validate([
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        $user = User::find($user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success','Password Updated Successfully');
    }

    public function update_address(Request $request){
        $address = User::find(auth('web')->user()->id);
        $address->address_line_one = $request->address_line_one;
        $address->post_office = $request->post_office;
        $address->thana = $request->thana;
        $address->postal_code = $request->postal_code;
        $address->district = $request->district;
        $address->save();
        return redirect()->back()->with('success','Address Updated Successfully');
    }

    public function order_detail($order_number){
        $order_detail = Order::with('order_detail', 'shipping_address')->where('order_number', $order_number)->where('user_id', auth('web')->user()->id)->first();
        return view('frontend.my-account.order-detail', compact('order_detail'));
    }

}
