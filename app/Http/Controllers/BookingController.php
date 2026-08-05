<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Services\QrisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Handle booking creation form submission.
     */
    public function store(Request $request)
    {
        $request->validate([
            'therapist_name' => 'required|string',
            'session_type' => 'required|string',
            'booking_date' => 'required|date',
            'booking_time' => 'required|string',
        ]);

        $user = Auth::user();
        $price = $request->price ?? 'Rp 350.000';

        $therapistId = null;
        if ($request->filled('therapist_id') && \Illuminate\Support\Str::isUuid($request->therapist_id)) {
            $existingTherapist = User::where('role', 'therapist')->find($request->therapist_id);
            if ($existingTherapist) {
                $therapistId = $existingTherapist->id;
            }
        }
        if (!$therapistId) {
            $defaultTherapist = User::where('role', 'therapist')->first();
            $therapistId = $defaultTherapist ? $defaultTherapist->id : null;
        }

        $booking = Booking::create([
            'user_id' => $user ? $user->id : null,
            'therapist_id' => $therapistId,
            'therapist_name' => $request->therapist_name,
            'patient_name' => $request->patient_name ?? ($user ? $user->name : 'Patient'),
            'session_type' => $request->session_type,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'notes' => $request->notes ?? 'Booking konsultasi online.',
            'price' => $price,
            'whatsapp_number' => $request->whatsapp_number ?? '6281234567890',
        ]);

        return redirect()->route('booking.pay', $booking->id)->with('success', 'Booking konsultasi berhasil dibuat! Silakan lakukan pembayaran via QRIS Dinamis.');
    }

    /**
     * Show Dynamic QRIS Payment Page for a booking with 100% Synchronized IDR Rupiah Price.
     */
    public function pay($id)
    {
        $booking = Booking::findOrFail($id);

        $priceRaw = $booking->price ?? 'Rp 350.000';
        
        // Remove currency symbols, spaces, dots, and decimals
        $digitsStr = preg_replace('/[^\d]/', '', $priceRaw);
        $digits = !empty($digitsStr) ? (int)$digitsStr : 350000;

        if ($digits < 1000 && $digits > 0) {
            // e.g. 150 or 155 -> 150000 IDR (Rp 150.000), NOT 2 Juta!
            $amountIdr = $digits * 1000;
        } elseif ($digits >= 1000) {
            // e.g. 350000 -> 350000 IDR (Rp 350.000)
            $amountIdr = $digits;
        } else {
            $amountIdr = 350000; // Default Rp 350.000
        }

        // Format clean Rupiah price
        $booking->price = 'Rp ' . number_format($amountIdr, 0, ',', '.');

        // Generate Dynamic QRIS Payload & Scannable Image URL with Synchronized IDR Amount
        $dynamicPayload = QrisService::generateDynamicPayload($amountIdr);
        $qrImageUrl = QrisService::getQrImageUrl($dynamicPayload);

        $booking->qris_payload = $dynamicPayload;
        $booking->save();

        return view('user.pay_qris', compact('booking', 'amountIdr', 'dynamicPayload', 'qrImageUrl'));
    }

    /**
     * Handle payment proof upload.
     */
    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,pdf|max:3072',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('proofs', 'public');
            $booking->payment_proof = 'storage/' . $path;
            $booking->payment_status = 'paid';
            $booking->status = 'accepted';
            $booking->save();
        }

        return redirect()->route('user.sessions')->with('success', 'Bukti pembayaran QRIS berhasil diunggah! Sesi konsultasi Anda telah dikonfirmasi.');
    }

    /**
     * Store patient rating & review in database.
     */
    public function storeReview(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $user = Auth::user();

        \App\Models\Review::create([
            'user_id' => $user ? $user->id : null,
            'therapist_id' => $request->therapist_id ?? null,
            'booking_id' => $request->booking_id ?? null,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan dan rating Anda (' . $request->rating . '/5 Bintang) telah berhasil disimpan ke database.');
    }
}
