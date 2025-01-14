<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
class CustomerController extends Controller
{
    public function customer_index(){
        return view('backend.customer.index');
    }

    public function customer_edit($id){
        $customer = User::find($id);
        return view('backend.customer.edit', compact('customer'));
    }

    public function customer_update(Request $request, $id){
        $validate = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
        ]);
        $customer = User::find($id);
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->phone = $request->phone;
        $customer->email  = $request->email;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->save();
        toastr()->success('Customer updated!', 'Success!');
        return redirect()->route('backend.customer.index');
    }

    public function get_customer_data(){
        $data = User::orderBy('id', 'ASC')->get();

        return Datatables::of($data)
            ->addColumn('name', function ($row){
                return $row->first_name.' '.$row->last_name;
            })->addColumn('address', function ($row){
                if ($row->address !== null){
                    return $row->address;
                }else{
                    return '-';
                }
            })->addColumn('status', function ($row){
                if ($row->status === 1){
                    return '<span class="badge badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })->addColumn('action', function($row){
                if ($row->status === 1){
                    $actionBtn = '<a href="'.route('backend.customer.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.route('backend.customer.status', $row->id).'" class="btn btn-danger btn-sm">Inactive</a>';
                }else{
                    $actionBtn = '<a href="'.route('backend.customer.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.route('backend.customer.status', $row->id).'" class="btn btn-primary btn-sm">Active</a>';
                }

                return $actionBtn;
            })->rawColumns(['name', 'address', 'status','action'])->addIndexColumn()->toJson();
    }

    public function active_inactive($id){
        $user = User::find($id);
        if ($user->status === 1){
            $user->status = 0;
        }else {
            $user->status = 1;
        }
        $user->save();
        toastr()->success('Customer status updated!', 'Success!');
        return redirect()->back();
    }

}
