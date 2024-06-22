<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\CaseController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\IndexController;
use App\Http\Controllers\Home\NewsController;
use App\Http\Controllers\Home\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
//Route::get('/about', [AboutController::class, 'index']);
//Route::get('/contact', [ContactController::class, 'index']);
//Route::get('/product', [ProductController::class, 'index']);
//Route::get('/case', [CaseController::class, 'index']);
//Route::get('/news', [NewsController::class, 'index']);

//Route::get('/login', [LoginController::class, 'index']);

//Route::group(['prefix' => 'admin'], function () {
//    Route::redirect('/', '/admin/dashboard');
//    Route::get('/dashboard', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin.dashboard');
//    Route::get('/product', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product');
//    Route::get('/product/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
//    Route::post('/product/create', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
//    Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting');
//    Route::get('/setting/create', [SettingController::class, 'create'])->name('admin.setting.create');
//});
