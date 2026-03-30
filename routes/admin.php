<?php

use Illuminate\Support\Facades\Route;;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\ImagesController;
use App\Http\Controllers\Admin\VariantsController;
use App\Http\Controllers\Admin\CartsController;
use App\Http\Controllers\Admin\CartItemsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\OrderItemsController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\AddressesController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middleware and are authenticated through the admin guard in a group.
|
*/

Route::name('admin.')->group(function() {
    Route::redirect('', 'admin/login');
    Route::middleware('auth:admin')->group(function() {
        Route::post('/addresses', [AddressesController::class, 'store'])->name('addresses.store');
		Route::post('/reviews', [ReviewsController::class, 'store'])->name('reviews.store');
		Route::post('/payments', [PaymentsController::class, 'store'])->name('payments.store');
		Route::post('/order_items', [OrderItemsController::class, 'store'])->name('order_items.store');
		Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
		Route::post('/cart_items', [CartItemsController::class, 'store'])->name('cart_items.store');
		Route::post('/carts', [CartsController::class, 'store'])->name('carts.store');
		Route::post('/variants', [VariantsController::class, 'store'])->name('variants.store');
		Route::post('/images', [ImagesController::class, 'store'])->name('images.store');
		Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
		Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
		Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
		Route::post('/users', [UsersController::class, 'store'])->name('users.store');
		Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/users', [UsersController::class, 'index'])->name('users');
	
		Route::name('users.')->group(function() {

			Route::get('/users/user/{user}', [UsersController::class, 'user'])->name('user');
			Route::delete('/users/{user}', [UsersController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/users/{id}', [UsersController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/users/erease/{id}', [UsersController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/products', [ProductsController::class, 'index'])->name('products');
	
		Route::name('products.')->group(function() {

			Route::get('/products/product/{product}', [ProductsController::class, 'product'])->name('product');
			Route::delete('/products/{product}', [ProductsController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/products/{id}', [ProductsController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/products/erease/{id}', [ProductsController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
	
		Route::name('categories.')->group(function() {

			Route::get('/categories/category/{category}', [CategoriesController::class, 'category'])->name('category');
			Route::delete('/categories/{category}', [CategoriesController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/categories/{id}', [CategoriesController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/categories/erease/{id}', [CategoriesController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/tags', [TagsController::class, 'index'])->name('tags');
	
		Route::name('tags.')->group(function() {

			Route::get('/tags/tag/{tag}', [TagsController::class, 'tag'])->name('tag');
			Route::delete('/tags/{tag}', [TagsController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/tags/{id}', [TagsController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/tags/erease/{id}', [TagsController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/images', [ImagesController::class, 'index'])->name('images');
	
		Route::name('images.')->group(function() {

			Route::get('/images/image/{image}', [ImagesController::class, 'image'])->name('image');
			Route::delete('/images/{image}', [ImagesController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/images/{id}', [ImagesController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/images/erease/{id}', [ImagesController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/variants', [VariantsController::class, 'index'])->name('variants');
	
		Route::name('variants.')->group(function() {

			Route::get('/variants/variant/{variant}', [VariantsController::class, 'variant'])->name('variant');
			Route::delete('/variants/{variant}', [VariantsController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/variants/{id}', [VariantsController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/variants/erease/{id}', [VariantsController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/carts', [CartsController::class, 'index'])->name('carts');
	
		Route::name('carts.')->group(function() {

			Route::get('/carts/cart/{cart}', [CartsController::class, 'cart'])->name('cart');
			Route::delete('/carts/{cart}', [CartsController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
		
		});

		Route::get('/cart_items', [CartItemsController::class, 'index'])->name('cart_items');
	
		Route::name('cart_items.')->group(function() {

			Route::get('/cart_items/cartitem/{cartitem}', [CartItemsController::class, 'cartitem'])->name('cartitem');
			Route::delete('/cart_items/{cartitem}', [CartItemsController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
		
		});

		Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
	
		Route::name('orders.')->group(function() {

			Route::get('/orders/order/{order}', [OrdersController::class, 'order'])->name('order');
			Route::delete('/orders/{order}', [OrdersController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/orders/{id}', [OrdersController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/orders/erease/{id}', [OrdersController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/order_items', [OrderItemsController::class, 'index'])->name('order_items');
	
		Route::name('order_items.')->group(function() {

			Route::get('/order_items/orderitem/{orderitem}', [OrderItemsController::class, 'orderitem'])->name('orderitem');
			Route::delete('/order_items/{orderitem}', [OrderItemsController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
		
		});

		Route::get('/payments', [PaymentsController::class, 'index'])->name('payments');
	
		Route::name('payments.')->group(function() {

			Route::get('/payments/payment/{payment}', [PaymentsController::class, 'payment'])->name('payment');
			Route::delete('/payments/{payment}', [PaymentsController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/payments/{id}', [PaymentsController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/payments/erease/{id}', [PaymentsController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews');
	
		Route::name('reviews.')->group(function() {

			Route::get('/reviews/review/{review}', [ReviewsController::class, 'review'])->name('review');
			Route::delete('/reviews/{review}', [ReviewsController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/reviews/{id}', [ReviewsController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/reviews/erease/{id}', [ReviewsController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		Route::get('/addresses', [AddressesController::class, 'index'])->name('addresses');
	
		Route::name('addresses.')->group(function() {

			Route::get('/addresses/address/{address}', [AddressesController::class, 'address'])->name('address');
			Route::delete('/addresses/{address}', [AddressesController::class, 'delete'])->middleware(['role:SuperAdmin|Manager'])->name('delete');
			Route::put('/addresses/{id}', [AddressesController::class, 'restore'])->middleware(['role:SuperAdmin|Manager'])->name('restore');
			Route::delete('/addresses/erease/{id}', [AddressesController::class, 'forceDelete'])->middleware(['role:SuperAdmin'])->name('erease');
		
		});

		
    });
});
