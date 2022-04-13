<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('administrator') }}">
        <!-- <div class="sidebar-brand-icon rotate-15">
            <i class="fas fa-laugh-wink .d-none .d-sm-block"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">Angelic</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('administrator') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Produk
    </div>

    <!-- Nav Item - Data barang -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('produk.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Data Barang</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - User Collapse Menu -->
    <li class="nav-item {{ session('userdata')->role == 'admin' ? 'd-none' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true"
            aria-controls="collapseUser">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola User:</h6>
                <a class="collapse-item" href="{{ url('administrator/user') }}">List User</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Data Kategori -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-archive"></i>
            <span>Data Kategori</span></a>
    </li>

    <!-- Nav Item - Data Tag -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('tag.list') }}">
            <i class="fas fa-fw fa-archive"></i>
            <span>Data Tag</span></a>
    </li>

    <!-- Nav Item - Data Ukuran -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ukuran.list') }}">
            <i class="fas fa-fw fa-archive"></i>
            <span>Data Ukuran</span></a>
    </li>

    <!-- Nav Item - Konten Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKonten" aria-expanded="true"
            aria-controls="collapseKonten">
            <i class="fas fa-fw fa-mail-bulk"></i>
            <span>Konten</span>
        </a>
        <div id="collapseKonten" class="collapse" aria-labelledby="headingKonten" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola Data Konten:</h6>
                <a class="collapse-item" href="{{ route('banner.list') }}">Banner</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Transaksi
    </div>

    <!-- Nav Item - Transaksi Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
            aria-expanded="true" aria-controls="collapseTransaksi">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTransaksi"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola Data Transaksi:</h6>
                <a class="collapse-item" href="{{ route('transaksi.neworder') }}">Order Masuk</a>
                <!-- Status: baru -->
                <a class="collapse-item" href="{{ route('transaksi.dibayar') }}">Sudah Dibayar</a>
                <!-- Status: dibayar -->
                <a class="collapse-item" href="{{ route('transaksi.dikemas') }}">Packaging</a>
                <!-- Status: dikemas -->
                <a class="collapse-item" href="{{ route('transaksi.dikirim') }}">Dikirim</a>
                <!-- Status: dikirim -->
                <a class="collapse-item" href="{{ route('transaksi.selesai') }}">Selesai</a>
                <!-- Status: selesai -->
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
