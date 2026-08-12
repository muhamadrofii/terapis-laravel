@extends('layouts.admin')

@section('title', 'Verifikasi SIK Dokter - Terapis Online Admin')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Verifikasi SIK Dokter</h1>
    <p class="text-secondary mb-0">Tinjau dan verifikasi dokumen Surat Izin Kesehatan (SIK) yang diunggah oleh para dokter dan terapis.</p>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr class="text-muted small">
                    <th>Nama Dokter / Terapis</th>
                    <th>Spesialisasi</th>
                    <th>Nama Dokumen</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th class="text-end">Aksi Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $doc)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $doc->user->avatar ?? 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=100&auto=format&fit=crop&q=80' }}" 
                                 alt="{{ $doc->user->name }}" 
                                 class="rounded-circle object-fit-cover" 
                                 style="width: 44px; height: 44px;">
                            <div>
                                <div class="fw-bold text-dark">{{ $doc->user->name }}</div>
                                <div class="text-muted small" style="font-size: 0.78rem;">{{ $doc->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="small text-secondary fw-semibold">{{ $doc->user->specialty ?? 'Clinical Psychologist' }}</td>
                    <td class="small">
                        <a href="{{ asset($doc->file_path) }}" target="_blank" class="text-decoration-none fw-bold text-purple" style="color: #5E2CB5;">
                            @if(str_contains($doc->file_name, '.pdf'))
                                <i class="bi bi-file-earmark-pdf-fill text-danger me-1"></i>
                            @else
                                <i class="bi bi-file-earmark-image-fill text-info me-1"></i>
                            @endif
                            {{ $doc->file_name }}
                        </a>
                    </td>
                    <td class="small text-secondary">{{ $doc->created_at->format('d M Y, H:i') }} WIB</td>
                    <td>
                        @if($doc->status === 'verified')
                            <span class="badge px-2.5 py-1.5 rounded-pill border small fw-bold" style="background-color: #ECFDF5; color: #059669; border-color: #10B981 !important; font-size: 0.72rem;">
                                Verified
                            </span>
                        @elseif($doc->status === 'rejected')
                            <span class="badge px-2.5 py-1.5 rounded-pill border small fw-bold" style="background-color: #FEF2F2; color: #DC2626; border-color: #EF4444 !important; font-size: 0.72rem;">
                                Rejected
                            </span>
                        @else
                            <span class="badge px-2.5 py-1.5 rounded-pill border small fw-bold" style="background-color: #FAF5FF; color: #7C3AED; border-color: #8B5CF6 !important; font-size: 0.72rem;">
                                Pending Review
                            </span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if($doc->status === 'pending')
                            <div class="d-flex justify-content-end gap-2">
                                <form action="{{ route('admin.medical_documents.verify', $doc->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn text-white btn-sm px-3 py-2 fw-bold rounded-3" style="background-color: #0D9488; font-size: 0.8rem;">
                                        Setujui (Verify)
                                    </button>
                                </form>
                                <form action="{{ route('admin.medical_documents.reject', $doc->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm px-3 py-2 fw-bold rounded-3" style="font-size: 0.8rem;">
                                        Tolak (Reject)
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-secondary small italic">Diproses</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">Belum ada unggahan dokumen SIK medis dari dokter/terapis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
