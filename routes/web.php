<?php

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
Route::get('/', function () {
    return view('home');
});
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
    Route::post('/login', [AuthController::class, 'login'])->middleware('admin');
});
