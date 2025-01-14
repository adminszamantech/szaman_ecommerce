@extends('backend.layout.app')
@section('title', 'Product list')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Product</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Products
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <h4>Product List <a class="float-right btn btn-sm btn-info" href="{{ route('backend.product.create') }}">Add Product</a></h4>
                        <!-- datatable start -->
                        <table id="data-table" class="table text-center table-bordered table-hover table-striped w-100">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>Stock</th>
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
                    url: "{{route('backend.product.getdata')}}",
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
                        width: "5%",
                        orderable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
                        searchable: true,
                        width: "20%",
                        orderable: false
                    },
                    {
                        data: 'category',
                        name: 'category',
                        width: "8%",
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'sub_category',
                        name: 'sub_category',
                        width: "8%",
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'brand',
                        name: 'brand',
                        width: "5%",
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        width: "5%",
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'stock',
                        name: 'stock',
                        width: "5%",
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'feature_image',
                        name: 'feature_image',
                        width: "8%",
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        width: "10%",
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
                    // window.location = "/admin/brand/"+id+"/delete"
                }
            }); //alert ends
        }


    </script>

@endsection
