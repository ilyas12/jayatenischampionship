-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2026 at 05:51 PM
-- Server version: 10.6.27-MariaDB
-- PHP Version: 8.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alikhsan_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `terre217_about`
--

CREATE TABLE `terre217_about` (
  `id` int(11) NOT NULL,
  `fkaboutcategoryid` int(11) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_about`
--

INSERT INTO `terre217_about` (`id`, `fkaboutcategoryid`, `description`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, '<p style=\"text-align: justify;\">PT. Sinar Cahaya Cemerlang was established in Jakarta on January 1985. Originally, our business catered to home industries, offering a moderate selection of food processors and kitchen appliances. From a modest beginning, we have since then increased our product offering selection, focusing specifically in bakery equipment. We are now able to cater to modern bakery needs, carrying a wide variety of industrial grade ovens, mixers, proofers, hot/cold showcases, and many others. For larger scale industries, we also carry a selection of semi-auto and auto production line that would be able to provide a streamline and efficient production. With an assortment of high quality equipment from USA, Europe and Taiwan, we are confident that we would be able to provide our customers with an integrated or independent solution for every step of the baking process &ndash; from mixing, forming, proofing, baking to the displaying of the final product.</p>\\r\\n<p>\\r\\n</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>\\r\\n</p>\\r\\n<p style=\"text-align: justify;\">Our mission is to provide a higher level of service experience and a better overall value to our customers. It goes along with our vision in becoming Indonesia&rsquo;s premier one-stop shop for bakery-related equipment. Whether you are a small home industry, a commercial bakery, a medium industry or even a large scale industry, we are ready to assist you in every step of the way, from equipment selection, operation planning, installation, and of course to the after-sales service. There is no secret recipe to our growth, just our commitment to deliver a combination of quality products and services, which in turn translates to lower costs and higher profitability for our customers. Please do not hesitate to contact us; we look forward to helping your business flourish.</p>\\r\\n<p>\\r\\n</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>\\r\\n</p>\\r\\n<p><span style=\"color: #000000;\"><strong>WHAT WE DO</strong></span></p>\\r\\n<p>\\r\\n</p>\\r\\n<p><strong>&nbsp;</strong></p>\\r\\n<p>\\r\\n</p>\\r\\n<p><span style=\"color: #000000;\"><strong>CONSULTATION</strong></span></p>\\r\\n<p>\\r\\n</p>\\r\\n<p style=\"text-align: justify;\">We encourage you to talk to one of our sales representatives to make sure the proper requirement for your production in terms of capacity, facility condition, human resources, and budget.</p>\\r\\n<p>\\r\\n</p>\\r\\n<p><span style=\"color: #000000;\"><strong>PLANNING</strong></span></p>\\r\\n<p>\\r\\n</p>\\r\\n<p style=\"text-align: justify;\">It has been our pride to be able to work with many businesses side by side ever since they started their first operation.&nbsp;&nbsp;Your near future plan is as important as the long term one and it is best to start now.&nbsp;</p>\\r\\n<p>\\r\\n</p>\\r\\n<p><span style=\"color: #000000;\"><strong>SALES</strong></span></p>\\r\\n<p>\\r\\n</p>\\r\\n<p style=\"text-align: justify;\">Our sales and marketing team is helpful and willing to go the extra mile to help you reach your goals.&nbsp;&nbsp;We cater equipment for small, medium, and large-scale production of bakery industry.&nbsp;&nbsp;This includes, home industry, modern bakery, hotel, restaurant and caf&eacute;.</p>\\r\\n<p>\\r\\n</p>\\r\\n<p><span style=\"background-color: #ffffff; color: #000000;\"><strong>INSTALLATION</strong></span></p>\\r\\n<p>\\r\\n</p>\\r\\n<p style=\"text-align: justify;\">The equipment you purchase from us will be completely installed and run on your site.&nbsp;&nbsp;A pre-inspection of the location will be conducted to ensure proper installation and placement.</p>\\r\\n<p>\\r\\n</p>\\r\\n<p><span style=\"background-color: #ffffff; color: #000000;\"><strong>TRAINING</strong></span></p>\\r\\n<p>\\r\\n</p>\\r\\n<p style=\"text-align: justify;\">We understood the importance of keeping your investment for the long run.&nbsp;&nbsp;From the very simple equipment to the most advanced ones, we are ready to train your employees the proper way to operate and maintain them.</p>\\r\\n<p>\\r\\n</p>\\r\\n<p><span style=\"color: #000000;\"><strong>AFTER-SALES SERVICE</strong></span></p>\\r\\n<p>\\r\\n</p>\\r\\n<p style=\"text-align: justify;\">Different production system requires different type of maintenance.&nbsp;&nbsp;Aside from daily maintenance that we recommend, you also need to schedule a periodic service to keep the quality and consistency of your production.&nbsp;&nbsp;We back up the products we sell with 1-year warranty for factory defects and services.&nbsp;&nbsp;We ensure the availability of critical spare-parts to minimize disruption to your production activities.</p>', 1, 1, '2015-06-25 20:04:24', '2017-01-25 07:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_about_category`
--

CREATE TABLE `terre217_about_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_administrator`
--

CREATE TABLE `terre217_administrator` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_administrator`
--

INSERT INTO `terre217_administrator` (`id`, `email`, `password`, `name`, `last_login`, `active`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin@admin.com', '$2y$10$LJOoeh61UlThp4IqNwxxqu9P521lT3GB2W27uzKt6PyI55nox5Or6', 'Administrator', '2022-11-29 13:40:21', 1, '0000-00-00 00:00:00', '2022-11-29 06:40:21', 'Ncfvs5EsPqF8CjJVXOvTLcIgdpf4X7qkw5K8EVlnj2nU7N9OJ2oQB80rsrH6'),
(5, 'ilyas.raswandi@gmail.com', '$2y$10$LJOoeh61UlThp4IqNwxxqu9P521lT3GB2W27uzKt6PyI55nox5Or6', 'Ilyas', '2022-11-29 21:37:10', 1, '2017-02-09 10:24:53', '2022-11-29 14:37:10', ''),
(0, 'asadahlan@duasisimoneychanger.co.id', '$2y$10$hIKnhq/PPWysMe22VxnQvOsuGti1c5y0XNcJN0Sq545/CxQ0lMQIi', 'Ilyasa Dahlan', '2026-07-28 13:02:04', 1, '2022-11-29 06:41:48', '2026-07-28 06:02:04', '');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_brand`
--

CREATE TABLE `terre217_brand` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `custom_url` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_brand`
--

INSERT INTO `terre217_brand` (`id`, `img`, `title`, `url`, `custom_url`, `meta_title`, `meta_keyword`, `meta_description`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'brand1.jpg', 'CHRISTOPHER GUY', 'christopher-guy', NULL, 'christopher guy', 'christopher guy', 'christopher guy', 3, 1, '2017-02-05 05:26:19', '2017-02-08 04:40:12'),
(2, 'brand2.jpg', 'FRENCH HERITAGE', 'french-heritage', NULL, 'french heritage', 'french heritage', 'french heritage', 4, 1, '2017-02-05 05:27:17', '2017-02-08 04:40:12'),
(3, 'brand3.jpg', 'HENKEL HARRIS', 'henkel-harris', NULL, 'henkel harris', 'henkel harris', 'henkel harris', 5, 1, '2017-02-05 05:27:58', '2017-02-08 04:40:12'),
(4, 'brand4.jpg', 'FENDI CASA', 'fendi-casa', NULL, '', '', '', 6, 1, '2017-02-05 10:56:54', '2017-02-08 04:40:12'),
(5, 'brand5.jpg', 'ARMANI / CASA', 'armani-casa', NULL, '', '', '', 7, 1, '2017-02-05 10:57:12', '2017-02-08 04:40:12'),
(6, 'brand6.jpg', 'Kartell', 'kartell', NULL, '', '', '', 8, 1, '2017-02-05 10:57:30', '2017-02-08 04:40:12'),
(7, 'brand7.jpg', 'BOCA DOLOBO', 'boca-dolobo', NULL, '', '', '', 9, 1, '2017-02-05 10:57:52', '2017-02-08 04:40:12'),
(8, 'brand8.jpg', 'POLIFORM', 'poliform', NULL, '', '', '', 10, 1, '2017-02-05 10:58:12', '2017-02-08 04:40:12'),
(9, 'woodard-furniture-logo.png', 'Woodard', 'woodard', NULL, '', '', '', 2, 1, '2017-02-07 06:29:48', '2017-02-08 04:40:12'),
(10, 'Lakeview-logo-250x100.png', 'Lakeview', 'lakeview', 'https://www.youtube.com/watch?v=vScUbKoE-qs', '', '', '', 1, 1, '2017-02-08 04:39:49', '2017-02-10 14:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_category`
--

CREATE TABLE `terre217_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `fkmodulesid` int(11) NOT NULL DEFAULT 0,
  `publish` int(1) NOT NULL DEFAULT 1,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_category`
--

INSERT INTO `terre217_category` (`id`, `name`, `permalink`, `fkmodulesid`, `publish`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'Office', 'office', 1, 1, 1, '2017-03-16 02:59:22', '2017-03-16 02:59:22'),
(2, 'Residences', 'residences', 1, 1, 3, '2017-03-16 02:59:46', '2017-03-16 02:59:46'),
(3, 'Hotel', 'hotel', 1, 1, 2, '2017-03-16 02:59:46', '2017-03-16 02:59:46'),
(4, 'Commercial', 'commercial', 2, 1, 3, '2017-03-16 02:58:20', '2017-03-16 02:58:20'),
(5, 'Accessories', 'accessories', 2, 1, 2, '2017-03-16 02:58:20', '2017-03-16 02:58:20'),
(6, 'Industrial', 'industrial', 1, 1, 4, '2017-03-16 02:59:46', '2017-03-16 02:59:46'),
(8, 'Vintage', 'vintage', 2, 1, 1, '2017-03-16 02:58:20', '2017-03-16 02:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_category_menu`
--

CREATE TABLE `terre217_category_menu` (
  `id` int(11) NOT NULL,
  `fkcategoryid` int(11) DEFAULT NULL,
  `fkmsmenuid` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_config`
--

CREATE TABLE `terre217_config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` mediumtext NOT NULL,
  `config_type` enum('front','back','both') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_config`
--

INSERT INTO `terre217_config` (`id`, `name`, `value`, `config_type`, `created_at`, `updated_at`) VALUES
(1, 'meta_title', 'Duasisi Money Changer', 'front', '2022-08-10 08:45:55', '2017-01-18 03:23:44'),
(2, 'meta_description', 'DuaSisi Money Changer is an authorized Money Changer operated by PT Tetra Duasisi since 1994 in Indonesia\'s two largest cities, Jakarta and Surabaya. We decide to locate our outlet in high-end shopping malls and office buildings to demonstrate our ability to meet and fulfill customers\' foreign exchange needs in a sophisticated modern lifestyle. With over 30 years in the industry, we have six branches. We have 4 branches in Jakarta at Plaza Asia, Plaza Senayan, Senayan City, Mall Grand Indonesia, and 2 branches in Surabaya at Tunjungan Plaza 1 and Ciputra World Surabaya. We are constantly striving to enhance ourselves to better our services.\r\n\r\nWe accept over 15 currencies, including:USD, SGD, AED, AUD, BND, CAD, CHY, EURO, GBP, HKD, JPY, WON, MYR, NTD, SAR, THB & VND.', 'front', '2025-08-01 06:30:38', '2025-08-01 06:30:38'),
(3, 'meta_keywords', 'USD, SGD, AED, AUD, BND, CAD, CHY, EURO, GBP, HKD, JPY, WON, MYR, NTD, SAR, THB & VND', 'front', '2025-08-01 06:30:38', '2025-08-01 06:30:38'),
(34, 'no_reply_name', 'Duasisi no-reply', 'front', '2025-08-03 10:01:32', '0000-00-00 00:00:00'),
(4, 'meta_author', 'Duasisi Money Changer', 'front', '2022-08-10 08:46:03', '0000-00-00 00:00:00'),
(5, 'meta_copyright', 'Copyright &copy; CMS', 'front', '2016-12-23 03:33:44', '0000-00-00 00:00:00'),
(7, 'website_logo', 'logo.png', 'both', '2026-07-27 15:04:42', '2026-07-25 13:21:30'),
(9, 'maintenance_mode', '0', 'front', '2017-02-13 08:15:48', '2017-02-13 08:15:48'),
(13, 'no_reply_email', 'Info@duasisimc.id', 'front', '2026-07-21 02:58:26', '2017-02-08 23:20:08'),
(14, 'email_logo', 'email_logo.png', 'front', '2015-06-23 00:19:39', '0000-00-00 00:00:00'),
(15, 'website_favicon', '', 'both', '2017-02-05 11:45:18', '0000-00-00 00:00:00'),
(18, 'contact_email', 'asadahlan@duasisimoneychanger.co.id', 'front', '2022-10-16 15:23:51', '2015-01-14 17:04:00'),
(19, 'mobile_logo', 'mobilelogo.png', 'front', '2015-06-23 00:21:30', '0000-00-00 00:00:00'),
(28, 'whitelist_ip', '::1', 'front', '2015-06-23 00:21:34', '0000-00-00 00:00:00'),
(33, 'no_reply_name', 'CMS', 'front', '2016-12-23 03:33:53', '0000-00-00 00:00:00'),
(35, 'product_stage_size', '400', 'both', '2015-06-23 00:22:06', '0000-00-00 00:00:00'),
(36, 'product_carousel_size', '100', 'both', '2015-06-23 00:22:08', '0000-00-00 00:00:00'),
(37, 'site_title', 'CMS Administrator', 'back', '2016-12-23 03:33:12', '0000-00-00 00:00:00'),
(38, 'meta_description', 'DuaSisi Money Changer is an authorized Money Changer operated by PT Tetra Duasisi since 1994 in Indonesia\'s two largest cities, Jakarta and Surabaya. We decide to locate our outlet in high-end shopping malls and office buildings to demonstrate our ability to meet and fulfill customers\' foreign exchange needs in a sophisticated modern lifestyle. With over 30 years in the industry, we have six branches. We have 4 branches in Jakarta at Plaza Asia, Plaza Senayan, Senayan City, Mall Grand Indonesia, and 2 branches in Surabaya at Tunjungan Plaza 1 and Ciputra World Surabaya. We are constantly striving to enhance ourselves to better our services.\r\n\r\nWe accept over 15 currencies, including:USD, SGD, AED, AUD, BND, CAD, CHY, EURO, GBP, HKD, JPY, WON, MYR, NTD, SAR, THB & VND.', 'back', '2025-08-01 06:30:38', '2025-08-01 06:30:38'),
(39, 'meta_keywords', 'USD, SGD, AED, AUD, BND, CAD, CHY, EURO, GBP, HKD, JPY, WON, MYR, NTD, SAR, THB & VND', 'back', '2025-08-01 06:30:38', '2025-08-01 06:30:38'),
(40, 'meta_author', '', 'back', '2015-06-23 00:30:04', '0000-00-00 00:00:00'),
(41, 'admin_logo', 'f6HJ2_logo.png', 'back', '2025-07-24 04:10:28', '2025-07-24 04:10:28'),
(42, 'asset_path', 'resources/admin/assets/', 'back', '2015-06-23 04:32:47', '0000-00-00 00:00:00'),
(43, 'page', '', 'back', '2015-06-23 00:36:20', '0000-00-00 00:00:00'),
(53, 'product_keep_original', 'true', 'back', '2015-06-24 06:28:44', '0000-00-00 00:00:00'),
(52, 'product_upload_folder', 'resources/assets/uploads/products/', 'back', '2015-06-24 06:27:37', '0000-00-00 00:00:00'),
(51, 'product_admin_size', '100', 'back', '2015-06-24 06:05:16', '0000-00-00 00:00:00'),
(54, 'ga_code', '', 'front', '2017-01-18 04:00:36', '2017-01-18 04:00:36'),
(55, 'project_stage_size', '400', 'both', '2015-06-23 00:22:06', '0000-00-00 00:00:00'),
(56, 'project_carousel_size', '100', 'both', '2015-06-23 00:22:08', '0000-00-00 00:00:00'),
(57, 'project_keep_original', 'true', 'back', '2015-06-24 06:28:44', '0000-00-00 00:00:00'),
(58, 'project_upload_folder', 'resources/assets/uploads/projects/', 'back', '2015-06-24 06:27:37', '0000-00-00 00:00:00'),
(59, 'project_admin_size', '100', 'back', '2015-06-24 06:05:16', '0000-00-00 00:00:00'),
(64, 'error404_title', '404', 'front', '2017-02-13 04:29:47', '2017-02-13 04:29:47'),
(60, 'login_admin_logo', 'S3VKO_logo.png', 'back', '2025-07-24 04:10:28', '2025-07-24 04:10:28'),
(61, 'instagram_feed', '<!-- InstaWidget -->\r\n<a href=\"https://instawidget.net/v/user/tipla_berlin\" id=\"link-ce46bdd4768f7217d2fb24a29f71da3522b863069818e9b3f6bd8338e440e645\">@tipla_berlin</a>\r\n<script src=\"https://instawidget.net/js/instawidget.js?u=ce46bdd4768f7217d2fb24a29f71da3522b863069818e9b3f6bd8338e440e645&width=500px\"></script>', 'front', '2017-02-13 08:48:22', '2017-02-13 08:48:22'),
(62, 'popup_image', 'oZOyC_135.jpeg', 'front', '2017-02-09 10:27:55', '2017-02-09 10:27:55'),
(100, 'about_image', 'Zmw7m_currencies-landing.jpg', 'front', '2022-10-16 15:58:06', '2022-10-16 15:58:06'),
(63, 'popup_email_newsletter', '', 'front', '2022-10-16 15:24:39', '2017-02-09 10:27:55'),
(65, 'error404_title_colour', '', 'front', '2017-01-18 04:14:19', '0000-00-00 00:00:00'),
(66, 'error404_subtitle', '', 'front', '2017-01-18 04:13:57', '0000-00-00 00:00:00'),
(67, 'error404_subtitle_colour', '', 'front', '2017-01-18 04:14:14', '0000-00-00 00:00:00'),
(68, 'error404_background_image', 'ojRZu_maintenance.jpg', 'front', '2017-02-13 04:29:47', '2017-02-13 04:29:47'),
(69, 'error404_button_text', 'Back To Home', 'front', '2017-02-13 04:29:47', '2017-02-13 04:29:47'),
(70, 'error404_button_text_colour', '', 'front', '2017-01-18 04:16:15', '0000-00-00 00:00:00'),
(71, 'error404_button_background_colour', '', 'front', '2017-01-18 04:15:58', '0000-00-00 00:00:00'),
(72, 'error404_message', '<p>Sorry, This Page Isn\'t Available<br />The Link you followed may be broken, or the page may have been removed</p>', 'front', '2017-02-13 04:33:08', '2017-02-13 04:33:08'),
(73, 'error404_message_colour', '', 'front', '2017-01-18 04:30:01', '0000-00-00 00:00:00'),
(74, 'download', 'qN4uf_0427104301-business_practices_-_james_peck.pdf', 'front', '2017-02-10 03:26:54', '2017-02-10 03:26:54'),
(75, 'download_thumbnail', 'eMwkp_terre-thumb.jpg', 'front', '2017-01-30 04:25:17', '2017-01-29 21:25:17'),
(76, 'about_title', 'ABOUT DUA SISI', 'front', '2022-10-16 15:28:38', '2022-10-16 15:28:38'),
(77, 'about_description', '<p>DuaSisi Money Changer is an authorized Money Changer operated by PT Tetra Duasisi since 1994 in Indonesia\'s two largest cities, Jakarta and Surabaya. We decide to locate our outlet in high-end shopping malls and office buildings to demonstrate our ability to meet and fulfill customers\' foreign exchange needs in a sophisticated modern lifestyle. With over 30 years in the industry, we have six branches. We have 4 branches in Jakarta at Plaza Asia, Plaza Senayan, Senayan City, Mall Grand Indonesia, and 2 branches in Surabaya at Tunjungan Plaza 1 and Ciputra World Surabaya. We are constantly striving to enhance ourselves to better our services.<br /><br />We accept over 15 currencies, including:USD, SGD, AED, AUD, BND, CAD, CHY, EURO, GBP, HKD, JPY, WON, MYR, NTD, SAR, THB &amp; VND.</p>', 'front', '2025-07-23 10:01:13', '2025-07-23 10:01:13'),
(110, 'underlying_title', 'Silahkan download dokumen Underlying sesuai kebutuhan anda', 'front', '2026-07-18 12:06:04', '2026-07-18 11:50:59'),
(111, 'underlying_individual_jkt_title', 'Individual - Jakarta', 'front', '2026-07-18 11:58:08', '0000-00-00 00:00:00'),
(78, 'marker', 'bAfZa_pin.png', 'front', '2017-02-14 02:10:53', '2017-02-14 02:10:53'),
(79, 'mt_logo', 'ik6gI_ride-thumb.jpg', 'front', '2017-02-03 23:47:21', '2017-02-03 16:47:21'),
(80, 'mt_text_1', 'THIS WEBSITE UNDER MAINTENANCE!', 'front', '2017-02-13 07:10:55', '2017-02-13 07:10:55'),
(81, 'mt_text_2', 'PLEASE COME BACK SOON', 'front', '2017-02-13 07:10:55', '2017-02-13 07:10:55'),
(82, 'mt_text_3', '', 'front', '2017-02-03 23:04:37', '0000-00-00 00:00:00'),
(83, 'mt_contact_1_icon', 'fa-phone', 'front', '2017-02-13 07:10:55', '2017-02-13 07:10:55'),
(84, 'mt_contact_1', '021 999 1234', 'front', '2017-02-13 07:10:55', '2017-02-13 07:10:55'),
(85, 'mt_contact_2_icon', 'fa-fax', 'front', '2017-02-13 07:10:55', '2017-02-13 07:10:55'),
(86, 'mt_contact_2', '021 999 1234', 'front', '2017-02-13 07:10:55', '2017-02-13 07:10:55'),
(87, 'mt_contact_3_icon', 'fa-envelope', 'front', '2017-02-13 07:10:55', '2017-02-13 07:10:55'),
(88, 'mt_contact_3', '', 'front', '2022-10-16 15:24:25', '2017-02-13 07:10:55'),
(89, 'mt_contact_4_icon', '', 'front', '2004-02-16 23:05:00', '0000-00-00 00:00:00'),
(90, 'mt_contact_4', '', 'front', '2004-02-16 23:05:00', '0000-00-00 00:00:00'),
(91, 'mt_background_image', 'rynwG_maintenance.jpg', 'front', '2017-02-13 07:10:55', '2017-02-13 07:10:55'),
(92, 'home_video_title', 'GO PRO 5', 'front', '2017-02-09 08:54:44', '2017-02-09 08:54:44'),
(93, 'home_video', '6y_JNwORcAY', 'front', '2017-02-10 04:04:28', '2017-02-10 04:04:28'),
(94, 'home_video_description', '<p>Tips &amp; Trick to style up your room.&nbsp;Tips &amp; Trick to style up your room.&nbsp;Tips &amp; Trick to style up your room.</p>', 'front', '2017-02-09 09:28:49', '2017-02-09 09:28:49'),
(95, 'home_check_our_video', 'https://www.youtube.com/channel/UCqhnX4jA0A5paNd1v-zEysw', 'front', '2017-02-04 11:39:38', '0000-00-00 00:00:00'),
(96, 'contact_single_address', '<p>JL. Let Jend S.Parman, Kav. 68, Jakarta Barat, DKI Jakarta, RT.11/RW.3, Slipi, Palmerah, West Jakarta City, Jakarta 11410</p>', 'front', '2022-09-07 10:06:55', '2022-09-07 10:06:55'),
(97, 'instagram_userid', 'tipla_berlin', 'front', '2017-02-10 02:57:45', '2017-02-10 02:57:45'),
(98, 'instagram_hastag', 'tereforlife', 'front', '2017-02-10 02:47:09', '2017-02-10 02:47:09'),
(99, 'instagram_message', 'Post your picture with TERRE hastag now! get featured and chance to win prizes!', 'front', '2017-02-05 05:09:03', '0000-00-00 00:00:00'),
(101, 'contact_image', '24cbA_slide-1.jpg', 'front', '2022-09-07 10:09:17', '2022-09-07 10:09:17'),
(102, 'contact_latitude', '-6.194339412293755', 'front', '2022-09-07 10:06:55', '2022-09-07 10:06:55'),
(103, 'contact_longitude', '106.7981583869137', 'front', '2022-09-07 10:06:55', '2022-09-07 10:06:55'),
(104, 'contact_title', 'CONTACT Duasisi', 'front', '2022-08-10 09:04:19', '0000-00-00 00:00:00'),
(105, 'contact_name', 'Duasisi HQ', 'front', '2022-08-10 09:04:14', '0000-00-00 00:00:00'),
(106, 'contact_contacts', '<p><a href=\"https://www.google.com/search?q=dua%20sisi%20money%20changer&amp;oq=dua+sisi&amp;aqs=chrome.0.69i59i512j69i57j46i175i199i512j0i512l2j69i60l3.5052j0j7&amp;sourceid=chrome&amp;ie=UTF-8&amp;tbs=lf:1,lf_ui:14&amp;tbm=lcl&amp;rflfq=1&amp;num=10&amp;rldimm=10082834473611834552&amp;lqi=ChZkdWEgc2lzaSBtb25leSBjaGFuZ2VySJ3FhP3lgICACFosEAAQARACEAMYABgBGAIYAyIWZHVhIHNpc2kgbW9uZXkgY2hhbmdlcjICaWSSARljdXJyZW5jeV9leGNoYW5nZV9zZXJ2aWNlqgEeEAEqGiIWZHVhIHNpc2kgbW9uZXkgY2hhbmdlcigm&amp;ved=2ahUKEwjwpvGSt4L6AhX2SmwGHZ5hAYIQvS56BAgEEAE&amp;sa=X&amp;rlst=f#\" data-dtype=\"d3ph\" data-local-attribute=\"d3ph\" data-ved=\"2ahUKEwi4uZKWt4L6AhUQR2wGHfk5CkAQkAgoAHoECBAQAw\">(021) 5332929</a></p>', 'front', '2022-09-07 10:06:55', '2022-09-07 10:06:55'),
(107, 'footer_contact_us', '<p>JL. Let Jend S.Parman, Kav. 68, Jakarta Barat, DKI Jakarta, RT.11/RW.3, Slipi, Palmerah, West Jakarta City, Jakarta 11410</p>', 'front', '2022-09-07 10:06:55', '2022-09-07 10:06:55'),
(108, 'mt_text_contact', 'DO YOU HAVE ANY QUESTION ABOUT ME ?', 'front', '2017-02-13 07:09:31', '0000-00-00 00:00:00'),
(109, 'instagram_feed_mobile', '<!-- InstaWidget -->\r\n<a href=\"https://instawidget.net/v/user/tipla_berlin\" id=\"link-6b2bfa69093e1491e0d6320bfc762e85d650579e7f0a5cf61c86dd33e06a19b4\">@tipla_berlin</a>\r\n<script src=\"https://instawidget.net/js/instawidget.js?u=6b2bfa69093e1491e0d6320bfc762e85d650579e7f0a5cf61c86dd33e06a19b4&width=400px\"></script>', 'front', '2017-02-13 08:48:22', '2017-02-13 08:48:22'),
(112, 'underlying_individual_jkt_title', 'Individual - Jakarta', 'front', '2026-07-18 11:58:14', '0000-00-00 00:00:00'),
(113, 'underlying_individual_jkt_files', 'PMSJL_FORM DI ATAS THRESHOLD - INDIVIDU Cb JKT.pdf', 'front', '2026-07-18 11:58:22', '2026-07-18 11:47:08'),
(114, 'underlying_individual_sby_title', 'Individual - Surabaya', 'front', '2026-07-18 11:58:34', '0000-00-00 00:00:00'),
(115, 'underlying_individual_sby_files', 'resources/assets/uploads/downloads/FORM_DI_ATAS_THRESHOLD_-_INDIVIDU_Cb_SBY.pdf', 'front', '2026-07-18 11:58:40', '0000-00-00 00:00:00'),
(116, 'underlying_corporate_jkt_title', 'Corporate - Jakarta', 'front', '2026-07-18 11:58:46', '0000-00-00 00:00:00'),
(117, 'underlying_corporate_jkt_files', 'resources/assets/uploads/downloads/FORM_DI_ATAS_THRESHOLD_-_CORPORATE_Cb_JKT.pdf', 'front', '2026-07-18 11:58:52', '0000-00-00 00:00:00'),
(118, 'underlying_corporate_sby_title', 'Corporate - Surabaya', 'front', '2026-07-18 11:58:57', '0000-00-00 00:00:00'),
(119, 'underlying_corporate_sby_files', 'resources/assets/uploads/downloads/FORM_DI_ATAS_THRESHOLD_-_CORPORATE_Cb_SBY.pdf', 'front', '2026-07-18 11:59:02', '0000-00-00 00:00:00'),
(120, 'underlying_img_banner', '2Y3yG_Website Underlying.jpg', 'front', '2026-07-28 06:28:59', '2026-07-28 06:28:59'),
(121, 'underlying_video_banner', '', 'front', '2026-07-18 11:59:14', '0000-00-00 00:00:00'),
(122, 'rates_url', 'https://docs.google.com/spreadsheets/d/1fSwX9XG2ozeAccZXMVu1frH-4Y3_Fbbt3h_5AWqgFv0/export?format=csv&gid=0', 'front', '2026-07-18 13:40:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_contact_map`
--

CREATE TABLE `terre217_contact_map` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `address` mediumtext DEFAULT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `publish` int(1) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `terre217_contact_map`
--

INSERT INTO `terre217_contact_map` (`id`, `img`, `name`, `address`, `longitude`, `latitude`, `publish`, `order_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'SCC JAKARTA', '<p>GRHA POPOLIA</p>\\r\\n<p>JL. GUNUNG SAHARI 2, No. 7</p>\\r\\n<p>Jakarta Pusat 10620</p>\\r\\n<p>P (021) 420.5344</p>\\r\\n<p>F (021) 420.5345</p>', '-6.168519', '106.841959', 1, 1, '2015-06-05 08:38:11', '2017-02-02 08:49:47'),
(2, NULL, 'SCC BANDUNG', '<p>RUKO TUGU MAS KENCANA BLOK I-J</p><p>KOMPLEKS KOPO KENCANA</p><p>Bandung</p><p>P (022) 612.5112</p><p>F (022) 612.5113</p>', '-6.935954', '107.588946', 1, 2, '2015-06-05 08:44:19', '2015-11-25 11:07:15'),
(4, NULL, 'SCC SURABAYA', '<p>Jl. NGAGEL JAYA SELATAN</p>\\r\\n<p>KOMPLEK RUKO RMI BLOK H/16</p>\\r\\n<p>Surabaya</p>\\r\\n<p>P (031) 505.6011</p>\\r\\n<p>F (031) 504.3471</p>', '-7.293196', '112.753309', 1, 3, '2015-06-05 08:44:19', '2017-02-02 08:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_contact_message`
--

CREATE TABLE `terre217_contact_message` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `voucher_number` varchar(255) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_contact_message`
--

INSERT INTO `terre217_contact_message` (`id`, `name`, `email`, `subject`, `branch`, `problem`, `voucher_number`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Widianto Pratama', 'widi.outpost@gmail.com', 'Test', '', '', '', 'Testing ~', '2017-02-07 06:12:03', '2017-02-07 06:12:03'),
(2, 'widianto.pratama@gmail.com', 'widi.outpost@gmail.com', 'Test', '', '', '', 'Testing ~', '2017-02-07 07:20:47', '2017-02-07 07:20:47'),
(3, 'Sigi Kumala', 'skullkim1359@gmail.com', 'Lorem ipsum', '', '', '', 'Lorem ipsum sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. ', '2017-02-07 22:52:59', '2017-02-07 22:52:59'),
(4, 'Widanto Pratama', 'widianto.pratama@gmail.com', 'Test', '', '', '', 'Testing ~', '2017-02-08 23:20:42', '2017-02-08 23:20:42'),
(5, 'Sigi Kumala', 'skullkim1359@gmail.com', 'test', '', '', '', 'nanananananananananan nanananana anananna nananana', '2017-02-09 10:04:45', '2017-02-09 10:04:45'),
(6, 'hikari', 'skullkim1359@gmail.com', 'hikari', '', '', '', ' Quisque malesuada nisl convallis mauris condimentum, in tincidunt felis consectetur. In convallis at mi sed lacinia. Cras eleifend libero luctus felis consectetur faucibus. In id sapien sit amet sapien interdum aliquam. Aenean tempor eleifend turpis quis eleifend. Nam id risus mauris. Sed eu interdum metus. Suspendisse lorem nibh, molestie tristique varius a, consectetur accumsan odio. Sed convallis eros tellus, id lacinia ex congue nec. In suscipit ligula et leo lacinia, ac ultricies felis placerat. Mauris semper quis neque quis commodo. Pellentesque eget accumsan mauris.\n', '2017-02-10 03:21:29', '2017-02-10 03:21:29'),
(7, 'admin', 'admin@admin.com', 'admin', '', '', '', 'admin admin admin admin', '2017-03-15 02:28:21', '2017-03-15 02:28:21'),
(8, 'ad', 'ilyas.raswandi@gmail.com', 'asd - asd - asd - asd', '', '', '', 'asd', '2025-08-03 09:54:16', '2025-08-03 09:54:16'),
(9, 'ilyas', 'ilyas.raswandi@gmail.com', 'jakarta - test - asfgf - 1234321234', '', '', '', 'asdasffsasafsfas', '2025-08-03 10:02:55', '2025-08-03 10:02:55'),
(10, 'ilyas', 'ilyas.raswandi@gmail.com', 'jakarta - test - asfgf - 1234321234', '', '', '', 'asdasffsasafsfas', '2025-08-03 10:06:14', '2025-08-03 10:06:14'),
(11, 'ilyas', 'ilyas.raswandi@gmail.com', 'jakarta - test - asfgf - 1234321234', '', '', '', 'asdasffsasafsfas', '2025-08-03 10:06:45', '2025-08-03 10:06:45'),
(12, 'ilyas', 'ilyas.raswandi@gmail.com', 'asdasd - asdasd - asdasd - 1234321234', '', '', '', 'asdasdasd', '2025-08-03 10:08:53', '2025-08-03 10:08:53'),
(13, 'ilyas', 'ilyas.raswandi@gmail.com', 'asdasd - asdasd - asdasd - 1234321234', '', '', '', 'asdasdasd', '2025-08-03 10:09:02', '2025-08-03 10:09:02'),
(14, 'ilyas', 'ilyas.raswandi@gmail.com', 'asdasd - asdasd - asdasd - 1234321234', '', '', '', 'asdasdasd', '2025-08-03 10:11:07', '2025-08-03 10:11:07'),
(15, 'ilyas', 'ilyas.raswandi@gmail.com', 'Testing - Dolarnya palsu - Testing - Testing', '', '', '', 'Testing', '2025-08-03 10:16:18', '2025-08-03 10:16:18'),
(16, 'ilyas', 'ilyas.raswandi@gmail.com', 'Testing 2 - Dolarnya palsu 2 - Testing 2 - Testing 2', '', '', '', 'Testing', '2025-08-03 10:21:30', '2025-08-03 10:21:30'),
(17, 'ilyas', 'ilyas.raswandi@gmail.com', 'jakarta - tukar uang - 123456789 - 1234321234', 'jakarta', 'tukar uang', '123456789', 'asdasdasasd', '2025-08-04 05:20:12', '2025-08-04 05:20:12'),
(18, 'ilyas', 'ilyas.raswandi@gmail.com', 'jakarta - tukar uang - 123456789 - 1234321234', 'jakarta', 'tukar uang', '123456789', 'asdasdasasd', '2025-08-04 05:24:05', '2025-08-04 05:24:05'),
(19, 'ilyas', 'dantemustday19@gmail.com', 'jakarta - tukar uang - 123456789 - 1234321234', 'jakarta', 'tukar uang', '123456789', 'asdasdasasd', '2025-08-04 05:28:08', '2025-08-04 05:28:08'),
(20, 'Jihan Farhani Kurniawan', 'jfarhani.kurniawan@gmail.com', 'Senayan City - JPY Rate Check - - - 081290226497', 'Senayan City', 'JPY Rate Check', '-', 'wants to check the Rate for JPY', '2025-11-10 07:10:42', '2025-11-10 07:10:42'),
(21, 'Jihan Farhani Kurniawan', 'jfarhani.kurniawan@gmail.com', 'Senayan City - JPY Rate Check - - - 081290226497', 'Senayan City', 'JPY Rate Check', '-', 'wants to check the Rate for JPY', '2025-11-10 07:10:44', '2025-11-10 07:10:44'),
(22, 'Jihan Farhani Kurniawan', 'jfarhani.kurniawan@gmail.com', 'Senayan City - JPY Rate Check - - - 081290226497', 'Senayan City', 'JPY Rate Check', '-', 'wants to check the Rate for JPY', '2025-11-10 07:10:45', '2025-11-10 07:10:45'),
(23, 'Mohammad Ari erlangga', 'arierlangga930@gmail.com', 'Exhibition Road - Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu  - 33FT193974568 - 085809726307', 'Exhibition Road', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '33FT193974568', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '2026-07-24 19:46:35', '2026-07-24 19:46:35'),
(24, 'Mohammad Ari erlangga', 'arierlangga930@gmail.com', 'Exhibition Road - Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu  - 33FT193974568 - 085809726307', 'Exhibition Road', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '33FT193974568', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '2026-07-24 19:46:40', '2026-07-24 19:46:40'),
(25, 'Mohammad Ari erlangga', 'arierlangga930@gmail.com', 'Exhibition Road - Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu  - 33FT193974568 - 085809726307', 'Exhibition Road', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '33FT193974568', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '2026-07-24 19:46:59', '2026-07-24 19:46:59'),
(26, 'Mohammad Ari erlangga', 'arierlangga930@gmail.com', 'Exhibition Road - Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu  - 33FT193974568 - 085809726307', 'Exhibition Road', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '33FT193974568', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '2026-07-24 19:47:01', '2026-07-24 19:47:01'),
(27, 'Mohammad Ari erlangga', 'arierlangga930@gmail.com', 'Exhibition Road - Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu  - 33FT193974568 - 085809726307', 'Exhibition Road', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '33FT193974568', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '2026-07-24 19:47:02', '2026-07-24 19:47:02'),
(28, 'Mohammad Ari erlangga', 'arierlangga930@gmail.com', 'Exhibition Road - Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu  - 33FT193974568 - 085809726307', 'Exhibition Road', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '33FT193974568', 'Saya ingin mengambil uang kiriman dari bahrain, tapi saya terkendala jarak saya sekrang stay di muntok, bangka belitung, apakah bisa di bantu ', '2026-07-24 19:47:02', '2026-07-24 19:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_custom_menu`
--

CREATE TABLE `terre217_custom_menu` (
  `id` int(11) NOT NULL,
  `sure_menu` varchar(255) DEFAULT NULL,
  `custom_name` varchar(255) DEFAULT NULL,
  `permalink` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `terre217_custom_menu`
--

INSERT INTO `terre217_custom_menu` (`id`, `sure_menu`, `custom_name`, `permalink`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'Home', 'home', 1, 1, '2017-02-13 10:16:35', '2017-02-13 10:16:35'),
(2, 'Brand', 'Brand', 'brands', 2, 1, '2017-02-10 13:31:48', '2017-02-10 13:31:48'),
(3, 'Products', 'Products', 'products', 3, 1, '2017-02-10 13:31:59', '2017-02-10 13:31:59'),
(4, 'Projects', 'Projects', 'projects', 4, 1, '2022-03-01 12:59:02', '2022-03-01 12:59:02'),
(5, 'News & Events', 'News & Events', 'news_and_events', 5, 1, '2017-02-10 13:32:12', '2017-02-10 13:32:12'),
(6, 'Testimonials', 'Testimonials', 'testimonials', 6, 1, '2017-02-10 13:32:26', '2017-02-10 13:32:26'),
(7, 'Stores', 'Stores', 'stores', 7, 1, '2017-02-10 13:32:31', '2017-02-10 13:32:31'),
(8, 'About', 'About', 'about', 8, 1, '2017-02-10 13:32:37', '2017-02-10 13:32:37'),
(9, 'Contact', 'Contact', 'contact', 9, 1, '2017-02-10 13:32:39', '2017-02-10 13:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_designerform`
--

CREATE TABLE `terre217_designerform` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `company` varchar(1000) NOT NULL,
  `company_address` varchar(1000) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `message` varchar(3000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_download_category`
--

CREATE TABLE `terre217_download_category` (
  `id` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `fkcategoryid` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `terre217_download_category`
--

INSERT INTO `terre217_download_category` (`id`, `img`, `file`, `fkcategoryid`, `title`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(15, 'terre-thumb.jpg', 'Tagihan_12705542.pdf', 1, 'Test', 1, 1, '2017-01-30 03:55:27', '2017-01-30 03:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_galleries`
--

CREATE TABLE `terre217_galleries` (
  `id` int(11) NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_galleries`
--

INSERT INTO `terre217_galleries` (`id`, `thumbnail`, `img`, `title`, `subtitle`, `description`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Darth_Vader8.jpg', 'Free_Download_Stormtrooper_Wallpaper_HD8.jpg', 'zxdas', 'asasa', '<p>asasas</p>', 1, 1, '2017-01-27 21:47:41', '2017-01-27 21:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_galleries_category`
--

CREATE TABLE `terre217_galleries_category` (
  `id` int(11) NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `fkcategoryid` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `terre217_galleries_category`
--

INSERT INTO `terre217_galleries_category` (`id`, `thumbnail`, `img`, `fkcategoryid`, `title`, `subtitle`, `description`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(2, 'Darth_Vader6.jpg', 'Free_Download_Stormtrooper_Wallpaper_HD6.jpg', 1, 'Gallery 1', 'Sub Gallery 2', '<p>Asasasa</p>', 1, 1, '2017-01-27 21:39:58', '2017-02-03 23:30:14'),
(3, 'ride-thumb.jpg', 'ride_thumb2.jpg', 1, 'Gallery 2', 'Sub Gallery 2', '<p>Asasas</p>', 2, 1, '2017-02-03 23:29:53', '2017-02-03 23:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_home_banner`
--

CREATE TABLE `terre217_home_banner` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `button` varchar(200) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_home_banner`
--

INSERT INTO `terre217_home_banner` (`id`, `img`, `title`, `subtitle`, `button`, `url`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'banner1.jpg', 'Stylish Office', 'Say goodbay to boring office', '', 'http://www.mendekor.com/', 1, 1, '2017-02-05 04:23:32', '2017-02-09 15:48:22'),
(2, 'banner2.jpg', 'All About Hobbies', 'We\'ve got everything covered', '', '', 2, 1, '2017-02-05 04:24:07', '2017-02-09 15:48:22'),
(3, '829f69bb134bc82826f76012d9350acf.jpg', 'Special Gift!!', 'Valentine treat for everyone', '', 'www.youtube.com/watch?v=6y_JNwORcAY', 4, 1, '2017-02-05 04:26:23', '2017-02-10 13:50:05'),
(4, 'banner4.jpg', 'Pop of Colour', 'We\'re bringing colours back!', '', '', 3, 1, '2017-02-05 04:26:52', '2017-02-08 04:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_home_slideshow`
--

CREATE TABLE `terre217_home_slideshow` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_home_slideshow`
--

INSERT INTO `terre217_home_slideshow` (`id`, `title`, `url`, `order_id`, `img`, `publish`, `created_at`, `updated_at`) VALUES
(6, 'HOMEPAGE20251', '', 9, 'Web-Slider-1.jpg', 1, '2025-07-23 12:46:46', '2025-07-23 12:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_location`
--

CREATE TABLE `terre217_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `permalink` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_location`
--

INSERT INTO `terre217_location` (`id`, `name`, `permalink`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta', 'jakarta', 1, 1, '2017-02-02 03:12:10', '2017-02-02 03:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_menuitems`
--

CREATE TABLE `terre217_menuitems` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `parrent_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_menuitems`
--

INSERT INTO `terre217_menuitems` (`id`, `name`, `type`, `link`, `parrent_id`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '2', 'home', NULL, 1, 1, '2017-03-09 07:09:41', '2017-03-09 07:09:41'),
(2, 'BRAND', '2', 'brands', NULL, 2, 1, '2017-03-09 07:16:30', '2017-03-09 07:16:30'),
(3, 'PRODUCTS', '2', 'products', NULL, 3, 1, '2017-03-09 07:09:43', '2017-03-09 07:09:43'),
(4, 'PROJECTS', '2', 'projects', NULL, 4, 1, '2022-03-01 12:57:48', '2022-03-01 12:57:48'),
(5, 'NEWS & EVENTS', '2', 'news_and_events', NULL, 5, 1, '2017-03-09 07:09:45', '2017-03-09 07:09:45'),
(6, 'TESTIMONIALS', '2', 'testimonials', NULL, 6, 1, '2017-03-09 07:09:45', '2017-03-09 07:09:45'),
(7, 'STORES', '2', 'stores', NULL, 7, 1, '2017-03-09 07:18:14', '2017-03-09 07:18:14'),
(8, 'ABOUT', '2', 'about', NULL, 8, 1, '2017-03-09 07:09:48', '2017-03-09 07:09:48'),
(9, 'CONTACT', '2', 'contact', NULL, 9, 1, '2017-03-09 07:09:49', '2017-03-09 07:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_modules`
--

CREATE TABLE `terre217_modules` (
  `id` int(11) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `fgcategory` int(11) NOT NULL DEFAULT 0,
  `publish` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_modules`
--

INSERT INTO `terre217_modules` (`id`, `route`, `name`, `title`, `description`, `images`, `meta_title`, `meta_keywords`, `meta_description`, `fgcategory`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'projects_all', 'Projects', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2017-03-09 07:17:47', '2017-03-09 07:17:47'),
(2, 'products', 'Products', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2017-03-09 06:36:54', '2017-03-09 06:36:54'),
(3, 'services', 'Services', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2017-03-09 06:59:34', '2017-03-09 06:59:34'),
(4, 'team', 'Team', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2017-03-09 06:59:37', '2017-03-09 06:59:37'),
(5, 'news_and_events', 'News & Events', '', '', NULL, NULL, NULL, NULL, 0, 1, '2017-03-09 07:00:25', '2017-03-09 07:00:25'),
(6, 'press', 'Press', '', '', NULL, NULL, NULL, NULL, 0, 0, '2017-03-09 06:59:40', '2017-03-09 06:59:40'),
(7, 'galleries', 'Galleries', '', '', NULL, NULL, NULL, NULL, 0, 0, '2017-03-09 06:59:42', '2017-03-09 06:59:42'),
(8, 'promotions', 'Promotions', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2017-03-09 06:59:44', '2017-03-09 06:59:44'),
(9, 'stores', 'Store', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2017-03-09 07:18:21', '2017-03-09 07:18:21'),
(10, 'home', 'Home', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(11, 'about', 'About', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(12, 'contact', 'Contact', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(13, 'testimonials', 'Testimonials', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(14, 'stores', 'Stores', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(15, 'brands', 'Brand', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terre217_msmenu`
--

CREATE TABLE `terre217_msmenu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nama_menu_alias` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `fkparent` int(10) DEFAULT NULL,
  `fgparent` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `create` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `edit` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `view` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `delete` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sorting` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order` int(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_msmenu`
--

INSERT INTO `terre217_msmenu` (`id`, `nama_menu`, `nama_menu_alias`, `fkparent`, `fgparent`, `create`, `edit`, `view`, `delete`, `sorting`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 1, '2017-01-27 04:52:34', '2017-01-27 04:52:39'),
(2, 'Homepage', 'homepage', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 2, '2017-01-27 04:53:18', '2017-01-27 04:53:21'),
(3, 'Slideshows', 'homepage-slideshows', 2, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 04:54:31', '2017-01-27 04:54:36'),
(4, 'Banners', 'homepage-banners', 2, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2017-01-27 04:55:17', '2017-01-27 04:55:20'),
(5, 'Videos', 'homepage-videos', 2, 'n', 'y', 'y', 'y', 'y', 'y', 3, '2017-01-27 04:55:47', '2017-01-27 04:55:50'),
(6, 'Brands', 'homepage-brands', 2, 'n', 'y', 'y', 'y', 'y', 'y', 4, '2017-01-27 04:56:14', '2017-01-27 04:56:17'),
(7, 'Products by Category', 'products-by-category', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 3, '2017-01-27 08:03:28', '2017-01-27 08:08:03'),
(8, 'Add Category', 'category', 7, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 08:04:23', '2017-01-27 08:04:27'),
(9, 'Add Product', 'add-product-by-category', 7, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2017-01-27 08:08:25', '2017-01-27 08:21:07'),
(10, 'Products by Sub Category', 'products-by-subcategory', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 4, '2017-01-27 08:03:28', '2017-01-27 08:08:03'),
(11, 'Add Category', 'category', 10, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 08:04:23', '2017-01-27 08:04:27'),
(12, 'Add Sub Category', 'sub-category', 10, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2017-01-27 08:04:23', '2017-01-27 08:04:27'),
(13, 'Add Product', 'add-product-by-subcategory', 10, 'n', 'y', 'y', 'y', 'y', 'y', 3, '2017-01-27 08:08:25', '2017-01-27 08:21:21'),
(14, 'Products by Brand', 'products-by-brand', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 5, '2017-01-27 08:23:29', '2017-01-27 08:23:32'),
(15, 'Add Brand', 'homepage-brands', 14, 'y', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 08:28:28', '2017-01-27 08:28:34'),
(16, 'Add Product', 'add-products-by-brand', 14, 'y', 'y', 'y', 'y', 'y', 'y', 2, '2017-01-27 08:29:34', '2017-01-27 08:29:38'),
(17, 'Products', 'products', NULL, 'y', 'y', 'y', 'y', 'y', 'y', 6, '2017-01-27 08:51:28', '2017-01-27 08:51:30'),
(18, 'Projects by Category', 'projects-by-category', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 7, '2017-01-27 08:03:28', '2017-01-27 08:08:03'),
(19, 'Add Category', 'category', 18, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 08:04:23', '2017-01-27 08:04:27'),
(20, 'Add Projects', 'add-projects-by-category', 18, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2017-01-27 08:08:25', '2017-01-27 08:21:07'),
(21, 'Projects by Sub Category', 'projects-by-subcategory', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 8, '2017-01-27 08:03:28', '2017-01-27 08:08:03'),
(22, 'Add Category', 'category', 21, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 08:04:23', '2017-01-27 08:04:27'),
(23, 'Add Sub Category', 'sub-category', 21, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2017-01-27 08:04:23', '2017-01-27 08:04:27'),
(24, 'Add Projects', 'add-projects-by-subcategory', 21, 'y', 'y', 'y', 'y', 'y', 'y', 3, '2017-01-27 08:29:34', '2017-01-27 08:44:40'),
(25, 'Projects', 'projects', NULL, 'y', 'y', 'y', 'y', 'y', 'y', 9, '2017-01-27 08:51:28', '2017-01-27 08:53:36'),
(26, 'News & Event by Category', 'news-and-event-by-category', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 10, '2017-01-27 08:03:28', '2017-01-27 09:08:29'),
(27, 'Add Category', 'category', 26, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 08:04:23', '2017-01-27 08:04:27'),
(28, 'Add News & Event', 'add-news-and-event-by-category', 26, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2017-01-27 08:55:36', '2017-01-27 08:56:53'),
(29, 'News & Events', 'news-and-event', NULL, 'y', 'y', 'y', 'y', 'y', 'y', 11, '2017-01-27 08:57:57', '2017-01-27 15:39:50'),
(30, 'Promotions', 'promotions', NULL, 'y', 'y', 'y', 'y', 'y', 'y', 12, '2017-01-27 08:59:20', '2017-01-27 08:59:23'),
(31, 'Services by Category', 'services-by-category', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 13, '2027-01-17 08:03:00', '2027-01-17 08:08:00'),
(32, 'Add Category', 'category', 31, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2027-01-17 08:04:00', '2027-01-17 08:04:00'),
(33, 'Add Services', 'add-services-by-category', 31, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2027-01-17 08:08:00', '2027-01-17 08:21:00'),
(34, 'Services by Sub Category', 'services-by-subcategory', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 14, '2027-01-17 08:03:00', '2027-01-17 08:08:00'),
(35, 'Add Category', 'category', 34, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2027-01-17 08:04:00', '2027-01-17 08:04:00'),
(36, 'Add Sub Category', 'sub-category', 34, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2027-01-17 08:04:00', '2027-01-17 08:04:00'),
(37, 'Add Services', 'add-services-by-subcategory', 34, 'y', 'y', 'y', 'y', 'y', 'y', 3, '2027-01-17 08:29:00', '2027-01-17 08:44:00'),
(38, 'Services', 'services', NULL, 'y', 'y', 'y', 'y', 'y', 'y', 15, '2027-01-17 08:51:00', '2027-01-17 08:53:00'),
(39, 'Galleries by Category', 'galleries-by-category', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 16, '2027-01-17 08:03:00', '2027-01-17 08:08:00'),
(40, 'Add Category', 'category', 39, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2027-01-17 08:04:00', '2027-01-17 08:04:00'),
(41, 'Add Galleries', 'add-galleries-by-category', 39, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2027-01-17 08:55:00', '2027-01-17 08:56:00'),
(42, 'Galleries', 'galleries', NULL, 'y', 'y', 'y', 'y', 'y', 'y', 17, '2027-01-17 08:57:00', '2027-01-17 08:57:00'),
(43, 'Press by Category', 'press-by-category', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 18, '2027-01-17 08:03:00', '2027-01-17 08:08:00'),
(44, 'Add Category', 'category', 43, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2027-01-17 08:04:00', '2027-01-17 08:04:00'),
(45, 'Add Press', 'add-press-by-category', 43, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2027-01-17 08:55:00', '2027-01-17 08:56:00'),
(46, 'Press', 'press', NULL, 'y', 'y', 'y', 'y', 'y', 'y', 19, '2027-01-17 08:57:00', '2027-01-17 08:57:00'),
(47, 'Stores by Location', 'stores-by-location', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 20, '2017-01-27 09:21:59', '2017-01-27 09:22:02'),
(48, 'Add by Province', 'province-stores-by-location', 47, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 09:23:00', '2017-01-27 09:24:34'),
(49, 'Add by City', 'city-stores-by-location', 47, 'n', 'y', 'y', 'y', 'y', 'y', 2, '2017-01-27 09:23:00', '2017-01-27 09:23:03'),
(50, 'Shops', 'shops', 47, 'n', 'y', 'y', 'y', 'y', 'y', 3, '2017-01-27 09:25:57', '2017-01-27 09:25:59'),
(51, 'Stores', 'stores', NULL, 'y', 'n', 'n', 'n', 'n', 'n', 21, '2017-01-27 09:26:59', '2017-01-27 09:27:02'),
(52, 'Shops', 'shops', 51, 'n', 'y', 'y', 'y', 'y', 'y', 1, '2017-01-27 09:25:57', '2017-01-27 09:25:59'),
(53, 'Testimonials', 'testimonials', NULL, 'y', 'y', 'y', 'y', 'y', 'y', 22, '2017-01-27 09:25:57', '2017-01-27 09:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_newsletter`
--

CREATE TABLE `terre217_newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_newsletter`
--

INSERT INTO `terre217_newsletter` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'widi.outpost@gmail.com', '2017-02-06 16:25:35', '2017-02-06 16:25:35'),
(2, 'fitrah.outpost@gmail.com', '2017-02-07 00:22:40', '2017-02-07 00:22:40'),
(3, 'skullkim1359@gmail.com', '2017-02-10 02:49:24', '2017-02-10 02:49:24'),
(4, 'dsvfsgd@gmail.com', '2017-02-22 07:09:15', '2017-02-22 07:09:15'),
(5, 'dantemustday19@gmail.com', '2017-02-22 07:09:39', '2017-02-22 07:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_news_events`
--

CREATE TABLE `terre217_news_events` (
  `id` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `img_2` varchar(255) DEFAULT NULL,
  `author` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `placement` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `period_time` int(1) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `events_date` date NOT NULL,
  `publish` int(11) NOT NULL DEFAULT 1,
  `short_description` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `permalink` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `terre217_news_events`
--

INSERT INTO `terre217_news_events` (`id`, `img`, `img_2`, `author`, `type`, `placement`, `title`, `period_time`, `start_date`, `end_date`, `events_date`, `publish`, `short_description`, `description`, `permalink`, `order_id`, `created_at`, `updated_at`) VALUES
(19, 'NEWS-BI.jpg', 'NEWS_BI2.jpg', 'Ilyasa Dahlan', '', 0, 'BI Akan Luncurkan Payment ID, Pantau Transaksi Keuangan Masyarakat  ', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>JAKARTA, KOMPAS.com - Bank Indonesia (BI) akan meluncurkan Payment ID pada peringatan Hari Ulang Tahun (HUT) Republik Indonesia pada 17 Agustus 2025 mendatang. Payment ID adalah kode unik yang terintegrasi dengan Nomor Induk Kependudukan (NIK) dan', '<p>JAKARTA, KOMPAS.com - Bank Indonesia (BI) akan meluncurkan Payment ID pada peringatan Hari Ulang Tahun (HUT) Republik Indonesia pada 17 Agustus 2025 mendatang. Payment ID adalah kode unik yang terintegrasi dengan Nomor Induk Kependudukan (NIK) dan akan mengoptimalisasi data granular. Bentuk Payment ID akan berupa kombinasi huruf dan angka. Payment ID merupakan bagian dari Blueprint Sistem Pembayaran Indonesia (BSPI) 2030.&nbsp; \"Payment ID ini based on NIK,\" kata kata Direktur Departemen Kebijakan Sistem Pembayaran (DKSP) BI Dudi Dermawan pada acara Editor Gathering Bank Indonesia, akhir pekan lalu.&nbsp;<br /><br />\"Payment ID ini based on NIK,\" kata kata Direktur Departemen Kebijakan Sistem Pembayaran (DKSP) BI Dudi Dermawan pada acara Editor Gathering Bank Indonesia, akhir pekan lalu.&nbsp;<br /><br />Budi menjelaskan, Payment ID sangat powerful alias kuat, lantaran bisa memantau transaksi keuangan masyarakat, termasuk sumber pendapatan, pengeluaran, riwayat pinjaman, investasi, hingga keterlibatan atau transaksi judi online (judol) dan pinjaman online (Pinjol). Selain memantau transaksi keuangan, Payment ID juga bermanfaat untuk mendeteksi fraud (kecurangan). Perbankan dapat menggunakan Payment ID dalam mengetahui profil atau kondisi keuangan calon nasabah. Payment ID bisa memantau data keuangan masyarakat dari beberapa akun perbankan, dompet digital, dan lainnya.<br /><br />Perbankan dapat menggunakan Payment ID dalam mengetahui profil atau kondisi keuangan calon nasabah. Payment ID bisa memantau data keuangan masyarakat dari beberapa akun perbankan, dompet digital, dan lainnya.<br /><br />Artikel ini telah tayang di&nbsp;Diakses&nbsp;Transaksi Keuangan Masyarakat\", Klik untuk baca:&nbsp;<a href=\"https://money.kompas.com/read/2025/07/21/155554726/bi-akan-luncurkan-payment-id-pantau-transaksi-keuangan-masyarakat?page=all\">https://money.kompas.com/read/2025/07/21/155554726/bi-akan-luncurkan-payment-id-pantau-transaksi-keuangan-masyarakat?page=all</a>.<br /><br /><br />Kompascom+ baca berita tanpa iklan:&nbsp;<a href=\"https://kmp.im/plus6\">https://kmp.im/plus6</a><br />Download aplikasi:&nbsp;<a href=\"https://kmp.im/app6\">https://kmp.im/app6</a></p>', 'bi-akan-luncurkan-payment-id-pantau-transaksi-keuangan-masyarakat', 9, '2025-07-24 05:03:50', '2026-07-14 12:24:28'),
(22, 'NEWS11113.jpg', 'NEWS111114.jpg', 'Ilyasa Dahlan', '', 0, 'Rupiah Dibuka Turun, Dolar AS ke Rp16.360', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Jakarta, CNBC Indonesia - Nilai tukar rupiah terhadap dolar Amerika Serikat (AS) dibuka melemah pada pembukaan perdagangan Selasa (29/7/2025).<br /><br /></p>', '<p>Jakarta, CNBC Indonesia - Nilai tukar rupiah terhadap dolar Amerika Serikat (AS) dibuka melemah pada pembukaan perdagangan Selasa (29/7/2025).<br />Melansir dari Refinitiv, nilai tukar rupiah mengalami koreksi 0,15% di level Rp16.360/US$, yang merupakan level terendahnya sejak 25 Juni 2025.<br /><br />Sementara itu, indeks dolar AS (DXY) per pukul 09.00 WIB terpantu turun tipis 0,02% pada level 98,61.</p>\r\n<p>&nbsp;</p>\r\n<p>Nilai tukar rupiah diperkirakan masih berada di bawah tekanan pada hari ini, seiring dengan penguatan signifikan indeks dolar AS pada perdagangan Senin (28/7/2025). DXY tercatat naik 1,01%, mencerminkan meningkatnya permintaan terhadap mata uang Negeri Paman Sam.<br /><br />Penguatan dolar AS terjadi setelah tercapainya kesepakatan dagang antara Amerika Serikat dan Uni Eropa pada akhir pekan lalu (27/7). Kesepakatan ini dipandang sebagai sinyal meredanya ketegangan dagang, sehingga meningkatkan kepercayaan pelaku pasar global. Alhasil, investor kembali memburu aset berdenominasi dolar AS, yang memberi tekanan tambahan pada rupiah yang masih sensitif terhadap fluktuasi indeks dolar.<br /><br />Tekanan terhadap rupiah juga diperkuat oleh sikap hati-hati pelaku pasar menjelang pengumuman kebijakan suku bunga Federal Reserve (The Fed) yang dijadwalkan Rabu malam atau Kamis dini hari waktu Indonesia.<br /><br />Konsensus pasar memperkirakan The Fed akan menahan suku bunga di kisaran 4,25%-4,50%, dengan peluang pemangkasan baru terbuka pada September mendatang. Jika proyeksi ini terealisasi, maka selisih suku bunga antara The Fed dan Bank Indonesia (BI) akan semakin menyempit, berpotensi memicu arus keluar modal asing.<br /><br />Seperti diketahui, BI telah memangkas suku bunga acuan sebanyak tiga kali sepanjang tahun 2025, masing-masing 25 basis poin pada Januari, Mei, dan Juli, sehingga saat ini berada di level 5,25%. Bank sentral juga membuka peluang pemangkasan lanjutan seiring prakiraan inflasi yang tetap rendah dan nilai tukar yang stabil.<br /><br />\"BI ke depan masih melihat ruang untuk penurunan suku bunga lebih lanjut,\" ujar Gubernur BI Perry Warjiyo dalam konferensi pers di Kantor Pusat LPS, Jakarta, Senin (28/7/2025).<br /><br />\"Kebijakan suku bunga tetap konsisten dengan prakiraan inflasi yang rendah dalam kisaran sasaran 2,5% sampai 1%,\" tambahnya.<br /><br />Diakses dari&nbsp;&nbsp;Indonesia \"Rupiah Dibuka Turun, Dolar AS ke Rp16.360\" selengkapnya di sini:&nbsp;<a href=\"https://www.cnbcindonesia.com/market/20250729074427-17-653032/rupiah-dibuka-turun-dolar-as-ke-rp16360\">https://www.cnbcindonesia.com/market/20250729074427-17-653032/rupiah-dibuka-turun-dolar-as-ke-rp16360</a><br /><br />Download Apps CNBC Indonesia sekarang https://app.cnbcindonesia.com/</p>', 'rupiah-dibuka-turun-dolar-as-ke-rp16360', 12, '2025-07-29 04:20:45', '2025-07-29 04:21:39'),
(20, 'NEWS111.jpg', 'NEWS1112.jpg', 'Ilyasa Dahlan', '', 0, 'Alasan Turis ke Thailand Wajib Bawa Uang Tunai Rp 6,5 Juta', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Jakarta - Bagi kamu yang ingin berlibur ke Thailand, ada syarat yang harus dipenuhi, ya. Syarat terbarunya, kamu mesti membawa uang tunai.<br />Mengapa ada aturan ini? Kedutaan Besar Republik Indonesia (KBRI) di Bangkok, Thailand menjelaskan alasa', '<p>Jakarta - Bagi kamu yang ingin berlibur ke Thailand, ada syarat yang harus dipenuhi, ya. Syarat terbarunya, kamu mesti membawa uang tunai.<br />Mengapa ada aturan ini? Kedutaan Besar Republik Indonesia (KBRI) di Bangkok, Thailand menjelaskan alasan, nominal, hingga tentang uang tunai.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Dikutip dari detikTravel, aturan warga negara asing (WNA) membawa uang tunai saat masuk Thailand bukanlah aturan baru. Tetapi, aturan itu heboh belakangan ini setelah Kedutaan Besar Republik Indonesia (KBRI) di Bangkok, Thailand, mengumumkannya secara resmi minggu ini.<br /><br /><br />Dalam unggahan di Instagram, KBRI Bangkok menyebut syarat-syarat untuk bepergian ke Thailand. Yakni, pelancong memiliki paspor dengan masa berlaku paling sedikit enam bulan, memiliki tiket pulang-pergi, memiliki bukti pemesanan akomodasi/hotel selama berada di Thailand, serta memiliki bukti kemampuan finansial untuk menunjang biaya hidup selama di Thailand.<br /><br />Syarat itu secara umum sama seperti syarat keimigrasian negara lainnya, termasuk Indonesia. Namun, syarat untuk menunjukkan bukti kemampuan finansial menjadi perdebatan warga +62.<br /><br /><br />KBRI Bangkok menyebut warga negara Indonesia (WNI) yang ingin ke Thailand diimbau membawa uang senilai 15-20 ribu baht per orang atau sekitar Rp 6,5 juta sampai Rp 8,6 juta.<br /><br />Sejumlah warganet menilai nominal tersebut terlalu besar. Apalagi, jika pergi dengan durasi pendek dan sendirian.<br /><br />Minister Counsellor/Koordinator Fungsi Protokol dan Konsuler KBRI Bangkok, Dewi Lestari, menduga imigrasi Thailand menetapkan aturan itu untuk mencegah kasus perdagangan orang atau human trafficking yang marak di Indonesia.<br /><br />\"Ada WNI yang menjadi korban trafficking yang dipekerjakan dalam bidang scamming online yang transit melalui Thailand kemudian dibawa ke negara lain untuk dipekerjakan menjadi scammer. Hal-hal seperti ini juga ditujukan untuk mencegah kondisi seperti itu, di samping untuk mencegah kasus WNI yang terlantar di Thailand dengan tujuan kedatangan sebagai turis,\" kata Dewi dalam wawancara bersama RRI Pro 3 yang diunggah di Instagram KBRI Bangkok pada Jumat (23/2) dan dikutip Senin (26/2).<br /><br />Dewi berujar aturan itu tercantum dalam undang-undang keimigrasian Thailand B.E. 2522 yang rilis pada 1979. Bab 2 (Chapter 2) dalam beleid mengatur tentang aturan masuk dan keluar dari Thailand. Khusus pada bagian 12 (Section 12), mengatur tentang orang asing yang masuk dalam kriteria tertentu tidak diizinkan masuk ke Thailand.<br /><br />\"Di mana salah satunya disebutkan apabila tidak memiliki uang. Itu yang membuat imigrasi melakukan random check bahwa orang ini memang punya kemampuan finansial untuk membiayai selama dia tinggal di Thailand,\" ujar dia.<br /><br />Asal Mula Penetapan Syarat Uang Rp 6,5 Juta<br />Dewi menyebut karena aturan ini, KBRI Bangkok pun mengimbau agar WNI yang hendak melancong ke Negeri Gajah Putih membawa uang 15-20 ribu baht atau sekitar Rp 6,5 juta sampai Rp 8,6 juta. KBRI menyebut penetapan nominal uang itu dibuat merujuk informasi di lapangan dari WNI yang ditolak dan keterangan petugas imigrasi Thailand.<br /><br />Mereka menyebutkan angka kisaran 15 ribu sampai 20 ribu baht. Lima belas ribu itu biasanya kalau datang sendiri, kalau dia datang berkeluarga minimal 20 ribu,\" kata Dewi.<br /><br />\"Apakah kemudian harus 15 ribu itu dalam bentuk tunai atau, misalnya, dia bawa 5 ribu, kemudian dia menunjukkan bukti bahwa dia punya di rekening 10 ribu baht, itu bergantung pada petugas yang melakukan verifikasi di lapangan,\" dia menambahkan.<br /><br />Diakses dari&nbsp;detikjabar, \"Alasan Turis ke Thailand Wajib Bawa Uang Tunai Rp 6,5 Juta\" selengkapnya&nbsp;<a href=\"https://www.detik.com/jabar/wisata/d-7212942/alasan-turis-ke-thailand-wajib-bawa-uang-tunai-rp-6-5-juta\">https://www.detik.com/jabar/wisata/d-7212942/alasan-turis-ke-thailand-wajib-bawa-uang-tunai-rp-6-5-juta</a>.<br /><br />Download Apps Detikcom Sekarang https://apps.detik.com/detik/</p>', 'alasan-turis-ke-thailand-wajib-bawa-uang-tunai-rp-65-juta', 10, '2025-07-24 05:08:23', '2025-08-06 10:24:07'),
(21, 'NEWS_BI3.jpg', 'NEWS_BI4.jpg', 'Ilyasa Dahlan', '', 2, 'BI Imbau Masyarakat Gunakan KUPVA BB yang Berizin', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p><strong>TRIBUN-TIMUR.COM, MAKASSAR-</strong>Bank Indonesia (BI) Sulawesi Selatan (Sulsel) mengimbau masyarakat agar lebih selektif dalam memilih&nbsp; KUPVA Bukan Bank (BB).</p>\r\n<p>Iwan Setiawan mengatakan, demi terciptanya penukaran uang asing y', '<p><strong>TRIBUN-TIMUR.COM, MAKASSAR-</strong>Bank Indonesia (BI) Sulawesi Selatan (Sulsel) mengimbau masyarakat agar lebih selektif dalam memilih&nbsp; KUPVA Bukan Bank (BB).</p>\r\n<p>Iwan Setiawan mengatakan, demi terciptanya penukaran uang asing yang tertib, masyarakat harus hati-hati .</p>\r\n<p>Juga harus memastikan usaha tersebut memperoleh izin&nbsp;<a title=\"Bank&nbsp;Indonesia\" href=\"https://makassar.tribunnews.com/tag/bank-indonesia\">Bank&nbsp;Indonesia</a>.</p>\r\n<p>&nbsp;</p>\r\n<p>Hal tersebut dapat dilihat melalui logo&nbsp;<a title=\"KUPVA&nbsp;BB\" href=\"https://makassar.tribunnews.com/tag/kupva-bb\">KUPVA&nbsp;BB</a>, sertifikat dari BI serta papan nama yang disertai nomor izin.</p>\r\n<p>\"Bagi masyarakat yang akan melalukan transaksi, lantas tak menemukan logo atau papan nama dan nomor izin, maka bisa lapor ke BI terdekat atau hubungi call center 131,\" katanya.</p>\r\n<p>Hal itu dikatannya saat menggelar pemaparan hasil penertiban&nbsp;<a title=\"KUPVA&nbsp;BB\" href=\"https://makassar.tribunnews.com/tag/kupva-bb\">KUPVA&nbsp;BB</a>&nbsp;di Ruang Rapat KPw BI Sulsel lantai IV, Jl Jenderal Sudirman,&nbsp;<a title=\"Makassar\" href=\"https://makassar.tribunnews.com/tag/makassar\">Makassar</a>, Sulawesi Selatan, Jumat (23/8/2019).</p>\r\n<p><br /><br />Diakses dari :&nbsp;<a href=\"https://makassar.tribunnews.com/2019/08/23/bi-imbau-masyarakat-gunakan-kupva-bb-yang-berizin\">Tribun-Timur.com</a>&nbsp;dengan judul BI Imbau Masyarakat Gunakan KUPVA BB yang Berizin,&nbsp;<a href=\"https://makassar.tribunnews.com/2019/08/23/bi-imbau-masyarakat-gunakan-kupva-bb-yang-berizin\">https://makassar.tribunnews.com/2019/08/23/bi-imbau-masyarakat-gunakan-kupva-bb-yang-berizin</a>.<br />Penulis: Sukmawati Ibrahim | Editor: Ansar</p>', 'bi-imbau-masyarakat-gunakan-kupva-bb-yang-berizin', 11, '2025-07-24 09:39:20', '2025-08-04 06:17:38'),
(18, 'NEWS9.jpg', 'NEWS10.jpg', 'Ilyasa Dahlan', '', 0, 'Rupiah Dibuka Perkasa, Dolar AS Turun Jadi Rp16.250', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Jakarta, CNBC Indonesia - Nilai tukar rupiah terhadap dolar Amerika Serikat (AS) pada pembukaan perdagangan hari ini, Kamis (24/7/2025) terpantau menguat.<br />Melansir dari Refinitiv, nilai tukar rupiah pada pembukaan perdagangan hari ini mengala', '<p>Jakarta, CNBC Indonesia - Nilai tukar rupiah terhadap dolar Amerika Serikat (AS) pada pembukaan perdagangan hari ini, Kamis (24/7/2025) terpantau menguat.<br />Melansir dari Refinitiv, nilai tukar rupiah pada pembukaan perdagangan hari ini mengalami penguatan sebesar 0,21% ke level Rp16.250/US$. Hal ini melanjutkan tren positif setelah pada perdagangan kemarin Rabu (23/7/2025) rupiah bisa menguat 0,12% terhadap dolar AS yakni berada di level Rp16.285/US$.<br /><br />Sementara itu, indeks dolar AS (DXY) pada penutupan perdagangan kemarin kembali mengalami pelemahan sebesar 0,18% di level 97,21, ini menandakan pelemahan selama empat hari berturut-turut bagi indeks dolar AS.<br /><br />Namun demikian, per pukul 09.00 WIB indeks dolar AS terpantau melemah tipis 0,08% di level 97,13.<br /><br />Pelemahan dolar AS menjadi sentimen utama yang menopang kinerja mata uang negara berkembang, termasuk rupiah. Arah kebijakan perdagangan AS kembali menjadi sorotan menjelang tenggat waktu 1 Agustus 2025, di mana Negeri Paman Sam memberi batas waktu kepada mitra dagangnya untuk mencapai kesepakatan tarif, atau berisiko dikenakan tarif tinggi. Seiring dengan pelaku pasar yang menunggu kepastian terkait tarif ini membuat dorongan terhadap pelemahan dolar AS.<br /><br />Di sisi lain, langkah investor global yang mulai memburu aset-aset berisiko seperti mata uang emerging market turut memperkuat posisi rupiah. Sentimen risk-on ini muncul di tengah ekspektasi bahwa ketegangan perdagangan dapat mereda atau bahkan membuka peluang negosiasi lanjutan yang lebih konstruktif, sehingga meningkatkan optimisme pasar.<br /><br />Dari dalam negeri, pasar akan turut mencermati proyeksi pertumbuhan ekonomi Indonesia yang baru dirilis oleh dua lembaga internasional, Asian Development Bank (ADB) dan ASEAN+3 Macroeconomic Research Office (AMRO).<br /><br />ADB mempertahankan outlook pertumbuhan RI di 5,0% pada 2025, didukung konsumsi rumah tangga, stimulus fiskal, serta pelonggaran suku bunga oleh Bank Indonesia.<br /><br />Sementara itu, AMRO justru memangkas proyeksi pertumbuhan menjadi 4,8% akibat dampak dari kebijakan tarif dagang AS terhadap ekspor dan konsumsi domestik. Kenaikan tarif impor AS menjadi 19% dinilai membebani permintaan dan menjadi risiko tambahan bagi prospek pemulihan ekonomi RI.</p>\r\n<p>&nbsp;</p>\r\n<p>BDi akses dari :&nbsp;CNBC Indonesia \"Rupiah Dibuka Perkasa, Dolar AS Turun Jadi Rp16.250\" selengkapnya di sini:&nbsp;<a href=\"https://www.cnbcindonesia.com/market/20250724083237-17-651766/rupiah-dibuka-perkasa-dolar-as-turun-jadi-rp16250\">https://www.cnbcindonesia.com/market/20250724083237-17-651766/rupiah-dibuka-perkasa-dolar-as-turun-jadi-rp16250</a><br /><br />Download Apps CNBC Indonesia sekarang https://app.cnbcindonesia.com/</p>', 'rupiah-dibuka-perkasa-dolar-as-turun-jadi-rp16250', 8, '2025-07-24 04:56:27', '2025-08-04 05:52:38'),
(23, 'USDASTREETNEWS.jpg', 'USDASTREETNEWS2.jpg', 'Ilyasa Dahlan', '', 0, 'Meramal Arah Suku Bunga The Fed di Era Tarif Trump', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Bisnis.com, JAKARTA &mdash; Ketua Federal Reserve Jerome Powell dan jajarannya akan memasuki ruang rapat bank sentral atau FOMC Meeting mulai Selasa (29/7/2025)</p>', '<p>Bisnis.com, JAKARTA &mdash; Ketua Federal Reserve Jerome Powell dan jajarannya akan memasuki ruang rapat bank sentral atau FOMC Meeting mulai Selasa (29/7/2025) untuk membahas suku bunga The Fed di tengah tekanan politik yang besar, kebijakan perdagangan yang dinamis, hingga dinamika ekonomi yang ketat. Pertemuan para pejabat The Fed bulan ini terbilang langka, karena rapat Federal Open Market Committee (FOMC) berlangsung pada pekan yang sama ketika pemerintah Amerika Serikat (AS) menerbitkan data pertumbuhan ekonomi, ketenagakerjaan, dan metrik harga pilihan bank sentral. Para ekonom dan berbagai lembaga meyakini suku bunga The Fed Juli 2025 tidak akan berubah, walaupun ada tekanan besar agar Powell cs segera menurunkan suku bunga&mdash;termasuk dari Presiden AS Donald Trump. Dilansir dari Bloomberg, perekonomian AS diperkirakan pulih pada kuartal II/2025, terutama karena penyempitan tajam defisit perdagangan setelah Trump mengumumkan rencana pemberlakuan tarif resiprokal. Pemimpin negara seantero dunia berbondong-bondong melakukan negosiasi tarif, para pelaku usaha mempercepat impor sebelum tarif baru berlaku.<br /><br />Permintaan rumah tangga dan investasi di AS diperkirakan hanya tumbuh moderat, meskipun pemerintah memperkirakan pertumbuhan ekonomi AS kuartal II/2025 akan mencapai 2,4% (year on year/YoY), setelah pada kuartal I/2025 menyusut ke 0,5% (YoY). Pertumbuhan lapangan kerja diperkirakan semakin lambat pada Juli 2025. Lalu, inflasi dasar Juni 2025 kemungkinan naik dari bulan sebelumnya.<br /><br />Beberapa pejabat The Fed mulai menyuarakan kekhawatiran tentang apa yang mereka anggap sebagai pasar kerja yang rapuh, termasuk dua orang yang mengatakan mereka melihat manfaat mempertimbangkan penurunan suku bunga sekarang. Tekanan juga meningkat dari luar ruang rapat. Presiden Donald Trump telah vokal tentang keinginannya agar Powell cs menurunkan biaya pinjaman bagi konsumen dan bisnis. Trump sering mengecam Powell karena bergerak terlalu lambat, sementara pada saat yang sama menyoroti kepemimpinannya atas pembengkakan biaya konstruksi terkait renovasi kantor pusat The Fed di Gedung Eccles, Washington, AS. Powell dan para bankir sentral lainnya telah menekankan perlunya kesabaran karena tarif yang diberlakukan pemerintahan Trump berisiko memicu kembali percepatan inflasi. Sejauh ini tahun ini, sejak berbagai bea masuk AS atas impor diberlakukan, tekanan harga masih tergolong moderat.<br /><br />Arah Suku Bunga The Fed Ekonom senior Wells Fargo Sarah House menuturkan, walaupun tidak ada perubahan suku bunga, dia menyebut adanya indikasi bahwa pasar sedang berada di titik balik dalam arah kebijakan. &ldquo;Tapi mayoritas anggota komite tampaknya belum sampai di tahap itu&mdash;mereka masih berhati-hati terhadap potensi tekanan inflasi akibat tarif,\" jelas House dikutip dari Bloomberg, Senin (28/7/2025). Pernyataan hasil rapat akan dipublikasikan pada Rabu (30/7/2025) pukul 14.00 waktu Washington, disusul konferensi pers oleh Powell 30 menit kemudian. Pasar kini memperkirakan pemangkasan suku bunga kemungkinan besar akan terjadi pada rapat berikutnya, September, dan pelaku pasar akan mencermati setiap pernyataan yang memperkuat ekspektasi tersebut.<br /><br />Sejumlah analis memprediksi adanya perbedaan pendapat (dissenting voice) dari Gubernur Fed Christopher Waller dan Wakil Ketua Pengawasan Michelle Bowman, dua pejabat yang diangkat oleh Trump dan secara terbuka menyuarakan kekhawatiran bahwa suku bunga saat ini terlalu tinggi di tengah risiko pelemahan pasar kerja. Waller sebelumnya telah memberi sinyal kemungkinan perbedaan pendapat awal bulan ini, dengan menyatakan The Fed seharusnya segera bertindak untuk mendukung pasar tenaga kerja yang ada di ujung tanduk. Sementara itu, Bowman pada Juni lalu juga mengatakan dirinya dapat mendukung pemangkasan suku bunga jika tekanan inflasi tetap lemah. Jika Waller dan Bowman sama-sama melakukan dissent, maka ini akan menjadi kali pertama dua gubernur Fed tidak sejalan sejak 1993. Waller sendiri disebut-sebut sebagai salah satu kandidat pengganti Powell saat masa jabatannya berakhir pada Mei mendatang. Namun demikian, beberapa pihak menilai perbedaan suara ini lebih bernuansa politis ketimbang teknis. Kepala Ekonom AS di JPMorgan Chase &amp; Co., Michael Feroli, dalam catatannya menyebut dissent atau perbedaan opini ganda lebih merupakan uji panggung untuk posisi Ketua The Fed dibanding cerminan kondisi ekonomi. Ekonom KPMG Diane Swonk juga menilai dissent menjadi hal lazim menjelang perubahan arah kebijakan.<br /><br />&ldquo;Perbedaan pandangan memang wajar muncul saat The Fed mendekati keputusan untuk memangkas suku bunga, apalagi dengan ketidakpastian tinggi soal dampak tarif,\" jelasnya. Saat Waller dan Bowman menitikberatkan mandat lapangan kerja, sebagian besar pejabat Fed lainnya masih fokus pada inflasi. Ketidakpastian terkait dampak tarif terhadap harga juga tercermin dari proyeksi yang dirilis Juni lalu, di mana 10 dari 19 pejabat mengusulkan dua kali pemangkasan suku bunga, sementara 7 lainnya tidak mengusulkan pemangkasan sama sekali. Laporan inflasi terbaru menunjukkan adanya kenaikan harga pada sejumlah barang yang terdampak tarif, seperti mainan dan peralatan rumah tangga. Namun, inflasi inti naik di bawah ekspektasi untuk bulan kelima berturut-turut pada Juni, mengindikasikan tekanan harga belum menyebar luas. Kepala Strategi Suku Bunga AS di Natixis North America, John Briggs, mengatakan bahwa pasca lonjakan inflasi akibat Covid-19, beberapa pejabat Fed lebih berhati-hati karena dampak tarif mungkin butuh waktu lebih lama untuk muncul. \"Masalahnya, The Fed jadi terus menunda pengambilan keputusan karena data yang belum jelas,\" katanya Natixis memproyeksikan The Fed akan mulai memangkas suku bunga pada Oktober dan melanjutkan penurunan bertahap sebesar 25 bps hingga Juni 2026.<br /><br />Diakses dari :&nbsp;<a href=\"https://www.bisnis.com/\">Bisnis.com</a>&nbsp;dengan judul \"Meramal Arah Suku Bunga The Fed di Era Tarif Trump\", Klik selengkapnya di sini:&nbsp;<a href=\"https://ekonomi.bisnis.com/read/20250729/620/1897266/meramal-arah-suku-bunga-the-fed-di-era-tarif-trump\">https://ekonomi.bisnis.com/read/20250729/620/1897266/meramal-arah-suku-bunga-the-fed-di-era-tarif-trump</a>.<br />Penulis : Lorenzo Anugrah Mahardhika &amp; Wibi Pangestu Pratama - Bisnis.com<br /><br /><br />Download aplikasi Bisnis.com terbaru untuk akses lebih cepat dan nyaman di sini:<br />Android:&nbsp;<a href=\"http://bit.ly/AppsBisniscomPS\">http://bit.ly/AppsBisniscomPS</a><br />iOS:&nbsp;<a href=\"http://bit.ly/AppsBisniscomIOS\">http://bit.ly/AppsBisniscomIOS</a><br />iOS:&nbsp;<a href=\"http://bit.ly/AppsBisniscomIOS\">http://bit.ly/AppsBisniscomIOS</a></p>', 'meramal-arah-suku-bunga-the-fed-di-era-tarif-trump', 13, '2025-07-29 04:31:29', '2025-07-29 04:34:52'),
(24, 'NEWSBANKING2.jpg', 'NEWSBANKING22.jpg', 'Ilyasa Dahlan', '', 0, 'PPATK Bakal Blokir Sementara Rekening Nganggur, Begini Respons Bank', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p><strong>KONTAN.CO.ID - JAKARTA.</strong>&nbsp;Pusat Pelaporan dan Analisis Transaksi Keuangan (PPATK) akan memblokir atau menghentikan sementara transaksi untuk rekening pasif</p>', '<p><strong>KONTAN.CO.ID - JAKARTA.</strong>&nbsp;Pusat Pelaporan dan Analisis Transaksi Keuangan (PPATK) akan memblokir atau menghentikan sementara transaksi untuk rekening pasif atau rekening dormant.</p>\r\n<p>Dikutip dari pengumuman dalam akun resmi Instagram @ppatk_indonesia, PPATK menjelaskan bahwa rekening dormant merupakan rekening tabungan, baik perorangan atau perusahaan, rekening giro, maupun rekening rupiah/valuta asing yang tidak digunakan untuk transaksi apa pun selama tiga&nbsp;hingga 12 bulan.</p>\r\n<p>&nbsp;</p>\r\n<p>Menyoal ini, Pengamat perbankan Moch Amin Nurdin&nbsp;mengatakan bahwa penyebab dari PPATK tengah fokus terhadap pengurangan rekening nganggur&nbsp;sebab jumlahnya yang diprediksi cenderung naik. Bila jumlah rekening dormant meningkat maka dikhawatirkan bakal banyak penyalahgunaan oleh pihak tak berwenang.</p>\r\n<p>\"Oleh sebab itu, PPATK menyarankan bank untuk melakukan sesuatu. Sebab banyak risiko. Banyak kejahatan pencucian uang, judol, dan lainnya dengan menggunakan rekening dormant,\" kata Amin kepada Kontan, Senin (28/7).</p>\r\n<p>Lebih dalam, Amin mengatakan bahwa penyebab dari makin bertambahnya jumlah rekening nganggur ini ialah banyaknya event yang melibatkan perbankan sebagai sponsor, penurunan daya beli yang senantiasa menurunkan hasrat menabung, dan adanya program pemerintah yang penyalurannya melalui rekening bank tertentu.</p>\r\n<p><strong>Baca Juga:&nbsp;<a class=\"track-bacajuga-inside\" href=\"https://nasional.kontan.co.id/news/ppatk-transaksi-judi-online-libatkan-rekening-penerima-bansos-total-rp-957-miliar\">PPATK: Transaksi Judi Online Libatkan Rekening Penerima Bansos, Total Rp 957 Miliar!</a></strong></p>\r\n<p>Merespons hal ini PT Bank Mandiri (Persero) Tbk&nbsp;mengatakan bahwa pihaknya mendukung penuh langkah-langkah yang dilakukan oleh PPATK dalam rangka penguatan rezim Anti Pencucian Uang, Pencegahan Pendanaan Terorisme dan Pencegahan Pendanaan Proliferasi Senjata Pemusnah Massal (APU PPT dan PPPSPM) di Indonesia.</p>\r\n<p>\"Adapun mekanisme pelaksanaan penghentian sementara transaksi mengacu kepada ketentuan UU No 8 Tahun 2010 tentang Pencegahan dan Pemberantasan Tindak Pidana Pencucian Uang,\" kata&nbsp;<em>Corporate Secretary</em>&nbsp;Bank Mandiri M. Ashidiq Iswara.</p>\r\n<p>Sebelumnya, ia menjelaskan bahwa rekening Mandiri akan menjadi dormant jika nasabah tidak melakukan transaksi keuangan apa pun, selain pembayaran biaya administrasi, selama 180 hari atau 6 bulan.</p>\r\n<p>Selain itu, PT Bank Pembangunan Daerah Jawa Barat dan Banten Tbk atau Bank BJB juga selaras. Pihaknya bakal terus menjunjung tinggi prinsip kepatuhan terhadap ketentuan peraturan perundang-undangan, dalam hal ini ialah otoritas yang berwenang seperti PPATK.</p>\r\n<p>Sekretaris Perusahaan Bank BJB Ayi Subarna menuturkan jika pihaknya sendiri sebelumnya telah memiliki kebijakan dan prosedur pengelolaan rekening dormant yang mengacu pada prinsip mengenali pengguna jasa.&nbsp;</p>\r\n<p>Dalam kebijakan itu, sebuah rekening dikategorikan dormant apabila tidak terdapat aktivitas transaksi debit seperti transfer keluar, pembayaran, atau pembelian dalam kurun waktu tertentu antara 6-12 bulan bergantung pada karakteristik masing-masing produk.</p>\r\n<p>\"Terkait mekanisme pemblokiran dan pembukaan blokir tersebut, bank bjb memastikan bahwa seluruh proses dilakukan secara transparan dan akuntabel,\" katanya.</p>\r\n<p>Unit usaha syariah PT Bank CIMB Niaga Tbk mencatatkan per tahun 2025 ini, CIMB Niaga Syariah memiliki jumlah total puluhan ribu rekening dormant. Hal ini disampaikan oleh Direktur CIMB Niaga Syariah Pandji P. Djajanegara.</p>\r\n<p>\"Di tahun 2025 terdapat puluhan ribu account dormant. Dan untuk memitigasinya dilakukan review berkala di masing-masing cabang,\" kata Pandji.</p>\r\n<p>Sementara itu, PT Bank Oke Indonesia Tbk atau OK Bank menyampaikan bahwa semenjak berdiri, OK Bank mencatat ada sekitar 2.000 rekening dormant. Sebagian besar adalah rekening yang dibuka sejak lama, sebelum PT Bank Dinar Tbk dan PT Bank Oke Indonesia merger menjadi OK Bank pada tahun 2019.</p>\r\n<p>Direktur Kepatuhan OK Bank Efdinal Alamsyah menjelaskan bahwa seiring berjalannya waktu, dia memproyeksi jumlah total rekening dormant bakal senantiasa menurun.</p>\r\n<p>\"Seharusnya jumlah rekening dormant akan berkurang, karena bank biasanya punya kebijakan bahwa rekening dormant yang sudah tidak mempunyai saldo akan ditutup secara otomatis,\" tutur Efdinal.</p>\r\n<p>&nbsp;</p>\r\n<p>Diakses dari :&nbsp;https://keuangan.kontan.co.id/news/ppatk-bakal-blokir-sementara-rekening-nganggur-begini-respons-bank</p>', 'ppatk-bakal-blokir-sementara-rekening-nganggur-begini-respons-bank', 14, '2025-07-29 04:41:29', '2025-07-29 04:41:29'),
(25, 'NEWSBANKING1.jpg', 'NEWSBANKING12.jpg', 'Ilyasa Dahlan', '', 0, 'Kesepakatan AS-Indonesia Bawa Dampak Positif ke Dunia Usaha', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Jakarta, CNBC Indonesia - Pemerintah Indonesia dan Amerika Serikat resmi menyepakati sebuah kerangka kerja untuk negosiasi Perjanjian Perdagangan Timbal Balik kedua negara</p>', '<p>Jakarta, CNBC Indonesia - Pemerintah Indonesia dan Amerika Serikat resmi menyepakati sebuah kerangka kerja untuk negosiasi Perjanjian Perdagangan Timbal Balik kedua negara.<br />Kerangka ini membuka jalan bagi penghapusan hampir seluruh tarif impor Indonesia terhadap produk-produk industri, pangan, dan pertanian dari Amerika Serikat. Sementara itu, AS akan menurunkan tarif produk Indonesia menjadi 19%, jauh lebih rendah dibandingkan tarif awal sebesar 32%.<br /><br />Kesepakatan ini dinilai banyak pihak bakal membawa dampak positif terhadap dunia usaha, salah satunya terkait perdagangan digital, jasa dan investasi.<br /><br />Seperti diketahui dalam kesepakatan ini Indonesia berkomitmen untuk mengatasi hambatan yang mempengaruhi perdagangan digital, jasa, dan investasi. Indonesia akan memberikan kepastian atas kemampuan untuk mentransfer data pribadi ke luar wilayahnya ke Amerika Serikat.<br /><br />Menurut Guru Besar Fakultas Hukum Universitas Padjadjaran, Prof. Ahmad M. Ramli, praktik transfer data pribadi lintas negara di era perdagangan digital adalah hal tak terhindarkan. Bahkan ia mengatakan selama ini hal tersebut telah berlangsung, terutama data pribadi pengguna platform digital.<br /><br />\"Tanpa proses transfer data, tidak akan ada layanan dan transaksi digital lintas negara. Dengan adanya UU PDP (Undang-Undang Perlindungan Data Pribadi), maka transfer data pribadi pun harus dilakukan dengan dasar pemrosesan yang sah,\" ungkap dia kepada CNBC Indonesia, Sabtu (26/7/2025).<br /><br />Namun ujar Ramli, kesepakatan antara Indonesia dan Amerika Serikat terkait hal itu harus ditindaklanjuti dengan melakukan pengawasan, monitoring evaluasi, dan menegakkan kepatuhan UU PDP. Hal ini agar transfer data ke mana pun di dunia tetap dilakukan secara akuntabel dan patuh hukum.<br /><br />\"Panduan teknis terkait hal ini seharusnya dibuat oleh Lembaga Pelindungan Data Pribadi. Pemerintah perlu membentuk Lembaga ini sesuai amanat UU PDP,\" tegas dia.<br /><br />Lebih lanjut dia menyampaikan kesepakatan ini membawa manfaat kepastian hukum bagi pelaku usaha Indonesia dalam pertukaran data lintas batas. Sehingga akan turut mendorong pertumbuhan perdagangan digital dan e-commerce.<br /><br />\"Pada prinsipnya kita mengakui bahwa AS memiliki perlindungan data yang sepadan sesuai UU 27/2022 tentang PDP,\" kata Prof. Ramli.<br /><br /><br />Diakses dari : l CNBC Indonesia \"Kesepakatan AS-Indonesia Bawa Dampak Positif ke Dunia Usaha\" selengkapnya di sini:&nbsp;<a href=\"https://www.cnbcindonesia.com/news/20250726194204-4-652476/kesepakatan-as-indonesia-bawa-dampak-positif-ke-dunia-usaha\">https://www.cnbcindonesia.com/news/20250726194204-4-652476/kesepakatan-as-indonesia-bawa-dampak-positif-ke-dunia-usaha</a><br /><br />Download Apps CNBC Indonesia sekarang https://app.cnbcindonesia.com/</p>', 'kesepakatan-as-indonesia-bawa-dampak-positif-ke-dunia-usaha', 15, '2025-07-30 08:00:27', '2025-07-30 08:00:27'),
(26, 'NEWSUSACITY.jpg', 'NEWSUSACITY2.jpg', 'Ilyasa Dahlan', '', 0, 'BI DKI Jakarta Batasi Sementara Izin Baru Money Changer Per 1 Juli 2025  ', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>JAKARTA, KOMPAS.com - Kantor Perwakilan (KPw) Bank Indonesia (BI) Provinsi DKI Jakarta akan memberlakukan pembatasan sementara&nbsp;</p>', '<p>JAKARTA, KOMPAS.com - Kantor Perwakilan (KPw) Bank Indonesia (BI) Provinsi DKI Jakarta akan memberlakukan pembatasan sementara terhadap pemberian izin Kegiatan Usaha Penukaran Valuta Asing Bukan Bank (KUPVA BB) di Wilayah Jakarta pada 1 Juli 2025 sampai 31 Desember 2026. Kepala Perwakilan BI Provinsi DKI Jakarta Arlyana Abubakar mengatakan, kebijakan itu dilakukan untuk menjaga efisiensi, pertumbuhan, serta persaingan usaha yang sehat di sektor jasa penukaran uang asing. Adapun sejauh ini, disebutkan Arlyana, jumlah kantor pusat dan kantor cabang pelayanan money changer di Jakarta sebanyak 482.<br /><br />Angka itu dikhawatirkan akan bertambah banyak lagi mengingat jumlah institusi di Jakarta yang menyelenggarakan money changer sebanyak 31 persen dari total jumlah penyelenggara secara nasional.<br /><br /></p>\r\n<p>Sementara perbankan yang melayani transaksi valuta asing hanya 7 bank yang meliputi bank pelat merah dan swasta. \"Jadi, memang kita melihat bahwa karena kita sudah cukup, kita lakukan simulasi nih kalau kita tambah lagi jumlahnya, maka ini bisa terjadi inefisiensi. Inefisiensi itu artinya akan terjadi persaingan yang tidak sehat. Jadi, begitu kalau kita tambah, maka dia, nanti akan bisa menyebabkan struktur pasarnya itu menjadi mempengaruhi tingkat profitabilitas,\" ujarnya saat jumpa pers di Jakarta, Minggu (1/6/2025). \"Jadi, kalau pasarnya jenuh, persaingan menjadi tidak sehat, dia menjadi tidak efisien, maka terjadi penambahan persaingan sehingga return on asset-nya dia jadi turun. Ini kan jadi nggak bagus nih industri ini,\" sambungnya.<br /><br />Arlyana menjelaskan, pembatasan izin ini berlaku untuk izin baru KUPVA BB, pembukaan kantor cabang oleh penyelenggara yang berbasis di luar Jakarta, serta relokasi kantor pusat atau cabang KUPVA BB dari luar ke dalam wilayah DKI.<br /><br />Namun, Arlyana menegaskan bahwa pembatasan ini tidak berlaku bagi perpanjangan izin usaha yang sudah ada di Jakarta, pembukaan cabang oleh KUPVA BB yang sudah berkantor pusat di Jakarta, maupun permohonan izin baru yang sudah lengkap dan terdaftar di sistem perizinan Ease sebelum 1 Juli 2025. \"Kita batasi mulai dari 1 Juli sampai 31 Desember 2026. Nanti itu kita evaluasi setiap 6 bulan dan ini memang hanya untuk perizinan money changer baru di Jakarta. Sementara kalau dia mau memperpanjang asal kantornya di Jakarta itu enggak apa-apa,\" jelas Arlyana.<br /><br /><br />Artikel ini telah tayang di&nbsp;<a href=\"https://www.kompas.com/\">Kompas.com</a>&nbsp;dengan judul \"BI DKI Jakarta Batasi Sementara Izin Baru Money Changer Per 1 Juli 2025\", Klik untuk baca:&nbsp;<a href=\"https://money.kompas.com/read/2025/06/01/154359126/bi-dki-jakarta-batasi-sementara-izin-baru-money-changer-per-1-juli-2025?page=all\">https://money.kompas.com/read/2025/06/01/154359126/bi-dki-jakarta-batasi-sementara-izin-baru-money-changer-per-1-juli-2025?page=all</a>.<br /><br /><br />Kompascom+ baca berita tanpa iklan:&nbsp;<a href=\"https://kmp.im/plus6\">https://kmp.im/plus6</a><br />Download aplikasi:&nbsp;<a href=\"https://kmp.im/app6\">https://kmp.im/app6</a></p>', 'bi-dki-jakarta-batasi-sementara-izin-baru-money-changer-per-1-juli-2025', 16, '2025-08-01 07:45:53', '2026-07-08 08:37:30'),
(27, 'NEWS102.jpg', 'NEWS103.jpg', 'Ilyasa Dahlan', '', 0, 'Pasar Berhitung Pemangkasan Suku Bunga The Fed, Dolar Anjlok  ', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Bisnis.com, JAKARTA &mdash; Nilai tukar dolar AS&nbsp;anjlok pada akhir pekan ini, setelah para pelaku pasar menghitung ekspektasi pemangkasan suku bunga The Fed</p>', '<p>Bisnis.com, JAKARTA &mdash; Nilai tukar dolar AS&nbsp;anjlok pada akhir pekan ini, setelah para pelaku pasar menghitung ekspektasi pemangkasan suku bunga The Fed. Berdasarkan data&nbsp;Bloomberg, indeks Bloomberg Dollar Spot turun 0,9% atau penurunan harian terburuk sejak 11 April 2025. Di sepanjang tahun berjalan, greenback sudah terdepresiasi lebih dari 7% akibat kebijakan dagang Trump yang agresif mengguncang pasar mata uang dan membebani prospek pertumbuhan global. Sementara itu, yen mencatat penguatan tertinggi atau naik hingga 2,3% terhadap dolar dan euro menguat lebih dari 1%. Adapun, laporan ketenagakerjaan AS yang dirilis lebih lemah dari perkiraan membuat para pelaku pasar berekspektasi besaran pemangkasan suku bunga di Negeri Paman Sam tahun ini. <br /><br />Data ketenagakerjaan bulan Juli meleset dari ekspektasi dan dua bulan sebelumnya direvisi lebih rendah. Hal ini mendorong pelaku pasar untuk sepenuhnya memperkirakan ada dua kali pemangkasan suku bunga oleh The Fed tahun ini. Laporan ketenagakerjaan yang lemah muncul di tengah kritik Presiden AS Donald Trump terhadap Ketua The Fed Jerome Powell karena dinilai lamban dalam menurunkan suku bunga. Helen Given, seorang trader valuta asing di Monex Inc, mengatakan saat ini sudah jelas pasar tenaga kerja AS sedang mendingin secara cukup tajam. \"Ada kemungkinan besar bahwa kampanye Trump terhadap Ketua Powell akan semakin memanas dalam beberapa hari mendatang, dan hal ini dapat menyebabkan pelemahan dolar lebih lanjut,\" kata Given, dikutip&nbsp;Bloomberg, Minggu (3/7/2025). Adapun, Juli sebenarnya memberikan sedikit kelegaan karena pelaku pasar mengurangi posisi jual terhadap dolar seiring dengan berkurangnya tekanan terhadap mata uang tersebut. Menurut data dari Commodity Futures Trading Commission yang dirilis Jumat, posisi spekulatif terhadap pelemahan dolar di pasar berjangka dan opsi tercatat pada level terendah sejak April dalam pekan yang berakhir pada 29 Juli 2025. Meski demikian, beberapa pelaku pasar memperkirakan dolar masih berpotensi melemah jika data ekonomi terus menunjukkan perlambatan pertumbuhan. &ldquo;Jika kelemahan dalam data aktivitas ekonomi terus berlanjut ke depan, pasar akan mulai mempertanyakan kinerja unggul saham AS belakangan ini yang sebagian besar didorong oleh pengumuman kesepakatan dagang, yang sebelumnya sempat mendongkrak dolar dibanding mata uang lainnya,&rdquo; kata Jayati Bharadwaj, seorang ahli strategi di TD Securities. <br /><br />Artikel ini telah tayang di&nbsp;Bisnis.com&nbsp;dengan judul \"Pasar Berhitung Pemangkasan Suku Bunga The Fed, Dolar Anjlok\", Klik selengkapnya di sini:&nbsp;https://market.bisnis.com/read/20250803/93/1898834/pasar-berhitung-pemangkasan-suku-bunga-the-fed-dolar-anjlok.<br /> Penulis : Dwi Nicken Tari - Bisnis.com<br /> <br /><br />Download aplikasi Bisnis.com terbaru untuk akses lebih cepat dan nyaman di sini:<br /> Android:&nbsp;http://bit.ly/AppsBisniscomPS<br /> iOS:&nbsp;http://bit.ly/AppsBisniscomIOS<!--/data/user/0/com.samsung.android.app.notes/files/clipdata/clipdata_bodytext_250803_184048_305.sdocx--></p>', 'pasar-berhitung-pemangkasan-suku-bunga-the-fed-dolar-anjlok', 17, '2025-08-03 11:42:23', '2026-01-02 03:50:58'),
(28, 'NEWSUSD20.jpg', 'NEWSUSD202.jpg', 'Ilyasa Dahlan', '', 0, 'Mata Uang Negara Berkembang Ambil Kesempatan Saat Dolar AS Terkapar  ?', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Bisnis.com, JAKARTA &ndash; Mata uang negara berkembang, termasuk rupiah, mengambil kesempatan untuk menguat di hadapan dolar AS yang terkapar usai rilis data tenaga kerja AS.&nbsp;</p>', '<p>Bisnis.com, JAKARTA &ndash; Mata uang negara berkembang, termasuk rupiah, mengambil kesempatan untuk menguat di hadapan dolar AS yang terkapar usai rilis data tenaga kerja AS. Berdasarkan data&nbsp;Bloomberg, indeks mata uang negara berkembang MSCI naik 0,5% pada Senin (4/8/2025) dalam kenaikan harian terbesar selama lebih dari sebulan. Sementara itu, Bloomberg Dollar Spot Index nyaris tidak berubah setelah turun 0,9% pada sesi sebelumnya. Peso Filipina dan ringgit Malaysia menjadi yang paling unggul dengan penguatan sekitar 1% terhadap dolar AS. Sedangkan rupiah&nbsp;mengawali perdagangan hari ini dengan menguat 0,81% atau 134,5 poin ke level Rp16.378,5 per dolar AS. Pada saat yang sama, indeks dolar AS terpantau turun 0,33% ke posisi 98,81.<br /><br />Apresiasi mata uang&nbsp;developing market&nbsp;ini terjadi setelah&nbsp;data tenaga kerja AS tampil lebih lemah dari perkiraan. Hal ini mendorong para pelaku pasar untuk memperkirakan pemangkasan suku bunga oleh Federal Reserve yang membuat nilai dolar AS melemah. Aset negara berkembang terpantau mendapatkan angin segar setelah pekan lalu tertekan oleh serangkaian tarif baru yang diumumkan oleh Presiden AS Donald Trump. Indeks mata uang MSCI sebelumnya turun selama enam sesi berturut-turut sebelum mengalami rebound hari ini. Investor saat ini bertaruh bahwa The Fed dapat menurunkan suku bunga secepat-cepatnya bulan depan, menyusul pelemahan mengejutkan dalam data ketenagakerjaan AS. Lloyd Chan, ahli strategi mata uang di MUFG Bank, melihat jika The Fed melanjutkan pemangkasan suku bunga pada bulan September dan memberikan sinyal kebijakan yang lebih dovish, hal ini berpotensi mendukung mata uang Asia. \"Namun, risiko bagi mata uang regional dapat muncul dari penerapan tarif AS yang lebih tinggi, yang bisa membebani ekspor,\" tulis Chan dalam catatan, dikutip&nbsp;Bloomberg pada Senin (4/8/2025).<br /><br />Adapun, sentimen terhadap pasar saham cenderung lebih lemah menyusul penurunan tajam di Wall Street pada akhir pekan lalu yang dipicu oleh meningkatnya angka pengangguran di AS dan perlambatan penciptaan lapangan kerja. Indeks saham di Indonesia, Filipina, dan Malaysia seluruhnya melemah pada awal perdagangan hari ini. Sementara itu, indeks saham MSCI untuk negara berkembang naik tipis 0,3%, didorong oleh saham-saham teknologi unggulan di Korea Selatan dan China. Disclaimer: berita ini tidak bertujuan mengajak membeli atau menjual saham. Keputusan investasi sepenuhnya ada di tangan pembaca. Bisnis.com tidak bertanggung jawab terhadap segala kerugian maupun keuntungan yang timbul dari keputusan investasi pembaca.<br /><br />Artikel ini telah tayang di&nbsp;<a href=\"https://www.bisnis.com/\">Bisnis.com</a>&nbsp;dengan judul \"Mata Uang Negara Berkembang Ambil Kesempatan Saat Dolar AS Terkapar\", Klik selengkapnya di sini:&nbsp;<a href=\"https://market.bisnis.com/read/20250804/93/1899058/mata-uang-negara-berkembang-ambil-kesempatan-saat-dolar-as-terkapar\">https://market.bisnis.com/read/20250804/93/1899058/mata-uang-negara-berkembang-ambil-kesempatan-saat-dolar-as-terkapar</a>.<br />Penulis : Dwi Nicken Tari - Bisnis.com<br /><br /><br />Download aplikasi Bisnis.com terbaru untuk akses lebih cepat dan nyaman di sini:<br />Android:&nbsp;<a href=\"http://bit.ly/AppsBisniscomPS\">http://bit.ly/AppsBisniscomPS</a><br />iOS:&nbsp;<a href=\"http://bit.ly/AppsBisniscomIOS\">http://bit.ly/AppsBisniscomIOS</a></p>', 'mata-uang-negara-berkembang-ambil-kesempatan-saat-dolar-as-terkapar', 18, '2025-08-04 05:42:19', '2026-07-16 04:45:02'),
(34, 'IG-DUA-SISI-2026-(1180-x-684-px)_20260714_191111_0000.jpg', 'IG_DUA_SISI_2026__1180_x_684_px__20260714_191111_00002.jpg', 'Ilyasa Dahlan', '', 2, 'Waspada Penipuan Pembayaran: Pastikan Anda Hanya Melakukan Pembayaran ke Rekening Resmi Perusahaan', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Di era digital, transaksi menjadi semakin mudah dan cepat. Namun, kemudahan tersebut juga dimanfaatkan oleh oknum yang tidak bertanggung jawab untuk melakukan berbagai modus penipuan, salah satunya dengan memberikan nomor rekening palsu yang menga', '<p>Di era digital, transaksi menjadi semakin mudah dan cepat. Namun, kemudahan tersebut juga dimanfaatkan oleh oknum yang tidak bertanggung jawab untuk melakukan berbagai modus penipuan, salah satunya dengan memberikan nomor rekening palsu yang mengatasnamakan suatu perusahaan.<br />Sebagai pelanggan, penting untuk selalu berhati-hati sebelum melakukan pembayaran. Satu langkah sederhana, yaitu memastikan bahwa dana dikirim ke rekening resmi perusahaan, dapat melindungi Anda dari risiko kehilangan uang akibat penipuan.</p>\r\n<p><br />Mengapa Verifikasi Rekening Itu Penting?</p>\r\n<p><br />Penipu sering memanfaatkan berbagai cara untuk meyakinkan korban, seperti:<br />Mengaku sebagai perwakilan perusahaan.<br />Mengirimkan nomor rekening yang berbeda dari rekening resmi.<br />Membuat situs web atau akun media sosial palsu yang menyerupai perusahaan asli.<br />Menghubungi pelanggan melalui WhatsApp, SMS, email, atau media sosial dengan alasan perubahan rekening atau instruksi pembayaran baru.<br />Apabila pembayaran dilakukan ke rekening yang tidak resmi, dana yang telah ditransfer umumnya sulit untuk dipulihkan.<br />Selalu Pastikan Rekening Tujuan Adalah Rekening Resmi Perusahaan<br />Sebelum melakukan transfer, lakukan beberapa langkah berikut:<br />Pastikan nama penerima rekening sesuai dengan nama resmi perusahaan.<br />Periksa kembali nomor rekening sebelum mengirim dana.<br />Jangan mudah percaya pada informasi perubahan rekening yang dikirim melalui pihak yang tidak dapat diverifikasi.<br />Apabila terdapat keraguan, hubungi layanan pelanggan melalui nomor telepon, WhatsApp, atau email resmi perusahaan.</p>\r\n<p><br />Simpan bukti transaksi setelah pembayaran berhasil dilakukan.<br />Waspadai Modus Penipuan yang Sering Terjadi<br />Beberapa modus yang umum ditemukan antara lain:<br />Penipu menghubungi pelanggan dan mengaku sebagai staf perusahaan.<br />Mengirim invoice atau tagihan palsu dengan nomor rekening yang berbeda.<br />Mengaku terdapat promo khusus dengan syarat pembayaran ke rekening pribadi.<br />Meminta pembayaran segera dengan alasan transaksi akan dibatalkan apabila tidak segera ditransfer.<br />Perusahaan yang profesional tidak akan meminta pelanggan mentransfer dana ke rekening pribadi karyawan.<br />Tips Aman Bertransaksi<br />Selalu gunakan kanal komunikasi resmi perusahaan.<br />Jangan membagikan data pribadi maupun bukti pembayaran kepada pihak yang tidak dikenal.<br />Hindari melakukan transaksi hanya berdasarkan informasi dari mesin pencari atau media sosial yang belum terverifikasi.</p>\r\n<p><br />Jika menemukan informasi yang mencurigakan, lakukan konfirmasi langsung kepada perusahaan.<br />Komitmen Kami terhadap Keamanan Transaksi<br />Demi melindungi seluruh pelanggan, kami hanya menerima pembayaran yang dilakukan ke rekening resmi atas nama perusahaan kami.<br />Kami mengimbau seluruh pelanggan untuk selalu melakukan verifikasi sebelum melakukan pembayaran. Kewaspadaan Anda merupakan langkah terbaik untuk menghindari tindak penipuan.</p>', 'waspada-penipuan-pembayaran-pastikan-anda-hanya-melakukan-pembayaran-ke-rekening-resmi-perusahaan', 23, '2026-07-14 12:24:07', '2026-07-14 12:24:07');
INSERT INTO `terre217_news_events` (`id`, `img`, `img_2`, `author`, `type`, `placement`, `title`, `period_time`, `start_date`, `end_date`, `events_date`, `publish`, `short_description`, `description`, `permalink`, `order_id`, `created_at`, `updated_at`) VALUES
(32, 'Website-PIC-1.jpg', 'Website_PIC_12.jpg', 'Ilyasa Dahlan', '', 2, 'Berlaku 1 Juli 2026. BI Batasi Pembelian Dolar AS US$10.000 ', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Jakarta, CNBC Indonesia - Aturan Bank Indonesia (BI) terkait dengan ambang batas pembelian valuta asing secara tunai tanpa agunan atau underlying sebesar US$ 10.000<br /><br /><br /></p>', '<p>Jakarta, CNBC Indonesia - Aturan Bank Indonesia (BI) terkait dengan ambang batas pembelian valuta asing secara tunai tanpa agunan atau underlying sebesar US$ 10.000 per pelaku/orang per bulan berlaku mulai hari ini, 1 Juli 2026.<br />Gubernur Bank Indonesia Perry Warjiyo mengatakan langkah tersebut merupakan salah satu upaya memperkuat kebijakan pendalaman Pasar Uang dan Pasar Valas (PUVA) agar semakin maju, efisien, dan pruden untuk daya tarik investasi asing dan efektivitas kebijakan moneter, termasuk stabilisasi nilai tukar Rupiah.<br /><br />\"Penguatan prinsip kehati-hatian dalam PUVA melalui implementasi penurunan threshold beli tunai valuta asing terhadap Rupiah tanpa underlying menjadi USD10.000 per pelaku per bulan yang mulai berlaku 1 Juli 2026,\" papar Perry, dikutip Rabu (1/7/2026).<br /><br />Perry menegaskan, kebijakan bagian dari penguatan prinsip kehati-hatian dalam pelaporan lalu lintas devisa melalui penyesuaian treshold kewajiban dukungan pendukung transfer dana ke luar negeri dalam valas dari nominal setara US$ 50 ribu menjadi setara US$ 25 ribu.<br /><br />Ini adalah ketiga kalinya dalam satu tahun ini BI menurunkan ambang batas underlying pembelian dolar AS. Pada Maret, BI menurunkan batasan dari US$ 100.000 menjadi US$ 50.000. Kemudian, pada Juni, BI kembali memutuskan menurunkan ambang batas dari US$ 25.000 menjadi US$15.000.<br /><br />Deputi Gubernur Senior Bank Indonesia (BI) Destry Damayanti mengungkapkan sejatinya BI tidak membatasi masyarakat untuk bertransaksi menggunakan dolar AS. Namun untuk stabilitas rupiah, ada syarat yang harus dipenuhi yakni memiliki dokumen transaksi yang melandasi kebutuhan valas (dokumen underlying) untuk transaksi dolar AS.<br /><br />\"Boleh transaksi dolar AS lebih dari US$10.000, tapi harus ada dokumen underlying jelas, jadi kita bukan membatasi, orang gak boleh transaksi dolar gitu, rupiah ke dolar enggak tapi kita hanya ingin mengatur, menata ulang tata kelolanya,\" kata Destry dalam Economic Update 2026 CNBC Indonesia, beberapa waktu lalu.<br /><br /></p>\r\n<p>Bagi nasabah yang ingin memborong dolar di atas ambang batas tersebut, BI mewajibkan adanya dokumen pendukung atau underlying transaksi yang sah dan bersifat riil.<br /><br />Dokumen ini menjadi bukti bahwa pembelian valas tersebut digunakan untuk kegiatan ekonomi produktif atau pemenuhan kewajiban, bukan untuk tujuan spekulatif atau sekadar investasi jangka pendek mencari keuntungan dari fluktuasi kurs.<br /><br />Beberapa contoh kegiatan yang sah dan dikategorikan memiliki underlying transaksi kuat antara lain:<br /><br />Kegiatan Impor Barang: Dibuktikan dengan dokumen Pemberitahuan Impor Barang (PIB) atau Invoice tagihan dari mitra dagang luar negeri.<br />Pembayaran Jasa Luar Negeri: Seperti biaya sekolah/kuliah di luar negeri, biaya pengobatan, atau pembayaran royalti dan lisensi internasional.<br />Pembayaran Utang Luar Negeri: Dokumen penarikan pinjaman atau jadwal pembayaran jatuh tempo utang luar negeri yang telah terdaftar.<br />Jika total pembelian valas dalam satu bulan masih berada di bawah atau sama dengan ekuivalen US$ 10.000, masyarakat cukup menandatangani surat pernyataan dari bank atau money changer tanpa perlu melampirkan dokumen underlying tersebut.<br /><br />Destry mencontohkan masyarakat yang ingin menempuh pendidikan di luar negeri, membutuhkan dolar AS lebih dari US$10.000, boleh dilakukan asal memiliki dokumen underlying seperti contohnya acceptance letter.<br /><br />\"Misal mau sekolah ke luar negeri, kan pasti enggak mungkin dong cuma US$10.000, pasti akan butuhnya lebih, asal ada dokumennya jelas, misalnya acceptance letter dari luar negeri butuh biaya sekian, oh itu boleh, karena itu menjadi underlying-nya, jadi kita bukan membatasi, tapi belilah atau tukarlah sesuai dengan kebutuhan,\" jelasnya.<br /><br />Baca artikel asli CNBC Indonesia \"Berlaku Hari Ini! BI Batasi Pembelian Dolar AS US$10.000\" selengkapnya di sini: <a href=\"https://www.cnbcindonesia.com/news/20260701061622-4-746978/berlaku-hari-ini-bi-batasi-pembelian-dolar-as-us-10000\">https://www.cnbcindonesia.com/news/20260701061622-4-746978/berlaku-hari-ini-bi-batasi-pembelian-dolar-as-us-10000</a><br /><br />Download Apps CNBC Indonesia sekarang https://app.cnbcindonesia.com/</p>', 'berlaku-1-juli-2026-bi-batasi-pembelian-dolar-as-us10000', 21, '2026-07-02 06:17:22', '2026-07-16 04:44:50'),
(30, 'NEWSSING23.jpg', 'NEWSSING24.jpg', 'Ilyasa Dahlan', '', 2, 'Singapura berhenti terbitkan uang kertas pecahan S$ 1.000, ada apa?', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p><strong>KONTAN.CO.ID -&nbsp;SINGAPURA.</strong>&nbsp; Mulai 1 Januari tahun depan, Singapura akan berhenti menerbitkan uang kertas pecahan S$ 1.000 untuk mengurangi risiko pencucian uang dan pendanaan terorisme.</p>', '<p><strong>KONTAN.CO.ID -&nbsp;SINGAPURA.</strong>&nbsp; Mulai 1 Januari tahun depan, Singapura akan berhenti menerbitkan uang kertas pecahan S$ 1.000 untuk mengurangi risiko pencucian uang dan pendanaan terorisme.&nbsp;</p>\r\n<p>Hanya, mulai sekarang hingga Desember nanti, peredaran uang kertas pecahan S$ 1.000 akan terbatas setiap bulan.</p>\r\n<p>\"Ini adalah tindakan pencegahan untuk mengurangi risiko pencucian uang dan pendanaan terorisme yang lebih tinggi terkait dengan uang kertas denominasi besar,\" kata Monetary Authority of Singapore (MAS).&nbsp;</p>\r\n<p>Menurut MAS, uang kertas denominasi besar memungkinkan individu untuk membawa nilai uang yang besar secara anonim.</p>\r\n<p>\"Langkah ini sejalan dengan norma internasional dan yurisdiksi utama telah berhenti mengeluarkan uang kertas denominasi besar seperti itu,\" ujar MAS, Selasa (3/11), seperti dikutip&nbsp;<em>Channel News Asia.</em></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>Tetap menjadi alat pembayaran yang sah</strong></h3>\r\n<p>&nbsp;</p>\r\n<p>Uang kertas pecahan S$ 1.000 yang beredar akan tetap menjadi alat pembayaran yang sah dan bisa terus digunakan sebagai alat pembayaran. MAS mengatakan, bank dapat terus mengedarkan uang kertas $1.000 yang masih mereka simpan.</p>\r\n<p>MAS menambahkan, denominasi lain akan tersedia \"dalam jumlah yang cukup\" untuk memenuhi permintaan, terutama uang kertas pecahan S$ 100 yang merupakan denominasi tertinggi berikutnya.</p>\r\n<p>Singapura berhenti menerbitkan uang kertas pecahan S$ 10.000 pada 2014, yang saat itu menjadi salah satu uang kertas paling berharga di dunia.</p>\r\n<p>&ldquo;Pengembangan sistem pembayaran elektronik yang lebih maju dan aman telah mengurangi kebutuhan akan transaksi berbasis uang tunai yang bernilai besar,&rdquo; kata&nbsp;<em>Deputy Managing Director&nbsp;</em>MAS Ong Chong Tee.</p>\r\n<p>&nbsp;</p>\r\n<p>Diakses dari&nbsp; https://newssetup.kontan.co.id/news/singapura-berhenti-terbitkan-uang-kertas-pecahan-s-1000-ada-apa</p>', 'singapura-berhenti-terbitkan-uang-kertas-pecahan-s-1000-ada-apa', 19, '2025-08-06 10:29:03', '2026-01-02 03:51:31'),
(35, 'Website-PIC-(Instagram-Post-(45))-UD-2.jpg', 'Website_PIC__Instagram_Post__45___UD_22.jpg', 'Ilyasa Dahlan', '', 1, 'Memahami Ketentuan Underlying untuk Pembelian USD Setara USD 10.000', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Dalam transaksi pembelian valuta asing (valas), <strong>underlying</strong> adalah dokumen atau informasi yang menjelaskan tujuan penggunaan dana dalam pembelian mata uang asing</p>', '<h1>Apa Itu Underlying?</h1>\r\n<p>Dalam transaksi pembelian valuta asing (valas), <strong>underlying</strong> adalah dokumen atau informasi yang menjelaskan tujuan penggunaan dana dalam pembelian mata uang asing. Ketentuan ini diterapkan oleh <strong>Bank Indonesia</strong> sebagai bagian dari upaya menjaga stabilitas nilai tukar rupiah, meningkatkan transparansi transaksi, serta mencegah penyalahgunaan sistem keuangan.</p>\r\n<p>Banyak masyarakat yang mengira setiap pembelian dolar Amerika Serikat (USD) harus disertai dokumen underlying. Faktanya, terdapat batasan nilai transaksi yang menentukan kapan dokumen tersebut diperlukan.</p>\r\n<h2>Apakah Pembelian USD Setara USD 10.000 Memerlukan Underlying?</h2>\r\n<p>Secara umum, <strong>pembelian valuta asing tunai atau non-tunai dengan nilai setara USD 10.000 masih berada di bawah batas yang mewajibkan penyampaian dokumen underlying</strong>.</p>\r\n<p>Artinya, nasabah umumnya dapat melakukan pembelian hingga setara <strong>USD 10.000</strong> tanpa harus menyerahkan dokumen pendukung transaksi, selama tetap memenuhi prosedur identifikasi nasabah (Know Your Customer/KYC) yang berlaku.</p>\r\n<p>Namun demikian, penyedia jasa penukaran valuta asing atau bank tetap dapat meminta informasi mengenai tujuan transaksi sebagai bagian dari penerapan prinsip kehati-hatian dan kepatuhan terhadap peraturan yang berlaku.</p>\r\n<h2>Kapan Underlying Mulai Diperlukan?</h2>\r\n<p>Apabila total pembelian valuta asing oleh nasabah <strong>melebihi ekuivalen USD 25.000 dalam satu bulan kalender</strong>, nasabah wajib melengkapi transaksi dengan dokumen underlying sesuai ketentuan Bank Indonesia.</p>\r\n<p>Dokumen tersebut dapat berupa:</p>\r\n<ul>\r\n<li>\r\n<p>Invoice atau tagihan dari pihak luar negeri.</p>\r\n</li>\r\n<li>\r\n<p>Perjanjian atau kontrak.</p>\r\n</li>\r\n<li>\r\n<p>Dokumen perjalanan (untuk keperluan tertentu).</p>\r\n</li>\r\n<li>\r\n<p>Bukti pembayaran biaya pendidikan.</p>\r\n</li>\r\n<li>\r\n<p>Dokumen biaya pengobatan.</p>\r\n</li>\r\n<li>\r\n<p>Dokumen investasi atau kebutuhan usaha.</p>\r\n</li>\r\n<li>\r\n<p>Dokumen lain yang dapat menjelaskan tujuan penggunaan valuta asing.</p>\r\n</li>\r\n</ul>\r\n<p>Selain dokumen tersebut, nasabah juga dapat diminta untuk menandatangani <strong>Surat Pernyataan Underlying</strong> sesuai ketentuan yang berlaku.</p>\r\n<h2>Mengapa Ketentuan Ini Diterapkan?</h2>\r\n<p>Ketentuan underlying bertujuan untuk:</p>\r\n<ul>\r\n<li>\r\n<p>Meningkatkan transparansi transaksi valuta asing.</p>\r\n</li>\r\n<li>\r\n<p>Mendukung stabilitas sistem keuangan Indonesia.</p>\r\n</li>\r\n<li>\r\n<p>Mencegah pencucian uang dan pendanaan kegiatan ilegal.</p>\r\n</li>\r\n<li>\r\n<p>Memastikan transaksi valuta asing dilakukan sesuai kebutuhan riil.</p>\r\n</li>\r\n</ul>\r\n<p>Bagi nasabah yang melakukan transaksi secara sah, ketentuan ini justru memberikan kepastian bahwa transaksi dilakukan sesuai dengan regulasi yang berlaku.</p>\r\n<h2>Tips Sebelum Membeli USD</h2>\r\n<p>Sebelum melakukan pembelian valuta asing, pastikan Anda:</p>\r\n<ul>\r\n<li>\r\n<p>Mengetahui jumlah kebutuhan mata uang asing yang akan dibeli.</p>\r\n</li>\r\n<li>\r\n<p>Melakukan transaksi di penyelenggara kegiatan usaha penukaran valuta asing yang berizin.</p>\r\n</li>\r\n<li>\r\n<p>Menyiapkan dokumen pendukung apabila total pembelian dalam satu bulan berpotensi melebihi ekuivalen USD 10.000.</p>\r\n</li>\r\n<li>\r\n<p>Menyimpan bukti transaksi untuk keperluan administrasi apabila diperlukan di kemudian hari.</p>\r\n</li>\r\n</ul>\r\n<h2>Kesimpulan</h2>\r\n<p>Pembelian <strong>USD senilai setara USD 10.000</strong> pada umumnya <strong>tidak memerlukan dokumen underlying</strong>, karena masih berada di bawah ambang batas yang ditetapkan oleh Bank Indonesia. Meskipun demikian, nasabah tetap wajib memenuhi persyaratan identifikasi yang berlaku, dan penyelenggara penukaran valuta asing dapat meminta informasi mengenai tujuan transaksi sebagai bagian dari penerapan prinsip kehati-hatian.</p>\r\n<p>Memahami ketentuan ini akan membantu proses transaksi menjadi lebih cepat, aman, dan sesuai dengan regulasi yang berlaku.</p>', 'memahami-ketentuan-underlying-untuk-pembelian-usd-setara-usd-10000', 24, '2026-07-16 04:44:29', '2026-07-16 07:39:20'),
(31, 'NEWS1111115.jpg', 'NEWS11111116.jpg', 'Ilyasa Dahlan', '', 0, 'Nilai Tukar Rupiah terhadap Dolar AS Hari Ini, Jumat, 2 Januari 2026  ', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Bisnis.com, Jakarta &mdash; Nilai tukar rupiah pada perdagangan hari ini, Jumat (2/1/2026) diproyeksikan bergerak fluktuatif dengan kecenderungan melemah. Rupiah diperkirakan akan bergerak di rentang Rp16.680 hingga Rp16.710</p>', '<p>Bisnis.com, Jakarta &mdash; Nilai tukar rupiah pada perdagangan hari ini, Jumat (2/1/2026) diproyeksikan bergerak fluktuatif dengan kecenderungan melemah. Rupiah diperkirakan akan bergerak di rentang Rp16.680 hingga Rp16.710 per dolar Amerika Serikat (AS). Sebagai pembanding, pada perdagangan terakhir pada tahun lalu, Rabu (31/12) sore, rupiah ditutup menguat 91 poin atau sekitar 0,54% ke posisi Rp16.680 per dolar AS, dibandingkan penutupan sebelumnya di Rp16.771 per dolar AS. Analis mata uang dan komoditas Ibrahim Assuaibi menjelaskan penguatan rupiah sebelumnya terjadi di tengah sentimen pasar yang tertekan oleh rilis risalah kebijakan Federal Reserve (The Fed) bulan Desember. &ldquo;Kebijakan Federal Reserve bulan Desember mengungkapkan perbedaan pendapat yang mendalam di antara para pembuat kebijakan mengenai arah suku bunga pada tahun 2026,&rdquo; kata Ibrahim di Jakarta.<br /><br />Meskipun The Fed menurunkan suku bunga seperempat poin pada pertemuan tersebut, sejumlah pejabat dinilai semakin berhati-hati melakukan pelonggaran lebih lanjut karena tekanan inflasi yang masih tinggi dan ketidakpastian prospek ekonomi. Di sisi lain, sebagian pejabat memperingatkan bahwa kebijakan yang terlalu ketat berisiko memperlambat pertumbuhan jika dipertahankan terlalu lama. Dari kawasan Asia, aktivitas pabrik China pada Desember 2025 kembali tumbuh, dengan indeks manufaktur bergerak di atas level 50 poin. Kondisi tersebut mencerminkan peningkatan moderat dalam permintaan domestik jelang akhir tahun, meski investor masih memandangnya sebagai sinyal positif yang berhati-hati.<br /><br />Sementara itu, ketegangan geopolitik global dinilai masih menjadi risiko terhadap rantai pasok dan volatilitas harga, meskipun sesekali memberi kelegaan jangka pendek bagi pasar. Di dalam negeri, pertumbuhan ekonomi sekitar 5% dipandang mencerminkan stabilitas dan menjadi target yang realistis untuk 2026. Namun, pemulihan ekonomi Indonesia masih dibayangi tekanan harga pangan dan energi serta daya beli masyarakat yang belum sepenuhnya pulih. Ketergantungan terhadap impor juga memengaruhi aliran devisa. Ibrahim menekankan pentingnya memperkuat fundamental ekonomi agar tidak hanya bertumpu pada konsumsi rumah tangga. Belanja pemerintah harus berperan lebih efektif dalam menghasilkan dampak berganda terhadap perekonomian rakyat, sedangkan sektor ekspor perlu dikembangkan untuk memproduksi lebih banyak komoditas bernilai tambah tinggi.<br /><br />Rupiah Melemah Awal Tahun Baru Nilai tukar rupiah terhadap dolar Amerika Serikat dibuka melemah ke level Rp16.699 pada perdagangan awal tahun, Jumat (2/1/2026). Rupiah hari ini melemah bersama sejumlah mata uang Asia lainnya.&nbsp;Mengutip data Bloomberg pukul 09.00 WIB,&nbsp;rupiah dibuka&nbsp;melemah 0,08% ke Rp16.699 per dolar AS. Adapun indeks dolar AS melemah 0,16% ke level 98,16. Sementara itu, mata uang Asia lainnya dibuka bervariasi. Yen Jepang menguat 0,07%, dolar Hong Kong melemah 0,08%, dolar Singapura menguat 0,06%, dan dolar Taiwan melemah 0,36%.&nbsp;Lalu peso Filipina melemah 0,02%, ringgit Malaysia menguat 0,04%, dan baht Thailand menguat 0,13%.<br /><br /><br />Artikel ini telah tayang di&nbsp;<a href=\"https://www.bisnis.com/\">Bisnis.com</a>&nbsp;dengan judul \"Nilai Tukar Rupiah terhadap Dolar AS Hari Ini, Jumat, 2 Januari 2026\", Klik selengkapnya di sini:&nbsp;<a href=\"https://market.bisnis.com/read/20260102/93/1941003/nilai-tukar-rupiah-terhadap-dolar-as-hari-ini-jumat-2-januari-2026\">https://market.bisnis.com/read/20260102/93/1941003/nilai-tukar-rupiah-terhadap-dolar-as-hari-ini-jumat-2-januari-2026</a>.<br />Penulis : Anggara Pernando - Bisnis.com<br /><br /><br />Download aplikasi Bisnis.com terbaru untuk akses lebih cepat dan nyaman di sini:<br />Android:&nbsp;<a href=\"http://bit.ly/AppsBisniscomPS\">http://bit.ly/AppsBisniscomPS</a><br />iOS:&nbsp;<a href=\"http://bit.ly/AppsBisniscomIOS\">http://bit.ly/AppsBisniscomIOS</a><br /><br /></p>', 'nilai-tukar-rupiah-terhadap-dolar-as-hari-ini-jumat-2-januari-2026', 20, '2026-01-02 03:50:24', '2026-07-02 06:17:41'),
(33, 'Website-PIC.jpg', 'Website_PIC2.jpg', 'Ilyasa Dahlan', '', 2, 'Tips Menyimpan Bukti Transaksi Digital agar Tetap Aman', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, '<p>Jakarta, CNBC Indonesia - Menyimpan bukti transaksi merupakan kebiasaan sederhana yang sering kali dianggap sepele. Padahal, dokumen tersebut memiliki peran penting sebagai catatan pembayaran<br /><br /><br /></p>', '<p>Jakarta, CNBC Indonesia - Menyimpan bukti transaksi merupakan kebiasaan sederhana yang sering kali dianggap sepele. Padahal, dokumen tersebut memiliki peran penting sebagai catatan pembayaran yang dapat digunakan untuk berbagai keperluan, mulai dari memastikan transaksi berhasil, mengajukan komplain, hingga memenuhi kebutuhan administrasi.<br />Seiring berkembangnya transaksi digital, bukti pembayaran kini umumnya diterima dalam bentuk notifikasi, email, atau file elektronik. Tanpa pengelolaan yang baik, dokumen tersebut berisiko terhapus, tercecer, atau sulit ditemukan ketika sewaktu-waktu diperlukan.<br /><br />Oleh karena itu, setiap orang perlu memiliki cara yang sistematis dalam menyimpan bukti transaksi. Dengan begitu, dokumen penting tetap tersimpan dengan aman dan mudah diakses kapan saja.<br /><br />Berikut beberapa tips menyimpan bukti transaksi digital maupun fisik agar tetap aman dan mudah ditemukan.<br /><br />1. Simpan Bukti Transaksi dalam Folder Digital yang Terstruktur<br />Pisahkan bukti transaksi berdasarkan kategori agar lebih mudah dicari. Misalnya, buat folder khusus untuk belanja online, tagihan bulanan, kesehatan, pendidikan, investasi, atau pekerjaan.<br /><br />Apabila memungkinkan, buat juga subfolder berdasarkan tahun atau bulan. Dengan susunan yang rapi, Anda tidak perlu menghabiskan waktu mencari dokumen ketika sewaktu-waktu dibutuhkan.<br /><br />2. Cadangkan Bukti Transaksi ke Penyimpanan Cloud<br />Jangan hanya menyimpan bukti transaksi di satu perangkat. Ponsel atau komputer dapat mengalami kerusakan, hilang, atau terhapus secara tidak sengaja.<br /><br />Sebagai langkah antisipasi, simpan salinan dokumen di layanan penyimpanan cloud sehingga tetap dapat diakses saat berganti perangkat atau ketika perangkat utama mengalami masalah.<br /><br />3. Cetak Bukti untuk Transaksi Bernilai Besar<br />Tidak semua bukti transaksi harus dicetak. Namun, untuk transaksi bernilai besar seperti pembelian kendaraan, properti, pembayaran pendidikan, atau dokumen yang berkaitan dengan perjanjian, salinan fisik dapat menjadi arsip tambahan yang bermanfaat.<br /><br />4. Gunakan Nama File yang Jelas dan Konsisten<br />Hindari menyimpan dokumen dengan nama file bawaan seperti IMG_1234 atau Screenshot.<br /><br />Gunakan format yang lebih informatif, misalnya:<br /><br />2026-07-06_Transfer_Listrik_Rp500000.pdf<br /><br />Atau:<br /><br />2026-07-06_Belanja_Marketplace_Rp350000.jpg<br /><br />Penamaan yang konsisten akan memudahkan pencarian menggunakan fitur pencarian di ponsel maupun komputer.<br /><br />5. Periksa Riwayat Transaksi Secara Berkala<br />Luangkan waktu untuk mengecek mutasi rekening, dompet digital, atau kartu kredit secara berkala. Langkah ini dapat membantu memastikan seluruh transaksi telah tercatat dengan benar sekaligus mendeteksi lebih dini apabila terdapat transaksi yang tidak dikenali.<br /><br />Jika menemukan perbedaan antara bukti transaksi dan riwayat rekening, segera hubungi penyedia layanan terkait.<br /><br />6. Ketahui Jenis Bukti Transaksi yang Sebaiknya Disimpan<br />Pada dasarnya, semakin penting nilai atau tujuan transaksi, semakin penting pula bukti pembayarannya untuk disimpan.<br /><br />Beberapa dokumen yang sebaiknya diarsipkan antara lain:<br /><br />Bukti transfer bank.<br /><br />Bukti pembayaran QRIS.<br /><br />Invoice atau faktur pembelian.<br /><br />E-receipt dari marketplace.<br /><br />Bukti pembayaran kartu kredit.<br /><br />Bukti pembayaran tagihan listrik, air, internet, dan telepon.<br /><br />Bukti pembayaran pajak.<br /><br />Bukti pembayaran cicilan.<br /><br />7. Hindari Kesalahan Saat Menyimpan Bukti Transaksi<br />Beberapa kebiasaan berikut dapat menyulitkan ketika membutuhkan bukti pembayaran di kemudian hari:<br /><br />Langsung menghapus bukti transaksi setelah pembayaran selesai.<br /><br />Hanya mengandalkan riwayat transaksi pada aplikasi.<br /><br />Tidak membuat salinan cadangan.<br /><br />Menyimpan seluruh dokumen dalam satu folder tanpa kategori.<br /><br />Menggunakan nama file yang sulit dikenali.<br /><br />Menghindari kebiasaan tersebut dapat membantu menjaga dokumen tetap tertata dan mudah ditemukan.<br /><br />8. Berapa Lama Bukti Transaksi Sebaiknya Disimpan?<br />Tidak ada aturan yang sama untuk semua jenis transaksi. Lama penyimpanan dapat disesuaikan dengan kebutuhan masing-masing.<br /><br />Sebagai gambaran:<br /><br />Bukti belanja online dapat disimpan hingga masa retur atau garansi berakhir.<br /><br />Bukti pembayaran tagihan sebaiknya disimpan setidaknya selama beberapa bulan sebagai arsip.<br /><br />Bukti pembayaran pajak, cicilan, atau transaksi bernilai besar sebaiknya disimpan lebih lama sesuai kebutuhan administrasi atau ketentuan yang berlaku.<br /><br />Bukti pembelian aset seperti kendaraan atau properti sebaiknya disimpan selama kepemilikan aset tersebut masih berlangsung.<br /><br />9. Jaga Keamanan Bukti Transaksi Digital<br />Selain memastikan dokumen tersimpan dengan rapi, keamanan data juga perlu diperhatikan.<br /><br />Beberapa langkah yang dapat dilakukan antara lain:<br /><br />Mengaktifkan autentikasi dua faktor pada akun penyimpanan cloud.<br /><br />Tidak membagikan bukti transaksi yang memuat data pribadi kepada pihak yang tidak berkepentingan.<br /><br />Memberikan kata sandi pada dokumen yang bersifat penting apabila diperlukan.<br /><br />Memastikan perangkat selalu menggunakan sistem keamanan dan pembaruan perangkat lunak terbaru.<br /><br />Kesimpulan<br />Menyimpan bukti transaksi merupakan kebiasaan sederhana yang dapat memberikan banyak manfaat. Selain memudahkan pencarian dokumen, bukti transaksi juga dapat menjadi alat verifikasi ketika terjadi kesalahan pembayaran, proses pengembalian dana, klaim garansi, hingga kebutuhan administrasi di kemudian hari.<br /><br />Baca artikel CNBC Indonesia \"Tips Menyimpan Bukti Transaksi Digital agar Tetap Aman\" selengkapnya di sini: <a href=\"https://www.cnbcindonesia.com/mymoney/20260706140849-72-748397/tips-menyimpan-bukti-transaksi-digital-agar-tetap-aman\">https://www.cnbcindonesia.com/mymoney/20260706140849-72-748397/tips-menyimpan-bukti-transaksi-digital-agar-tetap-aman</a><br /><br />Download Apps CNBC Indonesia sekarang https://app.cnbcindonesia.com/</p>', 'tips-menyimpan-bukti-transaksi-digital-agar-tetap-aman', 22, '2026-07-08 08:37:00', '2026-07-08 08:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_news_events_category`
--

CREATE TABLE `terre217_news_events_category` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `author` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `period_time` int(1) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `events_date` date NOT NULL,
  `publish` int(11) NOT NULL DEFAULT 1,
  `short_description` varchar(250) NOT NULL,
  `description` mediumtext NOT NULL,
  `permalink` varchar(150) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_news_events_category`
--

INSERT INTO `terre217_news_events_category` (`id`, `img`, `author`, `category_id`, `type`, `title`, `period_time`, `start_date`, `end_date`, `events_date`, `publish`, `short_description`, `description`, `permalink`, `order_id`, `created_at`, `updated_at`) VALUES
(8, NULL, 'Administrator', 1, '2', 'Satu', 2, '2017-01-27', '2017-01-27', '2017-01-27', 1, '<p>sasasa</p>', '<p>sasasa</p>', 'satu', 2, '2017-01-27 01:04:15', '2017-01-27 01:16:15'),
(9, NULL, 'Administrator', 1, '1', 'Dua', 0, '2017-01-27', '2017-01-27', '2017-01-28', 1, '', '<p>whole</p>', 'dua', 1, '2017-01-27 01:04:33', '2017-01-27 01:16:15'),
(10, NULL, 'Administrator', 1, '1', 'Tiga', 1, '2017-01-01', '2017-01-31', '2017-01-27', 1, '', '<p>sasasa</p>', 'tiga', 3, '2017-01-27 01:05:10', '2017-01-27 01:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_page`
--

CREATE TABLE `terre217_page` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `img` varchar(200) NOT NULL,
  `custom_page` tinyint(1) NOT NULL DEFAULT 0,
  `page_type` tinyint(1) DEFAULT 0,
  `permalink` varchar(200) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `show_footer` int(1) NOT NULL DEFAULT 1,
  `ordered_no` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `meta_title` varchar(200) NOT NULL,
  `meta_keyword` varchar(300) NOT NULL,
  `meta_description` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_page`
--

INSERT INTO `terre217_page` (`id`, `name`, `description`, `img`, `custom_page`, `page_type`, `permalink`, `url`, `publish`, `show_footer`, `ordered_no`, `created_at`, `updated_at`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(9, 'About', '<p>Nullam ut lacinia neque, in ultricies felis. Nullam nec elit quis tortor rutrum consectetur quis nec dui. Suspendisse id libero mi. Nam arcu metus, convallis nec risus a, porttitor rutrum urna. Curabitur pulvinar, massa eget finibus pharetra, leo mauris tristique mauris, nec tincidunt arcu neque quis mauris. Sed ut eros et magna dapibus hendrerit. Aliquam vitae augue cursus, lobortis felis ut, pulvinar metus. Vestibulum ac ex sed dui aliquet maximus ac quis ipsum.</p>\\r\\n<p>Nunc id molestie tortor, vel vehicula turpis. Quisque et mauris at diam consectetur ullamcorper. Aliquam placerat tortor ut nunc vestibulum, convallis lobortis justo dignissim. Ut vehicula, justo non porttitor semper, tortor est sollicitudin mi, nec tincidunt velit ligula eget lacus. Vivamus consectetur maximus nunc ac iaculis. Integer fringilla venenatis semper. Cras placerat erat vel efficitur rutrum. Sed at justo posuere nunc ullamcorper hendrerit. Duis vulputate blandit ex, eu pretium metus ornare porttitor. Donec et tortor velit. Nam hendrerit odio non arcu dignissim, eu pretium orci molestie. Aenean volutpat, turpis quis aliquet porttitor, metus justo gravida leo, sit amet sodales enim erat nec arcu. In pulvinar in enim eget molestie.</p>', 'About.jpg', 1, 0, 'about', 'about', 1, 1, 1, '2015-09-29 07:02:24', '2015-09-29 18:02:24', '', '', ''),
(10, 'Food Service', '<div class=\"gmail_default\">\\r\\n<p style=\"text-align: justify;\">To complete your food production process, we have commercial range of food processing equipments.&nbsp; Backed up by strong and reputable manufacturers, our range covers pasta making, meat, sauce, convenience food production, and many others.</p>\\r\\n<p style=\"text-align: justify;\">&nbsp;</p>\\r\\n<p style=\"text-align: justify;\"><span style=\"text-decoration: underline;\"><span style=\"color: #0000ff;\"><span style=\"color: #0000ff;\"><strong><img src=\"http://sccbakery.com/resources/assets/uploads/others/Roboqbo.jpg\" alt=\"\" width=\"188\" height=\"65\" /></strong></span></span></span></p>\\r\\n<p style=\"text-align: justify;\"><strong><span style=\"color: #000000;\">ROBOQBO UNIVERSAL PROCESSING SYSTEM</span></strong></p>\\r\\n<p>A concrete answer to the needs of restaurants, gastronomy, catering, pastry, cheese, from small laboratories/restaurants to medium/large food industry.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p><img src=\"http://sccbakery.com/resources/assets/uploads/others/anko.jpg\" alt=\"\" width=\"191\" height=\"59\" /></p>\\r\\n<p><strong>ANKO FOOD PROCESSING</strong></p>\\r\\n<p style=\"text-align: justify;\">Specialized in convenience food processing equipment, such as: shiumai, dumplings, paratha, meat bun, spring roll, samosa, etc., Anko&nbsp;design the most efficient production flow that can supply machines in the shortest time.</p>\\r\\n<p style=\"text-align: justify;\">&nbsp;</p>\\r\\n<p style=\"text-align: justify;\">&nbsp;</p>\\r\\n<p style=\"text-align: justify;\"><span style=\"text-decoration: underline;\"><strong><span style=\"color: #0000ff;\"><span style=\"color: #0000ff; text-decoration: underline;\"><a href=\"http://www.csfmtw.com.tw/index.php?lang=zh-en\"><img src=\"http://sccbakery.com/resources/assets/uploads/others/CHUNGSHEN.png\" alt=\"\" width=\"195\" height=\"110\" /></a></span></span></strong></span></p>\\r\\n<p style=\"text-align: justify;\">&nbsp;</p>\\r\\n<p style=\"text-align: justify;\"><strong>CHUNG SHEN COOKING MIXER</strong></p>\\r\\n<p style=\"text-align: justify;\">From cooking rendang, curry sauce, jam, bean paste, candy, etc., Chung Shen is the reliable manufacturer of cooking mixer. Perfect for your catering service, hotel, and restaurant business.</p>\\r\\n<p style=\"text-align: justify;\">&nbsp;</p>\\r\\n<p style=\"text-align: justify;\">For inquiries, please do not hesitate to <a href=\"http://sccbakery.com/new/contact\">contact us</a>.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>&nbsp;</p>\\r\\n</div>', 'Food-Service.jpg', 0, 0, 'food-service', 'food-service', 1, 0, 0, '2016-09-28 08:18:18', '2016-09-28 19:18:18', '', '', ''),
(12, 'Why Choose Us', '', 'food-head3.jpg', 1, 0, 'why-choose-us', 'why-choose-us', 1, 1, 2, '2015-06-26 00:22:31', '2015-06-26 00:13:23', '', '', ''),
(13, 'Meet Our Suppliers', '', '', 1, 0, 'meet-our-suppliers', 'meet-our-suppliers', 1, 1, 3, '2015-06-24 04:03:56', '0000-00-00 00:00:00', '', '', ''),
(14, 'Upcoming Events', '', '', 1, 0, 'upcoming-events', 'upcoming-events', 1, 1, 4, '2015-06-24 04:03:55', '0000-00-00 00:00:00', '', '', ''),
(15, 'Contact', '', 'Contact.jpg', 1, 0, 'contact', 'contact', 1, 1, 5, '2015-09-29 07:02:42', '2015-09-29 18:02:42', '', '', ''),
(18, 'Industrial Line', '<p>Nullam ut lacinia neque, in ultricies felis. Nullam nec elit quis tortor rutrum consectetur quis nec dui. Suspendisse id libero mi. Nam arcu metus, convallis nec risus a, porttitor rutrum urna. Curabitur pulvinar, massa eget finibus pharetra, leo mauris tristique mauris, nec tincidunt arcu neque quis mauris. Sed ut eros et magna dapibus hendrerit. Aliquam vitae augue cursus, lobortis felis ut, pulvinar metus. Vestibulum ac ex sed dui aliquet maximus ac quis ipsum.</p>\\r\\n<p>Nunc id molestie tortor, vel vehicula turpis. Quisque et mauris at diam consectetur ullamcorper. Aliquam placerat tortor ut nunc vestibulum, convallis lobortis justo dignissim. Ut vehicula, justo non porttitor semper, tortor est sollicitudin mi, nec tincidunt velit ligula eget lacus. Vivamus consectetur maximus nunc ac iaculis. Integer fringilla venenatis semper. Cras placerat erat vel efficitur rutrum. Sed at justo posuere nunc ullamcorper hendrerit. Duis vulputate blandit ex, eu pretium metus ornare porttitor. Donec et tortor velit. Nam hendrerit odio non arcu dignissim, eu pretium orci molestie. Aenean volutpat, turpis quis aliquet porttitor, metus justo gravida leo, sit amet sodales enim erat nec arcu. In pulvinar in enim eget molestie.</p>', 'Industrial-Line4.jpg', 1, 0, 'industrial-line', 'industrial-line', 1, 1, 6, '2015-10-20 03:22:27', '2015-10-20 14:22:27', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_press_album`
--

CREATE TABLE `terre217_press_album` (
  `id` int(11) NOT NULL,
  `fkpressid` int(11) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_press_album`
--

INSERT INTO `terre217_press_album` (`id`, `fkpressid`, `image`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(3, 1, 'Darth_Vader2.jpg', NULL, 1, '2017-01-31 02:32:45', '2017-01-31 02:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_press_awards`
--

CREATE TABLE `terre217_press_awards` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `publish` int(1) DEFAULT 1,
  `description` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_press_awards`
--

INSERT INTO `terre217_press_awards` (`id`, `order_id`, `title`, `image`, `publish`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Press 1', 'Darth-Vader.jpg', 1, '<p>sadsadsad</p>', '2017-01-30 18:26:52', '2017-01-30 19:13:54'),
(2, NULL, 'Press 2', 'Free-Download-Stormtrooper-Wallpaper-HD.jpg', 1, '<p>asdsadsa</p>', '2017-01-30 18:27:32', '2017-01-30 19:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_press_awards_category`
--

CREATE TABLE `terre217_press_awards_category` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `publish` int(1) DEFAULT 1,
  `description` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_product`
--

CREATE TABLE `terre217_product` (
  `id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `permalink` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_keyword` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_product_brand`
--

CREATE TABLE `terre217_product_brand` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `permalink` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_keyword` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `order_brand` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_product_category`
--

CREATE TABLE `terre217_product_category` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `projects` text DEFAULT NULL,
  `permalink` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_keyword` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `order_category` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_product_category`
--

INSERT INTO `terre217_product_category` (`id`, `img`, `video`, `category_id`, `brand_id`, `name`, `subtitle`, `description`, `projects`, `permalink`, `meta_title`, `meta_keyword`, `meta_description`, `order_category`, `publish`, `created_at`, `updated_at`) VALUES
(33, NULL, '', 5, 3, 'Urikiri', 'Computer Desk', '<p><span id=\"ctl03_MainContentArea_ctl00_ctl00_ctl00_ProductDisplay_ProductDescriptionModule_lblDesctiptionFull\" class=\"descriptionContent\">The modern styled design of the Heinrik Fiberboard Wood Computer Desk from Noble House adds a simple elegant desk that is ideal for any home office. With a hideaway keyboard drawer, this desk becomes the perfect compact corner desk for your home office. With ample space on the desk top for your screen and paperwork, you can look forward to finishing your work in blazing speed, to get back to the things that really matter.</span>&nbsp;<span id=\"ctl03_MainContentArea_ctl00_ctl00_ctl00_ProductDisplay_ProductDescriptionModule_lblBulletListFull\" class=\"descriptionContent\"><br /></span></p>\r\n<ul>\r\n<li>Includes: 1- computer desk</li>\r\n<li>Dimensions: 29.50\"H x 45.25\"W x 21.50\"D</li>\r\n<li>Weight: 63lbs</li>\r\n<li>Color: matte white</li>\r\n<li>Materials: Fiberboard, iron</li>\r\n<li>Spot clean</li>\r\n<li>IMPORTED</li>\r\n</ul>', '', 'urikiri', '', '', '', 9, 1, '2017-03-09 07:28:36', '2017-03-09 07:28:36'),
(28, NULL, '', 8, 2, 'Nysted', 'Room Divider', '<p>The NYSTED Room Divider is a simple and stylish unit that has the versatility of being able to serve as an open-back wall unit or a gorgeous room divider. With 16 fixed shelves there is room for everything from books and picture frames to baskets and potted plants. The lightweight frame is finished with durable melamine for a unit that will last. Also available in white.<br /><br /><strong>Features</strong><br />&bull; Measurements: L 150 x W 39 x H 150cm (59.1&rdquo; x 15.4&rdquo; x 59.1&rdquo;)<br />&bull;&nbsp;Particle board/MDF&nbsp;frame with melamine finish<br />&bull; Create your own look thanks to the 16 fixed shelves that can accommodate baskets, books, photos, and more<br />&bull; Colour: Black</p>', '<p>Project name : House at Kota Modern</p>\r\n<p><br />Year : 2010</p>\r\n<p><br />Note : FORME produced almost all the wood furniture include: wall panel, pantry, dining table, dining chair, wardrobe, dressing table, credenza, side table, sofa, bed included headboard</p>', 'nysted', 'Nysted', '', '', 4, 1, '2017-03-09 07:28:29', '2017-03-09 07:28:29'),
(26, NULL, '', 5, 10, 'Casa', 'Corner Sofa', '<p>The Casa Corner Sofa is ready to make its way into any existing decor. This sofa is flexible thanks to the smart design of its reversible chaise which allows for a right or left hand placement. For added convenience, the cover is made from a durable polyester fabric for easy cleaning.<br /><br />&bull; Measurement: W222xD154/86xH85cm<br />&bull; Reversible left or right hand chaise<br />&bull; Material: Durable polyester fabric&nbsp;<br />&bull; Colour: Grey</p>', '', 'casa', '', '', '', 2, 1, '2017-03-09 07:27:57', '2017-03-09 07:27:57'),
(27, NULL, 'vlDzYIIOYmM', 4, 1, 'Guarda ', 'Love Seat', '<p>The GUARDA Loveseat, also available in a matching 3 seater sofa, features a beautiful, grey colour for a subtle, textured look. The polyester fabric is not only comfortable but also brings with it some peace of mind thanks to its abrasion resistant nature. Add a splash of colour with any of our stylish decorative pillows<br /><br /><strong>Features&nbsp;</strong><br />&bull; Measurements: L 150 x W 84 x H 85 cm ( 59\" x 33\" x 33.5\")<br />&bull; Available in a matching 3 seat sofa<br />&bull; Colour: Grey</p>', '<p>Project name : House at Kota Modern</p>\r\n<p><br />Year : 2010</p>\r\n<p><br />Note : FORME produced almost all the wood furniture include: wall panel, pantry, dining table, dining chair, wardrobe, dressing table, credenza, side table, sofa, bed included headboard</p>', 'guarda', 'Guarda Love Seat', '', '', 3, 1, '2017-02-14 04:44:03', '2017-02-14 04:44:03'),
(30, NULL, '', 4, 10, 'Kappel', 'Side Chair', '<p>A perfect example of the intersection between comfort and the elegance of Scandinavian design, the KAPPEL chair is a fantastic option for any sitting room. A plush foam core wrapped in a dark grey polyester fabric makes up the seat that&rsquo;s set on four solid oak legs with stabilizing metal cross bars for a unique piece that will be a staple piece in your home for years to come.<br /><br /><strong>Features</strong><br />&bull; Measurements: L 70 x W 65 x H 73cm (27.6&rdquo; x 25.6&rdquo; x &nbsp;28.7&rdquo;)<br />&bull; Polyester wrapped foam on plywood with metal reinforced solid oak legs<br />&bull; Colour: Grey with natural legs</p>', '', 'kappel', '', '', '', 6, 1, '2017-03-09 07:28:14', '2017-03-09 07:28:14'),
(32, NULL, '', 8, 4, 'Noble House', 'Round Chair', '<p><span id=\"ctl03_MainContentArea_ctl00_ctl00_ctl00_ProductDisplay_ProductDescriptionModule_lblDesctiptionFull\" class=\"descriptionContent\">Add unique flare to any room with this modern chair from Noble House. With soft upholstery, you are sure to enjoy the comfort and style of this leather roundback chair.</span> <span id=\"ctl03_MainContentArea_ctl00_ctl00_ctl00_ProductDisplay_ProductDescriptionModule_lblBulletListFull\" class=\"descriptionContent\"><br /></span></p>\r\n<ul>\r\n<li>Includes: 1- club chair</li>\r\n<li>Dimensions: 31.75\"H x 30.25\"W x 27.75\"D</li>\r\n<li>Weight: 38lbs</li>\r\n<li>Color: white</li>\r\n<li>Softly padded for extreme comfort</li>\r\n<li>Neutral color will suit any room</li>\r\n<li>Stainless steal frame for longevity</li>\r\n<li>Spot clean</li>\r\n<li>IMPORTED</li>\r\n</ul>', '', 'noble-house', '', '', '', 8, 1, '2017-03-09 07:28:22', '2017-03-09 07:28:22'),
(25, NULL, '', 4, 9, 'Attelea', 'Sub Title Attelea', '<p>Whitney Peak approached Hospitality Designs with their hotel concept design for guestrooms. Initial design included floor to ceiling headboards, oversized nightstands, and desk dresser combo units.</p>', '<p>Project name : House at Kota Modern</p>\r\n<p><br />Year : 2010</p>\r\n<p><br />Note : FORME produced almost all the wood furniture include: wall panel, pantry, dining table, dining chair, wardrobe, dressing table, credenza, side table, sofa, bed included headboard</p>', 'attelea', 'Attelea', '', '', 1, 0, '2017-03-09 07:27:49', '2017-03-09 07:27:49'),
(29, NULL, '', 8, 9, 'Egedal', 'Arm Chair', '<p>The EGEDAL Arm Chair is a beautiful, Scandinavian designed piece with a subtle elegance that makes it perfect for any living space. In a cozy, light grey polyester with classic button tufts along the back, this sofa has an inviting appearance with soft, rounded edges that are the visual embodiments of its comfort. So sit down, sink in, and relax. Consider the EGEDAL armchair as a complementing piece to complete your living room.<br /><br /><strong>Features</strong><br />&bull; Measurements: L 82 x W 81 x H 82cm (32.3&rdquo; x 31.9&rdquo; x &nbsp;32.3&rdquo;)<br />&bull; Polyester wrapped foam core on plywood with solid pine legs<br />&bull; Comfort and style intersect perfectly in this beautifully designed Scandinavian piece<br />&bull; Includes 1 arm chair<br />&bull; Colour: Grey</p>', '', 'egedal', '', '', '', 5, 1, '2017-03-09 07:28:05', '2017-03-09 07:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_product_image`
--

CREATE TABLE `terre217_product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_product_image_brand`
--

CREATE TABLE `terre217_product_image_brand` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_product_image_category`
--

CREATE TABLE `terre217_product_image_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_product_image_category`
--

INSERT INTO `terre217_product_image_category` (`id`, `product_id`, `img`, `as_default`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(33, 29, 'egedal2.jpg', 1, NULL, 1, '2017-02-14 13:00:24', '2017-02-14 13:00:27'),
(32, 29, 'egedal.jpg', 0, NULL, 1, '2017-02-14 13:00:20', '2017-02-14 13:01:07'),
(27, 27, 'guarda-love-seat4.jpg', 0, NULL, 1, '2017-02-14 11:39:32', '2017-02-14 11:39:32'),
(20, 25, 'attelea3.jpg', 0, NULL, 1, '2017-02-14 10:57:04', '2017-02-14 11:34:19'),
(18, 25, 'attelea.jpg', 1, NULL, 1, '2017-02-14 10:57:00', '2017-02-14 12:01:53'),
(19, 25, 'attelea2.jpg', 0, NULL, 1, '2017-02-14 10:57:02', '2017-02-14 12:01:54'),
(26, 27, 'guarda-love-seat3.jpg', 1, NULL, 1, '2017-02-14 11:39:30', '2017-02-14 11:39:41'),
(31, 28, 'nysted.jpg', 1, NULL, 1, '2017-02-14 11:47:38', '2017-02-14 11:47:38'),
(28, 27, 'guarda-love-seat5.jpg', 0, NULL, 1, '2017-02-14 11:40:08', '2017-02-14 11:40:08'),
(30, 26, 'casa5.jpg', 0, NULL, 1, '2017-02-14 11:43:24', '2017-02-14 11:43:24'),
(29, 26, 'casa4.jpg', 1, NULL, 1, '2017-02-14 11:43:10', '2017-02-14 11:44:13'),
(34, 30, 'kappel.jpg', 1, NULL, 1, '2017-02-14 13:06:42', '2017-02-14 13:07:05'),
(35, 30, 'kappel2.jpg', 0, NULL, 1, '2017-02-14 13:06:49', '2017-02-14 13:06:49'),
(36, 30, 'kappel3.jpg', 0, NULL, 1, '2017-02-14 13:06:51', '2017-02-14 13:06:51'),
(38, 32, 'noble-house.jpg', 1, NULL, 1, '2017-02-16 15:05:14', '2017-02-16 15:05:45'),
(39, 32, 'noble-house2.jpg', 0, NULL, 1, '2017-02-16 15:05:16', '2017-02-16 15:05:16'),
(40, 32, 'noble-house3.jpg', 0, NULL, 1, '2017-02-16 15:05:18', '2017-02-16 15:05:18'),
(41, 33, 'urikiri.jpg', 1, NULL, 1, '2017-02-16 15:08:07', '2017-02-16 15:08:17'),
(42, 33, 'urikiri2.jpg', 0, NULL, 1, '2017-02-16 15:08:10', '2017-02-16 15:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_product_image_subcategory`
--

CREATE TABLE `terre217_product_image_subcategory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_product_subcategory`
--

CREATE TABLE `terre217_product_subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `subcategory_id` int(11) DEFAULT NULL,
  `name` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `permalink` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_keyword` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `order_category` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_project`
--

CREATE TABLE `terre217_project` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `permalink` varchar(300) NOT NULL,
  `location` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(300) NOT NULL,
  `meta_description` text NOT NULL,
  `order_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_project`
--

INSERT INTO `terre217_project` (`id`, `name`, `permalink`, `location`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'product-1', 'Indonesia', '<p>ASsas</p>', '', '', '', 1, 1, '2017-02-01 07:22:28', '2017-02-01 07:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_project_category`
--

CREATE TABLE `terre217_project_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(300) NOT NULL,
  `permalink` varchar(300) NOT NULL,
  `location` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(300) NOT NULL,
  `meta_description` text NOT NULL,
  `order_category` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_project_category`
--

INSERT INTO `terre217_project_category` (`id`, `category_id`, `img`, `name`, `permalink`, `location`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `order_category`, `publish`, `created_at`, `updated_at`) VALUES
(13, 3, NULL, 'Aston', 'aston', 'Jakarta', '<p>Being the founder of incorporating the metal accent on hotel furniture, the Aston hotel furniture collection is designed with an eye for balance and proportion. Aston is sleek, modern, and ideally suited for contemporary guestrooms.</p>\r\n<p>Aston hotel&nbsp;furniture can be customized to any size, shape, or finish. Ask about our custom hotel furniture services today.</p>', 'Aston', '', '', 1, 1, '2017-02-13 11:19:02', '2017-02-13 11:19:02'),
(14, 3, NULL, 'Akdong', 'akdong', 'Seoul, South Korea', '<p>The Hudson Collection by Stacy Garcia for Hospitality Designs combines clean lines and sleek finishes for simplistic, chic design. Inspired by modern architecture, The Hudson Collection features a contemporary headboard wall with contrasting wood tone elements.&nbsp;Cantilevered nightstands with built-in ambient lighting compliment this focal point seamlessly. The structured aesthetic of this collection is a handsome addition to any property.</p>\r\n<p>Hudson furniture can be customized to any size, shape, or finish. Ask about our custom hotel furniture services today.</p>', 'Akdong', '', '', 2, 1, '2017-02-14 02:15:05', '2017-02-14 02:15:05'),
(15, 3, NULL, 'Kogitsunemaru', 'kogitsunemaru', 'Hokkaido, Japan', '<p>Inspired by the framing of fine art seen in one of the most influential gallery districts of New York, Chelsea is a well curated collection designed by Stacy Garcia. Mitered corners and gently tapered legs blend with decorative elements to create a fresh take on traditional form. Statement pieces include an engineered wood-grain headboard, all-in-one desk media hutch, and a nightstand featuring two-toned wood accents and detailed feet, giving the collection the right amount of attractive functionality with a modern twist. The Chelsea collection is the perfect combination of classically styled furniture with a contemporary feel.</p>\r\n<p>Chelsea&nbsp;hotel&nbsp;furniture can be customized to any size, shape, or finish. Ask about our custom hotel furniture services today.</p>', 'Kogitsunemaru', '', '', 4, 1, '2017-02-16 07:48:56', '2017-02-16 07:48:56'),
(16, 3, NULL, 'Indigo', 'indigo', 'Jakarta, Indonesia', '<p>Simple and subtly elegant, Indigo is a hotel furniture collection that defines modern classic style. The uniquely upholstered headboard features removable panels for easy care and upkeep. The&nbsp;coordinated right and left paneled nightstands also highlights the distinctive look of the Indigo bed set.</p>\r\n<p>Indigo&nbsp;hotel&nbsp;furniture can be customized to any size, shape, or finish. Ask about our custom hotel furniture services today.</p>', 'Indigo', '', '', 3, 1, '2017-02-16 07:48:56', '2017-02-16 07:48:56'),
(17, 2, NULL, 'Dhusit Thani', 'dhusit-thani', 'Thailand', '<p>Whitney Peak approached Hospitality Designs with their hotel concept design for guestrooms. Initial design included floor to ceiling headboards, oversized nightstands, and desk dresser combo units.</p>', 'Dhusit Thani', '', '', 5, 1, '2017-02-14 03:40:16', '2017-02-14 03:40:16'),
(18, 1, NULL, 'Lea', 'lea', 'Bangkok', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>', 'Lea', '', '', 3, 1, '2017-02-16 07:48:38', '2017-02-16 07:48:38'),
(19, 1, NULL, 'Fella Series', 'fella-series', 'Nusa Dua, Bali', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>', 'Fella Series', '', '', 2, 1, '2017-02-16 07:48:38', '2017-02-16 07:48:38'),
(20, 1, NULL, 'Oslo', 'oslo', 'Oslo', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>', 'Oslo', '', '', 1, 1, '2017-02-16 07:48:09', '2017-02-16 07:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_project_image`
--

CREATE TABLE `terre217_project_image` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_project_image`
--

INSERT INTO `terre217_project_image` (`id`, `project_id`, `img`, `as_default`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, 'product-1.jpg', 1, NULL, 1, '2017-02-01 14:22:38', '2017-02-01 14:22:38'),
(2, 1, 'product-12.jpg', 0, NULL, 1, '2017-02-02 07:54:29', '2017-02-02 07:54:29'),
(3, 1, 'product-13.jpg', 0, NULL, 1, '2017-02-02 07:58:21', '2017-02-02 07:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_project_image_category`
--

CREATE TABLE `terre217_project_image_category` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_project_image_category`
--

INSERT INTO `terre217_project_image_category` (`id`, `project_id`, `img`, `as_default`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(29, 16, 'indigo.jpg', 1, NULL, 1, '2017-02-14 09:41:35', '2017-02-14 09:48:10'),
(28, 15, 'kogitsunemaru4.jpg', 0, NULL, 1, '2017-02-14 09:27:39', '2017-02-14 09:27:39'),
(27, 15, 'kogitsunemaru3.jpg', 0, NULL, 1, '2017-02-14 09:27:36', '2017-02-14 09:27:36'),
(26, 15, 'kogitsunemaru2.jpg', 0, NULL, 1, '2017-02-14 09:27:33', '2017-02-14 09:27:33'),
(25, 15, 'kogitsunemaru.jpg', 1, NULL, 1, '2017-02-14 09:27:24', '2017-02-14 09:29:16'),
(24, 14, 'akdong4.jpg', 0, NULL, 1, '2017-02-14 09:16:39', '2017-02-14 09:16:39'),
(23, 14, 'akdong3.jpg', 0, NULL, 1, '2017-02-14 09:16:37', '2017-02-14 09:16:37'),
(22, 14, 'akdong2.jpg', 0, NULL, 1, '2017-02-14 09:16:34', '2017-02-14 09:16:34'),
(21, 14, 'akdong.jpg', 1, NULL, 1, '2017-02-14 09:16:29', '2017-02-14 09:20:05'),
(20, 13, 'aston5.jpg', 1, NULL, 1, '2017-02-13 18:23:05', '2017-02-13 18:23:13'),
(16, 13, 'aston.jpg', 1, NULL, 1, '2017-02-13 18:22:54', '2017-02-13 18:22:54'),
(17, 13, 'aston2.jpg', 0, NULL, 1, '2017-02-13 18:22:58', '2017-02-13 18:22:58'),
(18, 13, 'aston3.jpg', 0, NULL, 1, '2017-02-13 18:23:00', '2017-02-13 18:23:00'),
(19, 13, 'aston4.jpg', 0, NULL, 1, '2017-02-13 18:23:01', '2017-02-13 18:23:01'),
(30, 16, 'indigo2.jpg', 0, NULL, 1, '2017-02-14 09:41:39', '2017-02-14 09:41:39'),
(31, 16, 'indigo3.jpg', 0, NULL, 1, '2017-02-14 09:41:42', '2017-02-14 09:41:42'),
(32, 16, 'indigo4.jpg', 0, NULL, 1, '2017-02-14 09:41:44', '2017-02-14 09:41:44'),
(33, 17, 'dhusit-thani.jpg', 1, NULL, 1, '2017-02-14 10:40:35', '2017-02-14 10:41:24'),
(34, 17, 'dhusit-thani2.jpg', 0, NULL, 1, '2017-02-14 10:40:59', '2017-02-14 10:40:59'),
(35, 17, 'dhusit-thani3.jpg', 0, NULL, 1, '2017-02-14 10:41:02', '2017-02-14 10:41:02'),
(36, 17, 'dhusit-thani4.jpg', 0, NULL, 1, '2017-02-14 10:41:03', '2017-02-14 10:41:03'),
(37, 17, 'dhusit-thani5.jpg', 0, NULL, 1, '2017-02-14 10:41:04', '2017-02-14 10:41:04'),
(38, 18, 'lea.jpg', 1, NULL, 1, '2017-02-16 14:39:17', '2017-02-16 14:40:04'),
(39, 18, 'lea2.jpg', 0, NULL, 1, '2017-02-16 14:39:53', '2017-02-16 14:39:53'),
(40, 18, 'lea3.jpg', 0, NULL, 1, '2017-02-16 14:39:55', '2017-02-16 14:39:55'),
(41, 18, 'lea4.jpg', 0, NULL, 1, '2017-02-16 14:39:56', '2017-02-16 14:39:56'),
(42, 18, 'lea5.jpg', 0, NULL, 1, '2017-02-16 14:39:57', '2017-02-16 14:39:57'),
(43, 18, 'lea6.jpg', 0, NULL, 1, '2017-02-16 14:39:58', '2017-02-16 14:39:58'),
(44, 19, 'fella-series.jpg', 1, NULL, 1, '2017-02-16 14:42:23', '2017-02-16 14:43:05'),
(45, 19, 'fella-series2.jpg', 0, NULL, 1, '2017-02-16 14:42:46', '2017-02-16 14:42:46'),
(46, 19, 'fella-series3.jpg', 0, NULL, 1, '2017-02-16 14:42:49', '2017-02-16 14:42:49'),
(47, 19, 'fella-series4.jpg', 0, NULL, 1, '2017-02-16 14:42:52', '2017-02-16 14:42:52'),
(48, 19, 'fella-series5.jpg', 0, NULL, 1, '2017-02-16 14:42:56', '2017-02-16 14:42:56'),
(49, 20, 'oslo.jpg', 0, NULL, 1, '2017-02-16 14:45:34', '2017-02-16 14:46:09'),
(50, 20, 'oslo2.jpg', 0, NULL, 1, '2017-02-16 14:45:40', '2017-02-16 14:45:40'),
(51, 20, 'oslo3.jpg', 0, NULL, 1, '2017-02-16 14:45:43', '2017-02-16 14:45:43'),
(52, 20, 'oslo4.jpg', 0, NULL, 1, '2017-02-16 14:45:45', '2017-02-16 14:45:45'),
(53, 20, 'oslo5.jpg', 1, NULL, 1, '2017-02-16 14:45:47', '2017-02-16 14:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_project_image_subcategory`
--

CREATE TABLE `terre217_project_image_subcategory` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_project_image_subcategory`
--

INSERT INTO `terre217_project_image_subcategory` (`id`, `project_id`, `img`, `as_default`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(7, 1, 'project-19.jpg', 1, NULL, 1, '2017-02-01 14:16:28', '2017-02-01 14:16:29'),
(6, 1, 'project-18.jpg', 0, NULL, 1, '2017-02-01 14:16:24', '2017-02-01 14:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_project_subcategory`
--

CREATE TABLE `terre217_project_subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `subcategory_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(300) NOT NULL,
  `permalink` varchar(300) NOT NULL,
  `location` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(300) NOT NULL,
  `meta_description` text NOT NULL,
  `order_category` int(11) NOT NULL,
  `order_subcategory` int(10) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_project_subcategory`
--

INSERT INTO `terre217_project_subcategory` (`id`, `category_id`, `subcategory_id`, `name`, `permalink`, `location`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `order_category`, `order_subcategory`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Project 1', 'project-1', 'Jakarta', '<p>Asasasa</p>', '', '', '', 1, 1, 1, '2017-02-01 02:52:10', '2017-02-01 02:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_promotions`
--

CREATE TABLE `terre217_promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `publish` int(1) NOT NULL DEFAULT 1,
  `description` mediumtext NOT NULL,
  `order_id` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_promotions`
--

INSERT INTO `terre217_promotions` (`id`, `title`, `image`, `url`, `publish`, `description`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'sadfgh', 'Free_Download_Stormtrooper_Wallpaper_HD4.jpg', 'sdfg', 1, '<p>sdfghj</p>', 1, '2017-01-27 14:05:48', '2017-01-27 14:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_schedule`
--

CREATE TABLE `terre217_schedule` (
  `id` int(11) NOT NULL,
  `fkteamid` int(11) DEFAULT NULL,
  `day` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `open` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `close` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_schedule`
--

INSERT INTO `terre217_schedule` (`id`, `fkteamid`, `day`, `open`, `close`, `location`, `created_at`, `updated_at`) VALUES
(2, 1, 'Monday', '08.00', '16.00', 'Kemayoran', '2017-01-30 08:12:21', '2017-01-30 15:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_services`
--

CREATE TABLE `terre217_services` (
  `id` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `permalink` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_services_by_category`
--

CREATE TABLE `terre217_services_by_category` (
  `id` int(11) NOT NULL,
  `fkcategoryid` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `permalink` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_services_by_category`
--

INSERT INTO `terre217_services_by_category` (`id`, `fkcategoryid`, `img`, `title`, `permalink`, `subtitle`, `description`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, 'ride-thumb.jpg', 'Service 1', 'service-1', 'Sub Service 1', '<p>ASsasasasassas</p>', 1, 1, '2017-02-02 09:14:27', '2017-02-02 09:14:27'),
(2, 1, 'ride_thumb2.jpg', 'Service 2', 'service-2', 'Sub Service 2', '<p>ASsasas</p>', 2, 1, '2017-02-03 23:31:26', '2017-02-03 23:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_services_by_category_gallery`
--

CREATE TABLE `terre217_services_by_category_gallery` (
  `id` int(11) NOT NULL,
  `fkserviceid` int(11) DEFAULT NULL,
  `fkgalleryid` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_services_by_category_gallery`
--

INSERT INTO `terre217_services_by_category_gallery` (`id`, `fkserviceid`, `fkgalleryid`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(8, 1, 2, 1, 1, '2017-02-03 23:29:09', '2017-02-03 23:29:09'),
(9, 1, 3, 2, 1, '2017-02-03 23:30:26', '2017-02-03 23:30:26'),
(10, 2, 3, 3, 1, '2017-02-03 23:34:36', '2017-02-03 23:34:36'),
(11, 2, 2, 4, 1, '2017-02-03 23:34:42', '2017-02-03 23:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_services_by_subcategory`
--

CREATE TABLE `terre217_services_by_subcategory` (
  `id` int(11) NOT NULL,
  `fkcategoryid` int(11) NOT NULL,
  `fksubcategoryid` int(11) DEFAULT NULL,
  `img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `permalink` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `terre217_social_link`
--

CREATE TABLE `terre217_social_link` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(500) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_social_link`
--

INSERT INTO `terre217_social_link` (`id`, `name`, `username`, `icon`, `link`, `publish`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', 'Terre', 'fa-facebook', 'https://www.facebook.com/', 1, 1, '2017-02-13 06:47:50', '2017-02-09 10:24:25'),
(2, 'Instagram', '@terre', 'fa-instagram', 'https://instagram.com/', 1, 3, '2017-02-13 06:48:02', '2017-02-04 04:59:48'),
(3, 'Twitter', '@terre_idn', 'fa-twitter', 'http://twitter.com/', 1, 2, '2017-02-13 06:48:05', '2017-02-04 04:59:41'),
(6, 'Youtube', NULL, 'fa-youtube', 'https://www.youtube.com', 0, 4, '2017-02-13 06:47:40', '2017-02-10 07:26:50'),
(7, 'Flicker', NULL, 'fa-flickr', 'https://www.flickr.com/', 0, 5, '2017-02-12 08:37:07', '2017-02-12 08:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_static_page`
--

CREATE TABLE `terre217_static_page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name_alias` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `fgdisplay` varchar(10) DEFAULT NULL,
  `fgfooter` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_static_page`
--

INSERT INTO `terre217_static_page` (`id`, `name`, `name_alias`, `meta_title`, `meta_description`, `meta_keywords`, `image`, `content`, `publish`, `fgdisplay`, `fgfooter`, `order_id`, `created_at`, `updated_at`) VALUES
(2, 'CURRENCY', 'currency', 'CURRENCY', 'DUASISIMMONEYCHANGER CURRENCY AVAILABLE', 'DUASISIMMONEYCHANGER CURRENCY AVAILABLE', 'currencies-landing.jpg', '<table class=\"table-currency\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center;\"><span style=\"color: #339966;\"><strong>COUNTRY</strong></span></td>\r\n<td style=\"text-align: center;\"><span style=\"color: #339966;\"><strong>CURRENCY</strong></span></td>\r\n<td style=\"text-align: center;\"><span style=\"color: #339966;\"><strong>CODE</strong></span></td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"https://duasisimoneychanger.co.id/resources/assets/uploads/others/america.png\" alt=\"\" />&nbsp; AMERICA</td>\r\n<td style=\"text-align: center;\">UNITED STATE DOLLAR</td>\r\n<td style=\"text-align: right;\">USD</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 1, 'on_footer', '2', 3, '2017-02-05 13:56:54', '2022-10-17 15:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_static_page_on_menu`
--

CREATE TABLE `terre217_static_page_on_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name_alias` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `order_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_static_page_on_menu`
--

INSERT INTO `terre217_static_page_on_menu` (`id`, `name`, `name_alias`, `meta_title`, `meta_description`, `meta_keywords`, `image`, `content`, `publish`, `order_id`, `created_at`, `updated_at`) VALUES
(2, 'Discount UP To 70 %', 'discount-up-to-70', '', '', '', 'about.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at eleifend dolor. Mauris non vulputate enim. Sed accumsan odio quis commodo pharetra. Vivamus sit amet accumsan mi. Sed purus mauris, fringilla ac erat vitae, laoreet congue est. Nam a condimentum quam, non posuere sapien. Ut vitae turpis purus.</p>\r\n<p>Pellentesque accumsan lectus quis nibh aliquam hendrerit. Nunc lobortis scelerisque massa. Suspendisse commodo ut lorem ut cursus. Fusce ipsum est, blandit quis risus et, pulvinar consectetur ex. Nullam porta tincidunt dignissim. Sed scelerisque vestibulum metus quis tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean ultrices ex sodales vehicula porta. Duis placerat lorem ut tellus imperdiet, ac blandit libero dapibus.</p>\r\n<p>Donec vestibulum dapibus enim quis hendrerit. Phasellus lacinia est eget elit aliquet, ut pulvinar tellus ultrices. Pellentesque semper commodo nisi eget convallis. Integer sagittis dui magna, ac laoreet urna semper a. Mauris efficitur consequat commodo. Praesent vel dictum sapien, eget ultrices libero. Nullam quis velit pretium, aliquet augue nec, fermentum ligula. Sed vel scelerisque nisi. Morbi a mi dolor. Mauris molestie justo at posuere congue. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent ut magna non nisl condimentum aliquam. Sed efficitur id tortor ut ultrices.</p>\r\n<p>Aenean aliquet, purus sed viverra tincidunt, eros nisi vulputate felis, cursus porta est leo a elit. Fusce eleifend quis diam id congue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec ornare rhoncus est a faucibus. Nam porttitor felis vitae hendrerit viverra. Curabitur a cursus orci. Donec euismod pretium arcu, sed vehicula neque molestie in. Sed fringilla ac tellus a eleifend. Maecenas rutrum maximus nibh quis porta. Sed vel rhoncus ipsum. Sed rhoncus ornare lacus, at elementum dui tristique sed. Nam elit sem, dapibus id ligula eget, pretium semper est. Donec pellentesque a sapien ac cursus. Suspendisse congue tempor nisi eget lobortis. Pellentesque efficitur ligula eu erat porttitor, id accumsan lacus posuere. Fusce fermentum sem orci, non finibus massa molestie nec.</p>\r\n<p>Sed ac vestibulum tortor, eu vestibulum odio. Vivamus mollis ligula ipsum, at scelerisque libero vehicula at. Aenean fermentum at nulla ut venenatis. Donec varius ex ut nibh rutrum ultrices. Nulla venenatis, sapien non fermentum venenatis, mi urna commodo nulla, quis varius enim tortor id enim. Curabitur in urna eget enim bibendum aliquet. Etiam in ligula et odio eleifend sollicitudin. Aenean eros velit, laoreet at diam ultricies, commodo sagittis felis. Nullam mauris diam, tempus ut mattis a, tincidunt in est. Donec efficitur sapien non magna mollis tempus. Proin id felis at neque egestas feugiat. Sed efficitur nibh a lobortis semper. Fusce metus neque, rhoncus facilisis imperdiet et, efficitur vitae risus.</p>\r\n<p>Proin interdum erat sed ante volutpat eleifend. In scelerisque feugiat aliquet. Etiam rhoncus odio a turpis vehicula, sed semper tellus eleifend. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel sollicitudin nulla, nec consequat eros. Morbi tempor, mauris id accumsan pellentesque, eros est lobortis purus, sed facilisis orci massa ultrices magna. Mauris pharetra scelerisque mauris, sit amet pretium lorem venenatis id. Curabitur eu semper neque, quis maximus ex. Mauris sed lorem nec tortor fermentum congue at in arcu.</p>\r\n<p>Curabitur sit amet elit id dolor imperdiet tincidunt. Sed ultricies vel magna quis elementum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi. Morbi nec eros eu elit porta aliquet. Mauris non porta massa. Praesent tristique ex sodales, aliquet ipsum a, aliquet felis. Nullam in elit lacus. Sed ullamcorper id urna id accumsan. Sed eleifend, sem quis sagittis tempus, mi erat mollis augue, at hendrerit felis ipsum at ligula.</p>\r\n<p>Integer ut scelerisque mi. Duis elementum bibendum est, sit amet consectetur massa pellentesque consectetur. Quisque finibus lacus turpis, non rutrum urna faucibus in. Sed feugiat consequat tristique. Sed id sodales quam. Quisque tristique velit ligula, eu dictum neque mattis a. Aliquam scelerisque lorem odio, nec posuere magna posuere in. Suspendisse vel consectetur libero. Integer imperdiet mauris pulvinar massa semper suscipit. Maecenas hendrerit vestibulum pulvinar.</p>\r\n<p>Nam interdum ultrices est, at maximus erat. Quisque sed lacinia tellus. Aliquam ultrices erat commodo, congue est vel, lacinia leo. Proin sapien urna, accumsan a quam id, mattis blandit lacus. Suspendisse tristique blandit neque, eu suscipit dui convallis sed. Mauris sit amet enim laoreet, interdum felis at, ornare lorem. Sed efficitur ut augue a dictum. Curabitur blandit laoreet magna, a vehicula ex. Nulla maximus ornare nibh, at porta erat dictum quis. Donec ac hendrerit purus, a lacinia ipsum. Morbi sit amet sollicitudin nulla, id lobortis enim. Sed vitae urna interdum, facilisis ligula non, dictum elit. Donec a lectus mauris. Nulla ut quam in nibh condimentum dictum a id magna. Integer elementum est ut odio mollis, ut pretium nibh mollis. Suspendisse vel vehicula augue.</p>\r\n<p>Nunc sapien justo, feugiat id turpis eu, ultrices pharetra magna. Pellentesque quis sem commodo, ullamcorper nisi tempor, pellentesque augue. Cras faucibus fringilla orci, non mattis justo blandit ut. Fusce in diam aliquet, maximus orci placerat, rhoncus quam. Ut pharetra euismod est aliquet hendrerit. Integer ut quam sagittis, euismod ante nec, suscipit ligula. Sed venenatis sapien id luctus hendrerit.</p>', 1, 1, '2017-02-09 15:21:21', '2017-02-09 15:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_stores`
--

CREATE TABLE `terre217_stores` (
  `id` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `img_2` varchar(255) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `region` int(11) DEFAULT 0,
  `call_number_one` varchar(20) DEFAULT NULL,
  `call_number_two` varchar(20) DEFAULT NULL,
  `office_phone_number` varchar(20) DEFAULT NULL,
  `whatsapp_number` varchar(20) DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `maps_url` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_stores`
--

INSERT INTO `terre217_stores` (`id`, `img`, `img_2`, `name`, `description`, `region`, `call_number_one`, `call_number_two`, `office_phone_number`, `whatsapp_number`, `latitude`, `longitude`, `maps_url`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'BRANCHESKPO.jpg', 'BRANCHESKPO2.jpg', 'KPO PLAZA ASIA', '<p>Plaza Asia, Lantai 3C, Jl Jend Sudriman Kav 59, Jakarta Selatan, DKI Jakarta, 12190</p>', 1, '+622138250138', '+622138250138', '+622138250138', '+628561670686', '-6.160892', '106.848074', 'https://www.google.com/search?gs_ssp=eJzj4tZP1zcsKS60MLOIN2C0UjWoMEo1s0wzNDVMMbY0MDNITrMCCiVbJBobpJkZJycZmpuap3hxFeQkViUqJBZnJgIAOEISPA&q=plaza+asia&oq=PLAZA+ASIA&gs_lcrp=EgZjaHJvbWUqFQgCEC4YJxivARjHARiABBiKBRiOBTIRCAAQRRgnGDkY4wIYgAQYigUyBggBEEUYQDIVCAIQ', 1, 1, '2017-02-05 14:15:18', '2025-07-24 16:34:28'),
(2, 'BRANCHESGI.jpg', 'BRANCHESGI2.jpg', 'GRAND INDONESIA', '<p>Grand Indonesia West Mall, LG 22A, Jakarta Pusat, Grand Est, 10310, Indonesia</p>', 1, '+622123580840', '+622123581213', '+62213580840', '+6285814417417', '-6.1952437', '106.7379695', 'https://www.google.com/search?q=dua+sisi+grand+indonesia&oq=dua+sisi+grand+indonesia&gs_lcrp=EgZjaHJvbWUqCggAEAAY4wIYgAQyCggAEAAY4wIYgAQyDQgBEC4YrwEYxwEYgAQyCAgCEAAYFhgeMggIAxAAGBYYHjIICAQQABgWGB7SAQg0NDYxajBqNKgCALACAA&sourceid=chrome&ie=UTF-8', 2, 1, '2022-10-17 08:23:33', '2026-07-02 12:57:18'),
(3, 'WEB-BRANCHES-DUA-SISI_20260724_143319_0000.jpg', 'WEB_BRANCHES_DUA_SISI_20260724_143319_00002.jpg', 'PLAZA SENAYAN', '<p>Ranch Market Plaza Senayan, Lantai LGJalan Asia Afrika No 8&nbsp; Jakarta Pusat, DKI Jakarta 10270, Indonesia</p>', 1, '+62215725321', '+62215725321', '+62215725321', '+6281282595209', '-6.226338046691871', '106.7990908225031', 'https://www.google.com/maps/place/Dua+Sisi+Money+Changer+Plaza+Senayan/@-6.2265194,106.7969665,17z/data=!3m1!4b1!4m5!3m4!1s0x2e69f14926effbd7:0xab2328cdfc223e03!8m2!3d-6.2265247!4d106.7991552', 3, 1, '2022-10-17 08:34:55', '2026-07-24 14:44:59'),
(4, 'BRANCHESSC.jpg', 'BRANCHESSC2.jpg', 'SENAYAN CITY', '<p>Senayan City LG L 12 Jl. Asia Afrika No.19, RW.3, Gelora, akarta Pusat, DKI Jakarta 10270, Indonesia</p>', 1, '+622172781155', '+622172781156', '+622172781155', '+6285730021190', '-6.226907589860433', '106.79725000988765', 'https://www.google.com/maps/place/Dua+Sisi+Money+Changer+Senayan+City/@1.314,103.84425,11z/data=!4m5!3m4!1s0x2e69f148d93468e5:0x2cce4f5502f0b93c!8m2!3d-6.2271849!4d106.7972822', 4, 1, '2022-10-17 08:36:48', '2025-07-23 20:15:28'),
(5, 'BRANCHESCW.jpg', 'BRANCHESCW2.jpg', 'CIPUTRA WORLD', '<p>Ciputra World, Jl. Mayjen Sungkono No.15 Lantai Lower Ground 89, Gn. Sari, Kec. Dukuhpakis, Surabaya, Jawa Timur 60224</p>', 2, '+623151200016', '+623151200017', '+623151200016', '+6282233144522', '-7.291809211912427', '112.72034391689499', 'https://www.google.com/maps/place/Dua+Sisi+Money+Changer+Ciputra+World+Surabaya/@-7.2921604,112.7154623,1093m/data=!3m1!1e3!4m10!1m2!2m1!1sDua+Sisi+Money+Changer+CIPUTRA+WORLD!3m6!1s0x2dd7fb8becf902bf:0x5de568317f14e910!8m2!3d-7.2921604!4d112.7202259!15sC', 5, 1, '2025-07-23 20:14:06', '2025-07-23 20:15:49'),
(6, 'BRANCHESTP1.jpg', 'BRANCHESTP12.jpg', 'TUNJUNGAN PLAZA', '<p>Jl. Basuki Rahmat No.8-12, Kedungdoro, Kec. Tegalsari, Surabaya, Jawa Timur 60261</p>', 2, '+623153226721', '+62315324193', '+623153226721', '+6282245007593', '-7.263575416684057', '112.74025262066374', 'https://www.google.com/maps/place/Dua+Sisi+Money+Changer+Tujungan+Plaza+1/@-7.2637936,112.7378172,1118m/data=!3m2!1e3!4b1!4m6!3m5!1s0x2dd7f960baa576fd:0xb2829bf0a9696fb1!8m2!3d-7.2637936!4d112.7403921!16s%2Fg%2F11h16r5vx?entry=ttu&g_ep=EgoyMDI1MDcyMS4wIKX', 6, 1, '2025-07-24 16:33:10', '2026-01-19 17:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_stores_location`
--

CREATE TABLE `terre217_stores_location` (
  `id` int(11) NOT NULL,
  `fklocationid` int(11) DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_stores_location`
--

INSERT INTO `terre217_stores_location` (`id`, `fklocationid`, `img`, `name`, `description`, `latitude`, `longitude`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(2, 1, 'Darth-Vader.jpg', 'Store 1', '<p>ASASsasas</p>', '0.12345', '-.012345', 1, 1, '2017-01-30 22:06:36', '2017-02-02 10:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_sub_category`
--

CREATE TABLE `terre217_sub_category` (
  `id` int(11) NOT NULL,
  `fkcategoryid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `permalink` varchar(150) NOT NULL,
  `order_id` int(1) NOT NULL,
  `publish` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_sub_category`
--

INSERT INTO `terre217_sub_category` (`id`, `fkcategoryid`, `name`, `permalink`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(3, 1, 'Sub Category 1', 'sub-category-1', 1, 1, '2017-01-29 21:44:08', '2017-01-29 23:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_team`
--

CREATE TABLE `terre217_team` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `permalink` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_keyword` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_team`
--

INSERT INTO `terre217_team` (`id`, `name`, `permalink`, `position`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(3, 'Test 1', 'test-1', 'Web Developer', '<p>ASasasasas</p>', '', '', '', 1, 1, '2017-02-02 06:41:11', '2017-02-02 06:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_teamprofile`
--

CREATE TABLE `terre217_teamprofile` (
  `id` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `permalink` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_teamprofile`
--

INSERT INTO `terre217_teamprofile` (`id`, `img`, `name`, `permalink`, `position`, `description`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Darth-Vader.jpg', 'WIDIANTO PRATAMA', 'widianto-pratama', 'Web Developer', '<p>Asasasa</p>', 1, 1, '2017-01-31 09:04:48', '2017-01-31 02:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_team_image`
--

CREATE TABLE `terre217_team_image` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_team_image`
--

INSERT INTO `terre217_team_image` (`id`, `team_id`, `img`, `as_default`, `order_id`, `publish`, `created_at`, `updated_at`) VALUES
(9, 3, 'test-1.jpg', 0, NULL, 1, '2017-02-02 07:11:12', '2017-02-02 07:30:25'),
(10, 3, 'test-12.jpg', 1, NULL, 1, '2017-02-02 07:26:06', '2017-02-02 07:30:26'),
(11, 3, 'test-13.jpg', 0, NULL, 1, '2017-02-02 07:49:57', '2017-02-02 07:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_testimonials`
--

CREATE TABLE `terre217_testimonials` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `publish` int(1) NOT NULL,
  `order_id` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_testimonials`
--

INSERT INTO `terre217_testimonials` (`id`, `image`, `name`, `title`, `location`, `description`, `publish`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'testimonial.jpg', 'Widianto Pratama', '', 'Jakarta', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 2, '2017-01-25 01:34:34', '2017-02-07 22:45:51'),
(2, NULL, 'VICTORIA', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 4, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(3, NULL, 'AMBER', '', 'BANDUNG', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 3, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(4, NULL, 'LUNA', '', 'BALI', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 5, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(5, NULL, 'LAY', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 6, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(6, NULL, 'KAI', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 7, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(7, NULL, 'KRIS', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 8, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(8, NULL, 'LUNA', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 9, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(9, NULL, 'LAY', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 10, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(10, NULL, 'KAI', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 11, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(11, NULL, 'KRIS', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 12, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(12, NULL, 'AMBER', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 13, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(13, NULL, 'LUNA', '', 'JAKARTA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 14, '2017-02-05 08:04:34', '2017-02-07 22:45:51'),
(14, '1dbc155c36038471d4543df107b702bc.jpg', 'Sigi Kumala', '', 'Jakarta', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper et urna placerat scelerisque. In eget est semper ligula luctus molestie et in diam. Nam vitae ligula varius, viverra diam.', 1, 1, '2017-02-07 00:19:12', '2017-02-07 22:45:51'),
(15, '829f69bb134bc82826f76012d9350acf.jpg', 'Lily', 'Lorem Ipsum', 'Bandung', 'Quisque malesuada nisl convallis mauris condimentum, in tincidunt felis consectetur. In convallis at mi sed lacinia. Cras eleifend libero luctus felis consectetur faucibus. ', 1, 15, '2017-02-10 03:28:22', '2017-02-10 03:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `terre217_upcoming_events`
--

CREATE TABLE `terre217_upcoming_events` (
  `id` int(11) NOT NULL,
  `title` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `period_time` tinyint(1) NOT NULL DEFAULT 0,
  `events_date` date DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terre217_upcoming_events`
--

INSERT INTO `terre217_upcoming_events` (`id`, `title`, `description`, `period_time`, `events_date`, `start_date`, `end_date`, `order_id`, `publish`, `updated_at`, `created_at`) VALUES
(3, 'SIAL INTERFOOD 2016', '<p>Come and visit our booth at the biggest food and bakery equipment exhibition in Indonesia. JIEXPKO Kemayoran, booth #D 030, 035, 060, 9&nbsp;- 12 November 2016. For more detail click <a href=\"http://sialinterfood.com/\">here</a></p>\\r\\n<p>&nbsp;<img src=\"http://sccbakery.com/resources/assets/uploads/others/SIAL INTERFOOD.jpg\" alt=\"\" width=\"418\" height=\"131\" /></p>', 1, '2015-11-11', '2016-11-09', '2016-11-12', 1, 1, '2016-09-28 14:46:02', '2015-09-15 13:57:04'),
(5, 'FOOD HOTEL INDONESIA 2017', '<p>The 14th International Hotel, Catering Equipment, Food &amp; Drink Exhibition.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p><img src=\"http://sccbakery.com/resources/assets/uploads/others/food-hotel-indonesia-logo.png\" alt=\"\" width=\"419\" height=\"122\" /></p>', 1, '0000-00-00', '2017-04-05', '2017-04-07', NULL, 1, '2016-09-28 14:37:45', '2016-09-23 15:03:59'),
(9, 'ss', '<p>ssssssssssssssssss</p>', 1, '0000-00-00', '2016-12-20', '2016-12-23', NULL, 1, '2016-12-21 09:53:46', '2016-12-21 09:53:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `terre217_about`
--
ALTER TABLE `terre217_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_about_category`
--
ALTER TABLE `terre217_about_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_administrator`
--
ALTER TABLE `terre217_administrator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `administrator_email_unique` (`email`);

--
-- Indexes for table `terre217_brand`
--
ALTER TABLE `terre217_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_category`
--
ALTER TABLE `terre217_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_category_menu`
--
ALTER TABLE `terre217_category_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_config`
--
ALTER TABLE `terre217_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_contact_map`
--
ALTER TABLE `terre217_contact_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_contact_message`
--
ALTER TABLE `terre217_contact_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_custom_menu`
--
ALTER TABLE `terre217_custom_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_designerform`
--
ALTER TABLE `terre217_designerform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_download_category`
--
ALTER TABLE `terre217_download_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_galleries`
--
ALTER TABLE `terre217_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_galleries_category`
--
ALTER TABLE `terre217_galleries_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_home_banner`
--
ALTER TABLE `terre217_home_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_home_slideshow`
--
ALTER TABLE `terre217_home_slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_location`
--
ALTER TABLE `terre217_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_menuitems`
--
ALTER TABLE `terre217_menuitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_modules`
--
ALTER TABLE `terre217_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_msmenu`
--
ALTER TABLE `terre217_msmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_newsletter`
--
ALTER TABLE `terre217_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_news_events`
--
ALTER TABLE `terre217_news_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_news_events_category`
--
ALTER TABLE `terre217_news_events_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_page`
--
ALTER TABLE `terre217_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_press_album`
--
ALTER TABLE `terre217_press_album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_press_awards`
--
ALTER TABLE `terre217_press_awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_press_awards_category`
--
ALTER TABLE `terre217_press_awards_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_product`
--
ALTER TABLE `terre217_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_product_brand`
--
ALTER TABLE `terre217_product_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_product_category`
--
ALTER TABLE `terre217_product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_product_image`
--
ALTER TABLE `terre217_product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_product_image_brand`
--
ALTER TABLE `terre217_product_image_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_product_image_category`
--
ALTER TABLE `terre217_product_image_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_product_image_subcategory`
--
ALTER TABLE `terre217_product_image_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_product_subcategory`
--
ALTER TABLE `terre217_product_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_project`
--
ALTER TABLE `terre217_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_project_category`
--
ALTER TABLE `terre217_project_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_project_image`
--
ALTER TABLE `terre217_project_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_project_image_category`
--
ALTER TABLE `terre217_project_image_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_project_image_subcategory`
--
ALTER TABLE `terre217_project_image_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_project_subcategory`
--
ALTER TABLE `terre217_project_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_promotions`
--
ALTER TABLE `terre217_promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_schedule`
--
ALTER TABLE `terre217_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_services`
--
ALTER TABLE `terre217_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_services_by_category`
--
ALTER TABLE `terre217_services_by_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_services_by_category_gallery`
--
ALTER TABLE `terre217_services_by_category_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_services_by_subcategory`
--
ALTER TABLE `terre217_services_by_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_social_link`
--
ALTER TABLE `terre217_social_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_static_page`
--
ALTER TABLE `terre217_static_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_static_page_on_menu`
--
ALTER TABLE `terre217_static_page_on_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_stores`
--
ALTER TABLE `terre217_stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_stores_location`
--
ALTER TABLE `terre217_stores_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_sub_category`
--
ALTER TABLE `terre217_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_team`
--
ALTER TABLE `terre217_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_teamprofile`
--
ALTER TABLE `terre217_teamprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_team_image`
--
ALTER TABLE `terre217_team_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_testimonials`
--
ALTER TABLE `terre217_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terre217_upcoming_events`
--
ALTER TABLE `terre217_upcoming_events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `terre217_config`
--
ALTER TABLE `terre217_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `terre217_contact_message`
--
ALTER TABLE `terre217_contact_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `terre217_home_slideshow`
--
ALTER TABLE `terre217_home_slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `terre217_news_events`
--
ALTER TABLE `terre217_news_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `terre217_stores`
--
ALTER TABLE `terre217_stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
