@extends('frontend.layout.app')
@section('title', 'Checkout')
@section('content')
    <div class="cart-container py-3 md:py-16">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-6 bg-white shadow-lg p-6">
                <div class="flex flex-col gap-6" id="shipping_container">
                    <div class="billing_container border border-theme my-4 relative">
                        <div
                            class="customer_info text-center text-2xl bg-white w-[35%] mx-auto absolute -top-[18px] left-[230px]">
                            <h2>Billing Information</h2>
                        </div>
                        <div class="billing_information text-center py-16 italic font-semibold">
                            <h1 class="text-xl">{{ $customer->name }}</h1>
                            <p>{{ $customer->phone }}</p>
                        </div>
                    </div>



                    <div class="billing_container border border-theme py-8 relative ">
                        <div
                            class="customer_info text-center text-2xl bg-white w-[35%] mx-auto absolute -top-[18px] left-[230px]">
                            <h2>Shipping Address</h2>
                        </div>
                        <span onclick="shippingAddress()"
                            class="absolute top-0 right-0 bg-theme text-white px-3 py-1 cursor-pointer"><i
                                class="far fa-edit"></i></span>
                        <div class="billing_information text-center my-8 italic font-semibold">
                            <div class="text-xl" id="getcustomeraddress">


                            </div>
                        </div>
                    </div>


                    <div class="flex flex-col gap-1 py-2">
                        <label for="area">Delivery Area</label>
                        <select name="area" id="area"
                            class="focus:outline-none border border-gray-300 px-2 py-2 rounded-md">
                            <option value="0">--Select delivery area--</option>
                            @foreach ($shipping_charge as $charge)
                                <option @if (count(Cart::instance('shipping')->content()) > 0 &&
                                        Cart::instance('shipping')->content()->where('id', 'shipping')->first()->price == $charge->amount) selected @endif value="{{ $charge->amount }}">
                                    {{ $charge->shipping_charge_name }}</option>
                            @endforeach
                        </select>
                        <small id="err_area" class="text-red-500"></small>
                    </div>
                </div>


                <div class="customer_form hidden" id="address_form">
                    <div class="flex flex-col gap-1 py-2">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone"
                            class="focus:outline-none border border-gray-300 px-2 py-2 rounded-md"
                            placeholder="Phone">
                        <small id="err_phone" class="text-red-500"></small>
                    </div>
                    <div class="flex flex-col gap-1 py-2">
                        <label for="address_line_one">House/Flat/Road</label>
                        <input type="text" id="address_line_one"
                            class="focus:outline-none border border-gray-300 px-2 py-2 rounded-md"
                            placeholder="House/Flat/Road">
                        <small id="err_address_line_one" class="text-red-500"></small>
                    </div>
                    <div class="flex flex-col gap-1 py-2">
                        <label for="post_office">Post Office</label>
                        <input type="text" id="post_office"
                            class="focus:outline-none border border-gray-300 px-2 py-2 rounded-md"
                            placeholder="Enter post office">
                        <small id="err_post_office" class="text-red-500"></small>
                    </div>
                    <div class="flex flex-col gap-1 py-2">
                        <label for="thana">Thana</label>
                        <input type="text" id="thana"
                            class="focus:outline-none border border-gray-300 px-2 py-2 rounded-md"
                            placeholder="Enter thana">
                        <small id="err_thana" class="text-red-500"></small>
                    </div>
                    <div class="flex flex-col gap-1 py-2">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code"
                            class="focus:outline-none border border-gray-300 px-2 py-2 rounded-md"
                            placeholder="Enter postal code">
                        <small id="err_postal_code" class="text-red-500"></small>
                    </div>
                    <div class="flex flex-col gap-1 py-2">
                        <label for="district">District</label>
                        <input type="text" id="district"
                            class="focus:outline-none border border-gray-300 px-2 py-2 rounded-md"
                            placeholder="Enter district">
                        <small id="err_district" class="text-red-500"></small>
                    </div>
                    <div class="payment_method flex flex-row items-center justify-center gap-4 pt-6 pb-4">
                        <a href="javascript:void(0)" class="px-4 py-1 bg-black text-white font-bold"
                            onclick="cancelShippingAddress()">Cancel</a>
                        <span onclick="updateShippingAddress()"
                            class="px-4 py-1 bg-theme text-white font-bold cursor-pointer">Update</span>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 bg-white shadow-lg p-6">
                <div class="customer_info text-center text-xl md:text-2xl pb-4 md:pb-2">
                    <h2>Order Summary</h2>
                </div>
                <div class="checkout_summary">

                </div>
                <div class="price_summary mt-4">
                    <div class="sub_total flex flex-row justify-between items-center border-b py-2 font-semibold">
                        <span>Sub Total :</span>
                        <span><span class="subTotal"></span> ৳</span>
                    </div>
                    <div class="shipping_charge flex flex-row justify-between items-center border-b py-2 font-semibold">
                        <span>Shipping Charge :</span>
                        <span><span id="shipping_charge">0</span> ৳</span>
                    </div>
                    <div class="discount_amount flex flex-row justify-between items-center border-b py-2 font-semibold">
                        <span>Discount Amount :</span>
                        <span>0 ৳</span>
                    </div>
                    <div class="discount_amount flex flex-row justify-between items-center border-b py-2 font-semibold">
                        <span>Payable Amount :</span>
                        <span><span id="paypalAmount"></span> ৳</span>
                    </div>
                </div>
                <div class="payment_method flex flex-row items-center justify-center gap-4 pt-6 pb-4">
                    <a href="javascript:void(0)" onclick="cashOnDelivery()"
                        class="px-4 py-1 bg-black text-white font-bold">COD</a>

                    <button type="button" class="px-4 py-1 bg-theme text-white font-bold"
                        onclick="onlinePaymentOrder()">Online Payment</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        //================= get cart items ============== //
        const getCheckOutContent = () => {
            axios.get("{{ route('frontend.getcarts') }}").then(getCheckoutContRes => {
                let checkoutCarts = Object.values(getCheckoutContRes.data.cart);
                if (checkoutCarts?.length > 0) {
                    let checkOutItems = '';
                    checkoutCarts.forEach(cartItems => {
                        checkOutItems +=
                            '<div class="grid grid-cols-12 gap-4 md:gap-0 border-b py-2"><div class="col-span-9"><div class="flex flex-row gap-4 "><img src="/storage/product/' +
                            cartItems.options.image + '" width="40" height="40" alt=""><h3>' + cartItems
                            .name + '</h3><span class="font-semibold"><small>' + cartItems.price +
                            ' x ' + cartItems.qty +
                            '</small></span></div></div><div class="col-span-3"><p class="text-right">' +
                            cartItems.subtotal + ' ৳</p></div></div>'
                    })
                    $('.checkout_summary').html(checkOutItems);
                    $('#fix_subtotal_price').text(getCheckoutContRes.data.subtotal);
                    $('.subTotal').text(getCheckoutContRes.data.subtotal.replace(/,/g, ''));
                    $('.item_count').text(getCheckoutContRes.data.total_qty);
                    $('#shipping_charge').text(getCheckoutContRes.data.shipping_charge);
                    $('#paypalAmount').text(parseInt(getCheckoutContRes.data.subtotal.replace(/,/g, '')) +
                        parseInt(getCheckoutContRes.data.shipping_charge))
                } else {
                    $('#fix_subtotal_price').text("0.00")
                    $('.item_count').text(0)
                    $('.subTotal').text('0.00');
                    $('#paypalAmount').text('0.00')
                    $('.checkout_summary').html('<h2 class="text-center text-xl">Cart Empty!</h2>')
                }
            })
        }
        getCheckOutContent();
        //================= get cart items ============== //

        const area = document.getElementById('area');
        area.addEventListener('change', function(event) {
            let shipping = event.target.value
            axios.post('/shippingcharge', {
                amount: parseInt(shipping)
            }).then(shippingRes => {

                let shipping_charge = parseInt(shippingRes.data.price)
                $('#shipping_charge').text(shippingRes.data.price);
                let subtotalClass = document.getElementsByClassName('subTotal')[0].innerText
                let subtotal = parseFloat(subtotalClass.replace(/,/g, ''))
                $('#paypalAmount').text(subtotal + shippingRes.data.price)
            })
        });

        let shipping_container = document.getElementById('shipping_container')
        let address_form = document.getElementById('address_form')
        // =================== Get Customer address ======================= //
        function getCustomerAddress() {
            axios.get('{{ route('get.customer.address') }}').then(getAddressRes => {

                let getCustomerAddress = '';
                if (getAddressRes.data.address_line_one !== null) {
                    $('#phone').val(getAddressRes.data.phone);
                    $('#address_line_one').val(getAddressRes.data.address_line_one);
                    $('#post_office').val(getAddressRes.data.post_office);
                    $('#thana').val(getAddressRes.data.thana);
                    $('#postal_code').val(getAddressRes.data.postal_code);
                    $('#district').val(getAddressRes.data.district);
                    getCustomerAddress += getAddressRes.data?.phone + ',<br>' + getAddressRes.data?.address_line_one + ',<br>' + getAddressRes.data
                        ?.post_office + ', ' + getAddressRes.data?.thana + ',<br>' + getAddressRes.data?.district +
                        '-' + getAddressRes.data?.postal_code + '<input type="hidden" value="1" id="hasAddress">';
                    $('#getcustomeraddress').html(getCustomerAddress);
                } else {
                    getCustomerAddress += '<h2>N/A</h2><input type="hidden" value="0" id="hasAddress">';
                    $('#getcustomeraddress').html(getCustomerAddress);
                }

            })
        }
        getCustomerAddress()
        // ==================== Shipping Address Method ================= //
        function shippingAddress() {
            shipping_container.classList.add('hidden')
            address_form.classList.remove('hidden')
            getCustomerAddress()
        }
        // ==================== Cancel Shipping Address Method ================= //
        function cancelShippingAddress() {
            shipping_container.classList.remove('hidden')
            address_form.classList.add('hidden')
        }

        function updateShippingAddress() {
            // toastr.success('sdfsdf');
            let phone = $('#phone').val();
            let address_line_one = $('#address_line_one').val();
            let post_office = $('#post_office').val();
            let thana = $('#thana').val();
            let postal_code = $('#postal_code').val();
            let district = $('#district').val();
            if(!phone?.length > 0){
                $('#err_phone').text('Enter Phone!');
            } else if (!address_line_one?.length > 0) {
                $('#err_address_line_one').text('Enter address line one!');
            } else if (!post_office?.length > 0) {
                $('#err_post_office').text('Enter post office!');
            } else if (!thana?.length > 0) {
                $('#err_thana').text('Enter thana!');
            } else if (!postal_code?.length > 0) {
                $('#err_postal_code').text('Enter postal code!');
            } else if (!district?.length > 0) {
                $('#err_district').text('Enter district!');
            } else {
                let data = {
                    phone: phone,
                    address_line_one: address_line_one,
                    post_office: post_office,
                    thana: thana,
                    postal_code: postal_code,
                    district: district,
                }
                axios.post('{{ route('update.customer.address') }}', data).then(customerAddressRes => {
                    toastr.success(customerAddressRes.data.success);
                    shipping_container.classList.remove('hidden')
                    address_form.classList.add('hidden')
                    getCustomerAddress()
                })
            }
        }
    </script>

@endsection
