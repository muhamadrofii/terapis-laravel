# Sistem Pelayanan Terapis Online - PRD

## Fitur Utama

### 1. Pasien
- Registrasi dan login
- Kelola profil
- Mencari dan memilih terapis
- Melihat profil, spesialisasi, jadwal, dan tarif terapis
- Booking jadwal konsultasi
- Pembayaran
- Konsultasi online melalui chat wa
- Melihat riwayat konsultasi
- Memberikan rating dan ulasan

### 2. Terapis
- Registrasi dan login
- Kelola profil dan spesialisasi
- Mengatur jadwal konsultasi
- Menerima atau menolak booking
- Melakukan konsultasi online
- Melihat riwayat pasien dan konsultasi

### 3. Admin
- Mengelola data pasien dan terapis
- Memverifikasi terapis
- Mengelola jadwal dan layanan
- Memverifikasi pembayaran
- Mengelola booking
- Melihat laporan dan statistik sistem

## Laravel Technical Implementation Features
- **Authentication & Authorization**: Using Laravel Breeze/Fortify for multi-auth (Patient, Therapist, Admin).
- **Database Management**: Eloquent ORM for relationship handling between patients, sessions, and payments.
- **Real-time Notifications**: Laravel Echo & Pusher for instant booking updates and session reminders.
- **Payment Integration**: Midtrans or Stripe integration via Laravel packages.
- **API Security**: Laravel Sanctum for secure communication.
- **Storage**: Laravel Filesystem for medical record and profile photo management.