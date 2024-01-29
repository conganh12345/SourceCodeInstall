<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;
use App\Services\AuthService;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Hiện trên ở giữa màn hình


//Test gửi mail qua Mailtrap
Route::get('testmail',function(){
    $name = "Các bạn";
    Mail::to('anhvca1234@gmail.com')->send(new \App\Mail\MyTestEmail($name));
});


Route::group(['prefix' => 'auth'], function () {
    // Form đăng ký
    Route::get('/register', [AuthController::class, 'showFormRegister'])->name('auth.register');
    Route::get('/verify-account/{email}', [AuthController::class, 'verify']);
    Route::get('/noverify-account/{email}', [AuthController::class, 'noverify']);
    Route::post('/register', [AuthController::class, 'register']);
    // Form đăng nhập
    Route::get('/login', [AuthController::class, 'showFormLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgotpass');
    Route::post('/forgot-password', [AuthController::class, 'postForgotPassword']);
    Route::get('/get-password/{email}', [AuthController::class, 'getPassword'])->name('auth.getpass');
    Route::post('/get-password/{email}', [AuthController::class, 'getForgotPassword']);

});
Route::group(['prefix' => 'auth'], function () {
    Route::view('/post','admin.layout.layout')->name('post');
    Route::view('/home','home')->name('home');
    Route::get('/list-post',[PostController::class, 'index'])->middleware('admin')->name('listpost');
    Route::post('/delete-post',[PostController::class, 'destroy'])->name('delete_post');
    Route::get('/delete-allpost',[PostController::class, 'destroyAll'])->name('delete_allpost');
    Route::get('/add-post',[PostController::class, 'create'])->name('add_post');
    Route::post('/add-post',[PostController::class, 'store'])->name('add_post_');
    Route::get('/edit-post/{id}',[PostController::class, 'edit'])->name('edit_post');
    Route::post('/edit-post/{id}',[PostController::class, 'update'])->name('edit_post_');
    Route::get('/show-post/{id}',[PostController::class, 'show'])->name('show_post');
    Route::get('/update-profile',[AuthController::class, 'editProfile'])->name('update_profile');
    Route::post('/update-profile',[AuthController::class, 'editedProfile']);
    Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('/show-article-details',[PostController::class, 'articleDetails'])->name('article_details');
    Route::get('/show-news-details/{slug}',[PostController::class, 'newsDetails'])->name('news_details');
});
