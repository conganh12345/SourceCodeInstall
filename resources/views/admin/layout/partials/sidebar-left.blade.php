<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
    <span class="brand-text font-weight-light">AdminLTE</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('update_profile') }}" class="nav-link" id="update-profile-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hồ sơ</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('listpost') }}" class="nav-link" id="listpost-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Xem danh sách bài viết</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" id="logout-link">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>Đăng xuất</p>
                </a>
            </li>


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

<script>

    // Lắng nghe sự kiện click trên mục menu và thêm class "active"
    document.getElementById('update-profile-link').addEventListener('click', function () {
        setActiveLink(this.id); // Đặt mục menu hiện tại thành "active"
    });

    document.getElementById('listpost-link').addEventListener('click', function () {
        setActiveLink(this.id);
    });




    // Hàm đặt mục menu hiện tại thành "active"
    function setActiveLink(linkId) {
        // Loại bỏ class "active" từ tất cả các mục menu
        var menuItems = document.querySelectorAll('.nav-link');
        menuItems.forEach(function (item) {
            item.classList.remove('active');
        });

        // Thêm class "active" cho mục menu hiện tại
        document.getElementById(linkId).classList.add('active');

        // Lưu trạng thái vào localStorage
        localStorage.setItem('activeLink', linkId);
    }

    // Kiểm tra trạng thái khi trang được load lại
    window.onload = function () {
        var activeLink = localStorage.getItem('activeLink');
        if (activeLink) {
            setActiveLink(activeLink);
        } else {
            // Nếu không có mục menu nào được lưu, kiểm tra trang hiện tại và đặt mục menu phù hợp
            var currentPath = window.location.pathname;
            var defaultLink = findLinkByPath(currentPath);

            if (defaultLink) {
                setActiveLink(defaultLink.id);
            }
        }
    };

    // Hàm tìm mục menu dựa trên đường dẫn URL
    function findLinkByPath(path) {
        var links = document.querySelectorAll('.nav-link');
        for (var i = 0; i < links.length; i++) {
            var href = links[i].getAttribute('href');
            if (path.includes(href)) {
                return links[i];
            }
        }
        return null;
    }
</script>
