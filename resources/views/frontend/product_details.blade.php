@extends('frontend.layout.app')
@section('title', 'Home Page')
@section('content')
    <div class="grid grid-cols-12 py-0 md:py-4 gap-6">
        <div class="col-span-12 md:col-span-4">
            <div class="feature-image">
                <img src="{{ asset('/storage/product/'.$product->feature_image) }}" id="productFeatureImage" class="w-full" alt="">
            </div>

            <div class="flex flex-row gap-2 py-2">
                @if(count($product->gallery) > 0)
                    @foreach($product->gallery as $gallery_image)
                        <div class="feature-image border-2 border-theme cursor-pointer" onclick="imageClick('{{asset('/storage/gallery/'.$gallery_image->image)}}')">
                            <img width="80" src="{{ asset('/storage/gallery/'.$gallery_image->image) }}" alt="{{ $gallery_image->image }}">
                        </div>
                    @endforeach
                @else
                    <div class="feature-image border-2 border-theme cursor-pointer" onclick="imageClick('{{asset('/storage/product/'.$product->feature_image)}}')">
                        <img width="80" src="{{  asset('/storage/product/'.$product->feature_image) }}" alt="{{ $product->feature_image }}">
                    </div>
                @endif
            </div>
        </div>
        <div class="col-span-12 md:col-span-4">
            <div class="product_title">
                <h2 class="text-2xl font-semibold"> {{ $product->title }}</h2>
            </div>
            <div class="single_product_whatsapp mt-4">
                <a href="https://wa.me/{{ siteSetting()->site_phone }}" target="_blank" class="single_product_whatsapp_link flex flex-row gap-2 items-center">
                    <svg data-v-ba5acb34="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="22px" height="22px" fill-rule="evenodd" clip-rule="evenodd" class="single_whats_app">
                        <path data-v-ba5acb34="" fill="#fff" d="M4.9,43.3l2.7-9.8C5.9,30.6,5,27.3,5,24C5,13.5,13.5,5,24,5c5.1,0,9.8,2,13.4,5.6	C41,14.2,43,18.9,43,24c0,10.5-8.5,19-19,19c0,0,0,0,0,0h0c-3.2,0-6.3-0.8-9.1-2.3L4.9,43.3z">
                        </path>
                        <path data-v-ba5acb34="" fill="#fff" d="M4.9,43.8c-0.1,0-0.3-0.1-0.4-0.1c-0.1-0.1-0.2-0.3-0.1-0.5L7,33.5c-1.6-2.9-2.5-6.2-2.5-9.6	C4.5,13.2,13.3,4.5,24,4.5c5.2,0,10.1,2,13.8,5.7c3.7,3.7,5.7,8.6,5.7,13.8c0,10.7-8.7,19.5-19.5,19.5c-3.2,0-6.3-0.8-9.1-2.3	L5,43.8C5,43.8,4.9,43.8,4.9,43.8z">
                        </path>
                        <path data-v-ba5acb34="" fill="#cfd8dc" d="M24,5c5.1,0,9.8,2,13.4,5.6C41,14.2,43,18.9,43,24c0,10.5-8.5,19-19,19h0c-3.2,0-6.3-0.8-9.1-2.3	L4.9,43.3l2.7-9.8C5.9,30.6,5,27.3,5,24C5,13.5,13.5,5,24,5 M24,43L24,43L24,43 M24,43L24,43L24,43 M24,4L24,4C13,4,4,13,4,24	c0,3.4,0.8,6.7,2.5,9.6L3.9,43c-0.1,0.3,0,0.7,0.3,1c0.2,0.2,0.4,0.3,0.7,0.3c0.1,0,0.2,0,0.3,0l9.7-2.5c2.8,1.5,6,2.2,9.2,2.2	c11,0,20-9,20-20c0-5.3-2.1-10.4-5.8-14.1C34.4,6.1,29.4,4,24,4L24,4z">
                        </path>
                        <path data-v-ba5acb34="" fill="#40c351" d="M35.2,12.8c-3-3-6.9-4.6-11.2-4.6C15.3,8.2,8.2,15.3,8.2,24c0,3,0.8,5.9,2.4,8.4L11,33l-1.6,5.8	l6-1.6l0.6,0.3c2.4,1.4,5.2,2.2,8,2.2h0c8.7,0,15.8-7.1,15.8-15.8C39.8,19.8,38.2,15.8,35.2,12.8z">
                        </path>
                        <path data-v-ba5acb34="" fill="#fff" fill-rule="evenodd" d="M19.3,16c-0.4-0.8-0.7-0.8-1.1-0.8c-0.3,0-0.6,0-0.9,0	s-0.8,0.1-1.3,0.6c-0.4,0.5-1.7,1.6-1.7,4s1.7,4.6,1.9,4.9s3.3,5.3,8.1,7.2c4,1.6,4.8,1.3,5.7,1.2c0.9-0.1,2.8-1.1,3.2-2.3	c0.4-1.1,0.4-2.1,0.3-2.3c-0.1-0.2-0.4-0.3-0.9-0.6s-2.8-1.4-3.2-1.5c-0.4-0.2-0.8-0.2-1.1,0.2c-0.3,0.5-1.2,1.5-1.5,1.9	c-0.3,0.3-0.6,0.4-1,0.1c-0.5-0.2-2-0.7-3.8-2.4c-1.4-1.3-2.4-2.8-2.6-3.3c-0.3-0.5,0-0.7,0.2-1c0.2-0.2,0.5-0.6,0.7-0.8	c0.2-0.3,0.3-0.5,0.5-0.8c0.2-0.3,0.1-0.6,0-0.8C20.6,19.3,19.7,17,19.3,16z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Ask for details</span>
                </a>
            </div>
            <div class="product_price mt-4">
                <div class="flex flex-row gap-4">
                    <div class="price_title font-semibold">Price:</div>
                    @if($product->discount !== null)
                        <div class="price font-semibold">
                            <span><b>৳</b>{{ number_format($product->discount_price) }}</span>
                        </div>
                        <div class="regular_price line-through text-gray-400 font-semibold">
                            <span><b>৳</b>{{ number_format($product->unit_price) }}</span>
                        </div>
                        @else
                        <div class="price font-semibold">
                            <span><b>৳</b>{{ number_format($product->unit_price) }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="qty_buynow flex flex-row gap-6 items-center justify-between md:justify-stretch mt-4">
                <div class="fixed_product_card_qty flex flex-row items-center justify-center border rounded">
                    <div class="fixed_product_card_qty_minus border-r px-4 py-1 md:py-2 cursor-pointer" id="qty_decrement">
                        <i class="fa-solid fa-minus"></i>
                    </div>
                    <input class="product_qty w-16 font-semibold py-1 md:py-2 focus:outline-none text-center" id="qtyValue" type="text" value="1">
                    <div class="fixed_product_card_qty_plus border-l px-4 py-1 md:py-2 cursor-pointer" id="qty_increment">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
                <div class="buynow_btn">
                    <a href="javascript:void(0)" id="{{ $product->id }}" onclick="buy_now_button(this.id)"  class=" bg-theme text-white px-6 py-2 md:px-8 md:py-3 font-semibold rounded">Order Now <i class="fa-solid fa-check"></i>
                    </a>
                </div>
            </div>
            <div class="flex flex-row gap-6 items-center justify-between md:justify-stretch mt-4">
                <a href="javascript:void(0)" id="{{ $product->id }}" onclick="add_to_cart(this.id)" class="cart_check_out border border-gray-300 px-4 py-2 md:px-6 md:py-3 hover:text-theme hover:border-theme duration-300 rounded">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Add To Cart
                </a>
                <a href="javascript:void(0)" id="{{ $product->id }}" onclick="add_to_favorite(event, this.id)"  class="cart_check_out border border-gray-300 px-4 py-2 md:px-6 md:py-3 hover:text-theme hover:border-theme duration-300 rounded">
                    <i class="fa-regular fa-heart"></i>
                    Add To Wishlist
                </a>
            </div>
        </div>
        <div class="col-span-12 md:col-span-4">
            <div class="flex flex-col gap-4">
                <div class="single_product_specification_list border-2 border-theme border-dotted px-4 py-4">
                    <ul class="flex flex-col gap-2">
                        <div class="single_product_call_title">
                            <p class="text-gray-600 font-semibold">Have question about this product ?</p>
                        </div>
                        <li class="text-theme">
                            <i class="fa-solid fa-check"></i>
                            Order today and receive it within 01 - 02 days
                        </li>
                        <li class="text-theme">
                            <i class="fa-solid fa-thumbs-up"></i>
                            Quality Product
                        </li>
                        <li class="text-theme">
                            <i class="fa-solid fa-handshake"></i>
                            Cash On Delivery Available
                        </li>
                        <li class="text-theme">
                            <i class="fa-solid fa-truck-fast"></i>
                            Delivery Charge {{ ucwords(shippingChargeInside()->shipping_charge_name) }}
                            <span><em>৳</em> {{ number_format(shippingChargeInside()->amount) }}</span>
                        </li>
                        <li class="text-theme">
                            <i class="fa-solid fa-truck-fast"></i>
                            Delivery Charge {{ ucwords(shippingChargeOutside()->shipping_charge_name) }}
                            <span><em>৳</em> {{ number_format(shippingChargeOutside()->amount) }}</span>
                        </li>
                    </ul>
                </div>
                <div class="single_product_call_details border-2 border-theme border-dotted px-4 py-4 flex flex-col gap-4">
                    <div class="single_product_call_title">
                        <p class="text-gray-600 font-semibold">Have question about this product ? please call</p>
                    </div>
                    <div class="single_product_call">
                        <ul class="flex flex-col gap-2">
                            <li>
                                <a href="tel:{{ siteSetting()->site_phone }}" class="single_product_call_link text-theme">
                                    <i class="fa-solid fa-phone"></i>
                                   {{ siteSetting()->site_phone }}
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ siteSetting()->site_phone }}" class="single_product_call_link text-theme">
                                    <i class="fa-solid fa-phone"></i>
                                    Bkash Personal
                                </a>
                            </li>
                            <li class="">
                                <a href="tel:{{ siteSetting()->site_phone }}" class="single_product_call_link text-theme">
                                    <i class="fa-solid fa-phone"></i>
                                    Nagad Personal
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product_tabs_container mt-4">
        <div class="single_product_tab">
            <ul class="single_product_tab_nav flex flex-row bg-gray-300">
                <li class="nav-item single_product_tab_nav_item">
                    <button class=" text-xs md:text-base px-4 py-2 bg-theme text-white font-bold hover:bg-theme hover:text-white" id="descriptionTabBtn" type="button">
                        DESCRIPTION
                    </button>
                </li>
                <li class="single_product_tab_nav_item">
                    <button class="text-xs md:text-base text-black px-4 py-2 font-bold hover:bg-theme hover:text-white" id="howToBuyTabBtn" type="button">
                        HOW TO BUY
                    </button>
                </li>
                <li class="single_product_tab_nav_item">
                    <button class="text-xs md:text-base text-black px-4 py-2 font-bold hover:bg-theme hover:text-white" id="refundPolicyBtn" type="button">
                        RETURN POLICY
                    </button>
                </li>
            </ul>
            <div class="tab-content py-6">
                <div class="tab-pane" id="descriptionContent">
                    <div class="single_product_tab_content">
                        {!! $product->description !!}
                    </div>
                </div>
                <div class="tab-pane hidden" id="howToBuyContent">
                    <div class="single_product_tab_content">
                        <div class="single_product_tab_list">
                            Select number of product you want to buy.
                            Click Add To Cart Button
                            Then go to checkout page
                            If you are a new customer, please click on Sign Up.provide us your valid information information.
                            Complete your checkout, we received your order, and for order confirmation or customer service contact with you
                        </div>
                    </div>
                </div>
                <div class="tab-pane hidden" id="refundPolicyContent">
                    <div class="single_product_tab_content">
                        <div class="single_product_tab_list">
                            <ul>
                                <li>
                                   Refund policy If your product is damaged, defective,
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="related_products">
        @include('frontend.partials.related-products')
    </div>

    <script>
        //================ Product Details Page =====================//
        function imageClick (event) {
            document.getElementById('productFeatureImage').src = event
            // console.log(event)
        }
        // Quantity
        const increment = document.getElementById('qty_increment');
        const decrement = document.getElementById('qty_decrement');
        const qtyValue = document.getElementById('qtyValue');
        increment.addEventListener('click', function (){
            qtyValue.value++
        });
        decrement.addEventListener('click', function (){
            if (parseInt(qtyValue.value) > 1){
                qtyValue.value--
            }
        });
        // Quantity

        // Tabs Javascript code
        const descriptionTabBtn = document.getElementById('descriptionTabBtn');
        const howToBuyTabBtn = document.getElementById('howToBuyTabBtn');
        const refundPolicyBtn = document.getElementById('refundPolicyBtn');

        const descriptionContent = document.getElementById('descriptionContent');
        const howToBuyContent = document.getElementById('howToBuyContent');
        const refundPolicyContent = document.getElementById('refundPolicyContent');

        descriptionTabBtn.addEventListener('click', function (){
            descriptionTabBtn.classList.add('bg-theme', 'text-white');
            descriptionTabBtn.classList.remove('text-black');

            howToBuyTabBtn.classList.remove('bg-theme', 'text-white')
            howToBuyTabBtn.classList.add('text-black')

            refundPolicyBtn.classList.remove('bg-theme', 'text-white')
            refundPolicyBtn.classList.add('text-black')

            descriptionContent.classList.remove('hidden');
            howToBuyContent.classList.add('hidden');
            refundPolicyContent.classList.add('hidden');
        });

        howToBuyTabBtn.addEventListener('click', function (){
            descriptionTabBtn.classList.remove('bg-theme', 'text-white')
            descriptionTabBtn.classList.add('text-black')

            howToBuyTabBtn.classList.remove('text-black');
            howToBuyTabBtn.classList.add('bg-theme', 'text-white');

            refundPolicyBtn.classList.remove('bg-theme', 'text-white')
            refundPolicyBtn.classList.add('text-black')

            descriptionContent.classList.add('hidden');
            howToBuyContent.classList.remove('hidden');
            refundPolicyContent.classList.add('hidden');

        });

        refundPolicyBtn.addEventListener('click', function (){
            descriptionTabBtn.classList.remove('bg-theme', 'text-white');
            descriptionTabBtn.classList.add('text-black');

            howToBuyTabBtn.classList.remove('bg-theme', 'text-white')
            howToBuyTabBtn.classList.add('text-black')

            refundPolicyBtn.classList.add('bg-theme', 'text-white')
            refundPolicyBtn.classList.remove('text-black')

            descriptionContent.classList.add('hidden');
            howToBuyContent.classList.add('hidden');
            refundPolicyContent.classList.remove('hidden');
        });

        //================ End Product Details Page =====================//
    </script>
@endsection
