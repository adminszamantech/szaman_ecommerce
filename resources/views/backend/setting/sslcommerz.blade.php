@extends('backend.layout.app')
@section('title', 'SSLCommerz Credentials')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/inputTags.min.css') }}">
@endsection
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.attribute.index') }}">SSLCommerz</a></li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">
                                <h4> SSLCommerz Credentials</h4>
                                <form id="form" method="POST" action="{{ route('backend.setting.sslcommerz.store') }}">
                                    @csrf @method('POST')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="store_id">Store ID</label>
                                                <input class="form-control" id="store_id" value="{{ !empty($sslcommerz->store_id) ? $sslcommerz->store_id : '' }}" placeholder="Enter store id" type="password" name="store_id">
                                                @error('store_id')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="store_password">Store Password</label>
                                                <input class="form-control" value="{{ !empty($sslcommerz->store_password) ? $sslcommerz->store_password : '' }}" placeholder="Store password" id="store_password" type="password" name="store_password">
                                                @error('store_password')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="is_live">Sandbox</label>
                                                <select class="form-control select2" name="is_live" id="is_live">
                                                    <option value="">---Select---</option>
                                                    <option value="0" @if(isset($sslcommerz->is_live) && $sslcommerz->is_live == 0) selected @endif>Test Mode</option>
                                                    <option value="1" @if(isset($sslcommerz->is_live) && $sslcommerz->is_live == 1) selected @endif>Live</option>
                                                </select>
                                                @error('is_live')
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')


@endsection
