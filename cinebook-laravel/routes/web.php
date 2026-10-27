<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// 1. Storefront Catalog & Search
Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('catalog');

// 2. Shopping Cart Routes
Route::post('/cart/add', [BookController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [BookController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove', [BookController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [BookController::class, 'clearCart'])->name('cart.clear');

// 3. Admin Panel Routes
Route::get('/admin', [BookController::class, 'adminIndex'])->name('admin.index');
Route::post('/admin/store', [BookController::class, 'storeBook'])->name('admin.store');
Route::post('/admin/delete/{id}', [BookController::class, 'deleteBook'])->name('admin.delete');

// 4. Custom Authentication Routes
Route::get('/register', [BookController::class, 'showRegister'])->name('register');
Route::post('/register', [BookController::class, 'register']);

Route::get('/login', [BookController::class, 'showLogin'])->name('login');
Route::post('/login', [BookController::class, 'login']);

Route::post('/logout', [BookController::class, 'logout'])->name('logout');

//5. Admin Panel Routes
Route::get('/admin', [BookController::class,'adminIndex'])->name('admin.index')->middleware('auth');
Route::post('/admin/store', [BookController::class,'storeBook'])->name('admin.store')->middleware('auth');
Route::post('/admin/delete/{id}', [BookController::class,'deleteBook'])->name('admin.delete')->middleware('auth');

//Checkout Route
Route::post('/cart/checkout', [BookController::class,'chechout'])->name('cart.checkout');