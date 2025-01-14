@extends('frontend.layout.app')
@section('title', 'Wishlist')
@section('content')
    <div class="flex flex-row items-center justify-center mt-4 border-t border-b border-theme py-1 uppercase">
        <h2 class="text-2xl mt-0 p-0">Wishlist Product</h2>
    </div>
    @if(count($favorite_list) > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 items-center bg-white px-4 md:px-0 py-6">
            @foreach($favorite_list as $wishlist)
            <!-- Single Product -->
                <div class="product-card flex flex-col text-center border-[1px] border-theme rounded-lg group">
                    <a href="{{ route('frontend.product.details', $wishlist->options->slug) }}" class=" product-img rounded-tl-lg rounded-tr-lg overflow-hidden relative">
                        <img class="group-hover:scale-125 duration-500 w-full" src="{{ asset('/storage/product/'.$wishlist->options->image) }}" alt="{{ $wishlist->options->image }}">

                        <div class="cart-favorite flex flex-col">

                            <!-- Add to cart icon -->
                            <button id="{{ $wishlist->rowId }}" onclick="remove_to_favorite(event, this.id)" class=" absolute top-0 rounded-bl-lg right-0 bg-red-500 text-white px-2 py-0 text-xl">
                                <i class="fa fa-close"></i>
                            </button>
                            <!-- Add to cart icon -->
                        </div>
                    </a>
                    <div class="product-price-info flex flex-col gap-1 py-1 items-center min-h-[125px]">
                        <a class="min-h-[44px]" href="{{ route('frontend.product.details', $wishlist->options->slug) }}"><h2 class="text-[14px] group-hover:text-theme font-semibold duration-500 px-2">{{ Str::limit($wishlist->name, 40) }}</h2></a>
                        <div class="product_price">
                            @if($wishlist->options->discount !== null)
                                <div class="flex flex-row gap-2 items-center justify-center">
                                    <div class="flex flex-row justify-center items-center gap-x-0.5 text-[12px] font-bold line-through">
                                        <span><b>৳</b>{{ number_format($wishlist->price) }}</span>
                                    </div>

                                    <div class="text-[13px] text-theme font-bold flex items-center">
                                        <span><b>৳</b>{{ number_format($wishlist->options->discount_price) }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-center">
                                    <div class="text-[13px] text-theme font-bold flex items-center">
                                        <span><b>৳</b>{{ number_format($wishlist->price) }}</span>
                                    </div>
                                </div>
                            @endif
                            <div class="product-rating flex flex-row gap-1 mt-2 text-theme">
                                @for($i = 0; $i< 5; $i++)
                                    <svg fill="currentColor" width="16" height="16" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                @endfor
                            </div>
                            <button id="{{ $wishlist->id }}" onclick="add_to_carts(event, this.id)" class="bg-theme text-white px-2 text-[14px] rounded my-1" type="button">Add to Cart</button>
                        </div>
                    </div>
                </div>
        <!--/ Single Product -->
                @endforeach
        </div>
    @else
        <div class="flex flex-col gap-16 items-center justify-center py-12">
            <h2 class="text-2xl">Your wishlist is empty!</h2>
            <div class="flex flex-col items-center justify-center gap-6 py-6">
                <div class="text-6xl">
                    <i class="fa fa-shopping-basket"></i>
                </div>
                <a href="{{ route('frontend.home_page') }}" class="bg-theme text-white px-6 py-2 font-semibold rounded">Continue shopping</a>
            </div>
        </div>
    @endif
@endsection

