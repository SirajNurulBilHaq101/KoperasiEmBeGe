<x-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-0">
        <h3 class="mb-0 h2 font-weight-bolder">Daftar Pesanan User</h3>
        <p class="mb-2">Lihat semua pesanan, bukti pembayaran, dan ubah status langsung dari table.</p>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive px-3 py-3">
                        <table id="orderTable"
                            class="table table-striped table-hover align-items-center mb-0 w-100 text-center">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">User</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Total</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Bukti Bayar
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    @php
                                        switch ($order->status) {
                                            case 'pending':
                                                $badge = 'bg-secondary';
                                                break;
                                            case 'confirmed':
                                                $badge = 'bg-info';
                                                break;
                                            case 'processed':
                                                $badge = 'bg-warning';
                                                break;
                                            case 'completed':
                                                $badge = 'bg-success';
                                                break;
                                            case 'cancelled':
                                                $badge = 'bg-danger';
                                                break;
                                            default:
                                                $badge = 'bg-dark';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-sm">{{ $loop->iteration }}</td>
                                        <td class="text-sm text-start">
                                            <strong>{{ $order->user->name }}</strong><br>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                        </td>
                                        <td class="text-sm">{{ $order->created_at->format('d M Y H:i') }}</td>
                                        <td class="text-sm">Rp {{ number_format($order->total) }}</td>
                                        <td class="text-sm">
                                            <span class="badge {{ $badge }} text-xs">
                                                {{ strtoupper($order->status) }}
                                            </span>
                                        </td>
                                        <td class="text-sm">
                                            @if ($order->payment_proof)
                                                <a href="{{ asset('payment-proofs/' . $order->payment_proof) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('payment-proofs/' . $order->payment_proof) }}"
                                                        style="height:50px; object-fit:cover; border:1px solid #ccc; border-radius:4px">
                                                </a>
                                            @else
                                                <span class="text-muted">Belum ada</span>
                                            @endif
                                        </td>
                                        <td class="text-sm">
                                            @if (!in_array($order->status, ['completed', 'cancelled']))
                                                <form method="POST"
                                                    action="{{ route('transaksi.pesanan.update-status', $order->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-select form-select-sm"
                                                        onchange="this.form.submit()">
                                                        <option disabled selected>Ubah Status</option>

                                                        @if ($order->status === 'pending')
                                                            <option value="confirmed">Confirmed</option>
                                                            <option value="cancelled">Cancelled</option>
                                                        @endif

                                                        @if ($order->status === 'confirmed')
                                                            <option value="processed">Processed</option>
                                                            <option value="cancelled">Cancelled</option>
                                                        @endif

                                                        @if ($order->status === 'processed')
                                                            <option value="completed">Completed</option>
                                                        @endif
                                                    </select>
                                                </form>
                                            @else
                                                <span class="text-muted">Tidak ada aksi</span>
                                            @endif
                                        </td>
                                        <td class="text-sm">
                                            <button class="btn btn-sm btn-primary btn-detail" data-bs-toggle="modal"
                                                data-bs-target="#detailModal" data-order='@json($order)'>
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Belum ada pesanan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Detail Pesanan -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                {{-- HEADER --}}
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bolder">Detail Pesanan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                {{-- BODY --}}
                <div class="modal-body">

                    {{-- Info User dan Tanggal --}}
                    <div id="order-info" class="mb-3 p-3"></div>

                    {{-- Table Items --}}
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Barang</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Harga</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Qty</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="order-items"></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th id="order-total" class="fw-bold text-center"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', function() {

                const order = JSON.parse(this.dataset.order);

                // ===== ORDER INFO =====
                document.getElementById('order-info').innerHTML = `
            <div class="mb-3">
                <p class="mb-1"><strong>Nama:</strong> ${order.user.name}</p>
                <p class="mb-1"><strong>Email:</strong> ${order.user.email}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge 
                        ${order.status === 'pending' ? 'bg-secondary' : ''}
                        ${order.status === 'confirmed' ? 'bg-info' : ''}
                        ${order.status === 'processed' ? 'bg-warning' : ''}
                        ${order.status === 'completed' ? 'bg-success' : ''}
                        ${order.status === 'cancelled' ? 'bg-danger' : ''} text-xs">
                        ${order.status.toUpperCase()}
                    </span>
                </p>
                <p class="mb-0"><strong>Tanggal:</strong> ${order.created_at}</p>
            </div>
        `;

                // ===== ITEM PESANAN =====
                let rows = '';
                order.items.forEach((item, i) => {
                    rows += `
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1 justify-content-center">
                            <span class="text-xs font-weight-bold text-secondary">${i + 1}</span>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${item.item.name}</p>
                    </td>
                    <td class="align-middle text-center text-xs font-weight-bold">
                        Rp ${Number(item.price).toLocaleString()}
                    </td>
                    <td class="align-middle text-center text-xs font-weight-bold">
                        ${item.qty}
                    </td>
                    <td class="align-middle text-center text-xs font-weight-bold">
                        Rp ${(item.price * item.qty).toLocaleString()}
                    </td>
                </tr>
            `;
                });

                document.getElementById('order-items').innerHTML = rows;
                document.getElementById('order-total').innerHTML =
                    `Rp ${Number(order.total).toLocaleString()}`;
            });
        });
    </script>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#orderTable').DataTable({
                    pageLength: 10,
                    scrollX: true,
                    columnDefs: [{
                            orderable: false,
                            targets: [6, 7]
                        } // Aksi & Detail
                    ],
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
