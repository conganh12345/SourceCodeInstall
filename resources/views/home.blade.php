<!-- resources/views/welcome.blade.php -->
@extends('admin.layout.layout')

@section('title', 'Home')

@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Home</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <style>
                body {
                    display: flex;
                    min-height: 100vh;
                    width: 100vw;
                    justify-content: center;
                    align-items: center;
                    margin: 0;
                }

                h2 {
                    color: yellow;
                    background: white;
                    padding: 10px;
                    margin-top: 120px;
                }
            </style>

            <div class="text-center">
                <h2>Võ Công Anh</h2>
            </div>

            {{-- Thông báo đăng nhập thành công --}}
            @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

<!-- Thêm thẻ meta để xác định viewport -->
@section('head')
    @parent
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection

<!-- Thêm script để xử lý khi nhấn nút Home -->
@section('scripts')
    @parent
    <script>
        // Thêm sự kiện click cho nút Home
        document.getElementById('home-link').addEventListener('click', function() {
            // Chuyển đến trang Home khi click
            window.location.href = "{{ route('home') }}";
        });
    </script>
@endsection
