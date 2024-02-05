@extends('admin.layout.layout')

@section('title', 'Edit User')

@section('contents')
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Cập nhật thông tin người dùng</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{route('admin.updateUser',$user)}}">
                @csrf <!-- Thêm CSRF Token -->

                <div class="card-body">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="{{ $user->first_name }}">
                        @error('first_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="{{ $user->last_name }}">
                        @error('last_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Enter address">{{ $user->address }}</textarea>
                        @error('address')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>PENDING</option>
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>ACTIVE</option>
                            <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>REJECTED</option>
                            <option value="3" {{ $user->status == 3 ? 'selected' : '' }}>LOCKED</option>
                        </select>
                        @error('status')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </section>
@endsection
