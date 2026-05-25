-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2026 at 04:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `phone`, `email`, `website`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Joty Prokash Biswas', '01403107510', 'jotybiswas0199@gmail.com', 'https://github.com/jotybiswas2022-coder', 'profile/oCCBufO5jPcnHTJ6SbHXo2OdRhqkVqVxEezyisEV.jpg', '2026-05-22 07:10:57', '2026-05-22 07:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Joty Prokash Biswas', 'jotybiswas0199@gmail.com', 'fgrdfg', '2026-05-22 07:07:37', '2026-05-22 07:07:37'),
(2, 'Joty Prokash Biswas', 'jotybiswas0199@gmail.com', 'rfert', '2026-05-22 07:09:31', '2026-05-22 07:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_for_recipients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deleted_for_recipients`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `recipient_id`, `message`, `image_path`, `created_at`, `updated_at`, `edited_at`, `deleted_at`, `deleted_for_recipients`) VALUES
(1, 1, 1, 'hi', NULL, '2026-05-22 05:20:41', '2026-05-25 06:39:20', NULL, '2026-05-22 05:46:49', '[1]'),
(2, 2, 1, 'Hiiii', NULL, '2026-05-22 05:23:15', '2026-05-22 06:06:47', NULL, NULL, '[1]'),
(5, 1, 3, NULL, NULL, '2026-05-22 05:32:40', '2026-05-22 06:27:07', NULL, NULL, '[3,1]'),
(6, 1, 3, NULL, NULL, '2026-05-22 05:40:36', '2026-05-22 06:27:09', NULL, '2026-05-22 05:47:34', '[3,1]'),
(7, 3, 1, NULL, NULL, '2026-05-22 05:48:05', '2026-05-22 06:20:40', '2026-05-22 05:48:24', '2026-05-22 06:20:37', '[1,3]'),
(8, 3, 1, NULL, 'messages/ZNzZeqgMornsten1Lh2ZclDbwLNCzdFmkD8qEFfL.png', '2026-05-22 06:21:16', '2026-05-22 06:27:11', NULL, NULL, '[1]'),
(9, 1, 6, 'Hi', NULL, '2026-05-22 06:26:17', '2026-05-22 06:26:17', NULL, NULL, NULL),
(10, 1, 5, 'Hi', NULL, '2026-05-22 06:26:30', '2026-05-22 06:26:30', NULL, NULL, NULL),
(11, 1, 4, 'Hi', NULL, '2026-05-22 06:26:46', '2026-05-22 06:26:46', NULL, NULL, NULL),
(12, 1, 2, 'Hi', NULL, '2026-05-22 06:27:01', '2026-05-22 07:40:49', NULL, NULL, '[1]'),
(13, 3, 1, 'Hello! How are you?', NULL, '2026-05-22 06:27:36', '2026-05-22 06:27:36', NULL, NULL, NULL),
(14, 1, 3, 'I am doing well, thank you!', NULL, '2026-05-22 06:28:36', '2026-05-22 06:28:36', NULL, NULL, NULL),
(15, 3, 1, 'What\'s about the Project?', NULL, '2026-05-22 06:29:16', '2026-05-22 06:29:16', NULL, NULL, NULL),
(16, 1, 3, 'Check this out 👇\r\nhttps://github.com/jotybiswas2022-coder/Chatbox', NULL, '2026-05-22 06:31:11', '2026-05-22 06:32:19', NULL, NULL, '[1,3]'),
(17, 1, 3, 'Check this out 👉 https://github.com/jotybiswas2022-coder/Chatbox', NULL, '2026-05-22 06:32:00', '2026-05-22 06:32:00', NULL, NULL, NULL),
(21, 1, 1, 'yuytug', NULL, '2026-05-25 07:25:18', '2026-05-25 07:56:55', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_01_094305_create_accounts_table', 1),
(5, '2026_03_01_140515_create_contacts_table', 1),
(6, '2026_05_21_175348_create_messages_table', 1),
(7, '2026_05_22_113530_add_edit_and_delete_tracking_to_messages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0lnOQJs5Qk3OLBnMeSy63Ho5MW36shgtg6ilxgam', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaWczdVdBUkhyanlNdTdkaHpqUzJSeDNKNTAwMjYyT2JudkhkdmpnMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3QvYWRtaW4vbWVzc2FnZXMiO3M6NToicm91dGUiO3M6MTQ6Im1lc3NhZ2VzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3Nzk2ODg1ODU7fX0=', 1779695951),
('opomFn0TA9wKJFcnjLK1f9IQ8UGXkt5UDETWU5pj', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaWtVeU12WFBxWklQRFVMc2lOazBzM3lHaHRmMVg1RWFPbGEwYmF6MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3QvYWRtaW4vbWVzc2FnZXMiO3M6NToicm91dGUiO3M6MTQ6Im1lc3NhZ2VzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3Nzk3MTg2NjM7fX0=', 1779718691);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Joty Prokash Biswas', 'jotybiswas0199@gmail.com', NULL, 1, '$2y$12$yIZxDb4pLJYmTMRVSUG57uV.9qCbmovt1D9uCKxayAi5vSfXoc.wm', NULL, '2026-05-22 05:20:34', '2026-05-22 05:20:34'),
(2, 'Elon Mask', 'elon@gmail.com', NULL, 0, '$2y$12$lZbAlCJUjBnn1su/A3ChSeIbnvCjKFnjxLSVDS1ZJsWyV27RwC76m', NULL, '2026-05-22 05:22:56', '2026-05-22 05:22:56'),
(3, 'Bill Gates', 'bill@gmail.com', NULL, 0, '$2y$12$igWOZWni2Y86pDryCDmSjeMhVly6J2zSzs6jeUApD77jawg3kRXlC', NULL, '2026-05-22 05:26:42', '2026-05-22 05:26:42'),
(4, 'Larry Page', 'larry@gmail.com', NULL, 0, '$2y$12$Eu9vTUxpM6Lwr7JNqlVELegB4hPNnkaJPXVbERDUoyz/TL0fTYGvG', NULL, '2026-05-22 06:24:40', '2026-05-22 06:24:40'),
(5, 'Mark Zuckerberg', 'mark@gmail.com', NULL, 0, '$2y$12$3inZoIJZ1Av69y.jRNTvouaABNEgsva.DbrpqQdwoBIgWynr2.2W.', NULL, '2026-05-22 06:25:35', '2026-05-22 06:25:35'),
(6, 'Tony Stark', 'tony@gmail.com', NULL, 0, '$2y$12$QAiby/Kfbt8GhKfaE0Sw2.v/MJgtjyxxG23lJ1yJEB6CgfFn14GoW', NULL, '2026-05-22 06:25:55', '2026-05-22 06:25:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
