<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Thêm đường dẫn đến CSS của AdminLTE -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
    <!-- Thêm đường dẫn đến Font Awesome để sử dụng icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="hold-transition register-page">

    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>Log In</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <form method="POST" action="{{ route('auth.register') }}">
                @csrf

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                </div>

                @error('first_name')
                    <span style="color: red">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                </div>

                @error('last_name')
                    <span style="color: red">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                </div>

                @error('email')
                    <span style="color: red">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" required>
                </div>

                @error('password')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword"  required>
                </div>

                @error('confirmpassword')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </form>

        <div style="margin-top: 20px; text-align: center;">
            <p>Đã có tài khoản? <a href="{{ url('/auth/login') }}">Đăng nhập ngay</a></p>
        </div>
        </div>
    </div>

    @if (Session::has('success'))
    <script>
        toastr.options= {
            "progressBar" :true,
            "closebutton" :true,
        }
        toastr.success("{{ Session::get('success') }}");
    </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.options= {
                "progressBar" :true,
                "closebutton" :true,
            }
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif

    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
