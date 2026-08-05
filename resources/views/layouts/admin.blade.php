<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal - SerenePath')</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Chart.js Library for Analytics Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --sp-purple: #5E2CB5;
            --sp-purple-dark: #4C1D95;
            --sp-purple-light: #F3E8FF;
            --sp-bg: #F8FAFC;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--sp-bg);
            color: #0F172A;
            min-height: 100vh;
        }

        .admin-navbar {
            background-color: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            padding: 0.85rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .admin-sidebar {
            width: 260px;
            background-color: #FFFFFF;
            border-right: 1px solid #E2E8F0;
            min-height: calc(100vh - 65px);
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
        }

        .admin-nav-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1.1rem;
            color: #475569;
            font-size: 0.92rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
            margin-bottom: 0.35rem;
        }

        .admin-nav-item:hover {
            color: var(--sp-purple);
            background-color: #F3E8FF;
        }

        .admin-nav-item.active {
            background-color: var(--sp-purple);
            color: #FFFFFF !important;
            box-shadow: 0 4px 14px rgba(94, 44, 181, 0.3);
        }
    </style>
</head>
<body>

    <!-- Admin Top Navbar -->
    <nav class="admin-navbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <a class="navbar-brand fw-extrabold fs-4" style="color: #5E2CB5;" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-flower2"></i> Terapis Online <span class="badge bg-purple-subtle text-purple small ms-1" style="background-color: #F3E8FF; color: #5E2CB5; font-size: 0.7rem;">ADMIN</span>
            </a>
        </div>

        <div class="d-none d-md-flex align-items-center bg-light rounded-pill px-3 py-1.5 border max-w-sm">
            <i class="bi bi-search text-muted me-2"></i>
            <input type="text" class="form-control border-0 bg-transparent shadow-none small" placeholder="Cari pengguna, terapis, invoice...">
        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn p-0 text-dark border-0"><i class="bi bi-bell fs-5"></i></button>
            <a href="{{ route('admin.qris') }}" class="btn p-0 text-dark border-0" title="Pengaturan QRIS"><i class="bi bi-qr-code-scan fs-5"></i></a>
            <div class="dropdown">
                <button class="btn p-0 text-dark border-0" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-4"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2">
                    <li><div class="dropdown-header fw-bold text-dark">{{ Auth::user()->name }} (Admin)</div></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item rounded-3" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Console Admin</a></li>
                    <li><a class="dropdown-item rounded-3" href="{{ route('therapist.dashboard') }}"><i class="bi bi-heart-pulse me-2"></i> Portal Terapis</a></li>
                    <li><a class="dropdown-item rounded-3" href="{{ route('user.dashboard') }}"><i class="bi bi-person me-2"></i> Portal Pasien</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a href="javascript:void(0)" onclick="triggerLogoutModal()" class="dropdown-item rounded-3 text-danger fw-semibold">
                            <i class="bi bi-box-arrow-right me-2"></i> Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar & Content Wrapper -->
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar d-none d-lg-block">
            <div class="nav flex-column">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
                <a href="{{ route('admin.qris') }}" class="admin-nav-item {{ request()->routeIs('admin.qris') ? 'active' : '' }}">
                    <i class="bi bi-qr-code-scan"></i> Kelola QRIS Master
                </a>
                <a href="{{ route('admin.users') }}" class="admin-nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Manajemen Pengguna
                </a>
                <a href="{{ route('admin.verifications') }}" class="admin-nav-item {{ request()->routeIs('admin.verifications') ? 'active' : '' }}">
                    <i class="bi bi-patch-check"></i> Verifikasi Terapis
                </a>
                <a href="{{ route('admin.payments') }}" class="admin-nav-item {{ request()->routeIs('admin.payments') ? 'active' : '' }}">
                    <i class="bi bi-credit-card"></i> Kelola Pembayaran & Booking
                </a>
                <a href="{{ route('admin.reports') }}" class="admin-nav-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-line"></i> Laporan & Statistik
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow-1 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

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
