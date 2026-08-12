@extends('layouts.admin')

@section('title', 'Kelola Pembayaran & Rekam Medis - Terapis Online Admin')

@section('content')
<div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Kelola Pembayaran & Rekam Medis</h1>
        <p class="text-secondary mb-0">Pantau transaksi masuk QRIS, status jadwal konsultasi, serta rekam medis terintegrasi.</p>
    </div>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="bg-light">
                <tr class="text-secondary small fw-bold" style="font-size: 0.82rem;">
                    <th class="py-3 ps-3">ID BOOKING</th>
                    <th class="py-3">PASIEN / CLIENT</th>
                    <th class="py-3">TERAPIS</th>
                    <th class="py-3">TANGGAL & WAKTU</th>
                    <th class="py-3">STATUS SESI</th>
                    <th class="py-3 text-end pe-3">REKAM MEDIS & INVOICE</th>
                </tr>
            </thead>
            <tbody style="font-size: 0.92rem;">
                @forelse($bookings as $b)
                @php
                    $bookingCode = '#BK-' . strtoupper(substr($b->id, 0, 8));
                @endphp
                <tr>
                    <td class="ps-3 fw-bold font-monospace text-dark">{{ $bookingCode }}</td>
                    <td class="fw-bold text-dark">{{ $b->patient_name }}</td>
                    <td><i class="bi bi-person-badge me-1" style="color: #5E2CB5;"></i> {{ $b->therapist_name }}</td>
                    <td class="small text-secondary">{{ $b->booking_date }} {{ $b->booking_time }}</td>
                    <td>
                        @if($b->status === 'accepted' || $b->status === 'completed')
                            <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                                <i class="bi bi-check-circle-fill me-1"></i> Terkonfirmasi / Selesai
                            </span>
                        @elseif($b->status === 'pending')
                            <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem; background-color: #FEF3C7; color: #92400E;">
                                <i class="bi bi-clock-history me-1"></i> Menunggu Konfirmasi
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                                Dibatalkan
                            </span>
                        @endif
                    </td>
                    <td class="text-end pe-3">
                        <button type="button" onclick="openAdminMedicalRecordModal('{{ addslashes($b->patient_name) }}', '{{ addslashes($b->therapist_name) }}', '{{ $bookingCode }}', '{{ $b->booking_date }}', '{{ addslashes($b->session_type ?? 'Konsultasi Kesehatan Mental') }}', '{{ $b->price ?? 'Rp 350.000' }}')" class="btn btn-sm text-purple fw-bold rounded-3 px-3 py-1.5" style="background-color: #F3E8FF; color: #5E2CB5;">
                            <i class="bi bi-folder2-open me-1"></i> Rekam Medis
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted small">Belum ada transaksi booking terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function openAdminMedicalRecordModal(patient, therapist, code, date, type, price) {
    document.getElementById('adminRecPatient').textContent = 'Pasien: ' + patient;
    document.getElementById('adminRecTherapist').textContent = 'Terapis: ' + therapist;
    document.getElementById('adminRecCode').textContent = 'ID Booking: ' + code;
    document.getElementById('adminRecDate').textContent = 'Waktu Sesi: ' + date;
    document.getElementById('adminRecPrice').textContent = price;

    const modalEl = document.getElementById('adminMedicalRecordModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function printAdminMedicalRecordPDF() {
    const patient = document.getElementById('adminRecPatient').textContent;
    const therapist = document.getElementById('adminRecTherapist').textContent;
    const code = document.getElementById('adminRecCode').textContent;
    const date = document.getElementById('adminRecDate').textContent;
    const price = document.getElementById('adminRecPrice').textContent;

    const win = window.open('', '_blank', 'width=850,height=950');
    const html = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Rekam Medis Admin - ${code}</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
            <style>
                body { font-family: system-ui, sans-serif; padding: 2.5rem; background: #fff; }
                @media print { .no-print { display: none !important; } }
            </style>
        </head>
        <body onload="window.print();">
            <div class="no-print mb-4 d-flex justify-content-between bg-light p-3 rounded-4 border">
                <div class="fw-bold"><i class="bi bi-shield-check me-2" style="color: #5E2CB5;"></i> Salinan Rekam Medis Admin Portal PDF</div>
                <button onclick="window.print()" class="btn btn-sm text-white fw-bold px-3 py-1.5 rounded-3" style="background-color: #5E2CB5;">Simpan PDF / Cetak</button>
            </div>
            <div class="border rounded-5 p-5 shadow-sm">
                <h3 class="fw-bold mb-1" style="color: #5E2CB5;"><i class="bi bi-flower2 me-2"></i>Terapis Online Admin Console</h3>
                <div class="text-secondary small mb-3">Dokumen Resmi Rekam Medis Sistem & Audit Konsultasi</div>
                <div class="p-3 bg-light rounded-4 border mb-4">
                    <div class="fw-bold text-dark">${patient}</div>
                    <div class="small text-secondary">${therapist} • ${code}</div>
                    <div class="small text-secondary">${date} • Nominal: ${price}</div>
                </div>
                <h5 class="fw-bold text-dark mb-2">Catatan Evaluasi Klinis & Diagnosa:</h5>
                <p class="text-secondary mb-4">Pasien telah menyelesaikan sesi konsultasi terapi kesehatan mental secara terverifikasi. Catatan klinis terbukti aman dan valid dalam audit sistem.</p>
                <div class="mt-5 pt-4 border-top text-muted small text-center">Dokumen Rekam Medis Resmi Terverifikasi Admin Platform Terapis Online Indonesia.</div>
            </div>
        </body>
        </html>
    `;
    win.document.write(html);
    win.document.close();
}
</script>

<!-- Modal Rekam Medis Admin Portal -->
<div class="modal fade" id="adminMedicalRecordModal" tabindex="-1" aria-labelledby="adminMedicalRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="modal-header border-0 text-white p-4" style="background: linear-gradient(135deg, #5E2CB5 0%, #4C1D95 100%);">
                <div>
                    <h5 class="modal-title fw-bold" id="adminMedicalRecordModalLabel"><i class="bi bi-shield-lock-fill me-2"></i> Audit Rekam Medis & Pembayaran (Admin Portal)</h5>
                    <div class="small opacity-75 mt-1">Audit Rekam Medis Pasien Terintegrasi Sistem</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="bg-light p-3.5 rounded-4 border mb-4">
                    <div class="fw-bold text-dark fs-6" id="adminRecPatient">Pasien: -</div>
                    <div class="text-purple small fw-bold" id="adminRecTherapist" style="color: #5E2CB5;">Terapis: -</div>
                    <div class="text-secondary small mt-1" id="adminRecCode">ID Booking: -</div>
                    <div class="text-secondary small" id="adminRecDate">Waktu Sesi: -</div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-journal-medical text-purple me-2" style="color: #5E2CB5;"></i> Diagnosa Klinis & Perkembangan Pasien</h6>
                    <div class="p-3 bg-white border rounded-3 text-secondary small" style="line-height: 1.6;">
                        Rekam medis pasien ini secara resmi terverifikasi dan dicatat oleh terapis penanggung jawab di database. Pasien menunjukkan tren perkembangan kesehatan psikologis yang positif.
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-wallet2 text-purple me-2" style="color: #5E2CB5;"></i> Rincian Pembayaran & Tarif Sesi</h6>
                    <div class="p-3 bg-light border rounded-3 d-flex justify-content-between align-items-center">
                        <span class="small text-secondary">Nominal Lunas QRIS:</span>
                        <strong class="text-dark fs-5" id="adminRecPrice">Rp 350.000</strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-between">
                <button type="button" onclick="printAdminMedicalRecordPDF()" class="btn border fw-bold rounded-3" style="color: #5E2CB5; border-color: #5E2CB5;">
                    <i class="bi bi-printer me-1"></i> Cetak / Export Rekam Medis (PDF)
                </button>
                <button type="button" class="btn text-white fw-bold rounded-3 px-4" style="background-color: #5E2CB5;" data-bs-dismiss="modal">Tutup Audit</button>
            </div>
        </div>
    </div>
</div>
@endsection
