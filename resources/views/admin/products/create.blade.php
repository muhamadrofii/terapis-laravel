@extends('layouts.admin')

@section('title', 'Tambah Produk Baru - Terapis Online Admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.products.index') }}" class="text-decoration-none fw-semibold text-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Produk
    </a>
</div>

<div class="d-flex flex-column gap-1 mb-4">
    <h1 class="fw-bold text-dark" style="font-size: 2.25rem;">Tambah Produk Baru</h1>
    <p class="text-secondary">Masukkan detail produk herbal baru ke dalam katalog sistem.</p>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 bg-white max-w-3xl">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <!-- Product Name -->
            <div class="col-md-12">
                <label for="name" class="form-label fw-bold text-secondary small">Nama Produk</label>
                <input type="text" name="name" id="name" class="form-control rounded-3 py-2.5 small @error('name') is-invalid @enderror" placeholder="Contoh: Ashwagandha Calm Drops" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="col-md-6">
                <label for="category" class="form-label fw-bold text-secondary small">Kategori Produk</label>
                <select name="category" id="category" class="form-select rounded-3 py-2.5 small @error('category') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Stress Relief" {{ old('category') == 'Stress Relief' ? 'selected' : '' }}>Stress Relief</option>
                    <option value="Better Sleep" {{ old('category') == 'Better Sleep' ? 'selected' : '' }}>Better Sleep</option>
                    <option value="Mental Clarity" {{ old('category') == 'Mental Clarity' ? 'selected' : '' }}>Mental Clarity</option>
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Is Bestseller -->
            <div class="col-md-6 d-flex align-items-center mt-lg-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_bestseller" id="is_bestseller" value="1" {{ old('is_bestseller') ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold text-secondary small" for="is_bestseller">
                        Tandai sebagai Produk Terlaris (Bestseller)
                    </label>
                </div>
            </div>

            <!-- Price IDR -->
            <div class="col-md-6">
                <label for="price" class="form-label fw-bold text-secondary small">Harga (Rupiah IDR)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary small">Rp</span>
                    <input type="number" name="price" id="price" class="form-control rounded-end-3 py-2.5 small @error('price') is-invalid @enderror" placeholder="510000" value="{{ old('price') }}" required>
                </div>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price USD -->
            <div class="col-md-6">
                <label for="price_usd" class="form-label fw-bold text-secondary small">Harga (Dolar USD)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary small">$</span>
                    <input type="number" step="0.01" name="price_usd" id="price_usd" class="form-control rounded-end-3 py-2.5 small @error('price_usd') is-invalid @enderror" placeholder="34.00" value="{{ old('price_usd') }}" required>
                </div>
                @error('price_usd')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image File Upload -->
            <div class="col-md-12">
                <label for="image" class="form-label fw-bold text-secondary small">Upload Gambar Produk</label>
                <input type="file" name="image" id="image" class="form-control rounded-3 py-2.5 small @error('image') is-invalid @enderror">
                <span class="text-muted small" style="font-size: 0.72rem;">Unggah file gambar berformat JPG, PNG, atau WebP (Maks 2MB).</span>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image URL (Fallback Option) -->
            <div class="col-md-12">
                <label for="image_url" class="form-label fw-bold text-secondary small">Atau Menggunakan URL Gambar Unsplash (Opsional)</label>
                <input type="text" name="image_url" id="image_url" class="form-control rounded-3 py-2.5 small" placeholder="https://images.unsplash.com/..." value="{{ old('image_url') }}">
            </div>

            <!-- Description -->
            <div class="col-md-12">
                <label for="description" class="form-label fw-bold text-secondary small">Deskripsi Produk</label>
                <textarea name="description" id="description" rows="5" class="form-control rounded-3 p-3 small @error('description') is-invalid @enderror" placeholder="Tuliskan deskripsi lengkap manfaat dan bahan aktif dari produk herbal ini..." required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn text-white px-5 py-3 rounded-3 fw-bold mt-4 shadow-sm" style="background-color: #5E2CB5;">
            <i class="bi bi-save-fill me-2"></i> Simpan Produk
        </button>
    </form>
</div>
@endsection
