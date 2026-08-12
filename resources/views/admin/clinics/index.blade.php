@extends('layouts.admin')

@section('title', 'Kelola Klinik Offline - Terapis Online Admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Kelola Klinik Offline</h1>
        <p class="text-secondary mb-0">Kelola daftar lokasi klinik offline Terapis Online untuk sesi tatap muka langsung (offline).</p>
    </div>
    <a href="{{ route('admin.clinics.create') }}" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;">
        <i class="bi bi-plus-lg"></i> Tambah Klinik Baru
    </a>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr class="text-muted small">
                    <th>Nama Klinik</th>
                    <th>Alamat</th>
                    <th>Jarak</th>
                    <th>Jam Operasional</th>
                    <th>Koordinat (Lat, Lng)</th>
                    <th>Status</th>
                    <th>No. Telp</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clinics as $c)
                <tr>
                    <td class="fw-bold text-dark">{{ $c->name }}</td>
                    <td class="small text-secondary" style="max-width: 220px;">{{ $c->address }}</td>
                    <td class="small text-dark fw-medium">{{ $c->distance }}</td>
                    <td class="small text-secondary">{{ $c->hours }}</td>
                    <td class="small text-secondary font-monospace" style="font-size: 0.8rem;">
                        {{ number_format($c->latitude, 4) }}, {{ number_format($c->longitude, 4) }}
                    </td>
                    <td>
                        @if($c->is_open)
                            <span class="badge text-white px-2.5 py-1 rounded-pill small" style="background-color: #0D9488 !important; font-size: 0.72rem;">● Open</span>
                        @else
                            <span class="badge bg-light text-secondary border px-2.5 py-1 rounded-pill small" style="font-size: 0.72rem;">Closed</span>
                        @endif
                    </td>
                    <td class="small text-secondary">{{ $c->phone ?? '-' }}</td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <a href="{{ route('admin.clinics.edit', $c->id) }}" class="btn btn-sm text-purple fw-bold rounded-3 px-3 py-1.5 d-inline-flex align-items-center gap-1 text-nowrap" style="background-color: #F3E8FF; color: #5E2CB5; border: none; font-size: 0.82rem;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.clinics.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus klinik ini dari database?');" class="d-inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-danger fw-bold rounded-3 px-3 py-1.5 d-inline-flex align-items-center gap-1 text-nowrap" style="background-color: #FFE4E6; color: #E11D48; border: none; font-size: 0.82rem;">
                                    <i class="bi bi-trash3-fill"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">Belum ada klinik offline terdaftar. Silakan tambah klinik baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
