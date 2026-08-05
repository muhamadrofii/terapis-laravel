@extends('layouts.app')

@section('title', 'SerenePath - Temukan Kedamaian Anda')

@section('content')
<!-- Hero Section (Pixel-perfect matching user screenshot) -->
<section class="py-5" style="background: linear-gradient(180deg, #F8F5FF 0%, #FAF7FE 100%); padding-top: 4rem !important; padding-bottom: 5rem !important;">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left Headline & Call to Action -->
            <div class="col-lg-6">
                <h1 class="display-4 fw-extrabold text-dark mb-4" style="font-weight: 800; letter-spacing: -1.2px; line-height: 1.15; font-size: 3.25rem;">
                    Temukan Kedamaian Anda
                </h1>
                <p class="lead text-secondary mb-4" style="font-size: 1.1rem; line-height: 1.7; max-width: 500px; color: #475569 !important;">
                    Terapi online profesional yang dirancang untuk mendukung kesehatan mental Anda dalam suasana yang aman dan menenangkan. Mulailah perjalanan Anda menuju kesejahteraan hari ini.
                </p>
                <a href="{{ route('register') }}" class="btn text-white px-4 py-3 shadow-sm rounded-pill fw-bold" style="background-color: #5E2CB5; font-size: 1rem; padding-left: 2.2rem !important; padding-right: 2.2rem !important;">
                    Mulai Sekarang
                </a>
            </div>
            
            <!-- Right Serene Interior Card Image -->
            <div class="col-lg-6">
                <div class="rounded-5 overflow-hidden shadow-sm border-0">
                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=900&auto=format&fit=crop&q=80" alt="Serene Therapy Room Armchair" class="img-fluid w-100 object-fit-cover rounded-5" style="max-height: 440px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Kami Section (Pixel-perfect matching user screenshot) -->
<section class="py-5" style="background-color: #F8FAFC; padding-top: 5rem !important; padding-bottom: 6rem !important;">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center max-w-xl mx-auto mb-5">
            <h2 class="display-6 fw-bold text-dark mb-2" style="font-weight: 800; font-size: 2.35rem; letter-spacing: -0.5px;">Layanan Kami</h2>
            <p class="text-secondary" style="font-size: 1.05rem; color: #64748B !important;">Pendekatan yang disesuaikan untuk kebutuhan unik Anda.</p>
        </div>

        <!-- 3 Service Cards Row -->
        <div class="row g-4">
            <!-- 1. Terapi Individu -->
            <div class="col-md-4">
                <div class="sp-card h-100 p-4 p-lg-5 border-0 shadow-sm bg-white" style="border-radius: 24px;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 52px; height: 52px; background-color: #EDE9FE; color: #5E2CB5;">
                        <i class="bi bi-person fs-4"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3" style="font-size: 1.3rem;">Terapi Individu</h4>
                    <p class="text-secondary small mb-0" style="line-height: 1.65; color: #64748B !important; font-size: 0.92rem;">
                        Sesi satu-satu yang berfokus pada pertumbuhan pribadi, mengatasi kecemasan, depresi, atau tantangan hidup lainnya dalam ruang yang rahasia.
                    </p>
                </div>
            </div>

            <!-- 2. Terapi Pasangan -->
            <div class="col-md-4">
                <div class="sp-card h-100 p-4 p-lg-5 border-0 shadow-sm bg-white" style="border-radius: 24px;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 52px; height: 52px; background-color: #EDE9FE; color: #5E2CB5;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3" style="font-size: 1.3rem;">Terapi Pasangan</h4>
                    <p class="text-secondary small mb-0" style="line-height: 1.65; color: #64748B !important; font-size: 0.92rem;">
                        Panduan profesional untuk meningkatkan komunikasi, menyelesaikan konflik, dan memperkuat ikatan emosional dalam hubungan Anda.
                    </p>
                </div>
            </div>

            <!-- 3. Terapi Keluarga -->
            <div class="col-md-4">
                <div class="sp-card h-100 p-4 p-lg-5 border-0 shadow-sm bg-white" style="border-radius: 24px;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 52px; height: 52px; background-color: #EDE9FE; color: #5E2CB5;">
                        <i class="bi bi-diagram-3 fs-4"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3" style="font-size: 1.3rem;">Terapi Keluarga</h4>
                    <p class="text-secondary small mb-0" style="line-height: 1.65; color: #64748B !important; font-size: 0.92rem;">
                        Sesi kolaboratif yang dirancang untuk mengatasi masalah keluarga, meningkatkan pemahaman, dan menciptakan dinamika rumah yang lebih harmonis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
