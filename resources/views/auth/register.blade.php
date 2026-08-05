<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Baru - SerenePath</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FAFAFC;
            color: #1E293B;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Left Side Hero Photo Box matching exact image from daftar_akun_serenepath_2 */
        .auth-left-banner {
            background: linear-gradient(180deg, rgba(88, 28, 160, 0.65) 0%, rgba(94, 44, 181, 0.75) 100%), 
                        url('https://lh3.googleusercontent.com/aida-public/AB6AXuBAmPbcwMWt1lHZfBe1NOyRfXkD8gX5JtRZ2dpIYjaYIXB5EeEyNNEhD1R99jYvLxml-uW9S_h0kn2qwXCrhQyWnwsr_VnGaCGUO0Mit69hHA6lI1ysfohmQyJ_MPUb5GU_nCYxtq4W3dgr7_kUy02fprWyzDB8B8xYvqdk_z8_-z-3VOZcGu3tvjNeBAwIfrKKRHvQ5cZO3B1xF9hI1j8AWDBpcya3QutqTNAYBHJzvldXt9v5uVHCgw') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem 4rem;
        }

        .auth-brand-logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: #FFFFFF;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-left-text {
            max-width: 480px;
            margin-bottom: 2rem;
        }

        .auth-left-title {
            font-size: 2.35rem;
            font-weight: 800;
            color: #FFFFFF;
            line-height: 1.2;
            letter-spacing: -0.5px;
            margin-bottom: 1rem;
        }

        .auth-left-desc {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        /* Right Side Form Box */
        .auth-right-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            background-color: #FAFAFC;
        }

        .auth-form-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .auth-form-title {
            font-size: 2.1rem;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.5px;
            margin-bottom: 0.35rem;
        }

        .auth-form-subtitle {
            font-size: 0.95rem;
            color: #64748B;
            margin-bottom: 2rem;
        }

        .form-label-custom {
            font-size: 0.88rem;
            font-weight: 600;
            color: #1E293B;
            margin-bottom: 0.4rem;
        }

        .input-group-custom {
            background-color: #F1F5F9;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .input-group-custom:focus-within {
            background-color: #FFFFFF;
            border-color: #5E2CB5;
            box-shadow: 0 0 0 3px rgba(94, 44, 181, 0.15);
        }

        .input-group-custom .input-group-text {
            background: transparent;
            border: none;
            color: #64748B;
            padding-left: 1rem;
            padding-right: 0.5rem;
        }

        .input-group-custom .form-control {
            background: transparent;
            border: none;
            font-size: 0.92rem;
            padding: 0.75rem 1rem 0.75rem 0.25rem;
            color: #0F172A;
        }

        .input-group-custom .form-control::placeholder {
            color: #94A3B8;
        }

        .input-group-custom .form-control:focus {
            box-shadow: none;
        }

        .btn-auth-submit {
            background-color: #5E2CB5;
            color: #FFFFFF;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            border: none;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-auth-submit:hover {
            background-color: #4C1D95;
            color: #FFFFFF;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(94, 44, 181, 0.3);
        }

        .link-purple {
            color: #5E2CB5;
            font-weight: 600;
            text-decoration: none;
        }

        .link-purple:hover {
            color: #4C1D95;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">
        <!-- Left Side: Photo from daftar_akun_serenepath_2 & Branding Overlay -->
        <div class="col-lg-6 d-none d-lg-block p-0">
            <div class="auth-left-banner">
                <a href="{{ route('home') }}" class="auth-brand-logo">
                    <i class="bi bi-flower2"></i>
                    <span>Terapis Online</span>
                </a>

                <div class="auth-left-text">
                    <h1 class="auth-left-title">Ruang Aman untuk Pikiran Anda</h1>
                    <p class="auth-left-desc">Bergabunglah hari ini untuk memulai perjalanan menuju kesejahteraan mental yang lebih baik, didukung oleh para profesional yang peduli.</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Clean Form Container -->
        <div class="col-lg-6 col-12 auth-right-container">
            <div class="auth-form-wrapper">
                
                <!-- Mobile Logo -->
                <div class="d-lg-none mb-4 text-center">
                    <a href="{{ route('home') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none fs-4 fw-bold" style="color: #5E2CB5;">
                        <i class="bi bi-flower2"></i> Terapis Online
                    </a>
                </div>

                <h2 class="auth-form-title">Buat Akun Baru</h2>
                <p class="auth-form-subtitle">Lengkapi data diri Anda untuk bergabung.</p>

                @if($errors->any())
                    <div class="alert alert-danger rounded-3 border-0 small mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <!-- Pilihan Peran Akun (Role Selector) -->
                    <div class="mb-3">
                        <label class="form-label-custom">Daftar Sebagai</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="role" id="role_user" value="user" {{ old('role', 'user') === 'user' ? 'checked' : '' }} onchange="toggleTherapistFields()">
                                <label class="btn btn-outline-secondary w-100 py-2.5 rounded-3 d-flex flex-column align-items-center gap-1 text-dark border shadow-xs" for="role_user" style="cursor: pointer;">
                                    <i class="bi bi-person-heart fs-5 text-purple" style="color: #5E2CB5;"></i>
                                    <span class="fw-bold small">Pasien / Klien</span>
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="role" id="role_therapist" value="therapist" {{ old('role') === 'therapist' ? 'checked' : '' }} onchange="toggleTherapistFields()">
                                <label class="btn btn-outline-secondary w-100 py-2.5 rounded-3 d-flex flex-column align-items-center gap-1 text-dark border shadow-xs" for="role_therapist" style="cursor: pointer;">
                                    <i class="bi bi-heart-pulse-fill fs-5 text-purple" style="color: #5E2CB5;"></i>
                                    <span class="fw-bold small">Terapis / Dokter</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Input Spesialisasi (Khusus Terapis) -->
                    <div class="mb-3" id="specialtyContainer" style="display: {{ old('role') === 'therapist' ? 'block' : 'none' }};">
                        <label for="specialty" class="form-label-custom">Spesialisasi Terapis</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="bi bi-journal-medical"></i></span>
                            <input type="text" name="specialty" id="specialty" class="form-control" placeholder="Contoh: Kecemasan, Depresi, Konseling Karir" value="{{ old('specialty') }}">
                        </div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label-custom">Nama Lengkap</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label-custom">Email</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label-custom">Password</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 8 karakter" required>
                            <button type="button" class="btn border-0 text-muted px-3" onclick="togglePasswordVisibility('password', this)" title="Tampilkan/Sembunyikan Password">
                                <i class="bi bi-eye fs-6"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label-custom">Konfirmasi Password</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="bi bi-arrow-counterclockwise"></i></span>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password Anda" required>
                            <button type="button" class="btn border-0 text-muted px-3" onclick="togglePasswordVisibility('password_confirmation', this)" title="Tampilkan/Sembunyikan Password">
                                <i class="bi bi-eye fs-6"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Checkbox Terms -->
                    <div class="mb-4 form-check">
                        <input type="checkbox" name="terms" class="form-check-input" id="terms" required>
                        <label class="form-check-label small text-muted" for="terms">
                            Saya setuju dengan <a href="javascript:void(0)" onclick="alert('Syarat & Ketentuan: Layanan SerenePath digunakan untuk konsultasi kesehatan mental secara aman dan rahasia.')" class="link-purple">Syarat & Ketentuan</a> dan <a href="javascript:void(0)" onclick="alert('Kebijakan Privasi: Data pribadi dan sesi konsultasi Anda dijaga kerahasiaannya dengan enkripsi penuh.')" class="link-purple">Kebijakan Privasi</a>.
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-auth-submit mb-4">
                        <span>Daftar Sekarang</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>

                    <!-- Login Link Footer -->
                    <div class="text-center small text-muted">
                        Sudah memiliki akun? <a href="{{ route('login') }}" class="link-purple">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleTherapistFields() {
    const isTherapist = document.getElementById('role_therapist').checked;
    const specialtyBox = document.getElementById('specialtyContainer');
    if (specialtyBox) {
        specialtyBox.style.display = isTherapist ? 'block' : 'none';
    }
}

function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash-fill';
        btn.style.color = '#5E2CB5';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
        btn.style.color = '';
    }
}
</script>
</body>
</html>
