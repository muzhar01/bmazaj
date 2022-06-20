<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AudioController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Models\Admin\Logo;
use App\Models\Admin\Color;

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
    $result['color']=Color::first();
    $result['logo']=Logo::first();
    $result['category']=Category::where('status','1')->get();
    return view('front.index',$result);
});

Route::get('/cmd/{cmd}', function ($cmd) {
    return \Artisan::call("$cmd");
});

Route::get('/admin',[AdminController::class,'index']);
Route::post('/admin/auth',[AdminController::class,'auth'])->name('admin-auth');
Route::group(['middleware'=>'admin_auth'],function(){
    // Dashboard Route //////
    Route::get('admin/dashboard',[AdminDashboard::class,'index']);
    // Logo Route //////
    Route::get('admin/logo',[LogoController::class,'index'])->name('admin-logo');
    Route::post('admin/logsubmit',[LogoController::class,'store'])->name('admin-logo-submit');
    
    // color Route //////
    Route::get('admin/color',[ColorController::class,'index'])->name('admin-color');
    Route::post('admin/colorsubmit',[ColorController::class,'store'])->name('admin-color-submit');

    // Category Route //////
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin-category');
    Route::get('admin/addcategory',[CategoryController::class,'create'])->name('admin-addcategory');
    Route::post('admin/categorysubmit',[CategoryController::class,'store'])->name('admin-category-submit');
    Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);
    Route::get('admin/category/edit/{id}',[CategoryController::class,'edit']);
    Route::get('admin/category/delete/{id}',[CategoryController::class,'destroy']);
    Route::post('admin/categoryupdate',[CategoryController::class,'update'])->name('admin-category-update');
    Route::post('admin/categoryposiiton',[CategoryController::class,'updatePosition'])->name('update-category-orderPosition');
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/playlist/{id}', [FrontController::class, 'playlist'])->name('playlist');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => '\App\Http\Controllers\LanguageController@switchLang']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
