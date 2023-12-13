-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 09:31 AM
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
-- Database: `food_kiosk`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_ons`
--

CREATE TABLE `add_ons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `c_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_ons`
--

INSERT INTO `add_ons` (`id`, `order_id`, `c_id`, `created_at`, `updated_at`) VALUES
(4, 18, 22, '2023-10-22 11:13:52', '2023-10-22 11:13:52'),
(5, 22, 19, '2023-10-31 02:36:04', '2023-10-31 02:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `customized_products`
--

CREATE TABLE `customized_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customized_product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customized_products`
--

INSERT INTO `customized_products` (`id`, `name`, `product_code`, `description`, `is_disabled`, `photo`, `created_at`, `updated_at`, `customized_product_id`) VALUES
(18, 'Lettuce', 'HTS-6521aa6ce45c1', 'Lettucee', 0, 'product_photos/wufe32ETCJx5JkjvKlZfvtA0XJq1BMMXB4jz43aG.jpg', '2023-10-07 10:58:54', '2023-10-31 22:20:16', 0),
(19, 'Seeds', 'HTS-6521aa870d9f0', 'seed', 0, 'product_photos/LmbMPNnbdz5MvoLx0PwxUwco5EXOJoYwqz2RQwpH.jpg', '2023-10-07 10:59:19', '2023-10-07 10:59:19', 0),
(20, 'Raisins', 'HTS-6521aa94a4a05', 'Ryzen', 0, 'product_photos/LlQafDFwtqvtr9EVUwnsZzoNba7sRaCmzgZ0Hb9P.jpg', '2023-10-07 10:59:32', '2023-10-07 10:59:32', 0),
(21, 'Garlic', 'HTS-6521aaa46f243', 'Ahos Gaming', 0, 'product_photos/kX1ZuzU1Vndd9hHhEWl6bb16IW1jCH9LEoOUSNBS.jpg', '2023-10-07 10:59:48', '2023-10-07 10:59:48', 0),
(22, 'Carrot', 'HTS-6521aab2ef56c', 'Carrots', 0, 'product_photos/6pD13A71b1N8SEiUo3Liwes0sVb5P15uHKWgAWIT.jpg', '2023-10-07 11:00:03', '2023-10-07 11:00:03', 0),
(23, 'Apple', 'HTS-6521aac67e504', 'Apple pro max', 0, 'product_photos/H0CrLBCLeBX3SdYYpfBAtFmbzCiS7hZA1j2hQStG.jpg', '2023-10-07 11:00:22', '2023-10-07 11:00:22', 0),
(25, 'Onion', 'HTS-6525b8b429727', 'india', 0, 'product_photos/EaQ6HXlnI9ATFJFrjxbNWmjjXDX5HXKNgbhDO6Fe.jpg', '2023-10-10 12:48:52', '2023-10-10 12:48:52', 0),
(26, 'Red Raisins', 'HTS-6525d74072988', 'wew', 0, 'product_photos/onKdinBO79NOv9qsRCEOhvPfJXT9UlYUpMk0EpQF.jpg', '2023-10-10 14:59:12', '2023-10-20 17:10:32', NULL),
(28, 'Tofu', 'HTS-6525d804365f5', 'Tufo In Action', 0, 'product_photos/KIC7GebatbF6OSW9HnRrqWMktVrnt7DovKdEgG2w.jpg', '2023-10-10 15:02:28', '2023-10-10 15:02:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_11_132659_create_sessions_table', 1),
(7, '2023_07_11_141541_create_products_table', 2),
(16, '2014_10_12_100000_create_password_resets_table', 8),
(17, '2023_07_28_192706_add_role_to_users_table', 9),
(18, '2023_08_02_075314_create_cashiers_table', 10),
(19, '2023_08_02_075320_create_kitchens_table', 10),
(20, '2023_08_02_121812_create_admins_table', 11),
(22, '2023_08_14_000005_create_product_category_table', 12),
(23, '2023_08_17_223021_create_orders_table', 13),
(24, '2023_08_17_223044_create_order_items_table', 13),
(25, '2023_07_15_121646_add_columns_to_users_table', 14),
(26, '2023_07_15_154752_create_permission_tables', 14),
(27, '2023_07_18_132723_add_is_disabled_to_users', 14),
(28, '2023_07_18_135328_add_is_disabled_to_products', 15),
(29, '2023_07_23_161818_add_photo_to_products_table', 16),
(34, '2023_10_06_195721_modify_order_items_table', 17),
(37, '2023_10_10_225746_modify_customized_products_table', 19),
(47, '2023_10_17_193207_create_jobs_table', 27),
(48, '2023_10_11_184238_create_orders_table', 28),
(49, '2023_10_09_000409_modify_order_items_table', 29),
(50, '2023_10_13_140753_create_add_ons_table', 30),
(51, '2023_10_13_182820_create_payments_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `total_amount`, `order_type`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(14, '7356', 915.00, 'Take Out', 'Cash', 'Paid', '2023-10-20 19:19:16', '2023-10-20 19:21:21'),
(15, '9300', 1770.00, 'Dine In', 'Cash', 'Paid', '2023-10-20 19:22:44', '2023-10-20 19:23:02'),
(16, '7396', 295.00, 'Take Out', 'Gcash', 'Paid', '2023-10-20 19:28:27', '2023-10-22 10:03:57'),
(17, '2353', 325.00, 'Take Out', 'Cash', 'Paid', '2023-10-22 10:19:19', '2023-10-22 10:19:33'),
(18, '5059', 295.00, 'Take Out', 'Cash', 'Paid', '2023-10-22 11:13:52', '2023-10-22 11:14:05'),
(19, '4808', 295.00, 'Dine In', 'Cash', 'Unpaid', '2023-10-27 18:34:45', '2023-10-27 18:34:45'),
(20, '3727', 915.00, 'Dine In', 'Cash', 'Unpaid', '2023-10-27 18:36:42', '2023-10-27 18:36:42'),
(21, '8760', 295.00, 'Take Out', 'Gcash', 'Unpaid', '2023-10-31 02:27:40', '2023-10-31 02:27:40'),
(22, '8384', 295.00, 'Dine In', 'Gcash', 'Unpaid', '2023-10-31 02:36:04', '2023-10-31 02:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 84, 2, 220.00, '2023-10-20 12:00:08', '2023-10-20 12:00:08'),
(2, 1, 86, 1, 180.00, '2023-10-20 12:00:08', '2023-10-20 12:00:08'),
(3, 2, 84, 1, 110.00, '2023-10-20 12:27:50', '2023-10-20 12:27:50'),
(4, 3, 84, 3, 330.00, '2023-10-20 13:28:43', '2023-10-20 13:28:43'),
(5, 6, 84, 1, 110.00, '2023-10-20 13:30:19', '2023-10-20 13:30:19'),
(6, 7, 83, 1, 150.00, '2023-10-20 13:31:34', '2023-10-20 13:31:34'),
(7, 7, 87, 1, 100.00, '2023-10-20 13:31:34', '2023-10-20 13:31:34'),
(8, 8, 83, 1, 150.00, '2023-10-20 14:48:54', '2023-10-20 14:48:54'),
(9, 9, 83, 1, 150.00, '2023-10-20 14:55:23', '2023-10-20 14:55:23'),
(10, 10, 83, 1, 150.00, '2023-10-20 14:58:55', '2023-10-20 14:58:55'),
(11, 11, 83, 1, 325.00, '2023-10-20 17:17:17', '2023-10-20 17:17:17'),
(12, 11, 84, 1, 295.00, '2023-10-20 17:17:17', '2023-10-20 17:17:17'),
(13, 12, 83, 1, 325.00, '2023-10-20 18:06:31', '2023-10-20 18:06:31'),
(14, 12, 85, 1, 345.00, '2023-10-20 18:06:31', '2023-10-20 18:06:31'),
(15, 13, 85, 1, 345.00, '2023-10-20 18:30:56', '2023-10-20 18:30:56'),
(16, 13, 87, 1, 195.00, '2023-10-20 18:30:56', '2023-10-20 18:30:56'),
(17, 14, 83, 1, 325.00, '2023-10-20 19:19:16', '2023-10-20 19:19:16'),
(18, 14, 84, 2, 590.00, '2023-10-20 19:19:16', '2023-10-20 19:19:16'),
(19, 15, 84, 6, 1770.00, '2023-10-20 19:22:44', '2023-10-20 19:22:44'),
(20, 16, 84, 1, 295.00, '2023-10-20 19:28:27', '2023-10-20 19:28:27'),
(21, 17, 83, 1, 325.00, '2023-10-22 10:19:19', '2023-10-22 10:19:19'),
(22, 18, 84, 1, 295.00, '2023-10-22 11:13:52', '2023-10-22 11:13:52'),
(23, 19, 84, 1, 295.00, '2023-10-27 18:34:45', '2023-10-27 18:34:45'),
(24, 20, 84, 2, 590.00, '2023-10-27 18:36:42', '2023-10-27 18:36:42'),
(25, 20, 83, 1, 325.00, '2023-10-27 18:36:42', '2023-10-27 18:36:42'),
(26, 21, 84, 1, 295.00, '2023-10-31 02:27:40', '2023-10-31 02:27:40'),
(27, 22, 84, 1, 295.00, '2023-10-31 02:36:04', '2023-10-31 02:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `cashier_id` bigint(20) UNSIGNED NOT NULL,
  `ref_num` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `change` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `cashier_id`, `ref_num`, `amount`, `change`, `created_at`, `updated_at`) VALUES
(1, 1, 41, NULL, '500', '100.00', '2023-10-20 12:00:29', '2023-10-20 12:00:29'),
(2, 2, 41, NULL, '120', '10.00', '2023-10-20 13:26:33', '2023-10-20 13:26:33'),
(3, 4, 41, NULL, '213', '213.00', '2023-10-20 13:30:28', '2023-10-20 13:30:28'),
(4, 5, 41, NULL, '123', '123.00', '2023-10-20 13:30:35', '2023-10-20 13:30:35'),
(5, 6, 41, NULL, '120', '10.00', '2023-10-20 13:30:43', '2023-10-20 13:30:43'),
(6, 9, 41, '111111', '150', NULL, '2023-10-20 14:57:52', '2023-10-20 14:57:52'),
(7, 10, 41, NULL, '160', '10.00', '2023-10-20 14:59:07', '2023-10-20 14:59:07'),
(8, 11, 41, NULL, '650', '30.00', '2023-10-20 17:17:42', '2023-10-20 17:17:42'),
(9, 12, 41, NULL, '700', '30.00', '2023-10-20 18:06:55', '2023-10-20 18:06:55'),
(10, 14, 41, NULL, '1000', '85.00', '2023-10-20 19:21:21', '2023-10-20 19:21:21'),
(11, 15, 41, NULL, '2000', '230.00', '2023-10-20 19:23:02', '2023-10-20 19:23:02'),
(12, 16, 41, '123123123123123000', '295', NULL, '2023-10-22 10:03:57', '2023-10-22 10:03:57'),
(13, 17, 41, NULL, '330', '5.00', '2023-10-22 10:19:33', '2023-10-22 10:19:33'),
(14, 18, 41, NULL, '300', '5.00', '2023-10-22 11:14:05', '2023-10-22 11:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
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
  `title` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `product_code` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `product_code`, `description`, `photo`, `created_at`, `updated_at`, `is_disabled`, `user_id`) VALUES
(83, 'Bukidnon Harvest Salad', '325', 'HTS-6521bd468d1a4', 'Salad', 'product_photos/RYd9O2zyaK7Hyv3fUW8tqffGsIJBlhfhWwuErHqg.jpg', '2023-10-07 12:19:18', '2023-10-20 16:50:56', 0, NULL),
(84, 'THY Quesadillas', '295', 'HTS-6521bd8b8ac0b', 'Queso', 'product_photos/rWFayXKiJTqs9FBibCKnUv9fkC7k1qlxj7nBoVZm.jpg', '2023-10-07 12:20:27', '2023-10-20 18:31:33', 0, NULL),
(85, 'Honey Lemon Chicken', '345', 'HTS-6521bd9e3e7d1', 'HoneyC', 'product_photos/umE9by5n0AzzXysFzSJOPZJlzgefTGieOUgNgWUp.jpg', '2023-10-07 12:20:46', '2023-10-20 16:50:03', 0, NULL),
(86, 'Honey Garlic Chicken', '345', 'HTS-6521bdb5c00cb', 'Chicken Inasar', 'product_photos/cVObBE2QSMrYh9LyEaamXIzwSzehrQD9NK7A8kwo.jpg', '2023-10-07 12:21:09', '2023-10-20 16:49:27', 0, NULL),
(87, 'THY Smoothie', '195', 'HTS-6521be0d01302', 'Smooth', 'product_photos/Zfe53GLAfjIUFJar3AGg8fhGXArl8p9RaxV6dIpT.jpg', '2023-10-07 12:22:37', '2023-10-20 16:48:06', 0, NULL),
(88, 'THY Mango Bliss', '225', 'HTS-6521be3c40e2d', 'Mango Cheese', 'product_photos/N3LSpgnzDGfCmZkUVgYQWWcWxpSV0eFPFafpnKHy.jpg', '2023-10-07 12:23:24', '2023-10-20 16:47:42', 0, NULL),
(89, 'THY Spinach Pasta', '299', 'HTS-65334232748f6', 'spinach', 'product_photos/oIHXqOAshJ6KTml9fjSHgceDXSlom7SgiP8jnQhZ.jpg', '2023-10-20 19:14:59', '2023-10-20 19:14:59', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('F3EMcbE7zKGg3ImtHakjPbuy9ighN5av4xjHwSyV', 41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVE9ybW9MSll6M3o1azhVSUMwNnM0czVBYUZiOUUyRTJQYTRSV3hzMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXNoaWVyL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQxO30=', 1699085983),
('fmEeMYQmKamAHmfFhxPLLHPnhcOE45sYl3b0kzR3', 27, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/87.0.4280.77 Mobile/15E148 Safari/604.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNXJNZ2t6S0N4OE5zZ0JSTXY1WDJwT2kzRFZLSloyRENaVVJOanZ4VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYW5kaW5nLXBhZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjc7fQ==', 1698820747),
('FUyS5v8cLBKxJ2CLG0o6hSWZnvKeAHICpqnsNwEl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnF1YmF6SVpFN25uWTQ5NExZZEtrY244NkV3cDNTQWdyWG5tYXJPdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYW5kaW5nLXBhZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1698938585),
('kLXm9egbKp18X078hTRTvLPUkblXBapqqURTobGx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWURxS2M2SWxMeDNEWGprdDNvWmZJMDk4Mk1uSWswWEFDWkhNMDVLcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXNoaWVyL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1698819647),
('PFzZrafAPpHQsHBvGigmeWG24YfdpmiglAmOA8la', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemxvd293YTMzQ0FWMFNvc2F6eGRSYVhBdTQ5djgzRUd4R25kYkNrRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYW5kaW5nLXBhZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1698907195),
('toO2DvaM390CDdLdc3Z7NTySJZj7RpcTPoLG0a3j', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWpIcWRmRWI1aU8wOUR4TUNocUxiME1lcHJoeFhrZmRzT1JET2JLVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYW5kaW5nLXBhZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1699082244),
('yn26Awqy6o2WmcLEjmDDtyRhMdTS6g3SylnSBhXK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY09sUk83c2NhUjZ1cTFrYVU4VkpFeGM5WjJ3U0MxcmNNeGx3aHBzMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYW5kaW5nLXBhZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1698902019);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_disabled`, `role`) VALUES
(27, 'Admin', 'admin@admin.com', NULL, '$2y$10$bSYzP6m2NrMwjMQiFmMzIu2oggj88q26n6VEBzvbMiO99nGmCMmuq', NULL, '2023-07-28 00:29:31', '2023-08-07 04:48:02', 0, 'Admin'),
(37, 'kokok', 'kokok@gmail.com', NULL, '$2y$10$PqVeZorcpxrzmKyGCXGP3uPRrtWZJXbLfL4OdtfpAq7tRLIDDS6Zu', NULL, '2023-07-28 10:32:15', '2023-08-07 04:51:04', 0, 'Kitchen'),
(41, 'wawak', 'wawak@gmail.com', NULL, '$2y$10$m7BhBH4uv0ueEQshkOalUuvp1nceM1OzVcGYoOcOdybv44dCnQRN2', NULL, '2023-08-13 13:04:10', '2023-08-13 13:04:10', 0, 'Cashier'),
(46, 'kakak', 'kakak@gmail.com', NULL, '$2y$10$QR1akGHPVM3UaGrDE7qHJutJ1/UI9knrUIvXaTk/d9.1JMulsOR3q', NULL, '2023-08-15 08:31:23', '2023-09-18 19:55:10', 0, 'Cashier'),
(47, 'omsim', 'omsim@gmail.com', NULL, '$2y$10$Y9Y9ez2YRV76e.XrJSUcf.I15Dd/TaED6cfzhHbybirhvOErWJVNa', NULL, '2023-09-19 09:28:04', '2023-10-20 07:04:34', 0, 'Kitchen'),
(48, 'kitchen1', 'kitchen@gmail.com', NULL, '$2y$10$.rmlUUlr4h1Wasec8rEMLelq3EN3XAa.V2jIqBsmzmyNn2qAk8brS', NULL, '2023-10-13 08:49:09', '2023-10-13 08:49:09', 0, 'Kitchen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_ons`
--
ALTER TABLE `add_ons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `customized_products`
--
ALTER TABLE `customized_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customized_product_id` (`customized_product_id`) USING BTREE;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `customized_product_id` (`id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `add_ons`
--
ALTER TABLE `add_ons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customized_products`
--
ALTER TABLE `customized_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_ons`
--
ALTER TABLE `add_ons`
  ADD CONSTRAINT `add_ons_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `add_ons_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `customized_products` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
