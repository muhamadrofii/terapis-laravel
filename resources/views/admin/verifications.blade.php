@extends('layouts.admin')

@section('title', 'Verifikasi Terapis - SerenePath Admin')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Verifikasi Terapis</h1>
    <p class="text-secondary mb-0">Tinjau dokumen lisensi dan kualifikasi terapis sebelum mengaktifkan akun.</p>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr class="text-muted small">
                    <th>Terapis</th>
                    <th>Spesialisasi</th>
                    <th>Lisensi / Dokumen</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($verifications as $v)
                <tr>
                    <td class="fw-bold text-dark">{{ $v->therapist_name }}</td>
                    <td class="small text-secondary">{{ $v->specialty }}</td>
                    <td class="small"><i class="bi bi-file-earmark-pdf text-danger me-1"></i> {{ $v->license_number }}</td>
                    <td class="small text-secondary">{{ $v->created_at->format('d M Y') }}</td>
                    <td>
                        @if($v->status === 'verified')
                            <span class="badge bg-success-subtle text-success px-2.5 py-1">Terverifikasi</span>
                        @else
                            <span class="badge bg-warning-subtle text-warning px-2.5 py-1">Menunggu Review</span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if($v->status === 'pending')
                            <form action="{{ route('admin.verify', $v->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn text-white btn-sm px-3 py-1.5 fw-semibold rounded-3" style="background-color: #5E2CB5;">Verifikasi</button>
                            </form>
                        @else
                            <button class="btn btn-light btn-sm text-secondary disabled">Selesai</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
