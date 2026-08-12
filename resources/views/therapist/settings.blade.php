@extends('layouts.therapist')

@section('title', 'Settings - Terapis Online')

@section('content')
<!-- Page Header -->
<div class="mb-4">
    <h1 class="fw-bold text-dark mb-1" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 2.25rem;">Medical Documents</h1>
    <p class="text-secondary mb-0">Upload and manage your health permits (Surat Izin Kesehatan).</p>
</div>

<div class="row g-4 mb-5">
    
    <!-- Left Column: Upload New Document -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-5 p-4 p-md-5 bg-white h-100" style="border-radius: 24px;">
            <h5 class="fw-bold text-dark mb-4">Upload New Document</h5>
            
            <form action="{{ route('therapist.settings.medical_document') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Drag and drop zone -->
                <div class="border border-2 border-dashed rounded-4 p-5 text-center position-relative mb-4" 
                     style="background-color: #F8FAFC; border-color: #CBD5E1 !important; border-radius: 16px; cursor: pointer;"
                     onclick="document.getElementById('doc-file-input').click()">
                    
                    <input type="file" name="document" id="doc-file-input" class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer" onchange="displayFileName(this)" required>
                    
                    <div class="mb-3">
                        <i class="bi bi-cloud-arrow-up text-purple fs-1" style="color: #5E2CB5; font-size: 3rem !important;"></i>
                    </div>
                    
                    <h5 class="fw-bold text-dark mb-1" id="upload-box-title">Drag and drop your file here</h5>
                    <p class="text-secondary small mb-3">Supported formats: PDF, JPG, PNG (Max 5MB)</p>
                    
                    <button type="button" class="btn text-white px-4 py-2 fw-bold rounded-3" style="background-color: #5E2CB5; font-size: 0.88rem;">
                        Browse Files
                    </button>
                </div>

                <!-- Warning banner at bottom of card -->
                <div class="rounded-4 p-3 d-flex gap-3 text-secondary align-items-center" style="background-color: #F3E8FF; color: #5B21B6 !important; border-radius: 12px;">
                    <i class="bi bi-info-circle-fill fs-4 text-purple" style="color: #5E2CB5;"></i>
                    <p class="mb-0 small" style="line-height: 1.45;">Please ensure your Surat Izin Kesehatan is valid and clearly legible. Processing may take up to 48 hours.</p>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn text-white px-4 py-2.5 fw-bold rounded-3 shadow-xs" style="background-color: #5E2CB5;">
                        <i class="bi bi-cloud-check-fill me-1"></i> Upload SIK Document
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Column: Recent Documents -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-5 p-4 bg-white h-100 d-flex flex-column justify-content-between" style="border-radius: 24px;">
            <div>
                <h5 class="fw-bold text-dark mb-4">Recent Documents</h5>
                
                <div class="d-flex flex-column gap-3 mb-4">
                    @forelse($medicalDocuments as $doc)
                        <!-- Document card strip -->
                        <div class="d-flex align-items-center justify-content-between p-3 rounded-4 border bg-white" style="border-radius: 14px; border-color: #E2E8F0 !important;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center" 
                                     style="width: 44px; height: 44px; background-color: {{ str_contains($doc->file_name, '.jpg') || str_contains($doc->file_name, '.png') ? '#F1F5F9' : '#F3E8FF' }}; color: {{ str_contains($doc->file_name, '.jpg') || str_contains($doc->file_name, '.png') ? '#64748B' : '#5E2CB5' }};">
                                    @if(str_contains($doc->file_name, '.pdf'))
                                        <i class="bi bi-file-earmark-pdf-fill fs-4"></i>
                                    @else
                                        <i class="bi bi-file-earmark-image-fill fs-4"></i>
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold text-dark text-truncate" style="font-size: 0.92rem; max-width: 160px;" title="{{ $doc->file_name }}">{{ $doc->file_name }}</div>
                                    <span class="text-secondary small" style="font-size: 0.75rem;">Uploaded {{ $doc->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <!-- Badges matching mockup style -->
                            <div>
                                @if($doc->status === 'verified')
                                    <span class="badge px-2.5 py-1.5 rounded-pill border small fw-bold d-inline-flex align-items-center gap-1" style="background-color: #ECFDF5; color: #059669; border-color: #10B981 !important; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle-fill"></i> Verified
                                    </span>
                                @elseif($doc->status === 'rejected')
                                    <span class="badge px-2.5 py-1.5 rounded-pill border small fw-bold d-inline-flex align-items-center gap-1" style="background-color: #FEF2F2; color: #DC2626; border-color: #EF4444 !important; font-size: 0.72rem;">
                                        <i class="bi bi-x-circle-fill"></i> Rejected
                                    </span>
                                @else
                                    <span class="badge px-2.5 py-1.5 rounded-pill border small fw-bold d-inline-flex align-items-center gap-1" style="background-color: #FAF5FF; color: #7C3AED; border-color: #8B5CF6 !important; font-size: 0.72rem;">
                                        <i class="bi bi-clock-fill"></i> Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted small">Belum ada dokumen Surat Izin Kesehatan terunggah.</div>
                    @endforelse
                </div>
            </div>

            <!-- View All documents link -->
            <div class="text-center mt-3 pt-3 border-top">
                <a href="javascript:void(0)" onclick="alert('Semua dokumen Anda sudah terdaftar di atas secara lengkap.')" class="text-decoration-none fw-bold small text-purple" style="color: #5E2CB5;">View All Documents</a>
            </div>
        </div>
    </div>

</div>

<!-- PROFILE EDIT SECTION (At bottom, as secondary settings card) -->
<div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm" style="border-radius: 24px;">
    <h5 class="fw-bold text-dark mb-4">Informasi Profil & Akun</h5>

    <form action="{{ route('therapist.settings.update') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold small text-dark">Nama Lengkap & Gelar</label>
                <input type="text" name="name" class="form-control rounded-3 py-2.5" value="{{ old('name', $therapist->name) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold small text-dark">Email Terapis</label>
                <input type="email" name="email" class="form-control rounded-3 py-2.5" value="{{ old('email', $therapist->email) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold small text-dark">Tarif Sesi Per Jam (Harga)</label>
                <input type="text" name="price" class="form-control rounded-3 py-2.5" value="{{ old('price', $therapist->price ?? 'Rp 350.000') }}" placeholder="Contoh: Rp 350.000">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold small text-dark">Bidang Spesialisasi</label>
                <input type="text" name="specialty" class="form-control rounded-3 py-2.5" value="{{ old('specialty', $therapist->specialty ?? 'Clinical Psychologist') }}">
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-semibold small text-dark">Kata Sandi Baru (Opsional)</label>
                <input type="password" name="password" class="form-control rounded-3 py-2.5" placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background-color: #5E2CB5;">Simpan Perubahan Profil</button>
        </div>
    </form>
</div>

<script>
    function displayFileName(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const sizeMb = (input.files[0].size / (1024 * 1024)).toFixed(2);
            document.getElementById('upload-box-title').textContent = fileName + ' (' + sizeMb + ' MB)';
        }
    }
</script>
@endsection
