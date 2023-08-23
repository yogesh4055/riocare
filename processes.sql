-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 07:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `processes`
--

DROP TABLE IF EXISTS `processes`;
CREATE TABLE `processes` (
  `id` int(11) NOT NULL,
  `process_name` varchar(255) DEFAULT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `processes`
--

INSERT INTO `processes` (`id`, `process_name`, `group_id`, `created_at`, `updated_at`) VALUES
(1, 'Charges Polydimethylsiloxane in reactor.', 1, '2022-08-08 23:16:07', '2022-08-08 23:16:07'),
(2, 'Heats the material up to 75-85 oC with continuous stirring.', 1, '2022-08-08 23:16:07', '2022-08-08 23:16:07'),
(3, 'Adds Cetostearyl Ethoxylate and stirs for 15 minutes.', 1, '2022-08-08 23:16:42', '2022-08-08 23:16:42'),
(4, 'Adds Cetostearyl Alcohol and stirs for 15 minutes.', 1, '2022-08-08 23:16:42', '2022-08-08 23:16:42'),
(5, 'Adds hot purified water and stir for 45 minutes.', 1, '2022-08-08 23:17:32', '2022-08-08 23:17:32'),
(6, 'Adds Calcium Propionate, Potassium Sorbate Sodium Benzoate and Stirs for 10 minutes. Cools it to less than 50 C.', 1, '2022-08-08 23:17:32', '2022-08-08 23:17:32'),
(7, 'Adds Hydrogen Peroxide and stir for 30 minutes.', 1, '2022-08-08 23:20:14', '2022-08-08 23:20:14'),
(8, 'Charges Polydimethylsiloxane in the reactor.', 2, '2022-08-08 23:20:14', '2022-08-08 23:20:14'),
(9, 'Heats the material up to 75-85 oC with continuous stirring.', 2, '2022-08-08 23:20:47', '2022-08-08 23:20:47'),
(10, 'Adds Cetostearyl Ethoxylate and stirs for 15 minutes.', 2, '2022-08-08 23:20:47', '2022-08-08 23:20:47'),
(11, 'Adds Cetostearyl Alcohol and stirs for 15 minutes.', 2, '2022-08-08 23:26:00', '2022-08-08 23:26:00'),
(12, 'Adds hot purified water and stirs for 45 minutes.', 2, '2022-08-08 23:26:00', '2022-08-08 23:26:00'),
(13, 'Adds Calcium Propiomate, Potassium Sorbate and Sodium Benzoate and Stirs for 10 minutes. Cools it to less than 50 oC.', 2, '2022-08-08 23:26:30', '2022-08-08 23:26:30'),
(14, 'Adds Hydrogen Peroxide and stirs for 30 minutes.', 2, '2022-08-08 23:26:30', '2022-08-08 23:26:30'),
(15, 'Charges Polydimethylsiloxane in reactor.', 3, '2022-08-08 23:27:21', '2022-08-08 23:27:21'),
(16, 'Starts heating the reactor with continuous stirring.', 3, '2022-08-08 23:27:21', '2022-08-08 23:27:21'),
(17, 'When temperature reaches 130-135 oC stops heating the reactor.', 3, '2022-08-08 23:27:57', '2022-08-08 23:27:57'),
(18, 'Stirs for 15 minutes and notes the maximum temperature. Cools it to less than 80 oC.', 3, '2022-08-08 23:27:57', '2022-08-08 23:27:57'),
(19, 'Charge Silicon dioxide (Precipitated Silica) in ribbon blender', 4, '2022-08-08 23:28:31', '2022-08-08 23:28:31'),
(20, 'Charge Dibasic Calcium phosphate in ribbon blender.', 4, '2022-08-08 23:28:31', '2022-08-08 23:28:31'),
(21, 'Start the ribbon blender.', 4, '2022-08-08 23:29:03', '2022-08-08 23:29:03'),
(22, 'Fill the sprayer tank with Simethicone and start the spraying inyo riboon blender continuously.', 4, '2022-08-08 23:29:03', '2022-08-08 23:29:03'),
(23, 'After complete spraying of Simethicone, run the ribbon blender for 35-45 minutes.', 4, '2022-08-08 23:29:24', '2022-08-08 23:29:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `processes`
--
ALTER TABLE `processes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `processes`
--
ALTER TABLE `processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
