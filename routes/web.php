<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
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

Route::get('/',[FrontendController::class,'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard','App\Http\Controllers\Admin\FrontendController@index');
    /*function(){
        //return "this is a Admin dashboard";
        //return view('admin.index');
    });*/
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
});