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
                                            @if($session->payment_status === 'paid' || $session->status === 'accepted')
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

                                <div class="d-flex align-items-center gap-2">
                                    @php
                                        try {
                                            $bookingCarbon = \Carbon\Carbon::parse($session->booking_date);
                                            $isTimeReady = $bookingCarbon->isToday() || $bookingCarbon->isPast();
                                        } catch (\Exception $e) {
                                            $isTimeReady = true;
                                        }
                                    @endphp

                                    @if($session->payment_status === 'unpaid')
                                        <a href="{{ route('booking.pay', $session->id) }}" class="btn text-white fw-bold rounded-3 px-3 py-2 small shadow-sm" style="background-color: #5E2CB5;">
                                            <i class="bi bi-qr-code-scan me-1"></i> Bayar QRIS
                                        </a>
                                    @elseif($isTimeReady)
                                        <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $session->whatsapp_number ?? '6281234567890') }}?text=Halo%20{{ urlencode($session->therapist_name) }},%20saya%20{{ urlencode($session->patient_name) }}%20siap%20memulai%20sesi%20konsultasi%20online." 
                                           target="_blank" 
                                           class="btn btn-success fw-bold rounded-3 px-3 py-2 small shadow-sm d-flex align-items-center gap-1">
                                            <i class="bi bi-whatsapp"></i> Mulai Konsultasi
                                        </a>
                                        <a href="{{ route('user.search') }}" class="btn btn-purple-light text-purple fw-semibold rounded-3 px-3 py-2 small" style="background-color: #F3E8FF; color: #5E2CB5;">Jadwal Ulang</a>
                                    @else
                                        <button type="button" 
                                                class="btn btn-light text-muted border fw-semibold rounded-3 px-3 py-2 small" 
                                                style="background-color: #F8FAFC; cursor: not-allowed;" 
                                                onclick="alert('Sesi konsultasi baru dapat dimulai saat jam jadwal Terapis tiba ({{ $session->booking_date }} @ {{ $session->booking_time }}).')" 
                                                title="Sesi konsultasi belum dimulai. Silakan tunggu hingga jadwal sesi tiba.">
                                            <i class="bi bi-clock-history me-1"></i> Mulai Konsultasi
                                        </button>
                                        <a href="{{ route('user.search') }}" class="btn btn-purple-light text-purple fw-semibold rounded-3 px-3 py-2 small" style="background-color: #F3E8FF; color: #5E2CB5;">Jadwal Ulang</a>
                                    @endif
                                    <button type="button" onclick="alert('Permintaan pembatalan sesi telah dikirim ke terapis.')" class="btn btn-light text-secondary border fw-semibold rounded-3 px-3 py-2 small">Batalkan</button>
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
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">{{ $awaitingPayment->session_type }}</h6>
                                    <div class="text-muted small">{{ $awaitingPayment->therapist_name }} • {{ $awaitingPayment->booking_date }}</div>
                                </div>
                                <span class="fs-5 fw-extrabold text-dark">{{ $awaitingPayment->price }}</span>
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
</script>
@endsection
