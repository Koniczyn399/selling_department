<?php

use App\Http\Controllers\OrderProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KomponentController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\OrderStateController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\CommissionServiceController;
use App\Http\Controllers\CommissionKomponentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Models\OrderProduct;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class)->only([
        'index',
        'create',
        'edit',
        'show',
    ]);

    Route::resource('manufacturers', ManufacturerController::class)->only([
        'index',
        'create',
        'edit',
    ]);

    Route::resource('categories', CategoryController::class)->only([
        'index',
        'create',
        'edit',
    ]);
  
    Route::resource('orderstates', OrderStateController::class)->only([
        'index',
        'create',
        'edit',
    ]);

   
    Route::resource('products', ProductController::class)->only([
        'index',
        'create',
        'edit',
        'show',
    ]);
  

    Route::resource('orders', OrderController::class)->only([
        'index',
        'create',
        'edit',
        'show'
    ]);

    Route::resource('orderproducts', OrderProductController::class)->only([
        'index',
        'create',
        'edit',
    ]);

});

/**
 * 
 */
