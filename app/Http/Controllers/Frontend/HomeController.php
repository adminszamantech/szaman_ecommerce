<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function home_page(){
        $feature_products = Product::where(['feature_product'=> 1,'is_active'=> 1,'is_publish'=> 1])->get();
        $hot_deals = Product::where(['hot_deal'=> 1,'is_active'=> 1,'is_publish'=> 1])->get();
        $best_selling = Product::where(['best_selling'=> 1,'is_publish'=> 1,'is_active'=> 1])->get();
        $products = Product::where(['is_publish'=> 1,'is_active'=> 1])->latest()->get();
        $sliders = Slider::where(['status'=> 1])->latest()->get();
        $brands = Brand::get();

        $category_wish_products = Category::with('product')->latest()->get();

        return view('frontend.homepage', compact('sliders', 'products', 'category_wish_products', 'feature_products', 'hot_deals', 'best_selling', 'brands'));
    }

    public function product_search(Request $request){
        // Retrieve the 'keyword' from the request input
        $keyword = $request->input('keyword');

        // Search for products with titles that match the search term
        $products = Product::where('title', 'LIKE', '%' . $keyword . '%')
            ->select(['id', 'title', 'unit_price', 'discount_price','slug', 'feature_image'])
            ->get();

        $content = "";
        if ($products->count() > 0){
            foreach ($products as $product){
                // Handle the image path and price dynamically
                $imagePath = asset('storage/product/' . $product->feature_image);
                $unitPrice = $product->unit_price;
                $discountPrice = $product->discount_price;

                if ($discountPrice !== null){
                    $content .= '<a href="' . route('frontend.product.details', $product->slug) . '" class="flex flex-row gap-2 border-b border-gray-300 py-2">
                            <div class="search-product-image">
                                <img width="50" src="' . $imagePath . '" alt="' . $product->title . '">
                            </div>
                            <div class="flex flex-col gap-1">
                                <h2 class="text-[12px] md:text-base">' . Str::words($product->title,8) . '</h2>
                                <div class="flex flex-row gap-2">
                                    <div class="flex flex-row justify-center items-center gap-x-0.5 text-[12px] line-through">
                                        <span><b>৳</b>'.number_format(  $unitPrice  ).'</span>
                                    </div>

                                    <div class="text-[13px] text-theme flex items-center">
                                        <span><b>৳</b>'.number_format(  $discountPrice  ).'</span>
                                    </div>
                                </div>
                            </div>
                        </a>';
                }else{
                    $content .= '<a href="' . route('frontend.product.details', $product->slug) . '" class="flex flex-row gap-2 border-b border-b-slate-700 py-2">
                            <div class="search-product-image">
                                <img width="50" src="' . $imagePath . '" alt="' . $product->title . '">
                            </div>
                            <div class="flex flex-col gap-1">
                                <h2 class="text-[12px] md:text-base">' . Str::words($product->title,8) . '</h2>
                                <div class="flex flex-row gap-2">

                                    <div class="text-[13px] text-theme flex items-center">
                                        <span><b>৳</b>'.number_format(  $unitPrice  ).'</span>
                                    </div>
                                </div>
                            </div>
                        </a>';
                }

            }
            return response()->json(['content' => $content, 'search_status' => true], 200);
        }else {
            return response()->json(['search_status' => false], 200);
        }

        // Return the results as a JSON response
    }


}
