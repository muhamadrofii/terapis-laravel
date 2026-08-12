@extends('layouts.admin')

@section('title', 'Edit Klinik - ' . $clinic->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.clinics.index') }}" class="text-decoration-none fw-semibold text-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Klinik
    </a>
</div>

<div class="d-flex flex-column gap-1 mb-4">
    <h1 class="fw-bold text-dark" style="font-size: 2.25rem;">Edit Klinik</h1>
    <p class="text-secondary">Perbarui detail lokasi klinik offline terdaftar.</p>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 bg-white max-w-3xl">
    <form action="{{ route('admin.clinics.update', $clinic->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- Clinic Name -->
            <div class="col-md-12">
                <label for="name" class="form-label fw-bold text-secondary small">Nama Klinik</label>
                <input type="text" name="name" id="name" class="form-control rounded-3 py-2.5 small @error('name') is-invalid @enderror" placeholder="Contoh: Downtown Serenity Center" value="{{ old('name', $clinic->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Address -->
            <div class="col-md-12">
                <label for="address" class="form-label fw-bold text-secondary small">Alamat Lengkap</label>
                <input type="text" name="address" id="address" class="form-control rounded-3 py-2.5 small @error('address') is-invalid @enderror" placeholder="Contoh: 124 Wellness Ave, Suite 300" value="{{ old('address', $clinic->address) }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Distance -->
            <div class="col-md-6">
                <label for="distance" class="form-label fw-bold text-secondary small">Jarak dari Pusat Kota / Referensi</label>
                <input type="text" name="distance" id="distance" class="form-control rounded-3 py-2.5 small @error('distance') is-invalid @enderror" placeholder="Contoh: 2.4 mi" value="{{ old('distance', $clinic->distance) }}" required>
                @error('distance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Operating Hours -->
            <div class="col-md-6">
                <label for="hours" class="form-label fw-bold text-secondary small">Jam Operasional / Info Waktu</label>
                <input type="text" name="hours" id="hours" class="form-control rounded-3 py-2.5 small @error('hours') is-invalid @enderror" placeholder="Contoh: Until 8:00 PM" value="{{ old('hours', $clinic->hours) }}" required>
                @error('hours')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Latitude -->
            <div class="col-md-6">
                <label for="latitude" class="form-label fw-bold text-secondary small">Garis Lintang (Latitude)</label>
                <input type="number" step="any" name="latitude" id="latitude" class="form-control rounded-3 py-2.5 small @error('latitude') is-invalid @enderror" placeholder="Contoh: 47.6205" value="{{ old('latitude', $clinic->latitude) }}" required>
                @error('latitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Longitude -->
            <div class="col-md-6">
                <label for="longitude" class="form-label fw-bold text-secondary small">Garis Bujur (Longitude)</label>
                <input type="number" step="any" name="longitude" id="longitude" class="form-control rounded-3 py-2.5 small @error('longitude') is-invalid @enderror" placeholder="Contoh: -122.3493" value="{{ old('longitude', $clinic->longitude) }}" required>
                @error('longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Number -->
            <div class="col-md-6">
                <label for="phone" class="form-label fw-bold text-secondary small">Nomor Telepon Klinik (Opsional)</label>
                <input type="text" name="phone" id="phone" class="form-control rounded-3 py-2.5 small" placeholder="Contoh: +62 811-9988-7766" value="{{ old('phone', $clinic->phone) }}">
            </div>

            <!-- Is Open Checkbox -->
            <div class="col-md-6 d-flex align-items-center mt-lg-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_open" id="is_open" value="1" {{ old('is_open', $clinic->is_open) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold text-secondary small" for="is_open">
                        Tandai Klinik sebagai Buka (Open) saat ini
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn text-white px-5 py-3 rounded-3 fw-bold mt-4 shadow-sm" style="background-color: #5E2CB5;">
            <i class="bi bi-check-circle-fill me-2"></i> Perbarui Klinik
        </button>
    </form>
</div>
@endsection
