-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 04:29 AM
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
-- Database: `gym_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `dolist`
--

CREATE TABLE `dolist` (
  `id` int(11) NOT NULL,
  `task` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','staff','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `weight_unit` enum('lb','kg') DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `rest_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `password`, `role`, `created_at`, `first_name`, `last_name`, `age`, `gender`, `weight`, `weight_unit`, `height`, `address`, `rest_date`) VALUES
(14, 'Htoo Aunk Lin', '09766458306', '$2y$10$UKF9S1yjFxJbsiG8OlovV.b1weEkpXoNgOF4nCjYjMo.vs4bt7Q8C', 'admin', '2024-10-26 02:02:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Mg Mg', '09666166162', '$2y$10$/PGqlImVXgxfKE796.iJ7.NvkY6oUPCspnbNRHnu4zkxcBUIaRWYi', 'user', '2024-10-26 02:11:07', 'Mg', 'Mg', 18, 'Male', 130, 'lb', '5\'7\"', 'Hpa-an', '2024-10-31 09:14:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dolist`
--
ALTER TABLE `dolist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dolist`
--
ALTER TABLE `dolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
