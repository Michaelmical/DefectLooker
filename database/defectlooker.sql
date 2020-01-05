-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2020 at 05:08 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `defectlooker`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` int(10) UNSIGNED NOT NULL,
  `descr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `areatype`
--

CREATE TABLE `areatype` (
  `areatype_id` int(10) UNSIGNED NOT NULL,
  `descr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `build`
--

CREATE TABLE `build` (
  `build_id` int(10) UNSIGNED NOT NULL,
  `proj_id` int(11) NOT NULL,
  `sp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drop_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `build`
--

INSERT INTO `build` (`build_id`, `proj_id`, `sp_id`, `version_id`, `drop_id`, `descr`, `created_at`, `updated_at`) VALUES
(1, 1, 'SP39', '1', 'Drop1', 'SP39.1 Drop1', NULL, NULL),
(2, 2, 'SP39', '0', 'Drop1', 'SP39.0 Drop1', NULL, NULL),
(3, 3, 'SP39', '0', 'Drop3', 'SP39.0 Drop3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complex`
--

CREATE TABLE `complex` (
  `complex_id` int(10) UNSIGNED NOT NULL,
  `descr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` decimal(8,2) NOT NULL,
  `criteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `areatype_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `defects`
--

CREATE TABLE `defects` (
  `defects_id` bigint(20) UNSIGNED NOT NULL,
  `orig_ref_id` int(11) NOT NULL,
  `task_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `defect_type_id` int(11) NOT NULL,
  `defect_cause_id` int(11) NOT NULL,
  `area_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `defect_cause`
--

CREATE TABLE `defect_cause` (
  `defect_cause_id` int(10) UNSIGNED NOT NULL,
  `desc_cause` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `defect_type`
--

CREATE TABLE `defect_type` (
  `defect_type_id` int(10) UNSIGNED NOT NULL,
  `desc_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `emp_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nick_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date NOT NULL,
  `image_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_number`, `last_name`, `first_name`, `middle_name`, `nick_name`, `birthdate`, `image_path`, `created_at`, `updated_at`) VALUES
(1, '0001', 'Trump', 'Donald', NULL, NULL, '2020-01-05', '1578164394.jpeg', NULL, NULL),
(2, '0002', 'Panelo', 'Salvador', NULL, NULL, '2020-01-01', 'user3-128x128.jpg', NULL, NULL),
(3, '0003', 'James', 'Lebron', NULL, NULL, '2020-01-01', '1578181204.jpeg', NULL, NULL),
(4, '0004', 'Leonard', 'Kawhi', NULL, NULL, '2020-01-30', '1578181204.jpeg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itemcriteria`
--

CREATE TABLE `itemcriteria` (
  `itemcriteria_id` int(10) UNSIGNED NOT NULL,
  `complex_id` int(11) NOT NULL,
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
(2, '2020_01_02_152437_create_permissiongroup_table', 1),
(3, '2020_01_02_162750_create_employee_table', 1),
(4, '2020_01_03_141444_create_project_table', 1),
(5, '2020_01_03_142030_create_task_table', 1),
(6, '2020_01_03_174633_create_pointsitem_table', 1),
(7, '2020_01_03_180224_create_itemcriteria_table', 1),
(8, '2020_01_04_023810_create_area_table', 1),
(9, '2020_01_04_024111_create_areatype_table', 1),
(10, '2020_01_04_024330_create_complex_table', 1),
(11, '2020_01_05_012735_create_build_table', 1),
(12, '2020_01_05_014159_create_defect_type_table', 1),
(13, '2020_01_05_014238_create_defect_cause_table', 1),
(14, '2020_01_05_014320_create_defects_table', 1),
(15, '2020_01_03_152030_create_task_table', 2),
(16, '2020_01_03_162030_create_task_table', 3),
(17, '2020_01_03_172030_create_task_table', 4),
(18, '2020_01_03_182030_create_task_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `permissiongroup`
--

CREATE TABLE `permissiongroup` (
  `grp_id` smallint(5) UNSIGNED NOT NULL,
  `type` enum('superadmin','admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissiongroup`
--

INSERT INTO `permissiongroup` (`grp_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', NULL, NULL),
(2, 'admin', NULL, NULL),
(3, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pointsitem`
--

CREATE TABLE `pointsitem` (
  `pointsitem_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemcriteria_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `proj_id` int(10) UNSIGNED NOT NULL,
  `proj_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`proj_id`, `proj_name`, `created_at`, `updated_at`) VALUES
(1, 'Asset Management System', NULL, NULL),
(2, 'Patient Monitoring System', NULL, NULL),
(3, 'Hotel Services Module', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `inc_type` enum('bug','task','enhancement') COLLATE utf8mb4_unicode_ci NOT NULL,
  `severity` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` date NOT NULL,
  `completed_at` date NOT NULL,
  `emp_id` int(11) NOT NULL,
  `build_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `name`, `inc_type`, `severity`, `started_at`, `completed_at`, `emp_id`, `build_id`, `created_at`, `updated_at`) VALUES
('0001', 'Testing Deployment 1', 'enhancement', 'low', '2020-05-05', '2020-06-06', 3, 1, '2020-01-04 19:30:19', '2020-01-04 19:30:19'),
('0002', 'Testing Deployment Number 2', 'bug', 'high', '2020-01-01', '2020-02-02', 3, 2, '2020-01-04 19:40:13', '2020-01-04 19:40:13'),
('0003', 'Deployment', 'task', 'medium', '2020-05-01', '2020-06-01', 3, 2, '2020-01-04 20:01:54', '2020-01-04 20:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `grp_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `emp_id`, `grp_id`, `created_at`, `updated_at`) VALUES
(1, 'superadmin@example.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 1, NULL, NULL),
(2, 'admin@example.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 2, NULL, NULL),
(3, 'user1@example.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 3, NULL, NULL),
(4, 'user2@example.com', '5f4dcc3b5aa765d61d8327deb882cf99', 4, 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `areatype`
--
ALTER TABLE `areatype`
  ADD PRIMARY KEY (`areatype_id`);

--
-- Indexes for table `build`
--
ALTER TABLE `build`
  ADD PRIMARY KEY (`build_id`);

--
-- Indexes for table `complex`
--
ALTER TABLE `complex`
  ADD PRIMARY KEY (`complex_id`);

--
-- Indexes for table `defects`
--
ALTER TABLE `defects`
  ADD PRIMARY KEY (`defects_id`);

--
-- Indexes for table `defect_cause`
--
ALTER TABLE `defect_cause`
  ADD PRIMARY KEY (`defect_cause_id`);

--
-- Indexes for table `defect_type`
--
ALTER TABLE `defect_type`
  ADD PRIMARY KEY (`defect_type_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `itemcriteria`
--
ALTER TABLE `itemcriteria`
  ADD PRIMARY KEY (`itemcriteria_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissiongroup`
--
ALTER TABLE `permissiongroup`
  ADD PRIMARY KEY (`grp_id`);

--
-- Indexes for table `pointsitem`
--
ALTER TABLE `pointsitem`
  ADD PRIMARY KEY (`pointsitem_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`proj_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

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
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `areatype`
--
ALTER TABLE `areatype`
  MODIFY `areatype_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `build`
--
ALTER TABLE `build`
  MODIFY `build_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complex`
--
ALTER TABLE `complex`
  MODIFY `complex_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defects`
--
ALTER TABLE `defects`
  MODIFY `defects_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defect_cause`
--
ALTER TABLE `defect_cause`
  MODIFY `defect_cause_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defect_type`
--
ALTER TABLE `defect_type`
  MODIFY `defect_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `itemcriteria`
--
ALTER TABLE `itemcriteria`
  MODIFY `itemcriteria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissiongroup`
--
ALTER TABLE `permissiongroup`
  MODIFY `grp_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pointsitem`
--
ALTER TABLE `pointsitem`
  MODIFY `pointsitem_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `proj_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
