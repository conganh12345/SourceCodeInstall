<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Enums\UserStatus;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->status) {
                case UserStatus::PENDING:
                    Auth::logout();
                    return to_route('auth.login')->with('error', 'Tài khoản của bạn đang chờ xác nhận.');
                    break;

                case UserStatus::REJECTED:
                    Auth::logout();
                    return to_route('auth.login')->with('error', 'Tài khoản của bạn đã bị từ chối');
                    break;

                case UserStatus::LOCKED:
                    Auth::logout();
                    return to_route('auth.login')->with('error', 'Tài khoản của bạn đã bị khóa');
                    break;

                case UserStatus::ACTIVE:
                    return $next($request);
                    break;

                default:
                    return back()->with('error', 'Email hoặc mật khẩu không đúng');
                    break;
            }
        }
        return back()->with('error', 'Vui lòng đăng nhập trước khi vào trang');
    }
}
