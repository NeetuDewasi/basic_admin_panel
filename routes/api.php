<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomAuthUserController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/user_data', [CustomAuthUserController::class, 'getAuthUser']);


// Route::post('/logout', [CustomAuthUserController::class, 'logout'])->middleware('auth:api');
Route::post('/user_update', [CustomAuthUserController::class, 'updateUserAdmin']);
Route::prefix('customers')->group(function (){
    Route::get('/all', [CustomerController::class, 'get_all_customers']);
    Route::post('/create', [CustomerController::class, 'createCustomer']);
    Route::get('/edit/{customer_id}',[CustomerController::class,'getCustomerOnEdit']);
    Route::post('/update/{customer_id}', [CustomerController::class, 'customerUpdate']);
    Route::delete('/delete/{id}', [CustomerController::class, 'deleteCustomer']);
});
