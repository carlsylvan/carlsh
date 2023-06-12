-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 11:07 PM
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
-- Database: `carlsh`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`) VALUES
(1, 'Levi\'s'),
(2, 'Lacoste');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Byxor'),
(2, 'Tröjor');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `title` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `title`) VALUES
(1, 'Blå'),
(2, 'Grön');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(111) NOT NULL,
  `title` varchar(55) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `added` datetime DEFAULT current_timestamp(),
  `sold` datetime DEFAULT NULL,
  `color_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `seller_id`, `category_id`, `size_id`, `added`, `sold`, `color_id`, `brand_id`) VALUES
(1, 'Jeans', 'Blåjeans. Snusfläckar i vänster bakficka.', 500, 1, 1, 1, '2023-05-30 10:42:23', '2023-06-07 10:38:04', 1, 1),
(2, 'Stickad tröja', 'Stickad tröja med vita och svarta detaljer på ärmarna.', 699, 2, 2, 2, '2023-05-31 16:34:35', '2023-06-07 10:42:33', 2, 2),
(5, 'Blabla', '. Snuafasfar i vänster bakficka.', 500, 1, 1, 1, '2023-06-07 10:14:37', '2023-06-07 10:31:01', 1, 1),
(6, 'Tröja xxxxxxxxxxx', 'Beskrivning av tröjan', 800, 2, 2, 2, '2023-06-07 10:58:30', '2023-06-07 11:16:17', 2, 2),
(9, 'Tröjatröja', 'Blalbalblabllblabab', 350, 2, 2, 2, '2023-06-07 13:16:22', '2023-06-07 13:16:50', 2, 2),
(10, 'Tröjatröja', 'Blalbalblabllblabab', 350, 2, 2, 2, '2023-06-07 13:22:49', '2023-06-07 13:23:28', 2, 2),
(11, 'Tröjatröja', 'Blalbalblabllblabab', 350, 2, 2, 2, '2023-06-07 13:29:58', NULL, 2, 2),
(12, 'Tröjatröja', 'Blalbalblabllblabab', 350, 2, 2, 2, '2023-06-07 13:52:48', '2023-06-09 16:54:37', 2, 2),
(13, 'Tööööröja', 'xaxaxaxa', 200, 5, 2, 2, '2023-06-09 16:54:01', NULL, 2, 2),
(14, 'EN TILL TRÖJA', 'whuwhuwhuwhwu', 200, 1, 2, 2, '2023-06-09 17:08:24', NULL, 2, 2),
(15, '1111', 'dadaddadad', 450, 2, 2, 2, '2023-06-12 22:28:56', NULL, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(111) NOT NULL,
  `last_name` varchar(111) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `first_name`, `last_name`, `phone`, `email`) VALUES
(1, 'Carl', 'Sylvan', '0761234567', 'carl.sylvan@medieinstitutet.se'),
(2, 'Namn', 'Namnsson', '0739876543', 'namn@namnsson.se'),
(4, 'Saljare', 'Saljarsson', '0123456789', 'saljare@sell.com'),
(5, 'Hej', 'Hejsson', '012345676', 'hej@hejhej.se');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `title` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `title`) VALUES
(1, '34'),
(2, 'XL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
