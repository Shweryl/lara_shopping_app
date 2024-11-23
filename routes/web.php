<?php

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

Auth::routes();
Route::get('/',function(){
    return view('auth.login');
});

Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user/edit',[UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update',[UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete',[UserController::class, 'destroy'])->name('user.delete');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
});


