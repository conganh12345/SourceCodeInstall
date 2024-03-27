<!-- resources/views/welcome.blade.php -->
@extends('admin.layout.layout')
<style>
    td.title,
    td.description {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@section('title', 'Danh sách bài viết')

@section('contents')
<!-- Popup xác nhận xóa (Modal) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.deletePosts') }}" method="POST">
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

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách bài viết</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('admin.createPost')}}" class="btn btn-success">Tạo mới</a>
                    <a href="{{route('admin.deleteUserPosts')}}" class="btn btn-danger" id="delete-all">Xóa tất cả</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bài viết mới nhất</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Thumbnail</th>
                                        <th class="title">Title</th>
                                        <th class="description">Description</th>
                                        <th>Publish Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>
                                                @if($post->thumbnail)
                                                <img src="{{ asset($post->thumbnail) }}" alt="Thumbnail" style="max-width: 100px; max-height: 120px; width: auto; height: auto;">
                                            @else
                                                <p>No thumbnail available</p>
                                            @endif

                                            </td>
                                            <td class="title">
                                                {{ $post->title }}
                                            </td>
                                            <td class="description">
                                                {{ $post->description }}
                                            </td>
                                            <td>{{ $post->publish_date }}</td>
                                            <td>
                                                @if($post->status == '1')
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td class="actions">
                                                    <button onclick="window.location='{{ route('admin.showPost', $post) }}';" class="btn btn-info btn-sm" style="margin-right: 10px;"><i class="fas fa-eye"></i></button>

                                                    <button onclick="window.location='{{ route('admin.editPost', $post) }}';" class="btn btn-warning btn-sm" style="margin-right: 10px;"><i class="fas fa-edit"></i></button>

                                                    <button class="btn btn-danger btn-sm deletePost" value="{{$post->id}}"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{-- {{ $posts->links() }} --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('head')
    @parent
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection

@section('scripts')
    @parent
    <script>
        document.getElementById('listpost-link').addEventListener('click', function() {
            window.location.href = "{{ route('admin.listPosts') }}";
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


