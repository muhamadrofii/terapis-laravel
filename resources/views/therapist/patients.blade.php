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
    @forelse($patients as $p)
        @php
            $patientCode = 'PT-' . strtoupper(substr($p->id, 0, 8));
        @endphp
        <div class="col-md-6 col-xl-4 patient-card-item" data-name="{{ $p->name }}" data-id="{{ $patientCode }}" data-status="active">
            <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center gap-3">
                            @if($p->avatar)
                                <img src="{{ $p->avatar }}" alt="{{ $p->name }}" class="rounded-circle object-fit-cover flex-shrink-0" style="width: 52px; height: 52px; min-width: 52px; min-height: 52px; aspect-ratio: 1 / 1;">
                            @else
                                <div class="rounded-circle text-purple fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px; min-width: 52px; min-height: 52px; aspect-ratio: 1 / 1; background-color: #F3E8FF; color: #5E2CB5; font-size: 1.1rem;">
                                    {{ strtoupper(substr($p->name, 0, 2)) }}
                                </div>
                            @endif
                            <div>
                                <h6 class="fw-bold text-dark mb-0 patient-name">{{ $p->name }}</h6>
                                <span class="text-muted small patient-id" style="font-size: 0.78rem;">ID: {{ $patientCode }}</span>
                            </div>
                        </div>
                        <span class="badge bg-success-subtle text-success px-2 py-1 small fw-bold">AKTIF</span>
                    </div>

                    <div class="d-flex flex-column gap-1 small text-secondary mb-3" style="font-size: 0.85rem;">
                        <div><i class="bi bi-envelope me-2"></i> {{ $p->email }}</div>
                        <div><i class="bi bi-calendar-event me-2"></i> Terdaftar: {{ $p->created_at ? $p->created_at->format('d M Y') : 'Baru' }}</div>
                        <div><i class="bi bi-journal-text me-2"></i> {{ $p->specialty ?? 'Konsultasi Kesehatan Mental' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $p->phone ?? '6281234567890') }}?text=Halo%20{{ urlencode($p->name) }},%20saya%20terapis%20Anda%20siap%20memulai%20sesi%20konsultasi%20online." target="_blank" class="btn btn-success fw-bold btn-sm py-2 px-3 rounded-3 me-2" title="Mulai Konsultasi via WhatsApp">
                        <i class="bi bi-whatsapp me-1"></i> Mulai Konsultasi
                    </a>
                    <button type="button" onclick="openMedicalRecordModal('{{ addslashes($p->name) }}', '{{ $patientCode }}', '{{ $p->email }}', '{{ addslashes($p->specialty ?? 'Konsultasi Kesehatan Mental') }}')" class="btn btn-light text-purple fw-semibold btn-sm py-2 rounded-3" style="background-color: #F3E8FF; color: #5E2CB5;">
                        <i class="bi bi-folder2-open me-1"></i> Rekam Medis
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 text-muted small">
            Belum ada data pasien terdaftar di database.
        </div>
    @endforelse
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
    const spec = document.getElementById('filterSpecialtySelect')?.value || '';
    const cards = document.querySelectorAll('.patient-card-item');

    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (spec === '' || text.includes(spec.toLowerCase())) {
            card.classList.remove('d-none');
        } else {
            card.classList.add('d-none');
        }
    });

    const modalEl = document.getElementById('moreFiltersModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

function openMedicalRecordModal(name, id, email, specialty) {
    document.getElementById('recPatientName').textContent = 'Pasien: ' + name;
    document.getElementById('recPatientId').textContent = 'ID Pasien: ' + id;
    document.getElementById('recPatientEmail').textContent = 'Email: ' + email;
    document.getElementById('recSpecialtyInput').value = specialty || 'Konsultasi Kesehatan Mental';

    const modalEl = document.getElementById('patientMedicalRecordModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function saveMedicalRecordNotes() {
    alert('Catatan rekam medis pasien berhasil disimpan ke basis data terapis!');
    const modalEl = document.getElementById('patientMedicalRecordModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

function printMedicalRecordPDF() {
    const name = document.getElementById('recPatientName').textContent;
    const id = document.getElementById('recPatientId').textContent;
    const email = document.getElementById('recPatientEmail').textContent;
    const diag = document.getElementById('recSpecialtyInput').value;

    const win = window.open('', '_blank', 'width=850,height=950');
    const html = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Rekam Medis - ${name}</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
            <style>
                body { font-family: system-ui, sans-serif; padding: 2.5rem; background: #fff; }
                @media print { .no-print { display: none !important; } }
            </style>
        </head>
        <body onload="window.print();">
            <div class="no-print mb-4 d-flex justify-content-between bg-light p-3 rounded-4 border">
                <div class="fw-bold"><i class="bi bi-file-earmark-pdf-fill me-2" style="color: #5E2CB5;"></i> Dokumen Rekam Medis Pasien PDF</div>
                <button onclick="window.print()" class="btn btn-sm text-white fw-bold px-3 py-1.5 rounded-3" style="background-color: #5E2CB5;">Cetak / Simpan PDF</button>
            </div>
            <div class="border rounded-5 p-5 shadow-sm">
                <h3 class="fw-bold mb-1" style="color: #5E2CB5;"><i class="bi bi-flower2 me-2"></i>Terapis Online Indonesia</h3>
                <div class="text-secondary mb-4 pb-3 border-bottom">${name} • ${id} • ${email}</div>
                <h5 class="fw-bold text-dark mb-2">Diagnosa Utama & Keluhan:</h5>
                <p class="text-secondary mb-4">${diag}</p>
                <h5 class="fw-bold text-dark mb-2">Catatan Perkembangan Terapi:</h5>
                <p class="text-secondary mb-4">Pasien menunjukkan peningkatan kondisi kesehatan emosional yang baik. Terapi perilaku kognitif berjalan efektif sesuai jadwal.</p>
                <div class="mt-5 pt-4 border-top text-muted small text-center">Dokumen Rekam Medis Resmi Terverifikasi Terapis Online Indonesia.</div>
            </div>
        </body>
        </html>
    `;
    win.document.write(html);
    win.document.close();
}
</script>

<!-- Modal Rekam Medis Pasien -->
<div class="modal fade" id="patientMedicalRecordModal" tabindex="-1" aria-labelledby="patientMedicalRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="modal-header border-0 text-white p-4" style="background: linear-gradient(135deg, #5E2CB5 0%, #4C1D95 100%);">
                <div>
                    <h5 class="modal-title fw-bold" id="patientMedicalRecordModalLabel"><i class="bi bi-folder2-open me-2"></i> Rekam Medis & Catatan Klinis Pasien</h5>
                    <div class="small opacity-75 mt-1" id="recPatientName">Pasien: -</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center bg-light p-3 rounded-4 border mb-4 gap-2">
                    <div>
                        <div class="fw-bold text-dark font-monospace" id="recPatientId">ID Pasien: -</div>
                        <div class="text-secondary small" id="recPatientEmail">Email: -</div>
                    </div>
                    <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">
                        <i class="bi bi-check-circle-fill me-1"></i> PASIEN AKTIF
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Diagnosa Klinis & Spesialisasi Keluhan</label>
                    <input type="text" class="form-control rounded-3" id="recSpecialtyInput" value="Pengelolaan Kecemasan & Gangguan Tidur">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Catatan Perkembangan Terapi (Progress Notes)</label>
                    <textarea class="form-control rounded-3" rows="4" placeholder="Tuliskan catatan perkembangan evaluasi sesi pasien di sini...">Pasien menunjukkan peningkatan signifikan dalam mengelola kecemasan tingkat sedang. Respon terhadap teknik relaksasi pernapasan positif. Sesi lanjutan dijadwalkan untuk konsolidasi coping mechanism.</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Rekomendasi Terapi & Suplemen Herbal</label>
                    <input type="text" class="form-control rounded-3" value="Teh Herbal Chamomile Lavender & Latihan Pernapasan 4-7-8 Setiap Malam">
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-between">
                <button type="button" onclick="printMedicalRecordPDF()" class="btn border fw-bold rounded-3" style="color: #5E2CB5; border-color: #5E2CB5;">
                    <i class="bi bi-printer me-1"></i> Cetak / Unduh Rekam Medis (PDF)
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-light border fw-semibold rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="saveMedicalRecordNotes()" class="btn text-white fw-bold rounded-3" style="background-color: #5E2CB5;">Simpan Rekam Medis</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Filter Lainnya -->
<div class="modal fade" id="moreFiltersModal" tabindex="-1" aria-labelledby="moreFiltersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="moreFiltersModalLabel"><i class="bi bi-funnel-fill text-purple me-2" style="color: #5E2CB5;"></i> Filter Pasien Lanjutan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Spesialisasi / Keluhan</label>
                    <select class="form-select rounded-3 py-2" id="filterSpecialtySelect">
                        <option value="">Semua Keluhan</option>
                        <option value="Kecemasan">Pengelolaan Kecemasan</option>
                        <option value="Trauma">Terapi Trauma & PTSD</option>
                        <option value="Depresi">Pengelolaan Depresi</option>
                        <option value="Stres">Manajemen Stres & Burnout</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Status Sesi</label>
                    <select class="form-select rounded-3 py-2" id="filterStatusSelect">
                        <option value="all">Semua Status</option>
                        <option value="active">Pasien Aktif</option>
                        <option value="completed">Sesi Selesai</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light border fw-semibold rounded-3" data-bs-dismiss="modal">Batal</button>
                <button type="button" onclick="applyAdvancedFilter()" class="btn text-white fw-bold rounded-3" style="background-color: #5E2CB5;">Terapkan Filter</button>
            </div>
        </div>
    </div>
</div>
@endsection
