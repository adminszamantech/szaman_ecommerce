<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\ShippingAddress;

class AppOrderController extends Controller
{
    public function cod_order(Request $request){

        //============ Order ========================//
        $order = new Order();
        $order->user_id = $request->user_id;
//        $order->order_number = IdGenerator::generate(['table' => 'orders', 'field' => 'order_number', 'length' => 8, 'prefix' => 'WC']);
        // Random Transaction ID Generate
        $order->tnx_id = $request->tnx_id;


        $order->payable_amount = $request->payable_amount;
        $order->payment_method = 2; // [1=Online, 2=Cash On Delivery]
        $order->shipping_charge = $request->shipping_charge;

        $order->payment_date = date('Y-m-d');
        $order->order_date = date('Y-m-d');
        $order->payment_status = 0;
        $order->save();
        //============ Order ==========================//

        //=============== Order Detail ================//

        for ($ci = 0; $ci < count($request->carts); $ci++){
            $order_details = new OrderDetail;
            $order_details->order_id = $order->id;
            $order_details->product_name = $request->carts[$ci]['name'];
            $order_details->qty = $request->carts[$ci]['qty'];
//            $order_details->variation = $order->id;
            $order_details->price = $request->carts[$ci]['price'];
            $order_details->subtotal = $request->carts[$ci]['subtotal'];
            $order_details->image = $request->carts[$ci]['image'];
            $order_details->save();
        }

        //=============== Order Detail ================//

        //=============== Shipping Address ===============//
        $user = User::find($request->user_id);
        $shipping_address = new ShippingAddress();
        $shipping_address->user_id = $user->id;
        $shipping_address->order_id = $order->id;
        $shipping_address->address_line_one = $user->address_line_one;
        $shipping_address->post_office = $user->post_office;
        $shipping_address->thana = $user->thana;
        $shipping_address->postal_code = $user->postal_code;
        $shipping_address->district = $user->district;
        $shipping_address->phone = $user->phone;
        $done = $shipping_address->save();
        //=============== Shipping Address ===============//

        return response()->json(['success' => 'Order has been placed!'], 200);

    }


    public function online_payment(Request $request){

        //============ Order ========================//
        $order = new Order();
        $order->user_id = $request->user_id;
//        $order->order_number = IdGenerator::generate(['table' => 'orders', 'field' => 'order_number', 'length' => 8, 'prefix' => 'WC']);
        // Random Transaction ID Generate
        $order->payable_amount = $request->payable_amount;
        $order->payment_method = 1; // [1=Online, 2=Cash On Delivery]
        $order->shipping_charge = $request->shipping_charge;
        $order->tnx_id = $request->tnx_id;
        $order->payment_date = date('Y-m-d');
        $order->order_date = date('Y-m-d');
        $order->payment_status = 0;
        $order->save();
        //============ Order ==========================//

        //=============== Order Detail ================//

        for ($ci = 0; $ci < count($request->carts); $ci++){
            $order_details = new OrderDetail;
            $order_details->order_id = $order->id;
            $order_details->product_name = $request->carts[$ci]['name'];
            $order_details->qty = $request->carts[$ci]['qty'];
//            $order_details->variation = $order->id;
            $order_details->price = $request->carts[$ci]['price'];
            $order_details->subtotal = $request->carts[$ci]['subtotal'];
            $order_details->image = $request->carts[$ci]['image'];
            $order_details->save();
        }

        //=============== Order Detail ================//

        //=============== Shipping Address ===============//
        $user = User::find($request->user_id);
        $shipping_address = new ShippingAddress();
        $shipping_address->user_id = $user->id;
        $shipping_address->order_id = $order->id;
        $shipping_address->address_line_one = $user->address_line_one;
        $shipping_address->post_office = $user->post_office;
        $shipping_address->thana = $user->thana;
        $shipping_address->postal_code = $user->postal_code;
        $shipping_address->district = $user->district;
        $shipping_address->phone = $user->phone;
        $done = $shipping_address->save();
        //=============== Shipping Address ===============//

        return response()->json(['success' => 'Order has been placed!'], 200);

    }

    public function success_payment(Request $request){
        $order = Order::where('tnx_id', $request->tnx_id)->first();
        $order->tnx_id = $request->payment_transaction_id;
//        $order->payment_method = $request->payment_method;
        $order->payment_status = 1;
        $order->order_status = 1;
        $order->save();
        return response()->json(['success' => 'Payment done with order updated'], 200);
    }

    public function fail_or_payment(Request $request){
        $order = Order::where('tnx_id', $request->tnx_id)->first();
//        $order->tnx_id = $request->payment_transaction_id;
//        $order->payment_method = $request->payment_method;
        $order->payment_status = 0; //[0=unpaid]
        $order->save();
        return response()->json(['success' => 'Payment failed with order updated'], 200);
    }

    public function get_order($user_id){
        $order = Order::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        return response()->json($order, 200);
    }

    public function order_detail(Request $request){
        $order_detail = Order::with('order_detail', 'shipping_address')->where('user_id', $request->user_id)->where('order_number', $request->order_number)->first();
        return response()->json($order_detail, 200);
    }

    public function order_cancel(Request $request){
        $order = Order::where('order_number', $request->order_number)->where('user_id', $request->user_id)->first();
        $order->order_status = 6;
        $order->save();
        return response()->json([
            'success' => 'Order is cancelled!'
        ], 200);
    }


}
