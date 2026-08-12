<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Patient Dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $userName = $user ? $user->name : 'Sarah Jenkins';

        $upcomingQuery = Booking::where('status', 'accepted');
        $pendingQuery = Booking::where('status', 'pending');
        $pastQuery = Booking::where('status', 'completed');

        if ($user) {
            $filter = function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('patient_name', $user->name);
            };
            $upcomingQuery->where($filter);
            $pendingQuery->where($filter);
            $pastQuery->where($filter);
        }

        $upcomingBookings = $upcomingQuery->orderBy('booking_date', 'asc')->get();
        $pendingBookings = $pendingQuery->orderBy('created_at', 'desc')->get();
        $pastBookings = $pastQuery->orderBy('booking_date', 'desc')->get();

        $therapists = User::where('role', 'therapist')->limit(3)->get();

        $productOrders = [];
        if ($user) {
            $productOrders = \App\Models\ProductOrder::with('product')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('user.dashboard', compact('userName', 'upcomingBookings', 'pendingBookings', 'pastBookings', 'therapists', 'productOrders'));
    }

    public function search(Request $request)
    {
        $therapists = User::where('role', 'therapist')->get();
        $clinics = Clinic::all();

        return view('user.search', compact('therapists', 'clinics'));
    }

    /**
     * My Sessions / Bookings Page (jadwal_saya_serenepath).
     */
    public function sessions()
    {
        $user = Auth::user();

        $query = Booking::query();
        if ($user) {
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('patient_name', $user->name);
            });
        }

        $upcomingSessions = $query->orderBy('created_at', 'desc')->get();

        $awaitingPaymentQuery = Booking::where('payment_status', 'unpaid');
        if ($user) {
            $awaitingPaymentQuery->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('patient_name', $user->name);
            });
        }
        $awaitingPayment = $awaitingPaymentQuery->orderBy('created_at', 'desc')->first();

        return view('user.sessions', compact('upcomingSessions', 'awaitingPayment'));
    }

    /**
     * Payment History & Review Ratings Page (riwayat_pembayaran_serenepath).
     */
    public function payments()
    {
        $user = Auth::user();

        $query = Booking::where('status', 'completed');
        if ($user) {
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('patient_name', $user->name);
            });
        }

        $pastSessions = $query->orderBy('booking_date', 'desc')->get();

        return view('user.payments', compact('pastSessions'));
    }

    /**
     * User Profile Settings Page (pengaturan_profil_serenepath).
     */
    public function settings()
    {
        $user = Auth::user() ?? (object)[
            'id' => 1,
            'name' => 'Sarah Jenkins',
            'email' => 'sarah.j@example.com',
            'phone' => '+62 812-3456-7890',
            'avatar' => null,
        ];

        return view('user.settings', compact('user'));
    }

    /**
     * Update User Profile Settings.
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . ($user ? $user->id : 0),
            'phone' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('phone')) {
                $user->phone = $request->phone;
            }
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
        }

        return redirect()->back()->with('success', 'Pengaturan profil Anda berhasil diperbarui!');
    }
}
