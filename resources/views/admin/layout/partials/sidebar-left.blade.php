

<!-- Brand Logo -->

<a href="index3.html" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="brand-text font-weight-light">AdminLTE</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div> -->

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('update_profile') }}" class="nav-link {{ Request::is('update_profile') ? 'active' : '' }}" id="update-profile-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Hồ sơ</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('listpost') }}" class="nav-link {{ Request::is('listpost') ? 'active' : '' }}" id="listpost-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Xem danh sách bài viết</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pages/examples/projects.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Projects</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Other Menu Item</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->

  </div>
  <!-- /.sidebar -->
