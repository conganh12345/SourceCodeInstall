@extends('admin.layout.layout')

@section('title', 'Chi tiết bài viết')

@section('contents')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chi tiết bài viết</h3>
            </div>
            <div class="card-body">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->description }}</p>
                <p>{!! $post->content !!}</p>
            </div>
        </div>
    </section>
@endsection
