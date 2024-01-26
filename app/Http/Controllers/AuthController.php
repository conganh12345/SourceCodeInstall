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
            return to_route('auth.login')->with('success', 'Đăng ký thành công! Vui lòng xác nhận tài khoản trước khi đăng nhập');
        } else {
            return to_route('auth.register')->with('error', 'Đăng ký thất bại! Không thể gửi email xác nhận. Tài khoản có thể bị khóa hoặc không tồn tại.');
        }
    }

    public function verify($email)
    {
        $result = $this->authService->verifyAccount($email);

        if ($result) {
            return to_route('auth.login')->with('success', 'Xác nhận tài khoản thành công! Bạn có thể đăng nhập ngay bây giờ.');
        } else {
            return redirect('/')->with('error', 'Không tìm thấy người dùng.');
        }
    }

    public function noverify($email)
    {
        $result = $this->authService->rejectVerification($email);

        if ($result) {
            return to_route('auth.register')->with('success', 'Từ chối xác thực thành công.');
        } else {
            return redirect('/')->with('error', 'Không tìm thấy người dùng.');
        }
    }

    public function login(Request $request)
    {
        $result = $this->authService->loginUser($request);

        if ($result) {
            return to_route('listpost', ['user' => Auth::user()])->with('success', 'Đăng nhập thành công');
        } else {
            return to_route('auth.login')->with('error', 'Đăng nhập thất bại');
        }
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
        } else {
            return back()->with('error', 'Email không tồn tại trong hệ thống');
        }
    }

    public function getPassword($email)
    {
        $result = $this->authService->resetPasswordView($email);

        if (!$result) {
            return redirect('/')->with('error', 'Không tìm thấy người dùng.');
        }

        return view('auth.getPassword', ['email' => $email]);
    }

    public function getForgotPassword(PasswordRequest $request, $email)
    {
        $result = $this->authService->resetPassword($request, $email);

        if ($result) {
            return to_route('auth.login')->with('success', 'Đổi mật khẩu thành công, bạn có thể đăng nhập');
        } else {
            return redirect('/')->with('error', 'Không tìm thấy người dùng.');
        }
    }

    public function editProfile()
    {

        // Lấy thông tin người dùng từ Auth hoặc từ model User
        $user = Auth::user();
        $result = $this->authService->editProfile($user);

        return view('post.update-profile', compact('user'));
    }

    public function editedProfile(ProfileRequest $request)
    {
        $user = Auth::user();
        $result = $this->authService->updateProfile($user, $request);

        if ($result) {
            return to_route('update_profile')->with('success', 'Hồ sơ đã được cập nhật thành công');
        } else {
            return back()->with('error', 'Cập nhật hồ sơ thất bại');
        }
    }
}
