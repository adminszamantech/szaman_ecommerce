@extends('frontend.layout.app')
@section('title', 'Profile | My Account')
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
        <div class="col-span-12 md:col-span-9 border border-theme">

            <div class="profile_heading text-center py-4 text-theme">
                <h3 class="text-2xl font-semibold text-theme">Profile</h3>
            </div>
            <div class="max-w-sm mx-auto bg-gray-100 shadow-lg rounded-lg overflow-hidden mt-1 mb-6">
                <img class="w-full h-56 object-fill" src="{{ asset('storage/profile/'.auth()->user()->image) }}" alt="Profile Image">

                <div class="px-6 py-4">
                  <h2 class="text-2xl font-semibold text-gray-500">{{ $user->name }}</h2>
                  <p class="text-gray-600 text-sm mt-2 text-gray-500">{{ $user->email  }}</p>
                  <p class="text-gray-600 text-sm mt-2 text-gray-500">{{ $user->phone }}</p>
                  <p class="text-gray-600 text-sm mt-2 text-gray-500">{{ $user->address_line_one. ', '. $user->post_office. ', '. $user->thana. ', '. $user->postal_code. ', '. $user->district}}</p>
                </div>

                <div class="px-6 py-4 flex justify-between items-center">
                  <a href="{{ route('frontend.home_page') }}" class="text-theme hover:text-orange-800"> <i class="fa fa-home"></i> Home</a>
                  <a href="{{ route('frontend.myaccount.page') }}" class="text-theme hover:text-orange-800"> <i class="fa fa-list"></i> Orders</a>
                </div>
              </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

    </script>
@endsection
