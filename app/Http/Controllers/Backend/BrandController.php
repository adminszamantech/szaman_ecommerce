<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{

    public function index(){
        return view('backend.brand.index');
    }

    public function get_brand_data(){
        $data = Brand::all();

        return Datatables::of($data)
            ->addColumn('image', function ($row){
                if ($row->image !== null){
                    return '<img src="'.asset('storage/brand/'.$row->image).'"  width="50">';
                }else{
                    return '<img src="https://placehold.co/40x40"  width="50">';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('backend.brand.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="#" data-confirm-delete="true" onclick="delete_alert('.$row->id.')" class="btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })->rawColumns(['image','action'])->addIndexColumn()->toJson();
    }


    public function edit($id){
        $brand = Brand::find($id);
        return view('backend.brand.edit', compact('brand'));
    }


    public function brand_store(Request $request){
        $validate = $request->validate([
            'name' => 'required|string'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;

        // If image request
        if ($request->file('image')){
            $file = $request->file('image');
            $image = Str::of(Str::lower($request->name))->slug('-').'-'.time().'.'.$file->getClientOriginalExtension();

            // check post directory slider is exists
            if(!Storage::disk('public')->exists('brand')){
                Storage::disk('public')->makeDirectory('brand');
            }

//            $imgResize = Image::make($request->image)->resize('300', '300')->stream();
            $imgResize = Image::make($request->image)->stream();
            Storage::disk('public')->put('brand/'.$image,$imgResize);

            $brand->image = $image;
        }

        $brand->save();

        toastr()->success('Data inserted successfully!', 'Success');

        return redirect()->back();

    }

    public function update_brand(Request $request, $id){
        // Validation
        $validate = $request->validate([
            'name' => 'required|string'
        ]);

        $brand = Brand::find($id);
        $brand->name = $request->name;
        // If image request
        if ($request->file('image')){
            $file = $request->file('image');
            $image = Str::of(Str::lower($request->name))->slug('-').'-'.time().'.'.$file->getClientOriginalExtension();

            // Check if category directory exists
            if(!Storage::disk('public')->exists('brand')){
                Storage::disk('public')->makeDirectory('brand');
            }

            // Remove existing image
            if ($brand->image !== null) {
                if (Storage::disk('public')->exists('brand/' . $brand->image)) {
                    Storage::disk('public')->delete('brand/' . $brand->image);
                }
            }

//            $imgResize = Image::make($request->image)->resize('300', '300')->stream();
            $imgResize = Image::make($request->image)->stream();
            Storage::disk('public')->put('brand/'.$image,$imgResize);

            $brand->image = $image;
        }

        $brand->save();

        toastr()->success('Data updated successfully!','Success');

        return redirect()->route('backend.brand.index');

    }

    public function destroy($id){

        $brand = Brand::find($id);
        // Remove existing image
        if ($brand->image !== null) {
            if (Storage::disk('public')->exists('brand/' . $brand->image)) {
                Storage::disk('public')->delete('brand/' . $brand->image);
            }
        }

        $brand->delete();

        toastr()->success('Data deleted successfully!', 'Success');

        return redirect()->back();

    }

}
