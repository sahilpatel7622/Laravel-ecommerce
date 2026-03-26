-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2026 at 07:19 AM
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
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Dhruvi', 'dhruvi@gmail.com', '123456'),
(2, 'Sahil', 'sahil@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mobile', 1, '2026-03-16 03:06:30', '2026-03-16 03:06:30'),
(2, 'Tv', 1, '2026-03-16 03:06:37', '2026-03-16 03:06:37'),
(3, 'Laptop', 0, '2026-03-16 03:06:49', '2026-03-16 03:06:49'),
(4, 'Fridge', 0, '2026-03-16 03:06:59', '2026-03-16 03:06:59');

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
(9, '2026_02_21_164950_trending', 7),
(10, '2026_02_26_090458_add_cart', 8),
(11, '2026_02_28_075536_admin', 9),
(13, '2026_03_10_092822_create_categories_table', 10),
(14, '2026_03_12_092026_add_otp_to_users_table', 11),
(15, '2026_03_18_090513_add_order_number_to_orders_table', 12),
(16, '2026_03_18_091456_create_order_items_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
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

INSERT INTO `orders` (`id`, `user_id`, `amount`, `address`, `status`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(50, 1, '200817', '123, ahmedabad, Gujarat - 380000', 'Pending', 'upi', 'Completed', '2025-03-18 04:00:33', '2026-03-18 04:00:33'),
(55, 1, '90754', '123, ahmedabad, Gujarat - 380000', 'Delivered', 'card', 'completed', '2026-03-18 04:11:17', '2026-03-18 04:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(4, 50, 2, 1, '2026-03-18 04:00:34', '2026-03-18 04:00:34'),
(5, 50, 7, 1, '2026-03-18 04:00:34', '2026-03-18 04:00:34'),
(6, 50, 11, 1, '2026-03-18 04:00:34', '2026-03-18 04:00:34'),
(10, 55, 1, 3, '2026-03-18 04:11:17', '2026-03-18 04:11:17');

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
(1, 'Redmi Note 15', '₹30,999', '1', 'https://m.media-amazon.com/images/I/81UgjzCNSrL._SX679_.jpg', 'REDMI Note 15 Pro 5G (Silver Ash 8GB+256GB) | 200MasterPixel OIS Camera | Dimensity 7400-Ultra | 17.3cm CrystalRes AMOLED Screen', NULL, '2026-03-16 03:19:25'),
(2, 'Apple iPhone 16 Pro', '₹1,19,900', '1', 'https://m.media-amazon.com/images/I/619oqSJVY5L._SX679_.jpg', 'iPhone 16 Pro Max 1 TB: 5G Mobile Phone with Camera Control, 4K 120 fps Dolby Vision and a Huge Leap in Battery Life.', NULL, '2026-03-16 03:19:39'),
(3, 'Samsung Galaxy S23 Ultra', '₹89,000', '1', 'https://m.media-amazon.com/images/I/71qGismu6NL._SX679_.jpg', 'Samsung Galaxy S23 FE 5G (Mint, 8GB, 128GB Storage)', NULL, '2026-03-16 03:19:51'),
(4, 'OnePlus 15R 5G', '₹39,999', '1', 'https://m.media-amazon.com/images/I/61AsNTuJ6mL._SX679_.jpg', 'The OnePlus 15R 5G is a mid-range smartphone that offers a range of features and specifications.', NULL, '2026-03-16 03:20:02'),
(5, 'Google Pixel 7 Pro', '₹28,999', '1', 'https://m.media-amazon.com/images/I/51OFxuD1GgL._SX522_.jpg', 'Google Pixel 7 Pro (Obsidian, 128 GB) (12 GB RAM)', NULL, '2026-03-16 03:20:15'),
(6, 'LG', '₹59,000', '2', 'https://m.media-amazon.com/images/I/71yz55f1VlL._SX522_.jpg', 'LG 139 cm (55 Inches) UR7500 AI Series 4K Ultra HD (3840 x 2160) LED Smart TV (Black) (2020 Model)', NULL, '2026-03-16 03:20:30'),
(7, 'Samsung', '₹70,000', '2', 'https://m.media-amazon.com/images/I/81GeWU+aNGL._SX522_.jpg', 'Samsung 139 cm (55 inches) QN90C Neo QLED 4K Ultra HD Smart TV (Black)', NULL, '2026-03-16 03:20:44'),
(8, 'Sony', '₹54,000', '2', 'https://m.media-amazon.com/images/I/81Vs1ZXn43L._SX522_.jpg', 'Sony 139 cm (55 inches) X80K Series 4K Ultra HD Smart LED Google TV XR55X80K', NULL, '2026-03-16 03:20:56'),
(9, 'Toshiba', '₹29,000', '2', 'https://m.media-amazon.com/images/I/9121McCSSxL._SX522_.jpg', 'Toshiba 139 cm (55 inches) C350NP Series 4K Ultra HD Smart LED Google TV 55C350NP (Black)', NULL, '2026-03-16 03:21:08'),
(10, 'TCL', '₹32,000', '2', 'https://m.media-amazon.com/images/I/71BXyInFv8L._SX522_.jpg', 'TCL 139 cm (55 inches) 4K UHD Smart QLED Google TV 55T6C (Black)', NULL, '2026-03-17 07:45:52'),
(11, 'iQOO Z10x 5G', '₹15,999', '1', 'https://m.media-amazon.com/images/I/61oa+zoqwmL._SX679_.jpg', 'iQOO Z10x 5G (Ultramarine, 8GB RAM, 256GB Storage) | 6500 mAh Large Capacity Battery | Dimensity 7300 Processor | Military-Grade Durability', NULL, '2026-03-16 03:21:31'),
(12, 'Xiaomi', '₹29,999', '2', 'https://m.media-amazon.com/images/I/71mA83yc8xL._SX522_.jpg', 'Xiaomi 138 cm (55 inch) FX Ultra HD 4K Smart LED Fire TV L55MB-FIN\r\nWarranty Information: Enjoy 1 Year of Comprehensive Warranty', NULL, '2026-03-16 03:21:39');

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
(2, 'Apple iPhone 16 Pro', '₹1,19,900', 'https://m.media-amazon.com/images/I/619oqSJVY5L._SX679_.jpg', NULL, NULL),
(7, 'Samsung', '₹70,000', 'https://m.media-amazon.com/images/I/81GeWU+aNGL._SX522_.jpg', NULL, NULL),
(10, 'TCL TV', '₹32,000', 'https://m.media-amazon.com/images/I/71BXyInFv8L._SX522_.jpg', NULL, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `password`, `Gender`, `created_at`, `updated_at`, `otp`) VALUES
(1, 'Dhruvi', '6359950829', 'dhruvi@gmail.com', '$2y$10$FSnb8Y8iyzjKwqxCEzLGRO1hjNS7KgWO8pjX05VN0IPSCMCvux0K.', 'Female', '2026-02-20 11:20:38', '2026-03-12 05:05:31', NULL),
(12, 'Sahil', '7622920559', 'sahilpatel55500@gmail.com', '$2y$10$ZFc6FtTf1axgqo.b883DT.ylk2yh0/33is/rd65dBq8sRjTDKiT5i', 'Male', '2026-03-18 04:46:28', '2026-03-18 04:57:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add cart`
--
ALTER TABLE `add cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

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
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `trending`
--
ALTER TABLE `trending`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
