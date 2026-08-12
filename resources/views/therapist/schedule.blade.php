@extends('layouts.therapist')

@section('title', 'Jadwal Sesi - Terapis Online')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Jadwal Sesi Konsultasi</h1>
        <p class="text-secondary mb-0">Lihat dan kelola ketersediaan waktu serta sesi konsultasi mendatang Anda.</p>
    </div>
    <button type="button" data-bs-toggle="modal" data-bs-target="#addSlotModal" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;">
        <i class="bi bi-plus-lg"></i> Tambah Slot Jadwal
    </button>
</div>

<!-- Schedule Timeline Widget -->
<div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-calendar3 me-2 text-purple" style="color: #5E2CB5;"></i> Agenda Sesi Konsultasi</h5>
        <div class="btn-group border rounded-3 p-1 bg-light" id="schedule-period-filter">
            <button type="button" class="btn btn-sm btn-white active shadow-sm fw-semibold" onclick="filterSchedulePeriod('day', this)">Hari</button>
            <button type="button" class="btn btn-sm text-secondary fw-semibold" onclick="filterSchedulePeriod('week', this)">Minggu</button>
            <button type="button" class="btn btn-sm text-secondary fw-semibold" onclick="filterSchedulePeriod('month', this)">Bulan</button>
        </div>
    </div>

    <div class="d-flex flex-column gap-3" id="schedule-list-container">
        @forelse($sessions as $session)
            <div class="p-3 rounded-4 border d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 schedule-card-item" data-date="{{ $session->booking_date }}" style="background-color: #F8FAFC; border-left: 5px solid {{ $session->status === 'cancelled' ? '#EF4444' : ($session->status === 'accepted' ? '#0D9488' : '#3B82F6') }} !important;">
                <div class="d-flex align-items-center gap-3">
                    <span class="badge px-3 py-2 fw-bold text-nowrap" style="background-color: {{ $session->status === 'cancelled' ? '#FEE2E2' : '#F3E8FF' }}; color: {{ $session->status === 'cancelled' ? '#EF4444' : '#5E2CB5' }};">
                        {{ $session->booking_time }}
                    </span>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">{{ $session->patient_name }}</h6>
                        <span class="text-muted small d-block">
                            {{ $session->booking_date }} &bull; {{ $session->session_type }} &bull; 
                            @if($session->status === 'cancelled')
                                <span class="text-danger fw-bold">Dibatalkan</span>
                            @elseif($session->status === 'completed')
                                <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i>Selesai</span>
                            @elseif($session->payment_status === 'paid' || $session->status === 'accepted')
                                <span class="text-success fw-semibold">Terkonfirmasi & Lunas</span>
                            @else
                                <span class="text-warning fw-semibold">Menunggu Pembayaran</span>
                            @endif
                        </span>
                        @if($session->notes)
                            <div class="text-secondary extra-small italic mt-1">Keluhan: "{{ $session->notes }}"</div>
                        @endif
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    @if($session->status === 'cancelled')
                        <button type="button" class="btn btn-light text-muted border btn-sm px-3 py-2 fw-bold rounded-3 d-inline-flex align-items-center justify-content-center text-nowrap" style="height: 36px; cursor: not-allowed;" disabled>
                            Sesi Dibatalkan
                        </button>
                    @elseif($session->status === 'completed')
                        <button type="button" class="btn btn-light text-success border btn-sm px-3 py-2 fw-bold rounded-3 d-inline-flex align-items-center justify-content-center text-nowrap" style="height: 36px; cursor: not-allowed;" disabled>
                            <i class="bi bi-check-circle-fill me-1"></i> Sesi Selesai
                        </button>
                    @else
                        <button type="button" class="btn text-white btn-sm px-3 py-2 fw-bold rounded-3 d-inline-flex align-items-center justify-content-center text-nowrap" style="background-color: #5E2CB5; height: 36px;" data-bs-toggle="modal" data-bs-target="#sessionDetailModal">
                            Detail Sesi
                        </button>
                        <form action="{{ route('booking.cancel', $session->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan sesi ini?')" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="btn btn-light text-danger border btn-sm px-3 py-2 fw-bold rounded-3 d-inline-flex align-items-center justify-content-center text-nowrap" style="height: 36px;">
                                <i class="bi bi-x-circle me-1"></i> Batalkan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-muted small py-4 text-center">
                Belum ada jadwal sesi konsultasi yang terdaftar.
            </div>
        @endforelse
    </div>
</div>

<!-- Modal 1: Tambah Slot Jadwal -->
<div class="modal fade" id="addSlotModal" tabindex="-1" aria-labelledby="addSlotModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="addSlotModalLabel"><i class="bi bi-calendar-plus me-2 text-purple" style="color: #5E2CB5;"></i> Tambah Slot Waktu Praktik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <form onsubmit="event.preventDefault(); alert('Slot waktu praktik baru berhasil ditambahkan ke jadwal!'); bootstrap.Modal.getInstance(document.getElementById('addSlotModal')).hide();">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Tanggal Praktik</label>
                        <input type="date" class="form-control rounded-3" value="{{ now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Jam Mulai</label>
                            <input type="time" class="form-control rounded-3" value="09:00" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Jam Selesai</label>
                            <input type="time" class="form-control rounded-3" value="10:00" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Mode Konsultasi</label>
                        <select class="form-select rounded-3">
                            <option>Sesi Online Video Call (QRIS)</option>
                            <option>Konsultasi Tatap Muka (In-Person)</option>
                            <option>Sesi Chat WhatsApp</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light border fw-semibold rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white fw-bold rounded-3" style="background-color: #5E2CB5;">Simpan Slot</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal 2: Detail Sesi Sesi Konsultasi -->
<div class="modal fade" id="sessionDetailModal" tabindex="-1" aria-labelledby="sessionDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="sessionDetailModalLabel"><i class="bi bi-clock-history me-2 text-purple" style="color: #5E2CB5;"></i> Detail Sesi Konsultasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="bg-light p-3 rounded-4 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=150&auto=format&fit=crop&q=80" alt="David Chen" class="rounded-circle object-fit-cover" style="width: 52px; height: 52px;">
                        <div>
                            <h6 class="fw-bold text-dark mb-0">David Chen</h6>
                            <div class="text-muted small">Konsultasi Tatap Muka (Ruang B)</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 text-secondary small">
                    <div class="d-flex justify-content-between">
                        <span>Waktu Konsultasi:</span>
                        <strong class="text-dark">Hari Ini, 11:00 - 12:00 WIB</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Status Pembayaran:</span>
                        <span class="badge bg-success-subtle text-success fw-bold">Lunas (QRIS)</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Tarif Sesi:</span>
                        <strong class="text-dark">Rp 350.000</strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn text-white fw-bold w-100 py-2 rounded-3" style="background-color: #5E2CB5;" data-bs-dismiss="modal">Tutup Detail</button>
            </div>
        </div>
    </div>
</div>

<script>
    function filterSchedulePeriod(period, btn) {
        const buttons = document.querySelectorAll('#schedule-period-filter button');
        buttons.forEach(b => {
            b.classList.remove('btn-white', 'active', 'shadow-sm');
            b.classList.add('text-secondary');
        });
        btn.classList.add('btn-white', 'active', 'shadow-sm');
        btn.classList.remove('text-secondary');

        const items = document.querySelectorAll('.schedule-card-item');
        const todayStr = new Date().toISOString().split('T')[0];

        items.forEach((item, index) => {
            const itemDate = item.getAttribute('data-date');
            if (period === 'day') {
                if (itemDate === todayStr || index === 0) {
                    item.style.setProperty('display', 'flex', 'important');
                } else {
                    item.style.setProperty('display', 'none', 'important');
                }
            } else if (period === 'week') {
                if (index < 4) {
                    item.style.setProperty('display', 'flex', 'important');
                } else {
                    item.style.setProperty('display', 'none', 'important');
                }
            } else {
                item.style.setProperty('display', 'flex', 'important');
            }
        });
    }
</script>
@endsection
