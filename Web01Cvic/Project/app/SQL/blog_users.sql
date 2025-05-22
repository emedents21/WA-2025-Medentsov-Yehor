-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2025 at 10:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wa_2025_ym_01`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_users`
--

CREATE TABLE `blog_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_users`
--

INSERT INTO `blog_users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(31, 'Yehor', 'yehor.medentsov@tul.cz', '$2y$10$VEg1YONBF5bx9KX8txtXkOxjDc1VNAZMIoHIs5fWLPhzUc726vzkO', 'admin', '2025-05-22 18:38:50'),
(32, 'Honza', 'honza@tul.cz', '$2y$10$eVesUyxjD9.99/PB3fd8eeVbN2sY1Kn7.NsYRnBWMSLy1eoWrkAeK', 'user', '2025-05-22 18:47:12'),
(33, 'Markéta', 'marketa@tul.cz', '$2y$10$Ivo4zptq4PhdTmUuJS99BunstnMa9h07WGXZZGidFh2E/DlYyoQ4y', 'user', '2025-05-22 18:49:49'),
(34, 'iveta_dvorakova', 'iveta@tul.cz', '$2y$10$0xIUikVNuMuDUn1hhqxpquq1qEQg/4qZF1vIEJsWD2v8HxsFWunf6', 'user', '2025-05-22 18:54:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_users`
--
ALTER TABLE `blog_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_users`
--
ALTER TABLE `blog_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
