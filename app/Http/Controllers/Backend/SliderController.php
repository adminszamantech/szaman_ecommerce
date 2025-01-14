<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.slider.index', compact('sliders'));
    }

    public function get_slider_data(){
        $data = Slider::all();

        return Datatables::of($data)
            ->addColumn('image', function ($row){
                if ($row->image !== null){
                    return '<img src="'.asset('storage/slider/'.$row->image).'"  width="50">';
                }else{
                    return '<img src="https://placehold.co/40x40"  width="50">';
                }
            })
            ->addColumn('status', function ($row){
                if ($row->status === 1){
                    return '<span class="badge badge-info">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('backend.slider.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="#" data-confirm-delete="true" onclick="delete_alert('.$row->id.')" class="btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })->rawColumns(['image','status', 'action'])->addIndexColumn()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string',
            'status' => 'required',
            'image' => 'required|dimensions:min_width=1921,min_height=581'
        ]);
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->product_link = $request->product_link;

        // If image request
        if ($request->file('image')){
            $file = $request->file('image');
            $image = 'slider'.'-'.rand(999999,100000).'.'.$file->getClientOriginalExtension();

            // check post directory slider is exists
            if(!Storage::disk('public')->exists('slider')){
                Storage::disk('public')->makeDirectory('slider');
            }

            $imgResize = Image::make($request->image)->resize('1921', '581')->stream();
            Storage::disk('public')->put('slider/'.$image,$imgResize);

            $slider->image = $image;
        }
        $slider->status = $request->status;
        $slider->save();

        toastr()->success('Data inserted successfully!', 'Success');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::find($id);
        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|string',
            'status' => 'required',
//            'image' => 'required|dimensions:min_width=1921,min_height=581'
        ]);

        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->product_link = $request->product_link;

        // If image request
        if ($request->file('image')){
            $file = $request->file('image');
            $image = 'slider'.'-'.rand(999999,100000).'.'.$file->getClientOriginalExtension();

            // Check if category directory exists
            if(!Storage::disk('public')->exists('slider')){
                Storage::disk('public')->makeDirectory('slider');
            }

            // Remove existing image
            if ($slider->image !== null) {
                if (Storage::disk('public')->exists('slider/' . $slider->image)) {
                    Storage::disk('public')->delete('slider/' . $slider->image);
                }
            }

            $imgResize = Image::make($request->image)->resize('1921', '581')->stream();
            Storage::disk('public')->put('slider/'.$image,$imgResize);

            $slider->image = $image;
        }
        $slider->status = $request->status;
        $slider->save();

        toastr()->success( 'Data update successfully!', 'Success');

        return redirect()->route('backend.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $slider = Slider::find($id);
        // Remove existing image
        if ($slider->image !== null) {
            if (Storage::disk('public')->exists('slider/' . $slider->image)) {
                Storage::disk('public')->delete('slider/' . $slider->image);
            }
        }

        $slider->delete();

        toastr()->success('Data deleted successfully!', 'Success');

        return redirect()->back();
    }
}
