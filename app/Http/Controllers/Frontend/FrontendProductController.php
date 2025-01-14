<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{

    public function detail_page($slug)
    {
        $product = Product::with('gallery')->where(['slug' => $slug, 'is_publish' => 1, 'is_active' => 1])->first();
        if (!$product) {
            abort(404, 'Product not found');
        }
        $related_products = Product::where(['category_id'=> $product->category_id,'is_active'=> 1,'is_publish'=> 1])
            ->where('id', '!=', $product->id)
            ->take(6)
            ->get();
        return view('frontend.product_details', compact('product', 'related_products'));
    }
}
