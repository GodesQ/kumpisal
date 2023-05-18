-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 18, 2023 at 09:18 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kumpisalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_verify` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `name`, `is_verify`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'godesq', 'james@godesq.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'James', 'GodesQ', 'James GodesQ', 1, 0, 0, '2023-05-17 06:14:07', '2023-05-17 06:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `churches`
--

DROP TABLE IF EXISTS `churches`;
CREATE TABLE IF NOT EXISTS `churches` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `church_uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `church_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parish_priest` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feast_date` date DEFAULT NULL,
  `criteria` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `churches`
--

INSERT INTO `churches` (`id`, `church_uuid`, `name`, `description`, `church_image`, `address`, `latitude`, `longitude`, `parish_priest`, `feast_date`, `criteria`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '99315597-2a25-433e-8be3-6eea4a36baf9', 'Ina ng Lupang Pangako Parish Church', 'Our church embraces diversity and promotes inclusivity, fostering an atmosphere of acceptance and understanding. We are committed to serving the needs of our members and the local community through various outreach programs and social initiatives.\r\n\r\nOur worship services are characterized by heartfelt music, engaging sermons, and a warm sense of fellowship. We provide opportunities for spiritual growth and education through Bible studies, prayer groups, and discipleship programs.\r\n\r\nThe church building itself is a beautiful sanctuary, adorned with inspiring stained glass windows and a peaceful ambiance. We also offer modern amenities and facilities to accommodate the needs of our congregation, including classrooms, a community hall, and a nursery.', 'ina_ng_lupang_pangako_parish_church.jpg', 'Ina ng Lupang Pangako Parish Church - Payatas, Quezon City (Diocese of Novaliches), Quezon City, Metro Manila, Philippines', '14.7196607', '121.107465', 'Rowen Carlos', '2020-01-05', 'diocese', 0, 0, '2023-05-17 17:01:24', '2023-05-18 01:02:35'),
(2, '99318045-ba04-4619-9082-0bc88d6e3d21', 'Diocesan Shrine and Parish of Nuestra Señora de Aranzazu', 'The history of the Nuestra Señora de Aránzazu (also known as Birhen ng Bayang San Mateo) in San Mateo, Rizal dates back to the early Spanish era of 1705. A Jesuit priest, Padre Juan de Echazabal, started the devotion to Our Lady of Aránzazu from Spain and changed the patron of the town from St.', 'diocesan_shrine_and_parish_of_nuestra_señora_de_aranzazu.jpg', 'Sta. Ana Cemetery, Gen. Luna St, Guitang Bayan 1, San Mateo, Rizal, Philippines', '14.6897983', '121.1167228', 'James Garnfil', '1875-09-09', 'vicariate', 0, 0, '2023-05-17 19:00:45', '2023-05-18 01:13:48'),
(3, '99318452-2a94-4243-9914-d08f268a9146', 'Our Lady of the Most Holy Rosary Parish Church', 'The story of the feast of Our Lady of the Rosary focuses on the intercessory power of Mary. It shows that when Christians are in danger, they can go to Mary. And when an individual is in pain, discouraged, or having trouble accepting God\'s will, he or she can also go to Mary.', 'our_lady_of_the_most_holy_rosary_parish_church.jpg', 'Balite, J. P. Rizal Street, Rodriguez, Rizal, Philippines', '14.734091', '121.1456447', 'George Benedict', '1901-05-01', 'diocese', 0, 0, '2023-05-17 19:12:04', '2023-05-18 01:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `confession_schedules`
--

DROP TABLE IF EXISTS `confession_schedules`;
CREATE TABLE IF NOT EXISTS `confession_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `church_uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `started_date` date NOT NULL,
  `started_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2023_05_15_065328_create_church_table', 1),
(3, '2023_05_15_070525_create_confession_schedules_table', 1),
(4, '2023_05_15_070920_create_users_confession_schedules_table', 1),
(5, '2023_05_15_125114_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_image` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` double(8,2) DEFAULT NULL,
  `longitude` double(8,2) DEFAULT NULL,
  `role` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_verify` tinyint(1) DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_uuid`, `name`, `user_image`, `email`, `password`, `firstname`, `lastname`, `middlename`, `address`, `latitude`, `longitude`, `role`, `is_verify`, `email_verified_at`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '992fc5b5-3ef7-4d2c-911a-5b7c88a7ca67', 'James Godesq', NULL, 'james@godesq.com', '$2y$10$ykNmYekngvhDX9.Avu7AJux3bN3qnrhp0.4oh7q6cBLTq9EMCBVM6', 'James', 'Godesq', 'Benedict', NULL, NULL, NULL, NULL, 1, NULL, 0, 0, '2023-05-16 22:23:15', '2023-05-17 15:56:42'),
(2, '992fcbb6-0f9f-4c1e-babb-4f1b134d28b8', 'James Garnfil', NULL, 'jamesgarnfil15@gmail.com', '$2y$10$P4eNGna4RMEfEqSMJoD6lOdP/P4iexOhBS5n8fi1QAU7ooNJY1kd2', 'James', 'Garnfil', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '2023-05-16 22:40:02', '2023-05-16 22:40:02'),
(3, '992fead0-329b-4f0d-bc7f-d3a777af3559', 'Joshua Reyes', NULL, 'joshuaclarkreyes2023@gmail.com', '$2y$10$CN/hngAkUen1ODyZwTqmYOZAMWjUGJGlT8gjZroiwXiyAWtHgK31u', 'Joshua', 'Reyes', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '2023-05-17 00:07:00', '2023-05-17 00:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_confession_schedules`
--

DROP TABLE IF EXISTS `users_confession_schedules`;
CREATE TABLE IF NOT EXISTS `users_confession_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `confession_schedule_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
