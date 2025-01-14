<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShippingCharge;
use App\Models\Slider;
use App\Models\Sslcommerze;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeLatestProducts(){

        $products = Product::with('category', 'sub_category', 'brand', 'gallery', 'variation')->where('is_publish', 1)->where('is_active', 1)->orderBy('id', 'DESC')->get();
        return response()->json($products, 200);

    }

    public function product_detail($id){

        $product = Product::with('category', 'sub_category', 'brand', 'gallery', 'variation')->where('id', $id)->where('is_publish', 1)->where('is_active', 1)->first();

        // Fetch related products based on category and partial title match
        $related_products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Exclude the current product
            ->where('is_publish', 1)
            ->where('is_active', 1)
//            ->where('title', 'LIKE', '%' . $product->title . '%') // Partial title match
            ->take(4) // Limit the number of related products (optional)
            ->get();

        return response()->json(['product_detail' => $product, 'related_products' => $related_products], 200);

    }

    public function home_slider(){
        $slider = Slider::where('status', 1)->orderBy('id', 'DESC')->get();
        return response()->json($slider, 200);
    }

    public function get_category(){
        $category = Category::select('name', 'image')->get();
        return response()->json($category, 200);
    }

    public function get_brand(){
        $brand = Brand::select('name', 'image', 'id')->get();
        return response()->json($brand, 200);
    }

    public function brand_products($brand_id){

        $products = Product::where('brand_id', $brand_id)->where('is_publish', 1)->where('is_active', 1)->get();

        return response()->json($products, 200);
    }

    public function shipping_charge(){
        $shipping_charge = ShippingCharge::orderBy('id', 'ASC')->get();
        return response()->json($shipping_charge, 200);
    }


    public function get_sslcredential(){
        $sslcommerz = Sslcommerze::find(1);
        return response()->json($sslcommerz, 200);
    }

    public function get_category_wise_project(){
        $category_wish_products = Category::orderBy('id', 'ASC')->get();

        foreach ($category_wish_products as $category) {
            $category->products = $category->product()->take(8)->get();
        }

        return response()->json($category_wish_products, 200);
    }

    public function category_product_list($category_id){
        $category_product = Category::with('product')->where('id', $category_id)->first();
        return response()->json($category_product, 200);
    }

    public function feature_products(){
        $feature_products = Product::where('feature_product', 1)->where('is_publish', 1)->where('is_active', 1)->get();
        return response()->json($feature_products, 200);
    }
    public function hot_deal_products(){
        $hot_deal = Product::where('hot_deal', 1)->where('is_publish', 1)->where('is_active', 1)->get();
        return response()->json($hot_deal, 200);
    }

    public function best_selling_products(){
        $hot_deal = Product::where('best_selling', 1)->where('is_publish', 1)->where('is_active', 1)->get();
        return response()->json($hot_deal, 200);
    }

    public function product_search(Request $request){
        // Retrieve the 'title' from the request input
        $keyword = $request->input('keyword');

        // Search for products with titles that match the search term
        $products = Product::where('title', 'LIKE', '%' . $keyword . '%')->select(['id', 'title', 'unit_price', 'discount_price', 'feature_image'])->get();

        // Return the results, you can return it as JSON or pass it to a view
        return response()->json($products, 200);
    }



}
