-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2019 at 04:21 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edutrip_v5`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `event_capacity` int(11) NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `event_id`, `event_name`, `price`, `event_capacity`, `user_email`, `session_id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 1, 'Museo Sugbo', 30.00, 100, '', 'kbH16DDJn5ZnOcWumvkAP0IlTdRR8T', 10.3040865, 123.9051521, NULL, NULL),
(2, 3, 'Fort San Pedro', 50.00, 100, '', 'kbH16DDJn5ZnOcWumvkAP0IlTdRR8T', 10.3040865, 123.9051521, NULL, NULL),
(3, 3, 'Fort San Pedro', 50.00, 100, '', 'CCm87zKBydtenGMSwnW9GYlWAruRG7', 10.3040865, 123.9051521, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `url`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Historical', 'Historical Description', 'hist-desc', 1, NULL, '2019-08-19 03:03:14', '2019-08-19 03:03:14'),
(2, 0, 'Math', 'Math Description', 'math-desc', 1, NULL, '2019-08-19 03:07:10', '2019-08-19 03:07:10'),
(3, 0, 'Science', 'Science Description', 'science-desc', 1, NULL, '2019-08-19 18:21:33', '2019-08-19 18:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `event_capacity` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `category_id`, `user_id`, `event_name`, `event_address`, `event_schedule`, `description`, `price`, `event_capacity`, `image`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Museo Sugbo', '731 M. J. Cuenco Ave, Cebu City, 6000 Cebu', '9:am-5:30pm', 'Museo Sugbo is the Cebu Provincial Museum located in the former Cebu Provincial Detention and Rehabilitation Center, four blocks from Plaza Independencia.', 30.00, 100, '63277.jpg', 10.3040865, 123.9051521, 1, '2019-09-19 19:33:47', '2019-09-19 19:33:47'),
(2, 1, 2, 'Casa Gorordo Museum', '35 Eduardo Aboitiz St, Cebu City, 6000 Cebu', '9:am-5:pm', 'Casa Gorordo is a house museum located in a historic area of Cebu, the oldest city in the Philippines. It is owned and managed by the Ramon Aboitiz Foundation Inc. (RAFI) through its Culture & Heritage Unit.', 70.00, 100, '53745.jpg', 10.3040865, 123.9051521, 1, '2019-09-19 19:50:53', '2019-09-19 19:50:53'),
(3, 1, 2, 'Fort San Pedro', 'A. Pigafetta Street, Cebu City, 6000 Cebu', '10:00 AM - 8:00 PM', 'Remains of a triangular stone Spanish fortress, dating to 1738, today housing a garden & museum.', 50.00, 100, '21473.jpg', 10.3040865, 123.9051521, 1, '2019-09-19 20:56:02', '2019-09-19 20:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE `itineraries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `reserved_by` int(11) DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_18_015844_create_category_table', 2),
(4, '2019_08_18_074659_create_events_table', 3),
(5, '2019_08_20_075713_create_reservations_table', 4),
(6, '2019_08_21_003323_create_reservations_table', 5),
(7, '2019_08_28_005111_create_responses_table', 6),
(8, '2019_08_28_005600_create_responses_table', 7),
(9, '2019_09_08_022758_create_itineraries_table', 8),
(10, '2019_09_09_175354_create_itineraries_table', 9),
(11, '2019_09_09_180612_create_itineraries_table', 10),
(12, '2019_09_09_190126_create_itineraries_table', 11),
(13, '2019_09_11_102337_create_itineraries_table', 12),
(14, '2019_09_11_103103_create_reservations_table', 13),
(15, '2019_09_16_083903_create_tags_table', 14),
(16, '2019_09_17_202358_create_cart_table', 15),
(17, '2019_09_26_194601_create_users_table', 16);

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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `current_id` int(11) NOT NULL,
  `current_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nop` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `seen` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `current_id`, `current_name`, `owner_id`, `session_id`, `nop`, `status`, `seen`, `title`, `start_time`, `end_time`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'owner', 1, 'fPwBqMhUerQmsU6NNAo24wiTKKtMCA', 4, 1, 1, 'Educational Trip', '07:00 AM', '05:00 AM', '2019-09-25', '2019-09-25', '2019-09-19 20:49:35', '2019-09-19 21:48:28'),
(2, 2, 'owner', 1, 'OUWQhaGUFNMECjSx4VMJAifJDBK4h7', 4, 1, 1, 'Educational Trip', '08:00 AM', '04:00 AM', '2019-09-23', '2019-09-23', '2019-09-19 21:00:08', '2019-09-19 21:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `admin`, `status`, `first_name`, `last_name`, `address`, `city`, `province`, `postal_code`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 2, 1, 'Jefferson Reyy', 'Sardido', 'Block 15 Lot 47, Deca Homes 4, Bankal', 'Lapu-lapu City', 'Cebu', '60178', '09077561662', 'admin@admin.com', NULL, '$2y$10$W89hxgOCVBif/Ye2sqdFG.uC0nvPIQzwJnI8T6cFardWQscoGBF6C', NULL, '2019-09-26 13:05:01', '2019-12-08 03:18:08'),
(2, 'Owner', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'owner@owner.com', NULL, '$2y$10$VHLDpd5U0ty88Jiq0jVx5eUcgfq0ZudwrT.z9PbNwhhw2G9fbDNR6', NULL, '2019-09-26 13:07:30', '2019-09-26 13:07:30'),
(3, 'Jefferson', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sjeffersonrey@gmail.com', NULL, '$2y$10$YEwBTZYqnUTG17aEOoze9.orjpqMxQ.dekLLnG5T63ru6nHhQjwuW', NULL, '2019-09-26 13:08:09', '2019-09-26 13:08:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itineraries`
--
ALTER TABLE `itineraries`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itineraries`
--
ALTER TABLE `itineraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
