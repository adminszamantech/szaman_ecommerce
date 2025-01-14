<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{

    public function get_order_data(){
        $data = Order::all();

        return Datatables::of($data)
            ->addColumn('payment_status', function($row){
                if($row->payment_status == 1){
                    return "<span class='badge badge-info'>Paid</span>";
                }else{
                    return "<span class='badge badge-warning'>Unpaid</span>";
                }
            })->addColumn('payment_method', function($row){
                if($row->payment_method == 1){
                    return "<span>Online</span>";
                }else{
                    return "<span>Cash On Delivery</span>";
                }
            })->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('backend.order.single.view', $row->id).'" class="btn btn-info btn-sm">View Order</a> <a href="#" data-confirm-delete="true" onclick="delete_alert('.$row->id.')" class="btn btn-danger btn-sm">Status</a>';
                return $actionBtn;
            })->rawColumns(['payment_method', 'payment_status','action'])->addIndexColumn()->toJson();
    }

    public function index(){
        return view('backend.order.index');
    }

    public function view_single_order($id){
        $order = Order::with('order_detail', 'shipping_address')->where('id', $id)->first();
        $user = User::find($order->user_id);
        return view('backend.order.order-view', compact('order', 'user'));
    }

}
