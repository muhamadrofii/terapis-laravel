<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TherapistVerification;
use App\Models\BookingActivity;
use App\Models\Booking;
use App\Models\Review;
use App\Models\QrisSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with comprehensive, rich data.
     */
    public function run(): void
    {
        // 1. QRIS Merchant Default Setting
        QrisSetting::create([
            'merchant_name' => 'Terapis Online Indonesia',
            'merchant_city' => 'Jakarta Selatan',
            'provider_name' => 'QRIS Dinamis Bank / E-Wallet',
            'static_payload' => '00020101021226680016ID.CO.QRIS.WWW01189360091400000000000215ID10200210352520303UME51440014ID.CO.QRIS.WWW02150000000000000005204581253033605802ID5924Terapis Online Indonesia6015Jakarta Selatan6304',
        ]);

        // 2. Admin User
        $admin = User::create([
            'name' => 'Admin Utama Terapis Online',
            'email' => 'admin@terapis.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+62 811-9988-7766',
            'specialty' => 'Administrator System',
        ]);

        // 3. Therapists Data (8 Terapis)
        $therapist1 = User::create([
            'name' => 'Dr. Sarah Jenkins, Ph.D.',
            'email' => 'sarah.jenkins@terapis.com',
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-1111-2222',
            'specialty' => 'Kecemasan, Depresi, Trauma',
            'avatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.9',
            'price' => 'Rp 350.000',
            'bio' => 'Psikolog klinis terverifikasi dengan pengalaman lebih dari 12 tahun mengkhususkan diri dalam terapi perilaku kognitif (CBT), pengelolaan kecemasan, dan trauma.',
        ]);

        $therapist2 = User::create([
            'name' => 'Mark Davis, M.Psi',
            'email' => 'therapist@terapis.com', // Primary login therapist
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-3333-4444',
            'specialty' => 'Keluarga, Trauma, Konseling Pasangan',
            'avatar' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.8',
            'price' => 'Rp 280.000',
            'bio' => 'Konselor keluarga lisensi utama dengan pengalaman 10+ tahun dalam membantu memulihkan komunikasi keluarga dan resolusi konflik pasangan.',
        ]);

        $therapist3 = User::create([
            'name' => 'Dr. Elena Rostova, Sp.KJ',
            'email' => 'elena.rostova@terapis.com',
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-5555-6666',
            'specialty' => 'Kecemasan, Stres Berat, Depresi',
            'avatar' => 'https://images.unsplash.com/photo-1594824813566-88855ce7890b?w=500&auto=format&fit=crop&q=80',
            'rating' => '5.0',
            'price' => 'Rp 450.000',
            'bio' => 'Psikiater spesialis dalam penanganan gangguan emosi berat, manajemen stres profesional, serta pengobatan medis holistik.',
        ]);

        $therapist4 = User::create([
            'name' => 'Dr. Emily Stanton, Sp.A',
            'email' => 'emily.stanton@terapis.com',
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-7777-8888',
            'specialty' => 'Psikologi Anak & Remaja, ADHD',
            'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.7',
            'price' => 'Rp 300.000',
            'bio' => 'Spesialis kesehatan mental anak dan tumbuh kembang remaja dengan pendekatan permainan edukatif dan konseling orang tua.',
        ]);

        $therapist5 = User::create([
            'name' => 'Dr. Aris Kusuma, M.Psi',
            'email' => 'aris.kusuma@terapis.com',
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-8888-9999',
            'specialty' => 'Karir, Burnout, Stres Pekerjaan',
            'avatar' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.9',
            'price' => 'Rp 320.000',
            'bio' => 'Konselor psikologi karir berpengalaman mendampingi karyawan dan profesional muda menghadapi kelelahan kerja (burnout).',
        ]);

        $therapist6 = User::create([
            'name' => 'Dr. Maya Putri, M.Psi',
            'email' => 'maya.putri@terapis.com',
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-9999-0000',
            'specialty' => 'Hubungan, Konseling Pasangan, Komunikasi',
            'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.8',
            'price' => 'Rp 290.000',
            'bio' => 'Pakar konseling hubungan interpersonal dan komunikasi intim bagi pasangan dan individu.',
        ]);

        $therapist7 = User::create([
            'name' => 'Dr. Budi Hermawan, Sp.KJ',
            'email' => 'budi.hermawan@terapis.com',
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-1010-2020',
            'specialty' => 'Trauma, PTSD, Kecemasan Akut',
            'avatar' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.9',
            'price' => 'Rp 400.000',
            'bio' => 'Psikiater trauma spesialis pemulihan luka batin, trauma masa kecil, dan PTSD.',
        ]);

        $therapist8 = User::create([
            'name' => 'Dr. Jessica Tan, Ph.D.',
            'email' => 'jessica.tan@terapis.com',
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-3030-4040',
            'specialty' => 'Depresi, Kecemasan, Emosi',
            'avatar' => 'https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?w=500&auto=format&fit=crop&q=80',
            'rating' => '5.0',
            'price' => 'Rp 360.000',
            'bio' => 'Dokter lulusan luar negeri dengan keahlian khusus pada penanganan depresi berkepanjangan.',
        ]);

        // 4. Patients Data (Users)
        $patientsData = [
            ['name' => 'Sarah Jenkins', 'email' => 'user@terapis.com', 'phone' => '+62 812-3456-7890'],
            ['name' => 'Michael T. Wicaksono', 'email' => 'michael.w@terapis.com', 'phone' => '+62 813-1111-2222'],
            ['name' => 'Emily Rahmawati', 'email' => 'emily.rahma@terapis.com', 'phone' => '+62 813-2222-3333'],
            ['name' => 'Marcus Reed', 'email' => 'marcus.reed@terapis.com', 'phone' => '+62 813-3333-4444'],
            ['name' => 'David Chen Prabowo', 'email' => 'david.chen@terapis.com', 'phone' => '+62 813-4444-5555'],
            ['name' => 'Linda Parker Rahayu', 'email' => 'linda.parker@terapis.com', 'phone' => '+62 813-5555-6666'],
            ['name' => 'Budi Santoso', 'email' => 'budi.santoso@terapis.com', 'phone' => '+62 813-6666-7777'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti.nur@terapis.com', 'phone' => '+62 813-7777-8888'],
            ['name' => 'Rian Hidayat', 'email' => 'rian.hidayat@terapis.com', 'phone' => '+62 813-8888-9999'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi.lestari@terapis.com', 'phone' => '+62 813-9999-0000'],
        ];

        $patientModels = [];
        foreach ($patientsData as $p) {
            $patientModels[] = User::create([
                'name' => $p['name'],
                'email' => $p['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => $p['phone'],
            ]);
        }

        // 5. Therapist Verifications
        TherapistVerification::create([
            'user_id' => $therapist1->id,
            'therapist_name' => $therapist1->name,
            'specialty' => $therapist1->specialty,
            'license_number' => 'SIP-PSI-2024-1042',
            'status' => 'verified',
        ]);

        TherapistVerification::create([
            'user_id' => $therapist2->id,
            'therapist_name' => $therapist2->name,
            'specialty' => $therapist2->specialty,
            'license_number' => 'SIP-PSI-2024-2088',
            'status' => 'verified',
        ]);

        TherapistVerification::create([
            'user_id' => $therapist3->id,
            'therapist_name' => $therapist3->name,
            'specialty' => $therapist3->specialty,
            'license_number' => 'SIP-SPKJ-2024-3011',
            'status' => 'verified',
        ]);

        TherapistVerification::create([
            'user_id' => $therapist4->id,
            'therapist_name' => $therapist4->name,
            'specialty' => $therapist4->specialty,
            'license_number' => 'SIP-SPA-2024-4099',
            'status' => 'pending',
        ]);

        // 6. Bookings (Transaksi Pembayaran QRIS)
        $bookingsData = [
            [
                'user_id' => $patientModels[0]->id,
                'therapist_id' => $therapist1->id,
                'therapist_name' => $therapist1->name,
                'patient_name' => $patientModels[0]->name,
                'session_type' => 'Terapi Perilaku Kognitif (CBT)',
                'booking_date' => now()->toDateString(),
                'booking_time' => '10:00 WIB',
                'status' => 'accepted',
                'payment_status' => 'paid',
                'notes' => 'Mengalami rasa cemas berlebih saat menghadapi presentasi kantor.',
                'price' => 'Rp 350.000',
                'whatsapp_number' => '6281234567890',
            ],
            [
                'user_id' => $patientModels[1]->id,
                'therapist_id' => $therapist2->id,
                'therapist_name' => $therapist2->name,
                'patient_name' => $patientModels[1]->name,
                'session_type' => 'Konsultasi Pasangan & Keluarga',
                'booking_date' => now()->addDays(1)->toDateString(),
                'booking_time' => '14:00 WIB',
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'notes' => 'Diskusi perbaikan pola komunikasi suami istri.',
                'price' => 'Rp 280.000',
                'whatsapp_number' => '6281311112222',
            ],
            [
                'user_id' => $patientModels[2]->id,
                'therapist_id' => $therapist3->id,
                'therapist_name' => $therapist3->name,
                'patient_name' => $patientModels[2]->name,
                'session_type' => 'Konsultasi Psikiatri & Stres',
                'booking_date' => now()->addDays(2)->toDateString(),
                'booking_time' => '11:00 WIB',
                'status' => 'accepted',
                'payment_status' => 'paid',
                'notes' => 'Insomnia dan kelelahan mental berkelanjutan.',
                'price' => 'Rp 450.000',
                'whatsapp_number' => '6281322223333',
            ],
            [
                'user_id' => $patientModels[3]->id,
                'therapist_id' => $therapist2->id,
                'therapist_name' => $therapist2->name,
                'patient_name' => $patientModels[3]->name,
                'session_type' => 'Terapi Pemulihan Trauma',
                'booking_date' => now()->subDays(2)->toDateString(),
                'booking_time' => '16:00 WIB',
                'status' => 'completed',
                'payment_status' => 'paid',
                'notes' => 'Evaluasi hasil latihan manajemen emosi bulanan.',
                'price' => 'Rp 280.000',
                'whatsapp_number' => '6281333334444',
            ],
            [
                'user_id' => $patientModels[4]->id,
                'therapist_id' => $therapist5->id,
                'therapist_name' => $therapist5->name,
                'patient_name' => $patientModels[4]->name,
                'session_type' => 'Konsultasi Burnout Karir',
                'booking_date' => now()->subDays(5)->toDateString(),
                'booking_time' => '13:00 WIB',
                'status' => 'completed',
                'payment_status' => 'paid',
                'notes' => 'Konsultasi transisi karir dan pencegahan kecemasan.',
                'price' => 'Rp 320.000',
                'whatsapp_number' => '6281344445555',
            ]
        ];

        foreach ($bookingsData as $b) {
            Booking::create($b);
        }

        // 7. Reviews
        Review::create([
            'user_id' => $patientModels[0]->id,
            'therapist_id' => $therapist1->id,
            'rating' => 5,
            'comment' => 'Dr. Sarah sangat perhatian dan teknik breathing exercise-nya sangat membantu saya mengatasi serangan cemas.',
        ]);

        Review::create([
            'user_id' => $patientModels[1]->id,
            'therapist_id' => $therapist2->id,
            'rating' => 5,
            'comment' => 'Penjelasan Pak Mark Davis dalam sesi konseling pasangan sangat menyejukkan dan praktis.',
        ]);

        Review::create([
            'user_id' => $patientModels[2]->id,
            'therapist_id' => $therapist3->id,
            'rating' => 5,
            'comment' => 'Sangat profesional. Dr. Elena paham betul diagnosa stres dan memberikan arahan medis yang jelas.',
        ]);
    }
}
