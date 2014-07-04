-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2014 at 01:06 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photoplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `name`, `email`) VALUES
(1, 'Lucy Wilde', 'wilde@evil.org');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `description` text,
  `file_image` varchar(64) DEFAULT NULL,
  `file_geojson` varchar(64) DEFAULT NULL,
  `author_id` int(5) DEFAULT NULL,
  `unique_id` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `title`, `description`, `file_image`, `file_geojson`, `author_id`, `unique_id`) VALUES
(6, 'Babel', 'Pieter_Bruegel_the_Elder_-_The_Tower_of_Babel_-_Google_Art_Project', 'Pieter_Bruegel_the_Elder_-_The_Tower_of_Babel', 'Pieter_Bruegel_the_Elder_-_The_Tower_of_Babel.json', 1, 'b4b3l'),
(7, 'Seurat', 'Georges Seurat - A Sunday on La Grande Jatte - 1884', 'Georges_Seurat_-_A_Sunday_on_La_Grande_Jatte_--_1884.jpg', 'Georges_Seurat_-_A_Sunday_on_La_Grande_Jatte_--_1884.json', 1, 'KfC3k'),
(8, 'Messier', 'Messier Galaxy', 'Messier81Hubble_1.jpg', 'Messier81Hubble_1.json', 1, 'G8ls9'),
(10, 'web trend map', 'infographic web trend map', 'wtm4-final.png', 'wtm4-final.json', 1, 'b28bY'),
(11, 'middle earh map', '', 'middle earth map.jpg', 'middle earth map.json', 1, 'cUPX1'),
(12, 'GTA-V', 'grand theft auto 5 map satellite', 'gta-v-map-satellite.jpg', 'gta-v-map-satellite.json', 1, 'JZxOL');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attemps',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `user_twitter` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_facebook` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_googleplus` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_twitter`, `user_facebook`, `user_googleplus`) VALUES
(1, 'Stefan Rusu', '$2y$10$P5YICqeZU.uErTQiTx7NW.wlVFyrEN8AIx4LFDQXli1r9AW.MJ99W', 'stefan.rusu@live.com', 1, '77dcada5986e5826c2a1ba1cb4b4bfa4933094b6', NULL, NULL, NULL, 0, NULL, '2014-02-22 12:57:15', '::1', 'stephanrusu', 'stephanrusu', 'stephanrusu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
