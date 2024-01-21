<?php

namespace App\Http\Controllers;
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
    public function showFormLogin(){
        return view('auth.login');
    }
    public function register(AuthRequest $request)
    {


        // Thêm dữ liệu vào cơ sở dữ liệu sử dụng Eloquent

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status' => '0', // Giá trị mặc định là 0 (chờ phê duyệt)
        ]);
            // Gửi mail tới người đăng ký
        try {
            Mail::to($user->email)->send(new \App\Mail\VerifyAccount($user));
        } catch (\Exception $e) {
            // Nếu gửi email thất bại, đặt status thành 3
            $user->status = '3';

            $user->save();
            return redirect('/auth/register')->with('error', 'Đăng ký thất bại! Không thể gửi email xác nhận. Tài khoản có thể bị khóa hoặc không tồn tại.');
        }

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
        $user->status = '1';
        $user->save();


        return redirect('/auth/login')->with('success', 'Xác nhận tài khoản thành công! Bạn có thể đăng nhập ngay bây giờ.');
    }
    public function noverify($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Không tìm thấy người dùng, có thể xử lý thông báo lỗi hoặc chuyển hướng.
            return redirect('/')->with('error', 'Không tìm thấy người dùng.');
        }

        // Cập nhật trạng thái tùy thuộc vào giá trị status
        $user->status = '2';
        $user->save();

          return redirect()->route('auth.register')->with('success', 'Từ chối xác thực thành công.');
    }
    public function login(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        return redirect()->route('post', ['user' => Auth::user()])->with('success', 'Đăng nhập thành công');

        }

         else{
            return redirect()->route('auth.login')->with('error', 'Đăng nhập thất bại');
         }
}
    public function forgotpasswword(){
        return view('auth.forgotPass');
    }
    public function postforgotpassword(EmailRequest $request){
            // Kiểm tra xem email đã tồn tại hay chưa
            $existingUser = User::where('email', $request->input('email'))->first();

            if (!$existingUser) {
                // Email chưa tồn tại, tạo mới user
                return back()->with('error', 'Email không tồn tại trong hệ thống');

                // Thực hiện các công việc khác sau khi tạo user
            } else {
                Mail::to($existingUser->email)->send(new \App\Mail\MailForPassWord($existingUser));
                return redirect()->route('auth.login')->with('success', 'Vui lòng kiểm tra email để thực hiện thay đổi mật khẩu');
            }

    }
    public function getpasswword($email){


            $user = User::where('email', $email)->first();

            // Cập nhật trạng thái tùy thuộc vào giá trị status

            return view('auth.getPassword', ['email' => $email]);

    }

    public function getforgotpassword(PasswordRequest $request,$email){


        $user = User::where('email', $email)->first();


        // Cập nhật trạng thái tùy thuộc vào giá trị status
        $user->update([

            'password' => bcrypt($request->input('password')),

        ]);
        $user->save();
        return redirect()->route('auth.login')->with('success', 'Đổi mật khẩu thành công,bạn có thể đăng nhập');

}
        public function editProfile()
        {
            // Lấy thông tin người dùng từ Auth hoặc từ model User
            $user = Auth::user(); // Sử dụng Auth để lấy người dùng đã đăng nhập

            return view('Post.updateprofile', compact('user'));
        }

        public function editedProfile(ProfileRequest $request)
    {

        $user = Auth::user(); // Lấy thông tin người dùng từ Auth

        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('update_profile')->with('success', 'Hồ sơ đã được cập nhật thành công');
    }


}
