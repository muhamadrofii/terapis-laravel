@extends('layouts.app')

@section('title', 'Herbal Shop - Terapis Online')

@section('content')
<div class="py-5" style="background-color: #FAF9FF; min-height: 100vh;">
    <div class="container">
        
        <!-- Shop Header -->
        <div class="text-center max-w-2xl mx-auto mb-5">
            <h1 class="display-4 fw-extrabold mb-3" style="color: #4C1D95; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; letter-spacing: -1px;">
                Herbal Shop
            </h1>
            <p class="text-secondary lead" style="font-size: 1.1rem; line-height: 1.6; max-width: 700px; margin: 0 auto; color: #475569 !important;">
                Discover our curated selection of natural remedies designed to support your mental wellness journey. From stress relief to cognitive support, find the herbal solution that fits your needs.
            </p>
        </div>

        <!-- Category Filters -->
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
            <button class="btn btn-filter active px-4 py-2 rounded-pill fw-semibold" onclick="filterCategory('All')">All Products</button>
            <button class="btn btn-filter px-4 py-2 rounded-pill fw-semibold" onclick="filterCategory('Stress Relief')">Stress Relief</button>
            <button class="btn btn-filter px-4 py-2 rounded-pill fw-semibold" onclick="filterCategory('Better Sleep')">Better Sleep</button>
            <button class="btn btn-filter px-4 py-2 rounded-pill fw-semibold" onclick="filterCategory('Mental Clarity')">Mental Clarity</button>
        </div>

        <!-- Products Grid -->
        <div class="row g-4" id="products-grid">
            
            <!-- Row 1: Featured & Side Product -->
            @php
                $bestseller = $products->where('is_bestseller', true)->first() ?? $products->first();
                $otherProducts = $products->where('id', '!=', $bestseller->id);
            @endphp

            @if($bestseller)
                <!-- Featured Product: Ashwagandha (Wide Card) -->
                <div class="col-lg-8 col-md-12 product-item" data-category="{{ $bestseller->category }}">
                    <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100 product-card transition-all d-flex flex-column flex-md-row">
                        <div class="col-md-5 position-relative" style="min-height: 250px;">
                            <img src="{{ $bestseller->image }}" alt="{{ $bestseller->name }}" class="w-100 h-100 object-fit-cover position-absolute">
                        </div>
                        <div class="col-md-7 p-4 p-lg-5 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="badge px-3 py-1.5 rounded-pill text-purple small fw-bold" style="background-color: #F3E8FF; color: #6B46C1;">Bestseller</span>
                                    <span class="badge bg-light text-secondary border px-3 py-1.5 rounded-pill small fw-medium">{{ $bestseller->category }}</span>
                                </div>
                                <h3 class="fw-bold text-dark mb-3" style="font-size: 1.85rem; font-family: 'Plus Jakarta Sans', sans-serif;">{{ $bestseller->name }}</h3>
                                <p class="text-secondary mb-4" style="line-height: 1.6; font-size: 0.95rem;">{{ $bestseller->description }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <div>
                                    <div class="fs-4 fw-extrabold text-dark" style="color: #4C1D95 !important;">${{ number_format($bestseller->price_usd, 2) }}</div>
                                    <div class="text-muted small">Rp {{ number_format($bestseller->price, 0, ',', '.') }}</div>
                                </div>
                                <a href="{{ route('shop.checkout', $bestseller->id) }}" class="btn text-white px-4 py-2.5 rounded-3 fw-bold d-flex align-items-center gap-2" style="background-color: #5E2CB5; transition: background-color 0.2s;">
                                    <i class="bi bi-cart-plus-fill"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @php
                // Get the second product to occupy the 1/3 space on the right of the bestseller
                $sideProduct = $otherProducts->first();
                if ($sideProduct) {
                    $otherProducts = $otherProducts->where('id', '!=', $sideProduct->id);
                }
            @endphp

            @if($sideProduct)
                <!-- Side Product: Chamomile Dream Tea (Vertical Card) -->
                <div class="col-lg-4 col-md-12 product-item" data-category="{{ $sideProduct->category }}">
                    <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100 product-card transition-all d-flex flex-column justify-content-between">
                        <div class="position-relative" style="height: 220px;">
                            <img src="{{ $sideProduct->image }}" alt="{{ $sideProduct->name }}" class="w-100 h-100 object-fit-cover">
                            <span class="position-absolute top-3 start-3 badge bg-white text-dark shadow-sm px-3 py-1.5 rounded-pill small fw-medium" style="top: 15px; left: 15px;">{{ $sideProduct->category }}</span>
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h4 class="fw-bold text-dark mb-2" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $sideProduct->name }}</h4>
                                <p class="text-secondary small mb-4" style="line-height: 1.5;">{{ $sideProduct->description }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div>
                                    <div class="fw-bold text-dark fs-5" style="color: #4C1D95 !important;">${{ number_format($sideProduct->price_usd, 2) }}</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Rp {{ number_format($sideProduct->price, 0, ',', '.') }}</div>
                                </div>
                                <a href="{{ route('shop.checkout', $sideProduct->id) }}" class="btn text-purple p-2.5 rounded-circle d-flex align-items-center justify-content-center shadow-xs" style="background-color: #F3E8FF; width: 44px; height: 44px; border: none; transition: all 0.2s;" title="Add to Cart">
                                    <i class="bi bi-cart-plus fs-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Row 2: Remaining Products (3 Columns Grid) -->
            @foreach($otherProducts as $p)
                <div class="col-lg-4 col-md-6 product-item" data-category="{{ $p->category }}">
                    <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100 product-card transition-all d-flex flex-column justify-content-between">
                        <div class="position-relative" style="height: 220px;">
                            <img src="{{ $p->image }}" alt="{{ $p->name }}" class="w-100 h-100 object-fit-cover">
                            <span class="position-absolute top-3 start-3 badge bg-white text-dark shadow-sm px-3 py-1.5 rounded-pill small fw-medium" style="top: 15px; left: 15px;">{{ $p->category }}</span>
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h4 class="fw-bold text-dark mb-2" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $p->name }}</h4>
                                <p class="text-secondary small mb-4" style="line-height: 1.5;">{{ $p->description }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div>
                                    <div class="fw-bold text-dark fs-5" style="color: #4C1D95 !important;">${{ number_format($p->price_usd, 2) }}</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                                </div>
                                <a href="{{ route('shop.checkout', $p->id) }}" class="btn text-purple p-2.5 rounded-circle d-flex align-items-center justify-content-center shadow-xs" style="background-color: #F3E8FF; width: 44px; height: 44px; border: none; transition: all 0.2s;" title="Add to Cart">
                                    <i class="bi bi-cart-plus fs-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</div>

<style>
    .btn-filter {
        background-color: #FFFFFF;
        color: #475569;
        border: 1px solid #E2E8F0;
        transition: all 0.2s ease;
    }
    .btn-filter:hover {
        background-color: #F1F5F9;
        color: #0F172A;
    }
    .btn-filter.active {
        background-color: #5E2CB5 !important;
        color: #FFFFFF !important;
        border-color: #5E2CB5 !important;
        box-shadow: 0 4px 12px rgba(94, 44, 181, 0.2);
    }
    .product-card {
        border: 1px solid #F1F5F9 !important;
        background-color: #FFFFFF;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08) !important;
    }
    .product-card img {
        transition: transform 0.3s ease;
    }
    .product-card:hover img {
        transform: scale(1.03);
    }
    .text-purple {
        color: #5E2CB5 !important;
    }
    .bg-purple-subtle {
        background-color: #F3E8FF !important;
    }
</style>

<script>
    function filterCategory(category) {
        // Toggle Active Button Class
        const buttons = document.querySelectorAll('.btn-filter');
        buttons.forEach(btn => {
            if(btn.textContent.trim().toLowerCase().includes(category.toLowerCase())) {
                btn.classList.add('active');
            } else if(category === 'All' && btn.textContent.trim().toLowerCase().includes('all')) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // Filter Products
        const items = document.querySelectorAll('.product-item');
        items.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            if (category === 'All' || itemCategory === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection
