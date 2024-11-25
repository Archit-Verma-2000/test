-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 01:30 PM
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
-- Database: `spotlight`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned_user`
--

CREATE TABLE `banned_user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 1,
  `isAuthenticated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_subscribers`
--

CREATE TABLE `mail_subscribers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_detail`
--

CREATE TABLE `otp_detail` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `otp` varchar(8) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_detail`
--

INSERT INTO `otp_detail` (`id`, `email`, `otp`, `createdAt`) VALUES
(35, 'architv2023@gmail.com', '83653072', '2024-11-25 12:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `spam_logs`
--

CREATE TABLE `spam_logs` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned_user`
--
ALTER TABLE `banned_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_subscribers`
--
ALTER TABLE `mail_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_detail`
--
ALTER TABLE `otp_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spam_logs`
--
ALTER TABLE `spam_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banned_user`
--
ALTER TABLE `banned_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `mail_subscribers`
--
ALTER TABLE `mail_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `otp_detail`
--
ALTER TABLE `otp_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `spam_logs`
--
ALTER TABLE `spam_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
