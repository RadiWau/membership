<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}" >
                <a href="/dashboard">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="la la-folder-open-o"></i>
                    <span class="menu-title" data-i18n="Templates">Penjualan</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::is('penjualan/kasir') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.penjualan.kasir')}}">
                            <span data-i18n="Horizontal">Kasir</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('penjualan/transaksi') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.penjualan.transaksi')}}"><i></i>
                            <span data-i18n="Horizontal">Transaksi</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="la la-folder-open-o"></i>
                    <span class="menu-title" data-i18n="Templates">Pembelian</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::is('pembelian/pengajuan') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.pembelian.pengajuan.index')}}">
                            <span data-i18n="Horizontal">Pengajuan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="Master Data">Master Data</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="#"><i></i><span data-i18n="Vertical">Customers</span></a>
                        <ul class="menu-content">
                            <li class="{{ Request::is('master-data/customer') ? 'active' : '' }}">
                                <a class="menu-item" href="{{route('apps.master-data.customers.index')}}"><i></i><span data-i18n="Classic Menu">List Customers</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item" href="#"><i></i><span data-i18n="Vertical">Supplier</span></a>
                        <ul class="menu-content">
                            <li class="{{ Request::is('master-data/supplier') ? 'active' : '' }}">
                                <a class="menu-item" href="{{route('apps.master-data.supplier.index')}}"><i></i><span data-i18n="Classic Menu">List Supplier</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item" href="#"><i></i><span data-i18n="Vertical">Sales</span></a>
                        <ul class="menu-content">
                            <li class="{{ Request::is('master-data/sales') ? 'active' : '' }}">
                                <a class="menu-item" href="{{route('apps.master-data.sales.index')}}"><i></i><span data-i18n="Classic Menu">List Sales</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item" href="#"><i></i><span data-i18n="Vertical">Jasa Service</span></a>
                        <ul class="menu-content">
                            <li class="{{ Request::is('master-data/jasa') ? 'active' : '' }}">
                                <a class="menu-item" href="{{route('apps.master-data.jasa.index')}}"><i></i><span data-i18n="Classic Menu">List Jasa Service</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item" href="#"><i></i><span data-i18n="Vertical">Produk</span></a>
                        <ul class="menu-content">
                            <li class="{{ Request::is('master-data/produk') ? 'active' : '' }}">
                                <a class="menu-item" href="{{route('apps.master-data.produk.index')}}"><i></i><span data-i18n="Classic Menu">List Produk</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="la la-folder-open-o"></i>
                    <span class="menu-title" data-i18n="Templates">Laporan</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::is('laporan/kas') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.laporan.kas.index')}}">
                            <span data-i18n="Horizontal">Kas</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('laporan/piutang') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.laporan.piutang.index')}}">
                            <span data-i18n="Horizontal">Piutang</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('laporan/keuangan') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.laporan.keuangan.index')}}">
                            <span data-i18n="Horizontal">Keuangan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="la la-folder-open-o"></i>
                    <span class="menu-title" data-i18n="Templates">Konfigurasi</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::is('konfigurasi/user') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.konfigurasi.user.index')}}">
                            <span data-i18n="Horizontal">Users</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('konfigurasi/role') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.konfigurasi.role.index')}}">
                            <span data-i18n="Horizontal">Role</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('konfigurasi/general') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('apps.konfigurasi.general.index')}}">
                            <span data-i18n="Horizontal">General</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
