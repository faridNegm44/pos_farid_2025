-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 04, 2025 at 04:41 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u848547329_pos_decoration`
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

-- --------------------------------------------------------

--
-- Table structure for table `clients_and_suppliers_types`
--

CREATE TABLE `clients_and_suppliers_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
(27, '2025_06_09_191936_create_roles_permissions_table', 18);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_name`, `financialYears_create`, `financialYears_update`, `financialYears_view`, `stores_create`, `stores_update`, `stores_view`, `stores_delete`, `financial_treasury_create`, `financial_treasury_update`, `financial_treasury_view`, `financial_treasury_delete`, `units_create`, `units_update`, `units_view`, `units_delete`, `companies_create`, `companies_update`, `companies_view`, `companies_delete`, `productsCategories_create`, `productsCategories_update`, `productsCategories_view`, `productsCategories_delete`, `products_sub_category_create`, `products_sub_category_update`, `products_sub_category_view`, `products_sub_category_delete`, `products_create`, `products_update`, `products_view`, `products_delete`, `products_report_view`, `taswea_products_create`, `taswea_products_view`, `transfer_between_stores_create`, `transfer_between_stores_view`, `clients_create`, `clients_update`, `clients_view`, `clients_delete`, `clients_report_view`, `clients_account_statement_view`, `suppliers_create`, `suppliers_update`, `suppliers_view`, `suppliers_delete`, `suppliers_report_view`, `suppliers_account_statement_view`, `taswea_client_supplier_create`, `taswea_client_supplier_view`, `partners_create`, `partners_update`, `partners_view`, `partners_delete`, `partners_report_view`, `partners_account_statement_view`, `taswea_partners_create`, `taswea_partners_view`, `sales_create`, `sales_return`, `sales_view`, `sales_return_view`, `products_stock_alert_view`, `purchases_create`, `purchases_return`, `purchases_view`, `purchases_return_view`, `treasury_bills_create`, `treasury_bills_view`, `treasury_bills_report_view`, `transfer_between_storages_create`, `transfer_between_storages_view`, `expenses_create`, `expenses_view`, `expenses_delete`, `expenses_report_view`, `users_create`, `users_update`, `users_view`, `users_delete`, `settings_update`, `settings_view`, `roles_permissions_create`, `roles_permissions_update`, `roles_permissions_view`, `roles_permissions_delete`, `total_sell_bill_today_view`, `total_profit_today_view`, `total_money_on_financial_treasury_view`, `top_products_view`, `top_clients_view`, `profit_view`, `created_at`, `updated_at`) VALUES
(1, 'سوبر ادمن', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2025-06-12 13:04:40', '2025-07-02 09:10:23');

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
(1, 'ديكوراشين هاوس', 'ديكوراشين هاوس وصف', 'ديكوراشين هاوس .. اختيارك الأمثل دائما', 'القاهره - مدينه نصر', 'decoration-house@decoration-house.com', '01016493611', '01117903055', 'logo.png', '- البضائع المباعة لا ترد ولا تستبدل بعد 14 يومًا من الشراء.  <br>\r\n-  يجب تقديم أصل الفاتورة عند أي استفسار.', 'fav_icon.png', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-02 11:50:05');

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
(1, 'فريد نجم', 'farid@gmail.com', '$2y$10$3P02z1BASW2XAhJ59IDObOimzTd42yTafpx2D3Q0Duyy79hdJAgPe', NULL, '01000', 1, 1, 'Elnozha2 22', NULL, '2025-02-19', '1739973719.png', 'ذكر', 1, '2025-07-04 07:36:51', NULL, NULL, NULL, NULL, '2025-07-04 07:36:51');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_treasuries`
--
ALTER TABLE `financial_treasuries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `purchase_return_bills`
--
ALTER TABLE `purchase_return_bills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_bills`
--
ALTER TABLE `sale_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_dets`
--
ALTER TABLE `store_dets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
