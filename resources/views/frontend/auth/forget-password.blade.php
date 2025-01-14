@extends('frontend.layout.app')
@section('title', 'Forget Password')
@section('content')
    <div class="flex items-center justify-center pt-16 pb-44">
        <div class="p-6 w-full max-w-md">
            <div class="flex flex-col text-center mb-10 gap-4">
               <h4 class="font-bold text-[#404040] tracking-[3px]">FORGOT PASSWORD?</h4>
                <hr>
                <p class="text-sm text-[#5e5e5e]">Please enter your email address below to receive a password reset link.</p>
            </div>
            <div id="loginForm" class="space-y-8">
                <div>
                    <input type="email" placeholder="Email address" class="w-full p-3 border rounded-md focus:outline-none">
                </div>
                <button class="w-full py-3 bg-theme text-white hover:bg-white border border-b-theme hover:border hover:border-theme hover:text-theme font-semibold duration-300 rounded-md">Continue</button>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
