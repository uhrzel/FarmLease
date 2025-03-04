-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: Mar 04, 2025 at 09:25 AM
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
-- Database: `farmlease`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('123|127.0.0.1', 'i:1;', 1741069085),
('123|127.0.0.1:timer', 'i:1741069085;', 1741069085),
('admin|127.0.0.1', 'i:1;', 1741076706),
('admin|127.0.0.1:timer', 'i:1741076706;', 1741076706),
('johndoe123|127.0.0.1', 'i:2;', 1741071739),
('johndoe123|127.0.0.1:timer', 'i:1741071739;', 1741071739),
('landowner@gmail.com|127.0.0.1', 'i:1;', 1741072429),
('landowner@gmail.com|127.0.0.1:timer', 'i:1741072429;', 1741072429),
('superadmin1|127.0.0.1', 'i:1;', 1741075972),
('superadmin1|127.0.0.1:timer', 'i:1741075972;', 1741075972);

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `land_listing_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_payment` decimal(10,2) NOT NULL,
  `start_month` date DEFAULT NULL,
  `end_month` date DEFAULT NULL,
  `start_year` int(11) DEFAULT NULL,
  `end_year` int(11) DEFAULT NULL,
  `payment_option` varchar(255) DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `reference_image` varchar(255) DEFAULT NULL,
  `down_payment` decimal(10,2) DEFAULT NULL,
  `status` enum('paid','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `land_listing_id`, `transaction_id`, `total_payment`, `start_month`, `end_month`, `start_year`, `end_year`, `payment_option`, `plan`, `reference_image`, `down_payment`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 1, 0.00, NULL, NULL, NULL, NULL, 'GCash', NULL, 'payments/fYTuSGRT10OJCFnhiPVDnk7cq25c1K0fqQ0vn18o.jpg', 12000.00, 'paid', '2025-03-03 23:30:08', '2025-03-03 23:39:27'),
(2, 5, 3, 3, 2000.00, '2025-02-18', '2025-03-25', NULL, NULL, 'PayMaya', 'Monthly', 'payments/BQcROdv5FenH3q6cia1kDpWnIjrexA2TygNnXpdY.jpg', 1000.00, 'pending', '2025-03-03 23:41:08', '2025-03-03 23:42:38');

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
-- Table structure for table `land_listings`
--

CREATE TABLE `land_listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landowner_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `size` double NOT NULL,
  `soil_quality` varchar(255) NOT NULL,
  `land_condition` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','declined') NOT NULL DEFAULT 'pending',
  `landowner_id` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_listings`
--

INSERT INTO `land_listings` (`id`, `landowner_name`, `location`, `price`, `phone_number`, `size`, `soil_quality`, `land_condition`, `description`, `image`, `status`, `landowner_id`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 'Coco Martin', 'Cebu, Catmon', 1000.00, '09219921992', 100, 'Good as Good', 'Good Quality', 'Ok lang sya', 'land_images/jAgsMmNwEilVolSEHO2JMfyrs8m7FUlNGTdHmjty.jpg', 'approved', 6, 7, '2025-03-03 23:09:14', '2025-03-03 23:29:26'),
(2, 'Jake Cuenca', 'Cebu, Sogod', 2000.00, '09123453111', 100, 'Good as Good', 'Good Quality', 'ok lang', 'land_images/LuDvtkdcknyyyaluajvDdJxLSUauuiXtH6aniy1v.jpg', 'approved', 6, 7, '2025-03-03 23:23:28', '2025-03-03 23:29:38'),
(3, 'Ann Mateo', 'Cebu, Poro', 1500.00, '09217216261', 20, 'Good as Good', 'Good Quality', 'ok lang', 'land_images/Sms3MC4QA2AZgnbUzeqp7kpNf5p9WAh2ZIBRys5E.jpg', 'approved', 6, 7, '2025-03-03 23:26:01', '2025-03-03 23:29:32'),
(4, 'Bryan Lao', 'Cebu, Medellin', 12000.00, '09291921881', 2, 'Good as Good', 'Good Quality', 'good lang', 'land_images/LUS4cnW5aAj619Xekc8FkCvYZi557S9SwhPtUUSR.jpg', 'approved', 6, 7, '2025-03-03 23:28:17', '2025-03-03 23:29:16');

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
(4, '2025_02_12_070628_add_role_to_users_table', 1),
(5, '2025_02_17_074756_create_land_listings_table', 1),
(6, '2025_02_18_045248_add_status_to_land_listings_table', 1),
(7, '2025_02_19_041608_add_approved_by_to_land_listings', 1),
(8, '2025_02_20_000052_create_transactions_table', 1),
(9, '2025_02_26_090537_create_carts_table', 1),
(10, '2025_02_26_090654_add_down_payment_to_carts_table', 1),
(11, '2025_02_26_090718_add_payment_details_to_carts_table', 1),
(12, '2025_02_26_102544_add_rental_period_to_carts_table', 1),
(13, '2025_02_28_072529_create_ratings_table', 1),
(14, '2025_03_04_061214_add_avatar_to_users_table', 1),
(15, '2025_03_04_061308_add_avatar_to_users_table', 1);

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
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `landlisting_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL COMMENT 'Rating score (e.g., 1-5)',
  `comments` text DEFAULT NULL COMMENT 'Optional user review',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `landlisting_id`, `rating`, `comments`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 5, 'This land seems great for farming with good soil and a convenient location.', '2025-03-03 23:34:00', '2025-03-03 23:34:00'),
(2, 5, 3, 5, 'Perfect size for growing crops or raising livestock.', '2025-03-03 23:50:24', '2025-03-03 23:50:24'),
(5, 79, 3, 5, 'The land offers great potential for sustainable farming.', '2025-03-04 00:17:06', '2025-03-04 00:17:06'),
(6, 76, 3, 3, 'Nice property!', '2025-03-04 00:18:07', '2025-03-04 00:18:07'),
(7, 60, 3, 5, 'good', '2025-03-04 00:18:45', '2025-03-04 00:18:45'),
(8, 60, 4, 3, 'Ok lang', '2025-03-04 00:18:58', '2025-03-04 00:18:58');

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
('vWRVb1GWK74xQBA46UeXNiONGvQ5mQtRfJNKPDRS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV1g2dUo4YmlhODRHNnhaeXU2Nmc0aHRUR21TbVc2VWliSERBVnh3SSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xhbmRsaXN0aW5ncy9uZXciO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1741076639),
('YascrXd58U2ZfGWWOucKtO388ENzjdmwOYfz0olB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTJraktCaVBDN3h6SXlzSnV5SXZpaVZ0TDVxRno3UFRvQTJVRkdxRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1741076718);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `land_listing_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('available','sold_out','pending','reserved') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `land_listing_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 6, 'sold_out', '2025-03-03 23:29:16', '2025-03-03 23:30:08'),
(2, 1, 6, 'available', '2025-03-03 23:29:26', '2025-03-03 23:29:26'),
(3, 3, 6, 'sold_out', '2025-03-03 23:29:32', '2025-03-03 23:41:08'),
(4, 2, 6, 'available', '2025-03-03 23:29:38', '2025-03-04 00:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','superadmin','lessee','land_owner','tenant') NOT NULL DEFAULT 'tenant',
  `valid_id` varchar(255) DEFAULT NULL,
  `identity_recognition` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `phone_number`, `city`, `barangay`, `street_address`, `zipcode`, `username`, `email`, `email_verified_at`, `password`, `role`, `valid_id`, `identity_recognition`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'James', 'Dela Cruz', 'Smith', '09154138624', '160301000', NULL, 'Purok Masagana 1', '9504', 'James Smith', 'tenant@gmail.com', NULL, '$2y$12$pKgq6zcXrviIRJbV63L6UekpbkCdvdmwtUfrAn2fR6DF2gutdmtAG', 'tenant', 'valid_ids/tlWaqx9wHRygBuDJVfAQwi2JKwSQgodzG4Xsreub.png', 'identity_recognition/PGvKZ733cJsKf5jbJQ9RDQ5FadsqIN9jDdlGFPVI.jpg', 'avatars/HiCRna4m6rB659aW0d5wtd5xvgDPSS0IqNIXB3OY.png', NULL, '2025-03-03 22:49:53', '2025-03-03 23:37:36'),
(5, 'David', 'Smith', 'Madison', '09154138624', '012906000', NULL, 'Purok Masagana 1', '9504', 'David123', 'lessee@gmail.com', NULL, '$2y$12$P8a5hYy.quwDWAVFj3qH1uAfKLGNMjHnbuiAJ9BPigrBuwdh2FzaW', 'lessee', 'valid_ids/tmzdX3FVsaHyvZSVQh8YzxSqO9NFfkkHmucSiize.png', 'identity_recognition/8vp6FNhJv6GtBgvu6O3Yfj2BKfXtEd2vw6gCSsuo.jpg', 'avatars/8VvGsPPSvMdlFrzEvXW0Lhc4d56jUP2qN4kM4sC9.png', NULL, '2025-03-03 22:52:50', '2025-03-03 23:40:40'),
(6, 'John', 'Laid', 'Doe', '09154138624', '012812000', NULL, 'lapid', '123', 'JohnDoe', 'landowner@gmail.com', NULL, '$2y$12$T46IJX2AVeWbfJc7UimgkeJbxLfE6uPY.NRXcBvB1haCmZQCmBKt2', 'land_owner', 'valid_ids/TtMkSkg7RY1Bn4qZIUYUm3wouXy43rCoWoouUWXQ.png', 'identity_recognition/P1GJukt3OaxbHRVaono3pefCMCvtJwFOBrLubFtF.jpg', 'avatars/51vDhvebMUn6U6ByYlr7dfM2uowERdc0D5FeadXC.jpg', NULL, '2025-03-03 23:01:09', '2025-03-03 23:19:10'),
(7, 'Arthur', 'Raul', 'Nerry', '09123456789', '012812000', NULL, 'magsaysay', '123', 'ArthurNerry', 'admin@gmail.com', NULL, '$2y$12$kz1MN56gZR99cW1s.k2k4OYj.T4OjSkHi946FTQwAlQLQZ7Yxld/i', 'admin', 'valid_ids/6LiIYCkpvwRyavUGVEna1gG7ype7OOGuZ2KGsepo.png', 'identity_recognition/GQZo0LeLXeLjn7R8syV72ihhG6g08Eu1eZbVKwrg.jpg', NULL, NULL, '2025-03-03 23:04:32', '2025-03-03 23:04:32'),
(59, 'Super', NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, 'superadmin', 'superadmin@example.com', '2025-03-04 00:16:04', '$2y$12$BSvoQMZO4cCHV6akDIPWnuYUh9JfbGm21CtUAZGoLX2kiLIiOcr7i', 'superadmin', NULL, NULL, NULL, NULL, '2025-03-04 00:16:04', '2025-03-04 00:16:04'),
(60, 'Anissa', NULL, 'Brekke', '(757) 288-3588', 'Alizeton', 'Ronaldo Throughway', '71826 Orn Square Suite 334', '97727', 'alejandra17', 'ryan.al@example.com', '2025-03-04 00:16:04', '$2y$12$NbBaV01uHx.VpNIeBDR7F./b8jt/vEgPJYQLxb35VBf.L7h4/jnCG', 'tenant', NULL, NULL, NULL, 'pHJKUBaI014QFHEFePsxoTV61t6iXQfPqqernrMnONMwDRk2BKUHDctjfThJ', '2025-03-04 00:16:04', '2025-03-04 00:16:04'),
(61, 'Norwood', NULL, 'Sporer', '1-854-425-1906', 'East Melody', 'Jones Cliffs', '499 Anais Rest Suite 105', '11486', 'gibson.adrianna', 'edna69@example.com', '2025-03-04 00:16:04', '$2y$12$SxIGv71XGUk96caKQthKaOhI/yEIMwdcz62flFLTOPD5vw7LgQ3xG', 'tenant', NULL, NULL, NULL, 'qOi9d6XuLR', '2025-03-04 00:16:05', '2025-03-04 00:16:05'),
(62, 'Alvis', NULL, 'Cruickshank', '1-234-371-3367', 'South Izaiah', 'Hills Ford', '7819 Nolan Rapids Apt. 553', '69414', 'jackeline23', 'turcotte.henriette@example.org', '2025-03-04 00:16:05', '$2y$12$PFnlUfA/4anCVKCLzP7.vuU.PsZe49nuonuwRFEIyqL8HQhFdMJoe', 'tenant', NULL, NULL, NULL, 'Q2Gk3XM0FG', '2025-03-04 00:16:05', '2025-03-04 00:16:05'),
(63, 'Serenity', 'Reymundo', 'Rau', '540.319.2576', 'South Lilyanberg', 'Pacocha Crossroad', '78575 O\'Hara Squares', '48460-6248', 'alanna.heidenreich', 'beichmann@example.net', '2025-03-04 00:16:05', '$2y$12$weTY2/tu4ZdvCwjc0oB5OuuhR7SRCdcGPSNZ3H94eVLTMwJToUH.K', 'tenant', NULL, NULL, NULL, 'uI7g4P8AJp', '2025-03-04 00:16:05', '2025-03-04 00:16:05'),
(64, 'Hassie', NULL, 'Turner', '(321) 541-8480', 'Bahringerchester', 'Feest Mountains', '4000 Prosacco Station Suite 232', '59989', 'brekke.berniece', 'lnolan@example.org', '2025-03-04 00:16:05', '$2y$12$PB5EW0hXoF1FQAY7txcGIOX.ToIoeh.DcJ8IX6Kg1e/l1tut8/2Qi', 'tenant', NULL, NULL, NULL, '9FHsoTPYWL', '2025-03-04 00:16:05', '2025-03-04 00:16:05'),
(65, 'Maybelle', NULL, 'Stark', '650-408-7692', 'Cleoratown', 'Hoeger Square', '737 Kristopher Court Apt. 465', '34302-5119', 'walter.laurence', 'oschumm@example.com', '2025-03-04 00:16:05', '$2y$12$Yv/WsFMfQYjPaTSHdOOZxeXY.H5GJmp8gDRpqAENSX1Va8TCo.Aha', 'tenant', NULL, NULL, NULL, 'bzr7Xynj67', '2025-03-04 00:16:06', '2025-03-04 00:16:06'),
(66, 'Lionel', 'Carolina', 'O\'Kon', '281-370-9824', 'Felicitachester', 'Furman Mills', '34928 Farrell Stravenue Suite 445', '37782-0209', 'ylind', 'ehaley@example.net', '2025-03-04 00:16:06', '$2y$12$Q6Fk0ymbGfSkVlkS/ublL.5aso5lRGKv3SOCdVr/vHocXopIG1h2C', 'tenant', NULL, NULL, NULL, 'KK3yfkV8rp', '2025-03-04 00:16:06', '2025-03-04 00:16:06'),
(67, 'Elody', 'Chaim', 'Hane', '+1 (478) 891-3648', 'Lake Keyonside', 'Schuster Camp', '57532 DuBuque Port Suite 176', '38746', 'gflatley', 'usenger@example.com', '2025-03-04 00:16:06', '$2y$12$A0worxCSsNQu/t3rw2.U9e8LjZG3VRbwsDpGf503IPyxr6ZS9Pssy', 'tenant', NULL, NULL, NULL, 'pOU7mjmDT9', '2025-03-04 00:16:06', '2025-03-04 00:16:06'),
(68, 'Adrianna', 'Santa', 'Feeney', '(248) 778-0345', 'Port Greenfurt', 'Annamarie Road', '695 Nolan Junction', '57199-0860', 'jamil.monahan', 'lockman.alexandrine@example.net', '2025-03-04 00:16:06', '$2y$12$uiO/yL.nVPre36Km1dCbSO5OE2YdackEKw7JSV3SjBGwTk18d8NL.', 'tenant', NULL, NULL, NULL, 'JzHuhpRQpO', '2025-03-04 00:16:06', '2025-03-04 00:16:06'),
(69, 'Wanda', 'Amina', 'Cole', '240-738-7874', 'North Melynamouth', 'Greenholt Heights', '293 Katherine Fall', '83118-1417', 'leannon.cristobal', 'hammes.lottie@example.org', '2025-03-04 00:16:06', '$2y$12$HRPpf3LLH308h/etUYLkm.d5mQMXJOVjj2Uz8ISIq5UexjGKt0gim', 'tenant', NULL, NULL, NULL, 'yoZZuZdiuK', '2025-03-04 00:16:06', '2025-03-04 00:16:06'),
(70, 'Linda', 'Franz', 'Sanford', '+1 (361) 605-6282', 'Lake Roberto', 'Greenfelder Inlet', '50897 Iva Overpass', '24160', 'wreichert', 'else38@example.com', '2025-03-04 00:16:06', '$2y$12$ub8Iv9ts7CU3lMI0cAD5ju2I2xXY/3MnZNtOUCgpgMDeLgqNBDDy.', 'lessee', NULL, NULL, NULL, 'jwFot0Hcgc', '2025-03-04 00:16:07', '2025-03-04 00:16:07'),
(71, 'Malcolm', 'Serenity', 'Price', '479-712-7459', 'South Anne', 'Grimes Garden', '63994 Ortiz Highway', '66137', 'kris.juanita', 'aaron90@example.net', '2025-03-04 00:16:07', '$2y$12$12Sv8NUpVG8HtbCj5cLXKeymVHg2OLcm2M6wjRNsEvmneEvR.wUg6', 'lessee', NULL, NULL, NULL, 'LQuCGkrD3z', '2025-03-04 00:16:07', '2025-03-04 00:16:07'),
(72, 'Aaliyah', NULL, 'Jacobi', '+1.740.445.8629', 'Lake Armando', 'Schneider Alley', '48381 Runte Corner Apt. 420', '40090-1419', 'allie74', 'price.consuelo@example.com', '2025-03-04 00:16:07', '$2y$12$yiGBgSsr1NCg6CO03Wfj8eWkg/iZfAsOSMKqzRq0Dv8i4WjTuuquK', 'lessee', NULL, NULL, NULL, 'YCFkCXl9tB', '2025-03-04 00:16:07', '2025-03-04 00:16:07'),
(73, 'Kevon', 'Shayne', 'Flatley', '(908) 590-5083', 'Port Bernadine', 'Ferry Freeway', '1069 Bartoletti Drive', '30851', 'melody52', 'webster.franecki@example.net', '2025-03-04 00:16:07', '$2y$12$VsoqkUpAolFZAXJTv2cpc.Tq7/jmzDbo3O/yc1qv2GgvJs69SAFY.', 'lessee', NULL, NULL, NULL, 'Wsv2diJ1mm', '2025-03-04 00:16:07', '2025-03-04 00:16:07'),
(74, 'Emelie', 'Lois', 'Dietrich', '630-222-5828', 'Port Guillermo', 'Santiago Village', '217 Porter Brook Apt. 883', '23940', 'blanca20', 'drodriguez@example.com', '2025-03-04 00:16:07', '$2y$12$jTaDZ.Ohi2r7nx.RWUbFyekaA1.wIVcQ/t.I3riBTvfVzSLeMVdkm', 'lessee', NULL, NULL, NULL, 'M8JL9unyzm', '2025-03-04 00:16:08', '2025-03-04 00:16:08'),
(75, 'Rozella', NULL, 'Balistreri', '+1 (317) 777-6616', 'Ellsworthton', 'Garret Trail', '773 Runolfsson Knoll Apt. 674', '86088', 'dexter67', 'elwyn.konopelski@example.net', '2025-03-04 00:16:08', '$2y$12$RjYGs7ZCRDUkCgjIWXjqmOMwUK8HvXBI2hKV3hsIrGOtwSt3J5yue', 'lessee', NULL, NULL, NULL, 'nktjpOnwIl', '2025-03-04 00:16:08', '2025-03-04 00:16:08'),
(76, 'Raquel', NULL, 'Bednar', '(585) 441-1322', 'Kolemouth', 'Jacynthe Garden', '89810 Gene Harbors Apt. 971', '63751', 'schaefer.millie', 'eloisa.toy@example.com', '2025-03-04 00:16:08', '$2y$12$amjoamyHRkeoKQ3XI36dkubOM99HTF68c9BYI1O76sxz9DH17dgda', 'lessee', NULL, NULL, NULL, 'gu3c6GctSl4nGbNDsysKqL5FotQSSkUh1rQd2pRRo8MxXyQbe9A04fbJUL1B', '2025-03-04 00:16:08', '2025-03-04 00:16:08'),
(77, 'Lorenz', NULL, 'Mueller', '689.342.7676', 'Gaylordmouth', 'McGlynn Ville', '430 Lynch Expressway Apt. 911', '73546', 'carlie08', 'neil49@example.net', '2025-03-04 00:16:08', '$2y$12$wcvoqclCLbxQHYYRpFtgg.NLzH6sDw9aTl.l8B/UAFULaRwu475lS', 'lessee', NULL, NULL, NULL, 'YAi7US6qVu', '2025-03-04 00:16:08', '2025-03-04 00:16:08'),
(78, 'Savion', 'Horacio', 'Leuschke', '1-678-434-3538', 'Lexiefort', 'Brett Shoal', '3452 Isadore Path Suite 507', '04318-1642', 'cassidy21', 'brant.williamson@example.org', '2025-03-04 00:16:08', '$2y$12$ScE1MlkKwN8aBBUEAiOhseXGpzfsLYtIL8OpfiERbc8sU05GBwmdS', 'lessee', NULL, NULL, NULL, 'n1jEaMD5iFswGE35bD23Xedur1MsPx0U1bR2kNxh31aKlezrepMl6oUHwEf6', '2025-03-04 00:16:08', '2025-03-04 00:16:08'),
(79, 'Imani', NULL, 'Reichel', '661-462-7343', 'Fadelhaven', 'Luigi Groves', '5095 Catherine Ramp Apt. 792', '38126', 'lreilly', 'rfunk@example.com', '2025-03-04 00:16:08', '$2y$12$5eduLspmuwj9rHIeNHZXZeRatMV5CwFA5txb1PA/D0U2pg9HsMdaG', 'lessee', NULL, NULL, NULL, 'ypSMYNzTqT4NvouCW25DlCNOFKQbAFqgef6CvwQEDJJZeVUM95W7ISzX9tpg', '2025-03-04 00:16:09', '2025-03-04 00:16:09'),
(80, 'Brett', 'Eduardo', 'Kautzer', '(417) 893-2671', 'Uptonside', 'Dejon Harbor', '41198 Bernhard Shore', '99823-6180', 'willa63', 'vyundt@example.com', '2025-03-04 00:16:09', '$2y$12$Ku04JyDbbrQf1xJlSSkB4uwwxia4hdpyeSwgtNy5JCJVL10x6u5Mq', 'land_owner', NULL, NULL, NULL, '6PnPEEmrEi', '2025-03-04 00:16:09', '2025-03-04 00:16:09'),
(81, 'Amara', 'Yvonne', 'Nolan', '+1-917-368-6941', 'Mannmouth', 'Jacobi Rue', '12484 Hilpert Port', '37372', 'isaias.wolff', 'joshua07@example.org', '2025-03-04 00:16:09', '$2y$12$yMVE5gSVK4RdtWjHFM2sN.O9LQvtur/OE6tgBOulEG7Nn6W46e1Be', 'land_owner', NULL, NULL, NULL, 'irRPKxYSF9', '2025-03-04 00:16:09', '2025-03-04 00:16:09'),
(82, 'Charlie', NULL, 'West', '910-295-1498', 'Romagueraburgh', 'Daniela Villages', '129 Jaunita Roads Apt. 665', '65555-4799', 'aracely.shanahan', 'ludie81@example.net', '2025-03-04 00:16:09', '$2y$12$CA7VemBSlT0Fao7kIpFtfO504Q0ST2N3DqBI4tQHD83hE61PUOd0S', 'land_owner', NULL, NULL, NULL, 'NaVeBHfQCl', '2025-03-04 00:16:10', '2025-03-04 00:16:10'),
(83, 'Clare', 'Dillan', 'Hayes', '+17158960710', 'Aidenbury', 'Stark Views', '3434 Amira Port', '86541', 'huels.annabell', 'matt.kiehn@example.org', '2025-03-04 00:16:10', '$2y$12$DDKejiXE.eZ8jSn7zkm3I.cGSzPlYU4YFvvdUHhE3RamL/NXq.SKq', 'land_owner', NULL, NULL, NULL, '9mFZuQGq5s', '2025-03-04 00:16:10', '2025-03-04 00:16:10'),
(84, 'Lorenzo', 'Donato', 'DuBuque', '+14634266983', 'Haroldton', 'Adelia River', '42913 Gaylord Divide Apt. 670', '48657-2799', 'fisher.marianna', 'lonie.shanahan@example.org', '2025-03-04 00:16:10', '$2y$12$Yrknrc6aI4rGWYLc5dA8aOf1jbnpnzqJHGM6erfKxuilXsB4pG1BC', 'land_owner', NULL, NULL, NULL, 'v6sYkQ08d8', '2025-03-04 00:16:10', '2025-03-04 00:16:10'),
(85, 'Linnie', NULL, 'Terry', '913.600.9493', 'Federicoshire', 'Zita Pass', '8900 Nolan Fort Suite 050', '03501-3300', 'huels.yadira', 'shirley49@example.net', '2025-03-04 00:16:10', '$2y$12$mTR.//m.spPCGW2NrQ/u6OrD5hTtKWG8TrCPK60iBYbzz9uguZkLy', 'land_owner', NULL, NULL, NULL, 'bdXzAAF6gg', '2025-03-04 00:16:10', '2025-03-04 00:16:10'),
(86, 'Chadd', 'Mellie', 'Thiel', '830.381.8243', 'Delmerville', 'Zola Passage', '68889 Erik Road Suite 355', '82581-2354', 'major29', 'paucek.dawn@example.net', '2025-03-04 00:16:10', '$2y$12$IO2X0.teiKLtIEHNOVJju.TvlY.O9ijYfcD4z2isbVa62ZTocAVaW', 'land_owner', NULL, NULL, NULL, 'SsvxOfklAX', '2025-03-04 00:16:11', '2025-03-04 00:16:11'),
(87, 'Nikolas', NULL, 'Huel', '937.359.2391', 'Mannborough', 'Denis Vista', '442 Icie Summit', '37835', 'xander.stark', 'dena.schroeder@example.net', '2025-03-04 00:16:11', '$2y$12$oOStBfoqHeHtEIEf3EXrMuV.Qdr2f/5GDuTbix/lERCqk1IVuJfNO', 'land_owner', NULL, NULL, NULL, 'Qi7crAklBP', '2025-03-04 00:16:11', '2025-03-04 00:16:11'),
(88, 'Alysson', 'Maegan', 'Zemlak', '+1 (858) 509-7255', 'Port Wileyport', 'Lehner Turnpike', '11442 Nelle Alley', '67055-2395', 'khahn', 'maudie23@example.com', '2025-03-04 00:16:11', '$2y$12$OlMhxPJ2gUG5AKg.Rom/A.njvQle2CxIFFMloykxMJDsLuWlHixgW', 'land_owner', NULL, NULL, NULL, 'QBZn9QT2QI', '2025-03-04 00:16:11', '2025-03-04 00:16:11'),
(89, 'Dejuan', 'Seth', 'Jacobi', '+1-615-769-3419', 'Lake Eileen', 'Cole Brook', '23074 Hansen Crossroad Apt. 849', '46999-5854', 'fidel.conroy', 'solson@example.com', '2025-03-04 00:16:11', '$2y$12$LM1YSHg4.eF1C5x9N5HbiuxsQH9H8NiKVo/J.xhlJV7Sm1PajqiFS', 'land_owner', NULL, NULL, NULL, 'qxRb3P36gM', '2025-03-04 00:16:11', '2025-03-04 00:16:11');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_land_listing_id_foreign` (`land_listing_id`),
  ADD KEY `carts_transaction_id_foreign` (`transaction_id`);

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
-- Indexes for table `land_listings`
--
ALTER TABLE `land_listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `land_listings_landowner_id_foreign` (`landowner_id`),
  ADD KEY `land_listings_approved_by_foreign` (`approved_by`);

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
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_landlisting_id_foreign` (`landlisting_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_land_listing_id_foreign` (`land_listing_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `land_listings`
--
ALTER TABLE `land_listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_land_listing_id_foreign` FOREIGN KEY (`land_listing_id`) REFERENCES `land_listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `land_listings`
--
ALTER TABLE `land_listings`
  ADD CONSTRAINT `land_listings_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `land_listings_landowner_id_foreign` FOREIGN KEY (`landowner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_landlisting_id_foreign` FOREIGN KEY (`landlisting_id`) REFERENCES `land_listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_land_listing_id_foreign` FOREIGN KEY (`land_listing_id`) REFERENCES `land_listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
