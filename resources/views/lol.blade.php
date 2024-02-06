<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/fontawesome-free/css/all.min.css') }}" />

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="{{ asset('/admin/dist/css/adminlte.min.css') }}" />

  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    @include('admin.layout.partials.header')
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include('admin.layout.partials.sidebar-left')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý bài viết</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('admin.createAllPost')}}" class="btn btn-success">Tạo mới</a>
                    <a href="{{route('admin.deleteAllPosts')}}" class="btn btn-danger" id="delete-all">Xóa tất cả</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('searchPost') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm bài viết" value="{{ old('search', isset($searchValue) ? $searchValue : '') }}">
                            <select name="search_type" class="form-control">
                                <option value="title" {{ old('search_type', isset($searchType) && $searchType == 'title' ? 'selected' : '') }}>Theo tiêu đề</option>
                                <option value="email" {{ old('search_type', isset($searchType) && $searchType == 'email' ? 'selected' : '') }}>Theo email</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách bài viết</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="data-table">
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    @include('admin.layout.partials.footer')
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js') }}"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (session('success'))
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
@endif

<script>
    $(document).ready(function(){
        $('.deletePost').click(function(e){
            e.preventDefault();
            var post_id = $(this).val();
            $('#post_id').val(post_id);
            $('#deleteModal').modal('show');
        })
    })

    $(document).ready( function () {
        $('#data-table').DataTable({
            "processing" :true,
            "serverSide" :true,
            "ajax": "{{route('getPosts')}}",
            "columns": [
                { "data": 'thumbnail' },
                { "data": 'title' },
                { "data": 'description' },
                { "data": 'publish_date' },
                { "data": 'status' },
                { "data": 'action' },
            ],
        });
    });
</script>

</body>
</html>
