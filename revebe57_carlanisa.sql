-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2022 at 09:27 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `revebe57_carlanisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustments`
--

CREATE TABLE `adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `attached_documents` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `AR_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CYID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `w_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `attr_value`, `w_id`, `created_at`, `updated_at`) VALUES
(1, 'Ready To Wear Size', 'XS,S,M,L,XL,2XL,3XL', 2, '2022-09-07 19:52:43', '2022-09-07 19:52:43'),
(2, 'Open Meter', 'P/meter,4.25 Meter,4.5 Meter,5 Meter', 3, '2022-09-11 14:25:11', '2022-09-14 15:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `BR_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BR_Email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BR_Phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CYID` bigint(20) UNSIGNED DEFAULT NULL,
  `BR_Address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BR_Address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CMPID` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_image`, `created_at`, `updated_at`) VALUES
(1, 'Carlanisa', NULL, '2022-09-07 19:57:03', '2022-09-07 19:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_decimal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `business_name`, `business_logo`, `default_currency`, `currency_decimal`, `time_zone`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Carlanisa Sdn Bhd.', '20220907182814.png', '1', '2', NULL, NULL, NULL, NULL, '2022-09-07 23:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `cash_registers`
--

CREATE TABLE `cash_registers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `cash_in_hand` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_sale` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_payment` decimal(8,2) NOT NULL DEFAULT '0.00',
  `cash_payment` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_card_payment` decimal(8,2) NOT NULL DEFAULT '0.00',
  `qr_code_payment` decimal(8,2) NOT NULL DEFAULT '0.00',
  `other_payment` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_sale_return` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_expense` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 mean open 1 mean closed',
  `open_by` bigint(20) UNSIGNED DEFAULT '0',
  `closed_by` bigint(20) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_registers`
--

INSERT INTO `cash_registers` (`id`, `WHID`, `cash_in_hand`, `total_sale`, `total_payment`, `cash_payment`, `credit_card_payment`, `qr_code_payment`, `other_payment`, `total_sale_return`, `total_expense`, `status`, `open_by`, `closed_by`, `created_at`, `updated_at`) VALUES
(1, 3, '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 1, 0, '2022-09-08 13:59:15', '2022-09-12 20:52:38'),
(2, 4, '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 1, 0, '2022-09-08 13:59:29', '2022-09-12 20:52:38'),
(3, 4, '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, 1, 0, '2022-09-12 21:43:21', '2022-09-12 21:43:21'),
(4, 3, '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 5, 0, '2022-09-16 23:49:37', '2022-09-17 01:37:10'),
(5, 4, '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, 4, 0, '2022-09-17 12:36:03', '2022-09-17 12:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `w_cat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `w_cat_id`, `created_at`, `updated_at`) VALUES
(1, 'Azalea | Kurung Moden Songket', 194, '2022-09-08 19:20:35', '2022-09-08 19:20:35'),
(2, 'Cotton | Baju Kurung Moden - 3 Pasang RM 100', 195, '2022-09-08 19:20:44', '2022-09-08 19:20:44'),
(3, 'Lily | Baju Kurung Riau Moden Songket', 196, '2022-09-08 19:20:52', '2022-09-08 19:20:52'),
(4, 'Luna | Kebarung Klasik Cotton Plain', 197, '2022-09-08 19:21:02', '2022-09-08 19:21:02'),
(5, 'Sakura | Baju Kurung Moden Embroidery', 198, '2022-09-08 19:21:10', '2022-09-08 19:21:10'),
(6, 'Melati | Kurung Riau Moden Plain', 199, '2022-09-08 19:21:16', '2022-09-08 19:21:16'),
(7, 'Vivah | Kurung Moden Songket', 200, '2022-09-08 19:21:23', '2022-09-08 19:21:23'),
(8, 'Raya | Kurung Moden Songket', 201, '2022-09-08 19:21:32', '2022-09-08 19:21:32'),
(9, 'Riza | Kurung Moden Songket', 202, '2022-09-08 19:21:38', '2022-09-08 19:21:38'),
(10, 'Fana | Kurung Moden Songket', 203, '2022-09-08 19:22:00', '2022-09-08 19:22:00'),
(11, 'Liana Kurung Moden Songket', 204, '2022-09-08 19:22:08', '2022-09-08 19:22:08'),
(12, 'Songket Tenun | 11\" Inch Border', 205, '2022-09-08 19:22:30', '2022-09-08 19:22:30'),
(13, 'Songket Tenun | Lily Star Bunga Tabur', 206, '2022-09-08 19:22:35', '2022-09-08 19:22:35'),
(14, 'Songket Tenun | Star Flower Border', 207, '2022-09-08 19:22:41', '2022-09-08 19:22:41'),
(15, 'Songket Tenun 3D | One Side Border', 208, '2022-09-08 19:22:46', '2022-09-08 19:22:46'),
(16, 'Songket Tenun | Star Flower', 209, '2022-09-08 19:22:51', '2022-09-08 19:22:51'),
(17, 'Songket Tenun | Star Flower Shaded', 210, '2022-09-08 19:22:56', '2022-09-08 19:22:56'),
(18, 'Songket Tenun | Bunga tabur', 211, '2022-09-08 19:23:02', '2022-09-08 19:23:02'),
(19, 'Songket Tenun | Bunga Raya', 212, '2022-09-08 19:23:08', '2022-09-08 19:23:08'),
(20, 'Songket Tenun | Matching', 213, '2022-09-08 19:23:18', '2022-09-08 19:23:18'),
(21, 'Instant Sarung | Mia', 214, '2022-09-08 19:23:32', '2022-09-08 19:23:32'),
(22, 'Instant Shawl | Fast 2.O', 215, '2022-09-08 19:23:37', '2022-09-08 19:23:37'),
(23, 'Instant Sarung | Moss', 216, '2022-09-08 19:25:22', '2022-09-08 19:25:22'),
(24, 'Instant Shawl | Slit', 217, '2022-09-08 19:25:28', '2022-09-08 19:25:28'),
(25, 'Instant Shawl | Marisa', 218, '2022-09-08 19:25:35', '2022-09-08 19:25:35'),
(26, 'Instant Shawl | Rania Seminit', 219, '2022-09-08 19:25:41', '2022-09-08 19:25:41'),
(27, 'Instant Shawl | Superfast Bergetah', 220, '2022-09-08 19:25:49', '2022-09-08 19:25:49'),
(28, 'Bawal Square Hijab | Collection', 221, '2022-09-08 19:26:16', '2022-09-08 19:26:16'),
(29, 'Shawl Plain Stone | Sofya', 222, '2022-09-08 19:38:47', '2022-09-08 19:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Ch_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CY_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ZID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `costcenters`
--

CREATE TABLE `costcenters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CC_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CT_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `exchange_rate`, `created_at`, `updated_at`) VALUES
(1, 'RM', 'RM', '1', '2022-09-07 23:13:44', '2022-09-07 23:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `trans_id`, `company_name`, `customer_group_id`, `email`, `phone_number`, `address`, `tax_number`, `city_id`, `country_id`, `postal_code`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Carlanisa', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-07 23:20:48', '2022-09-07 23:20:48'),
(2, 'waqas', 7, NULL, 1, NULL, '60192555975', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-08 14:02:50', '2022-09-08 14:02:50'),
(3, 'Walk In Customer', 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-15 14:21:54', '2022-09-15 14:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `name`, `percentage`, `created_at`, `updated_at`) VALUES
(1, 'General', '0', '2022-09-07 23:20:13', '2022-09-07 23:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `customer_items`
--

CREATE TABLE `customer_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `C_ItemID` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `C_Item_Price` decimal(50,2) NOT NULL,
  `CID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Customer_Type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_from` date NOT NULL,
  `valid_till` date NOT NULL,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_qty` int(11) NOT NULL,
  `days` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_on` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_photo` text COLLATE utf8mb4_unicode_ci,
  `dep_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created_By` bigint(20) UNSIGNED DEFAULT NULL,
  `Updated_By` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(17, 'bcf33a3b-0926-4295-9d9d-8e032b3f69b7', 'database', 'default', '{\"uuid\":\"bcf33a3b-0926-4295-9d9d-8e032b3f69b7\",\"displayName\":\"App\\\\Jobs\\\\UodatWordpressQty\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\UodatWordpressQty\",\"command\":\"O:26:\\\"App\\\\Jobs\\\\UodatWordpressQty\\\":11:{s:7:\\\"message\\\";a:4:{i:0;i:280;i:1;i:281;i:2;a:1:{s:14:\\\"stock_quantity\\\";i:22;}i:3;i:30;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2022-09-13 03:12:23.156817\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Exception: Error: Sorry, you are not allowed to edit this resource. [woocommerce_rest_cannot_edit] in /home3/revebe57/public_html/carlanisa.revebe.com/vendor/codexshaper/laravel-woocommerce/src/Traits/WooCommerceTrait.php:83\nStack trace:\n#0 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(261): Codexshaper\\WooCommerce\\WooCommerceApi->update(\'products/280\', Array)\n#1 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/codexshaper/laravel-woocommerce/src/Traits/QueryBuilderTrait.php(116): Illuminate\\Support\\Facades\\Facade::__callStatic(\'update\', Array)\n#2 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/codexshaper/laravel-woocommerce/src/Models/BaseModel.php(45): Codexshaper\\WooCommerce\\Models\\Product->update(280, Array)\n#3 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(261): Codexshaper\\WooCommerce\\Models\\BaseModel->__call(\'update\', Array)\n#4 /home3/revebe57/public_html/carlanisa.revebe.com/app/Jobs/UodatWordpressQty.php(35): Illuminate\\Support\\Facades\\Facade::__callStatic(\'update\', Array)\n#5 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\UodatWordpressQty->handle()\n#6 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#7 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#8 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#9 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(611): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#10 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#11 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\UodatWordpressQty))\n#12 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\UodatWordpressQty))\n#13 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#14 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(118): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\UodatWordpressQty), false)\n#15 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\UodatWordpressQty))\n#16 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\UodatWordpressQty))\n#17 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#18 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\UodatWordpressQty))\n#19 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#20 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(410): Illuminate\\Queue\\Jobs\\Job->fire()\n#21 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(360): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#22 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(158): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#23 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#24 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#25 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#26 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#27 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#28 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#29 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(611): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#30 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call(Array)\n#31 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/symfony/console/Command/Command.php(256): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Illuminate\\Console\\OutputStyle))\n#32 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Illuminate\\Console\\OutputStyle))\n#33 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/symfony/console/Application.php(971): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#34 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/symfony/console/Application.php(290): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#35 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/symfony/console/Application.php(166): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#36 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(92): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#37 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(184): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#38 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(263): Illuminate\\Console\\Application->call(\'queue:work\', Array, NULL)\n#39 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(261): Illuminate\\Foundation\\Console\\Kernel->call(\'queue:work\')\n#40 /home3/revebe57/public_html/carlanisa.revebe.com/routes/web.php(19): Illuminate\\Support\\Facades\\Facade::__callStatic(\'call\', Array)\n#41 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Routing/Route.php(230): Illuminate\\Routing\\RouteFileRegistrar->{closure}()\n#42 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Routing/Route.php(200): Illuminate\\Routing\\Route->runCallable()\n#43 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Routing/Router.php(695): Illuminate\\Routing\\Route->run()\n#44 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Routing\\Router->Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))\n#45 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#46 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#47 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/VerifyCsrfToken.php(78): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#48 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#49 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/View/Middleware/ShareErrorsFromSession.php(49): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#50 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\View\\Middleware\\ShareErrorsFromSession->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#51 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/AuthenticateSession.php(58): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#52 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Session\\Middleware\\AuthenticateSession->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#53 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php(121): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#54 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php(64): Illuminate\\Session\\Middleware\\StartSession->handleStatefulRequest(Object(Illuminate\\Http\\Request), Object(Illuminate\\Session\\Store), Object(Closure))\n#55 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Session\\Middleware\\StartSession->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#56 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/AddQueuedCookiesToResponse.php(37): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#57 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#58 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php(67): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#59 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Cookie\\Middleware\\EncryptCookies->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#60 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#61 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Routing/Router.php(697): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#62 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Routing/Router.php(672): Illuminate\\Routing\\Router->runRouteWithinStack(Object(Illuminate\\Routing\\Route), Object(Illuminate\\Http\\Request))\n#63 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Routing/Router.php(636): Illuminate\\Routing\\Router->runRoute(Object(Illuminate\\Http\\Request), Object(Illuminate\\Routing\\Route))\n#64 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Routing/Router.php(625): Illuminate\\Routing\\Router->dispatchToRoute(Object(Illuminate\\Http\\Request))\n#65 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(166): Illuminate\\Routing\\Router->dispatch(Object(Illuminate\\Http\\Request))\n#66 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Foundation\\Http\\Kernel->Illuminate\\Foundation\\Http\\{closure}(Object(Illuminate\\Http\\Request))\n#67 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#68 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#69 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#70 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#71 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php(40): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#72 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#73 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#74 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#75 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php(86): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#76 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#77 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/fruitcake/laravel-cors/src/HandleCors.php(37): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#78 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Fruitcake\\Cors\\HandleCors->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#79 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/fideloper/proxy/src/TrustProxies.php(57): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#80 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(167): Fideloper\\Proxy\\TrustProxies->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#81 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#82 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(141): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#83 /home3/revebe57/public_html/carlanisa.revebe.com/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(110): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter(Object(Illuminate\\Http\\Request))\n#84 /home3/revebe57/public_html/carlanisa.revebe.com/index.php(52): Illuminate\\Foundation\\Http\\Kernel->handle(Object(Illuminate\\Http\\Request))\n#85 {main}', '2022-09-13 08:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `gate_passes`
--

CREATE TABLE `gate_passes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `SUPID` bigint(20) UNSIGNED NOT NULL,
  `POID` bigint(20) UNSIGNED NOT NULL,
  `Driver_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Driver_cnic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Vehicle_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Vehicle_type` bigint(20) UNSIGNED DEFAULT NULL,
  `No_bags` bigint(20) DEFAULT NULL,
  `F_weight` decimal(50,2) DEFAULT NULL,
  `S_weight` decimal(50,2) DEFAULT NULL,
  `Net_weight` decimal(50,2) DEFAULT NULL,
  `Delivery_address` text COLLATE utf8mb4_unicode_ci,
  `BID` bigint(20) UNSIGNED DEFAULT NULL,
  `Weighing_charges` decimal(50,2) DEFAULT NULL,
  `Trans_charges` decimal(50,2) DEFAULT NULL,
  `Raw_material_nature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Time_in` time DEFAULT NULL,
  `Time_out` time DEFAULT NULL,
  `Unloading_time` time DEFAULT NULL,
  `Unloading_type` bigint(20) UNSIGNED DEFAULT NULL,
  `WHID` bigint(20) UNSIGNED DEFAULT NULL,
  `Bilty_No` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DC_No` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fanacial_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Owner_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `Updated_By` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `head_accounts`
--

CREATE TABLE `head_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Head_Ac_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RID` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `head_accounts`
--

INSERT INTO `head_accounts` (`id`, `Head_Ac_Name`, `RID`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Current Assets', 1, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(2, 'Fixed Assets', 1, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(3, 'Current Liability', 2, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(4, 'Long Term Liabilities', 2, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(5, 'Shareholders\' Equity', 3, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(6, 'Capital', 3, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(7, 'Revenue', 4, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(8, 'Retained Earnings', 4, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(9, 'Operating Expenses', 5, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(10, 'Financial Expenses', 5, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(11, 'Cost Of Revenue', 5, NULL, '2022-06-18 13:06:52', '2022-06-18 13:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Item_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Item_Article` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BRID` bigint(20) UNSIGNED DEFAULT NULL,
  `Item_Origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Item_Tech` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Item_Pack_Size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Item_UOM` bigint(20) UNSIGNED DEFAULT NULL,
  `Item_Min_Qty` bigint(20) DEFAULT NULL,
  `Item_Max_Qty` bigint(20) DEFAULT NULL,
  `Item_Hold_Qty` bigint(20) DEFAULT NULL,
  `Item_Booked_Qty` bigint(20) DEFAULT NULL,
  `Item_Type` bigint(20) UNSIGNED DEFAULT NULL,
  `Item_Inventory` tinyint(1) DEFAULT NULL,
  `Item_Valuation_Method` bigint(20) UNSIGNED DEFAULT NULL,
  `Dealer_Margin` decimal(8,2) DEFAULT NULL,
  `Item_sale_Unit` decimal(50,2) DEFAULT NULL,
  `Item_sale_Fraction` decimal(50,2) DEFAULT NULL,
  `Item_Purchase_Unit` decimal(50,2) DEFAULT NULL,
  `Item_Purchase_Fraction` decimal(50,2) DEFAULT NULL,
  `Item_Price_Ex_Gst` decimal(50,2) DEFAULT NULL,
  `Item_STax_Per` decimal(50,2) DEFAULT NULL,
  `Item_Price_Inc_Gst` decimal(50,2) DEFAULT NULL,
  `Item_Total_Rec` decimal(50,2) DEFAULT NULL,
  `Item_Total_Issued` decimal(50,2) DEFAULT NULL,
  `Item_Balance` decimal(50,2) DEFAULT NULL,
  `GL_Sale` bigint(20) UNSIGNED DEFAULT NULL,
  `GL_Purchase` bigint(20) UNSIGNED DEFAULT NULL,
  `GL_Discount` bigint(20) UNSIGNED DEFAULT NULL,
  `GL_STax` bigint(20) UNSIGNED DEFAULT NULL,
  `BID` bigint(20) UNSIGNED DEFAULT NULL,
  `Created_BY` bigint(20) UNSIGNED DEFAULT NULL,
  `Updated_By` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item__details`
--

CREATE TABLE `item__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `unit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_port` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_from_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `encryption` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_settings`
--

INSERT INTO `mail_settings` (`id`, `mail_host`, `mail_port`, `mail_address`, `password`, `mail_from_name`, `encryption`, `created_at`, `updated_at`) VALUES
(1, 'revebe.com', '21', 'mail.revebe.com', '$2y$10$jc4frnEpUSZXqdjFoK/YmuB0SuFqGB9PD2lNWpGIm96xyzVdVZ86y', 'azeem@revebe.com', 'afafafa', '2022-08-01 14:39:41', '2022-08-01 14:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2020_05_21_100000_create_teams_table', 1),
(12, '2020_05_21_200000_create_team_user_table', 1),
(13, '2020_05_21_300000_create_team_invitations_table', 1),
(14, '2021_04_27_191325_create_sessions_table', 1),
(15, '2021_05_04_101818_create_permission_tables', 1),
(16, '2021_05_04_101913_create_products_table', 1),
(17, '2021_05_17_055036_create_root_accounts_table', 1),
(18, '2021_05_17_065641_create_head_accounts_table', 1),
(19, '2021_05_19_105405_create_sub_heads_table', 1),
(20, '2021_05_20_113443_create_trans_accounts_table', 1),
(21, '2021_05_24_052106_create_where_houses_table', 1),
(22, '2021_05_26_174915_create_zones_table', 1),
(23, '2021_05_26_175300_create_countries_table', 1),
(24, '2021_05_26_175535_create_cities_table', 1),
(25, '2021_05_26_175550_create_areas_table', 1),
(26, '2021_06_08_071634_create_customers_table', 1),
(27, '2021_06_08_090335_create_suppliers_table', 1),
(28, '2021_06_08_091242_create_employees_table', 1),
(29, '2021_06_08_153647_create_sale_invoices_table', 1),
(30, '2021_06_08_154945_create_stock_details_table', 1),
(31, '2021_06_09_111442_create_costcenters_table', 1),
(32, '2021_06_09_132545_create_charges_table', 1),
(33, '2021_06_11_054139_create_unit_types_table', 1),
(34, '2021_06_11_055937_create_transports_table', 1),
(35, '2021_06_17_064142_create_items_table', 1),
(36, '2021_06_21_072153_create_customer_items_table', 1),
(37, '2021_07_01_092845_create_branches_table', 1),
(38, '2021_07_08_060743_create_designations_table', 1),
(39, '2021_07_08_065642_create_customer_types_table', 1),
(40, '2021_07_12_100638_create_transactions_table', 1),
(41, '2021_07_15_080131_create_banks_table', 1),
(42, '2021_08_05_045505_create_purchase_orders_table', 1),
(43, '2021_08_07_162242_create_item__details_table', 1),
(44, '2021_08_11_172034_create_gate_passes_table', 1),
(45, '2021_08_16_162053_create_purchase_invoices_table', 1),
(46, '2022_04_30_123813_create_discounts_table', 1),
(47, '2022_05_06_133950_create_departments_table', 1),
(48, '2022_05_06_134106_create_categories_table', 1),
(49, '2022_05_06_134234_create_customer_groups_table', 1),
(50, '2022_05_10_010013_create_brands_table', 1),
(51, '2022_05_10_181607_create_product_variants_table', 1),
(52, '2022_05_10_182036_create_product_warehouse_prices_table', 1),
(53, '2022_05_11_104534_create_warehouses_table', 1),
(54, '2022_05_13_005152_create_holidays_table', 1),
(55, '2022_05_23_160339_create_taxes_table', 1),
(56, '2022_05_24_172136_create_currencies_table', 1),
(58, '2022_05_30_161235_create_payrolls_table', 1),
(59, '2022_06_02_014308_create_quotations_table', 1),
(60, '2022_06_13_110843_create_attributes_table', 1),
(61, '2022_05_25_012443_create_sale_persons_table', 2),
(62, '2022_06_25_141701_create_sale_returns_table', 3),
(63, '2022_06_26_140836_create_purchase_returns_table', 3),
(65, '2022_07_02_093140_create_receipt_vouchers_table', 4),
(66, '2022_07_04_165317_create_payment_vouchers_table', 5),
(67, '2022_07_08_172902_create_jobs_table', 6),
(68, '2022_07_02_153031_create_mail_settings_table', 7),
(69, '2022_07_14_170852_create_o_inventories_table', 7),
(70, '2022_07_16_163033_create_transfers_table', 8),
(71, '2022_07_18_151608_create_adjustments_table', 9),
(72, '2022_07_28_172214_create_pos_settings_table', 10),
(73, '2022_06_29_155013_create_business_settings_table', 11),
(74, '2022_08_05_192555_create_notifications_table', 12),
(75, '2022_08_06_144637_create_cash_registers_table', 13),
(76, '2022_08_23_111348_create_woocommerce_settings_table', 14),
(77, '2022_08_23_111418_create_whatsapp_settings_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 2),
(6, 'App\\Models\\User', 3),
(7, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o_inventories`
--

CREATE TABLE `o_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `total_qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_vouchers`
--

CREATE TABLE `payment_vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trans_date` date NOT NULL,
  `trans_acc_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` bigint(20) UNSIGNED NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `trans_code` bigint(20) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `salary_from_acc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowances` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deductions` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_salary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `form` tinyint(1) NOT NULL DEFAULT '0',
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `parent_id`, `form`, `guard_name`, `created_at`, `updated_at`) VALUES
(13, 'Dashboard', NULL, 0, 'web', '2022-07-30 12:49:53', '2022-07-30 12:49:53'),
(14, 'dashboard_view', 13, 0, 'web', '2022-07-30 12:49:53', '2022-07-30 12:49:53'),
(15, 'Quotation', NULL, 1, 'web', '2022-07-30 12:50:44', '2022-07-30 12:50:44'),
(16, 'quotation_view', 15, 0, 'web', '2022-07-30 12:50:44', '2022-07-30 12:50:44'),
(17, 'quotation_create', 15, 0, 'web', '2022-07-30 12:50:44', '2022-07-30 12:50:44'),
(18, 'quotation_edit', 15, 0, 'web', '2022-07-30 12:50:44', '2022-07-30 12:50:44'),
(19, 'quotation_delete', 15, 0, 'web', '2022-07-30 12:50:44', '2022-07-30 12:50:44'),
(20, 'quotation_approve', 15, 0, 'web', '2022-07-30 12:50:44', '2022-07-30 12:50:44'),
(21, 'quotation_send', 15, 0, 'web', '2022-07-30 12:50:44', '2022-07-30 12:50:44'),
(22, 'quotation_upload', 15, 0, 'web', '2022-07-30 12:50:44', '2022-07-30 12:50:44'),
(23, 'Product', NULL, 1, 'web', '2022-07-30 13:14:10', '2022-07-30 13:14:10'),
(24, 'product_view', 23, 0, 'web', '2022-07-30 13:14:11', '2022-07-30 13:14:11'),
(25, 'product_create', 23, 0, 'web', '2022-07-30 13:14:11', '2022-07-30 13:14:11'),
(26, 'product_edit', 23, 0, 'web', '2022-07-30 13:14:11', '2022-07-30 13:14:11'),
(27, 'product_delete', 23, 0, 'web', '2022-07-30 13:14:11', '2022-07-30 13:14:11'),
(28, 'product_approve', 23, 0, 'web', '2022-07-30 13:14:11', '2022-07-30 13:14:11'),
(29, 'product_send', 23, 0, 'web', '2022-07-30 13:14:11', '2022-07-30 13:14:11'),
(30, 'product_upload', 23, 0, 'web', '2022-07-30 13:14:11', '2022-07-30 13:14:11'),
(31, 'Product Attribute', NULL, 1, 'web', '2022-08-01 13:11:18', '2022-08-01 13:11:18'),
(32, 'product_attribute_view', 31, 0, 'web', '2022-08-01 13:11:18', '2022-08-01 13:11:18'),
(33, 'product_attribute_create', 31, 0, 'web', '2022-08-01 13:11:18', '2022-08-01 13:11:18'),
(34, 'product_attribute_edit', 31, 0, 'web', '2022-08-01 13:11:18', '2022-08-01 13:11:18'),
(35, 'product_attribute_delete', 31, 0, 'web', '2022-08-01 13:11:18', '2022-08-01 13:11:18'),
(36, 'product_attribute_approve', 31, 0, 'web', '2022-08-01 13:11:18', '2022-08-01 13:11:18'),
(37, 'product_attribute_send', 31, 0, 'web', '2022-08-01 13:11:18', '2022-08-01 13:11:18'),
(38, 'product_attribute_upload', 31, 0, 'web', '2022-08-01 13:11:18', '2022-08-01 13:11:18'),
(39, 'Discount', NULL, 1, 'web', '2022-08-31 11:18:59', '2022-08-31 11:18:59'),
(40, 'discount_view', 39, 0, 'web', '2022-08-31 11:18:59', '2022-08-31 11:18:59'),
(41, 'discount_create', 39, 0, 'web', '2022-08-31 11:18:59', '2022-08-31 11:18:59'),
(42, 'discount_edit', 39, 0, 'web', '2022-08-31 11:18:59', '2022-08-31 11:18:59'),
(43, 'discount_delete', 39, 0, 'web', '2022-08-31 11:18:59', '2022-08-31 11:18:59'),
(44, 'discount_approve', 39, 0, 'web', '2022-08-31 11:18:59', '2022-08-31 11:18:59'),
(45, 'discount_send', 39, 0, 'web', '2022-08-31 11:18:59', '2022-08-31 11:18:59'),
(46, 'discount_upload', 39, 0, 'web', '2022-08-31 11:18:59', '2022-08-31 11:18:59'),
(47, 'Sale', NULL, 0, 'web', '2022-08-31 11:19:11', '2022-08-31 11:19:11'),
(48, 'sale_view', 47, 0, 'web', '2022-08-31 11:19:11', '2022-08-31 11:19:11'),
(49, 'Website Order', NULL, 0, 'web', '2022-08-31 11:19:28', '2022-08-31 11:19:28'),
(50, 'website_order_view', 49, 0, 'web', '2022-08-31 11:19:28', '2022-08-31 11:19:28'),
(51, 'POS', NULL, 1, 'web', '2022-08-31 11:20:02', '2022-08-31 11:20:02'),
(52, 'pos_view', 51, 0, 'web', '2022-08-31 11:20:02', '2022-08-31 11:20:02'),
(53, 'pos_create', 51, 0, 'web', '2022-08-31 11:20:02', '2022-08-31 11:20:02'),
(54, 'pos_edit', 51, 0, 'web', '2022-08-31 11:20:02', '2022-08-31 11:20:02'),
(55, 'pos_delete', 51, 0, 'web', '2022-08-31 11:20:02', '2022-08-31 11:20:02'),
(56, 'pos_approve', 51, 0, 'web', '2022-08-31 11:20:02', '2022-08-31 11:20:02'),
(57, 'pos_send', 51, 0, 'web', '2022-08-31 11:20:02', '2022-08-31 11:20:02'),
(58, 'pos_upload', 51, 0, 'web', '2022-08-31 11:20:02', '2022-08-31 11:20:02'),
(59, 'Import Sale By CSV', NULL, 0, 'web', '2022-08-31 11:20:15', '2022-08-31 11:20:15'),
(60, 'import_sale_by_csv_view', 59, 0, 'web', '2022-08-31 11:20:15', '2022-08-31 11:20:15'),
(61, 'Gift Card', NULL, 0, 'web', '2022-08-31 11:20:38', '2022-08-31 11:20:38'),
(62, 'gift_card_view', 61, 0, 'web', '2022-08-31 11:20:38', '2022-08-31 11:20:38'),
(63, 'Coupon', NULL, 0, 'web', '2022-08-31 11:21:11', '2022-08-31 11:21:11'),
(64, 'coupon_view', 63, 0, 'web', '2022-08-31 11:21:11', '2022-08-31 11:21:11'),
(65, 'Purchase', NULL, 0, 'web', '2022-08-31 11:21:31', '2022-08-31 11:21:31'),
(66, 'purchase_view', 65, 0, 'web', '2022-08-31 11:21:31', '2022-08-31 11:21:31'),
(67, 'Purchase list', NULL, 1, 'web', '2022-08-31 11:21:55', '2022-08-31 11:21:55'),
(68, 'purchase_list_view', 67, 0, 'web', '2022-08-31 11:21:55', '2022-08-31 11:21:55'),
(69, 'purchase_list_create', 67, 0, 'web', '2022-08-31 11:21:55', '2022-08-31 11:21:55'),
(70, 'purchase_list_edit', 67, 0, 'web', '2022-08-31 11:21:55', '2022-08-31 11:21:55'),
(71, 'purchase_list_delete', 67, 0, 'web', '2022-08-31 11:21:55', '2022-08-31 11:21:55'),
(72, 'purchase_list_approve', 67, 0, 'web', '2022-08-31 11:21:55', '2022-08-31 11:21:55'),
(73, 'purchase_list_send', 67, 0, 'web', '2022-08-31 11:21:55', '2022-08-31 11:21:55'),
(74, 'purchase_list_upload', 67, 0, 'web', '2022-08-31 11:21:55', '2022-08-31 11:21:55'),
(75, 'Return', NULL, 0, 'web', '2022-08-31 11:22:15', '2022-08-31 11:22:15'),
(76, 'return_view', 75, 0, 'web', '2022-08-31 11:22:15', '2022-08-31 11:22:15'),
(77, 'Sale Return', NULL, 1, 'web', '2022-08-31 11:22:22', '2022-08-31 11:22:22'),
(78, 'sale_return_view', 77, 0, 'web', '2022-08-31 11:22:22', '2022-08-31 11:22:22'),
(79, 'sale_return_create', 77, 0, 'web', '2022-08-31 11:22:22', '2022-08-31 11:22:22'),
(80, 'sale_return_edit', 77, 0, 'web', '2022-08-31 11:22:22', '2022-08-31 11:22:22'),
(81, 'sale_return_delete', 77, 0, 'web', '2022-08-31 11:22:22', '2022-08-31 11:22:22'),
(82, 'sale_return_approve', 77, 0, 'web', '2022-08-31 11:22:22', '2022-08-31 11:22:22'),
(83, 'sale_return_send', 77, 0, 'web', '2022-08-31 11:22:22', '2022-08-31 11:22:22'),
(84, 'sale_return_upload', 77, 0, 'web', '2022-08-31 11:22:22', '2022-08-31 11:22:22'),
(85, 'Purchase Return', NULL, 1, 'web', '2022-08-31 11:22:33', '2022-08-31 11:22:33'),
(86, 'purchase_return_view', 85, 0, 'web', '2022-08-31 11:22:33', '2022-08-31 11:22:33'),
(87, 'purchase_return_create', 85, 0, 'web', '2022-08-31 11:22:33', '2022-08-31 11:22:33'),
(88, 'purchase_return_edit', 85, 0, 'web', '2022-08-31 11:22:33', '2022-08-31 11:22:33'),
(89, 'purchase_return_delete', 85, 0, 'web', '2022-08-31 11:22:33', '2022-08-31 11:22:33'),
(90, 'purchase_return_approve', 85, 0, 'web', '2022-08-31 11:22:33', '2022-08-31 11:22:33'),
(91, 'purchase_return_send', 85, 0, 'web', '2022-08-31 11:22:33', '2022-08-31 11:22:33'),
(92, 'purchase_return_upload', 85, 0, 'web', '2022-08-31 11:22:33', '2022-08-31 11:22:33'),
(93, 'Application Setup', NULL, 0, 'web', '2022-08-31 11:22:49', '2022-08-31 11:22:49'),
(94, 'application_setup_view', 93, 0, 'web', '2022-08-31 11:22:49', '2022-08-31 11:22:49'),
(95, 'Business Setting', NULL, 1, 'web', '2022-08-31 11:23:07', '2022-08-31 11:23:07'),
(96, 'business_setting_view', 95, 0, 'web', '2022-08-31 11:23:07', '2022-08-31 11:23:07'),
(97, 'business_setting_create', 95, 0, 'web', '2022-08-31 11:23:07', '2022-08-31 11:23:07'),
(98, 'business_setting_edit', 95, 0, 'web', '2022-08-31 11:23:07', '2022-08-31 11:23:07'),
(99, 'business_setting_delete', 95, 0, 'web', '2022-08-31 11:23:07', '2022-08-31 11:23:07'),
(100, 'business_setting_approve', 95, 0, 'web', '2022-08-31 11:23:07', '2022-08-31 11:23:07'),
(101, 'business_setting_send', 95, 0, 'web', '2022-08-31 11:23:07', '2022-08-31 11:23:07'),
(102, 'business_setting_upload', 95, 0, 'web', '2022-08-31 11:23:07', '2022-08-31 11:23:07'),
(103, 'Pos Setting', NULL, 0, 'web', '2022-08-31 11:23:20', '2022-08-31 11:23:20'),
(104, 'pos_setting_view', 103, 0, 'web', '2022-08-31 11:23:20', '2022-08-31 11:23:20'),
(105, 'Woocommerce Setting', NULL, 1, 'web', '2022-08-31 11:23:47', '2022-08-31 11:23:47'),
(106, 'woocommerce_setting_view', 105, 0, 'web', '2022-08-31 11:23:47', '2022-08-31 11:23:47'),
(107, 'woocommerce_setting_create', 105, 0, 'web', '2022-08-31 11:23:47', '2022-08-31 11:23:47'),
(108, 'woocommerce_setting_edit', 105, 0, 'web', '2022-08-31 11:23:47', '2022-08-31 11:23:47'),
(109, 'woocommerce_setting_delete', 105, 0, 'web', '2022-08-31 11:23:47', '2022-08-31 11:23:47'),
(110, 'woocommerce_setting_approve', 105, 0, 'web', '2022-08-31 11:23:47', '2022-08-31 11:23:47'),
(111, 'woocommerce_setting_send', 105, 0, 'web', '2022-08-31 11:23:47', '2022-08-31 11:23:47'),
(112, 'woocommerce_setting_upload', 105, 0, 'web', '2022-08-31 11:23:47', '2022-08-31 11:23:47'),
(113, 'Whatsapp', NULL, 1, 'web', '2022-08-31 11:24:01', '2022-08-31 11:24:01'),
(114, 'whatsapp_view', 113, 0, 'web', '2022-08-31 11:24:01', '2022-08-31 11:24:01'),
(115, 'whatsapp_create', 113, 0, 'web', '2022-08-31 11:24:01', '2022-08-31 11:24:01'),
(116, 'whatsapp_edit', 113, 0, 'web', '2022-08-31 11:24:01', '2022-08-31 11:24:01'),
(117, 'whatsapp_delete', 113, 0, 'web', '2022-08-31 11:24:01', '2022-08-31 11:24:01'),
(118, 'whatsapp_approve', 113, 0, 'web', '2022-08-31 11:24:01', '2022-08-31 11:24:01'),
(119, 'whatsapp_send', 113, 0, 'web', '2022-08-31 11:24:01', '2022-08-31 11:24:01'),
(120, 'whatsapp_upload', 113, 0, 'web', '2022-08-31 11:24:01', '2022-08-31 11:24:01'),
(121, 'Location', NULL, 1, 'web', '2022-08-31 11:24:13', '2022-08-31 11:24:13'),
(122, 'location_view', 121, 0, 'web', '2022-08-31 11:24:13', '2022-08-31 11:24:13'),
(123, 'location_create', 121, 0, 'web', '2022-08-31 11:24:13', '2022-08-31 11:24:13'),
(124, 'location_edit', 121, 0, 'web', '2022-08-31 11:24:13', '2022-08-31 11:24:13'),
(125, 'location_delete', 121, 0, 'web', '2022-08-31 11:24:13', '2022-08-31 11:24:13'),
(126, 'location_approve', 121, 0, 'web', '2022-08-31 11:24:13', '2022-08-31 11:24:13'),
(127, 'location_send', 121, 0, 'web', '2022-08-31 11:24:13', '2022-08-31 11:24:13'),
(128, 'location_upload', 121, 0, 'web', '2022-08-31 11:24:13', '2022-08-31 11:24:13'),
(129, 'Send Notification', NULL, 1, 'web', '2022-08-31 11:24:25', '2022-08-31 11:24:25'),
(130, 'send_notification_view', 129, 0, 'web', '2022-08-31 11:24:25', '2022-08-31 11:24:25'),
(131, 'send_notification_create', 129, 0, 'web', '2022-08-31 11:24:25', '2022-08-31 11:24:25'),
(132, 'send_notification_edit', 129, 0, 'web', '2022-08-31 11:24:25', '2022-08-31 11:24:25'),
(133, 'send_notification_delete', 129, 0, 'web', '2022-08-31 11:24:25', '2022-08-31 11:24:25'),
(134, 'send_notification_approve', 129, 0, 'web', '2022-08-31 11:24:25', '2022-08-31 11:24:25'),
(135, 'send_notification_send', 129, 0, 'web', '2022-08-31 11:24:25', '2022-08-31 11:24:25'),
(136, 'send_notification_upload', 129, 0, 'web', '2022-08-31 11:24:25', '2022-08-31 11:24:25'),
(137, 'Currency', NULL, 1, 'web', '2022-08-31 11:24:43', '2022-08-31 11:24:43'),
(138, 'currency_view', 137, 0, 'web', '2022-08-31 11:24:43', '2022-08-31 11:24:43'),
(139, 'currency_create', 137, 0, 'web', '2022-08-31 11:24:43', '2022-08-31 11:24:43'),
(140, 'currency_edit', 137, 0, 'web', '2022-08-31 11:24:43', '2022-08-31 11:24:43'),
(141, 'currency_delete', 137, 0, 'web', '2022-08-31 11:24:43', '2022-08-31 11:24:43'),
(142, 'currency_approve', 137, 0, 'web', '2022-08-31 11:24:43', '2022-08-31 11:24:43'),
(143, 'currency_send', 137, 0, 'web', '2022-08-31 11:24:43', '2022-08-31 11:24:43'),
(144, 'currency_upload', 137, 0, 'web', '2022-08-31 11:24:43', '2022-08-31 11:24:43'),
(145, 'Tax', NULL, 1, 'web', '2022-08-31 11:24:55', '2022-08-31 11:24:55'),
(146, 'tax_view', 145, 0, 'web', '2022-08-31 11:24:55', '2022-08-31 11:24:55'),
(147, 'tax_create', 145, 0, 'web', '2022-08-31 11:24:55', '2022-08-31 11:24:55'),
(148, 'tax_edit', 145, 0, 'web', '2022-08-31 11:24:55', '2022-08-31 11:24:55'),
(149, 'tax_delete', 145, 0, 'web', '2022-08-31 11:24:55', '2022-08-31 11:24:55'),
(150, 'tax_approve', 145, 0, 'web', '2022-08-31 11:24:55', '2022-08-31 11:24:55'),
(151, 'tax_send', 145, 0, 'web', '2022-08-31 11:24:55', '2022-08-31 11:24:55'),
(152, 'tax_upload', 145, 0, 'web', '2022-08-31 11:24:55', '2022-08-31 11:24:55'),
(153, 'Create Sms', NULL, 1, 'web', '2022-08-31 11:25:30', '2022-08-31 11:25:30'),
(154, 'create_sms_view', 153, 0, 'web', '2022-08-31 11:25:30', '2022-08-31 11:25:30'),
(155, 'create_sms_create', 153, 0, 'web', '2022-08-31 11:25:30', '2022-08-31 11:25:30'),
(156, 'create_sms_edit', 153, 0, 'web', '2022-08-31 11:25:30', '2022-08-31 11:25:30'),
(157, 'create_sms_delete', 153, 0, 'web', '2022-08-31 11:25:30', '2022-08-31 11:25:30'),
(158, 'create_sms_approve', 153, 0, 'web', '2022-08-31 11:25:30', '2022-08-31 11:25:30'),
(159, 'create_sms_send', 153, 0, 'web', '2022-08-31 11:25:30', '2022-08-31 11:25:30'),
(160, 'create_sms_upload', 153, 0, 'web', '2022-08-31 11:25:30', '2022-08-31 11:25:30'),
(161, 'Mail Setting', NULL, 1, 'web', '2022-08-31 11:25:42', '2022-08-31 11:25:42'),
(162, 'mail_setting_view', 161, 0, 'web', '2022-08-31 11:25:42', '2022-08-31 11:25:42'),
(163, 'mail_setting_create', 161, 0, 'web', '2022-08-31 11:25:42', '2022-08-31 11:25:42'),
(164, 'mail_setting_edit', 161, 0, 'web', '2022-08-31 11:25:42', '2022-08-31 11:25:42'),
(165, 'mail_setting_delete', 161, 0, 'web', '2022-08-31 11:25:42', '2022-08-31 11:25:42'),
(166, 'mail_setting_approve', 161, 0, 'web', '2022-08-31 11:25:42', '2022-08-31 11:25:42'),
(167, 'mail_setting_send', 161, 0, 'web', '2022-08-31 11:25:42', '2022-08-31 11:25:42'),
(168, 'mail_setting_upload', 161, 0, 'web', '2022-08-31 11:25:42', '2022-08-31 11:25:42'),
(169, 'Transfer', NULL, 0, 'web', '2022-08-31 11:47:52', '2022-08-31 11:47:52'),
(170, 'transfer_view', 169, 0, 'web', '2022-08-31 11:47:52', '2022-08-31 11:47:52'),
(171, 'Transfer List', NULL, 1, 'web', '2022-08-31 11:48:02', '2022-08-31 11:48:02'),
(172, 'transfer_list_view', 171, 0, 'web', '2022-08-31 11:48:02', '2022-08-31 11:48:02'),
(173, 'transfer_list_create', 171, 0, 'web', '2022-08-31 11:48:02', '2022-08-31 11:48:02'),
(174, 'transfer_list_edit', 171, 0, 'web', '2022-08-31 11:48:02', '2022-08-31 11:48:02'),
(175, 'transfer_list_delete', 171, 0, 'web', '2022-08-31 11:48:02', '2022-08-31 11:48:02'),
(176, 'transfer_list_approve', 171, 0, 'web', '2022-08-31 11:48:02', '2022-08-31 11:48:02'),
(177, 'transfer_list_send', 171, 0, 'web', '2022-08-31 11:48:02', '2022-08-31 11:48:02'),
(178, 'transfer_list_upload', 171, 0, 'web', '2022-08-31 11:48:02', '2022-08-31 11:48:02'),
(179, 'People', NULL, 0, 'web', '2022-08-31 11:48:26', '2022-08-31 11:48:26'),
(180, 'people_view', 179, 0, 'web', '2022-08-31 11:48:26', '2022-08-31 11:48:26'),
(181, 'Customer Group', NULL, 1, 'web', '2022-08-31 11:48:42', '2022-08-31 11:48:42'),
(182, 'customer_group_view', 181, 0, 'web', '2022-08-31 11:48:42', '2022-08-31 11:48:42'),
(183, 'customer_group_create', 181, 0, 'web', '2022-08-31 11:48:42', '2022-08-31 11:48:42'),
(184, 'customer_group_edit', 181, 0, 'web', '2022-08-31 11:48:42', '2022-08-31 11:48:42'),
(185, 'customer_group_delete', 181, 0, 'web', '2022-08-31 11:48:42', '2022-08-31 11:48:42'),
(186, 'customer_group_approve', 181, 0, 'web', '2022-08-31 11:48:42', '2022-08-31 11:48:42'),
(187, 'customer_group_send', 181, 0, 'web', '2022-08-31 11:48:42', '2022-08-31 11:48:42'),
(188, 'customer_group_upload', 181, 0, 'web', '2022-08-31 11:48:42', '2022-08-31 11:48:42'),
(189, 'Sale Person', NULL, 1, 'web', '2022-08-31 11:49:01', '2022-08-31 11:49:01'),
(190, 'sale_person_view', 189, 0, 'web', '2022-08-31 11:49:02', '2022-08-31 11:49:02'),
(191, 'sale_person_create', 189, 0, 'web', '2022-08-31 11:49:02', '2022-08-31 11:49:02'),
(192, 'sale_person_edit', 189, 0, 'web', '2022-08-31 11:49:02', '2022-08-31 11:49:02'),
(193, 'sale_person_delete', 189, 0, 'web', '2022-08-31 11:49:02', '2022-08-31 11:49:02'),
(194, 'sale_person_approve', 189, 0, 'web', '2022-08-31 11:49:02', '2022-08-31 11:49:02'),
(195, 'sale_person_send', 189, 0, 'web', '2022-08-31 11:49:02', '2022-08-31 11:49:02'),
(196, 'sale_person_upload', 189, 0, 'web', '2022-08-31 11:49:02', '2022-08-31 11:49:02'),
(197, 'Supplier List', NULL, 1, 'web', '2022-08-31 11:49:19', '2022-08-31 11:49:19'),
(198, 'supplier_list_view', 197, 0, 'web', '2022-08-31 11:49:19', '2022-08-31 11:49:19'),
(199, 'supplier_list_create', 197, 0, 'web', '2022-08-31 11:49:19', '2022-08-31 11:49:19'),
(200, 'supplier_list_edit', 197, 0, 'web', '2022-08-31 11:49:19', '2022-08-31 11:49:19'),
(201, 'supplier_list_delete', 197, 0, 'web', '2022-08-31 11:49:19', '2022-08-31 11:49:19'),
(202, 'supplier_list_approve', 197, 0, 'web', '2022-08-31 11:49:19', '2022-08-31 11:49:19'),
(203, 'supplier_list_send', 197, 0, 'web', '2022-08-31 11:49:20', '2022-08-31 11:49:20'),
(204, 'supplier_list_upload', 197, 0, 'web', '2022-08-31 11:49:20', '2022-08-31 11:49:20'),
(205, 'Accounts', NULL, 0, 'web', '2022-08-31 11:49:37', '2022-08-31 11:49:37'),
(206, 'accounts_view', 205, 0, 'web', '2022-08-31 11:49:37', '2022-08-31 11:49:37'),
(207, 'Root Account', NULL, 1, 'web', '2022-08-31 11:49:49', '2022-08-31 11:49:49'),
(208, 'root_account_view', 207, 0, 'web', '2022-08-31 11:49:49', '2022-08-31 11:49:49'),
(209, 'root_account_create', 207, 0, 'web', '2022-08-31 11:49:49', '2022-08-31 11:49:49'),
(210, 'root_account_edit', 207, 0, 'web', '2022-08-31 11:49:49', '2022-08-31 11:49:49'),
(211, 'root_account_delete', 207, 0, 'web', '2022-08-31 11:49:49', '2022-08-31 11:49:49'),
(212, 'root_account_approve', 207, 0, 'web', '2022-08-31 11:49:49', '2022-08-31 11:49:49'),
(213, 'root_account_send', 207, 0, 'web', '2022-08-31 11:49:49', '2022-08-31 11:49:49'),
(214, 'root_account_upload', 207, 0, 'web', '2022-08-31 11:49:50', '2022-08-31 11:49:50'),
(215, 'Head Account', NULL, 1, 'web', '2022-08-31 11:50:00', '2022-08-31 11:50:00'),
(216, 'head_account_view', 215, 0, 'web', '2022-08-31 11:50:00', '2022-08-31 11:50:00'),
(217, 'head_account_create', 215, 0, 'web', '2022-08-31 11:50:00', '2022-08-31 11:50:00'),
(218, 'head_account_edit', 215, 0, 'web', '2022-08-31 11:50:00', '2022-08-31 11:50:00'),
(219, 'head_account_delete', 215, 0, 'web', '2022-08-31 11:50:00', '2022-08-31 11:50:00'),
(220, 'head_account_approve', 215, 0, 'web', '2022-08-31 11:50:00', '2022-08-31 11:50:00'),
(221, 'head_account_send', 215, 0, 'web', '2022-08-31 11:50:01', '2022-08-31 11:50:01'),
(222, 'head_account_upload', 215, 0, 'web', '2022-08-31 11:50:01', '2022-08-31 11:50:01'),
(223, 'Subhead Account', NULL, 1, 'web', '2022-08-31 11:50:13', '2022-08-31 11:50:13'),
(224, 'subhead_account_view', 223, 0, 'web', '2022-08-31 11:50:13', '2022-08-31 11:50:13'),
(225, 'subhead_account_create', 223, 0, 'web', '2022-08-31 11:50:13', '2022-08-31 11:50:13'),
(226, 'subhead_account_edit', 223, 0, 'web', '2022-08-31 11:50:13', '2022-08-31 11:50:13'),
(227, 'subhead_account_delete', 223, 0, 'web', '2022-08-31 11:50:13', '2022-08-31 11:50:13'),
(228, 'subhead_account_approve', 223, 0, 'web', '2022-08-31 11:50:13', '2022-08-31 11:50:13'),
(229, 'subhead_account_send', 223, 0, 'web', '2022-08-31 11:50:13', '2022-08-31 11:50:13'),
(230, 'subhead_account_upload', 223, 0, 'web', '2022-08-31 11:50:13', '2022-08-31 11:50:13'),
(231, 'New Transaction Account', NULL, 1, 'web', '2022-08-31 11:50:26', '2022-08-31 11:50:26'),
(232, 'new_transaction_account_view', 231, 0, 'web', '2022-08-31 11:50:26', '2022-08-31 11:50:26'),
(233, 'new_transaction_account_create', 231, 0, 'web', '2022-08-31 11:50:26', '2022-08-31 11:50:26'),
(234, 'new_transaction_account_edit', 231, 0, 'web', '2022-08-31 11:50:26', '2022-08-31 11:50:26'),
(235, 'new_transaction_account_delete', 231, 0, 'web', '2022-08-31 11:50:26', '2022-08-31 11:50:26'),
(236, 'new_transaction_account_approve', 231, 0, 'web', '2022-08-31 11:50:26', '2022-08-31 11:50:26'),
(237, 'new_transaction_account_send', 231, 0, 'web', '2022-08-31 11:50:26', '2022-08-31 11:50:26'),
(238, 'new_transaction_account_upload', 231, 0, 'web', '2022-08-31 11:50:26', '2022-08-31 11:50:26'),
(239, 'Vouchers', NULL, 1, 'web', '2022-08-31 11:50:37', '2022-08-31 11:50:37'),
(240, 'vouchers_view', 239, 0, 'web', '2022-08-31 11:50:37', '2022-08-31 11:50:37'),
(241, 'vouchers_create', 239, 0, 'web', '2022-08-31 11:50:37', '2022-08-31 11:50:37'),
(242, 'vouchers_edit', 239, 0, 'web', '2022-08-31 11:50:37', '2022-08-31 11:50:37'),
(243, 'vouchers_delete', 239, 0, 'web', '2022-08-31 11:50:37', '2022-08-31 11:50:37'),
(244, 'vouchers_approve', 239, 0, 'web', '2022-08-31 11:50:37', '2022-08-31 11:50:37'),
(245, 'vouchers_send', 239, 0, 'web', '2022-08-31 11:50:37', '2022-08-31 11:50:37'),
(246, 'vouchers_upload', 239, 0, 'web', '2022-08-31 11:50:37', '2022-08-31 11:50:37'),
(247, 'Receipt Vouhcer', NULL, 1, 'web', '2022-08-31 11:50:51', '2022-08-31 11:50:51'),
(248, 'receipt_vouhcer_view', 247, 0, 'web', '2022-08-31 11:50:51', '2022-08-31 11:50:51'),
(249, 'receipt_vouhcer_create', 247, 0, 'web', '2022-08-31 11:50:51', '2022-08-31 11:50:51'),
(250, 'receipt_vouhcer_edit', 247, 0, 'web', '2022-08-31 11:50:51', '2022-08-31 11:50:51'),
(251, 'receipt_vouhcer_delete', 247, 0, 'web', '2022-08-31 11:50:51', '2022-08-31 11:50:51'),
(252, 'receipt_vouhcer_approve', 247, 0, 'web', '2022-08-31 11:50:51', '2022-08-31 11:50:51'),
(253, 'receipt_vouhcer_send', 247, 0, 'web', '2022-08-31 11:50:51', '2022-08-31 11:50:51'),
(254, 'receipt_vouhcer_upload', 247, 0, 'web', '2022-08-31 11:50:51', '2022-08-31 11:50:51'),
(255, 'Payment Voucher', NULL, 1, 'web', '2022-08-31 11:51:00', '2022-08-31 11:51:00'),
(256, 'payment_voucher_view', 255, 0, 'web', '2022-08-31 11:51:00', '2022-08-31 11:51:00'),
(257, 'payment_voucher_create', 255, 0, 'web', '2022-08-31 11:51:00', '2022-08-31 11:51:00'),
(258, 'payment_voucher_edit', 255, 0, 'web', '2022-08-31 11:51:00', '2022-08-31 11:51:00'),
(259, 'payment_voucher_delete', 255, 0, 'web', '2022-08-31 11:51:00', '2022-08-31 11:51:00'),
(260, 'payment_voucher_approve', 255, 0, 'web', '2022-08-31 11:51:00', '2022-08-31 11:51:00'),
(261, 'payment_voucher_send', 255, 0, 'web', '2022-08-31 11:51:00', '2022-08-31 11:51:00'),
(262, 'payment_voucher_upload', 255, 0, 'web', '2022-08-31 11:51:00', '2022-08-31 11:51:00'),
(263, 'Journal Voucher', NULL, 1, 'web', '2022-08-31 11:51:13', '2022-08-31 11:51:13'),
(264, 'journal_voucher_view', 263, 0, 'web', '2022-08-31 11:51:13', '2022-08-31 11:51:13'),
(265, 'journal_voucher_create', 263, 0, 'web', '2022-08-31 11:51:13', '2022-08-31 11:51:13'),
(266, 'journal_voucher_edit', 263, 0, 'web', '2022-08-31 11:51:14', '2022-08-31 11:51:14'),
(267, 'journal_voucher_delete', 263, 0, 'web', '2022-08-31 11:51:14', '2022-08-31 11:51:14'),
(268, 'journal_voucher_approve', 263, 0, 'web', '2022-08-31 11:51:14', '2022-08-31 11:51:14'),
(269, 'journal_voucher_send', 263, 0, 'web', '2022-08-31 11:51:14', '2022-08-31 11:51:14'),
(270, 'journal_voucher_upload', 263, 0, 'web', '2022-08-31 11:51:14', '2022-08-31 11:51:14'),
(271, 'HRM', NULL, 1, 'web', '2022-08-31 11:51:24', '2022-08-31 11:51:24'),
(272, 'hrm_view', 271, 0, 'web', '2022-08-31 11:51:24', '2022-08-31 11:51:24'),
(273, 'hrm_create', 271, 0, 'web', '2022-08-31 11:51:24', '2022-08-31 11:51:24'),
(274, 'hrm_edit', 271, 0, 'web', '2022-08-31 11:51:24', '2022-08-31 11:51:24'),
(275, 'hrm_delete', 271, 0, 'web', '2022-08-31 11:51:24', '2022-08-31 11:51:24'),
(276, 'hrm_approve', 271, 0, 'web', '2022-08-31 11:51:24', '2022-08-31 11:51:24'),
(277, 'hrm_send', 271, 0, 'web', '2022-08-31 11:51:24', '2022-08-31 11:51:24'),
(278, 'hrm_upload', 271, 0, 'web', '2022-08-31 11:51:24', '2022-08-31 11:51:24'),
(279, 'HRM Settings', NULL, 1, 'web', '2022-08-31 11:51:34', '2022-08-31 11:51:34'),
(280, 'hrm_settings_view', 279, 0, 'web', '2022-08-31 11:51:34', '2022-08-31 11:51:34'),
(281, 'hrm_settings_create', 279, 0, 'web', '2022-08-31 11:51:34', '2022-08-31 11:51:34'),
(282, 'hrm_settings_edit', 279, 0, 'web', '2022-08-31 11:51:34', '2022-08-31 11:51:34'),
(283, 'hrm_settings_delete', 279, 0, 'web', '2022-08-31 11:51:34', '2022-08-31 11:51:34'),
(284, 'hrm_settings_approve', 279, 0, 'web', '2022-08-31 11:51:34', '2022-08-31 11:51:34'),
(285, 'hrm_settings_send', 279, 0, 'web', '2022-08-31 11:51:34', '2022-08-31 11:51:34'),
(286, 'hrm_settings_upload', 279, 0, 'web', '2022-08-31 11:51:34', '2022-08-31 11:51:34'),
(287, 'Designation', NULL, 1, 'web', '2022-08-31 11:51:48', '2022-08-31 11:51:48'),
(288, 'designation_view', 287, 0, 'web', '2022-08-31 11:51:48', '2022-08-31 11:51:48'),
(289, 'designation_create', 287, 0, 'web', '2022-08-31 11:51:48', '2022-08-31 11:51:48'),
(290, 'designation_edit', 287, 0, 'web', '2022-08-31 11:51:48', '2022-08-31 11:51:48'),
(291, 'designation_delete', 287, 0, 'web', '2022-08-31 11:51:48', '2022-08-31 11:51:48'),
(292, 'designation_approve', 287, 0, 'web', '2022-08-31 11:51:48', '2022-08-31 11:51:48'),
(293, 'designation_send', 287, 0, 'web', '2022-08-31 11:51:48', '2022-08-31 11:51:48'),
(294, 'designation_upload', 287, 0, 'web', '2022-08-31 11:51:48', '2022-08-31 11:51:48'),
(295, 'Departments', NULL, 1, 'web', '2022-08-31 11:51:58', '2022-08-31 11:51:58'),
(296, 'departments_view', 295, 0, 'web', '2022-08-31 11:51:58', '2022-08-31 11:51:58'),
(297, 'departments_create', 295, 0, 'web', '2022-08-31 11:51:58', '2022-08-31 11:51:58'),
(298, 'departments_edit', 295, 0, 'web', '2022-08-31 11:51:58', '2022-08-31 11:51:58'),
(299, 'departments_delete', 295, 0, 'web', '2022-08-31 11:51:58', '2022-08-31 11:51:58'),
(300, 'departments_approve', 295, 0, 'web', '2022-08-31 11:51:58', '2022-08-31 11:51:58'),
(301, 'departments_send', 295, 0, 'web', '2022-08-31 11:51:58', '2022-08-31 11:51:58'),
(302, 'departments_upload', 295, 0, 'web', '2022-08-31 11:51:58', '2022-08-31 11:51:58'),
(303, 'Emloyee', NULL, 0, 'web', '2022-08-31 11:52:14', '2022-08-31 11:52:14'),
(304, 'emloyee_view', 303, 0, 'web', '2022-08-31 11:52:14', '2022-08-31 11:52:14'),
(305, 'Attendance', NULL, 1, 'web', '2022-08-31 11:52:37', '2022-08-31 11:52:37'),
(306, 'attendance_view', 305, 0, 'web', '2022-08-31 11:52:37', '2022-08-31 11:52:37'),
(307, 'attendance_create', 305, 0, 'web', '2022-08-31 11:52:37', '2022-08-31 11:52:37'),
(308, 'attendance_edit', 305, 0, 'web', '2022-08-31 11:52:37', '2022-08-31 11:52:37'),
(309, 'attendance_delete', 305, 0, 'web', '2022-08-31 11:52:37', '2022-08-31 11:52:37'),
(310, 'attendance_approve', 305, 0, 'web', '2022-08-31 11:52:37', '2022-08-31 11:52:37'),
(311, 'attendance_send', 305, 0, 'web', '2022-08-31 11:52:37', '2022-08-31 11:52:37'),
(312, 'attendance_upload', 305, 0, 'web', '2022-08-31 11:52:37', '2022-08-31 11:52:37'),
(313, 'Payroll', NULL, 1, 'web', '2022-08-31 11:52:48', '2022-08-31 11:52:48'),
(314, 'payroll_view', 313, 0, 'web', '2022-08-31 11:52:48', '2022-08-31 11:52:48'),
(315, 'payroll_create', 313, 0, 'web', '2022-08-31 11:52:48', '2022-08-31 11:52:48'),
(316, 'payroll_edit', 313, 0, 'web', '2022-08-31 11:52:48', '2022-08-31 11:52:48'),
(317, 'payroll_delete', 313, 0, 'web', '2022-08-31 11:52:48', '2022-08-31 11:52:48'),
(318, 'payroll_approve', 313, 0, 'web', '2022-08-31 11:52:48', '2022-08-31 11:52:48'),
(319, 'payroll_send', 313, 0, 'web', '2022-08-31 11:52:48', '2022-08-31 11:52:48'),
(320, 'payroll_upload', 313, 0, 'web', '2022-08-31 11:52:48', '2022-08-31 11:52:48'),
(321, 'Holiday', NULL, 1, 'web', '2022-08-31 11:53:05', '2022-08-31 11:53:05'),
(322, 'holiday_view', 321, 0, 'web', '2022-08-31 11:53:05', '2022-08-31 11:53:05'),
(323, 'holiday_create', 321, 0, 'web', '2022-08-31 11:53:05', '2022-08-31 11:53:05'),
(324, 'holiday_edit', 321, 0, 'web', '2022-08-31 11:53:05', '2022-08-31 11:53:05'),
(325, 'holiday_delete', 321, 0, 'web', '2022-08-31 11:53:05', '2022-08-31 11:53:05'),
(326, 'holiday_approve', 321, 0, 'web', '2022-08-31 11:53:05', '2022-08-31 11:53:05'),
(327, 'holiday_send', 321, 0, 'web', '2022-08-31 11:53:05', '2022-08-31 11:53:05'),
(328, 'holiday_upload', 321, 0, 'web', '2022-08-31 11:53:05', '2022-08-31 11:53:05'),
(329, 'User Management', NULL, 0, 'web', '2022-08-31 11:53:35', '2022-08-31 11:53:35'),
(330, 'user_management_view', 329, 0, 'web', '2022-08-31 11:53:35', '2022-08-31 11:53:35'),
(331, 'New User', NULL, 1, 'web', '2022-08-31 11:53:44', '2022-08-31 11:53:44'),
(332, 'new_user_view', 331, 0, 'web', '2022-08-31 11:53:44', '2022-08-31 11:53:44'),
(333, 'new_user_create', 331, 0, 'web', '2022-08-31 11:53:44', '2022-08-31 11:53:44'),
(334, 'new_user_edit', 331, 0, 'web', '2022-08-31 11:53:44', '2022-08-31 11:53:44'),
(335, 'new_user_delete', 331, 0, 'web', '2022-08-31 11:53:44', '2022-08-31 11:53:44'),
(336, 'new_user_approve', 331, 0, 'web', '2022-08-31 11:53:44', '2022-08-31 11:53:44'),
(337, 'new_user_send', 331, 0, 'web', '2022-08-31 11:53:44', '2022-08-31 11:53:44'),
(338, 'new_user_upload', 331, 0, 'web', '2022-08-31 11:53:44', '2022-08-31 11:53:44'),
(339, 'Permission', NULL, 1, 'web', '2022-08-31 11:54:06', '2022-08-31 11:54:06'),
(340, 'permission_view', 339, 0, 'web', '2022-08-31 11:54:06', '2022-08-31 11:54:06'),
(341, 'permission_create', 339, 0, 'web', '2022-08-31 11:54:06', '2022-08-31 11:54:06'),
(342, 'permission_edit', 339, 0, 'web', '2022-08-31 11:54:06', '2022-08-31 11:54:06'),
(343, 'permission_delete', 339, 0, 'web', '2022-08-31 11:54:06', '2022-08-31 11:54:06'),
(344, 'permission_approve', 339, 0, 'web', '2022-08-31 11:54:06', '2022-08-31 11:54:06'),
(345, 'permission_send', 339, 0, 'web', '2022-08-31 11:54:06', '2022-08-31 11:54:06'),
(346, 'permission_upload', 339, 0, 'web', '2022-08-31 11:54:06', '2022-08-31 11:54:06'),
(347, 'Customer', NULL, 1, 'web', '2022-08-31 11:58:31', '2022-08-31 11:58:31'),
(348, 'customer_view', 347, 0, 'web', '2022-08-31 11:58:31', '2022-08-31 11:58:31'),
(349, 'customer_create', 347, 0, 'web', '2022-08-31 11:58:31', '2022-08-31 11:58:31'),
(350, 'customer_edit', 347, 0, 'web', '2022-08-31 11:58:31', '2022-08-31 11:58:31'),
(351, 'customer_delete', 347, 0, 'web', '2022-08-31 11:58:31', '2022-08-31 11:58:31'),
(352, 'customer_approve', 347, 0, 'web', '2022-08-31 11:58:31', '2022-08-31 11:58:31'),
(353, 'customer_send', 347, 0, 'web', '2022-08-31 11:58:31', '2022-08-31 11:58:31'),
(354, 'customer_upload', 347, 0, 'web', '2022-08-31 11:58:31', '2022-08-31 11:58:31'),
(355, 'Unit Type', NULL, 1, 'web', '2022-09-01 11:24:49', '2022-09-01 11:24:49'),
(356, 'unit_type_view', 355, 0, 'web', '2022-09-01 11:24:49', '2022-09-01 11:24:49'),
(357, 'unit_type_create', 355, 0, 'web', '2022-09-01 11:24:49', '2022-09-01 11:24:49'),
(358, 'unit_type_edit', 355, 0, 'web', '2022-09-01 11:24:49', '2022-09-01 11:24:49'),
(359, 'unit_type_delete', 355, 0, 'web', '2022-09-01 11:24:49', '2022-09-01 11:24:49'),
(360, 'unit_type_approve', 355, 0, 'web', '2022-09-01 11:24:49', '2022-09-01 11:24:49'),
(361, 'unit_type_send', 355, 0, 'web', '2022-09-01 11:24:49', '2022-09-01 11:24:49'),
(362, 'unit_type_upload', 355, 0, 'web', '2022-09-01 11:24:49', '2022-09-01 11:24:49'),
(363, 'Stock Count', NULL, 0, 'web', '2022-09-01 11:32:59', '2022-09-01 11:32:59'),
(364, 'stock_count_view', 363, 0, 'web', '2022-09-01 11:32:59', '2022-09-01 11:32:59'),
(365, 'Product Category', NULL, 1, 'web', '2022-09-01 11:34:53', '2022-09-01 11:34:53'),
(366, 'product_category_view', 365, 0, 'web', '2022-09-01 11:34:53', '2022-09-01 11:34:53'),
(367, 'product_category_create', 365, 0, 'web', '2022-09-01 11:34:54', '2022-09-01 11:34:54'),
(368, 'product_category_edit', 365, 0, 'web', '2022-09-01 11:34:54', '2022-09-01 11:34:54'),
(369, 'product_category_delete', 365, 0, 'web', '2022-09-01 11:34:54', '2022-09-01 11:34:54'),
(370, 'product_category_approve', 365, 0, 'web', '2022-09-01 11:34:54', '2022-09-01 11:34:54'),
(371, 'product_category_send', 365, 0, 'web', '2022-09-01 11:34:54', '2022-09-01 11:34:54'),
(372, 'product_category_upload', 365, 0, 'web', '2022-09-01 11:34:54', '2022-09-01 11:34:54'),
(373, 'Brand', NULL, 1, 'web', '2022-09-01 11:37:23', '2022-09-01 11:37:23'),
(374, 'brand_view', 373, 0, 'web', '2022-09-01 11:37:23', '2022-09-01 11:37:23'),
(375, 'brand_create', 373, 0, 'web', '2022-09-01 11:37:23', '2022-09-01 11:37:23'),
(376, 'brand_edit', 373, 0, 'web', '2022-09-01 11:37:24', '2022-09-01 11:37:24'),
(377, 'brand_delete', 373, 0, 'web', '2022-09-01 11:37:24', '2022-09-01 11:37:24'),
(378, 'brand_approve', 373, 0, 'web', '2022-09-01 11:37:24', '2022-09-01 11:37:24'),
(379, 'brand_send', 373, 0, 'web', '2022-09-01 11:37:24', '2022-09-01 11:37:24'),
(380, 'brand_upload', 373, 0, 'web', '2022-09-01 11:37:24', '2022-09-01 11:37:24'),
(381, 'Opening Inventory', NULL, 1, 'web', '2022-09-01 11:38:01', '2022-09-01 11:38:01'),
(382, 'opening_inventory_view', 381, 0, 'web', '2022-09-01 11:38:01', '2022-09-01 11:38:01'),
(383, 'opening_inventory_create', 381, 0, 'web', '2022-09-01 11:38:02', '2022-09-01 11:38:02'),
(384, 'opening_inventory_edit', 381, 0, 'web', '2022-09-01 11:38:02', '2022-09-01 11:38:02'),
(385, 'opening_inventory_delete', 381, 0, 'web', '2022-09-01 11:38:02', '2022-09-01 11:38:02'),
(386, 'opening_inventory_approve', 381, 0, 'web', '2022-09-01 11:38:02', '2022-09-01 11:38:02'),
(387, 'opening_inventory_send', 381, 0, 'web', '2022-09-01 11:38:02', '2022-09-01 11:38:02'),
(388, 'opening_inventory_upload', 381, 0, 'web', '2022-09-01 11:38:02', '2022-09-01 11:38:02'),
(389, 'Print Barcode', NULL, 1, 'web', '2022-09-01 11:38:31', '2022-09-01 11:38:31'),
(390, 'print_barcode_view', 389, 0, 'web', '2022-09-01 11:38:31', '2022-09-01 11:38:31'),
(391, 'print_barcode_create', 389, 0, 'web', '2022-09-01 11:38:31', '2022-09-01 11:38:31'),
(392, 'print_barcode_edit', 389, 0, 'web', '2022-09-01 11:38:31', '2022-09-01 11:38:31'),
(393, 'print_barcode_delete', 389, 0, 'web', '2022-09-01 11:38:31', '2022-09-01 11:38:31'),
(394, 'print_barcode_approve', 389, 0, 'web', '2022-09-01 11:38:31', '2022-09-01 11:38:31'),
(395, 'print_barcode_send', 389, 0, 'web', '2022-09-01 11:38:31', '2022-09-01 11:38:31'),
(396, 'print_barcode_upload', 389, 0, 'web', '2022-09-01 11:38:31', '2022-09-01 11:38:31'),
(397, 'Adjustment', NULL, 1, 'web', '2022-09-01 11:38:58', '2022-09-01 11:38:58'),
(398, 'adjustment_view', 397, 0, 'web', '2022-09-01 11:38:59', '2022-09-01 11:38:59'),
(399, 'adjustment_create', 397, 0, 'web', '2022-09-01 11:38:59', '2022-09-01 11:38:59'),
(400, 'adjustment_edit', 397, 0, 'web', '2022-09-01 11:38:59', '2022-09-01 11:38:59'),
(401, 'adjustment_delete', 397, 0, 'web', '2022-09-01 11:38:59', '2022-09-01 11:38:59'),
(402, 'adjustment_approve', 397, 0, 'web', '2022-09-01 11:38:59', '2022-09-01 11:38:59'),
(403, 'adjustment_send', 397, 0, 'web', '2022-09-01 11:38:59', '2022-09-01 11:38:59'),
(404, 'adjustment_upload', 397, 0, 'web', '2022-09-01 11:38:59', '2022-09-01 11:38:59'),
(405, 'Employee', NULL, 1, 'web', '2022-09-02 12:49:38', '2022-09-02 12:49:38'),
(406, 'employee_view', 405, 0, 'web', '2022-09-02 12:49:38', '2022-09-02 12:49:38'),
(407, 'employee_create', 405, 0, 'web', '2022-09-02 12:49:38', '2022-09-02 12:49:38'),
(408, 'employee_edit', 405, 0, 'web', '2022-09-02 12:49:38', '2022-09-02 12:49:38'),
(409, 'employee_delete', 405, 0, 'web', '2022-09-02 12:49:38', '2022-09-02 12:49:38'),
(410, 'employee_approve', 405, 0, 'web', '2022-09-02 12:49:38', '2022-09-02 12:49:38'),
(411, 'employee_send', 405, 0, 'web', '2022-09-02 12:49:38', '2022-09-02 12:49:38'),
(412, 'employee_upload', 405, 0, 'web', '2022-09-02 12:49:38', '2022-09-02 12:49:38'),
(413, 'Role', NULL, 1, 'web', '2022-09-02 12:54:32', '2022-09-02 12:54:32'),
(414, 'role_view', 413, 0, 'web', '2022-09-02 12:54:32', '2022-09-02 12:54:32'),
(415, 'role_create', 413, 0, 'web', '2022-09-02 12:54:32', '2022-09-02 12:54:32'),
(416, 'role_edit', 413, 0, 'web', '2022-09-02 12:54:33', '2022-09-02 12:54:33'),
(417, 'role_delete', 413, 0, 'web', '2022-09-02 12:54:33', '2022-09-02 12:54:33'),
(418, 'role_approve', 413, 0, 'web', '2022-09-02 12:54:33', '2022-09-02 12:54:33'),
(419, 'role_send', 413, 0, 'web', '2022-09-02 12:54:33', '2022-09-02 12:54:33'),
(420, 'role_upload', 413, 0, 'web', '2022-09-02 12:54:33', '2022-09-02 12:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_settings`
--

CREATE TABLE `pos_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `default_customer` bigint(20) UNSIGNED NOT NULL,
  `default_location` bigint(20) UNSIGNED NOT NULL,
  `default_saleperson` bigint(20) UNSIGNED NOT NULL,
  `invoice_header` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_footer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thermal_format` bigint(20) UNSIGNED NOT NULL,
  `a_format` bigint(20) UNSIGNED NOT NULL,
  `inv_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_tax` int(11) DEFAULT '0',
  `purchase_tax_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_taxID` bigint(20) DEFAULT '0',
  `sale_tax` int(11) DEFAULT '0',
  `sale_tax_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_taxID` bigint(20) DEFAULT '0',
  `wat` int(11) DEFAULT '0',
  `wat_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watID` bigint(20) DEFAULT '0',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_settings`
--

INSERT INTO `pos_settings` (`id`, `default_customer`, `default_location`, `default_saleperson`, `invoice_header`, `invoice_footer`, `thermal_format`, `a_format`, `inv_img`, `qr_img`, `purchase_tax`, `purchase_tax_label`, `purchase_taxID`, `sale_tax`, `sale_tax_label`, `sale_taxID`, `wat`, `wat_label`, `watID`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 1, '.', 'Thank you for your Business !!!', 1, 1, 'http://carlanisa.revebe.com/storage/app/public/pos_setting/6cqbQGbp8qk8qszoZmV8I8EudnzrOZpnvgtc1pVz.png', 'http://carlanisa.revebe.com/storage/app/public/pos_setting/CQigHzINtofKsRx6V0ehX5RSb6hrBwBeDqnIcUOk.png', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 1, NULL, '2022-09-07 23:24:09', '2022-09-15 14:22:31'),
(2, 3, 4, 1, '.', 'Thank you for Your Business !!!', 1, 1, 'http://carlanisa.revebe.com/storage/app/public/pos_setting/QR7HmerizgiUo0EUdQ7Auh58B2PQgKYO7eOY5RWc.png', 'http://carlanisa.revebe.com/storage/app/public/pos_setting/JyFwEoQSKlY9T74bUkXovP6SEcuvM49c9ku7P4bw.png', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 1, NULL, '2022-09-07 23:30:01', '2022-09-15 14:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `w_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category` bigint(20) UNSIGNED NOT NULL,
  `weight` decimal(20,2) DEFAULT NULL,
  `unit` bigint(20) UNSIGNED NOT NULL,
  `product_cost` decimal(20,2) DEFAULT NULL,
  `product_price` decimal(20,2) DEFAULT NULL,
  `profit_per` decimal(10,0) DEFAULT NULL,
  `profit_val` decimal(10,0) DEFAULT NULL,
  `inventory` tinyint(1) NOT NULL DEFAULT '1',
  `alert_qty` bigint(20) DEFAULT NULL,
  `product_tax` bigint(20) DEFAULT NULL,
  `tax_method` bigint(20) UNSIGNED DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  `product_images` text COLLATE utf8mb4_unicode_ci,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `promotional_price` decimal(20,2) DEFAULT NULL,
  `is_diffPrice` tinyint(1) DEFAULT '0',
  `is_variant` tinyint(1) DEFAULT '0',
  `is_promo` tinyint(1) DEFAULT '0',
  `promotional_start` date DEFAULT NULL,
  `promotional_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `w_id`, `name`, `brand_id`, `product_code`, `product_category`, `weight`, `unit`, `product_cost`, `product_price`, `profit_per`, `profit_val`, `inventory`, `alert_qty`, `product_tax`, `tax_method`, `featured`, `product_images`, `detail`, `promotional_price`, `is_diffPrice`, `is_variant`, `is_promo`, `promotional_start`, `promotional_end`, `created_at`, `updated_at`) VALUES
(6, 280, 'Kebarung Klasik | Baby Blue', 1, '64167024', 4, '0.72', 1, '60.50', '169.00', '179', '109', 0, 3, NULL, 1, 1, 'http://carlanisa.revebe.com/storage/app/public/product_images/YOIFTQ1vb9lqOPvYeUwcw19pVKB7t5XyYKmF0Tu7.jpg', NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-08 21:31:40', '2022-09-08 21:31:44'),
(7, 286, 'Kebarung Klasik | Black', 1, '81063583', 4, '0.72', 1, '60.50', '169.00', '179', '109', 0, 3, NULL, 1, 1, 'http://carlanisa.revebe.com/storage/app/public/product_images/v5vNYDtgCXk7LEqgeRttFMfyO0mIEkwegUPE3j4Q.jpg', NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-08 21:34:44', '2022-09-08 21:34:47'),
(8, 292, 'Kebarung Klasik | Blue Black', 1, '32702510', 4, '0.72', 1, '60.50', '169.00', '179', '109', 0, 3, NULL, 1, 1, 'http://carlanisa.revebe.com/storage/app/public/product_images/Kg05p5foB5iNfq3oLUOO6Ejhf13W3czWn1jpvxvN.jpg', NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-08 21:35:25', '2022-09-09 23:57:51'),
(9, 300, 'Kebarung Klasik | Dusty Green', 1, '93194805', 4, '0.72', 1, '60.50', '169.00', '179', '109', 0, 3, NULL, 1, 1, 'http://carlanisa.revebe.com/storage/app/public/product_images/pcsHCVOEzSMS6uEfOlB5mwT5Dr2CiqdD4GbUnpsI.jpg', NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:04:08', '2022-09-10 00:04:12'),
(10, 306, 'Kebarung Moden | Dusty Pink', 1, '23915628', 4, '0.72', 1, '60.50', '169.00', '179', '109', 0, 3, NULL, 1, 1, 'http://carlanisa.revebe.com/storage/app/public/product_images/5lp0JXI4d2h9pe8SbRSipUUhWSpkgF9U5YRhTxXN.jpg', NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:08:58', '2022-09-10 00:09:02'),
(11, 312, 'Kebarung Moden | Dusty Blue', 1, '83136710', 4, '0.72', 1, '60.50', '169.00', '179', '109', 0, 3, NULL, 1, 1, 'http://carlanisa.revebe.com/storage/app/public/product_images/khF8hJgMtgDmu01UwEgwWmx3dG34Pc0oIbhEPd09.jpg', NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:15:12', '2022-09-10 00:15:17'),
(12, 318, 'Kebarung Klasik | Salmon', 1, '42420309', 4, '0.72', 1, '60.50', '169.00', '179', '109', 0, 3, NULL, 1, 1, 'http://carlanisa.revebe.com/storage/app/public/product_images/dJQzj2sYkBJdrBDHbNYMDTj3MzG0wtjsYgtIg4ed.jpg', NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:16:25', '2022-09-10 00:16:29'),
(13, 324, 'Kebarung Klasik | Light Grey', 1, '63097582', 4, '0.72', 1, '60.50', '169.00', '179', '109', 0, 3, NULL, 1, 1, 'http://carlanisa.revebe.com/storage/app/public/product_images/pp2j3SXv0NTiGQKd8Xx2JoMwn7jgtD5nJRjA999p.jpg', NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:16:50', '2022-09-10 00:16:52'),
(14, 330, 'Baju kurung moden | Baby Blue', 1, '37362417', 5, '0.65', 1, '68.25', '159.00', '133', '91', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:25:57', '2022-09-10 00:26:01'),
(15, 337, 'Azalea Kurung Moden Songket | Apple Green Silver', 1, '15079789', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:28:29', '2022-09-10 00:28:33'),
(17, 349, 'Kurung Moden Songket | Avacado Silver', 1, '39221098', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:34:32', '2022-09-10 00:34:34'),
(18, 355, 'Baju Kurung Riau Songket | Black Silver', 1, '70996549', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:37:26', '2022-09-10 00:37:31'),
(19, 360, 'Kurung Moden Songket | Apple Green Silver', 1, '27313124', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:39:10', '2022-09-10 00:39:14'),
(20, 366, 'Baju Kurung Riau Moden | Baby Blue (Plain)', 1, '98694627', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:43:13', '2022-09-10 00:43:18'),
(21, 372, 'Liana-Baju Kurung Moden Songket | Blue Black Pink', 1, '60527394', 11, '0.70', 1, '82.00', '189.00', '130', '107', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:50:17', '2022-09-10 00:50:19'),
(22, 378, 'Baju Kurung Moden | Black', 1, '67800208', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 00:53:28', '2022-09-10 00:53:30'),
(23, 384, 'Baju Kurung Moden Songket | Baby Pink', 1, '42115597', 7, '0.70', 1, '82.50', '159.00', '93', '77', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:01:52', '2022-09-10 01:01:56'),
(24, 391, 'Baju Kurung Moden Songket | Baby Pink Silver', 1, '49130833', 9, '0.70', 1, '46.50', '129.00', '177', '83', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:09:15', '2022-09-10 01:09:20'),
(25, 397, 'Baju kurung moden | Black', 1, '90783114', 5, '0.65', 1, '68.25', '159.00', '133', '91', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:12:49', '2022-09-10 01:12:53'),
(26, 405, 'Baju kurung moden | Blue Black', 1, '21058216', 5, '0.65', 1, '68.25', '159.00', '133', '91', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:18:07', '2022-09-10 01:18:11'),
(27, 413, 'Baju kurung moden | Maroon', 1, '15548093', 5, '0.65', 1, '68.25', '159.00', '133', '91', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:30:36', '2022-09-10 01:30:41'),
(30, 437, 'Baju kurung moden | Purple Magenta', 1, '63109997', 5, '0.65', 1, '68.25', '159.00', '133', '91', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:41:34', '2022-09-10 01:41:40'),
(31, 445, 'Baju kurung moden | Royal Blue', 1, '99386200', 5, '0.65', 1, '68.25', '159.00', '133', '91', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:43:09', '2022-09-10 01:43:14'),
(32, 453, 'Baju kurung moden | Tea Pink', 1, '63542917', 5, '0.65', 1, '68.25', '159.00', '133', '91', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:47:21', '2022-09-10 01:47:25'),
(33, 461, 'Azalea Kurung Moden Songket | Baby Pink Gold', 1, '20038395', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:49:16', '2022-09-10 01:49:20'),
(34, 467, 'Azalea Kurung Moden Songket | Cream Gold', 1, '57070546', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:52:56', '2022-09-10 01:53:00'),
(35, 473, 'Azalea Kurung Moden Songket | Dusty Pink Silver', 1, '63512873', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:53:54', '2022-09-10 01:53:58'),
(36, 479, 'Azalea Kurung Moden Songket | Dusty Purple Silver', 1, '18221533', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:54:45', '2022-09-10 01:54:48'),
(37, 485, 'Azalea Kurung Moden Songket | Grey Gold', 1, '95609363', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:58:25', '2022-09-10 01:58:29'),
(38, 491, 'Azalea Kurung Moden Songket | Grey Silver', 1, '43115167', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 01:59:20', '2022-09-10 01:59:22'),
(39, 497, 'Azalea Kurung Moden Songket | Lavender Silver', 1, '15698024', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 02:04:26', '2022-09-10 02:04:30'),
(40, 503, 'Azalea Kurung Moden Songket | Light Purple Silver', 1, '59674501', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 02:05:18', '2022-09-10 02:05:22'),
(41, 509, 'Azalea Kurung Moden Songket | Magenta Gold', 1, '79822321', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 02:06:14', '2022-09-10 02:06:16'),
(42, 515, 'Azalea Kurung Moden Songket | Magenta Silver', 1, '84184902', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 02:08:16', '2022-09-10 02:08:20'),
(43, 521, 'Azalea Kurung Moden Songket | Maroon Silver', 1, '65048121', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 02:09:24', '2022-09-10 02:09:28'),
(44, 527, 'Azalea Kurung Moden Songket | Mint Green Silver', 1, '93237740', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 02:10:18', '2022-09-10 02:10:21'),
(45, 533, 'Azalea Kurung Moden Songket | Nude Silver', 1, '59802024', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 02:13:15', '2022-09-10 02:13:17'),
(46, 539, 'Azalea Kurung Moden Songket | Orange Gold', 1, '51043023', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:01:43', '2022-09-10 14:01:48'),
(47, 545, 'Azalea Kurung Moden Songket | Peach Pink Gold', 1, '89609829', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:02:39', '2022-09-10 14:02:43'),
(48, 551, 'Azalea Kurung Moden Songket | Peach Pink Silver', 1, '13296889', 1, '0.70', 1, '64.50', '159.00', '147', '95', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:03:27', '2022-09-10 14:03:32'),
(49, 557, 'Kurung Moden Songket | Avacado Silver', 1, '79218246', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:06:09', '2022-09-10 14:06:13'),
(50, 563, 'Kurung Moden Songket | Black Gold', 1, '90908165', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:06:56', '2022-09-10 14:06:59'),
(51, 569, 'Kurung Moden Songket | Black Silver', 1, '25592246', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:07:44', '2022-09-10 14:07:48'),
(52, 575, 'Kurung Moden Songket | Blue Black Gold', 1, '30389407', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:08:40', '2022-09-10 14:08:42'),
(53, 581, 'Kurung Moden Songket | Blue Black Silver', 1, '79365683', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:10:18', '2022-09-10 14:10:22'),
(54, 587, 'Kurung Moden Songket | Cream Gold', 1, '98260254', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:11:01', '2022-09-10 14:11:04'),
(55, 593, 'Kurung Moden Songket | Dark Chocolate Silver', 1, '39152678', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:11:57', '2022-09-10 14:12:01'),
(56, 599, 'Kurung Moden Songket | Dark Emerald Green Gold', 1, '95370401', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:12:49', '2022-09-10 14:12:53'),
(57, 605, 'Kurung Moden Songket | Dark Emerald Green Silver', 1, '90729934', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:15:57', '2022-09-10 14:16:01'),
(58, 611, 'Kurung Moden Songket | Dark Magenta Silver', 1, '40936308', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:17:09', '2022-09-10 14:17:13'),
(59, 617, 'Kurung Moden Songket | Dark Maroon Gold', 1, '71930368', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:18:00', '2022-09-10 14:18:03'),
(60, 623, 'Kurung Moden Songket | Dark Maroon Silver', 1, '31721996', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:23:13', '2022-09-10 14:23:17'),
(61, 629, 'Kurung Moden Songket | Dark Purple Silver', 1, '38700699', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:24:02', '2022-09-10 14:24:04'),
(62, 635, 'Kurung Moden Songket | Light Purple Silver', 1, '91580234', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:24:47', '2022-09-10 14:24:51'),
(63, 641, 'Kurung Moden Songket | Magenta Gold', 1, '17031629', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:25:28', '2022-09-10 14:25:31'),
(64, 647, 'Kurung Moden Songket | Magenta Silver', 1, '65189502', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:28:11', '2022-09-10 14:28:15'),
(65, 653, 'Kurung Moden Songket | Maroon Silver', 1, '10635122', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:31:07', '2022-09-10 14:31:12'),
(66, 659, 'Kurung Moden Songket | Olive green Gold', 1, '33437021', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:32:03', '2022-09-10 14:32:05'),
(67, 665, 'Kurung Moden Songket | Peach Silver', 1, '26701031', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:32:50', '2022-09-10 14:32:52'),
(68, 671, 'Kurung Moden Songket | Royal Blue Gold', 1, '13857698', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:33:35', '2022-09-10 14:33:40'),
(69, 677, 'Kurung Moden Songket | Royal Blue Silver', 1, '71541765', 10, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:35:48', '2022-09-10 14:35:52'),
(70, 683, 'Baju Kurung Riau Songket | Chocolate Silver', 1, '49226900', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:37:56', '2022-09-10 14:38:01'),
(71, 688, 'Baju Kurung Riau Songket | Blue Black Silver', 1, '20735376', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:39:03', '2022-09-10 14:39:08'),
(72, 693, 'Baju Kurung Riau Songket | Dark Emerald Green Silver', 1, '97330325', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:39:43', '2022-09-10 14:39:45'),
(73, 698, 'Baju Kurung Riau Songket | Magenta Gold', 1, '18824535', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:41:27', '2022-09-10 14:41:31'),
(74, 703, 'Baju Kurung Riau Songket | Magenta Silver', 1, '17585324', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:42:08', '2022-09-10 14:42:11'),
(75, 708, 'Baju Kurung Riau Songket | Maroon Silver', 1, '37128982', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:42:48', '2022-09-10 14:42:51'),
(76, 713, 'Baju Kurung Riau Songket | Mid night blue Silver', 1, '16357118', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:44:10', '2022-09-10 14:44:14'),
(77, 718, 'Baju Kurung Riau Songket | Olive Green Silver', 1, '52401969', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:45:27', '2022-09-10 14:45:32'),
(78, 723, 'Baju Kurung Riau Songket | Purple Silver', 1, '47831365', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:46:08', '2022-09-10 14:46:10'),
(79, 728, 'Baju Kurung Riau Songket | Royal Blue Silver', 1, '28709593', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:46:53', '2022-09-10 14:46:57'),
(80, 733, 'Baju Kurung Riau Songket | Teal Green Silver', 1, '59041804', 3, '0.65', 1, '49.50', '129.00', '161', '80', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:47:38', '2022-09-10 14:47:41'),
(81, 738, 'Kurung Moden Songket | Black Gold', 1, '75528323', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:49:29', '2022-09-10 14:49:34'),
(82, 744, 'Kurung Moden Songket | Black Silver', 1, '96211498', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:50:12', '2022-09-10 14:50:14'),
(83, 750, 'Kurung Moden Songket | Blue Black Gold', 1, '25697113', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:51:05', '2022-09-10 14:51:08'),
(84, 756, 'Kurung Moden Songket | Blue Black Silver', 1, '29640731', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:51:45', '2022-09-10 14:51:47'),
(85, 762, 'Kurung Moden Songket | Dark Emerald Green Gold', 1, '66958710', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:54:38', '2022-09-10 14:54:43'),
(86, 768, 'Kurung Moden Songket | Dark Purple Gold', 1, '60324019', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:55:56', '2022-09-10 14:56:01'),
(87, 774, 'Kurung Moden Songket | Dark Purple Silver', 1, '97534212', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:56:47', '2022-09-10 14:56:51'),
(88, 780, 'Kurung Moden Songket | Light Purple Silver', 1, '57983492', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:57:31', '2022-09-10 14:57:33'),
(89, 786, 'Kurung Moden Songket | Magenta Gold', 1, '25090782', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 14:58:13', '2022-09-10 14:58:15'),
(90, 792, 'Kurung Moden Songket | Maroon Gold', 1, '83283519', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:01:03', '2022-09-10 15:01:08'),
(91, 798, 'Kurung Moden Songket | Maroon Silver', 1, '68904717', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:02:24', '2022-09-10 15:02:29'),
(92, 804, 'Kurung Moden Songket | Orange Silver', 1, '16791024', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:03:11', '2022-09-10 15:03:14'),
(93, 810, 'Kurung Moden Songket | Royal Blue Gold', 1, '29021098', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:03:53', '2022-09-10 15:03:55'),
(94, 816, 'Kurung Moden Songket | Royal Blue Silver', 1, '11004348', 8, '0.65', 1, '49.50', '159.00', '221', '110', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:04:36', '2022-09-10 15:04:38'),
(95, 822, 'Baju Kurung Riau Moden | Black (Plain)', 1, '40375997', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:08:07', '2022-09-10 15:08:11'),
(96, 828, 'Baju Kurung Riau Moden | Dark Emerald (Plain)', 1, '94302612', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:08:52', '2022-09-10 15:08:54'),
(97, 834, 'Baju Kurung Riau Moden | Dark Maroon (Plain)', 1, '12041940', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:09:46', '2022-09-10 15:09:51'),
(98, 840, 'Baju Kurung Riau Moden | Dusty Blue (Check)', 1, '71216750', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:10:39', '2022-09-10 15:10:41'),
(99, 846, 'Baju Kurung Riau Moden | Dusty Maroon (check)', 1, '37518091', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:14:11', '2022-09-10 15:14:15'),
(100, 852, 'Baju Kurung Riau Moden | Light Green (Plain)', 1, '86796531', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:15:02', '2022-09-10 15:15:07'),
(101, 858, 'Baju Kurung Riau Moden | Magenta (check)', 1, '92768174', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:15:47', '2022-09-10 15:15:49'),
(102, 864, 'Baju Kurung Riau Moden | Nude (Plain)', 1, '20327391', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:16:30', '2022-09-10 15:16:33'),
(103, 870, 'Baju Kurung Riau Moden | Rose Gold (Plain)', 1, '84122871', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:19:24', '2022-09-10 15:19:28'),
(104, 876, 'Baju Kurung Riau Moden | Smokey Green (check)', 1, '30615792', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:20:26', '2022-09-10 15:20:30'),
(105, 882, 'Baju Kurung Riau Moden | Teal Blue (Check)', 1, '85608516', 6, '0.70', 1, '47.50', '99.00', '100', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:21:12', '2022-09-10 15:21:14'),
(106, 888, 'Baju Kurung Moden | Chocolate', 1, '61010122', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:25:38', '2022-09-10 15:25:42'),
(107, 894, 'Baju Kurung Moden | Dark Maroon', 1, '21103125', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:26:34', '2022-09-10 15:26:38'),
(108, 900, 'Baju Kurung Moden | Navy Blue', 1, '59692153', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:27:23', '2022-09-10 15:27:26'),
(109, 906, 'Baju Kurung Moden | Pink Purple', 1, '79119358', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:30:17', '2022-09-10 15:30:22'),
(110, 912, 'Baju Kurung Moden | Purple', 1, '28164251', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:32:00', '2022-09-10 15:32:04'),
(111, 918, 'Baju Kurung Moden | Purple', 1, '81397033', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:33:28', '2022-09-10 15:33:33'),
(112, 924, 'Baju Kurung Moden | Purple Manggis', 1, '44708100', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:34:17', '2022-09-10 15:34:19'),
(113, 930, 'Baju Kurung Moden | Royal blue', 1, '93538064', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:36:35', '2022-09-10 15:36:40'),
(114, 936, 'Baju Kurung Moden | Shocking Pink', 1, '13006324', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:37:18', '2022-09-10 15:37:20'),
(115, 942, 'Baju Kurung Moden | Turquoise Green', 1, '89361905', 2, '0.40', 1, '19.50', '49.00', '151', '30', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-10 15:37:58', '2022-09-10 15:38:00'),
(119, 1026, 'Cattle Heart Bawal Square | Cloud Blue', 1, '79619011', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 13:55:51', '2022-09-11 13:55:54'),
(120, 1027, 'Songket Tenun 11″ inch | Apple Green Gold D5', 1, '39644852', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 14:02:56', '2022-09-11 14:03:00'),
(121, 1028, 'Songket Bunga Raya | Apple Green Gold', 1, '30071626', 19, '0.70', 1, '40.00', '80.00', '100', '40', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 14:04:52', '2022-09-11 14:04:54'),
(122, 1029, 'Songket Tenun Lily Star | Black Silver', 1, '12421007', 13, '0.70', 1, '33.00', '55.00', '67', '22', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 14:08:34', '2022-09-11 14:08:38'),
(124, 1031, 'Songket Star Flower | Baby Blue Silver', 1, '80452890', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 14:14:10', '2022-09-11 14:14:11'),
(125, 1032, 'Songket Star Flower | Apple Green – Orange', 1, '94761387', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 14:15:42', '2022-09-11 14:15:47'),
(126, 1033, 'Songket Tenun Matching | Dark Emerald Green', 1, '32184691', 20, '0.64', 1, '40.00', '90.00', '125', '50', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 14:18:46', '2022-09-11 14:18:50'),
(127, 1034, 'Songket Bunga Tabur | Apple Green Silver', 1, '80579324', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 14:19:41', '2022-09-11 14:19:45'),
(128, 1035, 'Shawl Plain Stone | Black', 1, '46819397', 29, '0.15', 1, '11.75', '30.00', '155', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 14:38:19', '2022-09-11 14:38:24'),
(129, 1036, 'Instant shawl Marisa Sarung | Red', 1, '90356849', 25, '0.13', 1, '6.46', '20.00', '210', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 15:17:11', '2022-09-11 15:17:15'),
(130, 1037, 'Instant Shawl Rania | Black', 1, '13281015', 26, '0.13', 1, '4.95', '20.00', '304', '15', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 15:23:11', '2022-09-11 15:23:15'),
(131, 1038, 'Instant Shawl SuperFast | Black', 1, '22086137', 27, '0.10', 1, '5.74', '20.00', '248', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 15:28:06', '2022-09-11 15:28:10'),
(132, 1039, 'Instant Shawl SuperFast | Blue Black', 1, '13093059', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:36:42', '2022-09-11 17:36:44'),
(133, 1040, 'Instant Shawl SuperFast | Dusty Purple', 1, '42625824', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:39:54', '2022-09-11 17:39:58'),
(134, 1041, 'Instant Shawl SuperFast | Dusty Pink', 1, '23096470', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:40:26', '2022-09-11 17:40:28'),
(135, 1043, 'Instant Shawl SuperFast | Grey', 1, '22503871', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:40:53', '2022-09-11 17:40:55'),
(136, 1044, 'Instant Shawl SuperFast | Light Green', 1, '13984072', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:41:20', '2022-09-11 17:41:22'),
(137, 1045, 'Instant Shawl SuperFast | Light Grey', 1, '20839379', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:41:44', '2022-09-11 17:41:47'),
(138, 1046, 'Instant Shawl SuperFast | Maroon', 1, '23594483', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:42:12', '2022-09-11 17:42:14'),
(139, 1047, 'Instant Shawl SuperFast | Nescafe', 1, '27860322', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:42:38', '2022-09-11 17:42:40'),
(140, 1048, 'Instant Shawl SuperFast | Purple', 1, '38708004', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:44:37', '2022-09-11 17:44:42'),
(141, 1049, 'Instant Shawl SuperFast | Peach', 1, '74307032', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:45:06', '2022-09-11 17:45:09'),
(142, 1050, 'Instant Shawl SuperFast | Rose Gold', 1, '40300826', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:45:29', '2022-09-11 17:45:31'),
(143, 1051, 'Instant Shawl SuperFast | Sand', 1, '28648365', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:45:54', '2022-09-11 17:45:57'),
(144, 1052, 'Instant Shawl SuperFast | Sky Blue', 1, '21731533', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:46:15', '2022-09-11 17:46:18'),
(145, 1053, 'Instant Shawl SuperFast | Smokey Blue', 1, '70097593', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:46:38', '2022-09-11 17:46:40'),
(146, 1054, 'Instant Shawl SuperFast | Smokey Brown', 1, '92061472', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:46:59', '2022-09-11 17:47:02'),
(147, 1055, 'Instant Shawl SuperFast | Smokey Grey', 1, '45201726', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:47:22', '2022-09-11 17:47:24'),
(148, 1056, 'Instant Shawl SuperFast | Smokey Purple', 1, '17145893', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:49:27', '2022-09-11 17:49:31'),
(149, 1057, 'Instant Shawl SuperFast | Smokey Peach', 1, '69322489', 27, '0.25', 1, '5.74', '20.00', '248', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:50:14', '2022-09-11 17:50:16'),
(150, 1058, 'Instant Shawl Rania | Blue Black', 1, '75231916', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:52:05', '2022-09-11 17:52:07'),
(151, 1059, 'Instant Shawl Rania | Dusty Blue', 1, '17019449', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:54:29', '2022-09-11 17:54:34'),
(152, 1060, 'Instant Shawl Rania | Dusty Pink', 1, '59732371', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:58:06', '2022-09-11 17:58:10'),
(153, 1061, 'Instant Shawl Rania | Electric Blue', 1, '64380653', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:58:31', '2022-09-11 17:58:33'),
(154, 1062, 'Instant Shawl Rania | Light Green', 1, '15923248', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:58:53', '2022-09-11 17:58:55'),
(155, 1063, 'Instant Shawl Rania | Maroon', 1, '29345883', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:59:15', '2022-09-11 17:59:17'),
(156, 1064, 'Instant Shawl Rania | Nescafe', 1, '14082346', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 17:59:47', '2022-09-11 17:59:50'),
(157, 1065, 'Instant Shawl Rania | Rose Gold', 1, '81302015', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 18:00:20', '2022-09-11 18:00:25'),
(158, 1066, 'Instant Shawl Rania | Smokey Blue', 1, '45959180', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 18:01:41', '2022-09-11 18:01:45'),
(159, 1067, 'Instant Shawl Rania | Smokey Brown', 1, '92976296', 26, '0.25', 1, '4.95', '20.00', '304', '15', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 18:02:24', '2022-09-11 18:02:27'),
(161, 1075, 'Shawl Plain Stone | Dusty Blue', 1, '68959356', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 21:30:20', '2022-09-11 21:30:24'),
(162, 1076, 'Shawl Plain Stone | Dusty Mint', 1, '62132287', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 21:34:08', '2022-09-11 21:34:12'),
(163, 1077, 'Shawl Plain Stone | Dusty Pink', 1, '10327831', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 21:35:07', '2022-09-11 21:35:11'),
(164, 1078, 'Shawl Plain Stone | Dusty Purple', 1, '32510425', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 21:35:36', '2022-09-11 21:35:38'),
(165, 1079, 'Shawl Plain Stone | Hazelnut', 1, '46223100', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 21:36:03', '2022-09-11 21:36:06'),
(166, 1080, 'Shawl Plain Stone | Latte', 1, '38728940', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 21:36:35', '2022-09-11 21:36:38'),
(167, 1081, 'Shawl Plain Stone | Light Purple', 1, '93517638', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 22:04:41', '2022-09-11 22:04:46'),
(168, 1082, 'Shawl Plain Stone | Mocha', 1, '11824077', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 22:05:06', '2022-09-11 22:05:08'),
(169, 1083, 'Shawl Plain Stone | Soft Pink', 1, '37138605', 29, '0.25', 1, '11.75', '30.00', '155', '18', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-11 22:05:31', '2022-09-11 22:05:33'),
(170, 1084, 'Songket Bunga Raya | Apple Green Silver', 1, '19619520', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:12:27', '2022-09-12 00:12:32'),
(171, 1085, 'Songket Bunga Raya | Baby Blue Gold', 1, '53111469', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:16:16', '2022-09-12 00:16:20'),
(172, 1086, 'Songket Bunga Raya | Baby Pink Gold', 1, '27024188', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:17:36', '2022-09-12 00:17:41'),
(173, 1087, 'Songket Bunga Raya | Black Gold', 1, '30792600', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:19:51', '2022-09-12 00:19:55'),
(174, 1088, 'Songket Bunga Raya | Black Silver', 1, '53734560', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:20:27', '2022-09-12 00:20:29'),
(175, 1089, 'Songket Bunga Raya | Blue Black Gold', 1, '51767639', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:20:58', '2022-09-12 00:21:00'),
(176, 1090, 'Songket Bunga Raya | Blue Black Silver', 1, '48907170', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:21:28', '2022-09-12 00:21:30'),
(177, 1091, 'Songket Bunga Raya | Blue Turquoise Gold', 1, '24627939', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:22:06', '2022-09-12 00:22:10'),
(178, 1092, 'Songket Bunga Raya | Blue Turquoise Silver', 1, '71314136', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:23:22', '2022-09-12 00:23:26'),
(179, 1093, 'Songket Bunga Raya | Champagne Silver', 1, '29715034', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:23:59', '2022-09-12 00:24:01'),
(180, 1094, 'Songket Bunga Raya | Chocolate Gold', 1, '89894591', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:24:27', '2022-09-12 00:24:30'),
(181, 1095, 'Songket Bunga Raya | Cream Gold', 1, '70091276', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:24:55', '2022-09-12 00:24:58'),
(182, 1096, 'Songket Bunga Raya | Cream Silver', 1, '32116250', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:25:25', '2022-09-12 00:25:28'),
(183, 1097, 'Songket Bunga Raya | Dark Chocolate Silver', 1, '52411726', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:25:55', '2022-09-12 00:25:57'),
(184, 1098, 'Songket Bunga Raya | Dark Emerald Green Gold', 1, '90919034', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:30:56', '2022-09-12 00:31:00'),
(185, 1099, 'Songket Bunga Raya | Dark Emerald Green Silver', 1, '27338101', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:31:28', '2022-09-12 00:31:30'),
(186, 1100, 'Songket Bunga Raya | Dark Purple Silver', 1, '47842390', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:36:44', '2022-09-12 00:36:48'),
(187, 1101, 'Songket Bunga Raya | Emerald Green Silver', 1, '96356133', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:41:36', '2022-09-12 00:41:41'),
(188, 1102, 'Songket Bunga Raya | Grey Gold', 1, '27235046', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:45:32', '2022-09-12 00:45:36'),
(189, 1103, 'Songket Bunga Raya | Grey Silver', 1, '63135027', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:46:04', '2022-09-12 00:46:06'),
(190, 1104, 'Songket Bunga Raya | Light Mint Green Gold', 1, '90158533', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:46:46', '2022-09-12 00:46:50'),
(191, 1105, 'Songket Bunga Raya | Light Purple Gold', 1, '98191167', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:47:29', '2022-09-12 00:47:31'),
(192, 1106, 'Songket Bunga Raya | Light Purple Silver', 1, '94509469', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:48:03', '2022-09-12 00:48:07'),
(193, 1107, 'Songket Bunga Raya | Light Purple Silver', 1, '40891177', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:50:41', '2022-09-12 00:50:45'),
(194, 1108, 'Songket Bunga Raya | Maroon Gold', 1, '42161358', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:57:43', '2022-09-12 00:57:46'),
(195, 1109, 'Songket Bunga Raya | Maroon silver', 1, '34728958', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:58:34', '2022-09-12 00:58:37'),
(196, 1110, 'Songket Bunga Raya | Mint Green Gold', 1, '36057991', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:59:10', '2022-09-12 00:59:12'),
(197, 1111, 'Songket Bunga Raya | Olive Green Gold', 1, '83264011', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 00:59:38', '2022-09-12 00:59:40'),
(198, 1112, 'Songket Bunga Raya | Olive Green Silver', 1, '80411746', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:02:08', '2022-09-12 01:02:13'),
(199, 1113, 'Songket Bunga Raya | Orange Silver', 1, '29097266', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:04:20', '2022-09-12 01:04:24'),
(200, 1114, 'Songket Bunga Raya | Pink Belacan Gold', 1, '19026300', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:05:01', '2022-09-12 01:05:06'),
(201, 1115, 'Songket Bunga Raya | Purple Gold', 1, '91000348', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:05:36', '2022-09-12 01:05:38'),
(202, 1116, 'Songket Bunga Raya | Purple Mangis Gold', 1, '72875120', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:06:03', '2022-09-12 01:06:06'),
(204, 1118, 'Songket Bunga Raya | Royal Blue Gold', 1, '51320899', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:17:58', '2022-09-12 01:18:00'),
(205, 1119, 'Songket Bunga Raya | Royal Blue Silver', 1, '63683184', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:18:26', '2022-09-12 01:18:29'),
(206, 1120, 'Songket Bunga Raya | Salmon Silver', 1, '21215871', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:20:10', '2022-09-12 01:20:12'),
(207, 1121, 'Songket Bunga Raya | Teal Green Gold', 1, '74203293', 19, NULL, 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:21:00', '2022-09-12 01:21:04'),
(208, 1122, 'Songket Bunga Raya | Teal Green Silver', 1, '97395340', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:21:34', '2022-09-12 01:21:36'),
(209, 1123, 'Songket Bunga Raya | Yellow Silver', 1, '79629902', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:22:01', '2022-09-12 01:22:03'),
(210, 1124, 'Songket Bunga Raya | Purple Mangis Silver', 1, '63842554', 19, '0.53', 1, '40.00', '80.00', '100', '40', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:28:13', '2022-09-12 01:28:17'),
(211, 1125, 'Songket Tenun 11″ inch | Apple Green Silver D5', 1, '13956168', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:33:57', '2022-09-12 01:34:01'),
(212, 1126, 'Songket Tenun 11″ inch | Avocado Green Gold D5', 1, '89140957', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:34:47', '2022-09-12 01:34:52'),
(213, 1127, 'Songket Tenun 11″ inch | Avocado Green Silver D5', 1, '26854736', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:35:23', '2022-09-12 01:35:27'),
(214, 1128, 'Songket Tenun 11″ inch | Black Gold D4', 1, '84612231', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:35:57', '2022-09-12 01:35:59'),
(215, 1129, 'Songket Tenun 11″ inch | Black Silver D1', 1, '27014816', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:36:29', '2022-09-12 01:36:31'),
(216, 1130, 'Songket Tenun 11″ inch | Black Silver D2', 1, '21715909', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:37:09', '2022-09-12 01:37:11'),
(217, 1131, 'Songket Tenun 11″ inch | Blue Black Gold D1', 1, '29634210', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:38:02', '2022-09-12 01:38:06'),
(218, 1132, 'Songket Tenun 11″ inch | Blue Black Silver D1', 1, '99700454', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:38:33', '2022-09-12 01:38:35'),
(219, 1133, 'Songket Tenun 11″ inch | Champagne Gold D4', 1, '62503497', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:38:59', '2022-09-12 01:39:01'),
(220, 1134, 'Songket Tenun 11″ inch | Champagne Silver D3', 1, '93822404', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:39:28', '2022-09-12 01:39:30'),
(221, 1135, 'Songket Tenun 11″ inch | Cream Gold D3', 1, '32691463', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:39:52', '2022-09-12 01:39:54'),
(222, 1136, 'Songket Tenun 11″ inch | Cream Gold D4', 1, '90135921', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:40:18', '2022-09-12 01:40:20'),
(223, 1137, 'Songket Tenun 11″ inch | Cream Gold D5', 1, '37949360', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:40:40', '2022-09-12 01:40:43'),
(224, 1138, 'Songket Tenun 11″ inch | Cream Silver D2', 1, '39489390', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:42:49', '2022-09-12 01:42:51'),
(225, 1139, 'Songket Tenun 11″ inch | Cream Silver D3', 1, '22640339', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:43:14', '2022-09-12 01:43:16'),
(226, 1140, 'Songket Tenun 11″ inch | Cream Silver D4', 1, '86087952', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:43:39', '2022-09-12 01:43:41'),
(227, 1141, 'Songket Tenun 11″ inch | Dark Chocolate Gold D4', 1, '48326389', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:44:05', '2022-09-12 01:44:07'),
(228, 1142, 'Songket Tenun 11″ inch | Dark Chocolate Silver D1', 1, '19434087', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:44:37', '2022-09-12 01:44:39'),
(229, 1143, 'Songket Tenun 11″ inch | Dark Chocolate Silver D2', 1, '83526209', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:45:05', '2022-09-12 01:45:08'),
(230, 1144, 'Songket Tenun 11″ inch | Dark Chocolate Silver D5', 1, '33928538', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:45:32', '2022-09-12 01:45:34'),
(231, 1145, 'Songket Tenun 11″ inch | Dark Emerald Green Gold D3', 1, '39771342', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:46:01', '2022-09-12 01:46:04'),
(232, 1146, 'Songket Tenun 11″ inch | Dark Emerald Green Silver D1', 1, '93158763', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:46:26', '2022-09-12 01:46:28'),
(233, 1147, 'Songket Tenun 11″ inch | Dark Emerald Green Silver D2', 1, '79134092', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:46:54', '2022-09-12 01:46:56'),
(234, 1148, 'Songket Tenun 11″ inch | Dark Emerald Green Silver D5', 1, '82389239', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:47:20', '2022-09-12 01:47:23'),
(235, 1149, 'Songket Tenun 11″ inch | Dark Magenta Gold D3', 1, '54353119', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:47:44', '2022-09-12 01:47:46'),
(236, 1150, 'Songket Tenun 11″ inch | Dark Magenta Silver D2', 1, '93194115', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:48:26', '2022-09-12 01:48:28');
INSERT INTO `products` (`id`, `w_id`, `name`, `brand_id`, `product_code`, `product_category`, `weight`, `unit`, `product_cost`, `product_price`, `profit_per`, `profit_val`, `inventory`, `alert_qty`, `product_tax`, `tax_method`, `featured`, `product_images`, `detail`, `promotional_price`, `is_diffPrice`, `is_variant`, `is_promo`, `promotional_start`, `promotional_end`, `created_at`, `updated_at`) VALUES
(237, 1151, 'Songket Tenun 11″ inch | Dark Maroon Gold D1', 1, '70791955', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:48:50', '2022-09-12 01:48:52'),
(238, 1152, 'Songket Tenun 11″ inch | Dark Maroon Gold D3', 1, '72103061', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:49:15', '2022-09-12 01:49:17'),
(239, 1153, 'Songket Tenun 11″ inch | Dark Maroon Gold D4', 1, '91533428', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:49:46', '2022-09-12 01:49:48'),
(240, 1154, 'Songket Tenun 11″ inch | Dark Maroon Silver D1', 1, '72342395', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:50:34', '2022-09-12 01:50:38'),
(241, 1155, 'Songket Tenun 11″ inch | Dark Pink Silver D1', 1, '10045916', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:50:57', '2022-09-12 01:50:59'),
(242, 1156, 'Songket Tenun 11″ inch | Dark Purple Silver D1', 1, '70920905', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:51:20', '2022-09-12 01:51:22'),
(243, 1157, 'Songket Tenun 11″ inch | Dark Purple Silver D2', 1, '69701014', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:51:44', '2022-09-12 01:51:46'),
(244, 1158, 'Songket Tenun 11″ inch | Dusty Pink Gold D4', 1, '20571079', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:52:19', '2022-09-12 01:52:22'),
(245, 1159, 'Songket Tenun 11″ inch | Dusty Pink Silver D4', 1, '59821827', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:52:44', '2022-09-12 01:52:46'),
(246, 1160, 'Songket Tenun 11″ inch | Grey Gold D3', 1, '34172669', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:53:09', '2022-09-12 01:53:11'),
(247, 1161, 'Songket Tenun 11″ inch | Grey Silver D3', 1, '32687421', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:54:16', '2022-09-12 01:54:20'),
(248, 1162, 'Songket Tenun 11″ inch | Light Purple Silver D2', 1, '22035679', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:54:54', '2022-09-12 01:54:56'),
(249, 1163, 'Songket Tenun 11″ inch | Magenta Silver D1', 1, '43452876', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:55:19', '2022-09-12 01:55:22'),
(250, 1164, 'Songket Tenun 11″ inch | Magenta Silver D2', 1, '29495192', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:55:44', '2022-09-12 01:55:46'),
(251, 1165, 'Songket Tenun 11″ inch | Maroon Silver D1', 1, '76312092', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:56:06', '2022-09-12 01:56:08'),
(252, 1166, 'Songket Tenun 11″ inch | Maroon Silver D2', 1, '32790360', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:56:28', '2022-09-12 01:56:31'),
(253, 1167, 'Songket Tenun 11″ inch | Midnight Blue Silver D1', 1, '33275508', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:56:58', '2022-09-12 01:57:00'),
(254, 1168, 'Songket Tenun 11″ inch | Mustard Silver D3', 1, '41397472', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:57:41', '2022-09-12 01:57:43'),
(255, 1169, 'Songket Tenun 11″ inch | Off White Gold D5', 1, '72926316', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:58:04', '2022-09-12 01:58:07'),
(256, 1170, 'Songket Tenun 11″ inch | Olive Green Gold D5', 1, '41125613', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:58:27', '2022-09-12 01:58:29'),
(257, 1171, 'Songket Tenun 11″ inch | Pink Silver D5', 1, '28338079', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:59:13', '2022-09-12 01:59:17'),
(258, 1172, 'Songket Tenun 11″ inch | Royal Blue Gold D1', 1, '98325197', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 01:59:41', '2022-09-12 01:59:43'),
(259, 1173, 'Songket Tenun 11″ inch | Royal Blue Gold D3', 1, '86997501', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:00:06', '2022-09-12 02:00:09'),
(260, 1174, 'Songket Tenun 11″ inch | Royal Blue Gold D5', 1, '59067121', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:00:29', '2022-09-12 02:00:31'),
(261, 1175, 'Songket Tenun 11″ inch | Royal Blue Silver D1', 1, '38676821', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:01:19', '2022-09-12 02:01:21'),
(262, 1176, 'Songket Tenun 11″ inch | Royal Blue Silver D2', 1, '74362729', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:03:00', '2022-09-12 02:03:03'),
(263, 1177, 'Songket Tenun 11″ inch | Royal Blue Silver D5', 1, '34100528', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:03:32', '2022-09-12 02:03:34'),
(264, 1178, 'Songket Tenun 11″ inch | Black Gold D1', 1, '82939061', 12, '0.70', 1, '33.00', '80.00', '142', '47', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:03:56', '2022-09-12 02:03:58'),
(266, 1180, 'Songket Tenun Lily Star | Dark Chocolate Silver', 1, '94701201', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:09:05', '2022-09-12 02:09:10'),
(267, 1181, 'Songket Tenun Lily Star | Blue Turquoise Silver', 1, '43030810', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:11:45', '2022-09-12 02:11:49'),
(268, 1182, 'Songket Tenun Lily Star | Dark Emerald Green silver', 1, '14021798', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:12:45', '2022-09-12 02:12:47'),
(269, 1183, 'Songket Tenun Lily Star | Dark Purple Gold', 1, '65200113', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:13:14', '2022-09-12 02:13:16'),
(270, 1184, 'Songket Tenun Lily Star | Dark Purple Silver', 1, '30596172', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:13:43', '2022-09-12 02:13:45'),
(271, 1185, 'Songket Tenun Lily Star | Magenta Gold', 1, '63423149', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:14:27', '2022-09-12 02:14:32'),
(272, 1186, 'Songket Tenun Lily Star | Magenta Silver', 1, '67896232', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:14:51', '2022-09-12 02:14:53'),
(273, 1187, 'Songket Tenun Lily Star | Maroon silver', 1, '22379730', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:15:25', '2022-09-12 02:15:29'),
(274, 1188, 'Songket Tenun Lily Star | Olive green silver', 1, '33466518', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:15:55', '2022-09-12 02:15:57'),
(275, 1189, 'Songket Tenun Lily Star | Royal Blue Silver', 1, '14659168', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:16:21', '2022-09-12 02:16:23'),
(276, 1190, 'Songket Tenun Lily Star | Teal Green Silver', 1, '90168138', 13, '0.53', 1, '33.00', '55.00', '67', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:16:50', '2022-09-12 02:16:52'),
(296, 1210, 'Songket Star Flower | Cream Silver', 1, '21108968', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:46:39', '2022-09-12 02:46:41'),
(297, 1211, 'Songket Star Flower | Dark Magenta Silver', 1, '81835906', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:48:11', '2022-09-12 02:48:16'),
(298, 1212, 'Songket Star Flower | Cream Gold', 1, '24798552', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:49:57', '2022-09-12 02:49:59'),
(299, 1213, 'Songket Star Flower | Dusty Pink Gold', 1, '82013973', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:50:39', '2022-09-12 02:50:41'),
(300, 1214, 'Songket Star Flower | Dusty Pink Silver', 1, '20167402', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:51:08', '2022-09-12 02:51:11'),
(302, 1216, 'Songket Star Flower | Emerald Green Gold', 1, '68422039', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:53:34', '2022-09-12 02:53:39'),
(303, 1217, 'Songket Star Flower | Emerald Green Silver', 1, '83014473', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:54:07', '2022-09-12 02:54:09'),
(305, 1219, 'Songket Star Flower | Grey Rose Gold', 1, '97810036', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:55:32', '2022-09-12 02:55:34'),
(306, 1220, 'Songket Star Flower | Grey Silver', 1, '79329062', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:56:01', '2022-09-12 02:56:05'),
(307, 1221, 'Songket Star Flower | Lavender Silver', 1, '46810012', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:56:24', '2022-09-12 02:56:26'),
(308, 1222, 'Songket Star Flower | Magenta Silver', 1, '48290018', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:57:19', '2022-09-12 02:57:23'),
(309, 1223, 'Songket Star Flower | Mint Green Silver', 1, '98980460', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:57:50', '2022-09-12 02:57:52'),
(310, 1224, 'Songket Star Flower | Nude Silver', 1, '72106598', 16, NULL, 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:58:14', '2022-09-12 02:58:17'),
(311, 1225, 'Songket Star Flower | Purple Mangis', 1, '33128070', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:58:39', '2022-09-12 02:58:42'),
(312, 1226, 'Songket Star Flower | Purple Silver', 1, '73860132', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 02:59:06', '2022-09-12 02:59:09'),
(313, 1227, 'Songket Star Flower | White Silver', 1, '35470952', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 03:01:38', '2022-09-12 03:01:40'),
(314, 1228, 'Songket Star Flower | Grey Gold', 1, '71200392', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-12 03:03:29', '2022-09-12 03:03:34'),
(318, 1475, 'Slit Instant Shawl | Baby Blue', 1, '11998129', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:02:59', '2022-09-14 01:03:03'),
(319, 1476, 'Slit Instant Shawl | Black', 1, '43511157', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:04:45', '2022-09-14 01:04:47'),
(320, 1477, 'Slit Instant Shawl | Blue black', 1, '51827180', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:05:40', '2022-09-14 01:05:42'),
(321, 1478, 'Slit Instant Shawl | Dusty Blue', 1, '85231727', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:06:23', '2022-09-14 01:06:25'),
(322, 1479, 'Slit Instant Shawl | Dusty Pink', 1, '15082912', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:06:57', '2022-09-14 01:06:59'),
(323, 1480, 'Slit Instant Shawl | Latte', 1, '96987159', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:07:28', '2022-09-14 01:07:31'),
(325, 1482, 'Slit Instant Shawl | Light Grey', 1, '39712024', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:09:06', '2022-09-14 01:09:10'),
(326, 1483, 'Slit Instant Shawl | Nescafe', 1, '34177255', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:09:38', '2022-09-14 01:09:41'),
(327, 1484, 'Slit Instant Shawl | Sand', 1, '20361193', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:10:15', '2022-09-14 01:10:19'),
(328, 1485, 'Slit Instant Shawl | Smokey Brown', 1, '92430597', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:10:48', '2022-09-14 01:10:50'),
(329, 1486, 'Mia Instant Sarung | Baby blue', 1, '75839643', 21, '0.12', 1, '8.00', '25.00', '213', '17', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:13:23', '2022-09-14 01:13:28'),
(330, 1487, 'Mia Instant Sarung | Black', 1, '31723241', 21, '0.12', 1, '8.00', '25.00', '213', '17', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:14:05', '2022-09-14 01:14:07'),
(331, 1488, 'Mia Instant Sarung | Light Green', 1, '23554864', 21, '0.12', 1, '8.00', '25.00', '213', '17', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:14:58', '2022-09-14 01:15:03'),
(332, 1489, 'Mia Instant Sarung | Nescafe', 1, '27341603', 21, '0.12', 1, '8.00', '25.00', '213', '17', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:15:35', '2022-09-14 01:15:37'),
(333, 1490, 'Mia Instant Sarung | Peach', 1, '42821825', 21, '0.12', 1, '8.00', '25.00', '213', '17', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:16:16', '2022-09-14 01:16:21'),
(334, 1491, 'Mia Instant Sarung | Purple', 1, '43285603', 21, '0.12', 1, '8.00', '25.00', '213', '17', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:16:46', '2022-09-14 01:16:49'),
(335, 1492, 'Mia Instant Sarung | Royal Blue', 1, '96927394', 21, '0.12', 1, '8.00', '25.00', '213', '17', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:17:23', '2022-09-14 01:17:28'),
(336, 1493, 'Mia Instant Sarung | Blue Black', 1, '29199004', 21, '0.12', 1, '8.00', '25.00', '213', '17', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:17:58', '2022-09-14 01:18:01'),
(337, 1494, 'Moss Instant Sarung | Bw101', 1, '41228016', 23, '0.19', 1, '10.40', '25.00', '140', '15', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:19:55', '2022-09-14 01:19:59'),
(338, 1495, 'Moss Instant Sarung | Bw102', 1, '10631280', 23, '0.19', 1, '10.40', '25.00', '140', '15', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:21:03', '2022-09-14 01:21:09'),
(339, 1496, 'Moss Instant Sarung | Bw103', 1, '39149100', 23, '0.19', 1, '10.40', '25.00', '140', '15', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:21:55', '2022-09-14 01:21:59'),
(340, 1497, 'Moss Instant Sarung | Bw104', 1, '31965468', 23, '0.19', 1, '10.40', '25.00', '140', '15', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:22:37', '2022-09-14 01:22:41'),
(341, 1498, 'Moss Instant Sarung | Bw105', 1, '67862920', 23, '0.19', 1, '10.40', '25.00', '140', '15', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:23:11', '2022-09-14 01:23:13'),
(342, 1499, 'Moss Instant Sarung | bw106', 1, '50182849', 23, '0.19', 1, '10.40', '25.00', '140', '15', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:23:47', '2022-09-14 01:23:51'),
(343, 1500, 'Instant Shawl 2.O | Baby Blue', 1, '70391905', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:25:45', '2022-09-14 01:25:50'),
(344, 1501, 'Instant Shawl 2.O | Black', 1, '30969350', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:26:28', '2022-09-14 01:26:30'),
(345, 1502, 'Instant Shawl 2.O | Dusty Blue', 1, '45122178', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:27:08', '2022-09-14 01:27:12'),
(346, 1503, 'Instant Shawl 2.O | Dusty Pink', 1, '40385112', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:27:42', '2022-09-14 01:27:45'),
(347, 1504, 'Instant Shawl 2.O | Latte', 1, '97316822', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:28:19', '2022-09-14 01:28:23'),
(348, 1505, 'Instant Shawl 2.O | Latte Brown', 1, '84321916', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:29:00', '2022-09-14 01:29:02'),
(349, 1506, 'Instant Shawl 2.O | Light Green', 1, '15993681', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:29:36', '2022-09-14 01:29:40'),
(350, 1507, 'Instant Shawl 2.O | Mint Blue', 1, '85112216', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:30:13', '2022-09-14 01:30:16'),
(351, 1508, 'Instant Shawl 2.O | Nescafe', 1, '63673008', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:31:07', '2022-09-14 01:31:11'),
(352, 1509, 'Instant Shawl 2.O | Sand', 1, '62281376', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:31:52', '2022-09-14 01:31:56'),
(353, 1510, 'Instant Shawl 2.O | Smokey Brown', 1, '29327403', 22, '0.20', 1, '6.82', '25.00', '267', '18', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:32:21', '2022-09-14 01:32:23'),
(354, 1511, 'Songket Star Flower | Baby Blue - Brown', 1, '19304265', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:39:12', '2022-09-14 01:39:17'),
(355, 1512, 'Songket Star Flower | Baby Blue - Green', 1, '31400278', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:40:45', '2022-09-14 01:40:49'),
(356, 1513, 'Songket Star Flower | Champagne – Silver', 1, '85673159', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:41:25', '2022-09-14 01:41:27'),
(357, 1514, 'Songket Star Flower | Cream – Pink', 1, '65197092', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:41:54', '2022-09-14 01:41:56'),
(358, 1515, 'Songket Star Flower | Mint Green - Gold', 1, '25389077', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:43:09', '2022-09-14 01:43:14'),
(359, 1516, 'Songket Star Flower | Mustard – Orange', 1, '36108172', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:43:55', '2022-09-14 01:43:57'),
(360, 1517, 'Songket Star Flower | Olive Green – Gold', 1, '12033637', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:44:31', '2022-09-14 01:44:36'),
(361, 1518, 'Songket Star Flower | Orange – Gold', 1, '63255012', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:45:08', '2022-09-14 01:45:10'),
(362, 1519, 'Songket Star Flower | White – Brown', 1, '34009115', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:45:37', '2022-09-14 01:45:40'),
(363, 1520, 'Songket Star Flower | White – Gold', 1, '70995114', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:46:11', '2022-09-14 01:46:14'),
(364, 1521, 'Songket Star Flower | Yellow – Blue', 1, '23747362', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:46:40', '2022-09-14 01:46:42'),
(365, 1522, 'Songket Star Flower | Yellow – Brown', 1, '50834345', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:47:06', '2022-09-14 01:47:08'),
(366, 1523, 'Songket Star Flower | Yellow – Gold', 1, '83240072', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:47:31', '2022-09-14 01:47:33'),
(367, 1524, 'Songket Star Flower | Yellow – Green', 1, '16751338', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:48:01', '2022-09-14 01:48:03'),
(368, 1525, 'Songket Star Flower | Yellow – Purple', 1, '90435850', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:48:27', '2022-09-14 01:48:29'),
(369, 1526, 'Songket Star Flower | Yellow – Rose Gold', 1, '79075082', 14, '0.70', 1, '56.25', '120.00', '113', '64', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:48:51', '2022-09-14 01:48:53'),
(370, 1527, 'Songket Tenun Matching | Dark Purple', 1, '25311509', 20, '0.64', 1, '40.00', '90.00', '125', '50', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:52:13', '2022-09-14 01:52:17'),
(371, 1528, 'Songket Tenun Matching | Magenta Silver', 1, '70756985', 20, '0.64', 1, '40.00', '90.00', '125', '50', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:52:57', '2022-09-14 01:52:59'),
(372, 1529, 'Songket Tenun Matching | Midnight Blue', 1, '53412067', 20, '0.64', 1, '40.00', '90.00', '125', '50', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:53:29', '2022-09-14 01:53:32'),
(373, 1530, 'Songket Bunga Tabur | Baby Blue Gold', 1, '62703192', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:57:30', '2022-09-14 01:57:35'),
(374, 1531, 'Songket Bunga Tabur | Baby Blue Silver', 1, '71898702', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:58:02', '2022-09-14 01:58:05'),
(375, 1532, 'Songket Bunga Tabur | Baby Pink Gold', 1, '33511297', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:58:37', '2022-09-14 01:58:41'),
(376, 1533, 'Songket Bunga Tabur | Baby Pink Silver', 1, '47590491', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:59:07', '2022-09-14 01:59:09'),
(377, 1534, 'Songket Bunga Tabur | Black Silver', 1, '70132691', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 01:59:38', '2022-09-14 01:59:40'),
(378, 1535, 'Songket Bunga Tabur | Blue Black Gold', 1, '30295282', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:00:10', '2022-09-14 02:00:13'),
(379, 1536, 'Songket Bunga Tabur | Blue Turquoise Gold', 1, '70536594', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:01:37', '2022-09-14 02:01:41'),
(380, 1537, 'Songket Bunga Tabur | Champagne Gold', 1, '81073509', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:02:06', '2022-09-14 02:02:09'),
(381, 1538, 'Songket Bunga Tabur | Champagne Silver', 1, '13421430', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:03:03', '2022-09-14 02:03:07'),
(382, 1539, 'Songket Bunga Tabur | Cream Gold', 1, '96208312', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:03:41', '2022-09-14 02:03:43'),
(383, 1540, 'Songket Bunga Tabur | Cream silver', 1, '16082720', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:04:16', '2022-09-14 02:04:20'),
(384, 1541, 'Songket Bunga Tabur | Dark Chocolate Silver', 1, '97215168', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:04:43', '2022-09-14 02:04:45'),
(385, 1542, 'Songket Bunga Tabur | Dark Emerald Green Gold', 1, '51837215', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:05:10', '2022-09-14 02:05:12'),
(386, 1543, 'Songket Bunga Tabur | Dark Emerald Green Silver', 1, '13900267', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:05:34', '2022-09-14 02:05:36'),
(387, 1544, 'Songket Bunga Tabur | Dark Purple Silver', 1, '13818014', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:06:01', '2022-09-14 02:06:03'),
(388, 1545, 'Songket Bunga Tabur | Grey Gold', 1, '38867692', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:06:34', '2022-09-14 02:06:38'),
(389, 1546, 'Songket Bunga Tabur | Grey Silver', 1, '33486926', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:06:57', '2022-09-14 02:06:59'),
(390, 1547, 'Songket Bunga Tabur | Light Orange Silver', 1, '70359221', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:07:59', '2022-09-14 02:08:01'),
(391, 1548, 'Songket Bunga Tabur | Light Purple Silver', 1, '92319018', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:08:52', '2022-09-14 02:08:56'),
(392, 1549, 'Songket Bunga Tabur | Magenta Gold', 1, '26970611', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:09:21', '2022-09-14 02:09:24'),
(393, 1550, 'Songket Bunga Tabur | Maroon Gold', 1, '62295930', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:09:47', '2022-09-14 02:09:50'),
(394, 1551, 'Songket Bunga Tabur | Maroon Silver', 1, '98102503', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:10:10', '2022-09-14 02:10:13'),
(395, 1552, 'Songket Bunga Tabur | Merah Hati Gold', 1, '52796804', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:10:39', '2022-09-14 02:10:41'),
(396, 1553, 'Songket Bunga Tabur | Mint Green Silver', 1, '94302810', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:11:16', '2022-09-14 02:11:19'),
(397, 1554, 'Songket Bunga Tabur | Olive Green Gold', 1, '90632891', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:11:43', '2022-09-14 02:11:45'),
(398, 1555, 'Songket Bunga Tabur | Olive Green silver', 1, '19359167', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:12:12', '2022-09-14 02:12:14'),
(399, 1556, 'Songket Bunga Tabur | Pink belacan Silver', 1, '72596479', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:13:43', '2022-09-14 02:13:47'),
(400, 1557, 'Songket Bunga Tabur | Purple Gold', 1, '82100519', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:14:11', '2022-09-14 02:14:13'),
(401, 1558, 'Songket Bunga Tabur | Royal Blue Gold', 1, '12589062', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:14:38', '2022-09-14 02:14:40'),
(402, 1559, 'Songket Bunga Tabur | Royal Blue Silver', 1, '96572561', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:15:04', '2022-09-14 02:15:07'),
(403, 1560, 'Songket Bunga Tabur | Teal Green Silver', 1, '94590381', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:15:36', '2022-09-14 02:15:38'),
(404, 1561, 'Songket Bunga Tabur | Yellow Gold', 1, '60868075', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:16:12', '2022-09-14 02:16:16'),
(405, 1562, 'Songket Bunga Tabur | Yellow Silver', 1, '33582427', 18, NULL, 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:16:38', '2022-09-14 02:16:40'),
(406, 1563, 'Songket Bunga Tabur | Blue Black Silver', 1, '99605120', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:17:02', '2022-09-14 02:17:05'),
(407, 1564, 'Songket Bunga Tabur | Black Gold', 1, '37426585', 18, '0.70', 1, '36.00', '55.00', '53', '19', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 02:17:46', '2022-09-14 02:17:50'),
(409, 1711, 'Songket Tenun 3D | Black Silver', 1, '87310854', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-14 15:11:28', '2022-09-17 03:14:08'),
(410, 1760, 'Slit Instant Shawl | Latte Brown', 1, '19329964', 24, '0.24', 1, '7.30', '29.00', '297', '22', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-14 19:07:32', '2022-09-14 19:07:37'),
(411, 1908, 'Baju Kurung Moden Songket | Purple Silver', 1, '31937564', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 10:59:15', '2022-09-15 10:59:22'),
(412, 1926, 'Baju Kurung Moden Songket | Baby Pink Silver', 1, '81237719', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:01:23', '2022-09-15 11:01:26'),
(413, 1938, 'Baju Kurung Moden Songket | Champagne Silver', 1, '26840549', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:02:46', '2022-09-15 11:02:50'),
(414, 1944, 'Baju Kurung Moden Songket | Black Silver', 1, '69415911', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:04:12', '2022-09-15 11:04:19'),
(415, 1950, 'Baju Kurung Moden Songket | Cream silver', 1, '19316298', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:05:20', '2022-09-15 11:05:23'),
(416, 1956, 'Baju Kurung moden Songket | Royal Blue Gold', 1, '80921339', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:06:29', '2022-09-15 11:06:32'),
(417, 1962, 'Baju Kurung Moden Songket | Maroon Gold', 1, '18452687', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:07:41', '2022-09-15 11:07:44'),
(418, 1968, 'Baju Kurung Moden Songket | Maroon Silver', 1, '17298332', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:08:52', '2022-09-15 11:08:55'),
(419, 1974, 'Baju Kurung Moden Songket | Yellow', 1, '43060995', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:09:52', '2022-09-15 11:09:54'),
(420, 1980, 'Baju Kurung Moden Songket | Olive Green Gold', 1, '10173696', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:10:44', '2022-09-15 11:10:46'),
(421, 1986, 'Baju Kurung Moden Songket | Black Gold', 1, '96591039', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:11:39', '2022-09-15 11:11:42'),
(422, 1992, 'Baju Kurung Moden Songket | Olive Green Silver', 1, '13008993', 9, '0.70', 1, '48.00', '129.00', '169', '81', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:12:37', '2022-09-15 11:12:40'),
(423, 1998, 'Baju Kurung Moden Songket | Baby Pink', 1, '54319026', 7, '0.70', 1, '82.00', '159.00', '0', '159', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:19:11', '2022-09-15 11:19:14'),
(424, 2005, 'Baju Kurung Moden Songket | Mint Green', 1, '99437231', 7, '0.70', 1, '82.00', '159.00', '94', '77', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:20:33', '2022-09-15 11:20:35'),
(425, 2012, 'Baju Kurung Moden Songket | White', 1, '23156084', 7, '0.70', 1, '82.00', '159.00', '94', '77', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-15 11:21:45', '2022-09-15 11:21:49'),
(426, 2019, 'Cattle Heart Bawal Square | Grey', 1, '28706320', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:33:09', '2022-09-15 11:33:13'),
(427, 2020, 'Cattle Heart Bawal Square | Lead Orange', 1, '61782951', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:34:09', '2022-09-15 11:34:14'),
(428, 2021, 'Cattle Heart Bawal Square | Slate Blue', 1, '82809071', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:34:50', '2022-09-15 11:34:52'),
(429, 2022, 'Chic Avant Bawal Square | Magic Blue', 1, '14052871', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:35:27', '2022-09-15 11:35:31'),
(430, 2023, 'Zauk Bawal Square | Black', 1, '44993150', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:36:23', '2022-09-15 11:36:26'),
(431, 2024, 'Zauk Bawal Square | Light Blue', 1, '17195329', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:36:56', '2022-09-15 11:36:58'),
(432, 2025, 'Zauk Bawal Square | Maroon', 1, '76102399', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:37:32', '2022-09-15 11:37:35'),
(433, 2026, 'Zauk Bawal Square | Navy Blue', 1, '73208367', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:38:09', '2022-09-15 11:38:12'),
(434, 2027, 'Zauk Bawal Square | White – Green', 1, '37569921', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:39:39', '2022-09-15 11:39:41'),
(435, 2028, 'Zauk Bawal Square | White – Pink', 1, '54072830', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:40:06', '2022-09-15 11:40:08'),
(436, 2029, 'Zauk Bawal Square | White – Pink Gold', 1, '93835620', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:40:43', '2022-09-15 11:40:45'),
(437, 2030, 'Zauk Stripe Bawal Square | Black Mustard', 1, '52577112', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:41:16', '2022-09-15 11:41:19'),
(438, 2031, 'Zauk Stripe Bawal Square | Black Pink', 1, '42975857', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:41:44', '2022-09-15 11:41:46'),
(439, 2032, 'Zauk Stripe Bawal Square | Dusty Maroon', 1, '56743338', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:42:10', '2022-09-15 11:42:12'),
(440, 2033, 'Zauk Stripe Bawal Square | Light Blue', 1, '87012110', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:42:36', '2022-09-15 11:42:38'),
(441, 2034, 'Zauk Stripe Bawal Square | Skin', 1, '99310250', 28, '0.20', 1, '25.00', '39.00', '56', '14', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 11:43:01', '2022-09-15 11:43:03'),
(442, 2240, 'Songket Star Flower | Dusty Purple Silver', 1, '98009172', 16, '0.70', 1, '50.00', '120.00', '140', '70', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2022-09-15 17:49:46', '2022-09-15 17:49:51'),
(443, 2493, 'Songket Tenun 3D | Blue Black Silver', 1, '23496372', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-16 03:25:56', '2022-09-17 03:14:37'),
(444, 2498, 'Songket Tenun 3D | Blue Black Silver Gold', 1, '90072263', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-16 03:29:46', '2022-09-17 03:14:59'),
(445, 2503, 'Songket Tenun 3D | Cream Gold', 1, '32341231', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-16 03:31:42', '2022-09-17 03:15:21'),
(446, 2508, 'Songket Tenun 3D | Cream Silver', 1, '37297583', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-16 03:32:48', '2022-09-17 03:15:43'),
(447, 2513, 'Songket Tenun 3D | Cream Silver Gold', 1, '84725315', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-16 03:33:49', '2022-09-17 03:16:18'),
(448, 2518, 'Songket Tenun 3D | Grey Blue', 1, '82801245', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-16 03:34:52', '2022-09-17 03:16:42'),
(449, 2523, 'Songket Tenun 3D | Mint Green Silver', 1, '34012209', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-16 03:35:45', '2022-09-17 03:17:10'),
(450, 2528, 'Songket Tenun 3D | Peach Multi Colour', 1, '20323239', 15, '900.00', 2, '16.50', '30.00', '82', '14', 0, 3, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-16 03:36:54', '2022-09-17 03:17:31'),
(456, 30797, 'Songket Star Shaded | Baby Blue Silver', 1, '48207529', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 01:58:45', '2022-09-17 01:58:49'),
(457, 30802, 'Songket Star Shaded | Black Silver', 1, '16280107', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:01:22', '2022-09-17 02:01:27'),
(458, 30807, 'Songket Star Shaded | Champagne Silver', 1, '18507321', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:05:07', '2022-09-17 02:05:12'),
(459, 30812, 'Songket Star Shaded | Dark Maroon Silver', 1, '31208660', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:06:25', '2022-09-17 02:06:29'),
(461, 30822, 'Songket Star Shaded | Dusty Blue Gold', 1, '13860773', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:22:39', '2022-09-17 02:22:44'),
(462, 30827, 'Songket Star Shaded | Dusty Purple Silver', 1, '96533207', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:26:05', '2022-09-17 02:26:10'),
(463, 30832, 'Songket Star Shaded | Emerald green Silver', 1, '13136659', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:27:02', '2022-09-17 02:27:04'),
(464, 30837, 'Songket Star Shaded | Grey Blue Silver', 1, '33080526', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:30:40', '2022-09-17 02:30:44'),
(465, 30842, 'Songket Star Shaded | Peach Gold', 1, '22901641', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:31:38', '2022-09-17 02:31:42'),
(466, 30847, 'Songket Star Shaded | Purple Gold', 1, '99691304', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:32:19', '2022-09-17 02:32:21'),
(467, 30852, 'Songket Star Shaded | Royal Blue Silver', 1, '57328305', 17, '0.60', 2, '8.00', '16.25', '103', '8', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, '2022-09-17 02:35:44', '2022-09-17 02:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additonal_price` decimal(8,2) DEFAULT NULL,
  `attribute` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PID` bigint(20) UNSIGNED NOT NULL,
  `v_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `name`, `item_code`, `additonal_price`, `attribute`, `attribute_value`, `PID`, `v_id`, `created_at`, `updated_at`) VALUES
(26, 'XS', 'XS-64167024', NULL, 'Ready To Wear Size', 'XS', 6, 281, '2022-09-08 21:31:46', '2022-09-08 21:31:46'),
(27, 'S', 'S-64167024', NULL, 'Ready To Wear Size', 'S', 6, 282, '2022-09-08 21:31:48', '2022-09-08 21:31:48'),
(28, 'M', 'M-64167024', NULL, 'Ready To Wear Size', 'M', 6, 283, '2022-09-08 21:31:51', '2022-09-08 21:31:51'),
(29, 'L', 'L-64167024', NULL, 'Ready To Wear Size', 'L', 6, 284, '2022-09-08 21:31:53', '2022-09-08 21:31:53'),
(30, 'XL', 'XL-64167024', NULL, 'Ready To Wear Size', 'XL', 6, 285, '2022-09-08 21:31:55', '2022-09-08 21:31:55'),
(31, 'XS', 'XS-81063583', NULL, 'Ready To Wear Size', 'XS', 7, 287, '2022-09-08 21:34:49', '2022-09-08 21:34:49'),
(32, 'S', 'S-81063583', NULL, 'Ready To Wear Size', 'S', 7, 288, '2022-09-08 21:34:51', '2022-09-08 21:34:51'),
(33, 'M', 'M-81063583', NULL, 'Ready To Wear Size', 'M', 7, 289, '2022-09-08 21:34:53', '2022-09-08 21:34:53'),
(34, 'L', 'L-81063583', NULL, 'Ready To Wear Size', 'L', 7, 290, '2022-09-08 21:34:55', '2022-09-08 21:34:55'),
(35, 'XL', 'XL-81063583', NULL, 'Ready To Wear Size', 'XL', 7, 291, '2022-09-08 21:34:58', '2022-09-08 21:34:58'),
(36, 'XS', 'XS-32702510', NULL, 'Ready To Wear Size', 'XS', 8, 293, '2022-09-08 21:35:29', '2022-09-09 23:57:54'),
(37, 'S', 'S-32702510', NULL, 'Ready To Wear Size', 'S', 8, 294, '2022-09-08 21:35:31', '2022-09-09 23:57:56'),
(38, 'M', 'M-32702510', NULL, 'Ready To Wear Size', 'M', 8, 295, '2022-09-08 21:35:33', '2022-09-09 23:57:57'),
(39, 'L', 'L-32702510', NULL, 'Ready To Wear Size', 'L', 8, 296, '2022-09-08 21:35:35', '2022-09-09 23:57:58'),
(40, 'XL', 'XL-32702510', NULL, 'Ready To Wear Size', 'XL', 8, 297, '2022-09-08 21:35:38', '2022-09-09 23:58:00'),
(41, 'XS', 'XS-93194805', NULL, 'Ready To Wear Size', 'XS', 9, 301, '2022-09-10 00:04:14', '2022-09-10 00:04:14'),
(42, 'S', 'S-93194805', NULL, 'Ready To Wear Size', 'S', 9, 302, '2022-09-10 00:04:16', '2022-09-10 00:04:16'),
(43, 'M', 'M-93194805', NULL, 'Ready To Wear Size', 'M', 9, 303, '2022-09-10 00:04:18', '2022-09-10 00:04:18'),
(44, 'L', 'L-93194805', NULL, 'Ready To Wear Size', 'L', 9, 304, '2022-09-10 00:04:20', '2022-09-10 00:04:20'),
(45, 'XL', 'XL-93194805', NULL, 'Ready To Wear Size', 'XL', 9, 305, '2022-09-10 00:04:23', '2022-09-10 00:04:23'),
(46, 'XS', 'XS-23915628', NULL, 'Ready To Wear Size', 'XS', 10, 307, '2022-09-10 00:09:04', '2022-09-10 00:09:04'),
(47, 'S', 'S-23915628', NULL, 'Ready To Wear Size', 'S', 10, 308, '2022-09-10 00:09:07', '2022-09-10 00:09:07'),
(48, 'M', 'M-23915628', NULL, 'Ready To Wear Size', 'M', 10, 309, '2022-09-10 00:09:09', '2022-09-10 00:09:09'),
(49, 'L', 'L-23915628', NULL, 'Ready To Wear Size', 'L', 10, 310, '2022-09-10 00:09:11', '2022-09-10 00:09:11'),
(50, 'XL', 'XL-23915628', NULL, 'Ready To Wear Size', 'XL', 10, 311, '2022-09-10 00:09:14', '2022-09-10 00:09:14'),
(51, 'XS', 'XS-83136710', NULL, 'Ready To Wear Size', 'XS', 11, 313, '2022-09-10 00:15:19', '2022-09-10 00:15:19'),
(52, 'S', 'S-83136710', NULL, 'Ready To Wear Size', 'S', 11, 314, '2022-09-10 00:15:20', '2022-09-10 00:15:20'),
(53, 'M', 'M-83136710', NULL, 'Ready To Wear Size', 'M', 11, 315, '2022-09-10 00:15:21', '2022-09-10 00:15:21'),
(54, 'XL', 'XL-83136710', NULL, 'Ready To Wear Size', 'XL', 11, 316, '2022-09-10 00:15:22', '2022-09-10 00:15:22'),
(55, 'L', 'L-83136710', NULL, 'Ready To Wear Size', 'L', 11, 317, '2022-09-10 00:15:23', '2022-09-10 00:15:23'),
(56, 'XS', 'XS-42420309', NULL, 'Ready To Wear Size', 'XS', 12, 319, '2022-09-10 00:16:31', '2022-09-10 00:16:31'),
(57, 'S', 'S-42420309', NULL, 'Ready To Wear Size', 'S', 12, 320, '2022-09-10 00:16:33', '2022-09-10 00:16:33'),
(58, 'M', 'M-42420309', NULL, 'Ready To Wear Size', 'M', 12, 321, '2022-09-10 00:16:36', '2022-09-10 00:16:36'),
(59, 'L', 'L-42420309', NULL, 'Ready To Wear Size', 'L', 12, 322, '2022-09-10 00:16:38', '2022-09-10 00:16:38'),
(60, 'XL', 'XL-42420309', NULL, 'Ready To Wear Size', 'XL', 12, 323, '2022-09-10 00:16:40', '2022-09-10 00:16:40'),
(61, 'XS', 'XS-63097582', NULL, 'Ready To Wear Size', 'XS', 13, 325, '2022-09-10 00:16:55', '2022-09-10 00:16:55'),
(62, 'S', 'S-63097582', NULL, 'Ready To Wear Size', 'S', 13, 326, '2022-09-10 00:16:56', '2022-09-10 00:16:56'),
(63, 'M', 'M-63097582', NULL, 'Ready To Wear Size', 'M', 13, 327, '2022-09-10 00:16:57', '2022-09-10 00:16:57'),
(64, 'L', 'L-63097582', NULL, 'Ready To Wear Size', 'L', 13, 328, '2022-09-10 00:16:58', '2022-09-10 00:16:58'),
(65, 'XL', 'XL-63097582', NULL, 'Ready To Wear Size', 'XL', 13, 329, '2022-09-10 00:17:00', '2022-09-10 00:17:00'),
(66, 'XS', 'XS-37362417', NULL, 'Ready To Wear Size', 'XS', 14, 331, '2022-09-10 00:26:03', '2022-09-10 00:26:03'),
(67, 'S', 'S-37362417', NULL, 'Ready To Wear Size', 'S', 14, 332, '2022-09-10 00:26:06', '2022-09-10 00:26:06'),
(68, 'M', 'M-37362417', NULL, 'Ready To Wear Size', 'M', 14, 333, '2022-09-10 00:26:08', '2022-09-10 00:26:08'),
(69, 'L', 'L-37362417', NULL, 'Ready To Wear Size', 'L', 14, 334, '2022-09-10 00:26:10', '2022-09-10 00:26:10'),
(70, '2XL', '2XL-37362417', NULL, 'Ready To Wear Size', '2XL', 14, 335, '2022-09-10 00:26:12', '2022-09-10 00:26:12'),
(71, '3XL', '3XL-37362417', NULL, 'Ready To Wear Size', '3XL', 14, 336, '2022-09-10 00:26:13', '2022-09-10 00:26:13'),
(72, '2XL', '2XL-15079789', NULL, 'Ready To Wear Size', '2XL', 15, 338, '2022-09-10 00:28:35', '2022-09-10 00:28:35'),
(73, 'S', 'S-15079789', NULL, 'Ready To Wear Size', 'S', 15, 339, '2022-09-10 00:28:37', '2022-09-10 00:28:37'),
(74, 'M', 'M-15079789', NULL, 'Ready To Wear Size', 'M', 15, 340, '2022-09-10 00:28:38', '2022-09-10 00:28:38'),
(75, 'L', 'L-15079789', NULL, 'Ready To Wear Size', 'L', 15, 341, '2022-09-10 00:28:39', '2022-09-10 00:28:39'),
(76, 'XL', 'XL-15079789', NULL, 'Ready To Wear Size', 'XL', 15, 342, '2022-09-10 00:28:41', '2022-09-10 00:28:41'),
(82, 'S', 'S-39221098', NULL, 'Ready To Wear Size', 'S', 17, 350, '2022-09-10 00:34:36', '2022-09-10 00:34:36'),
(83, 'M', 'M-39221098', NULL, 'Ready To Wear Size', 'M', 17, 351, '2022-09-10 00:34:38', '2022-09-10 00:34:38'),
(84, 'L', 'L-39221098', NULL, 'Ready To Wear Size', 'L', 17, 352, '2022-09-10 00:34:40', '2022-09-10 00:34:40'),
(85, 'XL', 'XL-39221098', NULL, 'Ready To Wear Size', 'XL', 17, 353, '2022-09-10 00:34:42', '2022-09-10 00:34:42'),
(86, '2XL', '2XL-39221098', NULL, 'Ready To Wear Size', '2XL', 17, 354, '2022-09-10 00:34:45', '2022-09-10 00:34:45'),
(87, 'XL', 'XL-70996549', NULL, 'Ready To Wear Size', 'XL', 18, 356, '2022-09-10 00:37:33', '2022-09-10 00:37:33'),
(88, 'L', 'L-70996549', NULL, 'Ready To Wear Size', 'L', 18, 357, '2022-09-10 00:37:35', '2022-09-10 00:37:35'),
(89, 'M', 'M-70996549', NULL, 'Ready To Wear Size', 'M', 18, 358, '2022-09-10 00:37:37', '2022-09-10 00:37:37'),
(90, 'S', 'S-70996549', NULL, 'Ready To Wear Size', 'S', 18, 359, '2022-09-10 00:37:38', '2022-09-10 00:37:38'),
(91, 'S', 'S-27313124', NULL, 'Ready To Wear Size', 'S', 19, 361, '2022-09-10 00:39:16', '2022-09-10 00:39:16'),
(92, 'M', 'M-27313124', NULL, 'Ready To Wear Size', 'M', 19, 362, '2022-09-10 00:39:18', '2022-09-10 00:39:18'),
(93, 'L', 'L-27313124', NULL, 'Ready To Wear Size', 'L', 19, 363, '2022-09-10 00:39:20', '2022-09-10 00:39:20'),
(94, 'XL', 'XL-27313124', NULL, 'Ready To Wear Size', 'XL', 19, 364, '2022-09-10 00:39:23', '2022-09-10 00:39:23'),
(95, '2XL', '2XL-27313124', NULL, 'Ready To Wear Size', '2XL', 19, 365, '2022-09-10 00:39:25', '2022-09-10 00:39:25'),
(96, 'S', 'S-98694627', NULL, 'Ready To Wear Size', 'S', 20, 367, '2022-09-10 00:43:20', '2022-09-10 00:43:20'),
(97, 'M', 'M-98694627', NULL, 'Ready To Wear Size', 'M', 20, 368, '2022-09-10 00:43:22', '2022-09-10 00:43:22'),
(98, 'L', 'L-98694627', NULL, 'Ready To Wear Size', 'L', 20, 369, '2022-09-10 00:43:24', '2022-09-10 00:43:24'),
(99, 'XL', 'XL-98694627', NULL, 'Ready To Wear Size', 'XL', 20, 370, '2022-09-10 00:43:26', '2022-09-10 00:43:26'),
(100, '2XL', '2XL-98694627', NULL, 'Ready To Wear Size', '2XL', 20, 371, '2022-09-10 00:43:29', '2022-09-10 00:43:29'),
(101, 'S', 'S-60527394', NULL, 'Ready To Wear Size', 'S', 21, 373, '2022-09-10 00:50:21', '2022-09-10 00:50:21'),
(102, 'M', 'M-60527394', NULL, 'Ready To Wear Size', 'M', 21, 374, '2022-09-10 00:50:23', '2022-09-10 00:50:23'),
(103, 'L', 'L-60527394', NULL, 'Ready To Wear Size', 'L', 21, 375, '2022-09-10 00:50:25', '2022-09-10 00:50:25'),
(104, 'XL', 'XL-60527394', NULL, 'Ready To Wear Size', 'XL', 21, 376, '2022-09-10 00:50:28', '2022-09-10 00:50:28'),
(105, '2XL', '2XL-60527394', NULL, 'Ready To Wear Size', '2XL', 21, 377, '2022-09-10 00:50:30', '2022-09-10 00:50:30'),
(106, 'S', 'S-67800208', NULL, 'Ready To Wear Size', 'S', 22, 379, '2022-09-10 00:53:32', '2022-09-10 00:53:32'),
(107, 'M', 'M-67800208', NULL, 'Ready To Wear Size', 'M', 22, 380, '2022-09-10 00:53:35', '2022-09-10 00:53:35'),
(108, 'L', 'L-67800208', NULL, 'Ready To Wear Size', 'L', 22, 381, '2022-09-10 00:53:37', '2022-09-10 00:53:37'),
(109, 'XL', 'XL-67800208', NULL, 'Ready To Wear Size', 'XL', 22, 382, '2022-09-10 00:53:39', '2022-09-10 00:53:39'),
(110, '2XL', '2XL-67800208', NULL, 'Ready To Wear Size', '2XL', 22, 383, '2022-09-10 00:53:41', '2022-09-10 00:53:41'),
(111, 'XS', 'XS-42115597', NULL, 'Ready To Wear Size', 'XS', 23, 385, '2022-09-10 01:01:58', '2022-09-10 01:01:58'),
(112, 'S', 'S-42115597', NULL, 'Ready To Wear Size', 'S', 23, 386, '2022-09-10 01:02:00', '2022-09-10 01:02:00'),
(113, 'M', 'M-42115597', NULL, 'Ready To Wear Size', 'M', 23, 387, '2022-09-10 01:02:03', '2022-09-10 01:02:03'),
(114, 'L', 'L-42115597', NULL, 'Ready To Wear Size', 'L', 23, 388, '2022-09-10 01:02:05', '2022-09-10 01:02:05'),
(115, 'XL', 'XL-42115597', NULL, 'Ready To Wear Size', 'XL', 23, 389, '2022-09-10 01:02:07', '2022-09-10 01:02:07'),
(116, '2XL', '2XL-42115597', NULL, 'Ready To Wear Size', '2XL', 23, 390, '2022-09-10 01:02:08', '2022-09-10 01:02:08'),
(117, 'S', 'S-49130833', NULL, 'Ready To Wear Size', 'S', 24, 392, '2022-09-10 01:09:22', '2022-09-10 01:09:22'),
(118, 'M', 'M-49130833', NULL, 'Ready To Wear Size', 'M', 24, 393, '2022-09-10 01:09:24', '2022-09-10 01:09:24'),
(119, 'L', 'L-49130833', NULL, 'Ready To Wear Size', 'L', 24, 394, '2022-09-10 01:09:26', '2022-09-10 01:09:26'),
(120, 'XL', 'XL-49130833', NULL, 'Ready To Wear Size', 'XL', 24, 395, '2022-09-10 01:09:28', '2022-09-10 01:09:28'),
(121, '2XL', '2XL-49130833', NULL, 'Ready To Wear Size', '2XL', 24, 396, '2022-09-10 01:09:30', '2022-09-10 01:09:30'),
(122, 'XS', 'XS-90783114', NULL, 'Ready To Wear Size', 'XS', 25, 398, '2022-09-10 01:12:55', '2022-09-10 01:12:55'),
(123, 'S', 'S-90783114', NULL, 'Ready To Wear Size', 'S', 25, 399, '2022-09-10 01:12:57', '2022-09-10 01:12:57'),
(124, 'M', 'M-90783114', NULL, 'Ready To Wear Size', 'M', 25, 400, '2022-09-10 01:12:59', '2022-09-10 01:12:59'),
(125, 'L', 'L-90783114', NULL, 'Ready To Wear Size', 'L', 25, 401, '2022-09-10 01:13:00', '2022-09-10 01:13:00'),
(126, 'XL', 'XL-90783114', NULL, 'Ready To Wear Size', 'XL', 25, 402, '2022-09-10 01:13:01', '2022-09-10 01:13:01'),
(127, '2XL', '2XL-90783114', NULL, 'Ready To Wear Size', '2XL', 25, 403, '2022-09-10 01:13:02', '2022-09-10 01:13:02'),
(128, '3XL', '3XL-90783114', NULL, 'Ready To Wear Size', '3XL', 25, 404, '2022-09-10 01:13:05', '2022-09-10 01:13:05'),
(129, 'XS', 'XS-21058216', NULL, 'Ready To Wear Size', 'XS', 26, 406, '2022-09-10 01:18:13', '2022-09-10 01:18:13'),
(130, 'S', 'S-21058216', NULL, 'Ready To Wear Size', 'S', 26, 407, '2022-09-10 01:18:16', '2022-09-10 01:18:16'),
(131, 'M', 'M-21058216', NULL, 'Ready To Wear Size', 'M', 26, 408, '2022-09-10 01:18:18', '2022-09-10 01:18:18'),
(132, 'L', 'L-21058216', NULL, 'Ready To Wear Size', 'L', 26, 409, '2022-09-10 01:18:20', '2022-09-10 01:18:20'),
(133, 'XL', 'XL-21058216', NULL, 'Ready To Wear Size', 'XL', 26, 410, '2022-09-10 01:18:22', '2022-09-10 01:18:22'),
(134, '2XL', '2XL-21058216', NULL, 'Ready To Wear Size', '2XL', 26, 411, '2022-09-10 01:18:24', '2022-09-10 01:18:24'),
(135, '3XL', '3XL-21058216', NULL, 'Ready To Wear Size', '3XL', 26, 412, '2022-09-10 01:18:26', '2022-09-10 01:18:26'),
(136, 'XS', 'XS-15548093', NULL, 'Ready To Wear Size', 'XS', 27, 414, '2022-09-10 01:30:43', '2022-09-10 01:30:43'),
(137, 'S', 'S-15548093', NULL, 'Ready To Wear Size', 'S', 27, 415, '2022-09-10 01:30:45', '2022-09-10 01:30:45'),
(138, 'M', 'M-15548093', NULL, 'Ready To Wear Size', 'M', 27, 416, '2022-09-10 01:30:48', '2022-09-10 01:30:48'),
(139, 'L', 'L-15548093', NULL, 'Ready To Wear Size', 'L', 27, 417, '2022-09-10 01:30:50', '2022-09-10 01:30:50'),
(140, 'XL', 'XL-15548093', NULL, 'Ready To Wear Size', 'XL', 27, 418, '2022-09-10 01:30:52', '2022-09-10 01:30:52'),
(141, '2XL', '2XL-15548093', NULL, 'Ready To Wear Size', '2XL', 27, 419, '2022-09-10 01:30:53', '2022-09-10 01:30:53'),
(142, '3XL', '3XL-15548093', NULL, 'Ready To Wear Size', '3XL', 27, 420, '2022-09-10 01:30:55', '2022-09-10 01:30:55'),
(157, 'XS', 'XS-63109997', NULL, 'Ready To Wear Size', 'XS', 30, 438, '2022-09-10 01:41:43', '2022-09-10 01:41:43'),
(158, 'S', 'S-63109997', NULL, 'Ready To Wear Size', 'S', 30, 439, '2022-09-10 01:41:46', '2022-09-10 01:41:46'),
(159, 'M', 'M-63109997', NULL, 'Ready To Wear Size', 'M', 30, 440, '2022-09-10 01:41:49', '2022-09-10 01:41:49'),
(160, 'L', 'L-63109997', NULL, 'Ready To Wear Size', 'L', 30, 441, '2022-09-10 01:41:52', '2022-09-10 01:41:52'),
(161, 'XL', 'XL-63109997', NULL, 'Ready To Wear Size', 'XL', 30, 442, '2022-09-10 01:41:55', '2022-09-10 01:41:55'),
(162, '2XL', '2XL-63109997', NULL, 'Ready To Wear Size', '2XL', 30, 443, '2022-09-10 01:41:58', '2022-09-10 01:41:58'),
(163, '3XL', '3XL-63109997', NULL, 'Ready To Wear Size', '3XL', 30, 444, '2022-09-10 01:42:01', '2022-09-10 01:42:01'),
(164, 'XS', 'XS-99386200', NULL, 'Ready To Wear Size', 'XS', 31, 446, '2022-09-10 01:43:17', '2022-09-10 01:43:17'),
(165, 'S', 'S-99386200', NULL, 'Ready To Wear Size', 'S', 31, 447, '2022-09-10 01:43:20', '2022-09-10 01:43:20'),
(166, 'M', 'M-99386200', NULL, 'Ready To Wear Size', 'M', 31, 448, '2022-09-10 01:43:21', '2022-09-10 01:43:21'),
(167, 'L', 'L-99386200', NULL, 'Ready To Wear Size', 'L', 31, 449, '2022-09-10 01:43:24', '2022-09-10 01:43:24'),
(168, 'XL', 'XL-99386200', NULL, 'Ready To Wear Size', 'XL', 31, 450, '2022-09-10 01:43:27', '2022-09-10 01:43:27'),
(169, '2XL', '2XL-99386200', NULL, 'Ready To Wear Size', '2XL', 31, 451, '2022-09-10 01:43:29', '2022-09-10 01:43:29'),
(170, '3XL', '3XL-99386200', NULL, 'Ready To Wear Size', '3XL', 31, 452, '2022-09-10 01:43:32', '2022-09-10 01:43:32'),
(171, 'XS', 'XS-63542917', NULL, 'Ready To Wear Size', 'XS', 32, 454, '2022-09-10 01:47:27', '2022-09-10 01:47:27'),
(172, 'S', 'S-63542917', NULL, 'Ready To Wear Size', 'S', 32, 455, '2022-09-10 01:47:30', '2022-09-10 01:47:30'),
(173, 'M', 'M-63542917', NULL, 'Ready To Wear Size', 'M', 32, 456, '2022-09-10 01:47:32', '2022-09-10 01:47:32'),
(174, 'L', 'L-63542917', NULL, 'Ready To Wear Size', 'L', 32, 457, '2022-09-10 01:47:34', '2022-09-10 01:47:34'),
(175, 'XL', 'XL-63542917', NULL, 'Ready To Wear Size', 'XL', 32, 458, '2022-09-10 01:47:36', '2022-09-10 01:47:36'),
(176, '2XL', '2XL-63542917', NULL, 'Ready To Wear Size', '2XL', 32, 459, '2022-09-10 01:47:38', '2022-09-10 01:47:38'),
(177, '3XL', '3XL-63542917', NULL, 'Ready To Wear Size', '3XL', 32, 460, '2022-09-10 01:47:41', '2022-09-10 01:47:41'),
(178, 'S', 'S-20038395', NULL, 'Ready To Wear Size', 'S', 33, 462, '2022-09-10 01:49:22', '2022-09-10 01:49:22'),
(179, 'M', 'M-20038395', NULL, 'Ready To Wear Size', 'M', 33, 463, '2022-09-10 01:49:25', '2022-09-10 01:49:25'),
(180, 'L', 'L-20038395', NULL, 'Ready To Wear Size', 'L', 33, 464, '2022-09-10 01:49:27', '2022-09-10 01:49:27'),
(181, 'XL', 'XL-20038395', NULL, 'Ready To Wear Size', 'XL', 33, 465, '2022-09-10 01:49:29', '2022-09-10 01:49:29'),
(182, '2XL', '2XL-20038395', NULL, 'Ready To Wear Size', '2XL', 33, 466, '2022-09-10 01:49:31', '2022-09-10 01:49:31'),
(183, 'S', 'S-57070546', NULL, 'Ready To Wear Size', 'S', 34, 468, '2022-09-10 01:53:02', '2022-09-10 01:53:02'),
(184, 'M', 'M-57070546', NULL, 'Ready To Wear Size', 'M', 34, 469, '2022-09-10 01:53:04', '2022-09-10 01:53:04'),
(185, 'L', 'L-57070546', NULL, 'Ready To Wear Size', 'L', 34, 470, '2022-09-10 01:53:07', '2022-09-10 01:53:07'),
(186, 'XL', 'XL-57070546', NULL, 'Ready To Wear Size', 'XL', 34, 471, '2022-09-10 01:53:09', '2022-09-10 01:53:09'),
(187, '2XL', '2XL-57070546', NULL, 'Ready To Wear Size', '2XL', 34, 472, '2022-09-10 01:53:11', '2022-09-10 01:53:11'),
(188, 'S', 'S-63512873', NULL, 'Ready To Wear Size', 'S', 35, 474, '2022-09-10 01:54:00', '2022-09-10 01:54:00'),
(189, 'M', 'M-63512873', NULL, 'Ready To Wear Size', 'M', 35, 475, '2022-09-10 01:54:03', '2022-09-10 01:54:03'),
(190, 'L', 'L-63512873', NULL, 'Ready To Wear Size', 'L', 35, 476, '2022-09-10 01:54:05', '2022-09-10 01:54:05'),
(191, '2XL', '2XL-63512873', NULL, 'Ready To Wear Size', '2XL', 35, 477, '2022-09-10 01:54:07', '2022-09-10 01:54:07'),
(192, 'XL', 'XL-63512873', NULL, 'Ready To Wear Size', 'XL', 35, 478, '2022-09-10 01:54:09', '2022-09-10 01:54:09'),
(193, 'S', 'S-18221533', NULL, 'Ready To Wear Size', 'S', 36, 480, '2022-09-10 01:54:50', '2022-09-10 01:54:50'),
(194, 'M', 'M-18221533', NULL, 'Ready To Wear Size', 'M', 36, 481, '2022-09-10 01:54:52', '2022-09-10 01:54:52'),
(195, 'L', 'L-18221533', NULL, 'Ready To Wear Size', 'L', 36, 482, '2022-09-10 01:54:54', '2022-09-10 01:54:54'),
(196, 'XL', 'XL-18221533', NULL, 'Ready To Wear Size', 'XL', 36, 483, '2022-09-10 01:54:56', '2022-09-10 01:54:56'),
(197, '2XL', '2XL-18221533', NULL, 'Ready To Wear Size', '2XL', 36, 484, '2022-09-10 01:54:59', '2022-09-10 01:54:59'),
(198, 'S', 'S-95609363', NULL, 'Ready To Wear Size', 'S', 37, 486, '2022-09-10 01:58:31', '2022-09-10 01:58:31'),
(199, 'M', 'M-95609363', NULL, 'Ready To Wear Size', 'M', 37, 487, '2022-09-10 01:58:34', '2022-09-10 01:58:34'),
(200, 'L', 'L-95609363', NULL, 'Ready To Wear Size', 'L', 37, 488, '2022-09-10 01:58:36', '2022-09-10 01:58:36'),
(201, 'XL', 'XL-95609363', NULL, 'Ready To Wear Size', 'XL', 37, 489, '2022-09-10 01:58:38', '2022-09-10 01:58:38'),
(202, '2XL', '2XL-95609363', NULL, 'Ready To Wear Size', '2XL', 37, 490, '2022-09-10 01:58:40', '2022-09-10 01:58:40'),
(203, 'S', 'S-43115167', NULL, 'Ready To Wear Size', 'S', 38, 492, '2022-09-10 01:59:25', '2022-09-10 01:59:25'),
(204, 'M', 'M-43115167', NULL, 'Ready To Wear Size', 'M', 38, 493, '2022-09-10 01:59:27', '2022-09-10 01:59:27'),
(205, 'L', 'L-43115167', NULL, 'Ready To Wear Size', 'L', 38, 494, '2022-09-10 01:59:29', '2022-09-10 01:59:29'),
(206, 'XL', 'XL-43115167', NULL, 'Ready To Wear Size', 'XL', 38, 495, '2022-09-10 01:59:31', '2022-09-10 01:59:31'),
(207, '2XL', '2XL-43115167', NULL, 'Ready To Wear Size', '2XL', 38, 496, '2022-09-10 01:59:34', '2022-09-10 01:59:34'),
(208, 'S', 'S-15698024', NULL, 'Ready To Wear Size', 'S', 39, 498, '2022-09-10 02:04:33', '2022-09-10 02:04:33'),
(209, 'M', 'M-15698024', NULL, 'Ready To Wear Size', 'M', 39, 499, '2022-09-10 02:04:35', '2022-09-10 02:04:35'),
(210, 'L', 'L-15698024', NULL, 'Ready To Wear Size', 'L', 39, 500, '2022-09-10 02:04:37', '2022-09-10 02:04:37'),
(211, 'XL', 'XL-15698024', NULL, 'Ready To Wear Size', 'XL', 39, 501, '2022-09-10 02:04:39', '2022-09-10 02:04:39'),
(212, '2XL', '2XL-15698024', NULL, 'Ready To Wear Size', '2XL', 39, 502, '2022-09-10 02:04:41', '2022-09-10 02:04:41'),
(213, 'S', 'S-59674501', NULL, 'Ready To Wear Size', 'S', 40, 504, '2022-09-10 02:05:24', '2022-09-10 02:05:24'),
(214, 'M', 'M-59674501', NULL, 'Ready To Wear Size', 'M', 40, 505, '2022-09-10 02:05:26', '2022-09-10 02:05:26'),
(215, 'L', 'L-59674501', NULL, 'Ready To Wear Size', 'L', 40, 506, '2022-09-10 02:05:29', '2022-09-10 02:05:29'),
(216, 'XL', 'XL-59674501', NULL, 'Ready To Wear Size', 'XL', 40, 507, '2022-09-10 02:05:31', '2022-09-10 02:05:31'),
(217, '2XL', '2XL-59674501', NULL, 'Ready To Wear Size', '2XL', 40, 508, '2022-09-10 02:05:33', '2022-09-10 02:05:33'),
(218, 'S', 'S-79822321', NULL, 'Ready To Wear Size', 'S', 41, 510, '2022-09-10 02:06:18', '2022-09-10 02:06:18'),
(219, 'M', 'M-79822321', NULL, 'Ready To Wear Size', 'M', 41, 511, '2022-09-10 02:06:20', '2022-09-10 02:06:20'),
(220, 'L', 'L-79822321', NULL, 'Ready To Wear Size', 'L', 41, 512, '2022-09-10 02:06:23', '2022-09-10 02:06:23'),
(221, 'XL', 'XL-79822321', NULL, 'Ready To Wear Size', 'XL', 41, 513, '2022-09-10 02:06:25', '2022-09-10 02:06:25'),
(222, '2XL', '2XL-79822321', NULL, 'Ready To Wear Size', '2XL', 41, 514, '2022-09-10 02:06:27', '2022-09-10 02:06:27'),
(223, 'S', 'S-84184902', NULL, 'Ready To Wear Size', 'S', 42, 516, '2022-09-10 02:08:23', '2022-09-10 02:08:23'),
(224, 'M', 'M-84184902', NULL, 'Ready To Wear Size', 'M', 42, 517, '2022-09-10 02:08:25', '2022-09-10 02:08:25'),
(225, 'L', 'L-84184902', NULL, 'Ready To Wear Size', 'L', 42, 518, '2022-09-10 02:08:27', '2022-09-10 02:08:27'),
(226, 'XL', 'XL-84184902', NULL, 'Ready To Wear Size', 'XL', 42, 519, '2022-09-10 02:08:29', '2022-09-10 02:08:29'),
(227, '2XL', '2XL-84184902', NULL, 'Ready To Wear Size', '2XL', 42, 520, '2022-09-10 02:08:32', '2022-09-10 02:08:32'),
(228, 'S', 'S-65048121', NULL, 'Ready To Wear Size', 'S', 43, 522, '2022-09-10 02:09:31', '2022-09-10 02:09:31'),
(229, 'M', 'M-65048121', NULL, 'Ready To Wear Size', 'M', 43, 523, '2022-09-10 02:09:33', '2022-09-10 02:09:33'),
(230, 'L', 'L-65048121', NULL, 'Ready To Wear Size', 'L', 43, 524, '2022-09-10 02:09:35', '2022-09-10 02:09:35'),
(231, 'XL', 'XL-65048121', NULL, 'Ready To Wear Size', 'XL', 43, 525, '2022-09-10 02:09:37', '2022-09-10 02:09:37'),
(232, '2XL', '2XL-65048121', NULL, 'Ready To Wear Size', '2XL', 43, 526, '2022-09-10 02:09:39', '2022-09-10 02:09:39'),
(233, 'S', 'S-93237740', NULL, 'Ready To Wear Size', 'S', 44, 528, '2022-09-10 02:10:23', '2022-09-10 02:10:23'),
(234, 'M', 'M-93237740', NULL, 'Ready To Wear Size', 'M', 44, 529, '2022-09-10 02:10:25', '2022-09-10 02:10:25'),
(235, 'L', 'L-93237740', NULL, 'Ready To Wear Size', 'L', 44, 530, '2022-09-10 02:10:28', '2022-09-10 02:10:28'),
(236, 'XL', 'XL-93237740', NULL, 'Ready To Wear Size', 'XL', 44, 531, '2022-09-10 02:10:30', '2022-09-10 02:10:30'),
(237, '2XL', '2XL-93237740', NULL, 'Ready To Wear Size', '2XL', 44, 532, '2022-09-10 02:10:32', '2022-09-10 02:10:32'),
(238, 'S', 'S-59802024', NULL, 'Ready To Wear Size', 'S', 45, 534, '2022-09-10 02:13:20', '2022-09-10 02:13:20'),
(239, 'M', 'M-59802024', NULL, 'Ready To Wear Size', 'M', 45, 535, '2022-09-10 02:13:22', '2022-09-10 02:13:22'),
(240, 'L', 'L-59802024', NULL, 'Ready To Wear Size', 'L', 45, 536, '2022-09-10 02:13:24', '2022-09-10 02:13:24'),
(241, 'XL', 'XL-59802024', NULL, 'Ready To Wear Size', 'XL', 45, 537, '2022-09-10 02:13:26', '2022-09-10 02:13:26'),
(242, '2XL', '2XL-59802024', NULL, 'Ready To Wear Size', '2XL', 45, 538, '2022-09-10 02:13:28', '2022-09-10 02:13:28'),
(243, 'S', 'S-51043023', NULL, 'Ready To Wear Size', 'S', 46, 540, '2022-09-10 14:01:50', '2022-09-10 14:01:50'),
(244, 'M', 'M-51043023', NULL, 'Ready To Wear Size', 'M', 46, 541, '2022-09-10 14:01:52', '2022-09-10 14:01:52'),
(245, 'L', 'L-51043023', NULL, 'Ready To Wear Size', 'L', 46, 542, '2022-09-10 14:01:54', '2022-09-10 14:01:54'),
(246, '2XL', '2XL-51043023', NULL, 'Ready To Wear Size', '2XL', 46, 543, '2022-09-10 14:01:56', '2022-09-10 14:01:56'),
(247, 'XL', 'XL-51043023', NULL, 'Ready To Wear Size', 'XL', 46, 544, '2022-09-10 14:01:59', '2022-09-10 14:01:59'),
(248, 'S', 'S-89609829', NULL, 'Ready To Wear Size', 'S', 47, 546, '2022-09-10 14:02:46', '2022-09-10 14:02:46'),
(249, 'M', 'M-89609829', NULL, 'Ready To Wear Size', 'M', 47, 547, '2022-09-10 14:02:48', '2022-09-10 14:02:48'),
(250, 'L', 'L-89609829', NULL, 'Ready To Wear Size', 'L', 47, 548, '2022-09-10 14:02:50', '2022-09-10 14:02:50'),
(251, 'XL', 'XL-89609829', NULL, 'Ready To Wear Size', 'XL', 47, 549, '2022-09-10 14:02:52', '2022-09-10 14:02:52'),
(252, '2XL', '2XL-89609829', NULL, 'Ready To Wear Size', '2XL', 47, 550, '2022-09-10 14:02:55', '2022-09-10 14:02:55'),
(253, 'S', 'S-13296889', NULL, 'Ready To Wear Size', 'S', 48, 552, '2022-09-10 14:03:34', '2022-09-10 14:03:34'),
(254, 'M', 'M-13296889', NULL, 'Ready To Wear Size', 'M', 48, 553, '2022-09-10 14:03:36', '2022-09-10 14:03:36'),
(255, 'L', 'L-13296889', NULL, 'Ready To Wear Size', 'L', 48, 554, '2022-09-10 14:03:39', '2022-09-10 14:03:39'),
(256, 'XL', 'XL-13296889', NULL, 'Ready To Wear Size', 'XL', 48, 555, '2022-09-10 14:03:41', '2022-09-10 14:03:41'),
(257, '2XL', '2XL-13296889', NULL, 'Ready To Wear Size', '2XL', 48, 556, '2022-09-10 14:03:43', '2022-09-10 14:03:43'),
(258, 'S', 'S-79218246', NULL, 'Ready To Wear Size', 'S', 49, 558, '2022-09-10 14:06:14', '2022-09-10 14:06:14'),
(259, 'M', 'M-79218246', NULL, 'Ready To Wear Size', 'M', 49, 559, '2022-09-10 14:06:16', '2022-09-10 14:06:16'),
(260, 'L', 'L-79218246', NULL, 'Ready To Wear Size', 'L', 49, 560, '2022-09-10 14:06:17', '2022-09-10 14:06:17'),
(261, 'XL', 'XL-79218246', NULL, 'Ready To Wear Size', 'XL', 49, 561, '2022-09-10 14:06:19', '2022-09-10 14:06:19'),
(262, '2XL', '2XL-79218246', NULL, 'Ready To Wear Size', '2XL', 49, 562, '2022-09-10 14:06:20', '2022-09-10 14:06:20'),
(263, 'S', 'S-90908165', NULL, 'Ready To Wear Size', 'S', 50, 564, '2022-09-10 14:07:01', '2022-09-10 14:07:01'),
(264, 'M', 'M-90908165', NULL, 'Ready To Wear Size', 'M', 50, 565, '2022-09-10 14:07:03', '2022-09-10 14:07:03'),
(265, 'L', 'L-90908165', NULL, 'Ready To Wear Size', 'L', 50, 566, '2022-09-10 14:07:05', '2022-09-10 14:07:05'),
(266, 'XL', 'XL-90908165', NULL, 'Ready To Wear Size', 'XL', 50, 567, '2022-09-10 14:07:08', '2022-09-10 14:07:08'),
(267, '2XL', '2XL-90908165', NULL, 'Ready To Wear Size', '2XL', 50, 568, '2022-09-10 14:07:10', '2022-09-10 14:07:10'),
(268, 'S', 'S-25592246', NULL, 'Ready To Wear Size', 'S', 51, 570, '2022-09-10 14:07:51', '2022-09-10 14:07:51'),
(269, 'M', 'M-25592246', NULL, 'Ready To Wear Size', 'M', 51, 571, '2022-09-10 14:07:53', '2022-09-10 14:07:53'),
(270, 'L', 'L-25592246', NULL, 'Ready To Wear Size', 'L', 51, 572, '2022-09-10 14:07:55', '2022-09-10 14:07:55'),
(271, 'XL', 'XL-25592246', NULL, 'Ready To Wear Size', 'XL', 51, 573, '2022-09-10 14:07:57', '2022-09-10 14:07:57'),
(272, '2XL', '2XL-25592246', NULL, 'Ready To Wear Size', '2XL', 51, 574, '2022-09-10 14:07:59', '2022-09-10 14:07:59'),
(273, 'S', 'S-30389407', NULL, 'Ready To Wear Size', 'S', 52, 576, '2022-09-10 14:08:44', '2022-09-10 14:08:44'),
(274, 'M', 'M-30389407', NULL, 'Ready To Wear Size', 'M', 52, 577, '2022-09-10 14:08:47', '2022-09-10 14:08:47'),
(275, 'L', 'L-30389407', NULL, 'Ready To Wear Size', 'L', 52, 578, '2022-09-10 14:08:49', '2022-09-10 14:08:49'),
(276, 'XL', 'XL-30389407', NULL, 'Ready To Wear Size', 'XL', 52, 579, '2022-09-10 14:08:51', '2022-09-10 14:08:51'),
(277, '2XL', '2XL-30389407', NULL, 'Ready To Wear Size', '2XL', 52, 580, '2022-09-10 14:08:53', '2022-09-10 14:08:53'),
(278, 'S', 'S-79365683', NULL, 'Ready To Wear Size', 'S', 53, 582, '2022-09-10 14:10:24', '2022-09-10 14:10:24'),
(279, 'M', 'M-79365683', NULL, 'Ready To Wear Size', 'M', 53, 583, '2022-09-10 14:10:26', '2022-09-10 14:10:26'),
(280, 'L', 'L-79365683', NULL, 'Ready To Wear Size', 'L', 53, 584, '2022-09-10 14:10:29', '2022-09-10 14:10:29'),
(281, 'XL', 'XL-79365683', NULL, 'Ready To Wear Size', 'XL', 53, 585, '2022-09-10 14:10:31', '2022-09-10 14:10:31'),
(282, '2XL', '2XL-79365683', NULL, 'Ready To Wear Size', '2XL', 53, 586, '2022-09-10 14:10:33', '2022-09-10 14:10:33'),
(283, 'S', 'S-98260254', NULL, 'Ready To Wear Size', 'S', 54, 588, '2022-09-10 14:11:06', '2022-09-10 14:11:06'),
(284, 'M', 'M-98260254', NULL, 'Ready To Wear Size', 'M', 54, 589, '2022-09-10 14:11:08', '2022-09-10 14:11:08'),
(285, 'L', 'L-98260254', NULL, 'Ready To Wear Size', 'L', 54, 590, '2022-09-10 14:11:10', '2022-09-10 14:11:10'),
(286, 'XL', 'XL-98260254', NULL, 'Ready To Wear Size', 'XL', 54, 591, '2022-09-10 14:11:13', '2022-09-10 14:11:13'),
(287, '2XL', '2XL-98260254', NULL, 'Ready To Wear Size', '2XL', 54, 592, '2022-09-10 14:11:15', '2022-09-10 14:11:15'),
(288, 'S', 'S-39152678', NULL, 'Ready To Wear Size', 'S', 55, 594, '2022-09-10 14:12:03', '2022-09-10 14:12:03'),
(289, 'M', 'M-39152678', NULL, 'Ready To Wear Size', 'M', 55, 595, '2022-09-10 14:12:05', '2022-09-10 14:12:05'),
(290, 'L', 'L-39152678', NULL, 'Ready To Wear Size', 'L', 55, 596, '2022-09-10 14:12:07', '2022-09-10 14:12:07'),
(291, 'XL', 'XL-39152678', NULL, 'Ready To Wear Size', 'XL', 55, 597, '2022-09-10 14:12:08', '2022-09-10 14:12:08'),
(292, '2XL', '2XL-39152678', NULL, 'Ready To Wear Size', '2XL', 55, 598, '2022-09-10 14:12:10', '2022-09-10 14:12:10'),
(293, 'S', 'S-95370401', NULL, 'Ready To Wear Size', 'S', 56, 600, '2022-09-10 14:12:55', '2022-09-10 14:12:55'),
(294, 'M', 'M-95370401', NULL, 'Ready To Wear Size', 'M', 56, 601, '2022-09-10 14:12:58', '2022-09-10 14:12:58'),
(295, 'L', 'L-95370401', NULL, 'Ready To Wear Size', 'L', 56, 602, '2022-09-10 14:13:00', '2022-09-10 14:13:00'),
(296, 'XL', 'XL-95370401', NULL, 'Ready To Wear Size', 'XL', 56, 603, '2022-09-10 14:13:02', '2022-09-10 14:13:02'),
(297, '2XL', '2XL-95370401', NULL, 'Ready To Wear Size', '2XL', 56, 604, '2022-09-10 14:13:04', '2022-09-10 14:13:04'),
(298, 'S', 'S-90729934', NULL, 'Ready To Wear Size', 'S', 57, 606, '2022-09-10 14:16:03', '2022-09-10 14:16:03'),
(299, 'M', 'M-90729934', NULL, 'Ready To Wear Size', 'M', 57, 607, '2022-09-10 14:16:06', '2022-09-10 14:16:06'),
(300, 'L', 'L-90729934', NULL, 'Ready To Wear Size', 'L', 57, 608, '2022-09-10 14:16:08', '2022-09-10 14:16:08'),
(301, 'XL', 'XL-90729934', NULL, 'Ready To Wear Size', 'XL', 57, 609, '2022-09-10 14:16:10', '2022-09-10 14:16:10'),
(302, '2XL', '2XL-90729934', NULL, 'Ready To Wear Size', '2XL', 57, 610, '2022-09-10 14:16:12', '2022-09-10 14:16:12'),
(303, 'S', 'S-40936308', NULL, 'Ready To Wear Size', 'S', 58, 612, '2022-09-10 14:17:16', '2022-09-10 14:17:16'),
(304, 'M', 'M-40936308', NULL, 'Ready To Wear Size', 'M', 58, 613, '2022-09-10 14:17:18', '2022-09-10 14:17:18'),
(305, 'L', 'L-40936308', NULL, 'Ready To Wear Size', 'L', 58, 614, '2022-09-10 14:17:20', '2022-09-10 14:17:20'),
(306, 'XL', 'XL-40936308', NULL, 'Ready To Wear Size', 'XL', 58, 615, '2022-09-10 14:17:22', '2022-09-10 14:17:22'),
(307, '2XL', '2XL-40936308', NULL, 'Ready To Wear Size', '2XL', 58, 616, '2022-09-10 14:17:24', '2022-09-10 14:17:24'),
(308, 'S', 'S-71930368', NULL, 'Ready To Wear Size', 'S', 59, 618, '2022-09-10 14:18:05', '2022-09-10 14:18:05'),
(309, 'M', 'M-71930368', NULL, 'Ready To Wear Size', 'M', 59, 619, '2022-09-10 14:18:07', '2022-09-10 14:18:07'),
(310, 'L', 'L-71930368', NULL, 'Ready To Wear Size', 'L', 59, 620, '2022-09-10 14:18:10', '2022-09-10 14:18:10'),
(311, 'XL', 'XL-71930368', NULL, 'Ready To Wear Size', 'XL', 59, 621, '2022-09-10 14:18:12', '2022-09-10 14:18:12'),
(312, '2XL', '2XL-71930368', NULL, 'Ready To Wear Size', '2XL', 59, 622, '2022-09-10 14:18:14', '2022-09-10 14:18:14'),
(313, 'S', 'S-31721996', NULL, 'Ready To Wear Size', 'S', 60, 624, '2022-09-10 14:23:19', '2022-09-10 14:23:19'),
(314, 'M', 'M-31721996', NULL, 'Ready To Wear Size', 'M', 60, 625, '2022-09-10 14:23:21', '2022-09-10 14:23:21'),
(315, 'L', 'L-31721996', NULL, 'Ready To Wear Size', 'L', 60, 626, '2022-09-10 14:23:24', '2022-09-10 14:23:24'),
(316, 'XL', 'XL-31721996', NULL, 'Ready To Wear Size', 'XL', 60, 627, '2022-09-10 14:23:26', '2022-09-10 14:23:26'),
(317, '2XL', '2XL-31721996', NULL, 'Ready To Wear Size', '2XL', 60, 628, '2022-09-10 14:23:28', '2022-09-10 14:23:28'),
(318, 'S', 'S-38700699', NULL, 'Ready To Wear Size', 'S', 61, 630, '2022-09-10 14:24:06', '2022-09-10 14:24:06'),
(319, 'M', 'M-38700699', NULL, 'Ready To Wear Size', 'M', 61, 631, '2022-09-10 14:24:09', '2022-09-10 14:24:09'),
(320, 'L', 'L-38700699', NULL, 'Ready To Wear Size', 'L', 61, 632, '2022-09-10 14:24:11', '2022-09-10 14:24:11'),
(321, 'XL', 'XL-38700699', NULL, 'Ready To Wear Size', 'XL', 61, 633, '2022-09-10 14:24:13', '2022-09-10 14:24:13'),
(322, '2XL', '2XL-38700699', NULL, 'Ready To Wear Size', '2XL', 61, 634, '2022-09-10 14:24:15', '2022-09-10 14:24:15'),
(323, 'S', 'S-91580234', NULL, 'Ready To Wear Size', 'S', 62, 636, '2022-09-10 14:24:53', '2022-09-10 14:24:53'),
(324, 'M', 'M-91580234', NULL, 'Ready To Wear Size', 'M', 62, 637, '2022-09-10 14:24:54', '2022-09-10 14:24:54'),
(325, 'L', 'L-91580234', NULL, 'Ready To Wear Size', 'L', 62, 638, '2022-09-10 14:24:55', '2022-09-10 14:24:55'),
(326, 'XL', 'XL-91580234', NULL, 'Ready To Wear Size', 'XL', 62, 639, '2022-09-10 14:24:56', '2022-09-10 14:24:56'),
(327, '2XL', '2XL-91580234', NULL, 'Ready To Wear Size', '2XL', 62, 640, '2022-09-10 14:24:57', '2022-09-10 14:24:57'),
(328, 'S', 'S-17031629', NULL, 'Ready To Wear Size', 'S', 63, 642, '2022-09-10 14:25:33', '2022-09-10 14:25:33'),
(329, 'M', 'M-17031629', NULL, 'Ready To Wear Size', 'M', 63, 643, '2022-09-10 14:25:35', '2022-09-10 14:25:35'),
(330, 'L', 'L-17031629', NULL, 'Ready To Wear Size', 'L', 63, 644, '2022-09-10 14:25:37', '2022-09-10 14:25:37'),
(331, 'XL', 'XL-17031629', NULL, 'Ready To Wear Size', 'XL', 63, 645, '2022-09-10 14:25:40', '2022-09-10 14:25:40'),
(332, '2XL', '2XL-17031629', NULL, 'Ready To Wear Size', '2XL', 63, 646, '2022-09-10 14:25:42', '2022-09-10 14:25:42'),
(333, 'S', 'S-65189502', NULL, 'Ready To Wear Size', 'S', 64, 648, '2022-09-10 14:28:17', '2022-09-10 14:28:17'),
(334, 'M', 'M-65189502', NULL, 'Ready To Wear Size', 'M', 64, 649, '2022-09-10 14:28:20', '2022-09-10 14:28:20'),
(335, 'L', 'L-65189502', NULL, 'Ready To Wear Size', 'L', 64, 650, '2022-09-10 14:28:22', '2022-09-10 14:28:22'),
(336, 'XL', 'XL-65189502', NULL, 'Ready To Wear Size', 'XL', 64, 651, '2022-09-10 14:28:24', '2022-09-10 14:28:24'),
(337, '2XL', '2XL-65189502', NULL, 'Ready To Wear Size', '2XL', 64, 652, '2022-09-10 14:28:26', '2022-09-10 14:28:26'),
(338, 'S', 'S-10635122', NULL, 'Ready To Wear Size', 'S', 65, 654, '2022-09-10 14:31:14', '2022-09-10 14:31:14'),
(339, 'M', 'M-10635122', NULL, 'Ready To Wear Size', 'M', 65, 655, '2022-09-10 14:31:16', '2022-09-10 14:31:16'),
(340, 'L', 'L-10635122', NULL, 'Ready To Wear Size', 'L', 65, 656, '2022-09-10 14:31:18', '2022-09-10 14:31:18'),
(341, 'XL', 'XL-10635122', NULL, 'Ready To Wear Size', 'XL', 65, 657, '2022-09-10 14:31:21', '2022-09-10 14:31:21'),
(342, '2XL', '2XL-10635122', NULL, 'Ready To Wear Size', '2XL', 65, 658, '2022-09-10 14:31:23', '2022-09-10 14:31:23'),
(343, 'S', 'S-33437021', NULL, 'Ready To Wear Size', 'S', 66, 660, '2022-09-10 14:32:07', '2022-09-10 14:32:07'),
(344, 'M', 'M-33437021', NULL, 'Ready To Wear Size', 'M', 66, 661, '2022-09-10 14:32:10', '2022-09-10 14:32:10'),
(345, 'L', 'L-33437021', NULL, 'Ready To Wear Size', 'L', 66, 662, '2022-09-10 14:32:12', '2022-09-10 14:32:12'),
(346, 'XL', 'XL-33437021', NULL, 'Ready To Wear Size', 'XL', 66, 663, '2022-09-10 14:32:14', '2022-09-10 14:32:14'),
(347, '2XL', '2XL-33437021', NULL, 'Ready To Wear Size', '2XL', 66, 664, '2022-09-10 14:32:16', '2022-09-10 14:32:16'),
(348, 'S', 'S-26701031', NULL, 'Ready To Wear Size', 'S', 67, 666, '2022-09-10 14:32:54', '2022-09-10 14:32:54'),
(349, 'M', 'M-26701031', NULL, 'Ready To Wear Size', 'M', 67, 667, '2022-09-10 14:32:57', '2022-09-10 14:32:57'),
(350, 'L', 'L-26701031', NULL, 'Ready To Wear Size', 'L', 67, 668, '2022-09-10 14:32:59', '2022-09-10 14:32:59'),
(351, 'XL', 'XL-26701031', NULL, 'Ready To Wear Size', 'XL', 67, 669, '2022-09-10 14:33:01', '2022-09-10 14:33:01'),
(352, '2XL', '2XL-26701031', NULL, 'Ready To Wear Size', '2XL', 67, 670, '2022-09-10 14:33:03', '2022-09-10 14:33:03'),
(353, 'S', 'S-13857698', NULL, 'Ready To Wear Size', 'S', 68, 672, '2022-09-10 14:33:42', '2022-09-10 14:33:42'),
(354, 'M', 'M-13857698', NULL, 'Ready To Wear Size', 'M', 68, 673, '2022-09-10 14:33:44', '2022-09-10 14:33:44'),
(355, 'L', 'L-13857698', NULL, 'Ready To Wear Size', 'L', 68, 674, '2022-09-10 14:33:46', '2022-09-10 14:33:46'),
(356, 'XL', 'XL-13857698', NULL, 'Ready To Wear Size', 'XL', 68, 675, '2022-09-10 14:33:49', '2022-09-10 14:33:49'),
(357, '2XL', '2XL-13857698', NULL, 'Ready To Wear Size', '2XL', 68, 676, '2022-09-10 14:33:51', '2022-09-10 14:33:51'),
(358, 'S', 'S-71541765', NULL, 'Ready To Wear Size', 'S', 69, 678, '2022-09-10 14:35:54', '2022-09-10 14:35:54'),
(359, 'M', 'M-71541765', NULL, 'Ready To Wear Size', 'M', 69, 679, '2022-09-10 14:35:57', '2022-09-10 14:35:57'),
(360, 'L', 'L-71541765', NULL, 'Ready To Wear Size', 'L', 69, 680, '2022-09-10 14:35:59', '2022-09-10 14:35:59'),
(361, 'XL', 'XL-71541765', NULL, 'Ready To Wear Size', 'XL', 69, 681, '2022-09-10 14:36:01', '2022-09-10 14:36:01'),
(362, '2XL', '2XL-71541765', NULL, 'Ready To Wear Size', '2XL', 69, 682, '2022-09-10 14:36:03', '2022-09-10 14:36:03'),
(363, 'S', 'S-49226900', NULL, 'Ready To Wear Size', 'S', 70, 684, '2022-09-10 14:38:03', '2022-09-10 14:38:03'),
(364, 'M', 'M-49226900', NULL, 'Ready To Wear Size', 'M', 70, 685, '2022-09-10 14:38:05', '2022-09-10 14:38:05'),
(365, 'L', 'L-49226900', NULL, 'Ready To Wear Size', 'L', 70, 686, '2022-09-10 14:38:08', '2022-09-10 14:38:08'),
(366, 'XL', 'XL-49226900', NULL, 'Ready To Wear Size', 'XL', 70, 687, '2022-09-10 14:38:10', '2022-09-10 14:38:10'),
(367, 'S', 'S-20735376', NULL, 'Ready To Wear Size', 'S', 71, 689, '2022-09-10 14:39:10', '2022-09-10 14:39:10'),
(368, 'M', 'M-20735376', NULL, 'Ready To Wear Size', 'M', 71, 690, '2022-09-10 14:39:12', '2022-09-10 14:39:12'),
(369, 'L', 'L-20735376', NULL, 'Ready To Wear Size', 'L', 71, 691, '2022-09-10 14:39:14', '2022-09-10 14:39:14'),
(370, 'XL', 'XL-20735376', NULL, 'Ready To Wear Size', 'XL', 71, 692, '2022-09-10 14:39:16', '2022-09-10 14:39:16'),
(371, 'S', 'S-97330325', NULL, 'Ready To Wear Size', 'S', 72, 694, '2022-09-10 14:39:47', '2022-09-10 14:39:47'),
(372, 'M', 'M-97330325', NULL, 'Ready To Wear Size', 'M', 72, 695, '2022-09-10 14:39:50', '2022-09-10 14:39:50'),
(373, 'L', 'L-97330325', NULL, 'Ready To Wear Size', 'L', 72, 696, '2022-09-10 14:39:52', '2022-09-10 14:39:52'),
(374, 'XL', 'XL-97330325', NULL, 'Ready To Wear Size', 'XL', 72, 697, '2022-09-10 14:39:54', '2022-09-10 14:39:54'),
(375, 'S', 'S-18824535', NULL, 'Ready To Wear Size', 'S', 73, 699, '2022-09-10 14:41:33', '2022-09-10 14:41:33'),
(376, 'M', 'M-18824535', NULL, 'Ready To Wear Size', 'M', 73, 700, '2022-09-10 14:41:36', '2022-09-10 14:41:36'),
(377, 'L', 'L-18824535', NULL, 'Ready To Wear Size', 'L', 73, 701, '2022-09-10 14:41:38', '2022-09-10 14:41:38'),
(378, 'XL', 'XL-18824535', NULL, 'Ready To Wear Size', 'XL', 73, 702, '2022-09-10 14:41:40', '2022-09-10 14:41:40'),
(379, 'S', 'S-17585324', NULL, 'Ready To Wear Size', 'S', 74, 704, '2022-09-10 14:42:13', '2022-09-10 14:42:13'),
(380, 'M', 'M-17585324', NULL, 'Ready To Wear Size', 'M', 74, 705, '2022-09-10 14:42:15', '2022-09-10 14:42:15'),
(381, 'L', 'L-17585324', NULL, 'Ready To Wear Size', 'L', 74, 706, '2022-09-10 14:42:17', '2022-09-10 14:42:17'),
(382, 'XL', 'XL-17585324', NULL, 'Ready To Wear Size', 'XL', 74, 707, '2022-09-10 14:42:19', '2022-09-10 14:42:19'),
(383, 'S', 'S-37128982', NULL, 'Ready To Wear Size', 'S', 75, 709, '2022-09-10 14:42:53', '2022-09-10 14:42:53'),
(384, 'M', 'M-37128982', NULL, 'Ready To Wear Size', 'M', 75, 710, '2022-09-10 14:42:55', '2022-09-10 14:42:55'),
(385, 'L', 'L-37128982', NULL, 'Ready To Wear Size', 'L', 75, 711, '2022-09-10 14:42:57', '2022-09-10 14:42:57'),
(386, 'XL', 'XL-37128982', NULL, 'Ready To Wear Size', 'XL', 75, 712, '2022-09-10 14:42:58', '2022-09-10 14:42:58'),
(387, 'S', 'S-16357118', NULL, 'Ready To Wear Size', 'S', 76, 714, '2022-09-10 14:44:16', '2022-09-10 14:44:16'),
(388, 'M', 'M-16357118', NULL, 'Ready To Wear Size', 'M', 76, 715, '2022-09-10 14:44:18', '2022-09-10 14:44:18'),
(389, 'L', 'L-16357118', NULL, 'Ready To Wear Size', 'L', 76, 716, '2022-09-10 14:44:20', '2022-09-10 14:44:20'),
(390, 'XL', 'XL-16357118', NULL, 'Ready To Wear Size', 'XL', 76, 717, '2022-09-10 14:44:23', '2022-09-10 14:44:23'),
(391, 'S', 'S-52401969', NULL, 'Ready To Wear Size', 'S', 77, 719, '2022-09-10 14:45:34', '2022-09-10 14:45:34'),
(392, 'M', 'M-52401969', NULL, 'Ready To Wear Size', 'M', 77, 720, '2022-09-10 14:45:36', '2022-09-10 14:45:36'),
(393, 'L', 'L-52401969', NULL, 'Ready To Wear Size', 'L', 77, 721, '2022-09-10 14:45:38', '2022-09-10 14:45:38'),
(394, 'XL', 'XL-52401969', NULL, 'Ready To Wear Size', 'XL', 77, 722, '2022-09-10 14:45:41', '2022-09-10 14:45:41'),
(395, 'S', 'S-47831365', NULL, 'Ready To Wear Size', 'S', 78, 724, '2022-09-10 14:46:13', '2022-09-10 14:46:13'),
(396, 'M', 'M-47831365', NULL, 'Ready To Wear Size', 'M', 78, 725, '2022-09-10 14:46:15', '2022-09-10 14:46:15'),
(397, 'L', 'L-47831365', NULL, 'Ready To Wear Size', 'L', 78, 726, '2022-09-10 14:46:17', '2022-09-10 14:46:17'),
(398, 'XL', 'XL-47831365', NULL, 'Ready To Wear Size', 'XL', 78, 727, '2022-09-10 14:46:19', '2022-09-10 14:46:19'),
(399, 'S', 'S-28709593', NULL, 'Ready To Wear Size', 'S', 79, 729, '2022-09-10 14:46:59', '2022-09-10 14:46:59'),
(400, 'M', 'M-28709593', NULL, 'Ready To Wear Size', 'M', 79, 730, '2022-09-10 14:47:01', '2022-09-10 14:47:01'),
(401, 'L', 'L-28709593', NULL, 'Ready To Wear Size', 'L', 79, 731, '2022-09-10 14:47:04', '2022-09-10 14:47:04'),
(402, 'XL', 'XL-28709593', NULL, 'Ready To Wear Size', 'XL', 79, 732, '2022-09-10 14:47:06', '2022-09-10 14:47:06'),
(403, 'S', 'S-59041804', NULL, 'Ready To Wear Size', 'S', 80, 734, '2022-09-10 14:47:43', '2022-09-10 14:47:43'),
(404, 'M', 'M-59041804', NULL, 'Ready To Wear Size', 'M', 80, 735, '2022-09-10 14:47:45', '2022-09-10 14:47:45'),
(405, 'L', 'L-59041804', NULL, 'Ready To Wear Size', 'L', 80, 736, '2022-09-10 14:47:47', '2022-09-10 14:47:47'),
(406, 'XL', 'XL-59041804', NULL, 'Ready To Wear Size', 'XL', 80, 737, '2022-09-10 14:47:49', '2022-09-10 14:47:49'),
(407, 'S', 'S-75528323', NULL, 'Ready To Wear Size', 'S', 81, 739, '2022-09-10 14:49:36', '2022-09-10 14:49:36'),
(408, 'M', 'M-75528323', NULL, 'Ready To Wear Size', 'M', 81, 740, '2022-09-10 14:49:38', '2022-09-10 14:49:38'),
(409, 'L', 'L-75528323', NULL, 'Ready To Wear Size', 'L', 81, 741, '2022-09-10 14:49:40', '2022-09-10 14:49:40'),
(410, 'XL', 'XL-75528323', NULL, 'Ready To Wear Size', 'XL', 81, 742, '2022-09-10 14:49:42', '2022-09-10 14:49:42'),
(411, '2XL', '2XL-75528323', NULL, 'Ready To Wear Size', '2XL', 81, 743, '2022-09-10 14:49:45', '2022-09-10 14:49:45'),
(412, 'S', 'S-96211498', NULL, 'Ready To Wear Size', 'S', 82, 745, '2022-09-10 14:50:17', '2022-09-10 14:50:17'),
(413, 'M', 'M-96211498', NULL, 'Ready To Wear Size', 'M', 82, 746, '2022-09-10 14:50:19', '2022-09-10 14:50:19'),
(414, 'L', 'L-96211498', NULL, 'Ready To Wear Size', 'L', 82, 747, '2022-09-10 14:50:21', '2022-09-10 14:50:21'),
(415, 'XL', 'XL-96211498', NULL, 'Ready To Wear Size', 'XL', 82, 748, '2022-09-10 14:50:23', '2022-09-10 14:50:23'),
(416, '2XL', '2XL-96211498', NULL, 'Ready To Wear Size', '2XL', 82, 749, '2022-09-10 14:50:25', '2022-09-10 14:50:25'),
(417, 'S', 'S-25697113', NULL, 'Ready To Wear Size', 'S', 83, 751, '2022-09-10 14:51:10', '2022-09-10 14:51:10'),
(418, 'M', 'M-25697113', NULL, 'Ready To Wear Size', 'M', 83, 752, '2022-09-10 14:51:12', '2022-09-10 14:51:12'),
(419, 'L', 'L-25697113', NULL, 'Ready To Wear Size', 'L', 83, 753, '2022-09-10 14:51:14', '2022-09-10 14:51:14'),
(420, 'XL', 'XL-25697113', NULL, 'Ready To Wear Size', 'XL', 83, 754, '2022-09-10 14:51:16', '2022-09-10 14:51:16'),
(421, '2XL', '2XL-25697113', NULL, 'Ready To Wear Size', '2XL', 83, 755, '2022-09-10 14:51:18', '2022-09-10 14:51:18'),
(422, 'S', 'S-29640731', NULL, 'Ready To Wear Size', 'S', 84, 757, '2022-09-10 14:51:50', '2022-09-10 14:51:50'),
(423, 'M', 'M-29640731', NULL, 'Ready To Wear Size', 'M', 84, 758, '2022-09-10 14:51:52', '2022-09-10 14:51:52'),
(424, 'L', 'L-29640731', NULL, 'Ready To Wear Size', 'L', 84, 759, '2022-09-10 14:51:53', '2022-09-10 14:51:53'),
(425, 'XL', 'XL-29640731', NULL, 'Ready To Wear Size', 'XL', 84, 760, '2022-09-10 14:51:54', '2022-09-10 14:51:54'),
(426, '2XL', '2XL-29640731', NULL, 'Ready To Wear Size', '2XL', 84, 761, '2022-09-10 14:51:55', '2022-09-10 14:51:55'),
(427, 'S', 'S-66958710', NULL, 'Ready To Wear Size', 'S', 85, 763, '2022-09-10 14:54:45', '2022-09-10 14:54:45'),
(428, 'M', 'M-66958710', NULL, 'Ready To Wear Size', 'M', 85, 764, '2022-09-10 14:54:48', '2022-09-10 14:54:48'),
(429, 'L', 'L-66958710', NULL, 'Ready To Wear Size', 'L', 85, 765, '2022-09-10 14:54:50', '2022-09-10 14:54:50'),
(430, 'XL', 'XL-66958710', NULL, 'Ready To Wear Size', 'XL', 85, 766, '2022-09-10 14:54:52', '2022-09-10 14:54:52'),
(431, '2XL', '2XL-66958710', NULL, 'Ready To Wear Size', '2XL', 85, 767, '2022-09-10 14:54:54', '2022-09-10 14:54:54'),
(432, 'S', 'S-60324019', NULL, 'Ready To Wear Size', 'S', 86, 769, '2022-09-10 14:56:03', '2022-09-10 14:56:03'),
(433, 'M', 'M-60324019', NULL, 'Ready To Wear Size', 'M', 86, 770, '2022-09-10 14:56:05', '2022-09-10 14:56:05'),
(434, 'L', 'L-60324019', NULL, 'Ready To Wear Size', 'L', 86, 771, '2022-09-10 14:56:08', '2022-09-10 14:56:08'),
(435, 'XL', 'XL-60324019', NULL, 'Ready To Wear Size', 'XL', 86, 772, '2022-09-10 14:56:10', '2022-09-10 14:56:10'),
(436, '2XL', '2XL-60324019', NULL, 'Ready To Wear Size', '2XL', 86, 773, '2022-09-10 14:56:12', '2022-09-10 14:56:12'),
(437, 'S', 'S-97534212', NULL, 'Ready To Wear Size', 'S', 87, 775, '2022-09-10 14:56:53', '2022-09-10 14:56:53'),
(438, 'M', 'M-97534212', NULL, 'Ready To Wear Size', 'M', 87, 776, '2022-09-10 14:56:55', '2022-09-10 14:56:55'),
(439, 'L', 'L-97534212', NULL, 'Ready To Wear Size', 'L', 87, 777, '2022-09-10 14:56:58', '2022-09-10 14:56:58'),
(440, 'XL', 'XL-97534212', NULL, 'Ready To Wear Size', 'XL', 87, 778, '2022-09-10 14:57:00', '2022-09-10 14:57:00'),
(441, '2XL', '2XL-97534212', NULL, 'Ready To Wear Size', '2XL', 87, 779, '2022-09-10 14:57:02', '2022-09-10 14:57:02'),
(442, 'S', 'S-57983492', NULL, 'Ready To Wear Size', 'S', 88, 781, '2022-09-10 14:57:35', '2022-09-10 14:57:35'),
(443, 'M', 'M-57983492', NULL, 'Ready To Wear Size', 'M', 88, 782, '2022-09-10 14:57:37', '2022-09-10 14:57:37'),
(444, 'L', 'L-57983492', NULL, 'Ready To Wear Size', 'L', 88, 783, '2022-09-10 14:57:39', '2022-09-10 14:57:39'),
(445, 'XL', 'XL-57983492', NULL, 'Ready To Wear Size', 'XL', 88, 784, '2022-09-10 14:57:42', '2022-09-10 14:57:42'),
(446, '2XL', '2XL-57983492', NULL, 'Ready To Wear Size', '2XL', 88, 785, '2022-09-10 14:57:44', '2022-09-10 14:57:44'),
(447, 'S', 'S-25090782', NULL, 'Ready To Wear Size', 'S', 89, 787, '2022-09-10 14:58:18', '2022-09-10 14:58:18'),
(448, 'M', 'M-25090782', NULL, 'Ready To Wear Size', 'M', 89, 788, '2022-09-10 14:58:20', '2022-09-10 14:58:20'),
(449, 'L', 'L-25090782', NULL, 'Ready To Wear Size', 'L', 89, 789, '2022-09-10 14:58:22', '2022-09-10 14:58:22'),
(450, 'XL', 'XL-25090782', NULL, 'Ready To Wear Size', 'XL', 89, 790, '2022-09-10 14:58:24', '2022-09-10 14:58:24'),
(451, '2XL', '2XL-25090782', NULL, 'Ready To Wear Size', '2XL', 89, 791, '2022-09-10 14:58:26', '2022-09-10 14:58:26'),
(452, 'S', 'S-83283519', NULL, 'Ready To Wear Size', 'S', 90, 793, '2022-09-10 15:01:10', '2022-09-10 15:01:10'),
(453, 'M', 'M-83283519', NULL, 'Ready To Wear Size', 'M', 90, 794, '2022-09-10 15:01:12', '2022-09-10 15:01:12'),
(454, 'L', 'L-83283519', NULL, 'Ready To Wear Size', 'L', 90, 795, '2022-09-10 15:01:14', '2022-09-10 15:01:14'),
(455, 'XL', 'XL-83283519', NULL, 'Ready To Wear Size', 'XL', 90, 796, '2022-09-10 15:01:17', '2022-09-10 15:01:17'),
(456, '2XL', '2XL-83283519', NULL, 'Ready To Wear Size', '2XL', 90, 797, '2022-09-10 15:01:19', '2022-09-10 15:01:19'),
(457, 'S', 'S-68904717', NULL, 'Ready To Wear Size', 'S', 91, 799, '2022-09-10 15:02:31', '2022-09-10 15:02:31'),
(458, 'M', 'M-68904717', NULL, 'Ready To Wear Size', 'M', 91, 800, '2022-09-10 15:02:33', '2022-09-10 15:02:33'),
(459, 'L', 'L-68904717', NULL, 'Ready To Wear Size', 'L', 91, 801, '2022-09-10 15:02:35', '2022-09-10 15:02:35'),
(460, 'XL', 'XL-68904717', NULL, 'Ready To Wear Size', 'XL', 91, 802, '2022-09-10 15:02:37', '2022-09-10 15:02:37'),
(461, '2XL', '2XL-68904717', NULL, 'Ready To Wear Size', '2XL', 91, 803, '2022-09-10 15:02:39', '2022-09-10 15:02:39'),
(462, 'S', 'S-16791024', NULL, 'Ready To Wear Size', 'S', 92, 805, '2022-09-10 15:03:16', '2022-09-10 15:03:16'),
(463, 'M', 'M-16791024', NULL, 'Ready To Wear Size', 'M', 92, 806, '2022-09-10 15:03:18', '2022-09-10 15:03:18'),
(464, 'L', 'L-16791024', NULL, 'Ready To Wear Size', 'L', 92, 807, '2022-09-10 15:03:20', '2022-09-10 15:03:20'),
(465, 'XL', 'XL-16791024', NULL, 'Ready To Wear Size', 'XL', 92, 808, '2022-09-10 15:03:22', '2022-09-10 15:03:22'),
(466, '2XL', '2XL-16791024', NULL, 'Ready To Wear Size', '2XL', 92, 809, '2022-09-10 15:03:24', '2022-09-10 15:03:24'),
(467, 'S', 'S-29021098', NULL, 'Ready To Wear Size', 'S', 93, 811, '2022-09-10 15:03:57', '2022-09-10 15:03:57'),
(468, 'M', 'M-29021098', NULL, 'Ready To Wear Size', 'M', 93, 812, '2022-09-10 15:03:59', '2022-09-10 15:03:59'),
(469, 'L', 'L-29021098', NULL, 'Ready To Wear Size', 'L', 93, 813, '2022-09-10 15:04:02', '2022-09-10 15:04:02'),
(470, 'XL', 'XL-29021098', NULL, 'Ready To Wear Size', 'XL', 93, 814, '2022-09-10 15:04:04', '2022-09-10 15:04:04'),
(471, '2XL', '2XL-29021098', NULL, 'Ready To Wear Size', '2XL', 93, 815, '2022-09-10 15:04:06', '2022-09-10 15:04:06'),
(472, 'S', 'S-11004348', NULL, 'Ready To Wear Size', 'S', 94, 817, '2022-09-10 15:04:40', '2022-09-10 15:04:40'),
(473, 'M', 'M-11004348', NULL, 'Ready To Wear Size', 'M', 94, 818, '2022-09-10 15:04:42', '2022-09-10 15:04:42'),
(474, 'L', 'L-11004348', NULL, 'Ready To Wear Size', 'L', 94, 819, '2022-09-10 15:04:45', '2022-09-10 15:04:45'),
(475, 'XL', 'XL-11004348', NULL, 'Ready To Wear Size', 'XL', 94, 820, '2022-09-10 15:04:47', '2022-09-10 15:04:47'),
(476, '2XL', '2XL-11004348', NULL, 'Ready To Wear Size', '2XL', 94, 821, '2022-09-10 15:04:49', '2022-09-10 15:04:49'),
(477, 'S', 'S-40375997', NULL, 'Ready To Wear Size', 'S', 95, 823, '2022-09-10 15:08:14', '2022-09-10 15:08:14'),
(478, 'M', 'M-40375997', NULL, 'Ready To Wear Size', 'M', 95, 824, '2022-09-10 15:08:16', '2022-09-10 15:08:16'),
(479, 'L', 'L-40375997', NULL, 'Ready To Wear Size', 'L', 95, 825, '2022-09-10 15:08:18', '2022-09-10 15:08:18'),
(480, 'XL', 'XL-40375997', NULL, 'Ready To Wear Size', 'XL', 95, 826, '2022-09-10 15:08:20', '2022-09-10 15:08:20'),
(481, '2XL', '2XL-40375997', NULL, 'Ready To Wear Size', '2XL', 95, 827, '2022-09-10 15:08:22', '2022-09-10 15:08:22'),
(482, 'S', 'S-94302612', NULL, 'Ready To Wear Size', 'S', 96, 829, '2022-09-10 15:08:56', '2022-09-10 15:08:56'),
(483, 'M', 'M-94302612', NULL, 'Ready To Wear Size', 'M', 96, 830, '2022-09-10 15:08:58', '2022-09-10 15:08:58');
INSERT INTO `product_variants` (`id`, `name`, `item_code`, `additonal_price`, `attribute`, `attribute_value`, `PID`, `v_id`, `created_at`, `updated_at`) VALUES
(484, 'L', 'L-94302612', NULL, 'Ready To Wear Size', 'L', 96, 831, '2022-09-10 15:09:01', '2022-09-10 15:09:01'),
(485, 'XL', 'XL-94302612', NULL, 'Ready To Wear Size', 'XL', 96, 832, '2022-09-10 15:09:03', '2022-09-10 15:09:03'),
(486, '2XL', '2XL-94302612', NULL, 'Ready To Wear Size', '2XL', 96, 833, '2022-09-10 15:09:05', '2022-09-10 15:09:05'),
(487, 'S', 'S-12041940', NULL, 'Ready To Wear Size', 'S', 97, 835, '2022-09-10 15:09:53', '2022-09-10 15:09:53'),
(488, 'M', 'M-12041940', NULL, 'Ready To Wear Size', 'M', 97, 836, '2022-09-10 15:09:55', '2022-09-10 15:09:55'),
(489, 'L', 'L-12041940', NULL, 'Ready To Wear Size', 'L', 97, 837, '2022-09-10 15:09:57', '2022-09-10 15:09:57'),
(490, 'XL', 'XL-12041940', NULL, 'Ready To Wear Size', 'XL', 97, 838, '2022-09-10 15:09:59', '2022-09-10 15:09:59'),
(491, '2XL', '2XL-12041940', NULL, 'Ready To Wear Size', '2XL', 97, 839, '2022-09-10 15:10:01', '2022-09-10 15:10:01'),
(492, 'S', 'S-71216750', NULL, 'Ready To Wear Size', 'S', 98, 841, '2022-09-10 15:10:44', '2022-09-10 15:10:44'),
(493, 'M', 'M-71216750', NULL, 'Ready To Wear Size', 'M', 98, 842, '2022-09-10 15:10:46', '2022-09-10 15:10:46'),
(494, 'L', 'L-71216750', NULL, 'Ready To Wear Size', 'L', 98, 843, '2022-09-10 15:10:48', '2022-09-10 15:10:48'),
(495, 'XL', 'XL-71216750', NULL, 'Ready To Wear Size', 'XL', 98, 844, '2022-09-10 15:10:50', '2022-09-10 15:10:50'),
(496, '2XL', '2XL-71216750', NULL, 'Ready To Wear Size', '2XL', 98, 845, '2022-09-10 15:10:52', '2022-09-10 15:10:52'),
(497, 'S', 'S-37518091', NULL, 'Ready To Wear Size', 'S', 99, 847, '2022-09-10 15:14:18', '2022-09-10 15:14:18'),
(498, 'M', 'M-37518091', NULL, 'Ready To Wear Size', 'M', 99, 848, '2022-09-10 15:14:20', '2022-09-10 15:14:20'),
(499, 'L', 'L-37518091', NULL, 'Ready To Wear Size', 'L', 99, 849, '2022-09-10 15:14:22', '2022-09-10 15:14:22'),
(500, 'XL', 'XL-37518091', NULL, 'Ready To Wear Size', 'XL', 99, 850, '2022-09-10 15:14:24', '2022-09-10 15:14:24'),
(501, '2XL', '2XL-37518091', NULL, 'Ready To Wear Size', '2XL', 99, 851, '2022-09-10 15:14:26', '2022-09-10 15:14:26'),
(502, 'S', 'S-86796531', NULL, 'Ready To Wear Size', 'S', 100, 853, '2022-09-10 15:15:09', '2022-09-10 15:15:09'),
(503, 'M', 'M-86796531', NULL, 'Ready To Wear Size', 'M', 100, 854, '2022-09-10 15:15:11', '2022-09-10 15:15:11'),
(504, 'L', 'L-86796531', NULL, 'Ready To Wear Size', 'L', 100, 855, '2022-09-10 15:15:13', '2022-09-10 15:15:13'),
(505, 'XL', 'XL-86796531', NULL, 'Ready To Wear Size', 'XL', 100, 856, '2022-09-10 15:15:16', '2022-09-10 15:15:16'),
(506, '2XL', '2XL-86796531', NULL, 'Ready To Wear Size', '2XL', 100, 857, '2022-09-10 15:15:18', '2022-09-10 15:15:18'),
(507, 'S', 'S-92768174', NULL, 'Ready To Wear Size', 'S', 101, 859, '2022-09-10 15:15:51', '2022-09-10 15:15:51'),
(508, 'M', 'M-92768174', NULL, 'Ready To Wear Size', 'M', 101, 860, '2022-09-10 15:15:53', '2022-09-10 15:15:53'),
(509, 'L', 'L-92768174', NULL, 'Ready To Wear Size', 'L', 101, 861, '2022-09-10 15:15:56', '2022-09-10 15:15:56'),
(510, 'XL', 'XL-92768174', NULL, 'Ready To Wear Size', 'XL', 101, 862, '2022-09-10 15:15:58', '2022-09-10 15:15:58'),
(511, '2XL', '2XL-92768174', NULL, 'Ready To Wear Size', '2XL', 101, 863, '2022-09-10 15:16:00', '2022-09-10 15:16:00'),
(512, 'S', 'S-20327391', NULL, 'Ready To Wear Size', 'S', 102, 865, '2022-09-10 15:16:35', '2022-09-10 15:16:35'),
(513, 'M', 'M-20327391', NULL, 'Ready To Wear Size', 'M', 102, 866, '2022-09-10 15:16:37', '2022-09-10 15:16:37'),
(514, 'L', 'L-20327391', NULL, 'Ready To Wear Size', 'L', 102, 867, '2022-09-10 15:16:39', '2022-09-10 15:16:39'),
(515, 'XL', 'XL-20327391', NULL, 'Ready To Wear Size', 'XL', 102, 868, '2022-09-10 15:16:41', '2022-09-10 15:16:41'),
(516, '2XL', '2XL-20327391', NULL, 'Ready To Wear Size', '2XL', 102, 869, '2022-09-10 15:16:44', '2022-09-10 15:16:44'),
(517, 'S', 'S-84122871', NULL, 'Ready To Wear Size', 'S', 103, 871, '2022-09-10 15:19:31', '2022-09-10 15:19:31'),
(518, 'M', 'M-84122871', NULL, 'Ready To Wear Size', 'M', 103, 872, '2022-09-10 15:19:33', '2022-09-10 15:19:33'),
(519, 'L', 'L-84122871', NULL, 'Ready To Wear Size', 'L', 103, 873, '2022-09-10 15:19:35', '2022-09-10 15:19:35'),
(520, 'XL', 'XL-84122871', NULL, 'Ready To Wear Size', 'XL', 103, 874, '2022-09-10 15:19:37', '2022-09-10 15:19:37'),
(521, '2XL', '2XL-84122871', NULL, 'Ready To Wear Size', '2XL', 103, 875, '2022-09-10 15:19:39', '2022-09-10 15:19:39'),
(522, 'S', 'S-30615792', NULL, 'Ready To Wear Size', 'S', 104, 877, '2022-09-10 15:20:32', '2022-09-10 15:20:32'),
(523, 'M', 'M-30615792', NULL, 'Ready To Wear Size', 'M', 104, 878, '2022-09-10 15:20:35', '2022-09-10 15:20:35'),
(524, 'L', 'L-30615792', NULL, 'Ready To Wear Size', 'L', 104, 879, '2022-09-10 15:20:37', '2022-09-10 15:20:37'),
(525, 'XL', 'XL-30615792', NULL, 'Ready To Wear Size', 'XL', 104, 880, '2022-09-10 15:20:39', '2022-09-10 15:20:39'),
(526, '2XL', '2XL-30615792', NULL, 'Ready To Wear Size', '2XL', 104, 881, '2022-09-10 15:20:41', '2022-09-10 15:20:41'),
(527, 'S', 'S-85608516', NULL, 'Ready To Wear Size', 'S', 105, 883, '2022-09-10 15:21:16', '2022-09-10 15:21:16'),
(528, 'M', 'M-85608516', NULL, 'Ready To Wear Size', 'M', 105, 884, '2022-09-10 15:21:18', '2022-09-10 15:21:18'),
(529, 'L', 'L-85608516', NULL, 'Ready To Wear Size', 'L', 105, 885, '2022-09-10 15:21:21', '2022-09-10 15:21:21'),
(530, 'XL', 'XL-85608516', NULL, 'Ready To Wear Size', 'XL', 105, 886, '2022-09-10 15:21:23', '2022-09-10 15:21:23'),
(531, '2XL', '2XL-85608516', NULL, 'Ready To Wear Size', '2XL', 105, 887, '2022-09-10 15:21:25', '2022-09-10 15:21:25'),
(532, 'S', 'S-61010122', NULL, 'Ready To Wear Size', 'S', 106, 889, '2022-09-10 15:25:44', '2022-09-10 15:25:44'),
(533, 'M', 'M-61010122', NULL, 'Ready To Wear Size', 'M', 106, 890, '2022-09-10 15:25:46', '2022-09-10 15:25:46'),
(534, 'L', 'L-61010122', NULL, 'Ready To Wear Size', 'L', 106, 891, '2022-09-10 15:25:49', '2022-09-10 15:25:49'),
(535, 'XL', 'XL-61010122', NULL, 'Ready To Wear Size', 'XL', 106, 892, '2022-09-10 15:25:51', '2022-09-10 15:25:51'),
(536, '2XL', '2XL-61010122', NULL, 'Ready To Wear Size', '2XL', 106, 893, '2022-09-10 15:25:53', '2022-09-10 15:25:53'),
(537, 'S', 'S-21103125', NULL, 'Ready To Wear Size', 'S', 107, 895, '2022-09-10 15:26:40', '2022-09-10 15:26:40'),
(538, 'M', 'M-21103125', NULL, 'Ready To Wear Size', 'M', 107, 896, '2022-09-10 15:26:42', '2022-09-10 15:26:42'),
(539, 'L', 'L-21103125', NULL, 'Ready To Wear Size', 'L', 107, 897, '2022-09-10 15:26:45', '2022-09-10 15:26:45'),
(540, 'XL', 'XL-21103125', NULL, 'Ready To Wear Size', 'XL', 107, 898, '2022-09-10 15:26:47', '2022-09-10 15:26:47'),
(541, '2XL', '2XL-21103125', NULL, 'Ready To Wear Size', '2XL', 107, 899, '2022-09-10 15:26:49', '2022-09-10 15:26:49'),
(542, 'S', 'S-59692153', NULL, 'Ready To Wear Size', 'S', 108, 901, '2022-09-10 15:27:28', '2022-09-10 15:27:28'),
(543, 'M', 'M-59692153', NULL, 'Ready To Wear Size', 'M', 108, 902, '2022-09-10 15:27:30', '2022-09-10 15:27:30'),
(544, 'L', 'L-59692153', NULL, 'Ready To Wear Size', 'L', 108, 903, '2022-09-10 15:27:32', '2022-09-10 15:27:32'),
(545, 'XL', 'XL-59692153', NULL, 'Ready To Wear Size', 'XL', 108, 904, '2022-09-10 15:27:34', '2022-09-10 15:27:34'),
(546, '2XL', '2XL-59692153', NULL, 'Ready To Wear Size', '2XL', 108, 905, '2022-09-10 15:27:37', '2022-09-10 15:27:37'),
(547, 'S', 'S-79119358', NULL, 'Ready To Wear Size', 'S', 109, 907, '2022-09-10 15:30:24', '2022-09-10 15:30:24'),
(548, 'M', 'M-79119358', NULL, 'Ready To Wear Size', 'M', 109, 908, '2022-09-10 15:30:26', '2022-09-10 15:30:26'),
(549, 'L', 'L-79119358', NULL, 'Ready To Wear Size', 'L', 109, 909, '2022-09-10 15:30:28', '2022-09-10 15:30:28'),
(550, 'XL', 'XL-79119358', NULL, 'Ready To Wear Size', 'XL', 109, 910, '2022-09-10 15:30:30', '2022-09-10 15:30:30'),
(551, '2XL', '2XL-79119358', NULL, 'Ready To Wear Size', '2XL', 109, 911, '2022-09-10 15:30:33', '2022-09-10 15:30:33'),
(552, 'S', 'S-28164251', NULL, 'Ready To Wear Size', 'S', 110, 913, '2022-09-10 15:32:07', '2022-09-10 15:32:07'),
(553, 'M', 'M-28164251', NULL, 'Ready To Wear Size', 'M', 110, 914, '2022-09-10 15:32:09', '2022-09-10 15:32:09'),
(554, 'L', 'L-28164251', NULL, 'Ready To Wear Size', 'L', 110, 915, '2022-09-10 15:32:11', '2022-09-10 15:32:11'),
(555, 'XL', 'XL-28164251', NULL, 'Ready To Wear Size', 'XL', 110, 916, '2022-09-10 15:32:12', '2022-09-10 15:32:12'),
(556, '2XL', '2XL-28164251', NULL, 'Ready To Wear Size', '2XL', 110, 917, '2022-09-10 15:32:13', '2022-09-10 15:32:13'),
(557, 'S', 'S-81397033', '0.00', 'Ready To Wear Size', 'S', 111, 919, '2022-09-10 15:33:35', '2022-09-10 15:33:35'),
(558, 'M', 'M-81397033', NULL, 'Ready To Wear Size', 'M', 111, 920, '2022-09-10 15:33:37', '2022-09-10 15:33:37'),
(559, 'L', 'L-81397033', NULL, 'Ready To Wear Size', 'L', 111, 921, '2022-09-10 15:33:39', '2022-09-10 15:33:39'),
(560, 'XL', 'XL-81397033', NULL, 'Ready To Wear Size', 'XL', 111, 922, '2022-09-10 15:33:41', '2022-09-10 15:33:41'),
(561, '2XL', '2XL-81397033', NULL, 'Ready To Wear Size', '2XL', 111, 923, '2022-09-10 15:33:43', '2022-09-10 15:33:43'),
(562, 'S', 'S-44708100', NULL, 'Ready To Wear Size', 'S', 112, 925, '2022-09-10 15:34:22', '2022-09-10 15:34:22'),
(563, 'M', 'M-44708100', NULL, 'Ready To Wear Size', 'M', 112, 926, '2022-09-10 15:34:24', '2022-09-10 15:34:24'),
(564, 'L', 'L-44708100', NULL, 'Ready To Wear Size', 'L', 112, 927, '2022-09-10 15:34:26', '2022-09-10 15:34:26'),
(565, 'XL', 'XL-44708100', NULL, 'Ready To Wear Size', 'XL', 112, 928, '2022-09-10 15:34:28', '2022-09-10 15:34:28'),
(566, '2XL', '2XL-44708100', NULL, 'Ready To Wear Size', '2XL', 112, 929, '2022-09-10 15:34:30', '2022-09-10 15:34:30'),
(567, 'S', 'S-93538064', NULL, 'Ready To Wear Size', 'S', 113, 931, '2022-09-10 15:36:42', '2022-09-10 15:36:42'),
(568, 'M', 'M-93538064', NULL, 'Ready To Wear Size', 'M', 113, 932, '2022-09-10 15:36:44', '2022-09-10 15:36:44'),
(569, 'L', 'L-93538064', NULL, 'Ready To Wear Size', 'L', 113, 933, '2022-09-10 15:36:47', '2022-09-10 15:36:47'),
(570, 'XL', 'XL-93538064', NULL, 'Ready To Wear Size', 'XL', 113, 934, '2022-09-10 15:36:49', '2022-09-10 15:36:49'),
(571, '2XL', '2XL-93538064', NULL, 'Ready To Wear Size', '2XL', 113, 935, '2022-09-10 15:36:51', '2022-09-10 15:36:51'),
(572, 'S', 'S-13006324', NULL, 'Ready To Wear Size', 'S', 114, 937, '2022-09-10 15:37:22', '2022-09-10 15:37:22'),
(573, 'M', 'M-13006324', NULL, 'Ready To Wear Size', 'M', 114, 938, '2022-09-10 15:37:24', '2022-09-10 15:37:24'),
(574, 'L', 'L-13006324', NULL, 'Ready To Wear Size', 'L', 114, 939, '2022-09-10 15:37:27', '2022-09-10 15:37:27'),
(575, 'XL', 'XL-13006324', NULL, 'Ready To Wear Size', 'XL', 114, 940, '2022-09-10 15:37:29', '2022-09-10 15:37:29'),
(576, '2XL', '2XL-13006324', NULL, 'Ready To Wear Size', '2XL', 114, 941, '2022-09-10 15:37:31', '2022-09-10 15:37:31'),
(577, 'S', 'S-89361905', NULL, 'Ready To Wear Size', 'S', 115, 943, '2022-09-10 15:38:02', '2022-09-10 15:38:02'),
(578, 'M', 'M-89361905', NULL, 'Ready To Wear Size', 'M', 115, 944, '2022-09-10 15:38:04', '2022-09-10 15:38:04'),
(579, 'L', 'L-89361905', NULL, 'Ready To Wear Size', 'L', 115, 945, '2022-09-10 15:38:07', '2022-09-10 15:38:07'),
(580, 'XL', 'XL-89361905', NULL, 'Ready To Wear Size', 'XL', 115, 946, '2022-09-10 15:38:09', '2022-09-10 15:38:09'),
(581, '2XL', '2XL-89361905', NULL, 'Ready To Wear Size', '2XL', 115, 947, '2022-09-10 15:38:11', '2022-09-10 15:38:11'),
(591, 'P/meter', 'P/meter-87310854', NULL, 'Open Meter', 'P/meter', 409, 1712, '2022-09-14 15:11:35', '2022-09-17 03:14:16'),
(592, '4.25 Meter', '4.25 Meter-87310854', NULL, 'Open Meter', '4.25 Meter', 409, 1713, '2022-09-14 15:11:37', '2022-09-17 03:14:19'),
(593, '4.5 Meter', '4.5 Meter-87310854', '97.50', 'Open Meter', '4.5 Meter', 409, 1714, '2022-09-14 15:11:38', '2022-09-17 03:14:21'),
(594, '5 Meter', '5 Meter-87310854', '105.00', 'Open Meter', '5 Meter', 409, 1715, '2022-09-14 15:11:40', '2022-09-17 03:14:23'),
(595, 'S', 'S-31937564', NULL, 'Ready To Wear Size', 'S', 411, 1909, '2022-09-15 10:59:29', '2022-09-15 10:59:29'),
(596, 'M', 'M-31937564', NULL, 'Ready To Wear Size', 'M', 411, 1910, '2022-09-15 10:59:32', '2022-09-15 10:59:32'),
(597, 'L', 'L-31937564', NULL, 'Ready To Wear Size', 'L', 411, 1911, '2022-09-15 10:59:34', '2022-09-15 10:59:34'),
(598, 'XL', 'XL-31937564', NULL, 'Ready To Wear Size', 'XL', 411, 1912, '2022-09-15 10:59:36', '2022-09-15 10:59:36'),
(599, '2XL', '2XL-31937564', NULL, 'Ready To Wear Size', '2XL', 411, 1913, '2022-09-15 10:59:38', '2022-09-15 10:59:38'),
(600, 'S', 'S-81237719', NULL, 'Ready To Wear Size', 'S', 412, 1928, '2022-09-15 11:01:28', '2022-09-15 11:01:28'),
(601, 'M', 'M-81237719', NULL, 'Ready To Wear Size', 'M', 412, 1930, '2022-09-15 11:01:30', '2022-09-15 11:01:30'),
(602, 'L', 'L-81237719', NULL, 'Ready To Wear Size', 'L', 412, 1932, '2022-09-15 11:01:32', '2022-09-15 11:01:32'),
(603, 'XL', 'XL-81237719', NULL, 'Ready To Wear Size', 'XL', 412, 1933, '2022-09-15 11:01:34', '2022-09-15 11:01:34'),
(604, '2XL', '2XL-81237719', NULL, 'Ready To Wear Size', '2XL', 412, 1935, '2022-09-15 11:01:36', '2022-09-15 11:01:36'),
(605, 'S', 'S-26840549', NULL, 'Ready To Wear Size', 'S', 413, 1939, '2022-09-15 11:02:53', '2022-09-15 11:02:53'),
(606, 'M', 'M-26840549', NULL, 'Ready To Wear Size', 'M', 413, 1940, '2022-09-15 11:02:56', '2022-09-15 11:02:56'),
(607, 'L', 'L-26840549', NULL, 'Ready To Wear Size', 'L', 413, 1941, '2022-09-15 11:02:58', '2022-09-15 11:02:58'),
(608, 'XL', 'XL-26840549', NULL, 'Ready To Wear Size', 'XL', 413, 1942, '2022-09-15 11:03:01', '2022-09-15 11:03:01'),
(609, '2XL', '2XL-26840549', NULL, 'Ready To Wear Size', '2XL', 413, 1943, '2022-09-15 11:03:03', '2022-09-15 11:03:03'),
(610, 'S', 'S-69415911', NULL, 'Ready To Wear Size', 'S', 414, 1945, '2022-09-15 11:04:22', '2022-09-15 11:04:22'),
(611, 'M', 'M-69415911', NULL, 'Ready To Wear Size', 'M', 414, 1946, '2022-09-15 11:04:24', '2022-09-15 11:04:24'),
(612, 'L', 'L-69415911', NULL, 'Ready To Wear Size', 'L', 414, 1947, '2022-09-15 11:04:27', '2022-09-15 11:04:27'),
(613, 'XL', 'XL-69415911', NULL, 'Ready To Wear Size', 'XL', 414, 1948, '2022-09-15 11:04:29', '2022-09-15 11:04:29'),
(614, '2XL', '2XL-69415911', NULL, 'Ready To Wear Size', '2XL', 414, 1949, '2022-09-15 11:04:31', '2022-09-15 11:04:31'),
(615, 'S', 'S-19316298', NULL, 'Ready To Wear Size', 'S', 415, 1951, '2022-09-15 11:05:25', '2022-09-15 11:05:25'),
(616, 'M', 'M-19316298', NULL, 'Ready To Wear Size', 'M', 415, 1952, '2022-09-15 11:05:28', '2022-09-15 11:05:28'),
(617, 'L', 'L-19316298', NULL, 'Ready To Wear Size', 'L', 415, 1953, '2022-09-15 11:05:31', '2022-09-15 11:05:31'),
(618, 'XL', 'XL-19316298', NULL, 'Ready To Wear Size', 'XL', 415, 1954, '2022-09-15 11:05:34', '2022-09-15 11:05:34'),
(619, '2XL', '2XL-19316298', NULL, 'Ready To Wear Size', '2XL', 415, 1955, '2022-09-15 11:05:37', '2022-09-15 11:05:37'),
(620, 'S', 'S-80921339', NULL, 'Ready To Wear Size', 'S', 416, 1957, '2022-09-15 11:06:35', '2022-09-15 11:06:35'),
(621, 'M', 'M-80921339', NULL, 'Ready To Wear Size', 'M', 416, 1958, '2022-09-15 11:06:37', '2022-09-15 11:06:37'),
(622, 'L', 'L-80921339', NULL, 'Ready To Wear Size', 'L', 416, 1959, '2022-09-15 11:06:40', '2022-09-15 11:06:40'),
(623, 'XL', 'XL-80921339', NULL, 'Ready To Wear Size', 'XL', 416, 1960, '2022-09-15 11:06:42', '2022-09-15 11:06:42'),
(624, '2XL', '2XL-80921339', NULL, 'Ready To Wear Size', '2XL', 416, 1961, '2022-09-15 11:06:45', '2022-09-15 11:06:45'),
(625, 'S', 'S-18452687', NULL, 'Ready To Wear Size', 'S', 417, 1963, '2022-09-15 11:07:46', '2022-09-15 11:07:46'),
(626, 'M', 'M-18452687', NULL, 'Ready To Wear Size', 'M', 417, 1964, '2022-09-15 11:07:49', '2022-09-15 11:07:49'),
(627, 'L', 'L-18452687', NULL, 'Ready To Wear Size', 'L', 417, 1965, '2022-09-15 11:07:51', '2022-09-15 11:07:51'),
(628, 'XL', 'XL-18452687', NULL, 'Ready To Wear Size', 'XL', 417, 1966, '2022-09-15 11:07:54', '2022-09-15 11:07:54'),
(629, '2XL', '2XL-18452687', NULL, 'Ready To Wear Size', '2XL', 417, 1967, '2022-09-15 11:07:56', '2022-09-15 11:07:56'),
(630, 'S', 'S-17298332', NULL, 'Ready To Wear Size', 'S', 418, 1969, '2022-09-15 11:08:57', '2022-09-15 11:08:57'),
(631, 'M', 'M-17298332', NULL, 'Ready To Wear Size', 'M', 418, 1970, '2022-09-15 11:08:59', '2022-09-15 11:08:59'),
(632, 'L', 'L-17298332', NULL, 'Ready To Wear Size', 'L', 418, 1971, '2022-09-15 11:09:02', '2022-09-15 11:09:02'),
(633, 'XL', 'XL-17298332', NULL, 'Ready To Wear Size', 'XL', 418, 1972, '2022-09-15 11:09:04', '2022-09-15 11:09:04'),
(634, '2XL', '2XL-17298332', NULL, 'Ready To Wear Size', '2XL', 418, 1973, '2022-09-15 11:09:07', '2022-09-15 11:09:07'),
(635, 'S', 'S-43060995', NULL, 'Ready To Wear Size', 'S', 419, 1975, '2022-09-15 11:09:57', '2022-09-15 11:09:57'),
(636, 'M', 'M-43060995', NULL, 'Ready To Wear Size', 'M', 419, 1976, '2022-09-15 11:09:59', '2022-09-15 11:09:59'),
(637, 'L', 'L-43060995', NULL, 'Ready To Wear Size', 'L', 419, 1977, '2022-09-15 11:10:00', '2022-09-15 11:10:00'),
(638, 'XL', 'XL-43060995', NULL, 'Ready To Wear Size', 'XL', 419, 1978, '2022-09-15 11:10:03', '2022-09-15 11:10:03'),
(639, '2XL', '2XL-43060995', NULL, 'Ready To Wear Size', '2XL', 419, 1979, '2022-09-15 11:10:05', '2022-09-15 11:10:05'),
(640, 'S', 'S-10173696', NULL, 'Ready To Wear Size', 'S', 420, 1981, '2022-09-15 11:10:49', '2022-09-15 11:10:49'),
(641, 'M', 'M-10173696', NULL, 'Ready To Wear Size', 'M', 420, 1982, '2022-09-15 11:10:51', '2022-09-15 11:10:51'),
(642, 'L', 'L-10173696', NULL, 'Ready To Wear Size', 'L', 420, 1983, '2022-09-15 11:10:54', '2022-09-15 11:10:54'),
(643, 'XL', 'XL-10173696', NULL, 'Ready To Wear Size', 'XL', 420, 1984, '2022-09-15 11:10:56', '2022-09-15 11:10:56'),
(644, '2XL', '2XL-10173696', NULL, 'Ready To Wear Size', '2XL', 420, 1985, '2022-09-15 11:10:59', '2022-09-15 11:10:59'),
(645, 'S', 'S-96591039', NULL, 'Ready To Wear Size', 'S', 421, 1987, '2022-09-15 11:11:44', '2022-09-15 11:11:44'),
(646, 'M', 'M-96591039', NULL, 'Ready To Wear Size', 'M', 421, 1988, '2022-09-15 11:11:47', '2022-09-15 11:11:47'),
(647, 'L', 'L-96591039', NULL, 'Ready To Wear Size', 'L', 421, 1989, '2022-09-15 11:11:49', '2022-09-15 11:11:49'),
(648, 'XL', 'XL-96591039', NULL, 'Ready To Wear Size', 'XL', 421, 1990, '2022-09-15 11:11:52', '2022-09-15 11:11:52'),
(649, '2XL', '2XL-96591039', NULL, 'Ready To Wear Size', '2XL', 421, 1991, '2022-09-15 11:11:55', '2022-09-15 11:11:55'),
(650, 'S', 'S-13008993', NULL, 'Ready To Wear Size', 'S', 422, 1993, '2022-09-15 11:12:43', '2022-09-15 11:12:43'),
(651, 'M', 'M-13008993', NULL, 'Ready To Wear Size', 'M', 422, 1994, '2022-09-15 11:12:45', '2022-09-15 11:12:45'),
(652, 'L', 'L-13008993', NULL, 'Ready To Wear Size', 'L', 422, 1995, '2022-09-15 11:12:47', '2022-09-15 11:12:47'),
(653, 'XL', 'XL-13008993', NULL, 'Ready To Wear Size', 'XL', 422, 1996, '2022-09-15 11:12:49', '2022-09-15 11:12:49'),
(654, '2XL', '2XL-13008993', NULL, 'Ready To Wear Size', '2XL', 422, 1997, '2022-09-15 11:12:50', '2022-09-15 11:12:50'),
(655, 'XS', 'XS-54319026', NULL, 'Ready To Wear Size', 'XS', 423, 1999, '2022-09-15 11:19:16', '2022-09-15 11:19:16'),
(656, 'S', 'S-54319026', NULL, 'Ready To Wear Size', 'S', 423, 2000, '2022-09-15 11:19:19', '2022-09-15 11:19:19'),
(657, 'M', 'M-54319026', NULL, 'Ready To Wear Size', 'M', 423, 2001, '2022-09-15 11:19:21', '2022-09-15 11:19:21'),
(658, 'L', 'L-54319026', NULL, 'Ready To Wear Size', 'L', 423, 2002, '2022-09-15 11:19:23', '2022-09-15 11:19:23'),
(659, 'XL', 'XL-54319026', NULL, 'Ready To Wear Size', 'XL', 423, 2003, '2022-09-15 11:19:26', '2022-09-15 11:19:26'),
(660, '2XL', '2XL-54319026', NULL, 'Ready To Wear Size', '2XL', 423, 2004, '2022-09-15 11:19:28', '2022-09-15 11:19:28'),
(661, 'XS', 'XS-99437231', NULL, 'Ready To Wear Size', 'XS', 424, 2006, '2022-09-15 11:20:37', '2022-09-15 11:20:37'),
(662, 'S', 'S-99437231', NULL, 'Ready To Wear Size', 'S', 424, 2007, '2022-09-15 11:20:39', '2022-09-15 11:20:39'),
(663, 'M', 'M-99437231', NULL, 'Ready To Wear Size', 'M', 424, 2008, '2022-09-15 11:20:41', '2022-09-15 11:20:41'),
(664, 'L', 'L-99437231', NULL, 'Ready To Wear Size', 'L', 424, 2009, '2022-09-15 11:20:44', '2022-09-15 11:20:44'),
(665, 'XL', 'XL-99437231', NULL, 'Ready To Wear Size', 'XL', 424, 2010, '2022-09-15 11:20:46', '2022-09-15 11:20:46'),
(666, '2XL', '2XL-99437231', NULL, 'Ready To Wear Size', '2XL', 424, 2011, '2022-09-15 11:20:48', '2022-09-15 11:20:48'),
(667, 'XS', 'XS-23156084', NULL, 'Ready To Wear Size', 'XS', 425, 2013, '2022-09-15 11:21:52', '2022-09-15 11:21:52'),
(668, 'S', 'S-23156084', NULL, 'Ready To Wear Size', 'S', 425, 2014, '2022-09-15 11:21:54', '2022-09-15 11:21:54'),
(669, 'M', 'M-23156084', NULL, 'Ready To Wear Size', 'M', 425, 2015, '2022-09-15 11:21:56', '2022-09-15 11:21:56'),
(670, 'L', 'L-23156084', NULL, 'Ready To Wear Size', 'L', 425, 2016, '2022-09-15 11:21:58', '2022-09-15 11:21:58'),
(671, 'XL', 'XL-23156084', NULL, 'Ready To Wear Size', 'XL', 425, 2017, '2022-09-15 11:22:01', '2022-09-15 11:22:01'),
(672, '2XL', '2XL-23156084', NULL, 'Ready To Wear Size', '2XL', 425, 2018, '2022-09-15 11:22:03', '2022-09-15 11:22:03'),
(673, 'P/meter', 'P/meter-23496372', NULL, 'Open Meter', 'P/meter', 443, 2494, '2022-09-16 03:26:03', '2022-09-17 03:14:43'),
(674, '4.25 Meter', '4.25 Meter-23496372', NULL, 'Open Meter', '4.25 Meter', 443, 2495, '2022-09-16 03:26:06', '2022-09-17 03:14:46'),
(675, '4.5 Meter', '4.5 Meter-23496372', '97.50', 'Open Meter', '4.5 Meter', 443, 2496, '2022-09-16 03:26:08', '2022-09-17 03:14:48'),
(676, '5 Meter', '5 Meter-23496372', '105.00', 'Open Meter', '5 Meter', 443, 2497, '2022-09-16 03:26:10', '2022-09-17 03:14:50'),
(677, 'P/meter', 'P/meter-90072263', NULL, 'Open Meter', 'P/meter', 444, 2499, '2022-09-16 03:29:52', '2022-09-17 03:15:05'),
(678, '4.25 Meter', '4.25 Meter-90072263', NULL, 'Open Meter', '4.25 Meter', 444, 2500, '2022-09-16 03:29:54', '2022-09-17 03:15:08'),
(679, '4.5 Meter', '4.5 Meter-90072263', '97.50', 'Open Meter', '4.5 Meter', 444, 2501, '2022-09-16 03:29:57', '2022-09-17 03:15:11'),
(680, '5 Meter', '5 Meter-90072263', '105.00', 'Open Meter', '5 Meter', 444, 2502, '2022-09-16 03:29:59', '2022-09-17 03:15:13'),
(681, 'P/meter', 'P/meter-32341231', NULL, 'Open Meter', 'P/meter', 445, 2504, '2022-09-16 03:31:48', '2022-09-17 03:15:27'),
(682, '4.25 Meter', '4.25 Meter-32341231', NULL, 'Open Meter', '4.25 Meter', 445, 2505, '2022-09-16 03:31:50', '2022-09-17 03:15:30'),
(683, '4.5 Meter', '4.5 Meter-32341231', '97.50', 'Open Meter', '4.5 Meter', 445, 2506, '2022-09-16 03:31:52', '2022-09-17 03:15:32'),
(684, '5 Meter', '5 Meter-32341231', '105.00', 'Open Meter', '5 Meter', 445, 2507, '2022-09-16 03:31:55', '2022-09-17 03:15:34'),
(685, 'P/meter', 'P/meter-37297583', NULL, 'Open Meter', 'P/meter', 446, 2509, '2022-09-16 03:32:55', '2022-09-17 03:15:49'),
(686, '4.25 Meter', '4.25 Meter-37297583', NULL, 'Open Meter', '4.25 Meter', 446, 2510, '2022-09-16 03:32:57', '2022-09-17 03:15:52'),
(687, '4.5 Meter', '4.5 Meter-37297583', '97.50', 'Open Meter', '4.5 Meter', 446, 2511, '2022-09-16 03:32:59', '2022-09-17 03:15:53'),
(688, '5 Meter', '5 Meter-37297583', '105.00', 'Open Meter', '5 Meter', 446, 2512, '2022-09-16 03:33:01', '2022-09-17 03:15:55'),
(689, 'P/meter', 'P/meter-84725315', NULL, 'Open Meter', 'P/meter', 447, 2514, '2022-09-16 03:33:55', '2022-09-17 03:16:24'),
(690, '4.25 Meter', '4.25 Meter-84725315', NULL, 'Open Meter', '4.25 Meter', 447, 2515, '2022-09-16 03:33:57', '2022-09-17 03:16:27'),
(691, '4.5 Meter', '4.5 Meter-84725315', '97.50', 'Open Meter', '4.5 Meter', 447, 2516, '2022-09-16 03:33:59', '2022-09-17 03:16:29'),
(692, '5 Meter', '5 Meter-84725315', '105.00', 'Open Meter', '5 Meter', 447, 2517, '2022-09-16 03:34:01', '2022-09-17 03:16:31'),
(693, 'P/meter', 'P/meter-82801245', NULL, 'Open Meter', 'P/meter', 448, 2519, '2022-09-16 03:34:59', '2022-09-17 03:16:48'),
(694, '4.25 Meter', '4.25 Meter-82801245', NULL, 'Open Meter', '4.25 Meter', 448, 2520, '2022-09-16 03:35:01', '2022-09-17 03:16:50'),
(695, '4.5 Meter', '4.5 Meter-82801245', '97.50', 'Open Meter', '4.5 Meter', 448, 2521, '2022-09-16 03:35:03', '2022-09-17 03:16:52'),
(696, '5 Meter', '5 Meter-82801245', '105.00', 'Open Meter', '5 Meter', 448, 2522, '2022-09-16 03:35:05', '2022-09-17 03:16:54'),
(697, 'P/meter', 'P/meter-34012209', NULL, 'Open Meter', 'P/meter', 449, 2524, '2022-09-16 03:35:49', '2022-09-17 03:17:17'),
(698, '4.25 Meter', '4.25 Meter-34012209', NULL, 'Open Meter', '4.25 Meter', 449, 2525, '2022-09-16 03:35:51', '2022-09-17 03:17:19'),
(699, '4.5 Meter', '4.5 Meter-34012209', '97.50', 'Open Meter', '4.5 Meter', 449, 2526, '2022-09-16 03:35:53', '2022-09-17 03:17:21'),
(700, '5 Meter', '5 Meter-34012209', '105.00', 'Open Meter', '5 Meter', 449, 2527, '2022-09-16 03:35:55', '2022-09-17 03:17:23'),
(701, 'P/meter', 'P/meter-20323239', NULL, 'Open Meter', 'P/meter', 450, 2529, '2022-09-16 03:37:00', '2022-09-17 03:17:38'),
(702, '4.25 Meter', '4.25 Meter-20323239', NULL, 'Open Meter', '4.25 Meter', 450, 2530, '2022-09-16 03:37:03', '2022-09-17 03:17:40'),
(703, '4.5 Meter', '4.5 Meter-20323239', '97.50', 'Open Meter', '4.5 Meter', 450, 2531, '2022-09-16 03:37:05', '2022-09-17 03:17:42'),
(704, '5 Meter', '5 Meter-20323239', '105.00', 'Open Meter', '5 Meter', 450, 2532, '2022-09-16 03:37:07', '2022-09-17 03:17:44'),
(711, 'P/meter', 'P/meter-48207529', NULL, 'Open Meter', 'P/meter', 456, 30798, '2022-09-17 01:58:51', '2022-09-17 01:58:51'),
(712, '4.25 Meter', '4.25 Meter-48207529', '52.81', 'Open Meter', '4.25 Meter', 456, 30799, '2022-09-17 01:58:54', '2022-09-17 01:58:54'),
(713, '4.5 Meter', '4.5 Meter-48207529', '56.87', 'Open Meter', '4.5 Meter', 456, 30800, '2022-09-17 01:58:56', '2022-09-17 01:58:56'),
(714, '5 Meter', '5 Meter-48207529', '65.00', 'Open Meter', '5 Meter', 456, 30801, '2022-09-17 01:58:58', '2022-09-17 01:58:58'),
(715, 'P/meter', 'P/meter-16280107', NULL, 'Open Meter', 'P/meter', 457, 30803, '2022-09-17 02:01:29', '2022-09-17 02:01:29'),
(716, '4.25 Meter', '4.25 Meter-16280107', '52.81', 'Open Meter', '4.25 Meter', 457, 30804, '2022-09-17 02:01:31', '2022-09-17 02:01:31'),
(717, '4.5 Meter', '4.5 Meter-16280107', '56.87', 'Open Meter', '4.5 Meter', 457, 30805, '2022-09-17 02:01:33', '2022-09-17 02:01:33'),
(718, '5 Meter', '5 Meter-16280107', '65.00', 'Open Meter', '5 Meter', 457, 30806, '2022-09-17 02:01:35', '2022-09-17 02:01:35'),
(719, 'P/meter', 'P/meter-18507321', NULL, 'Open Meter', 'P/meter', 458, 30808, '2022-09-17 02:05:14', '2022-09-17 02:05:14'),
(720, '4.25 Meter', '4.25 Meter-18507321', '52.81', 'Open Meter', '4.25 Meter', 458, 30809, '2022-09-17 02:05:16', '2022-09-17 02:05:16'),
(721, '4.5 Meter', '4.5 Meter-18507321', '56.87', 'Open Meter', '4.5 Meter', 458, 30810, '2022-09-17 02:05:18', '2022-09-17 02:05:18'),
(722, '5 Meter', '5 Meter-18507321', '65.00', 'Open Meter', '5 Meter', 458, 30811, '2022-09-17 02:05:21', '2022-09-17 02:05:21'),
(723, 'P/meter', 'P/meter-31208660', NULL, 'Open Meter', 'P/meter', 459, 30813, '2022-09-17 02:06:32', '2022-09-17 02:06:32'),
(724, '4.25 Meter', '4.25 Meter-31208660', '52.81', 'Open Meter', '4.25 Meter', 459, 30814, '2022-09-17 02:06:34', '2022-09-17 02:06:34'),
(725, '4.5 Meter', '4.5 Meter-31208660', '56.87', 'Open Meter', '4.5 Meter', 459, 30815, '2022-09-17 02:06:36', '2022-09-17 02:06:36'),
(726, '5 Meter', '5 Meter-31208660', '65.00', 'Open Meter', '5 Meter', 459, 30816, '2022-09-17 02:06:38', '2022-09-17 02:06:38'),
(731, 'P/meter', 'P/meter-13860773', NULL, 'Open Meter', 'P/meter', 461, 30823, '2022-09-17 02:22:46', '2022-09-17 02:22:46'),
(732, '4.25 Meter', '4.25 Meter-13860773', '52.81', 'Open Meter', '4.25 Meter', 461, 30824, '2022-09-17 02:22:48', '2022-09-17 02:22:48'),
(733, '4.5 Meter', '4.5 Meter-13860773', '56.87', 'Open Meter', '4.5 Meter', 461, 30825, '2022-09-17 02:22:50', '2022-09-17 02:22:50'),
(734, '5 Meter', '5 Meter-13860773', '65.00', 'Open Meter', '5 Meter', 461, 30826, '2022-09-17 02:22:53', '2022-09-17 02:22:53'),
(735, 'P/meter', 'P/meter-96533207', NULL, 'Open Meter', 'P/meter', 462, 30828, '2022-09-17 02:26:12', '2022-09-17 02:26:12'),
(736, '4.25 Meter', '4.25 Meter-96533207', '52.81', 'Open Meter', '4.25 Meter', 462, 30829, '2022-09-17 02:26:14', '2022-09-17 02:26:14'),
(737, '4.5 Meter', '4.5 Meter-96533207', '56.87', 'Open Meter', '4.5 Meter', 462, 30830, '2022-09-17 02:26:16', '2022-09-17 02:26:16'),
(738, '5 Meter', '5 Meter-96533207', '65.00', 'Open Meter', '5 Meter', 462, 30831, '2022-09-17 02:26:18', '2022-09-17 02:26:18'),
(739, 'P/meter', 'P/meter-13136659', NULL, 'Open Meter', 'P/meter', 463, 30833, '2022-09-17 02:27:06', '2022-09-17 02:27:06'),
(740, '4.25 Meter', '4.25 Meter-13136659', '52.81', 'Open Meter', '4.25 Meter', 463, 30834, '2022-09-17 02:27:09', '2022-09-17 02:27:09'),
(741, '4.5 Meter', '4.5 Meter-13136659', '56.87', 'Open Meter', '4.5 Meter', 463, 30835, '2022-09-17 02:27:11', '2022-09-17 02:27:11'),
(742, '5 Meter', '5 Meter-13136659', '65.00', 'Open Meter', '5 Meter', 463, 30836, '2022-09-17 02:27:13', '2022-09-17 02:27:13'),
(743, 'P/meter', 'P/meter-33080526', NULL, 'Open Meter', 'P/meter', 464, 30838, '2022-09-17 02:30:46', '2022-09-17 02:30:46'),
(744, '4.25 Meter', '4.25 Meter-33080526', '52.81', 'Open Meter', '4.25 Meter', 464, 30839, '2022-09-17 02:30:48', '2022-09-17 02:30:48'),
(745, '4.5 Meter', '4.5 Meter-33080526', '56.87', 'Open Meter', '4.5 Meter', 464, 30840, '2022-09-17 02:30:50', '2022-09-17 02:30:50'),
(746, '5 Meter', '5 Meter-33080526', '65.00', 'Open Meter', '5 Meter', 464, 30841, '2022-09-17 02:30:53', '2022-09-17 02:30:53'),
(747, 'P/meter', 'P/meter-22901641', NULL, 'Open Meter', 'P/meter', 465, 30843, '2022-09-17 02:31:45', '2022-09-17 02:31:45'),
(748, '4.25 Meter', '4.25 Meter-22901641', '52.81', 'Open Meter', '4.25 Meter', 465, 30844, '2022-09-17 02:31:47', '2022-09-17 02:31:47'),
(749, '4.5 Meter', '4.5 Meter-22901641', '56.87', 'Open Meter', '4.5 Meter', 465, 30845, '2022-09-17 02:31:49', '2022-09-17 02:31:49'),
(750, '5 Meter', '5 Meter-22901641', '65.00', 'Open Meter', '5 Meter', 465, 30846, '2022-09-17 02:31:51', '2022-09-17 02:31:51'),
(751, 'P/meter', 'P/meter-99691304', NULL, 'Open Meter', 'P/meter', 466, 30848, '2022-09-17 02:32:23', '2022-09-17 02:32:23'),
(752, '4.25 Meter', '4.25 Meter-99691304', '52.81', 'Open Meter', '4.25 Meter', 466, 30849, '2022-09-17 02:32:25', '2022-09-17 02:32:25'),
(753, '4.5 Meter', '4.5 Meter-99691304', '56.87', 'Open Meter', '4.5 Meter', 466, 30850, '2022-09-17 02:32:28', '2022-09-17 02:32:28'),
(754, '5 Meter', '5 Meter-99691304', '65.00', 'Open Meter', '5 Meter', 466, 30851, '2022-09-17 02:32:30', '2022-09-17 02:32:30'),
(755, 'P/meter', 'P/meter-57328305', NULL, 'Open Meter', 'P/meter', 467, 30853, '2022-09-17 02:35:50', '2022-09-17 02:35:50'),
(756, '4.25 Meter', '4.25 Meter-57328305', '52.81', 'Open Meter', '4.25 Meter', 467, 30854, '2022-09-17 02:35:53', '2022-09-17 02:35:53'),
(757, '4.5 Meter', '4.5 Meter-57328305', '56.87', 'Open Meter', '4.5 Meter', 467, 30855, '2022-09-17 02:35:55', '2022-09-17 02:35:55'),
(758, '5 Meter', '5 Meter-57328305', '65.00', 'Open Meter', '5 Meter', 467, 30856, '2022-09-17 02:35:57', '2022-09-17 02:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouse_prices`
--

CREATE TABLE `product_warehouse_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `PID` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoices`
--

CREATE TABLE `purchase_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SUPID` bigint(20) UNSIGNED NOT NULL,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `trans_code` bigint(20) DEFAULT NULL,
  `purchase_status` bigint(20) UNSIGNED NOT NULL,
  `attached_document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_tax` bigint(20) DEFAULT NULL,
  `shipping_cost` decimal(20,2) DEFAULT NULL,
  `discount` decimal(20,2) DEFAULT NULL,
  `net_total` decimal(20,2) DEFAULT NULL,
  `inovice_details` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `SUPID` bigint(20) UNSIGNED NOT NULL,
  `lab` tinyint(1) NOT NULL DEFAULT '0',
  `EMPID` bigint(20) UNSIGNED NOT NULL,
  `Payment_Term` bigint(20) UNSIGNED DEFAULT NULL,
  `Delivery_Via` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created_By` bigint(20) UNSIGNED DEFAULT NULL,
  `Updated_By` bigint(20) UNSIGNED DEFAULT NULL,
  `BID` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `Delivery_days` int(11) DEFAULT '0',
  `Delivery_date` date DEFAULT NULL,
  `Payment_on` int(11) DEFAULT NULL,
  `After_delivery` date DEFAULT NULL,
  `Buyer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contact_Person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Delivery_address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pr` bigint(20) DEFAULT '0',
  `date` date DEFAULT NULL,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `SUPID` bigint(20) UNSIGNED NOT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inovice_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(30,2) DEFAULT '0.00',
  `net_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trans_code` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `SUPID` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `saleperson_id` bigint(20) UNSIGNED NOT NULL,
  `order_tax` decimal(8,2) DEFAULT NULL,
  `shipping_cost` decimal(8,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT '0.00',
  `net_total` decimal(8,2) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `date`, `WHID`, `SUPID`, `customer_id`, `saleperson_id`, `order_tax`, `shipping_cost`, `discount`, `net_total`, `status`, `note`, `attach_document`, `created_at`, `updated_at`) VALUES
(1, '2021-08-22', 1, 0, 5, 1, NULL, '0.00', '0.00', '24000.00', '0', NULL, NULL, '2022-08-21 11:21:18', '2022-08-21 11:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_vouchers`
--

CREATE TABLE `receipt_vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trans_date` date NOT NULL,
  `trans_acc_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` bigint(20) UNSIGNED NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `trans_code` bigint(20) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(6, 'Cashier', 'web', '2022-08-01 13:12:14', '2022-09-16 23:52:20'),
(7, 'Shop Manager', 'web', '2022-09-16 19:28:44', '2022-09-16 19:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(14, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(48, 1),
(50, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(60, 1),
(62, 1),
(64, 1),
(66, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(76, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(94, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(104, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(170, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(180, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(198, 1),
(199, 1),
(200, 1),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(206, 1),
(208, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(213, 1),
(214, 1),
(216, 1),
(217, 1),
(218, 1),
(219, 1),
(220, 1),
(221, 1),
(222, 1),
(224, 1),
(225, 1),
(226, 1),
(227, 1),
(228, 1),
(229, 1),
(230, 1),
(232, 1),
(233, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(238, 1),
(240, 1),
(241, 1),
(242, 1),
(243, 1),
(244, 1),
(245, 1),
(246, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(253, 1),
(254, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1),
(268, 1),
(269, 1),
(270, 1),
(272, 1),
(273, 1),
(274, 1),
(275, 1),
(276, 1),
(277, 1),
(278, 1),
(280, 1),
(281, 1),
(282, 1),
(283, 1),
(284, 1),
(285, 1),
(286, 1),
(288, 1),
(289, 1),
(290, 1),
(291, 1),
(292, 1),
(293, 1),
(294, 1),
(296, 1),
(297, 1),
(298, 1),
(299, 1),
(300, 1),
(301, 1),
(302, 1),
(304, 1),
(306, 1),
(307, 1),
(308, 1),
(309, 1),
(310, 1),
(311, 1),
(312, 1),
(314, 1),
(315, 1),
(316, 1),
(317, 1),
(318, 1),
(319, 1),
(320, 1),
(322, 1),
(323, 1),
(324, 1),
(325, 1),
(326, 1),
(327, 1),
(328, 1),
(330, 1),
(332, 1),
(333, 1),
(334, 1),
(335, 1),
(336, 1),
(337, 1),
(338, 1),
(340, 1),
(341, 1),
(342, 1),
(343, 1),
(344, 1),
(345, 1),
(346, 1),
(348, 1),
(349, 1),
(350, 1),
(351, 1),
(352, 1),
(353, 1),
(354, 1),
(356, 1),
(357, 1),
(358, 1),
(359, 1),
(360, 1),
(361, 1),
(362, 1),
(364, 1),
(366, 1),
(367, 1),
(368, 1),
(369, 1),
(370, 1),
(371, 1),
(372, 1),
(374, 1),
(375, 1),
(376, 1),
(377, 1),
(378, 1),
(379, 1),
(380, 1),
(382, 1),
(383, 1),
(384, 1),
(385, 1),
(386, 1),
(387, 1),
(388, 1),
(390, 1),
(391, 1),
(392, 1),
(393, 1),
(394, 1),
(395, 1),
(396, 1),
(398, 1),
(399, 1),
(400, 1),
(401, 1),
(402, 1),
(403, 1),
(404, 1),
(406, 1),
(407, 1),
(408, 1),
(409, 1),
(410, 1),
(411, 1),
(412, 1),
(414, 1),
(415, 1),
(416, 1),
(417, 1),
(418, 1),
(419, 1),
(420, 1),
(48, 6),
(52, 6),
(53, 6),
(54, 6),
(78, 6),
(79, 6),
(80, 6),
(24, 7),
(25, 7),
(26, 7),
(48, 7),
(50, 7),
(52, 7),
(53, 7),
(54, 7),
(78, 7),
(79, 7),
(80, 7),
(86, 7),
(87, 7),
(88, 7),
(170, 7),
(172, 7),
(173, 7),
(174, 7),
(382, 7),
(383, 7),
(384, 7),
(390, 7),
(391, 7),
(392, 7),
(398, 7),
(399, 7),
(400, 7);

-- --------------------------------------------------------

--
-- Table structure for table `root_accounts`
--

CREATE TABLE `root_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `root_accounts`
--

INSERT INTO `root_accounts` (`id`, `code`, `acc_name`, `created_at`, `updated_at`) VALUES
(1, '1', 'Asset', '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(2, '2', 'Liability', '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(3, '3', 'Owner Equity', '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(4, '4', 'Income', '2022-06-18 13:06:52', '2022-06-18 13:06:52'),
(5, '5', 'Expense', '2022-06-18 13:06:52', '2022-06-18 13:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoices`
--

CREATE TABLE `sale_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `si` bigint(20) DEFAULT '0',
  `inv_date` date NOT NULL,
  `sale_person` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `order_tax` decimal(8,2) DEFAULT NULL,
  `shipping_cost` decimal(8,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `net_total` decimal(8,2) NOT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` bigint(20) UNSIGNED DEFAULT NULL,
  `received_amount` decimal(20,2) DEFAULT NULL,
  `balance` decimal(20,2) DEFAULT NULL,
  `attach_document` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_status` bigint(20) DEFAULT NULL,
  `sale_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_code` bigint(20) DEFAULT NULL,
  `cash` decimal(30,2) DEFAULT NULL,
  `credit_card` decimal(30,2) DEFAULT NULL,
  `qr_code` decimal(30,2) DEFAULT NULL,
  `change_cash` decimal(30,2) DEFAULT NULL,
  `write_off` decimal(20,2) DEFAULT NULL,
  `pos` tinyint(4) DEFAULT '0',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_invoices`
--

INSERT INTO `sale_invoices` (`id`, `si`, `inv_date`, `sale_person`, `customer_id`, `WHID`, `order_tax`, `shipping_cost`, `discount`, `net_total`, `payment_status`, `paid_by`, `received_amount`, `balance`, `attach_document`, `sale_status`, `sale_note`, `staff_note`, `reference_number`, `trans_code`, `cash`, `credit_card`, `qr_code`, `change_cash`, `write_off`, `pos`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2209161, '2022-09-16', NULL, 3, 3, '0.00', '0.00', '0.00', '169.00', '3', NULL, '169.00', NULL, '', 2, NULL, NULL, NULL, 1, '169.00', '0.00', '0.00', NULL, NULL, 0, 5, NULL, '2022-09-17 01:35:51', '2022-09-17 01:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `sale_persons`
--

CREATE TABLE `sale_persons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_per` bigint(20) UNSIGNED NOT NULL,
  `WHID` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_persons`
--

INSERT INTO `sale_persons` (`id`, `name`, `commission_per`, `WHID`, `created_at`, `updated_at`) VALUES
(1, 'Carlanisa', 0, 3, '2022-09-07 23:22:55', '2022-09-07 23:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

CREATE TABLE `sale_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sr` bigint(20) DEFAULT '0',
  `date` date NOT NULL,
  `sale_person` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `order_tax` decimal(8,2) DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inovice_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_code` bigint(20) DEFAULT NULL,
  `shipping_cost` decimal(20,2) DEFAULT '0.00',
  `discount` decimal(20,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `net_total` decimal(20,0) NOT NULL,
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0XgstW7BQAA95Hc70ORGtDb7zztRUMj4ygCpKtIr', NULL, '198.235.24.151', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZE1PY1JiUllCc0ZoUXczRTk0N0VGeHdvQXFPSVFYbndPdVFvdU5odiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vd3d3LmNhcmxhbmlzYS5yZXZlYmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1663410412),
('b3VwivqeO9ZNn9JzbvMTsxqMaSx4Qa33I0uInjNl', NULL, '103.95.34.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:104.0) Gecko/20100101 Firefox/104.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWFkzeTZMTVhOcTA2YnEzb21XQUc0amdibFI0UExnWVBWUkI4bUJNMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1663401538),
('b78DE1s1EzIGM6jfEl0ZIi1SdM1cTdjvYVXlenpb', 1, '103.95.34.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVEhYQVNXVDJkU1FKSnByU1VqQzhlcHpMTHJ3cVZpNE8xOTdFV3l1ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vY2FybGFuaXNhLnJldmViZS5jb20vcHJpbnRfYmFyY29kZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRrYkx2d2lmbWFNRVducU1Sam52YXh1c1Y4VlRtSWw2QjBhOW9RT21Ud2hVNDkuSnNDUnpXRyI7fQ==', 1663401388),
('J4U1kdrxkSIadipGy5BZOwbrJcqIVIjNwTqSDGPW', NULL, '205.210.31.159', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkczbUxoZ3V0Q29aQ24zWHRYT3N6ck9kbm5Xak1oa0hzanJFS3RhRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vY2FybGFuaXNhLnJldmViZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1663406463),
('KCbVzbrrhDSRTMUu5o6HVZbwt8fPxe5ekSUt63ib', 4, '103.95.34.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:104.0) Gecko/20100101 Firefox/104.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOXNDZGZBMEpuVW9UQm5Da05YUlY5TFh3bngzUXc2ZHB1Z3doUklQMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9jYXJsYW5pc2EucmV2ZWJlLmNvbS9wcmludF9iYXJjb2RlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFNEOHVtd0kwVHpGRlZLdC9MeEZLMGV2d2l2Yy8wNHBqSUZYZ2pIcU1DWHZ1VG9nNWJ5NTFHIjt9', 1663401205),
('N7DwvQbMz5zxE5oki2yXQPpVvZTbV3FuroLco6BX', 1, '103.95.34.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:104.0) Gecko/20100101 Firefox/104.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOHlqZWdUZUIxWklqRHh0Q1ByWFNYa0R5dnVhMDlxUXRBU242M2hISCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vY2FybGFuaXNhLnJldmViZS5jb20vc2FsZS9wb3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAka2JMdndpZm1hTUVXbnFNUmpudmF4dXNWOFZUbUlsNkIwYTlvUU9tVHdoVTQ5LkpzQ1J6V0ciO30=', 1663401040),
('N7GiGEDQwma9hceXB2jGS2hocA4RdgbvrEuswmS2', 1, '37.111.134.254', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNjZxWmdsUGkxMjNQSklMY0dFcnFPc3N2alpyQ3EySWxrMDRSdlRTeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJGtiTHZ3aWZtYU1FV25xTVJqbnZheHVzVjhWVG1JbDZCMGE5b1FPbVR3aFU0OS5Kc0NSeldHIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNjoiaHR0cDovL2NhcmxhbmlzYS5yZXZlYmUuY29tL3NhbGUvcG9zIjt9fQ==', 1663401025),
('RntW7i0o7NfL91ou1y5d6sGiRm1LOPdMBRwr9PSt', NULL, '203.82.75.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaFJJdWVsbHFNNWZzNkhpZ3o1SW1tSWJ6alBobEJlRDc1aEZJOU9zUyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cHM6Ly9jYXJsYW5pc2EucmV2ZWJlLmNvbS9zYWxlL3BvcyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwczovL2NhcmxhbmlzYS5yZXZlYmUuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1663400359),
('Vxn0r9q4aUyuYURR9pB76aTNSnRt9HGkQRqcEMFK', 1, '103.138.50.194', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZmlZQllwa3IzY0Fsdk82QlY3S3F3cGJDRE5waGpsVXFTcEtHZ1RGNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9jYXJsYW5pc2EucmV2ZWJlLmNvbS9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJGtiTHZ3aWZtYU1FV25xTVJqbnZheHVzVjhWVG1JbDZCMGE5b1FPbVR3aFU0OS5Kc0NSeldHIjt9', 1663400254),
('XcmoAqNVtNKLU2UjBJViVUBjU1cD08v78Zwrz7qa', 4, '103.95.34.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY1NRMlVEaXBSdDNyVTJ0NzU4ZEkzSTVPdW5iUk1DTVZ6b0JLRzdWQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vY2FybGFuaXNhLnJldmViZS5jb20vc2FsZS9wb3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkU0Q4dW13STBUekZGVkt0L0x4RkswZXZ3aXZjLzA0cGpJRlhnakhxTUNYdnVUb2c1Ynk1MUciO30=', 1663400442);

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Unit` bigint(20) UNSIGNED NOT NULL,
  `Qty` bigint(20) NOT NULL,
  `Unit_cost` decimal(50,2) NOT NULL,
  `discount` decimal(50,2) DEFAULT NULL,
  `tax` decimal(50,2) DEFAULT NULL,
  `sub_total` decimal(50,2) NOT NULL,
  `PID` bigint(20) UNSIGNED DEFAULT NULL,
  `SID` bigint(20) UNSIGNED DEFAULT NULL,
  `OID` bigint(20) UNSIGNED DEFAULT '0',
  `SRID` bigint(20) UNSIGNED DEFAULT '0',
  `PRID` bigint(20) UNSIGNED DEFAULT '0',
  `TRFID` bigint(20) UNSIGNED DEFAULT '0',
  `ADJID` bigint(20) DEFAULT '0',
  `WHID` bigint(20) UNSIGNED DEFAULT NULL,
  `reference` longtext COLLATE utf8mb4_unicode_ci,
  `in_out` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_heads`
--

CREATE TABLE `sub_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Sub_Head_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HID` bigint(20) UNSIGNED NOT NULL,
  `RID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_heads`
--

INSERT INTO `sub_heads` (`id`, `Sub_Head_Name`, `HID`, `RID`, `created_at`, `updated_at`) VALUES
(4, 'Petty Cash & Bank', 1, 1, '2022-06-30 10:43:49', '2022-06-30 10:43:49'),
(5, 'Receivables/Customer', 1, 1, '2022-06-30 10:44:12', '2022-06-30 10:44:12'),
(6, 'Security & Deposits', 1, 1, '2022-06-30 10:44:40', '2022-06-30 10:44:40'),
(7, 'Advances', 1, 1, '2022-06-30 10:44:56', '2022-06-30 10:44:56'),
(8, 'Fixed Assets', 2, 1, '2022-06-30 10:45:11', '2022-06-30 10:45:11'),
(9, 'Acc Depreciation', 2, 1, '2022-06-30 10:45:47', '2022-06-30 10:45:47'),
(10, 'Employee', 1, 1, '2022-06-30 10:46:08', '2022-06-30 10:46:08'),
(11, 'Credit Cards', 3, 2, '2022-06-30 10:46:23', '2022-06-30 10:46:23'),
(12, 'Long Term Liabilities', 4, 2, '2022-06-30 10:46:49', '2022-06-30 10:46:49'),
(13, 'Payable & Vendors', 3, 2, '2022-06-30 10:47:05', '2022-06-30 10:47:05'),
(14, 'Short Term Loans', 3, 2, '2022-06-30 10:47:24', '2022-06-30 10:47:24'),
(15, 'Short Term Liabilities', 3, 2, '2022-06-30 10:47:41', '2022-06-30 10:47:41'),
(16, 'Sole Proprietor', 6, 3, '2022-06-30 10:48:17', '2022-06-30 10:48:17'),
(17, 'Partenship', 6, 3, '2022-06-30 10:48:31', '2022-06-30 10:48:31'),
(18, 'Retained Earnings', 6, 3, '2022-06-30 10:48:51', '2022-06-30 10:48:51'),
(19, 'Unappropriated Profit', 6, 3, '2022-06-30 10:49:09', '2022-06-30 10:49:09'),
(20, 'Incomes', 7, 4, '2022-06-30 10:49:24', '2022-06-30 10:49:24'),
(21, 'Operating Expenses', 9, 5, '2022-06-30 10:49:40', '2022-06-30 10:49:40'),
(22, 'Financial Expenses', 10, 5, '2022-06-30 10:49:56', '2022-06-30 10:49:56'),
(23, 'Cost Of Revenue', 11, 5, '2022-06-30 10:50:09', '2022-06-30 10:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_id` bigint(20) UNSIGNED DEFAULT NULL,
  `WHID` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` bigint(20) UNSIGNED DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `trans_id`, `WHID`, `image`, `company_name`, `email`, `phone_number`, `vat_number`, `address`, `city`, `state`, `postal_code`, `country`, `created_at`, `updated_at`) VALUES
(1, 'Calanisa Supplier', 8, 3, '', NULL, 'test@gmail.com', '34567', NULL, 'fafa', NULL, NULL, NULL, NULL, '2022-09-09 21:50:28', '2022-09-09 21:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax_name`, `tax_rate`, `created_at`, `updated_at`) VALUES
(1, 'General', '5', '2022-06-30 10:10:56', '2022-06-30 10:10:56'),
(2, 'Sale Tax', '17', '2022-07-29 12:40:03', '2022-07-29 12:40:03'),
(3, 'VAT', '5', '2022-07-29 12:40:10', '2022-08-01 13:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(50,2) DEFAULT NULL,
  `dr_cr` tinyint(1) NOT NULL,
  `vt` tinyint(4) NOT NULL,
  `trans_code` bigint(20) NOT NULL,
  `trans_acc_id` bigint(20) UNSIGNED NOT NULL,
  `trans_date` date NOT NULL,
  `posting_date` date NOT NULL,
  `rec_date` date NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `Created_By` bigint(20) UNSIGNED NOT NULL,
  `Updated_By` bigint(20) UNSIGNED NOT NULL,
  `BID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `SID` bigint(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `dr_cr`, `vt`, `trans_code`, `trans_acc_id`, `trans_date`, `posting_date`, `rec_date`, `narration`, `status`, `Created_By`, `Updated_By`, `BID`, `created_at`, `updated_at`, `SID`) VALUES
(1, '169.00', 1, 4, 1, 9, '2022-09-16', '0000-00-00', '0000-00-00', 'Against Sale inovice #1', 1, 0, 0, 0, '2022-09-17 01:35:51', '2022-09-17 01:35:51', 0),
(2, '169.00', 2, 4, 1, 3, '2022-09-16', '0000-00-00', '0000-00-00', 'Against Sale inovice #1', 1, 0, 0, 0, '2022-09-17 01:35:51', '2022-09-17 01:35:51', 0),
(3, NULL, 1, 1, 1, 1, '2022-09-16', '0000-00-00', '0000-00-00', 'Received Payment Against Sale inovice #1', 1, 0, 0, 0, '2022-09-17 01:35:51', '2022-09-17 01:35:51', 0),
(4, NULL, 2, 1, 1, 9, '2022-09-16', '0000-00-00', '0000-00-00', 'Payment Against Sale inovice #1', 1, 0, 0, 0, '2022-09-17 01:35:51', '2022-09-17 01:35:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `WHIDF` bigint(20) UNSIGNED NOT NULL,
  `WHIDT` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_cost` decimal(20,2) DEFAULT NULL,
  `net_total` decimal(20,2) NOT NULL,
  `attached_document` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TR_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TR_Mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TR_Phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CYID` bigint(20) UNSIGNED NOT NULL,
  `TR_National_Tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TR_Sale_Tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AC_Type` bigint(20) UNSIGNED NOT NULL,
  `TR_Adress1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TR_Adress2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BID` bigint(20) UNSIGNED DEFAULT NULL,
  `Created_By` bigint(20) UNSIGNED DEFAULT NULL,
  `Updated_By` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trans_accounts`
--

CREATE TABLE `trans_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Trans_Acc_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PID` bigint(20) UNSIGNED NOT NULL,
  `Parent_Type` bigint(20) UNSIGNED DEFAULT NULL,
  `OB` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OB_Type` smallint(6) DEFAULT NULL,
  `BID` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `Created_BY` bigint(20) UNSIGNED DEFAULT NULL,
  `Updated_By` bigint(20) UNSIGNED DEFAULT NULL,
  `Last_Activity` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trans_accounts`
--

INSERT INTO `trans_accounts` (`id`, `Trans_Acc_Name`, `PID`, `Parent_Type`, `OB`, `OB_Type`, `BID`, `Created_BY`, `Updated_By`, `Last_Activity`, `created_at`, `updated_at`) VALUES
(1, 'Azeem Customer', 5, 5, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-20 12:36:24', '2022-09-05 14:15:28'),
(2, 'supplier', 2, 2, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-20 12:37:02', '2022-08-20 12:37:02'),
(3, 'Website Order', 5, 6, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-21 12:25:30', '2022-08-21 12:25:30'),
(4, 'Sale Account', 20, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-08-21 12:28:16', '2022-08-21 12:28:16'),
(5, 'Purchase Account', 21, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-08-21 12:28:29', '2022-08-21 12:28:29'),
(6, 'Carlanisa', 5, 1, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-07 23:20:48', '2022-09-07 23:20:48'),
(7, 'waqas', 5, 2, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-08 14:02:50', '2022-09-08 14:02:50'),
(8, 'Calanisa Supplier', 13, 1, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-09 21:50:28', '2022-09-09 21:50:28'),
(9, 'Walk In Customer', 5, 3, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-15 14:21:54', '2022-09-15 14:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `unit_types`
--

CREATE TABLE `unit_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_types`
--

INSERT INTO `unit_types` (`id`, `unit_name`, `created_at`, `updated_at`) VALUES
(1, 'Pcs', '2022-09-07 19:57:27', '2022-09-07 19:57:27'),
(2, 'Meter', '2022-09-07 19:57:36', '2022-09-07 19:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `WHID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `WHID`, `created_at`, `updated_at`) VALUES
(1, 'Muhammd Azeem', 'admin@gmail.com', NULL, '$2y$10$kbLvwifmaMEWnqMRjnvaxusV8VTmIl6B0a9oQOmTwhU49.JsCRzWG', NULL, NULL, NULL, NULL, NULL, 4, '2022-06-18 13:06:52', '2022-09-07 23:46:43'),
(2, 'Ahad Azeem', 'ahad@gmail.com', NULL, '$2y$10$aGIOzVY9gn.fLaCfcnzajOhoPk4ZR0bohJiHYDtL4.fbFOXEfB14O', NULL, NULL, NULL, NULL, NULL, 3, '2022-08-02 11:42:20', '2022-09-12 20:56:38'),
(3, 'bangi', 'hellocarlanisa@gmail.com', NULL, '$2y$10$vi4JbHizc8RH8B1L/G51TOIm..n9gmAfVR/geu6kbD8rkwfL/DzUq', NULL, NULL, NULL, NULL, NULL, 3, '2022-09-07 23:49:58', '2022-09-12 20:55:13'),
(4, 'Fayaz', 'fayaz@gmail.com', NULL, '$2y$10$SD8umwI0TzFFVKt/LxFK0evwivc/04pjIFXgjHqMCXvuTog5by51G', NULL, NULL, NULL, NULL, NULL, 4, '2022-09-16 19:29:27', '2022-09-16 19:29:27'),
(5, 'Bangi', 'bangi@carlanisa.com', NULL, '$2y$10$hk65PfpgmqoLOAnrGEEuKechaoAOViSMD/tW3JE93NkFqjpYveJNq', NULL, NULL, NULL, NULL, NULL, 3, '2022-09-16 19:38:43', '2022-09-16 19:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_settings`
--

CREATE TABLE `whatsapp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `whatsapp_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whatsapp_settings`
--

INSERT INTO `whatsapp_settings` (`id`, `whatsapp_id`, `whatsapp_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '1233333', '56yuugfdsddd12', 1, 1, '2022-08-23 11:45:42', '2022-08-23 11:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `where_houses`
--

CREATE TABLE `where_houses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `WH_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `WH_Mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `WH_Phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `WH_Email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `WH_CYID` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `WH_Address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `where_houses`
--

INSERT INTO `where_houses` (`id`, `WH_Name`, `WH_Mobile`, `WH_Phone`, `WH_Email`, `WH_CYID`, `WH_Address`, `created_at`, `updated_at`) VALUES
(3, 'Butik Bangi', '0192555975', '', 'hellocarlanisa@gmail.com', '', 'Butik | Bangi Sentral', '2022-09-07 23:22:38', '2022-09-15 14:19:48'),
(4, 'Head Office', '0192555975', '', 'hellocarlanisa@gmail.com', '', 'Store | Head Office', '2022-09-07 23:29:20', '2022-09-15 14:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `woocommerce_settings`
--

CREATE TABLE `woocommerce_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `woocommerce_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `woocommerce_sk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `woocommerce_sc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `woocommerce_settings`
--

INSERT INTO `woocommerce_settings` (`id`, `woocommerce_url`, `woocommerce_sk`, `woocommerce_sc`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'https://studio99.pk/', 'ck_4af68cd8fdba3a33258ba1a07c39df43a4e95bc0', 'cs_279de417f95857ffd6bfb7c2df71f16679b59ebb', 1, 1, '2022-08-23 11:33:22', '2022-09-13 19:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Z_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CTID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjustments`
--
ALTER TABLE `adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costcenters`
--
ALTER TABLE `costcenters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_name_unique` (`name`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_items`
--
ALTER TABLE `customer_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gate_passes`
--
ALTER TABLE `gate_passes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `head_accounts`
--
ALTER TABLE `head_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `head_accounts_rid_foreign` (`RID`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item__details`
--
ALTER TABLE `item__details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item__details_purchase_order_id_foreign` (`purchase_order_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `mail_settings`
--
ALTER TABLE `mail_settings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `o_inventories`
--
ALTER TABLE `o_inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_vouchers_trans_code_unique` (`trans_code`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
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
-- Indexes for table `pos_settings`
--
ALTER TABLE `pos_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `default_customer` (`default_customer`,`default_location`,`default_saleperson`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_pid_foreign` (`PID`);

--
-- Indexes for table `product_warehouse_prices`
--
ALTER TABLE `product_warehouse_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_warehouse_prices_pid_foreign` (`PID`);

--
-- Indexes for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_invoices_trans_code_unique` (`trans_code`),
  ADD KEY `purchase_invoices_supid_foreign` (`SUPID`),
  ADD KEY `purchase_invoices_whid_foreign` (`WHID`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_vouchers`
--
ALTER TABLE `receipt_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt_vouchers_trans_code_unique` (`trans_code`);

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
-- Indexes for table `root_accounts`
--
ALTER TABLE `root_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `root_accounts_code_unique` (`code`);

--
-- Indexes for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_persons`
--
ALTER TABLE `sale_persons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_heads`
--
ALTER TABLE `sub_heads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_heads_sub_head_name_hid_rid_unique` (`Sub_Head_Name`,`HID`,`RID`),
  ADD KEY `sub_heads_hid_foreign` (`HID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_name_unique` (`name`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_accounts`
--
ALTER TABLE `trans_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsapp_settings`
--
ALTER TABLE `whatsapp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `where_houses`
--
ALTER TABLE `where_houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `woocommerce_settings`
--
ALTER TABLE `woocommerce_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjustments`
--
ALTER TABLE `adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_registers`
--
ALTER TABLE `cash_registers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `costcenters`
--
ALTER TABLE `costcenters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_items`
--
ALTER TABLE `customer_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gate_passes`
--
ALTER TABLE `gate_passes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `head_accounts`
--
ALTER TABLE `head_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item__details`
--
ALTER TABLE `item__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_inventories`
--
ALTER TABLE `o_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_settings`
--
ALTER TABLE `pos_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=759;

--
-- AUTO_INCREMENT for table `product_warehouse_prices`
--
ALTER TABLE `product_warehouse_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipt_vouchers`
--
ALTER TABLE `receipt_vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `root_accounts`
--
ALTER TABLE `root_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_persons`
--
ALTER TABLE `sale_persons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_heads`
--
ALTER TABLE `sub_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_accounts`
--
ALTER TABLE `trans_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `whatsapp_settings`
--
ALTER TABLE `whatsapp_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `where_houses`
--
ALTER TABLE `where_houses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `woocommerce_settings`
--
ALTER TABLE `woocommerce_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `head_accounts`
--
ALTER TABLE `head_accounts`
  ADD CONSTRAINT `head_accounts_rid_foreign` FOREIGN KEY (`RID`) REFERENCES `root_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item__details`
--
ALTER TABLE `item__details`
  ADD CONSTRAINT `item__details_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_pid_foreign` FOREIGN KEY (`PID`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_warehouse_prices`
--
ALTER TABLE `product_warehouse_prices`
  ADD CONSTRAINT `product_warehouse_prices_pid_foreign` FOREIGN KEY (`PID`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  ADD CONSTRAINT `purchase_invoices_supid_foreign` FOREIGN KEY (`SUPID`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `purchase_invoices_whid_foreign` FOREIGN KEY (`WHID`) REFERENCES `where_houses` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_heads`
--
ALTER TABLE `sub_heads`
  ADD CONSTRAINT `sub_heads_hid_foreign` FOREIGN KEY (`HID`) REFERENCES `head_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
