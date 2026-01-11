<x-layout>
    <div class="mb-3">
        <h3 class="mb-0 h2 font-weight-bolder">Data Barang</h3>
        <p class="mb-2">
            Tabel data barang yang tersedia di inventaris.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-white">
            {{ session('success') }}
        </div>
    @endif


    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">

                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Kode
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Nama Barang
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Input By
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Deskripsi
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            {{-- CODE --}}
                            <td class="align-middle text-center">
                                <span class="text-xs font-weight-bold">
                                    {{ $item->code }}
                                </span>
                            </td>

                            {{-- NAME --}}
                            <td class="align-middle text-center">
                                <h6 class="mb-0 text-xs">{{ $item->name }}</h6>
                                <p class="text-xs text-secondary mb-0">
                                    {{ $item->unit }}
                                </p>
                            </td>

                            {{-- CATEGORY --}}
                            <td class="align-middle text-center">
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

                            <td class="align-middle text-center">
                                <span class="text-xs text-secondary">
                                    {{ $item->user->name ?? '-' }}
                                </span>
                            </td>

                            {{-- DESCRIPTION --}}
                            <td class="align-middle text-center">
                                <span class="text-xs text-secondary">
                                    {{ $item->description ?? '-' }}
                                </span>
                            </td>

                            {{-- ACTION --}}
                            <td class="align-middle text-center">
                                <form action="{{ route('data-barang.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-xs text-secondary py-4">
                                Belum ada barang
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            
            <div class="d-flex justify-content-center mt-3 px-3">
                    {{ $items->links() }}
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <h3 class="mb-0 h4 font-weight-bolder">Tambah Barang</h3>
                        <p class="mb-0">
                            Barang yang ditambahkan akan masuk kedalam data aplikasi.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-icon btn-3 btn-info btn-lg w-100 mt-3" data-bs-toggle="modal"
                        data-bs-target="#modalTambahBarang">
                        <span class="btn-inner--icon">
                            <i class="material-symbols-rounded">add</i>
                        </span>
                        <span class="btn-inner--text">Tambah Barang</span>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <form action="{{ route('data-barang.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <!-- Kategori -->
                            <div class="col-md-6">
                                <div class="input-group input-group-static my-3">
                                    <label>Kategori</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="" hidden></option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Nama -->
                            <div class="col-md-6">
                                <div class="input-group input-group-static my-3">
                                    <label>Nama Barang</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>

                            <!-- Satuan -->
                            <div class="col-md-6">
                                <div class="input-group input-group-static my-3">
                                    <label>Satuan (kg / pcs / liter)</label>
                                    <input type="text" name="unit" class="form-control" required>
                                </div>
                            </div>

                            <!-- Harga -->
                            <div class="col-md-6">
                                <div class="input-group input-group-static my-3">
                                    <label>Harga Satuan</label>
                                    <input type="number" name="unit_price" class="form-control" min="0">
                                </div>
                            </div>

                            <!-- Stok -->
                            <div class="col-md-6">
                                <div class="input-group input-group-static my-3">
                                    <label>Jumlah</label>
                                    <input type="number" name="quantity" class="form-control" min="0">
                                </div>
                            </div>

                            <!-- Expired -->
                            <div class="col-md-6">
                                <div class="input-group input-group-static my-3">
                                    <label>Tanggal Kadaluarsa</label>
                                    <input type="date" name="expired_at" class="form-control">
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <div class="input-group input-group-static my-3">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn bg-gradient-primary">
                            Simpan
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

</x-layout>
