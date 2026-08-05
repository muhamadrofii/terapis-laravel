@extends('layouts.therapist')

@section('title', 'Dashboard Terapis - Terapis Online')

@section('content')
<!-- Header Text -->
<div class="mb-4">
    <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem; letter-spacing: -0.5px;">Selamat Pagi, {{ Auth::user()->name }}.</h1>
    <p class="text-secondary" style="font-size: 1.05rem; color: #64748B;">Berikut ringkasan jadwal sesi dan pasien Anda untuk hari ini.</p>
</div>

<div class="row g-4">
    <!-- Left Column: UP NEXT Bento Card & Pending Bookings -->
    <div class="col-lg-7">
        <!-- UP NEXT Bento Card -->
        @if($nextSession)
            <div class="sp-card p-4 mb-4 position-relative overflow-hidden shadow-sm" style="background: #FFFFFF; border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="badge uppercase tracking-wider mb-2 px-3 py-1 fw-bold text-white" style="background-color: #0D9488; font-size: 0.7rem; border-radius: 4px;">SESI BERIKUTNYA</span>
                        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.85rem; letter-spacing: -0.5px;">{{ $nextSession->patient_name }}</h2>
                        <p class="text-secondary mb-0" style="font-size: 0.95rem;">{{ $nextSession->session_type }} • {{ $nextSession->booking_date }}</p>
                        @if($nextSession->notes)
                            <p class="text-muted italic small mt-1 mb-0" style="font-size: 0.82rem;">
                                <i class="bi bi-chat-left-text me-1"></i> Keluhan: "{{ $nextSession->notes }}"
                            </p>
                        @endif
                    </div>
                    <div class="text-end">
                        <span class="small fw-bold text-purple d-block" style="color: #5E2CB5; font-size: 0.85rem;">Dimulai pukul</span>
                        <span class="display-5 fw-extrabold text-purple" style="color: #5E2CB5; font-weight: 800;">{{ $nextSession->booking_time }}</span>
                    </div>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2 pt-3 border-top" style="border-color: #F1F5F9 !important;">
                    <button type="button" onclick="openLiveChat('{{ $nextSession->patient_name }}', '{{ $nextSession->patient_avatar ?? '' }}', '{{ $nextSession->id }}')" class="btn text-white px-4 py-2 rounded-3 fw-bold shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5; font-size: 0.9rem;">
                        <i class="bi bi-chat-dots-fill"></i> Chat
                    </button>
                    <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $nextSession->whatsapp_number ?? '6281234567890') }}?text=Halo%20{{ urlencode($nextSession->patient_name) }},%20saya%20terapis%20Anda%20siap%20memulai%20sesi%20konsultasi%20online." target="_blank" class="btn btn-success px-4 py-2 rounded-3 fw-bold shadow-sm d-flex align-items-center gap-2" style="font-size: 0.9rem;">
                        <i class="bi bi-whatsapp"></i> Mulai Konsultasi
                    </a>
                </div>
            </div>
        @else
            <div class="sp-card p-4 mb-4 shadow-sm bg-white rounded-4 text-center py-4">
                <i class="bi bi-calendar-check text-muted fs-1 mb-2 d-block"></i>
                <h6 class="fw-bold text-dark mb-1">Belum Ada Sesi Berikutnya</h6>
                <p class="text-muted small mb-0">Semua sesi janji konsultasi telah selesai dilakukan.</p>
            </div>
        @endif

        <!-- Pending Bookings Section -->
        <div class="mb-4">
            <h5 class="fw-bold text-dark mb-3" style="font-size: 1.2rem;">Permintaan Booking Baru ({{ count($pendingBookings) }})</h5>
            
            <div class="d-flex flex-column gap-3">
                @forelse($pendingBookings as $pBooking)
                    <div class="sp-card p-3 d-flex align-items-center justify-content-between shadow-sm bg-white" style="border-radius: 16px;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle text-purple fw-bold d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: #F3E8FF; color: #5E2CB5; font-size: 0.9rem;">
                                {{ strtoupper(substr($pBooking->patient_name, 0, 2)) }}
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">{{ $pBooking->patient_name }}</h6>
                                <span class="text-muted small" style="font-size: 0.8rem;">{{ $pBooking->booking_date }} @ {{ $pBooking->booking_time }} - {{ $pBooking->session_type }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <form action="{{ route('therapist.booking.status', $pBooking->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="declined">
                                <button type="submit" class="btn btn-light rounded-circle p-2 text-danger border-0 shadow-sm" style="width: 36px; height: 36px;" title="Tolak">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                            <form action="{{ route('therapist.booking.status', $pBooking->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="btn btn-light rounded-circle p-2 text-success border-0 shadow-sm" style="width: 36px; height: 36px;" title="Terima">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="sp-card p-3 text-center bg-white rounded-3 border">
                        <span class="text-muted small">Tidak ada permintaan booking pending saat ini.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right Column: My Schedule Widget -->
    <div class="col-lg-5">
        <div class="sp-card p-4 shadow-sm bg-white" style="border-radius: 20px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0" style="font-size: 1.2rem;">Jadwal Saya Hari Ini</h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge text-teal fw-semibold rounded-pill px-2 py-1" style="background-color: #CCFBF1; color: #0D9488; font-size: 0.72rem;">
                        <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> LIVE
                    </span>
                    <i class="bi bi-three-dots text-muted cursor-pointer"></i>
                </div>
            </div>

            <!-- Timeline Appointments from MySQL -->
            <div class="d-flex flex-column gap-3 mt-3">
                @forelse($todaySchedule as $item)
                    <div class="d-flex gap-3 align-items-start border-start border-3 ps-3" style="border-left-color: {{ $item->status === 'accepted' ? '#0D9488' : '#5E2CB5' }} !important;">
                        <div>
                            <span class="small fw-bold text-dark d-block" style="font-size: 0.82rem;">{{ $item->booking_time }}</span>
                            <span class="fw-bold text-dark small" style="font-size: 0.88rem;">{{ $item->patient_name }}</span>
                            <span class="text-muted d-block" style="font-size: 0.78rem;">{{ $item->session_type }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-muted small py-3 text-center">
                        Belum ada jadwal sesi untuk hari ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
