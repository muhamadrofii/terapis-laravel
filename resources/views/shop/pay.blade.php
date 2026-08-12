@extends('layouts.app')

@section('title', 'Pembayaran QRIS Produk - Terapis Online')

@section('content')
@php
    $qrisSetting = \App\Models\QrisSetting::first();
@endphp

<div class="py-5" style="background-color: #F8FAFC; min-height: 100vh;">
    <div class="container">
        <div class="max-w-xl mx-auto">
            
            <!-- Payment Card -->
            <div class="bg-white p-4 p-md-5 rounded-5 border shadow-sm text-center">
                
                <!-- QRIS Header Logos -->
                <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/QRIS_logo.svg" alt="QRIS Logo" style="height: 28px;">
                    <span class="badge text-white px-2.5 py-1 rounded-pill fw-bold" style="background-color: #5E2CB5; font-size: 0.75rem;">
                        <i class="bi bi-lightning-charge-fill me-1"></i> QRIS DINAMIS OTOMATIS
                    </span>
                </div>

                <h3 class="fw-bold text-dark mb-1">Pembayaran Produk Herbal</h3>
                <p class="text-secondary small mb-4">Kode QR di bawah otomatis memuat nominal tagihan Anda. Pindai menggunakan E-Wallet (GoPay, OVO, DANA, LinkAja, ShopeePay) atau m-Banking pilihan Anda.</p>

                <!-- Amount Box -->
                <div class="p-3.5 rounded-4 mb-4" style="background-color: #F3E8FF; border: 2px dashed #5E2CB5; padding: 1.5rem !important;">
                    <div class="text-muted small fw-semibold text-uppercase">TOTAL TAGIHAN OTOMATIS</div>
                    <div class="d-flex align-items-center justify-content-center gap-2 my-1">
                        <div class="display-5 fw-extrabold" style="color: #5E2CB5; font-weight: 800;">
                            Rp {{ number_format($amountIdr, 0, ',', '.') }}
                        </div>
                        <button type="button" onclick="copyNominal({{ $amountIdr }})" class="btn btn-sm text-purple rounded-pill px-2.5 py-1 small fw-bold" style="background-color: #FFFFFF; color: #5E2CB5; border: 1px solid #5E2CB5;" title="Salin Nominal">
                            <i class="bi bi-copy me-1"></i> Salin
                        </button>
                    </div>
                    <div class="small text-secondary mt-2">
                        Produk: <strong>{{ $order->product->name }}</strong> ({{ $order->quantity }} pcs)<br>
                        Pengiriman: <strong>Kurir Terapis Online (FREE)</strong>
                    </div>
                </div>

                <!-- Dynamic QRIS Code Generated -->
                <div class="text-center p-3 bg-light rounded-4 border mb-4">
                    <div class="text-secondary small">Merchant QRIS Resmi:</div>
                    <div class="fw-bold text-dark mb-1 small">{{ $qrisSetting->merchant_name ?? 'Terapis Online Indonesia' }}</div>
                    
                    <!-- QR Code Image -->
                    <div class="p-3 bg-white rounded-3 border d-inline-block mb-2 shadow-sm">
                        <img src="{{ $qrImageUrl }}" alt="Dynamic QRIS Scannable Code" class="img-fluid rounded-3" style="width: 260px; height: 260px;">
                    </div>

                    <div class="d-flex align-items-center justify-content-center gap-1 text-success small fw-bold mb-1" style="font-size: 0.8rem;">
                        <i class="bi bi-check-circle-fill"></i> Nominal Rp {{ number_format($amountIdr, 0, ',', '.') }} Terisi Otomatis
                    </div>

                    <div class="text-muted font-monospace" style="font-size: 0.72rem;">NMID: ID1020021035252 • {{ $qrisSetting->merchant_city ?? 'Jakarta' }}</div>

                    <div class="mt-3 pt-3 border-top d-flex align-items-center justify-content-center gap-2">
                        <span class="spinner-grow spinner-grow-sm text-purple" style="color: #5E2CB5;" role="status"></span>
                        <span class="small fw-bold text-dark">Sisa Waktu Pembayaran: <span id="countdownTimer" class="fw-bold" style="color: #5E2CB5 !important;">14:59</span></span>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="text-start bg-light p-3.5 rounded-4 border mb-4 small text-secondary">
                    <div class="fw-bold text-dark mb-2"><i class="bi bi-shield-check text-success me-1"></i> Petunjuk Pembayaran:</div>
                    <ol class="mb-0 ps-3">
                        <li class="mb-1">Buka aplikasi m-Banking atau E-Wallet pilihan Anda.</li>
                        <li class="mb-1">Pilih menu <strong>Scan / QRIS</strong> lalu arahkan kamera ke Kode QR di atas.</li>
                        <li class="mb-1">Nominal tagihan <strong>Rp {{ number_format($amountIdr, 0, ',', '.') }}</strong> akan langsung terisi secara <strong>OTOMATIS</strong> di layar Anda tanpa perlu mengetik manual.</li>
                        <li>Selesaikan transaksi dan upload bukti screenshot Anda di bawah ini.</li>
                    </ol>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex flex-column gap-2">
                    <button type="button" class="btn text-white py-3 fw-bold rounded-4 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #5E2CB5;" data-bs-toggle="modal" data-bs-target="#uploadProofModal">
                        <i class="bi bi-cloud-arrow-up-fill fs-5"></i>
                        <span>Upload Bukti Pembayaran</span>
                    </button>

                    <a href="{{ route('user.dashboard') }}" class="btn btn-light text-secondary border py-2.5 rounded-4 small fw-semibold">
                        Bayar Nanti (Kembali ke Dashboard)
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Upload Bukti Transfer -->
<div class="modal fade" id="uploadProofModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-5 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark"><i class="bi bi-receipt me-2" style="color: #5E2CB5;"></i> Upload Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('shop.proof', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-4">
                    <p class="text-secondary small mb-3">Unggah screenshot resi pembayaran QRIS senilai <strong>Rp {{ number_format($amountIdr, 0, ',', '.') }}</strong>.</p>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">File Bukti Transfer (JPG, PNG, PDF)</label>
                        <input type="file" name="payment_proof" class="form-control rounded-3 py-2.5" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light text-secondary border rounded-3 px-3 py-2 small fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-3 px-4 py-2 small fw-bold shadow-sm" style="background-color: #5E2CB5;">Konfirmasi Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function copyNominal(amount) {
        navigator.clipboard.writeText(amount.toString());
        alert('Nominal Rp ' + amount.toLocaleString('id-ID') + ' berhasil disalin!');
    }

    let duration = 15 * 60;
    const timerDisplay = document.getElementById('countdownTimer');

    const timer = setInterval(() => {
        let minutes = parseInt(duration / 60, 10);
        let seconds = parseInt(duration % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        timerDisplay.textContent = minutes + ":" + seconds;

        if (--duration < 0) {
            clearInterval(timer);
            timerDisplay.textContent = "WAKTU HABIS";
        }
    }, 1000);
</script>
@endsection
