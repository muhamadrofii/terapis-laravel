@extends('layouts.app')

@section('title', 'Pencarian Terapis - Terapis Online')

@section('content')
<div class="py-4 bg-light min-vh-100">
    <div class="container">
        
        <!-- Filter Bar Top Tags (Dynamic Pills) -->
        <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
            @php
                $activeSpec = request('specialty', 'Semua');
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
                @php
                    $isActive = ($activeSpec === $key || ($key === 'Semua' && empty(request('specialty'))));
                @endphp
                <a href="{{ $key === 'Semua' ? route('user.search') : route('user.search', ['specialty' => $key]) }}" 
                   class="badge px-3 py-2 fw-semibold text-decoration-none transition-all {{ $isActive ? 'text-white shadow-sm' : 'bg-white text-secondary border' }}" 
                   style="{{ $isActive ? 'background-color: #5E2CB5;' : '' }} border-radius: 50px; font-size: 0.85rem;">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="row g-4">
            <!-- Left Sidebar Filters -->
            <div class="col-lg-3">
                <div class="bg-white p-4 rounded-4 border shadow-sm sticky-top" style="top: 90px;">
                    <h5 class="fw-bold text-dark mb-3">Filter Pencarian</h5>

                    <!-- Live Search Input -->
                    <div class="mb-4">
                        <div class="input-group bg-light rounded-3">
                            <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" id="therapistSearchInput" onkeyup="filterTherapistCards()" class="form-control bg-transparent border-0 small" placeholder="Cari nama terapis atau spesialisasi..." value="{{ request('q') }}">
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
                            <input class="form-check-input spec-checkbox" type="checkbox" value="Kecemasan" id="spec1" onchange="filterTherapistCards()">
                            <label class="form-check-label small text-secondary" for="spec1">Kecemasan (Anxiety)</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input spec-checkbox" type="checkbox" value="Depresi" id="spec2" onchange="filterTherapistCards()">
                            <label class="form-check-label small text-secondary" for="spec2">Depresi</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input spec-checkbox" type="checkbox" value="Keluarga" id="spec3" onchange="filterTherapistCards()">
                            <label class="form-check-label small text-secondary" for="spec3">Konseling Keluarga</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input spec-checkbox" type="checkbox" value="Trauma" id="spec4" onchange="filterTherapistCards()">
                            <label class="form-check-label small text-secondary" for="spec4">Trauma & PTSD</label>
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
                            <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
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
</div>

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

        // 1. Text Search Filter
        const matchesQuery = !query || name.includes(query) || specialty.includes(query);

        // 2. Price Range Filter
        let matchesPrice = priceAll;
        if (!priceAll) {
            if (priceLow && price < 300000) matchesPrice = true;
            if (priceMid && price >= 300000 && price <= 400000) matchesPrice = true;
            if (priceHigh && price > 400000) matchesPrice = true;
            if (!priceLow && !priceMid && !priceHigh) matchesPrice = true;
        }

        // 3. Specialty Checkboxes Filter
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
</script>
@endsection
