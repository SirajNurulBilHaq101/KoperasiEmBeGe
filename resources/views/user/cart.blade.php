<x-layout>
    <div class="container">
        <h3 class="mb-3 font-weight-bolder">Keranjang Belanja</h3>

        @if (empty($cart) || count($cart) === 0)
            <div class="alert alert-info text-center">
                Keranjang kosong
            </div>
        @else
            <div class="card mb-3">
                <div class="card-body table-responsive p-0">
                    <table class="table align-items-center mb-0 text-center">
                        <thead class="table">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Barang</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Qty</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Harga</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                    <td class="text-sm text-start">{{ $item['name'] }}</td>
                                    <td class="text-sm">{{ $item['qty'] }}</td>
                                    <td class="text-sm">Rp {{ number_format($item['price']) }}</td>
                                    <td class="text-sm">Rp {{ number_format($item['price'] * $item['qty']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-3 text-end">
                <h5>Total: <strong>Rp {{ number_format($total) }}</strong></h5>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.pesanan.checkout') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required
                                class="form-control">
                        </div>

                        <button type="submit" class="btn btn-dark w-100">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-layout>
