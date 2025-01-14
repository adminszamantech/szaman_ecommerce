@extends('backend.layout.app')
@section('title', 'Category')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Category</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Category
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

                                <h4>Add Category</h4>
                                <form action="{{ route('backend.category.store') }}" id="form" enctype="multipart/form-data" method="post">
                                    @csrf @method('POST')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Category name</label>
                                                <input class="form-control" id="name" placeholder="Ex: Laptop" type="text" name="name">
                                                @error('name')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Image</label>
                                                <input class="form-control" id="image" type="file" name="image">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-4">
                                                <p>Preview</p>
                                                <img src="" width="200" id="imagePreview" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-right">
                                        <button type="submit" id="form_button" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h4>Category List</h4>
                                <!-- datatable start -->
                                <table id="data-table" class="table text-center table-bordered table-hover table-striped w-100">
                                    <thead class="bg-primary-600">
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Image</th>
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

        $(document).ready(function() {

            var table = $('#data-table').removeAttr('width').DataTable({
                processing: true,
                serverSide: true,
                scrollX: false,
                pageLength: 10,
                ordering: true,
                responsive : true,
                searching : true,
                bDestroy : true,
                lengthChange : false,
                sorting : true,
                ajax: {
                    url: "{{route('backend.category.data')}}",
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
                        data: 'image',
                        name: 'image',
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
                    window.location = "/admin/category/"+id+"/delete"
                }
            }); //alert ends
        }


    </script>

@endsection
