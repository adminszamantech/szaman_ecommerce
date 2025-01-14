@extends('backend.layout.app')
@section('title', 'Create Product')
@section('content')

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.product.index') }}">Products</a></li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <small>
                Product
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-5" class="panel py-2">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12 px-6">
                                <h4>Add Product</h4>
                                <form action="{{ route('backend.product.store') }}" method="post" id="form" enctype="multipart/form-data" >
                                    @csrf @method('POST')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group pb-2">
                                                <label class="form-label" for="title">Product Title</label>
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter product title" autocomplete="off">
                                                @error('title')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="description">Description</label>
                                                <textarea name="description" id="description" class="text-editor"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="short_description">Short Description</label>
                                                <textarea name="short_description" id="short_description" class="text-editor"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="category_id">Category</label>
                                                <select name="category_id" class="form-control select2" id="category_id">
                                                    <option value="">Choose category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="subcategory_id">Sub Category</label>
                                                <select name="subcategory_id" class="form-control select2" id="subcategory_id">
                                                    <option value="">Choose subcategory</option>
                                                    @foreach($subcategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('subcategory_id')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="brand_id">Brand</label>
                                                <select name="brand_id" class="form-control select2" id="brand_id">
                                                    <option value="">Choose brand</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('brand_id')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="unit_price">Regular Price</label>
                                                <input type="text" name="unit_price" id="unit_price" class="form-control" placeholder="Enter regular price" autocomplete="off">
                                                @error('unit_price')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="discount">Discount (%)</label>
                                                <input type="text" name="discount" id="discount" class="form-control" placeholder="Ex: 10" autocomplete="off">
                                                @error('discount')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="discount_price">Discount Price</label>
                                                <input type="text" name="discount_price" id="discount_price" class="form-control" readonly autocomplete="off">
                                                @error('discount')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="quantity">Quantity</label>
                                                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Ex: 100" autocomplete="off">
                                                @error('quantity')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h2>Image</h2>
                                            <div class="row" style="border: 1px solid #dcd8d8; padding: 22px 5px 2px 0px">
                                                <div class="col-md-3">
                                                    <div class="form-group pb-4">
                                                        <label class="form-label" for="feature_image">Feature Image</label>
                                                        <input class="form-control" id="feature_image" type="file" name="feature_image">
                                                    </div>
                                                </div>

                                                <div class="col-md-2 pb-2">
                                                    <div class="col-md-4">
                                                        <p>Preview</p>
                                                        <img src="" width="50" id="feature_image_preview" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="closestAdd">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group pb-4">
                                                                    <label class="form-label" for="gallery[]">Gallery</label>
                                                                    <input class="form-control gallery-input" type="file" name="gallery[]">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 pb-2">
                                                                <div class="col-md-4">
                                                                    <p>Preview</p>
                                                                    <img src="" width="50" class="gallery-preview" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button style="margin-top: 25px;" class="btn btn-sm btn-primary addMore" type="button">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12 mt-2 mb-2">
                                            <h2>Attributes</h2>
                                            <div class="row" style="border: 1px solid #dcd8d8; padding: 10px 0px 18px 0px;">
                                                @foreach($attributes as $attribute)
                                                    <div class="col-md-3">
                                                        <label class="form-label"  for="{{ $attribute->name }}">{{ $attribute->name }}
                                                            <input type="hidden" name="variant_name[]" value="{{ $attribute->name }}">
                                                        </label>
                                                        @php
                                                            $attribute_values = explode(',', $attribute->attributes);
                                                        @endphp
                                                        <select name="{{ $attribute->name }}[]" class="select2" id="{{ $attribute->name }}" multiple="multiple">
                                                            @foreach($attribute_values as $attribute_value)
                                                                <option value="{{ $attribute_value }}">{{ $attribute_value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="best_selling">Best Selling</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="best_selling" id="best_selling" value="1">
                                                    <label class="custom-control-label" for="best_selling">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="feature_product">Feature Product</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="feature_product" id="feature_product" value="1">
                                                    <label class="custom-control-label" for="feature_product">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="hot_deal">Hot Deal</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="hot_deal" id="hot_deal" value="1">
                                                    <label class="custom-control-label" for="hot_deal">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="is_publish">Publish</label>
                                                <select name="is_publish" id="is_publish" class="select2 form-control">
                                                    <option value="1">Published</option>
                                                    <option value="0">Unpublished</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pb-4">
                                                <label class="form-label" for="is_active">Status</label>
                                                <select name="is_active" id="is_active" class="select2 form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
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

    <div class="addEventItem" style="display: none">
        <div class="deleteEventItem">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group pb-4">
                        <label class="form-label" for="gallery[]">Gallery</label>
                        <input class="form-control gallery-input" type="file" name="gallery[]">
                    </div>
                </div>

                <div class="col-md-3 pb-2">
                    <div class="col-md-4">
                        <p>Preview</p>
                        <img src="" width="50" class="gallery-preview" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <button style="margin-top: 25px;" class="btn btn-sm btn-primary addMore" type="button">+</button> &nbsp;
                    <button style="margin-top: 25px;" class="btn btn-sm btn-danger deleteItem" type="button">-</button>
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

        // Image Preview
        $('#feature_image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#feature_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
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


        document.addEventListener('DOMContentLoaded', function () {
            const unitPriceInput = document.getElementById('unit_price');
            const discountInput = document.getElementById('discount');
            const discountPriceInput = document.getElementById('discount_price');
            const quantityInput = document.getElementById('quantity');

            function calculateDiscountPrice() {
                const unitPrice = parseFloat(unitPriceInput.value) || 0;
                const discount = parseFloat(discountInput.value) || 0;

                if (unitPrice > 0 && discount > 0) {
                    const discountPrice = unitPrice - (unitPrice * discount / 100);

                    // Ensure the discount price is not negative
                    if (discountPrice >= 0) {
                        discountPriceInput.value = discountPrice.toFixed(0);
                    } else {
                        discountPriceInput.value = '0'; // Set to zero if the discount makes the price negative
                        Toast.fire({
                            icon: 'error',
                            text: 'Discount price should not be negative value!'
                        })
                    }
                } else {
                    discountPriceInput.value = '';
                }
            }

            function validateNumericInput(event) {
                if (!/^\d*\.?\d*$/.test(event.target.value)) {
                    event.target.value = event.target.value.replace(/[^\d.]/g, '');
                    Toast.fire({
                        icon: 'error',
                        text: 'Please enter only numeric values!'
                    })
                }
            }
            unitPriceInput.addEventListener('input', validateNumericInput);
            discountInput.addEventListener('input', validateNumericInput);
            quantityInput.addEventListener('input', validateNumericInput);

            unitPriceInput.addEventListener('input', calculateDiscountPrice);
            discountInput.addEventListener('input', calculateDiscountPrice);
        });



        // Handle dynamically added gallery inputs
        function previewGalleryImage(input) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $(input).closest('.row').find('.gallery-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

        $(document).on('change', '.gallery-input', function() {
            previewGalleryImage(this);
        });

        $(document).ready(function (){
            let counter = 0;

            $(document).on('click', '.addMore', function (e){
                e.preventDefault();
                let addEventItem = $('.addEventItem').html();
                $(this).closest('.closestAdd').append(addEventItem);
                counter++;
            });

            $(document).on('click', '.deleteItem', function (e){
                e.preventDefault();
                $(this).closest('.deleteEventItem').remove();
                counter -= 1;
            });
        })

    </script>

@endsection
