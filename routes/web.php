<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\QrisController as AdminQrisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\BookingController;

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Therapist Profile & Booking Form
Route::get('/therapists/search', [UserController::class, 'search'])->name('user.search');
Route::get('/therapists/{id}', [TherapistController::class, 'show'])->name('therapist.show');
Route::get('/booking/store', function() { return redirect()->route('user.search'); });
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::post('/review/store', [BookingController::class, 'storeReview'])->name('review.store');

// QRIS Dynamic Payment & Booking Status Routes
Route::get('/booking/{id}/pay', [BookingController::class, 'pay'])->name('booking.pay');
Route::post('/booking/{id}/proof', [BookingController::class, 'uploadProof'])->name('booking.proof');
Route::post('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

// Live Chat Web APIs
Route::get('/chat/messages', [\App\Http\Controllers\ChatController::class, 'getMessages'])->name('chat.messages');
Route::post('/chat/send', [\App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');

// Herbal Shop Routes (mockup matching)
Route::get('/resources', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/checkout/{id}', [\App\Http\Controllers\ShopController::class, 'checkout'])->name('shop.checkout');
Route::post('/shop/order', [\App\Http\Controllers\ShopController::class, 'storeOrder'])->name('shop.order.store');
Route::get('/shop/order/{id}/pay', [\App\Http\Controllers\ShopController::class, 'pay'])->name('shop.pay');
Route::post('/shop/order/{id}/proof', [\App\Http\Controllers\ShopController::class, 'uploadProof'])->name('shop.proof');

// Patient / User Portal Routes
Route::prefix('user')->middleware([\App\Http\Middleware\RoleMiddleware::class . ':user,therapist,admin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/sessions', [UserController::class, 'sessions'])->name('user.sessions');
    Route::get('/payments', [UserController::class, 'payments'])->name('user.payments');
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::post('/settings', [UserController::class, 'updateSettings'])->name('user.settings.update');
});

// Therapist Portal Routes (Strictly Therapist & Admin)
Route::prefix('therapist')->middleware([\App\Http\Middleware\RoleMiddleware::class . ':therapist,admin'])->group(function () {
    Route::get('/dashboard', [TherapistController::class, 'dashboard'])->name('therapist.dashboard');
    Route::get('/patients', [TherapistController::class, 'patients'])->name('therapist.patients');
    Route::get('/schedule', [TherapistController::class, 'schedule'])->name('therapist.schedule');
    Route::get('/invoices', [TherapistController::class, 'invoices'])->name('therapist.invoices');
    Route::get('/settings', [TherapistController::class, 'settings'])->name('therapist.settings');
    Route::post('/settings', [TherapistController::class, 'updateSettings'])->name('therapist.settings.update');
    Route::post('/settings/medical-document', [TherapistController::class, 'uploadMedicalDocument'])->name('therapist.settings.medical_document');
    Route::post('/booking/{id}/status', [TherapistController::class, 'updateBookingStatus'])->name('therapist.booking.status');
});

// Admin Portal Routes (Strictly Admin Only)
Route::prefix('admin')->middleware([\App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/qris', [AdminQrisController::class, 'index'])->name('admin.qris');
    Route::post('/qris', [AdminQrisController::class, 'update'])->name('admin.qris.update');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/verifications', [AdminDashboardController::class, 'verifications'])->name('admin.verifications');
    Route::get('/payments', [AdminDashboardController::class, 'payments'])->name('admin.payments');
    Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('admin.reports');
    Route::post('/verify/{id}', [AdminDashboardController::class, 'verifyTherapist'])->name('admin.verify');

    // Admin Herbal Product CRUD & Order Manager
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names('admin.products');
    Route::get('/product-orders', [\App\Http\Controllers\Admin\ProductController::class, 'orders'])->name('admin.products.orders');
    Route::post('/product-orders/{id}/status', [\App\Http\Controllers\Admin\ProductController::class, 'updateOrderStatus'])->name('admin.products.order_status');

    // Admin Offline Clinic CRUD
    Route::resource('clinics', \App\Http\Controllers\Admin\ClinicController::class)->names('admin.clinics');

    // Admin SIK Medical Documents Verification
    Route::get('/medical-documents', [\App\Http\Controllers\Admin\DashboardController::class, 'medicalDocuments'])->name('admin.medical_documents.index');
    Route::post('/medical-documents/{id}/verify', [\App\Http\Controllers\Admin\DashboardController::class, 'verifyMedicalDocument'])->name('admin.medical_documents.verify');
    Route::post('/medical-documents/{id}/reject', [\App\Http\Controllers\Admin\DashboardController::class, 'rejectMedicalDocument'])->name('admin.medical_documents.reject');
});
