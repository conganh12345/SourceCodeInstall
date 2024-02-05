<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AllPostController;
use App\Http\Controllers\AllUserController;
use App\Http\Middleware\CheckLogin;
use App\Services\AuthService;
use App\Services\PostService;
use App\Services\AllPostService;
use App\Models\Post;
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

Route::group(['prefix' => 'auth'], function () {
    // Form đăng ký
    Route::get('/register', [AuthController::class, 'showFormRegister'])->middleware('user')->name('auth.register');
    Route::post('/register', [AuthController::class, 'register']);
    // Form đăng nhập
    Route::get('/login', [AuthController::class, 'showFormLogin'])->middleware('user')->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    // Form quên mật khẩu
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgotpass');
    Route::post('/forgot-password', [AuthController::class, 'postForgotPassword']);
    Route::get('/get-password/{email}', [AuthController::class, 'getPassword'])->name('auth.getpass');
    Route::post('/get-password/{email}', [AuthController::class, 'getForgotPassword']);

});
Route::group(['prefix' => 'auth'], function () {

    Route::view('/post','admin.layout.layout')->name('post');
    Route::get('/show-news',[PostController::class, 'allnews'])->name('article_details_news');
    Route::get('/show-news/{slug}',[PostController::class, 'newsSlug'])->name('news_details_news');

    Route::middleware(['admin'])->group(function () {
        Route::view('/home','home')->name('home');
        Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
        Route::get('/show-article-details',[PostController::class, 'articleDetails'])->name('article_details');
        Route::get('/show-news-details/{slug}',[PostController::class, 'newsDetails'])->name('news_details');
        Route::get('/update-profile',[AuthController::class, 'editProfile'])->name('update_profile');
        Route::post('/update-profile',[AuthController::class, 'editedProfile']);
    });

    Route::group(['middleware' => ['admin','role:user']], function () {
        Route::get('/list-post',[PostController::class, 'index'])->name('admin.listPosts');
        Route::post('/delete-post',[PostController::class, 'destroy'])->name('admin.deletePosts');
        Route::get('/delete-allpost',[PostController::class, 'destroyAll'])->name('admin.deleteUserPosts');
        Route::get('/add-post',[PostController::class, 'create'])->name('admin.createPost');
        Route::post('/add-post',[PostController::class, 'store'])->name('admin.storePost');
        Route::get('/edit-post/{post}',[PostController::class, 'edit'])->name('admin.editPost');
        Route::post('/edit-post/{post}',[PostController::class, 'update'])->name('admin.updatePost');
        Route::get('/show-post/{post}',[PostController::class, 'show'])->name('admin.showPost');

    });
});
Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => ['admin','role:admin']], function () {
        Route::get('/all-post-management',[AllPostController::class, 'index'])->name('admin.manageAllPosts');
        Route::get('/add-post',[AllPostController::class, 'create'])->name('admin.createAllPost');
        Route::post('/add-post',[AllPostController::class, 'store'])->name('admin.storeAllPost');
        Route::get('/edit-post/{post}',[AllPostController::class, 'edit'])->name('admin.editAllPost');
        Route::post('/edit-post/{post}',[AllPostController::class, 'update'])->name('admin.updateAllPost');
        Route::post('/delete-post',[AllPostController::class, 'destroy'])->name('admin.deleteAllPost');
        Route::get('/delete-allpost',[AllPostController::class, 'destroyAll'])->name('admin.deleteAllPosts');
        Route::get('/show-post/{post}',[AllPostController::class, 'show'])->name('admin.showAllPost');
        Route::get('/searchPost',[AllPostController::class, 'search'])->name('searchPost');

        Route::get('/all-user-management',[AllUserController::class, 'index'])->name('admin.manageAllUsers');
        Route::get('/edit-user/{user}',[AllUserController::class, 'edit'])->name('admin.editUser');
        Route::post('/edit-user/{user}',[AllUserController::class, 'update'])->name('admin.updateUser');
        Route::get('/searchUser',[AllUserController::class, 'search'])->name('searchUser');
    });
});


