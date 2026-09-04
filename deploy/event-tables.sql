-- Event tables for the tournament site, schema and seed content.
--
-- Only needed when the host has no PHP CLI. The supported route is:
--
--     php artisan migrate --force && php artisan db:seed --force
--
-- Import this into the site's database (phpMyAdmin > Import, or
-- mysql -u USER -p DBNAME < event-tables.sql). It assumes DB_PREFIX=terre217_,
-- which is what .env sets.
--
-- The INSERTs at the end record the migrations as already run, so a later
-- `php artisan migrate` does not try to create these tables a second time.

SET FOREIGN_KEY_CHECKS=0;
/*M!999999\- enable the sandbox mode */ 

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `terre217_event_matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `terre217_event_matches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `round` smallint(5) unsigned NOT NULL DEFAULT 1,
  `round_name` varchar(60) DEFAULT NULL,
  `label` varchar(20) DEFAULT NULL,
  `meta` varchar(80) DEFAULT NULL,
  `court` varchar(60) DEFAULT NULL,
  `home_team_id` int(10) unsigned DEFAULT NULL,
  `away_team_id` int(10) unsigned DEFAULT NULL,
  `home_score` varchar(40) DEFAULT NULL,
  `away_score` varchar(40) DEFAULT NULL,
  `winner_team_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_matches_event_id_index` (`event_id`),
  KEY `event_matches_category_id_index` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `terre217_event_matches` DISABLE KEYS */;
INSERT INTO `terre217_event_matches` VALUES (22,1,19,1,'Quarter-final','QF 1',NULL,'Centre Court',25,29,'6 6','3 4',25,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(23,1,19,1,'Quarter-final','QF 2',NULL,'Court 1',28,30,'7 6','5 2',28,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(24,1,19,1,'Quarter-final','QF 3',NULL,'Court 2',27,31,'6 4 6','2 6 3',27,2,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(25,1,19,1,'Quarter-final','QF 4',NULL,'Centre Court',26,32,'6 6','4 1',26,3,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(26,1,19,2,'Semi-final','SF 1',NULL,'Centre Court',25,28,'6 7','4 6',25,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(27,1,19,2,'Semi-final','SF 2',NULL,'Centre Court',27,26,'4 6 6','6 3 4',26,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(28,1,19,3,'Final','Final',NULL,'Centre Court',25,26,'6 3 7','4 6 5',25,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44');
/*!40000 ALTER TABLE `terre217_event_matches` ENABLE KEYS */;
DROP TABLE IF EXISTS `terre217_event_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `terre217_event_teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `registration_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `permalink` varchar(255) DEFAULT NULL,
  `short_code` varchar(4) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `founded` smallint(6) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `seed` smallint(6) DEFAULT NULL,
  `team_group` varchar(20) DEFAULT NULL,
  `qualified` tinyint(1) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_teams_registration_id_unique` (`registration_id`),
  UNIQUE KEY `event_teams_event_id_permalink_unique` (`event_id`,`permalink`),
  UNIQUE KEY `event_teams_event_id_short_code_unique` (`event_id`,`short_code`),
  KEY `event_teams_event_id_index` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `terre217_event_teams` DISABLE KEYS */;
INSERT INTO `terre217_event_teams` VALUES (25,1,NULL,'Senayan Racquet Club','senayan-racquet-club','src','Jakarta Pusat',1974,NULL,1,NULL,1,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(26,1,NULL,'Kemang Country Club','kemang-country-club','kcc','Jakarta Selatan',1988,NULL,2,NULL,1,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(27,1,NULL,'Bintaro Tennis Society','bintaro-tennis-society','bts','Tangerang Selatan',1996,NULL,3,NULL,1,2,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(28,1,NULL,'Surabaya Smash','surabaya-smash','sbs','Surabaya',1981,NULL,4,NULL,1,3,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(29,1,NULL,'Bali Baseline Club','bali-baseline-club','bbl','Denpasar',2003,NULL,5,NULL,1,4,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(30,1,NULL,'Medan Ace Sports','medan-ace-sports','mas','Medan',1992,NULL,6,NULL,1,5,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(31,1,NULL,'Makassar Kencana','makassar-kencana','mkn','Makassar',1999,NULL,7,NULL,1,6,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(32,1,NULL,'Yogyakarta Victory','yogyakarta-victory','ykv','Yogyakarta',1985,NULL,8,NULL,1,7,1,'2026-08-31 14:22:44','2026-08-31 14:22:44');
/*!40000 ALTER TABLE `terre217_event_teams` ENABLE KEYS */;
DROP TABLE IF EXISTS `terre217_event_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `terre217_event_registrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `code` varchar(24) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `amount` decimal(14,2) DEFAULT NULL,
  `status` enum('pending','awaiting_verification','paid','rejected') NOT NULL DEFAULT 'pending',
  `payment_proof` varchar(255) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `verified_by` varchar(255) DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_registrations_code_unique` (`code`),
  KEY `event_registrations_event_id_index` (`event_id`),
  KEY `event_registrations_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `terre217_event_registrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `terre217_event_registrations` ENABLE KEYS */;
DROP TABLE IF EXISTS `terre217_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `terre217_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(14,2) DEFAULT NULL,
  `payment_instructions` text DEFAULT NULL,
  `opens_at` datetime DEFAULT NULL,
  `closes_at` datetime DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `phase` enum('registration','draw','running','finished') NOT NULL DEFAULT 'registration',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `terre217_events` DISABLE KEYS */;
INSERT INTO `terre217_events` VALUES (1,'Jaya Tennis Championship 2026','grandstand-open-2026','Eight days of championship tennis on grass. Singles, doubles and club team events — open to registered players of every grade.',750000.00,'Transfer the entry fee to:\n\n  Bank Mandiri\n  1234567890\n  Hipmi Jaya Tennis Club\n\nQuote your registration code as the transfer reference, then upload the transfer receipt on the confirmation page. Entries are confirmed once an official has checked the payment.','2026-07-01 00:00:00','2026-09-30 23:59:59',1,'registration','2026-08-31 14:17:08','2026-08-31 14:17:08');
/*!40000 ALTER TABLE `terre217_events` ENABLE KEYS */;
DROP TABLE IF EXISTS `terre217_event_team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `terre217_event_team_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(40) DEFAULT NULL,
  `rank` varchar(20) DEFAULT NULL,
  `bio` varchar(400) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_team_members_team_id_index` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `terre217_event_team_members` DISABLE KEYS */;
INSERT INTO `terre217_event_team_members` VALUES (49,25,'Arya Wicaksana','Captain','1',NULL,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(50,25,'Bagus Prakoso','Singles','14',NULL,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(51,26,'Dimas Haryanto','Captain','2',NULL,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(52,26,'Reza Alamsyah','Doubles','21',NULL,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(53,27,'Yusuf Ramadhan','Captain','3',NULL,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(54,27,'Ilham Saputra','Singles','18',NULL,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(55,28,'Bayu Nugroho','Captain','4',NULL,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(56,28,'Fajar Setiawan','Doubles','26',NULL,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(57,29,'Ketut Suardana','Captain','5',NULL,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(58,29,'Gede Mahendra','Singles','31',NULL,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(59,30,'Rizky Pratama','Captain','6',NULL,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(60,30,'Andre Sitorus','Doubles','29',NULL,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(61,31,'Ahmad Fauzan','Captain','7',NULL,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(62,31,'Rahmat Hidayat','Singles','35',NULL,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(63,32,'Wisnu Adiputra','Captain','8',NULL,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(64,32,'Galih Prasetyo','Doubles','40',NULL,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44');
/*!40000 ALTER TABLE `terre217_event_team_members` ENABLE KEYS */;
DROP TABLE IF EXISTS `terre217_event_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `terre217_event_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `draw_size` smallint(5) unsigned DEFAULT NULL,
  `status_label` varchar(40) DEFAULT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_categories_event_id_code_unique` (`event_id`,`code`),
  KEY `event_categories_event_id_index` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `terre217_event_categories` DISABLE KEYS */;
INSERT INTO `terre217_event_categories` VALUES (19,1,'ms','Men\'s Singles',NULL,8,NULL,0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(20,1,'ws','Women\'s Singles',NULL,8,NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(21,1,'md','Men\'s Doubles',NULL,8,NULL,2,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(22,1,'wd','Women\'s Doubles',NULL,8,NULL,3,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(23,1,'xd','Mixed Doubles',NULL,8,NULL,4,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(24,1,'ct','Club Teams',NULL,8,NULL,5,1,'2026-08-31 14:22:44','2026-08-31 14:22:44');
/*!40000 ALTER TABLE `terre217_event_categories` ENABLE KEYS */;
DROP TABLE IF EXISTS `terre217_event_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `terre217_event_schedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `starts_on` date DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `note` varchar(80) DEFAULT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_schedule_event_id_index` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `terre217_event_schedule` DISABLE KEYS */;
INSERT INTO `terre217_event_schedule` VALUES (16,1,'2026-10-12','Qualifying','Qualifying rounds, all courts','Free entry',0,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(17,1,'2026-10-14','Main draw begins','First round, singles and doubles',NULL,1,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(18,1,'2026-10-16','Quarter-finals','All categories, Centre Court and 1',NULL,2,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(19,1,'2026-10-18','Semi-finals','All categories, Centre Court',NULL,3,1,'2026-08-31 14:22:44','2026-08-31 14:22:44'),(20,1,'2026-10-19','Finals','Finals and presentation','Ticketed',4,1,'2026-08-31 14:22:44','2026-08-31 14:22:44');
/*!40000 ALTER TABLE `terre217_event_schedule` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


-- Mark the event migrations as applied.
CREATE TABLE IF NOT EXISTS `terre217_migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000001_create_event_registration_tables', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000001_create_event_registration_tables');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000002_create_event_teams_table', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000002_create_event_teams_table');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000003_create_event_schedule_table', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000003_create_event_schedule_table');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000004_create_event_matches_table', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000004_create_event_matches_table');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000005_add_court_to_event_matches', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000005_add_court_to_event_matches');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000006_create_event_categories_table', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000006_create_event_categories_table');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000007_add_category_to_event_matches', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000007_add_category_to_event_matches');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000008_link_event_teams_to_registrations', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000008_link_event_teams_to_registrations');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000009_add_permalink_to_event_teams', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000009_add_permalink_to_event_teams');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000010_create_event_team_members_table', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000010_create_event_team_members_table');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000011_add_phase_and_member_bio', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000011_add_phase_and_member_bio');
INSERT INTO `terre217_migrations` (`migration`,`batch`) SELECT '2026_08_30_000012_unique_short_code_per_event', 1 FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `terre217_migrations` WHERE `migration`='2026_08_30_000012_unique_short_code_per_event');
SET FOREIGN_KEY_CHECKS=1;
