@extends('layouts.admin')

@section('title', 'Pengaturan QRIS & Nomor Rekening Admin - Terapis Online')

@section('content')
<div class="mb-4">
    <div class="d-flex align-items-center gap-2 mb-1">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.25rem;">Pengaturan QRIS & Nomor Rekening Admin</h1>
        <span class="badge text-white px-3 py-1.5 rounded-pill fw-bold" style="background-color: #5E2CB5;">Bank & QRIS Integration</span>
    </div>
    <p class="text-secondary mb-0">Kelola foto QRIS resmi dan Nomor Rekening Bank Admin yang terintegrasi langsung dengan sistem pembayaran pasien.</p>
</div>

<div class="row g-4">
    <!-- Form Upload Gambar QRIS & Pengaturan Rekening Bank Admin -->
    <div class="col-lg-7">
        <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm">
            <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 48px; height: 48px; background-color: #5E2CB5;">
                    <i class="bi bi-bank fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Form QRIS & Rekening Bank Utama</h5>
                    <div class="text-muted small">Atur metode pembayaran QRIS dan Rekening Bank Transfer Resmi.</div>
                </div>
            </div>

            <form action="{{ route('admin.qris.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- SECTION 1: QRIS MERCHANT -->
                <h6 class="fw-bold text-purple mb-3" style="color: #5E2CB5;"><i class="bi bi-qr-code-scan me-1"></i> Data Merchant QRIS</h6>

                <!-- Provider / Payment Category -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Penyedia / Merchant QRIS</label>
                    <select name="provider_name" class="form-select rounded-3 py-2.5">
                        <option value="QRIS Dinamis Bank / E-Wallet" {{ ($setting->provider_name ?? '') == 'QRIS Dinamis Bank / E-Wallet' ? 'selected' : '' }}>QRIS Dinamis Bank / E-Wallet</option>
                        <option value="GoPay Merchant QRIS" {{ ($setting->provider_name ?? '') == 'GoPay Merchant QRIS' ? 'selected' : '' }}>GoPay Merchant QRIS (GoTo Financial)</option>
                        <option value="BCA QRIS Merchant" {{ ($setting->provider_name ?? '') == 'BCA QRIS Merchant' ? 'selected' : '' }}>BCA QRIS Merchant</option>
                        <option value="ShopeePay Merchant" {{ ($setting->provider_name ?? '') == 'ShopeePay Merchant' ? 'selected' : '' }}>ShopeePay Merchant</option>
                        <option value="DANA / OVO QRIS" {{ ($setting->provider_name ?? '') == 'DANA / OVO QRIS' ? 'selected' : '' }}>DANA / OVO QRIS</option>
                    </select>
                </div>

                <!-- Nama Merchant -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Nama Toko / Merchant (Tertera di QRIS)</label>
                    <input type="text" name="merchant_name" class="form-control rounded-3 py-2.5" value="{{ $setting->merchant_name ?? 'Terapis Online Indonesia' }}" placeholder="Contoh: Terapis Online Indonesia" required>
                </div>

                <!-- Kota Merchant -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Kota Merchant</label>
                    <input type="text" name="merchant_city" class="form-control rounded-3 py-2.5" value="{{ $setting->merchant_city ?? 'Jakarta Selatan' }}" placeholder="Contoh: Jakarta Selatan" required>
                </div>

                <!-- UPLOAD GAMBAR QRIS GOPAY / BANK -->
                <div class="mb-4 p-3.5 rounded-4" style="background-color: #F3E8FF; border: 2px dashed #5E2CB5;">
                    <label class="form-label fw-bold text-dark d-block mb-1">
                        <i class="bi bi-file-earmark-image me-1" style="color: #5E2CB5;"></i> Upload Gambar / Screenshot QRIS
                    </label>
                    <input type="file" name="qris_image" class="form-control rounded-3 py-2">
                    <div class="form-text small text-secondary mt-2">
                        <i class="bi bi-info-circle me-1"></i> Format: PNG, JPG, JPEG, SVG (Maks. 4MB). Screenshot QRIS resmi admin.
                    </div>
                </div>

                <!-- String QRIS Payload (Opsional) -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-dark">String Payload QRIS (Opsional / EMVCo)</label>
                    <textarea name="static_payload" class="form-control font-monospace rounded-3 small" rows="2" placeholder="00020101021226680016ID.CO.QRIS.WWW01189360091400000000000215ID10200210352520303UME51440014ID.CO.QRIS.WWW02150000000000000005204581253033605802ID5924Terapis Online Indonesia6015Jakarta Selatan6304">{{ $setting->static_payload }}</textarea>
                </div>

                <hr class="my-4">

                <!-- SECTION 2: NOMOR REKENING BANK ADMIN -->
                <h6 class="fw-bold text-purple mb-3" style="color: #5E2CB5;"><i class="bi bi-credit-card-2-front me-1"></i> Data Nomor Rekening Bank Admin</h6>

                <!-- Nama Bank -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Nama Bank Transfer Admin</label>
                    <input type="text" name="bank_name" class="form-control rounded-3 py-2.5" value="{{ $setting->bank_name ?? 'Bank Central Asia (BCA)' }}" placeholder="Contoh: Bank Central Asia (BCA) / Mandiri / BRI">
                </div>

                <!-- Nomor Rekening -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Nomor Rekening Bank Admin</label>
                    <input type="text" name="bank_account_number" class="form-control rounded-3 py-2.5 font-monospace" value="{{ $setting->bank_account_number ?? '8830991204' }}" placeholder="Contoh: 8830991204">
                </div>

                <!-- Atas Nama Rekening -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-dark">Atas Nama Pemilik Rekening</label>
                    <input type="text" name="bank_account_holder" class="form-control rounded-3 py-2.5" value="{{ $setting->bank_account_holder ?? 'PT Terapis Online Indonesia' }}" placeholder="Contoh: PT Terapis Online Indonesia">
                </div>

                <button type="submit" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;">
                    <i class="bi bi-cloud-arrow-up-fill fs-5"></i>
                    <span>Simpan & Publish Pengaturan Pembayaran</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Live Preview QRIS & Rekening Bank Admin -->
    <div class="col-lg-5">
        <div class="bg-white p-4 rounded-4 border shadow-sm text-center">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <span class="badge text-white px-3 py-1 rounded-pill small fw-bold" style="background-color: #5E2CB5;">
                    <i class="bi bi-wallet2 me-1"></i> {{ $setting->provider_name ?? 'QRIS & Bank Admin' }}
                </span>
            </div>

            <h6 class="fw-bold text-dark mb-3">Preview Tampilan Halaman Pembayaran Pasien</h6>

            <!-- Preview QRIS -->
            <div class="p-3 bg-light rounded-4 d-inline-block border mb-3 shadow-sm" style="max-width: 320px;">
                @if(!empty($setting->qris_image))
                    <img src="{{ asset($setting->qris_image) }}" alt="QRIS Admin" class="img-fluid rounded-3 object-fit-contain" style="max-height: 280px; width: 100%;">
                @else
                    <div class="p-4 bg-white rounded-3">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=240x240&data={{ urlencode($setting->static_payload ?? 'Terapis Online Indonesia') }}" alt="QRIS Preview" class="img-fluid rounded-3 mb-2">
                        <div class="badge bg-secondary-subtle text-secondary small">QRIS Standar Sistem</div>
                    </div>
                @endif
            </div>

            <div class="fw-bold text-dark fs-5 mb-0">{{ $setting->merchant_name ?? 'Terapis Online Indonesia' }}</div>
            <div class="text-muted small mb-3">NMID: ID1020021035252 • {{ $setting->merchant_city ?? 'Jakarta Selatan' }}</div>

            <!-- Preview Card Rekening Bank Admin -->
            <div class="p-3 text-start rounded-4 border mb-3" style="background-color: #F8FAFC; border-color: #CBD5E1 !important;">
                <div class="d-flex align-items-center gap-2 mb-2" style="color: #5E2CB5;">
                    <i class="bi bi-bank fs-5"></i>
                    <span class="fw-bold small text-uppercase">Transfer Bank Direct Admin</span>
                </div>
                <div class="row g-1 small">
                    <div class="col-4 text-secondary">Nama Bank:</div>
                    <div class="col-8 fw-bold text-dark">{{ $setting->bank_name ?? 'Bank Central Asia (BCA)' }}</div>

                    <div class="col-4 text-secondary">No. Rekening:</div>
                    <div class="col-8 fw-bold font-monospace text-dark fs-6">{{ $setting->bank_account_number ?? '8830991204' }}</div>

                    <div class="col-4 text-secondary">Atas Nama:</div>
                    <div class="col-8 fw-bold text-dark">{{ $setting->bank_account_holder ?? 'PT Terapis Online Indonesia' }}</div>
                </div>
            </div>
            
            <div class="alert alert-success border-0 rounded-4 small text-start mb-0" style="background-color: #ECFDF5; color: #047857;">
                <i class="bi bi-check-circle-fill me-1"></i> Data QRIS dan Nomor Rekening Admin ini akan ditampilkan secara otomatis pada halaman pembayaran/checkout pasien.
            </div>
        </div>
    </div>
</div>
@endsection
