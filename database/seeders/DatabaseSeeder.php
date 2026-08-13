<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TherapistVerification;
use App\Models\BookingActivity;
use App\Models\Booking;
use App\Models\Review;
use App\Models\QrisSetting;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Message;
use App\Models\Clinic;
use App\Models\MedicalDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with comprehensive, rich data.
     */
    public function run(): void
    {
        // 1. QRIS Merchant & Bank Account Default Setting
        $qrisPayloadSample = '00020101021226680016ID.CO.QRIS.WWW01189360091400000000000215ID10200210352520303UME51440014ID.CO.QRIS.WWW02150000000000000005204581253033605802ID5924Terapis Online Indonesia6015Jakarta Selatan6304';

        QrisSetting::create([
            'merchant_name' => 'Terapis Online Indonesia',
            'merchant_city' => 'Jakarta Selatan',
            'provider_name' => 'QRIS Dinamis Bank / E-Wallet',
            'qris_image' => 'qris/sample_qris.png',
            'bank_name' => 'Bank Central Asia (BCA)',
            'bank_account_number' => '8830991204',
            'bank_account_holder' => 'PT Terapis Online Indonesia',
            'static_payload' => $qrisPayloadSample,
        ]);

        // 2. Admin User
        $admin = User::create([
            'name' => 'Admin Utama Terapis Online',
            'email' => 'admin@terapis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+62 811-9988-7766',
            'specialty' => 'Administrator System',
        ]);

        // 3. Therapists Data (8 Terapis)
        $therapist1 = User::create([
            'name' => 'Dr. Sarah Jenkins, Ph.D.',
            'email' => 'sarah.jenkins@terapis.com',
            'email_verified_at' => now(),
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
            'name' => 'Dr. Julian Vance',
            'email' => 'therapist@terapis.com', // Primary login therapist
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-3333-4444',
            'specialty' => 'Clinical Psychologist',
            'avatar' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.8',
            'price' => 'Rp 350.000',
            'bio' => 'Terapis lisensi terverifikasi dengan pengalaman lebih dari 10 tahun yang mengkhususkan diri dalam terapi perilaku kognitif, pengelolaan kecemasan, dan teknik mindfulness.',
        ]);

        $therapist3 = User::create([
            'name' => 'Dr. Elena Rostova, Sp.KJ',
            'email' => 'elena.rostova@terapis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-5555-6666',
            'specialty' => 'Kecemasan, Stres Berat, Depresi',
            'avatar' => 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?w=500&auto=format&fit=crop&q=80',
            'rating' => '5.0',
            'price' => 'Rp 450.000',
            'bio' => 'Psikiater spesialis dalam penanganan gangguan emosi berat, manajemen stres profesional, serta pengobatan medis holistik.',
        ]);

        $therapist4 = User::create([
            'name' => 'Dr. Emily Stanton, Sp.A',
            'email' => 'emily.stanton@terapis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-7777-8888',
            'specialty' => 'Psikologi Anak & Remaja, ADHD',
            'avatar' => 'https://images.unsplash.com/photo-1614608682850-e0d6ed316d47?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.7',
            'price' => 'Rp 300.000',
            'bio' => 'Spesialis kesehatan mental child and adolescent dengan pendekatan play therapy dan konseling keluarga.',
        ]);

        $therapist5 = User::create([
            'name' => 'Dr. Aris Kusuma, M.Psi',
            'email' => 'aris.kusuma@terapis.com',
            'email_verified_at' => now(),
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
            'email_verified_at' => now(),
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
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-1010-2020',
            'specialty' => 'Trauma, PTSD, Kecemasan Akut',
            'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=500&auto=format&fit=crop&q=80',
            'rating' => '4.9',
            'price' => 'Rp 400.000',
            'bio' => 'Psikiater trauma spesialis pemulihan luka batin, trauma masa kecil, dan PTSD.',
        ]);

        $therapist8 = User::create([
            'name' => 'Dr. Jessica Tan, Ph.D.',
            'email' => 'jessica.tan@terapis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'therapist',
            'phone' => '+62 812-3030-4040',
            'specialty' => 'Depresi, Kecemasan, Emosi',
            'avatar' => 'https://images.unsplash.com/photo-1598550874175-4d0ef436c909?w=500&auto=format&fit=crop&q=80',
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
                'email_verified_at' => now(),
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

        TherapistVerification::create([
            'user_id' => $therapist5->id,
            'therapist_name' => $therapist5->name,
            'specialty' => $therapist5->specialty,
            'license_number' => 'SIP-PSI-2024-5055',
            'status' => 'verified',
        ]);

        TherapistVerification::create([
            'user_id' => $therapist6->id,
            'therapist_name' => $therapist6->name,
            'specialty' => $therapist6->specialty,
            'license_number' => 'SIP-PSI-2024-6012',
            'status' => 'verified',
        ]);

        // 6. Bookings (Transaksi Pembayaran QRIS)
        $booking1 = Booking::create([
            'user_id' => $patientModels[0]->id,
            'therapist_id' => $therapist1->id,
            'therapist_name' => $therapist1->name,
            'patient_name' => $patientModels[0]->name,
            'session_type' => 'Terapi Perilaku Kognitif (CBT)',
            'booking_date' => now()->toDateString(),
            'booking_time' => '10:00 WIB',
            'status' => 'accepted',
            'payment_status' => 'paid',
            'payment_proof' => 'payment_proofs/proof_b1.jpg',
            'qris_payload' => $qrisPayloadSample,
            'notes' => 'Mengalami rasa cemas berlebih saat menghadapi presentasi kantor.',
            'price' => 'Rp 350.000',
            'whatsapp_number' => '6281234567890',
        ]);

        $booking2 = Booking::create([
            'user_id' => $patientModels[1]->id,
            'therapist_id' => $therapist2->id,
            'therapist_name' => $therapist2->name,
            'patient_name' => $patientModels[1]->name,
            'session_type' => 'Konsultasi Pasangan & Keluarga',
            'booking_date' => now()->addDays(1)->toDateString(),
            'booking_time' => '14:00 WIB',
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_proof' => null,
            'qris_payload' => $qrisPayloadSample,
            'notes' => 'Diskusi perbaikan pola komunikasi suami istri.',
            'price' => 'Rp 280.000',
            'whatsapp_number' => '6281311112222',
        ]);

        $booking3 = Booking::create([
            'user_id' => $patientModels[2]->id,
            'therapist_id' => $therapist3->id,
            'therapist_name' => $therapist3->name,
            'patient_name' => $patientModels[2]->name,
            'session_type' => 'Konsultasi Psikiatri & Stres',
            'booking_date' => now()->addDays(2)->toDateString(),
            'booking_time' => '11:00 WIB',
            'status' => 'accepted',
            'payment_status' => 'paid',
            'payment_proof' => 'payment_proofs/proof_b3.jpg',
            'qris_payload' => $qrisPayloadSample,
            'notes' => 'Insomnia dan kelelahan mental berkelanjutan.',
            'price' => 'Rp 450.000',
            'whatsapp_number' => '6281322223333',
        ]);

        $booking4 = Booking::create([
            'user_id' => $patientModels[3]->id,
            'therapist_id' => $therapist2->id,
            'therapist_name' => $therapist2->name,
            'patient_name' => $patientModels[3]->name,
            'session_type' => 'Terapi Pemulihan Trauma',
            'booking_date' => now()->subDays(2)->toDateString(),
            'booking_time' => '16:00 WIB',
            'status' => 'completed',
            'payment_status' => 'paid',
            'payment_proof' => 'payment_proofs/proof_b4.jpg',
            'qris_payload' => $qrisPayloadSample,
            'notes' => 'Evaluasi hasil latihan manajemen emosi bulanan.',
            'price' => 'Rp 280.000',
            'whatsapp_number' => '6281333334444',
        ]);

        $booking5 = Booking::create([
            'user_id' => $patientModels[4]->id,
            'therapist_id' => $therapist5->id,
            'therapist_name' => $therapist5->name,
            'patient_name' => $patientModels[4]->name,
            'session_type' => 'Konsultasi Burnout Karir',
            'booking_date' => now()->subDays(5)->toDateString(),
            'booking_time' => '13:00 WIB',
            'status' => 'completed',
            'payment_status' => 'paid',
            'payment_proof' => 'payment_proofs/proof_b5.jpg',
            'qris_payload' => $qrisPayloadSample,
            'notes' => 'Konsultasi transisi karir dan pencegahan kecemasan.',
            'price' => 'Rp 320.000',
            'whatsapp_number' => '6281344445555',
        ]);

        // 7. Booking Activities Log
        BookingActivity::create([
            'patient_name' => $patientModels[0]->name,
            'action' => 'Melakukan janji sesi Terapi Perilaku Kognitif (CBT)',
            'status' => 'accepted',
            'activity_time' => '10 menit yang lalu',
        ]);

        BookingActivity::create([
            'patient_name' => $patientModels[1]->name,
            'action' => 'Mengunggah konfirmasi reservasi konseling',
            'status' => 'pending',
            'activity_time' => '35 menit yang lalu',
        ]);

        BookingActivity::create([
            'patient_name' => $patientModels[2]->name,
            'action' => 'Pembayaran via QRIS berhasil diverifikasi',
            'status' => 'accepted',
            'activity_time' => '1 jam yang lalu',
        ]);

        BookingActivity::create([
            'patient_name' => $patientModels[3]->name,
            'action' => 'Menyelesaikan sesi Terapi Pemulihan Trauma',
            'status' => 'completed',
            'activity_time' => '2 hari yang lalu',
        ]);

        BookingActivity::create([
            'patient_name' => $patientModels[4]->name,
            'action' => 'Sesi Konsultasi Burnout Karir selesai',
            'status' => 'completed',
            'activity_time' => '5 hari yang lalu',
        ]);

        // 8. Reviews
        Review::create([
            'user_id' => $patientModels[0]->id,
            'therapist_id' => $therapist1->id,
            'booking_id' => $booking1->id,
            'rating' => 5,
            'comment' => 'Dr. Sarah sangat perhatian dan teknik breathing exercise-nya sangat membantu saya mengatasi serangan cemas.',
        ]);

        Review::create([
            'user_id' => $patientModels[1]->id,
            'therapist_id' => $therapist2->id,
            'booking_id' => $booking2->id,
            'rating' => 5,
            'comment' => 'Penjelasan Dr. Julian Vance dalam sesi konseling sangat menyejukkan dan praktis.',
        ]);

        Review::create([
            'user_id' => $patientModels[2]->id,
            'therapist_id' => $therapist3->id,
            'booking_id' => $booking3->id,
            'rating' => 5,
            'comment' => 'Sangat profesional. Dr. Elena paham betul diagnosa stres dan memberikan arahan medis yang jelas.',
        ]);

        Review::create([
            'user_id' => $patientModels[3]->id,
            'therapist_id' => $therapist2->id,
            'booking_id' => $booking4->id,
            'rating' => 5,
            'comment' => 'Sesi pemulihan trauma bersama Dr. Julian sangat membuka wawasan dan menenangkan.',
        ]);

        // 9. Messages / Chat System
        Message::create([
            'booking_id' => $booking1->id,
            'sender_id' => $patientModels[0]->id,
            'sender_name' => $patientModels[0]->name,
            'receiver_id' => $therapist1->id,
            'message' => 'Halo Dok, saya sudah mentransfer pembayaran booking untuk sesi CBT.',
        ]);

        Message::create([
            'booking_id' => $booking1->id,
            'sender_id' => $therapist1->id,
            'sender_name' => $therapist1->name,
            'receiver_id' => $patientModels[0]->id,
            'message' => 'Halo Sarah, konfirmasi pembayaran sudah diterima. Terima kasih, sampai bertemu di sesi jam 10:00 WIB.',
        ]);

        Message::create([
            'booking_id' => $booking1->id,
            'sender_id' => $patientModels[0]->id,
            'sender_name' => $patientModels[0]->name,
            'receiver_id' => $therapist1->id,
            'message' => 'Baik Dok, terima kasih banyak!',
        ]);

        Message::create([
            'booking_id' => $booking3->id,
            'sender_id' => $patientModels[2]->id,
            'sender_name' => $patientModels[2]->name,
            'receiver_id' => $therapist3->id,
            'message' => 'Selamat siang Dr. Elena, apakah ada dokumen awal yang perlu saya isi sebelum konsuiltasi lusa?',
        ]);

        Message::create([
            'booking_id' => $booking3->id,
            'sender_id' => $therapist3->id,
            'sender_name' => $therapist3->name,
            'receiver_id' => $patientModels[2]->id,
            'message' => 'Selamat siang, cukup persiapkan riwayat keluhan tidur dan catatan kecemasan singkat jika ada.',
        ]);

        // 10. Herbal Products (Mockup Matching)
        $product1 = Product::create([
            'name' => 'Ashwagandha Calm Drops',
            'slug' => 'ashwagandha-calm-drops',
            'description' => 'A potent adaptogenic tincture designed to lower cortisol levels and promote a sense of deep relaxation throughout your day.',
            'category' => 'Stress Relief',
            'price' => 510000,
            'price_usd' => 34.00,
            'image' => 'https://images.unsplash.com/photo-1617897903246-719242758050?w=500&auto=format&fit=crop&q=80',
            'is_bestseller' => true,
        ]);

        $product2 = Product::create([
            'name' => 'Chamomile Dream Tea',
            'slug' => 'chamomile-dream-tea',
            'description' => 'Organic whole-flower chamomile blend to ease anxiety and prepare the mind for restorative sleep.',
            'category' => 'Better Sleep',
            'price' => 277500,
            'price_usd' => 18.50,
            'image' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?w=500&auto=format&fit=crop&q=80',
            'is_bestseller' => false,
        ]);

        $product3 = Product::create([
            'name' => 'L-Theanine Focus',
            'slug' => 'l-theanine-focus',
            'description' => 'Amino acid supplement derived from green tea to support focused attention without the jitters.',
            'category' => 'Mental Clarity',
            'price' => 420000,
            'price_usd' => 28.00,
            'image' => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?w=500&auto=format&fit=crop&q=80',
            'is_bestseller' => false,
        ]);

        $product4 = Product::create([
            'name' => 'Magnesium Sleep Rub',
            'slug' => 'magnesium-sleep-rub',
            'description' => 'Topical magnesium blended with essential oils to relax muscles and calm the nervous system before bed.',
            'category' => 'Better Sleep',
            'price' => 330000,
            'price_usd' => 22.00,
            'image' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=500&auto=format&fit=crop&q=80',
            'is_bestseller' => false,
        ]);

        $product5 = Product::create([
            'name' => 'Rhodiola Energy Gummies',
            'slug' => 'rhodiola-energy-gummies',
            'description' => 'A gentle, herbal boost to combat fatigue and improve mental resilience during stressful periods.',
            'category' => 'Stress Relief',
            'price' => 367500,
            'price_usd' => 24.50,
            'image' => 'https://images.unsplash.com/photo-1550572017-edd951b55104?w=500&auto=format&fit=crop&q=80',
            'is_bestseller' => false,
        ]);

        // 11. Product Orders
        ProductOrder::create([
            'user_id' => $patientModels[0]->id,
            'product_id' => $product1->id,
            'quantity' => 2,
            'total_price' => 1020000,
            'status' => 'completed',
            'payment_status' => 'paid',
            'payment_proof' => 'product_payments/proof_p1.jpg',
            'shipping_address' => 'Jl. Jendral Sudirman No. 45, Kav 10-11, Jakarta Selatan, 12190',
            'whatsapp_number' => '6281234567890',
            'notes' => 'Harap dikemas dengan bubble wrap tebal.',
        ]);

        ProductOrder::create([
            'user_id' => $patientModels[1]->id,
            'product_id' => $product2->id,
            'quantity' => 1,
            'total_price' => 277500,
            'status' => 'accepted',
            'payment_status' => 'paid',
            'payment_proof' => 'product_payments/proof_p2.jpg',
            'shipping_address' => 'Jl. Dago No. 102, Bandung, Jawa Barat',
            'whatsapp_number' => '6281311112222',
            'notes' => 'Pengiriman via kurir kilat.',
        ]);

        ProductOrder::create([
            'user_id' => $patientModels[2]->id,
            'product_id' => $product3->id,
            'quantity' => 1,
            'total_price' => 420000,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_proof' => null,
            'shipping_address' => 'Jl. Pemuda No. 88, Surabaya, Jawa Timur',
            'whatsapp_number' => '6281322223333',
            'notes' => 'Tolong infokan resi jika sudah dikirim.',
        ]);

        // 12. Offline Clinics (Mockup Matching)
        Clinic::create([
            'name' => 'Downtown Serenity Center',
            'address' => '124 Wellness Ave, Suite 300',
            'distance' => '2.4 mi',
            'hours' => 'Until 8:00 PM',
            'is_open' => true,
            'latitude' => 47.6205,
            'longitude' => -122.3493,
            'phone' => '+62 811-9988-7766',
        ]);

        Clinic::create([
            'name' => 'Westside Behavioral Health',
            'address' => '892 Calm Blvd',
            'distance' => '4.1 mi',
            'hours' => 'Opens Tomorrow 9 AM',
            'is_open' => false,
            'latitude' => 47.6062,
            'longitude' => -122.3321,
            'phone' => '+62 811-9988-7766',
        ]);

        Clinic::create([
            'name' => 'North Hills Therapy',
            'address' => '550 Pine Lane, Bldg B',
            'distance' => '6.8 mi',
            'hours' => 'Until 6:00 PM',
            'is_open' => true,
            'latitude' => 47.6553,
            'longitude' => -122.3035,
            'phone' => '+62 811-9988-7766',
        ]);

        // 13. Medical Documents for Therapists
        MedicalDocument::create([
            'user_id' => $therapist2->id,
            'file_name' => 'SIK_Vance_2023.pdf',
            'file_path' => 'documents/SIK_Vance_2023.pdf',
            'status' => 'verified',
            'created_at' => now()->subDays(300),
        ]);

        MedicalDocument::create([
            'user_id' => $therapist2->id,
            'file_name' => 'SIK_Renewal_2024.pdf',
            'file_path' => 'documents/SIK_Renewal_2024.pdf',
            'status' => 'pending',
            'created_at' => now(),
        ]);

        MedicalDocument::create([
            'user_id' => $therapist2->id,
            'file_name' => 'Draft_SIK_2022.jpg',
            'file_path' => 'documents/Draft_SIK_2022.jpg',
            'status' => 'rejected',
            'created_at' => now()->subDays(800),
        ]);

        MedicalDocument::create([
            'user_id' => $therapist1->id,
            'file_name' => 'STR_Jenkins_2024.pdf',
            'file_path' => 'documents/STR_Jenkins_2024.pdf',
            'status' => 'verified',
            'created_at' => now()->subDays(150),
        ]);
    }
}

