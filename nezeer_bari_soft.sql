-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2021 at 08:30 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nezeer_bari_soft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'razibeee2016@gmail.com', 'superman', NULL, '$2y$10$QDYhd3lyH0vjAtSH19WWvesm4izBsG3txROic2e/Uh60xadCck3QS', NULL, '2021-01-24 14:48:40', '2021-01-24 14:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `ac_no`, `branch_name`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Premier Bank', 'Ac-010', 'Dhanmondi', '300000.00', '2021-02-23 13:46:14', '2021-02-25 00:29:54'),
(2, 'Islami Bank', 'Ac-011', 'Dhanmondi', '200000.00', '2021-02-23 13:46:54', '2021-02-23 13:46:54'),
(3, 'Primer Bank', 'Ac-012', 'Dhanmondi', '500000.00', '2021-02-23 13:47:19', '2021-02-23 13:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `bank_loans`
--

CREATE TABLE `bank_loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `investor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_loans`
--

INSERT INTO `bank_loans` (`id`, `investor_name`, `date`, `created_at`, `updated_at`) VALUES
(3, 'Primer Bank', '2021-02-02', '2021-02-24 01:38:44', '2021-02-24 01:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `bank_loan_adds`
--

CREATE TABLE `bank_loan_adds` (
  `id` int(10) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_loan_adds`
--

INSERT INTO `bank_loan_adds` (`id`, `investor_id`, `bank_id`, `check_no`, `date`, `amount`, `payment_method`, `note`, `created_at`, `updated_at`) VALUES
(3, 3, 3, '1456', '2021-02-02', 100000, 'open', NULL, '2021-02-24 01:40:03', '2021-02-24 01:40:03'),
(4, 3, 3, '65743', '2021-02-02', 20000, 'check', NULL, '2021-02-24 01:42:05', '2021-02-24 01:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `bank_loan_expenses`
--

CREATE TABLE `bank_loan_expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_loan_expenses`
--

INSERT INTO `bank_loan_expenses` (`id`, `investor_id`, `bank_id`, `check_no`, `date`, `amount`, `payment_method`, `note`, `created_at`, `updated_at`) VALUES
(2, 3, 3, '65743', '2021-02-09', 20000, 'check', NULL, '2021-02-24 01:42:40', '2021-02-24 01:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfers`
--

CREATE TABLE `bank_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_bank_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashes`
--

CREATE TABLE `cashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cash_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cashes`
--

INSERT INTO `cashes` (`id`, `cash_name`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Cash (open)', '250000.00', '2021-02-23 13:48:58', '2021-02-24 01:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `cashopens`
--

CREATE TABLE `cashopens` (
  `id` int(10) UNSIGNED NOT NULL,
  `purpose_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Expernditure', '2021-01-24 15:39:12', '2021-01-24 15:39:12'),
(2, 'Materials', '2021-01-24 15:39:21', '2021-01-24 15:39:21'),
(3, 'Labour', '2021-01-24 15:39:30', '2021-01-24 15:39:30'),
(5, 'Overhead', '2021-01-24 15:39:46', '2021-01-24 15:39:46'),
(6, 'Site Expenditure & Maintenances Cost', '2021-02-06 00:45:29', '2021-02-06 00:45:29'),
(7, 'Engs', '2021-03-04 10:42:43', '2021-03-04 10:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apartment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `project_id`, `client_name`, `phone`, `address`, `floor`, `apartment`, `amount`, `created_at`, `updated_at`) VALUES
(3, 3, 'Ekrama Khanom Mouri', '01769011666', 'Flat#AB5, 17 West & Street Road, Dhanmondi, Dhaka.', '4th Floor', 'A/4', '5800000.00', '2021-02-05 21:44:12', '2021-02-05 21:44:12'),
(4, 3, 'Md. Omor Faruk', '01730042383', 'Plot-08, Road, 01, DOHS Cantonment, Chittagong.', '3rd Floor', 'B/3', '5900000.00', '2021-02-05 21:47:29', '2021-02-05 21:47:29'),
(5, 3, 'Md. Osma Goni', '01741528937', 'House-30, Road-01, H/S auto, Baizid, Chittagong.', '5th Floor', 'A/5', '12200000.00', '2021-02-05 21:49:15', '2021-02-05 21:49:15'),
(6, 3, 'Md. Sobur Hosen', '0197054694', '77, Kulgaoun, Jalalabad, Baizid, Chittagong.', '3rd Floor', 'A/3', '5400000.00', '2021-02-05 21:50:33', '2021-02-05 21:50:33'),
(7, 3, 'Maj Md. Humayun Kabir (Retd.)', '01713097937', '695, West Ibrahimpur, Dhaka.', '1st Floor', 'A1+B1', '9100000.00', '2021-02-05 21:52:45', '2021-02-05 21:52:45'),
(8, 3, 'Mohammad Nazmul Kabir', '01766966818', 'House-10 Shahi Mahal, 2nd Floor, Oxizen, Chattragram', '4th Floor', 'A/4', '10500000.00', '2021-02-05 21:54:37', '2021-02-05 21:54:37'),
(9, 3, 'Mohammad Ali Azam', '01989111555', '7/A, Baizid, R/A, Ctg.', '5th Floor', 'A6', '10500000.00', '2021-02-05 21:56:05', '2021-02-05 21:56:05'),
(10, 3, 'Mrs. Kaniz Fatema', '01769102044', 'HQ-10, Infentri Divission, Ramu Cantonment, Chittagong.', '3rd Floor', 'A/3', '11400000.00', '2021-02-05 21:58:36', '2021-02-05 21:58:36'),
(11, 3, 'Shaikh Anwaraul Kabir', '0171223691', 'Chittagong.', '5th Floor', 'A5+B5', '500000.00', '2021-02-05 22:31:12', '2021-02-05 22:31:12'),
(12, 4, 'Afrin Alamgir/Alamgir Hossain', '01769102044', 'HQ#10, Infantry Divssion, Ramu Cantonment.', '2nd Floor', 'A/2', '9000000.00', '2021-02-08 02:53:39', '2021-02-08 02:53:39'),
(13, 4, 'Md. Kamrul Islam', '01711025575', 'Flat-A11, Equity Village, 7 Kathalgong Road, Mirzarpool, Ctg.', '4th Floor', 'A/4', '12402000.00', '2021-02-08 02:55:44', '2021-02-08 02:55:44'),
(14, 4, 'Maj Yeameen Hasan Bhuiyan', '01915862172', 'House#D-26/3, Syabithi Officers Qtr., Chattragram.', '3rd Floor', 'A/3', '11400000.00', '2021-02-08 03:01:32', '2021-02-08 03:01:32'),
(15, 5, 'Khalil Uddin Sharker', '01781334158', 'Kanaihati House, West Dhanmondi, Dhaka', '5th Floor', 'E/5', '1250000.00', '2021-02-08 03:09:10', '2021-02-08 03:09:10'),
(16, 6, 'Md. Farukul islam', '01716719644', 'Vawamara, Thana & District: Sirajgonj, Bangladesh.', '4th Floor', 'A/4', '3700000.00', '2021-02-08 03:27:43', '2021-02-08 03:27:43'),
(17, 8, 'Mr. Omor kabir', '01730000422', 'Rajshahi', '1st Floor', 'A1+B1', '2000879.00', '2021-02-08 04:10:39', '2021-02-08 04:10:39'),
(18, 2, 'Md.Hanif Munshi', 'DL/2010/002', 'Asdfjfgv', 'A-6', 'A-6', '5377000.00', '2021-02-08 21:34:00', '2021-02-08 21:34:00'),
(19, 2, 'Mrs.Johura Yeasmeen', 'DL/2010/004', 'LKHGDTSR', 'B-7', 'B-7', '6221000.00', '2021-02-08 21:35:34', '2021-02-08 21:35:34'),
(20, 2, 'Mrs.Sarwar Jahan', 'DL/2011/007', 'hgsdacf', 'C-3', 'C-3', '4570000.00', '2021-02-08 21:37:55', '2021-02-08 21:37:55'),
(21, 2, 'Shima Banik', 'DL/2010/003', 'KGTDSA', 'A-7', 'A-7', '6100000.00', '2021-02-08 21:43:14', '2021-02-08 21:43:14'),
(22, 2, 'Mr.Nukul Chandra', 'DL/2017/009', 'GDHS', 'C-1', 'C-1', '5150000.00', '2021-02-08 21:50:53', '2021-02-08 21:50:53'),
(23, 2, 'Mr.Miju Ahmed', 'Dl/2013/010', 'lkshfgyer', 'C-2', 'C-2', '4750000.00', '2021-02-08 21:56:48', '2021-02-08 21:56:48'),
(24, 2, 'Syeda Raushon Akter', 'DL/2013/005', 'KGFDSTARE', '0', '0', '75000.00', '2021-02-08 21:57:56', '2021-02-08 21:57:56'),
(25, 2, 'Md.Anwar Hossain', 'DL/2012/008', 'KLGJHDSA', 'C-4', 'C-4', '5020000.00', '2021-02-08 21:59:10', '2021-02-08 21:59:10'),
(26, 2, 'Md.Amzad Hossain', 'DL/2015/009', 'IUTE', 'A-8', 'A-8', '5900000.00', '2021-02-08 22:00:39', '2021-02-08 22:00:39'),
(27, 2, 'Mr.Krishna Das Kundu', 'DL/2015/009', 'asdhjrikiut', '8', 'B-1', '5090000.00', '2021-02-08 22:01:53', '2021-02-08 22:01:53'),
(28, 2, 'Dr.Azizullah M Nuruzzaman', 'DL/2015/010', 'TYRERASDGHIJHIKJGDH', 'B-5', 'B-5', '9500000.00', '2021-02-08 22:03:04', '2021-02-08 22:03:04'),
(29, 2, 'Tapon Kumar Paul', 'DL/2015/011', 'LKASJHDGWE', 'A-5', 'A-5', '6825000.00', '2021-02-08 22:04:01', '2021-02-08 22:04:01'),
(30, 2, 'Ayesha Begum Headyet Ullah', 'Land Owner', 'SKDHFYR', '0', '0', '45000.00', '2021-02-08 22:06:33', '2021-02-08 22:06:33'),
(31, 2, 'Bill Board Sale', 'ASDGR', 'AGDHBYHSR', '0', '0', '116970.00', '2021-02-08 22:07:12', '2021-02-08 22:07:12'),
(32, 2, 'Ayesha Begum, Late. Dr.Zayedul', 'DSFGFHJ', 'ASDGH', 'Flat-A4', 'Flat-A4', '240000.00', '2021-02-08 22:09:36', '2021-02-08 22:09:36'),
(33, 2, 'Farhana Khan', 'SADGRTH', 'SDGTRH', 'Flat-B1', 'Flat-B1', '450000.00', '2021-02-08 22:10:38', '2021-02-08 22:10:38'),
(34, 2, 'Akter Hossain', 'zcbnm', 'zsdfhnjk,', 'C-5', 'C-5', '350000.00', '2021-02-08 22:11:38', '2021-02-08 22:11:38'),
(35, 2, 'Mrs.Monjila Khatun', 'sdagh', 'athyjfteyhdfg', '7B2', '7B2', '6718500.00', '2021-02-08 22:13:13', '2021-02-08 22:13:13'),
(36, 2, 'Ashok Kumar Shah', 'asfdhgjk,k', 'kmfjhngfdzSA', '8B2', '8B2', '5475000.00', '2021-02-08 23:41:43', '2021-02-08 23:41:43'),
(37, 2, 'Tasmiya Hasan Saluba', 'ASFIURFHU', 'ZXV  NSGDFZ', 'A-1', 'A-1', '7000000.00', '2021-02-08 23:42:43', '2021-02-08 23:42:43'),
(38, 2, 'MR.Hasan Jahid', 'sadghjkl;k', 'jmdxxfdgbn', '7B1', '7B1', '2438000.00', '2021-02-08 23:43:42', '2021-02-08 23:43:42'),
(39, 2, 'Mrs.Nurunnahar Zaman', 'DL/2011/005', 'sdgrhjytgw', 'B-5', 'B-5', '100000.00', '2021-02-08 23:49:14', '2021-02-08 23:49:14'),
(40, 7, 'Monir Uddin Monsury', 'CC/2010/001', 'YTCEWDXS', 'C-4', 'A-4', '12110000.00', '2021-02-09 00:23:53', '2021-02-09 00:23:53'),
(41, 7, 'Md.Ayub Alam', 'CC/2011/002', 'gjftwzxyukjh', 'C-2', 'C-2', '5596500.00', '2021-02-09 00:28:08', '2021-02-09 00:32:26'),
(42, 7, 'Shima Khisha', 'CC/2011/004', 'jhycgsdexfc', 'D-2', 'D-2', '6236510.00', '2021-02-09 00:32:06', '2021-02-09 00:32:06'),
(43, 7, 'Mr.Amzad Hossain', 'CC/2013/005', 'KHJGFSXDVBHNJM', 'B-4', 'B-4', '13607500.00', '2021-02-09 00:38:02', '2021-02-09 00:38:02'),
(44, 7, 'LT. Col Mohammad Ali Choudhury', 'CC/2011/004', 'KJHGDSCVBNM', '0', '0', '7494500.00', '2021-02-09 00:40:59', '2021-02-09 00:40:59'),
(45, 7, 'Shamim Noman', 'CC/2010/000', 'KNJHYTGSXDCGVHBN', '0', '0', '200000.00', '2021-02-09 00:52:31', '2021-02-09 00:52:31'),
(46, 7, 'Mr.Khalida', 'CC/2010/008', 'ASFSDG', '0', '0', '7948100.00', '2021-02-09 01:00:05', '2021-02-09 01:00:05'),
(47, 7, 'Mrs.Lubaba Chowdhury', 'agfghsah', 'dvdfgfdh', '0', '0', '100000.00', '2021-02-09 01:05:29', '2021-02-09 01:05:29'),
(48, 7, 'Mr.Mujib (Mubinul Islam & Zaheda)', 'CC/2017/009', 'DMFYSAE', 'D-3', 'C-3', '7179083.00', '2021-02-09 01:07:23', '2021-02-09 02:51:19'),
(49, 7, 'Utility Money Collection for All Client', 'mjdccvbnm,', 'kncesd bmn,', '0', '0', '515000.00', '2021-02-09 01:11:34', '2021-02-09 01:11:34'),
(50, 5, 'Farzana Taher Shurovi', '01711695071', 'Taltala, Mirpur, Dhaka.', '4th Floor', 'D/4', '6600000.00', '2021-02-10 03:12:21', '2021-02-10 03:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `client_payments`
--

CREATE TABLE `client_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_payments`
--

INSERT INTO `client_payments` (`id`, `client_id`, `bank_id`, `check_no`, `date`, `amount`, `payment_method`, `check_file`, `note`, `created_at`, `updated_at`) VALUES
(2, 2, 2, NULL, '2021-02-02', '100000.00', 'check', NULL, NULL, '2021-02-03 22:11:26', '2021-02-03 22:11:26'),
(3, 3, 0, NULL, '2020-02-29', '2950000.00', 'open', NULL, 'Opening Balance up to 29th February-2021', '2021-02-05 22:00:40', '2021-02-05 22:00:40'),
(4, 4, 0, NULL, '2020-02-29', '5000000.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:02:35', '2021-02-05 22:02:35'),
(5, 5, 0, NULL, '2020-02-29', '100000.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:03:22', '2021-02-05 22:03:22'),
(6, 6, 0, NULL, '2020-02-29', '500000.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:04:11', '2021-02-05 22:04:11'),
(7, 7, 0, NULL, '2020-02-29', '7700000.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:05:02', '2021-02-05 22:17:22'),
(8, 8, 0, NULL, '2020-02-29', '2750000.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:06:08', '2021-02-05 22:06:08'),
(9, 9, 0, NULL, '2020-02-29', '500000.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:07:07', '2021-02-05 22:07:07'),
(10, 10, 0, NULL, '2020-02-29', '6300000.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:07:50', '2021-02-05 22:18:01'),
(11, 7, 5, NULL, '2020-03-16', '450000.00', 'check', NULL, 'Installment', '2021-02-05 22:24:22', '2021-02-05 22:24:22'),
(12, 8, 5, NULL, '2020-03-16', '950000.00', 'check', NULL, 'Installment', '2021-02-05 22:25:55', '2021-02-05 22:25:55'),
(13, 10, 5, NULL, '2020-03-03', '600000.00', 'check', NULL, 'Installment', '2021-02-05 22:27:46', '2021-02-05 22:27:46'),
(14, 11, 3, NULL, '2020-03-11', '500000.00', 'check', NULL, 'Booking Money', '2021-02-05 22:32:59', '2021-02-05 22:32:59'),
(17, 11, 5, NULL, '2020-12-10', '100000.00', 'refund', NULL, 'Refund to Sk Anwarul Kabir', '2021-02-06 05:47:23', '2021-02-06 05:47:23'),
(18, 11, 5, NULL, '2020-12-20', '100000.00', 'refund', NULL, 'Refund to De. Anwarul Ksbir for Flat Cencel', '2021-02-07 23:42:57', '2021-02-07 23:42:57'),
(19, 13, 0, NULL, '2020-02-29', '11700000.00', 'open', NULL, 'Opening Balance up to February-2020.', '2021-02-08 02:57:11', '2021-02-08 02:57:11'),
(20, 12, 0, NULL, '2020-02-29', '7000000.00', 'open', NULL, 'Opening Balance up to Feb-2020.', '2021-02-08 02:58:22', '2021-02-08 02:58:22'),
(21, 14, 0, NULL, '2020-02-29', '11115000.00', 'open', NULL, 'Opening Balance up to Feb-2020.', '2021-02-08 03:02:39', '2021-02-08 03:02:39'),
(22, 15, 0, NULL, '2020-02-29', '1150000.00', 'open', NULL, 'Opening Balance up to Feb-2020.', '2021-02-08 03:10:04', '2021-02-08 03:10:04'),
(23, 15, 5, NULL, '2020-03-10', '100000.00', 'check', NULL, 'Cash Deposit to ac 50000+50000', '2021-02-08 03:11:42', '2021-02-08 03:11:42'),
(24, 16, 5, NULL, '2020-03-16', '500000.00', 'check', NULL, 'Booking Money for A4, 4th Floor', '2021-02-08 03:29:19', '2021-02-08 03:29:19'),
(25, 17, 0, NULL, '2020-02-29', '2000879.00', 'open', NULL, 'Opening balance up to Feb-2020', '2021-02-08 04:11:44', '2021-02-08 04:11:44'),
(26, 18, 0, NULL, '2020-02-28', '5377000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 01:21:12', '2021-02-09 01:21:12'),
(27, 19, 0, NULL, '2020-02-28', '6221000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 01:24:15', '2021-02-09 01:24:15'),
(28, 20, 0, NULL, '2020-02-28', '4570000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 01:26:13', '2021-02-09 01:26:13'),
(29, 21, 0, NULL, '2020-02-28', '6100000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 01:27:22', '2021-02-09 01:27:22'),
(30, 22, 0, NULL, '2020-02-28', '5150000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 01:28:23', '2021-02-09 01:28:23'),
(31, 23, 0, NULL, '2020-02-28', '4750000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:26:10', '2021-02-09 02:26:10'),
(32, 24, 0, NULL, '2020-02-28', '75000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:27:04', '2021-02-09 02:27:04'),
(33, 25, 0, NULL, '2020-02-28', '5020000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:28:11', '2021-02-09 02:28:11'),
(34, 26, 0, NULL, '2020-02-28', '5900000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:29:43', '2021-02-09 02:29:43'),
(35, 27, 0, NULL, '2020-02-28', '5090000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:30:27', '2021-02-09 02:30:27'),
(36, 28, 0, NULL, '2020-02-28', '9500000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:31:26', '2021-02-09 02:31:26'),
(37, 29, 0, NULL, '2020-02-28', '6825000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:32:04', '2021-02-09 02:32:04'),
(38, 30, 0, NULL, '2020-02-28', '45000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:32:52', '2021-02-09 02:32:52'),
(39, 31, 0, NULL, '2020-02-28', '116970.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:33:43', '2021-02-09 02:33:43'),
(40, 32, 0, NULL, '2020-02-28', '240000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:34:35', '2021-02-09 02:34:35'),
(41, 33, 0, NULL, '2020-02-28', '450000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:35:29', '2021-02-09 02:35:29'),
(42, 34, 0, NULL, '2020-02-28', '350000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:38:34', '2021-02-09 02:38:34'),
(43, 35, 0, NULL, '2020-02-28', '6718500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:39:53', '2021-02-09 02:39:53'),
(44, 36, 0, NULL, '2020-02-28', '5475000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:40:40', '2021-02-09 02:40:40'),
(45, 37, 0, NULL, '2020-02-28', '7000000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:41:43', '2021-02-09 02:41:43'),
(46, 38, 0, NULL, '2020-02-28', '2438000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:42:32', '2021-02-09 02:42:32'),
(47, 39, 0, NULL, '2020-02-28', '100000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:43:05', '2021-02-09 02:43:05'),
(48, 40, 0, NULL, '2020-02-28', '12110000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:44:17', '2021-02-09 02:44:17'),
(49, 41, 0, NULL, '2020-02-28', '5596500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:44:56', '2021-02-09 02:44:56'),
(50, 42, 0, NULL, '2020-02-28', '6236510.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:45:34', '2021-02-09 02:45:34'),
(51, 43, 0, NULL, '2020-02-28', '13607500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:46:25', '2021-02-09 02:46:25'),
(52, 44, 0, NULL, '2020-02-28', '7494500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:47:26', '2021-02-09 02:47:26'),
(53, 45, 0, NULL, '2020-02-28', '200000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:48:12', '2021-02-09 02:48:12'),
(54, 46, 0, NULL, '2020-02-28', '7948100.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:48:59', '2021-02-09 02:48:59'),
(55, 47, 0, NULL, '2020-02-28', '100000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:50:23', '2021-02-09 02:50:23'),
(56, 48, 0, NULL, '2020-02-28', '7179083.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:51:05', '2021-02-09 02:51:05'),
(57, 49, 0, NULL, '2020-02-28', '515000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-09 02:51:36', '2021-02-09 02:51:36'),
(58, 50, 0, NULL, '2020-02-29', '3000000.00', 'open', NULL, 'Opening Balance from February\'2020', '2021-02-10 03:13:54', '2021-02-10 03:13:54'),
(59, 3, 1, 'sss2', '2021-03-03', '12000.00', 'check', NULL, NULL, '2021-03-04 15:26:40', '2021-03-04 15:26:40'),
(60, 3, 0, NULL, '2021-03-11', '12000.00', 'cash', NULL, NULL, '2021-03-04 15:26:59', '2021-03-04 15:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depositers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `bank_id`, `checkno`, `date`, `branch_name`, `check_image`, `depositers_name`, `amount`, `created_at`, `updated_at`) VALUES
(2, '1', '7652', '2020-11-17', 'Mohammadpur', NULL, 'A', '100000.00', '2021-02-25 02:18:49', '2021-02-25 02:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invest_adds`
--

CREATE TABLE `invest_adds` (
  `id` int(10) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invest_adds`
--

INSERT INTO `invest_adds` (`id`, `investor_id`, `bank_id`, `check_no`, `date`, `amount`, `payment_method`, `note`, `created_at`, `updated_at`) VALUES
(4, 1, 0, NULL, '2021-02-02', '120000.00', 'open', NULL, '2021-02-24 01:45:01', '2021-02-24 01:45:01'),
(5, 1, 1, '345', '2021-02-02', '100000.00', 'check', NULL, '2021-02-24 01:45:43', '2021-02-24 01:45:43'),
(6, 2, 0, NULL, '2021-02-10', '10000.00', 'open', NULL, '2021-02-24 02:04:04', '2021-02-24 02:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `invest_expenses`
--

CREATE TABLE `invest_expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invest_expenses`
--

INSERT INTO `invest_expenses` (`id`, `investor_id`, `bank_id`, `check_no`, `date`, `amount`, `payment_method`, `note`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '65743', '2021-02-17', '100000.00', 'check', NULL, '2021-02-24 01:46:20', '2021-02-24 01:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `invest_money`
--

CREATE TABLE `invest_money` (
  `id` int(10) UNSIGNED NOT NULL,
  `purpose_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invest_money`
--

INSERT INTO `invest_money` (`id`, `purpose_name`, `date`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'MD', '2020-01-30', '0.00', '2021-02-23 13:59:30', '2021-02-23 13:59:40'),
(2, 'Md yyy', '2021-02-03', '0.00', '2021-02-24 02:03:36', '2021-02-24 02:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `items_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `items_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Project Procurement Cost', '2021-01-24 15:40:07', '2021-01-24 15:40:07'),
(2, 1, 'Business Development', '2021-01-24 15:40:17', '2021-01-24 15:40:17'),
(3, 1, 'Legal & Papers Expenses', '2021-01-24 15:40:25', '2021-01-24 15:40:25'),
(4, 1, 'Rajuk approval exp.', '2021-01-24 15:40:49', '2021-01-24 15:40:49'),
(5, 1, 'Brochure', '2021-01-24 15:41:00', '2021-01-24 15:41:00'),
(6, 1, 'Advertisement, Name Plate', '2021-01-24 15:41:08', '2021-01-24 15:41:08'),
(7, 1, 'Quality control & Testing', '2021-01-24 15:41:18', '2021-01-24 15:41:18'),
(8, 2, 'Steel, Angels', '2021-01-24 15:41:28', '2021-01-24 15:41:28'),
(11, 2, 'Cement', '2021-02-01 05:30:52', '2021-02-01 05:30:52'),
(12, 2, 'Bricks, Ceramic Bricks', '2021-02-01 05:31:45', '2021-02-01 05:32:09'),
(13, 2, 'Stone', '2021-02-01 05:32:23', '2021-02-01 05:32:23'),
(14, 2, 'Sand', '2021-02-01 05:32:33', '2021-02-01 05:32:33'),
(15, 3, 'Civil Contractor', '2021-02-04 05:08:22', '2021-02-04 05:08:22'),
(16, 1, 'Plan,Drawing & Design Exp', '2021-02-05 21:29:12', '2021-02-05 21:29:12'),
(17, 2, 'Sanitary', '2021-02-05 21:44:59', '2021-02-05 21:44:59'),
(18, 2, 'Electrical', '2021-02-05 21:45:25', '2021-02-05 21:45:25'),
(19, 2, 'Grill, Rails, M. Gate', '2021-02-05 21:48:48', '2021-02-05 21:48:48'),
(20, 2, 'Tiles & Mosaic', '2021-02-05 21:49:20', '2021-02-05 21:49:20'),
(21, 2, 'Thai, Glass & Mosquito net', '2021-02-05 21:50:00', '2021-02-05 21:50:00'),
(22, 2, 'Door', '2021-02-05 21:50:15', '2021-02-05 21:50:15'),
(23, 2, 'Paint', '2021-02-05 21:50:30', '2021-02-05 21:50:30'),
(24, 2, 'Shutter Materials (Bamboo,Angels,Cl Sheet)', '2021-02-05 21:51:30', '2021-02-05 21:51:30'),
(25, 2, 'Miscellaneous/Civil Materials/Safely', '2021-02-05 21:52:22', '2021-02-05 21:52:22'),
(26, 2, 'Lift, Generator', '2021-02-05 21:52:47', '2021-02-05 21:52:47'),
(27, 3, 'Pile Contractor', '2021-02-05 21:55:49', '2021-02-05 21:55:49'),
(28, 3, 'Others Labor', '2021-02-05 21:56:16', '2021-02-05 21:56:16'),
(29, 3, 'Electrical', '2021-02-05 21:56:34', '2021-02-05 21:56:34'),
(30, 3, 'Sanitary', '2021-02-05 21:56:48', '2021-02-05 21:56:48'),
(31, 3, 'Tiles', '2021-02-05 21:57:12', '2021-02-05 21:57:12'),
(32, 3, 'Paint', '2021-02-05 21:57:26', '2021-02-05 21:57:26'),
(33, 3, 'Door', '2021-02-05 21:57:40', '2021-02-05 21:57:40'),
(34, 3, 'Grill, Rails,Thai', '2021-02-05 21:58:05', '2021-02-05 21:58:05'),
(36, 3, 'Retrofitting Works', '2021-02-05 22:06:17', '2021-02-05 22:38:19'),
(37, 1, 'Preliminary Exp. (fancying, Sign Board)', '2021-02-05 22:41:28', '2021-02-05 22:41:28'),
(38, 1, 'Assets (Crockeries, Furniture & Fixture).', '2021-02-05 22:42:33', '2021-02-05 22:42:33'),
(42, 1, 'Safety & Security Exp.', '2021-02-05 22:45:05', '2021-02-05 22:45:05'),
(43, 1, 'Staff Salary', '2021-02-05 22:45:37', '2021-02-05 22:45:37'),
(44, 1, 'Director Honorium', '2021-02-05 22:46:11', '2021-02-05 22:46:11'),
(45, 1, 'Conveyance', '2021-02-05 22:46:29', '2021-02-05 22:46:29'),
(46, 1, 'Gas, Oil & Car Expenses.', '2021-02-05 22:47:05', '2021-02-05 22:47:05'),
(47, 1, 'Entertainment & Accommodation', '2021-02-05 22:47:36', '2021-02-05 22:47:36'),
(48, 1, 'Bank Charges', '2021-02-05 22:47:54', '2021-02-05 22:47:54'),
(49, 1, 'Utility Bill (gas, Elec, Wasa & Others).', '2021-02-05 22:48:29', '2021-02-05 22:48:29'),
(50, 1, 'Misc. Cost, Tips & Others', '2021-02-05 22:49:13', '2021-02-05 22:49:13'),
(51, 1, 'Donations', '2021-02-05 22:49:30', '2021-02-05 22:49:30'),
(52, 1, 'Flat Purchase.', '2021-02-05 22:49:54', '2021-02-05 22:49:54'),
(54, 6, 'Site Expense,Maintenance', '2021-02-05 23:19:23', '2021-02-06 00:48:48'),
(55, 6, 'Telephone,Mobile,Internet,Dish Bill', '2021-02-05 23:20:12', '2021-02-06 00:49:06'),
(56, 6, 'Stationary,Printing & Courier', '2021-02-05 23:21:00', '2021-02-06 00:49:26'),
(57, 5, 'Head Office Overhead', '2021-02-05 23:21:25', '2021-02-05 23:21:25'),
(58, 1, 'Beta Constructor(7th Floor)', '2021-02-06 00:48:59', '2021-02-06 00:48:59'),
(59, 1, 'Expenditure of Close Project', '2021-02-06 21:25:20', '2021-02-06 21:25:20'),
(60, 1, 'Loan Refund (Interest)', '2021-02-06 21:27:02', '2021-02-06 21:27:02');

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
(4, '2020_12_03_055210_create_permission_tables', 1),
(5, '2020_12_08_080503_create_admins_table', 1),
(6, '2020_12_09_195010_create_projects_table', 1),
(8, '2020_12_26_191157_create_categories_table', 1),
(9, '2021_01_16_201907_create_clients_table', 1),
(12, '2021_01_19_185527_create_banks_table', 1),
(15, '2021_01_20_214647_create_items_table', 1),
(16, '2021_01_22_083631_create_cashes_table', 1),
(18, '2021_01_29_204057_create_openbanks_table', 3),
(19, '2021_01_19_200205_create_widraws_table', 4),
(20, '2021_01_19_200444_create_deposits_table', 5),
(21, '2021_01_29_224532_create_cashopens_table', 6),
(22, '2021_01_19_090035_create_project_payments_table', 7),
(23, '2021_01_17_203953_create_client_payments_table', 8),
(25, '2021_02_03_120559_create_others_expenditures_table', 10),
(26, '2021_02_03_112057_create_others_table', 11),
(27, '2021_02_07_185634_create_invest_adds_table', 12),
(28, '2021_02_07_184846_create_invest_expenses_table', 13),
(29, '2021_02_07_215903_create_other_loan_expenses_table', 14),
(30, '2021_02_07_215931_create_other_loan_adds_table', 15),
(31, '2021_03_04_160644_create_professionals_table', 16),
(34, '2020_12_26_110823_create_visitors_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `openbanks`
--

CREATE TABLE `openbanks` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `ac_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` int(10) UNSIGNED NOT NULL,
  `purpose_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `others_expenditures`
--

CREATE TABLE `others_expenditures` (
  `id` int(10) UNSIGNED NOT NULL,
  `purpose_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_loans`
--

CREATE TABLE `other_loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `purpose_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_loans`
--

INSERT INTO `other_loans` (`id`, `purpose_name`, `date`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'ED', '2021-02-10', '0.00', '2021-02-23 14:06:37', '2021-02-24 01:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `other_loan_adds`
--

CREATE TABLE `other_loan_adds` (
  `id` int(10) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_loan_adds`
--

INSERT INTO `other_loan_adds` (`id`, `investor_id`, `bank_id`, `check_no`, `date`, `amount`, `payment_method`, `note`, `created_at`, `updated_at`) VALUES
(3, 1, 0, NULL, '2021-02-03', '100000.00', 'cash', NULL, '2021-02-24 01:49:00', '2021-02-24 01:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `other_loan_expenses`
--

CREATE TABLE `other_loan_expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'Dashboard', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(2, 'blog.create', 'admin', 'Blog', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(3, 'blog.view', 'admin', 'Blog', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(4, 'blog.edit', 'admin', 'Blog', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(5, 'blog.delete', 'admin', 'Blog', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(6, 'blog.approve', 'admin', 'Blog', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(7, 'admin.create', 'admin', 'Admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(8, 'admin.view', 'admin', 'Admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(9, 'admin.edit', 'admin', 'Admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(10, 'admin.delete', 'admin', 'Admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(11, 'admin.approve', 'admin', 'Admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(12, 'role.create', 'admin', 'Role', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(13, 'role.view', 'admin', 'Role', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(14, 'role.edit', 'admin', 'Role', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(15, 'role.delete', 'admin', 'Role', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(16, 'role.approve', 'admin', 'Role', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(17, 'profile.view', 'admin', 'Profile', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(18, 'profile.edit', 'admin', 'Profile', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(19, 'project.create', 'admin', 'Project', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(20, 'project.view', 'admin', 'Project', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(21, 'project.edit', 'admin', 'Project', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(22, 'project.delete', 'admin', 'Project', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(23, 'visitor.create', 'admin', 'Visitors', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(24, 'visitor.view', 'admin', 'Visitors', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(25, 'visitor.edit', 'admin', 'Visitors', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(26, 'visitor.delete', 'admin', 'Visitors', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(27, 'category.create', 'admin', 'Categories', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(28, 'category.view', 'admin', 'Categories', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(29, 'category.edit', 'admin', 'Categories', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(30, 'category.delete', 'admin', 'Categories', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(31, 'item-particular.create', 'admin', 'Item Particular', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(32, 'item-particular.view', 'admin', 'Item Particular', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(33, 'item-particular.edit', 'admin', 'Item Particular', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(34, 'item-particular.delete', 'admin', 'Item Particular', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(35, 'client.create', 'admin', 'Client', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(36, 'client.view', 'admin', 'Client', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(37, 'client.edit', 'admin', 'Client', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(38, 'client.delete', 'admin', 'Client', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(39, 'bank.create', 'admin', 'Bank', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(40, 'bank.view', 'admin', 'Bank', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(41, 'bank.edit', 'admin', 'Bank', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(42, 'bank.delete', 'admin', 'Bank', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(43, 'withdraw.create', 'admin', 'Bank withdraw', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(44, 'withdraw.view', 'admin', 'Bank withdraw', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(45, 'withdraw.edit', 'admin', 'Bank withdraw', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(46, 'withdraw.delete', 'admin', 'Bank withdraw', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(47, 'deposit.create', 'admin', 'Bank Deposit', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(48, 'deposit.view', 'admin', 'Bank Deposit', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(49, 'deposit.edit', 'admin', 'Bank Deposit', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(50, 'deposit.delete', 'admin', 'Bank Deposit', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(51, 'cash.create', 'admin', 'Cash Opening', '2021-01-24 14:48:39', '2021-01-24 14:48:39'),
(52, 'cash.view', 'admin', 'Cash Opening', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(53, 'cash.edit', 'admin', 'Cash Opening', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(54, 'cash.delete', 'admin', 'Cash Opening', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(55, 'project-wise-client-report.view', 'admin', 'Report', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(56, 'visistor-report.view', 'admin', 'Report', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(57, 'monthly-collection-statement.view', 'admin', 'Report', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(58, 'project-balance-sheet.view', 'admin', 'Report', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(59, 'expenditure-summery-sheet.view', 'admin', 'Report', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(60, 'cash-report.view', 'admin', 'Report', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(61, 'final-balance-sheet.view', 'admin', 'Report', '2021-01-24 14:48:40', '2021-01-24 14:48:40'),
(62, 'profit-loss-report.view', 'admin', 'Report', '2021-01-24 14:48:40', '2021-01-24 14:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `id` int(10) UNSIGNED NOT NULL,
  `profession_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professionals`
--

INSERT INTO `professionals` (`id`, `profession_name`, `created_at`, `updated_at`) VALUES
(2, 'Engineering', '2021-03-04 10:57:12', '2021-03-04 17:06:18'),
(3, 'sadasf', '2021-03-04 11:29:02', '2021-03-04 11:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `project_address`, `date`, `created_at`, `updated_at`) VALUES
(2, 'Theme Lobelia', 'Dhaka', '2021-01-25', '2021-01-24 15:32:41', '2021-01-24 15:32:41'),
(3, 'Theme Mahtab', 'Dhaka', '2021-01-25', '2021-01-24 15:32:52', '2021-01-24 15:32:52'),
(4, 'Theme Meadows', 'Dhaka', '2021-01-25', '2021-01-24 15:33:03', '2021-01-24 15:33:03'),
(5, 'Theme Peradise', 'Dhaka', '2021-01-25', '2021-01-24 15:33:15', '2021-01-24 15:33:15'),
(6, 'Theme Mukti Villa', 'Mirpur, Dhaka', '2017-01-06', '2021-02-06 00:14:27', '2021-02-06 00:14:27'),
(7, 'Theme Cosanova', 'Chittagong', '2012-01-06', '2021-02-06 00:16:08', '2021-02-06 00:16:08'),
(8, 'Theme Castle', 'Rajshahi', '2020-01-01', '2021-02-08 03:52:21', '2021-02-08 03:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `project_payments`
--

CREATE TABLE `project_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_payments`
--

INSERT INTO `project_payments` (`id`, `project_id`, `category_id`, `bank_id`, `check_no`, `item_name`, `date`, `amount`, `payment_method`, `check_file`, `note`, `created_at`, `updated_at`) VALUES
(14, 3, 1, 0, NULL, 1, '2020-02-28', '1388592.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:24:24', '2021-02-05 21:24:24'),
(15, 3, 1, 0, NULL, 3, '2020-02-28', '21012.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:25:24', '2021-02-05 21:25:24'),
(16, 3, 1, 0, NULL, 16, '2020-02-28', '196000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:30:21', '2021-02-05 21:30:21'),
(17, 3, 1, 0, NULL, 4, '2020-02-28', '254635.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:31:17', '2021-02-05 21:31:17'),
(18, 3, 1, 0, NULL, 5, '2020-02-28', '31000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:32:14', '2021-02-05 21:32:14'),
(19, 3, 1, 0, NULL, 6, '2020-02-28', '15365.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:33:05', '2021-02-05 21:33:05'),
(20, 3, 1, 0, NULL, 7, '2020-02-28', '17000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:33:50', '2021-02-05 21:33:50'),
(21, 3, 2, 0, NULL, 8, '2020-02-28', '3762170.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:35:09', '2021-02-05 21:35:09'),
(22, 3, 2, 0, NULL, 11, '2020-02-28', '1199410.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:36:07', '2021-02-05 21:36:07'),
(23, 3, 2, 0, NULL, 12, '2020-02-28', '1381100.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:37:02', '2021-02-05 21:37:02'),
(24, 3, 2, 0, NULL, 13, '2020-02-28', '1106146.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:40:11', '2021-02-05 21:40:11'),
(25, 3, 2, 0, NULL, 14, '2020-02-28', '354523.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:41:37', '2021-02-05 21:41:37'),
(26, 3, 2, 0, NULL, 17, '2020-02-28', '2270.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:46:45', '2021-02-05 21:46:45'),
(27, 3, 2, 0, NULL, 18, '2020-02-28', '40234.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:47:40', '2021-02-05 21:47:40'),
(28, 3, 2, 0, NULL, 23, '2020-02-28', '1480.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:54:17', '2021-02-05 21:54:17'),
(29, 3, 2, 0, NULL, 25, '2020-02-29', '10620.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 21:55:11', '2021-02-05 21:55:11'),
(30, 3, 3, 0, NULL, 27, '2020-02-28', '208000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:01:16', '2021-02-05 22:01:16'),
(31, 3, 3, 0, NULL, 15, '2020-02-28', '1443281.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:02:09', '2021-02-05 22:02:09'),
(32, 3, 3, 0, NULL, 28, '2020-02-28', '18200.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:04:52', '2021-02-05 22:04:52'),
(33, 3, 3, 0, NULL, 29, '2020-02-28', '5400.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:05:37', '2021-02-05 22:05:37'),
(34, 4, 1, 0, NULL, 1, '2020-02-28', '1500000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:41:16', '2021-02-05 22:41:16'),
(35, 4, 1, 0, NULL, 2, '2020-02-28', '55000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:42:04', '2021-02-05 22:42:04'),
(36, 4, 1, 0, NULL, 3, '2020-02-28', '11890.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:42:53', '2021-02-05 22:42:53'),
(37, 4, 1, 0, NULL, 16, '2020-02-28', '483856.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:43:44', '2021-02-05 22:43:44'),
(38, 4, 1, 0, NULL, 4, '2020-02-28', '79000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:44:43', '2021-02-05 22:44:43'),
(39, 4, 1, 0, NULL, 5, '2020-02-28', '31000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:45:33', '2021-02-05 22:45:33'),
(40, 4, 1, 0, NULL, 6, '2020-02-28', '113930.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:46:25', '2021-02-05 22:46:25'),
(41, 4, 1, 0, NULL, 7, '2020-02-28', '18000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:47:30', '2021-02-05 22:47:30'),
(42, 4, 2, 0, NULL, 8, '2020-02-28', '5065304.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:48:52', '2021-02-05 22:48:52'),
(43, 4, 2, 0, NULL, 11, '2020-02-28', '1071310.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:49:46', '2021-02-05 22:49:46'),
(44, 4, 2, 0, NULL, 12, '2020-02-28', '1769780.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:50:35', '2021-02-05 22:50:35'),
(45, 3, 1, 0, NULL, 37, '2020-02-29', '13550.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:51:43', '2021-02-05 22:51:43'),
(46, 4, 2, 0, NULL, 13, '2020-02-28', '1487793.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:51:50', '2021-02-05 22:51:50'),
(47, 4, 2, 0, NULL, 14, '2020-02-28', '363840.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:52:59', '2021-02-05 22:52:59'),
(48, 3, 6, 0, NULL, 54, '2020-02-29', '15195.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:53:09', '2021-02-06 00:46:59'),
(49, 4, 2, 0, NULL, 17, '2020-02-28', '90819.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:53:49', '2021-02-05 22:53:49'),
(50, 3, 6, 0, NULL, 56, '2020-02-29', '15136.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:54:23', '2021-02-06 00:47:46'),
(51, 4, 2, 0, NULL, 18, '2020-02-28', '83176.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:54:42', '2021-02-05 22:54:42'),
(52, 3, 1, 0, NULL, 43, '2020-02-29', '196826.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:55:16', '2021-02-05 22:55:16'),
(53, 4, 2, 0, NULL, 20, '2020-02-28', '8867.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:55:36', '2021-02-05 22:55:36'),
(54, 3, 1, 0, NULL, 45, '2020-02-29', '67475.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:55:53', '2021-02-05 22:55:53'),
(55, 3, 1, 0, NULL, 47, '2020-02-29', '75147.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:56:34', '2021-02-05 22:56:34'),
(56, 4, 2, 0, NULL, 21, '2020-02-28', '12000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:56:40', '2021-02-05 22:56:40'),
(57, 3, 1, 0, NULL, 48, '2020-02-29', '461.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:57:11', '2021-02-05 22:57:11'),
(58, 4, 2, 0, NULL, 22, '2020-02-28', '33731.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:57:37', '2021-02-05 22:57:37'),
(59, 3, 1, 0, NULL, 49, '2020-02-29', '211223.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:57:55', '2021-02-05 22:57:55'),
(60, 4, 2, 0, NULL, 23, '2020-02-28', '3450.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:58:22', '2021-02-05 22:58:22'),
(61, 3, 1, 0, NULL, 50, '2020-02-29', '72500.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:58:35', '2021-02-05 22:58:35'),
(62, 3, 1, 0, NULL, 52, '2020-02-29', '3200000.00', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 22:59:14', '2021-02-05 22:59:14'),
(63, 4, 2, 0, NULL, 25, '2020-02-28', '29795.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 22:59:14', '2021-02-05 22:59:14'),
(64, 4, 3, 0, NULL, 15, '2020-02-28', '1872817.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:00:09', '2021-02-05 23:00:09'),
(65, 4, 3, 0, NULL, 27, '2020-02-28', '362500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:01:05', '2021-02-05 23:01:05'),
(66, 3, 1, 0, NULL, 57, '2020-02-29', '2529603.29', 'open', NULL, 'Opening Balance form 29th Feberuary\'2020.', '2021-02-05 23:01:06', '2021-02-06 00:51:34'),
(67, 4, 3, 0, NULL, 28, '2020-02-28', '82950.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:01:54', '2021-02-05 23:01:54'),
(68, 4, 3, 0, NULL, 29, '2020-02-28', '25000.00', 'open', NULL, 'Opening Balance form Feb-2020', '2021-02-05 23:02:56', '2021-02-05 23:02:56'),
(69, 4, 3, 0, NULL, 30, '2020-02-28', '61000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:03:48', '2021-02-05 23:03:48'),
(70, 4, 3, 0, NULL, 31, '2020-02-28', '2816.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:04:49', '2021-02-05 23:04:49'),
(71, 4, 3, 0, NULL, 32, '2020-02-28', '6500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:05:56', '2021-02-05 23:05:56'),
(72, 4, 3, 0, NULL, 33, '2020-02-28', '800.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:06:57', '2021-02-05 23:06:57'),
(73, 4, 1, 0, NULL, 37, '2020-02-28', '21750.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:07:45', '2021-02-05 23:07:45'),
(74, 4, 4, 0, NULL, 54, '2020-02-28', '40778.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:08:51', '2021-02-06 00:02:19'),
(75, 4, 4, 0, NULL, 55, '2020-02-28', '26421.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:09:45', '2021-02-06 00:02:40'),
(76, 4, 4, 0, NULL, 56, '2020-02-28', '94868.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:10:33', '2021-02-06 00:03:01'),
(77, 4, 1, 0, NULL, 43, '2020-02-28', '1723592.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:12:10', '2021-02-05 23:12:10'),
(78, 4, 1, 0, NULL, 45, '2020-02-28', '335036.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:13:01', '2021-02-05 23:13:01'),
(79, 4, 1, 0, NULL, 46, '2020-02-28', '300.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:13:49', '2021-02-05 23:13:49'),
(80, 4, 1, 0, NULL, 47, '2020-02-28', '506244.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:14:59', '2021-02-05 23:14:59'),
(81, 4, 1, 0, NULL, 48, '2020-02-28', '13857.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:15:49', '2021-02-05 23:15:49'),
(82, 4, 1, 0, NULL, 49, '2020-02-28', '86201.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:16:42', '2021-02-05 23:16:42'),
(83, 4, 1, 0, NULL, 50, '2020-02-28', '96000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:17:35', '2021-02-05 23:17:35'),
(84, 3, 1, 0, NULL, 4, '2020-03-15', '20000.00', 'cash', NULL, 'Paid to Engr. Saiful', '2021-02-05 23:18:44', '2021-02-05 23:18:44'),
(85, 3, 2, 5, NULL, 11, '2020-03-08', '105300.00', 'check', NULL, 'Mir Cement for 260 Bag Cement', '2021-02-05 23:21:30', '2021-02-05 23:21:30'),
(86, 3, 3, 5, NULL, 15, '2020-03-02', '20800.00', 'check', NULL, 'Paid to Md. Ibahim Khali for SC#07', '2021-02-05 23:23:54', '2021-02-05 23:23:54'),
(87, 3, 3, 5, NULL, 15, '2020-03-08', '25600.00', 'check', NULL, 'Paid to Md. Ibrahim for SC#07, BW#03, BW#02', '2021-02-05 23:25:01', '2021-02-05 23:25:42'),
(88, 3, 3, 5, NULL, 15, '2020-03-15', '26800.00', 'check', NULL, 'Paid to Md. Ibrahim for Civil Works BW#02, SC#07', '2021-02-05 23:26:58', '2021-02-05 23:26:58'),
(89, 3, 3, 5, NULL, 15, '2020-03-22', '18800.00', 'check', NULL, 'Paid to MD. Ibrahim Khali for SC#07, BW#02', '2021-02-05 23:29:37', '2021-02-05 23:29:37'),
(90, 3, 3, 0, NULL, 28, '2020-03-13', '1000.00', 'cash', NULL, 'Retrofitting Works of Clm for Cant Board', '2021-02-05 23:32:03', '2021-02-05 23:32:03'),
(91, 3, 6, 0, NULL, 56, '2020-03-20', '875.00', 'cash', NULL, 'Photocopy and Courier', '2021-02-05 23:33:13', '2021-02-06 00:50:52'),
(92, 3, 1, 5, NULL, 43, '2020-03-16', '75000.00', 'check', NULL, 'Salary and Bonus of ED', '2021-02-05 23:35:44', '2021-02-05 23:35:44'),
(93, 3, 1, 0, NULL, 43, '2020-03-20', '128750.00', 'cash', NULL, 'Salary and Bonus of ED+Site', '2021-02-05 23:36:45', '2021-02-05 23:36:45'),
(94, 3, 1, 0, NULL, 45, '2020-03-15', '3879.00', 'cash', NULL, 'Conveyance of Ed', '2021-02-05 23:37:45', '2021-02-05 23:37:45'),
(95, 3, 1, 0, NULL, 47, '2020-03-29', '28369.00', 'cash', NULL, 'site Entertainment', '2021-02-05 23:38:41', '2021-02-05 23:38:41'),
(99, 4, 5, 0, NULL, 57, '2020-02-28', '3827651.05', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-05 23:55:34', '2021-02-05 23:55:34'),
(100, 7, 1, 0, NULL, 1, '2020-02-28', '608000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:17:33', '2021-02-06 00:17:33'),
(101, 7, 1, 0, NULL, 2, '2020-02-28', '134500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:18:22', '2021-02-06 00:18:22'),
(102, 7, 1, 0, NULL, 3, '2020-02-28', '398068.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:18:53', '2021-02-06 00:18:53'),
(103, 7, 1, 0, NULL, 16, '2020-02-28', '90001.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:19:36', '2021-02-06 00:19:36'),
(104, 7, 1, 0, NULL, 4, '2020-02-28', '390658.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:20:08', '2021-02-06 00:20:08'),
(105, 7, 1, 0, NULL, 6, '2020-02-28', '410681.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:20:38', '2021-02-06 00:20:38'),
(106, 7, 1, 0, NULL, 7, '2020-02-28', '19500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:21:08', '2021-02-06 00:21:08'),
(107, 7, 2, 0, NULL, 8, '2020-02-28', '7993559.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:22:10', '2021-02-06 00:22:10'),
(108, 7, 2, 0, NULL, 11, '2020-02-28', '5123217.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:22:38', '2021-02-06 00:22:38'),
(109, 7, 2, 0, NULL, 12, '2020-02-28', '3927260.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:23:24', '2021-02-06 00:23:24'),
(110, 7, 2, 0, NULL, 13, '2020-02-28', '2081225.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:24:10', '2021-02-06 00:24:10'),
(111, 7, 2, 0, NULL, 14, '2020-02-28', '1493610.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:25:41', '2021-02-06 00:25:41'),
(112, 7, 2, 0, NULL, 17, '2020-02-28', '1432342.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:26:27', '2021-02-06 00:26:27'),
(113, 7, 2, 0, NULL, 18, '2020-02-28', '1143152.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:27:15', '2021-02-06 00:27:15'),
(114, 7, 2, 0, NULL, 19, '2020-02-28', '672999.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:28:04', '2021-02-06 00:28:04'),
(115, 7, 2, 0, NULL, 20, '2020-02-28', '1527353.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:28:48', '2021-02-06 00:28:48'),
(116, 7, 2, 0, NULL, 21, '2020-02-28', '1153000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:29:45', '2021-02-06 00:29:45'),
(117, 7, 2, 0, NULL, 22, '2020-02-28', '1224799.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:30:21', '2021-02-06 00:30:21'),
(118, 7, 2, 0, NULL, 23, '2020-02-28', '761533.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:30:55', '2021-02-06 00:30:55'),
(119, 3, 1, 0, NULL, 49, '2020-03-10', '700.00', 'cash', NULL, 'Electric Bill Paid', '2021-02-06 00:30:57', '2021-02-06 00:30:57'),
(120, 7, 2, 0, NULL, 24, '2020-02-28', '3575.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:31:39', '2021-02-06 00:31:39'),
(121, 7, 2, 0, NULL, 25, '2020-02-28', '13933.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:32:48', '2021-02-06 00:32:48'),
(122, 7, 2, 0, NULL, 25, '2020-02-28', '1815000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:33:37', '2021-02-06 00:33:37'),
(123, 7, 3, 0, NULL, 27, '2020-02-28', '415160.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:34:15', '2021-02-06 00:34:15'),
(124, 3, 1, 5, NULL, 57, '2020-03-30', '428676.00', 'check', NULL, 'Head Office Overhead***', '2021-02-06 00:35:05', '2021-02-06 00:35:05'),
(125, 3, 1, 0, NULL, 57, '2020-03-30', '84437.50', 'cash', NULL, 'Head Office Overhead', '2021-02-06 00:36:02', '2021-02-06 00:36:02'),
(126, 7, 3, 0, NULL, 15, '2020-02-28', '5702129.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:36:29', '2021-02-06 00:36:29'),
(127, 7, 3, 0, NULL, 28, '2020-02-28', '285995.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:37:15', '2021-02-06 00:37:15'),
(128, 7, 3, 0, NULL, 29, '2020-02-28', '471759.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:37:59', '2021-02-06 00:37:59'),
(129, 7, 3, 0, NULL, 30, '2020-02-28', '345500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:38:33', '2021-02-06 00:38:33'),
(130, 7, 3, 0, NULL, 31, '2020-02-28', '508865.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:39:25', '2021-02-06 00:39:25'),
(131, 7, 3, 0, NULL, 23, '2020-02-28', '487000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:40:10', '2021-02-06 00:40:10'),
(132, 7, 3, 0, NULL, 22, '2020-02-28', '65032.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:40:51', '2021-02-06 00:40:51'),
(133, 7, 3, 0, NULL, 19, '2020-02-28', '126000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:41:30', '2021-02-06 00:41:30'),
(134, 7, 1, 0, NULL, 58, '2020-02-28', '100000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:50:03', '2021-02-06 00:50:03'),
(135, 7, 1, 0, NULL, 37, '2020-02-28', '9950.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:51:12', '2021-02-06 00:51:12'),
(136, 7, 1, 0, NULL, 38, '2020-02-28', '202926.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:52:04', '2021-02-06 00:52:04'),
(137, 7, 6, 0, NULL, 54, '2020-02-28', '77163.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:53:54', '2021-02-06 00:58:22'),
(138, 7, 6, 0, NULL, 55, '2020-02-28', '104629.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:54:59', '2021-02-06 00:58:52'),
(139, 7, 6, 0, NULL, 56, '2020-02-28', '153007.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 00:55:57', '2021-02-06 00:57:45'),
(140, 7, 1, 0, NULL, 42, '2020-02-28', '630.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:25:54', '2021-02-06 01:25:54'),
(141, 7, 1, 0, NULL, 43, '2020-02-28', '3821787.22', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:26:34', '2021-02-06 01:26:34'),
(142, 7, 1, 0, NULL, 45, '2020-02-28', '406264.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:27:52', '2021-02-06 01:27:52'),
(143, 7, 1, 0, NULL, 46, '2020-02-28', '4650.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:28:39', '2021-02-06 01:28:39'),
(144, 7, 1, 0, NULL, 47, '2020-02-28', '749140.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:29:10', '2021-02-06 01:29:10'),
(145, 7, 1, 0, NULL, 48, '2020-02-28', '2521479.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:30:03', '2021-02-06 01:30:03'),
(146, 7, 1, 0, NULL, 49, '2020-02-28', '2117198.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:31:15', '2021-02-06 01:31:15'),
(147, 7, 1, 0, NULL, 50, '2020-02-28', '836144.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:32:12', '2021-02-06 01:32:12'),
(148, 7, 5, 0, NULL, 57, '2020-02-28', '10771993.02', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 01:32:54', '2021-02-06 01:32:54'),
(149, 5, 1, 0, NULL, 1, '2020-02-28', '8715900.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 20:53:42', '2021-02-06 20:53:42'),
(150, 5, 1, 0, NULL, 2, '2020-02-28', '935140.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 20:54:40', '2021-02-06 20:54:40'),
(151, 5, 1, 0, NULL, 3, '2020-02-28', '1487440.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 20:55:28', '2021-02-06 20:55:28'),
(152, 5, 1, 0, NULL, 16, '2020-02-28', '296000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 20:56:39', '2021-02-06 20:56:39'),
(153, 5, 1, 0, NULL, 4, '2020-02-28', '576700.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 20:57:26', '2021-02-06 20:57:26'),
(154, 5, 1, 0, NULL, 5, '2020-02-28', '75000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 20:58:32', '2021-02-06 20:58:32'),
(155, 5, 1, 0, NULL, 6, '2020-02-28', '380175.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 20:59:04', '2021-02-06 20:59:04'),
(156, 5, 1, 0, NULL, 7, '2020-02-28', '37300.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 20:59:39', '2021-02-06 20:59:39'),
(157, 5, 2, 0, NULL, 8, '2020-02-28', '10765943.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:01:08', '2021-02-06 21:01:08'),
(158, 5, 2, 0, NULL, 11, '2020-02-28', '2620950.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:01:46', '2021-02-06 21:01:46'),
(159, 5, 2, 0, NULL, 12, '2020-02-28', '2203300.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:02:53', '2021-02-06 21:02:53'),
(160, 5, 2, 0, NULL, 13, '2020-02-28', '3593124.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:03:36', '2021-02-06 21:03:36'),
(161, 5, 2, 0, NULL, 14, '2020-02-28', '882910.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:05:53', '2021-02-06 21:05:53'),
(162, 5, 2, 0, NULL, 18, '2020-02-28', '138537.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:06:46', '2021-02-06 21:06:46'),
(163, 5, 2, 0, NULL, 22, '2020-02-28', '11300.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:07:37', '2021-02-06 21:07:37'),
(164, 5, 2, 0, NULL, 25, '2020-02-28', '18213.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:08:16', '2021-02-06 21:08:16'),
(165, 5, 3, 0, NULL, 27, '2020-02-28', '662400.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:09:32', '2021-02-06 21:09:32'),
(166, 5, 3, 0, NULL, 15, '2020-02-28', '3568500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:10:23', '2021-02-06 21:10:23'),
(167, 5, 3, 0, NULL, 28, '2020-02-28', '103230.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:10:59', '2021-02-06 21:10:59'),
(168, 5, 3, 0, NULL, 29, '2020-02-28', '41900.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:11:55', '2021-02-06 21:11:55'),
(169, 5, 1, 0, NULL, 37, '2020-02-28', '194293.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:12:53', '2021-02-06 21:12:53'),
(170, 5, 1, 0, NULL, 38, '2020-02-28', '7165.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:15:11', '2021-02-06 21:15:11'),
(171, 5, 6, 0, NULL, 54, '2020-02-28', '125551.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:16:09', '2021-02-06 21:16:09'),
(172, 5, 6, 0, NULL, 55, '2020-02-28', '50400.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:18:09', '2021-02-06 21:18:09'),
(173, 5, 6, 0, NULL, 56, '2020-02-28', '73577.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:18:43', '2021-02-06 21:18:43'),
(174, 5, 1, 0, NULL, 43, '2020-02-28', '2623910.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:19:18', '2021-02-06 21:19:18'),
(175, 5, 1, 0, NULL, 45, '2020-02-28', '136205.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:19:48', '2021-02-06 21:19:48'),
(176, 5, 1, 0, NULL, 47, '2020-02-28', '341213.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:20:24', '2021-02-06 21:20:24'),
(177, 5, 1, 0, NULL, 48, '2020-02-28', '2089005.14', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:21:25', '2021-02-06 21:21:25'),
(178, 5, 1, 0, NULL, 49, '2020-02-28', '349299.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:22:19', '2021-02-06 21:22:19'),
(179, 5, 1, 0, NULL, 50, '2020-02-28', '32330.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:23:46', '2021-02-06 21:23:46'),
(180, 5, 1, 0, NULL, 59, '2020-02-28', '793775.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:26:29', '2021-02-06 21:26:29'),
(181, 5, 1, 0, NULL, 60, '2020-02-28', '100000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:27:39', '2021-02-06 21:27:39'),
(182, 5, 5, 0, NULL, 57, '2020-02-28', '4354802.50', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:28:21', '2021-02-06 21:28:21'),
(183, 6, 1, 0, NULL, 3, '2020-02-28', '78325.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:31:56', '2021-02-06 21:31:56'),
(184, 6, 1, 0, NULL, 16, '2020-02-28', '120000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:32:59', '2021-02-06 21:32:59'),
(185, 6, 1, 0, NULL, 4, '2020-02-28', '346000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:33:37', '2021-02-06 21:33:37'),
(186, 6, 1, 0, NULL, 7, '2020-02-28', '31360.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:34:13', '2021-02-06 21:34:13'),
(187, 6, 2, 0, NULL, 8, '2020-02-28', '894662.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:34:46', '2021-02-06 21:34:46'),
(188, 6, 2, 0, NULL, 11, '2020-02-28', '300985.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:35:23', '2021-02-06 21:35:23'),
(189, 6, 2, 0, NULL, 12, '2020-02-28', '35805.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:36:36', '2021-02-06 21:36:36'),
(190, 6, 2, 0, NULL, 13, '2020-02-28', '510180.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:37:18', '2021-02-06 21:37:18'),
(191, 6, 2, 0, NULL, 14, '2020-02-28', '111000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:38:02', '2021-02-06 21:38:02'),
(192, 6, 2, 0, NULL, 17, '2020-02-28', '23460.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:38:45', '2021-02-06 21:38:45'),
(193, 6, 2, 0, NULL, 18, '2020-02-28', '2010.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:39:23', '2021-02-06 21:39:23'),
(194, 6, 3, 0, NULL, 15, '2020-02-28', '324000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:40:01', '2021-02-06 21:40:01'),
(195, 6, 3, 0, NULL, 28, '2020-02-28', '28000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:40:40', '2021-02-06 21:40:40'),
(196, 6, 1, 0, NULL, 37, '2020-02-28', '27942.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:41:14', '2021-02-06 21:41:14'),
(197, 6, 6, 0, NULL, 54, '2020-02-28', '37588.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:41:48', '2021-02-06 21:41:48'),
(198, 6, 6, 0, NULL, 56, '2020-02-28', '7924.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:42:30', '2021-02-06 21:43:00'),
(199, 6, 1, 0, NULL, 43, '2020-02-28', '140293.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:43:44', '2021-02-06 21:43:44'),
(200, 6, 1, 0, NULL, 45, '2020-02-28', '4470.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:44:40', '2021-02-06 21:44:40'),
(201, 6, 1, 0, NULL, 47, '2020-02-28', '20467.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:45:26', '2021-02-06 21:45:26'),
(202, 6, 1, 0, NULL, 49, '2020-02-28', '92855.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-06 21:46:12', '2021-02-06 21:46:12'),
(204, 6, 2, 0, NULL, 11, '2020-03-20', '29050.00', 'cash', NULL, 'Cement Purchase on Cash', '2021-02-06 22:24:06', '2021-02-06 22:24:06'),
(205, 6, 2, 0, NULL, 13, '2020-03-15', '36000.00', 'cash', NULL, 'Stone Purchase for Column work purpose', '2021-02-06 22:31:45', '2021-02-06 22:31:45'),
(206, 6, 2, 0, NULL, 14, '2020-03-09', '5500.00', 'cash', NULL, 'Sylhet  Sand for column costing work purpose', '2021-02-06 22:34:03', '2021-02-06 22:34:03'),
(207, 6, 3, 5, NULL, 15, '2020-03-02', '12600.00', 'check', NULL, 'Foundation work Exp.', '2021-02-06 22:39:49', '2021-02-06 22:48:04'),
(208, 6, 3, 5, NULL, 15, '2020-03-08', '13000.00', 'check', NULL, 'G.F Slab Work Purpose Exp.', '2021-02-06 22:42:57', '2021-02-06 22:42:57'),
(209, 6, 3, 0, NULL, 15, '2020-03-23', '15000.00', 'cash', NULL, 'Adv. for Shutter Materials purpose', '2021-02-06 22:45:20', '2021-02-06 22:45:20'),
(210, 6, 6, 0, NULL, 56, '2020-03-21', '200.00', 'cash', NULL, 'Signboard Number Change Sticker Purpose', '2021-02-06 22:52:09', '2021-02-06 22:52:09'),
(211, 6, 1, 0, NULL, 43, '2020-03-16', '9000.00', 'check', NULL, 'Salary paid by Check', '2021-02-06 22:55:13', '2021-02-06 22:55:13'),
(212, 6, 1, 0, NULL, 43, '2020-04-15', '9000.00', 'cash', NULL, 'Salary paid by Cash', '2021-02-06 23:01:37', '2021-02-06 23:01:37'),
(213, 6, 1, 0, NULL, 43, '2020-05-18', '9000.00', 'cash', NULL, 'Salary  paid on Cash', '2021-02-06 23:02:40', '2021-02-06 23:02:40'),
(214, 6, 1, 0, NULL, 43, '2020-05-18', '4500.00', 'cash', NULL, 'Bonous  of Guard', '2021-02-06 23:04:26', '2021-02-06 23:04:26'),
(215, 6, 1, 0, NULL, 43, '2020-06-25', '9000.00', 'cash', NULL, 'Salary paid of Guard by Cash', '2021-02-06 23:05:33', '2021-02-06 23:05:33'),
(216, 6, 1, 0, NULL, 49, '2020-03-03', '759.00', 'cash', NULL, 'Electrical Bill', '2021-02-06 23:08:03', '2021-02-06 23:08:03'),
(217, 6, 1, 0, NULL, 49, '2020-03-16', '32350.00', 'cash', NULL, 'Wasa Bill', '2021-02-06 23:09:02', '2021-02-06 23:09:02'),
(218, 6, 1, 0, NULL, 49, '2020-06-29', '2185.00', 'cash', NULL, 'Electrical Bill', '2021-02-06 23:10:05', '2021-02-06 23:10:05'),
(219, 5, 1, 3, NULL, 1, '2020-03-25', '100000.00', 'check', NULL, 'Komolesh & Nikhil Paul', '2021-02-06 23:18:52', '2021-02-06 23:18:52'),
(220, 5, 1, 3, NULL, 1, '2020-04-25', '100000.00', 'check', NULL, 'Komolesh & Nikhil Paul', '2021-02-06 23:20:18', '2021-02-06 23:22:31'),
(221, 5, 1, 3, NULL, 1, '2020-05-25', '100000.00', 'check', NULL, 'Komolesh & Nikhil Paul', '2021-02-06 23:21:56', '2021-02-06 23:23:29'),
(222, 5, 1, 5, NULL, 5, '2020-03-12', '20000.00', 'check', NULL, 'DCL for Brochure', '2021-02-06 23:26:47', '2021-02-06 23:26:47'),
(223, 5, 1, 5, NULL, 5, '2020-03-22', '25000.00', 'check', NULL, 'DCL for Brochure', '2021-02-06 23:29:46', '2021-02-06 23:29:46'),
(224, 5, 1, 5, NULL, 6, '2020-03-01', '5000.00', 'check', NULL, 'Bikroy.com', '2021-02-06 23:33:05', '2021-02-06 23:33:05'),
(225, 5, 1, 5, NULL, 6, '2020-03-03', '22770.00', 'check', NULL, 'Ad Link', '2021-02-06 23:35:41', '2021-02-06 23:35:41'),
(226, 5, 1, 5, NULL, 6, '2020-03-08', '22770.00', 'check', NULL, 'Ad Link', '2021-02-06 23:37:08', '2021-02-06 23:37:08'),
(231, 5, 2, 5, NULL, 11, '2020-03-03', '95000.00', 'check', NULL, 'Mir Cement', '2021-02-06 23:46:29', '2021-02-06 23:46:29'),
(234, 5, 2, 5, NULL, 11, '2020-03-02', '266000.00', 'check', NULL, 'Mir Cement', '2021-02-06 23:48:36', '2021-02-06 23:48:36'),
(235, 5, 2, 5, NULL, 11, '2020-03-15', '97500.00', 'check', NULL, 'Mir Cement', '2021-02-06 23:50:45', '2021-02-06 23:50:45'),
(236, 5, 2, 0, NULL, 12, '2020-03-23', '4000.00', 'cash', NULL, 'Brick Rent, BBL', '2021-02-06 23:52:34', '2021-02-06 23:52:34'),
(237, 5, 2, 5, NULL, 12, '2020-03-03', '52900.00', 'check', NULL, 'M/S Sadia Bricks', '2021-02-06 23:55:14', '2021-02-06 23:55:14'),
(238, 5, 2, 5, NULL, 12, '2020-03-12', '252900.00', 'check', NULL, 'M/S Sadia Bricks', '2021-02-06 23:57:14', '2021-02-06 23:57:14'),
(239, 5, 2, 0, NULL, 13, '2020-03-07', '18611.00', 'cash', NULL, 'Stone Rent', '2021-02-07 00:00:19', '2021-02-07 00:00:19'),
(240, 5, 2, 5, NULL, 13, '2020-03-19', '64380.00', 'check', NULL, 'Tanvir & Dina ent', '2021-02-07 00:02:28', '2021-02-07 00:02:28'),
(241, 5, 2, 0, NULL, 13, '2020-03-24', '16960.00', 'cash', NULL, 'Stone rent purpose', '2021-02-07 00:04:39', '2021-02-07 00:04:39'),
(242, 5, 2, 0, NULL, 14, '2020-03-16', '171394.00', 'cash', NULL, 'Local Sand Purpose', '2021-02-07 00:10:17', '2021-02-07 00:10:17'),
(243, 5, 2, 0, NULL, 18, '2020-03-03', '25144.00', 'cash', NULL, 'Electrical Materials', '2021-02-07 00:11:50', '2021-02-07 02:39:25'),
(244, 5, 3, 5, NULL, 27, '2020-03-20', '50000.00', 'check', NULL, 'Mahi Pile', '2021-02-07 00:14:53', '2021-02-07 00:14:53'),
(245, 5, 3, 5, NULL, 15, '2020-03-02', '57200.00', 'check', NULL, 'Azad Uddin', '2021-02-07 00:17:47', '2021-02-07 00:17:47'),
(246, 5, 3, 5, NULL, 15, '2020-03-05', '140000.00', 'check', NULL, 'Azad Uddin', '2021-02-07 00:19:46', '2021-02-07 00:19:46'),
(247, 5, 3, 5, NULL, 15, '2020-03-08', '8800.00', 'check', NULL, 'Azad Uddin', '2021-02-07 00:23:58', '2021-02-07 00:23:58'),
(248, 5, 3, 5, NULL, 15, '2020-03-12', '100000.00', 'check', NULL, 'Azad Uddin', '2021-02-07 00:25:43', '2021-02-07 00:25:43'),
(249, 5, 3, 5, NULL, 15, '2020-03-15', '33600.00', 'check', NULL, 'Azad Uddin', '2021-02-07 00:26:58', '2021-02-07 00:26:58'),
(250, 5, 3, 5, NULL, 15, '2020-03-22', '38800.00', 'check', NULL, 'Azad Uddin', '2021-02-07 00:28:04', '2021-02-07 00:28:04'),
(251, 5, 3, 5, NULL, 15, '2020-03-25', '50000.00', 'check', NULL, 'Azad Uddin', '2021-02-07 00:29:21', '2021-02-07 00:29:21'),
(252, 5, 3, 0, NULL, 28, '2020-05-10', '2600.00', 'cash', NULL, 'Fenching Repair', '2021-02-07 00:30:41', '2021-02-07 00:30:41'),
(254, 5, 6, 0, NULL, 54, '2020-03-01', '500.00', 'cash', NULL, 'Switch Board & Cap', '2021-02-07 00:33:51', '2021-02-07 00:33:51'),
(255, 5, 6, 0, NULL, 54, '2020-03-04', '4010.00', 'cash', NULL, 'Curing Pipe & Materials', '2021-02-07 00:34:58', '2021-02-07 00:34:58'),
(256, 5, 6, 0, NULL, 54, '2020-03-11', '370.00', 'cash', NULL, 'Check Bulb', '2021-02-07 00:36:07', '2021-02-07 00:36:07'),
(257, 5, 6, 0, NULL, 54, '2020-03-19', '150.00', 'cash', NULL, 'Burch & Haepike', '2021-02-07 00:37:28', '2021-02-07 00:37:28'),
(258, 5, 6, 0, NULL, 55, '2020-03-17', '700.00', 'cash', NULL, 'Internet Bill', '2021-02-07 00:43:29', '2021-02-07 00:43:29'),
(259, 5, 6, 0, NULL, 55, '2020-03-21', '700.00', 'cash', NULL, 'Mobile Bill', '2021-02-07 00:45:02', '2021-02-07 00:45:02'),
(260, 5, 6, 0, NULL, 56, '2020-03-18', '750.00', 'cash', NULL, 'Drawing Print', '2021-02-07 00:46:00', '2021-02-07 00:46:00'),
(261, 5, 1, 0, NULL, 43, '2020-03-16', '57603.00', 'check', NULL, 'Salary for the month of Feb.', '2021-02-07 00:48:11', '2021-02-07 00:48:11'),
(262, 5, 1, 0, NULL, 43, '2020-04-10', '63000.00', 'cash', NULL, 'Salary for the month of March.', '2021-02-07 00:49:25', '2021-02-07 00:49:25'),
(263, 5, 1, 0, NULL, 43, '2020-05-15', '27000.00', 'cash', NULL, 'Salary for the month of April', '2021-02-07 00:50:17', '2021-02-07 00:50:17'),
(264, 5, 1, 0, NULL, 43, '2020-05-15', '29250.00', 'cash', NULL, 'Salary for the month of May.', '2021-02-07 00:51:03', '2021-02-07 00:51:03'),
(265, 5, 1, 0, NULL, 43, '2020-06-20', '18000.00', 'cash', NULL, 'Salary for the month of May.', '2021-02-07 00:51:52', '2021-02-07 00:51:52'),
(266, 5, 1, 0, NULL, 45, '2020-03-14', '2000.00', 'cash', NULL, 'Octen for M Cycle', '2021-02-07 00:55:00', '2021-02-07 00:55:00'),
(267, 5, 1, 0, NULL, 45, '2020-03-03', '270.00', 'cash', NULL, 'Conveyance of Akram', '2021-02-07 00:56:36', '2021-02-07 00:56:36'),
(268, 5, 1, 0, NULL, 45, '2020-06-20', '2000.00', 'cash', NULL, 'Octen (April- June)', '2021-02-07 00:58:33', '2021-02-07 00:58:33'),
(269, 5, 1, 0, NULL, 47, '2020-03-10', '5000.00', 'cash', NULL, 'House Rent', '2021-02-07 01:00:16', '2021-02-07 01:00:16'),
(270, 5, 1, 0, NULL, 48, '2020-06-28', '2065.00', 'check', NULL, 'Bank Online Service Charge', '2021-02-07 01:01:24', '2021-02-08 04:16:25'),
(271, 5, 1, 0, NULL, 49, '2020-03-19', '21814.00', 'cash', NULL, 'Electrical Bill', '2021-02-07 01:03:03', '2021-02-07 01:03:03'),
(272, 5, 1, 0, NULL, 49, '2020-03-15', '67414.00', 'cash', NULL, 'Wasa Bill', '2021-02-07 01:03:46', '2021-02-07 01:03:46'),
(273, 5, 1, 0, NULL, 49, '2020-06-29', '12145.00', 'cash', NULL, 'Electric Bill', '2021-02-07 01:04:52', '2021-02-07 01:04:52'),
(274, 5, 1, 0, NULL, 59, '2020-03-21', '44725.00', 'cash', NULL, 'Closing Project Exp.', '2021-02-07 01:06:58', '2021-02-07 01:06:58'),
(275, 5, 1, 0, NULL, 60, '2020-04-04', '100000.00', 'check', NULL, 'Loan Interest', '2021-02-07 01:08:12', '2021-02-07 01:08:12'),
(276, 5, 5, 0, NULL, 57, '2020-03-28', '84437.50', 'cash', NULL, 'Head office exp.', '2021-02-07 01:10:09', '2021-02-07 02:36:24'),
(277, 5, 5, 0, NULL, 57, '2020-03-28', '428676.00', 'check', NULL, NULL, '2021-02-07 02:37:23', '2021-02-07 02:37:23'),
(278, 4, 1, 0, NULL, 3, '2020-03-16', '1800.00', 'cash', NULL, 'Land  Tax', '2021-02-07 03:16:06', '2021-02-07 03:16:06'),
(287, 2, 1, 0, NULL, 1, '2020-02-28', '2746117.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:45:37', '2021-02-07 22:45:37'),
(288, 2, 1, 0, NULL, 2, '2020-02-28', '7257370.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:46:09', '2021-02-07 22:46:09'),
(289, 2, 1, 0, NULL, 3, '2020-02-28', '3584570.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:46:44', '2021-02-07 22:46:44'),
(290, 2, 1, 0, NULL, 16, '2020-02-28', '191393.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:47:18', '2021-02-07 22:47:18'),
(291, 2, 1, 0, NULL, 4, '2020-02-28', '350400.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:47:53', '2021-02-07 22:47:53'),
(292, 2, 1, 0, NULL, 5, '2020-02-28', '112791.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:48:26', '2021-02-07 22:48:26'),
(293, 2, 1, 0, NULL, 6, '2020-02-28', '742047.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:49:08', '2021-02-07 22:49:08'),
(294, 2, 1, 0, NULL, 7, '2020-02-28', '27500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:51:06', '2021-02-07 22:51:06'),
(295, 2, 2, 0, NULL, 8, '2020-02-28', '10883819.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:51:46', '2021-02-07 22:51:46'),
(296, 2, 2, 0, NULL, 11, '2020-02-28', '5417275.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:52:24', '2021-02-07 22:52:24'),
(297, 2, 1, 0, NULL, 12, '2020-02-28', '4118221.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:53:07', '2021-02-07 22:53:07'),
(298, 2, 3, 0, NULL, 12, '2020-03-18', '1500.00', 'cash', NULL, 'Piles Brick Chips Purpose', '2021-02-07 22:55:01', '2021-02-08 04:06:25'),
(299, 2, 2, 0, NULL, 13, '2020-02-28', '1179189.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:56:05', '2021-02-07 22:56:05'),
(300, 2, 2, 0, NULL, 14, '2020-02-28', '887447.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:56:40', '2021-02-07 22:56:40'),
(301, 2, 2, 0, NULL, 17, '2020-02-28', '1553578.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:58:20', '2021-02-07 22:58:20'),
(302, 2, 2, 0, NULL, 18, '2020-02-28', '1982551.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:58:55', '2021-02-07 22:58:55'),
(303, 2, 2, 0, NULL, 19, '2020-02-28', '967870.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 22:59:36', '2021-02-07 22:59:36'),
(304, 2, 2, 0, NULL, 20, '2020-02-28', '2496466.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:01:32', '2021-02-07 23:01:32'),
(305, 2, 2, 0, NULL, 21, '2020-02-28', '955880.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:02:59', '2021-02-07 23:02:59'),
(306, 2, 2, 0, NULL, 22, '2020-02-28', '2089471.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:03:45', '2021-02-07 23:03:45'),
(307, 2, 2, 0, NULL, 23, '2020-02-28', '915446.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:04:16', '2021-02-08 00:17:14'),
(308, 2, 2, 0, NULL, 23, '2020-03-23', '9370.00', 'cash', NULL, 'Abdul Kader Paint Exp.', '2021-02-07 23:05:41', '2021-02-08 04:06:54'),
(309, 2, 2, 5, NULL, 23, '2020-03-15', '23100.00', 'check', NULL, 'Rainbow Paint', '2021-02-07 23:29:32', '2021-02-07 23:29:32'),
(310, 2, 2, 0, NULL, 24, '2020-02-28', '84595.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:31:18', '2021-02-07 23:31:18'),
(311, 2, 2, 0, NULL, 25, '2020-02-28', '297751.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:32:26', '2021-02-07 23:32:26'),
(312, 2, 2, 0, NULL, 26, '2020-02-28', '3540000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:33:03', '2021-02-07 23:33:03'),
(313, 2, 3, 0, NULL, 27, '2020-02-28', '0.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:34:31', '2021-02-07 23:38:48'),
(314, 2, 3, 0, NULL, 15, '2020-02-28', '6244796.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:35:12', '2021-02-07 23:38:28'),
(315, 2, 3, 0, NULL, 28, '2020-02-28', '421334.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:37:07', '2021-02-07 23:38:08'),
(316, 2, 3, 0, NULL, 29, '2020-02-28', '564380.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:39:41', '2021-02-07 23:39:41'),
(317, 2, 3, 0, NULL, 30, '2020-02-28', '359300.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:40:50', '2021-02-07 23:40:50'),
(318, 2, 3, 0, NULL, 31, '2020-02-28', '737500.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:41:28', '2021-02-07 23:41:28'),
(319, 2, 3, 0, NULL, 32, '2020-02-28', '389200.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:42:13', '2021-02-07 23:42:13'),
(320, 2, 3, 0, NULL, 33, '2020-02-28', '81050.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:43:10', '2021-02-07 23:43:10'),
(321, 2, 1, 0, NULL, 58, '2020-02-28', '190.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:45:17', '2021-02-07 23:45:17'),
(322, 2, 1, 0, NULL, 37, '2020-02-28', '171623.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:47:18', '2021-02-07 23:47:18'),
(323, 2, 1, 0, NULL, 38, '2021-02-28', '242987.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:48:06', '2021-02-07 23:48:06'),
(324, 2, 6, 0, NULL, 54, '2020-02-28', '91924.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:48:56', '2021-02-07 23:48:56'),
(325, 2, 6, 0, NULL, 55, '2020-02-28', '14635.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:49:32', '2021-02-07 23:49:32'),
(326, 2, 6, 0, NULL, 56, '2020-02-28', '73761.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:50:13', '2021-02-07 23:50:13'),
(327, 2, 1, 0, NULL, 42, '2020-02-28', '248007.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:52:30', '2021-02-07 23:52:30'),
(328, 2, 1, 0, NULL, 43, '2020-02-28', '3251100.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:53:16', '2021-02-07 23:53:16'),
(329, 2, 1, 0, NULL, 45, '2020-02-28', '129326.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:53:52', '2021-02-07 23:53:52'),
(330, 2, 1, 0, NULL, 47, '2020-02-28', '183989.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:54:38', '2021-02-07 23:54:38'),
(331, 2, 1, 0, NULL, 48, '2020-02-28', '1285697.50', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:55:27', '2021-02-07 23:55:27'),
(332, 2, 1, 0, NULL, 49, '2020-02-28', '3463945.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:56:17', '2021-02-07 23:56:17'),
(333, 2, 1, 0, NULL, 50, '2020-02-28', '137757.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:57:15', '2021-02-07 23:57:15'),
(334, 2, 1, 0, NULL, 51, '2020-02-28', '350000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:57:50', '2021-02-07 23:57:50'),
(335, 2, 1, 0, NULL, 52, '2020-02-28', '500000.00', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:58:25', '2021-02-07 23:58:25'),
(336, 2, 5, 0, NULL, 57, '2020-02-28', '7094514.70', 'open', NULL, 'Opening Balance from Feb-2020', '2021-02-07 23:59:30', '2021-02-07 23:59:30'),
(338, 4, 2, 5, NULL, 11, '2020-03-15', '105300.00', 'check', NULL, 'Mir Cement Purchase', '2021-02-09 03:08:01', '2021-02-09 03:08:01'),
(339, 4, 2, 5, NULL, 12, '2020-03-15', '117000.00', 'check', NULL, 'M/S Rahman Trading', '2021-02-09 03:09:48', '2021-02-09 03:09:48'),
(340, 4, 2, 0, NULL, 18, '2020-03-01', '5075.00', 'cash', NULL, 'Electric Materials', '2021-02-09 03:10:56', '2021-02-09 03:10:56'),
(341, 4, 2, 5, NULL, 22, '2020-03-16', '12500.00', 'Select Your Payment Method', NULL, 'M/S Alama Electric', '2021-02-09 03:13:51', '2021-02-09 03:13:51'),
(342, 4, 3, 5, NULL, 15, '2020-03-02', '12000.00', 'check', NULL, 'Md Ibrahim Khalil', '2021-02-09 03:15:21', '2021-02-09 03:15:21'),
(343, 4, 3, 5, NULL, 15, '2020-03-08', '12000.00', 'check', NULL, 'Md Ibrahim Khalil', '2021-02-09 03:17:24', '2021-02-09 03:17:24'),
(344, 4, 3, 5, NULL, 15, '2020-03-15', '24800.00', 'check', NULL, 'Md Ibrahim Khalil', '2021-02-09 03:18:36', '2021-02-09 03:18:36'),
(345, 4, 3, 5, NULL, 15, '2020-03-22', '15200.00', 'check', NULL, 'Md Ibrahim Khalil', '2021-02-09 03:19:56', '2021-02-09 03:19:56'),
(346, 4, 3, 0, NULL, 28, '2020-03-05', '693.00', 'cash', NULL, 'Door Frame Set', '2021-02-09 03:21:36', '2021-02-09 03:21:36'),
(347, 4, 3, 0, NULL, 28, '2020-03-11', '5500.00', 'cash', NULL, 'Materials Lifting', '2021-02-09 03:23:12', '2021-02-09 03:23:12'),
(348, 4, 3, 0, NULL, 28, '2020-03-17', '9900.00', 'cash', NULL, 'Brick Works PP Wall', '2021-02-09 03:24:03', '2021-02-09 03:24:03'),
(349, 4, 3, 5, NULL, 29, '2020-03-19', '10256.00', 'check', NULL, 'MS Alam Electric', '2021-02-09 03:25:37', '2021-02-09 03:25:37'),
(351, 9, 1, 0, NULL, 1, '2020-02-29', '29196474.77', 'open', NULL, 'Profit & Loss of Final Balance sheet', '2021-02-24 00:03:47', '2021-02-24 00:03:47'),
(352, 4, 1, 0, NULL, 3, '2020-07-16', '1800.00', 'cash', NULL, 'Land Tax Paid', '2021-02-25 00:28:31', '2021-02-25 00:28:31'),
(353, 4, 1, 1, NULL, 3, '2020-09-25', '108000.00', 'check', NULL, 'DOHS Parishad', '2021-02-25 00:33:10', '2021-02-25 00:33:10'),
(354, 4, 1, 1, NULL, 3, '2020-09-25', '108000.00', 'check', NULL, 'DOHS Parishad', '2021-02-25 00:34:29', '2021-02-25 00:34:29'),
(355, 4, 2, 0, NULL, 11, '2020-10-26', '4000.00', 'cash', NULL, 'Cement Purchase', '2021-02-25 00:35:54', '2021-02-25 00:35:54'),
(356, 4, 2, 0, NULL, 19, '2020-10-28', '15000.00', 'cash', NULL, 'Window Grill Purpose', '2021-02-25 00:37:45', '2021-02-25 00:37:45'),
(357, 4, 6, 0, NULL, 54, '2020-10-26', '10300.00', 'cash', NULL, 'Deep Tube-Well Service', '2021-02-25 00:39:25', '2021-02-25 00:39:25'),
(358, 4, 6, 0, NULL, 55, '2020-09-10', '300.00', 'cash', NULL, 'Mobile Bill Expense', '2021-02-25 00:40:32', '2021-02-25 00:40:32'),
(359, 4, 6, 0, NULL, 56, '2020-09-07', '58.00', 'cash', NULL, 'Bank Charge', '2021-02-25 00:41:44', '2021-02-25 00:41:44'),
(360, 4, 6, 0, NULL, 56, '2020-09-12', '402.00', 'cash', NULL, 'Drawing Print', '2021-02-25 00:46:46', '2021-02-25 00:46:46'),
(361, 4, 6, 0, NULL, 56, '2020-09-30', '1280.00', 'cash', NULL, 'Stationery & Printing', '2021-02-25 00:52:03', '2021-02-25 00:52:03'),
(362, 4, 1, 0, NULL, 45, '2020-08-26', '1600.00', 'cash', NULL, 'Conveyance of ED', '2021-02-25 00:53:46', '2021-02-25 00:53:46'),
(363, 4, 1, 0, NULL, 47, '2020-08-30', '1500.00', 'cash', NULL, 'Ent. of ED', '2021-02-25 00:55:02', '2021-02-25 00:55:02'),
(364, 4, 1, 0, NULL, 47, '2020-09-01', '1000.00', 'cash', NULL, 'Furniture Shifting', '2021-02-25 00:56:08', '2021-02-25 00:56:08'),
(365, 4, 1, 0, NULL, 47, '2020-09-01', '10000.00', 'cash', NULL, 'House Rent', '2021-02-25 00:57:00', '2021-02-25 00:57:00'),
(366, 4, 1, 0, NULL, 47, '2020-08-26', '5600.00', 'cash', NULL, 'Hotel Rent', '2021-02-25 00:58:09', '2021-02-25 00:58:09'),
(367, 4, 1, 0, NULL, 49, '2020-08-11', '1000.00', 'cash', NULL, 'Electric Bill', '2021-02-25 01:00:23', '2021-02-25 01:00:23'),
(368, 4, 1, 0, NULL, 49, '2020-09-07', '19678.00', 'cash', NULL, 'Electric Bill', '2021-02-25 01:01:28', '2021-02-25 01:01:28'),
(369, 3, 1, 0, NULL, 16, '2020-09-10', '34900.00', 'cash', NULL, 'Plan Approval', '2021-02-25 02:37:09', '2021-02-25 02:37:09'),
(370, 3, 3, 1, NULL, 15, '2020-10-25', '20000.00', 'check', NULL, '6th slab casting work', '2021-02-25 02:44:43', '2021-02-25 02:44:43'),
(371, 3, 1, 3, NULL, 43, '2020-09-25', '54306.00', 'check', NULL, 'staff salary', '2021-02-25 02:48:12', '2021-02-25 03:00:15'),
(372, 3, 1, 0, NULL, 49, '2020-09-07', '11428.00', 'cash', NULL, 'Electric Bill', '2021-02-25 02:50:23', '2021-02-25 02:50:23'),
(375, 3, 5, 3, NULL, 57, '2020-10-19', '99596.50', 'check', NULL, 'Head Office Overhead Exp.', '2021-02-25 03:22:11', '2021-02-25 03:22:11'),
(376, 3, 5, 0, NULL, 57, '2020-10-20', '37844.50', 'cash', NULL, 'Head Office Exp.', '2021-02-25 03:23:35', '2021-02-25 03:23:35'),
(377, 5, 2, 1, NULL, 8, '2020-10-27', '720000.00', 'check', NULL, 'SS Steel Ltd.', '2021-02-25 03:31:51', '2021-02-25 03:31:51'),
(378, 5, 2, 1, NULL, 11, '2020-10-27', '266000.00', 'check', NULL, 'Mir Cement', '2021-02-25 03:35:14', '2021-02-25 03:35:14'),
(379, 5, 2, 1, NULL, 11, '2020-09-07', '76000.00', 'check', NULL, 'Mir Cement', '2021-02-25 03:36:50', '2021-02-25 03:36:50'),
(380, 5, 2, 1, NULL, 12, '2020-09-13', '100000.00', 'check', NULL, 'M/S Sadia Enterprise', '2021-02-25 03:49:45', '2021-02-25 03:49:45'),
(381, 6, 1, 1, NULL, 2, '2021-02-03', '200.00', 'check', NULL, NULL, '2021-02-25 05:31:31', '2021-02-25 05:31:31'),
(382, 5, 2, 0, NULL, 8, '2021-02-17', '100.00', 'open', NULL, NULL, '2021-02-25 05:32:20', '2021-02-25 05:32:20'),
(383, 5, 1, 0, NULL, 2, '2021-02-18', '2000.00', 'open', NULL, NULL, '2021-02-25 05:33:38', '2021-02-25 05:33:38'),
(386, 2, 2, 2, NULL, 8, '2021-03-03', '12000.00', 'check', NULL, NULL, '2021-03-04 13:28:53', '2021-03-04 13:28:53'),
(387, 2, 2, 0, NULL, 11, '2021-03-04', '12000.00', 'cash', NULL, NULL, '2021-03-04 13:45:42', '2021-03-04 13:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(2, 'admin', 'admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(3, 'editor', 'admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38'),
(4, 'user', 'admin', '2021-01-24 14:48:38', '2021-01-24 14:48:38');

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
(1, 1),
(1, 3),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(43, 3),
(44, 1),
(44, 3),
(45, 1),
(45, 3),
(46, 1),
(46, 3),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Razibur Rahman', 'razibeee2014@gmail.com', NULL, '$2y$10$S84R09U7iV1saIUy3di46O69C7xNtQx0yZlpo/jMNxtZG8mFScdAO', NULL, '2021-01-24 14:48:38', '2021-01-24 14:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `land` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession_id` bigint(20) UNSIGNED NOT NULL,
  `organization` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_file_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_file_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `name`, `email`, `phone`, `area`, `land`, `width`, `height`, `store`, `building`, `demand`, `profession_id`, `organization`, `date`, `remark`, `report`, `contact_person`, `check_file`, `check_file_one`, `check_file_two`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Md. Razibur Rahman', 'razibeee2014@gmail.com', '01737988947', NULL, 'Bangladesh', NULL, NULL, NULL, NULL, NULL, 2, NULL, '2021-03-03', NULL, NULL, NULL, 'images/12.jpg', NULL, NULL, 'Bangladesh', '2021-03-04 18:07:10', '2021-03-04 18:07:10'),
(2, 'Mark NZ', 'info@propertynoise.co.nz', '01737988947', NULL, 'New Zealand', NULL, NULL, NULL, NULL, NULL, 3, NULL, '2021-03-04', NULL, NULL, NULL, NULL, NULL, NULL, 'New Zeland', '2021-03-04 18:08:33', '2021-03-04 18:08:33'),
(3, 'Md. Razibur Rahman', 'razibeee2014@gmail.com', '01737988947', NULL, 'Bangladesh', NULL, NULL, NULL, NULL, NULL, 2, NULL, '2021-03-11', NULL, NULL, NULL, 'images/art.png', 'images/New Microsoft Word Document.docx', NULL, 'Bangladesh', '2021-03-04 18:27:52', '2021-03-04 18:27:52'),
(4, 'Md. Razibur Rahman', 'razibeee2014@gmail.com', '01737988947', NULL, 'Bangladesh', NULL, NULL, NULL, NULL, NULL, 2, NULL, '2021-03-08', NULL, NULL, NULL, 'images/12.jpg', 'images/art.png', 'images/dv.txt', 'Bangladesh', '2021-03-04 18:31:48', '2021-03-04 18:31:48'),
(5, 'Md. Razibur Rahman', 'razibeee2014@gmail.com', '01737988947', NULL, 'Bangladesh', NULL, NULL, NULL, NULL, NULL, 2, NULL, '2021-03-05', NULL, NULL, NULL, NULL, NULL, NULL, 'Bangladesh', '2021-03-04 18:43:19', '2021-03-04 18:43:19'),
(6, 'Md. Razibur Rahman', 'razibeee2014@gmail.com', '01737988947', NULL, 'Bangladesh', NULL, NULL, NULL, NULL, NULL, 2, NULL, '2021-03-10', NULL, NULL, NULL, 'images/art.png', 'images/New Microsoft Word Document.docx', NULL, 'Bangladesh', '2021-03-04 18:56:15', '2021-03-04 19:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `widraws`
--

CREATE TABLE `widraws` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widraw_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `widraws`
--

INSERT INTO `widraws` (`id`, `bank_id`, `checkno`, `date`, `branch_name`, `check_image`, `widraw_name`, `amount`, `created_at`, `updated_at`) VALUES
(1, '1', '134567', '2021-02-10', 'Mohammadpur', NULL, 'wertyuk', '100000.00', '2021-02-24 01:53:39', '2021-02-24 01:53:39'),
(2, '1', 'r452w34567', '2020-12-22', 'Mohammadpur', NULL, 'Mitul', '20000.00', '2021-02-25 02:13:32', '2021-02-25 02:13:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_loans`
--
ALTER TABLE `bank_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_loan_adds`
--
ALTER TABLE `bank_loan_adds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_loan_expenses`
--
ALTER TABLE `bank_loan_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashes`
--
ALTER TABLE `cashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashopens`
--
ALTER TABLE `cashopens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_payments`
--
ALTER TABLE `client_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invest_adds`
--
ALTER TABLE `invest_adds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invest_expenses`
--
ALTER TABLE `invest_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invest_money`
--
ALTER TABLE `invest_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
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
-- Indexes for table `openbanks`
--
ALTER TABLE `openbanks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others_expenditures`
--
ALTER TABLE `others_expenditures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_loans`
--
ALTER TABLE `other_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_loan_adds`
--
ALTER TABLE `other_loan_adds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_loan_expenses`
--
ALTER TABLE `other_loan_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_payments`
--
ALTER TABLE `project_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widraws`
--
ALTER TABLE `widraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_loans`
--
ALTER TABLE `bank_loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_loan_adds`
--
ALTER TABLE `bank_loan_adds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_loan_expenses`
--
ALTER TABLE `bank_loan_expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashes`
--
ALTER TABLE `cashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cashopens`
--
ALTER TABLE `cashopens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `client_payments`
--
ALTER TABLE `client_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invest_adds`
--
ALTER TABLE `invest_adds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invest_expenses`
--
ALTER TABLE `invest_expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invest_money`
--
ALTER TABLE `invest_money`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `openbanks`
--
ALTER TABLE `openbanks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `others_expenditures`
--
ALTER TABLE `others_expenditures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_loans`
--
ALTER TABLE `other_loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `other_loan_adds`
--
ALTER TABLE `other_loan_adds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `other_loan_expenses`
--
ALTER TABLE `other_loan_expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_payments`
--
ALTER TABLE `project_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `widraws`
--
ALTER TABLE `widraws`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
