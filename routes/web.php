<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishController;
use App\Http\Controllers\Frontend\RatingController;

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookAuthController;

use App\Http\Controllers\Pay\OpayPaymentsController;
use Illuminate\Support\facades\Auth;
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


//frontend for category and product
Route::get('/',[FrontendController::class,'index']);
Route::get('category',[FrontendController::class,'category']);
Route::get('category/{slug}',[FrontendController::class,'viewcategory']);
Route::get('category/{category_slug}/{product_slug}',[FrontendController::class,'viewproduct']);
Route::get('product-list',[FrontendController::class,'searchProductAjax']);
Route::get('search',[FrontendController::class,'searchProduct']);
Route::get('view-product/{id}',[FrontendController::class,'viewproduct']);

Route::post('add-rating',[RatingController::class,'add']);

Auth::routes();

//login 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'handleGoogleCallback']);
Route::get('auth/facebook', [FacebookAuthController::class, 'redirect'])->name('facebook.login');
Route::get('auth/facebook/call-back', [FacebookAuthController::class, 'handleFacebookCallback']);

//frontend for cart
Route::get('load-cart-data',[CartController::class,'cartcount']);
Route::post('add-to-cart',[CartController::class,'addProduct']);
Route::post('delete-cart-item',[CartController::class,'deleteproduct']);
Route::post('update-cart',[CartController::class,'updateproduct']);


Route::get('load-wishlist-data',[WishController::class,'wishcount']);
Route::post('add-to-wishlist',[WishController::class,'add']);
Route::post('delete-wishlist-item',[WishController::class,'deletewishlist']);

Route::middleware(['auth'])->group(function(){
    Route::get('view-user',[UserController::class,'viewuser']);
    Route::post('edit-user',[UserController::class,'edituser']);

    Route::get('cart',[CartController::class,'viewcart']);
    Route::get('checkout',[CheckoutController::class,'index']);

    //paid for
    Route::post('place-order',[CheckoutController::class,'placeorder']);
    Route::post('ec-order',[CheckoutController::class,'checkout']); // ECPay
    Route::post('/callback',[CheckoutController::class,'eccallback']); //ECPay callback
    Route::post('proceed-to-pay',[CheckoutController::class,'razorpaycheck']); //cash
    Route::post('pay',[OpayPaymentsController::class,'pay']);   //Opay
    
    Route::get('my-order',[UserController::class,'index']);
    Route::get('view-order/{id}',[UserController::class,'view']);

    Route::get('wishlist',[WishController::class,'index']);
    

});


//admin dashboard 
Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('admin/dashboard','App\Http\Controllers\Admin\FrontendController@index')->name('dashboard');
    Route::get('admin/categories','App\Http\Controllers\Admin\CategoryController@index');
    Route::get('admin/add-categories','App\Http\Controllers\Admin\CategoryController@add');
    Route::post('admin/insert-category','App\Http\Controllers\Admin\CategoryController@insert');
    Route::get('admin/edit-category/{id}',[CategoryController::class, 'edit']);
    Route::PUT('admin/update-category/{id}',[CategoryController::class, 'update']);
    Route::get('admin/delete-category/{id}',[CategoryController::class, 'destroy']);

    Route::get('admin/products','App\Http\Controllers\Admin\ProductController@index');
    Route::get('admin/add-products','App\Http\Controllers\Admin\ProductController@add');
    Route::post('admin/insert-product','App\Http\Controllers\Admin\ProductController@insert');
    Route::get('admin/edit-product/{id}',[ProductController::class, 'edit']);
    Route::PUT('admin/update-product/{id}',[ProductController::class, 'update']);
    Route::get('admin/delete-product/{id}',[ProductController::class, 'destroy']);
    //Route::post('admin/delete-admin-product',[ProductController::class, 'delete']);

    Route::get('admin/orders',[OrderController::class,'index']);
    Route::get('admin/view-order/{id}',[OrderController::class,'view']);
    Route::put('admin/update-order/{id}',[OrderController::class,'update']);
    Route::get('admin/order-history',[OrderController::class,'history']);
   
    Route::get('admin/users',[DashboardController::class,'users']);
    Route::get('admin/view-users/{id}',[DashboardController::class,'viewusers']);
});