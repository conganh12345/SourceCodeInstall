<!-- resources/views/admin/profile/edit.blade.php -->
@extends('admin.layout.layout')

@section('title', 'Update Profile')

@section('contents')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Profile') }}</div>


                <div class="card-body">

                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->first_name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->last_name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update_profile') }}">
                            @csrf


                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name"  value="{{ old('first_name') }}"required>
                                    @error('first_name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name"  value="{{ old('last_name') }}"required>
                                    @error('last_name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <textarea id="address" class="form-control" name="address" value="{{ old('address') }}"required></textarea>
                                    @error('address')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                                </div>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Profile') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        {{-- @if (session('success'))
                    <script>
                        toastr.options= {
                            "progressBar" :true,
                            "closebutton" :true,
                        }
                        toastr.success("{{ Session::get('success') }}");
                    </script>
                    @endif
                    @if (session('error'))
                    <script>
                        toastr.options= {
                            "progressBar" :true,
                            "closebutton" :true,
                        }
                        toastr.error("{{ Session::get('error') }}");
                    </script>
                    @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Thêm script để xử lý khi nhấn nút Home và nút Update Profile -->
@section('scripts')
    @parent
    <script>
        // Thêm sự kiện click cho nút Update Profile
        document.getElementById('update-profile-link').addEventListener('click', function() {
            // Chuyển đến trang Update Profile khi click
            window.location.href = "{{ route('update_profile') }}";
        });
    </script>
@endsection
