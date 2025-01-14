<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function getCartContent(){
        $cart = Cart::instance('shopping')->content();
        $quantity = Cart::instance('shopping')->count();
        $subtotal = Cart::instance('shopping')->subtotal();
        $shipping = Cart::instance('shipping')->content()->where('id', 'shipping')->first();
        $shipping_charge = $shipping ? $shipping->price : 0;
        return response()->json(['cart' => $cart, 'total_qty' => $quantity, 'subtotal' => $subtotal, 'shipping_charge' => $shipping_charge], 200);
    }

    public function add_to_cart(Request $request){
        $product = Product::where('id', $request->product_id)->first();
        $price = $product->discount !== null ? $product->discount_price  : $product->unit_price;
        Cart::instance('shopping')->add($request->product_id, $product->title, $request->quantity, $price, ['image' => $product->feature_image]);
        return response()->json(['success' => 'Add to cart successfully'],200);
    }


    public function updateCart(Request $request){
        $cart = Cart::instance('shopping')->update($request->rowId, ['qty' =>$request->qty]);
        return response()->json(['success' => 'Cart is updated!'], 200);
    }

    public function cartRemove(Request $request){
        $cart = Cart::instance('shopping')->remove($request->rowId);
        return response()->json(['success' => 'Cart item has been removed!'], 200);
    }

    public function buy_now_button(Request $request){
        if (auth('web')->check()){
            $product = Product::where('id', $request->product_id)->first();
            $price = $product->discount !== null ? $product->discount_price  : $product->unit_price;
            Cart::instance('shopping')->add($request->product_id, $product->title, $request->quantity, $price, ['image' => $product->feature_image]);
            return response()->json(['success' => true],200);
        }else{
            return response()->json(['error' => "Please login or register to buy!"], 200);
        }

    }



    public function addShippingCharge(Request $request)
    {
        // Find the shipping item in the cart
        $shippingItem = Cart::instance('shipping')->content()->where('id', 'shipping')->first();

        if ($shippingItem) {
            // Update the existing shipping charge
            Cart::instance('shipping')->update($shippingItem->rowId, [
                'price' => $request->amount,
                'qty' => 1 // Ensure quantity is 1 for shipping
            ]);
        } else {
            // Add a new shipping charge
            Cart::instance('shipping')->add([
                'id' => 'shipping',
                'name' => 'Shipping Charge',
                'qty' => 1,
                'price' => $request->amount,
                'weight' => 0,
                'options' => ['type' => 'shipping']
            ]);
        }

        return response()->json(Cart::instance('shipping')->content()->where('id', 'shipping')->first(), 200);

    }


}
