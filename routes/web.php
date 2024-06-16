<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;  
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/cart', [HomeController::class,'cart'])->name('cart');


Route::get('/admin/login', [AuthController::class,'login'])->name('login');
Route::post('/checkLogin', [AuthController::class,'checkLogin'])->name('checkLogin');


Route::middleware(['auth'])->group(function () {
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/', [DashBoardController::class,'index'])->name('index');
        Route::resource('user', UserController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);
        
        //restore
        Route::get('user/{user}/restore',[UserController::class,'restore'])->name('user.restore');
        Route::get('product/{product}/restore',[ProductController::class,'restore'])->name('product.restore');
        Route::get('category/{category}/restore',[CategoryController::class,'restore'])->name('category.restore');
        });
});




Route::post('/test', [TestController::class,'index'])->name('test');