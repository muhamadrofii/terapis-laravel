@extends('layouts.admin')

@section('title', 'Laporan & Statistik - Terapis Online Admin')

@section('content')
<!-- Header & Controls -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.1rem; font-weight: 800; letter-spacing: -0.5px;">Tinjauan Kinerja</h1>
        <p class="text-secondary small mb-0">Ringkasan metrik utama platform Terapis Online bulan ini.</p>
    </div>
    <div class="d-flex align-items-center gap-2.5">
        <div class="bg-white border rounded-3 p-1 shadow-sm">
            <select class="form-select border-0 bg-transparent py-1.5 px-3 small fw-semibold text-secondary" style="cursor: pointer; font-size: 0.88rem;">
                <option value="this_month" selected>📅 Bulan Ini</option>
                <option value="last_month">📅 Bulan Lalu</option>
                <option value="this_year">📅 Tahun Ini</option>
            </select>
        </div>
        <button type="button" onclick="exportReportsPDF()" class="btn text-white fw-bold rounded-3 px-3.5 py-2 small shadow-sm d-flex align-items-center gap-1.5" style="background-color: #5E2CB5;">
            <i class="bi bi-download"></i> Ekspor PDF
        </button>
    </div>
</div>

<!-- 4 Top KPI Metric Cards Grid -->
<div class="row g-3.5 mb-4">
    
    <!-- Card 1: Total Pasien -->
    <div class="col-xl-3 col-md-6">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 position-relative">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="background-color: #F3E8FF; color: #5E2CB5; width: 46px; height: 46px;">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
                <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                    <i class="bi bi-graph-up me-1"></i>+12%
                </span>
            </div>
            <div class="text-secondary small fw-semibold mb-1">Total Pasien</div>
            <div class="display-6 fw-extrabold text-dark mb-0" style="font-weight: 800; letter-spacing: -1px;">{{ $totalPatients }}</div>
        </div>
    </div>

    <!-- Card 2: Terapis Aktif -->
    <div class="col-xl-3 col-md-6">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 position-relative">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="background-color: #F3E8FF; color: #5E2CB5; width: 46px; height: 46px;">
                    <i class="bi bi-person-badge-fill fs-4"></i>
                </div>
                <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                    <i class="bi bi-graph-up me-1"></i>+5%
                </span>
            </div>
            <div class="text-secondary small fw-semibold mb-1">Terapis Aktif</div>
            <div class="display-6 fw-extrabold text-dark mb-0" style="font-weight: 800; letter-spacing: -1px;">{{ $totalTherapists }}</div>
        </div>
    </div>

    <!-- Card 3: Pendapatan Bulan Ini -->
    <div class="col-xl-3 col-md-6">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 position-relative">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="background-color: #F3E8FF; color: #5E2CB5; width: 46px; height: 46px;">
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
                <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                    <i class="bi bi-graph-up me-1"></i>+18%
                </span>
            </div>
            <div class="text-secondary small fw-semibold mb-1">Pendapatan Bulan Ini</div>
            <div class="display-6 fw-extrabold text-dark mb-0" style="font-weight: 800; letter-spacing: -1px;">{{ $revenueVal }}</div>
        </div>
    </div>

    <!-- Card 4: Rata-rata Rating -->
    <div class="col-xl-3 col-md-6">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 position-relative">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="background-color: #CCFBF1; color: #0D9488; width: 46px; height: 46px;">
                    <i class="bi bi-star-fill fs-4"></i>
                </div>
                <span class="badge bg-secondary-subtle text-secondary px-2.5 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                    — Stabil
                </span>
            </div>
            <div class="text-secondary small fw-semibold mb-1">Rata-rata Rating</div>
            <div class="display-6 fw-extrabold text-dark mb-0" style="font-weight: 800; letter-spacing: -1px;">
                {{ $avgRating }}<span class="fs-5 text-muted fw-semibold">/5</span>
            </div>
        </div>
    </div>

</div>

<!-- Middle Section: Analytics Charts (Pertumbuhan Pengguna & Topik Sesi Terpopuler) -->
<div class="row g-4 mb-4">
    
    <!-- Left Chart: Pertumbuhan Pengguna (Line Chart) -->
    <div class="col-lg-8">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0">Pertumbuhan Pengguna</h5>
                <div class="d-flex align-items-center gap-3 small fw-semibold">
                    <span class="d-flex align-items-center gap-1.5 text-secondary">
                        <span class="rounded-circle d-inline-block" style="width: 10px; height: 10px; background-color: #5E2CB5;"></span> Pasien
                    </span>
                    <span class="d-flex align-items-center gap-1.5 text-secondary">
                        <span class="rounded-circle d-inline-block" style="width: 10px; height: 10px; background-color: #94A3B8;"></span> Terapis
                    </span>
                </div>
            </div>
            <div style="height: 270px; position: relative;">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Right Chart: Topik Sesi Terpopuler (Donut Chart) -->
    <div class="col-lg-4">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
            <h5 class="fw-bold text-dark mb-3">Topik Sesi Terpopuler</h5>
            
            <div class="my-auto position-relative" style="height: 200px;">
                <canvas id="sessionTopicsChart"></canvas>
            </div>

            <!-- Custom Topic Legend Grid -->
            <div class="row g-2 mt-3 pt-3 border-top small fw-semibold text-secondary">
                <div class="col-6 d-flex align-items-center gap-2">
                    <span class="rounded-circle" style="width: 10px; height: 10px; background-color: #5E2CB5;"></span>
                    <span>Kecemasan</span>
                </div>
                <div class="col-6 d-flex align-items-center gap-2">
                    <span class="rounded-circle" style="width: 10px; height: 10px; background-color: #3B82F6;"></span>
                    <span>Depresi</span>
                </div>
                <div class="col-6 d-flex align-items-center gap-2">
                    <span class="rounded-circle" style="width: 10px; height: 10px; background-color: #6366F1;"></span>
                    <span>Hubungan</span>
                </div>
                <div class="col-6 d-flex align-items-center gap-2">
                    <span class="rounded-circle" style="width: 10px; height: 10px; background-color: #0D9488;"></span>
                    <span>Karir & Stres</span>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Bottom Section: Tren Pendapatan & Kepuasan Pengguna -->
<div class="row g-4">
    
    <!-- Left: Tren Pendapatan (Bar Chart) -->
    <div class="col-lg-7">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0">Tren Pendapatan</h5>
                <span class="text-muted small fw-semibold">Juta Rupiah (IDR)</span>
            </div>
            <div style="height: 250px; position: relative;">
                <canvas id="revenueTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Right: Kepuasan Pengguna & Insight AI -->
    <div class="col-lg-5">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
            <div>
                <h5 class="fw-bold text-dark mb-4">Kepuasan Pengguna</h5>

                <!-- Metric 1: Kualitas Konsultasi -->
                <div class="mb-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-1.5">
                        <span class="fw-semibold text-dark small">Kualitas Konsultasi</span>
                        <span class="fw-bold text-purple small" style="color: #5E2CB5;">4.9/5</span>
                    </div>
                    <div class="progress rounded-pill bg-light" style="height: 9px;">
                        <div class="progress-bar rounded-pill" style="width: 98%; background-color: #5E2CB5;"></div>
                    </div>
                </div>

                <!-- Metric 2: Kemudahan Aplikasi -->
                <div class="mb-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-1.5">
                        <span class="fw-semibold text-dark small">Kemudahan Aplikasi</span>
                        <span class="fw-bold text-purple small" style="color: #5E2CB5;">4.7/5</span>
                    </div>
                    <div class="progress rounded-pill bg-light" style="height: 9px;">
                        <div class="progress-bar rounded-pill" style="width: 94%; background-color: #7C3AED;"></div>
                    </div>
                </div>

                <!-- Metric 3: Respon Bantuan -->
                <div class="mb-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-1.5">
                        <span class="fw-semibold text-dark small">Respon Bantuan</span>
                        <span class="fw-bold text-teal small" style="color: #0D9488;">4.5/5</span>
                    </div>
                    <div class="progress rounded-pill bg-light" style="height: 9px;">
                        <div class="progress-bar rounded-pill" style="width: 90%; background-color: #0D9488;"></div>
                    </div>
                </div>
            </div>

            <!-- Insight AI Box -->
            <div class="p-3.5 rounded-4 mt-3" style="background-color: #F3E8FF; border: 1px solid #E9D5FF;">
                <div class="d-flex align-items-center gap-2 mb-1.5" style="color: #5E2CB5;">
                    <i class="bi bi-graph-up-arrow fs-5"></i>
                    <span class="fw-bold small">Insight AI</span>
                </div>
                <p class="text-secondary small mb-0" style="font-size: 0.84rem; line-height: 1.55;">
                    Peningkatan rating sebesar 0.2 poin bulan ini sejalan dengan peluncuran fitur video call terbaru yang lebih stabil.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js Setup Scripts & Export PDF Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Chart Pertumbuhan Pengguna (Line Chart)
    const ctxUser = document.getElementById('userGrowthChart').getContext('2d');
    
    // Gradient background for Pasien curve
    const purpleGradient = ctxUser.createLinearGradient(0, 0, 0, 250);
    purpleGradient.addColorStop(0, 'rgba(94, 44, 181, 0.25)');
    purpleGradient.addColorStop(1, 'rgba(94, 44, 181, 0.01)');

    new Chart(ctxUser, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [
                {
                    label: 'Pasien',
                    data: [1200, 1350, 1500, 1800, 2100, 2300, 2450],
                    borderColor: '#5E2CB5',
                    borderWidth: 3,
                    backgroundColor: purpleGradient,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#5E2CB5',
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Terapis',
                    data: [100, 110, 120, 135, 150, 168, 184],
                    borderColor: '#94A3B8',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.4,
                    pointBackgroundColor: '#94A3B8',
                    pointRadius: 3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748B', font: { size: 12 } }
                },
                y: {
                    grid: { color: '#F1F5F9' },
                    ticks: { color: '#64748B', font: { size: 12 } }
                }
            }
        }
    });

    // 2. Chart Topik Sesi Terpopuler (Donut Chart)
    const ctxTopic = document.getElementById('sessionTopicsChart').getContext('2d');
    new Chart(ctxTopic, {
        type: 'doughnut',
        data: {
            labels: ['Kecemasan', 'Depresi', 'Hubungan', 'Karir & Stres'],
            datasets: [{
                data: [45, 25, 18, 12],
                backgroundColor: ['#5E2CB5', '#3B82F6', '#6366F1', '#0D9488'],
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { display: false }
            }
        }
    });

    // 3. Chart Tren Pendapatan (Bar Chart)
    const ctxRevenue = document.getElementById('revenueTrendChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Pendapatan (Juta Rp)',
                data: [85, 92, 104, 110, 118, 128],
                backgroundColor: '#5E2CB5',
                borderRadius: 8,
                barThickness: 28
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748B', font: { size: 12 } }
                },
                y: {
                    grid: { color: '#F1F5F9' },
                    ticks: { color: '#64748B', font: { size: 12 } }
                }
            }
        }
    });
});

function exportReportsPDF() {
    window.print();
}
</script>
@endsection
