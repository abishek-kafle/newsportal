<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CkeditorFileUploadController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [FrontEndController::class, 'index'])->name('index');

Auth::routes();

Route::get('/news/{slug}', [FrontEndController::class, 'newsSingle'])->name('newsSingle');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/forget-password', [AdminLoginController::class, 'forgetPassword'])->name('forgetPassword');

Route::prefix('/admin')->group(function(){
    //Admin login
    Route::match(['get','post'],'/login', [AdminLoginController::class, 'adminLogin'])->name('adminLogin');
    Route::group(['middleware' => 'admin'], function () {
        //Admin dashboard
        Route::get('/dashboard', [AdminLoginController::class, 'adminDashboard'])->name('adminDashboard');
        //Edit profile
        Route::get('/profile', [AdminLoginController::class, 'profile'])->name('profile');
        Route::post('/profile/update/{id}', [AdminLoginController::class, 'profileUpdate'])->name('profileUpdate');
        //change password
        Route::get('/profile/change_password', [AdminLoginController::class, 'changePassword'])->name('changePassword');
        //Check user password
        Route::post('/profile/check-password', [AdminLoginController::class, 'checkUserPassword'])->name('checkUserPassword');
        //Update Admin password
        Route::post('/profile/update_password/{id}', [AdminLoginController::class, 'updatePassword'])->name('updatePassword');


        // Category
        Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/add', [CategoryController::class, 'add'])->name('category.add');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete-category/{id}', [CategoryController::class, 'delete'])->name('category.delete');

        //News
        Route::get('/news/index', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/add', [NewsController::class, 'add'])->name('news.add');
        Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
        Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
        Route::post('/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::get('/delete-news/{id}', [NewsController::class, 'delete'])->name('news.delete');

        // CkEditor
        Route::post('ckeditor', [CkeditorFileUploadController::class, 'store'])->name('ckeditor.upload');

        // Social Media Settings
        Route::get('/social/settings', [SocialController::class, 'social'])->name('social');
        Route::post('/social/settings/{id}', [SocialController::class, 'socialUpdate'])->name('socialUpdate');

        // Theme Settings
        Route::get('/theme', 'ThemeController@theme')->name('theme');
        Route::post('/theme/update/{id}', 'ThemeController@themeUpdate')->name('themeUpdate');
    });
    Route::get('/logout', [AdminLoginController::class, 'adminLogout'])->name('adminLogout');
});

