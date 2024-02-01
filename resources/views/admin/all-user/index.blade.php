<!-- resources/views/welcome.blade.php -->
@extends('admin.layout.layout')

@section('title', 'Quản lý người dùng')

@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý người dùng</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('searchUser') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tài khoản">

                            <!-- Thêm một dropdown để chọn loại tìm kiếm -->
                            <select name="search_type" class="form-control">
                                <option value="name">Theo tên</option>
                                <option value="email">Theo email</option>
                            </select>

                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách người dùng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Duyệt qua danh sách người dùng và hiển thị thông tin -->
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->status }}</td>
                                            <td>
                                                <!-- Button edit -->
                                                <a href="{{ route('edit_user', $user->id) }}" class="btn btn-warning btn-sm" style="margin-right: 10px;">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
