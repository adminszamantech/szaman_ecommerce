@extends('frontend.layout.app')
@section('title', 'Address | My Account')
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
        <div class="col-span-12 md:col-span-9">
            <div class="rounded border border-theme pb-12">
                <div class="profile_heading text-center py-4 text-theme">
                    <h3 class="text-2xl font-semibold">Edit Profile</h3>
                </div>
                <form action="{{ route('frontend.myaccount.address.update') }}" method="POST">
                    @method('POST') @csrf
                    <div class="grid grid-cols-12 gap-4 px-4">
                        <div class="col-span-6">
                            <div class="flex flex-col gap-1">
                                <label for="address_line_one">Address Line One</label>
                                <input type="text" required="required" id="address_line_one" value="{{ $address->address_line_one }}" class="focus:outline px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md" name="address_line_one" placeholder="Address Line One">
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex flex-col gap-1">
                                <label for="thana">Thana</label>
                                <input type="text" id="thana" required="" class="focus:outline px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md" name="thana" value="{{ $address->thana }}" placeholder="thana">
                                @error('thana')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex flex-col gap-1">
                                <label for="post_office">Post Office</label>
                                <input type="text" required="required" id="post_office" value="{{ $address->post_office	 }}" class="focus:outline px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md" name="post_office" placeholder="Post office">
                                @error('post_office')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex flex-col gap-1">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" required="" id="postal_code" class="focus:outline px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md" name="postal_code" value="{{ $address->postal_code }}" placeholder="Postal Code">
                                @error('postal_code')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex flex-col gap-1">
                                <label for="district">District</label>
                                <input type="text" required="" id="district" class="focus:outline px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md" name="district" value="{{ $address->district }}" placeholder="District">
                                @error('district')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-12">
                            <button type="submit" class="bg-theme px-4 py-2 w-full text-xl text-white rounded">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

    </script>
@endsection
