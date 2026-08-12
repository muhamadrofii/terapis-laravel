@extends('layouts.app')

@section('title', 'Pencarian Terapis & Klinik - Terapis Online')

@section('content')
<!-- Leaflet Map CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="py-4 bg-light min-vh-100">
    <div class="container">
        
        <!-- Search Mode Switcher (Tab Group) -->
        <div class="d-flex justify-content-center mb-4">
            <div class="bg-white p-1.5 border rounded-pill shadow-sm d-inline-flex gap-2" style="padding: 6px !important; border-radius: 50px !important;">
                <button type="button" class="btn rounded-pill px-4 py-2 fw-bold text-white shadow-sm" id="tab-therapists" onclick="toggleSearchMode('therapists')" style="background-color: #5E2CB5; transition: all 0.2s; border-radius: 50px !important;">
                    <i class="bi bi-laptop me-1"></i> Konsultasi Online (Terapis)
                </button>
                <button type="button" class="btn rounded-pill px-4 py-2 fw-bold text-secondary" id="tab-clinics" onclick="toggleSearchMode('clinics')" style="transition: all 0.2s; background: none; border: none; border-radius: 50px !important;">
                    <i class="bi bi-geo-alt-fill me-1"></i> Cari Klinik Terdekat (Map)
                </button>
            </div>
        </div>

        <!-- ONLINE THERAPISTS SECTION -->
        <div id="therapists-view">
            <!-- Filter Bar Top Tags (Dynamic Pills) -->
            <div class="d-flex flex-wrap align-items-center gap-2 mb-4" id="therapist-pills">
                @php
                    $categories = [
                        'Semua' => 'Semua Spesialisasi',
                        'Kecemasan' => 'Kecemasan',
                        'Depresi' => 'Depresi',
                        'Keluarga' => 'Keluarga',
                        'Hubungan' => 'Hubungan',
                        'Trauma' => 'Trauma',
                    ];
                @endphp

                @foreach($categories as $key => $label)
                    <button type="button" 
                       onclick="selectTopCategory('{{ $key }}', this)"
                       class="top-category-pill btn px-3 py-2 fw-semibold transition-all bg-white text-secondary border" 
                       data-category="{{ $key }}"
                       style="border-radius: 50px; font-size: 0.85rem;">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="row g-4" id="therapists-container">
                <!-- Left Sidebar Filters -->
                <div class="col-lg-3">
                    <div class="bg-white p-4 rounded-4 border shadow-sm sticky-top" style="top: 90px; border-radius: 20px;">
                        <h5 class="fw-bold text-dark mb-3">Filter Pencarian</h5>

                        <!-- Live Search Input -->
                        <div class="mb-4">
                            <div class="input-group bg-light rounded-3">
                                <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" id="therapistSearchInput" onkeyup="filterTherapistCards()" class="form-control bg-transparent border-0 small" placeholder="Cari nama terapis..." value="{{ request('q') }}">
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-dark d-block mb-2">Rentang Tarif (Rp)</label>
                            <div class="form-check mb-1">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="all" id="priceAll" checked onchange="onPriceAllToggle()">
                                <label class="form-check-label small text-secondary" for="priceAll">Semua Tarif</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="low" id="price1" onchange="onPriceOptionToggle()">
                                <label class="form-check-label small text-secondary" for="price1">Di bawah Rp 300rb</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="mid" id="price2" onchange="onPriceOptionToggle()">
                                <label class="form-check-label small text-secondary" for="price2">Rp 300rb - Rp 400rb</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="high" id="price3" onchange="onPriceOptionToggle()">
                                <label class="form-check-label small text-secondary" for="price3">Di atas Rp 400rb</label>
                            </div>
                        </div>

                        <hr>

                        <!-- Specialties Checkboxes -->
                        <div class="mb-2">
                            <label class="form-label fw-bold small text-dark d-block mb-2">Spesialisasi Populer</label>
                            <div class="form-check mb-1">
                                <input class="form-check-input spec-checkbox" type="checkbox" value="Kecemasan" id="spec1" onchange="syncTopPills(); filterTherapistCards();">
                                <label class="form-check-label small text-secondary" for="spec1">Kecemasan (Anxiety)</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input spec-checkbox" type="checkbox" value="Depresi" id="spec2" onchange="syncTopPills(); filterTherapistCards();">
                                <label class="form-check-label small text-secondary" for="spec2">Depresi</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input spec-checkbox" type="checkbox" value="Keluarga" id="spec3" onchange="syncTopPills(); filterTherapistCards();">
                                <label class="form-check-label small text-secondary" for="spec3">Konseling Keluarga</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input spec-checkbox" type="checkbox" value="Hubungan" id="spec4" onchange="syncTopPills(); filterTherapistCards();">
                                <label class="form-check-label small text-secondary" for="spec4">Hubungan (Relationship)</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input spec-checkbox" type="checkbox" value="Trauma" id="spec5" onchange="syncTopPills(); filterTherapistCards();">
                                <label class="form-check-label small text-secondary" for="spec5">Trauma & PTSD</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column Results -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fw-bold text-dark mb-0" style="font-size: 1.75rem;">
                            Ditemukan <span id="therapistResultCount">{{ count($therapists) }}</span> Terapis Terdaftar
                        </h3>
                        <span class="text-muted small">Urutkan: <strong class="text-dark">Rekomendasi Terbaik</strong></span>
                    </div>

                    <!-- Therapist Cards Grid -->
                    <div class="row g-3 mb-4" id="therapistsGrid">
                        @forelse($therapists as $index => $t)
                            <div class="col-md-4 therapist-card-item" 
                                 data-name="{{ strtolower($t->name) }}" 
                                 data-specialty="{{ strtolower($t->specialty ?? '') }}"
                                 data-price="{{ (int)preg_replace('/[^\d]/', '', $t->price ?? '350000') }}">
                                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between" style="border-radius: 20px;">
                                    <div>
                                        <img src="{{ $t->avatar ?? 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&auto=format&fit=crop&q=80' }}" alt="{{ $t->name }}" class="rounded-circle object-fit-cover mb-3" style="width: 64px; height: 64px;">
                                        <h5 class="fw-bold text-dark mb-0 text-truncate" title="{{ $t->name }}">{{ $t->name }}</h5>
                                        <div class="text-muted small mb-2 text-truncate">{{ $t->title ?? 'Psikolog / Terapis' }}</div>
                                        <div class="text-warning small fw-bold mb-3">
                                            <i class="bi bi-star-fill"></i> {{ $t->rating ?? '4.9' }} <span class="text-muted font-normal">({{ rand(80, 200) }} ulasan)</span>
                                        </div>
                                        <div class="d-flex flex-wrap gap-1 mb-3">
                                            @php
                                                $specs = explode(',', $t->specialty ?? 'Kecemasan, Depresi');
                                            @endphp
                                            @foreach(array_slice($specs, 0, 2) as $s)
                                                <span class="badge bg-purple-subtle text-purple px-2 py-1" style="background-color: #F3E8FF; color: #5E2CB5;">{{ trim($s) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                        <span class="fw-bold text-dark">{{ $t->price ?? 'Rp 350.000' }} <span class="small text-muted font-normal">/ sesi</span></span>
                                        <a href="{{ route('therapist.show', $t->id) }}" class="btn text-white btn-sm px-3 py-2 fw-semibold rounded-3" style="background-color: #5E2CB5;">Lihat Profil</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5 bg-white rounded-4 border">
                                <i class="bi bi-person-x text-muted display-4 d-block mb-3"></i>
                                <h5 class="fw-bold text-dark mb-1">Terapis Tidak Ditemukan</h5>
                                <p class="text-muted small mb-0">Coba ubah kata kunci pencarian atau spesialisasi yang Anda pilih.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- OFFLINE CLINICS MAP SECTION (Mockup Matching) -->
        <div id="clinics-view" class="d-none">
            <div class="row g-4">
                
                <!-- Left Sidebar: Search, Filter pills, and list of clinics -->
                <div class="col-lg-5">
                    <div class="bg-white p-4 rounded-4 border shadow-sm" style="border-radius: 24px; min-height: 580px;">
                        
                        <h4 class="fw-bold text-dark mb-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">Find a Clinic Near You</h4>
                        
                        <!-- Search Box with location pin icon -->
                        <div class="mb-3 position-relative">
                            <div class="input-group bg-light rounded-3 border">
                                <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" id="clinicSearch" onkeyup="filterClinics()" class="form-control bg-transparent border-0 py-2.5 small" placeholder="Enter zip code or city...">
                                <span class="input-group-text bg-transparent border-0"><i class="bi bi-crosshair text-purple" style="color: #5E2CB5; cursor: pointer;"></i></span>
                            </div>
                        </div>

                        <!-- Pill filter check buttons -->
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5 fw-medium text-dark active-pill" onclick="togglePill(this)" style="font-size: 0.8rem; border-color: #E2E8F0;">Open Now</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5 fw-medium text-dark" onclick="togglePill(this)" style="font-size: 0.8rem; border-color: #E2E8F0;">In-Network</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5 fw-medium text-dark" onclick="togglePill(this)" style="font-size: 0.8rem; border-color: #E2E8F0;">Accessibility</button>
                        </div>

                        <!-- Clinics list wrapper -->
                        <div class="d-flex flex-column gap-3" id="clinics-list-container" style="max-height: 380px; overflow-y: auto; padding-right: 5px;">
                            
                            @forelse($clinics as $index => $c)
                            <!-- Clinic Card -->
                            <div class="clinic-card p-3.5 rounded-4 border bg-white cursor-pointer {{ $index === 0 ? 'active-clinic' : '' }}" 
                                 onclick="selectClinic([{{ $c->latitude }}, {{ $c->longitude }}], '{{ $c->name }}', this)"
                                 data-name="{{ $c->name }}"
                                 data-open="{{ $c->is_open ? 'true' : 'false' }}"
                                 style="border-radius: 18px; {{ $index === 0 ? 'border-color: #5E2CB5 !important; border-width: 2px;' : 'border-color: #E2E8F0;' }} transition: all 0.2s;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">{{ $c->name }}</h5>
                                    @if($c->is_open)
                                        <span class="badge text-white px-2.5 py-1 rounded-pill small bg-success" style="font-size: 0.68rem; background-color: #0D9488 !important;">● Open</span>
                                    @else
                                        <span class="badge bg-light text-secondary border px-2.5 py-1 rounded-pill small" style="font-size: 0.68rem;">Closed</span>
                                    @endif
                                </div>
                                <p class="text-secondary small mb-2">{{ $c->address }}</p>
                                <div class="d-flex gap-3 text-muted small {{ $c->is_open ? 'mb-3' : '' }}" style="font-size: 0.78rem;">
                                    <span><i class="bi bi-geo-alt"></i> {{ $c->distance }}</span>
                                    <span><i class="bi bi-clock"></i> {{ $c->hours }}</span>
                                </div>
                                @if($c->is_open)
                                <div class="d-flex gap-2">
                                    <button class="btn text-white btn-sm px-4 py-2 fw-bold rounded-3 flex-grow-1" onclick="openBookingModal('{{ $c->name }}')" style="background-color: #5E2CB5; font-size: 0.85rem;">
                                        Book Visit
                                    </button>
                                    @if($c->phone)
                                    <a href="tel:{{ $c->phone }}" class="btn btn-light btn-sm border rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                        <i class="bi bi-telephone text-purple" style="color: #5E2CB5;"></i>
                                    </a>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @empty
                            <div class="text-center py-5 text-muted small">Tidak ada klinik terdekat terdaftar.</div>
                            @endforelse

                        </div>
                    </div>
                </div>

                <!-- Right Pane: Interactive Seattle Map -->
                <div class="col-lg-7 position-relative">
                    <div id="map" style="position: sticky; top: 90px;"></div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal Booking Visit Klinik Offline -->
<div class="modal fade" id="bookClinicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-5 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark"><i class="bi bi-calendar-check me-2" style="color: #5E2CB5;"></i> Booking Kunjungan Klinik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="clinicBookingForm" onsubmit="submitClinicBooking(event)">
                <div class="modal-body py-4">
                    <p class="text-secondary small mb-3">Reservasi sesi tatap muka langsung di <strong id="modalClinicName" class="text-purple">Downtown Serenity Center</strong>.</p>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Nama Lengkap Pasien</label>
                        <input type="text" class="form-control rounded-3 py-2.5 small" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-dark">Tanggal Kunjungan</label>
                            <input type="date" class="form-control rounded-3 py-2.5 small" min="{{ date('y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-dark">Jam Kunjungan</label>
                            <select class="form-select rounded-3 py-2.5 small" required>
                                <option value="09:00 - 10:00">09:00 - 10:00</option>
                                <option value="10:00 - 11:00">10:00 - 11:00</option>
                                <option value="13:00 - 14:00">13:00 - 14:00</option>
                                <option value="14:00 - 15:00">14:00 - 15:00</option>
                                <option value="16:00 - 17:00">16:00 - 17:00</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Nomor WhatsApp Pasien</label>
                        <input type="tel" class="form-control rounded-3 py-2.5 small" placeholder="0812xxxxxxxx" value="{{ Auth::check() ? preg_replace('/^\+?62/', '', Auth::user()->phone ?? '') : '' }}" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light text-secondary border rounded-3 px-3 py-2 small fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-3 px-4 py-2 small fw-bold shadow-sm" style="background-color: #5E2CB5;">Konfirmasi Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    #map {
        height: 580px;
        width: 100%;
        border-radius: 24px;
        border: 1px solid #E2E8F0;
        z-index: 1;
    }
    .clinic-card {
        cursor: pointer;
        border: 1px solid #E2E8F0;
        transition: all 0.2s ease;
    }
    .clinic-card:hover {
        border-color: #CBD5E1 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
    }
    .active-clinic {
        box-shadow: 0 4px 14px rgba(94, 44, 181, 0.08) !important;
    }
    .btn-outline-secondary.active-pill {
        background-color: #F3E8FF !important;
        color: #5E2CB5 !important;
        border-color: #5E2CB5 !important;
        font-weight: 700;
    }
</style>

<script>
    let clinicMap = null;
    let clinicMarkers = [];

    // Switch view modes between online therapist grid and offline clinics map layout
    function toggleSearchMode(mode) {
        if (mode === 'therapists') {
            document.getElementById('tab-therapists').style.backgroundColor = '#5E2CB5';
            document.getElementById('tab-therapists').classList.remove('text-secondary');
            document.getElementById('tab-therapists').classList.add('text-white', 'shadow-sm');
            
            document.getElementById('tab-clinics').style.backgroundColor = '';
            document.getElementById('tab-clinics').classList.remove('text-white', 'shadow-sm');
            document.getElementById('tab-clinics').classList.add('text-secondary');

            document.getElementById('therapists-view').classList.remove('d-none');
            document.getElementById('clinics-view').classList.add('d-none');
        } else {
            document.getElementById('tab-clinics').style.backgroundColor = '#5E2CB5';
            document.getElementById('tab-clinics').classList.remove('text-secondary');
            document.getElementById('tab-clinics').classList.add('text-white', 'shadow-sm');
            
            document.getElementById('tab-therapists').style.backgroundColor = '';
            document.getElementById('tab-therapists').classList.remove('text-white', 'shadow-sm');
            document.getElementById('tab-therapists').classList.add('text-secondary');

            document.getElementById('therapists-view').classList.add('d-none');
            document.getElementById('clinics-view').classList.remove('d-none');

            // Set timeout to ensure container is fully visible before initializing Leaflet
            setTimeout(initClinicMap, 150);
        }
    }

    // Initialize Leaflet Map
    function initClinicMap() {
        if (clinicMap !== null) {
            clinicMap.invalidateSize();
            return;
        }

        // Centered around Seattle
        clinicMap = L.map('map').setView([47.6205, -122.3493], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(clinicMap);

        const clinics = [
            @foreach($clinics as $c)
            {
                name: "{{ $c->name }}",
                coords: [{{ $c->latitude }}, {{ $c->longitude }}],
                address: "{{ $c->address }}"
            },
            @endforeach
        ];

        // Create Leaflet icon style matching mockup
        const purpleIcon = L.divIcon({
            html: '<div style="background-color: #5E2CB5; width: 14px; height: 14px; border: 2px solid white; border-radius: 50%; box-shadow: 0 0 4px rgba(0,0,0,0.4);"></div>',
            className: 'custom-div-icon',
            iconSize: [14, 14],
            iconAnchor: [7, 7]
        });

        clinics.forEach(c => {
            const m = L.marker(c.coords, { icon: purpleIcon }).addTo(clinicMap);
            m.bindPopup(`<strong class="text-purple" style="color:#5E2CB5;">${c.name}</strong><br><small class="text-muted">${c.address}</small>`);
            clinicMarkers.push({ name: c.name, marker: m, coords: c.coords });
        });
    }

    // Selecting a clinic pans map to marker and triggers card active styles
    function selectClinic(coords, name, cardElement) {
        // Toggle Active Class in Card
        const cards = document.querySelectorAll('.clinic-card');
        cards.forEach(c => {
            c.classList.remove('active-clinic');
            c.style.borderColor = '#E2E8F0';
            c.style.borderWidth = '1px';
        });

        cardElement.classList.add('active-clinic');
        cardElement.style.borderColor = '#5E2CB5';
        cardElement.style.borderWidth = '2px';

        // Zoom and Open Popup
        if (clinicMap) {
            clinicMap.setView(coords, 14);
            const found = clinicMarkers.find(item => item.name === name);
            if (found) {
                found.marker.openPopup();
            }
        }
    }

    // Filter Clinics by Name or ZIP/City Search Input
    function filterClinics() {
        const query = document.getElementById('clinicSearch').value.toLowerCase().trim();
        const cards = document.querySelectorAll('.clinic-card');
        
        cards.forEach(card => {
            const name = card.getAttribute('data-name').toLowerCase();
            const openStatus = card.getAttribute('data-open');

            if (!query || name.includes(query)) {
                card.style.setProperty('display', 'block', 'important');
            } else {
                card.style.setProperty('display', 'none', 'important');
            }
        });
    }

    // Toggle active state of filter pills
    function togglePill(button) {
        button.classList.toggle('active-pill');
    }

    // Modal Booking Visit triggers
    function openBookingModal(name) {
        event.stopPropagation(); // Stop selectClinic trigger from parent click
        document.getElementById('modalClinicName').textContent = name;
        var myModal = new bootstrap.Modal(document.getElementById('bookClinicModal'));
        myModal.show();
    }

    function submitClinicBooking(e) {
        e.preventDefault();
        const name = document.getElementById('modalClinicName').textContent;
        var m = bootstrap.Modal.getInstance(document.getElementById('bookClinicModal'));
        m.hide();
        alert('Booking kunjungan tatap muka ke ' + name + ' berhasil dijadwalkan! Rincian konfirmasi telah dikirim ke WhatsApp Anda.');
    }
</script>

<!-- Existing Therapists Logic -->
<script>
function onPriceAllToggle() {
    const isChecked = document.getElementById('priceAll').checked;
    if (isChecked) {
        document.getElementById('price1').checked = false;
        document.getElementById('price2').checked = false;
        document.getElementById('price3').checked = false;
    }
    filterTherapistCards();
}

function onPriceOptionToggle() {
    const p1 = document.getElementById('price1').checked;
    const p2 = document.getElementById('price2').checked;
    const p3 = document.getElementById('price3').checked;

    if (p1 || p2 || p3) {
        document.getElementById('priceAll').checked = false;
    } else {
        document.getElementById('priceAll').checked = true;
    }
    filterTherapistCards();
}

function selectTopCategory(cat, btn) {
    document.querySelectorAll('.spec-checkbox').forEach(cb => {
        if (cat === 'Semua') {
            cb.checked = false;
        } else {
            cb.checked = (cb.value === cat);
        }
    });

    syncTopPills();
    filterTherapistCards();
}

function syncTopPills() {
    const checkedSpecs = Array.from(document.querySelectorAll('.spec-checkbox:checked')).map(cb => cb.value);
    
    document.querySelectorAll('.top-category-pill').forEach(pill => {
        pill.classList.remove('text-white', 'shadow-sm');
        pill.classList.add('bg-white', 'text-secondary', 'border');
        pill.style.backgroundColor = '';
        
        const cat = pill.getAttribute('data-category');
        if (checkedSpecs.length === 1 && checkedSpecs[0] === cat) {
            pill.classList.remove('bg-white', 'text-secondary', 'border');
            pill.classList.add('text-white', 'shadow-sm');
            pill.style.backgroundColor = '#5E2CB5';
        } else if (checkedSpecs.length === 0 && cat === 'Semua') {
            pill.classList.remove('bg-white', 'text-secondary', 'border');
            pill.classList.add('text-white', 'shadow-sm');
            pill.style.backgroundColor = '#5E2CB5';
        }
    });
}

function filterTherapistCards() {
    const query = document.getElementById('therapistSearchInput').value.toLowerCase().trim();
    const priceAll = document.getElementById('priceAll').checked;
    const priceLow = document.getElementById('price1').checked;
    const priceMid = document.getElementById('price2').checked;
    const priceHigh = document.getElementById('price3').checked;

    const specChecks = Array.from(document.querySelectorAll('.spec-checkbox:checked')).map(cb => cb.value.toLowerCase());

    const cards = document.querySelectorAll('.therapist-card-item');
    let visibleCount = 0;

    cards.forEach(card => {
        const name = card.getAttribute('data-name') || '';
        const specialty = card.getAttribute('data-specialty') || '';
        const price = parseInt(card.getAttribute('data-price') || '0', 10);

        const matchesQuery = !query || name.includes(query) || specialty.includes(query);

        let matchesPrice = priceAll;
        if (!priceAll) {
            if (priceLow && price < 300000) matchesPrice = true;
            if (priceMid && price >= 300000 && price <= 400000) matchesPrice = true;
            if (priceHigh && price > 400000) matchesPrice = true;
            if (!priceLow && !priceMid && !priceHigh) matchesPrice = true;
        }

        let matchesSpec = true;
        if (specChecks.length > 0) {
            matchesSpec = specChecks.some(sc => specialty.includes(sc));
        }

        if (matchesQuery && matchesPrice && matchesSpec) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    const countElem = document.getElementById('therapistResultCount');
    if (countElem) {
        countElem.innerText = visibleCount;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const spec = params.get('specialty');
    const q = params.get('q');

    if (spec && spec !== 'Semua') {
        const cb = Array.from(document.querySelectorAll('.spec-checkbox')).find(c => c.value === spec);
        if (cb) {
            cb.checked = true;
        }
    }
    if (q) {
        document.getElementById('therapistSearchInput').value = q;
    }

    syncTopPills();
    filterTherapistCards();
});
</script>
@endsection
