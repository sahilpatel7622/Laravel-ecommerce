-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2026 at 06:16 AM
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
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `add cart`
--

CREATE TABLE `add cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add cart`
--

INSERT INTO `add cart` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '2026-02-20 08:14:20', '2026-02-20 08:14:20'),
(55, 1, 7, '2026-02-21 23:39:26', '2026-02-21 23:39:26'),
(56, 1, 7, '2026-02-21 23:39:30', '2026-02-21 23:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2026_02_05_130708_users', 1),
(3, '2026_02_06_113553_products', 1),
(4, '2026_02_20_124143_add_cart', 2),
(5, '2026_02_20_163527_users', 3),
(6, '2026_02_21_060742_order', 4),
(7, '2026_02_21_161508_trending', 5),
(8, '2026_02_21_164723_trending', 6),
(9, '2026_02_21_164950_trending', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `address`, `status`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(25, 1, 9, '101, Arjun Apartment, Thaltej, ahmedabad, Gujarat - 826345', 'delivered', 'cash', 'Pending', '2026-02-21 08:27:20', '2026-02-21 08:27:20'),
(27, 1, 7, '101, ahmedabad, Gujarat - 867412', 'Cancelled', 'card', 'Done', '2026-02-21 08:50:20', '2026-02-21 23:44:58'),
(28, 1, 2, '102, amreli, Gujarat - 365550', 'Pending', 'cash', 'Pending', '2026-02-21 08:50:45', '2026-02-21 08:50:45'),
(30, 1, 3, '102, amreli, Gujarat - 365550', 'delivered', 'cash', 'Pending', '2026-02-21 08:50:45', '2026-02-21 08:50:45'),
(31, 1, 3, '102, amreli, Gujarat - 365550', 'Cancelled', 'upi', 'Pending', '2026-02-21 08:50:45', '2026-02-21 23:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `gallery` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `gallery`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Redmi Note 15', '₹30,999', 'Mobiles', 'https://m.media-amazon.com/images/I/81UgjzCNSrL._SX679_.jpg', 'REDMI Note 15 Pro 5G (Silver Ash 8GB+256GB) | 200MasterPixel OIS Camera | Dimensity 7400-Ultra | 17.3cm CrystalRes AMOLED Screen', NULL, NULL),
(2, 'Apple iPhone 16 Pro', '₹1,59,900', 'Mobiles', 'https://m.media-amazon.com/images/I/619oqSJVY5L._SX679_.jpg', 'iPhone 16 Pro Max 1 TB: 5G Mobile Phone with Camera Control, 4K 120 fps Dolby Vision and a Huge Leap in Battery Life.\r\n', NULL, NULL),
(3, 'Samsung Galaxy S23 Ultra', '₹1,09,999', 'Mobiles', 'https://m.media-amazon.com/images/I/71qGismu6NL._SX679_.jpg', 'Samsung Galaxy S23 FE 5G (Mint, 8GB, 128GB Storage)', NULL, NULL),
(4, 'OnePlus 15R 5G', '₹49,999', 'Mobiles', 'https://m.media-amazon.com/images/I/61AsNTuJ6mL._SX679_.jpg', 'The OnePlus 15R 5G is a mid-range smartphone that offers a range of features and specifications.', NULL, NULL),
(5, 'Google Pixel 7 Pro', '₹34,999', 'Mobiles', 'https://m.media-amazon.com/images/I/51OFxuD1GgL._SX522_.jpg', 'Google Pixel 7 Pro (Obsidian, 128 GB) (12 GB RAM)', NULL, NULL),
(6, 'LG', '₹70,000', 'TV', 'https://m.media-amazon.com/images/I/71yz55f1VlL._SX522_.jpg', 'LG 139 cm (55 Inches) UR7500 AI Series 4K Ultra HD (3840 x 2160) LED Smart TV (Black) (2020 Model)', NULL, NULL),
(7, 'Samsung', '₹80,000', 'TV', 'https://m.media-amazon.com/images/I/81GeWU+aNGL._SX522_.jpg', 'Samsung 139 cm (55 inches) QN90C Neo QLED 4K Ultra HD Smart TV (Black)', NULL, NULL),
(8, 'Sony', '₹63,000', 'TV', 'https://m.media-amazon.com/images/I/81Vs1ZXn43L._SX522_.jpg', 'Sony 139 cm (55 inches) X80K Series 4K Ultra HD Smart LED Google TV XR55X80K', NULL, NULL),
(9, 'Toshiba', '₹30,000', 'TV', 'https://m.media-amazon.com/images/I/9121McCSSxL._SX522_.jpg', 'Toshiba 139 cm (55 inches) C350NP Series 4K Ultra HD Smart LED Google TV 55C350NP (Black)', NULL, NULL),
(10, 'TCL TV', '₹35,000', 'TV', 'https://m.media-amazon.com/images/I/71BXyInFv8L._SX522_.jpg', 'TCL 139 cm (55 inches) 4K UHD Smart QLED Google TV 55T6C (Black)', NULL, NULL),
(11, 'iQOO Z10x 5G', '₹17,998 ', 'Mobiles', 'https://m.media-amazon.com/images/I/61oa+zoqwmL._SX679_.jpg', 'iQOO Z10x 5G (Ultramarine, 8GB RAM, 256GB Storage) | 6500 mAh Large Capacity Battery | Dimensity 7300 Processor | Military-Grade Durability', NULL, NULL),
(12, 'Xiaomi', '₹29,999 ', 'TV', 'https://m.media-amazon.com/images/I/71mA83yc8xL._SX522_.jpg', 'Xiaomi 138 cm (55 inch) FX Ultra HD 4K Smart LED Fire TV L55MB-FIN\r\nWarranty Information: Enjoy 1 Year of Comprehensive Warranty', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trending`
--

CREATE TABLE `trending` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `gallery` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trending`
--

INSERT INTO `trending` (`id`, `name`, `price`, `gallery`, `created_at`, `updated_at`) VALUES
(1, 'Redmi Note 15', '₹30,999', 'https://m.media-amazon.com/images/I/81UgjzCNSrL._SX679_.jpg', NULL, NULL),
(2, 'Apple iPhone 16 Pro', '₹1,59,900', 'https://m.media-amazon.com/images/I/619oqSJVY5L._SX679_.jpg', NULL, NULL),
(3, 'Samsung', '₹80,000', 'https://m.media-amazon.com/images/I/81GeWU+aNGL._SX522_.jpg', NULL, NULL),
(4, 'TCL TV', '₹35,000', 'https://m.media-amazon.com/images/I/71BXyInFv8L._SX522_.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `password`, `Gender`, `created_at`, `updated_at`) VALUES
(1, 'Dhruvi', '6359950829', 'dhruvi@gmail.com', '$2y$10$FSnb8Y8iyzjKwqxCEzLGRO1hjNS7KgWO8pjX05VN0IPSCMCvux0K.', 'Female', '2026-02-20 11:20:38', '2026-02-20 11:31:05'),
(3, 'Sahil', '7622920559', 'sahil@gmail.com', '$2y$10$IJ6S9PwqS68ZYOu/C6jMN.RHdgmPgyPiw4MQ1gNCnWK0lKt3XMOU6', 'Male', '2026-02-20 11:25:38', '2026-02-20 11:26:47'),
(7, 'Test User', '1234567890', 'testuser@example.com', '$2y$10$wrkA4x7SSmyojmYCOSOLTOpi.bgel/Js8owdY8H88q06DIXXtz3l2', '', '2026-02-21 23:35:28', '2026-02-21 23:35:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add cart`
--
ALTER TABLE `add cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trending`
--
ALTER TABLE `trending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add cart`
--
ALTER TABLE `add cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trending`
--
ALTER TABLE `trending`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
