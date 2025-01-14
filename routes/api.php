<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Api\AdminAuthController;
use App\Http\Controllers\Frontend\Api\UserAuthController;


Route::controller(UserAuthController::class)->group(function () {
    Route::post('/user/login', 'login');
});

Route::controller(AdminAuthController::class)->group(function () {
    Route::post('/admin/login', 'login');
});
