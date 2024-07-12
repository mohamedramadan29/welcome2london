<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\AdminController;
use \App\Http\Controllers\admin\ServiceController;
Route::get('/admin', [AdminController::class, 'index'])->name('login');
Route::group(['prefix' => 'admin'], function () {
    // Admin Login
    Route::match(['post', 'get'], '/', [AdminController::class, 'index'])->name('login');
    Route::match(['post', 'get'], 'login', [AdminController::class, 'index'])->name('login');
    Route::post('admin_login',[AdminController::class,'admin_login']);
    // Admin Dashboard
    Route::group(['middleware' => 'admin'], function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard');
            // update admin password
            Route::match(['post', 'get'], 'update_admin_password', 'update_admin_password');
            // check Admin Password
            Route::post('check_admin_password', 'check_admin_password');
            // Update Admin Details
            Route::match(['post', 'get'], 'update_admin_details', 'update_admin_details');
            // Admin Logout
            Route::get('logout', 'logout')->name('logout');
        });
          ///////////////////////// Start Services Section  //////////
        ///
        Route::controller(ServiceController::class)->group(function () {
            Route::get('services', 'index');
            Route::match(['post', 'get'], 'service/add', 'store');
            Route::match(['post', 'get'], 'service/update/{id}', 'update');
            Route::post('service/delete/{id}', 'delete');
        });

        //////////////////////////// Start Faqs /////////////////
        ///
        Route::controller(FaqController::class)->group(function () {
            Route::get('faqs', 'index');
            Route::match(['post', 'get'], 'faq/store', 'store');
            Route::match(['post', 'get'], 'faq/update/{id}', 'update');
            Route::post('faq/delete/{id}', 'delete');
        });
    });
});
