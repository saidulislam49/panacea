<?php

use App\Http\Controllers\Admin\BookshopController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WriterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
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



// admin routes
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
    Route::resource('/category', CategoryController::class);
    Route::resource('/book_shop', BookshopController::class);
    Route::resource('/options', OptionController::class);
    Route::resource('/writer', WriterController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/post-categories', PostCategoryController::class);
});




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::get('/home', [HomeController::class, 'index'])->name('home');