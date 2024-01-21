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
            <a href="#"><b>Email Address</b></a>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Please enter the registered email address</p>

            <form method="POST" action="{{ url('/auth/forgot-password') }}">
                @csrf

                <div class="form-group">

                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"required>
                </div>
                @error('email')
                    <span style="color: red">{{ $message }}</span>
                @enderror

                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Send Mail</button>
                </div>
            </form>

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