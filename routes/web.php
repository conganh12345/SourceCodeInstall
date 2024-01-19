<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
//Form đăng ký
Route::get('/register', [AuthController::class, 'showFormRegister']);
Route::get('/verify-account/{email}', [AuthController::class, 'verify']);
Route::post('/register', [AuthController::class, 'register']);


Route::group(['prefix' => 'auth'], function () {
    Route::view('login', 'auth.login');
});
