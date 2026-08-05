@extends('layouts.therapist')

@section('title', 'Pengaturan Praktik - Terapis Online')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Pengaturan Praktik Terapis</h1>
    <p class="text-secondary mb-0">Kelola profil terapis Anda, tarif konsultasi sesi, dan preferensi akun.</p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm">
    <h5 class="fw-bold text-dark mb-4">Informasi Profil Terapis</h5>

    <form action="{{ route('therapist.settings.update') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold small text-dark">Nama Lengkap & Gelar</label>
                <input type="text" name="name" class="form-control rounded-3 py-2.5" value="{{ old('name', Auth::check() ? Auth::user()->name : 'Dr. Julian Vance') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold small text-dark">Email Terapis</label>
                <input type="email" name="email" class="form-control rounded-3 py-2.5" value="{{ old('email', Auth::check() ? Auth::user()->email : 'therapist@serenepath.com') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold small text-dark">Tarif Sesi Per Jam (Rp)</label>
                <input type="text" class="form-control rounded-3 py-2.5" value="Rp 350.000" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold small text-dark">Bidang Spesialisasi</label>
                <input type="text" name="specialty" class="form-control rounded-3 py-2.5" value="{{ old('specialty', Auth::check() ? (Auth::user()->specialty ?? 'Terapi Perilaku Kognitif (CBT), Kecemasan, Depresi') : 'Terapi Perilaku Kognitif (CBT), Kecemasan, Depresi') }}">
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-semibold small text-dark">Kata Sandi Baru (Opsional)</label>
                <input type="password" name="password" class="form-control rounded-3 py-2.5" placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>

            <div class="col-12 mb-3">
                <label class="form-label fw-semibold small text-dark">Biografi & Ringkasan Profesional</label>
                <textarea class="form-control rounded-3" rows="4">Terapis lisensi terverifikasi dengan pengalaman lebih dari 10 tahun yang mengkhususkan diri dalam terapi perilaku kognitif, pengelolaan kecemasan, dan teknik mindfulness.</textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <a href="{{ route('therapist.dashboard') }}" class="btn btn-light text-secondary border fw-semibold px-4 py-2 rounded-3">Batal</a>
            <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background-color: #5E2CB5;">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
