<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index(){
        return view('backend.category.index');
    }

    public function get_category_data(){
        $data = Category::all();

        return Datatables::of($data)
            ->addColumn('image', function ($row){
                if ($row->image !== null){
                    return '<img src="'.asset('storage/category/'.$row->image).'"  width="50">';
                }else{
                    return '<img src="https://placehold.co/40x40"  width="50">';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('backend.category.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="#" data-confirm-delete="true" onclick="delete_alert('.$row->id.')" class="btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })->rawColumns(['image','action'])->addIndexColumn()->toJson();
    }


    public function edit($id){
        $category = Category::find($id);
        return view('backend.category.edit', compact('category'));
    }


    public function category_store(Request $request){
        $validate = $request->validate([
            'name' => 'required|string'
        ]);

        $category = new Category();
        $category->name = $request->name;

        // If image request
        if ($request->file('image')){
            $file = $request->file('image');
            $image = Str::of(Str::lower($request->name))->slug('-').'-'.time().'.'.$file->getClientOriginalExtension();

            // check post directory slider is exists
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            $imgResize = Image::make($request->image)->resize('300', '300')->stream();
            Storage::disk('public')->put('category/'.$image,$imgResize);

            $category->image = $image;
        }

        $category->save();

        toastr()->success( 'Data inserted successfully!', 'Success');

        return redirect()->back();

    }

    public function update_category(Request $request, $id){
        // Validation
        $validate = $request->validate([
            'name' => 'required|string'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        // If image request
        if ($request->file('image')){
            $file = $request->file('image');
            $image = Str::of(Str::lower($request->name))->slug('-').'-'.time().'.'.$file->getClientOriginalExtension();

            // Check if category directory exists
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            // Remove existing image
            if ($category->image !== null) {
                if (Storage::disk('public')->exists('category/' . $category->image)) {
                    Storage::disk('public')->delete('category/' . $category->image);
                }
            }

            $imgResize = Image::make($request->image)->resize('300', '300')->stream();
            Storage::disk('public')->put('category/'.$image,$imgResize);

            $category->image = $image;
        }

        $category->save();

        toastr()->success('Data updated successfully!', 'Success');

        return redirect()->route('backend.category.index');

    }

    public function destroy($id){

        $category = Category::find($id);
        // Remove existing image
        if ($category->image !== null) {
            if (Storage::disk('public')->exists('category/' . $category->image)) {
                Storage::disk('public')->delete('category/' . $category->image);
            }
        }

        $category->delete();

        toastr()->success('Data deleted successfully!','Success');

        return redirect()->back();

    }



}
