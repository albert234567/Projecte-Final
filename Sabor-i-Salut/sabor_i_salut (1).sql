-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2025 a las 20:46:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sabor_i_salut`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentari_menus`
--

CREATE TABLE `comentari_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuari_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `comentari` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentari_menus`
--

INSERT INTO `comentari_menus` (`id`, `usuari_id`, `menu_id`, `comentari`, `created_at`, `updated_at`) VALUES
(1, 3, 29, 'Aquest menu m\'ha agradat molt pero m ha sobrat el plat de Timbal de verdures rostides amb pesto', '2025-05-26 14:45:28', '2025-05-26 14:45:28'),
(2, 3, 29, 'Per cert la amanida estava molt bona', '2025-05-26 14:47:30', '2025-05-26 14:47:30'),
(3, 3, 29, 'be', '2025-05-26 14:49:43', '2025-05-26 14:49:43'),
(4, 3, 30, 'M\'encanta el carabassó', '2025-05-26 15:10:27', '2025-05-26 15:10:27'),
(5, 3, 30, 'Gracies', '2025-05-26 15:14:48', '2025-05-26 15:14:48'),
(6, 2, 31, 'Gracies per el menu sense lactosa', '2025-05-26 15:21:21', '2025-05-26 15:21:21'),
(7, 2, 32, 'M ha agradat la pizza', '2025-05-26 15:21:38', '2025-05-26 15:21:38'),
(8, 2, 32, 'no m ha agradat', '2025-05-27 14:40:29', '2025-05-27 14:40:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nutricionista_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `descripcio` text NOT NULL,
  `plats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`plats`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nutricionista_id`, `client_id`, `descripcio`, `plats`, `created_at`, `updated_at`) VALUES
(29, 1, 3, 'Menu vegetal sense fruits secs', '\"{\\\"esmorzar\\\":[\\\"143\\\"],\\\"dinar\\\":[\\\"124\\\"],\\\"berenar\\\":[\\\"160\\\"],\\\"sopar\\\":[\\\"115\\\"]}\"', '2025-06-09 22:00:00', NULL),
(30, 1, 3, 'Menu de carabassó', '\"{\\\"esmorzar\\\":[\\\"118\\\"],\\\"dinar\\\":[\\\"115\\\"],\\\"berenar\\\":[\\\"121\\\"],\\\"sopar\\\":[\\\"119\\\"]}\"', '2025-05-26 15:09:34', '2025-05-26 15:09:34'),
(31, 1, 2, 'Vega sense lactosa', '\"{\\\"esmorzar\\\":[\\\"117\\\"],\\\"dinar\\\":[\\\"115\\\"],\\\"berenar\\\":[\\\"123\\\"],\\\"sopar\\\":[\\\"137\\\"],\\\"asignar\\\":[\\\"116\\\",\\\"115\\\"]}\"', '2025-05-19 22:00:00', NULL),
(32, 1, 2, 'Sense gluten per el millor', '\"{\\\"esmorzar\\\":[\\\"144\\\"],\\\"dinar\\\":[\\\"154\\\"],\\\"berenar\\\":[\\\"158\\\"],\\\"sopar\\\":[\\\"137\\\"],\\\"asignar\\\":[\\\"115\\\"]}\"', '2025-06-07 22:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '2025_05_23_114816_create_plats_table', 1),
(26, '2025_05_23_120648_add_fields_to_plats_table', 1),
(34, '2014_10_12_000000_create_users_table', 2),
(35, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(36, '2019_08_19_000000_create_failed_jobs_table', 2),
(37, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(38, '2025_02_25_153700_create_menus_table', 2),
(39, '2025_02_25_154422_add_rol_to_users_table', 2),
(40, '2025_05_19_205322_add_created_by_user_id_to_users_table', 2),
(41, '2025_05_23_143228_make_created_by_user_id_nullable_on_users_table', 3),
(42, '2025_05_25_145633_add_quantitat_to_plats_table', 4),
(43, '2025_05_25_145747_add_quantitat_to_plats_table2', 5),
(44, '2025_05_26_162741_create_comentari_menus_table', 6),
(45, '2025_05_27_183300_add_premium_to_users_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
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
-- Estructura de tabla para la tabla `plats`
--

CREATE TABLE `plats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `descripcio` text DEFAULT NULL,
  `quantitat` varchar(255) DEFAULT NULL,
  `tipus` varchar(255) DEFAULT NULL,
  `vega` tinyint(1) NOT NULL DEFAULT 0,
  `intolerancies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`intolerancies`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plats`
--

INSERT INTO `plats` (`id`, `nom`, `descripcio`, `quantitat`, `tipus`, `vega`, `intolerancies`, `created_at`, `updated_at`) VALUES
(115, 'Sopa de carbassa i gingebre', 'Sopa cremosa de carbassa amb un toc de gingebre fresc', '250ml', 'dinar', 1, '[\"Sense lactosa\",\"Sense gluten\",\"Sense fruits secs\"]', '2025-05-25 09:17:57', '2025-05-25 07:44:30'),
(116, 'Filet de pollastre a la planxa amb verdures al vapor', 'Pollastre fresc a la planxa acompanyat de bròquil, pastanaga i carbassó', '180g', 'Dinar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(117, 'Lluç al forn amb salsa de iogurt i herbes', 'Lluç fresc al forn amb salsa lleugera de iogurt, julivert i menta', '200g', 'dinar', 0, '[\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 07:33:35'),
(118, 'Crema de carbassó i api', 'Crema saludable de carbassó i api, sense lactosa', '250ml', 'esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 07:33:41'),
(119, 'Arròs integral amb verdures i tofu', 'Arròs integral amb tofu marinat i verdures de temporada', '300g', 'Dinar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(120, 'Truita d’espinacs i formatge fresc', 'Truita d’ous amb espinacs i formatge fresc baix en greix', '160g', 'Sopar', 0, '[\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(121, 'Amanida de llenties i verdures', 'Llenties cuites amb pebrot, ceba, tomàquet i vinagreta de mostassa', '220g', 'Esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(122, 'Salmó a la planxa amb salsa de mostassa', 'Filet de salmó a la planxa amb salsa de mostassa i mel', '200g', 'Sopar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(123, 'Iogurt natural amb fruits vermells', 'Iogurt natural sense sucre amb maduixes i nabius frescos', '125g', 'Berenar', 1, '[\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(124, 'Timbal de verdures rostides amb pesto', 'Capes de verdures rostides amb pesto de nous', '230g', 'Dinar', 1, '[\"Sense fruits secs\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(125, 'Bacallà a la mediterrània', 'Bacallà guisat amb tomàquet, pebrot i olives', '200g', 'Sopar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(126, 'Hummus casolà amb bastonets de pastanaga', 'Hummus fet amb cigrons i tahina, acompanyat de pastanaga fresca', '150g', 'Esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(127, 'Filet de vedella amb puré de coliflor', 'Vedella magra a la planxa amb puré de coliflor cremos', '230g', 'Dinar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(128, 'Paella de verdures', 'Paella amb arròs integral i verdures variades de temporada', '250g', 'Dinar', 1, '[\"Sense gluten\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(130, 'Pollastre al curry amb arròs basmati', 'Pollastre guisat amb espècies i arròs basmati', '200g', 'Dinar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(131, 'Amanida de rúcula, pera i formatge blau', 'Amanida fresca amb rúcula, pera, nous i formatge blau', '180g', 'Esmorzar', 0, '[\"Sense fruits secs\",\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(132, 'Tortilla de patata light', 'Truita tradicional de patata amb poc oli', '180g', 'Sopar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(133, 'Sopa miso amb tofu i algues', 'Sopa japonesa amb pasta miso, tofu i algues wakame', '300ml', 'Berenar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(134, 'Amanida de cigrons i tomàquet', 'Cigrons amb tomàquet, ceba i julivert fresc', '200g', 'Esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(135, 'Carxofes al forn amb all i julivert', 'Carxofes rostides amb all i julivert fresc', '180g', 'Berenar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(136, 'Llenties estofades amb verdures', 'Llenties cuinades amb pastanaga, ceba i tomàquet natural', '250g', 'Dinar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(137, 'Canelons de verdures amb beixamel light', 'Canelons farcits de verdures amb beixamel baixa en greix', '240g', 'Sopar', 1, '[\"Sense gluten\",\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(138, 'Timbal de moniato i carabassa', 'Capas de moniato i carabassa rostides amb espècies', '220g', 'Esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(139, 'Pollastre a la llimona amb quinoa', 'Pollastre al forn amb salsa de llimona i quinoa com a acompanyament', '200g', 'Dinar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(140, 'Brou vegetal casolà', 'Brou fet amb verdures fresques per a bases de sopa', '300ml', 'Berenar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(141, 'Salmó al papillote amb espàrrecs', 'Salmó cuinat al vapor amb espàrrecs frescos', '200g', 'Sopar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(142, 'Crema de xampinyons', 'Crema de bolets xampinyons sense lactosa', '250ml', 'Esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(143, 'Amanida de pastanaga i poma', 'Amanida fresca amb pastanaga ratllada, poma i nous', '180g', 'Esmorzar', 1, '[\"Sense fruits secs\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(144, 'Hamburguesa vegetal amb pa integral', 'Hamburguesa feta de llenties i verdures amb pa integral', '250g', 'Dinar', 1, '[\"Sense gluten\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(145, 'Truita d’albergínia i formatge', 'Truita amb albergínia rostida i formatge fresc', '170g', 'Sopar', 0, '[\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(146, 'Peix blanc amb salsa de verdures', 'Peix blanc al vapor amb salsa lleugera de verdures', '220g', 'Sopar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(147, 'Pasta integral amb salsa de tomàquet natural', 'Pasta integral amb salsa de tomàquet casolana i alfàbrega', '260g', 'Dinar', 1, '[\"Sense gluten\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(148, 'Iogurt grec amb mel i nous', 'Iogurt grec natural amb mel i nous', '150g', 'Esmorzar', 0, '[\"Sense lactosa\",\"Sense fruits secs\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(149, 'Amanida de remolatxa i formatge de cabra', 'Remolatxa rostida amb formatge de cabra i nous', '180g', 'Esmorzar', 0, '[\"Sense fruits secs\",\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(150, 'Cigrons amb espinacs', 'Cigrons guisats amb espinacs frescos i espècies', '230g', 'Dinar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(151, 'Pollastre al romesco', 'Pollastre al forn amb salsa romesco casolana', '200g', 'Sopar', 0, '[\"Sense fruits secs\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(152, 'Crema de carbassa i coco', 'Crema de carbassa amb llet de coco, sense lactosa', '250ml', 'Berenar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(153, 'Amanida tèbia de patata i ceba', 'Patata bullida amb ceba i oli d’oliva verge extra', '180g', 'Esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(154, 'Fideuà integral de verdures', 'Fideuà amb fideus integrals i verdures variades', '260g', 'Dinar', 1, '[\"Sense gluten\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(155, 'Salmó amb puré de moniato', 'Filet de salmó a la planxa amb puré de moniato', '200g', 'Sopar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(156, 'Carpaccio de carbassó amb parmesà', 'Carpaccio fresc de carbassó amb parmesà i pinyons', '170g', 'Esmorzar', 0, '[\"Sense fruits secs\",\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(157, 'Amanida de llenties i remolatxa', 'Llenties cuites amb remolatxa i ceba tendra', '200g', 'Esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(158, 'Pizza integral vegetal', 'Pizza amb base integral, tomàquet, verdures i mozzarella', '270g', 'Sopar', 0, '[\"Sense gluten\",\"Sense lactosa\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(159, 'Crema freda de meló i menta', 'Crema refrescant de meló amb menta fresca', '250ml', 'Berenar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(160, 'Amanida de kale i poma', 'Kale fresc amb poma, nous i vinagreta suau', '180g', 'Esmorzar', 1, '[\"Sense fruits secs\"]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(161, 'Truita de carabassó i ceba', 'Truita lleugera amb carabassó i ceba caramel·litzada', '170g', 'Sopar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(162, 'Brou de pollastre casolà', 'Brou casolà fet amb ossos i verdures', '300ml', 'Berenar', 0, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57'),
(163, 'Crema de pastanaga i gingebre', 'Crema saludable de pastanaga amb un toc de gingebre', '250ml', 'Esmorzar', 1, '[]', '2025-05-25 09:17:57', '2025-05-25 09:17:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'client',
  `premium` tinyint(1) DEFAULT NULL,
  `created_by_user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `rol`, `premium`, `created_by_user_id`) VALUES
(1, 'albertroigg', 'albertroiggg@gmail.com', NULL, '$2y$12$E6UMY1rbwdiJy99zMMKd..7uUuWqgKDrN041sCKHV2.7wj/ZIvVVK', NULL, '2025-05-23 12:42:38', '2025-05-23 12:42:38', 'nutricionista', NULL, NULL),
(2, 'Anton', 'anton@gmail.com', NULL, '$2y$12$ypjp/RyYOTlWKwEij330i.QSipQNRws80HTCPdpJ3njYoplzE0uMC', NULL, '2025-05-23 13:15:32', '2025-05-23 13:15:32', 'client', NULL, 1),
(3, 'Jaime', 'jaime@gmail.com', NULL, '$2y$12$KDEYbUyyNEv5g/4bTHXis.nwMczwqb3Fi4TeojUYvoQVSuv8t6YoK', NULL, '2025-05-23 13:17:53', '2025-05-23 13:17:53', 'client', NULL, 1),
(5, 'Oriol', 'oriol@gmail.com', NULL, '$2y$12$i8uQAKSHxb23H2nVkz7HW.vt2REVPqPZEso41eoacQzKmdE9xe9iy', NULL, '2025-05-27 16:38:22', '2025-05-27 16:38:22', 'client', NULL, 1),
(6, 'Laia', 'laia@gmail.com', NULL, '$2y$12$MmTSN0.oosz.z7IlnjPY4.Z5yrys2q/BhrpbQxg8qn467HPr0inaG', NULL, '2025-05-27 16:39:25', '2025-05-27 16:39:25', 'nutricionista', 1, NULL),
(7, 'client1', 'client1@gmail.com', NULL, '$2y$12$A0NLYI4wvLxHi797aVWaROik0P7xDSA2VmdbuVRpSSYJRVJS7t5Ki', NULL, '2025-05-27 16:42:13', '2025-05-27 16:42:13', 'client', NULL, 6),
(8, 'client2', 'client2@gmail.com', NULL, '$2y$12$MhfP4l56uFueWzZkIswNFeYP0XnXriw.6wC0KdnGq5jwy2y3hEJsq', NULL, '2025-05-27 16:42:30', '2025-05-27 16:42:30', 'client', NULL, 6),
(9, 'client3', 'client3@gmail.com', NULL, '$2y$12$Zu7ym7nAAQGuiyKavkON0OeGlbB3xvENBGaQ5KI.aT7HeSp.dj7eW', NULL, '2025-05-27 16:42:44', '2025-05-27 16:42:44', 'client', NULL, 6),
(10, 'client4', 'client4@gmail.com', NULL, '$2y$12$5S/qZGxCehKzjFVX2jBCGezgGchAl6D101zg/A/L/ZhMdQDJyUSrW', NULL, '2025-05-27 16:43:02', '2025-05-27 16:43:02', 'client', NULL, 6),
(11, 'client5', 'client5@gmail.com', NULL, '$2y$12$f.t7ard9pcgk2ZBBJD8fbuz4PDKKImlU9T7YKK2vAVGaPSXH4mkVu', NULL, '2025-05-27 16:43:26', '2025-05-27 16:43:26', 'client', NULL, 6),
(12, 'client6', 'client6@gmail.com', NULL, '$2y$12$YlVXuroJXFf5yPn6Yndeme3RhjJ1o.ZvqVjuU7Yc1P/MLv.XV4nKK', NULL, '2025-05-27 16:43:49', '2025-05-27 16:43:49', 'client', NULL, 6),
(13, 'client7', 'client7@gmail.com', NULL, '$2y$12$dmU8iDWahSQ.pywts.5SfezWWcT7N1QAathPkYId6uOSh74m3bmDq', NULL, '2025-05-27 16:44:06', '2025-05-27 16:44:06', 'client', NULL, 6),
(14, 'client8', 'client8@gmail.com', NULL, '$2y$12$bC3..u1.fEEpez19iWZ7beXRGXqbcAyVntmPHyVYPDkXfq0nOghXC', NULL, '2025-05-27 16:44:33', '2025-05-27 16:44:33', 'client', NULL, 6),
(15, 'client9', 'client9@gmail.com', NULL, '$2y$12$t0Y3hR9f.7HeTH0wmoWQzuQB9.roLubRFZ9fEMczW8WG40OqM9.A6', NULL, '2025-05-27 16:44:52', '2025-05-27 16:44:52', 'client', NULL, 6),
(16, 'client10', 'client10@gmail.com', NULL, '$2y$12$Hn8L14INQNtiHFNXkMOhou.wH2JP465K3YPIDIA3pZkKtNF.re5EC', NULL, '2025-05-27 16:45:12', '2025-05-27 16:45:12', 'client', NULL, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentari_menus`
--
ALTER TABLE `comentari_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentari_menus_usuari_id_foreign` (`usuari_id`),
  ADD KEY `comentari_menus_menu_id_foreign` (`menu_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_nutricionista_id_foreign` (`nutricionista_id`),
  ADD KEY `menus_client_id_foreign` (`client_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `plats`
--
ALTER TABLE `plats`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_user_id_index` (`created_by_user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentari_menus`
--
ALTER TABLE `comentari_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plats`
--
ALTER TABLE `plats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentari_menus`
--
ALTER TABLE `comentari_menus`
  ADD CONSTRAINT `comentari_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentari_menus_usuari_id_foreign` FOREIGN KEY (`usuari_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `menus_nutricionista_id_foreign` FOREIGN KEY (`nutricionista_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_user_id_foreign` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
