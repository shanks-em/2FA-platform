-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 31 mars 2026 à 20:43
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `double_auth`
--

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(500) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `applications`
--

INSERT INTO `applications` (`id`, `username`, `email`, `password`, `token`, `is_active`, `created_at`) VALUES
(15, 'admin', 'fadilmoussi1250@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'a82392b0f35dd1d75788c9937259a93fe6d22f48aeb32cf3ac7eabab943d2fdb', 1, '2026-03-29 16:45:37');

-- --------------------------------------------------------

--
-- Structure de la table `otpcodes`
--

CREATE TABLE `otpcodes` (
  `id` int(11) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `otp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `expires_at` datetime NOT NULL,
  `app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `otpcodes`
--

INSERT INTO `otpcodes` (`id`, `whatsapp`, `user_email`, `otp`, `created_at`, `is_used`, `expires_at`, `app_id`) VALUES
(1, '+22960000000', 'utilisateur@gmail.com', 744270, '2026-03-22 19:05:06', 0, '2026-03-22 19:15:06', 8),
(2, '+22960000000', 'utilisateur@gmail.com', 721991, '2026-03-22 19:53:38', 0, '2026-03-22 20:03:38', 8),
(3, '+22960000000', 'utilisateur@gmail.com', 269850, '2026-03-22 19:58:50', 0, '2026-03-22 20:08:50', 8),
(4, '+22960000000', 'utilisateur@gmail.com', 509772, '2026-03-22 19:59:16', 0, '2026-03-22 20:09:16', 8),
(5, '+22960000000', 'utilisateur@gmail.com', 113848, '2026-03-22 19:59:48', 0, '2026-03-22 20:09:48', 8),
(6, '+22960000000', 'utilisateur@gmail.com', 882421, '2026-03-22 20:00:51', 0, '2026-03-22 20:10:51', 8),
(7, '+22960000000', 'utilisateur@gmail.com', 470375, '2026-03-22 20:01:46', 0, '2026-03-22 20:11:46', 8),
(8, '+22960000000', 'utilisateur@gmail.com', 922458, '2026-03-22 20:42:39', 0, '2026-03-22 20:52:39', 8),
(9, '+22960000000', 'utilisateur@gmail.com', 234680, '2026-03-22 20:44:22', 0, '2026-03-22 20:54:22', 8),
(10, '+22960000000', 'utilisateur@gmail.com', 152595, '2026-03-22 20:45:21', 0, '2026-03-22 20:55:21', 8),
(11, '+22960000000', 'utilisateur@gmail.com', 884369, '2026-03-22 20:46:43', 0, '2026-03-22 20:56:43', 8),
(12, '+22960000000', 'utilisateur@gmail.com', 777390, '2026-03-22 20:49:02', 0, '2026-03-22 20:59:02', 8),
(13, '+22960000000', 'fadilmoussi1250@gmail.com', 731698, '2026-03-22 20:50:18', 0, '2026-03-22 21:00:18', 8),
(14, '+22960000000', 'fadilmoussi1250@gmail.com', 940094, '2026-03-22 21:24:06', 0, '2026-03-22 21:34:06', 8),
(15, '+22960000000', 'fadilmoussi1250@gmail.com', 395871, '2026-03-22 21:33:34', 1, '2026-03-22 21:43:34', 8),
(16, '+22960000000', 'fadilmoussi1250@gmail.com', 485524, '2026-03-22 20:42:32', 0, '2026-03-22 20:52:32', 8),
(17, '+22960000000', 'fadilmoussi1250@gmail.com', 106354, '2026-03-22 20:48:13', 0, '2026-03-22 20:58:13', 8),
(18, '+22960000000', 'fadilmoussi1250@gmail.com', 666239, '2026-03-22 20:49:15', 0, '2026-03-22 20:59:15', 8),
(19, '+22960000000', 'fadilmoussi1250@gmail.com', 504425, '2026-03-22 20:52:18', 1, '2026-03-22 22:02:18', 8),
(20, '+22960000000', 'fadilmoussi1250@gmail.com', 929475, '2026-03-22 20:54:16', 0, '2026-03-22 22:04:16', 8),
(21, '+22960000000', 'fadilmoussi1250@gmail.com', 940385, '2026-03-22 21:13:56', 0, '2026-03-22 22:23:56', 8),
(22, '940385', 'fadilmoussi1250@gmail.com', 261989, '2026-03-22 21:18:23', 0, '2026-03-22 22:28:23', 8),
(23, '940385', 'fadilmoussi1250@gmail.com', 199750, '2026-03-22 21:21:27', 1, '2026-03-22 22:31:27', 8),
(24, 'cgfhjkl', 'fadilmoussi1250@gmail.com', 807236, '2026-03-22 21:33:13', 1, '2026-03-22 22:43:13', 8),
(25, '807236', 'fadilmoussi1250@gmail.com', 896872, '2026-03-23 14:35:04', 1, '2026-03-23 15:45:04', 8),
(26, '896872', 'fadilmoussi1250@gmail.com', 215893, '2026-03-24 14:49:12', 1, '2026-03-24 15:59:12', 8),
(27, '21583', 'fadilmoussi1250@gmail.com', 149289, '2026-03-24 14:51:43', 0, '2026-03-24 16:01:43', 8),
(28, '21583', 'fadilmoussi1250@gmail.com', 356634, '2026-03-24 14:53:11', 0, '2026-03-24 16:03:11', 8),
(29, '21583', 'fadilmoussi1250@gmail.com', 667681, '2026-03-24 14:53:46', 0, '2026-03-24 16:03:46', 8),
(30, '5161565', 'fadilmoussi1250@gmail.com', 909205, '2026-03-25 17:47:13', 1, '2026-03-25 18:57:13', 10),
(31, '16565', 'fadilmoussi1250@gmail.com', 841169, '2026-03-26 11:00:49', 0, '2026-03-26 12:10:49', 11),
(32, '16565', 'fadilmoussi1250@gmail.com', 604826, '2026-03-26 11:01:16', 1, '2026-03-26 12:11:16', 11),
(33, '6156465qA', 'fadilmoussi1250@gmail.com', 925498, '2026-03-26 11:07:31', 1, '2026-03-26 12:17:31', 11),
(34, '64655165', 'fadilmoussi1250@gmail.com', 616140, '2026-03-26 13:22:49', 1, '2026-03-26 14:32:49', 13),
(35, '+22992096464', 'fadilmoussi1250@gmail.com', 816530, '2026-03-28 21:22:30', 0, '2026-03-28 22:32:30', 14),
(36, '+22992096464', 'fadilmoussi1250@gmail.com', 831628, '2026-03-28 22:09:45', 0, '2026-03-28 23:19:45', 14),
(37, '+22992096464', 'fadilmoussi1250@gmail.com', 176155, '2026-03-28 22:13:26', 0, '2026-03-28 23:23:26', 14),
(38, '+22992096464', 'fadilmoussi1250@gmail.com', 565190, '2026-03-28 22:14:10', 0, '2026-03-28 23:24:10', 14),
(39, '+22992096464', 'fadilmoussi1250@gmail.com', 576699, '2026-03-28 22:15:56', 0, '2026-03-28 23:25:56', 14),
(40, '+22992096464', 'fadilmoussi1250@gmail.com', 253048, '2026-03-28 22:16:51', 0, '2026-03-28 23:26:51', 14),
(41, '+22992096464', 'fadilmoussi1250@gmail.com', 958001, '2026-03-28 22:19:24', 0, '2026-03-28 23:29:24', 14),
(42, '+22992096464', 'fadilmoussi1250@gmail.com', 111792, '2026-03-28 22:23:39', 0, '2026-03-28 23:33:39', 14),
(43, '+22992096464', 'fadilmoussi1250@gmail.com', 792165, '2026-03-28 22:26:53', 0, '2026-03-28 23:36:53', 14),
(44, '+22992096464', 'fadilmoussi1250@gmail.com', 193006, '2026-03-28 22:27:26', 0, '2026-03-28 23:37:26', 14),
(45, '+22992096464', 'fadilmoussi1250@gmail.com', 981490, '2026-03-28 22:32:54', 0, '2026-03-28 23:42:54', 14),
(46, '+22992096464', 'fadilmoussi1250@gmail.com', 542796, '2026-03-28 22:35:48', 0, '2026-03-28 23:45:48', 14),
(47, '+22992096464', 'fadilmoussi1250@gmail.com', 814985, '2026-03-28 22:38:35', 0, '2026-03-28 23:48:35', 14),
(48, '+22992096464', 'fadilmoussi1250@gmail.com', 864468, '2026-03-28 22:40:30', 0, '2026-03-28 23:50:30', 14),
(49, '+22992096464', 'fadilmoussi1250@gmail.com', 354980, '2026-03-28 22:41:13', 0, '2026-03-28 23:51:13', 14),
(50, '+22992096464', 'fadilmoussi1250@gmail.com', 631309, '2026-03-28 22:44:55', 0, '2026-03-28 23:54:55', 14),
(51, '22992096464', 'fadilmoussi1250@gmail.com', 905498, '2026-03-29 15:26:29', 0, '2026-03-29 16:36:29', 14),
(52, '22992096464', 'fadilmoussi1250@gmail.com', 257248, '2026-03-29 15:30:40', 0, '2026-03-29 16:40:40', 14),
(53, '22967548463', 'fadilmoussi1250@gmail.com', 700091, '2026-03-29 15:32:21', 0, '2026-03-29 16:42:21', 14),
(54, '22967548463', 'fadilmoussi1250@gmail.com', 480370, '2026-03-29 15:40:39', 0, '2026-03-29 16:50:39', 14),
(55, '22967548463', 'fadilmoussi1250@gmail.com', 745176, '2026-03-29 15:48:37', 1, '2026-03-29 16:58:37', 15),
(56, '229 67 54 84 63', 'fadilmoussi1250@gmail.com', 422287, '2026-03-29 16:07:29', 0, '2026-03-29 17:17:29', 15),
(57, '22967548463', 'fadilmoussi1250@gmail.com', 765411, '2026-03-29 16:09:14', 0, '2026-03-29 17:19:14', 15),
(58, '22967548463', 'fadilmoussi1250@gmail.com', 129916, '2026-03-29 16:09:31', 1, '2026-03-29 17:19:31', 15);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `otpcodes`
--
ALTER TABLE `otpcodes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `otpcodes`
--
ALTER TABLE `otpcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
