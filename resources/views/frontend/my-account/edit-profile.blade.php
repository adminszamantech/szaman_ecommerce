@extends('frontend.layout.app')
@section('title', 'Edit Profile | My Account')
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
                <h3 class="text-2xl font-semibold">Edit Profile</h3>
            </div>
            <form action="{{ route('frontend.myaccount.update.profile', $profile->id) }}" enctype="multipart/form-data" method="POST">
                @method('POST') @csrf
                <div class="grid grid-cols-12 gap-4 px-4">
                    <div class="col-span-6">
                        <div class="flex flex-col gap-1">
                            <label>Name</label>
                            <input type="text" name="name"  value="{{ $profile->name }}" class="focus:outline px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md"  placeholder="Full Name..." required>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex flex-col gap-1">
                            <label>Email</label>
                            <input type="email" name="email" class="px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md" value="{{ $profile->email }}" placeholder="Email..." required>
                            @error('email')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex flex-col gap-1">
                            <label>Phone</label>
                            <input type="text" name="phone" class="px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md"  value="{{ $profile->phone }}" placeholder="Phone..." required>
                            @error('phone')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex flex-col gap-1">
                            <label>Profile Image</label>
                            <input type="file" name="image" class="px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md" placeholder="profile image">

                        </div>
                    </div>
                    <div class="col-span-12">
                        <button type="submit" class="bg-theme px-4 py-2 w-full text-xl text-white rounded">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script>

    </script>
@endsection
