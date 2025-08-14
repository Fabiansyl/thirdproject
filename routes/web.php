<?php

use App\Http\Controllers\TwoFA\TwoFactorAuthController as TwoFATwoFactorAuthController;
use App\Http\Controllers\TwoFactorAuthController;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

// Enable Laravel's default authentication routes with email verification
Auth::routes(['verify' => true]);



Route::get('/', [App\Http\Controllers\Products\ProductsController::class, 'shop'])->name('products.shop');
Route::get('/home', [App\Http\Controllers\Products\ProductsController::class, 'shop'])->name('products.shop');
//Products
Route::get('products/category/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleCategory'])->name('single.category');
Route::get('products/single-product/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleProduct'])->name('single.product');
Route::get('products/shop', [App\Http\Controllers\Products\ProductsController::class, 'shop'])->name('products.shop');

// cart
Route::post('products/add-cart', [App\Http\Controllers\Products\ProductsController::class, 'addToCart'])->name('products.add.cart');
Route::get('products/cart', [App\Http\Controllers\Products\ProductsController::class, 'cart'])->name('products.cart')->middleware(['auth:web', 'verified']);
Route::post('products/Cart/{id}', [App\Http\Controllers\Products\ProductsController::class, 'deleteFromCart'])->name('products.cart.delete')->middleware(['auth:web', 'verified']);

//checkout and paying
Route::post('products/prepare-checkout', [App\Http\Controllers\Products\ProductsController::class, 'prepareCheckout'])->name('products.prepare.checkout');
Route::get('products/checkout', [App\Http\Controllers\Products\ProductsController::class, 'checkout'])->name('products.checkout')->middleware(['auth:web', 'verified']);
Route::post('products/checkout', [App\Http\Controllers\Products\ProductsController::class, 'processCheckout'])->name('products.process.checkout')->middleware(['auth:web', 'verified']);
Route::get('products/pay', [App\Http\Controllers\Products\ProductsController::class, 'payWithPaypal'])->name('products.pay')->middleware(['auth:web', 'verified']);

//users pages
Route::group(['middleware' => ['auth:web', '2fa', 'verified']], function () {
    Route::get('users/my-orders', [App\Http\Controllers\Users\UsersController::class, 'myOrders'])->name('users.orders');
    Route::get('users/setting', [App\Http\Controllers\Users\UsersController::class, 'settings'])->name('users.settings');
    Route::post('users/setting/{id}', [App\Http\Controllers\Users\UsersController::class, 'updateUserSettings'])->name('users.settings.update');
});

// Admin Panel
Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login')->middleware('check.for.auth');
Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['middleware' => ['auth:admin', '2fa', 'verified']], function () {
    Route::get('admin/index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');

    //admins
    Route::get('admin/all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'displayAdmins'])->name('admins.all');
    Route::get('admin/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('admins.create');
    Route::post('admin/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name('admins.store');

    //categories on Admin 
    Route::get('admin/all-categories', [App\Http\Controllers\Admins\AdminsController::class, 'displayCategories'])->name('categories.all');
    Route::get('admin/create-categories', [App\Http\Controllers\Admins\AdminsController::class, 'createCategories'])->name('categories.create');
    Route::post('admin/create-categories', [App\Http\Controllers\Admins\AdminsController::class, 'storeCategories'])->name('categories.store');
    Route::get('admin/update-category/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'displayCategory'])->name('categories.single');
    Route::post('admin/update-category/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateCategory'])->name('categories.update');
    Route::post('admin/category/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteFromCategory'])->name('categories.delete');

    //products on admin
    Route::get('admin/all-products', [App\Http\Controllers\Admins\AdminsController::class, 'displayProducts'])->name('products.all');
    Route::get('admin/create-products', [App\Http\Controllers\Admins\AdminsController::class, 'showCreateProductForm'])->name('products.create');
    Route::post('admin/create-products', [App\Http\Controllers\Admins\AdminsController::class, 'storeProducts'])->name('products.store');
    Route::post('admin/products/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteProducts'])->name('products.delete');

    //orders on admin
    Route::get('admin/all-orders', [App\Http\Controllers\Admins\AdminsController::class, 'displayOrders'])->name('orders.all');
    Route::get('admin/edit-orders', [App\Http\Controllers\Admins\AdminsController::class, 'editOrders'])->name('orders.edit');
    Route::post('admin/update-orders/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateOrders'])->name('orders.update');
});

// 2FA routes

Route::get('2fa/enable', [TwoFATwoFactorAuthController::class, 'enable2fa'])->name('2fa.enable')->middleware('auth');
Route::post('2fa/verify', [TwoFATwoFactorAuthController::class, 'verify2fa'])->name('2fa.verify')->middleware('auth');

