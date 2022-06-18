<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AudioController;

use App\Models\Admin\Category;
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
    $result['category']=Category::where('status','1')->get();
    return view('front.index',$result);
});

Route::get('/admin',[AdminController::class,'index']);
Route::post('/admin/auth',[AdminController::class,'auth'])->name('admin-auth');
Route::group(['middleware'=>'admin_auth'],function(){
    // Dashboard Route //////
    Route::get('admin/dashboard',[AdminDashboard::class,'index']);
    // Category Route //////
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin-category');
    Route::get('admin/addcategory',[CategoryController::class,'create'])->name('admin-addcategory');
    Route::post('admin/categorysubmit',[CategoryController::class,'store'])->name('admin-category-submit');
    Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);
    Route::get('admin/category/edit/{id}',[CategoryController::class,'edit']);
    Route::get('admin/category/delete/{id}',[CategoryController::class,'destroy']);
    Route::post('admin/categoryupdate',[CategoryController::class,'update'])->name('admin-category-update');
    // Audio Route //////
    Route::get('admin/audio',[AudioController::class,'index'])->name('admin-audio');
    Route::get('admin/add/audio',[AudioController::class,'create'])->name('admin-add-audio');
    Route::post('admin/audio/submit',[AudioController::class,'store'])->name('admin-audio-submit');
    Route::get('admin/audio/status/{status}/{id}',[AudioController::class,'status']);
    Route::get('admin/audio/edit/{id}',[AudioController::class,'edit']);
    Route::get('admin/audio/delete/{id}',[AudioController::class,'destroy']);
    Route::post('admin/audio/update',[AudioController::class,'update'])->name('admin-audio-update');
    

    Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin-logout');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/playlist/{id}', [App\Http\Controllers\FrontController::class, 'playlist'])->name('playlist');