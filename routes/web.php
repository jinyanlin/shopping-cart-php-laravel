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
Route::get('view-product/{id}',[FrontendController::class,'viewproduct']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//frontend for cart
Route::post('add-to-cart',[CartController::class,'addProduct']);
Route::post('delete-cart-item',[CartController::class,'deleteproduct']);
Route::post('update-cart',[CartController::class,'updateproduct']);

Route::middleware(['auth'])->group(function(){
    Route::get('cart',[CartController::class,'viewcart']);
    Route::get('checkout',[CheckoutController::class,'index']);
    Route::post('place-order',[CheckoutController::class,'placeorder']);
    Route::get('my-order',[UserController::class,'index']);
    Route::get('view-order/{id}',[UserController::class,'view']);
});


//admin dashboard 
Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard','App\Http\Controllers\Admin\FrontendController@index')->name('dashboard');
    Route::get('categories','App\Http\Controllers\Admin\CategoryController@index');
    Route::get('add-categories','App\Http\Controllers\Admin\CategoryController@add');
    Route::post('insert-category','App\Http\Controllers\Admin\CategoryController@insert');
    Route::get('edit-category/{id}',[CategoryController::class, 'edit']);
    Route::PUT('update-category/{id}',[CategoryController::class, 'update']);
    Route::get('delete-category/{id}',[CategoryController::class, 'destroy']);

    Route::get('products','App\Http\Controllers\Admin\ProductController@index');
    Route::get('add-products','App\Http\Controllers\Admin\ProductController@add');
    Route::post('insert-product','App\Http\Controllers\Admin\ProductController@insert');
    Route::get('edit-product/{id}',[ProductController::class, 'edit']);
    Route::PUT('update-product/{id}',[ProductController::class, 'update']);
    Route::get('delete-product/{id}',[ProductController::class, 'destroy']);
    
    Route::get('orders',[OrderController::class,'index']);
    Route::get('admin/view-order/{id}',[OrderController::class,'view']);
    Route::put('update-order/{id}',[OrderController::class,'update']);
    Route::get('order-history',[OrderController::class,'history']);
   
    Route::get('users',[DashboardController::class,'users']);
    Route::get('view-users/{id}',[DashboardController::class,'viewusers']);
});