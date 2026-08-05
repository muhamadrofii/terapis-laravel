@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan - SerenePath')

@section('content')
<div class="container py-5 text-center my-5">
    <div class="row justify-content-center py-4">
        <div class="col-md-6">
            <div class="sp-card p-5 shadow-lg">
                <div class="rounded-circle bg-purple-subtle d-inline-flex p-4 mb-4" style="background-color: #EDE9FE;">
                    <i class="bi bi-compass fs-1" style="color: #6B46C1;"></i>
                </div>
                <h1 class="display-1 fw-extrabold text-purple mb-0" style="color: #5B21B6; font-weight: 800; letter-spacing: -2px;">404</h1>
                <h3 class="fw-bold text-dark mb-3">Halaman Tidak Ditemukan</h3>
                <p class="text-secondary mb-4">
                    Maaf, halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau alamat URL yang Anda masukkan salah.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('home') }}" class="btn btn-sp-purple px-4 py-2">
                        <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
                    </a>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-sp-outline px-4 py-2">
                        Dashboard Portal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
