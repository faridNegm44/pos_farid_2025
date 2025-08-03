-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 09:14 PM
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
(1, 3, 1, 'عميل متنوع', NULL, NULL, '00000', 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 06:26:31', NULL),
(2, 3, 2, 'عميل فوزي', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 06:26:50', NULL),
(3, 3, 3, 'عميل ايهاب الاسكندراني', NULL, NULL, NULL, 'df_image.png', 'كاش', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 06:27:04', NULL),
(4, 3, 4, 'عميل جرجس المحلاوي', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 06:27:16', NULL),
(5, 1, 1, 'مورد متنوع', NULL, NULL, '00000', 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 06:28:15', NULL),
(6, 1, 2, 'مورد مزيكا', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 06:28:24', NULL),
(7, 1, 3, 'مورد محمد علي الاسكا', NULL, NULL, NULL, 'df_image.png', 'آجل', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 06:28:41', NULL);

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
(5, 'fix2', 120.00, NULL, '2025-07-30 06:22:32', '2025-07-30 06:22:58'),
(6, 'order', 150.00, NULL, '2025-07-30 06:22:40', '2025-07-30 06:22:40');

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
(1, 'خزينة رئيسيه', NULL, 100000.00, '1', NULL, '2025-07-31 06:20:52', '2025-07-31 06:20:52'),
(2, 'حزينه فودافون كاش', NULL, 7000.00, '1', NULL, '2025-07-31 06:21:02', '2025-07-31 06:21:02'),
(3, 'خزينه انستاباي', NULL, 1000.00, '1', NULL, '2025-07-31 06:21:10', '2025-07-31 06:21:10');

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

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `last_cost_price` decimal(30,20) DEFAULT NULL,
  `avg_cost_price` decimal(30,20) DEFAULT NULL,
  `daftry_qty` decimal(30,20) NOT NULL DEFAULT 0.00000000000000000000 COMMENT 'الكمية الدفترية كمية السيستم',
  `fealy_qty` decimal(30,20) DEFAULT NULL COMMENT 'الكمية الفعلية كمية المخزن',
  `difference_qty` decimal(30,20) DEFAULT NULL COMMENT 'الفرق بين الفعلي والدفتري كميات',
  `difference_value_last_cost` decimal(30,20) DEFAULT NULL COMMENT 'الفرق بين الفعلي والدفتري مالي اخر سعر تكلفة',
  `difference_value_avg_cost` decimal(30,20) DEFAULT NULL COMMENT 'الفرق بين الفعلي والدفتري مالي متوسط سعر تكلفة',
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, NULL, NULL, 'سلعة', 'صنف نجفه كريستال العبد 50 قطعه اول مده', NULL, 1, NULL, NULL, NULL, 0.000, 'نسبة', 50.000, 0, 7, 1.000, 10.000, 0.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-07-31 06:25:11'),
(2, NULL, NULL, 'سلعة', 'صنف لمبه ليد الامير 100 قطعه اول مده', NULL, 1, NULL, NULL, NULL, 0.000, 'نسبة', 100.000, 0, 9, 1.000, 8.000, 0.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-07-31 06:25:01'),
(3, NULL, NULL, 'سلعة', 'صنف دلابه ميرور 200 قطعه اول مده', NULL, 1, NULL, NULL, NULL, 0.000, 'نسبة', 200.000, 0, 8, 1.000, 15.000, 0.000, 0.000, '0', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-08-03 05:51:34'),
(4, NULL, NULL, 'سلعة', 'صنف نجفه الشبح 30 قطعه او مده', NULL, 3, NULL, NULL, NULL, 0.000, 'نسبة', 30.000, 0, 7, 1.000, 10.000, 0.000, 0.000, '1', 'df_image.png', NULL, '', NULL, NULL, NULL, NULL, '2025-08-03 05:51:24');

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

--
-- Dumping data for table `purchase_bills`
--

INSERT INTO `purchase_bills` (`id`, `status`, `custom_bill_num`, `supplier_id`, `treasury_id`, `bill_discount`, `count_items`, `total_bill_before`, `total_bill_after`, `custom_date`, `user_id`, `year_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'فاتورة ملغاة', NULL, 6, NULL, 0.000, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-03 05:58:49', NULL),
(2, 'فاتورة ملغاة', NULL, 6, NULL, 0.000, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-03 16:38:29', NULL);

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

INSERT INTO `roles_permissions` (`id`, `role_name`, `financialYears_create`, `financialYears_update`, `financialYears_view`, `stores_create`, `stores_update`, `stores_view`, `stores_delete`, `financial_treasury_create`, `financial_treasury_update`, `financial_treasury_view`, `financial_treasury_delete`, `units_create`, `units_update`, `units_view`, `units_delete`, `companies_create`, `companies_update`, `companies_view`, `companies_delete`, `productsCategories_create`, `productsCategories_update`, `productsCategories_view`, `productsCategories_delete`, `products_sub_category_create`, `products_sub_category_update`, `products_sub_category_view`, `products_sub_category_delete`, `products_create`, `products_update`, `products_view`, `products_delete`, `products_report_view`, `taswea_products_create`, `taswea_products_view`, `transfer_between_stores_create`, `transfer_between_stores_view`, `clients_create`, `clients_update`, `clients_view`, `clients_delete`, `clients_report_view`, `clients_account_statement_view`, `suppliers_create`, `suppliers_update`, `suppliers_view`, `suppliers_delete`, `suppliers_report_view`, `suppliers_account_statement_view`, `taswea_client_supplier_create`, `taswea_client_supplier_view`, `partners_create`, `partners_update`, `partners_view`, `partners_delete`, `partners_report_view`, `partners_account_statement_view`, `taswea_partners_create`, `taswea_partners_view`, `sales_create`, `sales_view`, `sales_bill_deleted_view`, `sales_bill_return_view`, `sales_bill_edited_view`, `products_stock_alert_view`, `purchases_create`, `purchases_view`, `purchase_bill_deleted_view`, `purchase_bill_return_view`, `purchase_bill_edited_view`, `treasury_bills_create`, `treasury_bills_view`, `treasury_bills_report_view`, `transfer_between_storages_create`, `transfer_between_storages_view`, `expenses_create`, `expenses_view`, `expenses_delete`, `expenses_report_view`, `users_create`, `users_update`, `users_view`, `users_delete`, `settings_update`, `settings_view`, `roles_permissions_create`, `roles_permissions_update`, `roles_permissions_view`, `roles_permissions_delete`, `total_sell_bill_today_view`, `total_profit_today_view`, `total_money_on_financial_treasury_view`, `top_products_view`, `top_clients_view`, `profit_view`, `tax_bill_view`, `discount_bill_view`, `cost_price_view`, `sale_price_view`, `receipts_create`, `receipts_update`, `receipts_view`, `receipts_delete`, `receipts_take_money`, `created_at`, `updated_at`) VALUES
(1, 'سوبر ادمن', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2025-06-12 13:04:40', '2025-07-31 15:46:22'),
(2, 'موظف مبيعات', 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-06-13 12:49:53', '2025-06-30 09:24:17'),
(3, 'موظف مشتريات', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-06-13 12:50:10', '2025-06-13 12:50:10'),
(5, 'فففففففف', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-07-02 08:12:50', '2025-07-02 08:59:35'),
(6, 'llllllllllllllllllllllllll', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-07-06 09:40:50', '2025-07-06 09:40:59');

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
(1, NULL, 'فاتورة ملغاة', 1, NULL, 0.000, 0.000, 0, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-07-31 06:30:05', NULL),
(2, NULL, 'فاتورة نشطة', 4, NULL, 71.250, 120.000, 5, 3.000, 2725.00000000000000000000, 2500.00000000000000000000, NULL, 1, 1, NULL, '2025-07-31 06:38:08', NULL),
(3, NULL, 'فاتورة ملغاة', 1, NULL, 0.000, 0.000, 0, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-01 13:28:16', NULL),
(4, NULL, 'فاتورة معدلة', 3, 1, 60.885, 120.000, 5, 1.000, 50.00000000000000000000, 58.60000000000000000000, NULL, 1, 1, NULL, '2025-08-01 13:50:21', NULL),
(5, NULL, 'فاتورة ملغاة', 3, 1, 0.000, 0.000, NULL, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-02 02:06:10', NULL),
(6, NULL, 'فاتورة ملغاة', 3, NULL, 0.000, 0.000, 0, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-02 03:06:48', NULL),
(7, NULL, 'فاتورة ملغاة', 3, 1, 0.000, 0.000, NULL, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-02 03:22:51', NULL),
(8, NULL, 'فاتورة ملغاة', 3, NULL, 0.000, 0.000, 0, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-02 03:31:05', NULL),
(9, NULL, 'فاتورة ملغاة', 3, 1, 0.000, 0.000, NULL, 0.000, 0.00000000000000000000, 0.00000000000000000000, NULL, 1, 1, NULL, '2025-08-02 03:39:38', NULL);

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
(1, 'ديكوراشين هاوس', 'ديكوراشين هاوس وصف', '\"يومي المحاسبي... شريكك الذكي في الإدارة المالية\"', '33 عبدالحميد عوض متفرع من مكرم عبيد - خلف محجوب - مدينه نصر', 'decoration-house@decoration-house.com', '01016493611', '01117903055', 'logo.png', '- البضائع المباعة لا ترد ولا تستبدل بعد 14 يومًا من الشراء.  <br>\r\n-  يجب تقديم أصل الفاتورة عند أي استفسار.الاستبدال والاسترجاع خلال 14 يوم من تاريخ استلام المنتج\r\n- لا يجوز استبدال او استرجاع المنتج إذا لم يكن المنتج في نفس حالة وقت البيع\r\n- لا يجوز استبدال او استرجاع المنتج الذي تم تصنيعه خصيصًا للعميل\r\n- ضمان 3 سنوات على جميع منتجاتنا\r\n- الضمان شامل الكهرباء واللون فقط\r\n- صيانة المنتج من خلال مقرنا فقط\r\n- استرجاع او استبدال المنتج من خلال مقرنا فقط وذلك للتأكد من صحة المنتج', 'fav_icon.png', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-01 09:02:16');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_dets`
--

INSERT INTO `store_dets` (`id`, `num_order`, `type`, `status`, `year_id`, `bill_id`, `product_id`, `current_sell_price_in_sale_bill`, `sell_price_small_unit`, `last_cost_price_small_unit`, `avg_cost_price_small_unit`, `product_bill_quantity`, `quantity_small_unit`, `tax`, `discount`, `bonus`, `total_before`, `total_after`, `transfer_from`, `transfer_to`, `transfer_quantity`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 1, NULL, 600.00000000000000000000, 500.00000000000000000000, 500.00000000000000000000, NULL, 50.000, 0.000, 10.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-31', '2025-07-31 06:22:07', '2025-07-31 06:25:11'),
(2, 2, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 2, NULL, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, NULL, 100.000, 0.000, 8.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-31', '2025-07-31 06:22:53', '2025-07-31 06:25:01'),
(3, 3, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 3, NULL, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, NULL, 200.000, 0.000, 15.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-31', '2025-07-31 06:23:41', '2025-07-31 06:24:54'),
(4, 4, 'رصيد اول مدة للسلعة/خدمة', 'نشط', 1, 0, 4, NULL, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, NULL, 30.000, 0.000, 10.000, NULL, 0.00000000000000000000, 0.00000000000000000000, NULL, NULL, NULL, '2025-07-31', '2025-07-31 06:24:34', '2025-07-31 06:24:46'),
(5, 1, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 1, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 29.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-31 06:30:05', NULL),
(6, 1, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 1, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 1.000, 199.000, 0.000, 15.000, NULL, 25.00000000000000000000, 21.25000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-31 06:30:05', NULL),
(7, 2, 'اضافة فاتورة مبيعات', 'نشط', 1, 2, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 1.000, 198.000, 0.000, 15.000, NULL, 25.00000000000000000000, 21.25000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-31 06:38:08', NULL),
(8, 2, 'اضافة فاتورة مبيعات', 'نشط', 1, 2, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 3.000, 26.000, 0.000, 10.000, NULL, 1500.00000000000000000000, 1350.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-31 06:38:08', NULL),
(9, 2, 'اضافة فاتورة مبيعات', 'نشط', 1, 2, 1, 600.00000000000000000000, 600.00000000000000000000, 500.00000000000000000000, 500.00000000000000000000, 2.000, 48.000, 0.000, 10.000, NULL, 1200.00000000000000000000, 1080.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-07-31 06:38:08', NULL),
(10, 1, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 1, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 27.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-07-31', '2025-07-31 15:40:27', NULL),
(11, 1, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 1, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 1.000, 199.000, 0.000, 15.000, NULL, 25.00000000000000000000, 21.25000000000000000000, NULL, NULL, 0.000, '2025-07-31', '2025-07-31 15:40:27', NULL),
(12, 3, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 3, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 26.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-01 13:28:16', NULL),
(13, 3, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 3, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 97.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-01 13:28:16', NULL),
(14, 3, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 3, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 27.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-01', '2025-08-01 13:49:02', NULL),
(15, 3, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 3, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 100.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, '2025-08-01', '2025-08-01 13:49:02', NULL),
(16, 4, 'اضافة فاتورة مبيعات', 'نشط', 1, 4, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 197.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-01 13:50:21', NULL),
(17, 4, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 4, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 97.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-01 13:50:21', NULL),
(18, 4, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 4, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 100.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, '2025-08-01', '2025-08-01 13:54:24', NULL),
(19, 5, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 5, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 26.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 02:06:10', NULL),
(20, 5, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 5, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 195.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 02:06:10', NULL),
(21, 5, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 5, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 97.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 02:06:10', NULL),
(23, 5, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 5, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 197.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 02:26:40', NULL),
(24, 5, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 5, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 27.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 02:41:35', NULL),
(25, 5, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 5, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 100.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 02:52:51', NULL),
(26, 6, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 6, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 26.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:06:48', NULL),
(27, 6, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 6, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 195.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:06:48', NULL),
(28, 6, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 6, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 97.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:06:48', NULL),
(29, 6, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 6, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 27.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:18:10', NULL),
(30, 6, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 6, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 197.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:18:10', NULL),
(31, 6, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 6, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 100.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:18:10', NULL),
(32, 7, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 7, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 26.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:22:51', NULL),
(33, 7, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 7, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 195.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:22:51', NULL),
(34, 7, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 7, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 97.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:22:51', NULL),
(35, 7, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 7, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 27.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:23:17', NULL),
(36, 7, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 7, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 197.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:23:22', NULL),
(37, 7, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 7, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 100.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:23:39', NULL),
(38, 8, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 8, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 26.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:31:05', NULL),
(39, 8, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 8, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 195.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:31:05', NULL),
(40, 8, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 8, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 97.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:31:05', NULL),
(41, 8, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 8, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 27.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:32:24', NULL),
(42, 8, 'اضافة فاتورة مبيعات', 'فاتورة ملغاة', 1, 8, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 197.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:33:08', NULL),
(43, 8, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 8, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 28.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:37:50', NULL),
(44, 8, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 8, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 199.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:37:50', NULL),
(45, 8, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 8, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 100.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:37:50', NULL),
(46, 8, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 8, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 29.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:37:50', NULL),
(47, 8, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 8, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 201.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:37:50', NULL),
(48, 9, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 9, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 28.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:39:38', NULL),
(49, 9, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 9, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 199.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:39:38', NULL),
(50, 9, 'اضافة فاتورة مبيعات', 'تم حذفه', 1, 9, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 97.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-02 03:39:38', NULL),
(51, 9, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 9, 4, 500.00000000000000000000, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 29.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:41:08', NULL),
(52, 9, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 9, 3, 25.00000000000000000000, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 201.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:41:27', NULL),
(53, 9, 'اضافة فاتورة مبيعات', 'ناتج عن حذف مبيعات', 1, 9, 2, 15.00000000000000000000, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 3.000, 100.000, 0.000, 8.000, NULL, 45.00000000000000000000, 41.40000000000000000000, NULL, NULL, 0.000, '2025-08-02', '2025-08-02 03:46:24', NULL),
(54, 1, 'اضافة فاتورة مشتريات', 'فاتورة ملغاة', 1, 1, 4, NULL, 500.00000000000000000000, 400.00000000000000000000, 397.41935483871000000000, 2.000, 31.000, 0.000, 10.000, NULL, 800.00000000000000000000, 720.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-03 05:58:49', NULL),
(55, 1, 'اضافة فاتورة مشتريات', 'فاتورة ملغاة', 1, 1, 3, NULL, 25.00000000000000000000, 20.00000000000000000000, 391.82495256167000000000, 3.000, 204.000, 0.000, 15.000, NULL, 60.00000000000000000000, 51.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-03 05:58:49', NULL),
(56, 9, 'اضافة فاتورة مشتريات', 'ناتج عن حذف مشتريات', 1, 9, 4, NULL, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 1.000, 29.000, 0.000, 10.000, NULL, 500.00000000000000000000, 450.00000000000000000000, NULL, NULL, 0.000, '2025-08-03', '2025-08-03 16:31:05', NULL),
(57, 9, 'اضافة فاتورة مشتريات', 'ناتج عن حذف مشتريات', 1, 9, 3, NULL, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 201.000, 0.000, 15.000, NULL, 50.00000000000000000000, 42.50000000000000000000, NULL, NULL, 0.000, '2025-08-03', '2025-08-03 16:31:05', NULL),
(58, 10, 'اضافة فاتورة مشتريات', 'فاتورة ملغاة', 1, 2, 3, NULL, 25.00000000000000000000, 20.00000000000000000000, 19.97044334975400000000, 2.000, 203.000, 0.000, 15.000, NULL, 40.00000000000000000000, 34.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-03 16:38:29', NULL),
(59, 10, 'اضافة فاتورة مشتريات', 'فاتورة ملغاة', 1, 2, 4, NULL, 500.00000000000000000000, 400.00000000000000000000, 51.84821428571500000000, 3.000, 32.000, 0.000, 10.000, NULL, 1200.00000000000000000000, 1080.00000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-03 16:38:29', NULL),
(60, 10, 'اضافة فاتورة مشتريات', 'فاتورة ملغاة', 1, 2, 2, NULL, 15.00000000000000000000, 10.00000000000000000000, 50.20789835164900000000, 4.000, 104.000, 0.000, 8.000, NULL, 40.00000000000000000000, 36.80000000000000000000, NULL, NULL, 0.000, NULL, '2025-08-03 16:38:29', NULL),
(61, 1, 'حذف كلي فاتورة مشتريات', 'ناتج عن حذف مشتريات', 1, 2, 3, NULL, 25.00000000000000000000, 20.00000000000000000000, 20.00000000000000000000, 2.000, 201.000, 0.000, 15.000, NULL, 40.00000000000000000000, 34.00000000000000000000, NULL, NULL, 0.000, '2025-08-03', '2025-08-03 16:47:54', NULL),
(62, 1, 'حذف كلي فاتورة مشتريات', 'ناتج عن حذف مشتريات', 1, 2, 4, NULL, 500.00000000000000000000, 400.00000000000000000000, 400.00000000000000000000, 3.000, 29.000, 0.000, 10.000, NULL, 1200.00000000000000000000, 1080.00000000000000000000, NULL, NULL, 0.000, '2025-08-03', '2025-08-03 16:47:54', NULL),
(63, 1, 'حذف كلي فاتورة مشتريات', 'ناتج عن حذف مشتريات', 1, 2, 2, NULL, 15.00000000000000000000, 10.00000000000000000000, 10.00000000000000000000, 4.000, 100.000, 0.000, 8.000, NULL, 40.00000000000000000000, 36.80000000000000000000, NULL, NULL, 0.000, '2025-08-03', '2025-08-03 16:47:54', NULL);

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
(1, 1, '2025-07-31', 1, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 100000.00000000000000000000, 100000.00000000000000000000, 100000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:20:52', NULL),
(2, 2, '2025-07-31', 2, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 7000.00000000000000000000, 7000.00000000000000000000, 7000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:21:02', NULL),
(3, 3, '2025-07-31', 3, 'رصيد اول خزنة', 0, 'رصيد اول خزنة', 0, NULL, 1000.00000000000000000000, 1000.00000000000000000000, 1000.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:21:10', NULL),
(4, 1, '2025-07-31', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 1, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:26:31', NULL),
(5, 2, '2025-07-31', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 2, NULL, 0.00000000000000000000, 1200.00000000000000000000, 1200.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:26:50', NULL),
(6, 3, '2025-07-31', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 3, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:27:04', NULL),
(7, 4, '2025-07-31', 0, 'رصيد اول عميل', 0, 'رصيد اول عميل', 4, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:27:16', NULL),
(8, 1, '2025-07-31', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 5, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:28:15', NULL),
(9, 2, '2025-07-31', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 6, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:28:24', NULL),
(10, 3, '2025-07-31', 0, 'رصيد اول مورد', 0, 'رصيد اول مورد', 7, NULL, 0.00000000000000000000, 0.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:28:41', NULL),
(11, 1, '2025-07-31', 1, 'اذن توريد نقدية', 1, 'اضافة فاتورة مبيعات', 1, NULL, 100500.00000000000000000000, 500.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:30:05', NULL),
(12, 1, '2025-07-31', 0, 'اضافة فاتورة مبيعات', 2, 'اضافة فاتورة مبيعات', 4, NULL, 0.00000000000000000000, NULL, 2500.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-07-31 06:38:08', NULL),
(13, 1, '2025-07-31', 0, 'اذن مرتجع نقدية لعميل', 1, 'اذن مرتجع نقدية لعميل', 1, NULL, 0.00000000000000000000, 500.00000000000000000000, -500.00000000000000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة فاتورة بيع ملغاة لعميل عميل متنوع', 1, 1, '2025-07-31 15:40:27', NULL),
(14, 2, '2025-08-01', 1, 'اذن توريد نقدية', 3, 'اضافة فاتورة مبيعات', 1, NULL, 101100.00000000000000000000, 600.00000000000000000000, -500.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-01 13:28:16', NULL),
(15, 2, '2025-08-01', 0, 'اذن مرتجع نقدية لعميل', 3, 'اذن مرتجع نقدية لعميل', 1, NULL, 0.00000000000000000000, 600.00000000000000000000, -1100.00000000000000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة فاتورة بيع ملغاة لعميل عميل متنوع', 1, 1, '2025-08-01 13:49:02', NULL),
(16, 3, '2025-08-01', 1, 'اذن توريد نقدية', 4, 'اضافة فاتورة مبيعات', 3, NULL, 101200.00000000000000000000, 100.00000000000000000000, 0.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-01 13:50:21', NULL),
(17, 3, '2025-08-01', 0, 'اذن مرتجع نقدية لعميل', 17, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 41.40000000000000000000, -41.40000000000000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-01 13:54:24', NULL),
(18, 4, '2025-08-02', 1, 'اذن توريد نقدية', 5, 'اضافة فاتورة مبيعات', 3, NULL, 101800.00000000000000000000, 600.00000000000000000000, -41.40000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-02 02:06:10', NULL),
(19, 4, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 20, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 42.50000000000000000000, -80.21791666666700000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 02:26:40', NULL),
(20, 5, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 19, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 450.00000000000000000000, -489.21284940209000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 02:41:35', NULL),
(21, 6, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 21, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 41.40000000000000000000, -526.89378149511000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 02:52:51', NULL),
(22, 5, '2025-08-02', 1, 'اذن توريد نقدية', 6, 'اضافة فاتورة مبيعات', 3, NULL, 102400.00000000000000000000, 600.00000000000000000000, -526.89378149511000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-02 03:06:48', NULL),
(23, 7, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 6, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 600.00000000000000000000, -1126.89378149510000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة فاتورة بيع ملغاة لعميل عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:18:10', NULL),
(24, 6, '2025-08-02', 1, 'اذن توريد نقدية', 7, 'اضافة فاتورة مبيعات', 3, NULL, 103000.00000000000000000000, 600.00000000000000000000, -1126.89378149510000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-02 03:22:51', NULL),
(25, 8, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 32, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 450.00000000000000000000, -1536.46878149510000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:23:17', NULL),
(26, 9, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 33, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 42.50000000000000000000, -1575.15086482840000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:23:22', NULL),
(27, 10, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 34, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 41.40000000000000000000, -1726.89786482840000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:23:39', NULL),
(28, 7, '2025-08-02', 1, 'اذن توريد نقدية', 8, 'اضافة فاتورة مبيعات', 3, NULL, 103600.00000000000000000000, 600.00000000000000000000, -1726.89786482840000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-02 03:31:05', NULL),
(29, 11, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 38, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 409.57500000000000000000, -2136.47286482840000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:32:24', NULL),
(30, 12, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 39, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 38.68208333333300000000, -2175.15494816170000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:33:08', NULL),
(31, 13, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 8, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 107.50000000000000000000, -2326.89494816170000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة فاتورة بيع ملغاة لعميل عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:37:50', NULL),
(32, 8, '2025-08-02', 1, 'اذن توريد نقدية', 9, 'اضافة فاتورة مبيعات', 3, NULL, 104200.00000000000000000000, 600.00000000000000000000, -2326.89494816170000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-02 03:39:38', NULL),
(33, 14, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 48, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 409.57500000000000000000, -2736.46994816170000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:41:08', NULL),
(34, 15, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 49, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 39.49258238151500000000, -2775.96253054320000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:41:27', NULL),
(35, 16, '2025-08-02', 0, 'اذن مرتجع نقدية لعميل', 50, 'اذن مرتجع نقدية لعميل', 3, NULL, 0.00000000000000000000, 38.52868045951900000000, -2604.09453054320000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة صنف تم حذفة من فاتورة مبيعات عميل ايهاب الاسكندراني', 1, 1, '2025-08-02 03:46:24', NULL),
(36, 1, '2025-08-03', 1, 'اذن صرف نقدية', 1, 'اضافة فاتورة مشتريات', 6, NULL, 103600.00000000000000000000, 600.00000000000000000000, -71.00000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-03 05:58:49', NULL),
(37, 1, '2025-08-03', 0, 'اذن مرتجع نقدية لمورد', 1, 'اذن مرتجع نقدية لمورد', 6, NULL, 0.00000000000000000000, 671.00000000000000000000, 600.00000000000000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة فاتورة مشتريات ملغاة لمورد مورد مزيكا', 1, 1, '2025-08-03 16:31:05', NULL),
(38, 1, '2025-08-03', 0, 'اضافة فاتورة مشتريات', 2, 'اضافة فاتورة مشتريات', 6, NULL, 0.00000000000000000000, NULL, -550.80000000000000000000, 0.00, NULL, NULL, NULL, 1, 1, '2025-08-03 16:38:29', NULL),
(39, 2, '2025-08-03', 0, 'اذن مرتجع نقدية لمورد', 2, 'اذن مرتجع نقدية لمورد', 6, NULL, 0.00000000000000000000, 1150.80000000000000000000, 600.00000000000000000000, 0.00, NULL, NULL, 'استرجاع إجمالي قيمة فاتورة مشتريات ملغاة لمورد مورد مزيكا', 1, 1, '2025-08-03 16:47:54', NULL);

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
(7, 'نجفة', '2025-07-23 14:44:28', '2025-07-23 14:44:28'),
(8, 'دلايه', '2025-07-23 14:44:49', '2025-07-23 14:44:49'),
(9, 'لمبة', '2025-07-23 14:44:54', '2025-07-23 14:44:54'),
(10, 'قطعه', '2025-07-23 14:45:03', '2025-07-23 14:45:03');

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
(1, 'فريد نجم', 'farid@gmail.com', '$2y$10$3P02z1BASW2XAhJ59IDObOimzTd42yTafpx2D3Q0Duyy79hdJAgPe', NULL, '01000', 1, 1, 'Elnozha2 22', NULL, '2025-02-19', '1754038868.png', 'ذكر', 1, '2025-07-21 18:12:37', NULL, NULL, NULL, NULL, '2025-08-01 09:01:08'),
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
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extra_expenses`
--
ALTER TABLE `extra_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_return_bills`
--
ALTER TABLE `purchase_return_bills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_bills`
--
ALTER TABLE `sale_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
