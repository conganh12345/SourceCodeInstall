<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{
    public function showUserName($userId)
    {
        $user = User::find($userId);

        if ($user) {
            echo "Tên admin:", $user->name;
        } else {
            echo "User not found";
        }
    }
    public function showFormRegister(){
        return view('auth.register');
    }
    public function register(AuthRequest $request)
    {


        // Thêm dữ liệu vào cơ sở dữ liệu sử dụng Eloquent

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status' => 0, // Giá trị mặc định là 0 (chờ phê duyệt)
        ]);

        if($acc = $user){
            Mail::to($acc->email)->send(new \App\Mail\VerifyAccount($acc));
        }
     // Điều hướng hoặc thực hiện các bước khác sau khi đăng ký thành công
        return redirect('/auth/login')->with('success', 'Đăng ký thành công! Vui lòng xác nhận tài khoản trước khi đăng nhập');

    }

    //Xử lý với nút xác thực tài khoản
        public function verify($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Không tìm thấy người dùng, có thể xử lý thông báo lỗi hoặc chuyển hướng.
            return redirect('/')->with('error', 'Không tìm thấy người dùng.');
        }

        // Cập nhật trạng thái tùy thuộc vào giá trị status
        $user->status = 1; // Hoặc giá trị khác tùy thuộc vào nhu cầu của bạn
        $user->save();

        // Điều hướng hoặc thực hiện các bước khác sau khi xác nhận thành công
        return redirect('/auth/login')->with('success', 'Xác nhận tài khoản thành công! Bạn có thể đăng nhập ngay bây giờ.');
    }

}
