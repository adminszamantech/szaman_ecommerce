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
                <h3 class="text-2xl font-semibold">All Orders</h3>
            </div>
            <div class="overflow-x-auto px-4">
                <table class=" min-w-full border-collapse border border-slate-700">
                    <thead class="bg-slate-200">
                        <tr>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">SL</th>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Invoice No</th>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Order Date</th>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Tnx ID</th>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Payable Amount</th>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Pay Method</th>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Payment Status</th>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Order Status</th>
                            <th class="border border-slate-300 py-1 px-2 whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($orders) > 0)
                        @foreach($orders as $key => $order)
                            <tr class="text-center">
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ $key+1 }}</td>
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ $order->order_number }}</td>
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ date('d-F-Y', strtotime($order->order_date)) }}</td>
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ $order->tnx_id }}</td>
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">{{ number_format($order->payable_amount) }} ৳</td>
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">
                                    @if($order->payment_method == 1)
                                        <span>Online</span>
                                    @else
                                        <span>COD</span>
                                    @endif
                                </td>
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">
                                    @if($order->payment_status == 1)
                                        <span class="bg-green-700 text-white px-4 rounded m-0 pb-1"><small class="m-0">Paid</small></span>
                                    @else
                                        <span class="bg-slate-600 text-white px-4 pb-1 rounded m-0"><small class="m-0">Unpaid</small></span>
                                    @endif
                                </td>
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">
                                    @if($order->payment_status == 0)
                                        <span class="bg-theme text-white px-4 rounded m-0 pb-1"><small class="m-0">Initiated</small></span>
                                    @elseif($order->payment_status == 1)
                                        <span class="bg-fuchsia-500 text-white px-4 pb-1 rounded m-0"><small class="m-0">Confirmed</small></span>
                                    @elseif($order->payment_status == 2)
                                        <span class="bg-amber-500 text-white px-4 pb-1 rounded m-0"><small class="m-0">Processing</small></span>
                                    @elseif($order->payment_status == 3)
                                        <span class="bg-lime-500 text-white px-4 pb-1 rounded m-0"><small class="m-0">Picked</small></span>
                                    @elseif($order->payment_status == 4)
                                        <span class="bg-teal-500 text-white px-4 pb-1 rounded m-0"><small class="m-0">Shipped</small></span>
                                    @elseif($order->payment_status == 5)
                                        <span class="bg-green-500 text-white px-4 pb-1 rounded m-0"><small class="m-0">Delivered</small></span>
                                    @elseif($order->payment_status == 6)
                                        <span class="bg-red-600 text-white px-4 pb-1 rounded m-0"><small class="m-0">Cancelled</small></span>
                                    @elseif($order->payment_status == 7)
                                        <span class="bg-sky-500 text-white px-4 pb-1 rounded m-0"><small class="m-0">Refunded</small></span>
                                    @else
                                        <span class="bg-rose-500 text-white px-4 pb-1 rounded m-0"><small class="m-0">Returned</small></span>
                                    @endif
                                </td>
                                <td class="border border-slate-300 py-2 px-2 whitespace-nowrap">
                                    <a href="{{ route('frontend.myaccount.orderdetail', $order->order_number) }}" class="bg-theme px-3 py-1 hover:text-black text-white rounded"><i class="fa-regular fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
