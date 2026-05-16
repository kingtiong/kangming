-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: kangming
-- ------------------------------------------------------
-- Server version	8.0.45-0ubuntu0.24.04.1

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
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `schedule_id` bigint unsigned DEFAULT NULL,
  `section_id` bigint unsigned DEFAULT NULL,
  `service_id` bigint unsigned DEFAULT NULL,
  `charge_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MYR',
  `status` enum('pending','confirmed','attended','cancelled','no_show') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','paid','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_reference_unique` (`reference`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_schedule_id_foreign` (`schedule_id`),
  KEY `bookings_section_id_foreign` (`section_id`),
  KEY `bookings_service_id_foreign` (`service_id`),
  KEY `bookings_charge_id_foreign` (`charge_id`),
  KEY `bookings_status_index` (`status`),
  KEY `bookings_payment_status_index` (`payment_status`),
  CONSTRAINT `bookings_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_zh_CN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_zh_TW` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_in_charge_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_code_unique` (`code`),
  KEY `branches_teacher_in_charge_id_foreign` (`teacher_in_charge_id`),
  CONSTRAINT `branches_teacher_in_charge_id_foreign` FOREIGN KEY (`teacher_in_charge_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'Kamunting (HQ)','甘文丁(总院)','甘文丁(總院)','KMG','No. 45, Jalan Medan Saujana 1, Medan Saujana, 34600 Kamunting, Perak','+60 11-6769 3193','tanteikee@gmail.com',2,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(2,'Ipoh','怡保','怡保','IPH','Jalan Sultan Idris Shah, 30000 Ipoh, Perak','+60 12-345 6701','ipoh@kangming.local',3,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(3,'Penang','槟城','檳城','PG','Lebuh Chulia, 10200 George Town, Penang','+60 12-345 6702','penang@kangming.local',4,1,'2026-05-13 17:20:08','2026-05-13 18:58:42');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
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
  PRIMARY KEY (`key`)
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
  PRIMARY KEY (`key`)
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
-- Table structure for table `charges`
--

DROP TABLE IF EXISTS `charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `charges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint unsigned NOT NULL,
  `branch_id` bigint unsigned DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label_zh_CN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label_zh_TW` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audience` enum('client','student','both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'both',
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MYR',
  `session_count` smallint unsigned NOT NULL DEFAULT '1',
  `valid_from` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charges_service_id_foreign` (`service_id`),
  KEY `charges_branch_id_foreign` (`branch_id`),
  KEY `charges_audience_index` (`audience`),
  CONSTRAINT `charges_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  CONSTRAINT `charges_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charges`
--

LOCK TABLES `charges` WRITE;
/*!40000 ALTER TABLE `charges` DISABLE KEYS */;
INSERT INTO `charges` VALUES (1,1,NULL,'Single session','单次','單次','client',120.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(2,1,NULL,'10-session package','10 次套票','10 次套票','client',1080.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:42'),(3,2,NULL,'Single session','单次','單次','client',90.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(4,2,NULL,'10-session package','10 次套票','10 次套票','client',810.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:42'),(5,3,NULL,'Single session','单次','單次','client',100.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(6,3,NULL,'10-session package','10 次套票','10 次套票','client',900.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:42'),(7,4,NULL,'Single session','单次','單次','client',80.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(8,4,NULL,'10-session package','10 次套票','10 次套票','client',720.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:42'),(9,5,NULL,'Single session','单次','單次','client',180.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(10,5,NULL,'10-session package','10 次套票','10 次套票','client',1620.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:42'),(11,6,NULL,'Single session','单次','單次','client',150.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(12,6,NULL,'10-session package','10 次套票','10 次套票','client',1350.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:42'),(13,7,NULL,'Single session','单次','單次','both',50.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(14,7,NULL,'10-session package','10 次套票','10 次套票','both',450.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:43'),(15,8,NULL,'Single session','单次','單次','student',280.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:43'),(16,8,NULL,'10-session package','10 次套票','10 次套票','student',2520.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:43'),(17,9,NULL,'Single session','单次','單次','student',420.00,'MYR',1,NULL,NULL,1,NULL,'2026-05-13 17:20:08','2026-05-13 18:58:43'),(18,9,NULL,'10-session package','10 次套票','10 次套票','student',3780.00,'MYR',10,NULL,NULL,1,'Save 10% — equivalent of 1 session free','2026-05-13 17:20:08','2026-05-13 18:58:43');
/*!40000 ALTER TABLE `charges` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_13_100000_create_branches_table',1),(5,'2026_05_13_100100_create_services_table',1),(6,'2026_05_13_100200_create_charges_table',1),(7,'2026_05_13_100300_create_sections_table',1),(8,'2026_05_13_100400_create_schedules_table',1),(9,'2026_05_13_100500_create_bookings_table',1),(10,'2026_05_13_120000_add_locale_columns_to_translatable_tables',2);
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
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned DEFAULT NULL,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` smallint unsigned DEFAULT NULL,
  `status` enum('scheduled','cancelled','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'scheduled',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_section_id_foreign` (`section_id`),
  KEY `schedules_teacher_id_foreign` (`teacher_id`),
  KEY `schedules_starts_at_index` (`starts_at`),
  KEY `schedules_status_index` (`status`),
  CONSTRAINT `schedules_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `schedules_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,1,2,'2026-05-20 19:00:00','2026-05-20 21:00:00','Studio A',15,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(2,1,2,'2026-05-23 19:00:00','2026-05-23 21:00:00','Studio A',15,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(3,1,2,'2026-05-26 19:00:00','2026-05-26 21:00:00','Studio A',15,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(4,1,2,'2026-05-29 19:00:00','2026-05-29 21:00:00','Studio A',15,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(5,1,2,'2026-06-01 19:00:00','2026-06-01 21:00:00','Studio A',15,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(6,1,2,'2026-06-04 19:00:00','2026-06-04 21:00:00','Studio A',15,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(7,1,2,'2026-06-07 19:00:00','2026-06-07 21:00:00','Studio A',15,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(8,1,2,'2026-06-10 19:00:00','2026-06-10 21:00:00','Studio A',15,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(9,2,2,'2026-05-14 10:00:00','2026-05-14 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(10,2,2,'2026-05-14 11:00:00','2026-05-14 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:08','2026-05-13 17:20:08'),(11,2,2,'2026-05-14 14:00:00','2026-05-14 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(12,2,2,'2026-05-14 15:00:00','2026-05-14 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(13,2,2,'2026-05-14 16:00:00','2026-05-14 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(14,2,2,'2026-05-15 10:00:00','2026-05-15 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(15,2,2,'2026-05-15 11:00:00','2026-05-15 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(16,2,2,'2026-05-15 14:00:00','2026-05-15 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(17,2,2,'2026-05-15 15:00:00','2026-05-15 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(18,2,2,'2026-05-15 16:00:00','2026-05-15 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(19,2,2,'2026-05-16 10:00:00','2026-05-16 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(20,2,2,'2026-05-16 11:00:00','2026-05-16 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(21,2,2,'2026-05-16 14:00:00','2026-05-16 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(22,2,2,'2026-05-16 15:00:00','2026-05-16 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(23,2,2,'2026-05-16 16:00:00','2026-05-16 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(24,2,2,'2026-05-17 10:00:00','2026-05-17 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(25,2,2,'2026-05-17 11:00:00','2026-05-17 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(26,2,2,'2026-05-17 14:00:00','2026-05-17 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(27,2,2,'2026-05-17 15:00:00','2026-05-17 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(28,2,2,'2026-05-17 16:00:00','2026-05-17 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(29,2,2,'2026-05-18 10:00:00','2026-05-18 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(30,2,2,'2026-05-18 11:00:00','2026-05-18 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(31,2,2,'2026-05-18 14:00:00','2026-05-18 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(32,2,2,'2026-05-18 15:00:00','2026-05-18 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(33,2,2,'2026-05-18 16:00:00','2026-05-18 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(34,2,2,'2026-05-19 10:00:00','2026-05-19 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(35,2,2,'2026-05-19 11:00:00','2026-05-19 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(36,2,2,'2026-05-19 14:00:00','2026-05-19 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(37,2,2,'2026-05-19 15:00:00','2026-05-19 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(38,2,2,'2026-05-19 16:00:00','2026-05-19 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(39,2,2,'2026-05-20 10:00:00','2026-05-20 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(40,2,2,'2026-05-20 11:00:00','2026-05-20 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(41,2,2,'2026-05-20 14:00:00','2026-05-20 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(42,2,2,'2026-05-20 15:00:00','2026-05-20 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(43,2,2,'2026-05-20 16:00:00','2026-05-20 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(44,3,3,'2026-05-14 10:00:00','2026-05-14 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(45,3,3,'2026-05-14 11:00:00','2026-05-14 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(46,3,3,'2026-05-14 14:00:00','2026-05-14 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(47,3,3,'2026-05-14 15:00:00','2026-05-14 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(48,3,3,'2026-05-14 16:00:00','2026-05-14 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(49,3,3,'2026-05-15 10:00:00','2026-05-15 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(50,3,3,'2026-05-15 11:00:00','2026-05-15 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(51,3,3,'2026-05-15 14:00:00','2026-05-15 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(52,3,3,'2026-05-15 15:00:00','2026-05-15 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(53,3,3,'2026-05-15 16:00:00','2026-05-15 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(54,3,3,'2026-05-16 10:00:00','2026-05-16 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(55,3,3,'2026-05-16 11:00:00','2026-05-16 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(56,3,3,'2026-05-16 14:00:00','2026-05-16 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(57,3,3,'2026-05-16 15:00:00','2026-05-16 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(58,3,3,'2026-05-16 16:00:00','2026-05-16 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(59,3,3,'2026-05-17 10:00:00','2026-05-17 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(60,3,3,'2026-05-17 11:00:00','2026-05-17 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(61,3,3,'2026-05-17 14:00:00','2026-05-17 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(62,3,3,'2026-05-17 15:00:00','2026-05-17 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(63,3,3,'2026-05-17 16:00:00','2026-05-17 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(64,3,3,'2026-05-18 10:00:00','2026-05-18 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(65,3,3,'2026-05-18 11:00:00','2026-05-18 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(66,3,3,'2026-05-18 14:00:00','2026-05-18 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(67,3,3,'2026-05-18 15:00:00','2026-05-18 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(68,3,3,'2026-05-18 16:00:00','2026-05-18 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(69,3,3,'2026-05-19 10:00:00','2026-05-19 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(70,3,3,'2026-05-19 11:00:00','2026-05-19 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(71,3,3,'2026-05-19 14:00:00','2026-05-19 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(72,3,3,'2026-05-19 15:00:00','2026-05-19 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(73,3,3,'2026-05-19 16:00:00','2026-05-19 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(74,3,3,'2026-05-20 10:00:00','2026-05-20 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(75,3,3,'2026-05-20 11:00:00','2026-05-20 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(76,3,3,'2026-05-20 14:00:00','2026-05-20 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(77,3,3,'2026-05-20 15:00:00','2026-05-20 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(78,3,3,'2026-05-20 16:00:00','2026-05-20 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(79,4,4,'2026-05-14 10:00:00','2026-05-14 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(80,4,4,'2026-05-14 11:00:00','2026-05-14 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(81,4,4,'2026-05-14 14:00:00','2026-05-14 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(82,4,4,'2026-05-14 15:00:00','2026-05-14 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(83,4,4,'2026-05-14 16:00:00','2026-05-14 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(84,4,4,'2026-05-15 10:00:00','2026-05-15 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(85,4,4,'2026-05-15 11:00:00','2026-05-15 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(86,4,4,'2026-05-15 14:00:00','2026-05-15 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(87,4,4,'2026-05-15 15:00:00','2026-05-15 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(88,4,4,'2026-05-15 16:00:00','2026-05-15 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(89,4,4,'2026-05-16 10:00:00','2026-05-16 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(90,4,4,'2026-05-16 11:00:00','2026-05-16 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(91,4,4,'2026-05-16 14:00:00','2026-05-16 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(92,4,4,'2026-05-16 15:00:00','2026-05-16 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(93,4,4,'2026-05-16 16:00:00','2026-05-16 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:09','2026-05-13 17:20:09'),(94,4,4,'2026-05-17 10:00:00','2026-05-17 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(95,4,4,'2026-05-17 11:00:00','2026-05-17 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(96,4,4,'2026-05-17 14:00:00','2026-05-17 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(97,4,4,'2026-05-17 15:00:00','2026-05-17 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(98,4,4,'2026-05-17 16:00:00','2026-05-17 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(99,4,4,'2026-05-18 10:00:00','2026-05-18 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(100,4,4,'2026-05-18 11:00:00','2026-05-18 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(101,4,4,'2026-05-18 14:00:00','2026-05-18 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(102,4,4,'2026-05-18 15:00:00','2026-05-18 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(103,4,4,'2026-05-18 16:00:00','2026-05-18 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(104,4,4,'2026-05-19 10:00:00','2026-05-19 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(105,4,4,'2026-05-19 11:00:00','2026-05-19 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(106,4,4,'2026-05-19 14:00:00','2026-05-19 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(107,4,4,'2026-05-19 15:00:00','2026-05-19 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(108,4,4,'2026-05-19 16:00:00','2026-05-19 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(109,4,4,'2026-05-20 10:00:00','2026-05-20 11:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(110,4,4,'2026-05-20 11:00:00','2026-05-20 12:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(111,4,4,'2026-05-20 14:00:00','2026-05-20 15:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(112,4,4,'2026-05-20 15:00:00','2026-05-20 16:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10'),(113,4,4,'2026-05-20 16:00:00','2026-05-20 17:00:00','Treatment Room 1',1,'scheduled',NULL,'2026-05-13 17:20:10','2026-05-13 17:20:10');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_zh_CN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_zh_TW` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint unsigned NOT NULL,
  `branch_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned DEFAULT NULL,
  `audience` enum('client','student','both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `capacity` smallint unsigned NOT NULL DEFAULT '10',
  `starts_on` date DEFAULT NULL,
  `ends_on` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_zh_CN` text COLLATE utf8mb4_unicode_ci,
  `description_zh_TW` text COLLATE utf8mb4_unicode_ci,
  `status` enum('draft','open','closed','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sections_code_unique` (`code`),
  KEY `sections_service_id_foreign` (`service_id`),
  KEY `sections_branch_id_foreign` (`branch_id`),
  KEY `sections_teacher_id_foreign` (`teacher_id`),
  KEY `sections_audience_index` (`audience`),
  KEY `sections_status_index` (`status`),
  CONSTRAINT `sections_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sections_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sections_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'Tung\'s Acupuncture Foundation — May 2026 Cohort','董氏针灸基础 — 2026 年 5 月期','董氏針灸基礎 — 2026 年 5 月期','TUNG-FOUND-2026',8,1,2,'student',15,'2026-05-20','2026-08-13','Twice-weekly evening classes at the Kamunting HQ — meridians, point location, needling safety, and live case discussion. Concludes with the formal 拜師 transmission ceremony.','甘文丁总院,每周两晚授课 — 经络、取穴、针刺安全与临床实例讨论,结业时举行正式拜师礼。','甘文丁總院,每週兩晚授課 — 經絡、取穴、針刺安全與臨床實例討論,結業時舉行正式拜師禮。','open','2026-05-13 17:20:08','2026-05-13 18:58:43'),(2,'Kamunting HQ — Daily Treatments','甘文丁总院 — 每日疗程','甘文丁總院 — 每日療程','TRT-KMG',1,1,2,'client',1,NULL,NULL,'One-on-one treatment slots with Prof. Dr. Tan Teik Ee at the Kamunting HQ.','甘文丁总院,陈世益博士教授一对一诊疗时段。','甘文丁總院,陳世益博士教授一對一診療時段。','open','2026-05-13 17:20:08','2026-05-13 18:58:43'),(3,'Ipoh — Daily Treatments','怡保 — 每日疗程','怡保 — 每日療程','TRT-IPH',1,2,3,'client',1,NULL,NULL,NULL,NULL,NULL,'open','2026-05-13 17:20:08','2026-05-13 18:58:43'),(4,'Penang — Daily Treatments','槟城 — 每日疗程','檳城 — 每日療程','TRT-PG',1,3,4,'client',1,NULL,NULL,NULL,NULL,NULL,'open','2026-05-13 17:20:08','2026-05-13 18:58:43');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_zh_CN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_zh_TW` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('treatment','class','consultation','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'treatment',
  `audience` enum('client','student','both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_zh_CN` text COLLATE utf8mb4_unicode_ci,
  `description_zh_TW` text COLLATE utf8mb4_unicode_ci,
  `duration_minutes` smallint unsigned NOT NULL DEFAULT '60',
  `default_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`),
  KEY `services_category_index` (`category`),
  KEY `services_audience_index` (`audience`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Tung\'s Acupuncture Treatment','董氏针灸疗程','董氏針灸療程','tungs-acupuncture-treatment','treatment','client','The signature Tung\'s system (董氏針灸) — fast-acting, lineage-based acupuncture for pain relief, internal medicine, and chronic conditions.','穅洺招牌的董氏针灸 — 师徒亲传体系,起效迅速,适用于疼痛、内科与慢性病。','穅洺招牌的董氏針灸 — 師徒親傳體系,起效迅速,適用於疼痛、內科與慢性病。',60,120.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(2,'General Acupuncture','一般针灸','一般針灸','general-acupuncture','treatment','client','Traditional TCM acupuncture for everyday wellness, stress, sleep, and minor pain.','传统中医针灸,适用于日常调理、压力、睡眠及轻度疼痛。','傳統中醫針灸,適用於日常調理、壓力、睡眠及輕度疼痛。',45,90.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(3,'Tuina Therapeutic Massage','推拿疗法','推拿療法','tuina-therapeutic-massage','treatment','client','Hands-on Chinese medical massage along meridians to release stagnation and restore flow.','依经络施作的中医手法疗法,化解阻滞、恢复气血畅通。','依經絡施作的中醫手法療法,化解阻滯、恢復氣血暢通。',60,100.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(4,'Cupping Therapy','拔罐疗法','拔罐療法','cupping-therapy','treatment','client','Traditional fire and silicone cupping for muscle recovery and toxin release.','传统火罐与硅胶拔罐,促进肌肉恢复与排毒。','傳統火罐與矽膠拔罐,促進肌肉恢復與排毒。',30,80.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(5,'Medical Aesthetics (醫美)','医美护理','醫美護理','medical-aesthetics','treatment','client','Facial acupuncture and aesthetic protocols for natural rejuvenation and skin health.','面部针灸与中医美容方案,自然焕肤、改善肌肤健康。','面部針灸與中醫美容方案,自然煥膚、改善肌膚健康。',60,180.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(6,'Beauty Care & Nursing (醫護)','美容护理','美容護理','beauty-care-nursing','treatment','client','Integrated TCM beauty and post-treatment care by certified practitioners.','由认证医师执行的中医美容与术后护理综合方案。','由認證醫師執行的中醫美容與術後護理綜合方案。',60,150.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(7,'Initial Consultation','初次问诊','初次問診','initial-consultation','consultation','both','Pulse and tongue diagnosis, full case review, and a personalised wellness plan.','把脉、观舌、完整病史复盘,以及量身定制的调理方案。','把脈、觀舌、完整病史複盤,以及量身定制的調理方案。',30,50.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(8,'Tung\'s Acupuncture — Foundation Course','董氏针灸 — 基础课程','董氏針灸 — 基礎課程','tungs-acupuncture-foundation-course','class','student','Step into the Tung\'s lineage. Master the points, channels, and clinical reasoning of董氏針灸 from a transmission holder.','入门董氏门派。由传承人亲授穴位、经络与临床思路。','入門董氏門派。由傳承人親授穴位、經絡與臨床思路。',120,280.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:43'),(9,'Tung\'s Acupuncture — Advanced Clinic','董氏针灸 — 进阶临床','董氏針灸 — 進階臨床','tungs-acupuncture-advanced-clinic','class','student','For practising clinicians. Advanced needling, supervised live cases, and lineage transmission rituals (拜師).','面向执业医师。进阶下针、临床实操督导,及正式拜师礼。','面向執業醫師。進階下針、臨床實操督導,及正式拜師禮。',180,420.00,1,'2026-05-13 17:20:08','2026-05-13 18:58:43');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
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
INSERT INTO `sessions` VALUES ('2q8UIOI6Y2f3FiKNd4kLi4HTg8gn8Aktl3p1ZIAY',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnpOYVcxYUVOZGhBanNOUGJmc3ZqMEpuakNWaTQ5ZlpMU05aRkZPRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2xvZ2luPyUyRmxvZ2luPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1778664315),('3vLVDZufROfOuZl1NguRmxPCu7mCE9cdnEXwW2LV',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNE1RYWJIMjFQeUUxVk0ydXdIclVkWlFCYVlNdDBxdFQxaThkMWVUMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2xvZ2luPyUyRmxvZ2luPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1778669066),('6wT4rlUI4GEm4GulJr8XL1lNLLn2ootJPATQCHh3',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXI1Zm5CWERkMkJsUkFzS1RmZVJpNzRiN1hVbkJ5NXJqMjljUkdJOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2JyYW5jaGVzPyUyRmJyYW5jaGVzPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1778664315),('8jJGH3DzrYZpeOT3KUE88xXC3a70E8BuyQThEPGI',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1Y1SnEyRjV2Y3ZHZE5uY0tnSG1qS0pyYzdJMnhNdUl4NGxTSk85QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL3NlcnZpY2VzPyUyRnNlcnZpY2VzPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1778664315),('AkVba345394WHfaC1A3ZF8UmRseGU5QDsxBjU6no',1,'137.184.96.183','curl/8.5.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoibnh1WVJoUHBzakNzT05URkJzd2VubkQyRDdCRWM2cGIwWDJLYlZkRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODY6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2FkbWluL3NlcnZpY2VzLzEvZWRpdD8lMkZhZG1pbiUyRnNlcnZpY2VzJTJGMSUyRmVkaXQ9Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJsb2NhbGUiO3M6NToiemhfQ04iO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1778669948),('fCeUnq6RsYSSKst02R3ZwB6Z04kSGE4QA3fV9H5q',NULL,'115.132.43.199','WhatsApp/2.2616.100 W','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUlLUml3R1NJM1U0bTdJYWIwUjJNQ3VGbjVvYkRRWW1LSDZDTGM4dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778664831),('GumNzXC7NYj072w8fXdB17dfozp0cOusnCwpzg8R',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaURWMVdZOEJYZmY1czJrWm80ZjBOQ0F0Rkx6bjUyaUlEYlgySVJLeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2ZvdW5kZXI/JTJGZm91bmRlcj0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1778664329),('JEVHdnd7PmJWwDNsagwwl8Y5VnDYKaReMj3kqbbM',NULL,'115.132.43.199','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVU9TdXcyY0xwVkhlRXpjemppOHZKRDlsR3dRRWdHUTBiSXZYRklUVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2xvZ2luPyUyRmxvZ2luPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1778665156),('m95bHPBPrqTat10bIVbgMINGmX2cO7KPO7XYK1gn',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFJ4NDRtemFib0xJMnkxandyZkVVSG9CNjRDWHVZQ3lKNTkydzRnRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL3NlcnZpY2VzPyUyRnNlcnZpY2VzPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1778664329),('msNHypcmyichJPNavCEJQRIbZAaH7WxmVkBhw10m',NULL,'115.132.43.199','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXFvTWVyQkIyVmtJM1lqMDdrclZudFB4RFJ2UnJwbVExTHFQZzVaRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9fQ==',1778669347),('MszS11M0bYcqDLThWF08gRU9d1YvPHO6v26zx1Fb',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVQ3SW5xMDBZaHZ4dUR1VjM0QzNiZk1CZlNQWlAwY0VVUUFPM0d1aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778664315),('p3wzKez5s5iithPBa4pSKtcjsnQTS3I6ZIkS0E3d',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0VISTM5eDNLb3dHR2F6eVFYQmhlWHBlTUpWTVN0NDltVmdLa0RkWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778664424),('PkFhe5pWQhME8uWcKBmYxWadAPp2mIMfJLCqzv7Q',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0I3Y0RCdTlIdjZuVHFkSkh5WWJRQ0gwUE9HNzRKMll5VjlLekJ2MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2NvbnRhY3Q/JTJGY29udGFjdD0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1778664329),('r84qajAKDlYdw8dPVEgfqFQ3KmXnr7jlnJn5o33G',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW93a1FmVThYRGZmYURSVkVrNmJ1Z1laY2RGdXlCWmtERzdHT080aCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL3JlZ2lzdGVyPyUyRnJlZ2lzdGVyPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1778664316),('rZkyJr2vEpwHhYCNEP4CfOWMY5nGh61AnAYqQQl3',3,'180.75.143.136','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNFQwRTFkU3NFV1cwM2V6bmVHVXlQN3lMUDRvdmhuYmhCSEVEZFB1SSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL3RlYWNoZXI/JTJGdGVhY2hlcj0iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=',1778669173),('s7ZNfgse9EuEULJi3QHNMuOd69xHrH8IdmLAxBxW',NULL,'115.164.33.221','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2phNWtHT1ZRVmxlTFNpTnVxS2Jodmk2MnV3Yjk4cGVqdEhGejN1WSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2xvZ2luPyUyRmxvZ2luPSI7fX0=',1778668010),('SaKUDu6XBlRzs2aNKJzpGforZrvgy4joqzBNq3mB',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVM2b2NlaElBTHBDZlRwM0I1cWlQN1ZhbjI3cTR5bVdPMnM1ejNQdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2Fib3V0PyUyRmFib3V0PSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1778664315),('slr0GMM63AcNSQbQQy24BgFTzpqE9lVYRX2oZzJs',NULL,'115.164.53.86','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoicmIyYU5HdVZxaHFyVVJ5RmZsRzZSV1VhODVLcmt1Q2tCbFZjaENxbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778925719),('u1SI1hrTeu9nc8aFezO8XCM1fpgkATNnlZuBSiBJ',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibjJtVWVzV2ZDeXJ5cXU2dTJFaks3NDJjV0NHWnd5d2NwajA1REhzcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2NvbnRhY3Q/JTJGY29udGFjdD0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1778664315),('vBQk547jUF6fbYJSOprbOpa0bxkuyv5mbvD4CQne',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoicEFWVHV2VkxFYm5TMEVlT1FaNXRLMzJjZGIxc3RzTWdJYjRuUTdVZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778664322),('VCiLx2rmJ8EMcIYiiTLvHy2YbHqzvf17D1EEgcl4',NULL,'115.132.43.199','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicFVGY1llRmtkT1VlSVVxTVc4eHRQaThzZHFrZzVkN1ZZOGZack9FciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2xvZ2luPyUyRmxvZ2luPSI7fX0=',1778667866),('wMGwX8KLluHIQeVoAmO5z5EWI9NMLy2sTNEiQxEe',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFpLVlFQRzUxMXh3aFBKeXljMG9Bb2xPUTY5TERnYktsS1NzQ2tZciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778664402),('x7Uv6P8GPtUIiCGPp7khr1K3jpiZKHJ9MTlALMep',NULL,'115.132.43.199','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2VLMXBtRzFja1A1aEZPazN6YW93QjJNR0VueWNIOUtpUjBDNVpzMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778667902),('ydR8qy7EArtzuJY3mdnZsx36RYXF4fyS08fhvGKN',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOW1kTVBnM2M5c2ZuaTVRNXlLbW4wMm40Ung0YkRrV2tsMzg3NjBjQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL2ZvdW5kZXI/JTJGZm91bmRlcj0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1778664315),('Yx3fdEZxT7o0iRCrGsCrT8uaosUWb6JQuB30dSuH',7,'161.142.154.31','Mozilla/5.0 (Linux; Android 16; Xiaomi 13 Ultra Build/BP2A.250605.031.A3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.7049.79 Mobile Safari/537.36 XiaoMi/MiuiBrowser/14.55.0-gn','YTo0OntzOjY6Il90b2tlbiI7czo0MDoib3IydGhGekxlUDl1eTlrVmRZcFBxQ2dpOE56a21YbVdWV205djZlNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nL21lbWJlcj8lMkZtZW1iZXI9Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9',1778667527),('zjZjH2e1E4kKqMmwfRAYRL8u1tAJNLZsEyidh2kM',NULL,'137.184.96.183','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjJNbXlyaGxiYXlmYTBUTUt3U1pmZFJkeU45elFIUENpYXBNRnNvRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8veGVudGlvb3Mub25saW5lL2thbmdtaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778664402);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','teacher','student','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `branch_id` bigint unsigned DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_index` (`role`),
  KEY `users_branch_id_index` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@kangming.local','+60 11-6769 3193','admin',NULL,NULL,NULL,NULL,1,NULL,'$2y$12$AAgoEOV5e.X2knsCg8wOUeBVW7HZINDxjN1OsH1Lhi63nhkQzgwIm',NULL,'2026-05-13 17:20:07','2026-05-13 18:58:41'),(2,'Prof. Dr. Tan Teik Ee 陳世益','tanteikee@kangming.local','+60 11-6769 3193','teacher',NULL,NULL,NULL,'中醫博士教授 · Professor Doctor of Traditional Chinese Medicine. Lineage holder of Tung\'s Acupuncture (董氏針灸).',1,NULL,'$2y$12$XG5ROz3LhvdO2tKx.FTrxeBdy3FI9jJOiQfOHZ9wrLV30dSFtKUba',NULL,'2026-05-13 17:20:07','2026-05-13 18:58:41'),(3,'Master Chan','chan@kangming.local','+60 12-345 6701','teacher',NULL,NULL,NULL,'Senior practitioner — pain management and tuina specialist.',1,NULL,'$2y$12$GLwMcqR7xc2M61egI439OOS/al80NcYkRNBAarN277gQXPJ4Zno2m',NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(4,'Dr. Wong','wong@kangming.local','+60 12-345 6702','teacher',NULL,NULL,NULL,'Tung\'s acupuncture instructor; women\'s health and fertility focus.',1,NULL,'$2y$12$5U115crjlXiwaWcdbT8qu.F.kFhmn7pMqrR0Q/CX7fIXh0cVBnaGu',NULL,'2026-05-13 17:20:08','2026-05-13 18:58:42'),(5,'Sample Student','student@kangming.local',NULL,'student',1,NULL,NULL,NULL,1,NULL,'$2y$12$Lh4OCIptMeitOI81C4vevOs24MphTkSWp5LXwApaYu.2DA5JTOve2',NULL,'2026-05-13 17:20:10','2026-05-13 18:58:44'),(6,'Sample Client','client@kangming.local',NULL,'client',1,NULL,NULL,NULL,1,NULL,'$2y$12$yhzWfiofdZNq/gzI8gMsluHHdx69expX1IyzTrJeBL1BVY9ZK1uEq',NULL,'2026-05-13 17:20:11','2026-05-13 18:58:44'),(7,'Thor','darem3913@gmail.com','0195943431','client',1,NULL,NULL,NULL,1,NULL,'$2y$12$pld6Xr1YLeTUimMIrYtLGODkY.9WpopSLhRktIumEl2GuBJr9lKVO',NULL,'2026-05-13 18:18:42','2026-05-13 18:18:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'kangming'
--

--
-- Dumping routines for database 'kangming'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-16 11:50:57
