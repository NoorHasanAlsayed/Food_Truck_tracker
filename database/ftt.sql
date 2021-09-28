-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 05:49 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ftt`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pizza', NULL, NULL, NULL),
(2, 'Burger', '2021-05-12 14:29:08', '2021-05-12 14:29:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuisine_food_truck`
--

CREATE TABLE `cuisine_food_truck` (
  `food_truck_id` bigint(20) UNSIGNED NOT NULL,
  `cuisine_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuisine_food_truck`
--

INSERT INTO `cuisine_food_truck` (`food_truck_id`, `cuisine_id`) VALUES
(7, 1),
(9, 2),
(12, 2),
(13, 2),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'monday', NULL, NULL),
(3, 'tuesday', NULL, NULL),
(4, 'wednesday', NULL, NULL),
(5, 'thursday', NULL, NULL),
(6, 'friday', NULL, NULL),
(7, 'saturday', NULL, NULL),
(8, 'sunday', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `day_food_truck`
--

CREATE TABLE `day_food_truck` (
  `id` int(10) UNSIGNED NOT NULL,
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `food_truck_id` bigint(20) UNSIGNED NOT NULL,
  `from_hours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_minutes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_hours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_minutes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `day_food_truck`
--

INSERT INTO `day_food_truck` (`id`, `day_id`, `food_truck_id`, `from_hours`, `from_minutes`, `to_hours`, `to_minutes`) VALUES
(7, 2, 12, '15', '00', '23', '30'),
(8, 2, 13, '15', '00', '23', '30'),
(9, 2, 15, '07', '30', '00', '30'),
(10, 2, 16, '07', '30', '00', '30'),
(11, 2, 17, '07', '30', '00', '30'),
(12, 2, 18, '07', '30', '00', '30'),
(13, 2, 19, '20', '30', '20', '30');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'setteing area', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feature_food_truck`
--

CREATE TABLE `feature_food_truck` (
  `food_truck_id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_food_truck`
--

INSERT INTO `feature_food_truck` (`food_truck_id`, `feature_id`) VALUES
(9, 1),
(12, 1),
(19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_trucks`
--

CREATE TABLE `food_trucks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_trucks`
--

INSERT INTO `food_trucks` (`id`, `name`, `latitude`, `longitude`, `address`, `active`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(7, 'Monster Food Truck', '26.1604429', '50.610433199999996', NULL, NULL, '2021-05-06 19:50:25', '2021-05-06 19:50:25', NULL, NULL),
(9, 'Bon Burger', '26.2056522', '50.6017292', 'Juffair', 'Active', '2021-05-10 15:00:57', '2021-05-10 15:00:57', NULL, 2),
(10, 'Monster Food Truck', '26.1604802', '50.610425899999996', 'sitra', NULL, '2021-05-20 17:08:42', '2021-05-20 17:08:42', NULL, NULL),
(11, 'b', '26.1604684', '50.6104384', 'Manama 300 road 23', NULL, '2021-05-20 17:12:19', '2021-05-20 17:12:19', NULL, NULL),
(12, 'b', NULL, NULL, 'Manama 300 road 23', NULL, '2021-05-20 17:20:04', '2021-05-20 17:20:04', NULL, NULL),
(13, 'Monster Food Truck889', '26.160443899999997', '50.610428999999996', NULL, NULL, '2021-05-20 17:27:16', '2021-05-20 17:27:16', NULL, 3),
(14, 'Monster Food Truck77', '26.160456099999998', '50.610436899999996', NULL, NULL, '2021-05-20 17:33:43', '2021-05-20 17:33:43', NULL, 3),
(15, 'food_trucks_tracker', '26.160448199999998', '50.6104816', NULL, NULL, '2021-05-20 17:34:59', '2021-05-20 17:34:59', NULL, 3),
(16, 'food_trucks_tracker', NULL, NULL, NULL, NULL, '2021-05-20 17:48:55', '2021-05-20 17:48:55', NULL, 3),
(17, 'food_trucks_tracker', NULL, NULL, NULL, NULL, '2021-05-20 17:53:32', '2021-05-20 17:53:32', NULL, 3),
(18, 'food_trucks_trackerknkn', NULL, NULL, NULL, NULL, '2021-05-20 18:51:21', '2021-05-20 18:51:21', NULL, 3),
(19, 'food_trucks_tracker', '26.160384600000004', '50.6104208', 'Manama 300 road 23', NULL, '2021-05-24 04:24:48', '2021-05-24 04:24:48', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\FoodTruck', 1, '9dc762ed-455f-4da9-b100-8dcaeadbd70f', 'image', '608df0bfa9d3c_monster_food_truck_by_fitzfactor_dc8p8co-fullview', '608df0bfa9d3c_monster_food_truck_by_fitzfactor_dc8p8co-fullview.jpg', 'image/jpeg', 'public', 'public', 112177, '[]', '{\"generated_conversions\":{\"thumb\":true,\"preview\":true}}', '[]', 1, '2021-05-01 21:22:40', '2021-05-01 21:22:42'),
(2, 'App\\Models\\FoodTruck', 2, '8298ab20-f906-4ce5-9587-2a11add66c91', 'image', '608df1730b3ba_monster_food_truck_by_fitzfactor_dc8p8co-fullview', '608df1730b3ba_monster_food_truck_by_fitzfactor_dc8p8co-fullview.jpg', 'image/jpeg', 'public', 'public', 112177, '[]', '{\"generated_conversions\":{\"thumb\":true,\"preview\":true}}', '[]', 2, '2021-05-01 21:25:51', '2021-05-01 21:25:52'),
(3, 'App\\Models\\FoodTruck', 5, 'c01e040e-1096-4a27-8bfb-99521cf34cf1', 'image', '60946ca6d6add_monster_food_truck_by_fitzfactor_dc8p8co-fullview', '60946ca6d6add_monster_food_truck_by_fitzfactor_dc8p8co-fullview.jpg', 'image/jpeg', 'public', 'public', 112177, '[]', '{\"generated_conversions\":{\"thumb\":true,\"preview\":true}}', '[]', 3, '2021-05-06 19:25:03', '2021-05-06 19:25:05'),
(4, 'App\\Models\\FoodTruck', 8, '1bd77aa9-eb78-4179-925c-e8b2c31e13b6', 'image', '6094aca93c518_monster_food_truck_by_fitzfactor_dc8p8co-fullview', '6094aca93c518_monster_food_truck_by_fitzfactor_dc8p8co-fullview.jpg', 'image/jpeg', 'public', 'public', 112177, '[]', '{\"generated_conversions\":{\"thumb\":true,\"preview\":true}}', '[]', 4, '2021-05-06 23:58:12', '2021-05-06 23:58:13'),
(5, 'App\\Models\\FoodTruck', 9, 'e8a91197-da89-4908-9e17-bbfcd670a570', 'image', '60997496cfb1a_download', '60997496cfb1a_download.jpg', 'image/jpeg', 'public', 'public', 6423, '[]', '{\"generated_conversions\":{\"thumb\":true,\"preview\":true}}', '[]', 5, '2021-05-10 15:00:59', '2021-05-10 15:01:04'),
(6, 'App\\Models\\FoodTruck', 13, '71ae7a1c-e6bb-4e28-ac1c-1abcd85677c6', 'image', '60a6c60bb4626_download', '60a6c60bb4626_download.jpg', 'image/jpeg', 'public', 'public', 6423, '[]', '{\"generated_conversions\":{\"thumb\":true,\"preview\":true}}', '[]', 6, '2021-05-20 17:27:16', '2021-05-20 17:27:17'),
(7, 'App\\Models\\FoodTruck', 15, '00ad88e3-ecec-480d-94ca-c61cc83ebb6b', 'image', '60a6c7e19f3f9_download', '60a6c7e19f3f9_download.jpg', 'image/jpeg', 'public', 'public', 6423, '[]', '{\"generated_conversions\":{\"thumb\":true,\"preview\":true}}', '[]', 7, '2021-05-20 17:34:59', '2021-05-20 17:35:00'),
(8, 'App\\Models\\FoodTruck', 19, 'bcd886a9-60c1-41d4-944f-a50fd9f61c65', 'image', '60ab54a9c937d_Software_Design', '60ab54a9c937d_Software_Design.jpg', 'image/png', 'public', 'public', 1087, '[]', '{\"generated_conversions\":{\"thumb\":true,\"preview\":true}}', '[]', 8, '2021-05-24 04:24:49', '2021-05-24 04:24:51');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2021_05_01_000001_create_media_table', 1),
(4, '2021_05_01_000002_create_permissions_table', 1),
(5, '2021_05_01_000003_create_roles_table', 1),
(6, '2021_05_01_000004_create_users_table', 1),
(7, '2021_05_01_000005_create_cuisines_table', 1),
(8, '2021_05_01_000006_create_features_table', 1),
(9, '2021_05_01_000007_create_food_trucks_table', 1),
(10, '2021_05_01_000008_create_reviews_table', 1),
(11, '2021_05_01_000009_create_permission_role_pivot_table', 1),
(12, '2021_05_01_000010_create_role_user_pivot_table', 1),
(13, '2021_05_01_000011_create_cuisine_food_truck_pivot_table', 1),
(14, '2021_05_01_000012_create_feature_food_truck_pivot_table', 1),
(15, '2021_05_01_000013_add_relationship_fields_to_food_trucks_table', 1),
(16, '2021_05_01_000014_add_relationship_fields_to_reviews_table', 1),
(17, '2021_05_01_030822_create_days_table', 2),
(18, '2021_05_01_031850_create-day_food_trruck_povit_table', 2);

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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'assest_managment_access', NULL, NULL, NULL),
(18, 'cuisine_create', NULL, NULL, NULL),
(19, 'cuisine_edit', NULL, NULL, NULL),
(20, 'cuisine_show', NULL, NULL, NULL),
(21, 'cuisine_delete', NULL, NULL, NULL),
(22, 'cuisine_access', NULL, NULL, NULL),
(23, 'feature_create', NULL, NULL, NULL),
(24, 'feature_edit', NULL, NULL, NULL),
(25, 'feature_show', NULL, NULL, NULL),
(26, 'feature_delete', NULL, NULL, NULL),
(27, 'feature_access', NULL, NULL, NULL),
(28, 'food_truck_create', NULL, NULL, NULL),
(29, 'food_truck_edit', NULL, NULL, NULL),
(30, 'food_truck_show', NULL, NULL, NULL),
(31, 'food_truck_delete', NULL, NULL, NULL),
(32, 'food_truck_access', NULL, NULL, NULL),
(33, 'review_create', NULL, NULL, NULL),
(34, 'review_edit', NULL, NULL, NULL),
(35, 'review_show', NULL, NULL, NULL),
(36, 'review_delete', NULL, NULL, NULL),
(37, 'review_access', NULL, NULL, NULL),
(38, 'profile_password_edit', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 35),
(2, 37),
(2, 38),
(3, 33),
(3, 34),
(3, 28),
(3, 38);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) NOT NULL,
  `rate` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `rate`, `body`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `truck_id`) VALUES
(1, 5, 'good', '2021-05-09 23:15:26', '2021-05-09 23:15:26', NULL, 1, 5),
(2, 5, 'good', '2021-05-09 20:34:50', '2021-05-09 20:34:50', NULL, 1, 2),
(3, 5, 'Excellent', '2021-05-10 19:54:38', '2021-05-10 19:54:38', NULL, 1, 5),
(4, 1, 'the food is not fresh', '2021-05-10 20:06:19', '2021-05-10 20:06:19', NULL, 1, 5),
(5, 5, 'Excellent', '2021-05-19 04:29:12', '2021-05-19 04:29:12', NULL, 3, 9),
(6, 4, 'the food is not fresh', '2021-05-19 04:43:14', '2021-05-19 04:43:14', NULL, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'Owner', NULL, '2021-05-12 14:30:54', NULL),
(3, 'User', '2021-05-12 14:32:48', '2021-05-12 14:32:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `food_truck_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `dob`, `contact_number`, `created_at`, `updated_at`, `deleted_at`, `food_truck_id`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$eHAcXJIK/9HYY.v0WDns8.f9oODKI0uDOCcyQ.JvkwWz6zRr1gl0.', NULL, NULL, '', NULL, NULL, NULL, 0),
(2, 'MJ', 'mj@gmail.com', NULL, '$2y$10$eYAAfSE2djW2UF1ViU7GZuPA3MFG8NfDIALoQgwe5b12SDmKzS/RW', NULL, '1983-10-20', '39898980', '2021-05-12 14:34:11', '2021-05-12 14:34:11', NULL, 9),
(3, 'Mariam', 'm@gmail.com', NULL, '$2y$10$7AdhZSjdl.NvYDexgnxupujMiFkLB1sH4/gzmEFH4kgHsgWMBnpSi', NULL, '2006-02-22', '37787980', '2021-05-12 14:35:21', '2021-05-24 04:24:48', NULL, 19),
(4, 'Hamad Salman', 'h@gmail.com', NULL, '$2y$10$y2lBAykREKrll4irNCsAvOtfkB92HLiec/AoZXtlLbuPeGLa9nLyy', NULL, NULL, NULL, '2021-05-12 17:08:59', '2021-05-12 17:08:59', NULL, NULL),
(5, 'Mohamed Ebhrain', 'mohd@gmail.com', NULL, '$2y$10$SeFkjTLaduqbuc3c2sWe8.TveekLj0xep0A5ECWdhX8AbkGGjqKau', NULL, NULL, NULL, '2021-05-12 17:12:52', '2021-05-12 17:12:52', NULL, NULL),
(6, 'Mohamed Ebhrain', 'mod@gmail.com', NULL, '$2y$10$u8tyChyHNijLw9LqDmOqcuPWfRSMEioEjAtZ6Dt3tGKZJEOmTiXH.', NULL, NULL, NULL, '2021-05-12 17:20:42', '2021-05-12 17:20:42', NULL, NULL),
(7, 'cc', 'c@n.com', NULL, '$2y$10$yu9.CNMzIZbFMaCOBED2peScAhhTXrticN/NubtmMrju6xeFvASo.', NULL, NULL, NULL, '2021-05-12 17:22:32', '2021-05-18 21:02:10', '2021-05-18 21:02:10', NULL),
(8, 'hg', 'g@g.com', NULL, '$2y$10$tLs4l9RJMuZ5QqkmNYFGlexN.9.FvPCes1oNXDGx88ongo8wWAUAy', NULL, NULL, NULL, '2021-05-12 17:23:50', '2021-05-18 21:02:07', '2021-05-18 21:02:07', NULL),
(9, 'hjg', 'nm@nm.com', NULL, '$2y$10$UUdJZsf.ttAGFmwUmviFneWwKPUwbNshei/144gTDBzMUuSOqgvHO', NULL, NULL, NULL, '2021-05-12 17:30:20', '2021-05-18 21:02:04', '2021-05-18 21:02:04', NULL),
(10, 'hgyi', 'd3@g.com', NULL, '$2y$10$X5ZEOSX.mhJ2ae2cTuY6tuUBj7xWOXJOgditbujsUL/.1k4MrXFWS', NULL, NULL, NULL, '2021-05-12 17:31:35', '2021-05-18 21:02:00', '2021-05-18 21:02:00', NULL),
(11, 'j', 'j@gmail.com', NULL, '$2y$10$/XVXYFULjMZNA70VVw70Au0cw1o/XYvQF8.UI3AvrC03ebRW/4DHO', NULL, NULL, NULL, '2021-05-12 17:33:56', '2021-05-18 21:01:57', '2021-05-18 21:01:57', NULL),
(12, 'hk', 'hk@j.com', NULL, '$2y$10$Y2tlTrm6ug5d6sh3/1HwMOBnKDfer8w29SReI8lL1cmV9j8P7CvTW', NULL, NULL, NULL, '2021-05-12 17:37:17', '2021-05-18 21:01:54', '2021-05-18 21:01:54', NULL),
(13, 'b', 'b@nb.com', NULL, '$2y$10$5duiU5XX3UfdQK7YOPJ0O.EUK0VZd/xmln7uC/GDt4xPMv4e9xubi', NULL, NULL, NULL, '2021-05-15 20:39:17', '2021-05-18 21:01:44', '2021-05-18 21:01:44', NULL),
(14, 'Noor Alsayed', 'noor.alsayeds3@gmail.com', NULL, '$2y$10$kenxutt2yssf3fMXzStcuOt2QIWrOfldfunUiqgMhwU6Wogl9JZWq', NULL, NULL, NULL, '2021-05-15 20:40:40', '2021-05-18 21:01:50', '2021-05-18 21:01:50', NULL),
(15, 'Noor Hasan', 'systemadmin@smils.com', NULL, '$2y$10$M6cWA3BlZFdlqec2naX76OY9onct2mwUrhMMc1SFHnt3DgT/h4Zz2', NULL, NULL, NULL, '2021-05-15 20:41:29', '2021-05-18 21:01:47', '2021-05-18 21:01:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuisines_name_unique` (`name`);

--
-- Indexes for table `cuisine_food_truck`
--
ALTER TABLE `cuisine_food_truck`
  ADD KEY `food_truck_id_fk_3748109` (`food_truck_id`),
  ADD KEY `cuisine_id_fk_3748109` (`cuisine_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `day_food_truck`
--
ALTER TABLE `day_food_truck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day_food_truck_day_id_foreign` (`day_id`),
  ADD KEY `day_food_truck_food_truck_id_foreign` (`food_truck_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `features_name_unique` (`name`);

--
-- Indexes for table `feature_food_truck`
--
ALTER TABLE `feature_food_truck`
  ADD KEY `food_truck_id_fk_3748110` (`food_truck_id`),
  ADD KEY `feature_id_fk_3748110` (`feature_id`);

--
-- Indexes for table `food_trucks`
--
ALTER TABLE `food_trucks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_3748283` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_3746866` (`role_id`),
  ADD KEY `permission_id_fk_3746866` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_3746875` (`user_id`),
  ADD KEY `role_id_fk_3746875` (`role_id`);

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
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `day_food_truck`
--
ALTER TABLE `day_food_truck`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_trucks`
--
ALTER TABLE `food_trucks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuisine_food_truck`
--
ALTER TABLE `cuisine_food_truck`
  ADD CONSTRAINT `cuisine_id_fk_3748109` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_truck_id_fk_3748109` FOREIGN KEY (`food_truck_id`) REFERENCES `food_trucks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `day_food_truck`
--
ALTER TABLE `day_food_truck`
  ADD CONSTRAINT `day_food_truck_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `day_food_truck_food_truck_id_foreign` FOREIGN KEY (`food_truck_id`) REFERENCES `food_trucks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_food_truck`
--
ALTER TABLE `feature_food_truck`
  ADD CONSTRAINT `feature_id_fk_3748110` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_truck_id_fk_3748110` FOREIGN KEY (`food_truck_id`) REFERENCES `food_trucks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food_trucks`
--
ALTER TABLE `food_trucks`
  ADD CONSTRAINT `user_fk_3748283` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_3746866` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_3746866` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_fk_3746875` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_3746875` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
