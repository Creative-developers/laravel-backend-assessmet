# ************************************************************
# Sequel Ace SQL dump
# Version 20046
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 9.2.0)
# Database: laravel_backend_assessmet
# Generation Time: 2025-02-20 15:26:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attribute_values
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attribute_values`;

CREATE TABLE `attribute_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint unsigned NOT NULL,
  `entity_id` bigint unsigned NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_values_attribute_id_foreign` (`attribute_id`),
  KEY `attribute_values_entity_id_foreign` (`entity_id`),
  CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attribute_values_entity_id_foreign` FOREIGN KEY (`entity_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `attribute_values` WRITE;
/*!40000 ALTER TABLE `attribute_values` DISABLE KEYS */;

INSERT INTO `attribute_values` (`id`, `attribute_id`, `entity_id`, `value`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'IT','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(2,1,2,'Sales','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(3,1,3,'Sales','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(4,1,4,'Finance','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(5,1,5,'IT','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(6,1,6,'HR','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(7,1,7,'IT','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(8,1,8,'Marketing','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(9,1,9,'IT','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(10,1,10,'IT','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(11,1,11,'IT','2025-02-20 13:51:29','2025-02-20 13:51:29'),
	(12,2,11,'2025-02-01','2025-02-20 13:51:29','2025-02-20 13:51:29'),
	(13,3,11,'2025-02-11','2025-02-20 13:51:29','2025-02-20 13:51:29'),
	(14,4,11,'55','2025-02-20 13:52:03','2025-02-20 13:52:03');

/*!40000 ALTER TABLE `attribute_values` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table attributes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attributes`;

CREATE TABLE `attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `attributes` WRITE;
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;

INSERT INTO `attributes` (`id`, `name`, `type`, `created_at`, `updated_at`)
VALUES
	(1,'department','text','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(2,'start_date','date','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(3,'end_date','date','2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(4,'price','number','2025-02-20 13:48:14','2025-02-20 13:48:14');

/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cache
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cache_locks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

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



# Dump of table job_batches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;

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



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

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



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'0001_01_01_000000_create_users_table',1),
	(2,'0001_01_01_000001_create_cache_table',1),
	(3,'0001_01_01_000002_create_jobs_table',1),
	(4,'2025_02_18_164408_create_projects_table',1),
	(5,'2025_02_18_164433_create_timesheets_table',1),
	(6,'2025_02_18_170359_create-project_user_table',1),
	(7,'2025_02_18_175641_create_attributes_table',2),
	(8,'2025_02_18_175651_create_attribute_values_table',2),
	(50,'2025_02_19_124035_create_oauth_auth_codes_table',3),
	(51,'2025_02_19_124036_create_oauth_access_tokens_table',3),
	(52,'2025_02_19_124037_create_oauth_refresh_tokens_table',3),
	(53,'2025_02_19_124038_create_oauth_clients_table',3),
	(54,'2025_02_19_124039_create_oauth_personal_access_clients_table',3);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table oauth_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`)
VALUES
	('045d9f3e2702e0ec7344e2ac0b26518f316d70e7a6a537293771f78adb35ae5bb541c7f4a58b72ef',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',0,'2025-02-20 13:27:45','2025-02-20 13:27:45','2026-02-20 13:27:45'),
	('0c804a0b86e9988a4dd1c7c3ae64fe9d4a756cf7eea426574b00e030bc664850c0a4f5768caf1154',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','Auth Token','[]',0,'2025-02-19 12:41:50','2025-02-19 12:41:50','2026-02-19 12:41:50'),
	('10cae55a437147b92dc9444efd59d32b51838de675849b4ffb3bc1a2779613dd697ca51ab4bec2b5',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',1,'2025-02-19 18:47:26','2025-02-19 18:48:00','2026-02-19 18:47:26'),
	('277e7992f527fce11b3da72ea74319120bd7a04e4c5c2a6e7404b8ecc6cf344b7fa2b3cafb723d07',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',0,'2025-02-20 10:13:13','2025-02-20 10:13:13','2026-02-20 10:13:13'),
	('2ef916c7cf9722860ad4ece356c31140d7a4e42976cac37afea6ac0b468e8c7bf966931100169251',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','Auth Token','[]',0,'2025-02-19 12:57:15','2025-02-19 12:57:15','2026-02-19 12:57:15'),
	('390874fc65c019ed252e4d617237ab84dd69f5d54b4d5393534ec32e62748985d9c214906a88d557',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',1,'2025-02-19 18:48:39','2025-02-19 18:49:00','2026-02-19 18:48:39'),
	('50e04a1d6e5a54a80eb7e0dc0edae8b3d6ca113dead7ca3e9e26c706a76e44387ae230127a75c07f',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',0,'2025-02-20 12:05:39','2025-02-20 12:05:39','2026-02-20 12:05:39'),
	('5be4d1153fa72599e14f1d195a9f3e3244cca2890917d264f23656adbb604aa3ef8dfe97188adc6d',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','Auth Token','[]',1,'2025-02-19 13:12:38','2025-02-20 10:12:37','2026-02-19 13:12:38'),
	('6fd664b8293f8bd3f514d9a418d654853095e750aba3cd07465e892c8ebb5089c04dd6066929cdb0',11,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',0,'2025-02-20 13:49:16','2025-02-20 13:49:16','2026-02-20 13:49:16'),
	('77706dabee80a396a4df9afd18fa29d133212e630bc8af4b8288664cf91781a6368192009046e1ea',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','Auth Token','[]',0,'2025-02-19 12:41:04','2025-02-19 12:41:04','2026-02-19 12:41:04'),
	('800a3aafcfca162bf95e70a8d75950265e959952e43a908045dad70dfaa7196289dcfe00c8fbd1dc',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','Auth Token','[]',0,'2025-02-19 12:57:06','2025-02-19 12:57:06','2026-02-19 12:57:06'),
	('86f6fc27917ebf82bc9d0b7cf82035888a058bf97d246aef65a4e6d6943f7c1bdd42ae9e519d88b0',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',0,'2025-02-19 22:51:48','2025-02-19 22:51:48','2026-02-19 22:51:48'),
	('cbae90ddb5603c990ba1d24316652054de5557c3a83a3a09c45bd059d181bc23a38cb3568d423624',16,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',0,'2025-02-20 12:03:58','2025-02-20 12:03:58','2026-02-20 12:03:58'),
	('ccc7bbbbe4c3769105ead35bbe640200ee417eeba03332d9e5036c6cd8856fbfa395f16fbaefccf6',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',1,'2025-02-20 10:11:36','2025-02-20 12:04:09','2026-02-20 10:11:36'),
	('dc9ad1c2d06c67e9a6d9028c9892386b3f18da3f6fb9ad8ab4b0bc466aa2c9ad4234249f190815bb',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',0,'2025-02-19 18:46:56','2025-02-19 18:46:56','2026-02-19 18:46:56'),
	('faadf184202031825f4d29293e8317534415b672b92262275b9a2610e4d2391d8553f7109ad91775',1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','authToken','[]',0,'2025-02-19 18:47:00','2025-02-19 18:47:00','2026-02-19 18:47:00');

/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table oauth_auth_codes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table oauth_clients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`)
VALUES
	('9e3fce6e-35fa-4a76-9000-feb7290441e2',NULL,'Laravel Personal Access Client','EHe4ohK2dr58md9sPzYg6QVPDvx3UqKa99UqxMt6',NULL,'http://localhost',1,0,0,'2025-02-19 12:40:34','2025-02-19 12:40:34'),
	('9e3fce6e-3b09-443c-bd8a-8ab999ccb160',NULL,'Laravel Password Grant Client','4RX7ZTvnKAT4lp77fI7Qfo6Sv9BYLOU5IhFzyw5q','users','http://localhost',0,1,0,'2025-02-19 12:40:34','2025-02-19 12:40:34');

/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table oauth_personal_access_clients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`)
VALUES
	(1,'9e3fce6e-35fa-4a76-9000-feb7290441e2','2025-02-19 12:40:34','2025-02-19 12:40:34');

/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table oauth_refresh_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table project_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `project_user`;

CREATE TABLE `project_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_user_user_id_foreign` (`user_id`),
  KEY `project_user_project_id_foreign` (`project_id`),
  CONSTRAINT `project_user_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `project_user` WRITE;
/*!40000 ALTER TABLE `project_user` DISABLE KEYS */;

INSERT INTO `project_user` (`id`, `user_id`, `project_id`)
VALUES
	(1,4,1),
	(2,5,1),
	(3,8,1),
	(4,10,1),
	(5,3,2),
	(6,4,2),
	(7,6,2),
	(8,4,3),
	(9,9,3),
	(10,1,4),
	(11,4,4),
	(12,6,4),
	(13,10,4),
	(14,4,5),
	(15,7,5),
	(16,8,5),
	(17,10,5),
	(18,2,6),
	(19,3,6),
	(20,4,6),
	(21,5,6),
	(22,6,7),
	(23,2,8),
	(24,5,8),
	(25,6,8),
	(26,1,9),
	(27,2,9),
	(28,3,9),
	(29,2,10),
	(30,6,10),
	(31,10,10);

/*!40000 ALTER TABLE `project_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`id`, `name`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Lind PLC',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(2,'Eichmann-Gislason',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(3,'Sanford PLC',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(4,'McGlynn, Kuhlman and Swift',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(5,'Russel-Bosco',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(6,'O\'Connell, Marquardt and Wehner',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(7,'O\'Conner-McClure',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(8,'Crooks-Lynch',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(9,'Jerde, Jast and Gutkowski',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(10,'Kerluke Inc',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(11,'Project A',1,'2025-02-20 13:51:29','2025-02-20 13:51:29');

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table timesheets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timesheets`;

CREATE TABLE `timesheets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `task_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hours` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timesheets_user_id_foreign` (`user_id`),
  KEY `timesheets_project_id_foreign` (`project_id`),
  CONSTRAINT `timesheets_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `timesheets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `timesheets` WRITE;
/*!40000 ALTER TABLE `timesheets` DISABLE KEYS */;

INSERT INTO `timesheets` (`id`, `user_id`, `project_id`, `task_name`, `date`, `hours`, `created_at`, `updated_at`)
VALUES
	(1,4,1,'Marketing Manager','2021-02-16',7.50,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(2,5,1,'Grounds Maintenance Worker','2023-06-14',6.64,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(3,8,1,'Clinical Psychologist','1980-06-02',6.16,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(4,10,1,'Staff Psychologist','1983-09-30',1.37,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(5,3,2,'Screen Printing Machine Operator','1973-08-13',7.23,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(6,4,2,'Separating Machine Operators','2013-07-12',2.53,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(7,6,2,'Museum Conservator','2011-12-06',6.01,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(8,4,3,'Lathe Operator','2021-09-10',2.87,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(9,9,3,'Private Sector Executive','2003-09-20',3.50,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(10,1,4,'Human Resource Manager','1992-07-07',7.05,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(11,4,4,'Materials Inspector','1997-07-19',3.27,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(12,6,4,'Communications Teacher','2007-01-16',6.91,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(13,10,4,'Aircraft Launch Specialist','1997-12-06',1.72,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(14,4,5,'Material Movers','2019-11-30',4.91,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(15,7,5,'Bicycle Repairer','1988-10-05',3.58,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(16,8,5,'Engine Assembler','1981-10-06',7.88,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(17,10,5,'Machine Operator','1971-01-26',4.26,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(18,2,6,'Shoe and Leather Repairer','1972-11-24',7.23,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(19,3,6,'Explosives Expert','2000-10-12',5.97,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(20,4,6,'Parking Enforcement Worker','1981-04-28',1.04,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(21,5,6,'Home Health Aide','2000-02-16',3.05,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(22,6,7,'Production Planner','1995-10-09',4.63,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(23,2,8,'Crane and Tower Operator','1986-05-23',6.69,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(24,5,8,'Rotary Drill Operator','2020-02-03',4.65,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(25,6,8,'Reporters OR Correspondent','1974-08-24',3.28,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(26,1,9,'Hand Presser','1971-09-11',5.92,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(27,2,9,'Parking Enforcement Worker','2002-01-23',5.93,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(28,3,9,'Anthropology Teacher','1986-10-16',7.82,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(29,2,10,'Tire Builder','1985-07-08',5.99,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(30,6,10,'Spraying Machine Operator','1991-06-10',5.30,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(31,10,10,'Diesel Engine Specialist','2002-11-30',7.94,'2025-02-20 13:48:14','2025-02-20 13:48:14');

/*!40000 ALTER TABLE `timesheets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'May','Effertz','sincere.hirthe@example.net','$2y$12$LOQSJmHsT7ZJWq34y8SLoeeU1X699f7cgg8696HzhZJ8cvq.uZAva',1,'2025-02-20 13:48:11','2025-02-20 13:48:11'),
	(2,'Minnie','Halvorson','talia20@example.net','$2y$12$P37pH9cVo6ygAHwytHtTi.1gP/GE2fJsVODfvsyWmHci84.FYMJnC',1,'2025-02-20 13:48:11','2025-02-20 13:48:11'),
	(3,'Corrine','Ledner','dashawn.fay@example.org','$2y$12$PIiaYQWOtYTINmvSp5s9aujdM6m20vLTCIo/xtY2nIku8yTazy65O',1,'2025-02-20 13:48:12','2025-02-20 13:48:12'),
	(4,'Russ','Wehner','lambert.padberg@example.net','$2y$12$QZybPtH2DB6ScgDVftP20.eYLhLezBi.pu4oRQXs6C5gpivQBcZDG',1,'2025-02-20 13:48:12','2025-02-20 13:48:12'),
	(5,'Glen','Roberts','astoltenberg@example.org','$2y$12$tdWSgdsCivOZOFlqmCWHq.V2XtGNLg4WsHbf3ZjQ4ZKROSJULXon2',1,'2025-02-20 13:48:12','2025-02-20 13:48:12'),
	(6,'Isom','Bosco','vschumm@example.com','$2y$12$Uo5eGuSBS/vm9VDiFhtBjucovdgwQ43YtmfkiSMgsH/.mDSm4gTqK',1,'2025-02-20 13:48:13','2025-02-20 13:48:13'),
	(7,'Peyton','Hoppe','johann.halvorson@example.org','$2y$12$BosaSIE3mTld6e/KDP5FNetDhExtCaKMf/KclZAbKI8ThYWpryyFW',1,'2025-02-20 13:48:13','2025-02-20 13:48:13'),
	(8,'Christian','Nader','murazik.misael@example.com','$2y$12$HXI3U1mXC7GzoxpKl7cyKe9TR57psH0C3FzvsgYoqmxDbyNCvEog.',1,'2025-02-20 13:48:13','2025-02-20 13:48:13'),
	(9,'Janet','Gutmann','jazlyn.hayes@example.org','$2y$12$6MZOVz9/zl6.bCD56rmepu04hq59T6pMEmPpb7Aa5oewpASj.AjoC',1,'2025-02-20 13:48:13','2025-02-20 13:48:13'),
	(10,'Rylan','Fisher','kanderson@example.com','$2y$12$X67WceZj/RGl3GEGcvI5oO6hq7Nvvj3k3Rgg7qw.nrWYpgj4faeOe',1,'2025-02-20 13:48:14','2025-02-20 13:48:14'),
	(11,'Test','user','testuser@gmail.com','$2y$12$y8DL2G5a40IB2euZWS50mu9JMg7Dp9iSq4lFYNZm1625xbRXmlX4y',1,'2025-02-20 13:48:53','2025-02-20 13:48:53');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
