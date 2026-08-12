@extends('layouts.app')

@section('title', 'Checkout - ' . $product->name)

@section('content')
<div class="py-5" style="background-color: #FAF9FF; min-height: 100vh;">
    <div class="container">
        
        <!-- Breadcrumb / Back button -->
        <div class="mb-4">
            <a href="{{ route('shop.index') }}" class="text-decoration-none fw-semibold text-secondary d-inline-flex align-items-center gap-1">
                <i class="bi bi-arrow-left"></i> Kembali ke Toko Herbal
            </a>
        </div>

        <div class="row g-4">
            <!-- Left: Checkout Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-5 p-4 p-lg-5 bg-white">
                    <h2 class="fw-bold text-dark mb-2" style="font-family: 'Plus Jakarta Sans', sans-serif;">Informasi Pengiriman</h2>
                    <p class="text-secondary small mb-4">Mohon isi alamat lengkap dan nomor WhatsApp Anda untuk pengiriman produk herbal.</p>

                    <form action="{{ route('shop.order.store') }}" method="POST" id="checkout-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Quantity input (Syncs with total card on right) -->
                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-bold text-secondary small">Jumlah Pembelian</label>
                            <div class="input-group" style="max-width: 140px;">
                                <button class="btn btn-outline-secondary border-light-subtle rounded-start-3" type="button" onclick="changeQty(-1)">-</button>
                                <input type="number" name="quantity" id="quantity" class="form-control text-center border-light-subtle shadow-none" value="1" min="1" max="10" readonly required>
                                <button class="btn btn-outline-secondary border-light-subtle rounded-end-3" type="button" onclick="changeQty(1)">+</button>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="mb-4">
                            <label for="shipping_address" class="form-label fw-bold text-secondary small">Alamat Pengiriman Lengkap</label>
                            <textarea name="shipping_address" id="shipping_address" rows="4" class="form-control rounded-3 border-light-subtle p-3 small shadow-none" placeholder="Masukkan alamat lengkap rumah Anda (Jalan, No. Rumah, RT/RW, Kecamatan, Kota, Kode Pos)" required></textarea>
                        </div>

                        <!-- WhatsApp Number -->
                        <div class="mb-4">
                            <label for="whatsapp_number" class="form-label fw-bold text-secondary small">Nomor WhatsApp Aktif</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-light-subtle text-secondary small">+62</span>
                                <input type="tel" name="whatsapp_number" id="whatsapp_number" class="form-control rounded-end-3 border-light-subtle py-2.5 small shadow-none" placeholder="812xxxxxxxx" value="{{ Auth::check() ? preg_replace('/^\+?62|^0/', '', Auth::user()->phone ?? '') : '' }}" required>
                            </div>
                            <span class="text-muted small" style="font-size: 0.72rem;">Nomor ini digunakan kurir untuk menghubungi Anda saat pengantaran.</span>
                        </div>

                        <!-- Shipping Notes -->
                        <div class="mb-4">
                            <label for="notes" class="form-label fw-bold text-secondary small">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" id="notes" rows="2" class="form-control rounded-3 border-light-subtle p-3 small shadow-none" placeholder="Contoh: Titipkan di satpam, warna kemasan, dll."></textarea>
                        </div>

                        <button type="submit" class="btn text-white w-100 py-3 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2 mt-4 shadow-sm" style="background-color: #5E2CB5;">
                            <i class="bi bi-credit-card-fill"></i> Lanjutkan ke Pembayaran QRIS
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right: Order Summary Card -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-5 p-4 bg-white position-sticky" style="top: 100px;">
                    <h4 class="fw-bold text-dark mb-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">Ringkasan Pesanan</h4>

                    <!-- Product detail row -->
                    <div class="d-flex gap-3 mb-4">
                        <div class="rounded-4 overflow-hidden shadow-xs border" style="width: 100px; height: 100px; min-width: 100px;">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div>
                            <span class="badge bg-light text-secondary border px-2.5 py-1 rounded-pill small fw-medium mb-1">{{ $product->category }}</span>
                            <h5 class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">{{ $product->name }}</h5>
                            <div class="text-muted small">Harga satuan:</div>
                            <div class="fw-bold text-purple" style="color: #5E2CB5;">
                                ${{ number_format($product->price_usd, 2) }} <span class="text-muted fw-normal small">/ Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="border-light-subtle my-3">

                    <!-- Breakdown pricing -->
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary small">Harga (<span id="summary-qty">1</span> barang)</span>
                        <span class="text-dark fw-semibold small" id="summary-subtotal-usd">${{ number_format($product->price_usd, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary small">Pengiriman (Kurir Terapis Online)</span>
                        <span class="text-success fw-bold small">FREE</span>
                    </div>

                    <hr class="border-light-subtle my-3">

                    <!-- Total pricing -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-extrabold text-dark" style="font-size: 1.15rem;">Total Harga</div>
                            <div class="text-muted small">Sudah termasuk pajak</div>
                        </div>
                        <div class="text-end">
                            <div class="fs-4 fw-extrabold text-purple" style="color: #4C1D95 !important;" id="summary-total-usd">${{ number_format($product->price_usd, 2) }}</div>
                            <div class="text-muted small" id="summary-total-idr">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <!-- Safety badge -->
                    <div class="rounded-4 p-3 bg-light border mt-4 d-flex gap-2">
                        <i class="bi bi-shield-fill-check fs-4" style="color: #0D9488;"></i>
                        <div>
                            <h6 class="fw-bold text-dark mb-0 small">Transaksi Aman & Terenkripsi</h6>
                            <p class="text-secondary mb-0" style="font-size: 0.72rem; line-height: 1.4;">Data pemesanan obat/herbal Anda dijamin kerahasiaannya dan diproses oleh sistem admin Terapis Online.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const unitPriceIdr = {{ $product->price }};
    const unitPriceUsd = {{ $product->price_usd }};

    function changeQty(amount) {
        const qtyInput = document.getElementById('quantity');
        let currentQty = parseInt(qtyInput.value);
        let newQty = currentQty + amount;

        if (newQty >= 1 && newQty <= 10) {
            qtyInput.value = newQty;
            updateSummary(newQty);
        }
    }

    function updateSummary(qty) {
        const subtotalUsd = (unitPriceUsd * qty).toFixed(2);
        const totalIdr = unitPriceIdr * qty;

        document.getElementById('summary-qty').textContent = qty;
        document.getElementById('summary-subtotal-usd').textContent = '$' + parseFloat(subtotalUsd).toLocaleString('en-US', {minimumFractionDigits: 2});
        document.getElementById('summary-total-usd').textContent = '$' + parseFloat(subtotalUsd).toLocaleString('en-US', {minimumFractionDigits: 2});
        document.getElementById('summary-total-idr').textContent = 'Rp ' + totalIdr.toLocaleString('id-ID');
    }
</script>
@endsection
