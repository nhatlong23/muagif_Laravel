<?php

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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

//fontend
Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/home', [IndexController::class, 'home']);
Route::post('/search', [IndexController::class, 'search']);


//category-product
Route::get('/category-product/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/brand-product/{brand_id}', [BrandProduct::class, 'show_brand_home']);
Route::get('/detail-product/{product_id}', [ProductController::class, 'details_product']);


//backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);


//Category Products
Route::get('/add_category_product', [CategoryProduct::class, 'add_category_product']);
Route::get('/edit_category_product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete_category_product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::get('/all_category_product', [CategoryProduct::class, 'all_category_product']);
Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);


//Brand Products
Route::get('/add_brand_product', [BrandProduct::class, 'add_brand_product']);
Route::get('/edit_brand_product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete_brand_product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
Route::get('/all_brand_product', [BrandProduct::class, 'all_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);
Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);


//Cart
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::get('/show_cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{id}', [CartController::class, 'delete_to_cart']);


//Products
Route::get('/add_product', [ProductController::class, 'add_product']);
Route::get('/edit_product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete_product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('/all_product', [ProductController::class, 'all_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);


//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);


//order
Route::get('/manage_order', [CheckoutController::class, 'manage_order']);
Route::get('/view_order/{order_id}', [CheckoutController::class, 'view_order']);
Route::get('/delete_order/{order_id}', [CheckoutController::class, 'delete_order']);
