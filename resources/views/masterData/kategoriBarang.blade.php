<x-layout>
    <div class="mb-3">
        <h3 class="mb-0 h2 font-weight-bolder">Kategori Barang</h3>
        <p class="mb-2">
            Tabel Kategori barang yang tersedia untuk inventaris.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-white">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="table-responsive px-3 py-3">
            <table id="kategoriTable" class="table table-striped table-hover align-items-center mb-0 w-100">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Kode
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Nama Kategori
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Deskripsi
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Status
                        </th>
                        <th class="text-secondary opacity-7 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td class="align-middle text-center">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $category->code }}
                                </p>
                            </td>

                            <td class="align-middle text-center">
                                <p class="text-xs mb-0">
                                    {{ $category->name }}
                                </p>
                            </td>

                            <td class="align-middle text-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $category->description ?? '-' }}
                                </p>
                            </td>

                            <td class="align-middle text-center text-sm">
                                @if ($category->is_active)
                                    <span class="badge badge-sm bg-gradient-success">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge badge-sm bg-gradient-secondary">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="align-middle text-center">
                                <form action="{{ route('kategori.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                            <td colspan="5" class="text-center text-xs text-secondary py-4">
                                Belum ada kategori
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <h3 class="mb-0 h4 font-weight-bolder">Tambah Kategori</h3>
                        <p class="mb-0">
                            Kategori yang ditambahkan akan masuk kedalam data aplikasi.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-icon btn-3 btn-info btn-lg w-100 mt-3" data-bs-toggle="modal"
                        data-bs-target="#modalTambahKategori">
                        <span class="btn-inner--icon">
                            <i class="material-symbols-rounded">add</i>
                        </span>
                        <span class="btn-inner--text">Tambah Kategori</span>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <!-- Nama Kategori -->
                            <div class="col-md-12">
                                <div class="input-group input-group-static my-3">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-md-12">
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

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#kategoriTable').DataTable({
                    pageLength: 10,
                    columnDefs: [{
                        orderable: false,
                        targets: 4 // kolom Aksi
                    }],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        zeroRecords: "Data tidak ditemukan",
                        paginate: {
                            next: "›",
                            previous: "‹"
                        }
                    }
                });
            });
        </script>
    @endpush

</x-layout>
