-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 01:00 PM
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
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
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
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `dikksha_name`, `phone_no`, `father_name`, `gurudev_name`, `counselor_name`, `counselor_phone_no`, `date_of_birth`, `educational_qualifications`, `study_occupation_organization`, `present_address`, `permanent_address`, `iskcon_connection_days`, `daily_chant_rounds`, `regular_chant_days`, `granthas_read`, `mangal_aarti_regularly`, `nearest_iskcon_temple`, `created_date`) VALUES
(1, 'Krishna', 'Krishna', '123', 'test', 'test', 'test', '123', '2024-08-26', 'test', 'test', 'test', 'test', 10, 16, 10, 'test', 'Yes', 'test', '2024-08-21 02:36:11'),
(2, 'Krishna', 'Krishna', '123', 'test', 'test', 'test', '123', '2024-08-26', 'test', 'test', 'test', 'test', 10, 16, 10, 'test', 'Yes', 'test', '2024-08-21 02:36:21'),
(3, 'Ananta Shayi', 'Ananta Shayi', '123', 'test', 'test', 'test', '123', '2024-08-26', 'test', 'test', 'test', 'test', 10, 16, 10, 'test', 'Yes', 'Nandankanan', '0000-00-00 00:00:00'),
(4, 'Achutta Keshaba', 'Achutta Keshaba', '123', 'test', 'test', 'test', '123', '2024-08-26', 'test', 'test', 'test', 'test', 10, 16, 10, 'test', 'Yes', 'Nandankanan', '2024-08-21 03:05:01');

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
(2, 'Baladev', 'Baladev@Baladev.com', '', '$2y$10$5c7u5jEbKcMQniq1Y4dTguxNPdz3miwOeVEtIU.Ak7ha3A.lcbtlS', 'ssms0002', 'user'),
(3, 'Sudama', 'test@counselor.com', '12345', '$2y$10$dSL/inMbrBlLb7vAR4th9u87Qw1uWR.gIrNASrQFa4kFJU1Dw1/62', 'ssms1219', 'counselor'),
(4, 'Madhumangal', 'test@counselor2.com', '123456', '$2y$10$b4kCouYJZW7B33cfSrBSZe4yz7/ntVsfa.e9OzfdB6N8s/e4EK47u', 'ssms0022', 'counselor'),
(5, 'Sridama', 'test@counselor3.com', '12345', '$2y$10$5Lva9d8rr0mASFcgwK906.JMJ4qFjik9ibKmVDuQ1waDmQjrOBJRS', 'ssms0003', 'counselor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
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
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
