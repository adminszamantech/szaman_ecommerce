@extends('backend.layout.app')
@section('title', 'Site Setting')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Site Setting</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
               Site Setting
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">

                                <h4>Site Setting</h4>
                                <form action="{{ route('backend.setting.site_setting') }}" id="form" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="site_name">Site Title</label>
                                                <input type="text" name="site_name" class="form-control" value="{{ isset($site_setting->site_name) ? $site_setting->site_name : '' }}" id="site_name" placeholder="Enter site title..."  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="site_email">Site Email</label>
                                                <input type="email" name="site_email" class="form-control" value="{{ isset($site_setting->site_email) ? $site_setting->site_email : '' }}" id="site_email" placeholder="Enter site email (ex: site@example.com)..."  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="site_phone">Site Phone</label>
                                                <input type="text" type="text" name="site_phone" class="form-control" value="{{ isset($site_setting->site_phone) ? $site_setting->site_phone : '' }}" id="site_phone" placeholder="Enter site phone (ex: 01700000000)..."  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="site_address">Site Address</label>
                                                <input type="text" name="site_address" class="form-control" value="{{ isset($site_setting->site_address) ? $site_setting->site_address : '' }}" id="site_address" placeholder="Enter site address (ex: 93, Kazi Nazrul Islam Avenue, Kawran Bazar)..."  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Logo</label>
                                                <input class="form-control" id="image" type="file" name="image">
                                            </div>
                                            <div class="col-md-6">
                                                <p>Logo Image Preview</p>
                                                <img src="" width="200" id="imagePreview" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Favicon</label>
                                                <input class="form-control" id="favicon" type="file" name="favicon">
                                            </div>
                                            <div class="col-md-6">
                                                <p>Favicon Image Preview</p>
                                                <img src="" width="200" id="faviconImagePreview" alt="">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Currency</label>
                                                <input class="form-control" placeholder="Enter currency..." value="{{ isset($site_setting->currency) ? $site_setting->currency : '' }}" type="text" name="currency">
                                            </div>

                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Vat</label>
                                                <input class="form-control" placeholder="Enter vat..." value="{{ isset($site_setting->vat) ? $site_setting->vat : '' }}" type="text" name="vat">
                                            </div>
                                        </div>



                                    </div>
                                    <div class="mt-4 text-right">
                                        <button type="submit" id="form_button" class="btn btn-success">Update</button>
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

        // Logo Image Preview
        $('#image').change(function(){
            let reader = new FileReader();

            reader.onload = (e) => {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
        // Favicon Image Preview
        $('#favicon').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#faviconImagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });



    </script>

@endsection
