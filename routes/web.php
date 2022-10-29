<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('edit-product/{id}',[CategoryController::class, 'edit']);
    Route::PUT('update-category/{id}',[CategoryController::class, 'update']);
});