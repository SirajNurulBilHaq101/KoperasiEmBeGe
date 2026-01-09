<x-layout>
    <div class="ms-3">
        <h3 class="mb-0 h4 font-weight-bolder">Data Barang</h3>
        <p class="mb-2">
            Tabel data barang yang tersedia di inventaris.
        </p>
    </div>
    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">

                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Kode
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nama Barang
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Kategori
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Stok
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Harga Satuan
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Kadaluarsa
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Deskripsi
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            {{-- CODE --}}
                            <td>
                                <span class="text-xs font-weight-bold">
                                    {{ $item->code }}
                                </span>
                            </td>

                            {{-- NAME --}}
                            <td>
                                <h6 class="mb-0 text-xs">{{ $item->name }}</h6>
                                <p class="text-xs text-secondary mb-0">
                                    {{ $item->unit }}
                                </p>
                            </td>

                            {{-- CATEGORY --}}
                            <td>
                                <span class="text-xs text-secondary">
                                    {{ $item->category->name ?? '-' }}
                                </span>
                            </td>

                            {{-- QUANTITY --}}
                            <td class="align-middle text-center">
                                <span class="text-xs">
                                    {{ rtrim(rtrim($item->quantity, '0'), '.') }} {{ $item->unit }}
                                </span>
                            </td>

                            {{-- UNIT PRICE --}}
                            <td class="align-middle text-center">
                                <span class="text-xs">
                                    Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- EXPIRED --}}
                            <td class="align-middle text-center">
                                <span class="badge badge-sm bg-gradient-secondary">
                                    {{ $item->expired_at ? \Carbon\Carbon::parse($item->expired_at)->format('d M Y') : 'Tidak ada' }}
                                </span>
                            </td>

                            {{-- DESCRIPTION --}}
                            <td>
                                <span class="text-xs text-secondary">
                                    {{ $item->description ?? '-' }}
                                </span>
                            </td>

                            {{-- ACTION --}}
                            <td class="align-middle text-center">
                                <a href="#" class="text-secondary text-xs">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</x-layout>
