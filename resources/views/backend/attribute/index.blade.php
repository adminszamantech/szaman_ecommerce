@extends('backend.layout.app')
@section('title', 'Attribute')
@section('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/inputTags.min.css') }}">
@endsection
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Attribute</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Attribute
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

                                <h4>Add Attribute</h4>
                                <form id="form">
                                    @csrf @method('POST')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Attribute Name</label>
                                                <input class="form-control" id="name" placeholder="Ex: Color" type="text" name="name">
                                                @error('name')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="attribute">Attribute</label>
                                                <input class="form-control" id="attribute" type="text" name="attribute">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-right">
                                        <button type="button" id="form_button" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h4>Attribute List</h4>
                                <!-- datatable start -->
                                <table id="data-table" class="table text-center table-bordered table-hover table-striped w-100">
                                    <thead class="bg-primary-600">
                                    <tr>
                                        <th>SL</th>
                                        <th>Attribute Name</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <!-- datatable end -->
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
                axios.post('/admin/attribute/store', data).then(response => {
                    $('#form')[0].reset();
                    Toast.fire({
                        icon: "success",
                        title: "Data stored successfully!"
                    });
                    setTimeout(() => {
                        window.location = "{{ route('backend.attribute.index') }}"
                    },1000)

                    {{--console.log(response.data)--}}
                })
            }


        });

        $(document).ready(function() {

            var table = $('#data-table').removeAttr('width').DataTable({
                processing: true,
                serverSide: true,
                scrollX: false,
                pageLength: 10,
                ordering: true,
                responsive : true,
                searching : false,
                bDestroy : true,
                lengthChange : false,
                sorting : true,
                ajax: {
                    url: "{{route('backend.attribute.getdata')}}",
                    type: "GET",
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    },
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        class: "text-center",
                        orderable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'attribute',
                        name: 'attribute',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    }
                ]
            });

        });

        function delete_alert(id) {
            Swal.fire({
                title: "Are you sure to delete?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    window.location = "/admin/attribute/destroy/"+id
                }
            }); //alert ends
        }

    </script>

@endsection
