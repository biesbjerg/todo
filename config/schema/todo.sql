-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 12, 2020 at 12:32 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 5.6.40-0+deb8u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `todo`
--
CREATE DATABASE IF NOT EXISTS `todo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `todo`;

-- --------------------------------------------------------

--
-- Table structure for table `todo_items`
--

DROP TABLE IF EXISTS `todo_items`;
CREATE TABLE IF NOT EXISTS `todo_items` (
`id` int(11) unsigned NOT NULL,
  `todo_list_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `notes` varchar(3000) DEFAULT NULL,
  `show_in_my_day` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `due_date` date DEFAULT NULL,
  `is_completed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(11) unsigned DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `level` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo_items`
--

INSERT INTO `todo_items` (`id`, `todo_list_id`, `title`, `notes`, `show_in_my_day`, `due_date`, `is_completed`, `parent_id`, `lft`, `rght`, `level`, `created`, `modified`) VALUES
(34, 6, 'Mælk', 'Letmælk eller sødmælk', 0, NULL, 0, NULL, 5, 6, 0, '2020-07-08 16:19:12', '2020-07-12 10:29:13'),
(35, 6, 'Havregryn', '', 0, NULL, 0, NULL, 7, 8, 0, '2020-07-08 16:19:19', '2020-07-12 10:07:30'),
(41, 6, 'Nødder', '', 0, NULL, 1, NULL, 1, 4, 0, '2020-07-09 08:15:49', '2020-07-10 19:10:55'),
(42, 6, 'Cashew', '', 0, NULL, 1, 41, 4, 1, 1, '2020-07-09 08:18:33', '2020-07-10 19:11:01'),
(45, 17, 'Bootstrap 4', '', 0, NULL, 1, NULL, 1, 2, 0, '2020-07-10 18:58:56', '2020-07-10 18:58:56'),
(46, 17, 'CakePHP 4', '', 0, NULL, 1, NULL, 3, 4, 0, '2020-07-10 18:59:06', '2020-07-10 19:00:28'),
(47, 17, 'Git', '', 0, NULL, 1, NULL, 5, 6, 0, '2020-07-10 18:59:14', '2020-07-10 19:00:30'),
(48, 17, 'Docker', '', 0, NULL, 1, NULL, 7, 8, 0, '2020-07-10 18:59:21', '2020-07-10 19:00:33'),
(49, 17, 'Twig', '', 0, NULL, 1, NULL, 7, 8, 0, '2020-07-10 18:59:40', '2020-07-10 19:00:35'),
(50, 17, 'Composer', '', 0, NULL, 1, NULL, 9, 10, 0, '2020-07-10 18:59:47', '2020-07-10 19:00:39'),
(51, 17, 'PHP 7', '', 0, NULL, 1, NULL, 11, 12, 0, '2020-07-10 18:59:55', '2020-07-10 19:00:42'),
(52, 17, 'MySQL', '', 0, NULL, 1, NULL, 13, 14, 0, '2020-07-10 19:00:05', '2020-07-10 19:00:45'),
(53, 6, 'Mandler', '', 0, NULL, 1, 41, 2, 3, 1, '2020-07-10 19:01:35', '2020-07-10 19:10:58'),
(60, 6, 'Sukker', '', 0, NULL, 0, NULL, 9, 10, 0, '2020-07-12 09:56:57', '2020-07-12 09:56:57'),
(61, 19, 'Design database', '', 0, '2020-07-13', 1, NULL, 1, 2, 0, '2020-07-12 10:00:34', '2020-07-12 10:00:34'),
(62, 19, 'Deploy på server', '', 0, '2020-07-13', 1, NULL, 9, 10, 0, '2020-07-12 10:01:48', '2020-07-12 10:01:48'),
(63, 19, 'Anvend HTTPS-forbindelse', '', 0, NULL, 1, NULL, 11, 12, 0, '2020-07-12 10:03:52', '2020-07-12 10:03:54'),
(64, 19, 'Oprettelse/redigering af lister', '', 0, NULL, 1, NULL, 5, 6, 0, '2020-07-12 10:04:28', '2020-07-12 10:05:53'),
(65, 19, 'Oprettelse/redigering af todos', '', 0, NULL, 1, NULL, 7, 8, 0, '2020-07-12 10:04:37', '2020-07-12 10:05:54'),
(66, 22, 'Gå med hunden', 'Husk godbidder!', 1, NULL, 0, NULL, 1, 2, 0, '2020-07-12 10:07:21', '2020-07-12 10:29:54'),
(67, 19, 'Design brugerflade', '', 0, NULL, 1, NULL, 3, 4, 0, '2020-07-12 10:10:51', '2020-07-12 10:11:01'),
(68, 22, 'Køb juletræ', '', 0, '2020-12-23', 0, NULL, 3, 4, 0, '2020-07-12 10:12:57', '2020-07-12 10:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `todo_lists`
--

DROP TABLE IF EXISTS `todo_lists`;
CREATE TABLE IF NOT EXISTS `todo_lists` (
`id` int(11) unsigned NOT NULL,
  `slug` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) NOT NULL,
  `incomplete_item_count` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo_lists`
--

INSERT INTO `todo_lists` (`id`, `slug`, `title`, `color`, `incomplete_item_count`, `created`, `modified`) VALUES
(6, 'indkobsliste', 'Indkøbsliste', '#5a9118', 3, '2020-07-07 12:22:05', '2020-07-10 19:01:15'),
(17, 'anvend-teknologier', 'Anvend teknologier', '#dc0909', 0, '2020-07-10 18:58:31', '2020-07-12 10:02:04'),
(19, 'todo-app', 'Todo-app', '#000000', 0, '2020-07-12 10:00:09', '2020-07-12 10:00:09'),
(22, 'opgaver', 'Opgaver', '#000000', 2, '2020-07-12 10:07:11', '2020-07-12 10:07:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todo_items`
--
ALTER TABLE `todo_items`
 ADD PRIMARY KEY (`id`), ADD KEY `todo_list_todo_items_idx` (`todo_list_id`,`lft`);

--
-- Indexes for table `todo_lists`
--
ALTER TABLE `todo_lists`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_UNIQUE` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todo_items`
--
ALTER TABLE `todo_items`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `todo_lists`
--
ALTER TABLE `todo_lists`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `todo_items`
--
ALTER TABLE `todo_items`
ADD CONSTRAINT `fk_todo_items_todo_lists` FOREIGN KEY (`todo_list_id`) REFERENCES `todo_lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
