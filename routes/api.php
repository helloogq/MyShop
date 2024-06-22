<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin'], function () {

    //用户接口
    Route::post('/user/login', [\App\Http\Controllers\Admin\UserController::class, 'login']);
    Route::post('/user/logout', [\App\Http\Controllers\Admin\UserController::class, 'logout']);
    Route::get('/user/info', [\App\Http\Controllers\Admin\UserController::class, 'info']);
    Route::get('/area', [\App\Http\Controllers\Admin\AreaController::class, 'getChildList']);

    //产品接口
    Route::apiResource('product', ProductController::class);
    Route::apiResource('customer', CustomerController::class);
    Route::apiResource('order', \App\Http\Controllers\Admin\OrderController::class);
});
