@extends('layouts.app')

@section('title', 'Pengaturan Profil - Terapis Online')

@section('content')
<div class="py-4 bg-light min-vh-100">
    <div class="container">
        
        <div class="mb-4">
            <h1 class="display-6 fw-bold text-dark mb-1" style="font-weight: 800;">Pengaturan Profil</h1>
            <p class="text-secondary">Kelola informasi pribadi Anda, kontak, dan keamanan kata sandi.</p>
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

<style>
    .nav-pills .nav-link {
        color: #64748B !important;
        background-color: transparent !important;
        border: none;
    }
    .nav-pills .nav-link.active {
        color: #FFFFFF !important;
        background-color: #5E2CB5 !important;
    }
    .nav-pills .nav-link:hover:not(.active) {
        background-color: #F8FAFC !important;
        color: #5E2CB5 !important;
    }
</style>

        <div class="row g-4">
            <!-- Left Sidebar Navigation -->
            <div class="col-lg-3">
                <div class="bg-white p-3 rounded-4 border shadow-sm">
                    <div class="nav flex-column nav-pills gap-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active text-start fw-semibold py-2.5 px-3 rounded-3 border-0 d-flex align-items-center" id="pill-info-tab" data-bs-toggle="pill" data-bs-target="#pill-info" type="button" role="tab" aria-controls="pill-info" aria-selected="true" style="transition: all 0.2s ease;">
                            <i class="bi bi-person me-2 fs-5"></i> Informasi Pribadi
                        </button>
                        <button class="nav-link text-start text-secondary fw-semibold py-2.5 px-3 rounded-3 border-0 d-flex align-items-center" id="pill-notif-tab" data-bs-toggle="pill" data-bs-target="#pill-notif" type="button" role="tab" aria-controls="pill-notif" aria-selected="false" style="transition: all 0.2s ease;">
                            <i class="bi bi-bell me-2 fs-5"></i> Notifikasi
                        </button>
                        <button class="nav-link text-start text-secondary fw-semibold py-2.5 px-3 rounded-3 border-0 d-flex align-items-center" id="pill-security-tab" data-bs-toggle="pill" data-bs-target="#pill-security" type="button" role="tab" aria-controls="pill-security" aria-selected="false" style="transition: all 0.2s ease;">
                            <i class="bi bi-shield-lock me-2 fs-5"></i> Keamanan & Kata Sandi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Main Form Container (Dynamic Tab Content) -->
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- TAB 1: Informasi Pribadi -->
                    <div class="tab-pane fade show active bg-white p-4 p-md-5 rounded-4 border shadow-sm" id="pill-info" role="tabpanel" aria-labelledby="pill-info-tab">
                        <h5 class="fw-bold text-dark mb-4">Informasi Pribadi</h5>

                        <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                            <img id="avatarPreview" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80" alt="Avatar" class="rounded-circle object-fit-cover" style="width: 80px; height: 80px;">
                            <div>
                                <input type="file" id="avatarInput" class="d-none" accept="image/*" onchange="if(this.files[0]) { document.getElementById('avatarPreview').src = URL.createObjectURL(this.files[0]); }">
                                <button type="button" onclick="document.getElementById('avatarInput').click()" class="btn btn-purple-light text-purple fw-semibold rounded-3 px-3 py-2 small me-2" style="background-color: #F3E8FF; color: #5E2CB5;">Unggah Foto</button>
                                <button type="button" onclick="document.getElementById('avatarPreview').src='https://via.placeholder.com/150';" class="btn btn-light text-secondary border fw-semibold rounded-3 px-3 py-2 small">Hapus Foto</button>
                            </div>
                        </div>

                        <form action="{{ route('user.settings.update') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-dark">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control rounded-3 py-2.5" value="{{ old('name', Auth::check() ? Auth::user()->name : ($user->name ?? 'Sarah Jenkins')) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-dark">Alamat Email</label>
                                    <input type="email" name="email" class="form-control rounded-3 py-2.5" value="{{ old('email', Auth::check() ? Auth::user()->email : ($user->email ?? 'sarah.j@example.com')) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-dark">Nomor Telepon / WA</label>
                                    <input type="text" name="phone" class="form-control rounded-3 py-2.5" value="{{ old('phone', Auth::check() ? (Auth::user()->phone ?? '+62 812-3456-7890') : ($user->phone ?? '+62 812-3456-7890')) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-dark">Zona Waktu</label>
                                    <select class="form-select rounded-3 py-2.5">
                                        <option selected>Asia/Jakarta (WIB - GMT+7)</option>
                                        <option>Asia/Makassar (WITA - GMT+8)</option>
                                        <option>Asia/Jayapura (WIT - GMT+9)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-light text-secondary border fw-semibold px-4 py-2 rounded-3">Batal</a>
                                <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background-color: #5E2CB5;">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>

                    <!-- TAB 2: Notifikasi -->
                    <div class="tab-pane fade bg-white p-4 p-md-5 rounded-4 border shadow-sm" id="pill-notif" role="tabpanel" aria-labelledby="pill-notif-tab">
                        <h5 class="fw-bold text-dark mb-4">Pengaturan Notifikasi</h5>

                        <form onsubmit="event.preventDefault(); alert('Pengaturan notifikasi berhasil disimpan!');">
                            <div class="d-flex flex-column gap-3 mb-4">
                                <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">Notifikasi Email</h6>
                                        <span class="text-secondary small">Kirim pengingat jadwal sesi dan faktur pembayaran ke email Anda.</span>
                                    </div>
                                    <div class="form-check form-switch fs-5">
                                        <input class="form-check-input" type="checkbox" role="switch" checked style="cursor: pointer;">
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">Pengingat WhatsApp</h6>
                                        <span class="text-secondary small">Kirim pemberitahuan otomatis sesi dimulai langsung ke nomor WhatsApp Anda.</span>
                                    </div>
                                    <div class="form-check form-switch fs-5">
                                        <input class="form-check-input" type="checkbox" role="switch" checked style="cursor: pointer;">
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">Pembaruan Promosi & Edukasi</h6>
                                        <span class="text-secondary small">Kirim info artikel kesehatan mental terbaru dan promo menarik.</span>
                                    </div>
                                    <div class="form-check form-switch fs-5">
                                        <input class="form-check-input" type="checkbox" role="switch" style="cursor: pointer;">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-light text-secondary border fw-semibold px-4 py-2 rounded-3">Batal</a>
                                <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background-color: #5E2CB5;">Simpan Pengaturan</button>
                            </div>
                        </form>
                    </div>

                    <!-- TAB 3: Keamanan & Kata Sandi -->
                    <div class="tab-pane fade bg-white p-4 p-md-5 rounded-4 border shadow-sm" id="pill-security" role="tabpanel" aria-labelledby="pill-security-tab">
                        <h5 class="fw-bold text-dark mb-4">Keamanan & Kata Sandi</h5>

                        <form action="{{ route('user.settings.update') }}" method="POST">
                            @csrf
                            <!-- Hidden inputs to prevent validation issues for other fields -->
                            <input type="hidden" name="name" value="{{ Auth::check() ? Auth::user()->name : ($user->name ?? 'Sarah Jenkins') }}">
                            <input type="hidden" name="email" value="{{ Auth::check() ? Auth::user()->email : ($user->email ?? 'sarah.j@example.com') }}">
                            <input type="hidden" name="phone" value="{{ Auth::check() ? Auth::user()->phone : ($user->phone ?? '') }}">

                            <div class="row g-3 mb-4">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-semibold small text-dark">Kata Sandi Baru</label>
                                    <input type="password" name="password" class="form-control rounded-3 py-2.5" placeholder="Masukkan kata sandi baru" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-semibold small text-dark">Konfirmasi Kata Sandi Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control rounded-3 py-2.5" placeholder="Ulangi kata sandi baru" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-light text-secondary border fw-semibold px-4 py-2 rounded-3">Batal</a>
                                <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background-color: #5E2CB5;">Perbarui Kata Sandi</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
