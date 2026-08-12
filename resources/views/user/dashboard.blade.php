@extends('layouts.app')

@section('title', 'Dashboard Pasien - Terapis Online')

@section('content')
<div class="bg-white py-4 min-vh-100">
    <div class="container">
        
        <!-- Hero Lavender Search Card -->
        <div class="p-5 mb-5 rounded-5 text-center position-relative overflow-hidden border-0" style="background-color: #F5F3FF;">
            <div class="max-w-2xl mx-auto py-3">
                <h1 class="display-5 fw-bold mb-3" style="color: #4C1D95; font-weight: 700; font-family: 'Inter', sans-serif;">
                    Temukan Terapis Pilihan Anda
                </h1>
                <p class="lead mb-4" style="font-size: 1.05rem; line-height: 1.6; color: #475569;">
                    Terhubung dengan psikolog dan terapis profesional terverifikasi untuk kesehatan mental Anda dalam ruang yang aman dan rahasia.
                </p>
                <div class="bg-white rounded-4 shadow-sm p-2 d-flex align-items-center max-w-lg mx-auto border" style="border-color: #E2E8F0 !important;">
                    <i class="bi bi-search text-muted fs-5 ms-3 me-2"></i>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none py-2" placeholder="Cari berdasarkan nama, spesialisasi, atau keluhan...">
                </div>
            </div>
        </div>

        <!-- Main Section: Specialized Support & Featured Therapists -->
        <div class="row g-4 mb-5">
            <!-- Left Column: Specialized Support -->
            <div class="col-lg-4">
                <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">Layanan Spesialisasi</h5>
                
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('user.search', ['specialty' => 'Anxiety']) }}" class="text-decoration-none bg-white p-3 rounded-4 border d-flex align-items-center justify-content-between text-dark shadow-sm hover-shadow transition-all" style="border-color: #E2E8F0 !important;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #F3E8FF; color: #6B46C1;">
                                <i class="bi bi-gear-fill"></i>
                            </div>
                            <span class="fw-semibold small" style="color: #1E293B;">Kecemasan & Stres</span>
                        </div>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>

                    <a href="{{ route('user.search', ['specialty' => 'Depression']) }}" class="text-decoration-none bg-white p-3 rounded-4 border d-flex align-items-center justify-content-between text-dark shadow-sm hover-shadow transition-all" style="border-color: #E2E8F0 !important;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #F3E8FF; color: #6B46C1;">
                                <i class="bi bi-emoji-frown-fill"></i>
                            </div>
                            <span class="fw-semibold small" style="color: #1E293B;">Depresi</span>
                        </div>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>

                    <a href="{{ route('user.search', ['specialty' => 'Family']) }}" class="text-decoration-none bg-white p-3 rounded-4 border d-flex align-items-center justify-content-between text-dark shadow-sm hover-shadow transition-all" style="border-color: #E2E8F0 !important;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #F3E8FF; color: #6B46C1;">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <span class="fw-semibold small" style="color: #1E293B;">Keluarga & Hubungan</span>
                        </div>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>

                    <a href="{{ route('user.search', ['specialty' => 'Stress']) }}" class="text-decoration-none bg-white p-3 rounded-4 border d-flex align-items-center justify-content-between text-dark shadow-sm hover-shadow transition-all" style="border-color: #E2E8F0 !important;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #F3E8FF; color: #6B46C1;">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <span class="fw-semibold small" style="color: #1E293B;">Karir & Burnout</span>
                        </div>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </div>
            </div>

            <!-- Right Column: Featured Therapists -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 1.25rem;">Terapis Pilihan</h5>
                    <a href="{{ route('user.search') }}" class="small text-decoration-none fw-semibold" style="color: #6B46C1;">Lihat Semua</a>
                </div>

                <div class="row g-3">
                    @forelse($therapists as $t)
                        <div class="col-md-6">
                            <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between" style="border-color: #E2E8F0 !important;">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <img src="{{ $t->avatar ?? 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&auto=format&fit=crop&q=80' }}" alt="{{ $t->name }}" class="rounded-circle object-fit-cover" style="width: 58px; height: 58px;">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0 text-truncate" title="{{ $t->name }}">{{ $t->name }}</h6>
                                        <div class="text-muted small text-truncate">{{ $t->title ?? 'Psikolog / Terapis' }}</div>
                                        <div class="text-warning small fw-bold mt-1">
                                            <i class="bi bi-star-fill"></i> {{ $t->rating ?? '4.9' }} <span class="text-muted font-normal">({{ rand(80,180) }} ulasan)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-1 mb-3">
                                    @php
                                        $specs = explode(',', $t->specialty ?? 'Kecemasan, Depresi');
                                    @endphp
                                    @foreach(array_slice($specs, 0, 2) as $s)
                                        <span class="badge bg-light text-secondary border fw-normal px-2 py-1">{{ trim($s) }}</span>
                                    @endforeach
                                </div>

                                <a href="{{ route('therapist.show', $t->id) }}" class="btn text-white w-100 py-2 fw-bold rounded-3" style="background-color: #5E2CB5;">
                                    Pesan Sekarang ({{ $t->price ?? 'Rp 350.000' }})
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4 bg-white rounded-4 border">
                            <p class="text-muted mb-0">Belum ada terapis terdaftar.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Section: My Upcoming Sessions -->
        <div class="mb-5">
            <h5 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;">Sesi Mendatang Saya</h5>
            
            <div class="bg-white p-4 rounded-4 border shadow-sm" style="border-color: #E2E8F0 !important; border-left: 5px solid #0D9488 !important;">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div class="d-flex align-items-center gap-4">
                        <!-- Date Badge Box -->
                        <div class="rounded-4 p-3 text-center d-flex flex-column justify-content-center" style="background-color: #F3E8FF; width: 80px; height: 80px; color: #5B21B6;">
                            <span class="small fw-bold uppercase" style="font-size: 0.75rem;">OKT</span>
                            <span class="fs-3 fw-extrabold" style="line-height: 1;">24</span>
                        </div>

                        <div>
                            <h5 class="fw-bold text-dark mb-1">Sesi Video Call dengan Dr. Sarah Jenkins</h5>
                            <div class="text-muted small">
                                <i class="bi bi-clock me-1"></i> 10:00 WIB - 10:50 WIB
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('user.sessions') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 small fw-semibold">
                            Jadwal Ulang
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo%20Dokter,%20saya%20siap%20memulai%20sesi%20konsultasi%20online." target="_blank" class="btn btn-success rounded-3 px-4 py-2 small fw-bold d-flex align-items-center gap-1">
                            <i class="bi bi-whatsapp"></i> Mulai Konsultasi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: My Herbal Orders (Pesanan Obat & Herbal) -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0" style="font-size: 1.25rem;">Pesanan Obat & Herbal Saya</h5>
                <a href="{{ route('shop.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-1.5 fw-bold shadow-xs" style="background-color: #5E2CB5; font-size: 0.8rem;">
                    <i class="bi bi-bag-plus-fill me-1"></i> Beli Herbal Baru
                </a>
            </div>

            @forelse($productOrders as $order)
                <div class="bg-white p-4 rounded-4 border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-left: 5px solid #5E2CB5 !important;">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $order->product->image }}" alt="{{ $order->product->name }}" class="rounded-3 border object-fit-cover" style="width: 60px; height: 60px;">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">{{ $order->product->name }} <span class="text-secondary small fw-normal">({{ $order->quantity }} pcs)</span></h6>
                                <div class="text-muted small mb-1">
                                    <i class="bi bi-calendar3 me-1"></i> Dipesan: {{ $order->created_at->format('d M Y') }} | Total: <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                                </div>
                                <div class="text-muted small text-truncate" style="max-width: 320px;" title="{{ $order->shipping_address }}">
                                    <i class="bi bi-geo-alt me-1"></i> Alamat: {{ $order->shipping_address }}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <!-- Status Badges -->
                            <div>
                                @if($order->status === 'completed')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-3 small">Selesai / Dikirim</span>
                                @elseif($order->status === 'accepted')
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-3 py-2 rounded-3 small">Sedang Dikemas</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-3 small">Dibatalkan</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-3 small">Menunggu Pembayaran</span>
                                @endif
                                
                                <div class="text-md-end mt-1">
                                    @if($order->payment_status === 'paid')
                                        <span class="badge bg-success text-white small" style="font-size: 0.7rem;">LUNAS VIA QRIS</span>
                                    @else
                                        <span class="badge bg-secondary text-white small" style="font-size: 0.7rem;">BELUM DIBAYAR</span>
                                    @endif
                                </div>
                            </div>

                            @if($order->payment_status === 'unpaid' && $order->status !== 'cancelled')
                                <a href="{{ route('shop.pay', $order->id) }}" class="btn text-white rounded-3 px-3 py-2 small fw-bold d-flex align-items-center gap-1 shadow-sm" style="background-color: #5E2CB5; font-size: 0.82rem;">
                                    <i class="bi bi-wallet2"></i> Bayar Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white p-4 rounded-4 border text-center py-5 shadow-xs" style="border-color: #E2E8F0 !important;">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-xs" style="width: 52px; height: 52px; background-color: #F3E8FF; color: #5E2CB5;">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <h6 class="fw-bold text-dark">Belum Ada Pesanan Herbal</h6>
                    <p class="text-secondary small mb-3">Butuh dukungan ekstra untuk rileks atau tidur nyenyak? Temukan kurasi produk obat & herbal di toko kami.</p>
                    <a href="{{ route('shop.index') }}" class="btn text-white rounded-3 px-4 py-2 small fw-bold shadow-sm" style="background-color: #5E2CB5; font-size: 0.85rem;">
                        Jelajahi Herbal Shop
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
