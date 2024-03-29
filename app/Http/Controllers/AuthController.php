<?php

namespace App\Http\Controllers;
use App\Services\AuthService;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('auth.login');
    }

    public function register(AuthRequest $request)
    {

        $result = $this->authService->registerUser($request);

        if ($result) {
            return to_route('auth.login')->with('success', 'Đăng ký thành công! Vui lòng chờ hệ thống xác nhận tài khoản trước khi đăng nhập');
        }

        return to_route('auth.register')->with('error', 'Đăng ký thất bại! Không thể gửi email xác nhận. Tài khoản có thể bị khóa hoặc không tồn tại.');

    }


    public function login(Request $request)
    {
        $result = $this->authService->loginUser($request);

        if ($result) {
            return to_route('article_details')->with('success', 'Đăng nhập thành công');
        }
            return to_route('auth.login')->with('error', 'Đăng nhập thất bại');
    }

    public function forgotPassword()
    {
        return view('auth.forgotPass');
    }

    public function postForgotPassword(EmailRequest $request)
    {
        $result = $this->authService->forgotPassword($request);

        if ($result) {
            return to_route('auth.login')->with('success', 'Vui lòng kiểm tra email để thực hiện thay đổi mật khẩu');
        }
            return back()->with('error', 'Email không tồn tại trong hệ thống');
    }

    public function getPassword($email)
    {
        $result = $this->authService->resetPasswordView($email);

        return view('auth.getPassword', ['email' => $email]);
    }

    public function getForgotPassword(PasswordRequest $request, $email)
    {
        $result = $this->authService->resetPassword($request, $email);

        if ($result) {
            return to_route('auth.login')->with('success', 'Đổi mật khẩu thành công, bạn có thể đăng nhập');
        }
    }

    public function editProfile()
    {
        $user = Auth::user();
        $result = $this->authService->editProfile($user);

        return view('admin.profile.update-profile', compact('user'));
    }

    public function editedProfile(ProfileRequest $request)
    {
        $user = Auth::user();
        $result = $this->authService->updateProfile($user, $request);

        if ($result) {
            return to_route('update_profile')->with('success', 'Hồ sơ đã được cập nhật thành công');
        }
            return back()->with('error', 'Cập nhật hồ sơ thất bại');
    }


}
