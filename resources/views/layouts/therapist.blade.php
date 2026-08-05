<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Therapist Dashboard - SerenePath')</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sp-purple: #5E2CB5;
            --sp-purple-dark: #4C1D95;
            --sp-purple-light: #F3E8FF;
            --sp-bg: #F8FAFC;
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

        /* Top Header Navbar */
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
            font-weight: 700;
            color: var(--sp-purple);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link-sp {
            font-weight: 500;
            font-size: 0.9rem;
            color: #475569;
            padding: 0.5rem 1rem !important;
        }

        /* Sidebar Styling (matching screenshot) */
        .therapist-sidebar {
            width: 240px;
            padding-top: 1.5rem;
            padding-right: 1.5rem;
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 160px);
        }

        .therapist-avatar-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .therapist-avatar-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 0.75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .therapist-name {
            font-size: 1rem;
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 0.15rem;
        }

        .therapist-title {
            font-size: 0.78rem;
            color: #64748B;
            margin-bottom: 0.35rem;
        }

        .secure-storage-badge {
            font-size: 0.68rem;
            color: #64748B;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .nav-menu-sidebar {
            list-style: none;
            padding: 0;
            margin: 0 0 2rem 0;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1.1rem;
            color: #475569;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .sidebar-nav-item:hover {
            color: var(--sp-purple);
            background-color: #F3E8FF;
        }

        .sidebar-nav-item.active {
            background-color: var(--sp-purple);
            color: #FFFFFF !important;
            box-shadow: 0 4px 14px rgba(94, 44, 181, 0.3);
        }

        .btn-start-session {
            background-color: var(--sp-purple);
            color: #FFFFFF;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.8rem 1.25rem;
            border-radius: 12px;
            border: none;
            width: 100%;
            margin-top: auto;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-start-session:hover {
            background-color: var(--sp-purple-dark);
            color: #FFFFFF;
            box-shadow: 0 4px 14px rgba(94, 44, 181, 0.3);
        }

        /* Footer */
        .footer-sp {
            background-color: #E2E8F0;
            border-top: 1px solid #CBD5E1;
            margin-top: auto;
            padding: 1.5rem 0;
        }

        .footer-sp a {
            color: #64748B;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <!-- Top Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-serenepath">
        <div class="container">
            <a class="navbar-brand navbar-brand-sp" href="{{ route('therapist.dashboard') }}">
                <span style="font-size: 1.5rem; font-weight: 800; color: #5E2CB5;"><i class="bi bi-flower2 me-1"></i>Terapis Online</span>
            </a>

            <div class="d-none d-md-flex mx-auto gap-4">
                <a class="nav-link nav-link-sp {{ request()->routeIs('therapist.schedule') ? 'fw-bold text-purple' : '' }}" href="{{ route('therapist.schedule') }}">Jadwal Sesi</a>
                <a class="nav-link nav-link-sp {{ request()->routeIs('therapist.patients') ? 'fw-bold text-purple' : '' }}" href="{{ route('therapist.patients') }}">Daftar Pasien</a>
                <a class="nav-link nav-link-sp {{ request()->routeIs('therapist.invoices') ? 'fw-bold text-purple' : '' }}" href="{{ route('therapist.invoices') }}">Faktur & Pendapatan</a>
            </div>

                <div class="dropdown">
                    <button class="btn p-0 text-dark border-0 position-relative" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="font-size: 0.5rem;"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-3 mt-2" style="width: 320px;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold mb-0">Notifikasi Terapis</h6>
                            <span class="badge bg-purple text-white rounded-pill" style="background-color: #5E2CB5;">2 Baru</span>
                        </div>
                        <hr class="dropdown-divider my-2">
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('therapist.dashboard') }}" class="text-decoration-none text-dark p-2 rounded-3 hover-bg-light d-flex align-items-start gap-2">
                                <div class="bg-success-subtle text-success p-2 rounded-circle"><i class="bi bi-calendar-check"></i></div>
                                <div>
                                    <div class="small fw-bold">Booking Baru Diterima</div>
                                    <div class="text-muted extra-small">Michael T. membuat pesan janji konsultasi.</div>
                                </div>
                            </a>
                            <a href="{{ route('therapist.invoices') }}" class="text-decoration-none text-dark p-2 rounded-3 hover-bg-light d-flex align-items-start gap-2">
                                <div class="bg-purple-subtle text-purple p-2 rounded-circle" style="background-color: #F3E8FF; color: #5E2CB5;"><i class="bi bi-qr-code"></i></div>
                                <div>
                                    <div class="small fw-bold">Pembayaran QRIS Lunas</div>
                                    <div class="text-muted extra-small">Sarah Jenkins telah membayar Rp 350.000.</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn p-0 text-dark border-0" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-4"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2">
                        <li><div class="dropdown-header fw-bold text-dark">{{ Auth::user()->name }} (Terapis)</div></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item rounded-3" href="{{ route('therapist.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard Terapis</a></li>
                        <li><a class="dropdown-item rounded-3" href="{{ route('therapist.settings') }}"><i class="bi bi-gear me-2"></i> Pengaturan Profil</a></li>
                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <li><a class="dropdown-item rounded-3" href="{{ route('admin.dashboard') }}"><i class="bi bi-shield-lock me-2"></i> Console Admin</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a href="javascript:void(0)" onclick="triggerLogoutModal()" class="dropdown-item rounded-3 text-danger fw-semibold">
                                <i class="bi bi-box-arrow-right me-2"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container (Sidebar + Content) -->
    <div class="container flex-grow-1 py-4">
        <div class="row g-4">
            <!-- Left Sidebar -->
            <div class="col-lg-3 d-none d-lg-block">
                <aside class="therapist-sidebar">
                    <!-- Avatar Widget (Dynamic Auth User) -->
                    <div class="therapist-avatar-container">
                        <img src="{{ Auth::user()->avatar ?? 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=150&auto=format&fit=crop&q=80' }}" alt="{{ Auth::user()->name }}" class="therapist-avatar-img shadow-sm" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover;">
                        <div class="therapist-name mt-2 fw-bold text-dark" style="font-size: 1.1rem;">{{ Auth::user()->name }}</div>
                        <div class="therapist-title text-muted small mb-1">{{ Auth::user()->specialty ?? 'Konselor / Terapis' }}</div>
                        <div class="secure-storage-badge text-secondary" style="font-size: 0.75rem;"><i class="bi bi-shield-lock-fill me-1 text-purple" style="color: #5E2CB5;"></i> AKUN TERVERIFIKASI</div>
                    </div>

                    <!-- Sidebar Menu -->
                    <ul class="nav-menu-sidebar">
                        <li>
                            <a href="{{ route('therapist.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('therapist.dashboard') ? 'active' : '' }}">
                                <i class="bi bi-grid-fill"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('therapist.patients') }}" class="sidebar-nav-item {{ request()->routeIs('therapist.patients') ? 'active' : '' }}">
                                <i class="bi bi-people"></i> Patients
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('therapist.schedule') }}" class="sidebar-nav-item {{ request()->routeIs('therapist.schedule') ? 'active' : '' }}">
                                <i class="bi bi-calendar3"></i> Schedule
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('therapist.invoices') }}" class="sidebar-nav-item {{ request()->routeIs('therapist.invoices') ? 'active' : '' }}">
                                <i class="bi bi-wallet2"></i> Invoices
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('therapist.settings') }}" class="sidebar-nav-item {{ request()->routeIs('therapist.settings') ? 'active' : '' }}">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                        </li>
                    </ul>

                    <!-- Start Session Button -->
                    <a href="{{ route('therapist.schedule') }}" class="btn-start-session">
                        <i class="bi bi-camera-video-fill me-1"></i> Start Session
                    </a>
                </aside>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9 col-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-sp">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="fw-bold fs-5 text-purple" style="color: #5E2CB5;">Terapis Online</div>
                <div class="text-muted small">© 2026 Terapis Online Mental Health. All rights reserved.</div>
                <div class="d-flex gap-3">
                    <a href="{{ route('user.search') }}">Find Help</a>
                    <a href="{{ route('therapist.patients') }}">Patients Roster</a>
                    <a href="{{ route('therapist.schedule') }}">Schedule</a>
                    <a href="{{ route('therapist.invoices') }}">Invoices</a>
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
