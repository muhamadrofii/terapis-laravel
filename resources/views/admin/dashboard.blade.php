@extends('layouts.admin')

@section('title', 'Platform Overview - SerenePath Admin Console')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div>
        <h1 class="page-title">Platform Overview</h1>
        <p class="page-subtitle">Welcome back to the SerenePath admin console.</p>
    </div>
    <div class="d-flex align-items-center gap-3">
        <span class="sp-badge-green py-2 px-3">
            <i class="bi bi-arrow-repeat"></i> Database Synced
        </span>
        <button class="btn btn-white bg-white border border-light shadow-sm rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
            <i class="bi bi-bell text-secondary fs-5"></i>
        </button>
    </div>
</div>

<!-- Metrics Cards Row -->
<div class="row g-4 mb-4">
    <!-- Card 1: Total Patients -->
    <div class="col-md-4">
        <div class="sp-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-4 p-2 d-flex align-items-center justify-content-center" style="background-color: #EDE9FE; width: 44px; height: 44px;">
                    <i class="bi bi-people-fill text-purple fs-5" style="color: #6B46C1;"></i>
                </div>
                <span class="sp-badge-green">
                    <i class="bi bi-graph-up-arrow"></i> +12%
                </span>
            </div>
            <div class="text-secondary fw-semibold small mb-1">Total Patients</div>
            <div class="fs-1 fw-extrabold text-dark" style="letter-spacing: -1px; font-weight: 800;">{{ number_format($totalPatients) }}</div>
        </div>
    </div>

    <!-- Card 2: Total Therapists -->
    <div class="col-md-4">
        <div class="sp-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-4 p-2 d-flex align-items-center justify-content-center" style="background-color: #FCE7F3; width: 44px; height: 44px;">
                    <i class="bi bi-person-workspace fs-5" style="color: #DB2777;"></i>
                </div>
                <span class="sp-badge-green">
                    <i class="bi bi-graph-up-arrow"></i> +5%
                </span>
            </div>
            <div class="text-secondary fw-semibold small mb-1">Total Therapists</div>
            <div class="fs-1 fw-extrabold text-dark" style="letter-spacing: -1px; font-weight: 800;">{{ number_format($totalTherapists) }}</div>
        </div>
    </div>

    <!-- Card 3: Revenue -->
    <div class="col-md-4">
        <div class="sp-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-4 p-2 d-flex align-items-center justify-content-center" style="background-color: #CCFBF1; width: 44px; height: 44px;">
                    <i class="bi bi-bank fs-5" style="color: #0D9488;"></i>
                </div>
                <span class="sp-badge-grey">This Month</span>
            </div>
            <div class="text-secondary fw-semibold small mb-1">Revenue</div>
            <div class="fs-1 fw-extrabold text-dark" style="letter-spacing: -1px; font-weight: 800;">{{ $revenue }}</div>
        </div>
    </div>
</div>

<!-- Main Grid Section -->
<div class="row g-4 mb-4">
    <!-- Pending Verifications (Left Column) -->
    <div class="col-lg-8">
        <div class="sp-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-dark fs-5"></i>
                    <h5 class="fw-bold mb-0 text-dark">Pending Verifications</h5>
                </div>
                <span class="sp-badge-pink">{{ $awaitingCount }} Awaiting</span>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th>Therapist Name</th>
                            <th>Specialty</th>
                            <th>Submitted</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingVerifications as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" 
                                         style="width: 40px; height: 40px; font-size: 0.85rem; 
                                                background-color: {{ $item->initials == 'ES' ? '#7C3AED' : ($item->initials == 'MR' ? '#EC4899' : '#0D9488') }};">
                                        {{ $item->initials }}
                                    </div>
                                    <div class="fw-bold text-dark" style="font-size: 0.92rem;">
                                        {{ $item->therapist_name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark mb-1" style="font-size: 0.88rem;">{{ $item->specialty }}</div>
                                @if($item->payment_verified)
                                <span class="badge bg-light text-secondary border border-light fw-medium" style="font-size: 0.72rem; padding: 0.25rem 0.6rem; border-radius: 6px; background-color: #FDF2F8 !important; color: #BE185D !important;">
                                    <i class="bi bi-card-heading me-1"></i> Payment Verified
                                </span>
                                @endif
                            </td>
                            <td class="text-muted small fw-medium">
                                {{ $item->submitted_ago }}
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.verify', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sp-purple">Verify</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No pending verifications.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Booking Activity (Right Column) -->
    <div class="col-lg-4">
        <div class="sp-card h-100">
            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-clock-history text-dark fs-5"></i>
                <h5 class="fw-bold mb-0 text-dark">Booking Activity</h5>
            </div>

            <ul class="timeline">
                @foreach($bookingActivities as $activity)
                <li class="timeline-item">
                    <span class="timeline-dot" style="background-color: {{ $activity->dot_color }};"></span>
                    <div class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $activity->title }}</div>
                    <div class="text-secondary small fw-medium mb-1">{{ $activity->description }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">{{ $activity->time_ago }}</div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Footer Card -->
<div class="sp-card p-3 border-0 mt-4" style="background-color: #E2E8F0;">
    <div class="d-flex justify-content-between align-items-center">
        <div class="fw-bold text-purple" style="color: #5B21B6; font-size: 1.1rem;">SerenePath</div>
        <div class="text-secondary small fw-medium">© 2024 SerenePath Mental Health. All rights reserved.</div>
    </div>
</div>
@endsection
