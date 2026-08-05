<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Terapis Online - Terapi Online & Kesehatan Mental')</title>

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sp-purple: #5E2CB5;
            --sp-purple-dark: #4C1D95;
            --sp-purple-light: #F3E8FF;
            --sp-bg: #FFFFFF;
            --sp-card-bg: #FFFFFF;
            --sp-text-main: #0F172A;
            --sp-text-muted: #64748B;
            --sp-teal: #0D9488;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--sp-bg);
            color: var(--sp-text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-serenepath {
            background: #FFFFFF;
            border-bottom: 1px solid #F1F5F9;
            padding: 1.1rem 0;
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .navbar-brand-sp {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--sp-purple);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link-sp {
            font-weight: 500;
            font-size: 0.95rem;
            color: #475569;
            padding: 0.5rem 1rem !important;
            transition: color 0.2s ease;
        }

        .nav-link-sp:hover {
            color: var(--sp-purple);
        }

        .btn-purple-primary {
            background-color: var(--sp-purple);
            color: #FFFFFF;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.65rem 1.6rem;
            border-radius: 50px;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-purple-primary:hover {
            background-color: var(--sp-purple-dark);
            color: #FFFFFF;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(94, 44, 181, 0.25);
        }

        .sp-card {
            background-color: var(--sp-card-bg);
            border-radius: 20px;
            border: 1px solid #E2E8F0;
            transition: all 0.2s ease;
        }

        .footer-sp {
            background-color: #F8FAFC;
            border-top: 1px solid #E2E8F0;
            margin-top: auto;
            padding: 2.5rem 0;
        }

        .footer-sp a {
            color: #64748B;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
        }

        .footer-sp a:hover {
            color: var(--sp-purple);
        }
    </style>
</head>
<body>

    <!-- Header Navbar (Full Working Links) -->
    <nav class="navbar navbar-expand-lg navbar-serenepath">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand navbar-brand-sp" href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'therapist' ? route('therapist.dashboard') : route('user.dashboard'))) : route('home') }}">
                <span style="font-size: 1.5rem; font-weight: 800; color: #5E2CB5;"><i class="bi bi-flower2 me-1"></i>Terapis Online</span>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Menu Links -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <div class="navbar-nav mx-auto gap-lg-3 py-2 py-lg-0">
                    <a class="nav-link nav-link-sp {{ request()->routeIs('user.search') ? 'fw-bold text-purple' : '' }}" href="{{ route('user.search') }}">Find Help</a>
                    <a class="nav-link nav-link-sp {{ request()->routeIs('user.sessions') ? 'fw-bold text-purple' : '' }}" href="{{ route('user.sessions') }}">My Sessions</a>
                    <a class="nav-link nav-link-sp {{ request()->routeIs('user.payments') ? 'fw-bold text-purple' : '' }}" href="{{ route('user.payments') }}">Payment History</a>
                    <a class="nav-link nav-link-sp {{ request()->routeIs('user.settings') ? 'fw-bold text-purple' : '' }}" href="{{ route('user.settings') }}">Settings</a>
                </div>

                <!-- Right Action Buttons -->
                <div class="d-flex align-items-center gap-3 pt-2 pt-lg-0">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 small fw-bold">Console Admin</a>
                        @elseif(Auth::user()->role === 'therapist')
                            <a href="{{ route('therapist.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 small fw-bold">Dashboard Terapis</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 small fw-bold">Dashboard Saya</a>
                        @endif

                        <div class="dropdown">
                            <button class="btn p-0 border-0" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-3" style="color: #5E2CB5;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2">
                                <li><div class="dropdown-header fw-bold text-dark">{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</div></li>
                                <li><hr class="dropdown-divider"></li>
                                
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item rounded-3" href="{{ route('admin.dashboard') }}"><i class="bi bi-shield-lock me-2"></i> Console Admin</a></li>
                                    <li><a class="dropdown-item rounded-3" href="{{ route('therapist.dashboard') }}"><i class="bi bi-heart-pulse me-2"></i> Portal Terapis</a></li>
                                    <li><a class="dropdown-item rounded-3" href="{{ route('user.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard Pasien</a></li>
                                @elseif(Auth::user()->role === 'therapist')
                                    <li><a class="dropdown-item rounded-3" href="{{ route('therapist.dashboard') }}"><i class="bi bi-heart-pulse me-2"></i> Dashboard Terapis</a></li>
                                    <li><a class="dropdown-item rounded-3" href="{{ route('therapist.settings') }}"><i class="bi bi-gear me-2"></i> Pengaturan Profil</a></li>
                                @else
                                    <li><a class="dropdown-item rounded-3" href="{{ route('user.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard Saya</a></li>
                                    <li><a class="dropdown-item rounded-3" href="{{ route('user.settings') }}"><i class="bi bi-gear me-2"></i> Pengaturan Profil</a></li>
                                @endif

                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="javascript:void(0)" onclick="triggerLogoutModal()" class="dropdown-item rounded-3 text-danger fw-semibold">
                                        <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link nav-link-sp fw-semibold">Log In</a>
                        <a href="{{ route('register') }}" class="btn btn-purple-primary text-white">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main class="flex-grow-1">
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-sp">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold fs-5" style="color: #5E2CB5;"><i class="bi bi-flower2 me-1"></i>Terapis Online</span>
                    <span class="text-muted small">© 2026 Terapis Online Mental Health. All rights reserved.</span>
                </div>
                <div class="d-flex gap-4">
                    <a href="javascript:void(0)" onclick="alert('Syarat & Ketentuan: Layanan Terapis Online digunakan untuk konsultasi kesehatan mental secara aman.')">Syarat & Ketentuan</a>
                    <a href="javascript:void(0)" onclick="alert('Kebijakan Privasi: Data pribadi dan sesi konsultasi Anda dijaga kerahasiaannya dengan enkripsi penuh.')">Kebijakan Privasi</a>
                    <a href="javascript:void(0)" onclick="alert('Pusat Bantuan WhatsApp: +62 812-3456-7890')">Bantuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Konfirmasi Logout (Bootstrap Modal) -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content rounded-4 border-0 shadow-lg text-center p-3">
                <div class="modal-body py-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 60px; height: 60px; background-color: #FFE4E6; color: #E11D48;">
                        <i class="bi bi-box-arrow-right fs-3"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Konfirmasi Keluar</h5>
                    <p class="text-secondary small mb-4">Apakah Anda yakin ingin keluar dari akun Anda?</p>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light text-secondary border w-50 rounded-3 py-2 small fw-semibold" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('logout') }}" method="POST" class="w-50 m-0">
                            @csrf
                            <button type="submit" class="btn text-white w-100 rounded-3 py-2 small fw-bold" style="background-color: #5E2CB5;">Ya, Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function triggerLogoutModal() {
            var modalEl = document.getElementById('logoutModal');
            if (modalEl) {
                var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
            }
        }
    </script>
</body>
</html>
