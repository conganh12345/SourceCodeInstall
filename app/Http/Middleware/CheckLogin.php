<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

            if ($user->status == '1') {
                return $next($request);
            } elseif ($user->status == '0') {
                Auth::logout();
                return redirect()->route('auth.login')->with('error', 'Tài khoản của bạn đang chờ xác nhận. Vui lòng kiểm tra email hoặc liên hệ hỗ trợ.');
            } elseif ($user->status == '2') {
                Auth::logout();
                return redirect()->route('auth.login')->with('error', 'Tài khoản của bạn đã bị từ chối');
            }
        } else {
            return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }
}
}
