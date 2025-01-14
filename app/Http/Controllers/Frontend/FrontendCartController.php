<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;

class FrontendCartController extends Controller
{
    public function cart_view(){
        return view('frontend.cart');
    }

    public function checkout_view(){
        if (auth('web')->check()){
            if (Cart::instance('shopping')->content()->count() > 0){
                $shipping_charge = ShippingCharge::all();
                $customer = User::find(auth('web')->user()->id);
                return view('frontend.checkout', compact('shipping_charge', 'customer'));
            }else {
                return redirect()->route('frontend.home_page');
            }
        }else{
            return redirect()->route('user_login_page')->with('error','Please login first!');
        }


    }
}
