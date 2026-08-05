-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: terapis
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `booking_activities`
--

DROP TABLE IF EXISTS `booking_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_activities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'accepted',
  `activity_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_activities`
--

LOCK TABLES `booking_activities` WRITE;
/*!40000 ALTER TABLE `booking_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `therapist_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `therapist_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qris_payload` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Rp 350.000',
  `whatsapp_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_therapist_id_foreign` (`therapist_id`),
  CONSTRAINT `bookings_therapist_id_foreign` FOREIGN KEY (`therapist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES ('30502dde-249c-4123-aee0-d68a3694fa0d','81c9c4f0-d588-49eb-abac-3d93b06233ce','f3a435c6-17c4-4233-aa19-94967388bbfb','Dr. Aris Kusuma, M.Psi','David Chen Prabowo','Konsultasi Burnout Karir','2026-07-31','13:00 WIB','completed','paid',NULL,NULL,'Konsultasi transisi karir dan pencegahan kecemasan.','Rp 320.000','6281344445555','2026-08-04 20:46:15','2026-08-04 20:46:15'),('3505607a-bfa9-486e-97f8-a7de8169721b','bdf8c3da-afbd-4bf0-92d3-60685b93bb67','34a142af-d001-4b7a-8690-12a89889b380','Mark Davis, M.Psi','Marcus Reed','Terapi Pemulihan Trauma','2026-08-03','16:00 WIB','completed','paid',NULL,NULL,'Evaluasi hasil latihan manajemen emosi bulanan.','Rp 280.000','6281333334444','2026-08-04 20:46:15','2026-08-04 20:46:15'),('3ea24854-1529-401b-9b96-6099984a2b71','2c5b2bd4-37ae-4924-85c2-486f1ee32dd6','bc529082-a15b-4283-a841-6628ab8f24cd','Dr. Elena Rostova, Sp.KJ','Emily Rahmawati','Konsultasi Psikiatri & Stres','2026-08-07','11:00 WIB','accepted','paid',NULL,NULL,'Insomnia dan kelelahan mental berkelanjutan.','Rp 450.000','6281322223333','2026-08-04 20:46:15','2026-08-04 20:46:15'),('8b637176-2ef5-4c65-ad7a-980d2786973f','542d6306-8608-420b-8122-2f94634c7393','34a142af-d001-4b7a-8690-12a89889b380','Mark Davis, M.Psi','Michael T. Wicaksono','Konsultasi Pasangan & Keluarga','2026-08-06','14:00 WIB','pending','unpaid',NULL,NULL,'Diskusi perbaikan pola komunikasi suami istri.','Rp 280.000','6281311112222','2026-08-04 20:46:15','2026-08-04 20:46:15'),('9e58f7ce-7d2f-4e0f-9f4f-bfad0c52720c','58f32ed2-d992-4c16-a92e-7e7fee0f1f93','74066d57-8860-4ccf-8193-f5424b03d54c','Dr. Sarah Jenkins, Ph.D.','Sarah Jenkins','Terapi Perilaku Kognitif (CBT)','2026-08-05','10:00 WIB','accepted','paid',NULL,NULL,'Mengalami rasa cemas berlebih saat menghadapi presentasi kantor.','Rp 350.000','6281234567890','2026-08-04 20:46:15','2026-08-04 20:46:15');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_03_000001_create_therapist_verifications_table',1),(5,'2026_08_03_000002_create_booking_activities_table',1),(6,'2026_08_04_000001_create_bookings_table',1),(7,'2026_08_04_000002_create_qris_settings_table',1),(8,'2026_08_05_000001_create_reviews_table',1),(9,'2026_08_05_000002_create_messages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qris_settings`
--

DROP TABLE IF EXISTS `qris_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qris_settings` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SerenePath Mental Health',
  `merchant_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Jakarta',
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GoPay QRIS / All Payment',
  `qris_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `static_payload` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qris_settings`
--

LOCK TABLES `qris_settings` WRITE;
/*!40000 ALTER TABLE `qris_settings` DISABLE KEYS */;
INSERT INTO `qris_settings` VALUES ('6d685a4e-cc13-44c4-9edc-ae50530ffaac','Terapis Online Indonesia','Jakarta Selatan','QRIS Dinamis Bank / E-Wallet',NULL,'00020101021226680016ID.CO.QRIS.WWW01189360091400000000000215ID10200210352520303UME51440014ID.CO.QRIS.WWW02150000000000000005204581253033605802ID5924Terapis Online Indonesia6015Jakarta Selatan6304','2026-08-04 20:46:08','2026-08-04 20:46:08');
/*!40000 ALTER TABLE `qris_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `therapist_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_therapist_id_foreign` (`therapist_id`),
  KEY `reviews_booking_id_foreign` (`booking_id`),
  CONSTRAINT `reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `reviews_therapist_id_foreign` FOREIGN KEY (`therapist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES ('019fd007-6f08-706c-a6a6-bca3c34f3f31','58f32ed2-d992-4c16-a92e-7e7fee0f1f93','74066d57-8860-4ccf-8193-f5424b03d54c',NULL,5,'Dr. Sarah sangat perhatian dan teknik breathing exercise-nya sangat membantu saya mengatasi serangan cemas.','2026-08-04 20:46:15','2026-08-04 20:46:15'),('019fd007-6f0f-71d9-b95f-893498f4caba','542d6306-8608-420b-8122-2f94634c7393','34a142af-d001-4b7a-8690-12a89889b380',NULL,5,'Penjelasan Pak Mark Davis dalam sesi konseling pasangan sangat menyejukkan dan praktis.','2026-08-04 20:46:15','2026-08-04 20:46:15'),('019fd007-6f15-7193-a883-f572a575568a','2c5b2bd4-37ae-4924-85c2-486f1ee32dd6','bc529082-a15b-4283-a841-6628ab8f24cd',NULL,5,'Sangat profesional. Dr. Elena paham betul diagnosa stres dan memberikan arahan medis yang jelas.','2026-08-04 20:46:15','2026-08-04 20:46:15');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('9Sz2fjo4wrDuz5D6impgMVbMuqWPz1d10NbqX2UZ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGFGVHU5dkROTWt6RTVEbjUySGRTbkY2Y1JvSEtjZUdJSEJITVpJdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=',1785901608);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `therapist_verifications`
--

DROP TABLE IF EXISTS `therapist_verifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `therapist_verifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `therapist_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `therapist_verifications_user_id_foreign` (`user_id`),
  CONSTRAINT `therapist_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `therapist_verifications`
--

LOCK TABLES `therapist_verifications` WRITE;
/*!40000 ALTER TABLE `therapist_verifications` DISABLE KEYS */;
INSERT INTO `therapist_verifications` VALUES ('10cc1b78-2215-46c0-a905-b738d397b8f7','0c0c12d3-e1f2-46ef-bd93-16d11972ad95','Dr. Emily Stanton, Sp.A','Psikologi Anak & Remaja, ADHD','SIP-SPA-2024-4099','pending','2026-08-04 20:46:15','2026-08-04 20:46:15'),('498c9ef4-276e-4a39-bcac-ceda9217a36f','bc529082-a15b-4283-a841-6628ab8f24cd','Dr. Elena Rostova, Sp.KJ','Kecemasan, Stres Berat, Depresi','SIP-SPKJ-2024-3011','verified','2026-08-04 20:46:15','2026-08-04 20:46:15'),('4e4d52f5-a0bc-46c3-85af-8fb0e4ecdec1','74066d57-8860-4ccf-8193-f5424b03d54c','Dr. Sarah Jenkins, Ph.D.','Kecemasan, Depresi, Trauma','SIP-PSI-2024-1042','verified','2026-08-04 20:46:15','2026-08-04 20:46:15'),('e3101d75-c672-406f-9dae-4e020e4cfef8','34a142af-d001-4b7a-8690-12a89889b380','Mark Davis, M.Psi','Keluarga, Trauma, Konseling Pasangan','SIP-PSI-2024-2088','verified','2026-08-04 20:46:15','2026-08-04 20:46:15');
/*!40000 ALTER TABLE `therapist_verifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('08639c22-9300-44a7-ab26-6c396d77f37a','Dr. Jessica Tan, Ph.D.','jessica.tan@terapis.com',NULL,'$2y$12$WRafExp1TKbEcUKOySN2oOGnRxYmUc6A/KlYgz1ClBRPTLtJ16Pdy','therapist','Depresi, Kecemasan, Emosi','https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?w=500&auto=format&fit=crop&q=80','5.0','Rp 360.000','Dokter lulusan luar negeri dengan keahlian khusus pada penanganan depresi berkepanjangan.','+62 812-3030-4040',NULL,'2026-08-04 20:46:12','2026-08-04 20:46:12'),('0c0c12d3-e1f2-46ef-bd93-16d11972ad95','Dr. Emily Stanton, Sp.A','emily.stanton@terapis.com',NULL,'$2y$12$tWvQlrPn/dSiqur.AVcsuOMe3QvO4KEz5QrQJkEPKNpPjXU1KnEfu','therapist','Psikologi Anak & Remaja, ADHD','https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500&auto=format&fit=crop&q=80','4.7','Rp 300.000','Spesialis kesehatan mental anak dan tumbuh kembang remaja dengan pendekatan permainan edukatif dan konseling orang tua.','+62 812-7777-8888',NULL,'2026-08-04 20:46:10','2026-08-04 20:46:10'),('2c5b2bd4-37ae-4924-85c2-486f1ee32dd6','Emily Rahmawati','emily.rahma@terapis.com',NULL,'$2y$12$tQ68R.dqjoRofVbK3wm0/.I61tmwC7jXY78ey1UcuPL0g5DPb684.','user',NULL,NULL,NULL,NULL,NULL,'+62 813-2222-3333',NULL,'2026-08-04 20:46:13','2026-08-04 20:46:13'),('34a142af-d001-4b7a-8690-12a89889b380','Mark Davis, M.Psi','therapist@terapis.com',NULL,'$2y$12$JGaZCk1I7GxdwTbnY4c.XulQ8xT5J6KBu0vapag.L9uPwrpw37hhC','therapist','Keluarga, Trauma, Konseling Pasangan','https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=500&auto=format&fit=crop&q=80','4.8','Rp 280.000','Konselor keluarga lisensi utama dengan pengalaman 10+ tahun dalam membantu memulihkan komunikasi keluarga dan resolusi konflik pasangan.','+62 812-3333-4444','6hLpPYbQF9yrUxy3y3UUoBSqO4byIFJHra23n7Bk2PKA7LndD4o84qohB3s4','2026-08-04 20:46:10','2026-08-04 20:46:10'),('42bb206d-320e-4a13-9809-f85f79470712','Dr. Budi Hermawan, Sp.KJ','budi.hermawan@terapis.com',NULL,'$2y$12$4HTBy12wNcgR.Khs..p54em12gWiqKbMPZyndVc5ho299zvRbLxOG','therapist','Trauma, PTSD, Kecemasan Akut','https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=500&auto=format&fit=crop&q=80','4.9','Rp 400.000','Psikiater trauma spesialis pemulihan luka batin, trauma masa kecil, dan PTSD.','+62 812-1010-2020',NULL,'2026-08-04 20:46:11','2026-08-04 20:46:11'),('542d6306-8608-420b-8122-2f94634c7393','Michael T. Wicaksono','michael.w@terapis.com',NULL,'$2y$12$4lhRPiS3bloXWCD6NSMJw.Tob8pCMu4UM/zD/Rm0ufTb0R4I10B5i','user',NULL,NULL,NULL,NULL,NULL,'+62 813-1111-2222',NULL,'2026-08-04 20:46:12','2026-08-04 20:46:12'),('570c7d66-a7a5-4d4c-a1d1-ebca88e311c1','Siti Nurhaliza','siti.nur@terapis.com',NULL,'$2y$12$5Q1pz5kUSvD6BOcYBoE2BOh1M7GXbO6nXDUrANktjkAhNRNdHPuay','user',NULL,NULL,NULL,NULL,NULL,'+62 813-7777-8888',NULL,'2026-08-04 20:46:15','2026-08-04 20:46:15'),('58f32ed2-d992-4c16-a92e-7e7fee0f1f93','Sarah Jenkins','user@terapis.com',NULL,'$2y$12$fN8jvLYmeOgvS6ifsjDhG.YF5fR2K1.KKkofMWkBgDrEqBUhTCseW','user',NULL,NULL,NULL,NULL,NULL,'+62 812-3456-7890',NULL,'2026-08-04 20:46:12','2026-08-04 20:46:12'),('6a8f6f6e-68cf-44c8-9876-62d1cf7cde07','Dr. Maya Putri, M.Psi','maya.putri@terapis.com',NULL,'$2y$12$UhRP4bfaYysA8QXbPGVwNeW9QJdgq98q.3aY12wQ8HwLILef8xJfW','therapist','Hubungan, Konseling Pasangan, Komunikasi','https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&auto=format&fit=crop&q=80','4.8','Rp 290.000','Pakar konseling hubungan interpersonal dan komunikasi intim bagi pasangan dan individu.','+62 812-9999-0000',NULL,'2026-08-04 20:46:11','2026-08-04 20:46:11'),('74066d57-8860-4ccf-8193-f5424b03d54c','Dr. Sarah Jenkins, Ph.D.','sarah.jenkins@terapis.com',NULL,'$2y$12$RFt8EcJwoXEdGR.uqvkztucg0ZNo2DRGjUt3aYwvdgLuACq2ZeO4a','therapist','Kecemasan, Depresi, Trauma','https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&auto=format&fit=crop&q=80','4.9','Rp 350.000','Psikolog klinis terverifikasi dengan pengalaman lebih dari 12 tahun mengkhususkan diri dalam terapi perilaku kognitif (CBT), pengelolaan kecemasan, dan trauma.','+62 812-1111-2222',NULL,'2026-08-04 20:46:09','2026-08-04 20:46:09'),('81c9c4f0-d588-49eb-abac-3d93b06233ce','David Chen Prabowo','david.chen@terapis.com',NULL,'$2y$12$ljfOb9RXJJuirMuxSrdYou.Nh6LuGGB3Z3hn2sWYgzBMSh4v2Qldi','user',NULL,NULL,NULL,NULL,NULL,'+62 813-4444-5555',NULL,'2026-08-04 20:46:14','2026-08-04 20:46:14'),('a41e0e90-a98b-4900-a51a-fcc76c052564','Linda Parker Rahayu','linda.parker@terapis.com',NULL,'$2y$12$Z3Ct/dFVN0PbyW4temGCV.o57bdkLFkMBaKg3QrcFVUKL9pgVwiW2','user',NULL,NULL,NULL,NULL,NULL,'+62 813-5555-6666',NULL,'2026-08-04 20:46:14','2026-08-04 20:46:14'),('bc529082-a15b-4283-a841-6628ab8f24cd','Dr. Elena Rostova, Sp.KJ','elena.rostova@terapis.com',NULL,'$2y$12$XDXPj2KTXFHCEN6OtySZS.hEb0L8x574EtQNSLI3tdTCHHYrSXE4e','therapist','Kecemasan, Stres Berat, Depresi','https://images.unsplash.com/photo-1594824813566-88855ce7890b?w=500&auto=format&fit=crop&q=80','5.0','Rp 450.000','Psikiater spesialis dalam penanganan gangguan emosi berat, manajemen stres profesional, serta pengobatan medis holistik.','+62 812-5555-6666',NULL,'2026-08-04 20:46:10','2026-08-04 20:46:10'),('bdf8c3da-afbd-4bf0-92d3-60685b93bb67','Marcus Reed','marcus.reed@terapis.com',NULL,'$2y$12$9uI8mxsADnf1drj3Wf7/MOwBnHehcNxPJV9zEGF0QOdMfqXnn/MNO','user',NULL,NULL,NULL,NULL,NULL,'+62 813-3333-4444',NULL,'2026-08-04 20:46:13','2026-08-04 20:46:13'),('c4ecc70f-16f1-4b68-9947-86b1e116a021','Rian Hidayat','rian.hidayat@terapis.com',NULL,'$2y$12$ONMxVBtJxH5nEhKiuU3XueiBCHqn9KlWs21MbjUe40hplUTrkjyUK','user',NULL,NULL,NULL,NULL,NULL,'+62 813-8888-9999',NULL,'2026-08-04 20:46:15','2026-08-04 20:46:15'),('daef1fe9-4c90-4820-9681-b20df03e25bf','Admin Utama Terapis Online','admin@terapis.com',NULL,'$2y$12$SNtjVWZhmaf/VkeRHKxj6OpEaY65vhUwBIz9WoUPh1GngNc5WmZly','admin','Administrator System',NULL,NULL,NULL,NULL,'+62 811-9988-7766',NULL,'2026-08-04 20:46:09','2026-08-04 20:46:09'),('e06dd389-3f60-4e65-8b83-3341fbec1c79','Budi Santoso','budi.santoso@terapis.com',NULL,'$2y$12$fR8sLZ9PhVefRUFu3VwykOIrPh7UFKoS70LkjxjvWVRWCNHrhlXAS','user',NULL,NULL,NULL,NULL,NULL,'+62 813-6666-7777',NULL,'2026-08-04 20:46:14','2026-08-04 20:46:14'),('ebeeacbb-8c26-473a-8dbb-e52ca3104e29','Dewi Lestari','dewi.lestari@terapis.com',NULL,'$2y$12$oX.QIwYqhgCxH0sbECU/jeEVf4Jbocai2oe4SCXQ9mYi6YFAFjM0a','user',NULL,NULL,NULL,NULL,NULL,'+62 813-9999-0000',NULL,'2026-08-04 20:46:15','2026-08-04 20:46:15'),('f3a435c6-17c4-4233-aa19-94967388bbfb','Dr. Aris Kusuma, M.Psi','aris.kusuma@terapis.com',NULL,'$2y$12$cmaMaCkj8unh3Z3OSZ315.qlWD3m8MXBrWjOV.cvT2vvswEEefXuC','therapist','Karir, Burnout, Stres Pekerjaan','https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=500&auto=format&fit=crop&q=80','4.9','Rp 320.000','Konselor psikologi karir berpengalaman mendampingi karyawan dan profesional muda menghadapi kelelahan kerja (burnout).','+62 812-8888-9999',NULL,'2026-08-04 20:46:11','2026-08-04 20:46:11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-05 10:47:46
