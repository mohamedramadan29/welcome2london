<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\front\FrontController;
use \App\Http\Controllers\front\PaypalController;
use \App\Http\Controllers\front\ServiceController;
Route::controller(FrontController::class)->group(function (){
    Route::get('/','index');
    Route::match(['post','get'],'booking','booking');
    Route::get('services','services');
    Route::match(['post','get'],'contact','contact');
    Route::get('booking-confirm/{booking_id}','booking_confirm');
});

Route::controller(ServiceController::class)->group(function (){
    Route::get('service/{slug}','service');
});

Route::controller(PaypalController::class)->group(function (){

//    Route::post('confirm/pay','pay')->name('payment');
//    Route::post('confirm/pay2','pay')->name('payment2');
//    Route::get('success2','success2');
//    Route::get('success','success');
//    Route::get('error','errorPayment');
//    Route::get('error2','errorPayment2');
    Route::get('paypal/create', 'index');
    Route::get('/create/{amount}', 'create');
    Route::post('/complete', 'complete');


});

Route::controller(\App\Http\Controllers\front\ServiceBookingContoller::class)->group(function (){

    Route::post('booking_serv','booking')->name('booking-serve');
    Route::get('booking-confirm2/{booking_id}','booking_confirm2');

});

include 'admin.php';
