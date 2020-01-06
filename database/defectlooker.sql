-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2020 at 07:28 PM
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

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `descr`, `created_at`, `updated_at`) VALUES
(1, 'API', NULL, NULL),
(2, 'SCREENS', NULL, NULL),
(3, 'DATABASE', NULL, NULL),
(4, 'REPORTS', NULL, NULL),
(5, 'CONFIGURATIONS', NULL, NULL),
(6, 'UT SCENARIOS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `areatype`
--

CREATE TABLE `areatype` (
  `areatype_id` int(10) UNSIGNED NOT NULL,
  `descr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areatype`
--

INSERT INTO `areatype` (`areatype_id`, `descr`, `area_id`, `created_at`, `updated_at`) VALUES
(1, 'METHODS/PROPERTIES', 1, NULL, NULL),
(2, 'XAML/VB/RESX', 2, NULL, NULL),
(3, 'SCHEMA', 3, NULL, NULL),
(4, 'DATA', 3, NULL, NULL),
(5, 'VIEWS', 3, NULL, NULL),
(6, 'STORED PROC', 3, NULL, NULL),
(7, 'LAYOUT', 4, NULL, NULL),
(8, 'DATA RETRIEVAL', 4, NULL, NULL),
(9, 'DATA TRANSFORMATION', 4, NULL, NULL),
(10, 'XPA/SCL', 5, NULL, NULL),
(11, 'SCENARIOS', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `build`
--

CREATE TABLE `build` (
  `build_id` int(10) UNSIGNED NOT NULL,
  `proj_id` int(11) NOT NULL,
  `descr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `build`
--

INSERT INTO `build` (`build_id`, `proj_id`, `descr`, `created_at`, `updated_at`) VALUES
(1, 1, 'TASKFORCE1.0DROP1', NULL, NULL),
(2, 2, 'SAVERS1.0DROP1', NULL, NULL),
(3, 3, 'CHICOS1.0DROP1', NULL, NULL);

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

--
-- Dumping data for table `complex`
--

INSERT INTO `complex` (`complex_id`, `descr`, `weight`, `criteria`, `areatype_id`, `created_at`, `updated_at`) VALUES
(1, 'very simple', '1.00', '1-2 validation checks\r\nor \r\n1-2 basic operations of add, subtruct, multiply or divide\r\nor\r\nSet 1-5 variables', 1, NULL, NULL),
(2, 'simple', '2.00', '3-5 validation checks\r\nor \r\n3-5 basic operations of add, subtruct, multiply or divide\r\nor\r\nSet over 5 variables', 1, NULL, NULL),
(3, 'medium', '3.00', '5-8 validation checks\r\nor\r\nData CRUD or transformation from 1-2 objects', 1, NULL, NULL),
(4, 'complex', '4.00', '9-10 validation checks\r\nor\r\nData CRUD or transformation from 3-5 objects', 1, NULL, NULL),
(5, 'very complex', '5.00', 'Over 10 validation checks\r\nor\r\nData CRUD from over 5 objects \r\nor Involves complex transformation of the data retrieved', 1, NULL, NULL),
(6, 'very simple', '1.00', 'Add/Modify/Delete 1-3\r\n- textbox\r\n- radiobutton\r\n- checkbox\r\n- dropdown list\r\n- button\r\nAdd/Modify/Delete 1-5 labels', 2, NULL, NULL),
(7, 'simple', '2.00', 'Add/Modify/Delete 4 - 6\r\n- textbox\r\n- radiobutton\r\n- checkbox\r\n- dropdown list\r\n- button\r\nAdd/Modify/Delete 1-2\r\n- table/grid - retrieval and display only\r\nAdd/Modify/Delete 6-10 labels', 2, NULL, NULL),
(8, 'medium', '3.00', 'Add/Modify/Delete 7 - 10\r\n- textbox\r\n- radiobutton\r\n- checkbox\r\n- dropdown list\r\n- button\r\nAdd/Modify/Delete 3 - 4\r\n- table/grid - retrieval and display only\r\nAdd/Modify/Delete 1-2\r\n- table/grid - with updateable rows, calculations, or pop-up window\r\nAdd/Modify/Delete over 10 labels', 2, NULL, NULL),
(9, 'complex', '4.00', 'Add/Modify/Delete over 10\r\n- textbox\r\n- radiobutton\r\n- checkbox\r\n- dropdown list\r\n- button\r\nAdd/Modify/Delete over 4\r\n- table/grid - retrieval and display only\r\nAdd/Modify/Delete over 2\r\n- table/grid - with updateable rows, calculations, or pop-up window ', 2, NULL, NULL),
(10, 'very simple', '0.50', '1-3 changes to the table\'s schema', 3, NULL, NULL),
(11, 'simple', '1.00', '4 - 5 changes to the table\'s schema', 3, NULL, NULL),
(12, 'medium', '1.50', '5-10 changes to the table\'s schema\r\nOr\r\nNew table with 1-10 columns', 3, NULL, NULL),
(13, 'complex', '2.00', 'Over 10 changes to the table\'s schema\r\nOr\r\nNew table with over 10 columns', 3, NULL, NULL),
(14, 'very simple', '0.25', '0-1 CUD records', 4, NULL, NULL),
(15, 'simple', '0.50', '2-10 CUD records', 4, NULL, NULL),
(16, 'medium', '0.75', '11-20 CUD records', 4, NULL, NULL),
(17, 'complex', '1.00', '21-30 CUD records', 4, NULL, NULL),
(18, 'very complex', '1.25', 'Over 30 CUD records', 4, NULL, NULL),
(19, 'very simple', '0.75', 'Adding/deleting 1-5 columns', 5, NULL, NULL),
(20, 'simple', '1.50', 'Adding/deleting 5-10 columns', 5, NULL, NULL),
(21, 'medium', '2.25', 'Adding/deleting 11-20 columns \r\nor\r\njoining 2 tables', 5, NULL, NULL),
(22, 'complex', '3.00', 'Adding/deleting over20\r\nor\r\njoining 2-3 tables', 5, NULL, NULL),
(23, 'very complex', '3.75', 'Joining over 3 tables', 5, NULL, NULL),
(24, 'very simple', '1.00', '1 referenced object with 1-2 basic operations of add, subtract, multiply or divide', 6, NULL, NULL),
(25, 'simple', '2.00', '2-3 referenced object with 3-5 basic operations of add, subtruct, multiply or divide', 6, NULL, NULL),
(26, 'medium', '3.00', '4-6 referenced object with over 5 basic operations of add, subtruct, multiply or divide', 6, NULL, NULL),
(27, 'complex', '4.00', '6-10 referenced object with over 5 basic operations of add, subtruct, multiply or divide', 6, NULL, NULL),
(28, 'very complex', '5.00', 'Over 10 referenced object with over 5 basic operations of add, subtruct, multiply or divide', 6, NULL, NULL),
(29, 'very simple', '0.50', 'List with 1-5 columns', 7, NULL, NULL),
(30, 'simple', '1.00', 'List with 5-8 columns', 7, NULL, NULL),
(31, 'medium', '1.50', 'List with 1 total and 1 sub total', 7, NULL, NULL),
(32, 'complex', '2.00', 'List with 1 total and 2-3 sub totals', 7, NULL, NULL),
(33, 'very complex', '2.50', 'List with 1 total and over 3 sub totals', 7, NULL, NULL),
(34, 'very simple', '1.00', 'From 1 object', 8, NULL, NULL),
(35, 'simple', '2.00', 'From 2 objects', 8, NULL, NULL),
(36, 'medium', '3.00', 'From 3-4 objects', 8, NULL, NULL),
(37, 'complex', '4.00', 'From 5-6 objects', 8, NULL, NULL),
(38, 'very complex', '5.00', 'From over 7 objects', 8, NULL, NULL),
(39, 'very simple', '1.00', '1-4 basic operations like add, subtract, multiply and divide', 9, NULL, NULL),
(40, 'simple', '2.00', '5-10 basic operations like add, subtract, multiply and divide', 9, NULL, NULL),
(41, 'medium', '3.00', '11-15 basic operations like add, subtract, multiply and divide\r\nor 1-4 use of statistical functions like averages, deviations, percentages', 9, NULL, NULL),
(42, 'complex', '4.00', 'over 15 basic operations like add, subtract, multiply and divide\r\nor 5-10 use of statistical functions like averages, deviations, percentages', 9, NULL, NULL),
(43, 'very complex', '5.00', 'Use of over 10  statistical functions like averages, deviations, percentages or advanced mathematics or must solve a very particular process.', 9, NULL, NULL),
(44, 'very simple', '1.00', 'Adding/Modifying 1-10 nodes', 10, NULL, NULL),
(45, 'simple', '2.00', 'Adding/Modifying 11-20 nodes', 10, NULL, NULL),
(46, 'medium', '3.00', 'Adding/Modifying 21-30 nodes', 10, NULL, NULL),
(47, 'complex', '4.00', 'Adding/Modifying 31-40 nodes', 10, NULL, NULL),
(48, 'very complex', '5.00', 'Adding/Modifying over 40 nodes', 10, NULL, NULL),
(49, 'very simple', '0.25', '1-4 steps', 11, NULL, NULL),
(50, 'simple', '0.50', '5-8 steps', 11, NULL, NULL),
(51, 'medium', '0.75', '9-12 steps', 11, NULL, NULL),
(52, 'complex', '1.00', 'Over 12 steps', 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `defects`
--

CREATE TABLE `defects` (
  `defects_id` bigint(20) UNSIGNED NOT NULL,
  `orig_ref_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

--
-- Dumping data for table `defect_cause`
--

INSERT INTO `defect_cause` (`defect_cause_id`, `desc_cause`, `created_at`, `updated_at`) VALUES
(1, 'Inadequate Self-review/Testing', NULL, NULL),
(2, 'Inconsistent Requirements', NULL, NULL),
(3, 'Incomplete Requirements', NULL, NULL),
(4, 'Incompatible versions', NULL, NULL),
(5, 'Data Error - Missing', NULL, NULL),
(6, 'Data Error - Incorrect', NULL, NULL),
(7, 'User Error', NULL, NULL),
(8, 'Lack of Training', NULL, NULL),
(9, 'Others', NULL, NULL);

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

--
-- Dumping data for table `defect_type`
--

INSERT INTO `defect_type` (`defect_type_id`, `desc_type`, `created_at`, `updated_at`) VALUES
(1, 'Logic Error', NULL, NULL),
(2, 'Missed functionality', NULL, NULL),
(3, 'Missed requirement', NULL, NULL),
(4, 'Data Error', NULL, NULL),
(5, 'Other error', NULL, NULL);

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
(1, '4100035', 'SPENCER', 'KARA', 'ARNOLD', 'KAY', '1992-01-01', 'user1-128x128.jpg', NULL, NULL),
(2, '4200040', 'PATTON', 'GERTRUDE', 'MALONE', 'GERT', '1993-01-01', 'user2-160x160.jpg', NULL, NULL),
(3, '4300045', 'JACOBS', 'DARIN', 'FULLER', 'RIN', '1992-01-01', 'user3-128x128.jpg', NULL, NULL);

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
(1, '2020_01_02_152437_create_permissiongroup_table', 1),
(2, '2020_01_02_162750_create_employee_table', 1),
(3, '2020_01_03_141444_create_project_table', 1),
(4, '2020_01_03_174633_create_pointsitem_table', 1),
(5, '2020_01_03_180224_create_itemcriteria_table', 1),
(6, '2020_01_03_182030_create_task_table', 1),
(7, '2020_01_04_023810_create_area_table', 1),
(8, '2020_01_04_024111_create_areatype_table', 1),
(9, '2020_01_04_024330_create_complex_table', 1),
(10, '2020_01_05_012735_create_build_table', 1),
(11, '2020_01_05_014159_create_defect_type_table', 1),
(12, '2020_01_05_014238_create_defect_cause_table', 1),
(13, '2020_01_05_014320_create_defects_table', 1),
(14, '2020_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissiongroup`
--

CREATE TABLE `permissiongroup` (
  `grp_id` smallint(5) UNSIGNED NOT NULL,
  `type` enum('SUPERADMIN','ADMIN','USER') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissiongroup`
--

INSERT INTO `permissiongroup` (`grp_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'SUPERADMIN', NULL, NULL),
(2, 'ADMIN', NULL, NULL),
(3, 'USER', NULL, NULL);

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
(1, 'TASKFORCE', NULL, NULL),
(2, 'SAVERS', NULL, NULL),
(3, 'CHICOS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `inc_type` enum('BUG','TASK','ENHANCEMENT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `severity` enum('LOW','MEDIUM','HIGH') COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` date NOT NULL,
  `completed_at` date NOT NULL,
  `emp_id` int(11) NOT NULL,
  `build_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `name`, `inc_type`, `severity`, `started_at`, `completed_at`, `emp_id`, `build_id`, `created_at`, `updated_at`) VALUES
('ENH00001', 'EXAMPLE OF ENH NAME', 'ENHANCEMENT', 'HIGH', '2019-12-30', '2020-01-05', 1, 1, NULL, NULL),
('TSK00001', 'EXAMPLE OF TASK NAME1', 'TASK', 'MEDIUM', '2019-12-29', '2020-01-04', 2, 1, NULL, NULL),
('TSK00002', 'EXAMPLE OF TASK NAME2', 'TASK', 'LOW', '2019-12-28', '2020-01-03', 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL,
  `grp_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `emp_id`, `grp_id`, `created_at`, `updated_at`) VALUES
(1, 'superadmin@gmail.com', '$2y$10$8.WCAUtchK0mAaOnAGS.TuXYmPVoS3IJsZ.fAinPdLCYfiJFbhzdS', 1, 1, NULL, NULL),
(2, 'admin@gmail.com', '$2y$10$6GzdrmzKr.doVtAAH2zHru2h.HzNixVkPhjDaLzAfl0c8hBblXhje', 2, 2, NULL, NULL),
(3, 'user1@gmail.com', '$2y$10$hEHxDiFUTew7EAdCVfyiluJiLOB64blqxF/fR.jxeGlYTPUwjgG/q', 3, 3, NULL, NULL);

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
  ADD PRIMARY KEY (`areatype_id`),
  ADD KEY `areatype_area_id_foreign` (`area_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_grp_id_foreign` (`grp_id`),
  ADD KEY `users_emp_id_foreign` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `areatype`
--
ALTER TABLE `areatype`
  MODIFY `areatype_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `build`
--
ALTER TABLE `build`
  MODIFY `build_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complex`
--
ALTER TABLE `complex`
  MODIFY `complex_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `defects`
--
ALTER TABLE `defects`
  MODIFY `defects_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defect_cause`
--
ALTER TABLE `defect_cause`
  MODIFY `defect_cause_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `defect_type`
--
ALTER TABLE `defect_type`
  MODIFY `defect_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itemcriteria`
--
ALTER TABLE `itemcriteria`
  MODIFY `itemcriteria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areatype`
--
ALTER TABLE `areatype`
  ADD CONSTRAINT `areatype_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `users_grp_id_foreign` FOREIGN KEY (`grp_id`) REFERENCES `permissiongroup` (`grp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
