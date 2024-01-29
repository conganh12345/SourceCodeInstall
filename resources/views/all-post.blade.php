<!-- resources/views/welcome.blade.php -->
@extends('admin.layout.layout')

@section('title', 'Danh sách bài viết')

@section('contents')
<!-- Popup xác nhận xóa (Modal) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('delete_post') }}" method="POST">
            @csrf
                    <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Xóa bài viết</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="posts_delete_id" id="post_id">
                    <h5>Bạn có chắc là muốn xóa bài viết này không?</h5>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
      </div>
    </div>
  </div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tin tức</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <!-- Button to create a new post -->
                    <a href="{{route('add_post')}}" class="btn btn-success">Tạo mới</a>
                    <!-- Button to delete all posts (you may replace '#delete-all' with the actual route) -->

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

                                <tbody>
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="col-md-4">
                                                <div class="card">
                                                    @if($post->thumbnail)
                                                        <img src="{{ asset($post->thumbnail) }}" class="card-img-top" alt="Thumbnail">
                                                    @else
                                                        <div class="card-img-top" style="height: 150px; background-color: #ddd;"></div>
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <a href="{{ route('news_details', $post->slug) }}">{{ $post->title }}</a>
                                                        </h5>
                                                        <p class="card-text">{{ $post->publish_date }}</p>
                                                        <p class="card-text">{{ $post->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

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

@section('delete')
    <script>
        $(document).ready(function(){
            $('.deletePost').click(function(e){
                e.preventDefault();

                var post_id = $(this).val();
                $('#post_id').val(post_id);
                $('#deleteModal').modal('show');
            })
        })
    </script>
@endsection


