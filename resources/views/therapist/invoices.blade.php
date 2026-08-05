@extends('layouts.therapist')

@section('title', 'Faktur & Pendapatan - Terapis Online')

@section('content')
<!-- Modern Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem; letter-spacing: -0.5px;">Faktur & Pendapatan</h1>
        <p class="text-secondary mb-0">Kelola tagihan konsultasi, pantau pencairan saldo, dan cetak invoice resmi.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" onclick="window.print()" class="btn btn-light text-dark border fw-semibold px-3 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-printer"></i> Cetak Ringkasan
        </button>
        <button type="button" onclick="alert('Laporan keuangan bulan ini berhasil diunduh (PDF).')" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;">
            <i class="bi bi-download"></i> Export Laporan PDF
        </button>
    </div>
</div>

<!-- Modern Stat Cards Grid -->
<div class="row g-4 mb-4">
    <!-- Card 1: Total Pendapatan -->
    <div class="col-md-4">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 position-relative overflow-hidden" style="border-color: #E2E8F0 !important;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="background-color: #F3E8FF; color: #5E2CB5; width: 48px; height: 48px;">
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
                <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                    <i class="bi bi-arrow-up-right me-1"></i> +12.5%
                </span>
            </div>
            <div class="text-secondary small fw-semibold mb-1">Total Pendapatan</div>
            <div class="fs-2 fw-extrabold text-dark mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Rp 12.450.000</div>
            <div class="text-muted small">Diperbarui otomatis dari transaksi QRIS</div>
        </div>
    </div>

    <!-- Card 2: Menunggu Pencairan -->
    <div class="col-md-4">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 position-relative overflow-hidden" style="border-color: #E2E8F0 !important;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="background-color: #CCFBF1; color: #0D9488; width: 48px; height: 48px;">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
                <span class="badge bg-info-subtle text-info px-2.5 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                    Minggu Ini
                </span>
            </div>
            <div class="text-secondary small fw-semibold mb-1">Menunggu Pencairan</div>
            <div class="fs-2 fw-extrabold text-dark mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Rp 1.200.000</div>
            <div class="text-muted small">Jadwal transfer otomatis: Jumat, 17:00 WIB</div>
        </div>
    </div>

    <!-- Card 3: Menunggu Pembayaran Pasien -->
    <div class="col-md-4">
        <div class="p-4 rounded-4 border shadow-sm h-100 position-relative overflow-hidden" style="background-color: #FFF5F5; border-color: #FECDD3 !important;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="background-color: #FFE4E6; color: #E11D48; width: 48px; height: 48px;">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                </div>
                <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                    Belum Lunas
                </span>
            </div>
            <div class="text-danger small fw-semibold mb-1">Menunggu Pembayaran Pasien</div>
            <div class="fs-2 fw-extrabold text-danger mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Rp 350.000</div>
            <div class="text-danger small">1 Transaksi QRIS menunggu bukti bayar</div>
        </div>
    </div>
</div>

<!-- Modern Invoices Container -->
<div class="bg-white p-4 rounded-4 border shadow-sm" style="border-color: #E2E8F0 !important;">
    <!-- Filter Pills & Search Bar -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div class="btn-group border rounded-3 p-1 bg-light">
            <button type="button" class="btn btn-sm text-white fw-bold px-3 shadow-sm" style="background-color: #5E2CB5;">Semua Invoice</button>
            <button type="button" class="btn btn-sm text-secondary fw-semibold px-3">Lunas (Paid)</button>
            <button type="button" class="btn btn-sm text-secondary fw-semibold px-3">Pending</button>
        </div>

        <div class="input-group bg-light rounded-3" style="max-width: 320px;">
            <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" class="form-control bg-transparent border-0 small" placeholder="Cari No. Invoice atau Pasien...">
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="bg-light">
                <tr class="text-secondary small fw-bold" style="font-size: 0.82rem;">
                    <th class="py-3 ps-3">NO. INVOICE</th>
                    <th class="py-3">PASIEN / CLIENT</th>
                    <th class="py-3">TANGGAL SESI</th>
                    <th class="py-3">METODE BAYAR</th>
                    <th class="py-3">NOMINAL</th>
                    <th class="py-3">STATUS</th>
                    <th class="py-3 text-end pe-3">AKSI</th>
                </tr>
            </thead>
            <tbody style="font-size: 0.92rem;">
                <!-- Row 1 -->
                <tr>
                    <td class="ps-3">
                        <span class="fw-bold text-dark font-monospace">#INV-2026-089</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80" class="rounded-circle object-fit-cover" style="width: 36px; height: 36px;" alt="Sarah Jenkins">
                            <div>
                                <div class="fw-bold text-dark">Sarah Jenkins</div>
                                <div class="text-muted" style="font-size: 0.78rem;">Anxiety Management</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-secondary">05 Ags 2026, 10:00 WIB</td>
                    <td>
                        <span class="badge bg-light text-dark border px-2.5 py-1.5 fw-semibold" style="border-radius: 6px;">
                            <i class="bi bi-qr-code me-1" style="color: #5E2CB5;"></i> Dynamic QRIS
                        </span>
                    </td>
                    <td class="fw-extrabold text-dark">Rp 350.000</td>
                    <td>
                        <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                            <i class="bi bi-check-circle-fill me-1"></i> LUNAS
                        </span>
                    </td>
                    <td class="text-end pe-3">
                        <button type="button" class="btn btn-sm text-purple fw-bold rounded-3 px-3 py-1.5" style="background-color: #F3E8FF; color: #5E2CB5;" data-bs-toggle="modal" data-bs-target="#invoiceModal1">
                            <i class="bi bi-receipt me-1"></i> Detail Invoice
                        </button>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr>
                    <td class="ps-3">
                        <span class="fw-bold text-dark font-monospace">#INV-2026-090</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=150&auto=format&fit=crop&q=80" class="rounded-circle object-fit-cover" style="width: 36px; height: 36px;" alt="Michael T.">
                            <div>
                                <div class="fw-bold text-dark">Michael T.</div>
                                <div class="text-muted" style="font-size: 0.78rem;">Initial Consultation</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-secondary">06 Ags 2026, 11:30 WIB</td>
                    <td>
                        <span class="badge bg-light text-dark border px-2.5 py-1.5 fw-semibold" style="border-radius: 6px;">
                            <i class="bi bi-qr-code me-1" style="color: #5E2CB5;"></i> Dynamic QRIS
                        </span>
                    </td>
                    <td class="fw-extrabold text-dark">Rp 350.000</td>
                    <td>
                        <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem; background-color: #FEF3C7; color: #92400E;">
                            <i class="bi bi-clock-history me-1"></i> PENDING
                        </span>
                    </td>
                    <td class="text-end pe-3">
                        <button type="button" class="btn btn-sm text-purple fw-bold rounded-3 px-3 py-1.5" style="background-color: #F3E8FF; color: #5E2CB5;" data-bs-toggle="modal" data-bs-target="#invoiceModal2">
                            <i class="bi bi-receipt me-1"></i> Detail Invoice
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Detail Invoice Kekinian (Paid Invoice) -->
<div class="modal fade" id="invoiceModal1" tabindex="-1" aria-labelledby="invoiceModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            
            <!-- Modal Header Banner -->
            <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #5E2CB5 0%, #4C1D95 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle p-2 text-purple d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; color: #5E2CB5;">
                        <i class="bi bi-flower2 fs-3"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">SerenePath Invoice</h4>
                        <div class="small opacity-75">Resmi • Terverifikasi Sistem QRIS</div>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Invoice Body Content -->
            <div class="modal-body p-4 p-md-5">
                
                <!-- Invoice Meta Header -->
                <div class="d-flex flex-column flex-sm-row justify-content-between border-bottom pb-4 mb-4 gap-3">
                    <div>
                        <span class="badge bg-success text-white px-3 py-2 fw-bold rounded-pill mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i> LUNAS / PAID VIA QRIS
                        </span>
                        <h3 class="fw-extrabold text-dark mb-1 font-monospace">#INV-2026-089</h3>
                        <div class="text-muted small">No. Referensi QRIS: <strong class="text-dark">NMID-99201482910</strong></div>
                    </div>

                    <div class="text-sm-end">
                        <div class="text-muted small mb-1">Tanggal Transaksi</div>
                        <div class="fw-bold text-dark">05 Agustus 2026, 10:00 WIB</div>
                        <div class="text-muted small mt-2">Metode Pembayaran</div>
                        <div class="fw-bold text-purple" style="color: #5E2CB5;"><i class="bi bi-qr-code-scan me-1"></i> QRIS Dinamis (ShopeePay/Gopay/BCA)</div>
                    </div>
                </div>

                <!-- Billed From & Billed To Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-light border h-100">
                            <div class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">DITERBITKAN OLEH</div>
                            <div class="fw-bold text-dark fs-6">Dr. Julian Vance, Ph.D.</div>
                            <div class="text-secondary small">Spesialis Cognitive Behavioral Therapy (CBT)</div>
                            <div class="text-muted small mt-2"><i class="bi bi-envelope me-1"></i> therapist@serenepath.com</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-light border h-100">
                            <div class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">DITUJUKAN KEPADA</div>
                            <div class="fw-bold text-dark fs-6">Sarah Jenkins</div>
                            <div class="text-secondary small">Pasien Terdaftar • ID: PT-2049</div>
                            <div class="text-muted small mt-2"><i class="bi bi-telephone me-1"></i> +62 812-3456-7890</div>
                        </div>
                    </div>
                </div>

                <!-- Itemized Invoice Table -->
                <div class="table-responsive rounded-4 border mb-4">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr class="text-secondary small fw-bold">
                                <th class="py-3 ps-3">DESKRIPSI LAYANAN</th>
                                <th class="py-3 text-center">DURASI</th>
                                <th class="py-3 text-end pe-3">HARGA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom">
                                <td class="ps-3 py-3">
                                    <div class="fw-bold text-dark">Sesi Terapi Online (Video Call)</div>
                                    <div class="text-muted small">Spesialisasi: Cognitive Behavioral Therapy (CBT), Anxiety</div>
                                </td>
                                <td class="text-center py-3">50 Menit</td>
                                <td class="text-end pe-3 py-3 fw-bold text-dark">Rp 350.000</td>
                            </tr>
                            <tr>
                                <td class="ps-3 py-2 text-muted small">Platform & Service Fee</td>
                                <td class="text-center py-2 text-muted small">-</td>
                                <td class="text-end pe-3 py-2 text-muted small">Rp 0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Invoice Total Box -->
                <div class="p-4 rounded-4 text-white d-flex justify-content-between align-items-center" style="background-color: #5E2CB5;">
                    <div>
                        <div class="small text-white-50 uppercase fw-semibold" style="font-size: 0.78rem;">TOTAL PEMBAYARAN</div>
                        <div class="fs-6 fw-normal">Sudah dibayar penuh via QRIS</div>
                    </div>
                    <div class="display-6 fw-extrabold" style="font-weight: 800;">Rp 350.000</div>
                </div>

            </div>

            <!-- Modal Footer Buttons -->
            <div class="modal-footer bg-light p-3 border-top-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light border text-secondary rounded-3 px-3" data-bs-dismiss="modal">Tutup</button>
                <div class="d-flex gap-2">
                    <button type="button" onclick="exportInvoicePDF('#INV-2026-089', 'Sarah Jenkins', 'Dr. Julian Vance, Ph.D.', 'Rp 350.000', '05 Agustus 2026')" class="btn btn-outline-purple rounded-3 px-3 py-2 fw-semibold" style="color: #5E2CB5; border-color: #5E2CB5;">
                        <i class="bi bi-printer me-1"></i> Cetak Invoice
                    </button>
                    <button type="button" onclick="exportInvoicePDF('#INV-2026-089', 'Sarah Jenkins', 'Dr. Julian Vance, Ph.D.', 'Rp 350.000', '05 Agustus 2026')" class="btn text-white rounded-3 px-4 py-2 fw-bold" style="background-color: #5E2CB5;">
                        <i class="bi bi-download me-1"></i> Unduh PDF
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Detail Invoice (Pending Invoice) -->
<div class="modal fade" id="invoiceModal2" tabindex="-1" aria-labelledby="invoiceModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            
            <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #D97706 0%, #B45309 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle p-2 text-warning d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-clock-history fs-3 text-warning"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">SerenePath Invoice (Pending)</h4>
                        <div class="small opacity-75">Menunggu Konfirmasi Bukti Pembayaran QRIS</div>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 p-md-5">
                <div class="d-flex flex-column flex-sm-row justify-content-between border-bottom pb-4 mb-4 gap-3">
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-2 fw-bold rounded-pill mb-2">
                            <i class="bi bi-clock-history me-1"></i> MENUNGGU PEMBAYARAN
                        </span>
                        <h3 class="fw-extrabold text-dark mb-1 font-monospace">#INV-2026-090</h3>
                    </div>

                    <div class="text-sm-end">
                        <div class="text-muted small mb-1">Tanggal Transaksi</div>
                        <div class="fw-bold text-dark">06 Agustus 2026, 11:30 WIB</div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-light border h-100">
                            <div class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.75rem;">DITERBITKAN OLEH</div>
                            <div class="fw-bold text-dark fs-6">Dr. Julian Vance, Ph.D.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-light border h-100">
                            <div class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.75rem;">DITUJUKAN KEPADA</div>
                            <div class="fw-bold text-dark fs-6">Michael T.</div>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-4 text-dark bg-warning-subtle border border-warning d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-muted fw-semibold">TOTAL TAGIHAN</div>
                        <div class="fs-6 text-secondary">Nominal QRIS Dinamis</div>
                    </div>
                    <div class="display-6 fw-extrabold text-dark">Rp 350.000</div>
                </div>
            </div>

            <div class="modal-footer bg-light p-3 border-top-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light border text-secondary rounded-3 px-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" onclick="alert('Pemberitahuan tagihan telah dikirim ulang ke pasien via WhatsApp.')" class="btn text-white rounded-3 px-4 py-2 fw-bold" style="background-color: #D97706;">
                    <i class="bi bi-send me-1"></i> Kirim Pengingat Bayar
                </button>
            </div>

        </div>
    </div>
</div>

<script>
function exportInvoicePDF(invNum, patientName, therapistName, amount, date, status = 'LUNAS') {
    const printWindow = window.open('', '_blank', 'width=850,height=950');
    const htmlContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Invoice ${invNum} - SerenePath</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
            <style>
                body { font-family: system-ui, -apple-system, sans-serif; background-color: #ffffff; }
                @media print {
                    .no-print { display: none !important; }
                    body { padding: 0 !important; }
                }
            </style>
        </head>
        <body class="p-4" onload="window.print();">
            <div class="no-print mb-4 d-flex justify-content-between align-items-center bg-light p-3 rounded-4 border">
                <div class="fw-bold text-dark"><i class="bi bi-file-earmark-pdf-fill me-2" style="color: #5E2CB5;"></i> Mode Export PDF / Cetak Invoice ${invNum}</div>
                <button onclick="window.print()" class="btn text-white fw-bold btn-sm px-4 rounded-3" style="background-color: #5E2CB5;">
                    <i class="bi bi-printer me-1"></i> Klik Untuk Simpan PDF / Cetak
                </button>
            </div>

            <div class="border rounded-5 p-5 shadow-sm">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
                    <div>
                        <h2 class="fw-bold mb-1" style="color: #5E2CB5;"><i class="bi bi-flower2 me-2"></i>SerenePath</h2>
                        <div class="text-secondary small">Platform Telekonsultasi & Kesehatan Mental Terverifikasi</div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success text-white px-3 py-1.5 fw-bold rounded-pill mb-2">● ${status} VIA QRIS</span>
                        <h4 class="fw-bold font-monospace text-dark mb-0">${invNum}</h4>
                        <div class="text-muted small mt-1">Tanggal: ${date}</div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="p-3.5 bg-light rounded-4 border">
                            <div class="text-uppercase text-muted small fw-bold mb-1">PENYEDIA LAYANAN (TERAPIS)</div>
                            <div class="fw-bold text-dark fs-6">${therapistName}</div>
                            <div class="text-secondary small">Psikolog Klinis Terverifikasi</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3.5 bg-light rounded-4 border">
                            <div class="text-uppercase text-muted small fw-bold mb-1">PEMBAYAR (PASIEN)</div>
                            <div class="fw-bold text-dark fs-6">${patientName}</div>
                            <div class="text-secondary small">Status Transaksi Valid</div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive rounded-4 border mb-4">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="small text-secondary fw-bold">
                                <th class="py-3 ps-3">DESKRIPSI LAYANAN</th>
                                <th class="py-3 text-center">DURASI</th>
                                <th class="py-3 text-end pe-3">NOMINAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-3 py-3">
                                    <div class="fw-bold text-dark">Sesi Terapi Online (Video Call & Konsultasi)</div>
                                    <div class="text-muted small">Spesialisasi Cognitive Behavioral Therapy (CBT)</div>
                                </td>
                                <td class="text-center py-3">50 Menit</td>
                                <td class="text-end pe-3 py-3 fw-bold text-dark">${amount}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Total -->
                <div class="p-4 rounded-4 text-white d-flex justify-content-between align-items-center mb-4" style="background-color: #5E2CB5;">
                    <div>
                        <div class="fw-bold">TOTAL PEMBAYARAN</div>
                        <div class="small opacity-75">Telah dilunasi via QRIS Dinamis</div>
                    </div>
                    <div class="fs-2 fw-extrabold">${amount}</div>
                </div>

                <div class="mt-5 text-center text-muted small border-top pt-3">
                    Invoice ini sah dan diterbitkan secara elektronik oleh SerenePath Mental Health Platform.<br>
                    NMID QRIS: ID1020021035252 • Terverifikasi Bank Indonesia
                </div>
            </div>
        </body>
        </html>
    `;
    printWindow.document.write(htmlContent);
    printWindow.document.close();
}
</script>
@endsection
