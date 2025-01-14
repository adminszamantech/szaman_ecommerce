<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{

    public function attribute_view(){
        return view('backend.attribute.index');
    }

    public function attribute_data(){
        $data = Attribute::all();

        return Datatables::of($data)
            ->addColumn('attribute', function ($row){
                $array = explode(',', $row->attributes);
                $badges = '';
                $color = [
                    'danger',
                    'info',
                    'primary',
                    'success',
                    'secondary ',
                ];
                foreach ($array as $key => $attribute){
                    $badges .= '<span class="badge badge-'.$color[$key % count($color)].'">'.$attribute.'</span>&nbsp;';
                }
                return $badges;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('backend.attribute.edit', $row->id).'" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onclick="delete_alert('.$row->id.')" class="btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })->rawColumns(['attribute','action'])->addIndexColumn()->toJson();
    }

    public function attribute_store(Request $request){

        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->attributes = $request->attribute;
        $attribute->save();
        toastr()->success('Data stored successfully!');
        return redirect()->route('backend.attribute.index');

    }

    public function attribute_edit($id){
        $attribute = Attribute::find($id);
        return view('backend.attribute.edit', compact('attribute'));
    }

    public function attribute_update(Request $request, $id){
        $attribute = Attribute::find($id);
        $attribute->name = $request->name;
        $attribute->attributes = $request->attribute;
        $attribute->save();
        toastr()->success('Data updated successfully!', 'Success');
        return redirect()->back();
    }

    public function destroy($id){

        $attribute = Attribute::find($id);
        $attribute->delete();
        toastr()->success('Data deleted successfully!', 'Success');
        return redirect()->back();
    }


}
