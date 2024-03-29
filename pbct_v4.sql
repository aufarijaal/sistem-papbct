-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 06:30 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbct_v4`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `machineid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 0,
  `isayakanactive` tinyint(1) NOT NULL DEFAULT 0,
  `temperature` double(8,2) NOT NULL DEFAULT 0.00,
  `current_weight` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`machineid`, `owner_username`, `isactive`, `isayakanactive`, `temperature`, `current_weight`, `created_at`, `updated_at`) VALUES
('abc123', 'owner1', 0, 0, 32.00, 170.00, NULL, NULL),
('bcd456', NULL, 0, 0, 33.20, 0.00, NULL, NULL),
('efg789', NULL, 0, 0, 40.00, 0.00, NULL, NULL),
('hij123', NULL, 0, 0, 35.80, 0.00, NULL, NULL),
('klm456', NULL, 0, 0, 29.10, 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(36, '2014_10_12_000000_create_users_table', 1),
(37, '2014_10_12_100000_create_password_resets_table', 1),
(38, '2019_08_19_000000_create_failed_jobs_table', 1),
(39, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(40, '2022_05_22_221050_create_stats_table', 1),
(41, '2022_05_22_221139_create_machines_table', 1),
(42, '2022_05_23_144254_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('WBbMN4x5AaFGQiIFxXKQwdjEILn1vEe4uMAFJ6Y3', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieW5aYzZveFA4bE8zbm1mNEc2THJnQmgzNm9KdzIySllBVnl0MW03SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdGF0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1659000619);

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `machineid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `machineid`, `weight`, `created_at`, `updated_at`) VALUES
(1, 'bcd456', 396.80, '2022-06-18 08:58:39', '2022-06-18 08:58:39'),
(2, 'klm456', 407.50, '2022-06-12 20:41:40', '2022-06-12 20:41:40'),
(3, 'abc123', 187.60, '2022-06-11 17:31:51', '2022-06-11 17:31:51'),
(4, 'hij123', 242.30, '2022-06-22 15:30:22', '2022-06-22 15:30:22'),
(5, 'bcd456', 234.50, '2022-06-19 20:58:52', '2022-06-19 20:58:52'),
(6, 'hij123', 284.20, '2022-06-28 16:44:22', '2022-06-28 16:44:22'),
(7, 'efg789', 461.10, '2022-06-16 23:26:28', '2022-06-16 23:26:28'),
(8, 'abc123', 27.40, '2022-06-24 20:15:45', '2022-06-24 20:15:45'),
(9, 'bcd456', 194.60, '2022-06-28 06:02:27', '2022-06-28 06:02:27'),
(10, 'abc123', 456.90, '2022-06-06 02:25:54', '2022-06-06 02:25:54'),
(11, 'hij123', 105.20, '2022-06-09 23:46:58', '2022-06-09 23:46:58'),
(12, 'klm456', 392.50, '2022-07-01 02:34:56', '2022-07-01 02:34:56'),
(13, 'bcd456', 32.10, '2022-06-24 03:48:32', '2022-06-24 03:48:32'),
(14, 'abc123', 343.50, '2022-06-08 14:01:31', '2022-06-08 14:01:31'),
(15, 'efg789', 224.70, '2022-06-04 22:07:01', '2022-06-04 22:07:01'),
(16, 'hij123', 55.50, '2022-06-12 11:10:31', '2022-06-12 11:10:31'),
(17, 'bcd456', 244.80, '2022-06-14 00:09:58', '2022-06-14 00:09:58'),
(18, 'abc123', 386.90, '2022-06-17 06:57:43', '2022-06-17 06:57:43'),
(19, 'klm456', 427.00, '2022-06-29 14:19:50', '2022-06-29 14:19:50'),
(20, 'bcd456', 276.00, '2022-06-12 19:53:51', '2022-06-12 19:53:51'),
(21, 'abc123', 418.30, '2022-06-24 06:44:42', '2022-06-24 06:44:42'),
(22, 'klm456', 34.50, '2022-06-17 00:46:33', '2022-06-17 00:46:33'),
(23, 'klm456', 76.10, '2022-06-16 11:30:41', '2022-06-16 11:30:41'),
(24, 'efg789', 268.40, '2022-06-27 11:53:15', '2022-06-27 11:53:15'),
(25, 'bcd456', 498.20, '2022-06-28 10:06:42', '2022-06-28 10:06:42'),
(26, 'klm456', 345.00, '2022-06-05 06:00:00', '2022-06-05 06:00:00'),
(27, 'efg789', 418.50, '2022-07-01 09:15:49', '2022-07-01 09:15:49'),
(28, 'hij123', 331.30, '2022-06-28 05:45:15', '2022-06-28 05:45:15'),
(29, 'efg789', 128.40, '2022-07-01 14:56:18', '2022-07-01 14:56:18'),
(30, 'efg789', 388.80, '2022-06-20 05:57:05', '2022-06-20 05:57:05'),
(31, 'hij123', 110.50, '2022-06-07 18:36:00', '2022-06-07 18:36:00'),
(32, 'efg789', 371.20, '2022-06-14 20:55:27', '2022-06-14 20:55:27'),
(33, 'bcd456', 493.00, '2022-06-29 20:47:18', '2022-06-29 20:47:18'),
(34, 'efg789', 464.90, '2022-06-10 09:06:01', '2022-06-10 09:06:01'),
(35, 'efg789', 165.30, '2022-06-06 07:27:35', '2022-06-06 07:27:35'),
(36, 'efg789', 449.20, '2022-06-21 08:54:29', '2022-06-21 08:54:29'),
(37, 'klm456', 138.90, '2022-06-21 03:38:48', '2022-06-21 03:38:48'),
(38, 'efg789', 87.40, '2022-06-21 11:09:18', '2022-06-21 11:09:18'),
(39, 'abc123', 204.80, '2022-06-26 14:59:43', '2022-06-26 14:59:43'),
(40, 'klm456', 496.60, '2022-06-07 03:05:24', '2022-06-07 03:05:24'),
(41, 'efg789', 269.20, '2022-06-22 03:53:00', '2022-06-22 03:53:00'),
(42, 'hij123', 333.80, '2022-06-05 01:39:02', '2022-06-05 01:39:02'),
(43, 'bcd456', 429.30, '2022-06-04 18:49:57', '2022-06-04 18:49:57'),
(44, 'bcd456', 432.70, '2022-06-24 08:46:55', '2022-06-24 08:46:55'),
(45, 'klm456', 37.80, '2022-07-02 15:41:24', '2022-07-02 15:41:24'),
(46, 'klm456', 289.10, '2022-07-03 14:11:34', '2022-07-03 14:11:34'),
(47, 'efg789', 275.70, '2022-06-23 10:25:05', '2022-06-23 10:25:05'),
(48, 'efg789', 447.60, '2022-06-21 06:41:47', '2022-06-21 06:41:47'),
(49, 'efg789', 130.00, '2022-06-14 17:05:45', '2022-06-14 17:05:45'),
(50, 'efg789', 343.30, '2022-06-21 15:39:11', '2022-06-21 15:39:11'),
(51, 'bcd456', 413.10, '2022-06-07 20:04:13', '2022-06-07 20:04:13'),
(52, 'efg789', 90.70, '2022-06-21 14:23:44', '2022-06-21 14:23:44'),
(53, 'klm456', 92.50, '2022-06-18 10:32:48', '2022-06-18 10:32:48'),
(54, 'efg789', 199.30, '2022-06-30 12:13:51', '2022-06-30 12:13:51'),
(55, 'efg789', 392.30, '2022-06-04 19:51:40', '2022-06-04 19:51:40'),
(56, 'efg789', 47.10, '2022-07-04 03:14:04', '2022-07-04 03:14:04'),
(57, 'bcd456', 26.00, '2022-06-22 09:16:54', '2022-06-22 09:16:54'),
(58, 'hij123', 378.30, '2022-06-18 15:16:00', '2022-06-18 15:16:00'),
(59, 'abc123', 308.00, '2022-06-10 12:00:10', '2022-06-10 12:00:10'),
(60, 'abc123', 200.10, '2022-06-11 08:25:01', '2022-06-11 08:25:01'),
(61, 'hij123', 491.60, '2022-06-14 02:35:49', '2022-06-14 02:35:49'),
(62, 'bcd456', 214.90, '2022-06-19 22:07:52', '2022-06-19 22:07:52'),
(63, 'efg789', 134.10, '2022-06-15 00:41:27', '2022-06-15 00:41:27'),
(64, 'hij123', 16.80, '2022-06-14 22:57:58', '2022-06-14 22:57:58'),
(65, 'efg789', 421.00, '2022-06-12 01:16:18', '2022-06-12 01:16:18'),
(66, 'klm456', 493.50, '2022-06-14 04:00:15', '2022-06-14 04:00:15'),
(67, 'efg789', 8.90, '2022-06-29 20:50:36', '2022-06-29 20:50:36'),
(68, 'klm456', 432.60, '2022-07-04 03:31:13', '2022-07-04 03:31:13'),
(69, 'hij123', 473.10, '2022-06-13 16:28:21', '2022-06-13 16:28:21'),
(70, 'bcd456', 159.20, '2022-06-19 08:23:58', '2022-06-19 08:23:58'),
(71, 'klm456', 163.50, '2022-06-11 13:33:44', '2022-06-11 13:33:44'),
(72, 'bcd456', 204.90, '2022-06-14 11:37:54', '2022-06-14 11:37:54'),
(73, 'bcd456', 456.80, '2022-06-09 10:37:28', '2022-06-09 10:37:28'),
(74, 'efg789', 359.80, '2022-06-14 04:29:34', '2022-06-14 04:29:34'),
(75, 'abc123', 441.80, '2022-06-06 12:41:35', '2022-06-06 12:41:35'),
(76, 'abc123', 71.50, '2022-06-08 16:02:31', '2022-06-08 16:02:31'),
(77, 'hij123', 53.00, '2022-06-13 14:52:29', '2022-06-13 14:52:29'),
(78, 'klm456', 176.90, '2022-06-25 05:32:21', '2022-06-25 05:32:21'),
(79, 'hij123', 251.30, '2022-06-26 11:39:54', '2022-06-26 11:39:54'),
(80, 'hij123', 382.70, '2022-06-16 12:45:45', '2022-06-16 12:45:45'),
(81, 'abc123', 225.60, '2022-06-29 12:54:53', '2022-06-29 12:54:53'),
(82, 'klm456', 17.50, '2022-07-03 16:52:35', '2022-07-03 16:52:35'),
(83, 'bcd456', 355.70, '2022-06-18 00:52:36', '2022-06-18 00:52:36'),
(84, 'bcd456', 437.80, '2022-06-16 16:27:51', '2022-06-16 16:27:51'),
(85, 'hij123', 342.00, '2022-06-13 19:51:54', '2022-06-13 19:51:54'),
(86, 'klm456', 19.30, '2022-06-05 01:43:33', '2022-06-05 01:43:33'),
(87, 'klm456', 146.70, '2022-06-17 17:46:15', '2022-06-17 17:46:15'),
(88, 'hij123', 202.50, '2022-06-27 19:49:24', '2022-06-27 19:49:24'),
(89, 'efg789', 55.00, '2022-06-13 06:46:19', '2022-06-13 06:46:19'),
(90, 'klm456', 128.50, '2022-07-01 23:42:34', '2022-07-01 23:42:34'),
(91, 'efg789', 329.90, '2022-06-11 00:16:19', '2022-06-11 00:16:19'),
(92, 'efg789', 192.30, '2022-06-06 12:07:26', '2022-06-06 12:07:26'),
(93, 'efg789', 425.90, '2022-06-11 03:27:41', '2022-06-11 03:27:41'),
(94, 'bcd456', 359.50, '2022-06-14 16:12:22', '2022-06-14 16:12:22'),
(95, 'hij123', 352.50, '2022-06-16 19:48:24', '2022-06-16 19:48:24'),
(96, 'klm456', 385.00, '2022-06-09 19:20:01', '2022-06-09 19:20:01'),
(97, 'bcd456', 1.20, '2022-06-09 03:58:29', '2022-06-09 03:58:29'),
(98, 'efg789', 379.80, '2022-07-03 23:45:16', '2022-07-03 23:45:16'),
(99, 'efg789', 39.80, '2022-06-24 15:25:31', '2022-06-24 15:25:31'),
(100, 'efg789', 395.80, '2022-06-07 14:06:40', '2022-06-07 14:06:40'),
(101, 'klm456', 465.40, '2022-06-08 16:39:49', '2022-06-08 16:39:49'),
(102, 'klm456', 354.20, '2022-06-10 08:30:51', '2022-06-10 08:30:51'),
(103, 'hij123', 37.90, '2022-06-27 01:43:06', '2022-06-27 01:43:06'),
(104, 'bcd456', 280.90, '2022-06-04 13:16:15', '2022-06-04 13:16:15'),
(105, 'klm456', 451.30, '2022-06-05 14:20:31', '2022-06-05 14:20:31'),
(106, 'klm456', 416.80, '2022-06-17 15:55:21', '2022-06-17 15:55:21'),
(107, 'klm456', 13.50, '2022-06-23 11:29:50', '2022-06-23 11:29:50'),
(108, 'klm456', 28.10, '2022-06-23 12:13:44', '2022-06-23 12:13:44'),
(109, 'bcd456', 290.90, '2022-06-07 13:30:52', '2022-06-07 13:30:52'),
(110, 'hij123', 126.10, '2022-07-03 18:06:13', '2022-07-03 18:06:13'),
(111, 'bcd456', 131.20, '2022-06-07 18:23:10', '2022-06-07 18:23:10'),
(112, 'hij123', 7.10, '2022-06-15 11:59:19', '2022-06-15 11:59:19'),
(113, 'efg789', 15.40, '2022-06-15 16:39:51', '2022-06-15 16:39:51'),
(114, 'bcd456', 63.90, '2022-06-07 22:58:28', '2022-06-07 22:58:28'),
(115, 'hij123', 190.50, '2022-06-10 06:45:05', '2022-06-10 06:45:05'),
(116, 'efg789', 378.90, '2022-06-14 15:32:15', '2022-06-14 15:32:15'),
(117, 'efg789', 263.10, '2022-06-05 08:50:14', '2022-06-05 08:50:14'),
(118, 'bcd456', 273.50, '2022-06-18 06:34:58', '2022-06-18 06:34:58'),
(119, 'bcd456', 206.50, '2022-06-10 15:58:15', '2022-06-10 15:58:15'),
(120, 'klm456', 31.70, '2022-06-18 10:19:27', '2022-06-18 10:19:27'),
(121, 'abc123', 94.30, '2022-06-08 10:41:58', '2022-06-08 10:41:58'),
(122, 'hij123', 191.60, '2022-06-05 21:00:12', '2022-06-05 21:00:12'),
(123, 'bcd456', 290.70, '2022-07-01 22:15:15', '2022-07-01 22:15:15'),
(124, 'abc123', 75.70, '2022-06-10 07:55:53', '2022-06-10 07:55:53'),
(125, 'hij123', 157.80, '2022-06-04 21:16:21', '2022-06-04 21:16:21'),
(126, 'efg789', 497.80, '2022-07-01 20:03:08', '2022-07-01 20:03:08'),
(127, 'klm456', 101.90, '2022-06-28 23:22:21', '2022-06-28 23:22:21'),
(128, 'efg789', 265.90, '2022-06-18 19:37:01', '2022-06-18 19:37:01'),
(129, 'efg789', 233.70, '2022-06-26 00:39:58', '2022-06-26 00:39:58'),
(130, 'hij123', 261.20, '2022-06-06 08:27:14', '2022-06-06 08:27:14'),
(131, 'abc123', 409.10, '2022-06-06 10:30:48', '2022-06-06 10:30:48'),
(132, 'efg789', 241.50, '2022-06-07 19:29:18', '2022-06-07 19:29:18'),
(133, 'bcd456', 385.80, '2022-06-10 03:56:08', '2022-06-10 03:56:08'),
(134, 'bcd456', 399.90, '2022-06-05 03:07:19', '2022-06-05 03:07:19'),
(135, 'efg789', 313.50, '2022-06-28 09:53:02', '2022-06-28 09:53:02'),
(136, 'abc123', 194.50, '2022-06-21 12:18:05', '2022-06-21 12:18:05'),
(137, 'bcd456', 190.30, '2022-06-22 02:19:24', '2022-06-22 02:19:24'),
(138, 'bcd456', 200.90, '2022-06-08 21:41:41', '2022-06-08 21:41:41'),
(139, 'bcd456', 376.80, '2022-06-12 03:35:26', '2022-06-12 03:35:26'),
(140, 'bcd456', 375.30, '2022-06-20 19:43:49', '2022-06-20 19:43:49'),
(141, 'abc123', 158.50, '2022-06-08 15:04:57', '2022-06-08 15:04:57'),
(142, 'efg789', 46.80, '2022-06-29 16:50:09', '2022-06-29 16:50:09'),
(143, 'bcd456', 118.30, '2022-06-17 19:32:36', '2022-06-17 19:32:36'),
(144, 'abc123', 410.30, '2022-06-19 21:52:18', '2022-06-19 21:52:18'),
(145, 'bcd456', 102.70, '2022-06-06 07:39:03', '2022-06-06 07:39:03'),
(146, 'abc123', 115.40, '2022-07-01 23:07:18', '2022-07-01 23:07:18'),
(147, 'bcd456', 261.50, '2022-06-25 10:35:11', '2022-06-25 10:35:11'),
(148, 'efg789', 423.20, '2022-06-17 18:48:59', '2022-06-17 18:48:59'),
(149, 'efg789', 153.30, '2022-06-21 02:42:10', '2022-06-21 02:42:10'),
(150, 'bcd456', 200.30, '2022-06-11 03:54:23', '2022-06-11 03:54:23'),
(151, 'efg789', 319.10, '2022-06-19 23:13:52', '2022-06-19 23:13:52'),
(152, 'hij123', 453.50, '2022-06-20 22:01:03', '2022-06-20 22:01:03'),
(153, 'hij123', 362.00, '2022-06-06 03:24:43', '2022-06-06 03:24:43'),
(154, 'klm456', 136.20, '2022-06-26 05:01:52', '2022-06-26 05:01:52'),
(155, 'hij123', 286.90, '2022-07-01 21:09:59', '2022-07-01 21:09:59'),
(156, 'hij123', 139.00, '2022-06-10 11:42:39', '2022-06-10 11:42:39'),
(157, 'klm456', 292.50, '2022-06-19 05:57:42', '2022-06-19 05:57:42'),
(158, 'efg789', 53.90, '2022-06-29 20:29:30', '2022-06-29 20:29:30'),
(159, 'abc123', 240.40, '2022-07-03 13:05:33', '2022-07-03 13:05:33'),
(160, 'bcd456', 86.00, '2022-06-13 04:51:47', '2022-06-13 04:51:47'),
(161, 'abc123', 434.50, '2022-06-30 12:03:19', '2022-06-30 12:03:19'),
(162, 'hij123', 386.90, '2022-06-27 16:08:04', '2022-06-27 16:08:04'),
(163, 'klm456', 448.70, '2022-06-29 19:54:50', '2022-06-29 19:54:50'),
(164, 'hij123', 242.40, '2022-06-15 14:16:31', '2022-06-15 14:16:31'),
(165, 'hij123', 27.40, '2022-07-04 05:12:27', '2022-07-04 05:12:27'),
(166, 'abc123', 389.90, '2022-06-11 09:03:04', '2022-06-11 09:03:04'),
(167, 'efg789', 136.90, '2022-06-21 14:42:44', '2022-06-21 14:42:44'),
(168, 'hij123', 265.00, '2022-06-15 19:12:57', '2022-06-15 19:12:57'),
(169, 'hij123', 383.50, '2022-06-09 09:20:48', '2022-06-09 09:20:48'),
(170, 'abc123', 16.40, '2022-06-12 20:16:57', '2022-06-12 20:16:57'),
(171, 'abc123', 2.30, '2022-06-05 14:20:11', '2022-06-05 14:20:11'),
(172, 'efg789', 39.10, '2022-06-28 04:44:13', '2022-06-28 04:44:13'),
(173, 'efg789', 46.80, '2022-06-17 04:49:40', '2022-06-17 04:49:40'),
(174, 'abc123', 223.60, '2022-06-26 08:18:12', '2022-06-26 08:18:12'),
(175, 'efg789', 101.20, '2022-06-10 17:44:54', '2022-06-10 17:44:54'),
(176, 'efg789', 163.60, '2022-06-06 22:40:07', '2022-06-06 22:40:07'),
(177, 'klm456', 190.70, '2022-06-06 02:02:40', '2022-06-06 02:02:40'),
(178, 'klm456', 69.30, '2022-06-25 17:41:23', '2022-06-25 17:41:23'),
(179, 'bcd456', 319.40, '2022-06-29 16:18:50', '2022-06-29 16:18:50'),
(180, 'klm456', 260.60, '2022-06-05 09:05:44', '2022-06-05 09:05:44'),
(181, 'hij123', 322.30, '2022-06-17 21:33:59', '2022-06-17 21:33:59'),
(182, 'bcd456', 84.90, '2022-06-19 19:54:22', '2022-06-19 19:54:22'),
(183, 'bcd456', 483.90, '2022-06-26 23:20:18', '2022-06-26 23:20:18'),
(184, 'efg789', 280.10, '2022-06-19 01:56:42', '2022-06-19 01:56:42'),
(185, 'klm456', 484.40, '2022-06-26 15:39:52', '2022-06-26 15:39:52'),
(186, 'hij123', 118.10, '2022-06-16 04:37:24', '2022-06-16 04:37:24'),
(187, 'efg789', 187.00, '2022-07-01 22:21:49', '2022-07-01 22:21:49'),
(188, 'klm456', 156.90, '2022-07-03 23:37:00', '2022-07-03 23:37:00'),
(189, 'bcd456', 424.40, '2022-06-24 19:05:01', '2022-06-24 19:05:01'),
(190, 'klm456', 356.00, '2022-06-25 07:12:34', '2022-06-25 07:12:34'),
(191, 'efg789', 464.60, '2022-06-14 06:52:01', '2022-06-14 06:52:01'),
(192, 'abc123', 435.30, '2022-06-14 00:24:09', '2022-06-14 00:24:09'),
(193, 'klm456', 47.70, '2022-06-09 14:03:23', '2022-06-09 14:03:23'),
(194, 'bcd456', 23.40, '2022-06-08 22:36:50', '2022-06-08 22:36:50'),
(195, 'klm456', 477.80, '2022-06-04 18:19:46', '2022-06-04 18:19:46'),
(196, 'efg789', 391.90, '2022-06-27 22:02:05', '2022-06-27 22:02:05'),
(197, 'hij123', 220.80, '2022-06-28 13:11:31', '2022-06-28 13:11:31'),
(198, 'hij123', 373.70, '2022-06-23 16:16:29', '2022-06-23 16:16:29'),
(199, 'hij123', 408.50, '2022-06-22 23:44:58', '2022-06-22 23:44:58'),
(200, 'efg789', 349.00, '2022-06-28 08:33:22', '2022-06-28 08:33:22'),
(201, 'bcd456', 136.90, '2022-06-25 02:53:10', '2022-06-25 02:53:10'),
(202, 'bcd456', 110.80, '2022-06-20 14:31:10', '2022-06-20 14:31:10'),
(203, 'bcd456', 263.00, '2022-06-22 01:57:03', '2022-06-22 01:57:03'),
(204, 'klm456', 240.20, '2022-06-21 05:51:38', '2022-06-21 05:51:38'),
(205, 'bcd456', 74.60, '2022-06-16 23:05:28', '2022-06-16 23:05:28'),
(206, 'klm456', 280.70, '2022-06-17 22:58:34', '2022-06-17 22:58:34'),
(207, 'efg789', 255.10, '2022-06-04 08:20:46', '2022-06-04 08:20:46'),
(208, 'bcd456', 299.30, '2022-06-24 11:07:50', '2022-06-24 11:07:50'),
(209, 'hij123', 271.10, '2022-06-08 06:50:43', '2022-06-08 06:50:43'),
(210, 'klm456', 68.10, '2022-06-19 02:27:17', '2022-06-19 02:27:17'),
(211, 'bcd456', 198.30, '2022-06-04 14:24:39', '2022-06-04 14:24:39'),
(212, 'hij123', 207.80, '2022-06-04 09:17:04', '2022-06-04 09:17:04'),
(213, 'abc123', 63.10, '2022-06-06 12:34:14', '2022-06-06 12:34:14'),
(214, 'bcd456', 392.70, '2022-06-07 18:49:26', '2022-06-07 18:49:26'),
(215, 'bcd456', 260.70, '2022-06-16 05:23:06', '2022-06-16 05:23:06'),
(216, 'abc123', 156.70, '2022-06-16 05:51:03', '2022-06-16 05:51:03'),
(217, 'klm456', 453.30, '2022-06-20 05:45:20', '2022-06-20 05:45:20'),
(218, 'hij123', 290.00, '2022-06-29 14:18:03', '2022-06-29 14:18:03'),
(219, 'efg789', 18.40, '2022-06-09 00:49:43', '2022-06-09 00:49:43'),
(220, 'efg789', 187.50, '2022-06-08 21:21:26', '2022-06-08 21:21:26'),
(221, 'efg789', 210.90, '2022-06-26 08:39:31', '2022-06-26 08:39:31'),
(222, 'abc123', 259.00, '2022-06-24 03:39:01', '2022-06-24 03:39:01'),
(223, 'bcd456', 7.60, '2022-06-26 23:19:52', '2022-06-26 23:19:52'),
(224, 'bcd456', 393.30, '2022-06-23 20:18:43', '2022-06-23 20:18:43'),
(225, 'efg789', 489.40, '2022-06-13 16:03:02', '2022-06-13 16:03:02'),
(226, 'bcd456', 175.70, '2022-07-04 01:46:20', '2022-07-04 01:46:20'),
(227, 'hij123', 259.50, '2022-06-29 02:40:40', '2022-06-29 02:40:40'),
(228, 'hij123', 442.30, '2022-07-04 05:31:02', '2022-07-04 05:31:02'),
(229, 'efg789', 323.00, '2022-07-03 03:38:34', '2022-07-03 03:38:34'),
(230, 'abc123', 170.40, '2022-06-29 15:48:03', '2022-06-29 15:48:03'),
(231, 'abc123', 326.60, '2022-06-04 11:26:11', '2022-06-04 11:26:11'),
(232, 'klm456', 358.00, '2022-06-26 23:37:26', '2022-06-26 23:37:26'),
(233, 'abc123', 257.00, '2022-06-11 14:31:51', '2022-06-11 14:31:51'),
(234, 'klm456', 338.30, '2022-06-18 14:06:23', '2022-06-18 14:06:23'),
(235, 'bcd456', 469.00, '2022-06-06 04:18:06', '2022-06-06 04:18:06'),
(236, 'bcd456', 439.90, '2022-06-05 09:06:12', '2022-06-05 09:06:12'),
(237, 'bcd456', 357.90, '2022-06-25 10:07:05', '2022-06-25 10:07:05'),
(238, 'bcd456', 486.40, '2022-06-11 08:08:18', '2022-06-11 08:08:18'),
(239, 'efg789', 21.30, '2022-06-13 04:56:45', '2022-06-13 04:56:45'),
(240, 'klm456', 217.80, '2022-07-03 10:14:24', '2022-07-03 10:14:24'),
(241, 'abc123', 104.10, '2022-06-21 00:33:11', '2022-06-21 00:33:11'),
(242, 'abc123', 133.70, '2022-06-15 17:08:01', '2022-06-15 17:08:01'),
(243, 'hij123', 251.60, '2022-06-04 20:58:50', '2022-06-04 20:58:50'),
(244, 'efg789', 303.10, '2022-06-18 04:49:27', '2022-06-18 04:49:27'),
(245, 'hij123', 167.50, '2022-06-16 04:16:07', '2022-06-16 04:16:07'),
(246, 'klm456', 202.40, '2022-06-27 04:42:06', '2022-06-27 04:42:06'),
(247, 'efg789', 200.60, '2022-07-03 11:55:30', '2022-07-03 11:55:30'),
(248, 'hij123', 287.90, '2022-06-10 11:42:51', '2022-06-10 11:42:51'),
(249, 'klm456', 55.10, '2022-06-25 11:00:11', '2022-06-25 11:00:11'),
(250, 'klm456', 138.60, '2022-06-25 09:58:20', '2022-06-25 09:58:20'),
(251, 'abc123', 21.10, '2022-06-19 15:44:52', '2022-06-19 15:44:52'),
(252, 'abc123', 358.50, '2022-07-03 14:16:33', '2022-07-03 14:16:33'),
(253, 'bcd456', 430.20, '2022-06-25 22:24:30', '2022-06-25 22:24:30'),
(254, 'klm456', 397.50, '2022-06-25 07:47:07', '2022-06-25 07:47:07'),
(255, 'bcd456', 426.70, '2022-06-22 19:48:33', '2022-06-22 19:48:33'),
(256, 'bcd456', 34.50, '2022-06-20 09:26:36', '2022-06-20 09:26:36'),
(257, 'efg789', 336.10, '2022-06-28 18:13:55', '2022-06-28 18:13:55'),
(258, 'abc123', 355.50, '2022-06-14 04:13:27', '2022-06-14 04:13:27'),
(259, 'hij123', 385.10, '2022-06-12 11:42:50', '2022-06-12 11:42:50'),
(260, 'bcd456', 154.10, '2022-06-17 05:21:47', '2022-06-17 05:21:47'),
(261, 'bcd456', 128.40, '2022-06-05 22:48:06', '2022-06-05 22:48:06'),
(262, 'efg789', 85.00, '2022-06-04 16:45:31', '2022-06-04 16:45:31'),
(263, 'hij123', 143.40, '2022-06-28 04:16:39', '2022-06-28 04:16:39'),
(264, 'efg789', 138.70, '2022-06-30 13:49:17', '2022-06-30 13:49:17'),
(265, 'bcd456', 13.70, '2022-06-23 18:17:26', '2022-06-23 18:17:26'),
(266, 'hij123', 461.30, '2022-06-23 01:29:36', '2022-06-23 01:29:36'),
(267, 'hij123', 441.70, '2022-06-09 01:27:37', '2022-06-09 01:27:37'),
(268, 'hij123', 191.50, '2022-06-09 23:08:05', '2022-06-09 23:08:05'),
(269, 'klm456', 382.50, '2022-07-01 07:59:30', '2022-07-01 07:59:30'),
(270, 'abc123', 212.70, '2022-06-23 16:45:26', '2022-06-23 16:45:26'),
(271, 'klm456', 481.00, '2022-06-24 15:46:36', '2022-06-24 15:46:36'),
(272, 'hij123', 263.00, '2022-06-18 04:48:02', '2022-06-18 04:48:02'),
(273, 'hij123', 154.00, '2022-06-14 15:08:17', '2022-06-14 15:08:17'),
(274, 'klm456', 59.50, '2022-06-10 02:30:40', '2022-06-10 02:30:40'),
(275, 'klm456', 198.60, '2022-06-08 05:44:59', '2022-06-08 05:44:59'),
(276, 'efg789', 273.50, '2022-06-12 04:55:48', '2022-06-12 04:55:48'),
(277, 'abc123', 452.90, '2022-06-14 02:08:30', '2022-06-14 02:08:30'),
(278, 'klm456', 271.10, '2022-06-14 15:27:27', '2022-06-14 15:27:27'),
(279, 'klm456', 88.00, '2022-06-11 04:49:16', '2022-06-11 04:49:16'),
(280, 'bcd456', 24.00, '2022-06-09 00:03:34', '2022-06-09 00:03:34'),
(281, 'abc123', 160.60, '2022-06-12 04:39:15', '2022-06-12 04:39:15'),
(282, 'abc123', 260.80, '2022-06-07 03:26:26', '2022-06-07 03:26:26'),
(283, 'hij123', 263.90, '2022-06-21 22:09:37', '2022-06-21 22:09:37'),
(284, 'efg789', 170.90, '2022-06-18 02:43:21', '2022-06-18 02:43:21'),
(285, 'bcd456', 371.40, '2022-06-23 08:00:55', '2022-06-23 08:00:55'),
(286, 'efg789', 213.80, '2022-06-19 20:30:00', '2022-06-19 20:30:00'),
(287, 'klm456', 410.40, '2022-06-24 19:38:47', '2022-06-24 19:38:47'),
(288, 'abc123', 409.60, '2022-06-19 07:44:07', '2022-06-19 07:44:07'),
(289, 'klm456', 276.20, '2022-06-22 22:44:46', '2022-06-22 22:44:46'),
(290, 'abc123', 376.80, '2022-06-07 18:38:05', '2022-06-07 18:38:05'),
(291, 'abc123', 494.80, '2022-06-15 07:11:48', '2022-06-15 07:11:48'),
(292, 'hij123', 493.80, '2022-07-04 00:16:56', '2022-07-04 00:16:56'),
(293, 'hij123', 336.60, '2022-06-13 01:12:07', '2022-06-13 01:12:07'),
(294, 'hij123', 187.20, '2022-06-20 05:38:26', '2022-06-20 05:38:26'),
(295, 'efg789', 104.10, '2022-06-16 07:22:41', '2022-06-16 07:22:41'),
(296, 'bcd456', 167.80, '2022-06-20 00:10:11', '2022-06-20 00:10:11'),
(297, 'klm456', 324.20, '2022-06-05 04:24:46', '2022-06-05 04:24:46'),
(298, 'klm456', 341.50, '2022-07-02 01:09:47', '2022-07-02 01:09:47'),
(299, 'klm456', 132.90, '2022-06-26 02:10:17', '2022-06-26 02:10:17'),
(300, 'hij123', 105.40, '2022-06-28 05:39:46', '2022-06-28 05:39:46'),
(301, 'abc123', 107.00, '2022-07-05 00:45:16', '2022-07-05 00:45:16'),
(302, 'abc123', 70.00, '2022-07-05 00:46:43', '2022-07-05 00:46:43'),
(303, 'abc123', 27.00, '2022-07-05 00:47:53', '2022-07-05 00:47:53'),
(304, 'abc123', 162.00, '2022-07-05 00:55:46', '2022-07-05 00:55:46'),
(305, 'abc123', 0.00, '2022-07-05 00:57:34', '2022-07-05 00:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pekerja',
  `owner_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `owner_username`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin1', '$2y$10$Wfw8STGYfaM6arR0Id6JL.PrDiiftI8Sjfxeqx4tS4NQToBEXXZIm', 'admin', NULL, NULL, '2022-07-04 06:45:23', '2022-07-04 06:45:23'),
(2, 'owner1', '$2y$10$zjMgKPXyRA68jWLPIr4/BOjEgXUfNz3i8Q.5Rq5G4JoJrRNiUCOkq', 'owner', NULL, NULL, '2022-07-04 07:00:05', '2022-07-04 07:00:05'),
(3, 'pekerja1', '$2y$10$bce0ySb0Farll1h85V3FsuMFk.nSx8YDhNk7Numliti9mDIRdruKa', 'pekerja', 'owner1', NULL, '2022-07-04 17:44:10', '2022-07-04 17:44:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD UNIQUE KEY `machines_machineid_unique` (`machineid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
