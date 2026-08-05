@extends('layouts.app')

@section('title', 'History & Ratings - SerenePath')

@section('content')
<div class="py-4 bg-light min-vh-100">
    <div class="container">
        
        <div class="mb-4">
            <h1 class="display-6 fw-bold text-dark mb-1" style="font-weight: 800;">History & Ratings</h1>
            <p class="text-secondary">Review your past consultation sessions and manage your invoices.</p>
        </div>

        <style>
            .nav-pills-purple .nav-link.active {
                background-color: #5E2CB5 !important;
                color: #FFFFFF !important;
                box-shadow: 0 4px 12px rgba(94, 44, 181, 0.25);
            }
            .nav-pills-purple .nav-link {
                color: #475569;
                transition: all 0.2s ease;
            }
            .nav-pills-purple .nav-link:hover:not(.active) {
                color: #5E2CB5;
                background-color: #F3E8FF;
            }
        </style>

        <!-- Navigation Tabs -->
        <ul class="nav nav-pills nav-pills-purple gap-2 mb-4 bg-white p-2 rounded-4 border shadow-sm max-w-md" id="paymentTabs" role="tablist">
            <li class="nav-item flex-fill text-center" role="presentation">
                <button class="nav-link active w-100 fw-bold rounded-3 py-2.5" id="sessions-tab" data-bs-toggle="pill" data-bs-target="#sessions-pane" type="button" role="tab" aria-controls="sessions-pane" aria-selected="true">
                    <i class="bi bi-clock-history me-1"></i> Past Sessions
                </button>
            </li>
            <li class="nav-item flex-fill text-center" role="presentation">
                <button class="nav-link w-100 fw-bold rounded-3 py-2.5" id="invoices-tab" data-bs-toggle="pill" data-bs-target="#invoices-pane" type="button" role="tab" aria-controls="invoices-pane" aria-selected="false">
                    <i class="bi bi-receipt me-1"></i> Invoices & Receipts
                </button>
            </li>
        </ul>

        <!-- Tab Content Panes -->
        <div class="tab-content" id="paymentTabContent">
            
            <!-- Pane 1: Past Sessions List -->
            <div class="tab-pane fade show active" id="sessions-pane" role="tabpanel" aria-labelledby="sessions-tab" tabindex="0">
                <div class="d-flex flex-column gap-3 max-w-4xl">
                    <!-- Item 1 -->
                    <div class="bg-white p-4 rounded-4 border shadow-sm d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&auto=format&fit=crop&q=80" alt="Dr. Sarah Jenkins" class="rounded-circle object-fit-cover" style="width: 56px; height: 56px;">
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Dr. Sarah Jenkins</h5>
                                <div class="text-muted small">
                                    <i class="bi bi-calendar-event me-1"></i> Oct 12, 2023 &nbsp;•&nbsp; <i class="bi bi-clock me-1"></i> 45 min
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn text-white fw-bold rounded-3 px-3 py-2 small shadow-sm" style="background-color: #5E2CB5;" data-bs-toggle="modal" data-bs-target="#ratingModal">
                                <i class="bi bi-star me-1"></i> Beri Ulasan
                            </button>
                            <button class="btn btn-light text-secondary border-0"><i class="bi bi-three-dots-vertical"></i></button>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="bg-white p-4 rounded-4 border shadow-sm d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle text-purple fw-bold d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; background-color: #F1F5F9; color: #475569;">
                                MJ
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Mark Johnson, LCSW</h5>
                                <div class="text-muted small">
                                    <i class="bi bi-calendar-event me-1"></i> Sep 28, 2023 &nbsp;•&nbsp; <i class="bi bi-clock me-1"></i> 60 min
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <div class="text-warning small fw-bold mb-1">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i> <span class="text-dark">4.5</span>
                            </div>
                            <span class="fst-italic text-muted small">"Very helpful session."</span>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="bg-white p-4 rounded-4 border shadow-sm d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=150&auto=format&fit=crop&q=80" alt="Dr. Robert Chen" class="rounded-circle object-fit-cover" style="width: 56px; height: 56px;">
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Dr. Robert Chen</h5>
                                <div class="text-muted small">
                                    <i class="bi bi-calendar-event me-1"></i> Sep 15, 2023 &nbsp;•&nbsp; <i class="bi bi-clock me-1"></i> 45 min
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="button" class="btn text-white fw-bold rounded-3 px-3 py-2 small shadow-sm" style="background-color: #5E2CB5;" data-bs-toggle="modal" data-bs-target="#ratingModal">
                                <i class="bi bi-star me-1"></i> Beri Ulasan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pane 2: Invoices & Receipts -->
            <div class="tab-pane fade" id="invoices-pane" role="tabpanel" aria-labelledby="invoices-tab" tabindex="0">
                <div class="d-flex flex-column gap-3 max-w-4xl">
                    
                    <!-- Invoice Card 1 -->
                    <div class="bg-white p-4 rounded-4 border shadow-sm d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-3 text-purple d-flex align-items-center justify-content-center" style="background-color: #F3E8FF; color: #5E2CB5; width: 52px; height: 52px;">
                                <i class="bi bi-receipt-cutoff fs-4"></i>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fw-bold text-dark mb-0 font-monospace">#INV-2026-089</h5>
                                    <span class="badge bg-success-subtle text-success px-2.5 py-1 rounded-pill fw-bold" style="font-size: 0.75rem;">LUNAS</span>
                                </div>
                                <div class="text-muted small mt-1">
                                    <span>Dr. Sarah Jenkins</span> &nbsp;•&nbsp; <span>05 Ags 2026</span> &nbsp;•&nbsp; <span class="fw-bold text-dark">Rp 350.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-outline-purple rounded-3 px-3 py-2 small fw-bold" style="color: #5E2CB5; border-color: #5E2CB5;" data-bs-toggle="modal" data-bs-target="#userInvoiceModal">
                                <i class="bi bi-eye me-1"></i> Lihat Invoice
                            </button>
                            <button type="button" onclick="exportInvoicePDF('#INV-2026-089', 'Sarah Jenkins', 'Dr. Sarah Jenkins', 'Rp 350.000', '05 Agustus 2026')" class="btn text-white rounded-3 px-3 py-2 small fw-bold" style="background-color: #5E2CB5;">
                                <i class="bi bi-download me-1"></i> Unduh PDF
                            </button>
                        </div>
                    </div>

                    <!-- Invoice Card 2 -->
                    <div class="bg-white p-4 rounded-4 border shadow-sm d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-3 text-secondary d-flex align-items-center justify-content-center" style="background-color: #F1F5F9; color: #475569; width: 52px; height: 52px;">
                                <i class="bi bi-receipt-cutoff fs-4"></i>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fw-bold text-dark mb-0 font-monospace">#INV-2026-042</h5>
                                    <span class="badge bg-success-subtle text-success px-2.5 py-1 rounded-pill fw-bold" style="font-size: 0.75rem;">LUNAS</span>
                                </div>
                                <div class="text-muted small mt-1">
                                    <span>Dr. Robert Chen</span> &nbsp;•&nbsp; <span>15 Sep 2025</span> &nbsp;•&nbsp; <span class="fw-bold text-dark">Rp 300.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-outline-purple rounded-3 px-3 py-2 small fw-bold" style="color: #5E2CB5; border-color: #5E2CB5;" data-bs-toggle="modal" data-bs-target="#userInvoiceModal">
                                <i class="bi bi-eye me-1"></i> Lihat Invoice
                            </button>
                            <button type="button" onclick="exportInvoicePDF('#INV-2026-042', 'Sarah Jenkins', 'Dr. Robert Chen', 'Rp 300.000', '15 September 2025')" class="btn text-white rounded-3 px-3 py-2 small fw-bold" style="background-color: #5E2CB5;">
                                <i class="bi bi-download me-1"></i> Unduh PDF
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Give Rating & Review -->
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="ratingModalLabel"><i class="bi bi-star-fill text-warning me-2"></i> Beri Ulasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('review.store') }}" method="POST" id="formUserReview">
                @csrf
                <input type="hidden" name="rating" id="selectedRatingValue" value="5">
                <div class="modal-body py-3">
                    <div class="mb-4 text-center p-3 rounded-4" style="background-color: #F8FAFC; border: 1px solid #E2E8F0;">
                        <label class="form-label fw-bold text-dark d-block mb-2">Pilih Rating Sesi Anda</label>
                        <div class="fs-1 text-warning mb-2" id="starRatingContainer" style="cursor: pointer;">
                            <i class="bi bi-star me-1 rating-star" onclick="setRating(1)" onmouseover="hoverRating(1)" onmouseout="resetRating()"></i>
                            <i class="bi bi-star me-1 rating-star" onclick="setRating(2)" onmouseover="hoverRating(2)" onmouseout="resetRating()"></i>
                            <i class="bi bi-star me-1 rating-star" onclick="setRating(3)" onmouseover="hoverRating(3)" onmouseout="resetRating()"></i>
                            <i class="bi bi-star me-1 rating-star" onclick="setRating(4)" onmouseover="hoverRating(4)" onmouseout="resetRating()"></i>
                            <i class="bi bi-star rating-star" onclick="setRating(5)" onmouseover="hoverRating(5)" onmouseout="resetRating()"></i>
                        </div>
                        <div class="small fw-bold text-purple" id="ratingTextDisplay" style="color: #5E2CB5;">Silakan klik bintang di atas (1 - 5 Bintang)</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Ulasan / Pengalaman Konsultasi</label>
                        <textarea name="comment" id="reviewCommentText" class="form-control rounded-3 py-2.5" rows="3" placeholder="Tuliskan ulasan Anda mengenai terapis (misal: Sesi sangat membantu, terapis sangat mendengarkan)..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light text-secondary border rounded-3 px-3 py-2 small fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-3 px-4 py-2 small fw-bold shadow-sm" style="background-color: #5E2CB5;">Beri Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sukses Beri Ulasan (Bootstrap Success Modal) -->
<div class="modal fade" id="reviewSuccessModal" tabindex="-1" aria-labelledby="reviewSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-5 border-0 shadow-lg text-center p-3">
            <div class="modal-body py-4">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 72px; height: 72px; background-color: #F3E8FF; color: #5E2CB5;">
                    <i class="bi bi-check-circle-fill display-5"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2">Ulasan Berhasil Disimpan!</h4>
                <p class="text-secondary small mb-4" id="successModalText">
                    {{ session('success') ?? 'Terima kasih atas ulasan Anda! Rating dan komentar telah berhasil tersimpan secara permanen di database MySQL.' }}
                </p>
                <button type="button" class="btn text-white w-100 py-2.5 fw-bold rounded-3 shadow-sm" style="background-color: #5E2CB5;" data-bs-dismiss="modal">Selesai</button>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successModal = new bootstrap.Modal(document.getElementById('reviewSuccessModal'));
        successModal.show();
    });
</script>
@endif

<script>
let currentSelectedRating = 5; // Default 5 star
const ratingLabels = [
    "",
    "1 / 5 Bintang (Kurang Puas)",
    "2 / 5 Bintang (Cukup)",
    "3 / 5 Bintang (Baik)",
    "4 / 5 Bintang (Sangat Baik)",
    "5 / 5 Bintang (Sangat Puas / Sempurna)"
];

document.addEventListener("DOMContentLoaded", function() {
    setRating(5);
});

function setRating(val) {
    currentSelectedRating = val;
    document.getElementById('selectedRatingValue').value = val;
    renderStars(val);
}

function hoverRating(val) {
    renderStars(val);
}

function resetRating() {
    renderStars(currentSelectedRating);
}

function renderStars(rating) {
    const stars = document.querySelectorAll('#starRatingContainer .rating-star');
    const labelDisplay = document.getElementById('ratingTextDisplay');
    
    stars.forEach((star, index) => {
        if (index < rating) {
            star.className = 'bi bi-star-fill me-1 text-warning rating-star';
        } else {
            star.className = 'bi bi-star me-1 text-muted opacity-50 rating-star';
        }
    });

    if (labelDisplay && rating >= 1 && rating <= 5) {
        labelDisplay.innerText = ratingLabels[rating];
    }
}

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

<!-- Modal User Invoice Preview -->
<div class="modal fade" id="userInvoiceModal" tabindex="-1" aria-labelledby="userInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #5E2CB5 0%, #4C1D95 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle p-2 text-purple d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; color: #5E2CB5;">
                        <i class="bi bi-flower2 fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Bukti Pembayaran Kuitansi / Invoice</h5>
                        <div class="small opacity-75">SerenePath Mental Health Platform</div>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 p-md-5">
                <div class="d-flex justify-content-between border-bottom pb-4 mb-4">
                    <div>
                        <span class="badge bg-success text-white px-3 py-1.5 fw-bold rounded-pill mb-2">● LUNAS VIA QRIS</span>
                        <h4 class="fw-extrabold text-dark mb-0 font-monospace">#INV-2026-089</h4>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">Tanggal Pembayaran</div>
                        <div class="fw-bold text-dark">05 Agustus 2026</div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small font-bold">PENYEDIA LAYANAN</div>
                            <div class="fw-bold text-dark">Dr. Sarah Jenkins</div>
                            <div class="text-secondary small">Clinical Psychologist</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small font-bold">PEMBAYAR (PASIEN)</div>
                            <div class="fw-bold text-dark">Sarah Jenkins</div>
                            <div class="text-secondary small">Terverifikasi</div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive rounded-3 border mb-4">
                    <table class="table mb-0">
                        <thead class="bg-light">
                            <tr class="small text-secondary fw-bold">
                                <th>Layanan</th>
                                <th class="text-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">Sesi Terapi Online (Cognitive Behavioral Therapy)</div>
                                    <div class="text-muted small">Durasi 50 Menit via Video Call</div>
                                </td>
                                <td class="text-end fw-bold text-dark">Rp 350.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-3 rounded-3 text-white d-flex justify-content-between align-items-center" style="background-color: #5E2CB5;">
                    <span class="fw-bold">Total Pembayaran</span>
                    <span class="fs-4 fw-extrabold">Rp 350.000</span>
                </div>
            </div>

            <div class="modal-footer bg-light border-top-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light border text-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" onclick="exportInvoicePDF('#INV-2026-089', 'Sarah Jenkins', 'Dr. Sarah Jenkins', 'Rp 350.000', '05 Agustus 2026')" class="btn text-white fw-bold px-4" style="background-color: #5E2CB5;">
                    <i class="bi bi-printer me-1"></i> Cetak / Simpan PDF
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
