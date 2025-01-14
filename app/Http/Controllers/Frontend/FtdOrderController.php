<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\ShippingAddress;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;


class FtdOrderController extends Controller
{

    public function cod_order_now(Request $request){

        //============ Order ========================//
        $order = new Order();
        $order->user_id = Auth::guard('web')->user()->id;
        $order->tnx_id = str()->random(20);;
        $numberWithoutComma = str_replace(",", "", Cart::instance('shopping')->subtotal());
        $floatNumber = floatval($numberWithoutComma);
        $integerNumber = intval($floatNumber);

        $order->payable_amount = $integerNumber+Cart::instance('shipping')->content()->where('id', 'shipping')->first()->price;
        $order->shipping_charge = Cart::instance('shipping')->content()->where('id', 'shipping')->first()->price;
        $order->payment_method = 2; //1=Online, 2=Cash On Delivery

        $order->payment_date = date('Y-m-d');
        $order->order_date = date('Y-m-d');
        $order->payment_status = 0;
        $order->save();
        //============ Order ==========================//

        //=============== Order Detail ================//
        $carts = Cart::instance('shopping')->content();

        foreach ($carts as $cart){
            $order_details = new OrderDetail;
            $order_details->order_id = $order->id;
            $order_details->product_name = $cart->name;
            $order_details->qty = $cart->qty;
            $order_details->price = $cart->price;
            $order_details->subtotal = $cart->subtotal;
            $order_details->image = $cart->options->image;
            $order_details->save();
        }
        //=============== Order Detail ================//

        //=============== Shipping Address ===============//
        $user = User::find(Auth::guard('web')->user()->id);
        $shipping_address = new ShippingAddress();
        $shipping_address->user_id = $user->id;
        $shipping_address->order_id = $order->id;
        $shipping_address->phone = $user->phone;
        $shipping_address->address_line_one = $user->address_line_one;
        $shipping_address->post_office = $user->post_office;
        $shipping_address->thana = $user->thana;
        $shipping_address->postal_code = $user->postal_code;
        $shipping_address->district = $user->district;
        $shipping_address->phone = $user->phone;
        $done = $shipping_address->save();
        //=============== Shipping Address ===============//
        Cart::instance('shopping')->destroy();
        Cart::instance('shipping')->destroy();
        return response()->json(['success' => 'Order has been placed!'], 200);
    }

}
