@extends('backend.layout.app')
@section('title', 'Orderd')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Orders</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Orders
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <h4>Orders</h4>
                        <!-- datatable start -->
                        <table id="data-table" class="table text-center table-bordered table-hover table-striped w-100">
                            <thead class="bg-primary-600">
                            <tr>
                                <th>SL</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>TRN ID</th>
                                <th>Pay Method</th>
                                <th>Payable Amount</th>
                                <th>Payment Status</th>
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
                    url: "{{route('backend.order.data')}}",
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
                        data: 'order_number',
                        name: 'order_number',
                        searchable: true,
                        width: "6%",
                        orderable: false
                    },
                    {
                        data: 'order_date',
                        name: 'order_date',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'tnx_id',
                        name: 'tnx_id',
                        searchable: true,
                        orderable: false,
                        width: "6%",
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'payable_amount',
                        name: 'payable_amount',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
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
                    // window.location = "/admin/brand/"+id+"/delete"
                }
            }); //alert ends
        }


    </script>

@endsection
