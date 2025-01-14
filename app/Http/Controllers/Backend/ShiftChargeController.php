<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShiftChargeController extends Controller
{
    public function index(){

        return view('backend.shipping-charge.index');
    }

    public function shipping_charge_store_or_update(Request $request){
        $validate= $request->validate([
            'shipping_charge_name' => 'required',
            'amount' => 'required|numeric'
        ]);


        $shipping_charge = new ShippingCharge();
        $shipping_charge->shipping_charge_name = $request->shipping_charge_name;
        $shipping_charge->amount = $request->amount;
        $shipping_charge->save();

        toastr()->success('Data inserted successfully!', 'Success');
        return redirect()->back();

    }

    public function edit($id){
        $shipping_charge = ShippingCharge::find($id);
        return view('backend.shipping-charge.edit', compact('shipping_charge'));
    }

    public function get_shipping_data(){
        $data = ShippingCharge::all();

        return Datatables::of($data)
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('backend.shipping-charge.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="#" data-confirm-delete="true" onclick="delete_alert('.$row->id.')" class="btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })->rawColumns(['action'])->addIndexColumn()->toJson();
    }

    public function update(Request $request, $id){

        $validate= $request->validate([
            'shipping_charge_name' => 'required',
            'amount' => 'required|numeric'
        ]);

        $shipping_charge = ShippingCharge::find($id);
        $shipping_charge->shipping_charge_name = $request->shipping_charge_name;
        $shipping_charge->amount = $request->amount;
        $shipping_charge->save();

        toastr()->success('Data updated successfully!', 'Success');
        return redirect()->route('backend.shipping-charge.index');

    }


    public function destroy($id){
        $shipping_charge = ShippingCharge::find($id);
        $shipping_charge->delete();
        toastr()->success('Data deleted successfully!', 'Success');
        return redirect()->back();
    }

}
