<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\front\FrontController;

Route::controller(FrontController::class)->group(function (){
    Route::get('/','index');
});
include 'admin.php';
