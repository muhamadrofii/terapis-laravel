@extends('layouts.admin')

@section('title', 'Kelola Produk Herbal - Terapis Online Admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1" style="font-size: 2.25rem;">Kelola Produk Herbal</h1>
        <p class="text-secondary mb-0">Kelola katalog obat dan suplemen herbal untuk mendukung kesehatan mental pasien.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm d-flex align-items-center gap-2" style="background-color: #5E2CB5;">
        <i class="bi bi-plus-lg"></i> Tambah Produk Baru
    </a>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr class="text-muted small">
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga (IDR)</th>
                    <th>Harga (USD)</th>
                    <th>Status</th>
                    <th>Ditambahkan Pada</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $p->image }}" alt="{{ $p->name }}" class="rounded-3 object-fit-cover border" style="width: 50px; height: 50px;">
                            <div>
                                <h6 class="fw-bold text-dark mb-0">{{ $p->name }}</h6>
                                <span class="text-muted small" style="font-size: 0.75rem;">Slug: {{ $p->slug }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-light text-secondary border px-2.5 py-1 rounded-pill small">{{ $p->category }}</span>
                    </td>
                    <td class="fw-semibold text-dark">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </td>
                    <td class="text-secondary small">
                        ${{ number_format($p->price_usd, 2) }}
                    </td>
                    <td>
                        @if($p->is_bestseller)
                        <span class="badge bg-purple-subtle text-purple px-2.5 py-1" style="background-color: #F3E8FF; color: #5E2CB5;">★ Bestseller</span>
                        @else
                        <span class="badge bg-light text-secondary border px-2.5 py-1">Standard</span>
                        @endif
                    </td>
                    <td class="small text-secondary">
                        {{ $p->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-sm text-purple fw-bold rounded-3 px-3 py-1.5 d-inline-flex align-items-center gap-1 text-nowrap" style="background-color: #F3E8FF; color: #5E2CB5; border: none; font-size: 0.82rem;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari database?');" class="d-inline m-0">
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
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada produk herbal terdaftar. Silakan tambah produk baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
