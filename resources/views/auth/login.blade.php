<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Thêm đường dẫn đến CSS của AdminLTE -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">

    <!-- Thêm đoạn mã CSS tùy chỉnh -->
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #d2d6de; /* Màu nền của trang */
        }

        .login-box {
            width: 320px;
        }

        .login-box-body {
            background-color: #fff; /* Màu nền của form */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #d2d6de; /* Màu viền của input */
            border-radius: 5px;
        }

        .checkbox {
            margin-bottom: 20px;
        }

        .btn {
            background-color: #4caf50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Sign Up</b> </a>
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
                        <!-- Thêm class "text-right" để căn phải -->
                        <a href="{{ url('/password/reset') }}" class="text-right">Forgot Password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </form>

            {{-- Thông báo đăng nhập thành công --}}
            @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
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
