-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 09:49 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacymis`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `pharmacy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` int(11) NOT NULL,
  `contact_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no_2` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_accounts`
--

CREATE TABLE `customer_accounts` (
  `customer_account_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL DEFAULT 0,
  `money` double(8,2) NOT NULL DEFAULT 0.00,
  `usd` double(8,2) NOT NULL DEFAULT 0.00,
  `afg` double(8,2) NOT NULL DEFAULT 0.00,
  `kal` double(8,2) NOT NULL DEFAULT 0.00,
  `usd_afg` double(8,2) NOT NULL,
  `usd_kal` double(8,2) NOT NULL,
  `in_out` tinyint(4) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` bigint(20) UNSIGNED NOT NULL,
  `afg` double(8,2) NOT NULL DEFAULT 0.00,
  `usd` double(8,2) NOT NULL DEFAULT 0.00,
  `kal` double(8,2) NOT NULL DEFAULT 0.00,
  `usd_afg` double(8,2) NOT NULL,
  `usd_kal` double(8,2) NOT NULL,
  `in_out` tinyint(4) NOT NULL,
  `expense_date` date NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `measure_unit_id` int(11) NOT NULL,
  `dose` float NOT NULL,
  `quantity_per_carton` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `measure_unit_id`, `dose`, `quantity_per_carton`, `created_at`, `updated_at`) VALUES
(1, 'cefiget', 1, 100, 12, '2022-04-06 03:05:31', '2022-04-06 03:05:31'),
(2, 'cefiget', 1, 200, 6, '2022-04-06 03:05:31', '2022-04-06 03:05:31'),
(3, 'panadol', 3, 10, 120, '2022-04-06 03:05:31', '2022-04-06 03:05:31'),
(4, 'paramol', 1, 150, 12, '2022-04-06 03:05:31', '2022-04-06 03:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `measure_units`
--

CREATE TABLE `measure_units` (
  `measure_unit_id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measure_units`
--

INSERT INTO `measure_units` (`measure_unit_id`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'ml', NULL, NULL),
(2, 'lit', NULL, NULL),
(3, 'mg', NULL, NULL),
(4, 'gr', NULL, NULL),
(5, 'cc', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_03_21_111336_create_transfers_table', 1),
(5, '2022_03_21_111402_create_transfer_items_table', 1),
(6, '2022_03_21_111416_create_customer_accounts_table', 1),
(7, '2022_03_21_111449_create_seller_accounts_table', 1),
(8, '2022_03_21_111517_create_supplier_accounts_table', 1),
(9, '2022_03_21_111534_create_returns_table', 1),
(10, '2022_03_21_111626_create_return_items_table', 1),
(11, '2022_03_21_111642_create_stocks_table', 1),
(12, '2022_03_21_111656_create_suppliers_table', 1),
(13, '2022_03_21_111717_create_customers_table', 1),
(14, '2022_03_21_111728_create_sites_table', 1),
(15, '2022_03_21_111752_create_measure_units_table', 1),
(16, '2022_03_21_111802_create_items_table', 1),
(17, '2022_03_21_111813_create_orders_table', 1),
(18, '2022_03_21_111829_create_order_items_table', 1),
(19, '2022_03_21_111856_create_purchases_table', 1),
(20, '2022_03_21_111906_create_purchase_items_table', 1),
(21, '2022_03_21_111918_create_stock_items_table', 1),
(22, '2022_03_21_112048_create_sales_table', 1),
(23, '2022_03_21_112106_create_sales_items_table', 1),
(24, '2022_03_21_112209_create_expenses_table', 1),
(25, '2022_03_22_053217_create_provinces_table', 1),
(26, '2022_03_22_054415_create_sellers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `supplier_id`, `order_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-04-06', 1, '2022-04-06 03:06:20', '2022-04-06 03:08:14'),
(2, 1, '2022-04-07', 0, '2022-04-07 03:14:24', '2022-04-07 03:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `item_id`, `quantity`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 1, '2022-04-06 03:06:20', '2022-04-06 03:06:20'),
(2, 3, 20, 1, '2022-04-06 03:06:20', '2022-04-06 03:06:20'),
(3, 4, 30, 1, '2022-04-06 03:06:20', '2022-04-06 03:06:20'),
(4, 4, 10, 2, '2022-04-07 03:14:24', '2022-04-07 03:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `en_province` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dr_province` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ps_province` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_id`, `en_province`, `dr_province`, `ps_province`, `created_at`, `updated_at`) VALUES
(1, 'Kabul', 'کابل', 'کابل', NULL, NULL),
(2, 'Kapisa', 'کاپيسا', 'کاپيسا', NULL, NULL),
(3, 'Parwan', 'پروان', 'پروان', NULL, NULL),
(4, 'Wardak', 'میدان وردک', 'میدان وردک', NULL, NULL),
(5, 'Logar', 'لوگر', 'لوگر', NULL, NULL),
(6, 'Ghazni', 'غزني', 'غزني', NULL, NULL),
(7, 'Paktia', 'پکتيا', 'پکتيا', NULL, NULL),
(8, 'Nangarhar', 'ننگرهار', 'ننگرهار', NULL, NULL),
(9, 'Laghman', 'لغمان', 'لغمان', NULL, NULL),
(10, 'Kunar', 'کنر', 'کنر', NULL, NULL),
(11, 'Badakhshan', 'بدخشان', 'بدخشان', NULL, NULL),
(12, 'Takhar', 'تخار', 'تخار', NULL, NULL),
(13, 'Baghlan', 'بغلان', 'بغلان', NULL, NULL),
(14, 'Kunduz', 'کندوز', 'کندوز', NULL, NULL),
(15, 'Samangan', 'سمنگان', 'سمنگان', NULL, NULL),
(16, 'Balkh', 'بلخ', 'بلخ', NULL, NULL),
(17, 'Jawzjan', 'جوزجان', 'جوزجان', NULL, NULL),
(18, 'Faryab', 'فارياب', 'فارياب', NULL, NULL),
(19, 'Badghis', 'بادغيس', 'بادغيس', NULL, NULL),
(20, 'Herat', 'هرات', 'هرات', NULL, NULL),
(21, 'Farah', 'فراه', 'فراه', NULL, NULL),
(22, 'Nimroz', 'نيمروز', 'نيمروز', NULL, NULL),
(23, 'Hilmand', 'هلمند', 'هلمند', NULL, NULL),
(24, 'Kandahar', 'کندهار', 'کندهار', NULL, NULL),
(25, 'Zabul', 'زابل', 'زابل', NULL, NULL),
(26, 'Uruzgan', 'ارزگان', 'ارزگان', NULL, NULL),
(27, 'Ghor', 'غور', 'غور', NULL, NULL),
(28, 'Bamyan', 'باميان', 'باميان', NULL, NULL),
(29, 'Paktika', 'پکتيکا', 'پکتيکا', NULL, NULL),
(30, 'Nuristan', 'نورستان', 'نورستان', NULL, NULL),
(31, 'Sar i Pul', 'سرپل', 'سرپل', NULL, NULL),
(32, 'Khost', 'خوست', 'خوست', NULL, NULL),
(33, 'Panjshir', 'پنجشير', 'پنجشير', NULL, NULL),
(34, 'Daikundi', 'دايکندي', 'دايکندي', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(11) DEFAULT 0,
  `stock_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `supplier_id`, `purchase_invoice_no`, `order_id`, `stock_id`, `purchase_date`, `created_at`, `updated_at`) VALUES
(1, 1, '123', 1, 1, '2022-04-06', '2022-04-06 03:08:14', '2022-04-06 03:08:14'),
(2, 1, '567', 0, 1, '2022-04-06', '2022-04-06 03:10:08', '2022-04-06 03:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `purchase_item_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`purchase_item_id`, `purchase_id`, `item_id`, `quantity`, `purchase_price`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, 12.00, '2022-04-06', '2022-04-06 03:08:14', '2022-04-06 03:08:14'),
(2, 1, 3, 20, 14.00, '2022-04-06', '2022-04-06 03:08:14', '2022-04-06 03:08:14'),
(3, 1, 4, 30, 16.00, '2022-04-06', '2022-04-06 03:08:14', '2022-04-06 03:08:14'),
(4, 2, 4, 15, 12.00, '2022-04-06', '2022-04-06 03:10:08', '2022-04-06 03:10:08'),
(5, 2, 1, 12, 13.00, '2022-04-06', '2022-04-06 03:10:08', '2022-04-06 03:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `reutrn_id` bigint(20) UNSIGNED NOT NULL,
  `customer_type` tinyint(4) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `return_item_id` bigint(20) UNSIGNED NOT NULL,
  `returns_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `seller_type` tinyint(4) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `sale_item_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `sale_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `seller_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` int(11) NOT NULL,
  `contact_no_2` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_accounts`
--

CREATE TABLE `seller_accounts` (
  `seller_account_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL DEFAULT 0,
  `money` double(8,2) NOT NULL DEFAULT 0.00,
  `usd` double(8,2) NOT NULL DEFAULT 0.00,
  `afg` double(8,2) NOT NULL DEFAULT 0.00,
  `kal` double(8,2) NOT NULL DEFAULT 0.00,
  `usd_afg` double(8,2) NOT NULL,
  `usd_kal` double(8,2) NOT NULL,
  `percentage` tinyint(4) NOT NULL DEFAULT 0,
  `in_out` tinyint(4) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `site_id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`site_id`, `site_name`, `province`, `created_at`, `updated_at`) VALUES
(1, 'updated', 6, '2022-03-26 00:16:44', '2022-03-26 23:29:30'),
(2, 'mk', 5, '2022-03-26 01:11:43', '2022-03-26 01:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `stock_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incharge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `stock_name`, `stock_address`, `incharge`, `contact_no`, `created_at`, `updated_at`) VALUES
(1, 'stock1', 'kabul', 'ahmad', 799999999, '2022-03-30 05:28:38', '2022-03-30 05:28:38'),
(2, 'stock2', 'parwan', 'mahmood', 788888888, '2022-03-30 05:28:54', '2022-03-30 05:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `stock_items`
--

CREATE TABLE `stock_items` (
  `stock_item_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `sale_price` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `stock_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_items`
--

INSERT INTO `stock_items` (`stock_item_id`, `item_id`, `quantity`, `purchase_price`, `sale_price`, `expiry_date`, `stock_id`, `created_at`, `updated_at`) VALUES
(1, 1, 22, 13.00, 14.00, '2022-04-06', 1, '2022-04-06 03:08:14', '2022-04-06 03:10:08'),
(2, 3, 20, 14.00, 15.00, '2022-04-06', 1, '2022-04-06 03:08:14', '2022-04-06 03:08:14'),
(3, 4, 45, 12.00, 13.00, '2022-04-06', 1, '2022-04-06 03:08:14', '2022-04-06 03:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `contact_no`, `email`, `created_at`, `updated_at`) VALUES
(1, 'gsks', NULL, 'gsk@gmail.com', '2022-03-26 23:44:04', '2022-03-27 00:01:38'),
(2, 'sdfkjl', 'sdfsjlkd', 'sfdljksd', '2022-03-26 23:44:29', '2022-03-26 23:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_accounts`
--

CREATE TABLE `supplier_accounts` (
  `supplie_account_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL DEFAULT 0,
  `money` double(8,2) NOT NULL DEFAULT 0.00,
  `paid` double(8,2) NOT NULL DEFAULT 0.00,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `transfer_id` bigint(20) UNSIGNED NOT NULL,
  `source_stock_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_stock_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_items`
--

CREATE TABLE `transfer_items` (
  `transfer_item_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  ADD PRIMARY KEY (`customer_account_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `measure_units`
--
ALTER TABLE `measure_units`
  ADD PRIMARY KEY (`measure_unit_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`purchase_item_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`reutrn_id`);

--
-- Indexes for table `return_items`
--
ALTER TABLE `return_items`
  ADD PRIMARY KEY (`return_item_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`sale_item_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `seller_accounts`
--
ALTER TABLE `seller_accounts`
  ADD PRIMARY KEY (`seller_account_id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD PRIMARY KEY (`stock_item_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_accounts`
--
ALTER TABLE `supplier_accounts`
  ADD PRIMARY KEY (`supplie_account_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `transfer_items`
--
ALTER TABLE `transfer_items`
  ADD PRIMARY KEY (`transfer_item_id`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  MODIFY `customer_account_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `measure_units`
--
ALTER TABLE `measure_units`
  MODIFY `measure_unit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `province_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `purchase_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `reutrn_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_items`
--
ALTER TABLE `return_items`
  MODIFY `return_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `sale_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_accounts`
--
ALTER TABLE `seller_accounts`
  MODIFY `seller_account_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `site_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `stock_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_accounts`
--
ALTER TABLE `supplier_accounts`
  MODIFY `supplie_account_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_items`
--
ALTER TABLE `transfer_items`
  MODIFY `transfer_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
