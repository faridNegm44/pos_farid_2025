-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 07:42 PM
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

INSERT INTO `clients_and_suppliers` (`id`, `client_supplier_type`, `code`, `name`, `email`, `address`, `phone`, `image`, `type_payment`, `debit`, `debit_limit`, `status`, `commercial_register`, `tax_card`, `vat_registration_code`, `name_of_commissioner`, `phone_of_commissioner`, `note`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'اسماء', NULL, ' مقطم شارع كريم بنونه د 9 شقه 109 \nmokatem', '0100', 'df_image.png', 'كاش', 'نعم', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 07:48:03', NULL),
(2, 3, 2, 'هالة', NULL, NULL, NULL, 'df_image.png', 'كاش', 'نعم', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 07:48:49', NULL),
(3, 3, 3, 'ايه', NULL, NULL, NULL, 'df_image.png', 'كاش', 'نعم', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 07:49:32', NULL),
(4, 1, 1, 'مورد امير', NULL, NULL, NULL, 'df_image.png', 'كاش', 'نعم', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 07:52:11', NULL),
(5, 1, 2, 'مورد رمضان', NULL, NULL, NULL, 'df_image.png', 'كاش', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 07:52:21', '2025-05-19 08:51:32'),
(7, 1, 4, 'مورد عشري', NULL, NULL, '01099', 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 07:53:11', '2025-04-12 07:55:24'),
(8, 3, 4, 'عميل افتراضي', NULL, 'عميل افتراضي', '00000', 'df_image.png', 'كاش', 'نعم', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-16 14:23:45', NULL),
(9, 3, 5, 'ehab اجل عليه 1000', NULL, NULL, '010023425', 'df_image.png', 'آجل', 'نعم', '2000', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-17 09:10:41', NULL),
(13, 3, 7, 'عبدالله ماهر', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-18 15:59:41', NULL),
(14, 3, 8, 'يونس ادريس', 'email@g.com', 'adress', '67877', '1747603967.jpg', 'آجل', NULL, '1234', 1, '1', '2', '3', '4', '5', 'notes', '2025-05-18 16:00:24', '2025-05-19 06:56:42'),
(15, 3, 9, 'شوري علي', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-18 16:02:34', NULL),
(20, 1, 5, 'مورد جديد برصيد افتتاحي واجل', NULL, NULL, NULL, 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-19 08:53:12', '2025-05-19 08:53:22'),
(22, 3, 10, 'هيثم كاش', NULL, NULL, NULL, 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-21 09:28:39', NULL),
(23, 3, 11, 'عزت اجل رصيد افتتاحي', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-21 09:29:21', NULL),
(24, 3, 12, 'حمو ايهاب اجل', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-21 09:29:34', NULL),
(25, 1, 6, 'سيد ايرجنت', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-21 09:38:30', NULL),
(26, 1, 7, 'محمود ايرجنت', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-21 09:38:38', NULL);

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
(6, 'ffffffffffff', '1', '2024-08-31 08:52:39', '2025-05-19 07:02:26'),
(7, 'xxxx', '1', '2025-01-22 12:18:27', '2025-01-22 12:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `treasury` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` enum('اضافة','حذف') NOT NULL DEFAULT 'اضافة',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `treasury`, `title`, `amount`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 3, 'دفع كهرباء شهر 4', '1000', 'اضافة', NULL, '2025-04-12 13:32:13', '2025-04-12 13:32:13'),
(2, 3, 'دفع ايجار محل اليماني', '2000', 'اضافة', 'ملاحظه دفع ايجار محل اليماني', '2025-04-12 13:35:29', '2025-04-12 13:35:29'),
(3, 1, 'باقي مرتب علي ماهر', '1000.5', 'حذف', NULL, '2025-04-12 14:22:58', '2025-04-12 14:22:58'),
(5, 3, 'فاتوره مايه شهر 5', '200', 'حذف', NULL, '2025-05-20 08:33:07', '2025-05-20 08:33:07');

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
  `userOne` varchar(50) DEFAULT NULL,
  `moneyFirstDuration` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_treasuries`
--

INSERT INTO `financial_treasuries` (`id`, `name`, `userOne`, `moneyFirstDuration`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'خزينة رئيسيه', 'محمد فريد نجم', 100000.00, '1', 'تحت اشراف محمد فريد نجم لعام 2025', '2025-04-12 07:34:08', '2025-04-12 07:34:08'),
(2, 'خزنه انستاباي', NULL, 0.00, '1', NULL, '2025-04-12 07:41:45', '2025-04-12 07:45:10'),
(3, 'خزنه فودافون كاش', NULL, 3000.00, '1', NULL, '2025-04-12 07:41:58', '2025-04-12 07:41:58');

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
(1, 'سنه مالية 2024', '2024-01-01 00:00:00', '2024-12-31 00:00:00', '1', NULL, NULL, NULL);

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
(20, '2024_08_31_085237_create_financial_treasuries_table', 11),
(21, '2025_01_29_003248_create_expenses_table', 12),
(22, '2025_01_29_200656_create_treasury_bill_dets_table', 13),
(23, '2025_03_05_225718_create_taswea_products_table', 14),
(24, '2025_03_05_230552_create_taswea_reasons_table', 15),
(25, '2025_02_06_102321_create_purchase_bills_table', 16),
(26, '2025_04_07_151511_create_purchase_bill_dets_table', 17);

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
  `stockAlert` decimal(10,3) NOT NULL DEFAULT 0.000,
  `discountPercentage` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tax` varchar(50) NOT NULL DEFAULT '0.000',
  `firstPeriodCount` decimal(10,3) NOT NULL DEFAULT 0.000,
  `bigUnit` int(11) DEFAULT NULL,
  `smallUnit` int(11) NOT NULL,
  `small_unit_numbers` decimal(10,3) NOT NULL DEFAULT 0.000,
  `max_sale_quantity` decimal(10,3) NOT NULL DEFAULT 0.000,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `image` varchar(255) NOT NULL DEFAULT 'df_image.png',
  `desc` varchar(255) DEFAULT NULL,
  `offerDiscountStatus` enum('1','0') DEFAULT NULL,
  `offerDiscountPercentage` varchar(255) DEFAULT NULL,
  `offerStart` datetime DEFAULT NULL,
  `offerEnd` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `shortCode`, `natCode`, `nameAr`, `nameEn`, `store`, `company`, `category`, `stockAlert`, `discountPercentage`, `tax`, `firstPeriodCount`, `bigUnit`, `smallUnit`, `small_unit_numbers`, `max_sale_quantity`, `status`, `image`, `desc`, `offerDiscountStatus`, `offerDiscountPercentage`, `offerStart`, `offerEnd`, `created_at`, `updated_at`) VALUES
(3, 'sh1', 'nat1', 'اول صنف', 'first product', 2, 2, 3, 3.000, 10.000, '14', 30.000, 1, 2, 5.000, 6.000, '1', 'df_image.png', 'وصف', '', NULL, NULL, NULL, NULL, '2025-04-25 03:18:37'),
(4, NULL, NULL, 'ثااااني صنف', 'second product', 3, 5, 7, 0.000, 0.000, '0', 0.000, 1, 2, 2.000, 0.000, '0', '1745522822.png', NULL, '', NULL, NULL, NULL, NULL, '2025-04-25 03:38:22'),
(5, NULL, NULL, 'سيتال شراب', NULL, 3, 5, 7, 0.000, 0.000, '0', 15.000, 0, 1, 1.000, 0.000, '0', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-04-25 03:38:07'),
(6, NULL, NULL, 'بروفين شراب 110ملnew', NULL, 3, 3, 5, 0.000, 7.000, '12', 4.000, 1, 3, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-04-25 04:00:40'),
(7, NULL, NULL, 'امباجليماكس 100', NULL, 3, 4, 4, 0.000, 17.000, '11', 40.000, 1, 2, 3.000, 90.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-04-25 03:19:07'),
(8, NULL, NULL, 'كونجستال', 'congestal', 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 2, 3.000, 0.000, '0', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, 'صنف الفنتيرن', 'alphinter product', 1, NULL, NULL, 0.000, 0.000, '0', 10.000, 1, 2, 5.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, 'كتافاست اكياس', 'catafast sach', 1, NULL, NULL, 0.000, 0.000, '0', 24.000, 1, 5, 12.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(11, NULL, NULL, 'فولتارين اقراص', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 1, 2, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(12, NULL, NULL, 'كتافلام اقراص 50', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 1, 2, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(13, NULL, NULL, 'كتافلام اقراص 25', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 1, 2, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(14, NULL, NULL, 'فلاجيل شراب 250مل', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 1, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, 'فلاجيلاقراص 500جم', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 1, 2, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, 'فلاجيلاقراص250 جم', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 1, 2, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(17, NULL, NULL, 'روبالجين جيل', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 1, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(18, NULL, NULL, 'موف جييل', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 1, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-05-01 16:12:57'),
(19, NULL, NULL, 'كونجستال شراب', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 1, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(20, NULL, NULL, 'انتينال شراب', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 1, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(21, NULL, NULL, 'دياكس شراب', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 1, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(22, NULL, NULL, 'كيورام 1 جرام اقراص', 'curam 1gm tabs', 1, NULL, NULL, 0.000, 0.000, '0', 16.000, 1, 2, 4.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(23, NULL, NULL, 'كيبوركس اقراص 1جرام', 'cuprex 1gm tabs', 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 1, 2, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(25, NULL, NULL, 'كيس كوشن فيرزاتشي 2 كوشن في الكيس', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 14, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-05-21 09:34:48'),
(26, NULL, NULL, 'كيس كوشن بابلز 2 كوشن في الكيس', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 14, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(27, NULL, NULL, 'انتريه بابلز', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 16, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(28, NULL, NULL, 'ركنة بابلز', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 0.000, 0, 17, 1.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(29, NULL, NULL, 'كوشن رخامي 2 كوشن في الكيس', NULL, 1, NULL, NULL, 0.000, 0.000, '0', 23.000, 0, 14, 2.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL);

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
(6, 'بوياتر', '2025-01-22 12:07:54', '2025-01-22 12:07:54'),
(7, 'النجف2', '2025-03-11 09:02:02', '2025-03-11 09:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bills`
--

CREATE TABLE `purchase_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_bill_num` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `treasury_id` int(11) DEFAULT NULL,
  `bill_tax` decimal(10,3) DEFAULT NULL,
  `bill_discount` decimal(10,3) DEFAULT NULL,
  `count_items` decimal(10,3) NOT NULL,
  `custom_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_bills`
--

INSERT INTO `purchase_bills` (`id`, `custom_bill_num`, `supplier_id`, `treasury_id`, `bill_tax`, `bill_discount`, `count_items`, `custom_date`, `user_id`, `year_id`, `notes`, `created_at`, `updated_at`) VALUES
(77, NULL, 25, NULL, NULL, NULL, 1.000, NULL, 1, 1, NULL, '2025-05-21 09:39:03', NULL),
(78, NULL, 25, NULL, NULL, NULL, 2.000, NULL, 1, 1, NULL, '2025-05-21 09:41:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_bills`
--

CREATE TABLE `sale_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_bill_num` varchar(255) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `treasury_id` int(11) DEFAULT NULL,
  `bill_tax` decimal(10,3) DEFAULT NULL,
  `bill_discount` decimal(10,3) DEFAULT NULL,
  `extra_money` decimal(10,3) DEFAULT NULL,
  `count_items` decimal(10,3) NOT NULL,
  `total_bill_before` decimal(30,20) NOT NULL,
  `total_bill_after` decimal(30,20) NOT NULL,
  `custom_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_bills`
--

INSERT INTO `sale_bills` (`id`, `custom_bill_num`, `client_id`, `treasury_id`, `bill_tax`, `bill_discount`, `extra_money`, `count_items`, `total_bill_before`, `total_bill_after`, `custom_date`, `user_id`, `year_id`, `notes`, `created_at`, `updated_at`) VALUES
(61, NULL, 9, 3, NULL, NULL, NULL, 1.000, 200.00000000000000000000, 200.00000000000000000000, NULL, 1, 1, NULL, '2025-05-18 07:21:43', NULL),
(63, NULL, 9, NULL, NULL, NULL, NULL, 1.000, 300.00000000000000000000, 300.00000000000000000000, NULL, 1, 1, NULL, '2025-05-18 07:22:52', NULL),
(64, NULL, 9, NULL, NULL, NULL, NULL, 1.000, 210.00000000000000000000, 200.00000000000000000000, NULL, 1, 1, NULL, '2025-05-18 07:23:40', NULL),
(65, NULL, 8, 3, NULL, NULL, 50.000, 1.000, 500.00000000000000000000, 550.00000000000000000000, NULL, 1, 1, '50 عربيه شحن من السنبلاوين', '2025-05-18 07:26:12', NULL),
(66, NULL, 8, 3, NULL, NULL, NULL, 3.000, 175.00000000000000000000, 175.00000000000000000000, NULL, 1, 1, NULL, '2025-05-18 08:00:22', NULL),
(67, 'hythamCustom1', 22, 3, NULL, 70.000, NULL, 2.000, 470.00000000000000000000, 400.00000000000000000000, '2025-05-18', 1, 1, 'نسيت ابيعها يوم 18', '2025-05-21 09:44:17', NULL),
(70, '1هيثم', 22, 3, 10.000, 87.200, 10.000, 3.000, 840.00000000000000000000, 880.00000000000000000000, NULL, 1, 1, NULL, '2025-05-21 13:29:16', NULL);

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
  `policy` text DEFAULT NULL,
  `fav_icon` varchar(50) NOT NULL,
  `cost_price` enum('1','2') NOT NULL DEFAULT '1',
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

INSERT INTO `settings` (`id`, `app_name`, `description`, `footer_text`, `address`, `email`, `phone1`, `phone2`, `logo`, `policy`, `fav_icon`, `cost_price`, `mail_driver`, `from`, `to`, `host`, `port`, `encryption`, `username`, `password`, `maintenance_mode`, `created_at`, `updated_at`) VALUES
(1, 'روزا ستور للمفروشات', 'روزا ستور للمفروشات وصف', 'روزا ستور للمفروشات .. اختيارك الأمثل دائما', 'الدقهلية المنصوره السنبلاوين قريه برهمتوش', 'decoration-house@decoration-house.com', '01016493611', '01117903055', 'logo.png', '- البضائع المباعة لا ترد ولا تستبدل بعد 14 يومًا من الشراء.  <br>\r\n-  يجب تقديم أصل الفاتورة عند أي استفسار.', 'fav_icon.jpg', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-16 08:31:00');

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
(1, 'المخزن العام', '1', 'مخزن رئيسي للمكان', '2024-06-29 08:33:29', '2025-03-11 08:25:18'),
(2, 'مخزن الأسمنت', '0', NULL, '2024-06-29 08:33:49', '2024-06-29 08:33:49'),
(3, 'هاني', '1', NULL, '2024-07-12 11:51:17', '2024-07-12 11:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `store_dets`
--

CREATE TABLE `store_dets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `num_order` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `year_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sell_price_small_unit` decimal(30,20) DEFAULT NULL,
  `last_cost_price_small_unit` decimal(30,20) DEFAULT NULL,
  `avg_cost_price_small_unit` decimal(30,20) DEFAULT NULL,
  `product_bill_quantity` decimal(10,3) DEFAULT NULL,
  `quantity_small_unit` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tax` decimal(10,3) DEFAULT NULL,
  `discount` decimal(10,3) DEFAULT NULL,
  `bonus` decimal(10,3) DEFAULT NULL,
  `total_before` decimal(30,20) NOT NULL,
  `total_after` decimal(30,20) NOT NULL,
  `return_quantity` decimal(10,3) NOT NULL,
  `transfer_from` int(5) DEFAULT NULL,
  `transfer_to` int(5) DEFAULT NULL,
  `transfer_quantity` decimal(10,3) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_dets`
--

INSERT INTO `store_dets` (`id`, `num_order`, `type`, `year_id`, `bill_id`, `product_id`, `sell_price_small_unit`, `last_cost_price_small_unit`, `avg_cost_price_small_unit`, `product_bill_quantity`, `quantity_small_unit`, `tax`, `discount`, `bonus`, `total_before`, `total_after`, `return_quantity`, `transfer_from`, `transfer_to`, `transfer_quantity`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 'رصيد اول مدة للصنف', 1, 0, 3, 130.00000000000000000000, 120.00000000000000000000, 120.00000000000000000000, NULL, 30.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-04-25', '2025-04-24 19:24:40', '2025-04-25 03:18:37'),
(2, 2, 'رصيد اول مدة للصنف', 1, 0, 4, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-04-25', '2025-04-24 19:27:02', '2025-04-25 03:38:22'),
(3, 3, 'رصيد اول مدة للصنف', 1, 0, 5, 30.00000000000000000000, NULL, NULL, NULL, 15.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-04-25', '2025-04-24 19:28:46', '2025-04-25 03:38:07'),
(4, 4, 'رصيد اول مدة للصنف', 1, 0, 6, 45.00000000000000000000, NULL, NULL, NULL, 4.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-04-24', '2025-04-24 19:29:17', NULL),
(5, 4, 'رصيد اول مدة للصنف مكرر', 1, 0, 6, 45.00000000000000000000, NULL, NULL, NULL, 8.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-04-24', '2025-04-24 19:29:17', NULL),
(6, 5, 'رصيد اول مدة للصنف', 1, 0, 7, 77.00000000000000000000, 66.00000000000000000000, 66.00000000000000000000, NULL, 40.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-04-25', '2025-04-24 20:03:18', '2025-04-25 03:19:07'),
(7, 6, 'رصيد اول مدة للصنف', 1, 0, 8, 60.66000000000000000000, 50.55000000000000000000, 50.55000000000000000000, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-04-29', '2025-04-29 13:10:59', NULL),
(8, 7, 'رصيد اول مدة للصنف', 1, 0, 9, NULL, NULL, NULL, NULL, 10.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 12:26:17', NULL),
(9, 8, 'رصيد اول مدة للصنف', 1, 0, 10, NULL, NULL, NULL, NULL, 24.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:07:40', NULL),
(10, 9, 'رصيد اول مدة للصنف', 1, 0, 11, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:09:41', NULL),
(11, 10, 'رصيد اول مدة للصنف', 1, 0, 12, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:10:05', NULL),
(12, 11, 'رصيد اول مدة للصنف', 1, 0, 13, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:10:09', NULL),
(13, 12, 'رصيد اول مدة للصنف', 1, 0, 14, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:10:45', NULL),
(14, 13, 'رصيد اول مدة للصنف', 1, 0, 15, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:11:03', NULL),
(15, 14, 'رصيد اول مدة للصنف', 1, 0, 16, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:11:09', NULL),
(16, 15, 'رصيد اول مدة للصنف', 1, 0, 17, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:11:28', NULL),
(17, 16, 'رصيد اول مدة للصنف', 1, 0, 18, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:11:35', '2025-05-01 16:12:57'),
(18, 17, 'رصيد اول مدة للصنف', 1, 0, 19, 32.00000000000000000000, 29.00000000000000000000, 29.00000000000000000000, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:12:07', NULL),
(19, 18, 'رصيد اول مدة للصنف', 1, 0, 20, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:12:17', NULL),
(20, 19, 'رصيد اول مدة للصنف', 1, 0, 21, NULL, NULL, NULL, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-01', '2025-05-01 16:12:34', NULL),
(79, 20, 'رصيد اول مدة للصنف', 1, 0, 22, 90.00000000000000000000, 80.00000000000000000000, 80.00000000000000000000, NULL, 16.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-08', '2025-05-08 08:47:53', NULL),
(80, 21, 'رصيد اول مدة للصنف', 1, 0, 23, 70.00000000000000000000, 60.00000000000000000000, 60.00000000000000000000, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-08', '2025-05-08 08:52:37', NULL),
(122, 1, 'اضافة فاتورة مشتريات', 1, 76, 11, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 2.000, 0.000, 0.000, NULL, 40.00000000000000000000, 40.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-09 12:11:21', NULL),
(123, 1, 'اضافة فاتورة مشتريات', 1, 76, 15, 35.00000000000000000000, 33.00000000000000000000, 33.00000000000000000000, 2.000, 2.000, 0.000, 0.000, NULL, 66.00000000000000000000, 66.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-09 12:11:21', NULL),
(124, 1, 'اضافة فاتورة مشتريات', 1, 76, 23, 70.00000000000000000000, 60.00000000000000000000, 60.00000000000000000000, 7.000, 7.000, 0.000, 0.000, NULL, 420.00000000000000000000, 420.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-09 12:11:21', NULL),
(195, 1, 'اضافة فاتورة مبيعات', 1, 61, 22, 100.00000000000000000000, 80.00000000000000000000, 80.00000000000000000000, 2.000, 14.000, 0.000, 0.000, NULL, 200.00000000000000000000, 200.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-18 07:21:43', NULL),
(197, 2, 'اضافة فاتورة مبيعات', 1, 63, 22, 100.00000000000000000000, 80.00000000000000000000, 80.00000000000000000000, 3.000, 11.000, 0.000, 0.000, NULL, 300.00000000000000000000, 300.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-18 07:22:52', NULL),
(198, 3, 'اضافة فاتورة مبيعات', 1, 64, 23, 70.00000000000000000000, 60.00000000000000000000, 60.00000000000000000000, 3.000, 4.000, 0.000, 0.000, NULL, 210.00000000000000000000, 210.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-18 07:23:40', NULL),
(199, 4, 'اضافة فاتورة مبيعات', 1, 65, 22, 100.00000000000000000000, 80.00000000000000000000, 80.00000000000000000000, 5.000, 6.000, 0.000, 0.000, NULL, 500.00000000000000000000, 500.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-18 07:26:12', NULL),
(200, 5, 'اضافة فاتورة مبيعات', 1, 66, 5, 30.00000000000000000000, NULL, NULL, 1.000, 14.000, 0.000, 0.000, NULL, 30.00000000000000000000, 30.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-18 08:00:22', NULL),
(201, 5, 'اضافة فاتورة مبيعات', 1, 66, 6, 45.00000000000000000000, NULL, NULL, 1.000, 7.000, 0.000, 0.000, NULL, 45.00000000000000000000, 45.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-18 08:00:22', NULL),
(202, 5, 'اضافة فاتورة مبيعات', 1, 66, 22, 100.00000000000000000000, 80.00000000000000000000, 80.00000000000000000000, 1.000, 5.000, 0.000, 0.000, NULL, 100.00000000000000000000, 100.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-18 08:00:22', NULL),
(203, 22, 'رصيد اول مدة للصنف', 1, 0, 25, 105.00000000000000000000, 90.00000000000000000000, 90.00000000000000000000, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-21', '2025-05-21 09:33:25', '2025-05-21 09:34:48'),
(204, 23, 'رصيد اول مدة للصنف', 1, 0, 26, 110.00000000000000000000, 95.00000000000000000000, 95.00000000000000000000, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-21', '2025-05-21 09:35:11', NULL),
(205, 24, 'رصيد اول مدة للصنف', 1, 0, 27, 350.00000000000000000000, 300.00000000000000000000, 300.00000000000000000000, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-21', '2025-05-21 09:35:47', NULL),
(206, 25, 'رصيد اول مدة للصنف', 1, 0, 28, 180.00000000000000000000, 150.00000000000000000000, 150.00000000000000000000, NULL, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-21', '2025-05-21 09:37:06', NULL),
(207, 2, 'اضافة فاتورة مشتريات', 1, 77, 28, 180.00000000000000000000, 150.00000000000000000000, 150.00000000000000000000, 20.000, 20.000, 0.000, 0.000, NULL, 3000.00000000000000000000, 3000.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 09:39:03', NULL),
(208, 3, 'اضافة فاتورة مشتريات', 1, 78, 26, 110.00000000000000000000, 95.00000000000000000000, 95.00000000000000000000, 50.000, 50.000, 0.000, 0.000, NULL, 4750.00000000000000000000, 4750.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 09:41:33', NULL),
(209, 3, 'اضافة فاتورة مشتريات', 1, 78, 25, 105.00000000000000000000, 90.00000000000000000000, 90.00000000000000000000, 50.000, 50.000, 0.000, 0.000, NULL, 4500.00000000000000000000, 4500.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 09:41:33', NULL),
(210, 6, 'اضافة فاتورة مبيعات', 1, 67, 28, 180.00000000000000000000, 150.00000000000000000000, 150.00000000000000000000, 2.000, 18.000, 0.000, 0.000, NULL, 360.00000000000000000000, 360.00000000000000000000, 0.000, NULL, NULL, 0.000, '2025-05-18', '2025-05-21 09:44:17', NULL),
(211, 6, 'اضافة فاتورة مبيعات', 1, 67, 26, 110.00000000000000000000, 95.00000000000000000000, 95.00000000000000000000, 1.000, 49.000, 0.000, 0.000, NULL, 110.00000000000000000000, 110.00000000000000000000, 0.000, NULL, NULL, 0.000, '2025-05-18', '2025-05-21 09:44:17', NULL),
(213, 26, 'رصيد اول مدة للصنف', 1, 0, 29, 90.00000000000000000000, 80.00000000000000000000, 80.00000000000000000000, NULL, 23.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, NULL, '2025-05-21', '2025-05-21 10:25:37', NULL),
(217, 7, 'اضافة فاتورة مبيعات', 1, 70, 29, 90.00000000000000000000, 80.00000000000000000000, 80.00000000000000000000, 1.000, 22.000, 0.000, 10.000, NULL, 90.00000000000000000000, 81.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 13:29:16', NULL),
(218, 7, 'اضافة فاتورة مبيعات', 1, 70, 26, 110.00000000000000000000, 95.00000000000000000000, 95.00000000000000000000, 3.000, 46.000, 14.000, 0.000, NULL, 330.00000000000000000000, 376.20000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 13:29:16', NULL),
(219, 7, 'اضافة فاتورة مبيعات', 1, 70, 25, 105.00000000000000000000, 90.00000000000000000000, 90.00000000000000000000, 4.000, 46.000, 0.000, 0.000, NULL, 420.00000000000000000000, 420.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 13:29:16', NULL),
(221, 1, 'تسوية صنف', 1, 2, 29, 90.00000000000000000000, 80.00000000000000000000, 80.00000000000000000000, 0.000, 20.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 16:55:54', NULL),
(222, 2, 'تسوية صنف', 1, 3, 25, 105.00000000000000000000, 90.00000000000000000000, 90.00000000000000000000, 0.000, 50.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 17:11:32', NULL),
(223, 3, 'تسوية صنف', 1, 4, 9, NULL, NULL, NULL, 0.000, 9.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 17:19:44', NULL),
(224, 4, 'تسوية صنف', 1, 5, 10, NULL, NULL, NULL, 0.000, 28.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 17:21:39', NULL),
(225, 5, 'تسوية صنف', 1, 6, 9, NULL, NULL, NULL, 0.000, 0.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 17:27:40', NULL),
(226, 6, 'تسوية صنف', 1, 7, 10, NULL, NULL, NULL, 0.000, 22.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 17:29:37', NULL),
(227, 7, 'تسوية صنف', 1, 8, 10, NULL, NULL, NULL, 0.000, 18.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 17:30:21', NULL),
(228, 8, 'تسوية صنف', 1, 9, 9, NULL, NULL, NULL, 0.000, 2.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 17:32:23', NULL),
(229, 9, 'تسوية صنف', 1, 10, 9, NULL, NULL, NULL, 0.000, 5.000, NULL, NULL, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.000, NULL, NULL, 0.000, NULL, '2025-05-21 17:33:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taswea_products`
--

CREATE TABLE `taswea_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `old_quantity` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `reason_id` int(11) NOT NULL,
  `user_id` int(5) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taswea_products`
--

INSERT INTO `taswea_products` (`id`, `product_id`, `old_quantity`, `quantity`, `reason_id`, `user_id`, `notes`, `year_id`, `created_at`, `updated_at`) VALUES
(2, 29, 22.00, 20.00, 4, 1, 'سرقه 2 كيس يوم 1-1-2025', 1, '2025-05-21 16:55:54', '2025-05-21 16:55:54'),
(3, 25, 46.00, 50.00, 3, 1, NULL, 1, '2025-05-21 17:11:32', '2025-05-21 17:11:32'),
(4, 9, 10.00, 9.00, 1, 1, NULL, 1, '2025-05-21 17:19:44', '2025-05-21 17:19:44'),
(5, 10, 24.00, 28.00, 3, 1, 'xxxxxx', 1, '2025-05-21 17:21:39', '2025-05-21 17:21:39'),
(6, 9, 9.00, 0.00, 1, 1, NULL, 1, '2025-05-21 17:27:40', '2025-05-21 17:27:40'),
(7, 10, 28.00, 22.00, 1, 1, NULL, 1, '2025-05-21 17:29:37', '2025-05-21 17:29:37'),
(8, 10, 22.00, 18.00, 1, 1, NULL, 1, '2025-05-21 17:30:21', '2025-05-21 17:30:21'),
(9, 9, 0.00, 2.00, 1, 1, NULL, 1, '2025-05-21 17:32:23', '2025-05-21 17:32:23'),
(10, 9, 2.00, 5.00, 1, 1, NULL, 1, '2025-05-21 17:33:35', '2025-05-21 17:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `taswea_reasons`
--

CREATE TABLE `taswea_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taswea_reasons`
--

INSERT INTO `taswea_reasons` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'تلف/هالك', NULL, NULL),
(2, 'عيب صناعة', NULL, NULL),
(3, 'زيادة غير مبررة', NULL, NULL),
(4, 'سرقة', NULL, NULL),
(5, 'انتهاء صلاحية', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `treasury_bill_dets`
--

CREATE TABLE `treasury_bill_dets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `num_order` int(11) NOT NULL,
  `date` date NOT NULL,
  `treasury_id` int(11) NOT NULL,
  `treasury_type` varchar(255) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `bill_type` varchar(255) NOT NULL,
  `client_supplier_id` int(11) NOT NULL,
  `treasury_money_after` decimal(15,2) NOT NULL DEFAULT 0.00,
  `amount_money` decimal(15,2) DEFAULT NULL,
  `remaining_money` decimal(15,2) NOT NULL,
  `transaction_from` decimal(15,2) DEFAULT NULL,
  `transaction_to` decimal(15,2) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treasury_bill_dets`
--

INSERT INTO `treasury_bill_dets` (`id`, `num_order`, `date`, `treasury_id`, `treasury_type`, `bill_id`, `bill_type`, `client_supplier_id`, `treasury_money_after`, `amount_money`, `remaining_money`, `transaction_from`, `transaction_to`, `notes`, `user_id`, `year_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-12', 1, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, 100000.00, 100000.00, 100000.00, NULL, NULL, 'تحت اشراف محمد فريد نجم لعام 2025', 1, 1, '2025-04-12 07:34:08', NULL),
(2, 2, '2025-04-12', 2, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, 0.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-04-12 07:41:45', NULL),
(3, 3, '2025-04-12', 3, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, 3000.00, 3000.00, 3000.00, NULL, NULL, NULL, 1, 1, '2025-04-12 07:41:58', NULL),
(4, 1, '2025-04-12', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 1, 0.00, 2000.00, 2000.00, NULL, NULL, NULL, 1, 1, '2025-04-12 07:48:03', NULL),
(5, 2, '2025-04-12', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 2, 0.00, -5000.00, -5000.00, NULL, NULL, NULL, 1, 1, '2025-04-12 07:48:49', NULL),
(6, 3, '2025-04-12', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 3, 0.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-04-12 07:49:32', NULL),
(7, 1, '2025-04-12', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 4, 0.00, -7000.00, -7000.00, NULL, NULL, NULL, 1, 1, '2025-04-12 07:52:11', NULL),
(8, 2, '2025-04-12', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 5, 0.00, 6000.00, 6000.00, NULL, NULL, NULL, 1, 1, '2025-04-12 07:52:21', NULL),
(10, 4, '2025-04-12', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 7, 0.00, -230.00, -230.00, NULL, NULL, NULL, 1, 1, '2025-04-12 07:53:11', NULL),
(11, 1, '2025-04-12', 1, 'اذن توريد نقدية', 0, '0', 1, 100800.00, 800.00, 1200.00, NULL, NULL, 'ملاحظه', 1, 1, '2025-04-12 08:24:40', NULL),
(12, 2, '2025-04-12', 1, 'اذن توريد نقدية', 0, '0', 1, 103000.00, 2200.00, -1000.00, NULL, NULL, NULL, 1, 1, '2025-04-12 08:25:43', NULL),
(13, 1, '2025-04-03', 1, 'اذن صرف نقدية', 0, '0', 4, 100000.00, 3000.00, -4000.00, NULL, NULL, 'تنزيل 3 الاف من امير', 1, 1, '2025-04-12 08:27:28', NULL),
(14, 2, '2025-04-12', 1, 'اذن صرف نقدية', 0, '0', 4, 95000.00, 5000.00, 1000.00, NULL, NULL, NULL, 1, 1, '2025-04-12 08:28:18', NULL),
(15, 3, '2025-04-12', 1, 'اذن صرف نقدية', 0, '0', 1, 94000.00, 1000.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-04-12 08:57:42', NULL),
(16, 1, '2025-04-12', 3, 'مصروف', 1, '0', 0, 2000.00, 1000.00, 2000.00, NULL, NULL, NULL, 1, 1, '2025-04-12 13:32:13', NULL),
(17, 2, '2025-04-12', 3, 'مصروف', 2, '0', 0, 0.00, 2000.00, 0.00, NULL, NULL, 'ملاحظه دفع ايجار محل اليماني', 1, 1, '2025-04-12 13:35:29', NULL),
(18, 3, '2025-04-12', 1, 'مصروف', 3, '0', 0, 92999.50, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-04-12 14:22:58', NULL),
(19, 1, '2025-04-12', 1, 'تحويل بين خزنتين', 0, '0', 0, 92000.00, 999.50, 92000.00, 1.00, 2.00, 'اول عملية تحويل بين خزنتين', 1, 1, '2025-04-12 15:25:55', NULL),
(20, 1, '2025-04-12', 2, 'تحويل بين خزنتين', 0, '0', 0, 999.50, 999.50, 999.50, 1.00, 2.00, 'اول عملية تحويل بين خزنتين', 1, 1, '2025-04-12 15:25:55', NULL),
(21, 2, '2025-04-12', 2, 'تحويل بين خزنتين', 0, '0', 0, 899.50, 100.00, 899.50, 2.00, 3.00, NULL, 1, 1, '2025-04-12 15:35:06', NULL),
(22, 2, '2025-04-12', 3, 'تحويل بين خزنتين', 0, '0', 0, 100.00, 100.00, 100.00, 2.00, 3.00, NULL, 1, 1, '2025-04-12 15:35:06', NULL),
(68, 1, '2025-05-09', 0, 'اضافة فاتورة مشتريات', 76, 'اضافة فاتورة مشتريات', 7, 0.00, NULL, -1076.00, NULL, NULL, NULL, 1, 1, '2025-05-09 12:11:21', NULL),
(69, 3, '2025-05-09', 1, 'اذن توريد نقدية', 0, '0', 1, 93100.00, 1100.00, -1100.00, NULL, NULL, NULL, 1, 1, '2025-05-09 16:48:48', NULL),
(70, 3, '2025-05-10', 1, 'تحويل بين خزنتين', 0, '0', 0, 93094.50, 5.50, 93094.50, 1.00, 2.00, NULL, 1, 1, '2025-05-10 08:41:48', NULL),
(71, 3, '2025-05-10', 2, 'تحويل بين خزنتين', 0, '0', 0, 905.00, 5.50, 905.00, 1.00, 2.00, NULL, 1, 1, '2025-05-10 08:41:48', NULL),
(72, 4, '2025-05-16', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 8, 0.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-16 14:23:45', NULL),
(97, 5, '2025-05-17', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 9, 0.00, 1000.00, 1000.00, NULL, NULL, NULL, 1, 1, '2025-05-17 09:10:41', NULL),
(116, 4, '2025-05-18', 3, 'اذن توريد نقدية', 61, 'اضافة فاتورة مبيعات', 9, 1600.00, 1500.00, -300.00, NULL, NULL, NULL, 1, 1, '2025-05-18 07:21:43', NULL),
(117, 1, '2025-05-18', 0, 'اضافة فاتورة مبيعات', 63, 'اضافة فاتورة مبيعات', 9, 0.00, NULL, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-18 07:22:52', NULL),
(118, 2, '2025-05-18', 0, 'اضافة فاتورة مبيعات', 64, 'اضافة فاتورة مبيعات', 9, 0.00, NULL, 200.00, NULL, NULL, NULL, 1, 1, '2025-05-18 07:23:40', NULL),
(119, 5, '2025-05-18', 3, 'اذن توريد نقدية', 65, 'اضافة فاتورة مبيعات', 8, 2150.00, 550.00, 0.00, NULL, NULL, '50 عربيه شحن من السنبلاوين', 1, 1, '2025-05-18 07:26:12', NULL),
(120, 6, '2025-05-18', 3, 'اذن توريد نقدية', 66, 'اضافة فاتورة مبيعات', 8, 2325.00, 175.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-18 08:00:22', NULL),
(123, 6, '2025-05-18', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 13, 0.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-18 15:59:41', NULL),
(124, 7, '2025-05-18', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 14, 0.00, -1200.00, -1200.00, NULL, NULL, NULL, 1, 1, '2025-05-18 16:00:24', NULL),
(125, 8, '2025-05-18', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 15, 0.00, 350.50, 350.50, NULL, NULL, NULL, 1, 1, '2025-05-18 16:02:34', NULL),
(130, 5, '2025-05-19', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 20, 0.00, -2500.00, -2500.00, NULL, NULL, NULL, 1, 1, '2025-05-19 08:53:12', NULL),
(132, 4, '2025-05-19', 1, 'اذن صرف نقدية', 0, '0', 8, 92094.50, 1000.00, 1000.00, NULL, NULL, 'اذن صرف فلوس للعميل لافتراضي 1000 جنيه', 1, 1, '2025-05-19 10:51:12', NULL),
(133, 5, '2025-05-19', 1, 'اذن صرف نقدية', 0, '0', 7, 91018.50, 1076.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-19 10:53:37', NULL),
(134, 6, '2025-05-19', 1, 'اذن صرف نقدية', 0, '0', 7, 90868.50, 150.00, 150.00, NULL, NULL, NULL, 1, 1, '2025-05-19 10:56:19', NULL),
(137, 4, '2025-05-20', 3, 'مصروف', 5, '0', 0, 2125.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-20 08:33:07', NULL),
(138, 1, '2025-05-20', 3, 'مرتجع مصروف', 5, '0', 0, 2325.00, 200.00, 2325.00, NULL, NULL, 'مرتجع مصروف من فاتورة رقم 5', 1, 1, '2025-05-20 08:34:19', NULL),
(139, 2, '2025-05-20', 1, 'مرتجع مصروف', 3, '0', 0, 91869.00, 1000.50, 91869.00, NULL, NULL, 'مرتجع مصروف من فاتورة رقم 3', 1, 1, '2025-05-20 09:37:14', NULL),
(140, 9, '2025-05-21', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 22, 0.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-21 09:28:39', NULL),
(141, 10, '2025-05-21', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 23, 0.00, 2000.00, 2000.00, NULL, NULL, NULL, 1, 1, '2025-05-21 09:29:21', NULL),
(142, 11, '2025-05-21', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 24, 0.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-21 09:29:34', NULL),
(143, 6, '2025-05-21', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 25, 0.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-21 09:38:30', NULL),
(144, 7, '2025-05-21', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 26, 0.00, 0.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-21 09:38:38', NULL),
(145, 2, '2025-05-21', 0, 'اضافة فاتورة مشتريات', 77, 'اضافة فاتورة مشتريات', 25, 0.00, NULL, -3000.00, NULL, NULL, NULL, 1, 1, '2025-05-21 09:39:03', NULL),
(146, 3, '2025-05-21', 0, 'اضافة فاتورة مشتريات', 78, 'اضافة فاتورة مشتريات', 25, 0.00, NULL, -12250.00, NULL, NULL, NULL, 1, 1, '2025-05-21 09:41:33', NULL),
(147, 7, '2025-05-21', 3, 'اذن توريد نقدية', 67, 'اضافة فاتورة مبيعات', 22, 2725.00, 400.00, 0.00, NULL, NULL, 'نسيت ابيعها يوم 18', 1, 1, '2025-05-21 09:44:17', NULL),
(149, 8, '2025-05-21', 3, 'اذن توريد نقدية', 0, '0', 23, 5025.00, 2300.00, 50.00, NULL, NULL, NULL, 1, 1, '2025-05-21 09:54:05', NULL),
(151, 9, '2025-05-21', 3, 'اذن توريد نقدية', 70, 'اضافة فاتورة مبيعات', 22, 5905.00, 880.00, 0.00, NULL, NULL, NULL, 1, 1, '2025-05-21 13:29:16', NULL);

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
(12, 'عععww', '2024-04-27 12:10:35', '2025-05-19 07:04:23'),
(13, 'aya unit', '2024-05-24 09:09:20', '2025-05-19 07:02:50'),
(14, 'كيس', '2025-05-21 09:32:22', '2025-05-21 09:32:22'),
(15, 'بياضه', '2025-05-21 09:32:30', '2025-05-21 09:32:30'),
(16, 'طقم انتريه', '2025-05-21 09:32:43', '2025-05-21 09:32:43'),
(17, 'ركنة', '2025-05-21 09:36:22', '2025-05-21 09:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_barcode` varchar(255) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `role` tinyint(4) NOT NULL,
  `theme` tinyint(4) NOT NULL DEFAULT 1,
  `address` varchar(255) DEFAULT NULL,
  `nat_id` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'df_image.png',
  `gender` varchar(10) NOT NULL DEFAULT 'ذكر',
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

INSERT INTO `users` (`id`, `name`, `email`, `password`, `login_barcode`, `phone`, `role`, `theme`, `address`, `nat_id`, `birth_date`, `image`, `gender`, `status`, `last_login_time`, `note`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'فريد نجم', 'farid@gmail.com', '$2y$10$3P02z1BASW2XAhJ59IDObOimzTd42yTafpx2D3Q0Duyy79hdJAgPe', NULL, '01000', 1, 1, 'Elnozha2 22', NULL, '2025-02-19', '1739973719.png', 'ذكر', 1, '2025-05-17 16:16:04', NULL, NULL, NULL, NULL, '2025-05-17 13:16:04'),
(2, 'Asmaa Negm', 'asmaa@gmail.com', '$2y$10$4jTJP/oP3HUdRUS5hEmH6e94eu7LKeOfMWjXJZBLLkFHAw4fvi4QW', NULL, NULL, 1, 1, NULL, NULL, NULL, 'df_image.png', 'انثي', 0, NULL, NULL, NULL, NULL, NULL, '2025-02-19 14:05:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients_and_suppliers`
--
ALTER TABLE `clients_and_suppliers`
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
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_bills_custom_bill_num_unique` (`custom_bill_num`);

--
-- Indexes for table `sale_bills`
--
ALTER TABLE `sale_bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_bills_custom_bill_num_unique` (`custom_bill_num`);

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
-- Indexes for table `taswea_products`
--
ALTER TABLE `taswea_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taswea_reasons`
--
ALTER TABLE `taswea_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treasury_bill_dets`
--
ALTER TABLE `treasury_bill_dets`
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
  ADD UNIQUE KEY `users_login_barcode_unique` (`login_barcode`),
  ADD UNIQUE KEY `users_nat_id_unique` (`nat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients_and_suppliers`
--
ALTER TABLE `clients_and_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_categoys`
--
ALTER TABLE `product_categoys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `sale_bills`
--
ALTER TABLE `sale_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `taswea_products`
--
ALTER TABLE `taswea_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `taswea_reasons`
--
ALTER TABLE `taswea_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `treasury_bill_dets`
--
ALTER TABLE `treasury_bill_dets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
