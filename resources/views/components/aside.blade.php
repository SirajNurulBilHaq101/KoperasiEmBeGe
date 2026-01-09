<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- Main --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Main</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link active bg-gradient-dark text-white" href="../pages/dashboard.html">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Stok Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/tables.html">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Grafik Transaksi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/billing.html">
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Total Penjualan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/virtual-reality.html">
                    <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                    <span class="nav-link-text ms-1">Saldo Kas</span>
                </a>
            </li>
            {{-- Master Data --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Master Data</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('data-barang.index') }}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Data Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('kategori-barang.index') }}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Kategori Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/billing.html">
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Satuan dan Harga</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/virtual-reality.html">
                    <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                    <span class="nav-link-text ms-1">Data Karyawan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/virtual-reality.html">
                    <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                    <span class="nav-link-text ms-1">Data Supplier</span>
                </a>
            </li>
            {{-- Manajemen Stok --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Manajemen Stok</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/dashboard.html">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Stok Masuk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/tables.html">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Stok Keluar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/billing.html">
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Mutasi Stok</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/virtual-reality.html">
                    <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                    <span class="nav-link-text ms-1">Penyesuaian Stok</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/virtual-reality.html">
                    <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                    <span class="nav-link-text ms-1">Kartu stok</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/virtual-reality.html">
                    <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                    <span class="nav-link-text ms-1">Stok Opname</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-danger w-100" type="submit">
                    Log Out
                </button>
            </form>
        </div>

    </div>
</aside>
