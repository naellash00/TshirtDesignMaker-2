-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 01:28 AM
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
-- Database: `tshirtdesignmaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `design_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `designs` varchar(255) NOT NULL,
  `amount_paid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `UserID`, `name`, `email`, `phone`, `address`, `pmode`, `designs`, `amount_paid`) VALUES
(3, 4, 'noor', 'noor@gmail.com', '+967773368288', 'Othman Ibn Affan Rd, Al Andalus, Riyadh 13213, Saudi Arabia', 'cards', 'Helloworld(3)', '60');

-- --------------------------------------------------------

--
-- Table structure for table `prevdesigns`
--

CREATE TABLE `prevdesigns` (
  `user_id` int(11) NOT NULL,
  `logo_url` varchar(500) NOT NULL,
  `logo_size` int(120) NOT NULL,
  `tscolor_url` varchar(500) NOT NULL,
  `words` varchar(15) NOT NULL,
  `words_color` varchar(255) NOT NULL,
  `design_id` int(11) NOT NULL,
  `priproduct` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ts_size` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prevdesigns`
--

INSERT INTO `prevdesigns` (`user_id`, `logo_url`, `logo_size`, `tscolor_url`, `words`, `words_color`, `design_id`, `priproduct`, `quantity`, `ts_size`) VALUES
(1, '4.jpeg', 90, 'WhiteT-shirt1.png', 'CR7', '#31aa56', 4, 20, 1, 'l'),
(1, '657c90ea80fb6.png', 90, 'PinkT-shirt1.png', 'PHP', '#423333', 5, 20, 1, 'm'),
(4, '657c9d88a5b12.png', 90, 'WhiteT-shirt1.png', 'Noor', '#1e1a1a', 6, 20, 1, 's'),
(4, '657ca1f88c286.png', 90, 'BlueT-shirt.png', 'Helloworld', '#ffffff', 7, 20, 1, 'xl'),
(4, '657ccc3252a06.jpeg', 90, 'WhiteT-shirt1.png', 'heloo', '#837272', 8, 20, 1, 's');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'naelahh', 'naelahh0306@gmail.co', 'sekai'),
(2, 'atheer', 'rtf66510@gmail.com', '112233'),
(3, 'atheer1', 'rtf66510@gmail.com', '12345'),
(4, 'noor', 'noor@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prevdesigns`
--
ALTER TABLE `prevdesigns`
  ADD PRIMARY KEY (`design_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prevdesigns`
--
ALTER TABLE `prevdesigns`
  MODIFY `design_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
