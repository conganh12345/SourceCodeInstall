@extends('admin.layout.layout')

@section('title', 'Edit Post')

@section('contents')
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa bài viết</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('admin.updatePost', $post) }}" enctype="multipart/form-data">
                @csrf <!-- Thêm CSRF Token -->

                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ $post->title }}">
                        @error('title')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug" value="{{ $post->slug }}">
                        @error('slug')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description">{{ $post->description }}</textarea>
                        @error('description')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Enter content">{{ $post->content }}</textarea>
                        @error('content')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="publish_date">Publish Date</label>
                        <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{  $post->publish_date }}">
                        @error('publish_date')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="{{ $post->status }}">
                        @error('status')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fileInput">Thumbnail</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileInput" name="thumbnail" onchange="displayFileName(this)">
                                <label class="custom-file-label" for="fileInput" id="fileInputLabel">Choose file</label>
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
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                placeholder: 'Nhập nội dung...',
                tabsize: 2,
                height: 300
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function removeVietnameseAccents(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        }

        $(document).ready(function() {
            // Khi người dùng nhập title, cập nhật giá trị của slug
            $('#title').on('input', function() {
                var title = $(this).val();
                var slug = removeVietnameseAccents(title).toLowerCase().replace(/\s+/g, '-');
                $('#slug').val(slug);
            });
        });
    </script>
    <script>
        function displayFileName(input) {
            // Lấy tệp tin đã chọn
            var fileName = input.files[0].name;

            // Hiển thị đường dẫn tệp tin trong label
            var label = document.getElementById('fileInputLabel');
            label.textContent = fileName;
        }
        </script>
@endsection
