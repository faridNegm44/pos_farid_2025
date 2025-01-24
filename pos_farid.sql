-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 09:47 PM
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
-- Database: `pos_farid`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients_and_suppliers`
--

CREATE TABLE `clients_and_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_supplier_type` tinyint(4) NOT NULL,
  `code` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'df_image.png',
  `type_payment` varchar(255) NOT NULL DEFAULT 'كاش',
  `debit` varchar(255) DEFAULT NULL,
  `debit_limit` varchar(255) DEFAULT NULL,
  `money` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `commercial_register` varchar(255) DEFAULT NULL,
  `tax_card` varchar(255) DEFAULT NULL,
  `vat_registration_code` varchar(255) DEFAULT NULL,
  `name_of_commissioner` varchar(255) DEFAULT NULL,
  `phone_of_commissioner` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients_and_suppliers`
--

INSERT INTO `clients_and_suppliers` (`id`, `client_supplier_type`, `code`, `name`, `email`, `address`, `phone`, `image`, `type_payment`, `debit`, `debit_limit`, `money`, `status`, `commercial_register`, `tax_card`, `vat_registration_code`, `name_of_commissioner`, `phone_of_commissioner`, `note`, `created_at`, `updated_at`) VALUES
(13, 3, 12, 'جرجس المحلاوي', 'gergs@gmail.com', 'المحله شارع الغزل والنسيج خلف البنزينه', '0100998877665', '1725367087.jpg', 'آجل', NULL, '1000', '970', 0, '777', '2277', '777', '77', '777', '666666666tt', '2024-09-03 06:42:59', '2024-09-03 09:40:52'),
(16, 3, 16, 'علي احمد زيدان المصري', 'ali@gmail.com', NULL, '019999999', 'df_image.png', 'كاش', NULL, NULL, '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-03 10:34:03', '2024-09-03 10:39:15'),
(30, 1, 2, 'ايهاب علي الفيروزfff', 'ehab@gmail.comfff', 'cairo el mokatemfff', '666666', '1725477040.jpg', 'كاش', NULL, '666666666', '2000', 1, '1144', '2244', '3344', '4444', '5544', '111111111144', '2024-09-04 00:37:22', '2024-09-04 16:11:06'),
(32, 1, 3, 'الصفا', NULL, NULL, NULL, 'df_image.png', 'كاش', 'نعم', NULL, '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-04 03:34:51', NULL),
(33, 1, 3, 'المتحده اكسسوار', NULL, NULL, NULL, 'df_image.png', 'كاش', 'نعم', NULL, '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-04 03:35:04', NULL),
(34, 1, 4, 'ابن سيناء', NULL, NULL, NULL, 'df_image.png', 'كاش', 'نعم', '66000', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-04 03:35:16', '2024-09-04 03:35:39'),
(37, 3, 17, 'امجد علي', NULL, NULL, NULL, 'df_image.png', 'كاش', 'لاء', NULL, '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 16:38:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients_and_suppliers_dets`
--

CREATE TABLE `clients_and_suppliers_dets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `treasury_id` int(11) NOT NULL,
  `bill_type` varchar(255) DEFAULT NULL,
  `bill_id` int(11) NOT NULL,
  `treasury_bill_head_id` int(11) NOT NULL,
  `treasury_bill_body_id` int(11) NOT NULL,
  `client_supplier_id` int(11) NOT NULL,
  `money` varchar(255) DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients_and_suppliers_dets`
--

INSERT INTO `clients_and_suppliers_dets` (`id`, `treasury_id`, `bill_type`, `bill_id`, `treasury_bill_head_id`, `treasury_bill_body_id`, `client_supplier_id`, `money`, `year_id`, `notes`, `created_at`, `updated_at`) VALUES
(13, 0, 'رصيد اول المدة', 0, 0, 0, 13, '970', 1, '666666666', NULL, NULL),
(14, 0, 'رصيد اول المدة', 0, 0, 0, 13, '970', 1, '666666666', NULL, NULL),
(17, 0, 'رصيد اول المدة', 0, 0, 0, 16, '0', 1, NULL, NULL, NULL),
(18, 0, 'رصيد اول المدة', 0, 0, 0, 16, '0', 1, NULL, NULL, NULL),
(32, 0, 'رصيد اول المدة', 0, 0, 0, 30, '-2000', 1, '1111111111', NULL, NULL),
(34, 0, 'رصيد اول المدة', 0, 0, 0, 30, '-2000', 1, '1111111111', NULL, NULL),
(35, 0, 'رصيد اول المدة', 0, 0, 0, 32, '0', 1, NULL, NULL, NULL),
(36, 0, 'رصيد اول المدة', 0, 0, 0, 33, '0', 1, NULL, NULL, NULL),
(37, 0, 'رصيد اول المدة', 0, 0, 0, 34, '0', 1, NULL, NULL, NULL),
(40, 0, 'رصيد اول المدة', 0, 0, 0, 37, '0', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients_and_suppliers_types`
--

CREATE TABLE `clients_and_suppliers_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clients_and_suppliers_types`
--

INSERT INTO `clients_and_suppliers_types` (`id`, `name`, `type`, `status`) VALUES
(1, 'مورد', '+', 1),
(2, 'مورد داخلي', '+', 1),
(3, 'عميل', '-', 1),
(4, 'عميل داخلي', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'شركة عرب سيد', '1', '2024-05-24 12:59:21', '2024-05-24 13:04:55'),
(2, 'شركة عرب سيد بلاستيك', '0', '2024-05-24 12:59:44', '2024-05-24 13:04:33'),
(3, 'شركة الحمد للكهرباء', '1', '2024-05-24 13:08:13', '2024-05-24 13:08:13'),
(4, 'شركة الهلباوي للحداديد', '1', '2024-05-24 13:08:26', '2024-05-24 13:09:11'),
(5, 'شركة علي اند علي للأوراق', '1', '2024-05-24 13:08:54', '2024-05-24 13:08:54'),
(6, 'ffffffffffff', '0', '2024-08-31 08:52:39', '2025-01-22 12:18:15'),
(7, 'xxxx', '1', '2025-01-22 12:18:27', '2025-01-22 12:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_storages`
--

CREATE TABLE `financial_storages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `userOne` int(11) NOT NULL,
  `userTwo` int(11) DEFAULT NULL,
  `userThree` int(11) DEFAULT NULL,
  `moneyFirstDuration` int(11) NOT NULL DEFAULT 0,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_treasuries`
--

CREATE TABLE `financial_treasuries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `userOne` int(11) DEFAULT NULL,
  `moneyFirstDuration` int(11) NOT NULL DEFAULT 0,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_treasuries`
--

INSERT INTO `financial_treasuries` (`id`, `name`, `userOne`, `moneyFirstDuration`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'خزينه فريد نجم', NULL, 1000, '0', 'rrrrrr', '2024-08-31 07:34:08', '2024-12-22 10:21:15'),
(2, 'خزينة البنك الأهلي المصري', NULL, 0, '1', NULL, '2024-08-31 07:44:54', '2024-08-31 08:49:12'),
(3, 'خزينة انستاباي ايهاب', NULL, 999, '1', NULL, '2024-12-22 10:20:26', '2024-12-22 10:20:26'),
(4, 'خزينه أسماء', NULL, 30000, '0', NULL, '2024-12-22 10:22:34', '2024-12-22 10:22:34'),
(5, 'خزنه تيست الرقم', NULL, 200000, '1', NULL, '2024-12-22 10:27:39', '2024-12-22 10:27:39'),
(6, 'خزنه تيست المليون', NULL, 3000000, '1', NULL, '2024-12-22 10:28:25', '2024-12-22 10:28:25'),
(7, 'خزنه جديدة', NULL, 0, '0', NULL, '2025-01-22 12:20:42', '2025-01-22 12:20:49'),
(8, 'xxx', NULL, 555000, '1', 'note xxxxxxx', '2025-01-22 12:21:07', '2025-01-22 12:21:27'),
(9, 'خزنه جديدة 2', NULL, 0, '1', NULL, '2025-01-23 14:53:39', '2025-01-23 14:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `financial_years`
--

CREATE TABLE `financial_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_years`
--

INSERT INTO `financial_years` (`id`, `name`, `start`, `end`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'سنة مالية 2024', '2024-01-01 00:00:00', '2024-12-31 00:00:00', '1', 'note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 note 1 ', '2024-05-28 14:40:13', '2024-05-28 14:40:13');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_10_135458_create_settings_table', 1),
(6, '2024_04_21_122748_create_clients_and_suppliers_table', 2),
(7, '2024_04_25_204845_create_units_table', 3),
(8, '2024_05_24_152418_create_product_categoys_table', 4),
(9, '2024_05_24_154921_create_companies_table', 5),
(10, '2024_05_28_141605_create_financial_years_table', 6),
(11, '2024_05_28_141805_create_financial_storages_table', 7),
(12, '2024_06_06_102238_create_products_table', 8),
(13, '2024_06_29_111532_create_stores_table', 9),
(18, '2024_07_20_095531_create_store_dets_table', 10),
(19, '2024_08_31_082834_create_clients_and_suppliers_dets_table', 11),
(20, '2024_08_31_085237_create_financial_treasuries_table', 11);

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
  `shortCode` varchar(255) DEFAULT NULL,
  `natCode` varchar(255) DEFAULT NULL,
  `nameAr` varchar(255) NOT NULL,
  `nameEn` varchar(255) DEFAULT NULL,
  `store` int(11) NOT NULL,
  `company` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `stockAlert` varchar(255) NOT NULL DEFAULT '0',
  `divisible` enum('1','0') NOT NULL DEFAULT '0',
  `sellPrice` varchar(255) NOT NULL,
  `purchasePrice` varchar(255) NOT NULL,
  `discountPercentage` varchar(255) NOT NULL DEFAULT '0',
  `tax` varchar(255) NOT NULL DEFAULT '0',
  `firstPeriodCount` varchar(255) NOT NULL DEFAULT '0',
  `bigUnit` int(11) DEFAULT NULL,
  `smallUnit` int(11) NOT NULL,
  `smallUnitPrice` varchar(255) NOT NULL,
  `smallUnitNumbers` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `image` varchar(255) NOT NULL DEFAULT 'df_image.png',
  `desc` varchar(255) DEFAULT NULL,
  `offerDiscountStatus` enum('1','0') NOT NULL DEFAULT '0',
  `offerDiscountPercentage` varchar(255) DEFAULT NULL,
  `offerStart` datetime DEFAULT NULL,
  `offerEnd` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `shortCode`, `natCode`, `nameAr`, `nameEn`, `store`, `company`, `category`, `stockAlert`, `divisible`, `sellPrice`, `purchasePrice`, `discountPercentage`, `tax`, `firstPeriodCount`, `bigUnit`, `smallUnit`, `smallUnitPrice`, `smallUnitNumbers`, `status`, `image`, `desc`, `offerDiscountStatus`, `offerDiscountPercentage`, `offerStart`, `offerEnd`, `created_at`, `updated_at`) VALUES
(7, '12', '11ee', 'كوشن فرو', NULL, 1, 2, 2, '0', '0', '100', '90', '0', '0', '0', 0, 1, '100', '2', '1', 'df_image.png', 'وصف', '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:08:45', '2024-07-20 12:08:45'),
(8, 'ffff', 'ggg', 'rrrrrrr', NULL, 1, 2, 2, '0', '0', '11', '11', '0', '0', '0', 2, 3, '22', '11', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:12:16', '2024-07-20 12:12:16'),
(10, '1111', '1111', '22222', NULL, 1, 2, 1, '0', '0', '222', '22', '0', '0', '0', 0, 1, '22', '22', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:29:24', '2024-07-20 12:29:24'),
(11, 'e', 'er', 'farid negm', 'farid negm', 1, 2, 2, '0', '0', '33', '44', '11', '0', '0', 1, 1, '11', '11', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:31:36', '2024-07-20 12:31:36'),
(12, '33', '3333', '3333', NULL, 2, 3, 3, '0', '0', '11', '22', '22', '0', '11', 0, 1, '22', '33', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:32:42', '2024-07-20 12:32:42'),
(13, '44', '44', '44', '44', 2, 4, 3, '0', '0', '22', '22', '0', '0', '0', 0, 1, '22', '33', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:34:38', '2024-07-20 12:34:38'),
(14, 'ssssssss', 'ssssss', 'ssssss', NULL, 2, NULL, NULL, '0', '0', '1111111', '2222', '22', '0', '0', 0, 1, '22', '22', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:39:14', '2024-07-20 12:39:14'),
(16, 'rrrrr', '5555ttttt', 'fffffffffffffffffffffffff', NULL, 1, NULL, NULL, '0', '0', '77', '88', '0', '0', '0', 0, 1, '55', '44', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:44:50', '2024-07-20 12:44:50'),
(17, '333', '33', '33', NULL, 1, NULL, NULL, '0', '0', '33', '33', '0', '0', '0', 0, 1, '33', '33', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:45:57', '2024-07-20 12:45:57'),
(18, NULL, NULL, '2222222', NULL, 2, NULL, NULL, '0', '0', '22', '22', '0', '0', '0', 0, 2, '22', '2', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:49:03', '2024-07-20 12:49:03'),
(19, 'قققققققق', NULL, 'قققققققققق', NULL, 2, NULL, NULL, '0', '0', '44', '44', '0', '0', '0', 0, 2, '44', '44', '1', 'df_image.png', NULL, '0', '0', '2024-07-20 00:00:00', '2024-07-21 00:00:00', '2024-07-20 12:52:55', '2024-07-20 12:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_categoys`
--

CREATE TABLE `product_categoys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categoys`
--

INSERT INTO `product_categoys` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'حدايد معدل', '2024-05-24 12:40:59', '2024-05-24 12:45:28'),
(2, 'بويات', '2024-05-24 12:41:06', '2024-05-24 12:46:39'),
(3, 'بلاستيك', '2024-05-24 12:44:55', '2024-05-24 12:44:55'),
(4, 'خراطيم كهرباء 22', '2024-05-24 12:45:03', '2025-01-22 12:05:29'),
(5, 'ggg 222', '2024-08-31 08:53:59', '2025-01-22 12:05:24'),
(6, 'بوياتر', '2025-01-22 12:07:54', '2025-01-22 12:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `logo` varchar(255) NOT NULL,
  `fav_icon` varchar(50) NOT NULL,
  `mail_driver` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `encryption` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `description`, `footer_text`, `address`, `email`, `phone1`, `phone2`, `logo`, `fav_icon`, `mail_driver`, `from`, `to`, `host`, `port`, `encryption`, `username`, `password`, `maintenance_mode`, `created_at`, `updated_at`) VALUES
(1, 'روزا ستور للمفروشات - أسماء نجم', 'روزا ستور للمفروشات وصف', 'جميع الحقوق محفوظه ( فريد نجم ) - 01012775704', 'الدقهلية المنصوره السنبلاوين قريه برهمتوش', 'decoration-house@decoration-house.com', '01016493611', '01117903055', 'logo.jpg', 'fav_icon.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-24 18:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'مخزن الحدايد والبويات', '1', 'ملاحظه 1', '2024-06-29 08:33:29', '2024-06-29 08:33:29'),
(2, 'مخزن الأسمنت', '0', NULL, '2024-06-29 08:33:49', '2024-06-29 08:33:49'),
(3, 'هاني', '1', NULL, '2024-07-12 11:51:17', '2024-07-12 11:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `store_dets`
--

CREATE TABLE `store_dets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `year_id` int(11) NOT NULL,
  `bill_head_id` int(11) NOT NULL,
  `bill_body_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_num_unit` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `quantity_all` varchar(255) NOT NULL,
  `product_sellPrice` varchar(255) NOT NULL,
  `product_purchasePrice` varchar(255) NOT NULL,
  `product_avg` varchar(255) NOT NULL,
  `product_cost` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_dets`
--

INSERT INTO `store_dets` (`id`, `type`, `year_id`, `bill_head_id`, `bill_body_id`, `product_id`, `product_num_unit`, `quantity`, `quantity_all`, `product_sellPrice`, `product_purchasePrice`, `product_avg`, `product_cost`, `date`, `created_at`, `updated_at`) VALUES
(5, 'رصيد اول المدة', 1, 0, 0, 7, 0, '0', '0', '100', '90', '0', '0', '2024-07-20', '2024-07-20 12:08:45', NULL),
(6, 'رصيد اول المدة', 1, 0, 0, 8, 0, '0', '0', '11', '11', '0', '0', '2024-07-20', '2024-07-20 12:12:16', NULL),
(8, 'رصيد اول المدة', 1, 0, 0, 10, 0, '0', '0', '222', '22', '0', '0', '2024-07-20', '2024-07-20 12:29:24', NULL),
(9, 'رصيد اول المدة', 1, 0, 0, 11, 0, '0', '0', '33', '44', '0', '0', '2024-07-20', '2024-07-20 12:31:36', NULL),
(10, 'رصيد اول المدة', 1, 0, 0, 12, 0, '0', '11', '11', '22', '0', '0', '2024-07-20', '2024-07-20 12:32:42', NULL),
(11, 'رصيد اول المدة', 1, 0, 0, 13, 0, '0', '0', '22', '22', '0', '0', '2024-07-20', '2024-07-20 12:34:38', NULL),
(12, 'رصيد اول المدة', 1, 0, 0, 14, 0, '0', '0', '1111111', '2222', '0', '0', '2024-07-20', '2024-07-20 12:39:14', NULL),
(14, 'رصيد اول المدة', 1, 0, 0, 16, 0, '0', '0', '77', '88', '0', '0', '2024-07-20', '2024-07-20 12:44:51', NULL),
(15, 'رصيد اول المدة', 1, 0, 0, 17, 0, '0', '0', '33', '33', '0', '0', '2024-07-20', '2024-07-20 12:45:57', NULL),
(16, 'رصيد اول المدة', 1, 0, 0, 18, 0, '0', '0', '22', '22', '0', '0', '2024-07-20', '2024-07-20 12:49:03', NULL),
(17, 'رصيد اول المدة', 1, 0, 0, 19, 0, '0', '0', '44', '44', '0', '0', '2024-07-20', '2024-07-20 12:52:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'علبه', '2024-04-25 20:22:42', '2024-04-27 13:19:57'),
(2, 'شريط', '2024-04-25 20:24:13', '2024-04-25 20:24:13'),
(3, 'قرص', '2024-04-25 20:24:18', '2024-04-25 20:24:18'),
(4, 'سرنجة', '2024-04-25 20:35:53', '2024-04-25 20:35:53'),
(5, 'كيس فوار', '2024-04-25 20:54:19', '2024-04-25 20:54:19'),
(6, 'زجاجه دوارء', '2024-04-25 20:55:07', '2024-04-25 20:55:07'),
(7, 'سرنجة انسولين', '2024-04-25 20:57:25', '2024-04-25 20:57:25'),
(8, 'فرشة اسنان', '2024-04-25 20:58:55', '2024-04-25 20:58:55'),
(9, 'زجاجة شامبو', '2024-04-25 20:59:07', '2024-04-25 20:59:07'),
(10, 'موس حلاقة', '2024-04-25 20:59:23', '2024-04-25 20:59:23'),
(11, 'سكر دايت', '2024-04-25 21:02:09', '2024-04-25 21:02:09'),
(12, 'ععع', '2024-04-27 12:10:35', '2024-04-27 12:10:35'),
(13, 'ayabgg fffff', '2024-05-24 09:09:20', '2025-01-22 12:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `login_barcode` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `role` tinyint(4) NOT NULL,
  `theme` tinyint(4) NOT NULL DEFAULT 1,
  `address` varchar(255) DEFAULT NULL,
  `nat_id` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'df_image.png',
  `gender` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `last_login_time` datetime DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `login_name`, `login_barcode`, `phone`, `role`, `theme`, `address`, `nat_id`, `birth_date`, `image`, `gender`, `status`, `last_login_time`, `note`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'farid', 'farid@gmail.com', '111111', 'farid login', NULL, NULL, 1, 1, NULL, NULL, NULL, 'df_image.png', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'aya', 'aya@gmail.com', '222222', 'aya login', NULL, NULL, 0, 1, NULL, NULL, NULL, 'df_image.png', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'asmaa', 'asmaa@gmail.com', '111111', 'asmaa \r\nlogin', NULL, NULL, 1, 1, NULL, NULL, NULL, 'df_image.png', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'hala', 'hala@gmail.com', '222222', 'hala login', NULL, NULL, 0, 1, NULL, NULL, NULL, 'df_image.png', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients_and_suppliers`
--
ALTER TABLE `clients_and_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_and_suppliers_dets`
--
ALTER TABLE `clients_and_suppliers_dets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_and_suppliers_types`
--
ALTER TABLE `clients_and_suppliers_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `financial_storages`
--
ALTER TABLE `financial_storages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `financial_storages_name_unique` (`name`);

--
-- Indexes for table `financial_treasuries`
--
ALTER TABLE `financial_treasuries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `financial_treasuries_name_unique` (`name`);

--
-- Indexes for table `financial_years`
--
ALTER TABLE `financial_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `financial_years_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_namear_unique` (`nameAr`),
  ADD UNIQUE KEY `products_nameen_unique` (`nameEn`);

--
-- Indexes for table `product_categoys`
--
ALTER TABLE `product_categoys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categoys_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stores_name_unique` (`name`);

--
-- Indexes for table `store_dets`
--
ALTER TABLE `store_dets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_login_name_unique` (`login_name`),
  ADD UNIQUE KEY `users_login_barcode_unique` (`login_barcode`),
  ADD UNIQUE KEY `users_nat_id_unique` (`nat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients_and_suppliers`
--
ALTER TABLE `clients_and_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `clients_and_suppliers_dets`
--
ALTER TABLE `clients_and_suppliers_dets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `clients_and_suppliers_types`
--
ALTER TABLE `clients_and_suppliers_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_storages`
--
ALTER TABLE `financial_storages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_treasuries`
--
ALTER TABLE `financial_treasuries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_categoys`
--
ALTER TABLE `product_categoys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_dets`
--
ALTER TABLE `store_dets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
