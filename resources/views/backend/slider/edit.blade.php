@extends('backend.layout.app')
@section('title', 'Slider')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Slider</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Slider Edit
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Edit Slider</h4>
                                <form action="{{ route('backend.slider.update', $slider->id) }}" id="form" enctype="multipart/form-data" method="post">
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 pb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Title</label>
                                                <input class="form-control" id="title" placeholder="Ex: Slider 1" value="{{ $slider->title }}" type="text" name="title">
                                                @error('title')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Image</label>
                                                <input class="form-control" id="image" type="file" name="image">
                                                <span class="text-primary"><small>Image Dimensions 1921x581</small></span>
                                                @error('image')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="status">Status</label>
                                                <select name="status" class="form-control select2" id="status">
                                                    <option value="">---Select---</option>
                                                    <option value="1" @if($slider->status === 1) selected @endif>Active</option>
                                                    <option value="0" @if($slider->status === 0) selected @endif>Inactive</option>
                                                </select>
                                                @error('status')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-2">
                                            <div class="col-md-4">
                                                <p>Preview</p>
                                                <img src="{{ asset('/storage/slider/'.$slider->image) }}" width="200" id="imagePreview" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-12 pb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="product_link">Product Link</label>
                                                <input class="form-control" id="product_link" placeholder="{{ route('frontend.home_page') }}/product/product-1" value="{{ $slider->product_link }}" type="text" name="product_link">
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

        // Image Preview
        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });





    </script>

@endsection
