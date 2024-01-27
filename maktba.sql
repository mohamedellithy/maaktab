-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 27, 2024 at 07:28 PM
-- Server version: 5.7.36
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maktba`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fields` longtext COLLATE utf8mb4_unicode_ci,
  `main_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_main_category_id_foreign` (`main_category_id`),
  KEY `applications_child_category_id_foreign` (`child_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `app_name`, `fields`, `main_category_id`, `child_category_id`, `created_at`, `updated_at`) VALUES
(7, 'نموذج طلب مشروع جديد #1', '[\"{\\\"name\\\":\\\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\\\",\\\"type\\\":\\\"text\\\"}\",\"{\\\"name\\\":\\\"\\u0631\\u0642\\u0645 \\u0627\\u0644\\u062c\\u0648\\u0627\\u0644\\\",\\\"type\\\":\\\"text\\\"}\",\"{\\\"name\\\":\\\"\\u0648\\u0635\\u0641 \\u0627\\u0644\\u0645\\u0634\\u0631\\u0648\\u0639\\\",\\\"type\\\":\\\"textarea\\\"}\",\"{\\\"name\\\":\\\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0637\\u0644\\u0628 \\u0627\\u0644\\u0645\\u0634\\u0631\\u0648\\u0639\\\",\\\"type\\\":\\\"date\\\"}\",\"{\\\"name\\\":\\\"\\u0645\\u0631\\u0641\\u0642\\u0627\\u062a \\u0627\\u0644\\u0645\\u0634\\u0631\\u0648\\u0639\\\",\\\"type\\\":\\\"file\\\"}\"]', 14, 19, '2024-01-13 09:14:55', '2024-01-13 10:33:10'),
(8, 'نموذج طلب مشروع جديد #2', '[\"{\\\"name\\\":\\\"\\u0631\\u0642\\u0645 \\u0627\\u0644\\u062c\\u0648\\u0627\\u0644\\\",\\\"type\\\":\\\"text\\\"}\",\"{\\\"name\\\":\\\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\\\",\\\"type\\\":\\\"text\\\"}\",\"{\\\"name\\\":\\\"\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0634\\u0631\\u0648\\u0639\\\",\\\"type\\\":\\\"textarea\\\"}\",\"{\\\"name\\\":\\\"\\u0645\\u0631\\u0641\\u0642\\u0627\\u062a \\u0627\\u0644\\u0645\\u0634\\u0631\\u0648\\u0639 \\u0648 \\u0627\\u0644\\u0628\\u0637\\u0627\\u0642\\u0629\\\",\\\"type\\\":\\\"file\\\"}\",\"{\\\"name\\\":\\\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0646\\u062a\\u0647\\u0627\\u0621 \\u0627\\u0644\\u062a\\u0646\\u0641\\u064a\\u0630\\\",\\\"type\\\":\\\"date\\\"}\"]', 12, 17, '2024-01-13 10:51:34', '2024-01-13 10:51:34'),
(9, 'استمارة طلب خدمة استشارات', '[\"{\\\"name\\\":\\\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644\\\",\\\"type\\\":\\\"text\\\"}\",\"{\\\"name\\\":\\\"\\u0631\\u0642\\u0645 \\u0627\\u0644\\u062c\\u0648\\u0627\\u0644 \\\",\\\"type\\\":\\\"text\\\"}\",\"{\\\"name\\\":\\\"\\u0645\\u0631\\u0641\\u0642\\u0627\\u062a \\u0627\\u0644\\u0637\\u0644\\u0628\\\",\\\"type\\\":\\\"file\\\"}\",\"{\\\"name\\\":\\\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\\\",\\\"type\\\":\\\"text\\\"}\"]', 14, 19, '2024-01-17 18:56:08', '2024-01-17 18:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_foreign` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent`, `created_at`, `updated_at`) VALUES
(11, 'التصميم', NULL, '2024-01-11 14:20:40', '2024-01-11 14:23:46'),
(12, 'التسويق', NULL, '2024-01-11 14:20:48', '2024-01-11 14:20:48'),
(13, 'الاعلانات', NULL, '2024-01-11 14:20:54', '2024-01-11 14:20:54'),
(14, 'الاستثمارات', NULL, '2024-01-11 14:21:01', '2024-01-11 14:21:01'),
(15, 'الدعايا العالمية', NULL, '2024-01-11 14:21:08', '2024-01-11 14:21:32'),
(16, 'التسويق الاون لاين', 12, '2024-01-11 14:21:48', '2024-01-11 14:23:32'),
(17, 'التسويق الأوف لاين', 12, '2024-01-11 14:24:04', '2024-01-11 14:24:04'),
(18, 'الاستثمار العالمي', 14, '2024-01-11 14:24:23', '2024-01-11 14:24:23'),
(19, 'الاسثمار المحلي', 14, '2024-01-11 14:24:38', '2024-01-11 14:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `discount_type` enum('precent','value') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'precent',
  `value` double(8,3) NOT NULL,
  `status` enum('active','un-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `count_used` int(11) DEFAULT NULL,
  `products` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_products`
--

DROP TABLE IF EXISTS `coupon_products`;
CREATE TABLE IF NOT EXISTS `coupon_products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_products_coupon_id_foreign` (`coupon_id`),
  KEY `coupon_products_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE IF NOT EXISTS `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `download_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_description` text COLLATE utf8mb4_unicode_ci,
  `download_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_attachments_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'download',
  `download_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pdf',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `downloads_project_id_foreign` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `project_id`, `download_name`, `download_description`, `download_link`, `download_attachments_id`, `download_status`, `download_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'ملف جديد للمشاهدة', '<p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span><br></p>', 'https://www.youtube.com/watch?v=8r-qaCbKVIA', '1', 'without_download', 'image', '2024-01-21 09:52:27', '2024-01-21 10:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `path`, `name`, `size`, `type`, `alt`, `created_at`, `updated_at`) VALUES
(1, 'services/image/image-3_1705169743.jpg', 'image-3_1705169743.jpg', '51657', 'image/jpeg', NULL, '2024-01-13 16:15:43', '2024-01-13 16:15:43'),
(2, 'services/image/image-3_1705169813.jpg', 'image-3_1705169813.jpg', '51657', 'image/jpeg', NULL, '2024-01-13 16:16:53', '2024-01-13 16:16:53'),
(3, 'services/image/image-2_1705170129.jpg', 'image-2_1705170129.jpg', '39726', 'image/jpeg', NULL, '2024-01-13 16:22:09', '2024-01-13 16:22:09'),
(4, 'services/image/WhatsApp Image 2023-11-12 at 21.14.13_864e3e21_1705170225.jpg', 'WhatsApp Image 2023-11-12 at 21.14.13_864e3e21_1705170225.jpg', '69007', 'image/jpeg', NULL, '2024-01-13 16:23:45', '2024-01-13 16:23:45'),
(5, 'services/image/image-1_1705170499.jpg', 'image-1_1705170499.jpg', '50749', 'image/jpeg', NULL, '2024-01-13 16:28:19', '2024-01-13 16:28:19'),
(6, 'services/image/image-3_1705173243.jpg', 'image-3_1705173243.jpg', '51657', 'image/jpeg', NULL, '2024-01-13 17:14:03', '2024-01-13 17:14:03'),
(7, 'services/image/image-3_1705173270.jpg', 'image-3_1705173270.jpg', '51657', 'image/jpeg', NULL, '2024-01-13 17:14:30', '2024-01-13 17:14:30'),
(8, 'services/image/image-3_1705173432.jpg', 'image-3_1705173432.jpg', '51657', 'image/jpeg', NULL, '2024-01-13 17:17:12', '2024-01-13 17:17:12'),
(9, 'services/image/image-3_1705173499.jpg', 'image-3_1705173499.jpg', '51657', 'image/jpeg', NULL, '2024-01-13 17:18:19', '2024-01-13 17:18:19'),
(10, 'services/image/1Capture_1705525104.PNG', '1Capture_1705525104.PNG', '74939', 'image/png', NULL, '2024-01-17 18:58:24', '2024-01-17 18:58:24'),
(12, 'services/image/image-3_1705786099.jpg', 'image-3_1705786099.jpg', '51657', 'image/jpeg', NULL, '2024-01-20 19:28:19', '2024-01-20 19:28:19'),
(14, 'services/image/image-3_1705786331.jpg', 'image-3_1705786331.jpg', '51657', 'image/jpeg', NULL, '2024-01-20 19:32:11', '2024-01-20 19:32:11'),
(16, 'services/image/image-3_1705786414.jpg', 'image-3_1705786414.jpg', '51657', 'image/jpeg', NULL, '2024-01-20 19:33:34', '2024-01-20 19:33:34'),
(17, 'services/image/image-3_1705840122.jpg', 'image-3_1705840122.jpg', '51657', 'image/jpeg', NULL, '2024-01-21 10:28:43', '2024-01-21 10:28:43'),
(18, 'services/image/beneficiary-files-20240123-1706010827_1706011307.pdf', 'beneficiary-files-20240123-1706010827_1706011307.pdf', '172795', 'application/pdf', NULL, '2024-01-23 10:01:47', '2024-01-23 10:01:47'),
(19, 'services/image/family-record-20240123-1706010848_1706011307.pdf', 'family-record-20240123-1706010848_1706011307.pdf', '160123', 'application/pdf', NULL, '2024-01-23 10:01:47', '2024-01-23 10:01:47'),
(20, 'services/image/banner-2_1706099464.png', 'banner-2_1706099464.png', '1347595', 'image/png', NULL, '2024-01-24 10:31:04', '2024-01-24 10:31:04'),
(21, 'services/image/ayroui_1706105267.svg', 'ayroui_1706105267.svg', '1454', 'image/svg+xml', NULL, '2024-01-24 12:07:48', '2024-01-24 12:07:48'),
(22, 'services/image/ecommerce-html_1706105268.svg', 'ecommerce-html_1706105268.svg', '11946', 'image/svg+xml', NULL, '2024-01-24 12:07:48', '2024-01-24 12:07:48'),
(23, 'services/image/graygrids_1706105268.svg', 'graygrids_1706105268.svg', '10753', 'image/svg+xml', NULL, '2024-01-24 12:07:48', '2024-01-24 12:07:48'),
(24, 'services/image/lineicons_1706105268.svg', 'lineicons_1706105268.svg', '5850', 'image/svg+xml', NULL, '2024-01-24 12:07:48', '2024-01-24 12:07:48'),
(25, 'services/image/tailwindtemplates_1706105268.svg', 'tailwindtemplates_1706105268.svg', '8716', 'image/svg+xml', NULL, '2024-01-24 12:07:48', '2024-01-24 12:07:48'),
(26, 'services/image/uideck_1706105268.svg', 'uideck_1706105268.svg', '6616', 'image/svg+xml', NULL, '2024-01-24 12:07:48', '2024-01-24 12:07:48'),
(27, 'services/image/blog-02_1706131104.jpg', 'blog-02_1706131104.jpg', '135227', 'image/jpeg', NULL, '2024-01-24 19:18:24', '2024-01-24 19:18:24'),
(28, 'services/image/team-01_1706132335.png', 'team-01_1706132335.png', '59619', 'image/png', NULL, '2024-01-24 19:38:55', '2024-01-24 19:38:55'),
(29, 'services/image/team-02_1706132339.png', 'team-02_1706132339.png', '56380', 'image/png', NULL, '2024-01-24 19:38:59', '2024-01-24 19:38:59'),
(30, 'services/image/team-03_1706132343.png', 'team-03_1706132343.png', '54832', 'image/png', NULL, '2024-01-24 19:39:03', '2024-01-24 19:39:03'),
(31, 'services/image/team-04_1706132346.png', 'team-04_1706132346.png', '55458', 'image/png', NULL, '2024-01-24 19:39:06', '2024-01-24 19:39:06'),
(32, 'services/image/blog-02_1706210703.jpg', 'blog-02_1706210703.jpg', '135227', 'image/jpeg', NULL, '2024-01-25 17:25:03', '2024-01-25 17:25:03'),
(33, 'services/image/blog-02_1706210920.jpg', 'blog-02_1706210920.jpg', '135227', 'image/jpeg', NULL, '2024-01-25 17:28:40', '2024-01-25 17:28:40'),
(34, 'services/image/blog-02_1706211246.jpg', 'blog-02_1706211246.jpg', '135227', 'image/jpeg', NULL, '2024-01-25 17:34:06', '2024-01-25 17:34:06'),
(35, 'services/image/blog-02_1706340594.jpg', 'blog-02_1706340594.jpg', '135227', 'image/jpeg', NULL, '2024-01-27 05:29:55', '2024-01-27 05:29:55'),
(36, 'services/image/blog-02_1706340682.jpg', 'blog-02_1706340682.jpg', '135227', 'image/jpeg', NULL, '2024-01-27 05:31:22', '2024-01-27 05:31:22'),
(37, 'services/image/blog-02_1706340942.jpg', 'blog-02_1706340942.jpg', '135227', 'image/jpeg', NULL, '2024-01-27 05:35:42', '2024-01-27 05:35:42'),
(38, 'services/image/blog-02_1706340968.jpg', 'blog-02_1706340968.jpg', '135227', 'image/jpeg', NULL, '2024-01-27 05:36:08', '2024-01-27 05:36:08'),
(39, 'services/image/blog-02_1706341479.jpg', 'blog-02_1706341479.jpg', '135227', 'image/jpeg', NULL, '2024-01-27 05:44:39', '2024-01-27 05:44:39'),
(40, 'services/image/blog-02_1706341492.jpg', 'blog-02_1706341492.jpg', '135227', 'image/jpeg', NULL, '2024-01-27 05:44:52', '2024-01-27 05:44:52'),
(41, 'services/image/blog-02_1706341512.jpg', 'blog-02_1706341512.jpg', '135227', 'image/jpeg', NULL, '2024-01-27 05:45:12', '2024-01-27 05:45:12'),
(42, 'services/image/beneficiary-files-20240123-1706010827_1706341544.pdf', 'beneficiary-files-20240123-1706010827_1706341544.pdf', '172795', 'application/pdf', NULL, '2024-01-27 05:45:44', '2024-01-27 05:45:44'),
(43, 'services/image/family-record-20240123-1706010848_1706341648.pdf', 'family-record-20240123-1706010848_1706341648.pdf', '160123', 'application/pdf', NULL, '2024-01-27 05:47:28', '2024-01-27 05:47:28'),
(44, 'services/image/family-record-20240123-1706010848_1706341693.pdf', 'family-record-20240123-1706010848_1706341693.pdf', '160123', 'application/pdf', NULL, '2024-01-27 05:48:13', '2024-01-27 05:48:13'),
(45, 'services/image/family-record-20240123-1706010848_1706341748.pdf', 'family-record-20240123-1706010848_1706341748.pdf', '160123', 'application/pdf', NULL, '2024-01-27 05:49:08', '2024-01-27 05:49:08'),
(46, 'services/image/beneficiary-files-20240123-1706010827_1706362787.pdf', 'beneficiary-files-20240123-1706010827_1706362787.pdf', '172795', 'application/pdf', NULL, '2024-01-27 11:39:47', '2024-01-27 11:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `sender` enum('client','platform') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'platform',
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `attachments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_order_id_foreign` (`order_id`),
  KEY `messages_client_id_foreign` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `order_id`, `client_id`, `sender`, `message`, `attachments`, `read`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص', '1,2', '0', '2024-01-15 21:16:25', '2024-01-17 21:16:25'),
(2, 12, 2, 'platform', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '1,2', '0', '2024-01-15 21:16:25', '2024-01-17 21:16:25'),
(3, 12, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '38', '0', '2024-01-27 05:36:08', '2024-01-27 05:36:08'),
(4, 12, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '39', '0', '2024-01-27 05:44:39', '2024-01-27 05:44:39'),
(5, 12, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '40', '0', '2024-01-27 05:44:52', '2024-01-27 05:44:52'),
(6, 12, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '41', '0', '2024-01-27 05:45:12', '2024-01-27 05:45:12'),
(7, 12, 2, 'client', 'منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع', '42', '0', '2024-01-27 05:45:44', '2024-01-27 05:45:44'),
(8, 12, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '43', '0', '2024-01-27 05:47:28', '2024-01-27 05:47:28'),
(9, 12, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '44', '0', '2024-01-27 05:48:13', '2024-01-27 05:48:13'),
(10, 12, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '45', '0', '2024-01-27 05:49:08', '2024-01-27 05:49:08'),
(11, 9, 2, 'client', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص', '1,2', '0', '2024-01-15 20:16:25', '2024-01-17 21:16:25'),
(13, 12, 2, 'platform', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ', '1,2,3,4', '0', '2024-01-27 11:38:53', '2024-01-27 11:38:53'),
(14, 12, 2, 'client', 'لمحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل', '46', '0', '2024-01-27 11:39:47', '2024-01-27 11:39:47'),
(15, 12, 2, 'platform', 'الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', NULL, '0', '2024-01-27 11:40:21', '2024-01-27 11:40:21'),
(16, 12, 2, 'platform', 'الشكل الخارجي', NULL, '0', '2024-01-27 17:06:16', '2024-01-27 17:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_13_141525_create_images_table', 1),
(7, '2023_07_17_115209_create_products_table', 1),
(11, '2023_07_22_122546_create_pages_table', 1),
(12, '2023_07_23_101429_create_settings_table', 1),
(14, '2023_08_01_090713_create_reviews_table', 1),
(15, '2023_12_09_190243_add_status_to_services_table', 1),
(16, '2023_12_11_085630_create_coupons_table', 1),
(17, '2023_12_11_212416_create_coupon_products_table', 1),
(18, '2023_12_12_134710_add_coupon_id_to_orders', 1),
(19, '2023_12_12_185153_add_discount_to_products', 1),
(20, '2023_12_12_201159_add_starting_and_ending_to_products', 1),
(21, '2024_01_08_124118_create_categories_table', 2),
(22, '2024_01_12_002817_create_applications_table', 3),
(24, '2023_07_13_142237_create_services_table', 4),
(28, '2023_07_17_115209_create_projects_table', 5),
(30, '2023_07_27_082940_create_downloads_table', 6),
(32, '2023_07_20_143326_create_orders_table', 7),
(33, '2023_07_20_153922_create_order_items_table', 7),
(34, '2023_07_22_095546_create_payments_table', 7),
(35, '2024_01_20_143003_create_order_attachments_table', 7),
(36, '2024_01_22_142613_create_proposals_table', 8),
(37, '2024_01_25_210002_create_messages_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `modelable_id` int(11) NOT NULL,
  `modelable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_total` double DEFAULT NULL,
  `proposal_id` int(191) DEFAULT NULL,
  `order_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `read` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  KEY `orders_application_id_foreign` (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `customer_id`, `application_id`, `modelable_id`, `modelable_type`, `order_total`, `proposal_id`, `order_status`, `read`, `created_at`, `updated_at`) VALUES
(8, 'mvUGB82r5p', 2, 8, 1, 'App\\Models\\Service', NULL, NULL, 'pending', 1, '2024-01-20 19:33:34', '2024-01-21 07:18:47'),
(9, 'zAAJ8QlagS', 2, 8, 1, 'App\\Models\\Project', 80, 6, 'progress', 1, '2024-01-21 10:28:42', '2024-01-23 16:22:25'),
(12, 'ZruSPN8KcY', 2, 8, 1, 'App\\Models\\Project', 180, 8, 'completed', 1, '2024-01-25 17:34:06', '2024-01-27 08:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_attachments`
--

DROP TABLE IF EXISTS `order_attachments`;
CREATE TABLE IF NOT EXISTS `order_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('media','text') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_attachments_order_id_foreign` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_attachments`
--

INSERT INTO `order_attachments` (`id`, `order_id`, `name`, `value`, `type`, `created_at`, `updated_at`) VALUES
(6, 8, 'رقم_الجوال', '01026051966', 'text', NULL, NULL),
(7, 8, 'البريد_الالكتروني', 'mohamed@gmail.com', 'text', NULL, NULL),
(8, 8, 'تفاصيل_المشروع', 'لوريم لوريم لوريم', 'text', NULL, NULL),
(9, 8, 'مرفقات_المشروع_و_البطاقة', '16', 'media', NULL, NULL),
(10, 8, 'تاريخ_انتهاء_التنفيذ', '2024-01-01', 'text', NULL, NULL),
(11, 9, 'رقم_الجوال', '01026051966', 'text', NULL, NULL),
(12, 9, 'البريد_الالكتروني', 'mohamed@gmail.com', 'text', NULL, NULL),
(13, 9, 'تفاصيل_المشروع', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخاص هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة', 'text', NULL, NULL),
(14, 9, 'مرفقات_المشروع_و_البطاقة', '17', 'media', NULL, NULL),
(15, 9, 'تاريخ_انتهاء_التنفيذ', '2024-01-17', 'text', NULL, NULL),
(26, 12, 'رقم_الجوال', '01026051966', 'text', NULL, NULL),
(27, 12, 'البريد_الالكتروني', 'mohamed@gmail.com', 'text', NULL, NULL),
(28, 12, 'تفاصيل_المشروع', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص', 'text', NULL, NULL),
(29, 12, 'مرفقات_المشروع_و_البطاقة', '34', 'media', NULL, NULL),
(30, 12, 'تاريخ_انتهاء_التنفيذ', '2024-01-23', 'text', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'header',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `menu_position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`),
  KEY `pages_thumbnail_id_foreign` (`thumbnail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `thumbnail_id`, `content`, `position`, `status`, `meta_title`, `meta_description`, `menu_position`, `created_at`, `updated_at`) VALUES
(1, 'الرئيسية', '/', NULL, 'a:6:{s:13:\"slider_banner\";a:7:{s:6:\"enable\";s:6:\"active\";s:7:\"heading\";N;s:11:\"sub_heading\";N;s:11:\"description\";N;s:12:\"thumbnail_id\";s:2:\"20\";s:10:\"video_link\";N;s:8:\"video_id\";N;}s:14:\"partner_banner\";a:3:{s:6:\"enable\";s:6:\"active\";s:11:\"sub_heading\";s:95:\"موثوق به من قبل أكثر من 1000 شركة فى منطقة الشرق الأوسط\";s:13:\"thumbnails_id\";s:17:\"21,22,23,24,25,26\";}s:12:\"about_banner\";a:5:{s:6:\"enable\";s:6:\"active\";s:11:\"sub_heading\";s:15:\"نبذة عنا\";s:7:\"heading\";s:71:\"وكالة مكتب لاعمال التصميم و الاستشارات\";s:11:\"description\";s:1173:\"<p><span style=\"color: rgb(49, 46, 46); font-family: Tajawal, sans-serif; font-size: 17px; text-align: justify;\">لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه … بروشور او فلاير على سبيل المثال … او نماذج مواقع انترنت … وعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي. وخلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد. من كتاب “حول أقاصي الخير والشر</span><br></p>\";s:16:\"thumbnail_id_big\";s:2:\"27\";}s:16:\"introduce_banner\";a:6:{s:6:\"enable\";s:6:\"active\";s:7:\"heading\";s:16:\"مميزاتنا\";s:11:\"sub_heading\";s:73:\"مميزاتنا التى نقدمها بشكل حصري لعملائنا\";s:11:\"description\";s:224:\"مميزاتنا التى نقدمها بشكل حصري لعملائنا  مميزاتنا التى نقدمها بشكل حصري لعملائنا   مميزاتنا التى نقدمها بشكل حصري لعملائنا\";s:13:\"feature_title\";a:4:{i:0;s:20:\"Free and Open-Source\";i:1;s:20:\"Free and Open-Source\";i:2;s:20:\"Free and Open-Source\";i:3;s:20:\"Free and Open-Source\";}s:19:\"feature_description\";a:4:{i:0;s:98:\"Lorem Ipsum is simply dummy text of the printing and industry. Lorem Ipsum is simply dummy text of\";i:1;s:98:\"Lorem Ipsum is simply dummy text of the printing and industry. Lorem Ipsum is simply dummy text of\";i:2;s:98:\"Lorem Ipsum is simply dummy text of the printing and industry. Lorem Ipsum is simply dummy text of\";i:3;s:98:\"Lorem Ipsum is simply dummy text of the printing and industry. Lorem Ipsum is simply dummy text of\";}}s:14:\"contact_banner\";a:5:{s:6:\"enable\";s:6:\"active\";s:7:\"heading\";s:36:\"تواصل معنا لمساعدتك\";s:11:\"description\";N;s:8:\"location\";s:52:\"401 Broadway, 24th Floor, Orchard Cloud View, London\";s:6:\"emails\";s:43:\"info@yourdomain.com\r\ncontact@yourdomain.com\";}s:18:\"our_reviews_banner\";a:7:{s:6:\"enable\";s:6:\"active\";s:7:\"heading\";s:21:\"رأي عملائنا\";s:11:\"sub_heading\";s:42:\"ماذا يقول عملائنا عنا ؟\";s:11:\"description\";s:104:\"منصة رائعة و متميزة تقدم لنا العديد من الخدمات و المميزات\";s:13:\"reviewer_name\";a:3:{i:0;s:21:\"محمد الليثي\";i:1;s:21:\"أحمد الليثي\";i:2;s:15:\"على سعيد\";}s:20:\"reviewer_description\";a:3:{i:0;s:126:\"منصة رائعة و متميزة تقدم لنا العديد من الخدمات و المميزات متميزة تقدم\";i:1;s:126:\"منصة رائعة و متميزة تقدم لنا العديد من الخدمات و المميزات متميزة تقدم\";i:2;s:126:\"منصة رائعة و متميزة تقدم لنا العديد من الخدمات و المميزات متميزة تقدم\";}s:12:\"thumbnail_id\";a:3:{i:0;s:2:\"28\";i:1;s:2:\"29\";i:2;s:2:\"31\";}}}', 'header', 'active', 'الرئيسية', 'الرئيسية', '10', '2024-01-08 09:33:04', '2024-01-24 22:07:26'),
(2, 'المنتجات', 'projects', NULL, '', 'header', 'active', 'المشاريع', 'المشاريع', '40', '2024-01-08 09:33:04', '2024-01-08 09:33:04'),
(3, 'الخدمات', 'services', NULL, NULL, 'header', 'active', 'الخدمات', 'الخدمات', '10', '2024-01-08 09:33:04', '2024-01-20 07:39:27'),
(4, 'تواصل معنا', 'contact-us', NULL, '', 'header', 'active', 'تواصل معنا', 'تواصل معنا', '60', '2024-01-08 09:33:04', '2024-01-08 09:33:04'),
(5, 'من نحن', 'من-نحن', NULL, '', 'header', 'active', 'من نحن', 'من نحن', '20', '2024-01-08 09:33:04', '2024-01-08 09:33:04'),
(6, 'سياسة الخصوصية', 'سياسة-الخصوصية', NULL, '', 'header', 'active', 'سياسة الخصوصية', 'سياسة الخصوصية', '50', '2024-01-08 09:33:04', '2024-01-08 09:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-paid',
  `getaway` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'thawani',
  `total_payment` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `transaction_id`, `status_payment`, `getaway`, `total_payment`, `created_at`, `updated_at`) VALUES
(2, 12, 'KLf4029ywLLDgsOXYD8dnXtz0GrUwDw6QCW5aIglC1Ft6ehsr3yJMbcOxNTNnUsKzTOzTfaDATdzJ23Ye91cTvu3MATXJaxzJOZs', 'success', 'thawani', 180, '2024-01-25 18:56:48', '2024-01-25 18:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `discount` double DEFAULT NULL,
  `attachments_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_type` enum('percent','value') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percent',
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_thumbnail_id_foreign` (`thumbnail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `attachments_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `main_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_thumbnail_id_foreign` (`thumbnail_id`),
  KEY `projects_main_category_id_foreign` (`main_category_id`),
  KEY `projects_child_category_id_foreign` (`child_category_id`),
  KEY `projects_application_id_foreign` (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `short_description`, `description`, `thumbnail_id`, `status`, `slug`, `price`, `attachments_id`, `meta_title`, `meta_description`, `main_category_id`, `child_category_id`, `application_id`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, 'مشروع رقم تجريبي رقم #2', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', '<p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><h2><span style=\"font-family: Tajawal; font-size: 24px;\"><font color=\"#731842\">المحتوى المقروء لصفحة ما سيلهي القارئ</font></span></h2><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span><br></p><h2><font color=\"#731842\"><span style=\"font-size: 24px;\">التركيز على الشكل الخارجي للنص</span><span style=\"font-family: Tajawal; font-size: 24px;\">﻿</span></font></h2><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(115, 24, 66); font-family: Tajawal; font-size: 24px; text-align: var(--bs-body-text-align);\">المحتوى المقروء لصفحة ما سيلهي القارئ</span><br></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><h2><span style=\"font-family: Tajawal; font-size: 24px;\"><font color=\"#731842\">المحتوى المقروء لصفحة ما سيلهي القارئ</font></span></h2><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><br></p><p></p>', 3, 'active', 'مشروع-جديد', 500, '1,2,3', NULL, NULL, 12, 16, 8, '2024-01-01', '2024-01-31', '2024-01-13 22:34:53', '2024-01-21 10:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

DROP TABLE IF EXISTS `proposals`;
CREATE TABLE IF NOT EXISTS `proposals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `attachments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `status` enum('accepted','refused','wait') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'wait',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proposals_order_id_foreign` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `order_id`, `description`, `attachments`, `price`, `status`, `created_at`, `updated_at`) VALUES
(3, 9, 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخاص هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة', '1,2', 180, 'refused', '2024-01-23 12:20:29', '2024-01-23 16:22:25'),
(4, 9, 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخاص هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة', '1,2', 200, 'refused', NULL, '2024-01-23 16:22:25'),
(5, 9, 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخاص هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة', '1,2', 210, 'refused', NULL, '2024-01-23 16:22:25'),
(6, 9, 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخاص هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة', '1,2', 80, 'accepted', '2024-01-23 12:25:42', '2024-01-23 16:22:25'),
(8, 12, 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص', '18,19', 180, 'accepted', '2024-01-25 18:29:21', '2024-01-25 18:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `degree` int(11) NOT NULL DEFAULT '1',
  `review` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `replay_on` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_customer_id_foreign` (`customer_id`),
  KEY `reviews_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` bigint(20) UNSIGNED DEFAULT NULL,
  `whatsapStatus` tinyint(1) NOT NULL DEFAULT '0',
  `whatsapNumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loginStatus` tinyint(1) NOT NULL DEFAULT '0',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','unactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_image_foreign` (`image`),
  KEY `services_main_category_id_foreign` (`main_category_id`),
  KEY `services_child_category_id_foreign` (`child_category_id`),
  KEY `services_application_id_foreign` (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`, `whatsapStatus`, `whatsapNumber`, `loginStatus`, `meta_title`, `meta_description`, `slug`, `main_category_id`, `child_category_id`, `application_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'خدمة جديدة و ممتعة للتجربة رقم 21', '<p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><h2><span style=\"font-family: Tajawal; font-size: 24px;\"><font color=\"#731842\">المحتوى المقروء لصفحة ما سيلهي القارئ</font></span></h2><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span><br></p><h2><font color=\"#731842\"><span style=\"font-size: 24px;\">التركيز على الشكل الخارجي للنص</span><span style=\"font-family: Tajawal; font-size: 24px;\">﻿</span></font></h2><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(115, 24, 66); font-family: Tajawal; font-size: 24px; text-align: var(--bs-body-text-align);\">المحتوى المقروء لصفحة ما سيلهي القارئ</span><br></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><h2><span style=\"font-family: Tajawal; font-size: 24px;\"><font color=\"#731842\">المحتوى المقروء لصفحة ما سيلهي القارئ</font></span></h2><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: Tajawal; font-size: 14px;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام «هنا يوجد محتوى نصي، هنا يوجد محتوى نصي» فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل افتراضي كنموذج عن النص</span></p><p><br></p>', 4, 1, '201026051966', 1, NULL, NULL, 'خدمة-جديدة-و-ممتعة-للتجربة-رقم-21', 12, 16, 8, 'active', '2024-01-13 19:52:45', '2024-01-20 11:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'website_name', 'الخطوة الرائدة للتجارة و الاستثمار', 'general', NULL, NULL),
(2, 'admin_email', 'admin@djazairelkheir.com', 'general', NULL, NULL),
(3, 'website_currency', 'SAR', 'general', NULL, NULL),
(4, 'social_facebook', '#', 'general', NULL, NULL),
(5, 'social_twitter', '#', 'general', NULL, NULL),
(6, 'social_insta', '#', 'general', NULL, NULL),
(7, 'website_linkedin', '#', 'general', NULL, NULL),
(8, 'social_youtube', '#', 'general', NULL, NULL),
(9, 'website_whastapp', '201026051966', 'general', NULL, NULL),
(10, 'website_logo', '', 'general', NULL, NULL),
(11, 'meta_title', '', 'general', NULL, NULL),
(12, 'meta_description', '', 'general', NULL, NULL),
(13, 'thawani_enable', 'active', 'general', NULL, NULL),
(14, 'thawani_api_key', 'rRQ26GcsZzoEhbrP2HZvLYDbn9C9et', 'general', NULL, NULL),
(15, 'thawani_public_key', 'HGvTMLDssJghr9tlN9gr4DVYt0qyBy', 'general', NULL, NULL),
(16, 'thawani_logo', '', 'general', NULL, NULL),
(17, 'payments', 'thawani', 'general', NULL, NULL),
(18, 'thawani_title', 'ثوانى للدفع الالكترونى', 'general', NULL, NULL),
(19, 'website_address', 'مدينة الرياض حي المدينة الصناعية الجديدة عمارة رقم 12', 'general', NULL, NULL),
(20, 'website_location_map', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118833.70252939525!2d39.72464916088559!3d21.446799873768818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c21b4ced818775%3A0x98ab2469cf70c9ce!2sMecca%20Saudi%20Arabia!5e0!3m2!1sen!2seg!4v1691155480604!5m2!1sen!2seg\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'general', NULL, NULL),
(21, 'reviews_enable', 'active', 'general', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 -> admin , 1 -> customer',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active , pending',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `phone_code`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$lhBd2jp8ucLU5e6ScU5.Lu7ToKQ.IrcQPuD/HOzLzY9MqyzkAA9da', NULL, NULL, '0', 'active', NULL, '2024-01-08 09:33:04', '2024-01-08 09:33:04'),
(2, 'mohamed ellithy', 'mohamedellithyfreelancer@gmail.com', NULL, '$2y$10$OXhyT4.zsNQ3qViM13CpoOZaldWZUMQKL2RLnq03tv4E9QyzVh3CG', '1026051966', '20', '1', 'active', NULL, '2024-01-17 10:47:55', '2024-01-27 08:22:55'),
(3, 'mohamed ellithy', 'mohamedellithyfreelancq@gmail.com', NULL, '$2y$10$Y2i.KsEcwbAO9J2yIQisDu.LlsfUgzhsn5BA2lHB8zhsjmi3KM9li', '1080766906', '20', '1', 'active', NULL, '2024-01-17 16:47:24', '2024-01-17 16:47:24');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_child_category_id_foreign` FOREIGN KEY (`child_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `applications_main_category_id_foreign` FOREIGN KEY (`main_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `coupon_products`
--
ALTER TABLE `coupon_products`
  ADD CONSTRAINT `coupon_products_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_attachments`
--
ALTER TABLE `order_attachments`
  ADD CONSTRAINT `order_attachments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_thumbnail_id_foreign` FOREIGN KEY (`thumbnail_id`) REFERENCES `images` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_thumbnail_id_foreign` FOREIGN KEY (`thumbnail_id`) REFERENCES `images` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_child_category_id_foreign` FOREIGN KEY (`child_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_main_category_id_foreign` FOREIGN KEY (`main_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_thumbnail_id_foreign` FOREIGN KEY (`thumbnail_id`) REFERENCES `images` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `services_child_category_id_foreign` FOREIGN KEY (`child_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `services_image_foreign` FOREIGN KEY (`image`) REFERENCES `images` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `services_main_category_id_foreign` FOREIGN KEY (`main_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
