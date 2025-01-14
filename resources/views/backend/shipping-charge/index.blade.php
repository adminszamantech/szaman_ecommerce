@extends('backend.layout.app')
@section('title', 'Shipping Charge')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/inputTags.min.css') }}">
@endsection
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.attribute.index') }}">Shipping Charge</a></li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-6">

                                <h4> Shipping Charge</h4>
                                <form id="form" method="POST" action="{{ route('backend.shipping-charge.store') }}">
                                    @csrf @method('POST')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="shipping_charge_name">Shipping charge Name</label>
                                                <input class="form-control" id="shipping_charge_name" value="{{ old('shipping_charge_name') }}" placeholder="Inside Dhaka" type="text" name="shipping_charge_name">
                                                @error('shipping_charge_name')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="amount">Amount</label>
                                                <input class="form-control" value="{{ old('amount') }}" placeholder="60" id="amount" type="text" name="amount">
                                                @error('amount')
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
                            <div class="col-md-6">
                                <h4>Shipping List</h4>
                                <!-- datatable start -->
                                <table id="data-table" class="table text-center table-bordered table-hover table-striped w-100">
                                    <thead class="bg-primary-600">
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Amount</th>
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
                searching : false,
                bDestroy : true,
                lengthChange : false,
                sorting : true,
                ajax: {
                    url: "{{route('backend.shipping-charge.data')}}",
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
                        data: 'shipping_charge_name',
                        name: 'shipping_charge_name',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'amount',
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
                    window.location = "/admin/shipping-charge/destroy/"+id
                }
            }); //alert ends
        }

        {{--$('#form_button').click(function (e){--}}
        {{--    e.preventDefault();--}}
        {{--    let name = $('#name').val();--}}
        {{--    let attribute = $('#attribute').val();--}}
        {{--    let attribute_id = $('#attribute_id').val();--}}
        {{--    if (!name.length > 0){--}}
        {{--        Toast.fire({--}}
        {{--            icon: "error",--}}
        {{--            title: "Attribute name is required!"--}}
        {{--        });--}}
        {{--    }else if(!attribute.length > 0){--}}
        {{--        Toast.fire({--}}
        {{--            icon: "error",--}}
        {{--            title: "Attribute value is required!"--}}
        {{--        });--}}
        {{--    }else{--}}

        {{--        const data = {--}}
        {{--            name: name,--}}
        {{--            attribute: attribute--}}
        {{--        }--}}
        {{--        axios.post('/admin/attribute/'+attribute_id+'/update', data).then(response => {--}}
        {{--            $('#form')[0].reset();--}}
        {{--            Toast.fire({--}}
        {{--                icon: "success",--}}
        {{--                title: "Updated successfully!"--}}
        {{--            });--}}
        {{--            setTimeout(()=> {--}}
        {{--                window.location = "{{ route('backend.attribute.index') }}"--}}
        {{--            },1000)--}}
        {{--        })--}}
        {{--    }--}}


        {{--});--}}

    </script>

@endsection
