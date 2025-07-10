-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2025 at 05:21 PM
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
(1, 3, 1, 'عميل ماجد', NULL, NULL, NULL, 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-25 08:51:47', NULL),
(2, 3, 2, 'عميل فوزي', NULL, NULL, '01225262733', 'df_image.png', 'آجل', NULL, '8000', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-25 08:52:37', '2025-07-07 14:00:57'),
(3, 1, 1, 'مورد عشري', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-25 08:53:08', NULL),
(4, 1, 2, 'مورد سيد', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-25 08:53:15', NULL),
(5, 1, 3, 'مورد امير', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-25 08:53:24', NULL),
(6, 3, 3, 'مازن', NULL, NULL, NULL, 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-05 10:46:29', NULL),
(7, 3, 4, 'حمدي مرعي', NULL, 'المقطم كريم بنونه', '010000', 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-05 10:46:56', NULL),
(8, 3, 5, 'يوسف', NULL, NULL, '01000', 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-05 13:01:13', NULL),
(9, 3, 6, 'يس', NULL, NULL, NULL, 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-05 13:27:32', NULL),
(10, 3, 7, 'جني', NULL, NULL, NULL, 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-05 13:40:09', NULL);

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
(1, 'شركة الوايلي', '1', '2025-06-25 07:47:46', '2025-06-25 07:47:46'),
(2, 'شركه فينوس', '1', '2025-06-25 07:47:52', '2025-06-25 07:47:52'),
(3, 'شركة زمزم', '1', '2025-06-25 07:48:05', '2025-06-25 07:48:23');

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
(5, 4, 'سكر', '10', 'حذف', NULL, '2025-07-01 06:44:50', '2025-07-01 06:44:50'),
(6, 4, 'ايجار', '900', 'اضافة', NULL, '2025-07-01 07:35:10', '2025-07-01 07:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `extra_expenses`
--

CREATE TABLE `extra_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_expenses`
--

INSERT INTO `extra_expenses` (`id`, `expense_type`, `amount`, `notes`, `created_at`, `updated_at`) VALUES
(3, 'صيانه', 150.00, NULL, '2025-07-05 07:42:05', '2025-07-05 07:42:19'),
(4, 'توصيل منزلي', 100.00, NULL, '2025-07-05 07:42:54', '2025-07-05 07:42:54');

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
(1, 'خزينة رئيسيه ( الدرج )', NULL, 50000.00, '1', NULL, '2025-06-25 07:44:18', '2025-06-25 07:44:18'),
(2, 'خزينة فودافون كاش 1', NULL, 3000.00, '1', NULL, '2025-06-25 07:44:36', '2025-06-25 07:44:36'),
(4, 'انستاباي', NULL, 7900.00, '1', NULL, '2025-06-25 07:46:33', '2025-06-25 07:46:33');

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
(1, 'سنه 2025', '2025-05-22 00:00:00', '2025-05-31 00:00:00', '1', 'سنه ماليه رقم 1 بدايه من 2025', '2025-05-22 09:51:11', '2025-05-22 09:51:11');

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
(26, '2025_04_07_151511_create_purchase_bill_dets_table', 17),
(27, '2025_06_09_191936_create_roles_permissions_table', 18),
(28, '2025_07_05_013537_create_extra_expenses_table', 19),
(29, '2025_07_08_152054_create_receipts_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `first_money` decimal(30,20) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` tinyint(5) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `type` enum('سلعة','خدمي') NOT NULL DEFAULT 'سلعة',
  `nameAr` varchar(255) NOT NULL,
  `nameEn` varchar(255) DEFAULT NULL,
  `store` int(11) NOT NULL,
  `company` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `sub_category` int(11) DEFAULT NULL,
  `stockAlert` decimal(10,3) NOT NULL DEFAULT 0.000,
  `type_tax` enum('قيمة','نسبة') NOT NULL DEFAULT 'نسبة',
  `firstPeriodCount` decimal(10,3) NOT NULL DEFAULT 0.000,
  `bigUnit` int(11) DEFAULT NULL,
  `smallUnit` int(11) NOT NULL,
  `small_unit_numbers` decimal(10,3) NOT NULL DEFAULT 0.000,
  `prod_discount` decimal(10,3) NOT NULL DEFAULT 0.000,
  `prod_tax` decimal(10,3) NOT NULL DEFAULT 0.000,
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

INSERT INTO `products` (`id`, `shortCode`, `natCode`, `type`, `nameAr`, `nameEn`, `store`, `company`, `category`, `sub_category`, `stockAlert`, `type_tax`, `firstPeriodCount`, `bigUnit`, `smallUnit`, `small_unit_numbers`, `prod_discount`, `prod_tax`, `max_sale_quantity`, `status`, `image`, `desc`, `offerDiscountStatus`, `offerDiscountPercentage`, `offerStart`, `offerEnd`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'سلعة', 'بنادول', NULL, 1, NULL, NULL, NULL, 0.000, 'نسبة', 40.000, 0, 2, 3.000, 7.000, 12.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, 'سلعة', 'اوجمنتين 2 شريط', NULL, 3, 1, NULL, NULL, 0.000, 'نسبة', 11.000, 1, 1, 2.000, 5.000, 15.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-07-01 09:12:42'),
(3, NULL, NULL, 'سلعة', 'الفنتيرين', NULL, 3, 1, NULL, NULL, 0.000, 'نسبة', 15.000, 1, 2, 3.000, 18.000, 20.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-07-01 08:33:24'),
(4, NULL, NULL, 'سلعة', 'سيتال شراب', NULL, 1, NULL, NULL, NULL, 0.000, 'نسبة', 8.000, 0, 1, 1.000, 3.000, 11.500, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-07-01 08:31:57');

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
(1, 'أقراص', '2025-06-25 07:56:06', '2025-06-25 07:56:06'),
(3, 'حقن', '2025-06-25 07:56:13', '2025-06-25 07:56:13'),
(4, 'شراب', '2025-06-25 07:56:24', '2025-06-25 07:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` int(11) NOT NULL,
  `main_category` int(11) NOT NULL,
  `name_sub_category` varchar(100) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `main_category`, `name_sub_category`, `status`, `created_at`) VALUES
(1, 1, 'فيتامينات', 1, '2025-06-25 07:56:41'),
(2, 1, 'مضاد حيوي', 1, '2025-06-25 07:56:48'),
(3, 1, 'مسكن', 1, '2025-06-25 07:56:52'),
(4, 3, 'حقن مسكنه', 1, '2025-06-25 07:57:08'),
(5, 3, 'حقن للأعصاب', 1, '2025-06-25 07:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bills`
--

CREATE TABLE `purchase_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_bill_num` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `treasury_id` int(11) DEFAULT NULL,
  `bill_discount` decimal(10,3) DEFAULT NULL,
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
-- Dumping data for table `purchase_bills`
--

INSERT INTO `purchase_bills` (`id`, `custom_bill_num`, `supplier_id`, `treasury_id`, `bill_discount`, `count_items`, `total_bill_before`, `total_bill_after`, `custom_date`, `user_id`, `year_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, 3, NULL, NULL, 3.000, 934.00000000000000000000, 934.00000000000000000000, NULL, 1, 1, NULL, '2025-06-25 09:01:17', NULL),
(2, NULL, 4, NULL, NULL, 1.000, 440.00000000000000000000, 440.00000000000000000000, NULL, 1, 1, NULL, '2025-07-01 05:06:18', NULL),
(3, NULL, 4, NULL, NULL, 1.000, 360.00000000000000000000, 360.00000000000000000000, NULL, 1, 1, NULL, '2025-07-01 06:50:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_bills`
--

CREATE TABLE `purchase_return_bills` (
  `id` bigint(20) NOT NULL,
  `purchase_bill_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `bill_discount` decimal(10,3) DEFAULT NULL,
  `count_items` decimal(10,3) NOT NULL,
  `total_bill_before` decimal(30,20) NOT NULL,
  `total_bill_after` decimal(30,20) NOT NULL,
  `custom_date` date DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payer_type` varchar(50) NOT NULL,
  `payer_id` int(11) NOT NULL,
  `amount` decimal(30,20) NOT NULL,
  `amount_in_words` varchar(255) DEFAULT NULL COMMENT 'المبلغ بالحروف',
  `payment_type` enum('كاش','شيك') NOT NULL DEFAULT 'كاش',
  `cheque_number` varchar(255) DEFAULT NULL,
  `cheque_bank` varchar(255) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `receipt_date` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'تاريخ تحرير الإيصال',
  `status` enum('جاري التحصيل','تم التحصيل','ملغى') NOT NULL DEFAULT 'جاري التحصيل' COMMENT 'حالة الإيصال',
  `notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `payer_type`, `payer_id`, `amount`, `amount_in_words`, `payment_type`, `cheque_number`, `cheque_bank`, `cheque_date`, `receipt_date`, `status`, `notes`, `user_id`, `year_id`, `created_at`, `updated_at`) VALUES
(1, 'عميل', 2, 1000.00000000000000000000, NULL, 'كاش', NULL, NULL, NULL, NULL, 'ملغى', NULL, 1, 1, '2025-07-09 17:04:24', NULL),
(2, 'عميل', 2, 999.00000000000000000000, NULL, 'كاش', NULL, NULL, NULL, '2025-07-09 20:03:07', 'تم التحصيل', NULL, 1, 1, '2025-07-01 07:03:36', NULL),
(3, 'عميل', 10, 10.00000000000000000000, NULL, 'كاش', NULL, NULL, NULL, '2025-07-09 20:03:46', 'تم التحصيل', 'ملاااااااحظات', 1, 1, '2025-07-30 07:03:41', NULL),
(4, 'مورد', 4, 12.70000000000000000000, NULL, 'كاش', NULL, NULL, NULL, '2025-07-09 14:58:36', 'ملغى', NULL, 1, 1, '2025-07-21 07:03:44', NULL),
(5, 'عميل', 1, 800.00000000000000000000, NULL, 'كاش', NULL, NULL, NULL, NULL, 'تم التحصيل', NULL, 1, 1, '2025-07-09 08:53:59', NULL),
(13, 'عميل', 8, 99.00000000000000000000, NULL, 'كاش', NULL, NULL, NULL, '2025-07-09 12:30:35', 'تم التحصيل', NULL, 1, 1, '2025-07-09 09:29:43', NULL),
(14, 'عميل', 6, 8888.00000000000000000000, NULL, 'كاش', NULL, NULL, NULL, '2025-07-09 12:30:29', 'ملغى', 'notesssssssssssss', 1, 1, '2025-07-09 09:30:03', NULL),
(15, 'عميل', 2, 3528.75990000000000000000, NULL, 'كاش', NULL, NULL, NULL, '2025-07-10 09:55:57', 'تم التحصيل', NULL, 1, 1, '2025-07-10 04:53:31', NULL),
(16, 'عميل', 2, 0.00000000000000000000, NULL, 'كاش', NULL, NULL, NULL, '2025-07-10 15:19:43', 'ملغى', NULL, 1, 1, '2025-07-10 07:05:33', NULL),
(17, 'عميل', 10, 11.00000000000000000000, NULL, 'كاش', NULL, NULL, NULL, '2025-07-10 15:19:26', 'تم التحصيل', NULL, 1, 1, '2025-07-10 11:43:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `financialYears_create` tinyint(4) NOT NULL DEFAULT 0,
  `financialYears_update` tinyint(4) NOT NULL DEFAULT 0,
  `financialYears_view` tinyint(4) NOT NULL DEFAULT 0,
  `stores_create` tinyint(4) NOT NULL DEFAULT 0,
  `stores_update` tinyint(4) NOT NULL DEFAULT 0,
  `stores_view` tinyint(4) NOT NULL DEFAULT 0,
  `stores_delete` tinyint(4) NOT NULL DEFAULT 0,
  `financial_treasury_create` tinyint(4) NOT NULL DEFAULT 0,
  `financial_treasury_update` tinyint(4) NOT NULL DEFAULT 0,
  `financial_treasury_view` tinyint(4) NOT NULL DEFAULT 0,
  `financial_treasury_delete` tinyint(4) NOT NULL DEFAULT 0,
  `units_create` tinyint(4) NOT NULL DEFAULT 0,
  `units_update` tinyint(4) NOT NULL DEFAULT 0,
  `units_view` tinyint(4) NOT NULL DEFAULT 0,
  `units_delete` tinyint(4) NOT NULL DEFAULT 0,
  `companies_create` tinyint(4) NOT NULL DEFAULT 0,
  `companies_update` tinyint(4) NOT NULL DEFAULT 0,
  `companies_view` tinyint(4) NOT NULL DEFAULT 0,
  `companies_delete` tinyint(4) NOT NULL DEFAULT 0,
  `productsCategories_create` tinyint(4) NOT NULL DEFAULT 0,
  `productsCategories_update` tinyint(4) NOT NULL DEFAULT 0,
  `productsCategories_view` tinyint(4) NOT NULL DEFAULT 0,
  `productsCategories_delete` tinyint(4) NOT NULL DEFAULT 0,
  `products_sub_category_create` tinyint(4) NOT NULL DEFAULT 0,
  `products_sub_category_update` tinyint(4) NOT NULL DEFAULT 0,
  `products_sub_category_view` tinyint(4) NOT NULL DEFAULT 0,
  `products_sub_category_delete` tinyint(4) NOT NULL DEFAULT 0,
  `products_create` tinyint(4) NOT NULL DEFAULT 0,
  `products_update` tinyint(4) NOT NULL DEFAULT 0,
  `products_view` tinyint(4) NOT NULL DEFAULT 0,
  `products_delete` tinyint(4) NOT NULL DEFAULT 0,
  `products_report_view` tinyint(4) NOT NULL DEFAULT 0,
  `taswea_products_create` tinyint(4) NOT NULL DEFAULT 0,
  `taswea_products_view` tinyint(4) NOT NULL DEFAULT 0,
  `transfer_between_stores_create` tinyint(4) NOT NULL DEFAULT 0,
  `transfer_between_stores_view` tinyint(4) NOT NULL DEFAULT 0,
  `clients_create` tinyint(4) NOT NULL DEFAULT 0,
  `clients_update` tinyint(4) NOT NULL DEFAULT 0,
  `clients_view` tinyint(4) NOT NULL DEFAULT 0,
  `clients_delete` tinyint(4) NOT NULL DEFAULT 0,
  `clients_report_view` tinyint(4) NOT NULL DEFAULT 0,
  `clients_account_statement_view` tinyint(4) NOT NULL DEFAULT 0,
  `suppliers_create` tinyint(4) NOT NULL DEFAULT 0,
  `suppliers_update` tinyint(4) NOT NULL DEFAULT 0,
  `suppliers_view` tinyint(4) NOT NULL DEFAULT 0,
  `suppliers_delete` tinyint(4) NOT NULL DEFAULT 0,
  `suppliers_report_view` tinyint(4) NOT NULL DEFAULT 0,
  `suppliers_account_statement_view` tinyint(4) NOT NULL DEFAULT 0,
  `taswea_client_supplier_create` tinyint(4) NOT NULL DEFAULT 0,
  `taswea_client_supplier_view` tinyint(4) NOT NULL DEFAULT 0,
  `partners_create` tinyint(4) NOT NULL DEFAULT 0,
  `partners_update` tinyint(4) NOT NULL DEFAULT 0,
  `partners_view` tinyint(4) NOT NULL DEFAULT 0,
  `partners_delete` tinyint(4) NOT NULL DEFAULT 0,
  `partners_report_view` tinyint(4) NOT NULL DEFAULT 0,
  `partners_account_statement_view` tinyint(4) NOT NULL DEFAULT 0,
  `taswea_partners_create` tinyint(4) NOT NULL DEFAULT 0,
  `taswea_partners_view` tinyint(4) NOT NULL DEFAULT 0,
  `sales_create` tinyint(4) NOT NULL DEFAULT 0,
  `sales_return` tinyint(4) NOT NULL DEFAULT 0,
  `sales_view` tinyint(4) NOT NULL DEFAULT 0,
  `sales_return_view` tinyint(4) NOT NULL DEFAULT 0,
  `products_stock_alert_view` tinyint(4) NOT NULL DEFAULT 0,
  `purchases_create` tinyint(4) NOT NULL DEFAULT 0,
  `purchases_return` tinyint(4) NOT NULL DEFAULT 0,
  `purchases_view` tinyint(4) NOT NULL DEFAULT 0,
  `purchases_return_view` tinyint(4) NOT NULL DEFAULT 0,
  `treasury_bills_create` tinyint(4) NOT NULL DEFAULT 0,
  `treasury_bills_view` tinyint(4) NOT NULL DEFAULT 0,
  `treasury_bills_report_view` tinyint(4) NOT NULL DEFAULT 0,
  `transfer_between_storages_create` tinyint(4) NOT NULL DEFAULT 0,
  `transfer_between_storages_view` tinyint(4) NOT NULL DEFAULT 0,
  `expenses_create` tinyint(4) NOT NULL DEFAULT 0,
  `expenses_view` tinyint(4) NOT NULL DEFAULT 0,
  `expenses_delete` tinyint(4) NOT NULL DEFAULT 0,
  `expenses_report_view` tinyint(4) NOT NULL DEFAULT 0,
  `users_create` tinyint(4) NOT NULL DEFAULT 0,
  `users_update` tinyint(4) NOT NULL DEFAULT 0,
  `users_view` tinyint(4) NOT NULL DEFAULT 0,
  `users_delete` tinyint(4) NOT NULL DEFAULT 0,
  `settings_update` tinyint(4) NOT NULL DEFAULT 0,
  `settings_view` tinyint(4) NOT NULL DEFAULT 0,
  `roles_permissions_create` tinyint(4) NOT NULL DEFAULT 0,
  `roles_permissions_update` tinyint(4) NOT NULL DEFAULT 0,
  `roles_permissions_view` tinyint(4) NOT NULL DEFAULT 0,
  `roles_permissions_delete` tinyint(4) NOT NULL DEFAULT 0,
  `total_sell_bill_today_view` tinyint(4) NOT NULL DEFAULT 0,
  `total_profit_today_view` tinyint(4) NOT NULL DEFAULT 0,
  `total_money_on_financial_treasury_view` tinyint(4) NOT NULL DEFAULT 0,
  `top_products_view` tinyint(4) NOT NULL DEFAULT 0,
  `top_clients_view` tinyint(4) NOT NULL DEFAULT 0,
  `profit_view` tinyint(4) NOT NULL DEFAULT 0,
  `tax_bill_view` tinyint(4) NOT NULL DEFAULT 0,
  `discount_bill_view` tinyint(4) NOT NULL DEFAULT 0,
  `cost_price_view` tinyint(4) NOT NULL DEFAULT 0,
  `receipts_create` tinyint(4) NOT NULL DEFAULT 0,
  `receipts_update` tinyint(4) NOT NULL DEFAULT 0,
  `receipts_view` tinyint(4) NOT NULL DEFAULT 0,
  `receipts_delete` tinyint(4) NOT NULL DEFAULT 0,
  `receipts_take_money` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_name`, `financialYears_create`, `financialYears_update`, `financialYears_view`, `stores_create`, `stores_update`, `stores_view`, `stores_delete`, `financial_treasury_create`, `financial_treasury_update`, `financial_treasury_view`, `financial_treasury_delete`, `units_create`, `units_update`, `units_view`, `units_delete`, `companies_create`, `companies_update`, `companies_view`, `companies_delete`, `productsCategories_create`, `productsCategories_update`, `productsCategories_view`, `productsCategories_delete`, `products_sub_category_create`, `products_sub_category_update`, `products_sub_category_view`, `products_sub_category_delete`, `products_create`, `products_update`, `products_view`, `products_delete`, `products_report_view`, `taswea_products_create`, `taswea_products_view`, `transfer_between_stores_create`, `transfer_between_stores_view`, `clients_create`, `clients_update`, `clients_view`, `clients_delete`, `clients_report_view`, `clients_account_statement_view`, `suppliers_create`, `suppliers_update`, `suppliers_view`, `suppliers_delete`, `suppliers_report_view`, `suppliers_account_statement_view`, `taswea_client_supplier_create`, `taswea_client_supplier_view`, `partners_create`, `partners_update`, `partners_view`, `partners_delete`, `partners_report_view`, `partners_account_statement_view`, `taswea_partners_create`, `taswea_partners_view`, `sales_create`, `sales_return`, `sales_view`, `sales_return_view`, `products_stock_alert_view`, `purchases_create`, `purchases_return`, `purchases_view`, `purchases_return_view`, `treasury_bills_create`, `treasury_bills_view`, `treasury_bills_report_view`, `transfer_between_storages_create`, `transfer_between_storages_view`, `expenses_create`, `expenses_view`, `expenses_delete`, `expenses_report_view`, `users_create`, `users_update`, `users_view`, `users_delete`, `settings_update`, `settings_view`, `roles_permissions_create`, `roles_permissions_update`, `roles_permissions_view`, `roles_permissions_delete`, `total_sell_bill_today_view`, `total_profit_today_view`, `total_money_on_financial_treasury_view`, `top_products_view`, `top_clients_view`, `profit_view`, `tax_bill_view`, `discount_bill_view`, `cost_price_view`, `receipts_create`, `receipts_update`, `receipts_view`, `receipts_delete`, `receipts_take_money`, `created_at`, `updated_at`) VALUES
(1, 'سوبر ادمن', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 1, '2025-06-12 13:04:40', '2025-07-10 12:21:56'),
(2, 'موظف مبيعات', 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-06-13 12:49:53', '2025-06-30 09:24:17'),
(3, 'موظف مشتريات', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-06-13 12:50:10', '2025-06-13 12:50:10'),
(5, 'فففففففف', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-07-02 08:12:50', '2025-07-02 08:59:35'),
(6, 'llllllllllllllllllllllllll', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-07-06 09:40:50', '2025-07-06 09:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `sale_bills`
--

CREATE TABLE `sale_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_bill_num` varchar(255) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `treasury_id` int(11) DEFAULT NULL,
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

INSERT INTO `sale_bills` (`id`, `custom_bill_num`, `client_id`, `treasury_id`, `bill_discount`, `extra_money`, `count_items`, `total_bill_before`, `total_bill_after`, `custom_date`, `user_id`, `year_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, NULL, NULL, NULL, 2.000, 380.00000000000000000000, 380.00000000000000000000, NULL, 1, 1, NULL, '2025-06-25 13:10:27', NULL),
(2, NULL, 2, NULL, NULL, NULL, 1.000, 125.00000000000000000000, 125.00000000000000000000, NULL, 1, 1, NULL, '2025-06-25 15:22:12', NULL),
(3, NULL, 2, NULL, NULL, NULL, 2.000, 38.00000000000000000000, 38.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:12:22', NULL),
(4, NULL, 2, NULL, NULL, NULL, 2.000, 80.00000000000000000000, 80.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:13:37', NULL),
(5, NULL, 2, NULL, NULL, NULL, 2.000, 80.00000000000000000000, 80.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:14:32', NULL),
(6, NULL, 2, NULL, NULL, NULL, 2.000, 80.00000000000000000000, 80.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:14:39', NULL),
(7, NULL, 2, NULL, NULL, NULL, 2.000, 80.00000000000000000000, 80.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:14:51', NULL),
(8, NULL, 2, NULL, NULL, NULL, 2.000, 80.00000000000000000000, 80.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:15:09', NULL),
(11, NULL, 2, NULL, NULL, NULL, 2.000, 190.00000000000000000000, 190.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:26:16', NULL),
(12, NULL, 2, NULL, NULL, NULL, 2.000, 135.00000000000000000000, 135.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:27:01', NULL),
(14, NULL, 1, 1, NULL, NULL, 2.000, 380.00000000000000000000, 380.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 06:45:42', NULL),
(15, NULL, 2, NULL, 0.500, NULL, 3.000, 83.00000000000000000000, 80.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 08:20:34', NULL),
(16, NULL, 1, 1, NULL, NULL, 1.000, 500.00000000000000000000, 500.00000000000000000000, NULL, 1, 1, NULL, '2025-06-30 11:39:10', NULL),
(17, NULL, 2, NULL, NULL, NULL, 1.000, 360.00000000000000000000, 360.00000000000000000000, NULL, 1, 1, NULL, '2025-07-01 06:39:12', NULL),
(18, NULL, 2, NULL, NULL, NULL, 1.000, 260.00000000000000000000, 260.00000000000000000000, NULL, 1, 1, NULL, '2025-07-01 06:50:58', NULL),
(19, NULL, 2, NULL, 10.000, NULL, 2.000, 345.00000000000000000000, 335.00000000000000000000, NULL, 1, 1, NULL, '2025-07-01 06:56:36', NULL),
(20, NULL, 1, 1, NULL, NULL, 1.000, 280.00000000000000000000, 275.52000000000000000000, NULL, 1, 1, NULL, '2025-07-02 11:26:52', NULL),
(21, NULL, 7, NULL, NULL, NULL, 1.000, 11.00000000000000000000, 11.45760000000000000000, NULL, 1, 1, NULL, '2025-07-05 13:31:44', NULL),
(22, NULL, 10, 1, NULL, 100.000, 2.000, 65.00000000000000000000, 165.00000000000000000000, NULL, 1, 1, NULL, '2025-07-05 13:41:23', NULL),
(23, NULL, 10, 1, NULL, 100.000, 1.000, 35.00000000000000000000, 134.18800000000000000000, NULL, 1, 1, NULL, '2025-07-05 13:44:46', NULL),
(24, NULL, 2, NULL, NULL, NULL, 1.000, 35.00000000000000000000, 34.44000000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:30:37', NULL),
(25, NULL, 2, NULL, NULL, NULL, 1.000, 35.00000000000000000000, 34.44000000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:30:45', NULL),
(26, NULL, 2, NULL, NULL, NULL, 1.000, 30.00000000000000000000, 32.44650000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:33:47', NULL),
(27, NULL, 2, NULL, NULL, NULL, 1.000, 30.00000000000000000000, 32.44650000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:37:15', NULL),
(28, NULL, 2, NULL, NULL, NULL, 1.000, 30.00000000000000000000, 32.44650000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:37:27', NULL),
(29, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:40:14', NULL),
(30, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:41:47', NULL),
(31, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:41:51', NULL),
(32, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:41:55', NULL),
(33, NULL, 2, NULL, NULL, NULL, 1.000, 30.00000000000000000000, 32.44650000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:42:28', NULL),
(34, NULL, 2, NULL, NULL, NULL, 1.000, 30.00000000000000000000, 32.44650000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:43:43', NULL),
(35, NULL, 2, NULL, NULL, NULL, 1.000, 30.00000000000000000000, 32.44650000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:43:54', NULL),
(36, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:46:23', NULL),
(37, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:48:24', NULL),
(38, NULL, 2, NULL, NULL, NULL, 1.000, 30.00000000000000000000, 32.44650000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:49:12', NULL),
(39, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:49:40', NULL),
(40, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:52:04', NULL),
(41, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:54:47', NULL),
(42, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 08:57:20', NULL),
(43, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 09:05:54', NULL),
(44, NULL, 2, NULL, NULL, NULL, 1.000, 130.00000000000000000000, 142.02500000000000000000, NULL, 1, 1, NULL, '2025-07-08 09:08:26', NULL),
(45, NULL, 2, NULL, NULL, NULL, 1.000, 11.00000000000000000000, 11.45760000000000000000, NULL, 1, 1, NULL, '2025-07-08 09:10:52', NULL),
(46, NULL, 2, NULL, NULL, NULL, 1.000, 11.00000000000000000000, 11.45760000000000000000, NULL, 1, 1, NULL, '2025-07-08 09:14:01', NULL),
(47, NULL, 2, NULL, NULL, NULL, 1.000, 11.00000000000000000000, 11.45760000000000000000, NULL, 1, 1, NULL, '2025-07-08 09:17:52', NULL),
(48, NULL, 2, NULL, 0.458, NULL, 1.000, 11.00000000000000000000, 11.00000000000000000000, NULL, 1, 1, NULL, '2025-07-08 09:21:12', NULL),
(49, NULL, 2, NULL, NULL, NULL, 1.000, 11.00000000000000000000, 11.45760000000000000000, NULL, 1, 1, NULL, '2025-07-08 09:21:58', NULL),
(50, NULL, 2, NULL, NULL, NULL, 1.000, 15.00000000000000000000, 15.62400000000000000000, NULL, 1, 1, NULL, '2025-07-09 08:28:13', NULL),
(51, NULL, 2, NULL, NULL, NULL, 1.000, 11.00000000000000000000, 11.45760000000000000000, NULL, 1, 1, NULL, '2025-07-10 12:32:19', NULL),
(52, NULL, 10, 1, 0.915, NULL, 1.000, 22.00000000000000000000, 22.00000000000000000000, NULL, 1, 1, NULL, '2025-07-10 12:33:07', NULL);

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
  `cost_price` enum('1','2') NOT NULL DEFAULT '1' COMMENT 'القيمه 1 تعني اخر سعر تكلفة\r\nالقيمه 2 تعني متوسط سعر تكلفة',
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
(1, 'ديكوراشين هاوس', 'ديكوراشين هاوس وصف', 'ديكوراشين هاوس .. اختيارك الأمثل دائما', '33 عبدالحميد عوض متفرعمن مكرم عبيد - خلف محجوب - مدينه نصر', 'decoration-house@decoration-house.com', '01016493611', '01117903055', 'logo.png', '- البضائع المباعة لا ترد ولا تستبدل بعد 14 يومًا من الشراء.  <br>\r\n-  يجب تقديم أصل الفاتورة عند أي استفسار.الاستبدال والاسترجاع خلال 14 يوم من تاريخ استلام المنتج\r\n- لا يجوز استبدال او استرجاع المنتج إذا لم يكن المنتج في نفس حالة وقت البيع\r\n- لا يجوز استبدال او استرجاع المنتج الذي تم تصنيعه خصيصًا للعميل\r\n- ضمان 3 سنوات على جميع منتجاتنا\r\n- الضمان شامل الكهرباء واللون فقط\r\n- صيانة المنتج من خلال مقرنا فقط\r\n- استرجاع او استبدال المنتج من خلال مقرنا فقط وذلك للتأكد من صحة المنتج', 'fav_icon.png', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-07 09:27:58');

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
(1, 'مخزن رئيسي ( المعرض )', '1', 'خاص ب المعرض كمخزن رئيسي', '2025-06-25 07:33:55', '2025-06-25 07:33:55'),
(3, 'مخزن فرعي ( الشيخ زايد اكتوبر )', '1', NULL, '2025-06-25 07:35:02', '2025-06-25 07:35:02');

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
  `current_sell_price_in_sale_bill` decimal(30,20) DEFAULT NULL COMMENT 'خاص بسعر بيع المنتج في فاتوره البيع بحيث لو العميل اراد تغيير سعر البيع فلا يؤثر علي اخر سعر تم تسجيله ف فاتوره المشتريات لهذا الصنف',
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

INSERT INTO `store_dets` (`id`, `num_order`, `type`, `year_id`, `bill_id`, `product_id`, `current_sell_price_in_sale_bill`, `sell_price_small_unit`, `last_cost_price_small_unit`, `avg_cost_price_small_unit`, `product_bill_quantity`, `quantity_small_unit`, `tax`, `discount`, `bonus`, `total_before`, `total_after`, `transfer_from`, `transfer_to`, `transfer_quantity`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 'رصيد اول مدة للسلعة/خدمة', 1, 0, 1, NULL, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, NULL, 40.000, 0.000, 7.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-01', '2025-07-01 04:43:03', NULL),
(2, 2, 'رصيد اول مدة للسلعة/خدمة', 1, 0, 2, NULL, 105.00000000000000000000, 100.00000000000000000000, 100.00000000000000000000, NULL, 11.000, 0.000, 8.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-01', '2025-07-01 04:43:52', NULL),
(3, 3, 'رصيد اول مدة للسلعة/خدمة', 1, 0, 3, NULL, 35.00000000000000000000, 31.00000000000000000000, 31.00000000000000000000, NULL, 15.000, 0.000, 9.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-01', '2025-07-01 04:44:18', NULL),
(4, 1, 'اضافة فاتورة مشتريات', 1, 2, 2, NULL, 120.00000000000000000000, 110.00000000000000000000, 102.66666666667000000000, 4.000, 15.000, 0.000, 0.000, NULL, 440.00000000000000000000, 440.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-01 05:06:18', NULL),
(5, 1, 'اضافة فاتورة مبيعات', 1, 17, 2, 120.00000000000000000000, 120.00000000000000000000, 110.00000000000000000000, 102.66666666667000000000, 3.000, 12.000, 0.000, 0.000, NULL, 360.00000000000000000000, 360.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-01 06:39:12', NULL),
(6, 2, 'اضافة فاتورة مشتريات', 1, 3, 2, NULL, 120.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 4.000, 16.000, 0.000, 0.000, NULL, 360.00000000000000000000, 360.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-01 06:50:00', NULL),
(7, 2, 'اضافة فاتورة مبيعات', 1, 18, 2, 130.00000000000000000000, 120.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 2.000, 14.000, 0.000, 0.000, NULL, 260.00000000000000000000, 260.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-01 06:50:58', NULL),
(8, 3, 'اضافة فاتورة مبيعات', 1, 19, 2, 120.00000000000000000000, 120.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 2.000, 12.000, 0.000, 0.000, NULL, 240.00000000000000000000, 240.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-01 06:56:36', NULL),
(9, 3, 'اضافة فاتورة مبيعات', 1, 19, 3, 35.00000000000000000000, 35.00000000000000000000, 31.00000000000000000000, 31.00000000000000000000, 3.000, 12.000, 0.000, 0.000, NULL, 105.00000000000000000000, 105.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-01 06:56:36', NULL),
(10, 4, 'رصيد اول مدة للسلعة/خدمة', 1, 0, 4, NULL, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, NULL, 8.000, 11.500, 3.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-01', '2025-07-01 08:17:50', '2025-07-01 08:31:57'),
(11, 1, 'تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة', 1, 0, 3, NULL, 35.00000000000000000000, 31.00000000000000000000, 31.00000000000000000000, NULL, 12.000, 20.000, 18.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-01', '2025-07-01 08:33:24', NULL),
(12, 2, 'تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة', 1, 0, 2, NULL, 120.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, NULL, 12.000, 13.000, 3.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-01', '2025-07-01 08:35:37', NULL),
(13, 3, 'تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة', 1, 0, 2, NULL, 120.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, NULL, 12.000, 15.000, 5.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-01', '2025-07-01 08:37:25', NULL),
(14, 4, 'تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة', 1, 0, 2, NULL, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, NULL, 12.000, 15.000, 5.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-01', '2025-07-01 09:12:42', NULL),
(15, 4, 'اضافة فاتورة مبيعات', 1, 20, 3, 35.00000000000000000000, 35.00000000000000000000, 31.00000000000000000000, 31.00000000000000000000, 8.000, 4.000, 20.000, 18.000, NULL, 280.00000000000000000000, 275.52000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-02 11:26:52', NULL),
(16, 5, 'اضافة فاتورة مبيعات', 1, 21, 1, 11.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 1.000, 39.000, 12.000, 7.000, NULL, 11.00000000000000000000, 11.45760000000000000000, NULL, NULL, 0.000, NULL, '2025-07-05 13:31:45', NULL),
(17, 6, 'اضافة فاتورة مبيعات', 1, 22, 3, 35.00000000000000000000, 35.00000000000000000000, 31.00000000000000000000, 31.00000000000000000000, 1.000, 3.000, NULL, NULL, NULL, 35.00000000000000000000, 35.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-05 13:41:23', NULL),
(18, 6, 'اضافة فاتورة مبيعات', 1, 22, 4, 30.00000000000000000000, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, 1.000, 7.000, NULL, NULL, NULL, 30.00000000000000000000, 30.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-05 13:41:23', NULL),
(19, 7, 'اضافة فاتورة مبيعات', 1, 23, 3, 35.00000000000000000000, 35.00000000000000000000, 31.00000000000000000000, 31.00000000000000000000, 1.000, 2.000, 20.000, 18.600, NULL, 35.00000000000000000000, 34.18800000000000000000, NULL, NULL, 0.000, NULL, '2025-07-05 13:44:46', NULL),
(20, 8, 'اضافة فاتورة مبيعات', 1, 24, 3, 35.00000000000000000000, 35.00000000000000000000, 31.00000000000000000000, 31.00000000000000000000, 1.000, 1.000, 20.000, 18.000, NULL, 35.00000000000000000000, 34.44000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:30:37', NULL),
(21, 9, 'اضافة فاتورة مبيعات', 1, 25, 3, 35.00000000000000000000, 35.00000000000000000000, 31.00000000000000000000, 31.00000000000000000000, 1.000, 0.000, 20.000, 18.000, NULL, 35.00000000000000000000, 34.44000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:30:45', NULL),
(22, 10, 'اضافة فاتورة مبيعات', 1, 26, 4, 30.00000000000000000000, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, 1.000, 6.000, 11.500, 3.000, NULL, 30.00000000000000000000, 32.44650000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:33:47', NULL),
(23, 11, 'اضافة فاتورة مبيعات', 1, 27, 4, 30.00000000000000000000, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, 1.000, 5.000, 11.500, 3.000, NULL, 30.00000000000000000000, 32.44650000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:37:15', NULL),
(24, 12, 'اضافة فاتورة مبيعات', 1, 28, 4, 30.00000000000000000000, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, 1.000, 4.000, 11.500, 3.000, NULL, 30.00000000000000000000, 32.44650000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:37:27', NULL),
(25, 13, 'اضافة فاتورة مبيعات', 1, 29, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 11.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:40:14', NULL),
(26, 14, 'اضافة فاتورة مبيعات', 1, 30, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 10.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:41:47', NULL),
(27, 15, 'اضافة فاتورة مبيعات', 1, 31, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 9.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:41:51', NULL),
(28, 16, 'اضافة فاتورة مبيعات', 1, 32, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 8.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:41:55', NULL),
(29, 17, 'اضافة فاتورة مبيعات', 1, 33, 4, 30.00000000000000000000, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, 1.000, 3.000, 11.500, 3.000, NULL, 30.00000000000000000000, 32.44650000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:42:28', NULL),
(30, 18, 'اضافة فاتورة مبيعات', 1, 34, 4, 30.00000000000000000000, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, 1.000, 2.000, 11.500, 3.000, NULL, 30.00000000000000000000, 32.44650000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:43:43', NULL),
(31, 19, 'اضافة فاتورة مبيعات', 1, 35, 4, 30.00000000000000000000, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, 1.000, 1.000, 11.500, 3.000, NULL, 30.00000000000000000000, 32.44650000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:43:54', NULL),
(32, 20, 'اضافة فاتورة مبيعات', 1, 36, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 7.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:46:23', NULL),
(33, 21, 'اضافة فاتورة مبيعات', 1, 37, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 6.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:48:24', NULL),
(34, 22, 'اضافة فاتورة مبيعات', 1, 38, 4, 30.00000000000000000000, 30.00000000000000000000, 26.00000000000000000000, 26.00000000000000000000, 1.000, 0.000, 11.500, 3.000, NULL, 30.00000000000000000000, 32.44650000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:49:12', NULL),
(35, 23, 'اضافة فاتورة مبيعات', 1, 39, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 5.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:49:40', NULL),
(36, 24, 'اضافة فاتورة مبيعات', 1, 40, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 4.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:52:04', NULL),
(37, 25, 'اضافة فاتورة مبيعات', 1, 41, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 3.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:54:47', NULL),
(38, 26, 'اضافة فاتورة مبيعات', 1, 42, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 2.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 08:57:20', NULL),
(39, 27, 'اضافة فاتورة مبيعات', 1, 43, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 1.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 09:05:54', NULL),
(40, 28, 'اضافة فاتورة مبيعات', 1, 44, 2, 130.00000000000000000000, 130.00000000000000000000, 90.00000000000000000000, 99.50000000000300000000, 1.000, 0.000, 15.000, 5.000, NULL, 130.00000000000000000000, 142.02500000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 09:08:26', NULL),
(41, 29, 'اضافة فاتورة مبيعات', 1, 45, 1, 11.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 1.000, 38.000, 12.000, 7.000, NULL, 11.00000000000000000000, 11.45760000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 09:10:52', NULL),
(42, 30, 'اضافة فاتورة مبيعات', 1, 46, 1, 11.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 1.000, 37.000, 12.000, 7.000, NULL, 11.00000000000000000000, 11.45760000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 09:14:01', NULL),
(43, 31, 'اضافة فاتورة مبيعات', 1, 47, 1, 11.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 1.000, 36.000, 12.000, 7.000, NULL, 11.00000000000000000000, 11.45760000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 09:17:52', NULL),
(44, 32, 'اضافة فاتورة مبيعات', 1, 48, 1, 11.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 1.000, 35.000, 12.000, 7.000, NULL, 11.00000000000000000000, 11.45760000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 09:21:12', NULL),
(45, 33, 'اضافة فاتورة مبيعات', 1, 49, 1, 11.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 1.000, 34.000, 12.000, 7.000, NULL, 11.00000000000000000000, 11.45760000000000000000, NULL, NULL, 0.000, NULL, '2025-07-08 09:21:58', NULL),
(46, 34, 'اضافة فاتورة مبيعات', 1, 50, 1, 15.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 1.000, 33.000, 12.000, 7.000, NULL, 15.00000000000000000000, 15.62400000000000000000, NULL, NULL, 0.000, NULL, '2025-07-09 08:28:13', NULL),
(47, 35, 'اضافة فاتورة مبيعات', 1, 51, 1, 11.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 1.000, 32.000, 12.000, 7.000, NULL, 11.00000000000000000000, 11.45760000000000000000, NULL, NULL, 0.000, NULL, '2025-07-10 12:32:19', NULL),
(48, 36, 'اضافة فاتورة مبيعات', 1, 52, 1, 11.00000000000000000000, 11.00000000000000000000, 8.00000000000000000000, 8.00000000000000000000, 2.000, 30.000, 12.000, 7.000, NULL, 22.00000000000000000000, 22.91520000000000000000, NULL, NULL, 0.000, NULL, '2025-07-10 12:33:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taswea_client_supplier`
--

CREATE TABLE `taswea_client_supplier` (
  `id` bigint(20) NOT NULL,
  `client_supplier_id` int(11) NOT NULL,
  `old_money` decimal(30,20) NOT NULL,
  `new_money` decimal(30,20) NOT NULL,
  `reason_id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taswea_partners`
--

CREATE TABLE `taswea_partners` (
  `id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `old_money` decimal(30,20) NOT NULL,
  `new_money` decimal(30,20) NOT NULL,
  `reason_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `taswea_reasons_to_client_supplier`
--

CREATE TABLE `taswea_reasons_to_client_supplier` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taswea_reasons_to_client_supplier`
--

INSERT INTO `taswea_reasons_to_client_supplier` (`id`, `name`) VALUES
(1, 'رصيد افتتاحي خاطئ'),
(2, 'مرتجع لم يتم تسجيله'),
(3, 'خصم إضافي / خصم بالاتفاق'),
(4, 'عمولة / مكافأة'),
(5, 'مرتجع لم يتم تسجيله'),
(6, 'تسوية ضريبية'),
(7, 'غير ذلك');

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
  `partner_id` int(11) DEFAULT NULL,
  `treasury_money_after` decimal(30,20) NOT NULL DEFAULT 0.00000000000000000000,
  `amount_money` decimal(30,20) DEFAULT NULL,
  `remaining_money` decimal(30,20) NOT NULL,
  `commission_percentage` decimal(5,2) NOT NULL DEFAULT 0.00 COMMENT 'خاص بنسبه الشركاء ',
  `transaction_from` decimal(30,20) DEFAULT NULL,
  `transaction_to` decimal(30,20) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treasury_bill_dets`
--

INSERT INTO `treasury_bill_dets` (`id`, `num_order`, `date`, `treasury_id`, `treasury_type`, `bill_id`, `bill_type`, `client_supplier_id`, `partner_id`, `treasury_money_after`, `amount_money`, `remaining_money`, `commission_percentage`, `transaction_from`, `transaction_to`, `notes`, `user_id`, `year_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-06-25', 1, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 50000.00000000000000000000, 50000.00000000000000000000, 50000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-06-25 07:44:18', NULL),
(2, 2, '2025-06-25', 2, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 3000.00000000000000000000, 3000.00000000000000000000, 3000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-06-25 07:44:36', NULL),
(4, 3, '2025-06-25', 4, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 7900.00000000000000000000, 7900.00000000000000000000, 7900.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-06-25 07:46:33', NULL),
(5, 1, '2025-06-25', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 1, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-06-25 08:51:47', NULL),
(6, 2, '2025-06-25', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 2, NULL, 0.00000000000000000000, 1500.00000000000000000000, 1500.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-06-25 08:52:37', NULL),
(7, 1, '2025-06-25', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 3, NULL, 0.00000000000000000000, -4000.00000000000000000000, -4000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-06-25 08:53:08', NULL),
(8, 2, '2025-06-25', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 4, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-06-25 08:53:15', NULL),
(9, 3, '2025-06-25', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 5, NULL, 0.00000000000000000000, 2000.00000000000000000000, 2000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-06-25 08:53:24', NULL),
(31, 1, '2025-07-01', 0, 'اضافة فاتورة مشتريات', 2, 'اضافة فاتورة مشتريات', 4, NULL, 0.00000000000000000000, NULL, -440.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-01 05:06:18', NULL),
(32, 1, '2025-07-01', 0, 'اضافة فاتورة مبيعات', 17, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 1860.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-01 06:39:12', NULL),
(33, 1, '2025-07-01', 4, 'مصروف', 5, '0', 0, NULL, 7890.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-01 06:44:50', NULL),
(34, 1, '2025-07-01', 4, 'مرتجع مصروف', 5, '0', 0, NULL, 7900.00000000000000000000, 10.00000000000000000000, 7900.00000000000000000000, 0.00, NULL, NULL, 'مرتجع مصروف من فاتورة رقم 5', 1, 1, '2025-07-01 06:45:02', NULL),
(35, 2, '2025-07-01', 0, 'اضافة فاتورة مشتريات', 3, 'اضافة فاتورة مشتريات', 4, NULL, 0.00000000000000000000, NULL, -800.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-01 06:50:00', NULL),
(36, 2, '2025-07-01', 0, 'اضافة فاتورة مبيعات', 18, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2120.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-01 06:50:58', NULL),
(37, 3, '2025-07-01', 0, 'اضافة فاتورة مبيعات', 19, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2455.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-01 06:56:36', NULL),
(38, 2, '2025-07-01', 4, 'مصروف', 6, '0', 0, NULL, 7000.00000000000000000000, 900.00000000000000000000, 7000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-01 07:35:11', NULL),
(39, 1, '2025-07-02', 1, 'اذن توريد نقدية', 20, 'اضافة فاتورة مبيعات', 1, NULL, 50275.52000000000000000000, 275.52000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-02 11:26:52', NULL),
(40, 3, '2025-07-05', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 6, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-05 10:46:29', NULL),
(41, 4, '2025-07-05', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 7, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-05 10:46:56', NULL),
(42, 5, '2025-07-05', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 8, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-05 13:01:13', NULL),
(43, 6, '2025-07-05', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 9, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-05 13:27:32', NULL),
(44, 4, '2025-07-05', 0, 'اضافة فاتورة مبيعات', 21, 'اضافة فاتورة مبيعات', 7, NULL, 0.00000000000000000000, NULL, 11.45760000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-05 13:31:45', NULL),
(45, 7, '2025-07-05', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 10, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-05 13:40:09', NULL),
(46, 2, '2025-07-05', 1, 'اذن توريد نقدية', 22, 'اضافة فاتورة مبيعات', 10, NULL, 50440.52000000000000000000, 165.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-05 13:41:23', NULL),
(47, 3, '2025-07-05', 1, 'اذن توريد نقدية', 23, 'اضافة فاتورة مبيعات', 10, NULL, 50574.70800000000000000000, 134.18800000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-05 13:44:46', NULL),
(48, 5, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 24, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2489.44000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:30:37', NULL),
(49, 6, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 25, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2523.88000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:30:45', NULL),
(50, 7, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 26, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2556.32650000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:33:47', NULL),
(51, 8, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 27, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2588.77300000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:37:15', NULL),
(52, 9, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 28, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2621.21950000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:37:27', NULL),
(53, 10, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 29, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2763.24450000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:40:14', NULL),
(54, 11, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 30, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 2905.26950000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:41:47', NULL),
(55, 12, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 31, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3047.29450000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:41:51', NULL),
(56, 13, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 32, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3189.31950000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:41:55', NULL),
(57, 14, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 33, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3221.76600000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:42:28', NULL),
(58, 15, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 34, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3254.21250000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:43:43', NULL),
(59, 16, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 35, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3286.65900000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:43:54', NULL),
(60, 17, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 36, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3428.68400000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:46:23', NULL),
(61, 18, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 37, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3570.70900000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:48:24', NULL),
(62, 19, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 38, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3603.15550000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:49:12', NULL),
(63, 20, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 39, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3745.18050000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:49:40', NULL),
(64, 21, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 40, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 3887.20550000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:52:04', NULL),
(65, 22, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 41, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4029.23050000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:54:47', NULL),
(66, 23, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 42, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4171.25550000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 08:57:20', NULL),
(67, 24, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 43, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4313.28050000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 09:05:54', NULL),
(68, 25, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 44, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4455.30550000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 09:08:26', NULL),
(69, 26, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 45, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4466.76310000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 09:10:52', NULL),
(70, 27, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 46, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4478.22070000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 09:14:01', NULL),
(71, 28, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 47, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4489.67830000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 09:17:52', NULL),
(72, 29, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 48, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4500.67830000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 09:21:12', NULL),
(73, 30, '2025-07-08', 0, 'اضافة فاتورة مبيعات', 49, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4512.13590000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-08 09:21:58', NULL),
(74, 31, '2025-07-09', 0, 'اضافة فاتورة مبيعات', 50, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 4527.75990000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-09 08:28:13', NULL),
(76, 4, '2025-07-09', 4, 'اذن توريد نقدية', 0, '0', 2, NULL, 7999.00000000000000000000, 999.00000000000000000000, 3528.75990000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-09 17:03:07', NULL),
(77, 5, '2025-07-09', 4, 'اذن توريد نقدية', 0, '0', 10, NULL, 8009.00000000000000000000, 10.00000000000000000000, -10.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-09 17:03:46', NULL),
(78, 6, '2025-07-10', 4, 'اذن توريد نقدية', 0, '0', 2, NULL, 11537.75990000000000000000, 3528.75990000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-10 06:55:57', NULL),
(79, 7, '2025-07-10', 4, 'اذن توريد نقدية', 0, '0', 10, NULL, 11548.75990000000000000000, 11.00000000000000000000, -21.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-10 12:19:26', NULL),
(80, 32, '2025-07-10', 0, 'اضافة فاتورة مبيعات', 51, 'اضافة فاتورة مبيعات', 2, NULL, 0.00000000000000000000, NULL, 11.45760000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-10 12:32:19', NULL),
(81, 8, '2025-07-10', 1, 'اذن توريد نقدية', 52, 'اضافة فاتورة مبيعات', 10, NULL, 50596.70800000000000000000, 22.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-10 12:33:07', NULL);

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
(1, 'علبة', '2025-06-25 07:21:40', '2025-06-25 07:21:40'),
(2, 'شريط', '2025-06-25 07:21:45', '2025-06-25 07:21:45'),
(3, 'حقنة', '2025-06-25 07:21:52', '2025-06-25 07:21:52'),
(4, 'ماء مذيب للشراب', '2025-06-25 07:22:12', '2025-06-25 07:22:12'),
(5, 'ماء مذيب للحقن', '2025-06-25 07:22:18', '2025-06-25 07:22:18'),
(6, 'سرنجة', '2025-06-25 07:22:24', '2025-06-25 07:22:24');

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
(1, 'فريد نجم', 'farid@gmail.com', '$2y$10$3P02z1BASW2XAhJ59IDObOimzTd42yTafpx2D3Q0Duyy79hdJAgPe', NULL, '01000', 1, 1, 'Elnozha2 22', NULL, '2025-02-19', '1739973719.png', 'ذكر', 1, '2025-07-09 10:19:07', NULL, NULL, NULL, NULL, '2025-07-09 07:19:07'),
(2, 'Asmaa Negm', 'asmaa@gmail.com', '$2y$10$4jTJP/oP3HUdRUS5hEmH6e94eu7LKeOfMWjXJZBLLkFHAw4fvi4QW', NULL, NULL, 3, 1, NULL, NULL, NULL, '1749319463.jpeg', 'انثي', 0, NULL, NULL, NULL, NULL, NULL, '2025-06-13 12:55:15'),
(3, 'aaaaa', 'a@sd', '$2y$10$CVvWhLkNjtwTQrIFf.9vg.quhHQT/Ur5yxgwgQAjNXtXPdG2IKrfm', NULL, '111111', 1, 1, NULL, '111111', NULL, '1749319525.jpg', 'ذكر', 1, NULL, NULL, NULL, NULL, NULL, '2025-06-07 18:05:25');

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
-- Indexes for table `extra_expenses`
--
ALTER TABLE `extra_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `partners`
--
ALTER TABLE `partners`
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
  ADD UNIQUE KEY `products_nameen_unique` (`nameEn`),
  ADD KEY `shortCode` (`shortCode`),
  ADD KEY `natCode` (`natCode`);

--
-- Indexes for table `product_categoys`
--
ALTER TABLE `product_categoys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categoys_name_unique` (`name`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_bills_custom_bill_num_unique` (`custom_bill_num`);

--
-- Indexes for table `purchase_return_bills`
--
ALTER TABLE `purchase_return_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `taswea_client_supplier`
--
ALTER TABLE `taswea_client_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taswea_partners`
--
ALTER TABLE `taswea_partners`
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
-- Indexes for table `taswea_reasons_to_client_supplier`
--
ALTER TABLE `taswea_reasons_to_client_supplier`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clients_and_suppliers_types`
--
ALTER TABLE `clients_and_suppliers_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `extra_expenses`
--
ALTER TABLE `extra_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_treasuries`
--
ALTER TABLE `financial_treasuries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_categoys`
--
ALTER TABLE `product_categoys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_return_bills`
--
ALTER TABLE `purchase_return_bills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_bills`
--
ALTER TABLE `sale_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `taswea_client_supplier`
--
ALTER TABLE `taswea_client_supplier`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taswea_partners`
--
ALTER TABLE `taswea_partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taswea_products`
--
ALTER TABLE `taswea_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taswea_reasons`
--
ALTER TABLE `taswea_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taswea_reasons_to_client_supplier`
--
ALTER TABLE `taswea_reasons_to_client_supplier`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `treasury_bill_dets`
--
ALTER TABLE `treasury_bill_dets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
