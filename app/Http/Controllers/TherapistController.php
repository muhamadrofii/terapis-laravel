<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TherapistController extends Controller
{
    /**
     * Display Therapist Dashboard.
     */
    public function dashboard()
    {
        $therapistUser = Auth::user();
        $therapistName = $therapistUser ? $therapistUser->name : 'Terapis';

        $query = Booking::query();
        if ($therapistUser) {
            $firstName = explode(' ', $therapistUser->name)[0];
            $query->where(function($q) use ($therapistUser, $firstName) {
                $q->where('therapist_id', $therapistUser->id)
                  ->orWhere('therapist_name', 'like', '%' . $firstName . '%');
            });
        }

        $nextSession = (clone $query)->whereIn('status', ['accepted', 'pending'])
            ->orderBy('booking_date', 'asc')
            ->first();

        $pendingBookings = (clone $query)->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $todaySchedule = (clone $query)->orderBy('booking_time', 'asc')->get();

        return view('therapist.dashboard', compact('therapistName', 'nextSession', 'pendingBookings', 'todaySchedule'));
    }

    /**
     * Display Therapist Public Profile & Interactive Booking Page.
     */
    public function show($id)
    {
        $therapist = User::where('role', 'therapist')->find($id);

        if (!$therapist) {
            $firstTherapist = User::where('role', 'therapist')->first();
            $firstUuid = $firstTherapist ? $firstTherapist->id : null;

            if ($id == 2 || $id === '2') {
                $therapist = (object) [
                    'id' => $firstUuid,
                    'name' => 'Mark Davis, M.Psi',
                    'title' => 'Konselor Keluarga',
                    'specialty' => 'Keluarga, Trauma',
                    'avatar' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=500&auto=format&fit=crop&q=80',
                    'rating' => '4.8',
                    'reviews_count' => 85,
                    'experience' => '10+ Tahun Pengalaman',
                    'price' => 'Rp 280.000',
                    'bio' => 'Mark Davis adalah konselor keluarga terlisensi dengan pengalaman lebih dari 10 tahun mendampingi hubungan keluarga & pemulihan trauma.',
                ];
            } elseif ($id == 3 || $id === '3') {
                $therapist = (object) [
                    'id' => $firstUuid,
                    'name' => 'Dr. Elena Rostova, Sp.KJ',
                    'title' => 'Psikiater Klinis',
                    'specialty' => 'Kecemasan, Stres',
                    'avatar' => 'https://images.unsplash.com/photo-1594824813566-88855ce7890b?w=500&auto=format&fit=crop&q=80',
                    'rating' => '5.0',
                    'reviews_count' => 200,
                    'experience' => '15+ Tahun Pengalaman',
                    'price' => 'Rp 450.000',
                    'bio' => 'Dr. Elena Rostova adalah psikiater spesialis dalam pengelolaan stres berat, kecemasan akut, serta gangguan mood.',
                ];
            } else {
                $therapist = (object) [
                    'id' => $firstUuid,
                    'name' => 'Dr. Sarah Jenkins, Ph.D.',
                    'title' => 'Psikolog Klinis Utama',
                    'specialty' => 'Kecemasan, Depresi, Trauma',
                    'avatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&auto=format&fit=crop&q=80',
                    'rating' => '4.9',
                    'reviews_count' => 124,
                    'experience' => '12+ Tahun Pengalaman',
                    'price' => 'Rp 350.000',
                    'bio' => 'Dr. Sarah Jenkins adalah psikolog klinis terverifikasi dengan pengalaman lebih dari 12 tahun membantu mengatasi kecemasan dan stres.',
                ];
            }
        }

        return view('therapist.show', compact('therapist'));
    }

    /**
     * Accept or decline a booking request.
     */
    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,declined,completed',
        ]);

        $booking = Booking::find($id);

        if ($booking) {
            $booking->status = $request->status;
            $booking->save();

            $statusText = $request->status === 'accepted' ? 'disetujui' : ($request->status === 'declined' ? 'ditolak' : 'diselesaikan');
            return back()->with('success', "Permintaan booking dari {$booking->patient_name} telah berhasil {$statusText}.");
        }

        return back()->with('error', 'Data booking tidak ditemukan.');
    }

    /**
     * Patient Roster Page (daftar_pasien_serenepath_terapis).
     */
    public function patients()
    {
        $patients = User::where('role', 'user')->get();
        $activeCount = $patients->count();
        $archivedCount = 0;

        return view('therapist.patients', compact('patients', 'activeCount', 'archivedCount'));
    }

    /**
     * Session Schedule Page (jadwal_sesi_serenepath_terapis).
     */
    public function schedule()
    {
        $sessions = Booking::orderBy('booking_date', 'asc')->get();
        return view('therapist.schedule', compact('sessions'));
    }

    /**
     * Invoices & Earnings Page (invoice_pendapatan_serenepath_terapis).
     */
    public function invoices()
    {
        $invoices = Booking::orderBy('created_at', 'desc')->get();
        $totalEarnings = '$12,450.00';
        $pendingPayouts = '$1,200.00';
        $overdueAmount = '$450.00';

        return view('therapist.invoices', compact('invoices', 'totalEarnings', 'pendingPayouts', 'overdueAmount'));
    }

    /**
     * Therapist Account Settings Page (pengaturan_akun_serenepath_terapis).
     */
    public function settings()
    {
        $therapist = Auth::user() ?? (object) [
            'id' => 1,
            'name' => 'Dr. Julian Vance',
            'email' => 'therapist@serenepath.com',
            'specialty' => 'Cognitive Behavioral Therapy (CBT)',
            'bio' => 'Licensed therapist specializing in CBT and anxiety management.',
        ];

        return view('therapist.settings', compact('therapist'));
    }

    /**
     * Update Therapist Profile Settings.
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . ($user ? $user->id : 0),
            'specialty' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('specialty')) {
                $user->specialty = $request->specialty;
            }
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
        }

        return redirect()->back()->with('success', 'Pengaturan profil & praktik terapis berhasil disimpan!');
    }
}
