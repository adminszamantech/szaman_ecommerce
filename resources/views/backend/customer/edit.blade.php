@extends('backend.layout.app')
@section('title', 'Customer edit')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.customer.index') }}">Customer</a></li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">

                                <h4> Customer Update</h4>
                                <form id="form" method="POST" action="{{ route('backend.customer.update', $customer->id) }}">
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="first_name">First Name</label>
                                                <input class="form-control" id="first_name" value="{{ $customer->first_name }}" placeholder="First name" type="text" name="first_name">
                                                @error('first_name')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                         <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="last_name">Last Name</label>
                                                <input class="form-control" id="last_name" value="{{$customer->last_name }}" placeholder="Last name" type="text" name="last_name">
                                                @error('last_name')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="email">Email</label>
                                                <input class="form-control" id="email" value="{{ $customer->email }}" placeholder="examle@gmail.com" type="email" name="email">
                                                @error('email')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="phone">Phone</label>
                                                <input class="form-control" id="phone" value="{{ $customer->phone }}" placeholder="+88017343254" type="text" name="phone">
                                                @error('phone')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="address">Address</label>
                                                <textarea name="address" class="form-control" id="address" cols="10" rows="4">{{ $customer->address }}</textarea>
                                                @error('address')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="status">Status</label>
                                                <select name="status" id="status" class="form-control select2">
                                                    <option value="1" @if($customer->status === 1) selected @endif>Active</option>
                                                    <option value="0" @if($customer->status === 0) selected @endif>Inactive</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>

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
        </div>
    </div>

@endsection
@section('js')

    <script>

        // Verify token
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



        function delete_alert(id) {
            Swal.fire({
                title: "Are you sure to delete?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    window.location = "/admin/shipping-charge/destroy/"+id
                }
            }); //alert ends
        }

    </script>

@endsection
