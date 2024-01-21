<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;
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

//Sử dụng Accessor để tạo attribute name từ first_name và last_name, có thể gọi $user->name
Route::get('user/{userId}', [AuthController::class, 'showUserName']);
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
    Route::get('/login', [AuthController::class, 'showFormlogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/forgot-password', [AuthController::class, 'forgotpasswword'])->name('auth.forgotpass');
    Route::post('/forgot-password', [AuthController::class, 'postforgotpassword']);
    Route::get('/get-password/{email}', [AuthController::class, 'getpasswword'])->name('auth.getpass');
    Route::post('/get-password/{email}', [AuthController::class, 'getforgotpassword']);

});
Route::group(['prefix' => 'auth'], function () {
    Route::view('/post','post')->middleware('admin')->name('post');
    Route::view('/home','home')->name('home');
    Route::view('/listpost','Post.listpost')->name('listpost');
    Route::get('/updateprofile',[AuthController::class, 'editProfile'])->name('update_profile');
    Route::post('/updateprofile',[AuthController::class, 'editedProfile']);
});
