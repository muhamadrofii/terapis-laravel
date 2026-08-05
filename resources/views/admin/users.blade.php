@extends('layouts.admin')

@section('title', 'Manajemen Pengguna - SerenePath Admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Manajemen Pengguna</h1>
        <p class="text-secondary mb-0">Kelola akun pasien dan terapis, status, serta izin akses.</p>
    </div>
    <button class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;">
        <i class="bi bi-person-plus-fill"></i> Tambah Pengguna Baru
    </button>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div class="btn-group border rounded-3 p-1 bg-light">
            <button class="btn btn-sm btn-white active shadow-sm fw-semibold">Semua</button>
            <button class="btn btn-sm text-secondary fw-semibold">Pasien</button>
            <button class="btn btn-sm text-secondary fw-semibold">Terapis</button>
        </div>

        <div class="input-group bg-light rounded-3 max-w-md">
            <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" class="form-control bg-transparent border-0 small" placeholder="Cari pengguna...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr class="text-muted small">
                    <th>Pengguna</th>
                    <th>Peran</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    <th>Terakhir Aktif</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&auto=format&fit=crop&q=80" alt="Dr. Sarah" class="rounded-circle object-fit-cover" style="width: 44px; height: 44px;">
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Dr. Sarah Wijaya</h6>
                                <span class="text-muted small">ID: TRP-8472</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-purple-subtle text-purple px-2.5 py-1" style="background-color: #F3E8FF; color: #5E2CB5;">Terapis</span></td>
                    <td class="small text-secondary">sarah.w@serenepath.id<br>+62 812-3456-7890</td>
                    <td><span class="badge bg-success-subtle text-success px-2 py-1">● Aktif</span></td>
                    <td class="small text-secondary">Hari ini, 09:41</td>
                    <td class="text-end"><button class="btn btn-light btn-sm border-0"><i class="bi bi-three-dots-vertical"></i></button></td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle text-purple fw-bold d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: #F1F5F9; color: #475569;">
                                RA
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Reza Aditya</h6>
                                <span class="text-muted small">ID: PTN-2931</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-secondary-subtle text-secondary px-2.5 py-1">Pasien</span></td>
                    <td class="small text-secondary">reza.aditya@email.com<br>+62 856-1122-3344</td>
                    <td><span class="badge bg-success-subtle text-success px-2 py-1">● Aktif</span></td>
                    <td class="small text-secondary">Kemarin, 14:20</td>
                    <td class="text-end"><button class="btn btn-light btn-sm border-0"><i class="bi bi-three-dots-vertical"></i></button></td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=150&auto=format&fit=crop&q=80" alt="Andi Pratama" class="rounded-circle object-fit-cover" style="width: 44px; height: 44px;">
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Andi Pratama, M.Psi</h6>
                                <span class="text-muted small">ID: TRP-9921</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-purple-subtle text-purple px-2.5 py-1" style="background-color: #F3E8FF; color: #5E2CB5;">Terapis</span></td>
                    <td class="small text-secondary">andi.pratama@serenepath.id<br>+62 813-9876-5432</td>
                    <td><span class="badge bg-warning-subtle text-warning px-2 py-1">● Menunggu Verifikasi</span></td>
                    <td class="small text-secondary">Baru saja</td>
                    <td class="text-end"><button class="btn btn-light btn-sm border-0"><i class="bi bi-three-dots-vertical"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
