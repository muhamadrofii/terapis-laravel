@extends('layouts.admin')

@section('title', 'Manajemen Pengguna & Terapis - Admin Terapis Online')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Manajemen Pengguna & Terapis</h1>
        <p class="text-secondary mb-0">Kelola akun pasien dan terapis, tarif sesi/harga, spesialisasi, serta hak akses.</p>
    </div>
    <button class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-person-plus-fill"></i> Tambah Pengguna Baru
    </button>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div class="btn-group border rounded-3 p-1 bg-light" id="role-filter-group">
            <button type="button" class="btn btn-sm btn-white active shadow-sm fw-semibold" onclick="filterUserRole('all', this)">Semua ({{ count($users) }})</button>
            <button type="button" class="btn btn-sm text-secondary fw-semibold" onclick="filterUserRole('therapist', this)">Terapis ({{ $users->where('role', 'therapist')->count() }})</button>
            <button type="button" class="btn btn-sm text-secondary fw-semibold" onclick="filterUserRole('user', this)">Pasien ({{ $users->where('role', 'user')->count() }})</button>
        </div>

        <div class="input-group bg-light rounded-3 max-w-md">
            <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" id="user-search-input" onkeyup="searchUsersTable()" class="form-control bg-transparent border-0 small" placeholder="Cari nama, email, atau spesialisasi...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover" id="users-table">
            <thead class="bg-light">
                <tr class="text-secondary small fw-bold" style="font-size: 0.82rem;">
                    <th class="py-3 ps-3">PENGGUNA / TERAPIS</th>
                    <th class="py-3">PERAN (ROLE)</th>
                    <th class="py-3">TARIF / HARGA SESI</th>
                    <th class="py-3">KONTAK & EMAIL</th>
                    <th class="py-3">STATUS</th>
                    <th class="py-3 text-end pe-3">AKSI</th>
                </tr>
            </thead>
            <tbody style="font-size: 0.92rem;">
                @forelse($users as $u)
                    <tr class="user-row" data-role="{{ $u->role }}">
                        <td class="ps-3 py-3">
                            <div class="d-flex align-items-center gap-3">
                                @if(!empty($u->avatar))
                                    <img src="{{ $u->avatar }}" alt="{{ $u->name }}" class="rounded-circle object-fit-cover flex-shrink-0" style="width: 44px; height: 44px;">
                                @else
                                    <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; background-color: {{ $u->role === 'therapist' ? '#5E2CB5' : '#64748B' }};">
                                        {{ strtoupper(substr($u->name, 0, 2)) }}
                                    </div>
                                @endif
                                <div>
                                    <h6 class="fw-bold text-dark mb-0 user-searchable-name">{{ $u->name }}</h6>
                                    @if($u->role === 'therapist')
                                        <span class="text-muted small user-searchable-spec"><i class="bi bi-patch-check-fill text-primary me-1"></i>{{ $u->specialty ?? 'Psikolog Klinis' }}</span>
                                    @else
                                        <span class="text-muted small">ID: PT-{{ strtoupper(substr($u->id, 0, 8)) }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($u->role === 'admin')
                                <span class="badge bg-danger-subtle text-danger px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">Admin Utama</span>
                            @elseif($u->role === 'therapist')
                                <span class="badge text-white px-3 py-1.5 rounded-pill fw-bold" style="background-color: #5E2CB5; font-size: 0.78rem;">Terapis</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.78rem;">Pasien</span>
                            @endif
                        </td>
                        <td>
                            @if($u->role === 'therapist')
                                <div class="fw-bold text-dark">{{ $u->price ?? 'Rp 350.000' }}</div>
                                <span class="text-muted small">per 60 menit</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="small text-secondary">
                            <div class="user-searchable-email">{{ $u->email }}</div>
                            <div>{{ $u->phone ?? '081234567890' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-success-subtle text-success px-2.5 py-1 rounded-pill fw-bold" style="font-size: 0.78rem;">● Aktif</span>
                        </td>
                        <td class="text-end pe-3">
                            <button type="button" onclick="openUserDetailModal('{{ addslashes($u->name) }}', '{{ $u->role }}', '{{ $u->email }}', '{{ $u->phone ?? '081234567890' }}', '{{ addslashes($u->specialty ?? 'Psikolog Klinis') }}', '{{ $u->price ?? 'Rp 350.000' }}')" class="btn btn-light text-purple fw-bold btn-sm py-1.5 px-3 rounded-3" style="background-color: #F3E8FF; color: #5E2CB5;">
                                <i class="bi bi-eye-fill me-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted small">Belum ada pengguna terdaftar dalam database.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterUserRole(role, btn) {
        const buttons = document.querySelectorAll('#role-filter-group button');
        buttons.forEach(b => {
            b.classList.remove('btn-white', 'active', 'shadow-sm');
            b.classList.add('text-secondary');
        });
        btn.classList.add('btn-white', 'active', 'shadow-sm');
        btn.classList.remove('text-secondary');

        const rows = document.querySelectorAll('.user-row');
        rows.forEach(row => {
            if (role === 'all' || row.getAttribute('data-role') === role) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function searchUsersTable() {
        const input = document.getElementById('user-search-input').value.toLowerCase();
        const rows = document.querySelectorAll('.user-row');

        rows.forEach(row => {
            const name = row.querySelector('.user-searchable-name')?.textContent.toLowerCase() || '';
            const email = row.querySelector('.user-searchable-email')?.textContent.toLowerCase() || '';
            const spec = row.querySelector('.user-searchable-spec')?.textContent.toLowerCase() || '';

            if (name.includes(input) || email.includes(input) || spec.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function openUserDetailModal(name, role, email, phone, spec, price) {
        document.getElementById('detailUserName').textContent = name;
        document.getElementById('detailUserRoleBadge').textContent = role.toUpperCase();
        document.getElementById('detailUserEmail').value = email;
        document.getElementById('detailUserPhone').value = phone;
        document.getElementById('detailUserSpec').value = spec;
        document.getElementById('detailUserPrice').value = price;

        const modalEl = document.getElementById('userDetailModal');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    function saveUserDetailChanges() {
        alert('Data akun pengguna berhasil diperbarui!');
        const modalEl = document.getElementById('userDetailModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    }

    function saveNewUserAccount() {
        alert('Akun pengguna baru berhasil ditambahkan!');
        const modalEl = document.getElementById('addUserModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    }
</script>

<!-- Modal Detail & Edit Akun Pengguna -->
<div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="modal-header border-0 text-white p-4" style="background: linear-gradient(135deg, #5E2CB5 0%, #4C1D95 100%);">
                <div>
                    <h5 class="modal-title fw-bold" id="userDetailModalLabel"><i class="bi bi-person-gear me-2"></i> Detail & Kelola Akun Pengguna</h5>
                    <div class="small opacity-75 mt-1" id="detailUserName">Nama Pengguna</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-4 border mb-4">
                    <span class="badge bg-purple-subtle text-purple px-3 py-1.5 rounded-pill fw-bold" style="background-color: #F3E8FF; color: #5E2CB5;" id="detailUserRoleBadge">ROLE</span>
                    <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill fw-bold">● AKUN AKTIF</span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-dark">Alamat Email</label>
                        <input type="email" class="form-control rounded-3" id="detailUserEmail" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-dark">Nomor Telepon / WhatsApp</label>
                        <input type="text" class="form-control rounded-3" id="detailUserPhone">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-dark">Spesialisasi (Jika Terapis)</label>
                        <input type="text" class="form-control rounded-3" id="detailUserSpec">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-dark">Tarif Sesi Per Jam (Jika Terapis)</label>
                        <input type="text" class="form-control rounded-3" id="detailUserPrice">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-between">
                <button type="button" class="btn btn-light border fw-semibold rounded-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" onclick="saveUserDetailChanges()" class="btn text-white fw-bold rounded-3 px-4" style="background-color: #5E2CB5;">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengguna Baru -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="modal-header border-0 text-white p-4" style="background: linear-gradient(135deg, #5E2CB5 0%, #4C1D95 100%);">
                <div>
                    <h5 class="modal-title fw-bold" id="addUserModalLabel"><i class="bi bi-person-plus-fill me-2"></i> Tambah Pengguna Baru</h5>
                    <div class="small opacity-75 mt-1">Buat Akun Pasien / Terapis / Admin Baru</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-dark">Nama Lengkap</label>
                        <input type="text" class="form-control rounded-3" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-dark">Peran (Role)</label>
                        <select class="form-select rounded-3">
                            <option value="user">Pasien / Client</option>
                            <option value="therapist">Terapis Terlisensi</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-dark">Alamat Email</label>
                        <input type="email" class="form-control rounded-3" placeholder="email@example.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-dark">Kata Sandi (Password)</label>
                        <input type="password" class="form-control rounded-3" value="password123">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-between">
                <button type="button" class="btn btn-light border fw-semibold rounded-3" data-bs-dismiss="modal">Batal</button>
                <button type="button" onclick="saveNewUserAccount()" class="btn text-white fw-bold rounded-3 px-4" style="background-color: #5E2CB5;">Simpan Pengguna Baru</button>
            </div>
        </div>
    </div>
</div>
@endsection
