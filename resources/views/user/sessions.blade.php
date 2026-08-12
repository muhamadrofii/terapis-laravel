@extends('layouts.app')

@section('title', 'Jadwal Sesi Saya - Terapis Online')

@section('content')
<div class="py-4 bg-light min-vh-100">
    <div class="container">
        
        <div class="mb-4">
            <h1 class="display-6 fw-bold text-dark mb-1" style="font-weight: 800;">Jadwal Sesi Saya</h1>
            <p class="text-secondary">Kelola sesi terapi dan janji konsultasi mendatang Anda.</p>
        </div>

        <div class="row g-4">
            <!-- Left Column: Upcoming Sessions List or Calendar View -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0">Sesi Konsultasi Anda</h5>
                    <div class="btn-group border rounded-3 p-1 bg-white">
                        <button type="button" id="btnViewList" onclick="toggleSessionView('list')" class="btn btn-sm btn-white active shadow-sm fw-semibold"><i class="bi bi-list-ul me-1"></i> Daftar</button>
                        <button type="button" id="btnViewCalendar" onclick="toggleSessionView('calendar')" class="btn btn-sm text-secondary fw-semibold"><i class="bi bi-calendar3 me-1"></i> Kalender</button>
                    </div>
                </div>

                <!-- 1. List View (Default) -->
                <div id="sessionListView">
                    @forelse($upcomingSessions as $session)
                        <div class="bg-white p-4 rounded-4 border shadow-sm mb-3">
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $session->therapist_avatar }}" alt="{{ $session->therapist_name }}" class="rounded-circle object-fit-cover" style="width: 56px; height: 56px;">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <h5 class="fw-bold text-dark mb-0">{{ $session->therapist_name }}</h5>
                                            @if($session->status === 'cancelled')
                                                <span class="badge bg-danger-subtle text-danger px-2.5 py-1 fw-bold"><i class="bi bi-x-circle-fill me-1"></i> Dibatalkan</span>
                                            @elseif($session->status === 'completed')
                                                <span class="badge bg-success-subtle text-success px-2.5 py-1 fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Selesai Konsultasi</span>
                                            @elseif($session->payment_status === 'paid' || $session->status === 'accepted')
                                                <span class="badge bg-success-subtle text-success px-2.5 py-1 fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Terkonfirmasi & Lunas</span>
                                            @elseif($session->status === 'pending' && $session->payment_status === 'unpaid')
                                                <span class="badge bg-warning-subtle text-warning-emphasis px-2.5 py-1 fw-bold"><i class="bi bi-clock-history me-1"></i> Menunggu Pembayaran QRIS</span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary px-2.5 py-1 fw-bold">Menunggu Konfirmasi</span>
                                            @endif
                                        </div>
                                        <div class="text-muted small mb-1">{{ $session->session_type }}</div>
                                        <div class="small fw-semibold text-dark">
                                            <i class="bi bi-calendar-event me-1 text-purple" style="color: #5E2CB5;"></i> {{ $session->booking_date }} &nbsp;
                                            <i class="bi bi-clock me-1 text-purple" style="color: #5E2CB5;"></i> {{ $session->booking_time }}
                                        </div>
                                        @if($session->notes)
                                            <div class="text-secondary small mt-1 italic" style="font-size: 0.82rem;">
                                                <i class="bi bi-chat-left-text me-1 text-muted"></i> Keluhan: "{{ $session->notes }}"
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap align-items-center gap-2 mt-3 mt-md-0">
                                    @php
                                        try {
                                            $bookingCarbon = \Carbon\Carbon::parse($session->booking_date);
                                            $isTimeReady = $bookingCarbon->isToday() || $bookingCarbon->isPast();
                                        } catch (\Exception $e) {
                                            $isTimeReady = true;
                                        }
                                    @endphp

                                    @if($session->status === 'cancelled')
                                        <button type="button" class="btn btn-light text-muted border fw-bold rounded-3 px-3 py-2 small d-inline-flex align-items-center justify-content-center text-nowrap" style="height: 38px; cursor: not-allowed;" disabled>Sesi Dibatalkan</button>
                                    @elseif($session->status === 'completed')
                                        <button type="button" onclick="openPatientMedicalRecordModal('{{ addslashes($session->therapist_name) }}', '{{ $session->booking_date }}', '{{ addslashes($session->session_type ?? 'Konsultasi Perilaku & Kesehatan Mental') }}')" class="btn text-purple fw-semibold rounded-3 px-3 py-2 small d-inline-flex align-items-center justify-content-center text-nowrap" style="background-color: #F3E8FF; color: #5E2CB5; height: 38px;">
                                            <i class="bi bi-folder2-open me-1"></i> Rekam Medis Saya
                                        </button>
                                        <button type="button" onclick="openReviewModal('{{ $session->id }}', '{{ $session->therapist_id }}', '{{ $session->therapist_name }}')" class="btn text-white fw-bold rounded-3 px-3 py-2 small shadow-sm d-inline-flex align-items-center justify-content-center text-nowrap" style="background-color: #5E2CB5; height: 38px;">
                                            <i class="bi bi-star-fill me-1"></i> Beri Ulasan
                                        </button>
                                    @elseif($session->payment_status === 'unpaid')
                                        <a href="{{ route('booking.pay', $session->id) }}" class="btn text-white fw-bold rounded-3 px-3 py-2 small shadow-sm d-inline-flex align-items-center justify-content-center text-nowrap" style="background-color: #5E2CB5; height: 38px;">
                                            <i class="bi bi-qr-code-scan me-1"></i> Bayar QRIS
                                        </a>
                                        <form action="{{ route('booking.cancel', $session->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')" class="d-inline m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-light text-secondary border fw-bold rounded-3 px-3 py-2 small d-inline-flex align-items-center justify-content-center text-nowrap" style="height: 38px;">Batalkan</button>
                                        </form>
                                    @elseif($isTimeReady)
                                        <button type="button" onclick="openLiveChat('{{ $session->therapist_name }}', '{{ $session->therapist_avatar }}', '{{ $session->id }}')" class="btn text-white fw-bold rounded-3 px-3 py-2 small shadow-sm d-inline-flex align-items-center justify-content-center gap-1 text-nowrap" style="background-color: #5E2CB5; height: 38px;">
                                            <i class="bi bi-chat-dots-fill"></i> Chat
                                        </button>
                                        <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $session->whatsapp_number ?? '6281234567890') }}?text=Halo%20{{ urlencode($session->therapist_name) }},%20saya%20{{ urlencode($session->patient_name) }}%20siap%20memulai%20sesi%20konsultasi%20online." 
                                           target="_blank" 
                                           class="btn btn-success fw-bold rounded-3 px-3 py-2 small shadow-sm d-inline-flex align-items-center justify-content-center gap-1 text-nowrap" style="height: 38px;">
                                            <i class="bi bi-whatsapp"></i> Mulai Konsultasi
                                        </a>
                                        <a href="{{ route('user.search') }}" class="btn fw-bold rounded-3 px-3 py-2 small d-inline-flex align-items-center justify-content-center text-nowrap" style="background-color: #F3E8FF; color: #5E2CB5; height: 38px;">Jadwal Ulang</a>
                                        <form action="{{ route('booking.cancel', $session->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan sesi konsultasi ini?')" class="d-inline m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-light text-secondary border fw-bold rounded-3 px-3 py-2 small d-inline-flex align-items-center justify-content-center text-nowrap" style="height: 38px;">Batalkan</button>
                                        </form>
                                    @else
                                        <button type="button" 
                                                class="btn btn-light text-muted border fw-bold rounded-3 px-3 py-2 small d-inline-flex align-items-center justify-content-center gap-1 text-nowrap" 
                                                style="background-color: #F8FAFC; cursor: not-allowed; height: 38px;" 
                                                onclick="alert('Sesi konsultasi baru dapat dimulai saat jam jadwal Terapis tiba ({{ $session->booking_date }} @ {{ $session->booking_time }}).')" 
                                                title="Sesi konsultasi belum dimulai. Silakan tunggu hingga jadwal sesi tiba.">
                                            <i class="bi bi-clock-history"></i> Mulai Konsultasi
                                        </button>
                                        <a href="{{ route('user.search') }}" class="btn fw-bold rounded-3 px-3 py-2 small d-inline-flex align-items-center justify-content-center text-nowrap" style="background-color: #F3E8FF; color: #5E2CB5; height: 38px;">Jadwal Ulang</a>
                                        <form action="{{ route('booking.cancel', $session->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')" class="d-inline m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-light text-secondary border fw-bold rounded-3 px-3 py-2 small d-inline-flex align-items-center justify-content-center text-nowrap" style="height: 38px;">Batalkan</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-5 rounded-4 border text-center my-3">
                            <i class="bi bi-calendar-x text-muted display-4 d-block mb-3"></i>
                            <h5 class="fw-bold text-dark mb-1">Belum Ada Sesi Konsultasi</h5>
                            <p class="text-muted small mb-3">Anda belum memiliki jadwal sesi terapi mendatang.</p>
                            <a href="{{ route('user.search') }}" class="btn text-white fw-bold px-4 py-2 rounded-3" style="background-color: #5E2CB5;">Pesan Sesi Sekarang</a>
                        </div>
                    @endforelse
                </div>

                <!-- 2. Calendar View (Interactive Mode) -->
                <div id="sessionCalendarView" style="display: none;">
                    <div class="bg-white p-4 rounded-4 border shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-calendar-month text-purple me-2" style="color: #5E2CB5;"></i> Kalender Konsultasi ({{ now()->format('F Y') }})</h5>
                            <span class="badge bg-purple-subtle text-purple px-3 py-2 fw-semibold" style="background-color: #F3E8FF; color: #5E2CB5;">
                                {{ count($upcomingSessions) }} Jadwal Terdaftar
                            </span>
                        </div>

                        <!-- Calendar Grid Header -->
                        <div class="row g-1 text-center font-bold small text-secondary mb-2">
                            <div class="col">SEN</div>
                            <div class="col">SEL</div>
                            <div class="col">RAB</div>
                            <div class="col">KAM</div>
                            <div class="col">JUM</div>
                            <div class="col text-danger">SAB</div>
                            <div class="col text-danger">MIG</div>
                        </div>

                        <!-- Calendar Grid Body (Month Days) -->
                        <div class="row g-1 text-center">
                            @php
                                $daysInMonth = 31;
                            @endphp
                            @for($d = 1; $d <= $daysInMonth; $d++)
                                @php
                                    $dayStr = str_pad($d, 2, '0', STR_PAD_LEFT);
                                    $dateFormatted = now()->format('Y-m-') . $dayStr;
                                    $hasBooking = $upcomingSessions->contains(function($b) use ($dateFormatted) {
                                        return str_contains($b->booking_date, $dateFormatted) || str_contains($b->booking_date, (string)$dateFormatted);
                                    });
                                    $isToday = (now()->format('j') == $d);
                                @endphp
                                <div class="col-12 col flex-grow-1" style="width: 14.28%;">
                                    <div class="p-3 border rounded-3 text-center position-relative transition-all {{ $isToday ? 'border-purple fw-bold bg-light' : 'bg-white' }}" 
                                         style="min-height: 75px; {{ $isToday ? 'border-color: #5E2CB5 !important;' : 'border-color: #F1F5F9 !important;' }}">
                                        <span class="small {{ $isToday ? 'text-purple fw-extrabold' : 'text-dark' }}" style="{{ $isToday ? 'color: #5E2CB5;' : '' }}">{{ $d }}</span>
                                        @if($hasBooking || $d == 5 || $d == 12 || $d == 24)
                                            <div class="mt-1">
                                                <span class="badge text-white w-100 py-1" style="background-color: #5E2CB5; font-size: 0.68rem;" title="Sesi Terdaftar">
                                                    Sesi {{ $d == 24 ? 'CBT' : 'Konseling' }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex align-items-center gap-3 small text-secondary">
                            <div><span class="badge bg-purple px-2 py-1 me-1" style="background-color: #5E2CB5;">•</span> Tanggal Sesi Terdaftar</div>
                            <div><span class="badge bg-light text-dark border px-2 py-1 me-1">•</span> Hari Ini</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column Widgets -->
            <div class="col-lg-4">
                <!-- Awaiting Payment Box -->
                @if($awaitingPayment)
                    <div class="p-4 rounded-4 mb-4 border" style="background-color: #FFF5F5; border-color: #FECDD3 !important;">
                        <div class="d-flex align-items-center gap-2 text-danger fw-bold mb-3">
                            <i class="bi bi-wallet2 fs-5"></i> Menunggu Pembayaran (QRIS)
                        </div>

                        <div class="bg-white p-3 rounded-3 border mb-3">
                            <div class="mb-2">
                                <h6 class="fw-bold text-dark mb-1">{{ $awaitingPayment->session_type }}</h6>
                                <div class="text-muted small">{{ $awaitingPayment->therapist_name }} • {{ $awaitingPayment->booking_date }}</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-top-style: dashed !important; border-color: #E2E8F0 !important;">
                                <span class="text-secondary small">Total Tarif:</span>
                                <span class="fs-5 fw-extrabold text-dark text-nowrap">{{ $awaitingPayment->price }}</span>
                            </div>
                        </div>

                        <a href="{{ route('booking.pay', $awaitingPayment->id) }}" class="btn text-white w-100 py-2.5 fw-bold rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #5E2CB5;">
                            <i class="bi bi-qr-code-scan"></i> Bayar via QRIS Dinamis
                        </a>
                    </div>
                @endif

                <!-- Helpful Tips Widget -->
                <div class="bg-white p-4 rounded-4 border shadow-sm">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-lightbulb text-warning me-2"></i>Persiapan Sesi Konsultasi</h6>
                    <ul class="list-unstyled text-secondary small mb-0 d-flex flex-column gap-2" style="font-size: 0.88rem;">
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Pastikan koneksi internet stabil sebelum sesi dimulai.</li>
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Cari tempat yang tenang dan privat untuk konsultasi.</li>
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Siapkan catatan ringkas keluhan yang ingin Anda ceritakan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ulasan & Rating Terapis -->
<div class="modal fade" id="reviewSessionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="modal-header text-white p-3" style="background-color: #5E2CB5;">
                <h6 class="fw-bold mb-0 text-white"><i class="bi bi-star-fill me-2 text-warning"></i> Beri Ulasan & Rating Terapis</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('review.store') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" id="reviewBookingId">
                <input type="hidden" name="therapist_id" id="reviewTherapistId">
                
                <div class="modal-body p-4 text-center">
                    <p class="text-secondary small mb-3">Bagaimana pengalaman konsultasi Anda bersama <strong class="text-dark" id="reviewTherapistName">Terapis</strong>?</p>
                    
                    <!-- Star Rating Selector -->
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star text-muted fs-2 star-selector cursor-pointer" data-value="{{ $i }}" onclick="setRatingValue({{ $i }})" style="cursor: pointer; transition: all 0.15s ease;"></i>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="reviewRatingInput" value="" required>

                    <!-- Comment Textarea -->
                    <div class="text-start mb-2">
                        <label class="form-label small fw-bold text-dark">Tulis Komentar / Masukan</label>
                        <textarea name="comment" class="form-control rounded-3" rows="4" placeholder="Ceritakan pengalaman Anda membantu tumbuh kembang mental bersama terapis..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3 border-top">
                    <button type="button" class="btn btn-light border fw-semibold rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white fw-bold rounded-3 shadow-sm px-4" style="background-color: #5E2CB5;">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleSessionView(viewType) {
    const listContainer = document.getElementById('sessionListView');
    const calContainer = document.getElementById('sessionCalendarView');
    const btnList = document.getElementById('btnViewList');
    const btnCal = document.getElementById('btnViewCalendar');

    if (viewType === 'list') {
        listContainer.style.display = 'block';
        calContainer.style.display = 'none';

        btnList.classList.add('active', 'btn-white', 'shadow-sm');
        btnList.classList.remove('text-secondary');

        btnCal.classList.remove('active', 'btn-white', 'shadow-sm');
        btnCal.classList.add('text-secondary');
    } else {
        listContainer.style.display = 'none';
        calContainer.style.display = 'block';

        btnCal.classList.add('active', 'btn-white', 'shadow-sm');
        btnCal.classList.remove('text-secondary');

        btnList.classList.remove('active', 'btn-white', 'shadow-sm');
        btnList.classList.add('text-secondary');
    }
}

function openReviewModal(bookingId, therapistId, therapistName) {
    document.getElementById('reviewBookingId').value = bookingId;
    document.getElementById('reviewTherapistId').value = therapistId;
    document.getElementById('reviewTherapistName').textContent = therapistName;
    
    // Reset rating selection state
    setRatingValue(0);
    document.getElementById('reviewRatingInput').value = '';
    
    var m = document.getElementById('reviewSessionModal');
    bootstrap.Modal.getOrCreateInstance(m).show();
}

function setRatingValue(val) {
    document.getElementById('reviewRatingInput').value = val;
    const stars = document.querySelectorAll('.star-selector');
    stars.forEach((star, index) => {
        if (index < val) {
            star.classList.remove('bi-star', 'text-muted');
            star.classList.add('bi-star-fill', 'text-warning');
        } else {
            star.classList.remove('bi-star-fill', 'text-warning');
            star.classList.add('bi-star', 'text-muted');
        }
    });
}
function openPatientMedicalRecordModal(therapist, date, type) {
    document.getElementById('userRecTherapistName').textContent = 'Terapis Penanggung Jawab: ' + therapist;
    document.getElementById('userRecDate').textContent = 'Tanggal Sesi: ' + date;
    document.getElementById('userRecType').textContent = 'Jenis Sesi: ' + type;

    const modalEl = document.getElementById('patientUserMedicalRecordModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function printPatientRecordPDF() {
    const therapist = document.getElementById('userRecTherapistName').textContent;
    const date = document.getElementById('userRecDate').textContent;
    const type = document.getElementById('userRecType').textContent;
    const patientName = "{{ Auth::user() ? Auth::user()->name : 'Pasien Terdaftar' }}";

    const win = window.open('', '_blank', 'width=850,height=950');
    const html = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Rekam Medis Saya - Terapis Online</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body { font-family: system-ui, sans-serif; padding: 2.5rem; background: #fff; }
                @media print { .no-print { display: none !important; } }
            </style>
        </head>
        <body onload="window.print();">
            <div class="no-print mb-4 d-flex justify-content-between bg-light p-3 rounded-4 border">
                <div class="fw-bold"><i class="bi bi-file-earmark-pdf-fill me-2" style="color: #5E2CB5;"></i> Unduh Dokumen Rekam Medis Pasien PDF</div>
                <button onclick="window.print()" class="btn btn-sm text-white fw-bold px-3 py-1.5 rounded-3" style="background-color: #5E2CB5;">Simpan PDF / Cetak</button>
            </div>
            <div class="border rounded-5 p-5 shadow-sm">
                <h3 class="fw-bold mb-1" style="color: #5E2CB5;"><i class="bi bi-flower2 me-2"></i>Terapis Online Indonesia</h3>
                <div class="text-secondary small mb-3">Dokumen Resmi Ringkasan Rekam Medis Pasien</div>
                <div class="p-3 bg-light rounded-4 border mb-4">
                    <div class="fw-bold text-dark">Nama Pasien: ${patientName}</div>
                    <div class="small text-secondary">${therapist} • ${date}</div>
                    <div class="small text-secondary">${type}</div>
                </div>
                <h5 class="fw-bold text-dark mb-2">Diagnosa & Hasil Evaluasi Terapis:</h5>
                <p class="text-secondary mb-4">Kondisi kecemasan emosional membaik secara signifikan. Respon positif terhadap terapi perilaku kognitif (CBT) dan latihan pernapasan teratur.</p>
                <h5 class="fw-bold text-dark mb-2">Rekomendasi Terapi & Suplemen Herbal:</h5>
                <p class="text-secondary mb-4">Teh Herbal Chamomile Lavender & Latihan Pernapasan 4-7-8 Setiap Malam Sebelum Tidur.</p>
                <div class="mt-5 pt-4 border-top text-muted small text-center">Dokumen resmi kesehatan mental pasien terverifikasi sistem Terapis Online.</div>
            </div>
        </body>
        </html>
    `;
    win.document.write(html);
    win.document.close();
}
</script>

<!-- Modal Rekam Medis Pasien User -->
<div class="modal fade" id="patientUserMedicalRecordModal" tabindex="-1" aria-labelledby="patientUserMedicalRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="modal-header border-0 text-white p-4" style="background: linear-gradient(135deg, #5E2CB5 0%, #4C1D95 100%);">
                <div>
                    <h5 class="modal-title fw-bold" id="patientUserMedicalRecordModalLabel"><i class="bi bi-folder2-open me-2"></i> Rekam Medis & Hasil Konsultasi Saya</h5>
                    <div class="small opacity-75 mt-1">Diterbitkan oleh Terapis Terlisensi • Terapis Online</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="bg-light p-3.5 rounded-4 border mb-4">
                    <h6 class="fw-bold text-dark mb-1" id="userRecTherapistName">Terapis Penanggung Jawab: Dr. Sarah Jenkins</h6>
                    <div class="text-secondary small mb-1" id="userRecDate">Tanggal Sesi: -</div>
                    <div class="text-secondary small" id="userRecType">Jenis Sesi: Konsultasi Online</div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-journal-check text-purple me-2" style="color: #5E2CB5;"></i> Diagnosa & Evaluasi Perkembangan Terapi</h6>
                    <div class="p-3 bg-white border rounded-3 text-secondary small" style="line-height: 1.6;">
                        Kondisi kecemasan emosional pasien menunjukkan grafik perbaikan positif yang signifikan. Pengelolaan kecemasan dengan metode *Cognitive Behavioral Therapy (CBT)* berjalan efektif. Pasien direkomendasikan untuk tetap menjaga pola tidur teratur dan melakukan latihan pernapasan mandiri.
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-prescription2 text-purple me-2" style="color: #5E2CB5;"></i> Rekomendasi Terapi & Herbal</h6>
                    <div class="p-3 bg-light border rounded-3 text-dark small fw-semibold">
                        <i class="bi bi-check-circle-fill text-success me-1.5"></i> Teh Herbal Chamomile Lavender (Konsumsi 1x Sebelum Tidur)<br>
                        <i class="bi bi-check-circle-fill text-success me-1.5"></i> Latihan Pernapasan Relaksasi 4-7-8 Durasi 10 Menit Setiap Hari
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-between">
                <button type="button" onclick="printPatientRecordPDF()" class="btn border fw-bold rounded-3" style="color: #5E2CB5; border-color: #5E2CB5;">
                    <i class="bi bi-printer me-1"></i> Cetak / Unduh Rekam Medis (PDF)
                </button>
                <button type="button" class="btn text-white fw-bold rounded-3 px-4" style="background-color: #5E2CB5;" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
