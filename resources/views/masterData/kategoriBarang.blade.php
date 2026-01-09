<x-layout>
    <div class="ms-3">
        <h3 class="mb-0 h4 font-weight-bolder">Kategori Barang</h3>
        <p class="mb-2">
            Tabel Kategori barang yang tersedia untuk inventaris.
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
                            Nama Kategori
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Deskripsi
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Status
                        </th>
                        <th class="text-center text-secondary opacity-7">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $category->code }}
                                </p>
                            </td>

                            <td>
                                <p class="text-xs mb-0">
                                    {{ $category->name }}
                                </p>
                            </td>

                            <td>
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
                                <a href="#" class="text-secondary text-xs">
                                    Edit
                                </a>
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
</x-layout>
