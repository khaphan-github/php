<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
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
	Route::put('/admin/category', [AdminCategoryController::class, 'updateFunction'])->name('categories.updateFunction');
	Route::get('/admin/category/delete/{id}', [AdminCategoryController::class, 'deleteFunction']);
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

//Route Shop
Route::view('/shop', 'client/pages/shop');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/', [ProductController::class, 'home'])->name('home');

//Route Cart
Route::get('/shop-cart', [CartController::class, 'cart'])->name('cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('remove-from-cart');


Route::view('/blog', 'client/pages/blog');
Route::view('/contact', 'client/pages/contact');
Route::view('/blog-details', 'client/pages/blog-details');
Route::view('/checkout', 'client/pages/checkout');
Route::view('/shop-cart', 'client/pages/shop-cart');
Route::view('/shop-details', 'client/pages/shop-details');
Route::view('/NotFoundItem', 'client/pages/NotFoundItem');

