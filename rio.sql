-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 04:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rio`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_modules`
--

DROP TABLE IF EXISTS `access_modules`;
CREATE TABLE `access_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `controller_id` int(10) UNSIGNED NOT NULL,
  `action_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller_id` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `action`, `controller_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'index', 3, 1, '2021-04-22 08:56:25', '2021-04-22 08:56:25'),
(5, 'index1', 3, 1, '2021-04-22 09:10:04', '2021-04-22 09:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(27, 'user', 'Account Updated', 'App\\Models\\User', NULL, 7, 'App\\Models\\User', 1, '{\"user_id\":1,\"first_name\":\"Administror\",\"ip\":\"::1\"}', NULL, '2021-10-27 12:18:15', '2021-10-27 12:18:15'),
(28, 'default', 'This User Model has been updated', 'App\\Models\\User', 'updated', 7, 'App\\Models\\User', 1, '[]', NULL, '2021-10-27 12:24:52', '2021-10-27 12:24:52'),
(29, 'user', 'Account Updated', 'App\\Models\\User', 'updated', 7, 'App\\Models\\User', 1, '{\"user_id\":1,\"first_name\":\"Administror\",\"ip\":\"::1\"}', NULL, '2021-10-27 12:34:27', '2021-10-27 12:34:27'),
(30, 'Permission', 'Permission Created', 'Spatie\\Permission\\Models\\Permission', 'created', NULL, 'App\\Models\\User', 1, '{\"user_id\":1,\"first_name\":\"Administror\",\"ip\":\"::1\"}', NULL, '2021-10-27 12:48:35', '2021-10-27 12:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `add_batch_manufacture`
--

DROP TABLE IF EXISTS `add_batch_manufacture`;
CREATE TABLE `add_batch_manufacture` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proName` int(11) DEFAULT 0,
  `bmrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refMfrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BatchSize` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Viscosity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ProductionCommencedon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ProductionCompletedon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ManufacturingDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RetestDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doneBy` int(11) DEFAULT 0,
  `checkedBy` int(11) DEFAULT 0,
  `inlineRadioOptions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval` tinyint(4) DEFAULT 0,
  `approvalDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedByI` int(11) DEFAULT 0,
  `Remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_batch_manufacture`
--

INSERT INTO `add_batch_manufacture` (`id`, `proName`, `bmrNo`, `batchNo`, `refMfrNo`, `grade`, `BatchSize`, `Viscosity`, `ProductionCommencedon`, `ProductionCompletedon`, `ManufacturingDate`, `RetestDate`, `doneBy`, `checkedBy`, `inlineRadioOptions`, `approval`, `approvalDate`, `checkedByI`, `Remark`, `is_delete`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 31, '112', '12', '12', '12', '100', NULL, '2021-08-07', '2021-08-07', '2021-08-07', '2021-08-07', 1, 1, NULL, 1, NULL, 1, NULL, 1, 1, '2021-08-07 14:56:28', '2021-08-07 14:56:28'),
(2, 31, '1235', '123456', '12', '12', '100', NULL, '2021-08-16', '2021-08-16', '2021-08-16', '2021-08-16', 1, 1, NULL, 1, NULL, 1, NULL, 1, 1, '2021-08-16 11:50:43', '2021-08-16 11:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `add_lotsl`
--

DROP TABLE IF EXISTS `add_lotsl`;
CREATE TABLE `add_lotsl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bmrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` int(11) DEFAULT 0,
  `refMfrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lotNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ReactorNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Process_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homogenize_done` tinyint(4) DEFAULT 0,
  `homogenize_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_lotsl`
--

INSERT INTO `add_lotsl` (`id`, `order_id`, `proName`, `bmrNo`, `batchNo`, `batch_id`, `refMfrNo`, `Date`, `lotNo`, `ReactorNo`, `Process_date`, `homogenize_done`, `homogenize_date`, `created_at`, `updated_at`) VALUES
(3, '13211711', '30', '112', '12', 1, '12', '2021-08-13', '1', '3', '2021-08-13', 0, NULL, '2021-08-13 12:24:11', '2021-08-13 12:24:11'),
(4, '14212255', '30', '112', '12', 1, '12', '2021-08-14', '2', '3', '2021-08-14', 0, NULL, '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(5, '14212317', '30', '112', '12', 1, '12', '2021-08-14', '3', '3', '2021-08-14', 0, NULL, '2021-08-14 18:13:17', '2021-08-14 18:13:17'),
(6, '16211854', '31', '1235', '123456', 0, '12', '2021-08-16', '1', '5', '2021-08-16', 0, NULL, '2021-08-16 12:41:54', '2021-08-16 12:41:54'),
(7, '16211807', '31', '1235', '123456', 0, '12', '2021-08-16', '1', '5', '2021-08-16', 0, NULL, '2021-08-16 13:17:07', '2021-08-16 13:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `add_lots_raw_material_detail`
--

DROP TABLE IF EXISTS `add_lots_raw_material_detail`;
CREATE TABLE `add_lots_raw_material_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MaterialName` int(11) DEFAULT 0,
  `rmbatchno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_lots_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_lots_raw_material_detail`
--

INSERT INTO `add_lots_raw_material_detail` (`id`, `MaterialName`, `rmbatchno`, `Quantity`, `add_lots_id`, `created_at`, `updated_at`) VALUES
(13, 24, '1', '5', '3', '2021-08-13 12:24:11', '2021-08-13 12:24:11'),
(14, 24, '1', '5', '3', '2021-08-13 12:24:11', '2021-08-13 12:24:11'),
(15, 23, '2', '10', '3', '2021-08-13 12:24:12', '2021-08-13 12:24:12'),
(16, 24, '1', '5', '3', '2021-08-13 12:24:12', '2021-08-13 12:24:12'),
(17, 23, '2', '10', '3', '2021-08-13 12:24:12', '2021-08-13 12:24:12'),
(18, 24, '1', '10', '3', '2021-08-13 12:24:12', '2021-08-13 12:24:12'),
(19, 24, '1', '5', '4', '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(20, 24, '1', '5', '4', '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(21, 23, '2', '10', '4', '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(22, 24, '1', '5', '4', '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(23, 23, '2', '10', '4', '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(24, 24, '1', '10', '4', '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(25, 24, '1', '5', '5', '2021-08-14 18:13:17', '2021-08-14 18:13:17'),
(26, 24, '1', '5', '5', '2021-08-14 18:13:17', '2021-08-14 18:13:17'),
(27, 23, '2', '10', '5', '2021-08-14 18:13:17', '2021-08-14 18:13:17'),
(28, 24, '1', '5', '5', '2021-08-14 18:13:18', '2021-08-14 18:13:18'),
(29, 23, '2', '10', '5', '2021-08-14 18:13:18', '2021-08-14 18:13:18'),
(30, 24, '1', '10', '5', '2021-08-14 18:13:18', '2021-08-14 18:13:18'),
(31, 23, '2', '10', '7', '2021-08-16 13:17:08', '2021-08-16 13:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `ar_no_master`
--

DROP TABLE IF EXISTS `ar_no_master`;
CREATE TABLE `ar_no_master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batch_manufacturing_records_line_clearance_record`
--

DROP TABLE IF EXISTS `batch_manufacturing_records_line_clearance_record`;
CREATE TABLE `batch_manufacturing_records_line_clearance_record` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bmrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refMfrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batch_manufacturing_records_list_of_equipment`
--

DROP TABLE IF EXISTS `batch_manufacturing_records_list_of_equipment`;
CREATE TABLE `batch_manufacturing_records_list_of_equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bmrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` int(11) DEFAULT 0,
  `refMfrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Remark` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_manufacturing_records_list_of_equipment`
--

INSERT INTO `batch_manufacturing_records_list_of_equipment` (`id`, `order_id`, `proName`, `bmrNo`, `batchNo`, `batch_id`, `refMfrNo`, `Remark`, `created_at`, `updated_at`) VALUES
(1, '13211319', '30', '112', '12', 1, '12', NULL, '2021-08-07 16:21:41', '2021-08-13 07:53:19'),
(2, '16211824', '31', '1235', '123456', 2, '12', NULL, '2021-08-16 12:41:24', '2021-08-16 12:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `batch_manufacturing_records_packing`
--

DROP TABLE IF EXISTS `batch_manufacturing_records_packing`;
CREATE TABLE `batch_manufacturing_records_packing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bmrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refMfrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ManufacturerDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Temperature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Humidity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TemperatureP` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `50kgDrums` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `20kgDrums` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EndstartTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `areaCleanliness` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CareaCleanliness` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rmInput` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fgOutput` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filledDrums` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excessFilledDrums` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qcsampling` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StabilitySample` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `WorkingSlandered` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValidationSample` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CustomerSample` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ActualYield` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ApprovedBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_manufacturing_records_packing`
--

INSERT INTO `batch_manufacturing_records_packing` (`id`, `proName`, `bmrNo`, `batchNo`, `refMfrNo`, `ManufacturerDate`, `Observation`, `Temperature`, `Humidity`, `TemperatureP`, `50kgDrums`, `20kgDrums`, `startTime`, `EndstartTime`, `areaCleanliness`, `CareaCleanliness`, `rmInput`, `fgOutput`, `filledDrums`, `excessFilledDrums`, `qcsampling`, `StabilitySample`, `WorkingSlandered`, `ValidationSample`, `CustomerSample`, `ActualYield`, `checkedBy`, `ApprovedBy`, `Remark`, `batch_id`, `created_at`, `updated_at`) VALUES
(1, '31', '112', '12', '12', '2021-08-16', '10', '10', '10', '10', '2', '3', '22:57', '00:01', '1', '1', '100', '90', '10', '10', '101', '10', '10', '10', '10', '10', '1', '1', 'test test', 1, '2021-08-16 09:41:12', '2021-08-16 09:41:12'),
(2, '31', '1235', '123456', '12', '2021-08-16', '10', '10', '10', '10', '10', '10', '19:20', '19:22', '1', '1', '100', '10', '101', '10', '10', '10', '10', '10', '1', '01', '1', '1', NULL, 0, '2021-08-16 13:49:51', '2021-08-16 13:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_raw_material`
--

DROP TABLE IF EXISTS `bill_of_raw_material`;
CREATE TABLE `bill_of_raw_material` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNoI` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` int(11) DEFAULT 0,
  `bmrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refMfrNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doneBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_raw_material_details`
--

DROP TABLE IF EXISTS `bill_of_raw_material_details`;
CREATE TABLE `bill_of_raw_material_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rawMaterialName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_of_raw_material_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `controllers`
--

DROP TABLE IF EXISTS `controllers`;
CREATE TABLE `controllers` (
  `id` int(10) UNSIGNED NOT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `menu_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_menu` tinyint(4) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `controllers`
--

INSERT INTO `controllers` (`id`, `controller`, `publish`, `menu_name`, `is_menu`, `parent`, `order`, `created_at`, `updated_at`) VALUES
(3, 'Deparment', 1, 'Department', 1, 0, 1, '2021-04-22 08:24:25', '2021-04-22 08:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_type` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'W',
  `publish` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`, `department_type`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'W', 1, '2021-04-21 14:23:05', '2021-04-21 14:23:09'),
(2, 'Warehouse', 'W', 1, '2021-05-06 18:21:59', '2021-05-06 18:21:59'),
(3, 'Day Store', 'W', 1, '2021-05-07 17:25:37', '2021-06-30 17:56:19'),
(4, 'Purchase', 'W', 1, '2021-05-07 17:25:55', '2021-05-07 17:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, '2021-04-21 14:23:27', '2021-04-21 14:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `detail_packing_material_requisition`
--

DROP TABLE IF EXISTS `detail_packing_material_requisition`;
CREATE TABLE `detail_packing_material_requisition` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `PackingMaterialName` int(11) NOT NULL DEFAULT 0,
  `Capacity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisition_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'R' COMMENT 'R-Raw material,F-finish Good, P- Packing material',
  `approved_qty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_packing_material_requisition`
--

INSERT INTO `detail_packing_material_requisition` (`id`, `PackingMaterialName`, `Capacity`, `Quantity`, `requisition_id`, `created_at`, `updated_at`, `type`, `approved_qty`) VALUES
(2, 23, NULL, '10', '2', '2021-08-11 06:52:05', '2021-08-11 06:54:34', 'R', 10),
(3, 23, NULL, '10', '3', '2021-08-11 08:21:37', '2021-08-11 08:22:28', 'R', 5),
(4, 24, NULL, '5', '3', '2021-08-11 08:21:37', '2021-08-11 08:22:29', 'R', 5),
(5, 24, NULL, '5', '4', '2021-08-11 08:40:30', '2021-08-11 11:03:00', 'R', 5),
(6, 25, '25', '20', '5', '2021-08-11 12:14:43', '2021-08-11 14:57:38', 'P', 20),
(7, 25, '25', '20', '5', '2021-08-11 12:14:43', '2021-08-11 14:57:38', 'P', 20),
(8, 23, NULL, '10', '6', '2021-08-16 11:51:11', '2021-08-16 11:51:33', 'R', 10),
(9, 25, '25', '10', '7', '2021-08-16 12:40:50', '2021-08-16 12:41:06', 'P', 10);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_code`
--

DROP TABLE IF EXISTS `equipment_code`;
CREATE TABLE `equipment_code` (
  `id` int(11) NOT NULL,
  `equipment_id` int(11) DEFAULT 0,
  `code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipment_code`
--

INSERT INTO `equipment_code` (`id`, `equipment_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 1, 'PR/RC/001', '2021-07-20 20:01:02', '2021-07-20 20:01:02'),
(2, 1, 'PR/RC/002', '2021-07-20 20:01:02', '2021-07-20 20:01:02'),
(3, 2, 'PR/BT/001', '2021-07-22 14:26:44', '2021-07-22 14:26:44'),
(4, 2, 'PR/BT/002', '2021-07-22 14:26:44', '2021-07-22 14:26:44'),
(5, 2, 'PR/BT/003', '2021-07-22 14:27:24', '2021-07-22 14:27:24'),
(6, 3, 'PR/FS/001', '2021-07-22 14:27:24', '2021-07-22 14:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_name`
--

DROP TABLE IF EXISTS `equipment_name`;
CREATE TABLE `equipment_name` (
  `id` int(11) NOT NULL,
  `equipment` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipment_name`
--

INSERT INTO `equipment_name` (`id`, `equipment`, `created_at`, `updated_at`) VALUES
(1, 'SS Reactor', '2021-07-20 19:56:45', '2021-07-20 19:56:45'),
(2, 'SS Homogenising Tank', '2021-07-20 19:57:00', '2021-07-20 19:57:00'),
(3, 'Filling Station', '2021-07-20 19:57:11', '2021-07-20 19:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
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
-- Table structure for table `finished_goods_dispatch`
--

DROP TABLE IF EXISTS `finished_goods_dispatch`;
CREATE TABLE `finished_goods_dispatch` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dispath_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatch_form` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatch_to` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `good_dispatch_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_of_dispatch` int(11) NOT NULL,
  `party_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` int(11) NOT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` int(11) NOT NULL,
  `viscosity` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mfg_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_ratest_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_no_of_200kg_drums` int(11) DEFAULT NULL,
  `total_no_of_50kg_drums` int(11) DEFAULT NULL,
  `total_no_of_30kg_drums` int(11) DEFAULT NULL,
  `total_no_of_5kg_drums` int(11) DEFAULT NULL,
  `total_no_of_fiber_board_drums` double DEFAULT NULL,
  `total_no_qty` int(11) NOT NULL,
  `seal_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatch_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatch_by` int(11) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generate_label`
--

DROP TABLE IF EXISTS `generate_label`;
CREATE TABLE `generate_label` (
  `id` int(11) NOT NULL,
  `simethicone` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_no_I` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` int(11) DEFAULT 0,
  `mfg_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retest_date` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_wt` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tare_wt` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generate_label`
--

INSERT INTO `generate_label` (`id`, `simethicone`, `batch_no_I`, `batch_id`, `mfg_date`, `retest_date`, `net_wt`, `tare_wt`, `Remark`, `created_at`, `updated_at`) VALUES
(1, '100', '12', 1, '2021-08-07', '2021-08-07', '100', '100', NULL, '2021-08-16 10:48:54', '2021-08-16 10:48:54'),
(2, 'qwqw', '123456', 2, '2021-08-16', '2021-08-16', NULL, '100', NULL, '2021-08-16 13:51:05', '2021-08-16 13:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `goods_receipt_notes`
--

DROP TABLE IF EXISTS `goods_receipt_notes`;
CREATE TABLE `goods_receipt_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `goods_going_from` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goods_going_to` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_receipt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacurer` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goods_receipt_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods_receipt_notes`
--

INSERT INTO `goods_receipt_notes` (`id`, `goods_going_from`, `goods_going_to`, `date_of_receipt`, `manufacurer`, `supplier`, `invoice_no`, `goods_receipt_no`, `created_by`, `remark`, `created_at`, `updated_at`) VALUES
(10, '4', '2', '1617647400', 6, 7, '002', 'GRN/PM/2021/001', 1, '', '2021-05-24 15:50:13', '2021-05-24 15:50:13'),
(11, '4', '2', '1628274600', 4, 5, '123', '31212', 1, '', '2021-08-07 14:39:41', '2021-08-07 14:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `goods_receipt_note_items`
--

DROP TABLE IF EXISTS `goods_receipt_note_items`;
CREATE TABLE `goods_receipt_note_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `good_receipt_id` int(10) UNSIGNED NOT NULL,
  `material` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `used_qty` int(11) DEFAULT 0,
  `ar_no_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods_receipt_note_items`
--

INSERT INTO `goods_receipt_note_items` (`id`, `good_receipt_id`, `material`, `total_qty`, `used_qty`, `ar_no_date`, `created_at`, `updated_at`) VALUES
(1, 11, 25, 1000, 50, '123', '2021-08-07 14:39:41', '2021-08-16 12:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homogenizing`
--

DROP TABLE IF EXISTS `homogenizing`;
CREATE TABLE `homogenizing` (
  `id` int(11) NOT NULL,
  `proName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `bmrNo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNo` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` int(11) DEFAULT 0,
  `refMfrNo` varchar(425) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homoTank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Observedvalue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homogenizing`
--

INSERT INTO `homogenizing` (`id`, `proName`, `order_id`, `bmrNo`, `batchNo`, `batch_id`, `refMfrNo`, `homoTank`, `Observedvalue`, `updated_at`, `created_at`) VALUES
(1, '31', 16211346, '112', '12', 1, '12', '4', '1234', '2021-08-16 07:55:46', '2021-08-16 07:55:46'),
(2, '31', 16211353, '112', '12', 1, '12', '4', 'Test', '2021-08-16 08:07:53', '2021-08-16 08:07:53'),
(3, '31', 16211917, '1235', '123456', 2, '12', '6', 'Test', '2021-08-16 13:49:17', '2021-08-16 13:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `homogenizing_list`
--

DROP TABLE IF EXISTS `homogenizing_list`;
CREATE TABLE `homogenizing_list` (
  `id` int(11) NOT NULL,
  `dateProcess` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lots_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `stratTime` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endTime` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doneby` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homogenizing_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homogenizing_list`
--

INSERT INTO `homogenizing_list` (`id`, `dateProcess`, `lots_name`, `qty`, `stratTime`, `endTime`, `doneby`, `homogenizing_id`, `updated_at`, `created_at`) VALUES
(1, '2021-08-16', 'Lot 1', 10, '22:58', '21:58', '1', 1, '2021-08-16 07:55:47', '2021-08-16 07:55:47'),
(2, '2021-08-16', 'Lot 2', 20, '21:02', '23:01', '1', 1, '2021-08-16 07:55:47', '2021-08-16 07:55:47'),
(3, '2021-08-16', 'Lot 3', 10, '22:01', '23:01', '1', 2, '2021-08-16 08:07:54', '2021-08-16 08:07:54'),
(4, '2021-08-16', 'Lot 1', 10, '19:19', '19:22', '1', 3, '2021-08-16 13:49:17', '2021-08-16 13:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `inward_finished_goods`
--

DROP TABLE IF EXISTS `inward_finished_goods`;
CREATE TABLE `inward_finished_goods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inward_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inward_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` int(11) NOT NULL,
  `batch_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` int(10) UNSIGNED NOT NULL,
  `viscosity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mfg_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_ratest_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_no_of_200kg_drums` int(11) DEFAULT NULL,
  `total_no_of_50kg_drums` int(11) DEFAULT NULL,
  `total_no_of_30kg_drums` int(11) DEFAULT NULL,
  `total_no_of_5kg_drums` int(11) DEFAULT NULL,
  `total_no_of_fiber_board_drums` int(11) DEFAULT NULL,
  `total_quantity` double NOT NULL,
  `total_no_of_200kg_drums_bal` double DEFAULT NULL,
  `total_no_of_50kg_drums_bal` double DEFAULT NULL,
  `total_no_of_30kg_drums_bal` double DEFAULT NULL,
  `total_no_of_5kg_drums_bal` double DEFAULT NULL,
  `total_no_of_fiber_board_drums_bal` int(11) DEFAULT NULL,
  `total_quantity_bal` int(11) DEFAULT NULL,
  `ar_no` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_by` int(11) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inward_raw_materials`
--

DROP TABLE IF EXISTS `inward_raw_materials`;
CREATE TABLE `inward_raw_materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `inward_no` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_from` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_to` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_receipt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` int(11) NOT NULL,
  `manufacturer` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `supplier_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_gst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goods_receipt_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viscosity` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inward_raw_materials`
--

INSERT INTO `inward_raw_materials` (`id`, `inward_no`, `received_from`, `received_to`, `date_of_receipt`, `material`, `manufacturer`, `supplier`, `supplier_address`, `supplier_gst`, `invoice_no`, `goods_receipt_no`, `viscosity`, `created_by`, `remark`, `created_at`, `updated_at`) VALUES
(16, '1', '2', '4', '1619202600', 23, 4, 5, NULL, NULL, 'SS-21/22-0018', 'GRM/RM/21/002', NULL, 1, NULL, '2021-05-24 15:28:23', '2021-05-24 15:28:23'),
(17, '1', '2', '4', '1619202600', 23, 4, 5, NULL, NULL, 'SS-21/22-0018', 'GRM/RM/21/002', NULL, 1, NULL, '2021-05-24 15:28:40', '2021-05-24 15:28:40'),
(18, '18', '2', '4', '1617733800', 15, 5, 6, NULL, NULL, '513280', 'GRN/RM/21/001', NULL, 1, NULL, '2021-05-24 15:33:32', '2021-05-24 15:33:32'),
(19, '19', '3', '1', '1626028200', 15, 4, 6, NULL, NULL, '1219', '987', '25', 1, NULL, '2021-07-14 18:20:33', '2021-07-14 18:20:33'),
(20, '20', '2', '1', '1626028200', 16, 4, 5, NULL, NULL, '551', '123', '90', 1, NULL, '2021-07-14 18:21:35', '2021-07-14 18:21:35'),
(21, '21', '3', '1', '1623522600', 23, 4, 5, NULL, NULL, '8520', '0258', '85', 1, NULL, '2021-07-14 18:23:18', '2021-07-14 18:23:18'),
(22, '22', '3', '4', '1628274600', 24, 4, 5, NULL, NULL, '123', '121212', NULL, 1, NULL, '2021-08-07 14:39:01', '2021-08-07 14:39:01'),
(23, '23', '2', '4', '1628620200', 23, 4, 5, NULL, NULL, '123', '1212', NULL, 1, NULL, '2021-08-11 06:53:38', '2021-08-11 06:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `inward_raw_materials_items`
--

DROP TABLE IF EXISTS `inward_raw_materials_items`;
CREATE TABLE `inward_raw_materials_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `inward_raw_material_id` int(10) UNSIGNED NOT NULL,
  `material` int(11) NOT NULL,
  `opening_stock` double DEFAULT NULL,
  `batch_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_no_of_containers_or_bags` int(11) NOT NULL,
  `qty_received_kg` int(11) NOT NULL,
  `used_qty` double DEFAULT 0,
  `mfg_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mfg_expiry_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rio_care_expiry_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ar_no_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inward_raw_materials_items`
--

INSERT INTO `inward_raw_materials_items` (`id`, `inward_raw_material_id`, `material`, `opening_stock`, `batch_no`, `total_no_of_containers_or_bags`, `qty_received_kg`, `used_qty`, `mfg_date`, `mfg_expiry_date`, `rio_care_expiry_date`, `ar_no_date`, `created_at`, `updated_at`) VALUES
(1, 22, 24, 0, '123', 10, 100, 25, '1628274600', '1628274600', '1628274600', '12346', '2021-08-07 14:39:02', '2021-08-11 11:03:00'),
(2, 23, 23, 164, '12345', 10, 100, 25, '1628620200', '1628620200', '1628620200', '12', '2021-08-11 06:53:38', '2021-08-16 11:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `issual_by_stores_for_production`
--

DROP TABLE IF EXISTS `issual_by_stores_for_production`;
CREATE TABLE `issual_by_stores_for_production` (
  `id` int(11) NOT NULL,
  `requisition_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issual_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `for_fg_batch_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `returned_from_day_store` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dispensed_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_material_production`
--

DROP TABLE IF EXISTS `issue_material_production`;
CREATE TABLE `issue_material_production` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` int(11) NOT NULL,
  `opening_bal` int(11) NOT NULL,
  `batch_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viscosity` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issual_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issued_quantity` double NOT NULL,
  `batch_quantity` double DEFAULT NULL,
  `finished_batch_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excess` double DEFAULT NULL,
  `wastage` double DEFAULT NULL,
  `returned_from_day_store` double DEFAULT NULL,
  `closing_balance_qty` double NOT NULL,
  `dispensed_by` int(11) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_material_production_requestion`
--

DROP TABLE IF EXISTS `issue_material_production_requestion`;
CREATE TABLE `issue_material_production_requestion` (
  `id` int(11) NOT NULL,
  `requestion_id` int(11) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `issed_date` varchar(30) NOT NULL,
  `batch_no` varchar(100) NOT NULL,
  `type` char(1) DEFAULT 'R' COMMENT 'R-Raw Material,P-packing,F-Finished GOOD',
  `checkedBy` int(11) NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issue_material_production_requestion`
--

INSERT INTO `issue_material_production_requestion` (`id`, `requestion_id`, `from`, `to`, `issed_date`, `batch_no`, `type`, `checkedBy`, `ApprovedBy`, `batch_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Warehouse', 'Day Store', '2021-08-07', '12', 'R', 1, 1, 1, '2021-08-07 20:27:26', '2021-08-07 20:27:26'),
(2, 2, 'Warehouse', 'Day Store', '2021-08-11', '12', 'R', 1, 1, 1, '2021-08-11 12:24:33', '2021-08-11 12:24:33'),
(3, 3, 'Warehouse', 'Day Store', '2021-08-11', '12', 'R', 1, 1, 1, '2021-08-11 13:52:28', '2021-08-11 13:52:28'),
(6, 4, 'Warehouse', 'Day Store', '2021-08-11', '12', 'R', 1, 1, 1, '2021-08-11 16:32:59', '2021-08-11 16:32:59'),
(7, 5, 'Warehouse', 'Day Store', '2021-08-11', '12', 'P', 1, 1, 1, '2021-08-11 20:27:38', '2021-08-11 20:27:38'),
(8, 6, 'Warehouse', 'Day Store', '2021-08-16', '123456', 'R', 1, 1, 2, '2021-08-16 17:21:33', '2021-08-16 17:21:33'),
(9, 7, 'Warehouse', 'Day Store', '2021-08-16', '123456', 'P', 1, 1, 2, '2021-08-16 18:11:05', '2021-08-16 18:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `issue_material_production_requestion_details`
--

DROP TABLE IF EXISTS `issue_material_production_requestion_details`;
CREATE TABLE `issue_material_production_requestion_details` (
  `id` int(11) NOT NULL,
  `issual_material_id` int(11) NOT NULL DEFAULT 0,
  `material_id` int(11) NOT NULL,
  `requesist_qty` double NOT NULL,
  `batch_id` int(11) NOT NULL,
  `approved_qty` double NOT NULL,
  `ar_no_date` varchar(100) NOT NULL,
  `main_details_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issue_material_production_requestion_details`
--

INSERT INTO `issue_material_production_requestion_details` (`id`, `issual_material_id`, `material_id`, `requesist_qty`, `batch_id`, `approved_qty`, `ar_no_date`, `main_details_id`, `created_at`, `updated_at`) VALUES
(1, 1, 24, 10, 1, 10, '12346', 1, '2021-08-07 20:27:26', '2021-08-07 20:27:26'),
(2, 2, 23, 10, 2, 10, '12', 2, '2021-08-11 12:24:34', '2021-08-11 12:24:34'),
(3, 3, 23, 10, 2, 10, '12', 3, '2021-08-11 13:52:28', '2021-08-11 13:52:28'),
(4, 3, 24, 5, 1, 5, '12346', 3, '2021-08-11 13:52:29', '2021-08-11 13:52:29'),
(7, 6, 24, 5, 1, 3, '12346', 4, '2021-08-11 16:33:00', '2021-08-11 16:33:00'),
(8, 6, 24, 5, 1, 2, '12346', 4, '2021-08-11 16:33:00', '2021-08-11 16:33:00'),
(9, 7, 25, 20, 1, 20, '123', 5, '2021-08-11 20:27:38', '2021-08-11 20:27:38'),
(10, 7, 25, 20, 1, 20, '123', 5, '2021-08-11 20:27:38', '2021-08-11 20:27:38'),
(11, 8, 23, 10, 2, 10, '12', 6, '2021-08-16 17:21:33', '2021-08-16 17:21:33'),
(12, 9, 25, 10, 1, 10, '123', 7, '2021-08-16 18:11:05', '2021-08-16 18:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `line_clearance_record`
--

DROP TABLE IF EXISTS `line_clearance_record`;
CREATE TABLE `line_clearance_record` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `EquipmentName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_clearance_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_of_equipment_in_manufacturin_process`
--

DROP TABLE IF EXISTS `list_of_equipment_in_manufacturin_process`;
CREATE TABLE `list_of_equipment_in_manufacturin_process` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `EquipmentName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EquipmentCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_manufacturing_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_of_equipment_in_manufacturin_process`
--

INSERT INTO `list_of_equipment_in_manufacturin_process` (`id`, `EquipmentName`, `EquipmentCode`, `batch_manufacturing_id`, `created_at`, `updated_at`) VALUES
(3, '1', '1', 1, '2021-08-13 07:53:19', '2021-08-13 07:53:19'),
(4, '2', '3', 1, '2021-08-13 07:53:20', '2021-08-13 07:53:20'),
(5, '1', '1', 2, '2021-08-16 12:41:24', '2021-08-16 12:41:24'),
(6, '2', '4', 2, '2021-08-16 12:41:24', '2021-08-16 12:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE `manufacturers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `manufacturer`, `publish`, `created_at`, `updated_at`) VALUES
(4, 'Molychem', 1, '2021-05-24 15:23:48', '2021-05-24 15:23:48'),
(5, 'Milton Pharma', 1, '2021-05-24 15:30:37', '2021-05-24 15:30:48'),
(6, 'Pyramid Technoplast Pvt. Ltd.', 1, '2021-05-24 15:46:30', '2021-05-24 15:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `material_details`
--

DROP TABLE IF EXISTS `material_details`;
CREATE TABLE `material_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `PackingMaterialName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Capacity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ARDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packingmaterial_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_details`
--

INSERT INTO `material_details` (`id`, `PackingMaterialName`, `Capacity`, `Quantity`, `arNo`, `ARDate`, `packingmaterial_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, '2021-07-12', 1, '2021-07-12 15:16:27', '2021-07-12 15:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `mesurments`
--

DROP TABLE IF EXISTS `mesurments`;
CREATE TABLE `mesurments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mesurment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mesurment_value` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mesurments`
--

INSERT INTO `mesurments` (`id`, `mesurment`, `mesurment_value`, `created_at`, `updated_at`) VALUES
(1, 'Kg', 1000, '2021-04-23 08:25:27', '2021-04-23 08:25:27'),
(2, 'Ltr', 1000, '2021-04-23 08:26:17', '2021-04-23 08:26:17'),
(3, 'Gm', 1, '2021-04-23 08:26:48', '2021-04-23 08:26:48'),
(4, 'Ton', 1000, '2021-04-23 08:26:48', '2021-04-23 08:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(45, '2021_04_10_142630_create_department_table', 1),
(46, '2021_04_10_145354_create_roles_table', 1),
(47, '2021_04_10_145629_create_designations_table', 1),
(48, '2021_04_10_151014_create_controllers_table', 1),
(49, '2021_04_10_151014_create_users_table', 1),
(50, '2021_04_10_151127_create_actions_table', 1),
(51, '2021_04_10_160707_create_access_modules_table', 1),
(52, '2021_04_15_155241_create_manufacturers_table', 1),
(53, '2021_04_15_155539_create_suppliers_table', 1),
(54, '2021_04_15_155830_create_raw_materials_table', 1),
(55, '2021_04_15_160403_create_inward_raw_materials_table', 1),
(56, '2021_04_15_160533_create_inward_raw_materials_items_table', 1),
(57, '2021_04_15_163029_create_goods_receipt_notes_table', 1),
(58, '2021_04_15_163441_create_goods_receipt_note_items_table', 1),
(59, '2021_04_16_061159_create_issue_material_production_table', 1),
(60, '2021_04_16_061160_create_grades_table', 1),
(61, '2021_04_16_070034_create_inward_finished_goods_table', 1),
(62, '2021_04_16_074602_create_mode_of_dispatch_table', 1),
(63, '2021_04_16_075541_create_finished_goods_dispatch_table', 1),
(64, '2021_04_16_083029_create_quality_controll_check_table', 1),
(65, '2021_4_11_000000_create_failed_jobs_table', 1),
(66, '2021_4_11_100000_create_password_resets_table', 1),
(67, '2021_04_23_081550_create_mesurments_table', 2),
(68, '2021_06_18_102210_create_add_batch_manufacture_table', 3),
(69, '2021_06_18_182145_create_bill_of_raw_material_table', 3),
(70, '2021_06_19_014555_create_batch_manufacturing_records_packing_table', 3),
(71, '2021_06_19_111323_create_batch_manufacturing_records_list_of_equipment_table', 3),
(72, '2021_06_19_173552_create_line_clearance_record_table', 3),
(73, '2021_06_20_125927_create_list_of_equipment_in_manufacturin_process_table', 3),
(74, '2021_06_20_134758_create_batch_manufacturing_records_line_clearance_record_table', 3),
(75, '2021_06_20_192639_create_bill_of_raw_material_details_table', 3),
(76, '2021_06_18_102211_create_add_batch_manufacture_table', 4),
(77, '2021_06_18_182146_create_bill_of_raw_material_table', 4),
(78, '2021_06_28_172258_create_add_lots_raw_material_detail_table', 5),
(79, '2021_06_28_172751_create_add_lotsl_table', 5),
(80, '2021_06_29_121845_create_packingmaterial_issual_slip_table', 5),
(81, '2021_06_29_122034_create_material_details_table', 5),
(82, '2021_06_29_151112_create_packing_material_requisition_slip_table', 5),
(83, '2021_06_29_152002_create_detail_packing_material_requisition_table', 5),
(84, '2021_10_26_143629_create_permission_tables', 6),
(85, '2021_10_26_154251_create_activity_log_table', 7),
(86, '2021_10_26_154252_add_event_column_to_activity_log_table', 7),
(87, '2021_10_26_154253_add_batch_uuid_column_to_activity_log_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`, `team_id`) VALUES
(1, 'App\\Models\\User', 1, 0),
(2, 'App\\Models\\User', 7, 0),
(2, 'App\\Models\\User', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mode_of_dispatch`
--

DROP TABLE IF EXISTS `mode_of_dispatch`;
CREATE TABLE `mode_of_dispatch` (
  `id` int(10) UNSIGNED NOT NULL,
  `mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packingmaterial_issual_slip`
--

DROP TABLE IF EXISTS `packingmaterial_issual_slip`;
CREATE TABLE `packingmaterial_issual_slip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batchNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doneBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packing_material_requisition_slip`
--

DROP TABLE IF EXISTS `packing_material_requisition_slip`;
CREATE TABLE `packing_material_requisition_slip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batchNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkedBy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApprovedBy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'R-Raw Matarial, F- Finish Good, P- Packing Matarial',
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packing_material_requisition_slip`
--

INSERT INTO `packing_material_requisition_slip` (`id`, `order_id`, `from`, `to`, `batchNo`, `Date`, `checkedBy`, `ApprovedBy`, `Remark`, `created_at`, `updated_at`, `batch_id`, `type`, `status`) VALUES
(1, 7212002, '2', '3', '12', '2021-08-07', '1', '1', NULL, '2021-08-07 14:57:02', '2021-08-07 14:57:26', 1, 'R', 1),
(2, 11211204, '2', '3', '12', '2021-08-11', '1', '1', NULL, '2021-08-11 06:52:04', '2021-08-11 06:54:33', 1, 'R', 1),
(3, 11211337, '2', '3', '12', '2021-08-11', '1', '1', NULL, '2021-08-11 08:21:37', '2021-08-11 08:22:28', 1, 'R', 1),
(4, 11211430, '2', '3', '12', '2021-08-11', '1', '1', NULL, '2021-08-11 08:40:30', '2021-08-11 10:57:57', 1, 'R', 1),
(5, 11211743, '2', '3', '12', '2021-08-11', '1', '1', NULL, '2021-08-11 12:14:43', '2021-08-11 14:57:38', 1, 'P', 1),
(6, 16211710, '2', '3', '123456', '2021-08-16', '1', '1', NULL, '2021-08-16 11:51:10', '2021-08-16 11:51:33', 2, 'R', 1),
(7, 16211850, '2', '3', '123456', '2021-08-16', '1', '1', NULL, '2021-08-16 12:40:50', '2021-08-16 12:41:05', 2, 'P', 1);

-- --------------------------------------------------------

--
-- Table structure for table `party_master`
--

DROP TABLE IF EXISTS `party_master`;
CREATE TABLE `party_master` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobileno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2021-10-27 07:14:35', '2021-10-27 07:14:35'),
(2, 'user-create', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(3, 'user-edit', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(4, 'user-delete', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(5, 'role-list', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(6, 'role-create', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(7, 'role-edit', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(8, 'role-delete', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(9, 'permission-list', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(10, 'permission-create', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(11, 'permission-edit', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(12, 'permission-delete', 'web', '2021-09-30 01:58:13', '2021-09-30 01:58:13'),
(116, 'activitylog-list', 'web', '2021-10-27 12:48:35', '2021-10-27 12:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `process_lots`
--

DROP TABLE IF EXISTS `process_lots`;
CREATE TABLE `process_lots` (
  `id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `temp` int(11) DEFAULT NULL,
  `stratTime` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endTime` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doneby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lot_id` int(11) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `process_lots`
--

INSERT INTO `process_lots` (`id`, `qty`, `temp`, `stratTime`, `endTime`, `doneby`, `lot_id`, `process_id`, `created_at`, `updated_at`) VALUES
(11, 1, 1, '01:01', '01:01', '1', 3, 1, '2021-08-13 12:24:12', '2021-08-13 12:24:12'),
(12, 1, 1, '01:01', '01:01', '1', 3, 2, '2021-08-13 12:24:12', '2021-08-13 12:24:12'),
(13, 1, 1, '01:01', '01:01', '1', 3, 3, '2021-08-13 12:24:12', '2021-08-13 12:24:12'),
(16, 2, 2, '22:44', '22:44', '1', 4, 1, '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(17, 2, 2, '22:45', '22:46', '1', 4, 2, '2021-08-14 17:14:55', '2021-08-14 17:14:55'),
(18, 2, 2, '22:46', '22:47', '1', 4, 3, '2021-08-14 17:14:56', '2021-08-14 17:14:56'),
(19, 2, 2, '22:50', '22:49', '1', 4, 4, '2021-08-14 17:14:56', '2021-08-14 17:14:56'),
(21, 3, 3, '23:42', '23:42', '1', 5, 1, '2021-08-14 18:13:18', '2021-08-14 18:13:18'),
(22, 3, 3, '23:43', '23:44', '1', 5, 2, '2021-08-14 18:13:18', '2021-08-14 18:13:18'),
(23, 3, 3, '23:45', '23:48', '1', 5, 3, '2021-08-14 18:13:18', '2021-08-14 18:13:18'),
(24, 13, 3, '23:49', '23:54', '1', 5, 4, '2021-08-14 18:13:18', '2021-08-14 18:13:18'),
(25, 3, 3, '23:55', '23:11', '1', 5, 5, '2021-08-14 18:13:18', '2021-08-14 18:13:18'),
(26, 1, 1, '01:01', '01:01', '1', 7, 1, '2021-08-16 13:17:08', '2021-08-16 13:17:08'),
(27, 1, 1, '01:01', '01:01', '1', 7, 2, '2021-08-16 13:17:08', '2021-08-16 13:17:08'),
(28, 1, 1, '01:01', '01:01', '1', 7, 3, '2021-08-16 13:17:08', '2021-08-16 13:17:08'),
(29, 1, 1, '01:01', '01:01', '1', 7, 4, '2021-08-16 13:17:08', '2021-08-16 13:17:08'),
(30, 1, 1, '01:01', '01:01', '1', 7, 5, '2021-08-16 13:17:08', '2021-08-16 13:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `quality_controll_check`
--

DROP TABLE IF EXISTS `quality_controll_check`;
CREATE TABLE `quality_controll_check` (
  `id` int(11) NOT NULL,
  `quantity_approved` int(11) DEFAULT NULL,
  `quantity_rejected` int(11) DEFAULT NULL,
  `quantity_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `inward_material_id` int(11) DEFAULT NULL,
  `inward_material_item_id` int(11) DEFAULT NULL,
  `raw_material_id` int(11) DEFAULT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quality_controll_check`
--

INSERT INTO `quality_controll_check` (`id`, `quantity_approved`, `quantity_rejected`, `quantity_status`, `date_of_approval`, `remark`, `created_at`, `updated_at`, `inward_material_id`, `inward_material_item_id`, `raw_material_id`, `total_qty`, `ar_no`, `checked_by`) VALUES
(1, 100, 0, 'Approved', '2021-08-07', NULL, '2021-08-07 14:55:46', '2021-08-07 14:55:46', 22, 1, 24, '100', '12346', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials`
--

DROP TABLE IF EXISTS `raw_materials`;
CREATE TABLE `raw_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_mesurment` int(11) NOT NULL,
  `material_type` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'P-packing material\r\nR- Raw Material\r\nF- Finish Good',
  `material_stock` double NOT NULL,
  `material_preorder_stock` int(11) NOT NULL,
  `expiry_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rio_expiry_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `man_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `capacity` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raw_materials`
--

INSERT INTO `raw_materials` (`id`, `material_name`, `material_mesurment`, `material_type`, `material_stock`, `material_preorder_stock`, `expiry_date`, `rio_expiry_date`, `man_date`, `created_at`, `updated_at`, `capacity`) VALUES
(9, 'Polydimethyl Siloxane', 1, 'R', 0, 5000, '', '', '', '2021-05-24 15:02:32', '2021-05-24 15:02:32', NULL),
(10, 'Polydimethyl Siloxane 1000 cSt', 1, 'R', 0, 5000, '', '', '', '2021-05-24 15:03:48', '2021-05-24 15:03:48', NULL),
(11, 'Polydimethyl Siloxane 100 cSt', 1, 'R', 0, 2000, '', '', '', '2021-05-24 15:04:48', '2021-05-24 15:04:48', NULL),
(12, 'Polydimethyl Siloxane 350 cSt', 1, 'R', 0, 2000, '', '', '', '2021-05-24 15:05:15', '2021-05-24 15:05:15', NULL),
(13, 'Polydimethyl Siloxane 20 cSt', 1, 'R', 0, 2000, '', '', '', '2021-05-24 15:06:42', '2021-05-24 15:06:42', NULL),
(14, 'Fumed Silica (Colloidalsilcondioxide)', 1, 'R', 0, 2000, '', '', '', '2021-05-24 15:12:16', '2021-05-24 15:12:16', NULL),
(15, 'Dibasic Calcium Phosphate', 1, 'R', 205, 1000, '', '', '', '2021-05-24 15:14:25', '2021-07-14 18:20:33', NULL),
(16, 'Cetosearyl Ethoxylate', 1, 'R', 288, 1000, '', '', '', '2021-05-24 15:15:52', '2021-07-14 18:21:35', NULL),
(17, 'Cetosearyl Alcohol', 1, 'R', 0, 1000, '', '', '', '2021-05-24 15:16:13', '2021-05-24 15:16:13', NULL),
(18, 'S. M.', 1, 'R', 0, 1000, '', '', '', '2021-05-24 15:16:45', '2021-05-24 15:16:45', NULL),
(19, 'C.P. (Calciam Propionate)', 1, 'R', 0, 1000, '', '', '', '2021-05-24 15:19:21', '2021-05-24 15:19:21', NULL),
(20, 'P.S. (Pottasium Sorbate)', 1, 'R', 0, 1000, '', '', '', '2021-05-24 15:19:49', '2021-05-24 15:19:49', NULL),
(21, 'S.B. (Sodium Benzoate)', 1, 'R', 0, 1000, '', '', '', '2021-05-24 15:20:12', '2021-05-24 15:20:12', NULL),
(22, 'Hydrogen Peroxide', 2, 'R', 0, 1000, '', '', '', '2021-05-24 15:20:44', '2021-05-24 15:20:44', NULL),
(23, 'Artho Phospheric Acid', 2, 'R', 264, 1000, '', '', '', '2021-05-24 15:21:20', '2021-08-11 06:53:38', NULL),
(24, 'Silicon Diaoxide (Precipited)', 1, 'R', 100, 1000, '', '', '', '2021-05-24 15:21:50', '2021-08-07 14:39:02', NULL),
(25, 'Fibre Board Drum 25KG', 1, 'P', 1100, 100, '', '', '', '2021-05-24 15:42:22', '2021-08-07 14:39:41', '25'),
(26, 'Fibre Board Drum 50KG', 1, 'P', 0, 100, '', '', '', '2021-05-24 15:43:02', '2021-05-24 15:43:02', NULL),
(27, 'HDPE Drum (210Kg) NM', 1, 'P', 0, 100, '', '', '', '2021-05-24 15:43:41', '2021-05-24 15:43:41', NULL),
(28, 'HDPE Drum (50Kg) NM', 1, 'P', 0, 100, '', '', '', '2021-05-24 15:44:24', '2021-05-24 15:44:24', NULL),
(29, 'HDPE Drum (50Kg) TOM', 1, 'P', 0, 100, '', '', '', '2021-05-24 15:44:48', '2021-05-24 15:44:48', NULL),
(30, 'Test', 1, 'F', 20, 20, '', '', '', '2021-06-29 18:22:31', '2021-06-29 18:22:31', NULL),
(31, 'SIMETHICON', 1, 'F', 0, 0, '', '', '', '2021-07-05 17:12:43', '2021-07-05 17:12:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `team_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrator', 'web', '2021-10-26 10:48:59', '2021-10-26 10:48:59'),
(2, 1, 'Warehouse Manager', 'web', '2021-10-26 10:49:50', '2021-10-26 10:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles_backup`
--

DROP TABLE IF EXISTS `roles_backup`;
CREATE TABLE `roles_backup` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_backup`
--

INSERT INTO `roles_backup` (`id`, `role`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, '2021-04-21 14:23:49', '2021-04-21 14:23:55'),
(2, 'Warehouse Manager', 1, '2021-05-06 18:23:12', '2021-05-06 18:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(116, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `matarial_id` int(11) NOT NULL,
  `material_type` char(1) NOT NULL,
  `department` int(11) NOT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `used_qty` int(11) DEFAULT 0,
  `batch_no` varchar(100) DEFAULT NULL,
  `process_batch_id` int(11) DEFAULT 0,
  `ar_no_date` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` char(1) DEFAULT 'R' COMMENT 'R-Raw Material,P-Packing Material,F-Finish Good'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `matarial_id`, `material_type`, `department`, `qty`, `used_qty`, `batch_no`, `process_batch_id`, `ar_no_date`, `created_at`, `updated_at`, `type`) VALUES
(1, 24, 'R', 3, 10, 10, '1', 1, '12346', '2021-08-07 20:27:26', '2021-08-14 23:43:18', 'R'),
(2, 23, 'R', 3, 10, 10, '2', 1, '12', '2021-08-11 12:24:34', '2021-08-13 17:26:09', 'R'),
(3, 23, 'R', 3, 5, 0, '2', 1, '12', '2021-08-11 13:52:28', '2021-08-11 13:52:28', 'R'),
(4, 24, 'R', 3, 5, 0, '1', 1, '12346', '2021-08-11 13:52:29', '2021-08-11 13:52:29', 'R'),
(5, 24, 'R', 3, 5, 0, '0', 1, '', '2021-08-11 16:33:00', '2021-08-11 16:33:00', 'R'),
(6, 25, 'P', 3, 20, 0, '0', 1, '', '2021-08-11 20:27:38', '2021-08-11 20:27:38', 'P'),
(7, 25, 'P', 3, 20, 0, '0', 1, '', '2021-08-11 20:27:38', '2021-08-11 20:27:38', 'P'),
(8, 23, 'R', 3, 10, 0, '0', 2, '', '2021-08-16 17:21:33', '2021-08-16 17:21:33', 'R'),
(9, 25, 'P', 3, 10, 0, '0', 2, '', '2021-08-16 18:11:06', '2021-08-16 18:11:06', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_no` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_per_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `city`, `state`, `address`, `contact_no`, `gst_no`, `pan_no`, `contact_per_name`, `company_name`, `publish`, `created_at`, `updated_at`) VALUES
(5, 'Shreeji Scientific', 'Navi Mumbai', 'Maharashtra', 'Navi Mumbai', '123456789', NULL, NULL, 'Ganesh Joshi', 'Shreeji Scientific', 1, '2021-05-24 15:25:28', '2021-05-24 15:25:28'),
(6, 'V.N. Pharma', 'Mumbai', 'Maharashtra', 'Mumbai', '1231231234', NULL, NULL, 'VN', 'V.N. Pharma', 1, '2021-05-24 15:31:25', '2021-05-24 15:31:25'),
(7, 'Pyramid Technoplast Pvt. Ltd', 'Silvasa', 'Diu Daman', 'Silvasa', '1231231234', NULL, NULL, 'Contact Person 1', 'Pyramid Technoplast Pvt. Ltd.', 1, '2021-05-24 15:48:08', '2021-05-24 15:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `designation_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `department_id`, `role_id`, `designation_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administror', 'admin@admin.com', '2021-04-21 14:24:52', '$2y$12$Mn2J37jFlqk.lGC50cCZ9O4UWfTFfpsFu4qOLUrb3d8JSep4bThvy', 1, 1, 1, 'CXblf9N5gkyywOCtF2MkXqxNthRcoZWswk8NSaZtu1ubAun9qrXdEbb0fYDw', '2021-04-21 14:25:16', '2021-04-21 14:25:20'),
(7, 'Amar Bhanushali', 'adminau@gmail.com', NULL, '$2y$10$T92jqGbgpwdswFQhFxeD6epEQeEV26ighWJLL9cRTiot7CUvZE41W', 1, 0, 1, NULL, '2021-10-27 11:09:54', '2021-10-27 12:34:27'),
(8, 'Test User', 'admin123@admin.com', NULL, '$2y$10$Xt7zot42CtxetXrgTuaUDuoy3zP3wKqmwKl7dznHNyLRpCf2XDZPy', 1, 0, 1, NULL, '2021-10-27 11:15:33', '2021-10-27 11:15:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_modules`
--
ALTER TABLE `access_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_modules_user_id_foreign` (`user_id`),
  ADD KEY `access_modules_controller_id_foreign` (`controller_id`),
  ADD KEY `access_modules_action_id_foreign` (`action_id`);

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `add_batch_manufacture`
--
ALTER TABLE `add_batch_manufacture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_lotsl`
--
ALTER TABLE `add_lotsl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_lots_raw_material_detail`
--
ALTER TABLE `add_lots_raw_material_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_no_master`
--
ALTER TABLE `ar_no_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_manufacturing_records_line_clearance_record`
--
ALTER TABLE `batch_manufacturing_records_line_clearance_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_manufacturing_records_list_of_equipment`
--
ALTER TABLE `batch_manufacturing_records_list_of_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_manufacturing_records_packing`
--
ALTER TABLE `batch_manufacturing_records_packing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_of_raw_material`
--
ALTER TABLE `bill_of_raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_of_raw_material_details`
--
ALTER TABLE `bill_of_raw_material_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controllers`
--
ALTER TABLE `controllers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_packing_material_requisition`
--
ALTER TABLE `detail_packing_material_requisition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_code`
--
ALTER TABLE `equipment_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_name`
--
ALTER TABLE `equipment_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `finished_goods_dispatch`
--
ALTER TABLE `finished_goods_dispatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generate_label`
--
ALTER TABLE `generate_label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_receipt_notes`
--
ALTER TABLE `goods_receipt_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_receipt_note_items`
--
ALTER TABLE `goods_receipt_note_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_receipt_note_items_good_receipt_id_foreign` (`good_receipt_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homogenizing`
--
ALTER TABLE `homogenizing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homogenizing_list`
--
ALTER TABLE `homogenizing_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inward_finished_goods`
--
ALTER TABLE `inward_finished_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inward_finished_goods_grade_foreign` (`grade`);

--
-- Indexes for table `inward_raw_materials`
--
ALTER TABLE `inward_raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inward_raw_materials_items`
--
ALTER TABLE `inward_raw_materials_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inward_raw_materials_items_inward_raw_material_id_foreign` (`inward_raw_material_id`);

--
-- Indexes for table `issual_by_stores_for_production`
--
ALTER TABLE `issual_by_stores_for_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_material_production`
--
ALTER TABLE `issue_material_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_material_production_requestion`
--
ALTER TABLE `issue_material_production_requestion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_material_production_requestion_details`
--
ALTER TABLE `issue_material_production_requestion_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `line_clearance_record`
--
ALTER TABLE `line_clearance_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_of_equipment_in_manufacturin_process`
--
ALTER TABLE `list_of_equipment_in_manufacturin_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_details`
--
ALTER TABLE `material_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesurments`
--
ALTER TABLE `mesurments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`team_id`,`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  ADD KEY `model_has_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `model_has_permissions_team_foreign_key_index` (`team_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`team_id`,`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  ADD KEY `model_has_roles_role_id_foreign` (`role_id`),
  ADD KEY `model_has_roles_team_foreign_key_index` (`team_id`);

--
-- Indexes for table `mode_of_dispatch`
--
ALTER TABLE `mode_of_dispatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packingmaterial_issual_slip`
--
ALTER TABLE `packingmaterial_issual_slip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packing_material_requisition_slip`
--
ALTER TABLE `packing_material_requisition_slip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party_master`
--
ALTER TABLE `party_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `process_lots`
--
ALTER TABLE `process_lots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quality_controll_check`
--
ALTER TABLE `quality_controll_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_materials`
--
ALTER TABLE `raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_team_id_name_guard_name_unique` (`name`,`guard_name`) USING BTREE,
  ADD KEY `roles_team_foreign_key_index` (`team_id`);

--
-- Indexes for table `roles_backup`
--
ALTER TABLE `roles_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_designation_id_index` (`designation_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_modules`
--
ALTER TABLE `access_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `add_batch_manufacture`
--
ALTER TABLE `add_batch_manufacture`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `add_lotsl`
--
ALTER TABLE `add_lotsl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `add_lots_raw_material_detail`
--
ALTER TABLE `add_lots_raw_material_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ar_no_master`
--
ALTER TABLE `ar_no_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `batch_manufacturing_records_line_clearance_record`
--
ALTER TABLE `batch_manufacturing_records_line_clearance_record`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batch_manufacturing_records_list_of_equipment`
--
ALTER TABLE `batch_manufacturing_records_list_of_equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `batch_manufacturing_records_packing`
--
ALTER TABLE `batch_manufacturing_records_packing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill_of_raw_material`
--
ALTER TABLE `bill_of_raw_material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_of_raw_material_details`
--
ALTER TABLE `bill_of_raw_material_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `controllers`
--
ALTER TABLE `controllers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_packing_material_requisition`
--
ALTER TABLE `detail_packing_material_requisition`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `equipment_code`
--
ALTER TABLE `equipment_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `equipment_name`
--
ALTER TABLE `equipment_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finished_goods_dispatch`
--
ALTER TABLE `finished_goods_dispatch`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generate_label`
--
ALTER TABLE `generate_label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `goods_receipt_notes`
--
ALTER TABLE `goods_receipt_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `goods_receipt_note_items`
--
ALTER TABLE `goods_receipt_note_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `homogenizing`
--
ALTER TABLE `homogenizing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homogenizing_list`
--
ALTER TABLE `homogenizing_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inward_finished_goods`
--
ALTER TABLE `inward_finished_goods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inward_raw_materials`
--
ALTER TABLE `inward_raw_materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `inward_raw_materials_items`
--
ALTER TABLE `inward_raw_materials_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issual_by_stores_for_production`
--
ALTER TABLE `issual_by_stores_for_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issue_material_production`
--
ALTER TABLE `issue_material_production`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issue_material_production_requestion`
--
ALTER TABLE `issue_material_production_requestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `issue_material_production_requestion_details`
--
ALTER TABLE `issue_material_production_requestion_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `line_clearance_record`
--
ALTER TABLE `line_clearance_record`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_of_equipment_in_manufacturin_process`
--
ALTER TABLE `list_of_equipment_in_manufacturin_process`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material_details`
--
ALTER TABLE `material_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mesurments`
--
ALTER TABLE `mesurments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `mode_of_dispatch`
--
ALTER TABLE `mode_of_dispatch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packingmaterial_issual_slip`
--
ALTER TABLE `packingmaterial_issual_slip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packing_material_requisition_slip`
--
ALTER TABLE `packing_material_requisition_slip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `party_master`
--
ALTER TABLE `party_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `process_lots`
--
ALTER TABLE `process_lots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `quality_controll_check`
--
ALTER TABLE `quality_controll_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raw_materials`
--
ALTER TABLE `raw_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles_backup`
--
ALTER TABLE `roles_backup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_modules`
--
ALTER TABLE `access_modules`
  ADD CONSTRAINT `access_modules_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`),
  ADD CONSTRAINT `access_modules_controller_id_foreign` FOREIGN KEY (`controller_id`) REFERENCES `controllers` (`id`),
  ADD CONSTRAINT `access_modules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `goods_receipt_note_items`
--
ALTER TABLE `goods_receipt_note_items`
  ADD CONSTRAINT `goods_receipt_note_items_good_receipt_id_foreign` FOREIGN KEY (`good_receipt_id`) REFERENCES `goods_receipt_notes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inward_finished_goods`
--
ALTER TABLE `inward_finished_goods`
  ADD CONSTRAINT `inward_finished_goods_grade_foreign` FOREIGN KEY (`grade`) REFERENCES `grades` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inward_raw_materials_items`
--
ALTER TABLE `inward_raw_materials_items`
  ADD CONSTRAINT `inward_raw_materials_items_inward_raw_material_id_foreign` FOREIGN KEY (`inward_raw_material_id`) REFERENCES `inward_raw_materials` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `users_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
