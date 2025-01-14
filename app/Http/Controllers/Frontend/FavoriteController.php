<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class FavoriteController extends Controller
{

    public function add_to_favorite(Request $request){
        $product = Product::where('id', $request->product_id)->first();
        $price = $product->discount !== null ? $product->discount_price  : $product->unit_price;
        // Find the shipping item in the cart
        $favoriteItem = Cart::instance('favorite')->content()->where('id', $product->id)->first();

        if ($favoriteItem) {
            // Already Favorite added
            return response()->json(['success' => 'Already added to favorite!'], 200);

        } else {
            // Add a new shipping charge
            Cart::instance('favorite')->add([
                'id' => $product->id,
                'name' =>  $product->title,
                'qty' => 1,
                'price' => $product->unit_price,
                'weight' => 0,
                'options' => ['image' => $product->feature_image, 'discount' => $product->discount, 'discount_price' => $product->discount_price, 'slug' => $product->slug]
            ]);

        }

        return response()->json(['success' => 'Added to favorite!', 'total_favorite'=> Cart::instance('favorite')->count()], 200);
    }

    public function wishlist_page(){

        $favorite_list = Cart::instance('favorite')->content();
        return view('frontend.wishlist', compact('favorite_list'));

    }

    public function remove_favorite(Request $request){
        $favorite = Cart::instance('favorite')->remove($request->rowId);
        return response()->json(['success' => 'Item removed from Wishlist!', 'total_favorite'=> Cart::instance('favorite')->count()], 200);
    }


}
