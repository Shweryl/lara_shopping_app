<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Auth::routes(['verify' => true]);

Route::get('/',function(){
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user/edit',[UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update',[UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete',[UserController::class, 'destroy'])->name('user.delete');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/show', [ProductController::class, 'show'])->name('product.detail');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/all', [CartController::class, 'allcarts'])->name('cart.all');
    Route::get('/cart/{id}/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/ordersubmit', [OrderController::class, 'submit'])->name('order.submit');
});


