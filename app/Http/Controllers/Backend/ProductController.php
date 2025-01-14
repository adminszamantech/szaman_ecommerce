<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.product.index');
    }

    public function product_data(){
        $data = Product::with('category', 'sub_category', 'brand')->get();

        return Datatables::of($data)
            ->addColumn('category', function ($row){
                if ($row->category){
                    return $row->category->name;
                }else{
                    return '-';
                }
            })->addColumn('sub_category', function ($row){
                if ($row->sub_category){
                    return $row->sub_category->name;
                }else{
                    return '-';
                }
            })->addColumn('stock', function ($row){
                if ($row->quantity > '0'){
                    return '<span class="badge badge-success">Available</span>';
                }else{
                    return '<span class="badge badge-danger">Stock Out</span>';
                }
            })->addColumn('brand', function ($row){
                if ($row->brand){
                    return $row->brand->name;
                }else{
                    return '-';
                }
            })->addColumn('feature_image', function ($row){
                if ($row->feature_image !== null){
                    return '<img src="'.asset('storage/product/'.$row->feature_image).'"  width="50">';
                }else{
                    return '<img src="https://placehold.co/40x40"  width="50">';
                }
            })->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('backend.product.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="#" data-confirm-delete="true" onclick="delete_alert('.$row->id.')" class="btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })->rawColumns(['category', 'sub_category', 'brand', 'stock', 'feature_image','action'])->addIndexColumn()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        return view('backend.product.create', compact('categories', 'subcategories', 'brands', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string'
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->unit_price = $request->unit_price;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount;
        $product->discount_price = $request->discount_price;

        if ($request->file('feature_image')){
            $file = $request->file('feature_image');
            $image = 'product'.'-'.rand(999999,100000).'.'.$file->getClientOriginalExtension();

            // check post directory slider is exists
            if(!Storage::disk('public')->exists('product')){
                Storage::disk('public')->makeDirectory('product');
            }

            $imgResize = Image::make($request->feature_image)->resize('300', '300')->stream();
            Storage::disk('public')->put('product/'.$image,$imgResize);

            $product->feature_image = $image;
        }
        $product->best_selling = $request->best_selling;
        $product->feature_product = $request->feature_product;
        $product->hot_deal = $request->hot_deal;
        $product->is_publish = $request->is_publish;
        $product->is_active = $request->is_active;
        $save = $product->save();

        // Gallery Image
        if ($request->file('gallery')){
            if ($save){
                $count = count($request->file('gallery'));

                for ($i = 0; $i < $count; $i++){
                    $file = $request->file('gallery')[$i];
                    $image = 'gallery'.'-'.rand(999999,100000).'.'.$file->getClientOriginalExtension();

                    // check post directory slider is exists
                    if(!Storage::disk('public')->exists('gallery')){
                        Storage::disk('public')->makeDirectory('gallery');
                    }

                    $imgResize = Image::make($request->gallery[$i])->resize('300', '300')->stream();
                    Storage::disk('public')->put('gallery/'.$image,$imgResize);

                    $product->feature_image = $image;

                    $gallery = new Gallery();
                    $gallery->product_id = $product->id;
                    $gallery->image = $image;
                    $gallery->save();

                }
            }
        }

        // Product Variant
        if ($request->variant_name){
            foreach ($request->variant_name as $variant){

                if ($request->$variant){
                    $product_variant = new ProductVariant();
                    $product_variant->product_id = $product->id;
                    $product_variant->variant_name = $variant;

                    // Array to string convert - "value1,value2,value3"
                    $string_value = implode(',', $request->$variant);
                    $product_variant->variant_value = $string_value;
                    $product_variant->save();
                }


            }
        }
        toastr()->success('Product inserted successfully!', 'Success');
        return redirect()->route('backend.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('category', 'sub_category', 'brand', 'gallery', 'variation')->find($id);
        if (!$product){
            toastr()->error('Page not found!', 'Error');
            return redirect()->route('backend.product.index');
        }
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        return view('backend.product.edit', compact('product', 'categories', 'subcategories', 'brands', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|string'
        ]);

        $product = Product::with('gallery')->find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->unit_price = $request->unit_price;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount;
        $product->discount_price = $request->discount_price;

        if ($request->file('feature_image')){
            $file = $request->file('feature_image');
            $image = 'product'.'-'.rand(999999,100000).'.'.$file->getClientOriginalExtension();

            // check post directory slider is exists
            if(!Storage::disk('public')->exists('product')){
                Storage::disk('public')->makeDirectory('product');
            }

            // Remove existing image
            if ($product->feature_image !== null) {
                if (Storage::disk('public')->exists('product/' . $product->feature_image)) {
                    Storage::disk('public')->delete('product/' . $product->feature_image);
                }
            }

            $imgResize = Image::make($request->feature_image)->resize('300', '300')->stream();
            Storage::disk('public')->put('product/'.$image,$imgResize);

            $product->feature_image = $image;
        }
        $product->best_selling = $request->best_selling;
        $product->feature_product = $request->feature_product;
        $product->hot_deal = $request->hot_deal;
        $product->is_publish = $request->is_publish;
        $product->is_active = $request->is_active;
        $save = $product->save();

        // Delete removed gallery images
        if ($request->deleted_gallery) {
            $deletedGalleryIds = explode(',', $request->deleted_gallery);
            foreach ($deletedGalleryIds as $deletedImageId) {
                $gallery = Gallery::findOrFail($deletedImageId);
                if (Storage::disk('public')->exists('gallery/' . $gallery->image)) {
                    Storage::disk('public')->delete('gallery/' . $gallery->image);
                }
                $gallery->delete();
            }
        }

        // New Gallery Request
        if ($request->file('gallery')){
            if ($save){

                $count = count($request->file('gallery'));
                for ($i = 0; $i < $count; $i++){
                    $file = $request->file('gallery')[$i];
                    $image = 'gallery'.'-'.rand(999999,100000).'.'.$file->getClientOriginalExtension();

                    // check post directory slider is exists
                    if(!Storage::disk('public')->exists('gallery')){
                        Storage::disk('public')->makeDirectory('gallery');
                    }

//                    // Remove existing image
//                    if ($product->gallery[$i]->image !== null) {
//                        if (Storage::disk('public')->exists('gallery/' . $product->gallery[$i]->image)) {
//                            Storage::disk('public')->delete('gallery/' . $product->gallery[$i]->image);
//                        }
//                    }

                    $imgResize = Image::make($request->gallery[$i])->resize('300', '300')->stream();
                    Storage::disk('public')->put('gallery/'.$image,$imgResize);

                    $product->feature_image = $image;

                    $gallery = new Gallery();
                    $gallery->product_id = $product->id;
                    $gallery->image = $image;
                    $gallery->save();

                }
            }
        }

        // Product Variant
        if ($request->variant_name){

            // Delete Product Variant
            $exist_variant = ProductVariant::where('product_id', $product->id)->delete();
            foreach ($request->variant_name as $variant){

                if ($request->$variant){
                    $product_variant = new ProductVariant();
                    $product_variant->product_id = $product->id;
                    $product_variant->variant_name = $variant;

                    // Array to string convert - "value1,value2,value3"
                    $string_value = implode(',', $request->$variant);
                    $product_variant->variant_value = $string_value;
                    $product_variant->save();
                }
            }
        }
        toastr()->success('Product updated successfully!', 'Success');
        return redirect()->route('backend.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
