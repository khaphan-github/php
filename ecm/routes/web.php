<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminOrdersController;
use App\Http\Controllers\AdminProductReviewsController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('admin/dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('admin/billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('admin/profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('admin/rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('admin/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('admin/tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('admin/virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('admin/static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('admin/static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

	// Category
	Route::get('/admin/category', [AdminCategoryController::class, 'filterPage'])->name('categories.filter');
	Route::post('/admin/category', [AdminCategoryController::class, 'createFunction'])->name('categories.createFunction');
	Route::get('/admin/category/delete/{id}', [AdminCategoryController::class, 'deleteFunction']);

	// Product
	Route::get('/admin/products', [AdminProductsController::class, 'filterPage'])->name('products.filter');
	Route::post('/admin/products/store', [AdminProductsController::class, 'createFunction'])->name('products.create');
	Route::get('/admin/products/delete/{id}', [AdminProductsController::class, 'deleteFunction']);
	Route::post('/admin/products/upload-excel', [AdminProductsController::class, 'upload']);

	// Orders
	Route::get('/admin/orders', [AdminOrdersController::class, 'filterPage'])->name('orders.filter');
	Route::get('/admin/orders/{id}/details', [AdminOrdersController::class, 'getOrderDetail'])->name('orders.getOrderDetail');
	Route::post('/admin/orders/store', [AdminOrdersController::class, 'createFunction'])->name('orders.create');
	Route::get('/admin/orders/delete/{id}', [AdminOrdersController::class, 'deleteFunction']);

	// Product preview
	Route::get('/admin/product/{id}/product_reviews', [AdminProductReviewsController::class, 'filterPage'])->name('product_reviews.filter');
	Route::post('/admin/product_reviews/store', [AdminProductReviewsController::class, 'createFunction'])->name('product_reviews.create');
	Route::get('/admin/product_reviews/delete/{id}', [AdminProductReviewsController::class, 'deleteFunction']);


	// Account
	Route::get('/admin/users', [AdminUsersController::class, 'filterPage'])->name('users.filter');
	Route::post('/admin/users/store', [AdminUsersController::class, 'createFunction'])->name('users.create');
	Route::get('/admin/users/delete/{id}', [AdminUsersController::class, 'deleteFunction']);

	// routes/web.php
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');


// Route includes 

//Route Admin
Route::get('/test', [TestController::class, 'get']);
Route::post('/admin/category/create', [TestController::class, 'store'])->name('admin.category.store');

//Route Home
Route::view('/home', 'client/pages/home');
Route::get('/home', [ProdController::class, 'home'])->name('home');
Route::get('/', [ProdController::class, 'home'])->name('home');

//Route Shop
Route::view('/shop', 'client/pages/shop');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::view('/shop-details', 'client/pages/shop-details');
Route::get('/product/{id}', [ProdController::class, 'productDetails'])->name('shop-details');
Route::post('/add-to-cart', [ProdController::class, 'addToCart'])->name('add-to-cart');
Route::post('/update-cart', [ProdController::class, 'updateCart'])->name('updateCart');

//Route Cart
Route::view('/shop-cart', 'client/pages/shop-cart');
Route::get('/shop-cart', [CartController::class, 'cart'])->name('cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
Route::get('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');

//Route Checkout
Route::view('/checkout', 'client/pages/checkout');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/paypal', [OrderController::class, 'paypal'])->name('paypal');
Route::get('/success', [OrderController::class, 'success'])->name('success');
Route::get('/cancel', [OrderController::class, 'cancel'])->name('cancel');

//Route Contact
Route::view('/contact', 'client/pages/contact');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

//Route Profile
Route::view('/profile', 'client/pages/profile');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

//Route Authen Client
Route::view('/login', 'client/authen/login');


Route::view('/blog', 'client/pages/blog');

Route::view('/blog-details', 'client/pages/blog-details');


Route::view('/NotFoundItem', 'client/pages/NotFoundItem');
