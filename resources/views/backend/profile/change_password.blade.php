@extends('backend.layout.app')
@section('title', 'Change Password')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Change Password</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Change Password
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <h4>Change Password</h4>
                        <form action="{{ route('backend.admin.update-change-password') }}" method="POST" id="form">
                            @csrf @method('POST')
                            <div class="form-group">
                                <label class="form-label" for="old_password">Old Password</label>
                                <input class="form-control" id="old_password" placeholder="******" type="password" name="old_password">
                                @error('old_password')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">New Password</label>
                                <input class="form-control" id="password" placeholder="******" type="password" name="password">
                                @error('new_password')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input class="form-control" id="password_confirmation" placeholder="******" type="password" name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                                <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">
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
