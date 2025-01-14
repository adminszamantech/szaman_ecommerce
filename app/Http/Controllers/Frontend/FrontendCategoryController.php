<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class FrontendCategoryController extends Controller
{
    public function category_page($slug){
        $category_products = Category::with('product')->where('slug', $slug)->first();
        if ($category_products){
            return view('frontend.category-page', compact('category_products'));
        }else{
            return redirect()->route('frontend.home_page')->with('error','Page doesn\'t exist!');
        }
    }

    public function sub_category_page($category_slug, $subcat_slug){

        $subcategory_products = Subcategory::with('product', 'category')->where('slug', $subcat_slug)->first();

        if ($subcategory_products){
            return view('frontend.subcategory-page', compact('subcategory_products'));
        }else{
            return redirect()->route('frontend.home_page')->with('error','Page doesn\'t exist!');
        }


    }

    public function brand_product_page($brand_id){
        $brand_products = Brand::with('product')->where('id', $brand_id)->first();
        if ($brand_products){
            return view('frontend.brand-page', compact('brand_products'));
        }else{
            return redirect()->route('frontend.home_page')->with('error','Page doesn\'t exist!');
        }
    }

}
