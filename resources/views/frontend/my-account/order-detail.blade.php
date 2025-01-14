@extends('frontend.layout.app')
@section('title', 'Dashboard | My Account')
@section('content')
    <div class="grid grid-cols-12 py-4 gap-6">
        <div class="col-span-12">
            <h2 class="font-semibold">My Account</h2>
        </div>
        <div class="col-span-12 md:col-span-3 border border-theme rounded">
            <div class="flex flex-col gap-4 py-4">
                <div class="profile">
                    <div class="profile_pic_content flex flex-col justify-center items-center gap-3">
                        <div class="profile_pic">
                            <img class="rounded-full w-40" src="{{ asset('storage/profile/'.auth()->user()->image) }}" alt="">
                        </div>
                        <div class="profile_name">
                            <h5 class="text-xl text-theme font-semibold">{{ auth('web')->user()->first_name }} {{ auth('web')->user()->name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="menu-list ">
                    <ul class="px-4 py-2">
                        <li class="border-b border-b-[#ced4da]">
                            <a href="{{ route('frontend.myaccount.page') }}" class="@if(request()->is('my-account')) text-theme @endif py-2 text-sm uppercase block hover:text-theme">
                                <i class="fa-solid fa-table-cells-large mr-1"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="border-b border-b-[#ced4da]">
                            <a href="{{ route('frontend.myaccount.view_profile') }}" class="@if(request()->is('my-account/profile')) text-theme @endif py-2 text-sm uppercase block hover:text-theme ">
                                <i class="fa-regular fa-user mr-1"></i>
                                Profile
                            </a>
                        </li>
                        <li class="border-b border-b-[#ced4da]">
                            <a href="{{ route('frontend.myaccount.view_profile.edit') }}" class="@if(request()->is('my-account/profile/edit')) text-theme @endif py-2 text-sm uppercase block hover:text-theme">
                                <i class="fa-regular fa-pen-to-square mr-1"></i>
                                Edit Profile
                            </a>
                        </li>
                        <li class="border-b border-b-[#ced4da]">
                            <a href="{{ route('frontend.myaccount.address.view') }}" class="@if(request()->is('my-account/address')) text-theme @endif py-2 text-sm uppercase block hover:text-theme">
                                <i class="fa-solid fa-location-dot mr-1"></i>
                                Address
                            </a>
                        </li>
                        <li class="border-b border-b-[#ced4da]">
                            <a href="{{ route('frontend.myaccount.change_password') }}" class="@if(request()->is('my-account/change-password')) text-theme @endif py-2 text-sm uppercase block hover:text-theme">
                                <i class="fa-solid fa-key mr-1"></i>
                                Change Password
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.logout') }}" class="py-2 text-sm uppercase block hover:text-theme">
                                <i class="fa-solid fa-right-from-bracket mr-1"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-9 border border-theme py-3">

            <div class="profile_heading text-center pb-3 pt-0 md:py-4 text-theme">
                <h3 class="text-2xl font-semibold">Order Detail</h3>
            </div>
            <div class="overflow-x-auto px-4 py-6">
                <table class=" min-w-full border-collapse border border-slate-700">
                    <thead class="">
                    <tr>
                        <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">SL</th>
                        <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Image</th>
                        <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Product</th>
                        <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Quantity</th>
                        <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Price</th>
                        <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Total</th>

                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach($order_detail->order_detail as $key => $detail)
                        @php $subtotal +=$detail->subtotal  @endphp
                        <tr class="text-center">
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ $key+1 }}</td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">
                                <img src="{{ asset('/storage/product/'. $detail->image) }}" width="80" class="inline-block text-center" alt="">
                            </td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ $detail->product_name }}</td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ $detail->qty }}</td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ number_format($detail->price) }} ৳</td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ number_format($detail->subtotal) }} ৳</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap" colspan="4"></td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap font-bold">Sub Total</td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap font-bold">{{ number_format($subtotal) }} ৳</td>
                        </tr>
                        <tr>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap" colspan="4"></td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap font-bold">Discount</td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap font-bold">0 ৳</td>
                        </tr>
                        <tr>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap" colspan="4"></td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap font-bold">Shipping Cost</td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap font-bold">{{ number_format($order_detail->shipping_charge) }} ৳</td>
                        </tr>
                        <tr>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap" colspan="4"></td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap font-bold">Total Payable</td>
                            <td class="border border-slate-300 py-2 px-2 whitespace-nowrap font-bold">{{ number_format($order_detail->payable_amount) }} ৳</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

    </script>
@endsection
