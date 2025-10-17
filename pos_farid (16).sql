-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 10:09 AM
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
(1, 3, 1, 'عميل متنوع', NULL, NULL, '0000', 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:22:30', NULL),
(2, 3, 2, 'عميل علي ماهر', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:22:40', NULL),
(3, 3, 3, 'عميل احمد حسن', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:22:47', NULL),
(4, 1, 1, 'مورد متنوع', NULL, NULL, '0000', 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:23:04', NULL),
(5, 1, 2, 'عميل جرجس', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:23:10', NULL),
(6, 1, 3, 'عميل مرقص', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:23:16', NULL);

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
(1, 'خزينه الدرج المعرض', NULL, 100000.00, '1', NULL, '2025-08-28 15:20:34', '2025-08-28 15:20:34'),
(2, 'فودافون كاش', NULL, 8000.00, '1', NULL, '2025-08-28 15:20:42', '2025-08-28 15:20:42'),
(3, 'انستاباي', NULL, 0.00, '1', NULL, '2025-08-28 15:21:03', '2025-08-28 15:21:03');

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
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `close_date` timestamp NULL DEFAULT NULL,
  `supervisor_1` int(11) NOT NULL,
  `supervisor_2` int(11) DEFAULT NULL,
  `supervisor_3` int(11) DEFAULT NULL,
  `status` enum('جاري الجرد','تم الاعتماد','ملغي') NOT NULL DEFAULT 'جاري الجرد',
  `user_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `date`, `close_date`, `supervisor_1`, `supervisor_2`, `supervisor_3`, `status`, `user_id`, `year_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, '2025-08-28', '2025-08-30 13:21:46', 1, NULL, NULL, 'تم الاعتماد', 1, 1, NULL, '2025-08-28 19:01:25', '2025-08-28 19:01:25'),
(2, NULL, NULL, 1, NULL, NULL, 'جاري الجرد', 1, 1, NULL, '2025-08-30 14:50:13', '2025-08-30 14:50:13');

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
(29, '2025_07_08_152054_create_receipts_table', 20),
(30, '2025_07_11_135217_create_inventories_table', 21),
(31, '2025_07_11_135805_create_inventory_items_table', 22);

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
(1, 'q90', 'NAT001', 'سلعة', 'لمبة ليد 1  q90', NULL, 1, NULL, NULL, NULL, 3.000, 'نسبة', 86.000, NULL, 1, 1.000, 4.000, 10.000, 28.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52'),
(2, 'P002', 'NAT002', 'سلعة', 'لمبة ليد 2', 'لمبة ليد 2 EN', 1, NULL, NULL, NULL, 10.000, 'نسبة', 24.000, NULL, 1, 1.000, 0.000, 0.000, 1.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52'),
(3, 'P003', 'NAT003', 'سلعة', 'نجفة 3', 'نجفة 3 EN', 1, NULL, NULL, NULL, 6.000, 'نسبة', 33.000, NULL, 1, 2.000, 16.000, 14.000, 19.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52'),
(4, 'P004', 'NAT004', 'سلعة', 'أباجورة 4', 'أباجورة 4 EN', 1, NULL, NULL, NULL, 5.000, 'نسبة', 74.000, NULL, 1, 2.000, 16.000, 5.000, 45.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52'),
(5, 'P005', 'NAT005', 'سلعة', 'أباجورة 5', 'أباجورة 5 EN', 1, NULL, NULL, NULL, 9.000, 'نسبة', 44.000, NULL, 1, 5.000, 4.000, 10.000, 11.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52'),
(6, 'P006', 'NAT006', 'سلعة', 'نجفة 6', 'نجفة 6 EN', 1, NULL, NULL, NULL, 7.000, 'نسبة', 27.000, NULL, 1, 1.000, 2.000, 14.000, 8.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52'),
(7, 'P007', 'NAT007', 'سلعة', 'نجفة 7', 'نجفة 7 EN', 1, NULL, NULL, NULL, 8.000, 'نسبة', 57.000, NULL, 1, 2.000, 12.000, 14.000, 4.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52'),
(8, 'P008', 'NAT008', 'سلعة', 'أباجورة 8', 'أباجورة 8 EN', 1, NULL, NULL, NULL, 9.000, 'نسبة', 38.000, NULL, 1, 2.000, 13.000, 10.000, 2.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52'),
(9, 'P009', 'NAT009', 'سلعة', 'نجفة 9', 'نجفة 9 EN', 1, NULL, NULL, NULL, 8.000, 'نسبة', 22.000, NULL, 1, 2.000, 12.000, 0.000, 16.000, '1', 'df_image.png', NULL, NULL, NULL, NULL, NULL, '2025-08-28 15:21:52', '2025-08-28 15:21:52');

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

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bills`
--

CREATE TABLE `purchase_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('فاتورة نشطة','فاتورة ملغاة','فاتورة معلقة','فاتورة معدلة') NOT NULL DEFAULT 'فاتورة نشطة',
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
  `sales_view` tinyint(4) NOT NULL DEFAULT 0,
  `sales_bill_deleted_view` tinyint(4) NOT NULL DEFAULT 0,
  `sales_bill_return_view` tinyint(4) NOT NULL DEFAULT 0,
  `sales_bill_edited_view` tinyint(4) NOT NULL DEFAULT 0,
  `sales_summary_report_view` tinyint(4) DEFAULT 0,
  `products_stock_alert_view` tinyint(4) NOT NULL DEFAULT 0,
  `purchases_create` tinyint(4) NOT NULL DEFAULT 0,
  `purchases_view` tinyint(4) NOT NULL DEFAULT 0,
  `purchase_bill_deleted_view` tinyint(4) NOT NULL DEFAULT 0,
  `purchase_bill_return_view` tinyint(4) NOT NULL DEFAULT 0,
  `purchase_bill_edited_view` tinyint(4) NOT NULL DEFAULT 0,
  `treasury_bills_create` tinyint(4) NOT NULL DEFAULT 0,
  `treasury_bills_view` tinyint(4) NOT NULL DEFAULT 0,
  `treasury_bills_report_view` tinyint(4) NOT NULL DEFAULT 0,
  `transfer_between_storages_create` tinyint(4) NOT NULL DEFAULT 0,
  `transfer_between_storages_view` tinyint(4) NOT NULL DEFAULT 0,
  `expenses_create` tinyint(4) NOT NULL DEFAULT 0,
  `expenses_view` tinyint(4) NOT NULL DEFAULT 0,
  `expenses_delete` tinyint(4) NOT NULL DEFAULT 0,
  `expenses_report_view` tinyint(4) NOT NULL DEFAULT 0,
  `inventories_create` tinyint(4) NOT NULL DEFAULT 0,
  `inventories_update` tinyint(4) NOT NULL DEFAULT 0,
  `inventories_view` tinyint(4) NOT NULL DEFAULT 0,
  `inventories_delete` tinyint(4) NOT NULL DEFAULT 0,
  `inventories_print` tinyint(4) NOT NULL DEFAULT 0,
  `inventories_start` tinyint(4) NOT NULL DEFAULT 0,
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
  `sale_price_view` tinyint(4) NOT NULL DEFAULT 0,
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

INSERT INTO `roles_permissions` (`id`, `role_name`, `financialYears_create`, `financialYears_update`, `financialYears_view`, `stores_create`, `stores_update`, `stores_view`, `stores_delete`, `financial_treasury_create`, `financial_treasury_update`, `financial_treasury_view`, `financial_treasury_delete`, `units_create`, `units_update`, `units_view`, `units_delete`, `companies_create`, `companies_update`, `companies_view`, `companies_delete`, `productsCategories_create`, `productsCategories_update`, `productsCategories_view`, `productsCategories_delete`, `products_sub_category_create`, `products_sub_category_update`, `products_sub_category_view`, `products_sub_category_delete`, `products_create`, `products_update`, `products_view`, `products_delete`, `products_report_view`, `taswea_products_create`, `taswea_products_view`, `transfer_between_stores_create`, `transfer_between_stores_view`, `clients_create`, `clients_update`, `clients_view`, `clients_delete`, `clients_report_view`, `clients_account_statement_view`, `suppliers_create`, `suppliers_update`, `suppliers_view`, `suppliers_delete`, `suppliers_report_view`, `suppliers_account_statement_view`, `taswea_client_supplier_create`, `taswea_client_supplier_view`, `partners_create`, `partners_update`, `partners_view`, `partners_delete`, `partners_report_view`, `partners_account_statement_view`, `taswea_partners_create`, `taswea_partners_view`, `sales_create`, `sales_view`, `sales_bill_deleted_view`, `sales_bill_return_view`, `sales_bill_edited_view`, `sales_summary_report_view`, `products_stock_alert_view`, `purchases_create`, `purchases_view`, `purchase_bill_deleted_view`, `purchase_bill_return_view`, `purchase_bill_edited_view`, `treasury_bills_create`, `treasury_bills_view`, `treasury_bills_report_view`, `transfer_between_storages_create`, `transfer_between_storages_view`, `expenses_create`, `expenses_view`, `expenses_delete`, `expenses_report_view`, `inventories_create`, `inventories_update`, `inventories_view`, `inventories_delete`, `inventories_print`, `inventories_start`, `users_create`, `users_update`, `users_view`, `users_delete`, `settings_update`, `settings_view`, `roles_permissions_create`, `roles_permissions_update`, `roles_permissions_view`, `roles_permissions_delete`, `total_sell_bill_today_view`, `total_profit_today_view`, `total_money_on_financial_treasury_view`, `top_products_view`, `top_clients_view`, `profit_view`, `tax_bill_view`, `discount_bill_view`, `cost_price_view`, `sale_price_view`, `receipts_create`, `receipts_update`, `receipts_view`, `receipts_delete`, `receipts_take_money`, `created_at`, `updated_at`) VALUES
(1, 'سوبر ادمن', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2025-06-12 13:04:40', '2025-08-30 14:54:32'),
(2, 'موظف مبيعات', 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-06-13 12:49:53', '2025-06-30 09:24:17'),
(3, 'موظف مشتريات', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-06-13 12:50:10', '2025-06-13 12:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `sale_bills`
--

CREATE TABLE `sale_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_bill_num` varchar(255) DEFAULT NULL,
  `status` enum('فاتورة نشطة','فاتورة ملغاة','فاتورة معلقة','فاتورة معدلة') NOT NULL DEFAULT 'فاتورة نشطة',
  `client_id` int(11) NOT NULL,
  `treasury_id` int(11) DEFAULT NULL,
  `bill_discount` decimal(10,3) DEFAULT NULL,
  `extra_money` decimal(10,3) DEFAULT NULL,
  `extra_money_type` tinyint(5) DEFAULT NULL,
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

INSERT INTO `sale_bills` (`id`, `custom_bill_num`, `status`, `client_id`, `treasury_id`, `bill_discount`, `extra_money`, `extra_money_type`, `count_items`, `total_bill_before`, `total_bill_after`, `custom_date`, `user_id`, `year_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, 'فاتورة ملغاة', 1, NULL, 0.000, 0.000, 0, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-28 15:24:47', NULL),
(2, NULL, 'فاتورة نشطة', 3, 1, 0.216, 100.000, NULL, 1.000, 1410.00000000000000000000, 1350.00000000000000000000, NULL, 1, 1, NULL, '2025-08-28 19:12:48', '2025-08-28 19:13:47');

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
(1, 'ديكوراشين هاوس', 'ديكوراشين هاوس وصف', '\"يومي المحاسبي... شريكك الذكي في الإدارة المالية\"', '33 عبدالحميد عوض متفرع من مكرم عبيد - خلف محجوب - مدينه نصر', 'decoration-house@decoration-house.com', '01016493611', '01117903055', 'logo.png', '- البضائع المباعة لا ترد ولا تستبدل بعد 14 يومًا من الشراء.  <br>\r\n-  يجب تقديم أصل الفاتورة عند أي استفسار.الاستبدال والاسترجاع خلال 14 يوم من تاريخ استلام المنتج\r\n- لا يجوز استبدال او استرجاع المنتج إذا لم يكن المنتج في نفس حالة وقت البيع\r\n- لا يجوز استبدال او استرجاع المنتج الذي تم تصنيعه خصيصًا للعميل\r\n- ضمان 3 سنوات على جميع منتجاتنا\r\n- الضمان شامل الكهرباء واللون فقط\r\n- صيانة المنتج من خلال مقرنا فقط\r\n- استرجاع او استبدال المنتج من خلال مقرنا فقط وذلك للتأكد من صحة المنتج', 'fav_icon.png', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-28 20:20:02');

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
(1, 'مخزن رئيسي', '1', NULL, '2025-08-28 15:20:05', '2025-08-28 15:20:05'),
(2, 'مخزن فرعي', '1', NULL, '2025-08-28 15:20:11', '2025-08-28 15:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `store_dets`
--

CREATE TABLE `store_dets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `num_order` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` enum('نشط','تم تعديله','تم حذفه','مرتجع مشتريات','مرتجع مبيعات','فاتورة ملغاة','ناتج عن حذف مبيعات','ناتج عن مرتجع مبيعات','ناتج عن حذف مشتريات','ناتج عن مرتجع مشتريات') NOT NULL DEFAULT 'نشط' COMMENT 'خاص بحاله الصنف عند انشاء فاتوره يكون الصنف اول مره  نشط حالات اخري مثل تم تعديل مثل تعديل السعر او الخصم او تم حذفه عند حذف الصنف من الفاتوره ',
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
  `user_id` int(7) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_dets`
--

INSERT INTO `store_dets` (`id`, `num_order`, `type`, `status`, `year_id`, `bill_id`, `product_id`, `current_sell_price_in_sale_bill`, `sell_price_small_unit`, `last_cost_price_small_unit`, `avg_cost_price_small_unit`, `product_bill_quantity`, `quantity_small_unit`, `tax`, `discount`, `bonus`, `total_before`, `total_after`, `transfer_from`, `transfer_to`, `transfer_quantity`, `date`, `user_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 1, NULL, 554.00000000000000000000, 544.00000000000000000000, 544.00000000000000000000, NULL, 86.000, 10.000, 4.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(2, 2, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 2, NULL, 1568.00000000000000000000, 1556.00000000000000000000, 1556.00000000000000000000, NULL, 24.000, 0.000, 0.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(3, 3, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 3, NULL, 1410.00000000000000000000, 1398.00000000000000000000, 1398.00000000000000000000, NULL, 33.000, 14.000, 16.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(4, 4, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 4, NULL, 687.00000000000000000000, 657.00000000000000000000, 657.00000000000000000000, NULL, 74.000, 5.000, 16.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(5, 5, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 5, NULL, 1523.00000000000000000000, 1516.00000000000000000000, 1516.00000000000000000000, NULL, 44.000, 10.000, 4.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(6, 6, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 6, NULL, 956.00000000000000000000, 940.00000000000000000000, 940.00000000000000000000, NULL, 27.000, 14.000, 2.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(7, 7, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 7, NULL, 1120.00000000000000000000, 1087.00000000000000000000, 1087.00000000000000000000, NULL, 57.000, 14.000, 12.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(8, 8, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 8, NULL, 1616.00000000000000000000, 1598.00000000000000000000, 1598.00000000000000000000, NULL, 38.000, 10.000, 13.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(9, 9, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 9, NULL, 1110.00000000000000000000, 1071.00000000000000000000, 1071.00000000000000000000, NULL, 22.000, 0.000, 12.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-08-28', 1, 'تم إدراجه بواسطة ملف الإكسل', '2025-08-28 15:21:52', NULL),
(10, 1, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 1, 3, 1410.00000000000000000000, 1410.00000000000000000000, 1398.00000000000000000000, 1398.00000000000000000000, 1.000, 32.000, 14.000, 16.000, NULL, 1410.00000000000000000000, 1350.21600000000000000000, NULL, NULL, 0.000, NULL, NULL, NULL, '2025-08-28 15:24:47', NULL),
(11, 1, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 1, 6, 956.00000000000000000000, 956.00000000000000000000, 940.00000000000000000000, 940.00000000000000000000, 0.000, 26.000, 14.000, 2.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, 0.000, NULL, NULL, NULL, '2025-08-28 15:24:47', '2025-08-28 15:55:57'),
(12, 1, 'مرتجع جزئي فاتورة مبيعات', 'ناتج عن مرتجع مبيعات', 1, 1, 6, 956.00000000000000000000, 956.00000000000000000000, 940.00000000000000000000, 940.00000000000000000000, 1.000, 27.000, 14.000, 2.000, NULL, 956.00000000000000000000, 1068.04320000000000000000, NULL, NULL, 0.000, '2025-08-28', NULL, NULL, '2025-08-28 15:55:57', NULL),
(13, 1, 'حذف كلي فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 1, 3, 1410.00000000000000000000, 1410.00000000000000000000, 1398.00000000000000000000, 1398.00000000000000000000, 1.000, 33.000, 14.000, 16.000, NULL, 1410.00000000000000000000, 1350.21600000000000000000, NULL, NULL, 0.000, '2025-08-28', NULL, NULL, '2025-08-28 16:11:36', NULL),
(14, 2, 'حذف كلي فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 1, 6, 956.00000000000000000000, 956.00000000000000000000, 940.00000000000000000000, 940.00000000000000000000, 0.000, 27.000, 14.000, 2.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, 0.000, '2025-08-28', NULL, NULL, '2025-08-28 16:11:36', NULL),
(15, 1, 'تسوية سلعة/خدمة', 'نشط', 1, 1, 3, NULL, 1410.00000000000000000000, 1398.00000000000000000000, 1398.00000000000000000000, 33.000, 30.000, 14.000, 16.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, 0.000, NULL, NULL, NULL, '2025-08-28 19:08:58', NULL),
(16, 2, 'اضافة فاتورة مبيعات', 'نشط', 1, 2, 3, 1410.00000000000000000000, 1410.00000000000000000000, 1398.00000000000000000000, 1398.00000000000000000000, 1.000, 29.000, 14.000, 16.000, NULL, 1410.00000000000000000000, 1350.21600000000000000000, NULL, NULL, 0.000, NULL, NULL, NULL, '2025-08-28 19:12:48', NULL);

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

--
-- Dumping data for table `taswea_products`
--

INSERT INTO `taswea_products` (`id`, `product_id`, `old_quantity`, `quantity`, `reason_id`, `user_id`, `notes`, `year_id`, `created_at`, `updated_at`) VALUES
(1, 3, 33.00, 30.00, 1, 1, NULL, 1, '2025-08-28 19:08:58', '2025-08-28 19:08:58');

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
(1, 'صيانة', NULL, NULL),
(2, 'تلف/هالك', NULL, NULL),
(3, 'زيادة غير مبررة', NULL, NULL),
(4, 'سرقة', NULL, NULL),
(5, 'انتهاء صلاحية', NULL, NULL),
(6, 'عيب صناعة', NULL, NULL);

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
(1, 1, '2025-08-28', 1, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 100000.00000000000000000000, 100000.00000000000000000000, 100000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:20:34', NULL),
(2, 2, '2025-08-28', 2, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 8000.00000000000000000000, 8000.00000000000000000000, 8000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:20:42', NULL),
(3, 3, '2025-08-28', 3, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:21:03', NULL),
(4, 1, '2025-08-28', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 1, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:22:30', NULL),
(5, 2, '2025-08-28', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 2, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:22:40', NULL),
(6, 3, '2025-08-28', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 3, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:22:47', NULL),
(7, 1, '2025-08-28', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 4, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:23:04', NULL),
(8, 2, '2025-08-28', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 5, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:23:10', NULL),
(9, 3, '2025-08-28', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 6, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:23:16', NULL),
(10, 1, '2025-08-28', 1, 'اذن توريد نقدية', 1, 'اضافة فاتورة مبيعات', 1, NULL, 102400.00000000000000000000, 2400.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 15:24:47', NULL),
(11, 1, '2025-08-28', 0, 'اذن مرتجع نقدية لعميل', 11, 'اذن مرتجع نقدية لعميل', 1, NULL, 0.00000000000000000000, 1068.04320000000000000000, -1068.04320000000000000000, 0.00, NULL, NULL, 'تم إرجاع منتج من العميل عميل متنوع، وتم خصم قيمة المرتجع واحتساب الفارق على حسابه.', 1, 1, '2025-08-28 15:55:57', NULL),
(12, 2, '2025-08-28', 0, 'اذن مرتجع نقدية لعميل', 1, 'اذن مرتجع نقدية لعميل', 1, NULL, 0.00000000000000000000, 1331.95680000000000000000, -2400.00000000000000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة فاتورة بيع ملغاة لعميل عميل متنوع', 1, 1, '2025-08-28 16:11:36', NULL),
(13, 2, '2025-08-28', 1, 'اذن توريد نقدية', 2, 'اضافة فاتورة مبيعات', 3, NULL, 103750.00000000000000000000, 1350.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-28 19:12:48', NULL);

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
(1, 'قطعه', '2025-08-28 15:21:14', '2025-08-28 15:21:14'),
(2, 'نجفه', '2025-08-28 15:21:18', '2025-08-28 15:21:18'),
(3, 'اباجوره', '2025-08-28 15:21:22', '2025-08-28 15:21:22'),
(4, 'لمبه', '2025-08-28 15:21:25', '2025-08-28 15:21:25');

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
(1, 'فريد نجم', 'farid@gmail.com', '$2y$10$3P02z1BASW2XAhJ59IDObOimzTd42yTafpx2D3Q0Duyy79hdJAgPe', NULL, '01000', 1, 1, 'Elnozha2 22', NULL, '2025-02-19', '1754038868.png', 'ذكر', 1, '2025-10-15 17:44:17', NULL, NULL, NULL, NULL, '2025-10-15 14:44:17'),
(2, 'Asmaa Negm', 'asmaa@gmail.com', '$2y$10$4jTJP/oP3HUdRUS5hEmH6e94eu7LKeOfMWjXJZBLLkFHAw4fvi4QW', NULL, NULL, 3, 1, NULL, NULL, NULL, '1749319463.jpeg', 'انثي', 1, NULL, NULL, NULL, NULL, NULL, '2025-06-13 12:55:15'),
(3, 'aaaaa', 'a@sd', '$2y$10$CVvWhLkNjtwTQrIFf.9vg.quhHQT/Ur5yxgwgQAjNXtXPdG2IKrfm', NULL, '111111', 1, 1, NULL, '111111', NULL, '1749319525.jpg', 'ذكر', 0, NULL, NULL, NULL, NULL, NULL, '2025-06-07 18:05:25');

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
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients_and_suppliers_types`
--
ALTER TABLE `clients_and_suppliers_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extra_expenses`
--
ALTER TABLE `extra_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_categoys`
--
ALTER TABLE `product_categoys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_bills`
--
ALTER TABLE `sale_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `store_dets`
--
ALTER TABLE `store_dets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taswea_reasons`
--
ALTER TABLE `taswea_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `taswea_reasons_to_client_supplier`
--
ALTER TABLE `taswea_reasons_to_client_supplier`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `treasury_bill_dets`
--
ALTER TABLE `treasury_bill_dets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
