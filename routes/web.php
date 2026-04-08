<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AccountController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('{locale}')->group(function() {
	require __DIR__.'/auth.php';



	Route::get('lang/{lang}', [MainController::class, 'lang'])->name('lang');

Route::get('', [MainController::class, 'home'])->name('home');

Route::get('about', [MainController::class, 'about'])->name('about');

Route::get('contact', [MainController::class, 'contactMe'])->name('contact_me');
Route::prefix('products')->name('products.')->group(function() {
	Route::middleware('auth:users')->group(function() {
		Route::post('reviews/{product}', [ProductsController::class, 'storeReview'])->name('reviews.store');
	});

	Route::get('', [ProductsController::class, 'index'])->name('index');

	Route::get('show/{product}', [ProductsController::class, 'show'])->name('show');

	Route::get('search/{query}/{category}/{tag}', [ProductsController::class, 'search'])->name('search');
});

Route::prefix('cart')->name('cart.')->group(function() {
	Route::get('', [CartController::class, 'show'])->name('show');

	Route::post('items/{product}/{quantity}/{variant}', [CartController::class, 'storeItem'])->name('items.store');

	Route::put('items-update/{cart_item}/{quantity}', [CartController::class, 'updateItem'])->name('items.update');

	Route::delete('items-remove/{cart_item}', [CartController::class, 'destroyItem'])->name('items.destroy');
});

Route::prefix('checkout')->name('checkout.')->group(function() {
	Route::middleware('auth:users')->group(function() {
		Route::get('', [CheckoutController::class, 'show'])->name('show');
	Route::post('process/{cart}/{address}', [CheckoutController::class, 'store'])->name('store');
	});

	
});

Route::prefix('orders')->name('orders.')->group(function() {
	Route::middleware('auth:users')->group(function() {
		Route::get('', [OrdersController::class, 'index'])->name('index');
	Route::get('show/{order}', [OrdersController::class, 'show'])->name('show');
	Route::delete('cancel/{order}', [OrdersController::class, 'destroy'])->name('destroy');
	});

	
});

Route::prefix('account')->name('account.')->group(function() {
	Route::middleware('auth:users')->group(function() {
		Route::get('', [AccountController::class, 'show'])->name('show');
	Route::get('edit', [AccountController::class, 'edit'])->name('edit');
	Route::put('update', [AccountController::class, 'update'])->name('update');
	Route::delete('delete', [AccountController::class, 'destroy'])->name('destroy');
	});

	
});



	Route::get('terms', [MainController::class, 'terms'])->name('terms');

	Route::get('privacy', [MainController::class, 'privacy'])->name('privacy');

	Route::get('cookies', [MainController::class, 'cookies'])->name('cookies');
});

