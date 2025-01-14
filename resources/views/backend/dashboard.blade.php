@extends('backend.layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                <a href="{{ Route::has('employee.index') }}" class="text-white">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <span id="total_employee">0</span>
                        <small class="m-0 l-h-n">All Product</small>
                    </h3>
                </a>
                <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                <a href="{{ Route::has('user.index') }}" class="text-white">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <span id="total_user">0</span>
                        <small class="m-0 l-h-n">Today Order</small>
                    </h3>
                </a>
                <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <span id="today_total_attendance">1</span>
                        <small class="m-0 l-h-n">Total Order</small>
                    </h3>
                </div>
                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                <a href="#">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        0
                        <small class="m-0 l-h-n">Total Earn</small>
                    </h3>
                </a>
                <i class="fal fa-globe position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // Sweetalert
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        let successMessage = "{{ session('success') }}";
        // Login Message
        if (successMessage){
            Toast.fire({
                icon: "success",
                title: successMessage
            });
        }

        {{--// Verify token--}}
        {{--if (!localStorage.getItem('token')){--}}
        {{--    window.location = "{{Route::has('login')}}"--}}
        {{--}--}}


    </script>
@endsection
