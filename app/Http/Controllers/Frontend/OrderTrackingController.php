<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderTrackingController extends Controller
{
    public function order_tracking_page(){
        return view('frontend.order_tracking_page');
    }

    public function get_track_order_by_id(Request $request){

        $order = Order::with('shipping_address')->where(['order_number'=> $request->order_id, 'user_id'=>auth()->id()])->first();
        if ($order){
            return response()->json(['success' => $order], 200);
        }else{

            return response()->json(['error' => 'Order track not found!']);
        }
    }

}
