-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2020 at 07:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safetygpstracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_users`
--

CREATE TABLE `all_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alter_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `par_add` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installation_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_bill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `complain_status` int(11) DEFAULT 0,
  `service_problem_status` int(11) DEFAULT 0,
  `total_due` double DEFAULT NULL,
  `next_payment_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expair_status` int(11) DEFAULT 0,
  `payment_status` int(11) DEFAULT 0,
  `order_status` int(11) DEFAULT 0,
  `due_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_paied` double DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '123456',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_users`
--

INSERT INTO `all_users` (`id`, `user_id`, `name`, `phone`, `alter_phone`, `email`, `par_add`, `car_number`, `car_model`, `installation_date`, `monthly_bill`, `device_price`, `user_type`, `complain_status`, `service_problem_status`, `total_due`, `next_payment_date`, `expair_status`, `payment_status`, `order_status`, `due_date`, `total_paied`, `note`, `password`, `created_at`, `updated_at`) VALUES
(1, 45, 'birob ratin', '01761955763', NULL, 'khasrur8@gmail.com', 'dhaka,bangladesh', 'DM GA 32-7096', 'AXIO', '2020-03-26', '500', NULL, 1, 0, 0, NULL, '2020-07-01 00:00:00', 0, 1, 0, '2020-06-11', NULL, NULL, '123456', '2020-03-03 05:38:28', '2020-03-03 05:38:28'),
(2, 46, 'birob ratin', '01761955790', NULL, 'khasrur8@gmail.com', 'dhaka,bangladesh', 'DM GA 32-7096', 'AXIO', '2020-03-18', '500', NULL, 1, 0, 0, NULL, '2020-09-01 00:00:00', 0, 1, 0, '2020-06-12', NULL, NULL, '123456', '2020-03-03 05:39:21', '2020-03-03 05:39:33'),
(3, 47, 'birob ratin', '01761955798', NULL, 'khasrur8@gmail.com', 'dhaka,bangladesh', 'DM GA 32-7096', 'AXIO', '2020-03-19', '23923', NULL, 1, 0, 0, NULL, '2020-11-01 00:00:00', 0, 1, 0, '2020-06-18', NULL, NULL, '123456', '2020-03-03 05:40:23', '2020-03-05 10:47:54'),
(4, 48, 'nirob ratin', '01761955749', NULL, 'khasrur8@gmail.com', 'satkhira,khulna bangladrsh', 'DM GA 32-7096', 'AXIO', '2020-03-18', '500', NULL, 1, 0, 0, NULL, '2020-03-01 00:00:00', 0, 0, 0, '2020-02-05', NULL, NULL, '123456', '2020-03-03 05:41:11', '2020-03-16 11:09:11'),
(6, 50, 'nirob ratin', '01761955769', '01761955769', 'khasrur8@gmail.com', 'satkhira,khulna bangladrsh', 'DM GA 32-7096', 'AXIO', '2020-03-12', '500', '300', 1, 0, 0, NULL, '2020-06-01 00:00:00', 0, 1, 0, '2020-05-08', NULL, NULL, '123456', '2020-03-03 06:08:24', '2020-03-16 10:07:41'),
(8, 52, 'nirob ratin', NULL, '01761955746', 'khasrur8@gmail.com', 'satkhira,khulna bangladrsh', 'DM GA 32-7096', 'AXIO', '2020-03-12', '500', '300', 1, 0, 0, NULL, '2020-07-01 00:00:00', 0, 1, 0, '2020-06-18', NULL, NULL, '123456', '2020-03-03 08:04:41', '2020-03-03 10:44:37'),
(9, 53, 'nirob ratin', NULL, NULL, 'khasrur8@gmail.com', 'satkhira,khulna bangladrsh', 'DM GA 32-7096', 'AXIO', '2020-03-18', '500', '300', 1, 0, 0, NULL, '2020-11-01 00:00:00', 0, 1, 0, '2020-06-18', NULL, NULL, '123456', '2020-03-03 09:58:48', '2020-03-05 10:44:59'),
(10, 55, 'nirob ratin', '01761955780', '01761955780', 'khasrur8@gmail.com', 'satkhira,khulna bangladrsh', 'DM GA 32-7096', 'AXIO', '2020-03-25', '500', '300', 1, 0, 0, NULL, '2020-03-01 00:00:00', 1, 1, 0, '2020-01-15', NULL, 'asdasd', '123456', '2020-03-05 11:10:29', '2020-03-18 06:11:02'),
(20, 65, 'nirob ratin', '01761955767', '01761955767', 'khasrur8@gmail.com', 'satkhira,khulna bangladrsh', 'DM GA 32-7096', 'AXIO', '2020-03-25', '500', '3000', 1, 0, 0, NULL, '2020-06-01 00:00:00', 1, 1, 0, '2020-05-12', NULL, NULL, '123456', '2020-03-16 09:57:12', '2020-03-16 10:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `assign_technician_devices`
--

CREATE TABLE `assign_technician_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `technician_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collect_amount` int(11) DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_technician_devices`
--

INSERT INTO `assign_technician_devices` (`id`, `status`, `technician_id`, `user_id`, `order_id`, `collect_amount`, `note`, `created_at`, `updated_at`) VALUES
(10, '0', 2, 6, NULL, NULL, NULL, '2020-03-04 07:01:55', '2020-03-04 07:01:55'),
(11, '1', 1, 9, NULL, NULL, NULL, '2020-03-04 07:02:18', '2020-03-16 10:21:40'),
(13, '0', 2, 4, NULL, NULL, NULL, '2020-03-04 07:05:27', '2020-03-04 07:05:27'),
(14, '1', 1, 3, NULL, 500, NULL, '2020-03-04 07:36:59', '2020-03-04 07:37:11'),
(15, '1', 1, 3, NULL, NULL, NULL, '2020-03-04 07:40:50', '2020-03-04 07:41:32'),
(16, '1', 1, 3, '1', NULL, NULL, '2020-03-04 10:12:08', '2020-03-04 10:12:36'),
(21, '1', 1, 20, NULL, 4000, NULL, '2020-03-16 10:22:06', '2020-03-16 10:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `billing_shedules`
--

CREATE TABLE `billing_shedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing_shedules`
--

INSERT INTO `billing_shedules` (`id`, `user_id`, `date`, `note`, `created_at`, `updated_at`) VALUES
(1, 8, '2020-03-12', 'update', '2020-03-03 08:41:02', '2020-03-04 09:17:33'),
(2, 4, '2020-03-18', 'sdfsdf', '2020-03-05 06:53:04', '2020-03-05 10:22:03'),
(3, 9, '2020-03-12', 'sdfsdf', '2020-03-05 10:19:51', '2020-03-05 10:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'not solve',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_infos`
--

CREATE TABLE `contact_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_phone_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_phone_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_infos`
--

INSERT INTO `contact_infos` (`id`, `address`, `phone`, `header_phone_1`, `header_phone_2`, `header_phone_3`, `email`, `created_at`, `updated_at`) VALUES
(4, '66/8 Indira Road, West Rajabajar, Dhaka-1215', '01713546487', '01713546487', '01713546487', '01713546487', 'info@safetygpstracker.com.bd', '2020-03-02 09:52:43', '2020-03-02 09:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `custom_orders`
--

CREATE TABLE `custom_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month_charge` int(11) NOT NULL,
  `device_price` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demos`
--

CREATE TABLE `demos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_name`, `device_model`, `device_price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'asdasd', 'x23423', '2342', 240, '2020-03-02 10:30:11', '2020-03-04 07:21:22'),
(2, 'Teltonika', 'FMB920', '2500', 54, '2020-03-03 10:08:28', '2020-03-04 07:40:31'),
(7, 'Teltonika', 'FMB920', '2500', 54, '2020-03-03 10:08:28', '2020-03-04 07:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `happy_clients`
--

CREATE TABLE `happy_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page_models`
--

CREATE TABLE `home_page_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `animated_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `small_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_models`
--

INSERT INTO `home_page_models` (`id`, `cover_image`, `animated_text`, `small_text`, `created_at`, `updated_at`) VALUES
(2, '2020-03-16-5e6f6332edbc8.jpg', NULL, NULL, '2020-03-16 11:29:55', '2020-03-16 11:29:55');

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
(3, '2020_02_02_110436_create_home_page_models_table', 2),
(4, '2020_02_03_074459_create_happy_clients_table', 3),
(5, '2020_02_03_082648_create_services_table', 4),
(6, '2020_02_03_090749_create_demos_table', 5),
(7, '2020_02_03_094020_create_teams_table', 6),
(8, '2020_02_03_102252_create_contact_infos_table', 7),
(9, '2020_02_04_050452_create_all_users_table', 8),
(10, '2020_02_04_104210_create_payment_histories_table', 9),
(11, '2020_02_06_145459_create_payment_confarmation_histories_table', 10),
(12, '2020_02_06_154645_create_technicians_table', 11),
(13, '2020_02_06_163506_create_monthly_bill_update-statuses_table', 12),
(14, '2020_02_06_164220_create_monthly_bill_update_statuses_table', 13),
(15, '2020_02_09_110858_create_devices_table', 14),
(16, '2020_02_09_122921_create_assign_technician_devices_table', 15),
(17, '2020_02_09_161915_create_technician_device_stocks_table', 16),
(18, '2020_02_09_162719_create_assign_technician_devices_table', 17),
(19, '2020_02_09_162955_create_technician_device_stocks_table', 18),
(20, '2020_02_10_164609_create_transaction_histories_table', 19),
(21, '2020_02_10_170457_create_transaction_histories_table', 20),
(22, '2020_02_17_111134_create_price_sub_categories_table', 21),
(23, '2020_02_17_111141_create_price_categaroys_table', 21),
(24, '2020_02_17_113535_create_price_sub_categories_table', 22),
(25, '2020_02_17_163247_create_features_table', 23),
(26, '0000_00_00_000000_create_payments_table', 24),
(27, '2020_02_19_123452_create_orders_table', 25),
(28, '2020_02_24_151959_create_billing_shedules_table', 26),
(29, '2020_02_26_150806_create_complains_table', 27),
(30, '2020_02_29_124936_create_custom_orders_table', 28),
(31, '2020_03_01_111034_create_what_client_says_table', 29),
(32, '2020_03_01_125646_create_tracking_devices_table', 30),
(34, '2020_03_03_164922_create_technican_stocks_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_bill_update_statuses`
--

CREATE TABLE `monthly_bill_update_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `monthly_bill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(255) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` int(11) NOT NULL,
  `device_quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `transaction_id`, `package_id`, `payment_status`, `order_status`, `device_quantity`, `created_at`, `updated_at`) VALUES
(1, 47, 1, 1, 'completed', 2, NULL, '2020-03-04 09:54:29', '2020-03-04 10:12:36');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_months` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `name`, `email`, `phone`, `amount`, `address`, `status`, `transaction_id`, `currency`, `number_of_months`, `created_at`, `updated_at`) VALUES
(1, 47, 'birob ratin', 'khasrur8@gmail.com', '01761955798', 25765, 'dhaka,bangladesh', 'Processing', '5e5f7ad5e99e4', 'BDT', NULL, '2020-03-04 09:54:29', '2020-03-04 09:54:29'),
(2, 60, 'birob ratin', 'khasrur8@gmail.com', '01761955799', 25765, 'satkhira,khulna bangladrsh', 'Processing', '5e6617afda93e', 'BDT', NULL, '2020-03-09 10:17:19', '2020-03-09 10:17:19'),
(3, 61, 'birob ratin', 'khasrur8@gmail.com', '01761955740', 501, 'satkhira,khulna bangladrsh', 'Processing', '5e661ab71a732', 'BDT', NULL, '2020-03-09 10:30:15', '2020-03-09 10:30:15'),
(4, 62, 'birob ratin', 'khasrur8@gmail.com', '01761955746', 25765, 'satkhira,khulna bangladrsh', 'Processing', '5e661baa21e84', 'BDT', NULL, '2020-03-09 10:34:18', '2020-03-09 10:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `payment_confarmation_histories`
--

CREATE TABLE `payment_confarmation_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `payment_history_id` bigint(20) UNSIGNED NOT NULL,
  `updated_amount` double NOT NULL,
  `payment_for_month` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_confarmation_histories`
--

INSERT INTO `payment_confarmation_histories` (`id`, `user_id`, `admin_id`, `payment_history_id`, `updated_amount`, `payment_for_month`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 4, 1500, 3, '2020-03-03 05:39:33', '2020-03-03 05:39:33'),
(2, 3, 2, 5, 500, 1, '2020-03-03 05:40:32', '2020-03-03 05:40:32'),
(3, 9, 2, 16, 2500, 5, '2020-03-05 10:10:28', '2020-03-05 10:10:28'),
(4, 3, 2, 20, 95692, 4, '2020-03-05 10:47:54', '2020-03-05 10:47:54'),
(18, 20, 2, 56, 500, 1, '2020-03-16 09:57:32', '2020-03-16 09:57:32'),
(19, 10, 2, 22, 500, 1, '2020-03-16 10:05:32', '2020-03-16 10:05:32'),
(20, 10, 2, 22, 500, 1, '2020-03-16 10:06:06', '2020-03-16 10:06:06'),
(21, 6, 2, 9, 500, 1, '2020-03-16 10:07:41', '2020-03-16 10:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_this_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nest_payment_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_paid_until_this_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_due` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_histories`
--

INSERT INTO `payment_histories` (`id`, `user_id`, `month_name`, `payment_this_date`, `nest_payment_date`, `total_paid_until_this_date`, `total_due`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-06-01 00:00:00', NULL, '2020-06-01 00:00:00', '', '500', 0, '2020-03-03 05:38:28', '2020-03-03 05:38:28'),
(2, 2, '2020-06-01 00:00:00', '500', '2020-06-01 00:00:00', '', '0', 1, '2020-03-03 05:39:21', '2020-03-03 05:39:33'),
(3, 2, '2020-07-01 00:00:00', '500', NULL, '', '0', 1, '2020-03-03 05:39:33', '2020-03-03 05:39:33'),
(4, 2, '2020-08-01 00:00:00', '500', NULL, '', '0', 1, '2020-03-03 05:39:33', '2020-03-03 05:39:33'),
(5, 3, '2020-06-01 00:00:00', '500', '2020-06-01 00:00:00', '', '0', 1, '2020-03-03 05:40:23', '2020-03-03 05:40:32'),
(6, 4, '2020-02-01 00:00:00', NULL, NULL, '', '500', 0, '2020-03-03 05:41:11', '2020-03-03 05:41:11'),
(9, 6, '2020-05-01 00:00:00', '500', '2020-05-01 00:00:00', '', '0', 1, '2020-03-03 06:08:24', '2020-03-16 10:07:41'),
(11, 8, '2020-06-01 00:00:00', NULL, '2020-06-01 00:00:00', '', '500', 0, '2020-03-03 08:04:41', '2020-03-03 08:04:41'),
(12, 9, '2020-06-01 00:00:00', '500', '2020-06-01 00:00:00', '', '0', 1, '2020-03-03 09:58:48', '2020-03-05 10:10:28'),
(13, 9, '2020-07-01 00:00:00', '500', NULL, '', '0', 1, '2020-03-05 10:10:28', '2020-03-05 10:10:28'),
(14, 9, '2020-08-01 00:00:00', '500', NULL, '', '0', 1, '2020-03-05 10:10:28', '2020-03-05 10:10:28'),
(15, 9, '2020-09-01 00:00:00', '500', NULL, '', '0', 1, '2020-03-05 10:10:28', '2020-03-05 10:10:28'),
(16, 9, '2020-10-01 00:00:00', '500', NULL, '', '0', 1, '2020-03-05 10:10:28', '2020-03-05 10:10:28'),
(17, 3, '2020-07-01 00:00:00', '23923', NULL, '', '0', 1, '2020-03-05 10:47:54', '2020-03-05 10:47:54'),
(18, 3, '2020-08-01 00:00:00', '23923', NULL, '', '0', 1, '2020-03-05 10:47:54', '2020-03-05 10:47:54'),
(19, 3, '2020-09-01 00:00:00', '23923', NULL, '', '0', 1, '2020-03-05 10:47:54', '2020-03-05 10:47:54'),
(20, 3, '2020-10-01 00:00:00', '23923', NULL, '', '0', 1, '2020-03-05 10:47:54', '2020-03-05 10:47:54'),
(21, 10, '2020-01-01 00:00:00', '500', NULL, '', '0', 1, '2020-03-05 11:10:29', '2020-03-16 10:05:32'),
(22, 10, '2020-02-01 00:00:00', '500', NULL, '', '0', 1, '2020-03-05 11:10:29', '2020-03-16 10:06:06'),
(56, 20, '2020-05-01 00:00:00', '500', '2020-05-01 00:00:00', '', '0', 1, '2020-03-16 09:57:12', '2020-03-16 09:57:32'),
(59, 10, '2020-03-01 00:00:00', NULL, '2020-03-01 00:00:00', '', '500', 0, '2020-03-16 11:08:17', '2020-03-16 11:08:17'),
(60, 4, '2020-03-01 00:00:00', NULL, '2020-03-01 00:00:00', '', '500', 0, '2020-03-16 11:09:11', '2020-03-16 11:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `price_categaroys`
--

CREATE TABLE `price_categaroys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_price` int(11) DEFAULT NULL,
  `monthly_charge` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_categaroys`
--

INSERT INTO `price_categaroys` (`id`, `name`, `bg_image`, `device_price`, `monthly_charge`, `created_at`, `updated_at`) VALUES
(1, 'birob ratin', '2020-03-04-5e5f7acb4f558.png', 2342, 23423, '2020-03-04 09:54:19', '2020-03-04 09:54:19'),
(2, 'nirob ratin', '2020-03-04-5e5f87af4b816.png', 500, 1, '2020-03-04 10:49:19', '2020-03-04 10:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `price_sub_categories`
--

CREATE TABLE `price_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skipe_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `technican_stocks`
--

CREATE TABLE `technican_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_id` bigint(20) UNSIGNED NOT NULL,
  `technicain_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technican_stocks`
--

INSERT INTO `technican_stocks` (`id`, `device_id`, `technicain_id`, `quantity`, `model`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 21, 'x23423', NULL, '2020-03-03 11:55:25', '2020-03-16 10:22:18'),
(5, 2, 2, 19, 'FMB920', NULL, '2020-03-04 06:36:45', '2020-03-09 10:34:28'),
(6, 1, 2, 7, 'x23423', NULL, '2020-03-04 07:21:22', '2020-03-09 10:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign_device_id` int(11) DEFAULT NULL,
  `device_quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `name`, `phone`, `email`, `address`, `assign_device_id`, `device_quantity`, `created_at`, `updated_at`) VALUES
(1, 'sagor', '01761955222', 'khasrur8@gmail.com', 'satkhira,khulna bangladrsh', NULL, NULL, '2020-03-03 10:09:04', '2020-03-03 10:09:04'),
(2, 'birob ratin', '01761955765', 'khasrur8@gmail.com', 'dhaka,bangladesh', NULL, NULL, '2020-03-03 12:04:25', '2020-03-03 12:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `technician_device_stocks`
--

CREATE TABLE `technician_device_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `technician_id` bigint(20) UNSIGNED NOT NULL,
  `assign_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technician_device_stocks`
--

INSERT INTO `technician_device_stocks` (`id`, `quantity`, `device_id`, `device_model`, `technician_id`, `assign_id`, `created_at`, `updated_at`) VALUES
(9, '5', '5', 'FMB920', 2, 10, '2020-03-04 07:01:55', '2020-03-04 07:01:55'),
(10, '3', '1', 'x23423', 1, 11, '2020-03-04 07:02:18', '2020-03-04 07:02:18'),
(11, '0', '2', 'FMB920', 1, 11, '2020-03-04 07:02:18', '2020-03-04 07:02:18'),
(14, '5', '5', 'FMB920', 2, 13, '2020-03-04 07:05:27', '2020-03-04 07:05:27'),
(15, '1', '1', 'x23423', 1, 14, '2020-03-04 07:36:59', '2020-03-04 07:36:59'),
(16, '1', '2', 'FMB920', 1, 14, '2020-03-04 07:36:59', '2020-03-04 07:36:59'),
(17, '5', '1', 'x23423', 1, 15, '2020-03-04 07:40:50', '2020-03-04 07:40:50'),
(18, '1', '7', 'FMB920', 1, 15, '2020-03-04 07:40:50', '2020-03-04 07:40:50'),
(19, '3', '1', 'x23423', 1, 16, '2020-03-04 10:12:08', '2020-03-04 10:12:36'),
(26, '3', '1', 'x23423', 1, 21, '2020-03-16 10:22:06', '2020-03-16 10:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_devices`
--

CREATE TABLE `tracking_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_histories`
--

CREATE TABLE `transaction_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `technician_id` bigint(20) UNSIGNED NOT NULL,
  `assign_id` bigint(20) UNSIGNED NOT NULL,
  `sell_price` double NOT NULL,
  `installation_cost` double NOT NULL,
  `device_costing` double NOT NULL,
  `profit_or_loss` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_histories`
--

INSERT INTO `transaction_histories` (`id`, `user_id`, `technician_id`, `assign_id`, `sell_price`, `installation_cost`, `device_costing`, `profit_or_loss`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 14, 100, 4000, 0, -3900, '2020-03-04 07:37:11', '2020-03-04 07:37:11'),
(4, 3, 1, 15, 3000, 200, 0, 2800, '2020-03-04 07:41:32', '2020-03-04 07:41:32'),
(5, 3, 1, 16, 100, 200, 0, -100, '2020-03-04 10:12:36', '2020-03-04 10:12:36'),
(9, 20, 1, 21, 100, 30, 0, 70, '2020-03-16 10:22:18', '2020-03-16 10:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT 1,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `role`, `type`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ranasopnil@gmail.com', '01713244647', NULL, '$2y$10$y.q7qZsghaahNaE3R35bm.4.FewwCqGhJ/FZ6fTRjxLnu8tyJqYTi', NULL, 0, 'admin', '2020-03-01 10:32:16', '2020-03-01 10:32:16'),
(2, 'birob ratin', 'khasrur8@gmail.com', '01761955765', NULL, '$2y$10$lmxKpmOOybJy1TIwhuMdieXuptnjiG11CzD2aFHzIqFAsRZjsZsdS', NULL, 0, 'admin', '2020-03-01 11:02:34', '2020-03-01 11:02:34'),
(45, 'birob ratin', 'khasrur8@gmail.com', '01761955763', NULL, '$2y$10$xpCKvlX4Y4qyLlk0nfnYtuG28QMofjZ4293XPbiT1XwZVvJEXveq.', NULL, 2, 'user', '2020-03-03 05:38:28', '2020-03-03 05:38:28'),
(46, 'birob ratin', 'khasrur8@gmail.com', '01761955790', NULL, '$2y$10$cuyRklnGzxvOW7vDewK9AejrUf6gOoohX9jV5IgK3l41zFOmxzUpC', NULL, 2, 'user', '2020-03-03 05:39:21', '2020-03-03 05:39:21'),
(47, 'birob ratin', 'khasrur8@gmail.com', '01761955798', NULL, '$2y$10$ZxIIL1r2CF69cgdPTN11weg/MXDF4rgrRUUpHUS2qMsM.5KnY/oSS', NULL, 2, 'user', '2020-03-03 05:40:23', '2020-03-03 05:40:23'),
(48, 'nirob ratin', 'khasrur8@gmail.com', '01761955749', NULL, '$2y$10$gb3rqvwKCOE/yUmYCDHHheq3STuLHdFrP1Qz2vv2LPEBU7uLx74FO', NULL, 2, 'user', '2020-03-03 05:41:11', '2020-03-03 05:41:11'),
(50, 'nirob ratin', 'khasrur8@gmail.com', '01761955769', NULL, '$2y$10$C.YIIodmjOQJW7G6OD34cO.PceIH4B5B35N5jbJQPMEZQ80Jhe2CG', NULL, 2, 'user', '2020-03-03 06:08:24', '2020-03-05 11:05:36'),
(52, 'nirob ratin', 'khasrur8@gmail.com', NULL, NULL, '$2y$10$lhQOKm1MDF/qvgpeotD6t.mGAedmvmRAXFEpcDj6rRdqicoEo7E5S', NULL, 2, 'user', '2020-03-03 08:04:41', '2020-03-03 10:44:37'),
(53, 'nirob ratin', 'khasrur8@gmail.com', NULL, NULL, '$2y$10$hjitOzlWpcwOnrL/u3OIJ.QI4Nnblgn.JPIxrLDAlL39bCkHmkCrq', NULL, 2, 'user', '2020-03-03 09:58:48', '2020-03-05 10:44:59'),
(54, 'birob ratin', 'khasrur8@gmail.com', '01761955768', NULL, '$2y$10$Zaq6OSCynw1PtXK1VfqRcuWRHdCcJAQ2LFiYSjJxSpbqZbPdW/YKu', NULL, 0, 'sub_admin', '2020-03-05 06:18:41', '2020-03-05 06:19:02'),
(55, 'nirob ratin', 'khasrur8@gmail.com', '01761955780', NULL, '$2y$10$KLthHLgENv/YY875Y7qazeRACqfUyTC4HgNYNbLXwVU8uGD.LuRGy', NULL, 2, 'user', '2020-03-05 11:10:29', '2020-03-05 11:10:29'),
(65, 'nirob ratin', 'khasrur8@gmail.com', '01761955767', NULL, '$2y$10$NuID/K6A8ofWphw9SiPHK.WvIXDJ6jpl2IywQ3YBEBMbp2oO/duty', NULL, 2, 'user', '2020-03-16 09:57:12', '2020-03-16 09:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `what_client_says`
--

CREATE TABLE `what_client_says` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_users`
--
ALTER TABLE `all_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_technician_devices`
--
ALTER TABLE `assign_technician_devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_technician_devices_technician_id_foreign` (`technician_id`),
  ADD KEY `assign_technician_devices_user_id_foreign` (`user_id`);

--
-- Indexes for table `billing_shedules`
--
ALTER TABLE `billing_shedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billing_shedules_user_id_foreign` (`user_id`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complains_user_id_foreign` (`user_id`);

--
-- Indexes for table `contact_infos`
--
ALTER TABLE `contact_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `demos`
--
ALTER TABLE `demos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `happy_clients`
--
ALTER TABLE `happy_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_models`
--
ALTER TABLE `home_page_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_bill_update_statuses`
--
ALTER TABLE `monthly_bill_update_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monthly_bill_update_statuses_user_id_foreign` (`user_id`),
  ADD KEY `monthly_bill_update_statuses_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_transaction_id_foreign` (`transaction_id`),
  ADD KEY `orders_package_id_foreign` (`package_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment_confarmation_histories`
--
ALTER TABLE `payment_confarmation_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_confarmation_histories_user_id_foreign` (`user_id`),
  ADD KEY `payment_confarmation_histories_admin_id_foreign` (`admin_id`),
  ADD KEY `payment_confarmation_histories_payment_history_id_foreign` (`payment_history_id`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `price_categaroys`
--
ALTER TABLE `price_categaroys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_sub_categories`
--
ALTER TABLE `price_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_sub_categories_price_id_foreign` (`price_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technican_stocks`
--
ALTER TABLE `technican_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technican_stocks_device_id_foreign` (`device_id`),
  ADD KEY `technican_stocks_technicain_id_foreign` (`technicain_id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technician_device_stocks`
--
ALTER TABLE `technician_device_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technician_device_stocks_technician_id_foreign` (`technician_id`),
  ADD KEY `technician_device_stocks_assign_id_foreign` (`assign_id`);

--
-- Indexes for table `tracking_devices`
--
ALTER TABLE `tracking_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_histories`
--
ALTER TABLE `transaction_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_histories_user_id_foreign` (`user_id`),
  ADD KEY `transaction_histories_technician_id_foreign` (`technician_id`),
  ADD KEY `transaction_histories_assign_id_foreign` (`assign_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `what_client_says`
--
ALTER TABLE `what_client_says`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_users`
--
ALTER TABLE `all_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `assign_technician_devices`
--
ALTER TABLE `assign_technician_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `billing_shedules`
--
ALTER TABLE `billing_shedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_infos`
--
ALTER TABLE `contact_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `custom_orders`
--
ALTER TABLE `custom_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demos`
--
ALTER TABLE `demos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `happy_clients`
--
ALTER TABLE `happy_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_page_models`
--
ALTER TABLE `home_page_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `monthly_bill_update_statuses`
--
ALTER TABLE `monthly_bill_update_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_confarmation_histories`
--
ALTER TABLE `payment_confarmation_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `price_categaroys`
--
ALTER TABLE `price_categaroys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `price_sub_categories`
--
ALTER TABLE `price_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technican_stocks`
--
ALTER TABLE `technican_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `technician_device_stocks`
--
ALTER TABLE `technician_device_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tracking_devices`
--
ALTER TABLE `tracking_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_histories`
--
ALTER TABLE `transaction_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `what_client_says`
--
ALTER TABLE `what_client_says`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_technician_devices`
--
ALTER TABLE `assign_technician_devices`
  ADD CONSTRAINT `assign_technician_devices_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assign_technician_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `all_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `billing_shedules`
--
ALTER TABLE `billing_shedules`
  ADD CONSTRAINT `billing_shedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `all_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complains`
--
ALTER TABLE `complains`
  ADD CONSTRAINT `complains_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `all_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD CONSTRAINT `custom_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `all_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `monthly_bill_update_statuses`
--
ALTER TABLE `monthly_bill_update_statuses`
  ADD CONSTRAINT `monthly_bill_update_statuses_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `monthly_bill_update_statuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `all_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `price_categaroys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_confarmation_histories`
--
ALTER TABLE `payment_confarmation_histories`
  ADD CONSTRAINT `payment_confarmation_histories_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_confarmation_histories_payment_history_id_foreign` FOREIGN KEY (`payment_history_id`) REFERENCES `payment_histories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_confarmation_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `all_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD CONSTRAINT `payment_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `all_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `price_sub_categories`
--
ALTER TABLE `price_sub_categories`
  ADD CONSTRAINT `price_sub_categories_price_id_foreign` FOREIGN KEY (`price_id`) REFERENCES `price_categaroys` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `technican_stocks`
--
ALTER TABLE `technican_stocks`
  ADD CONSTRAINT `technican_stocks_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `technican_stocks_technicain_id_foreign` FOREIGN KEY (`technicain_id`) REFERENCES `technicians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `technician_device_stocks`
--
ALTER TABLE `technician_device_stocks`
  ADD CONSTRAINT `technician_device_stocks_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `assign_technician_devices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `technician_device_stocks_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_histories`
--
ALTER TABLE `transaction_histories`
  ADD CONSTRAINT `transaction_histories_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `assign_technician_devices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_histories_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `all_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
