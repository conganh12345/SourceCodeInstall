<!-- resources/views/welcome.blade.php -->

@section('title', 'Danh sách bài viết')

@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tin tức</h1>
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






