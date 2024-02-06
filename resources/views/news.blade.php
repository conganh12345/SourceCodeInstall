<!-- resources/views/welcome.blade.php -->

@section('title', 'Danh sách bài viết')

@section('contents')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tin tức</h1>
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
                                                            <a href="{{ route('news_details_news', $post->slug) }}">{{ $post->title }}</a>
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





