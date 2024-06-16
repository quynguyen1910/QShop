<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu row" id="side-menu">
            <li class="">
                <a class="d-block text-decoration-none text-capitalize" href="{{ route('admin.index') }}"><i
                        class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li class="">
                <a class="d-block text-decoration-none text-capitalize" href="{{ route('admin.user.index') }}">
                    <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                    <span class="nav-label">Quản lý Tài Khoản</span></a>
            </li>
            <li class="">
                <a class="d-block text-decoration-none text-capitalize" href="{{ route('admin.product.index') }}">
                    <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                    <span class="nav-label">Quản lý sản phẩm</span></a>
            </li>
            <li class="">
                <a class="d-block text-decoration-none text-capitalize" href="{{ route('admin.category.index') }}">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="nav-label">Quản lý danh mục</span></a>
            </li>
        </ul>

    </div>
</nav>
