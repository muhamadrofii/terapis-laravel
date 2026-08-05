@extends('layouts.admin')

@section('title', 'Kelola Pembayaran & Booking - SerenePath Admin')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Kelola Pembayaran & Booking</h1>
    <p class="text-secondary mb-0">Pantau transaksi masuk, refund, dan status jadwal konsultasi sistem.</p>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr class="text-muted small">
                    <th>ID Booking</th>
                    <th>Pasien</th>
                    <th>Terapis</th>
                    <th>Tanggal & Waktu</th>
                    <th>Status Booking</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $b)
                <tr>
                    <td class="fw-semibold small">#{{ substr($b->id, 0, 8) }}</td>
                    <td class="fw-bold text-dark">{{ $b->patient_name }}</td>
                    <td>{{ $b->therapist_name }}</td>
                    <td class="small text-secondary">{{ $b->booking_date }} {{ $b->booking_time }}</td>
                    <td>
                        @if($b->status === 'accepted')
                            <span class="badge bg-success-subtle text-success px-2.5 py-1">Accepted</span>
                        @elseif($b->status === 'pending')
                            <span class="badge bg-warning-subtle text-warning px-2.5 py-1">Pending</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-2.5 py-1">Declined</span>
                        @endif
                    </td>
                    <td class="text-end"><button class="btn btn-light btn-sm border-0"><i class="bi bi-three-dots-vertical"></i></button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
