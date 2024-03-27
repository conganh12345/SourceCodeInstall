<!-- resources/views/welcome.blade.php -->
@extends('admin.layout.layout')

@section('title', 'Danh sách bài viết')

@section('contents')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tin tức</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <!-- Button to create a new post -->
                    {{-- <a href="#" class="btn btn-success">Tạo mới</a> --}}
                    <!-- Button to delete all posts (you may replace '#delete-all' with the actual route) -->
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


