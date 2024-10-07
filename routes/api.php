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


// 添加用户
Route::post('/add_user', function (Request $request) {
    // 密码版
    $user = new \App\Models\User();
    $user->name = $request->input("name");
    $user->account = $request->input("account");
    $user->email = $request->input("email");
    // 需要通过 Hash::make 加密后，才能使用 Auth::attempt 验证密码正确性
    $user->password = Hash::make($request->input("password"));
    $user->save();
    return $user;
});

Route::group(['prefix' => 'admin'], function () {



    //用户接口
    Route::post('/user/login', [\App\Http\Controllers\Admin\UserController::class, 'login']);
    Route::post('/user/logout', [\App\Http\Controllers\Admin\UserController::class, 'logout']);
    Route::get('/user/info', [\App\Http\Controllers\Admin\UserController::class, 'info'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);
    Route::get('/area', [\App\Http\Controllers\Admin\AreaController::class, 'getChildList']);

    //产品接口
    Route::apiResource('product', ProductController::class);
    Route::apiResource('customer', CustomerController::class);
    Route::apiResource('order', \App\Http\Controllers\Admin\OrderController::class);
});
