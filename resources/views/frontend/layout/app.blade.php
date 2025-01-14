<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/storage/logo/' . siteSetting()->favicon) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/storage/logo/' . siteSetting()->favicon) }}">
    <link rel="mask-icon" href="{{ asset('/storage/logo/' . siteSetting()->favicon) }}" color="#5bbad5">
    <link rel="favicon" href="{{ asset('/storage/logo/' . siteSetting()->favicon) }}" color="#5bbad5">
    <title>@yield('title') | {{ siteSetting()->site_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @vite('resources/css/app.css')
    @yield('css')

</head>

<body class="bg-gray-100">
    <!-- Desktop Header -->
    <x-frontend.common.header />
    <!--/ Desktop Header -->
    <x-frontend.common.mobile-header />
    <div class="main-content mx-auto md:w-[1560px] max-w-full px-4">
        @yield('content')
    </div>
    <!-- Footer -->
    <x-frontend.common.footer />
    <!--/ Footer -->

    <!-- Mobile Footer -->
    <x-frontend.common.mobile-footer />
    <!--/ Mobile Footer -->

    <!--=============== Sticky Cart ===============-->
    <div class="fixed_product_sticky hidden md:block fixed top-[40%] z-20 bg-white drop-shadow right-0 cursor-pointer"
        id="openModalButton">
        <div class="flex flex-col items-center justify-center">
            <div class="fixed_product_sticky_icon p-1">
                <i class="fa-solid text-theme fa-cart-shopping text-xl"></i>
            </div>

            <div class="fixed_product_sticky_count bg-theme text-white px-2 py-1">
                <p><span class="item_count">{{ Cart::instance('shopping')->count() }}</span> items</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="cartModel"
        class="fixed top-0 left-full inset-0 bg-gray-600 bg-opacity-50 items-center justify-center z-[9999]">
        <div id="cartSlide"
            class="bg-white shadow-lg py-2 w-full h-screen max-h-full max-w-md absolute -right-[600px] duration-300 top-0">
            <!-- Fixed Product Cart Header -->
            <div class="flex justify-between items-center px-2">
                <div class="icon flex flex-row gap-2 justify-center items-center">
                    <div class="fixed_product_sticky_icon">
                        <i class="fa-solid text-theme fa-cart-shopping text-2xl"></i>
                    </div>
                    <div class="w-6 h-6 bg-theme rounded-full flex items-center justify-center text-white">
                        <span class="item_count">{{ Cart::instance('shopping')->count() }} </span>
                    </div>
                </div>
                <button id="closeModalButton" class="text-gray-600 hover:text-gray-900 bg-red-500 px-2 rounded-sm">
                    <i class="fa-solid fa-xmark text-xl text-white"></i>
                </button>
            </div>
            <hr class="mt-2">
            <!--/ Fixed Product Cart Header -->
            <!-- Fixed Product Cart Body -->
            <div class="fixed_product_cart_body h-[700px] pb-[300px] md:pb-[200px] overflow-y-scroll">
                <div class="px-2 py-2 stickyCart">

                </div>
            </div>
            <!--/ Fixed Product Cart Body -->
            <!-- Fixed Product Cart Footer -->
            <div class="fixed_product_cart_footer bg-[#f5f6f7] absolute left-0 bottom-0 w-full py-4">
                <div class="px-2 flex flex-col gap-2">
                    <div class="subtotal_container flex flex-row justify-between items-center">
                        <span>Subtotal:</span>
                        <p><span id="fix_subtotal_price">{{ Cart::instance('shopping')->subtotal() }}</span>৳</p>
                    </div>
                    <a href="{{ route('frontend.checkout_view') }}"
                        class="px-4 py-3 bg-theme font-bold text-white text-center">Checkout</a>
                    <a href="{{ route('frontend.cart_view') }}"
                        class="px-4 py-3 font-bold bg-black text-white text-center">View Cart</a>
                </div>
            </div>
            <!--/ Fixed Product Cart Footer -->
        </div>
    </div>
    <!--=============== Sticky Cart ===============-->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"></script>
    <!-- Toastr jS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->

    <script>
        window.onscroll = function() {
            desktopHeaderFunction()
        };

        var header = document.getElementById("myheader");
        var header_bottom = document.getElementById("header_bottom");
        var header_cart_svg = document.getElementById("header_cart_svg");

        var header_heart = document.getElementById("header_heart");

        var header_cart_amount = document.getElementById("header_cart_amount");
        var header_currency = document.getElementById("header_currency");
        var sticky = header.offsetTop;
        var mobile_header = document.getElementById("fix_mobile_sticky");

        function desktopHeaderFunction() {
            if (window.pageYOffset > 10) {
                header.classList.add("sticky_header");
                header.classList.add("bg-theme");
                header.classList.remove('bg-[#f7f8fa]')

                header_bottom.classList.add('md:hidden')
                header_bottom.classList.remove('md:block')

                header_heart.classList.remove('text-theme');
                header_heart.classList.add('text-white');

                header_cart_svg.setAttribute('stroke', '#fff');
                header_cart_amount.classList.add('text-white');
                header_cart_amount.classList.remove('text-black');
                header_currency.classList.add('text-white');

                mobile_header.classList.add("mobile_sticky_header");
            } else {
                header.classList.remove("sticky_header");
                header.classList.remove("bg-theme");
                header.classList.add('bg-[#f7f8fa]')

                header_bottom.classList.remove('md:hidden')
                header_bottom.classList.add('md:block')
                header_heart.classList.add('text-theme');
                header_heart.classList.remove('text-white');

                header_cart_svg.setAttribute('stroke', '#eb5d1e');
                header_cart_amount.classList.remove('text-white');
                header_cart_amount.classList.add('text-black');
                header_currency.classList.remove('text-white');

                mobile_header.classList.remove("mobile_sticky_header");
            }
        }

        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }


        // ================ Stick Cart =======================//
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const modal = document.getElementById('cartModel');
        const sliding = document.getElementById('cartSlide');

        openModalButton.addEventListener('click', () => {
            modal.classList.remove('left-full');
            modal.classList.add('left-0');
            document.body.classList.add("overflow-hidden");
            sliding.classList.remove('-right-[600px]')
            sliding.classList.add('-right-0')
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('left-full');
            modal.classList.remove('left-0');
            document.body.classList.remove("overflow-hidden");
            sliding.classList.remove('-right-0')
            sliding.classList.add('-right-[600px]')
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('left-full');
                modal.classList.remove('left-0');
                sliding.classList.remove('-right-0')
                sliding.classList.add('-right-[600px]')
                document.body.classList.remove("overflow-hidden");
            }
        });
        // ================ Stick Cart =======================//

        //================= Add To Favorite =======================//
        function add_to_favorite(event, product_id) {
            event.preventDefault();
            axios.post('{{ route('frontend.addtofavorite') }}', {
                product_id: parseInt(product_id),
            }).then(addFavRes => {
                toastr.success(addFavRes.data.success);
                $('.favorite_count').text(addFavRes.data.total_favorite)
            })
        }
        //================ End Add To Favorite =========================//

        //================= Remove to Favorite =======================//
        function remove_to_favorite(event, row_id) {
            event.preventDefault();
            axios.post('{{ route('frontend.removefavorite') }}', {
                rowId: row_id,
            }).then(rmvFavRes => {
                toastr.success(rmvFavRes.data.success);
                $('#favorite_count').text(rmvFavRes.data.total_favorite);
                window.location.href = "{{ route('frontend.wishlist.page') }}"
            })
        }
        //================ End Remove to Favorite =========================//

        //================= Product Add To Cart =======================//
        function add_to_carts(event, product_id) {
            event.preventDefault();
            axios.post('{{ route('frontend.addtocart') }}', {
                product_id: parseInt(product_id),
                quantity: 1
            }).then(addCartRes => {
                toastr.success(addCartRes.data.success);
                getCartContent();
            })
        }
        //================ Add To Cart =========================//



        //================= Single Product Add To Cart =======================//
        function add_to_cart(product_id) {
            let qty = document.getElementById('qtyValue');
            axios.post('{{ route('frontend.addtocart') }}', {
                product_id: parseInt(product_id),
                quantity: parseInt(qty.value)
            }).then(addCartRes => {
                toastr.success(addCartRes.data.success);
                getCartContent();
            })
        }
        //================ Single Product Add To Cart =========================//

        // ================= Buy Now Button =======================//
        function buy_now_button(product_id) {
            let qty = document.getElementById('qtyValue');
            axios.post('{{ route('frontend.buynowbutton') }}', {
                product_id: parseInt(product_id),
                quantity: parseInt(qty.value)
            }).then(buyNowRes => {
                if (buyNowRes.data.success === true) {
                    window.location.href = "{{ route('frontend.checkout_view') }}"
                    getCartContent();
                } else {
                    toastr.error(buyNowRes.data.error);
                }
            })
        }
        //================ Single Product Add To Cart =========================//


        // ==================== Increment Cart ================//
        const cartIncrement = (id) => {
            let qty = document.getElementById('qty_' + id).value
            document.getElementById('qty_' + id).value = parseInt(qty) + 1;
            // console.log(qty)
            let data = {
                rowId: id,
                qty: parseInt(qty) + 1
            }
            axios.post('/updatecart', data).then(updateCartRes => {
                // toastr.success(updateCartRes.data.success);
                getCartContent();
                getCartPageContent();
            })

        }
        // ==================== Increment Cart ================//

        // ==================== Decrement Cart ================//
        const cartDecrement = (id) => {
            let qty = document.getElementById('qty_' + id).value
            if (parseInt(qty) > 1) {
                document.getElementById('qty_' + id).value = parseInt(qty) - 1;
                let data = {
                    rowId: id,
                    qty: parseInt(qty) - 1
                }
                axios.post('/updatecart', data).then(updateCartRes => {
                    // toastr.success(updateCartRes.data.success);
                    getCartContent();
                    getCartPageContent();
                })
            }
        }
        // ==================== Decrement Cart ================//

        // ====================  Cart removed ================= //
        const cartRemove = (rowId) => {
            const data = {
                rowId: rowId
            }
            axios.post('/removecart', data).then(rmvCartRes => {
                getCartContent();
                getCartPageContent();
                //toastr.success(rmvCartRes.data.success);
            })
        }
        // ====================/ Cart Removed ===================//

        //================= get cart items ============== //
        const getCartContent = () => {
            axios.get("{{ route('frontend.getcarts') }}").then(getCartContRes => {
                let carts = Object.values(getCartContRes.data.cart);

                if (carts?.length > 0) {
                    let fixedCatItems = '';
                    carts.forEach(cartItems => {
                        fixedCatItems +=
                            '<div class="grid grid-cols-12 border-b pb-1"><div class="col-span-3"><img src="/storage/product/' +
                            cartItems.options.image +
                            '" width="80" height="80" alt=""/></div><div class="col-span-9"><div class="flex flex-col w-full gap-1"><div class="flex justify-between gap-4"><h3>' +
                            cartItems.name +
                            '</h3> <a class="card_remove text-red-600 cursor-pointer" id="' + cartItems
                            .rowId +
                            '" onclick="cartRemove(this.id)" > <i class="fa-solid fa-trash"></i></a></div><div class="fixed_product_card_qty_price flex flex-row items-center justify-between"><div class="fixed_product_card_qty flex flex-row items-center justify-center border rounded"><div class="fixed_product_card_qty_minus border-r px-2 cursor-pointer" id="' +
                            cartItems.rowId +
                            '" onclick="cartDecrement(this.id)"><i class="fa-solid fa-minus"></i></div><input class="product_qty w-10 font-semibold focus:outline-none text-center" id="qty_' +
                            cartItems.rowId + '" type="text" value="' + cartItems.qty +
                            '"><div class="fixed_product_card_qty_plus border-l px-2 cursor-pointer" id="' +
                            cartItems.rowId +
                            '" onclick="cartIncrement(this.id)"><i class="fa-solid fa-plus"></i></div></div><div class="fixed_product_card_close_price"><p>' +
                            cartItems.subtotal + '<em>৳</em></p></div></div></div></div></div>'
                    })
                    $('.stickyCart').html(fixedCatItems);
                    $('#fix_subtotal_price').text(getCartContRes.data.subtotal);
                    $('.subTotal').text(getCartContRes.data.subtotal);
                    $('.item_count').text(getCartContRes.data.total_qty);
                } else {
                    $('#fix_subtotal_price').text("0.00")
                    $('.item_count').text(0)
                    $('.subTotal').text('0.00');
                    $('.stickyCart').html('<h2 class="text-center text-xl">Cart Empty!</h2>')

                }
            })
        }
        getCartContent();
        //================= get cart items ============== //

        //================= Cart Page =====================//
        const getCartPageContent = () => {
            axios.get("{{ route('frontend.getcarts') }}").then(getCartPageContRes => {
                let cartPage = Object.values(getCartPageContRes.data.cart);

                if (cartPage?.length > 0) {
                    let cartPageContent = '';
                    cartPage.forEach(cartPageItems => {
                        cartPageContent +=
                            '<div class="cart-item py-4 grid grid-cols-12 gap-4 border-b border-[#EEEEEE]"><div class="col-span-12 md:col-span-8"><div class="flex flex-row gap-6"><div class="item-image"><img src="/storage/product/' +
                            cartPageItems.options.image +
                            '" alt="" class="w-32 border rounded"></div><div class=" flex flex-col justify-between"><div class="items-title"><h2>' +
                            cartPageItems.name + ' </h2></div><div id="' + cartPageItems.rowId +
                            '" onclick="cartRemove(this.id)" class="hidden md:block remove_button uppercase font-semibold cursor-pointer hover:text-theme">Remove</div></div></div></div><div class="col-span-12 md:col-span-4"><div class="flex flex-row items-center justify-between"><div class="view_cart_price"><span> ' +
                            cartPageItems.subtotal +
                            '৳ </span></div><div class="fixed_product_card_qty flex flex-row items-center justify-center border rounded"><div class="fixed_product_card_qty_minus border-r px-2 cursor-pointer" id="' +
                            cartPageItems.rowId +
                            '" onclick="cartDecrement(this.id)"><i class="fa-solid fa-minus"></i></div><input class="product_qty w-10 font-semibold focus:outline-none text-center" type="text" id="qty_' +
                            cartPageItems.rowId + '" value="' + cartPageItems.qty + '"><div id="' +
                            cartPageItems.rowId +
                            '" onclick="cartIncrement(this.id)" class="fixed_product_card_qty_plus border-l px-2 cursor-pointer"><i class="fa-solid fa-plus"></i></div></div></div></div><div class="col-span-12"><div id="' +
                            cartPageItems.rowId +
                            '" onclick="cartRemove(this.id)" class="md:hidden block text-center remove_button uppercase font-semibold cursor-pointer hover:text-theme"> Remove</div></div></div>'
                    })
                    $('.cartPageContent').html(cartPageContent);
                    $('#fix_subtotal_price').text(getCartPageContRes.data.subtotal)
                    $('.item_count').text(getCartPageContRes.data.total_qty)
                    $('.mycartqty').text(getCartPageContRes.data.total_qty);
                    $('.subTotal').text(getCartPageContRes.data.subtotal)
                    $('.total_amount').text(getCartPageContRes.data.subtotal)
                } else {
                    $('#fix_subtotal_price').text("0.00")
                    $('.item_count').text(0)
                    $('.mycartqty').text(0)
                    $('.cartPageContent').html('<h2 class="text-center text-xl">Cart Empty!</h2>')
                    $('.subTotal').text('0.00')
                    $('.total_amount').text('0.00')
                }
            })
        }
        getCartPageContent()
        //================ Cart Page =====================//

        //================ Search Product ================//
        function searchProduct(value) {

            let close_search_button = document.getElementById('close_search_button');
            let ps_container_id = document.getElementById('ps-container');
            if (value.length > 2) {
                let data = {
                    keyword: value
                }
                axios.post("{{ route('frontend.search_product') }}", data).then(searchRes => {
                    if (searchRes.data.search_status == true) {
                        ps_container_id.classList.remove('hidden')
                        close_search_button.classList.remove('hidden')
                        $('.search-product-container').html(searchRes.data.content)
                    } else {
                        ps_container_id.classList.add('hidden')

                    }
                })

            } else {
                ps_container_id.classList.add('hidden')
                close_search_button.classList.add('hidden')
            }

        }

        function searchCloseButton() {
            let ps_container_id = document.getElementById('ps-container');
            ps_container_id.classList.add('hidden')


            let close_search_button = document.getElementById('close_search_button');
            close_search_button.classList.add('hidden')
            $('#searchKeyword').val('');
            $('.search-product-container').html("")

        }

        //================ Search Product ================//

        //================ Cash On Delivery Order ===============//
        function cashOnDelivery() {
            let shipping_charge = document.getElementById('area').value
            let hasAddress = document.getElementById('hasAddress').value
            if (shipping_charge == '0') {
                toastr.error('Select Delivery Area!')
            } else if (hasAddress == '0') {
                toastr.error('Shipping Address Required!')
            } else {
                axios.post("{{ route('frontend.cod.ordernow') }}", {
                    payment_method: 'COD'
                }).then(codOrderRes => {
                    toastr.success(codOrderRes.data.success)
                    getCartContent();
                    getCartPageContent();
                    window.location.href = "{{ route('frontend.myaccount.page') }}"

                })
            }
        }
        //================ End Cash On Delivery Order ===============//

        //================ Online Payment Order ===============//
        function onlinePaymentOrder() {
            let shipping_charge = document.getElementById('area').value
            let hasAddress = document.getElementById('hasAddress').value

            if (shipping_charge == '0') {
                toastr.warning('Select Delivery Area!')
            } else if (hasAddress == '0') {
                toastr.warning('Shipping Address Required!')
            } else {
                window.location.href = "{{ route('online.payment') }}"
            }
        }
        //================ End Online Payment Order ===============//

        //======= Banner Slider Swiper ============= //
        let bannerSwiper = new Swiper(".bannerSwiper", {
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".feature-swiper-button-next",
                prevEl: ".feature-swiper-button-prev",
            },
        });
        // Stop the slider when the mouse enters the swiper container
        document.querySelector('.bannerSwiper').addEventListener('mouseenter', function() {
            bannerSwiper.autoplay.stop();
        });
        // Restart the slider when the mouse leaves the swiper container
        document.querySelector('.bannerSwiper').addEventListener('mouseleave', function() {
            bannerSwiper.autoplay.start();
        });
        //======= End Banner Slider Swiper ============= //

        //======== Feature Product Swiper Slider ==============//
        let featureProductSlider = new Swiper(".featureProductSlider", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            speed: 500,
            navigation: {
                nextEl: ".feature-swiper-button-next",
                prevEl: ".feature-swiper-button-prev",
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                "@1.50": {
                    slidesPerView: 5,
                    spaceBetween: 10,
                },
            },
        });
        // Stop the slider when the mouse enters the swiper container
        document.querySelector('.featureProductSlider').addEventListener('mouseenter', function() {
            featureProductSlider.autoplay.stop();
        });
        // Restart the slider when the mouse leaves the swiper container
        document.querySelector('.featureProductSlider').addEventListener('mouseleave', function() {
            featureProductSlider.autoplay.start();
        });
        //======== End Feature Product Swiper Slider ==============//

        //============= Hot Deal Swiper Slider ==================//
        let hotDealSlider = new Swiper(".hotDealSlider", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            speed: 500,
            navigation: {
                nextEl: ".hotdeal-swiper-button-next",
                prevEl: ".hotdeal-swiper-button-prev",
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                "@1.50": {
                    slidesPerView: 5,
                    spaceBetween: 10,
                },
            },
        });
        // Stop the slider when the mouse enters the swiper container
        document.querySelector('.hotDealSlider').addEventListener('mouseenter', function() {
            hotDealSlider.autoplay.stop();
        });
        // Restart the slider when the mouse leaves the swiper container
        document.querySelector('.hotDealSlider').addEventListener('mouseleave', function() {
            hotDealSlider.autoplay.start();
        });
        //============= End Hot Deal Swiper Slider ==================//

        //============= Best Selling Swiper Slider ==================//
        let bestSellingSlider = new Swiper(".bestSellingSlider", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            speed: 500,
            navigation: {
                nextEl: ".bestselling-swiper-button-next",
                prevEl: ".bestselling-swiper-button-prev",
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                "@1.50": {
                    slidesPerView: 5,
                    spaceBetween: 10,
                },
            },
        });
        // Stop the slider when the mouse enters the swiper container
        document.querySelector('.bestSellingSlider').addEventListener('mouseenter', function() {
            bestSellingSlider.autoplay.stop();
        });
        // Restart the slider when the mouse leaves the swiper container
        document.querySelector('.bestSellingSlider').addEventListener('mouseleave', function() {
            bestSellingSlider.autoplay.start();
        });
        //============= End Best Selling Swiper Slider ==================//
    </script>
    @yield('js')
</body>

</html>
