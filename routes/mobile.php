<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\HomeController;
use App\Http\Controllers\Mobile\CustomerAuthController;
use App\Http\Controllers\Mobile\CheckoutController;
use App\Http\Controllers\Mobile\AppOrderController;
use App\Http\Controllers\Mobile\ProfileController;


Route::controller(HomeController::class)->group(function (){
   Route::get('/homelatestproduct', 'homeLatestProducts');
   Route::get('/singleproduct/{id}', 'product_detail');
   Route::get('/homeslider', 'home_slider');
   Route::get('/getcategory', 'get_category');
   Route::get('/getbrand', 'get_brand');
   Route::get('/getbrandproduct/{brand_id}', 'brand_products');
   Route::get('/getshippingcharge', 'shipping_charge');
   Route::get('/sslcredential', 'get_sslcredential');
   Route::get('/catwiseproduct', 'get_category_wise_project');
   Route::get('/catproducts/{category_id}', 'category_product_list');
   Route::get('/featureproducts', 'feature_products');
   Route::get('/hotdealproducts', 'hot_deal_products');
   Route::get('/bestsellingproducts', 'best_selling_products');
   Route::post('/searchproduct', 'product_search');
});

// Add more mobile-specific routes here

Route::controller(CustomerAuthController::class)->group(function () {
    Route::post('/customer/login', 'login');
    Route::post('/customer/register', 'register');
});

// Checkout Controller
Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout/get-address/{user_id}', 'get_customer_address');
    Route::post('/checkout/address/store/{user_id}', 'update_customer_address');
    Route::get('/checkout/customer/{user_id}', 'get_customer_detail');
});

// App Order Controller
Route::controller(AppOrderController::class)->group(function () {
    Route::post('/cod-order', 'cod_order');
    Route::post('/online-pay', 'online_payment');
    Route::post('/success', 'success_payment');
    Route::post('/fail-cancel', 'fail_or_payment');
    Route::get('/get-order/{user_id}', 'get_order');
    Route::post('/order-detail', 'order_detail');
    Route::post('/order/cancel', 'order_cancel');
});


// Profile Controller
Route::controller(ProfileController::class)->group(function () {
    Route::post('/update-password', 'password_update');
    Route::post('/update-address', 'address_update');
});
