@extends('frontend.layout.app')
@section('title', 'Customer Login')
@section('content')
    <div class="flex items-center justify-center py-20">
        <div class="p-6 w-full max-w-md">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="px-4 py-6  bg-white rounded-xl shadow-lg hover:bg-orange-100">
                    <div class="flex justify-center items-center mb-10">
                        <button id="loginTab"
                            class="w-full py-1 px-4 border-b-[3px] border-b-theme text-theme font-bold uppercase focus:outline-none block text-center">Login
                            Information</button>
                    </div>
                    <div id="loginForm" class="space-y-4">
                        <div>
                            <input type="email" name="email" placeholder="Enter email address"
                                class="w-full px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md"
                                required>
                        </div>
                        <div>
                            <input type="password" name="password" placeholder="Enter your password"
                                class="w-full px-3 py-2 focus:outline focus:outline-orange-500 border border-orange-400 rounded-md"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full py-3 bg-theme text-white border border-theme rounded-md hover:bg-white hover:border hover:border-theme hover:text-theme font-semibold duration-300">Login</button>
                        <div class="flex flex-col gap-4 text-center">
                            <a href="{{ route('user.forget.password') }}" class="text-sm text-theme">Forgot your
                                password?</a>
                        </div>
                        <div class="flex space-x-2 justify-center">
                            <span class="text-theme text-xs">Dont have an account?</span> <a href="{{ route('login') }}"
                                class="text-sm text-gray-600 font-semibold">SingUp</a>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-grow h-px bg-gray-300"></div>
                            <span class="mx-4 text-gray-600">or</span>
                            <div class="flex-grow h-px bg-gray-300"></div>
                        </div>
                        <div class="flex justify-center content-center gap-3">
                            <button type="submit"
                            class="px-2 py-2 bg-theme text-white border border-theme rounded-md hover:bg-white hover:border hover:border-theme hover:text-theme font-semibold duration-300">Google</button>
                            <button type="submit"
                            class="px-2 py-2 bg-theme text-white border border-theme rounded-md hover:bg-white hover:border hover:border-theme hover:text-theme font-semibold duration-300">Faceboox</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
