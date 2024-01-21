<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Thêm đường dẫn đến CSS của AdminLTE -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">

    <!-- Không cần sử dụng đoạn mã CSS tùy chỉnh vì bạn đã sử dụng CSS của AdminLTE -->

</head>
<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Sign Up</b></a>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ url('/auth/login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <a href="{{ route('auth.forgotpass') }}" class="text-right">Forgot Password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </form>
            <!-- Nút "Chưa có tài khoản" -->
            <div style="margin-top: 20px; text-align: center;">
                <p>Chưa có tài khoản? <a href="{{ url('/auth/register') }}">Đăng ký ngay</a></p>
            </div>
            @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif
            @if(session('error'))
                <script>
                    alert("{{ session('error') }}");
                </script>
            @endif

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- Thêm đường dẫn đến các thư viện cần thiết của AdminLTE -->
    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>
</body>
</html>
