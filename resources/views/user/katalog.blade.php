<x-layout>
    <div class="container py-4">
        {{-- Alerts --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h3 class="mb-4 font-weight-bolder">Katalog Barang</h3>

        <div class="row g-3 justify-content-start">
            @foreach ($items as $item)
                <div class="col-lg-4 d-flex">
                    <div class="card shadow-sm w-100 h-100 d-flex flex-column align-items-center">
                        {{-- Header --}}
                        <div class="card-header p-3 d-flex flex-column align-items-center gap-1 text-center w-100">
                            <p class="mb-1 h4 text-capitalize">{{ $item->name }}</p>

                            {{-- Stok --}}
                            @if ($item->quantity > 0)
                                <span class="text-success text-sm">{{ intval($item->quantity) }} {{ $item->unit }} tersedia</span>
                            @else
                                <span class="text-danger text-sm">Habis</span>
                            @endif

                            <h6 class="mb-0 mt-1">Rp {{ number_format($item->unit_price) }} / {{ $item->unit }}</h6>
                        </div>

                        <hr class="dark horizontal my-0 w-100">

                        {{-- Footer --}}
                        <div class="card-footer p-3 d-flex flex-column align-items-center gap-2 w-100">
                            {{-- Form tambah ke keranjang --}}
                            @if ($item->quantity > 0)
                                <form method="POST" action="{{ route('user.keranjang.store') }}"
                                    class="d-flex flex-column align-items-center gap-2 w-100">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="number" name="qty" value="1" min="1"
                                        max="{{ $item->quantity }}" class="form-control form-control-sm text-center"
                                        style="max-width: 120px;" aria-label="Jumlah" required>
                                    <button class="btn btn-dark btn-sm w-50 mt-1" type="submit">Tambah</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm w-50" disabled>Stok Habis</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
