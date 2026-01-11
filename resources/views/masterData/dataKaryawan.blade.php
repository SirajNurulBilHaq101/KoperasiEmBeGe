<x-layout>
    <div class="mb-3">
        <h3 class="mb-0 h2 font-weight-bolder">Data Karyawan</h3>
        <p class="mb-2">
            Tabel karyawan yang terdaftar pada sistem.
        </p>
    </div>
    

    {{-- TABEL --}}
    <div class="card mb-4">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Email</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Role
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawans as $karyawan)
                        <tr>
                            <td class="align-middle text-center text-xs text-secondary mb-0 font-weight-bold">
                                {{ $karyawan->name }}</td>
                            <td class="align-middle text-center text-xs text-secondary mb-0">{{ $karyawan->email }}</td>
                            <td class="align-middle text-center text-xs text-secondary mb-0">
                                <span class="badge bg-gradient-dark">
                                    {{ str_replace('_', ' ', $karyawan->role) }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <form method="POST" action="{{ route('data-karyawan.destroy', $karyawan) }}"
                                    onsubmit="return confirm('Hapus karyawan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary text-sm">
                                Belum ada karyawan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-3 px-3">
            <div class="overflow-auto">
                {{ $karyawans->links() }}
            </div>
        </div>
    </div>

    {{-- FORM TAMBAH --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('data-karyawan.store') }}">
                @csrf
                <div class="row g-2">

                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Nama karyawan" required>
                    </div>

                    <div class="col-md-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="col-md-2">
                        <select name="role" class="form-select" required>
                            <option value="">Role</option>
                            <option value="karyawan_lapangan">Karyawan Lapangan</option>
                            <option value="operator_dashboard">Operator</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-dark w-100">
                            Tambah
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-layout>
