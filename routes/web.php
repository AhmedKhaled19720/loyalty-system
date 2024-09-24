<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Grouping product routes under authentication
Route::middleware(['auth'])->group(function () {
    //----------------------- start product routes-------------------------
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/products/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('product.forceDelete');
    //----------------------- End product routes-------------------------




    //----------------------- start cart routes-------------------------

    // Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{orderId}', [CartController::class, 'remove'])->name('cart.remove');
    // Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

    //----------------------- End cart routes-------------------------


    //----------------------- start setting routes-------------------------


    Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
    //----------------------- End setting routes-------------------------


    //----------------------- start points routes-------------------------


    Route::post('/points/store', [App\Http\Controllers\PointController::class, 'store'])->name('points.store');
    Route::delete('/points/{id}', [PointController::class, 'destroy'])->name('points.destroy');
    Route::put('/points/{id}', [PointController::class, 'update'])->name('points.update');

    //----------------------- End points routes-------------------------
});
