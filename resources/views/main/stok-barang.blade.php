<x-layout>
    <div class="mb-0">
        <h3 class="mb-0 h2 font-weight-bolder">Data Barang</h3>
        <p class="mb-2">
            Tabel data barang yang tersedia di inventaris.
        </p>
    </div>

    {{-- RINGKASAN --}}
    <div class="row mb-2">

        <div class="col-md-4 mb-2">
            <div class="card bg-gradient-danger text-white">
                <div class="card-body">
                    <p class="text-sm mb-1">Stok Habis</p>
                    <h4 class="mb-0 text-white">
                        {{ $stokHabis->count() }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-2">
            <div class="card bg-gradient-warning text-white">
                <div class="card-body">
                    <p class="text-sm mb-1">Stok Menipis (≤ 5)</p>
                    <h4 class="mb-0 text-white">
                        {{ $stokMenipis->count() }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-2">
            <div class="card bg-gradient-dark text-white">
                <div class="card-body">
                    <p class="text-sm mb-1">Total Jenis Barang</p>
                    <h4 class="mb-0 text-white">
                        {{ $items->count() }}
                    </h4>
                </div>
            </div>
        </div>

    </div>

    {{-- KARTU STOK --}}
    <div class="row">
        @forelse ($items as $item)
            @php
                if ($item->total_quantity <= 0) {
                    $status = 'Habis';
                    $badge = 'danger';
                } elseif ($item->total_quantity <= 5) {
                    $status = 'Menipis';
                    $badge = 'warning';
                } else {
                    $status = 'Aman';
                    $badge = 'success';
                }
            @endphp

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100">

                    {{-- HEADER --}}
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-sm mb-0">
                                    {{ $item->name }}
                                </p>
                                <h5 class="mb-0">
                                    {{ rtrim(rtrim($item->total_quantity, '0'), '.') }}
                                    {{ $item->unit }}
                                </h5>
                            </div>

                            <span class="badge bg-gradient-{{ $badge }} text-xs">
                                {{ $status }}
                            </span>
                        </div>
                    </div>

                    <hr class="dark horizontal my-0">

                    {{-- FOOTER --}}
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-1 text-sm">
                            Kategori:
                            <span class="text-secondary">
                                {{ $item->category->name ?? '-' }}
                            </span>
                        </p>

                        <p class="mb-0 text-sm">
                            Expired terdekat:
                            <span class="text-secondary">
                                {{ $item->nearest_expired ? \Carbon\Carbon::parse($item->nearest_expired)->format('d M Y') : 'Tidak ada' }}
                            </span>
                        </p>
                    </div>

                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center text-secondary text-sm">
                        Belum ada stok barang
                    </div>
                </div>
            </div>
        @endforelse
    </div>


    {{-- DAFTAR BARANG EXPIRED --}}
    @if ($expiredItems->count())
        <div class="row mt-0">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 text-danger">Barang Expired</h6>
                        <p class="text-sm text-secondary mb-0">
                            Daftar item yang sudah melewati tanggal kedaluwarsa
                        </p>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                            Kode Barang
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                            Nama
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                            Qty
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                            Expired
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expiredItems as $expired)
                                        <tr>
                                            <td class="text-sm text-center">
                                                {{ $expired->code }}
                                            </td>
                                            <td class="text-sm text-center">
                                                {{ $expired->name }}
                                            </td>
                                            <td class="text-sm text-center">
                                                {{ rtrim(rtrim($expired->quantity, '0'), '.') }}
                                                {{ $expired->unit }}
                                            </td>
                                            <td class="text-sm text-center text-danger">
                                                {{ \Carbon\Carbon::parse($expired->expired_at)->format('d M Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

</x-layout>
