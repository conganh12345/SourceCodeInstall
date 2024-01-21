<!-- resources/views/welcome.blade.php -->
@extends('admin.layout.layout')

@section('title', 'Danh sách bài viết')

@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách bài viết</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bài viết mới nhất</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Publish Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Duyệt qua danh sách bài viết và hiển thị thông tin -->
                                    {{-- @foreach($posts as $post)
                                        <tr>
                                            <td><img src="{{ $post->thumbnail }}" alt="Thumbnail" style="max-width: 100px;"></td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->description }}</td>
                                            <td>{{ $post->publish_date }}</td>
                                            <td>{{ $post->status }}</td>
                                            <td>
                                                <!-- Icon delete -->
                                                <a href="{{ route('delete.post', ['id' => $post->id]) }}"><i class="fas fa-trash"></i></a>
                                                <!-- Icon edit -->
                                                <a href="{{ route('edit.post', ['id' => $post->id]) }}"><i class="fas fa-edit"></i></a>
                                                <!-- Icon show -->
                                                <a href="{{ route('show.post', ['id' => $post->id]) }}"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
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

<!-- Thêm thẻ meta để xác định viewport -->
@section('head')
    @parent
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection

<!-- Thêm script để xử lý khi nhấn nút Home -->
@section('scripts')
    @parent
    <script>
        // Thêm sự kiện click cho nút Xem danh sách bài viết
        document.getElementById('listpost-link').addEventListener('click', function() {
            // Chuyển đến trang Listpost khi click
            window.location.href = "{{ route('listpost') }}";
        });
    </script>
@endsection
