<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="" class="d-block">Admin</a>
        </div>
    </div>

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
            <li class="nav-header">Daftar Menu</li>
            <li class="nav-item">
                <a href="{{ url('/pelanggan') }}" class="nav-link {{ $activeMenu == 'pelanggan' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Pelanggan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/produk') }}" class="nav-link {{ $activeMenu == 'produk' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-laptop"></i>
                    <p>Produk</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/transaksi') }}" class="nav-link {{ $activeMenu == 'transaksi' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-bag"></i>
                    <p>Penjualan</p>
                </a>
            </li>
        </ul>
    </nav>
</div>