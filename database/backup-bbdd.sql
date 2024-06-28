-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for app-challenge-ocmi
CREATE DATABASE IF NOT EXISTS `app-challenge-ocmi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `app-challenge-ocmi`;

-- Dumping structure for table app-challenge-ocmi.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.clients: ~2 rows (approximately)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
REPLACE INTO `clients` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', '2024-06-27 04:43:44', '2024-06-27 04:43:44'),
	(2, 'Clientes', '2024-06-27 05:39:01', '2024-06-27 05:39:01');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `document` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentType` enum('perHour','salary') COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentAmount` decimal(10,2) NOT NULL,
  `clientId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_document_clientid_unique` (`document`,`clientId`),
  KEY `employees_clientid_foreign` (`clientId`),
  CONSTRAINT `employees_clientid_foreign` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.employees: ~2 rows (approximately)
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
REPLACE INTO `employees` (`id`, `document`, `name`, `paymentType`, `paymentAmount`, `clientId`, `created_at`, `updated_at`) VALUES
	(1, '1053859032', 'Juan Pablo Caguasango Enriquez', 'perHour', 480.00, 1, '2024-06-27 04:45:53', '2024-06-27 04:45:53'),
	(2, '1053859033', 'Maria Camila Arroyave', 'salary', 4800.00, 1, '2024-06-27 05:06:42', '2024-06-27 05:10:10');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.migrations: ~15 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(16, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
	(17, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
	(18, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
	(19, '2016_06_01_000004_create_oauth_clients_table', 1),
	(20, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
	(21, '2019_08_19_000000_create_failed_jobs_table', 1),
	(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(23, '2024_06_27_004316_create_clients_table', 1),
	(24, '2024_06_27_004858_create_users_table', 1),
	(25, '2024_06_27_004932_create_employees_table', 1),
	(26, '2024_06_27_004943_create_timesheets_table', 1),
	(27, '2024_06_27_005248_create_roles_table', 1),
	(28, '2024_06_27_005255_create_permissions_table', 1),
	(29, '2024_06_27_005451_create_permission_role_table', 1),
	(30, '2024_06_27_005536_create_role_user_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.oauth_access_tokens: ~6 rows (approximately)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
REPLACE INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('68c76ee764cf53ec3d34eca2f3bc7477fc323ddf293bfdfeac7b6965845b89d792b8fb81d3201c60', 2, 1, 'token.juan.enriquez@gmail.com', '["client.main","users.index","timesheets.index","employees.index"]', 0, '2024-06-27 06:04:34', '2024-06-27 06:04:34', '2025-06-27 06:04:34'),
	('8356904721432e955c5680aa3213c063ca5b0aab49003550c63ca8ee4c673d5b3425d35b18ee22c1', 2, 1, 'token.juan.enriquez@gmail.com', '["client.main","users.index","timesheets.index","employees.index"]', 0, '2024-06-28 02:48:23', '2024-06-28 02:48:23', '2025-06-28 02:48:23'),
	('879061da6f5e78b13012e90f41098164eecc4fb6f7bebe07f5533b0b2db910f29ec344fee84374d1', 2, 1, 'token.juan.enriquez@gmail.com', '["client.main","users.index","timesheets.index","employees.index"]', 0, '2024-06-27 05:47:37', '2024-06-27 05:47:37', '2025-06-27 05:47:37'),
	('98bd32e711a92ecbdcfae7000039b9a41c3157481d9bd4dcec8d8cc0328b79c904e14ce246e54936', 2, 1, 'token.juan.enriquez@gmail.com', '["client.main","users.index","timesheets.index"]', 0, '2024-06-27 05:42:19', '2024-06-27 05:42:19', '2025-06-27 05:42:19'),
	('a32eafa2163051a0164c065fce385874f11d9762e7970f004bfe00a875899178895c236e88abd4f5', 1, 1, 'token.admin@admin.com', '["*"]', 0, '2024-06-28 19:11:04', '2024-06-28 19:11:04', '2025-06-28 19:11:04'),
	('d742ecb31e768a7f0ce4d6d726374da5f0bb0588fa6fec97217d5c959a3dc3c8fd2ec9de12ca4d9f', 2, 1, 'token.juan.enriquez@gmail.com', '[]', 0, '2024-06-27 05:39:21', '2024-06-27 05:39:21', '2025-06-27 05:39:21');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.oauth_auth_codes: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.oauth_clients: ~2 rows (approximately)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
REPLACE INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'fOcbupjGC42PhdUwEfyEgp7hhA5ZH5qLIJJmGX7z', NULL, 'http://localhost', 1, 0, 0, '2024-06-27 04:44:40', '2024-06-27 04:44:40'),
	(2, NULL, 'Laravel Password Grant Client', 'k1HIip2FCJScMLH5Jm0a1vngbjL5Ks0VrvTOwLYH', 'users', 'http://localhost', 0, 1, 0, '2024-06-27 04:44:40', '2024-06-27 04:44:40');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.oauth_personal_access_clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
REPLACE INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2024-06-27 04:44:40', '2024-06-27 04:44:40');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.oauth_refresh_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.permissions: ~2 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
REPLACE INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Consultas lista de usuarios', 'users.index', '2024-06-27 05:39:55', '2024-06-27 05:39:55'),
	(2, 'Consultar lista de timesheets', 'timesheets.index', '2024-06-27 05:40:26', '2024-06-27 05:40:26'),
	(3, 'Consultar lista de empleados', 'employees.index', '2024-06-27 05:45:43', '2024-06-27 05:45:43');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roleId` bigint(20) unsigned NOT NULL,
  `permissionId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_roleid_foreign` (`roleId`),
  KEY `permission_role_permissionid_foreign` (`permissionId`),
  CONSTRAINT `permission_role_permissionid_foreign` FOREIGN KEY (`permissionId`) REFERENCES `permissions` (`id`),
  CONSTRAINT `permission_role_roleid_foreign` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.permission_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
REPLACE INTO `permission_role` (`id`, `roleId`, `permissionId`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, '2024-06-27 05:41:40', '2024-06-27 05:41:40'),
	(2, 2, 2, '2024-06-27 05:41:40', '2024-06-27 05:41:40'),
	(3, 2, 3, '2024-06-27 05:47:19', '2024-06-27 05:47:19');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullAccess` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`id`, `name`, `slug`, `fullAccess`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'all.admin', 1, '2024-06-27 04:44:02', '2024-06-27 04:44:02'),
	(2, 'Cliente', 'client.main', 0, '2024-06-27 05:41:14', '2024-06-27 05:41:14');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roleId` bigint(20) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_roleid_foreign` (`roleId`),
  KEY `role_user_userid_foreign` (`userId`),
  CONSTRAINT `role_user_roleid_foreign` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_user_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.role_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
REPLACE INTO `role_user` (`id`, `roleId`, `userId`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2024-06-27 04:44:14', '2024-06-27 04:44:14'),
	(2, 2, 2, '2024-06-27 05:42:12', '2024-06-27 05:42:12');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.timesheets
CREATE TABLE IF NOT EXISTS `timesheets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` json NOT NULL,
  `grossWages` decimal(10,2) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `checkDate` datetime NOT NULL,
  `startPaymentPeriod` datetime NOT NULL,
  `endPaymentPeriod` datetime NOT NULL,
  `state` enum('pending','rejected','success') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clientId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timesheets_clientid_foreign` (`clientId`),
  CONSTRAINT `timesheets_clientid_foreign` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.timesheets: ~2 rows (approximately)
/*!40000 ALTER TABLE `timesheets` DISABLE KEYS */;
REPLACE INTO `timesheets` (`id`, `name`, `metadata`, `grossWages`, `comments`, `checkDate`, `startPaymentPeriod`, `endPaymentPeriod`, `state`, `clientId`, `created_at`, `updated_at`) VALUES
	(1, 'Nomina 1', '[{"id": 1, "name": "Juan Pablo Caguasango Enriquez", "clientId": 1, "document": "1053859032", "created_at": "2024-06-27 04:45", "updated_at": "2024-06-27 04:45", "paymentType": "perHour", "paymentAmount": 480}, {"id": 2, "name": "Maria Camila Arroyave", "clientId": 1, "document": "1053859033", "created_at": "2024-06-27 05:06", "updated_at": "2024-06-27 05:10", "paymentType": "salary", "paymentAmount": 4800}]', 5200.89, NULL, '2024-06-27 00:00:00', '2024-06-21 00:00:00', '2024-06-27 00:00:00', 'pending', 1, '2024-06-27 05:19:04', '2024-06-27 05:19:04'),
	(2, 'Nomina 2', '[{"id": 1, "name": "Juan Pablo Caguasango Enriquez", "clientId": 1, "document": "1053859032", "created_at": "2024-06-27 04:45", "updated_at": "2024-06-27 04:45", "paymentType": "perHour", "paymentAmount": 480}, {"id": 2, "name": "Maria Camila Arroyave", "clientId": 1, "document": "1053859033", "created_at": "2024-06-27 05:06", "updated_at": "2024-06-27 05:10", "paymentType": "salary", "paymentAmount": 4800}]', 2434.89, NULL, '2024-06-27 00:00:00', '2024-06-21 00:00:00', '2024-06-27 00:00:00', 'pending', 1, '2024-06-27 05:23:44', '2024-06-27 05:23:44'),
	(3, 'Nomina 2', '[{"id": 1, "name": "Juan Pablo Caguasango Enriquez", "clientId": 1, "document": "1053859032", "created_at": "2024-06-27 04:45", "updated_at": "2024-06-27 04:45", "paymentType": "perHour", "paymentAmount": 480}, {"id": 2, "name": "Maria Camila Arroyave", "clientId": 1, "document": "1053859033", "created_at": "2024-06-27 05:06", "updated_at": "2024-06-27 05:10", "paymentType": "salary", "paymentAmount": 4800}]', 2434.89, NULL, '2024-06-27 00:00:00', '2024-06-21 00:00:00', '2024-06-27 00:00:00', 'pending', 1, '2024-06-27 05:37:57', '2024-06-27 05:37:57');
/*!40000 ALTER TABLE `timesheets` ENABLE KEYS */;

-- Dumping structure for table app-challenge-ocmi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clientId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_clientid_foreign` (`clientId`),
  CONSTRAINT `users_clientid_foreign` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-challenge-ocmi.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `username`, `password`, `clientId`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'admin@admin.com', '$2y$12$atekhVFvguIQcgTrfSeHvekKcalT7W1bZaDhNOwVAnz36QV/QzLLa', 1, '2024-06-27 04:43:49', '2024-06-27 04:43:49'),
	(2, 'Juan Pablo Caguasango', 'juan.enriquez@gmail.com', '$2y$12$T6GZMUp8wK4QndPQf2TGaOMmp2ybkFrqlljmWuSXSrUHi4v5RylIy', 2, '2024-06-27 05:39:07', '2024-06-27 05:39:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
