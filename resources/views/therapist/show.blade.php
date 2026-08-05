@extends('layouts.app')

@section('title', ($therapist->name ?? 'Dr. Sarah Jenkins') . ' - Profil & Booking - Terapis Online')

@section('content')
<div class="py-4" style="background-color: #F8FAFC; min-height: 100vh;">
    <div class="container">
        <div class="row g-4">
            <!-- Left Column: Therapist Profile Details & Reviews -->
            <div class="col-lg-7">
                
                <!-- Card 1: Hero Profile Card -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="border-color: #E2E8F0 !important;">
                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-4">
                        <img src="{{ $therapist->avatar ?? 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&auto=format&fit=crop&q=80' }}" class="rounded-circle object-fit-cover shadow-sm" style="width: 140px; height: 140px;" alt="{{ $therapist->name }}">
                        
                        <div class="text-center text-sm-start">
                            <h2 class="fw-bold text-dark mb-1" style="font-size: 2rem; letter-spacing: -0.5px;">{{ $therapist->name ?? 'Dr. Sarah Jenkins, Ph.D.' }}</h2>
                            <p class="text-secondary mb-3" style="font-size: 1.1rem; color: #475569;">{{ $therapist->title ?? 'Psikolog Klinis Utama' }}</p>
                            
                            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start gap-2 mb-3">
                                @php
                                    $specs = explode(',', $therapist->specialty ?? 'Kecemasan, Depresi, Trauma');
                                @endphp
                                @foreach($specs as $spec)
                                    <span class="badge text-white px-3 py-2 fw-semibold" style="background-color: #5E2CB5; border-radius: 50px; font-size: 0.82rem;">{{ trim($spec) }}</span>
                                @endforeach
                            </div>

                            <div class="d-flex flex-column gap-2 text-secondary small" style="color: #475569 !important; font-size: 0.9rem;">
                                <div><i class="bi bi-mortarboard me-2 text-purple" style="color: #5E2CB5;"></i> Magister Psikologi Klinis & Terapan</div>
                                <div><i class="bi bi-briefcase me-2 text-purple" style="color: #5E2CB5;"></i> {{ $therapist->experience ?? '10+ Tahun Pengalaman' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: About Therapist -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="border-color: #E2E8F0 !important;">
                    <h4 class="fw-bold text-dark mb-3" style="font-size: 1.35rem;">Tentang {{ $therapist->name ?? 'Terapis' }}</h4>
                    <p class="text-secondary mb-3" style="line-height: 1.7; font-size: 0.98rem; color: #475569 !important;">
                        {{ $therapist->bio ?? 'Terapis profesional terverifikasi yang siap membantu mengurai masalah emosional dan kesehatan mental Anda.' }}
                    </p>
                    <p class="text-secondary mb-0" style="line-height: 1.7; font-size: 0.98rem; color: #475569 !important;">
                        Baik saat Anda menghadapi masa transisi kehidupan yang menantang, berjuang melawan kecemasan, atau mencari pengembangan diri, tujuan saya adalah memberikan wawasan dan perangkat yang dibutuhkan untuk membangun ketahanan mental.
                    </p>
                </div>

                <!-- Card 3: Patient Reviews -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm" style="border-color: #E2E8F0 !important;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-dark mb-0" style="font-size: 1.35rem;">Ulasan Pasien</h4>
                        <div class="text-warning fw-bold small">
                            <i class="bi bi-star-fill me-1"></i> <span class="fs-5 text-dark fw-bold">{{ $therapist->rating ?? '4.9' }}</span> <span class="text-muted font-normal">({{ $therapist->reviews_count ?? 120 }} ulasan)</span>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-4">
                        <!-- Review 1 -->
                        <div class="pb-3 border-bottom" style="border-color: #F1F5F9 !important;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle text-purple fw-bold d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: #F3E8FF; color: #5E2CB5; font-size: 0.85rem;">
                                        M
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark small">Pengguna Terverifikasi</div>
                                        <div class="text-muted" style="font-size: 0.75rem;">2 minggu lalu</div>
                                    </div>
                                </div>
                                <div class="text-warning small">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                            <p class="text-secondary small mb-0" style="color: #475569 !important; font-size: 0.92rem; line-height: 1.6;">"Sangat membantu dalam mengelola stres kerja saya. Pembawaannya yang tenang membuat setiap sesi konsultasi terasa sangat aman."</p>
                        </div>

                        <!-- Review 2 -->
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle text-teal fw-bold d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: #CCFBF1; color: #0D9488; font-size: 0.85rem;">
                                        T
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark small">Pengguna Terverifikasi</div>
                                        <div class="text-muted" style="font-size: 0.75rem;">1 bulan lalu</div>
                                    </div>
                                </div>
                                <div class="text-warning small">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                            <p class="text-secondary small mb-0" style="color: #475569 !important; font-size: 0.92rem; line-height: 1.6;">"Sangat perhatian dan memberikan saran praktis yang dapat langsung diterapkan."</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Book a Session Widget -->
            <div class="col-lg-5">
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm sticky-top" style="border-color: #E2E8F0 !important; top: 90px;">
                    <h5 class="fw-bold text-dark mb-3" style="font-size: 1.2rem;">Pesan Sesi Konsultasi</h5>

                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #F1F5F9 !important;">
                        <div>
                            <span class="display-6 fw-extrabold text-purple" style="color: #5E2CB5; font-weight: 800;">{{ $therapist->price ?? 'Rp 350.000' }}</span>
                            <span class="text-muted small">/ 50 menit</span>
                        </div>
                        <span class="badge fw-semibold px-3 py-2" style="background-color: #CCFBF1; color: #0D9488; font-size: 0.8rem; border-radius: 6px;">
                            Sesi Video Call
                        </span>
                    </div>

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="therapist_id" value="{{ $therapist->id ?? 1 }}">
                        <input type="hidden" name="therapist_name" value="{{ $therapist->name ?? 'Dr. Sarah Jenkins' }}">
                        <input type="hidden" name="patient_name" value="{{ Auth::check() ? Auth::user()->name : 'Pasien' }}">
                        <input type="hidden" name="session_type" value="Terapi & Konsultasi Spesialis">
                        <input type="hidden" name="price" value="{{ $therapist->price ?? 'Rp 350.000' }}">

                        <!-- Select Date Strip -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-semibold small text-dark mb-0">Pilih Tanggal</label>
                                <input type="date" id="customDatePicker" class="form-control form-control-sm border-0 bg-light rounded-3 text-secondary fw-semibold" style="width: auto; font-size: 0.8rem;" min="{{ now()->format('Y-m-d') }}" value="{{ now()->format('Y-m-d') }}" onchange="selectCustomDate(this.value)">
                            </div>
                            <div class="row g-2 text-center" id="dateCardsContainer">
                                @php
                                    $today = now();
                                @endphp
                                @for($i = 0; $i < 4; $i++)
                                    @php
                                        $dateObj = now()->addDays($i);
                                        $isToday = ($i === 0);
                                    @endphp
                                    <div class="col-3">
                                        <div class="date-card p-2 border rounded-3 {{ $isToday ? 'text-white shadow-sm active-date' : 'text-muted bg-white' }}" 
                                             style="cursor: pointer; {{ $isToday ? 'background-color: #5E2CB5; border-color: #5E2CB5 !important;' : 'border-color: #E2E8F0 !important;' }}" 
                                             onclick="selectDateCard(this, '{{ $dateObj->format('Y-m-d') }}', '{{ strtoupper($dateObj->format('D')) }} {{ $dateObj->format('d') }}')">
                                            <div class="small fw-bold" style="font-size: 0.68rem;">{{ strtoupper($dateObj->format('D')) }}</div>
                                            <div class="fs-5 fw-bold {{ $isToday ? 'text-white' : 'text-dark' }}">{{ $dateObj->format('d') }}</div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Available Times Strip -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-dark d-block mb-2">Waktu Tersedia (WIB)</label>
                            <div class="row g-2 text-center" id="timeSlotsContainer">
                                <div class="col-6">
                                    <button type="button" class="btn btn-light w-100 py-2 border text-muted small text-decoration-line-through disabled" style="background-color: #F8FAFC; border-color: #E2E8F0 !important;">09:00 WIB</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="time-slot btn btn-light w-100 py-2 border text-dark small fw-semibold" style="background-color: #F8FAFC; border-color: #E2E8F0 !important;" onclick="selectTimeSlot(this, '10:00 WIB')">10:00 WIB</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="time-slot btn w-100 py-2 text-white small fw-bold shadow-sm active-time" style="background-color: #5E2CB5; border-color: #5E2CB5 !important;" onclick="selectTimeSlot(this, '11:30 WIB')">11:30 WIB</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="time-slot btn btn-light w-100 py-2 border text-dark small fw-semibold" style="background-color: #F8FAFC; border-color: #E2E8F0 !important;" onclick="selectTimeSlot(this, '14:00 WIB')">14:00 WIB</button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="booking_date" id="inputBookingDate" value="{{ now()->format('Y-m-d') }}">
                        <input type="hidden" name="booking_time" id="inputBookingTime" value="11:30 WIB">

                        <!-- Input Keluhan Utama Pasien -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-dark d-block mb-1"><i class="bi bi-pencil-square me-1 text-purple" style="color: #5E2CB5;"></i> Keluhan Utama / Catatan untuk Terapis</label>
                            <textarea name="notes" class="form-control rounded-3 border bg-light text-dark small" rows="3" placeholder="Tuliskan keluhan mental, gejala kecemasan/stres, atau topik yang ingin Anda konsultasikan di sini..." style="border-color: #E2E8F0 !important;" required></textarea>
                        </div>

                        <!-- Selected Summary Display -->
                        <div class="p-3 rounded-4 mb-4" style="background-color: #F1F5F9;">
                            <div class="d-flex justify-content-between small text-secondary mb-1">
                                <span>Jadwal Dipilih</span>
                                <span class="fw-bold text-purple" id="selectedScheduleSummary" style="color: #5E2CB5;">{{ now()->format('Y-m-d') }} @ 11:30 WIB</span>
                            </div>
                            <div class="d-flex justify-content-between small text-secondary mb-1">
                                <span>Biaya Sesi</span>
                                <span>{{ $therapist->price ?? 'Rp 350.000' }}</span>
                            </div>
                            <div class="d-flex justify-content-between small text-secondary mb-2">
                                <span>Biaya Layanan</span>
                                <span>Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold text-dark border-top pt-2" style="border-color: #E2E8F0 !important;">
                                <span>Total Tagihan</span>
                                <span>{{ $therapist->price ?? 'Rp 350.000' }}</span>
                            </div>
                        </div>

                        <!-- Proceed Button -->
                        <button type="submit" class="btn text-white w-100 py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #5E2CB5; border-radius: 12px;">
                            <span>Lanjut ke Pembayaran QRIS</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>

                        <div class="text-center text-muted small mt-2" style="font-size: 0.78rem;">
                            Nominal QRIS akan terisi otomatis secara dinamis.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function selectDateCard(element, dateVal, dateLabel) {
    document.querySelectorAll('.date-card').forEach(el => {
        el.classList.remove('text-white', 'shadow-sm', 'active-date');
        el.classList.add('text-muted', 'bg-white');
        el.style.backgroundColor = '#FFFFFF';
        el.style.borderColor = '#E2E8F0';
        const numText = el.querySelector('.fs-5');
        if (numText) {
            numText.classList.remove('text-white');
            numText.classList.add('text-dark');
        }
    });

    element.classList.remove('text-muted', 'bg-white');
    element.classList.add('text-white', 'shadow-sm', 'active-date');
    element.style.backgroundColor = '#5E2CB5';
    element.style.borderColor = '#5E2CB5';
    const numText = element.querySelector('.fs-5');
    if (numText) {
        numText.classList.remove('text-dark');
        numText.classList.add('text-white');
    }

    document.getElementById('inputBookingDate').value = dateVal;
    document.getElementById('customDatePicker').value = dateVal;
    updateSummary();
}

function selectCustomDate(dateVal) {
    const todayStr = new Date().toISOString().split('T')[0];
    if (dateVal < todayStr) {
        alert('Tanggal tidak boleh di masa lalu (sebelum hari ini). Silakan pilih tanggal hari ini atau yang akan datang.');
        document.getElementById('customDatePicker').value = todayStr;
        document.getElementById('inputBookingDate').value = todayStr;
        updateSummary();
        return;
    }

    document.getElementById('inputBookingDate').value = dateVal;
    document.querySelectorAll('.date-card').forEach(el => {
        el.classList.remove('text-white', 'shadow-sm', 'active-date');
        el.classList.add('text-muted', 'bg-white');
        el.style.backgroundColor = '#FFFFFF';
        el.style.borderColor = '#E2E8F0';
        const numText = el.querySelector('.fs-5');
        if (numText) {
            numText.classList.remove('text-white');
            numText.classList.add('text-dark');
        }
    });
    updateSummary();
}

function selectTimeSlot(element, timeVal) {
    document.querySelectorAll('.time-slot').forEach(el => {
        el.classList.remove('text-white', 'shadow-sm', 'active-time');
        el.classList.add('btn-light', 'text-dark', 'fw-semibold');
        el.style.backgroundColor = '#F8FAFC';
        el.style.borderColor = '#E2E8F0';
    });

    element.classList.remove('btn-light', 'text-dark', 'fw-semibold');
    element.classList.add('text-white', 'shadow-sm', 'active-time');
    element.style.backgroundColor = '#5E2CB5';
    element.style.borderColor = '#5E2CB5';

    document.getElementById('inputBookingTime').value = timeVal;
    updateSummary();
}

function updateSummary() {
    const d = document.getElementById('inputBookingDate').value;
    const t = document.getElementById('inputBookingTime').value;
    const summary = document.getElementById('selectedScheduleSummary');
    if (summary) {
        summary.innerText = d + ' @ ' + t;
    }
}
</script>
@endsection
