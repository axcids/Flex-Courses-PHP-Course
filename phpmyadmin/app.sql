-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2020 at 06:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) UNSIGNED NOT NULL,
  `service_id` int(11) UNSIGNED DEFAULT NULL,
  `contact_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `contact_email` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `contact_document` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `message` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `service_id`, `contact_name`, `contact_email`, `contact_document`, `message`) VALUES
(27, 4, 'Abdul', 'Abdul@majeed.com', 'uploads/1589235003download.jpeg', 'Test 1'),
(45, 3, 'Abdul', 'Abdul@majeed.com', 'uploads/1589483887download (1).jpeg', 'kl zg ya salman');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(10, 1, '6cc2c2f740bc0644134b9a629cbec40b', '2020-05-17 02:19:52', '2020-05-16 03:19:52'),
(14, 24, '6495cff56be6132194523b5573ac11ed', '2020-05-17 21:34:44', '2020-05-16 22:34:44'),
(15, 25, '51f5018c77e9ba71e2c57b2ede13ac65', '2020-05-17 21:41:39', '2020-05-16 22:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(6,2) UNSIGNED NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'phone', '1000.00', 'uploads/products/phone.jpg'),
(2, 'keyboard', '100.00', 'uploads/products/keyboard.jpg'),
(3, 'mouse', '50.00', 'uploads/products/mouse.jpg'),
(4, 'monitor', '700.00', 'uploads/products/monitor.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`) VALUES
(1, 'phone 1', '500.00'),
(2, 'training', '200.00'),
(3, 'design', '100.00'),
(4, 'coding', '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `app_name` varchar(64) COLLATE utf8mb4_bin NOT NULL DEFAULT 'Service app'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `admin_email`, `app_name`) VALUES
(1, 'admin@admin.com', 'Service app');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_bin NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role`, `created_at`) VALUES
(1, 'Abdul@majeed.com', 'Abdul', '$2y$10$ADeHk7wXJb.Ua7.56nDOTOT7KLwEh6JYH0syV.xYO0ErMNsz5GeJ.', 'admin', '2020-05-15 05:06:56'),
(24, 'ThamerAlturki@Nay.com', 'Thamer', '$2y$10$K.Qtr.0IKP99e3Uc8F1iGek/mYnbsUyKr4I0ESQe4Kmt1nCj3SWVW', 'user', '2020-05-16 22:25:05'),
(25, 'NasserAlhameedi@hotmail.com', 'Nasser Alhameedi', '$2y$10$/kGFAuXNSKIDvQi7adt6we3DffNLA5.n7Gf6CIbV5gAhydIbPPRCO', 'user', '2020-05-16 22:40:57'),
(26, 'admin@admin.com', 'admin', '$2y$10$jEALdn/6EVymxBEB/blEQOaFQpxnwTyBEHFN3ew6tLQoyFylxAoSu', 'admin', '2020-05-19 19:44:48'),
(27, 'SaadAlajme@gmail.com', 'Saad Alajme', '$2y$10$6nzo3n934CkRa7C8MUg64.R7zeyjdGPGcyTEeFwxy8fJEYIvDpP56', 'user', '2020-05-19 19:46:27'),
(28, 'user@user.com', 'user', '$2y$10$QRs/y6T.ucjy51rrs6EQA.gXDOU4s09uG7We3GFf4DwdepsM4REq6', 'user', '2020-05-19 19:48:26'),
(37, 'MohammedAlbader@gmail.com', 'Mohammed Albader', '$2y$10$UMRA7CTvqmo1l8RYVhd1bOBoVsqBEoSY2MACAU1N2qsKOVzIJCIR6', 'user', '2020-05-27 06:01:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_reset_user_is` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_user_is` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
