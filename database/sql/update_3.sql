INSERT INTO db_version
(db_id,name,descr)
VALUES
(3,'database version 0.1','added support for hybrid departments for mission with varied number of resources + allowance support')
;

ALTER TABLE `employee`
ADD COLUMN `allowance` DOUBLE DEFAULT 0.0;

ALTER TABLE `mission_users`
ADD COLUMN start_date DATE DEFAULT NULL,
ADD COLUMN end_date DATE DEFAULT NULL,
ADD COLUMN allowance_percent int DEFAULT 0,
ADD COLUMN allowance DOUBLE DEFAULT 0.0
;

ALTER TABLE department
MODIFY COLUMN id INT(11) UNSIGNED;

--
-- Table structure for table `mission_department`
--

CREATE TABLE `mission_department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `staff_required`  int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mission_department`
--
ALTER TABLE `mission_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mission_department_mission_id_foreign` (`mission_id`),
  ADD KEY `mission_department_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for table `mission_department`
--
ALTER TABLE `mission_department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for table `mission_department`
--
ALTER TABLE `mission_department`
  ADD CONSTRAINT `mission_department_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mission_department_mission_id_foreign` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE;

-- --------------------------------------------------------

--
-- Table structure for table `department_users`   one -> many
--

CREATE TABLE `department_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for table `department_users`
--
ALTER TABLE `department_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_users_department_id_foreign` (`department_id`),
  ADD KEY `department_users_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_users`
--
ALTER TABLE `department_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;


--
-- Constraints for table `department_users`
--
ALTER TABLE `department_users`
  ADD CONSTRAINT `department_users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `department_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
  

