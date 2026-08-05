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
        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-calendar3 me-2 text-purple" style="color: #5E2CB5;"></i> Oktober 2024</h5>
        <div class="btn-group border rounded-3 p-1 bg-light">
            <button class="btn btn-sm btn-white active shadow-sm fw-semibold">Hari</button>
            <button class="btn btn-sm text-secondary fw-semibold">Minggu</button>
            <button class="btn btn-sm text-secondary fw-semibold">Bulan</button>
        </div>
    </div>

    <div class="d-flex flex-column gap-3">
        <!-- Time slot 1 -->
        <div class="p-3 rounded-4 border d-flex justify-content-between align-items-center" style="background-color: #F8FAFC; border-left: 5px solid #0D9488 !important;">
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-teal-subtle text-teal px-3 py-2 fw-bold" style="background-color: #CCFBF1; color: #0D9488;">09:00 WIB</span>
                <div>
                    <h6 class="fw-bold text-dark mb-0">Sarah Jenkins</h6>
                    <span class="text-muted small">Terapi Perilaku Kognitif (Sesi Video Call)</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="https://wa.me/6281234567890?text=Halo%20Sarah,%20saya%20terapis%20Anda%20siap%20memulai%20sesi%20konsultasi%20online." target="_blank" class="btn btn-success btn-sm px-3 py-2 fw-bold rounded-3 shadow-sm d-flex align-items-center gap-1">
                    <i class="bi bi-whatsapp"></i> Mulai Konsultasi
                </a>
            </div>
        </div>

        <!-- Time slot 2 -->
        <div class="p-3 rounded-4 border d-flex justify-content-between align-items-center" style="background-color: #F8FAFC; border-left: 5px solid #5E2CB5 !important;">
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-purple-subtle text-purple px-3 py-2 fw-bold" style="background-color: #F3E8FF; color: #5E2CB5;">11:00 WIB</span>
                <div>
                    <h6 class="fw-bold text-dark mb-0">David Chen</h6>
                    <span class="text-muted small">Konsultasi Tatap Muka (Ruang B)</span>
                </div>
            </div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#sessionDetailModal" class="btn btn-light text-secondary border btn-sm px-3 py-2 fw-semibold rounded-3">Lihat Detail</button>
        </div>

        <!-- Time slot 3 -->
        <div class="p-3 rounded-4 border d-flex justify-content-between align-items-center" style="background-color: #F8FAFC; border-left: 5px solid #64748B !important;">
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-secondary-subtle text-secondary px-3 py-2 fw-bold">14:30 WIB</span>
                <div>
                    <h6 class="fw-semibold text-muted mb-0">Istirahat Makan Siang & Administrasi</h6>
                </div>
            </div>
            <span class="badge bg-light text-secondary border">Terjadwal</span>
        </div>
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
                <button type="button" class="btn btn-purple-primary w-100" data-bs-dismiss="modal">Tutup Detail</button>
            </div>
        </div>
    </div>
</div>
@endsection
