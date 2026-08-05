@extends('layouts.admin')

@section('title', 'Upload QRIS GoPay & Merchant - SerenePath Admin')

@section('content')
<div class="mb-4">
    <div class="d-flex align-items-center gap-2 mb-1">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.25rem;">Upload Gambar QRIS (GoPay & Merchant)</h1>
        <span class="badge text-white px-3 py-1.5 rounded-pill fw-bold" style="background-color: #5E2CB5;">GoPay / All Payment</span>
    </div>
    <p class="text-secondary mb-0">Unggah foto/gambar QRIS resmi (seperti GoPay, BCA, OVO, ShopeePay, DANA) untuk dijadikan rujukan pembayaran dinamis pasien.</p>
</div>

<div class="row g-4">
    <!-- Form Upload Gambar QRIS GoPay / Merchant -->
    <div class="col-lg-7">
        <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm">
            <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 48px; height: 48px; background-color: #5E2CB5;">
                    <i class="bi bi-qr-code-scan fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Form Upload QRIS GoPay / Bank</h5>
                    <div class="text-muted small">Pilih gambar file QRIS dari gallery atau komputer Anda.</div>
                </div>
            </div>

            <form action="{{ route('admin.qris.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Provider / Payment Category -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Penyedia / Merchant QRIS</label>
                    <select name="provider_name" class="form-select rounded-3 py-2.5">
                        <option value="GoPay Merchant QRIS" {{ ($setting->provider_name ?? '') == 'GoPay Merchant QRIS' ? 'selected' : '' }}>GoPay Merchant QRIS (GoTo Financial)</option>
                        <option value="BCA QRIS Merchant" {{ ($setting->provider_name ?? '') == 'BCA QRIS Merchant' ? 'selected' : '' }}>BCA QRIS Merchant</option>
                        <option value="ShopeePay Merchant" {{ ($setting->provider_name ?? '') == 'ShopeePay Merchant' ? 'selected' : '' }}>ShopeePay Merchant</option>
                        <option value="DANA / OVO QRIS" {{ ($setting->provider_name ?? '') == 'DANA / OVO QRIS' ? 'selected' : '' }}>DANA / OVO QRIS</option>
                        <option value="QRIS Standar Nasional (All Payment)" {{ ($setting->provider_name ?? '') == 'QRIS Standar Nasional (All Payment)' ? 'selected' : '' }}>QRIS Standar Nasional (All Payment)</option>
                    </select>
                </div>

                <!-- Nama Merchant -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Nama Toko / Merchant (Tertera di QRIS)</label>
                    <input type="text" name="merchant_name" class="form-control rounded-3 py-2.5" value="{{ $setting->merchant_name ?? 'SerenePath Mental Health' }}" placeholder="Contoh: SerenePath Therapy Center" required>
                </div>

                <!-- Kota Merchant -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Kota Merchant</label>
                    <input type="text" name="merchant_city" class="form-control rounded-3 py-2.5" value="{{ $setting->merchant_city ?? 'Jakarta' }}" placeholder="Contoh: Jakarta" required>
                </div>

                <!-- UPLOAD GAMBAR QRIS GOPAY / BANK -->
                <div class="mb-4 p-3.5 rounded-4" style="background-color: #F3E8FF; border: 2px dashed #5E2CB5;">
                    <label class="form-label fw-bold text-dark d-block mb-1">
                        <i class="bi bi-file-earmark-image me-1" style="color: #5E2CB5;"></i> Upload Gambar / Screenshot QRIS GoPay
                    </label>
                    <input type="file" name="qris_image" class="form-control rounded-3 py-2">
                    <div class="form-text small text-secondary mt-2">
                        <i class="bi bi-info-circle me-1"></i> Format: PNG, JPG, JPEG, SVG (Maks. 4MB). Anda dapat mengunggah screenshot gambar QRIS dari aplikasi GoPay Merchant, m-Banking, atau Canva.
                    </div>
                </div>

                <!-- String QRIS Payload (Opsional) -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-dark">String Payload QRIS (Opsional / EMVCo)</label>
                    <textarea name="static_payload" class="form-control font-monospace rounded-3 small" rows="3" placeholder="00020101021126580014ID.LINKAJA.WWW0118936009110021035252021520091100210352520303UMI51440014ID.CO.QRIS.WWW0215ID10200210352520303UMI5204581253033605802ID5910SerenePath6007Jakarta6304">{{ $setting->static_payload }}</textarea>
                </div>

                <button type="submit" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;">
                    <i class="bi bi-cloud-arrow-up-fill fs-5"></i>
                    <span>Simpan & Publish QRIS GoPay</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Live Preview Gambar QRIS GoPay / Bank -->
    <div class="col-lg-5">
        <div class="bg-white p-4 rounded-4 border shadow-sm text-center">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <span class="badge text-white px-3 py-1 rounded-pill small fw-bold" style="background-color: #5E2CB5;">
                    <i class="bi bi-wallet2 me-1"></i> {{ $setting->provider_name ?? 'GoPay Merchant' }}
                </span>
            </div>

            <h6 class="fw-bold text-dark mb-3">Tampilan QRIS yang Diunggah Admin</h6>

            <div class="p-3 bg-light rounded-4 d-inline-block border mb-3 shadow-sm" style="max-width: 320px;">
                @if(!empty($setting->qris_image))
                    <img src="{{ asset($setting->qris_image) }}" alt="QRIS GoPay Admin" class="img-fluid rounded-3 object-fit-contain" style="max-height: 320px; width: 100%;">
                @else
                    <div class="p-4 bg-white rounded-3">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=240x240&data={{ urlencode($setting->static_payload ?? 'SerenePath GoPay') }}" alt="QRIS Preview" class="img-fluid rounded-3 mb-2">
                        <div class="badge bg-secondary-subtle text-secondary small">Belum ada gambar diunggah</div>
                    </div>
                @endif
            </div>

            <div class="fw-bold text-dark fs-5 mb-0">{{ $setting->merchant_name ?? 'SerenePath Mental Health' }}</div>
            <div class="text-muted small mb-3">NMID: ID1020021035252 • {{ $setting->merchant_city ?? 'Jakarta' }}</div>
            
            <div class="alert alert-success border-0 rounded-4 small text-start mb-0" style="background-color: #ECFDF5; color: #047857;">
                <i class="bi bi-check-circle-fill me-1"></i> Gambar QRIS GoPay ini akan ditayangkan secara langsung pada halaman checkout pembayaran pasien saat melakukan booking konsultasi.
            </div>
        </div>
    </div>
</div>
@endsection
