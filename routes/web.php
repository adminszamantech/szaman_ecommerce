<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\FtdOrderController;
use App\Http\Controllers\Frontend\MyAccountController;
use App\Http\Controllers\Frontend\UserLoginController;
use App\Http\Controllers\Backend\ShiftChargeController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Frontend\FrontendCartController;
use App\Http\Controllers\Frontend\OnlinePaymentController;
use App\Http\Controllers\Frontend\OrderTrackingController;
use App\Http\Controllers\Frontend\CategoryProductController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\FrontendCategoryController;


Route::controller(UserLoginController::class)->group(function () {
    Route::get('/forget-password', 'user_forget_password')->name('user.forget.password');
    Route::post('/auth/userregister', 'customer_register')->name('user.register.post');


});

// -------------------frontend starting---------------------
Route::match(['get', 'post'], '/login', [UserLoginController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [UserLoginController::class, 'register'])->name('register');
Route::get('/', [HomeController::class, 'home_page'])->name('frontend.home_page');
Route::post('/search-product', [HomeController::class, 'product_search'])->name('frontend.search_product');
Route::get('/category/{slug}', [FrontendCategoryController::class, 'category_page'])->name('frontend.category.page');
Route::get('/category/{category_slug}/{subcat_slug}', [FrontendCategoryController::class, 'sub_category_page'])->name('frontend.subcategory.page');
Route::get('/brand/{brand_id}', [FrontendCategoryController::class, 'brand_product_page'])->name('frontend.brand.page');
Route::get('/product/{slug}', [FrontendProductController::class, 'detail_page'])->name('frontend.product.details');
Route::post('/addtofavorite', [FavoriteController::class, 'add_to_favorite'])->name('frontend.addtofavorite');
Route::get('/wish-list', [FavoriteController::class, 'wishlist_page'])->name('frontend.wishlist.page');
Route::post('/removefavorite', [FavoriteController::class, 'remove_favorite'])->name('frontend.removefavorite');
Route::get('/cart/view', [FrontendCartController::class, 'cart_view'])->name('frontend.cart_view');
Route::get('/productcsdfsdf', [CategoryProductController::class, 'get_category_product'])->name('dfggfg');
Route::get('/getcartitems', [CartController::class, 'getCartContent'])->name('frontend.getcarts');
Route::post('/addtocart', [CartController::class, 'add_to_cart'])->name('frontend.addtocart');
Route::post('/updatecart', [CartController::class, 'updateCart'])->name('frontend.updatecart');
Route::post('/removecart', [CartController::class, 'cartRemove'])->name('frontend.removecart');
Route::post('/shippingcharge', [CartController::class, 'addShippingCharge'])->name('frontend.shippingadd');
Route::post('/cartbuynow', [CartController::class, 'buy_now_button'])->name('frontend.buynowbutton');

//User Auth Route
Route::middleware('auth')->group(function () {
    Route::get('/order-tracking', [OrderTrackingController::class, 'order_tracking_page'])->name('frontend.order_tracking_page');
    Route::post('/getordertrack', [OrderTrackingController::class, 'get_track_order_by_id'])->name('frontend.get_track_order_by_id');
    Route::get('/checkout', [FrontendCartController::class, 'checkout_view'])->name('frontend.checkout_view');
    Route::get('/my-account', [MyAccountController::class, 'my_account_page'])->name('frontend.myaccount.page');
    Route::get('/my-account/order-details/{order_number}', [MyAccountController::class, 'order_detail'])->name('frontend.myaccount.orderdetail');
    Route::get('/my-account/profile', [MyAccountController::class, 'view_profile'])->name('frontend.myaccount.view_profile');
    Route::get('/my-account/profile/edit', [MyAccountController::class, 'edit_profile'])->name('frontend.myaccount.view_profile.edit');
    Route::get('/my-account/address', [MyAccountController::class, 'view_address'])->name('frontend.myaccount.address.view');
    Route::get('/my-account/change-password/', [MyAccountController::class, 'change_password'])->name('frontend.myaccount.change_password');
    Route::post('/my-account/profile/edit/{user_id}', [MyAccountController::class, 'update_edit_profile'])->name('frontend.myaccount.update.profile');
    Route::post('/my-account/update-password/{user_id}', [MyAccountController::class, 'update_password'])->name('frontend.myaccount.update.password');
    Route::post('/my-account/address/update', [MyAccountController::class, 'update_address'])->name('frontend.myaccount.address.update');
    Route::post('cus-address/update', [UserLoginController::class,'update_customer_address'])->name('update.customer.address');
    Route::get('cus-address/get', [UserLoginController::class,'get_customer_address'])->name('get.customer.address');
    Route::post('/cod-order-now', [FtdOrderController::class, 'cod_order_now'])->name('frontend.cod.ordernow');
    //SSLCOMMERZ
    Route::get('/pay', [OnlinePaymentController::class, 'index'])->name('online.payment');
    Route::post('/success', [OnlinePaymentController::class, 'success']);
    Route::post('/fail', [OnlinePaymentController::class, 'fail']);
    Route::post('/cancel', [OnlinePaymentController::class, 'cancel']);
    Route::post('/ipn', [OnlinePaymentController::class, 'ipn']);
    //SSLCOMMERZ END
    Route::get('/logout', [UserLoginController::class, 'customer_logout'])->name('customer.logout');
});



// Admin Route
Route::controller(LoginController::class)->group(function () {
    Route::get('/admin/login', 'login_form')->name('admin.form');
    Route::post('/admin/login', 'login')->name('admin.login');
});
Route::middleware('admin')->prefix('/admin')->group(function () {

    Route::get('/', function () {
        return redirect()->route('backend.dashboard');
    });
    Route::controller(OrderController::class)->prefix('order')->group(function () {
        Route::get('/index', 'index')->name('backend.order.index');
        Route::get('/get-order-data', 'get_order_data')->name('backend.order.data');
        Route::get('/{id}/view', 'view_single_order')->name('backend.order.single.view');
    });
    Route::controller(CustomerController::class)->prefix('customer')->group(function () {
        Route::get('/index', 'customer_index')->name('backend.customer.index');
        Route::get('/edit/{id}', 'customer_edit')->name('backend.customer.edit');
        Route::get('/get-customer-data', 'get_customer_data')->name('backend.customer.data');
        Route::put('/update/{id}', 'customer_update')->name('backend.customer.update');
        Route::get('/status/{id}', 'active_inactive')->name('backend.customer.status');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard_view')->name('backend.dashboard');
    });
    Route::controller(SliderController::class)->prefix('slider')->group(function () {
        Route::get('/', 'index')->name('backend.slider.index');
        Route::get('/{id}/edit', 'edit')->name('backend.slider.edit');
        Route::put('/{id}/update', 'update')->name('backend.slider.update');
        Route::get('/{id}/delete', 'destroy')->name('backend.slider.destroy');
        Route::post('/store', 'store')->name('backend.slider.store');
        Route::get('/get-slider-data', 'get_slider_data')->name('backend.slider.data');
    });
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/change-password', 'change_password_view')->name('backend.admin.change-password');
        Route::post('/change-password', 'update_change_password')->name('backend.admin.update-change-password');
        Route::get('/update-profile', 'edit_profile_view')->name('backend.admin.edit_profile');
        Route::post('/update-profile', 'update_edit_profile_view')->name('backend.admin.update_profile');
        Route::get('/logout', 'admin_logout')->name('backend.admin.logout');
    });
    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('/', 'index')->name('backend.category.index');
        Route::get('/{id}/edit', 'edit')->name('backend.category.edit');
        Route::post('/store', 'category_store')->name('backend.category.store');
        Route::get('/get-category-data', 'get_category_data')->name('backend.category.data');
        Route::put('/{id}/update', 'update_category')->name('backend.category.update');
        Route::get('/{id}/delete', 'destroy')->name('backend.category.destroy');
    });
    Route::controller(SubcategoryController::class)->prefix('subcategory')->group(function () {
        Route::get('/', 'index')->name('backend.subcategory.index');
        Route::get('/{id}/edit', 'edit')->name('backend.subcategory.edit');
        Route::post('/store', 'subcategory_store')->name('backend.subcategory.store');
        Route::get('/get-subcategory-data', 'get_subcategory_data')->name('backend.subcategory.data');
        Route::put('/{id}/update', 'update_subcategory')->name('backend.subcategory.update');
        Route::get('/{id}/delete', 'destroy')->name('backend.subcategory.destroy');
    });
    Route::controller(BrandController::class)->prefix('brand')->group(function () {
        Route::get('/', 'index')->name('backend.brand.index');
        Route::get('/{id}/edit', 'edit')->name('backend.brand.edit');
        Route::post('/store', 'brand_store')->name('backend.brand.store');
        Route::get('/get-brand-data', 'get_brand_data')->name('backend.brand.data');
        Route::put('/{id}/update', 'update_brand')->name('backend.brand.update');
        Route::get('/{id}/delete', 'destroy')->name('backend.brand.destroy');
    });
    Route::controller(AttributeController::class)->prefix('attribute')->group(function () {
        Route::get('/', 'attribute_view')->name('backend.attribute.index');
        Route::post('/store', 'attribute_store')->name('backend.attribute.store');
        Route::get('/get-data', 'attribute_data')->name('backend.attribute.getdata');
        Route::get('/destroy/{id}', 'destroy')->name('backend.attribute.destroy');
        Route::get('/{id}/edit', 'attribute_edit')->name('backend.attribute.edit');
        Route::post('/{id}/update', 'attribute_update')->name('backend.attribute.update');
    });
    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::get('/', 'index')->name('backend.product.index');
        Route::get('/create', 'create')->name('backend.product.create');
        Route::post('/store', 'store')->name('backend.product.store');
        Route::get('/get-data', 'product_data')->name('backend.product.getdata');
        Route::get('/destroy/{id}', 'destroy')->name('backend.product.destroy');
        Route::get('/{id}/edit', 'edit')->name('backend.product.edit');
        Route::put('/{id}/update', 'update')->name('backend.product.update');
    });
    Route::controller(ShiftChargeController::class)->prefix('shipping-charge')->group(function () {
        Route::get('/', 'index')->name('backend.shipping-charge.index');
        Route::get('/get-shipping-charge', 'get_shipping_data')->name('backend.shipping-charge.data');
        Route::get('/{id}/edit', 'edit')->name('backend.shipping-charge.edit');
        Route::get('/destroy/{id}', 'destroy')->name('backend.shipping-charge.destroy');
        Route::put('/{id}/update', 'update')->name('backend.shipping-charge.update');
        Route::post('/store', 'shipping_charge_store_or_update')->name('backend.shipping-charge.store');
    });
    Route::controller(SettingController::class)->prefix('settings')->group(function () {
        Route::get('/sslcommerz-credentials', 'sslcommerz_view')->name('backend.setting.sslcommerz');
        Route::post('/sslcommerz-credentials', 'update_or_insert')->name('backend.setting.sslcommerz.store');
        Route::match(['get', 'post'], '/site-setting', 'site_setting')->name('backend.setting.site_setting');
    });
});

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return redirect()->route('frontend.home_page');
});
