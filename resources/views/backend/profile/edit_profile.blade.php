@extends('backend.layout.app')
@section('title', 'Profile')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Profile</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Profile
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <h4>Profile</h4>
                        <form action="{{ route('backend.admin.update_profile') }}" method="POST" id="form">
                            @csrf @method('POST')
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" id="name" placeholder="Enter your name" value="{{ Auth::guard('admin')->user()->name }}" type="text" name="name">
                                @error('name')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" readonly id="email" value="{{ Auth::guard('admin')->user()->email }}" type="email" name="email">
                                @error('email')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="mt-4 text-right">
                                <button type="submit" id="form_button" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>

        {{--// Verify token--}}
        {{--if (!localStorage.getItem('access_token')){--}}
        {{--    window.location = "{{route('admin.login')}}";--}}
        {{--}--}}

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Sweetalert
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
        // Sweetalert

    </script>

@endsection
