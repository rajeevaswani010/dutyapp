-- phpMyAdmin SQL Dump
-- version 5.2.1-1.fc37.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2024 at 11:02 PM
-- Server version: 10.5.18-MariaDB
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dutyapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `code` varchar(4) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `description`, `code`, `phone`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(100, 'Marketing', 'marketing department', 'MKT', '94873625', 1, 1, '2024-03-06 14:06:47', NULL),
(101, 'Finance', 'Finance department taking care of company finances', 'FIN', '94873652', 1, 1, '2024-03-06 14:09:45', NULL),
(102, 'Sales', 'Sales, Advertisement department', 'SALS', '94875415', 1, 1, '2024-03-06 14:09:45', NULL),
(103, 'Operations', 'operations department taking care of company operations', 'OP', '94873611', 1, 1, '2024-03-06 14:10:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `supervisor_id` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) NOT NULL DEFAULT 0,
  `designation` varchar(50) NOT NULL DEFAULT '0',
  `doj` date DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `dob`, `gender`, `phone`, `address`, `email`, `password`, `supervisor_id`, `department_id`, `designation`, `doj`, `is_active`, `created_at`, `updated_at`) VALUES
(100000, 'Percy Jackson', NULL, 'Male', '94580001', NULL, 'percy.jackson@company.com', '12345678', NULL, 101, '0', NULL, 1, '2024-03-06 14:58:13', '2024-03-06 15:02:34'),
(100001, 'Radheshyam', NULL, 'Male', '94580002', NULL, 'radheshyam@company.com', '12345678', 100000, 101, '0', NULL, 1, '2024-03-06 14:58:33', '2024-03-06 15:02:42'),
(100002, 'Pawam Sharma', NULL, 'Male', '94580003', NULL, 'pawamsharma@company.com', '12345678', NULL, 102, '0', NULL, 1, '2024-03-06 14:58:33', '2024-03-06 15:02:49'),
(100003, 'Prakruti', NULL, 'Female', '94580012', NULL, 'prakruti@company.com', '12345678', 100004, 104, '0', NULL, 1, '2024-03-06 14:58:33', '2024-03-06 15:03:00'),
(100004, 'Sheela', NULL, 'Female', '94580013', NULL, 'sheeka@company.com', '12345678', NULL, 104, '0', NULL, 1, '2024-03-06 14:58:33', '2024-03-06 15:03:05'),
(100005, 'Rajeev', NULL, 'Male', '94580112', NULL, 'rajeev.aswani@company.com', '12345678', NULL, 104, '0', NULL, 1, '2024-03-06 21:58:16', NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_06_221827_add_new_fields_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mission`
--

CREATE TABLE `mission` (
  `id` int(6) UNSIGNED NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `num_of_days` int(11) NOT NULL,
  `num_of_nights` int(11) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `department` varchar(30) NOT NULL,
  `directorate` varchar(255) DEFAULT NULL,
  `num_of_staff` int(11) NOT NULL,
  `travelling_area_from` varchar(255) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `travel_start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `travel_return_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` varchar(255) NOT NULL,
  `allowance_percentage` int(11) NOT NULL DEFAULT 0 COMMENT '0 : 0; 1: 50; 2: 75; 3: 100',
  `air_ticket_required` tinyint(1) NOT NULL DEFAULT 0,
  `vehicle_required` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mission`
--

INSERT INTO `mission` (`id`, `purpose`, `country`, `city`, `num_of_days`, `num_of_nights`, `section`, `department`, `directorate`, `num_of_staff`, `travelling_area_from`, `start_date`, `end_date`, `travel_start_date`, `travel_return_date`, `remarks`, `allowance_percentage`, `air_ticket_required`, `vehicle_required`) VALUES
(100000000, 'salalah site visit', 'Oman', 'Salalah', 2, 1, NULL, 'Operations', NULL, 3, 'Muscat', '2024-03-06 21:06:53', '2024-03-06 21:06:53', '2024-03-06 21:06:53', '2024-03-06 21:06:53', 'no remarks', 0, 0, 0),
(100000001, 'salalah site visit', 'Oman', 'Salalah', 2, 1, NULL, 'Operations', NULL, 3, 'Muscat', '2024-03-06 21:10:36', '2024-03-06 21:10:36', '2024-03-06 21:10:36', '2024-03-06 21:10:36', 'no remarks', 0, 0, 0),
(100000002, 'Dubai for site evaluation', 'Oman', 'Dubai', 2, 1, NULL, 'Operations', NULL, 3, 'Muscat', '2024-03-06 21:10:36', '2024-03-06 21:10:36', '2024-03-06 21:10:36', '2024-03-06 21:10:36', 'no remarks', 0, 0, 0);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `employee_id` varchar(255) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `address` text DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `dob`, `doj`, `employee_id`, `gender`, `phone`, `is_active`, `address`, `designation`, `department`, `supervisor_id`) VALUES
(1, 'Rajeev Aswani', 'rajeev.aswani@rediffmail.com', NULL, '$2y$12$JTEOBHaso.8Tpxfo8ydtJ.I3zgQaU62B9xrsb/tqW3vnLGmRf7Qs6', NULL, '2024-03-06 15:56:35', '2024-03-06 15:56:35', NULL, NULL, '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(2, 'Rajeev Aswani', 'rajeev.aswani@company.com', NULL, '$2y$12$XKSm8q6KoMLq5H4LjMwEmet7BlvyS4y97I5y7Jnq8KC.XpO8xFsdu', NULL, '2024-03-06 17:58:53', '2024-03-06 17:58:53', NULL, NULL, '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(3, 'Radheshyam', 'radheshyam@company.com', NULL, '$2y$12$78.srhx3TrL7fxByGFhhju2vQIK.LSTt7HoBT/OBW7kn5c3Adwudu', NULL, NULL, NULL, NULL, NULL, '10929810', 'male', '94580002', 1, NULL, NULL, 'Finance', NULL),
(4, 'Pawam Sharma', 'pawamsharma@company.com', NULL, '$2y$12$78.srhx3TrL7fxByGFhhju2vQIK.LSTt7HoBT/OBW7kn5c3Adwudu', NULL, NULL, NULL, NULL, NULL, '123412313', 'male', '94580003', 1, NULL, NULL, 'Finance', NULL),
(5, 'Percy Jackson', 'percy.jackson@gcompany.com', NULL, '$2y$12$78.srhx3TrL7fxByGFhhju2vQIK.LSTt7HoBT/OBW7kn5c3Adwudu', NULL, NULL, NULL, NULL, NULL, '1123532', 'male', '94580001', 1, NULL, NULL, 'Operations', NULL),
(6, 'Prakruti', 'prakruti@company.com', NULL, '$2y$12$78.srhx3TrL7fxByGFhhju2vQIK.LSTt7HoBT/OBW7kn5c3Adwudu', NULL, NULL, NULL, NULL, NULL, '1098789', 'female', '94580012', 1, NULL, NULL, 'Sales', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100006;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000003;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
