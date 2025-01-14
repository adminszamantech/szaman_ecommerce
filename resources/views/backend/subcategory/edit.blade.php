@extends('backend.layout.app')
@section('title', 'Edit Subcategory')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Edit Subcategory</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Edit Subcategory
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

                                <h4>Edit Subcategory</h4>
                                <form action="{{ route('backend.subcategory.update', $subcategory->id) }}" id="form" enctype="multipart/form-data" method="post">
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="category_id">Category</label>
                                                <select class="form-control select2" name="category_id" id="category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option @if($subcategory->category_id === $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Subcategory</label>
                                                <input class="form-control" id="name" value="{{ $subcategory->name }}" placeholder="Ex: Laptop" type="text" name="name">
                                                @error('name')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Image</label>
                                                <input class="form-control" id="image" type="file" name="image">
                                            </div>
                                        </div>
                                        @if($subcategory->image !== null)
                                            <div class="col-md-3">
                                                <p>Image Preview</p>
                                                <img src="{{ asset('storage/subcategory/'.$subcategory->image) }}" width="200" id="imagePreview" alt="">
                                            </div>
                                        @else
                                            <div class="col-md-3">
                                                <div class="col-md-4">
                                                    <p>Image Preview</p>
                                                    <img src="" width="200" id="imagePreview" alt="">
                                                </div>
                                            </div>
                                        @endif
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
