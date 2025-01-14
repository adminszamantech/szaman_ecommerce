<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryController extends Controller
{
    public function index(){
        $categories = Category::select('id', 'name')->get();
        return view('backend.subcategory.index', compact('categories'));
    }

    public function get_subcategory_data(){
        $data = Subcategory::with('category')->orderByDesc('id')->get();

        return Datatables::of($data)
            ->addColumn('category', function ($row){
                return $row->category->name;
            })
            ->addColumn('image', function ($row){
                if ($row->image !== null){
                    return '<img src="'.asset('storage/subcategory/'.$row->image).'"  width="50">';
                }else{
                    return '<img src="https://placehold.co/40x40"  width="50">';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('backend.subcategory.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="#" data-confirm-delete="true" onclick="delete_alert('.$row->id.')" class="btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })->rawColumns(['category', 'image','action'])->addIndexColumn()->toJson();
    }


    public function edit($id){
        $categories = Category::select('id', 'name')->get();
        $subcategory = Subcategory::find($id);
        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
    }


    public function subcategory_store(Request $request){
        $validate = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required'
        ]);

        $subcategory = new Subcategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;

        // If image request
        if ($request->file('image')){
            $file = $request->file('image');
            $image = Str::of(Str::lower($request->name))->slug('-').'-'.time().'.'.$file->getClientOriginalExtension();

            // check post directory slider is exists
            if(!Storage::disk('public')->exists('subcategory')){
                Storage::disk('public')->makeDirectory('subcategory');
            }

            $imgResize = Image::make($request->image)->resize('300', '300')->stream();
            Storage::disk('public')->put('subcategory/'.$image,$imgResize);

            $subcategory->image = $image;
        }

        $subcategory->save();

        toastr()->success('Data inserted successfully!','Success');

        return redirect()->back();

    }

    public function update_subcategory(Request $request, $id){
        $validate = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required'
        ]);

        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->name;
        // If image request
        if ($request->file('image')){
            $file = $request->file('image');
            $image = Str::of(Str::lower($request->name))->slug('-').'-'.time().'.'.$file->getClientOriginalExtension();

            // Check if category directory exists
            if(!Storage::disk('public')->exists('subcategory')){
                Storage::disk('public')->makeDirectory('subcategory');
            }

            // Remove existing image
            if ($subcategory->image !== null) {
                if (Storage::disk('public')->exists('subcategory/' . $subcategory->image)) {
                    Storage::disk('public')->delete('subcategory/' . $subcategory->image);
                }
            }

            $imgResize = Image::make($request->image)->resize('300', '300')->stream();
            Storage::disk('public')->put('subcategory/'.$image,$imgResize);

            $subcategory->image = $image;
        }

        $subcategory->save();

        toastr()->success('Data updated successfully!', 'Success');

        return redirect()->route('backend.subcategory.index');

    }

    public function destroy($id){

        $subcategory = Subcategory::find($id);
        // Remove existing image
        if ($subcategory->image !== null) {
            if (Storage::disk('public')->exists('subcategory/' . $subcategory->image)) {
                Storage::disk('public')->delete('subcategory/' . $subcategory->image);
            }
        }

        $subcategory->delete();

        toastr()->success('Data deleted successfully!', 'Success');

        return redirect()->back();

    }

}
