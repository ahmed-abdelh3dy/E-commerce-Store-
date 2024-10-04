<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item ">
            <a href="" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Starter Pages
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.categories.index') }}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>categories
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.products.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>products</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>orders</p>
            </a>
        </li>
    </ul>
    </ul>
</nav>
<!-- /.sidebar-menu -->
