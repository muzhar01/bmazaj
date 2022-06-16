<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboard;
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

Route::get('/admin',[AdminController::class,'index']);
Route::post('/admin/auth',[AdminController::class,'auth'])->name('admin-auth');
Route::group(['middleware'=>'admin_auth'],function(){
    Route::get('admin/dashboard',[AdminDashboard::class,'index']);
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin-category');
    Route::get('admin/addcategory',[CategoryController::class,'create'])->name('admin-addcategory');
    Route::post('admin/categorysubmit',[CategoryController::class,'store'])->name('admin-category-submit');
    Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);
    Route::get('admin/category/edit/{id}',[CategoryController::class,'edit']);
    Route::get('admin/category/dlete/{id}',[CategoryController::class,'destory']);
    Route::post('admin/categoryupdate',[CategoryController::class,'update'])->name('admin-category-update');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
