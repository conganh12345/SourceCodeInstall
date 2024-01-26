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

        try {
            Mail::to($user->email)->send(new \App\Mail\VerifyAccount($user));
        } catch (\Exception $e) {
            $user->status = '3';
            $user->save();
            return false; // Thất bại
        }

        return true; // Thành công
    }

    public function verifyAccount($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false; // Thất bại
        }

        $user->status = '1';
        $user->save();

        return true; // Thành công
    }

    public function rejectVerification($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false; // Thất bại
        }

        $user->status = '2';
        $user->save();

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

        if (!$existingUser) {
            return false; // Thất bại
        }

        try {
            Mail::to($existingUser->email)->send(new \App\Mail\MailForPassWord($existingUser));
        } catch (\Exception $e) {
            return false; // Thất bại
        }

        return true; // Thành công
    }

    public function resetPasswordView($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false; // Thất bại
        }

        return true; // Thành công
    }

    public function resetPassword($request, $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false; // Thất bại
        }

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);

        $user->save();

        return true; // Thành công
    }

    public function editProfile($user)
    {

        if (!$user) {
            return false;
        }

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
