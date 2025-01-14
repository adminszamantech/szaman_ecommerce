@extends('frontend.layout.app')
@section('title', 'Cart')
@section('content')

    @if(Cart::instance('shopping')->count() > 0)
        <div class="cart-container py-3 md:py-14">
            <div class="grid grid-cols-12">
                <div class="col-span-12 md:col-span-9 md:pr-4 mb-6 md:mb-0">
                    <div class="cart-list bg-white shadow-lg px-6 py-0 md:py-6">
                        <div class="cart-header py-4 border-b border-[#EEEEEE]">
                            <h2 class="text-xl font-bold">My Cart (<span class="mycartqty"></span>)</h2>
                        </div>
                        <div class="cartPageContent">

                        </div>

                    </div>
                </div>
                <div class="col-span-12 md:col-span-3">
                    <div class="product_shipping px-6 py-6 bg-white shadow-md sticky top-20">
                        <div class="text-2xl pb-3 border-b px-4">
                            <h2>Order Summary</h2>
                        </div>
                        <div class="view_cart_subtotal flex justify-between items-center text-xl border-b py-3 px-4">
                            <strong>Subtotal</strong>
                            <strong><span class="subTotal">{{ Cart::instance('shopping')->subtotal() }}</span>৳</strong>
                        </div>

                        <div class="view_cart_shipping_content">


                            <div class="view_cart_process_checkout">
                                <a href="{{ route('frontend.checkout_view') }}" class="view_cart_process_checkout_link bg-theme inline-block w-full text-white text-[18px] py-3 text-center font-semibold border border-theme hover:bg-transparent hover:text-theme duration-300">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-row items-center justify-center mt-4 border-t border-b border-theme py-1 uppercase">
            <h2 class="text-2xl mt-0 p-0">Shopping Cart</h2>
        </div>
        <div class="flex flex-col gap-16 items-center justify-center py-12">
            <h2 class="text-2xl">Your shopping cart is empty!</h2>
            <div class="flex flex-col items-center justify-center gap-6 py-6">
                <div class="text-6xl">
                    <i class="fa fa-shopping-basket"></i>
                </div>
                <a href="{{ route('frontend.home_page') }}" class="bg-theme text-white px-6 py-2 font-semibold rounded">Continue shopping</a>
            </div>
        </div>
    @endif
@endsection
