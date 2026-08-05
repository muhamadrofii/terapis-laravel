@extends('layouts.therapist')

@section('title', 'Daftar Pasien - Terapis Online')

@section('content')
<!-- Patient Roster Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Daftar Pasien Aktif</h1>
        <p class="text-secondary mb-0">Kelola dan lihat rekam medis untuk {{ $activeCount ?? count($patients) }} pasien terdaftar Anda di database.</p>
    </div>
    <button type="button" data-bs-toggle="modal" data-bs-target="#addPatientModal" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;">
        <i class="bi bi-person-plus-fill"></i> Tambah Pasien Baru
    </button>
</div>

<!-- Search & Filter Bar -->
<div class="bg-white p-3 rounded-4 border shadow-sm mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <div class="input-group bg-light rounded-3 max-w-md">
        <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
        <input type="text" id="patientSearchInput" onkeyup="filterPatientCards()" class="form-control bg-transparent border-0 small" placeholder="Cari pasien berdasarkan nama atau ID...">
    </div>

    <div class="d-flex align-items-center gap-2">
        <div class="btn-group border rounded-3 p-1 bg-light">
            <button type="button" id="btnFilterActive" onclick="togglePatientTab('active')" class="btn btn-sm btn-white active shadow-sm fw-semibold">Aktif ({{ $activeCount ?? count($patients) }})</button>
            <button type="button" id="btnFilterArchived" onclick="togglePatientTab('archived')" class="btn btn-sm text-secondary fw-semibold">Arsip ({{ $archivedCount ?? 0 }})</button>
        </div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#moreFiltersModal" class="btn btn-light text-secondary border fw-semibold rounded-3 btn-sm px-3 py-2"><i class="bi bi-funnel me-1"></i> Filter Lainnya</button>
    </div>
</div>

<!-- Patient Cards Grid -->
<div class="row g-3 mb-4" id="patientCardsGrid">
    <!-- Card 1 (Active) -->
    <div class="col-md-6 col-xl-4 patient-card-item" data-name="Sarah Jenkins" data-id="PT-2049" data-status="active">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80" alt="Sarah Jenkins" class="rounded-circle object-fit-cover" style="width: 52px; height: 52px;">
                        <div>
                            <h6 class="fw-bold text-dark mb-0 patient-name">Sarah Jenkins</h6>
                            <span class="text-muted small patient-id" style="font-size: 0.78rem;">ID: PT-2049</span>
                        </div>
                    </div>
                    <span class="badge bg-success-subtle text-success px-2 py-1 small fw-bold">AKTIF</span>
                </div>

                <div class="d-flex flex-column gap-1 small text-secondary mb-3" style="font-size: 0.85rem;">
                    <div><i class="bi bi-envelope me-2"></i> sarah.j@example.com</div>
                    <div><i class="bi bi-calendar-event me-2"></i> Sesi Terakhir: 12 Okt 2024</div>
                    <div><i class="bi bi-journal-text me-2"></i> Pengelolaan Kecemasan</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="https://wa.me/6281234567890?text=Halo%20Sarah,%20saya%20terapis%20Anda%20siap%20memulai%20sesi%20konsultasi%20online." target="_blank" class="btn btn-success fw-bold btn-sm py-2 px-3 rounded-3 me-2" title="Mulai Konsultasi via WhatsApp">
                    <i class="bi bi-whatsapp me-1"></i> Mulai Konsultasi
                </a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#patientRecordModal1" class="btn btn-light text-purple fw-semibold btn-sm py-2 rounded-3" style="background-color: #F3E8FF; color: #5E2CB5;"><i class="bi bi-folder2-open me-1"></i> Rekam Medis</button>
            </div>
        </div>
    </div>

    <!-- Card 2 (Active) -->
    <div class="col-md-6 col-xl-4 patient-card-item" data-name="Marcus Reed" data-id="PT-1892" data-status="active">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle text-purple fw-bold d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; background-color: #F3E8FF; color: #5E2CB5; font-size: 1rem;">
                            MR
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0 patient-name">Marcus Reed</h6>
                            <span class="text-muted small patient-id" style="font-size: 0.78rem;">ID: PT-1892</span>
                        </div>
                    </div>
                    <span class="badge bg-success-subtle text-success px-2 py-1 small fw-bold">AKTIF</span>
                </div>

                <div class="d-flex flex-column gap-1 small text-secondary mb-3" style="font-size: 0.85rem;">
                    <div><i class="bi bi-envelope me-2"></i> m.reed88@example.com</div>
                    <div><i class="bi bi-calendar-event me-2"></i> Sesi Terakhir: 10 Okt 2024</div>
                    <div><i class="bi bi-journal-text me-2"></i> Terapi CBT Bertahap</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <button type="button" data-bs-toggle="modal" data-bs-target="#patientRecordModal2" class="btn btn-light text-purple fw-semibold btn-sm w-100 py-2 rounded-3 me-2" style="background-color: #F3E8FF; color: #5E2CB5;"><i class="bi bi-folder2-open me-1"></i> Rekam Medis</button>
                <button class="btn btn-light text-secondary border-0"><i class="bi bi-three-dots-vertical"></i></button>
            </div>
        </div>
    </div>

    <!-- Card 3 (Active / Review) -->
    <div class="col-md-6 col-xl-4 patient-card-item" data-name="David Chen" data-id="PT-3105" data-status="active">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between" style="border-color: #FECDD3 !important;">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=150&auto=format&fit=crop&q=80" alt="David Chen" class="rounded-circle object-fit-cover" style="width: 52px; height: 52px;">
                        <div>
                            <h6 class="fw-bold text-dark mb-0 patient-name">David Chen</h6>
                            <span class="text-muted small patient-id" style="font-size: 0.78rem;">ID: PT-3105</span>
                        </div>
                    </div>
                    <span class="badge bg-danger-subtle text-danger px-2 py-1 small fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> EVALUASI</span>
                </div>

                <div class="d-flex flex-column gap-1 small text-secondary mb-3" style="font-size: 0.85rem;">
                    <div><i class="bi bi-envelope me-2"></i> david.chen.w@example.com</div>
                    <div><i class="bi bi-calendar-event me-2 text-danger"></i> Absen Sesi: 14 Okt 2024</div>
                    <div><i class="bi bi-journal-text me-2"></i> Konsultasi Depresi</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="https://wa.me/6281234567891" target="_blank" class="btn text-white fw-semibold btn-sm w-100 py-2 rounded-3 me-2" style="background-color: #5E2CB5;"><i class="bi bi-chat-dots-fill me-1"></i> Kontak WA</a>
                <button class="btn btn-light text-secondary border-0"><i class="bi bi-three-dots-vertical"></i></button>
            </div>
        </div>
    </div>

    <!-- Card 4 (Archived Sample Card) -->
    <div class="col-md-6 col-xl-4 patient-card-item d-none" data-name="Linda Parker" data-id="PT-1102" data-status="archived">
        <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between opacity-75">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle text-secondary fw-bold d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; background-color: #F1F5F9; font-size: 1rem;">
                            LP
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0 patient-name">Linda Parker</h6>
                            <span class="text-muted small patient-id" style="font-size: 0.78rem;">ID: PT-1102</span>
                        </div>
                    </div>
                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1 small fw-bold">ARSIP</span>
                </div>

                <div class="d-flex flex-column gap-1 small text-secondary mb-3" style="font-size: 0.85rem;">
                    <div><i class="bi bi-envelope me-2"></i> linda.p@example.com</div>
                    <div><i class="bi bi-calendar-event me-2"></i> Sesi Selesai: Jan 2024</div>
                    <div><i class="bi bi-journal-text me-2"></i> Konseling Traumatik</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <button type="button" onclick="alert('Pasien Linda Parker berada dalam arsip sejarah konsultasi.')" class="btn btn-light text-secondary border fw-semibold btn-sm w-100 py-2 rounded-3 me-2"><i class="bi bi-archive me-1"></i> Buka Arsip</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 1: Tambah Pasien Baru -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="addPatientModalLabel"><i class="bi bi-person-plus-fill me-2 text-purple" style="color: #5E2CB5;"></i> Pendaftaran Pasien Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <form onsubmit="event.preventDefault(); alert('Pasien baru berhasil didaftarkan ke sistem!'); bootstrap.Modal.getInstance(document.getElementById('addPatientModal')).hide();">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Lengkap Pasien</label>
                        <input type="text" class="form-control rounded-3" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Alamat Email</label>
                        <input type="email" class="form-control rounded-3" placeholder="budi@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nomor WhatsApp Pasien</label>
                        <input type="text" class="form-control rounded-3" placeholder="+62 812-3456-7890" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Kategori Keluhan Utama</label>
                        <select class="form-select rounded-3">
                            <option>Pengelolaan Kecemasan (Anxiety)</option>
                            <option>Depresi & Stres Berat</option>
                            <option>Konseling Keluarga / Pasangan</option>
                            <option>Trauma Masa Lalu</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light border fw-semibold rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white fw-bold rounded-3" style="background-color: #5E2CB5;">Daftarkan Pasien</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal 2: Filter Lainnya Modal -->
<div class="modal fade" id="moreFiltersModal" tabindex="-1" aria-labelledby="moreFiltersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="moreFiltersModalLabel"><i class="bi bi-funnel-fill me-2 text-purple" style="color: #5E2CB5;"></i> Filter Lanjutan Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <form onsubmit="event.preventDefault(); applyAdvancedFilter(); bootstrap.Modal.getInstance(document.getElementById('moreFiltersModal')).hide();">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Kategori Kasus</label>
                        <select class="form-select rounded-3" id="filterCategory">
                            <option value="">Semua Kategori Kasus</option>
                            <option value="Anxiety">Pengelolaan Kecemasan (Anxiety)</option>
                            <option value="CBT">Terapi Perilaku Kognitif (CBT)</option>
                            <option value="Depresi">Konsultasi Depresi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Urutan Pasien</label>
                        <select class="form-select rounded-3">
                            <option>Sesi Terbaru Pertama</option>
                            <option>Nama Pasien A-Z</option>
                            <option>ID Pasien Tertua</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light border fw-semibold rounded-3" data-bs-dismiss="modal">Reset</button>
                        <button type="submit" class="btn text-white fw-bold rounded-3" style="background-color: #5E2CB5;">Terapkan Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal 3: Rekam Medis Pasien 1 (Sarah Jenkins) -->
<div class="modal fade" id="patientRecordModal1" tabindex="-1" aria-labelledby="patientRecordModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="patientRecordModal1Label"><i class="bi bi-folder2-open me-2 text-purple" style="color: #5E2CB5;"></i> Rekam Medis: Sarah Jenkins (PT-2049)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <span class="text-muted small d-block">Total Sesi</span>
                            <span class="fs-4 fw-extrabold text-purple" style="color: #5E2CB5;">5 Sesi</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <span class="text-muted small d-block">Status Kemajuan</span>
                            <span class="badge bg-success-subtle text-success mt-1 fw-bold">Membaik (+35%)</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <span class="text-muted small d-block">Diagnosa Utama</span>
                            <span class="fw-bold text-dark small">Generalized Anxiety</span>
                        </div>
                    </div>
                </div>
                <h6 class="fw-bold text-dark mb-2">Catatan Klinis Terapis:</h6>
                <p class="text-secondary small bg-light p-3 rounded-3" style="line-height: 1.6;">
                    Pasien menunjukkan penurunan skor kecemasan yang signifikan setelah 5 sesi Cognitive Behavioral Therapy (CBT). Teknik breathing exercise yang diajarkan rutin dilakukan setiap pagi. Sesi selanjutnya difokuskan pada pengelolaan kecemasan di lingkungan kerja.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-purple-primary w-100" data-bs-dismiss="modal">Tutup Rekam Medis</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 4: Rekam Medis Pasien 2 (Marcus Reed) -->
<div class="modal fade" id="patientRecordModal2" tabindex="-1" aria-labelledby="patientRecordModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="patientRecordModal2Label"><i class="bi bi-folder2-open me-2 text-purple" style="color: #5E2CB5;"></i> Rekam Medis: Marcus Reed (PT-1892)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <span class="text-muted small d-block">Total Sesi</span>
                            <span class="fs-4 fw-extrabold text-purple" style="color: #5E2CB5;">3 Sesi</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <span class="text-muted small d-block">Status Kemajuan</span>
                            <span class="badge bg-info-subtle text-info mt-1 fw-bold">Stabil</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <span class="text-muted small d-block">Diagnosa Utama</span>
                            <span class="fw-bold text-dark small">Workplace Burnout</span>
                        </div>
                    </div>
                </div>
                <h6 class="fw-bold text-dark mb-2">Catatan Klinis Terapis:</h6>
                <p class="text-secondary small bg-light p-3 rounded-3" style="line-height: 1.6;">
                    Pasien Marcus Reed dalam tahap evaluasi kelelahan kerja (burnout). Responsif terhadap latihan regulasi emosi dan reframing pola pikir. Sesi lanjutan dijadwalkan minggu depan.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-purple-primary w-100" data-bs-dismiss="modal">Tutup Rekam Medis</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentTab = 'active';

function filterPatientCards() {
    const query = document.getElementById('patientSearchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.patient-card-item');

    cards.forEach(card => {
        const name = card.getAttribute('data-name').toLowerCase();
        const id = card.getAttribute('data-id').toLowerCase();
        const status = card.getAttribute('data-status');

        const matchesQuery = name.includes(query) || id.includes(query);
        const matchesStatus = (status === currentTab);

        if (matchesQuery && matchesStatus) {
            card.classList.remove('d-none');
        } else {
            card.classList.add('d-none');
        }
    });
}

function togglePatientTab(tabName) {
    currentTab = tabName;

    const btnActive = document.getElementById('btnFilterActive');
    const btnArchived = document.getElementById('btnFilterArchived');

    if (tabName === 'active') {
        btnActive.classList.add('btn-white', 'active', 'shadow-sm');
        btnActive.classList.remove('text-secondary');
        btnArchived.classList.remove('btn-white', 'active', 'shadow-sm');
        btnArchived.classList.add('text-secondary');
    } else {
        btnArchived.classList.add('btn-white', 'active', 'shadow-sm');
        btnArchived.classList.remove('text-secondary');
        btnActive.classList.remove('btn-white', 'active', 'shadow-sm');
        btnActive.classList.add('text-secondary');
    }

    filterPatientCards();
}

function applyAdvancedFilter() {
    alert('Filter lanjutan berhasil diterapkan!');
    filterPatientCards();
}
</script>
@endsection
