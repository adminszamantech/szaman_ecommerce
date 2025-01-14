@extends('backend.layout.app')
@section('title', 'Order Detail')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Order</a></li>
        <li class="breadcrumb-item"> {{$order->order_number}}</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Order Detail
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="order_information">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h2 class="text-center mb-0 text-white">Order Information</h2>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="h5">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Order ID</td>
                                                        <td>{{ $order->order_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order Date</td>
                                                        <td>{{ date('d-F-Y', strtotime($order->order_date)) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Transaction ID</td>
                                                        <td>{{ $order->tnx_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payment Method</td>
                                                        <td>{{ $order->payment_method }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payable Amount</td>
                                                        <td>{{ $order->payable_amount }} Taka</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payment Status</td>
                                                        <td>
                                                            @if($order->payment_status == 1)
                                                                <span class="badge badge-info">Paid</span>
                                                            @else
                                                                <span class="badge badge-warning">Unpaid</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="billing_information">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h2 class="text-center mb-0 text-white">Billing Information</h2>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="font-italic h4">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Customer Name</td>
                                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone</td>
                                                        <td>{{ $user->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>{{ $user->email }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="Shipping_information">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h2 class="text-center mb-0 text-white">Shipping Information</h2>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="font-italic h4">
                                                {{$order->shipping_address->address_line_one}},<br>
                                                {{$order->shipping_address->post_office}},  {{$order->shipping_address->thana}}, <br>
                                                {{$order->shipping_address->district}}-{{$order->shipping_address->postal_code}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <div class="order_items">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h2 class="text-center mb-0 text-white">Order Item List</h2>
                                        </div>
                                        <div class="card-body text-center">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Image</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                                @foreach($order->order_detail as $key => $product)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td><img src="{{ asset('/storage/product/'.$product->image) }}" width="50" alt=""></td>
                                                        <td>{{ $product->product_name }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->qty }}</td>
                                                        <td>{{ $product->subtotal }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="5" class="text-right"><b>Shipping Charge</b></td>
                                                    <td><b>{{ $order->shipping_charge }}.00</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-right"><b>Total</b></td>
                                                    <td><b>{{ $order->payable_amount }} Taka</b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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




    </script>

@endsection
