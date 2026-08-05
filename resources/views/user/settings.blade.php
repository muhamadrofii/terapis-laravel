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

        <div class="row g-4">
            <!-- Left Sidebar Navigation -->
            <div class="col-lg-3">
                <div class="bg-white p-3 rounded-4 border shadow-sm">
                    <div class="nav flex-column nav-pills gap-1">
                        <button class="nav-link active text-start fw-semibold py-2.5 px-3 rounded-3" style="background-color: #5E2CB5;">
                            <i class="bi bi-person me-2"></i> Informasi Pribadi
                        </button>
                        <button class="nav-link text-start text-secondary fw-semibold py-2.5 px-3 rounded-3">
                            <i class="bi bi-bell me-2"></i> Notifikasi
                        </button>
                        <button class="nav-link text-start text-secondary fw-semibold py-2.5 px-3 rounded-3">
                            <i class="bi bi-shield-lock me-2"></i> Keamanan & Kata Sandi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Main Form Container -->
            <div class="col-lg-9">
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm">
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

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small text-dark">Kata Sandi Baru (Opsional)</label>
                                <input type="password" name="password" class="form-control rounded-3 py-2.5" placeholder="Kosongkan jika tidak diubah">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small text-dark">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-3 py-2.5" placeholder="Kosongkan jika tidak diubah">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-light text-secondary border fw-semibold px-4 py-2 rounded-3">Batal</a>
                            <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background-color: #5E2CB5;">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
