<aside id="sidenav-main"
    class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2">

    <hr class="horizontal dark mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        {{-- SIDEBAR --}}

        <ul class="navbar-nav">

            {{-- ================= ADMIN / PENGURUS ================= --}}
            @if (auth()->user()->role === 'admin')
                <li class="nav-item mt-3">
                    <h6 class="ps-2 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">
                        Main
                    </h6>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('stok-barang.index') }}"
                        class="nav-link {{ request()->routeIs('stok-barang.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">inventory</i>
                        <span class="nav-link-text ms-1">Stok Barang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('grafik-transaksi.index') }}"
                        class="nav-link {{ request()->routeIs('grafik-transaksi.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Grafik Transaksi</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-2 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">
                        Master Data
                    </h6>
                </li>

                <li class="nav-item">
                    <a href="{{ route('data-barang.index') }}"
                        class="nav-link {{ request()->routeIs('data-barang.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">inventory_2</i>
                        <span class="nav-link-text ms-1">Data Barang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kategori-barang.index') }}"
                        class="nav-link {{ request()->routeIs('kategori-barang.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">category</i>
                        <span class="nav-link-text ms-1">Kategori Barang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('data-karyawan.index') }}"
                        class="nav-link {{ request()->routeIs('data-karyawan.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">groups</i>
                        <span class="nav-link-text ms-1">Data Karyawan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('transaksi.pesanan.index') }}"
                        class="nav-link {{ request()->routeIs('transaksi.pesanan.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">receipt_long</i>
                        <span class="nav-link-text ms-1">Pesanan User</span>
                    </a>
                </li>
            @endif


            {{-- ================= USER / ANGGOTA ================= --}}
            @if (auth()->user()->role === 'user')
                <li class="nav-item mt-3">
                    <h6 class="ps-2 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">
                        Belanja
                    </h6>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.katalog.index') }}"
                        class="nav-link {{ request()->routeIs('user.katalog.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">store</i>
                        <span class="nav-link-text ms-1">Katalog Barang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.keranjang.index') }}"
                        class="nav-link {{ request()->routeIs('user.keranjang.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">shopping_cart</i>
                        <span class="nav-link-text ms-1">Keranjang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.pesanan.index') }}"
                        class="nav-link {{ request()->routeIs('user.pesanan.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}">
                        <i class="material-symbols-rounded opacity-5">receipt_long</i>
                        <span class="nav-link-text ms-1">Pesanan Saya</span>
                    </a>
                </li>
            @endif

        </ul>

    </div>

    {{-- ================= FOOTER (SELALU TAMPIL) ================= --}}
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    Log Out
                </button>
            </form>
        </div>
    </div>

</aside>
