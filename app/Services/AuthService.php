<?php
// app/Services/AuthService.php

// app/Services/AuthService.php

namespace App\Services;

use App\Models\User;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyAccount;

use App\Mail\MailForPassWord;


class AuthService
{

    public function registerUser($requestData)
    {
        $user = User::create([
            'first_name' => $requestData->input('first_name'),
            'last_name' => $requestData->input('last_name'),
            'email' => $requestData->input('email'),
            'password' => bcrypt($requestData->input('password')),
            'status' => '0',
        ]);


        Mail::to($user->email)->send(new VerifyAccount($user));


        return true; // Thành công
    }



    public function loginUser($request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return true; // Thành công
        }

        return false; // Thất bại
    }

    public function forgotPassword($request)
    {
        $existingUser = User::where('email', $request->input('email'))->first();

        Mail::to($existingUser->email)->send(new MailForPassWord($existingUser));


        return true; // Thành công
    }

    public function resetPasswordView($email)
    {
        $user = User::where('email', $email)->first();

        return true; // Thành công
    }

    public function resetPassword($request, $email)
    {

        $user = User::where('email', $email)->first();

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);

        $user->save();

        return true; // Thành công
    }

    public function editProfile($user)
    {


        return true;
    }

    public function updateProfile($user, $requestData)
    {
        $user->update([
            'first_name' => $requestData->input('first_name'),
            'last_name' => $requestData->input('last_name'),
            'address' => $requestData->input('address'),
        ]);

        return true; // Thành công
    }
}
