@extends('backend.layout.app')
@section('title', 'Edit Attribute')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/inputTags.min.css') }}">
@endsection
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.attribute.index') }}">Attribute</a></li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Edit Attribute
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">

                                <h4>Edit Attribute</h4>
                                <form id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Attribute Name</label>
                                                <input class="form-control" id="name" value="{{ $attribute->name }}" placeholder="Ex: Color" type="text" name="name">
                                                @error('name')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="attribute">Attribute</label>
                                                <input class="form-control" value="{{ $attribute->attributes }}" id="attribute" type="text" name="attribute">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-right">
                                        <input type="hidden" value="{{ $attribute->id }}" name="attribute_id" id="attribute_id">
                                        <button type="button" id="form_button" class="btn btn-success">Save</button>
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
    <script src="{{ asset('backend/assets/js/inputTags.jquery.min.js') }}"></script>
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

        $('#attribute').inputTags({
            max: 20,
            minLength: 1,
            maxLength: 100,
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

        $('#form_button').click(function (e){
            e.preventDefault();
            let name = $('#name').val();
            let attribute = $('#attribute').val();
            let attribute_id = $('#attribute_id').val();
            if (!name.length > 0){
                Toast.fire({
                    icon: "error",
                    title: "Attribute name is required!"
                });
            }else if(!attribute.length > 0){
                Toast.fire({
                    icon: "error",
                    title: "Attribute value is required!"
                });
            }else{

                const data = {
                    name: name,
                    attribute: attribute
                }
                axios.post('/admin/attribute/'+attribute_id+'/update', data).then(response => {
                    $('#form')[0].reset();
                    Toast.fire({
                        icon: "success",
                        title: "Updated successfully!"
                    });
                    setTimeout(()=> {
                        window.location = "{{ route('backend.attribute.index') }}"
                    },1000)
                })
            }


        });

    </script>

@endsection
