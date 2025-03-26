-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql202.infinityfree.com
-- Generation Time: Mar 09, 2025 at 07:01 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37948368_sharktropic`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Electronics', '2024-03-31 07:34:30'),
(2, 'Clothing', '2024-03-31 07:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

CREATE TABLE `coupon_codes` (
  `id` int(11) NOT NULL,
  `offer` varchar(255) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `expiration_date` varchar(255) DEFAULT NULL,
  `percent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `coupon_codes`
--

INSERT INTO `coupon_codes` (`id`, `offer`, `coupon_code`, `expiration_date`, `percent`, `created_at`) VALUES
(1, 'Exclusive Offer! Save 20% on Your Next Purchase', 'Wrd454', '12 June 2024', '20', '2024-12-26 12:53:08'),
(2, 'Spring Savings Spectacular!', 'Wrd454', '12 June 2024', '25', '2024-12-26 12:53:08'),
(3, 'Summer Special: 25% Off Just for You!', 'Wrd454', '12 June 2024', '15', '2024-12-26 12:53:08'),
(9, 'Exclusive Deal: Save Big This Fall!', 'Wrd454', '12 June 2024', '20', '2025-01-08 11:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `title`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Jenny Wilson', '34,21', 'Hello there!', '2025-01-08 14:00:48', '2025-03-09 08:07:16'),
(2, 'Esther Howard', '24,21', 'Interested in updates.', '2025-01-08 14:02:04', '2025-03-09 08:06:18'),
(3, 'Marvin McKinney', '14,21', 'Interested in updates.', '2025-01-08 14:02:54', '2025-03-09 08:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `donation_images`
--

CREATE TABLE `donation_images` (
  `id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `image_filename_sm` varchar(255) NOT NULL,
  `image_filename_md` varchar(255) NOT NULL,
  `image_filename_lg` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donation_images`
--

INSERT INTO `donation_images` (`id`, `donation_id`, `image_filename_sm`, `image_filename_md`, `image_filename_lg`, `created_at`) VALUES
(23, 0, '67ca0741ae6421741293377_credit-1.png', '67ca0741ae6421741293377_credit-1.png', '67ca0741ae6421741293377_credit-1.png', NULL),
(24, 0, '67ca0764ec8291741293412_credit-1.png', '67ca0764ec8291741293412_credit-1.png', '67ca0764ec8291741293412_credit-1.png', NULL),
(25, 0, '67cc256785a5d1741432167_credit-1.png', '67cc256785a5d1741432167_credit-1.png', '67cc256785a5d1741432167_credit-1.png', NULL),
(26, 0, '67cc26874a46f1741432455_credit-1.png', '67cc26874a46f1741432455_credit-1.png', '67cc26874a46f1741432455_credit-1.png', NULL),
(27, 0, '67cc27ec0a4281741432812_credit-1.png', '67cc27ec0a4281741432812_credit-1.png', '67cc27ec0a4281741432812_credit-1.png', NULL),
(28, 0, '67cc2842c84571741432898_credit-1.png', '67cc2842c84571741432898_credit-1.png', '67cc2842c84571741432898_credit-1.png', NULL),
(29, 0, '67cc2842c84571741432898_credit-1.png', '67cc2842c84571741432898_credit-1.png', '67cc2842c84571741432898_credit-1.png', NULL),
(30, 0, '67cc2842c84571741432898_credit-1.png', '67cc2842c84571741432898_credit-1.png', '67cc2842c84571741432898_credit-1.png', NULL),
(31, 0, '67cc2842c84571741432898_credit-1.png', '67cc2842c84571741432898_credit-1.png', '67cc2842c84571741432898_credit-1.png', '2025-03-08 11:25:27'),
(32, 0, '67cc8d539b24c1741458771_single-product-3.jpg', '67cc8d539b24c1741458771_single-product-3.jpg', '67cc8d539b24c1741458771_single-product-3.jpg', '2025-03-08 18:33:04'),
(33, 0, '67cc8d539b24c1741458771_single-product-3.jpg', '67cc8d539b24c1741458771_single-product-3.jpg', '67cc8d539b24c1741458771_single-product-3.jpg', '2025-03-08 18:37:17'),
(34, 0, '67cc8e7177af61741459057_single-product-2.jpg', '67cc8e7177af61741459057_single-product-2.jpg', '67cc8e7177af61741459057_single-product-2.jpg', '2025-03-08 18:37:44'),
(35, 0, '67cc94d276fe31741460690_single-product-2.jpg', '67cc94d276fe31741460690_single-product-2.jpg', '67cc94d276fe31741460690_single-product-2.jpg', '2025-03-08 19:05:02'),
(36, 0, '67cc94d276fe31741460690_single-product-2.jpg', '67cc94d276fe31741460690_single-product-2.jpg', '67cc94d276fe31741460690_single-product-2.jpg', '2025-03-08 19:08:10'),
(46, 3, '67cd4bb5a5a741741507509_credit-1.png', '67cd4bb5a5a741741507509_credit-1.png', '67cd4bb5a5a741741507509_credit-1.png', '2025-03-09 08:05:17'),
(47, 2, '67cd4bf324f381741507571_credit-2.png', '67cd4bf324f381741507571_credit-2.png', '67cd4bf324f381741507571_credit-2.png', '2025-03-09 08:06:18'),
(48, 1, '67cd4c2eed7d21741507630_credit-4.png', '67cd4c2eed7d21741507630_credit-4.png', '67cd4c2eed7d21741507630_credit-4.png', '2025-03-09 08:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `email_verify`
--

CREATE TABLE `email_verify` (
  `id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `email_verify`
--

INSERT INTO `email_verify` (`id`, `subscriber_id`, `code`, `expires`) VALUES
(1, 44, '482159', 1738680051);

-- --------------------------------------------------------

--
-- Table structure for table `login_verify`
--

CREATE TABLE `login_verify` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `expires` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_verify`
--

INSERT INTO `login_verify` (`id`, `user_id`, `code`, `expires`) VALUES
(1, 7, '192078', '1736769730'),
(2, 8, '666751', '1736769847'),
(3, 9, '307771', '1736770297'),
(4, 10, '899884', '1736770430');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(6, 'SharkTopic/MM6 Maison Margiela', 'Description', '2024-06-22 13:51:45', '2025-01-13 12:04:42'),
(7, 'Sweater Winter', 'Description', '2024-06-22 13:52:22', '2025-01-13 12:45:16'),
(8, 'SharkTopic/MM6 Maison Margiela', 'MM6 is part of Maison Margiela, a luxury fashion house founded by Belgian designer Martin Margiela in 1988. In 1997 MM6 Maison Margiela was established as a relaxed line to complement the Maison’s avant-garde, deconstructive designs. MM6 has since evolved as a brand to encompass a wide range of everyday offerings with subtle and subversive twists, anchored in Margiela’s design philosophy.\n\nIn an era defined by exaggerated opulence, Martin Margiela challenged expectations by presenting deconstructed tailoring and often employing recycled or humble materials.\n\nFollowing the founder’s spirit of anonymity, MM6 remains designed by a collective, directing focus back on the garments and the ideas that shape them. Margiela’s subversive practices have since become widely adopted, as generations of designers continue to look to the collective as a touch point of integrity and innovation.', '2024-06-22 14:51:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_images`
--

CREATE TABLE `news_images` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `image_filename_sm` varchar(255) NOT NULL,
  `image_filename_md` varchar(255) NOT NULL,
  `image_filename_lg` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news_images`
--

INSERT INTO `news_images` (`id`, `news_id`, `image_filename_sm`, `image_filename_md`, `image_filename_lg`, `created_at`) VALUES
(10, 7, '6676cc8eaf954_Rectangle 20 (7).jpg', '6676cc8eaf954_Rectangle 20 (7).jpg', '6676cc8eaf954_Rectangle 20 (7).jpg', NULL),
(16, 8, '6676d6f994fc01719064313_Rectangle 20 (5).jpg', '6676d6f994fc01719064313_Rectangle 20 (5).jpg', '6676d6f994fc01719064313_Rectangle 20 (5).jpg', '2024-06-22 14:51:56'),
(19, 6, '67850157099931736769879_6697d8ed473fb1721227501_product-2.jpg', '67850157099931736769879_6697d8ed473fb1721227501_product-2.jpg', '67850157099931736769879_6697d8ed473fb1721227501_product-2.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `total` bigint(20) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `promo_code` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `buyer_id`, `fullname`, `email`, `phone`, `addr`, `total`, `order_status`, `promo_code`, `created_at`) VALUES
(13, 1, 'Shadman', 'shadmanwebdev@gmail.com', '456456456', 'abc', 60, 'Paid', '', '2024-07-03 14:06:56'),
(14, 2, 'Hy', 'mateomir@gmail.com', '33333334', 'Hbghh', 75, 'Started', '', '2024-12-19 14:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` varchar(10) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `product_id`, `product_size`, `unit_price`, `qty`, `order_id`) VALUES
(8, 34, 'm', '15.00', 2, 13),
(9, 38, 'xl', '15.00', 2, 13),
(10, 37, 'xl', '15.00', 4, 14),
(11, 34, 'm', '15.00', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pid` int(11) NOT NULL,
  `id` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `payment_intent_id` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pid`, `id`, `payment_method`, `status`, `fullname`, `email`, `phone`, `amount`, `currency`, `address`, `postal_code`, `country`, `customer_id`, `reference_id`, `created`, `payment_intent_id`, `order_id`) VALUES
(10, 'cs_test_a11BG0nIS6R2uD4iqX7BuYT0qpvYru3auXi04epSTb07SC9GXDtXThuCut', 'Stripe', 'complete', 'John Doe', 'synotype@gmail.com', NULL, '5596.00', 'gbp', NULL, NULL, 'BD', NULL, NULL, 1719234847, 'pi_3PVCiwH4rZ2esk0g0EHKmPYX', 10),
(11, 'cs_test_b1pR6nB8yu4ziaF1NMU9uW5wLRNNOy9nwSnL5CrrNUPuMnhl4eogP4iW2L', 'Stripe', 'complete', 'John Doe', 'shadmanwebdev@gmail.com', NULL, '12000.00', 'gbp', NULL, NULL, 'BD', NULL, NULL, 1720012015, 'pi_3PYSuIH4rZ2esk0g1ITwqqou', 13);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `regular_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `size` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `title`, `description`, `regular_price`, `sale_price`, `size`, `created_at`, `updated_at`) VALUES
(34, 1, 'Shirt #34 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.', '35.00', '15.00', '[\"s\",\"m\",\"l\"]', '2024-06-30 12:26:45', '2025-03-08 11:30:40'),
(35, 1, 'Shirt #35 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-06-30 12:38:15', NULL),
(36, 1, 'Shirt #36 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-06-30 12:51:11', NULL),
(37, 1, 'Shirt #37 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"l\",\"xl\",\"xxl\"]', '2024-06-30 12:52:09', NULL),
(38, 1, 'Shirt #38 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"s\",\"m\",\"l\",\"xl\",\"xxl\"]', '2024-06-30 12:53:01', NULL),
(39, 1, 'Shirt #39 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-06-30 12:53:45', NULL),
(40, 1, 'Shirt #40 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-06-30 13:00:33', '2024-07-16 13:35:58'),
(41, 1, 'Shirt #41 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"s\",\"m\",\"l\"]', '2024-07-01 10:00:00', NULL),
(42, 1, 'Shirt #42 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 10:10:00', '2024-07-16 13:36:56'),
(43, 1, 'Shirt #43 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 10:20:00', '2024-07-16 13:38:08'),
(44, 1, 'Shirt #44 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"l\",\"xl\",\"xxl\"]', '2024-07-01 10:30:00', '2024-07-16 13:38:56'),
(45, 1, 'Shirt #45 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"s\",\"m\",\"l\",\"xl\",\"xxl\"]', '2024-07-01 10:40:00', '2024-07-16 13:40:12'),
(46, 1, 'Shirt #46 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 10:50:00', '2024-07-16 13:40:39'),
(47, 1, 'Shirt #47 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 11:00:00', '2024-07-16 13:44:29'),
(48, 1, 'Shirt #48 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"s\",\"m\",\"l\"]', '2024-07-01 11:10:00', '2024-07-16 14:00:43'),
(49, 1, 'Shirt #49 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 11:20:00', '2024-07-16 14:02:08'),
(50, 1, 'Shirt #50 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 11:30:00', '2024-07-16 14:02:35'),
(51, 1, 'Shirt #51 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"l\",\"xl\",\"xxl\"]', '2024-07-01 11:40:00', '2024-07-16 14:02:50'),
(52, 1, 'Shirt #52 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"s\",\"m\",\"l\",\"xl\",\"xxl\"]', '2024-07-01 11:50:00', '2024-07-16 14:03:06'),
(53, 1, 'Shirt #53 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 12:00:00', '2024-07-16 14:03:25'),
(54, 1, 'Shirt #54 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 12:10:00', '2024-07-16 15:13:05'),
(55, 1, 'Shirt #55 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"l\",\"xl\",\"xxl\"]', '2024-07-01 12:20:00', '2024-07-16 15:13:21'),
(56, 1, 'Shirt #56 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"s\",\"m\",\"l\",\"xl\",\"xxl\"]', '2024-07-01 12:30:00', '2024-07-16 15:13:49'),
(57, 1, 'Shirt #57 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 12:40:00', '2024-07-16 15:19:56'),
(58, 1, 'Shirt #58 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 12:50:00', '2024-07-16 15:20:31'),
(59, 1, 'Shirt #59 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"l\",\"xl\",\"xxl\"]', '2024-07-01 13:00:00', '2024-07-16 15:21:00'),
(60, 1, 'Shirt #60 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"s\",\"m\",\"l\",\"xl\",\"xxl\"]', '2024-07-01 13:10:00', '2024-07-16 15:31:18'),
(61, 1, 'Shirt #61 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 13:20:00', '2024-07-16 15:31:51'),
(62, 1, 'Shirt #62 Long', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '35.00', '15.00', '[\"m\",\"l\",\"xl\"]', '2024-07-01 13:30:00', '2024-07-16 15:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `products_sold`
--

CREATE TABLE `products_sold` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_filename_sm` varchar(255) NOT NULL,
  `image_filename_md` varchar(255) NOT NULL,
  `image_filename_lg` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_filename_sm`, `image_filename_md`, `image_filename_lg`, `created_at`) VALUES
(168, 35, '668143696e3021719747433_product-2.jpg', '668143696e3021719747433_product-2.jpg', '668143696e3021719747433_product-2.jpg', '2024-06-30 12:38:15'),
(169, 35, '668143725c99a1719747442_single-product-1.jpg', '668143725c99a1719747442_single-product-1.jpg', '668143725c99a1719747442_single-product-1.jpg', '2024-06-30 12:38:15'),
(170, 35, '668143725cc841719747442_single-product-2.jpg', '668143725cc841719747442_single-product-2.jpg', '668143725cc841719747442_single-product-2.jpg', '2024-06-30 12:38:15'),
(171, 35, '668143725cf731719747442_single-product-3.jpg', '668143725cf731719747442_single-product-3.jpg', '668143725cf731719747442_single-product-3.jpg', '2024-06-30 12:38:15'),
(172, 35, '668143725d1461719747442_single-product-4.jpg', '668143725d1461719747442_single-product-4.jpg', '668143725d1461719747442_single-product-4.jpg', '2024-06-30 12:38:15'),
(173, 35, '668143725d3101719747442_single-product-5.jpg', '668143725d3101719747442_single-product-5.jpg', '668143725d3101719747442_single-product-5.jpg', '2024-06-30 12:38:15'),
(174, 36, '6681465189a741719748177_product-3.jpg', '6681465189a741719748177_product-3.jpg', '6681465189a741719748177_product-3.jpg', '2024-06-30 12:51:11'),
(175, 36, '6681466994fed1719748201_winter-drop-16a.jpg', '6681466994fed1719748201_winter-drop-16a.jpg', '6681466994fed1719748201_winter-drop-16a.jpg', '2024-06-30 12:51:11'),
(176, 37, '668146c1abcc91719748289_product-4.jpg', '668146c1abcc91719748289_product-4.jpg', '668146c1abcc91719748289_product-4.jpg', '2024-06-30 12:52:09'),
(177, 38, '668146f54d0161719748341_product-5.jpg', '668146f54d0161719748341_product-5.jpg', '668146f54d0161719748341_product-5.jpg', '2024-06-30 12:53:01'),
(178, 38, '668146fdb18f01719748349_winter-drop-21b.jpg', '668146fdb18f01719748349_winter-drop-21b.jpg', '668146fdb18f01719748349_winter-drop-21b.jpg', '2024-06-30 12:53:01'),
(179, 39, '66814724c3e981719748388_product-6.jpg', '66814724c3e981719748388_product-6.jpg', '66814724c3e981719748388_product-6.jpg', '2024-06-30 12:53:45'),
(180, 39, '6681472bc2aa71719748395_winter-drop-23b.jpg', '6681472bc2aa71719748395_winter-drop-23b.jpg', '6681472bc2aa71719748395_winter-drop-23b.jpg', '2024-06-30 12:53:45'),
(181, 41, '668148de43fcf1719748830_winter-drop-7.jpg', '668148de43fcf1719748830_winter-drop-7.jpg', '668148de43fcf1719748830_winter-drop-7.jpg', '2024-06-30 13:00:33'),
(182, 41, '668148de43fcf1719748830_winter-drop-7.jpg', '668148de43fcf1719748830_winter-drop-7.jpg', '668148de43fcf1719748830_winter-drop-7.jpg', '2024-07-01 10:00:00'),
(204, 63, '66814e17e9475171974769_product-23.jpg', '66814e17e9475171974769_product-23.jpg', '66814e17e9475171974769_product-23.jpg', '2024-07-01 13:40:00'),
(205, 64, '66814e534ace6171974803_product-24.jpg', '66814e534ace6171974803_product-24.jpg', '66814e534ace6171974803_product-24.jpg', '2024-07-01 13:50:00'),
(206, 65, '66814e8ec5a84171974836_product-25.jpg', '66814e8ec5a84171974836_product-25.jpg', '66814e8ec5a84171974836_product-25.jpg', '2024-07-01 14:00:00'),
(207, 66, '66814ecaaa3ba1719748670_product-26.jpg', '66814ecaaa3ba1719748670_product-26.jpg', '66814ecaaa3ba1719748670_product-26.jpg', '2024-07-01 14:10:00'),
(208, 67, '66814f073ab5b1719749004_product-27.jpg', '66814f073ab5b1719749004_product-27.jpg', '66814f073ab5b1719749004_product-27.jpg', '2024-07-01 14:20:00'),
(209, 68, '66814f43285fc1719749338_product-28.jpg', '66814f43285fc1719749338_product-28.jpg', '66814f43285fc1719749338_product-28.jpg', '2024-07-01 14:30:00'),
(210, 69, '66814f7f5894b1719749672_product-29.jpg', '66814f7f5894b1719749672_product-29.jpg', '66814f7f5894b1719749672_product-29.jpg', '2024-07-01 14:40:00'),
(211, 70, '66814fba781fe1719740006_product-30.jpg', '66814fba781fe1719740006_product-30.jpg', '66814fba781fe1719740006_product-30.jpg', '2024-07-01 14:50:00'),
(212, 71, '66814ff5f5c8d1719740040_shirt-71.jpg', '66814ff5f5c8d1719740040_shirt-71.jpg', '66814ff5f5c8d1719740040_shirt-71.jpg', '2024-07-01 15:00:00'),
(213, 72, '66815031c5d0e1719740374_shirt-72.jpg', '66815031c5d0e1719740374_shirt-72.jpg', '66815031c5d0e1719740374_shirt-72.jpg', '2024-07-01 15:10:00'),
(214, 73, '6681506d5bce61719740708_shirt-73.jpg', '6681506d5bce61719740708_shirt-73.jpg', '6681506d5bce61719740708_shirt-73.jpg', '2024-07-01 15:20:00'),
(215, 74, '668150a9760f91719747042_shirt-74.jpg', '668150a9760f91719747042_shirt-74.jpg', '668150a9760f91719747042_shirt-74.jpg', '2024-07-01 15:30:00'),
(216, 75, '668150e592eb31719747376_shirt-75.jpg', '668150e592eb31719747376_shirt-75.jpg', '668150e592eb31719747376_shirt-75.jpg', '2024-07-01 15:40:00'),
(217, 76, '6681512174dc71719747710_shirt-76.jpg', '6681512174dc71719747710_shirt-76.jpg', '6681512174dc71719747710_shirt-76.jpg', '2024-07-01 15:50:00'),
(218, 77, '6681515d40f5a1719748044_shirt-77.jpg', '6681515d40f5a1719748044_shirt-77.jpg', '6681515d40f5a1719748044_shirt-77.jpg', '2024-07-01 16:00:00'),
(219, 78, '668151993e0621719748378_shirt-78.jpg', '668151993e0621719748378_shirt-78.jpg', '668151993e0621719748378_shirt-78.jpg', '2024-07-01 16:10:00'),
(220, 79, '668151d56a29c1719748712_shirt-79.jpg', '668151d56a29c1719748712_shirt-79.jpg', '668151d56a29c1719748712_shirt-79.jpg', '2024-07-01 16:20:00'),
(221, 80, '6681521111b8b1719749046_shirt-80.jpg', '6681521111b8b1719749046_shirt-80.jpg', '6681521111b8b1719749046_shirt-80.jpg', '2024-07-01 16:30:00'),
(222, 81, '6681524d9ae1d1719749380_shirt-81.jpg', '6681524d9ae1d1719749380_shirt-81.jpg', '6681524d9ae1d1719749380_shirt-81.jpg', '2024-07-01 16:40:00'),
(223, 82, '668152895d48d1719749714_shirt-82.jpg', '668152895d48d1719749714_shirt-82.jpg', '668152895d48d1719749714_shirt-82.jpg', '2024-07-01 16:50:00'),
(224, 83, '668152c4d2b021719740048_shirt-83.jpg', '668152c4d2b021719740048_shirt-83.jpg', '668152c4d2b021719740048_shirt-83.jpg', '2024-07-01 17:00:00'),
(225, 40, '66966919ef34a1721133337_product-1.jpg', '66966919ef34a1721133337_product-1.jpg', '66966919ef34a1721133337_product-1.jpg', NULL),
(226, 40, '66966925341941721133349_winter-drop-15a.jpg', '66966925341941721133349_winter-drop-15a.jpg', '66966925341941721133349_winter-drop-15a.jpg', NULL),
(227, 42, '6696695552be81721133397_product-2.jpg', '6696695552be81721133397_product-2.jpg', '6696695552be81721133397_product-2.jpg', NULL),
(228, 42, '6696695c98b1d1721133404_single-product-1.jpg', '6696695c98b1d1721133404_single-product-1.jpg', '6696695c98b1d1721133404_single-product-1.jpg', NULL),
(229, 43, '66966999d694c1721133465_product-6.jpg', '66966999d694c1721133465_product-6.jpg', '66966999d694c1721133465_product-6.jpg', NULL),
(230, 43, '669669ab764fa1721133483_winter-drop-23b.jpg', '669669ab764fa1721133483_winter-drop-23b.jpg', '669669ab764fa1721133483_winter-drop-23b.jpg', NULL),
(231, 44, '669669c1561791721133505_product-4.jpg', '669669c1561791721133505_product-4.jpg', '669669c1561791721133505_product-4.jpg', NULL),
(232, 44, '669669deb699d1721133534_winter-drop-28a.jpg', '669669deb699d1721133534_winter-drop-28a.jpg', '669669deb699d1721133534_winter-drop-28a.jpg', NULL),
(233, 45, '66966a157d1571721133589_product-3.jpg', '66966a157d1571721133589_product-3.jpg', '66966a157d1571721133589_product-3.jpg', NULL),
(234, 45, '66966a25be1311721133605_winter-drop-16a.jpg', '66966a25be1311721133605_winter-drop-16a.jpg', '66966a25be1311721133605_winter-drop-16a.jpg', NULL),
(235, 46, '66966a3c321321721133628_product-2.jpg', '66966a3c321321721133628_product-2.jpg', '66966a3c321321721133628_product-2.jpg', NULL),
(236, 46, '66966a41da85d1721133633_single-product-1.jpg', '66966a41da85d1721133633_single-product-1.jpg', '66966a41da85d1721133633_single-product-1.jpg', NULL),
(237, 47, '66966b28322071721133864_product-6.jpg', '66966b28322071721133864_product-6.jpg', '66966b28322071721133864_product-6.jpg', NULL),
(238, 48, '66966eeabd1331721134826_product-5.jpg', '66966eeabd1331721134826_product-5.jpg', '66966eeabd1331721134826_product-5.jpg', NULL),
(239, 48, '66966ef73c2841721134839_winter-drop-21b.jpg', '66966ef73c2841721134839_winter-drop-21b.jpg', '66966ef73c2841721134839_winter-drop-21b.jpg', NULL),
(240, 49, '66966f48a569f1721134920_product-6.jpg', '66966f48a569f1721134920_product-6.jpg', '66966f48a569f1721134920_product-6.jpg', NULL),
(241, 50, '66966f5e2a37a1721134942_product-1.jpg', '66966f5e2a37a1721134942_product-1.jpg', '66966f5e2a37a1721134942_product-1.jpg', NULL),
(242, 50, '66966f66917821721134950_winter-drop-15b.jpg', '66966f66917821721134950_winter-drop-15b.jpg', '66966f66917821721134950_winter-drop-15b.jpg', NULL),
(243, 51, '66966f76024501721134966_product-2.jpg', '66966f76024501721134966_product-2.jpg', '66966f76024501721134966_product-2.jpg', NULL),
(244, 52, '66966f85734671721134981_product-1.jpg', '66966f85734671721134981_product-1.jpg', '66966f85734671721134981_product-1.jpg', NULL),
(245, 53, '66966f93c689c1721134995_product-3.jpg', '66966f93c689c1721134995_product-3.jpg', '66966f93c689c1721134995_product-3.jpg', NULL),
(246, 53, '66966f995e8e21721135001_winter-drop-16a.jpg', '66966f995e8e21721135001_winter-drop-16a.jpg', '66966f995e8e21721135001_winter-drop-16a.jpg', NULL),
(247, 54, '66967fdd1027a1721139165_product-2.jpg', '66967fdd1027a1721139165_product-2.jpg', '66967fdd1027a1721139165_product-2.jpg', NULL),
(248, 54, '66967fe0c138a1721139168_single-product-1.jpg', '66967fe0c138a1721139168_single-product-1.jpg', '66967fe0c138a1721139168_single-product-1.jpg', NULL),
(249, 55, '66967ffd9a0bb1721139197_product-5.jpg', '66967ffd9a0bb1721139197_product-5.jpg', '66967ffd9a0bb1721139197_product-5.jpg', NULL),
(250, 56, '6696800d665291721139213_product-6.jpg', '6696800d665291721139213_product-6.jpg', '6696800d665291721139213_product-6.jpg', NULL),
(251, 56, '66968018db4bb1721139224_winter-drop-23b.jpg', '66968018db4bb1721139224_winter-drop-23b.jpg', '66968018db4bb1721139224_winter-drop-23b.jpg', NULL),
(252, 57, '6696818816d661721139592_product-3.jpg', '6696818816d661721139592_product-3.jpg', '6696818816d661721139592_product-3.jpg', NULL),
(253, 58, '669681a1857861721139617_product-4.jpg', '669681a1857861721139617_product-4.jpg', '669681a1857861721139617_product-4.jpg', NULL),
(254, 58, '669681aac1d031721139626_winter-drop-28b.jpg', '669681aac1d031721139626_winter-drop-28b.jpg', '669681aac1d031721139626_winter-drop-28b.jpg', NULL),
(255, 59, '669681be9a91f1721139646_product-2.jpg', '669681be9a91f1721139646_product-2.jpg', '669681be9a91f1721139646_product-2.jpg', NULL),
(256, 59, '669681c8262741721139656_single-product-5.jpg', '669681c8262741721139656_single-product-5.jpg', '669681c8262741721139656_single-product-5.jpg', NULL),
(260, 60, '669684295f1b11721140265_product-5.jpg', '669684295f1b11721140265_product-5.jpg', '669684295f1b11721140265_product-5.jpg', NULL),
(261, 60, '669684345baf41721140276_winter-drop-21a.jpg', '669684345baf41721140276_winter-drop-21a.jpg', '669684345baf41721140276_winter-drop-21a.jpg', NULL),
(262, 61, '66968451a57b81721140305_product-3.jpg', '66968451a57b81721140305_product-3.jpg', '66968451a57b81721140305_product-3.jpg', NULL),
(263, 62, '669684776dd4a1721140343_product-2.jpg', '669684776dd4a1721140343_product-2.jpg', '669684776dd4a1721140343_product-2.jpg', NULL),
(264, 62, '6696847b7ba1d1721140347_single-product-1.jpg', '6696847b7ba1d1721140347_single-product-1.jpg', '6696847b7ba1d1721140347_single-product-1.jpg', NULL),
(267, 34, '67cc2a5b2ac111741433435_winter-drop-6a.jpg', '67cc2a5b2ac111741433435_winter-drop-6a.jpg', '67cc2a5b2ac111741433435_winter-drop-6a.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(5, 26, 100, '2024-06-20 15:37:36', NULL),
(6, 27, 12, '2024-06-20 15:46:30', NULL),
(13, 34, 10, '2024-06-30 12:26:45', '2025-03-08 11:30:40'),
(14, 35, 10, '2024-06-30 12:38:15', NULL),
(15, 36, 10, '2024-06-30 12:51:11', NULL),
(16, 37, 10, '2024-06-30 12:52:09', NULL),
(17, 38, 10, '2024-06-30 12:53:01', NULL),
(18, 39, 10, '2024-06-30 12:53:45', NULL),
(20, 41, 10, '2024-06-30 13:00:33', NULL),
(21, 60, 5, NULL, '2024-07-16 15:31:18'),
(22, 61, 10, NULL, NULL),
(23, 62, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pwd_reset`
--

CREATE TABLE `pwd_reset` (
  `id` int(11) NOT NULL,
  `pwd_reset_email` varchar(255) NOT NULL,
  `pwd_reset_selector` text NOT NULL,
  `pwd_reset_token` text NOT NULL,
  `pwd_reset_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) DEFAULT NULL,
  `title_tag` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `sitename`, `title_tag`, `meta_description`, `copyright_text`, `contact`) VALUES
(1, 'SharkTropic', 'SharkTropic', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 'Coypright © Website', 'contact@website.com');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_email_setup`
--

CREATE TABLE `smtp_email_setup` (
  `id` int(11) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_encryption` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `smtp_email_setup`
--

INSERT INTO `smtp_email_setup` (`id`, `smtp_host`, `smtp_encryption`, `smtp_port`, `username`, `pwd`) VALUES
(1, 'smtp.gmail.com', 'SSL', '465', 'testemail6329@gmail.com', 'ffscmltnjhwnxwnw'),
(2, 'smtp.gmail.com', 'SSL', '465', 'testemail6329@gmail.com', 'ffscmltnjhwnxwnw');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subscriber_type` varchar(255) DEFAULT NULL,
  `subscriber_status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `notify` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `phone`, `subscriber_type`, `subscriber_status`, `created_at`, `notify`) VALUES
(1, 'marvinmckinney@example.com', NULL, 'email', 'approved', '2024-12-26 12:53:08', 'Yes'),
(2, 'annetteblack@example.com', NULL, 'email', 'approved', '2024-12-26 12:53:08', 'Yes'),
(3, 'estherhoward@example.com', NULL, 'email', 'approved', '2024-12-26 12:53:08', 'No'),
(7, 'testemail6330@gmail.com', NULL, 'email', 'approved', '2025-01-18 11:51:35', 'Yes'),
(39, NULL, '+8801886898669', 'phone', 'approved', '2025-01-19 14:21:20', 'Yes'),
(40, NULL, 'shadmanwebdev@gmail.com', 'email', 'pending', '2025-02-04 13:45:47', 'Yes'),
(41, NULL, 'shadmanwebdev@gmail.com', 'email', 'pending', '2025-02-04 13:51:54', 'Yes'),
(42, NULL, 'shadmanwebdev@gmail.com', 'email', 'pending', '2025-02-04 14:04:01', 'Yes'),
(43, NULL, 'shadmanwebdev@gmail.com', 'email', 'pending', '2025-02-04 14:06:43', 'Yes'),
(44, NULL, 'shadmanwebdev@gmail.com', 'email', 'pending', '2025-02-04 14:10:51', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_message`
--

CREATE TABLE `subscriber_message` (
  `id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subscriber_message`
--

INSERT INTO `subscriber_message` (`id`, `subscriber_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'Welcome to Our Newsletter', 'Hi Marvin McKinney, thank you for subscribing to our newsletter! Stay tuned for exciting updates.', '2025-01-05 05:01:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `user_status` varchar(255) DEFAULT 'member',
  `account_status` varchar(255) DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `fullname`, `email`, `pwd`, `photo`, `user_status`, `account_status`, `created_at`, `updated_at`) VALUES
(11, NULL, 'test', 'testemail6330@gmail.com', '$2y$11$5XkghAhnYwwSJfYkdL/dDezqc3Bf1VjwlEzeLjFnOBVgrx7HoaqLa', NULL, 'admin', 'verified', '2025-01-13 11:44:33', '2025-01-13 11:44:33'),
(24, '105767686365495286609', 'shadman webdev', 'shadmanwebdev@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocISpfwjp_wFDLS-jCdqWDFtRIJRdJhNELE2rF_AD8fshxtW6w=s96-c', 'member', 'pending', '2025-03-09 10:58:53', '2025-03-09 11:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `verify_email`
--

CREATE TABLE `verify_email` (
  `id` int(11) NOT NULL,
  `vrf_email` varchar(255) NOT NULL,
  `vrf_selector` text NOT NULL,
  `vrf_token` text NOT NULL,
  `vrf_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offer` (`offer`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_images`
--
ALTER TABLE `donation_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verify`
--
ALTER TABLE `email_verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_verify`
--
ALTER TABLE `login_verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_images`
--
ALTER TABLE `news_images`
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
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_sold`
--
ALTER TABLE `products_sold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_email_setup`
--
ALTER TABLE `smtp_email_setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subscriber_message`
--
ALTER TABLE `subscriber_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_email`
--
ALTER TABLE `verify_email`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `donation_images`
--
ALTER TABLE `donation_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `email_verify`
--
ALTER TABLE `email_verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_verify`
--
ALTER TABLE `login_verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news_images`
--
ALTER TABLE `news_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `products_sold`
--
ALTER TABLE `products_sold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp_email_setup`
--
ALTER TABLE `smtp_email_setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `subscriber_message`
--
ALTER TABLE `subscriber_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `verify_email`
--
ALTER TABLE `verify_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
