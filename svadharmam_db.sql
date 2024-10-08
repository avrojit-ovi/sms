-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2024 at 01:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `svadharmam_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_counselor`
--

CREATE TABLE `assigned_counselor` (
  `id` int(11) NOT NULL,
  `counselor_id` varchar(10) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `assigned_by` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assigned_counselor`
--

INSERT INTO `assigned_counselor` (`id`, `counselor_id`, `user_id`, `assigned_by`) VALUES
(21, 'ssms0001', 'ssms0002', 'ssms0001'),
(22, 'ssms0001', 'smsu0003', 'ssms0001'),
(23, 'ssms0001', 'smsu0004', 'ssms0001'),
(25, 'ssms0001', 'smsu4564', 'ssms0001');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dikksha_name` varchar(100) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `gurudev_name` varchar(100) NOT NULL,
  `counselor_name` varchar(100) NOT NULL,
  `counselor_phone_no` varchar(15) NOT NULL,
  `date_of_birth` date NOT NULL,
  `educational_qualifications` text DEFAULT NULL,
  `study_occupation_organization` text DEFAULT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `iskcon_connection_days` int(11) NOT NULL,
  `daily_chant_rounds` int(11) NOT NULL,
  `regular_chant_days` int(11) NOT NULL,
  `granthas_read` text DEFAULT NULL,
  `mangal_aarti_regularly` enum('Yes','No') NOT NULL,
  `nearest_iskcon_temple` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `email`, `name`, `dikksha_name`, `phone_no`, `father_name`, `gurudev_name`, `counselor_name`, `counselor_phone_no`, `date_of_birth`, `educational_qualifications`, `study_occupation_organization`, `present_address`, `permanent_address`, `iskcon_connection_days`, `daily_chant_rounds`, `regular_chant_days`, `granthas_read`, `mangal_aarti_regularly`, `nearest_iskcon_temple`, `created_date`, `userid`) VALUES
(1, 'krishna@test.com', 'Krishna', 'Krishna', '123', 'test', 'test', 'test', '123', '2024-08-26', 'test', 'test', 'test', 'test', 10, 16, 10, 'test', 'Yes', 'test', '2024-08-21 02:36:11', 'smsu0001'),
(3, 'anantashayidas@gmail.com', 'Ananta Shayi', 'Ananta Shayi', '123', 'test', 'test', 'test', '123', '2024-08-26', 'test', 'test', 'test', 'test', 10, 16, 10, 'test', 'Yes', 'Nandankanan', '0000-00-00 00:00:00', 'smsu0003'),
(4, 'achuttakeshaba@test.com', 'Achutta Keshaba', 'Achutta Keshaba', '123', 'test', 'test', 'test', '123', '2024-08-26', 'test', 'test', 'test', 'test', 10, 16, 10, 'test', 'Yes', 'Nandankanan', '2024-08-21 03:05:01', 'smsu0004'),
(5, 'test@test.com', 'test', 'test', 'test', 'test', 'test', 'test', 'test', '2024-08-13', 'test', 'test', 'test', 'test', 1000, 16, 1000, 'test', 'Yes', 'test', '2024-08-21 07:21:28', 'smsu9149'),
(6, 'test2@test.com', 'test', 'test2', 'test2', 'test2', 'test2', 'test2', 'test2', '2024-08-22', 'test2', 'test2', 'test2', 'test2', 2, 2, 2, 'test2', 'Yes', 'test2', '2024-08-21 07:29:30', 'smsu5361'),
(7, 'wsds@test.com', 'wsds', 'sd', 'sdsd', 'sd', 'sd', 'sd', 'sd', '2024-08-19', '', '', 'sd', 'sd', 22, 22, 22, '', 'Yes', '22', '2024-08-24 02:26:21', 'smsu4564');

-- --------------------------------------------------------

--
-- Table structure for table `shadhana_profiles`
--

CREATE TABLE `shadhana_profiles` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `morning_wakeup_time` time DEFAULT NULL,
  `mangalaarti_time` time DEFAULT NULL,
  `tulshi_parikrama` enum('Yes','No') DEFAULT NULL,
  `chanting_rounds` int(11) DEFAULT NULL,
  `chanting_finished_time` time DEFAULT NULL,
  `grantha_study` enum('Yes','No') DEFAULT NULL,
  `grantha_name` varchar(100) DEFAULT NULL,
  `grantha_reading_duration` varchar(50) DEFAULT NULL,
  `lecture_hearing` enum('Yes','No') DEFAULT NULL,
  `lecture_name` varchar(100) DEFAULT NULL,
  `lecture_hearing_duration` varchar(50) DEFAULT NULL,
  `material_study_work` enum('Yes','No') DEFAULT NULL,
  `material_study_work_duration` varchar(50) DEFAULT NULL,
  `devotional_services` text DEFAULT NULL,
  `did_gossip` enum('Yes','No') DEFAULT NULL,
  `gossip_duration` varchar(50) DEFAULT NULL,
  `phone_usage_duration` varchar(50) DEFAULT NULL,
  `slept_with_kirtan` enum('Yes','No') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shadhana_profiles`
--

INSERT INTO `shadhana_profiles` (`id`, `userid`, `name`, `morning_wakeup_time`, `mangalaarti_time`, `tulshi_parikrama`, `chanting_rounds`, `chanting_finished_time`, `grantha_study`, `grantha_name`, `grantha_reading_duration`, `lecture_hearing`, `lecture_name`, `lecture_hearing_duration`, `material_study_work`, `material_study_work_duration`, `devotional_services`, `did_gossip`, `gossip_duration`, `phone_usage_duration`, `slept_with_kirtan`, `created_at`) VALUES
(1, 'smsu0004', 'Achutta Keshaba', NULL, '17:39:00', NULL, 16, '17:40:00', 'Yes', NULL, '2', 'Yes', NULL, '23', 'Yes', '23', NULL, 'Yes', '333', '222', NULL, '2024-08-27 11:40:48'),
(2, 'smsu0004', 'Achutta Keshaba', NULL, '17:39:00', NULL, 16, '17:40:00', 'Yes', NULL, '2', 'Yes', NULL, '23', 'Yes', '23', NULL, 'Yes', '333', '222', NULL, '2024-09-03 07:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `shadhana_record`
--

CREATE TABLE `shadhana_record` (
  `id` int(11) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `morning_wake_up_time` time DEFAULT NULL,
  `mangalaarti_time` time DEFAULT NULL,
  `tulsi_parikrama` enum('Yes','No') DEFAULT 'No',
  `chanting_rounds` int(11) DEFAULT NULL,
  `chanting_finished_time` time DEFAULT NULL,
  `grantha_study` enum('Yes','No') DEFAULT 'No',
  `which_grantha` varchar(255) DEFAULT NULL,
  `grantha_reading_duration` varchar(100) DEFAULT NULL,
  `lecture_hearing` enum('Yes','No') DEFAULT 'No',
  `which_lecture` varchar(255) DEFAULT NULL,
  `lecture_hearing_duration` varchar(100) DEFAULT NULL,
  `material_study_work` enum('Yes','No') DEFAULT 'No',
  `material_study_work_duration` varchar(100) DEFAULT NULL,
  `devotional_services_done` text DEFAULT NULL,
  `did_gossip` enum('Yes','No') DEFAULT 'No',
  `gossip_duration` varchar(100) DEFAULT NULL,
  `phone_usage_duration` varchar(100) DEFAULT NULL,
  `slept_listening_kirtan` enum('Yes','No') DEFAULT 'No',
  `date_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shadhana_record`
--

INSERT INTO `shadhana_record` (`id`, `userid`, `user_name`, `morning_wake_up_time`, `mangalaarti_time`, `tulsi_parikrama`, `chanting_rounds`, `chanting_finished_time`, `grantha_study`, `which_grantha`, `grantha_reading_duration`, `lecture_hearing`, `which_lecture`, `lecture_hearing_duration`, `material_study_work`, `material_study_work_duration`, `devotional_services_done`, `did_gossip`, `gossip_duration`, `phone_usage_duration`, `slept_listening_kirtan`, `date_time`) VALUES
(1, 'smsu5361', 'test', '00:37:00', '03:36:00', 'Yes', 15, '00:39:00', 'Yes', 'qwefw', 'wdfw', 'Yes', 'qwc', '23', 'Yes', '1111', 'wfwefvc', 'Yes', '22', '22', 'Yes', '2024-09-07 13:20:04'),
(3, 'smsu0003', 'Ananta Shayi', '01:06:00', '01:04:00', 'Yes', 33, '01:04:00', 'Yes', 'test', '2', 'Yes', 'test', '23', 'Yes', '23', 'qwerfgw2e43get', 'Yes', '22', 'werfew', 'Yes', '2024-09-06 13:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `userid`, `role`) VALUES
(1, 'Krishna', 'Krishna@krishna.com', '12345', '$2y$10$OWqoKYGkAM8YYrEV1KEgnuzlA2LTdreKOJi148QSIzg.R7FP7gcaG', 'ssms0001', 'admin'),
(2, 'Baladev', 'Baladev@Baladev.com', '', '$2y$10$5c7u5jEbKcMQniq1Y4dTguxNPdz3miwOeVEtIU.Ak7ha3A.lcbtlS', 'ssms0002', 'admin'),
(3, 'Sudama', 'test@counselor.com', '12345', '$2y$10$dSL/inMbrBlLb7vAR4th9u87Qw1uWR.gIrNASrQFa4kFJU1Dw1/62', 'ssms1219', 'counselor'),
(4, 'Madhumangal', 'test@counselor2.com', '123456', '$2y$10$b4kCouYJZW7B33cfSrBSZe4yz7/ntVsfa.e9OzfdB6N8s/e4EK47u', 'ssms0022', 'counselor'),
(5, 'Sridama', 'test@counselor3.com', '12345', '$2y$10$5Lva9d8rr0mASFcgwK906.JMJ4qFjik9ibKmVDuQ1waDmQjrOBJRS', 'ssms0003', 'counselor'),
(15, 'Ananta Shayi', 'anantashayidas@gmail.com', '123', '$2y$10$Qcavv448i/BMb/3d1eCJ/.VqHa5ZfVVvFVdAkD/FFxDfdSyxqEc2a', 'smsu0003', 'user'),
(16, 'Achutta Keshaba', 'achuttakeshaba@test.com', '123', '$2y$10$Loah3y40BQwDBsIFHtdRL.TWcgxRbSi31TiVdyXhBHa3vHm.IQhoi', 'smsu0004', 'user'),
(17, 'Krishna', 'krishna@test.com', '123', '$2y$10$q8bpCnlwuMfOxCufCDKcw.V0RBPJSiIpf12MjskG6Lymy.pKPWL1K', 'smsu0001', 'user'),
(18, 'wsds', 'wsds@test.com', 'sdsd', '$2y$10$BlrKTiiBqNs/8JNAnKc8buGh223xr2YVQfdl40uNriLKSUttYTJMi', 'smsu4564', 'user'),
(19, 'test', 'test2@test.com', 'test2', '$2y$10$/1LkYuJWZcB4cZ0d0yMGteWkCB6i4a8uuwCl.DLTWokokILezijje', 'smsu5361', 'user'),
(20, 'test', 'test@test.com', 'test', '$2y$10$fN6ldYmZ2FtFgwdYAFjQDulVjdaXzKk7/wvZzsifMiW05ouwhgmTK', 'smsu9149', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_counselor`
--
ALTER TABLE `assigned_counselor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `counselor_id` (`counselor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `assigned_by` (`assigned_by`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `shadhana_profiles`
--
ALTER TABLE `shadhana_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shadhana_record`
--
ALTER TABLE `shadhana_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_counselor`
--
ALTER TABLE `assigned_counselor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shadhana_profiles`
--
ALTER TABLE `shadhana_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shadhana_record`
--
ALTER TABLE `shadhana_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_counselor`
--
ALTER TABLE `assigned_counselor`
  ADD CONSTRAINT `assigned_counselor_ibfk_1` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `assigned_counselor_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `assigned_counselor_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
