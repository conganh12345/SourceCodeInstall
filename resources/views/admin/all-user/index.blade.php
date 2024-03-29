<!-- resources/views/welcome.blade.php -->
@extends('admin.layout.layout')

@section('title', 'Quản lý người dùng')

@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý người dùng</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('searchUser') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tài khoản" value="{{ old('search', isset($searchValue) ? $searchValue : '') }}">
                            <select name="search_type" class="form-control">
                                <option value="name" {{ old('search_type', isset($searchType) && $searchType == 'name' ? 'selected' : '') }}>Theo tên</option>
                                <option value="email" {{ old('search_type', isset($searchType) && $searchType == 'email' ? 'selected' : '') }}>Theo email</option>
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
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>
                                                @if($user->status == '0')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($user->status == '1')
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($user->status == '2')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @elseif($user->status == '3')
                                                    <span class="badge badge-secondary">Locked</span>
                                                @else
                                                    {{ $user->status }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.editUser', $user) }}" class="btn btn-warning btn-sm" style="margin-right: 10px;">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
