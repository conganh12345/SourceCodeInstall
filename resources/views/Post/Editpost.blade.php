@extends('admin.layout.layout')

@section('title', 'Add Post')


@section('contents')
<section class="content">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Sửa bài viết</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" placeholder="Enter slug">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" placeholder="Enter description"></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" placeholder="Enter content"></textarea>
                </div>
                <div class="form-group">
                    <label for="publish_date">Publish Date</label>
                    <input type="date" class="form-control" id="publish_date">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fileInput">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileInput">
                            <label class="custom-file-label" for="fileInput">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
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
