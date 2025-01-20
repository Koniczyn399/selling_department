<?php

use App\Http\Controllers\OrderProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\OrderStateController;
use App\Http\Controllers\ManufacturerController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\SpecialUserController;

Route::get('/', function () {
    return view('welcome_new');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('orders.index');
    })->name('dashboard');

    Route::name('users.show')->get('/users/{user}/{history?}', [UserController::class,'show']);
    Route::name('users.edit')->get('/user_edit/{user}', [UserController::class,'edit']);
    Route::name('users.create')->get('/user_create', [UserController::class,'create']);

    Route::resource('users', UserController::class)->only([
        'index',
        //'create',
        //'edit',
        //'show',
    ]);

    Route::name('employees.show')->get('/employees/{user}', [SpecialUserController::class,'show']);
    Route::name('employees.edit')->get('/employee_edit/{employee}', [SpecialUserController::class,'edit']);
    Route::name('employees.create')->get('/employee_create', [SpecialUserController::class,'create']);
    Route::resource('employees', SpecialUserController::class)->only([
        'index',
        // 'create',
        // 'edit',
        //'show',
    ]);

     Route::name('datas.create')->get('/datas/{new_id}', [DataController::class,'create']);

    Route::resource('datas', DataController::class)->only([
        'index',
     //   'create',
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
        'edit',
        'index',
        'create',
      
    ]);

    

});

/**
 * 
 */
