<x-layout>
    <div class="mb-0">
        <h3 class="mb-0 h2 font-weight-bolder">Pesanan User</h3>
        <p class="mb-2">Daftar pesanan yang dibuat oleh user beserta status dan total pembayaran.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan.</div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">#</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Tanggal
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Total</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        @php
                                            switch ($order->status) {
                                                case 'pending':
                                                    $badge = 'secondary';
                                                    break;
                                                case 'confirmed':
                                                    $badge = 'info';
                                                    break;
                                                case 'processed':
                                                    $badge = 'warning';
                                                    break;
                                                case 'completed':
                                                    $badge = 'success';
                                                    break;
                                                case 'cancelled':
                                                    $badge = 'danger';
                                                    break;
                                                default:
                                                    $badge = 'dark';
                                            }
                                        @endphp
                                        <tr>
                                            <td class="text-sm text-center">{{ $loop->iteration }}</td>
                                            <td class="text-sm text-center">
                                                {{ $order->created_at->format('d M Y H:i') }}</td>
                                            <td class="text-sm text-center">Rp {{ number_format($order->total) }}</td>
                                            <td class="text-sm text-center">
                                                <span class="badge bg-gradient-{{ $badge }} text-xs">
                                                    {{ strtoupper($order->status) }}
                                                </span>
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
