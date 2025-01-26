-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 05:43 PM
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
(1, 3, 1, 'محمد مجدي', NULL, NULL, NULL, 'df_image.png', 'كاش', 'نعم', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-26 14:22:39', NULL),
(2, 3, 2, 'اسماء نجم', NULL, NULL, NULL, 'df_image.png', 'كاش', 'نعم', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-26 14:22:51', NULL),
(3, 3, 3, 'هاني الشربيني', NULL, NULL, NULL, '1737901399.jpg', 'كاش', 'نعم', '20000', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-26 14:23:19', NULL),
(4, 4, 4, 'رضا البيلي2222', 'reda@gmail.com2222', 'cairo el mokatem2222222', '01056892222', '1737901971.jpg', 'كاش', NULL, '1500', 1, '1222222', '22222222', '32222', '4222222', '52222', 'ملاحظات22222222222', '2025-01-26 14:28:50', '2025-01-26 14:32:51'),
(5, 1, 1, 'المتحده', NULL, NULL, '0100', 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-26 14:50:08', NULL),
(6, 1, 2, 'new sup2222', 'nesup@gmail.com22222', 'El nozha 141 st22222', '03212222', '1737904052.jpg', 'كاش', 'نعم', '3333333', 1, '133', '22333', '2333', '3333', '4333', 'El nozha 141 st ملاحظات', '2025-01-26 15:04:08', '2025-01-26 15:10:40');

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
(1, 0, 'رصيد اول عميل', 0, 0, 0, 1, '8000', 1, NULL, NULL, NULL),
(2, 0, 'رصيد اول عميل', 0, 0, 0, 2, '-15000', 1, NULL, NULL, NULL),
(3, 0, 'رصيد اول عميل', 0, 0, 0, 3, '0', 1, NULL, NULL, NULL),
(4, 0, 'رصيد اول عميل', 0, 0, 0, 4, '0', 1, 'ملاحظات', NULL, NULL),
(5, 0, 'رصيد اول مورد', 0, 0, 0, 5, '-1300', 1, NULL, NULL, NULL),
(6, 0, 'رصيد اول مورد', 0, 0, 0, 6, '9000', 1, 'El nozha 141 st ملاحظات', NULL, NULL),
(7, 0, 'رصيد اول خزنة', 0, 0, 0, 1, '400000', 1, NULL, '2025-01-08 15:35:15', NULL),
(8, 0, 'رصيد اول خزنة', 0, 0, 0, 2, '10200', 1, NULL, '2025-01-26 15:32:02', NULL);

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
  `userOne` varchar(50) DEFAULT NULL,
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
(1, 'خزينة رئيسيه', 'علي ايهااب', 400000, '1', 'تم فتح الخزينة الرئيسية', '2025-01-26 15:30:28', '2025-01-26 15:30:28'),
(2, 'فودافون كاش', NULL, 10200, '1', NULL, '2025-01-26 15:32:02', '2025-01-26 15:32:02');

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
  `smallUnitNumbers` varchar(255) DEFAULT NULL,
  `max_sale_quantity` varchar(4) NOT NULL DEFAULT '0',
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

INSERT INTO `products` (`id`, `shortCode`, `natCode`, `nameAr`, `nameEn`, `store`, `company`, `category`, `stockAlert`, `divisible`, `sellPrice`, `purchasePrice`, `discountPercentage`, `tax`, `firstPeriodCount`, `bigUnit`, `smallUnit`, `smallUnitPrice`, `smallUnitNumbers`, `max_sale_quantity`, `status`, `image`, `desc`, `offerDiscountStatus`, `offerDiscountPercentage`, `offerStart`, `offerEnd`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'بنادول اكسترا 3 شريط', NULL, 1, NULL, NULL, '0', '0', '90', '80', '0', '0', '0', 1, 2, '30', '3', '0', '1', 'df_image.png', NULL, '0', '', NULL, NULL, '2025-01-26 08:23:57', '2025-01-26 08:23:57'),
(2, NULL, NULL, 'الفنترن اقراص 3 شريط', NULL, 1, 1, 1, '0', '0', '150', '140', '0', '0', '0', 1, 2, '50', '3', '0', '1', 'df_image.png', NULL, '0', '', NULL, NULL, '2025-01-26 08:26:36', '2025-01-26 08:26:36'),
(3, NULL, NULL, 'ميوفين اقراص 22', 'myofen cap', 1, NULL, NULL, '0', '0', '45', '40', '0', '0', '0', 3, 2, '15', '3', '0', '1', 'df_image.png', NULL, '0', '', NULL, NULL, '2025-01-26 08:30:08', '2025-01-26 08:46:19'),
(4, NULL, NULL, 'جديد', 'neeeew', 2, 5, 3, '0', '0', '80', '70', '0', '0', '0', 1, 1, '10', NULL, '0', '1', 'df_image.png', NULL, '0', '', NULL, NULL, '2025-01-26 09:33:38', '2025-01-26 09:33:38');

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
  `transfer_from` int(3) DEFAULT NULL,
  `transfer_to` int(3) DEFAULT NULL,
  `transfer_quantity` decimal(7,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_dets`
--

INSERT INTO `store_dets` (`id`, `type`, `year_id`, `bill_head_id`, `bill_body_id`, `product_id`, `product_num_unit`, `quantity`, `quantity_all`, `product_sellPrice`, `product_purchasePrice`, `product_avg`, `transfer_from`, `transfer_to`, `transfer_quantity`, `date`, `created_at`, `updated_at`) VALUES
(1, 'رصيد اول', 1, 0, 0, 1, 0, '0', '0', '90', '80', '0', NULL, NULL, NULL, '2025-01-26', '2025-01-26 08:23:57', NULL),
(2, 'رصيد اول', 1, 0, 0, 2, 0, '0', '0', '150', '140', '0', NULL, NULL, NULL, '2025-01-26', '2025-01-26 08:26:36', NULL),
(3, 'رصيد اول', 1, 0, 0, 3, 0, '0', '0', '45', '40', '0', NULL, NULL, NULL, '2025-01-26', '2025-01-26 08:30:08', NULL),
(4, 'رصيد اول', 1, 0, 0, 4, 0, '0', '0', '80', '70', '0', NULL, NULL, NULL, '2025-01-26', '2025-01-26 09:33:38', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients_and_suppliers_dets`
--
ALTER TABLE `clients_and_suppliers_dets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
