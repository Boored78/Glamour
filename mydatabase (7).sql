-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 04:14 PM
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
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `quantity`) VALUES
(62, 10, 7, 3),
(72, 6, 2, 1),
(80, 17, 9, 1),
(87, 17, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, '', '123antonslavchev@gmail.com', 'etye5tysrht467ioi', '2025-03-26 06:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `payment_method` enum('cash','card') DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `cart_items` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `first_name`, `last_name`, `address`, `phone`, `payment_method`, `card_number`, `cart_items`, `created_at`, `user_id`) VALUES
(1, 'asd', 'asd', '12ed1', '123123412', 'cash', NULL, '[{\"product_id\":36,\"quantity\":1},{\"product_id\":32,\"quantity\":1}]', '2025-04-09 06:07:17', 10),
(2, 'Bojidar ', 'Angelov ', 'oasdjk', '0885759695', 'card', '23476890-9876453', '[{\"product_id\":16,\"quantity\":4},{\"product_id\":20,\"quantity\":1},{\"product_id\":21,\"quantity\":1}]', '2025-04-11 07:46:43', 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sex` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `sex`, `type`) VALUES
(15, 'Bako Radhan', 'img/shop1.png', 30.00, 'male', 'woody'),
(16, 'YCL', 'img/shop2.png', 90.00, 'female', 'floral'),
(17, 'Eclipse Noir', 'img/shop3.png', 78.00, 'male', 'oriental'),
(18, 'Velvet Dusk', 'img/shop4.png', 56.00, 'female', 'fresh'),
(19, 'Moonlit Embrace', 'img/shop5.png', 53.00, 'male', 'woody'),
(20, 'Silk Reverie', 'img/shop6.png', 93.00, 'female', 'floral'),
(21, 'Mystic Bloom', 'img/shop7.png', 48.00, 'male', 'oriental'),
(22, 'Amber Mirage', 'img/shop8.png', 29.00, 'female', 'fresh'),
(23, 'Celestial Whisper', 'img/shop9.png', 79.00, 'male', 'woody'),
(24, 'Crimson Twilight', 'img/shop10.png', 33.00, 'female', 'floral'),
(25, 'Ivory Petal', 'img/shop11.png', 76.00, 'male', 'oriental'),
(26, 'Midnight Sonata', 'img/shop12.png', 49.99, 'male', 'woody'),
(27, 'Ivory Mirage', 'img/shop13.png', 54.99, 'female', 'floral'),
(28, 'Golden Euphoria', 'img/shop14.png', 59.99, 'male', 'oriental'),
(29, 'Velvet Ember', 'img/shop15.png', 45.50, 'female', 'fresh'),
(30, 'Seraphic Bloom', 'img/shop16.png', 64.99, 'male', 'woody'),
(31, 'Amber Cascade', 'img/shop17.png', 39.99, 'female', 'floral'),
(32, 'Opal Desire', 'img/shop18.png', 69.99, 'male', 'oriental'),
(33, 'Moonstone Essence', 'img/shop19.png', 55.00, 'female', 'fresh'),
(34, 'Saffron Twilight', 'img/shop20.png', 42.75, 'male', 'woody'),
(35, 'Whispering Orchid', 'img/shop21.png', 58.50, 'female', 'floral'),
(36, 'Rosewood Lullaby', 'img/shop22.png', 47.99, 'male', 'oriental'),
(37, 'Crimson Haze', 'img/shop23.png', 52.00, 'female', 'fresh'),
(38, 'Mystic Dew', 'img/shop24.png', 49.25, 'male', 'woody');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'img/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_picture`) VALUES
(3, NULL, 'bobonoob25@gmail.com', '$2y$10$vQfjcqisnJgLzr7rntBPbuIk3a98Q1gAFexxWxKk7VZWgsXhv110S', ''),
(4, 'Boored_', 'angelovbojidar23@gmail.com', '$2y$10$Yrup04Jb3HPcmTY567CpsuOdveA0zy8vha9K3G4fnJPtRAmBPropC', 'img/Picsart_25-04-09_09-42-26-533.jpg'),
(6, NULL, 'rekajin83@gmail.com', '$2y$10$Gg9VYXP0QeIyjAlkJB8Z3uvQHaU2c.40VmFt2jm4CVBYEuwUrbr9G', ''),
(7, NULL, 'biserka123@gmail.com', '$2y$10$gTdnwkclcBjUA/0NJg8TH.nOtyDNuOFEA4epJqywbytdHkVi50B9m', ''),
(9, 'Boored_', 'bojidar123@gmail.com', '$2y$10$skbKiZkJdyRu43i6FoO/fOjw.dgg45gZd8kq8Zr6Hn0kIyXPK95NO', 'img/images.jpg'),
(10, 'Ivakisa', 'ivailoaleksandrov12211221@abv.bg', '$2y$10$YfLPZEIOib7LO.dmGvkk4.dz75cAQ/Tjr9THtLDJhO5EsMSBOqZEG', 'img/images (1).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
