-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2017 at 12:16 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystanddata`
--
CREATE DATABASE IF NOT EXISTS `mystanddata` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mystanddata`;

-- --------------------------------------------------------

--
-- Table structure for table `askcomments`
--

DROP TABLE IF EXISTS `askcomments`;
CREATE TABLE IF NOT EXISTS `askcomments` (
  `AskCommentsID` int(10) NOT NULL AUTO_INCREMENT,
  `AskID` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `CommentWord` varchar(100) NOT NULL,
  `CommentTime` datetime NOT NULL,
  PRIMARY KEY (`AskCommentsID`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `askcomments`
--

INSERT INTO `askcomments` (`AskCommentsID`, `AskID`, `UserID`, `CommentWord`, `CommentTime`) VALUES
(1, 58, 2, 'ok', '2016-09-17 10:34:57'),
(2, 58, 2, 'ok', '2016-09-17 10:35:25'),
(3, 58, 2, 'check 45', '2016-09-17 10:37:33'),
(4, 58, 2, 'check', '2016-09-17 10:49:01'),
(5, 58, 2, 'check 46', '2016-09-17 10:49:56'),
(6, 57, 2, 'ok', '2016-09-17 11:02:46'),
(7, 57, 2, 'hi', '2016-09-17 11:03:32'),
(8, 59, 2, 'check 48', '2016-09-17 11:13:19'),
(9, 63, 2, 'hi', '2016-09-17 11:35:05'),
(10, 8, 2, 'check for otherAsk', '2016-09-17 11:36:01'),
(11, 62, 2, 'check to show harry', '2016-09-17 12:56:08'),
(12, 58, 2, 'check to show vijay', '2016-09-17 13:39:34'),
(13, 57, 2, 'hiii', '2016-09-18 03:35:59'),
(14, 57, 2, 'hihoihg', '2016-09-18 03:36:04'),
(15, 62, 2, 'check to show shr', '2016-09-18 03:37:49'),
(16, 62, 2, 'hi', '2016-09-18 06:07:22'),
(17, 53, 2, 'hi', '2016-09-18 11:42:24'),
(18, 59, 2, 'hi', '2016-09-18 11:52:38'),
(19, 59, 2, 'check 50', '2016-09-18 11:54:09'),
(20, 64, 2, 'Check it for fun', '2016-09-18 18:25:35'),
(21, 58, 2, 'for just fun', '2016-09-19 13:13:33'),
(22, 59, 2, 'check 51', '2016-09-19 16:26:35'),
(23, 59, 2, 'check 52', '2016-09-19 16:27:22'),
(24, 59, 2, 'check 53', '2016-09-19 16:29:42'),
(25, 59, 2, 'check 54', '2016-09-19 16:30:24'),
(26, 58, 2, 'check fro double', '2016-09-21 09:36:50'),
(27, 58, 2, 'check 58', '2016-09-22 06:02:45'),
(28, 58, 2, 'check 59', '2016-09-22 09:40:37'),
(29, 58, 2, 'check for span', '2016-09-22 11:00:54'),
(30, 58, 2, 'check 60', '2016-09-23 16:38:15'),
(31, 64, 2, 'check 61', '2016-09-24 15:36:25'),
(32, 64, 2, 'check 62', '2016-09-27 07:59:41'),
(33, 58, 2, 'check  61', '2016-09-29 08:39:44'),
(34, 58, 2, 'check 62', '2016-10-06 16:15:15'),
(35, 58, 2, 'check 63', '2016-10-07 05:51:46'),
(36, 58, 2, 'check 64', '2016-10-09 08:51:39'),
(37, 64, 2, 'check 64', '2016-10-09 08:55:51'),
(38, 58, 27, 'check 65', '2016-10-09 16:33:36'),
(39, 68, 2, '279  - 228', '2016-10-10 10:31:08'),
(40, 68, 2, 'He won', '2016-10-11 04:04:28'),
(41, 69, 29, 'He won', '2016-10-11 04:30:52'),
(42, 73, 2, 'f*ck u bro yo!', '2016-10-26 06:14:26'),
(43, 71, 2, 'hello', '2016-10-27 04:59:29'),
(44, 68, 2, 'check', '2016-10-27 16:47:43'),
(45, 70, 2, 'check', '2016-11-01 01:48:01'),
(46, 70, 2, 'i dont know', '2016-11-01 01:48:38'),
(47, 71, 2, 'yea', '2016-11-04 12:29:02'),
(48, 70, 2, 'ok', '2016-11-09 16:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `changegroup`
--

DROP TABLE IF EXISTS `changegroup`;
CREATE TABLE IF NOT EXISTS `changegroup` (
  `ChangeTrackID` int(10) NOT NULL AUTO_INCREMENT,
  `WhatChange` varchar(20) NOT NULL,
  `UserID` int(10) NOT NULL,
  `WhatOld` varchar(30) NOT NULL,
  `WhatNew` varchar(30) NOT NULL,
  `ChangeTime` datetime NOT NULL,
  PRIMARY KEY (`ChangeTrackID`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `changegroup`
--

INSERT INTO `changegroup` (`ChangeTrackID`, `WhatChange`, `UserID`, `WhatOld`, `WhatNew`, `ChangeTime`) VALUES
(1, 'Interested', 2, '11111111', '11100111', '2016-09-12 14:19:09'),
(2, 'Name', 2, 'test2', 'test', '2016-09-12 14:37:49'),
(3, 'Password', 2, 'test', 'test2', '2016-09-12 14:39:27'),
(4, 'Password', 2, 'test2', 'test', '2016-09-12 14:39:48'),
(5, 'Name', 22, 'test23', 'test', '2016-09-12 17:04:17'),
(6, 'Name', 22, 'test', 'test23', '2016-09-12 17:04:43'),
(7, 'Gender', 22, 'female', 'male', '2016-09-12 17:04:43'),
(8, 'Name', 22, 'test23', 'test2', '2016-09-12 17:05:33'),
(9, 'Interested', 23, '00000000', '11100000', '2016-09-13 07:47:15'),
(10, 'Phone', 23, '9825098250', '9825011297', '2016-09-13 07:48:31'),
(11, 'DOB', 23, '1998-05-31', '1998-06-30', '2016-09-13 07:48:31'),
(12, 'Interested', 23, '11100000', '11111111', '2016-09-13 07:53:32'),
(13, 'Interested', 2, '11100111', '10000011', '2016-09-13 15:50:08'),
(14, 'Name', 2, 'test', 'test2', '2016-09-13 15:50:40'),
(15, 'Gender', 2, 'male', 'female', '2016-09-13 15:50:40'),
(16, 'Phone', 2, '9825098250', '9825098251', '2016-09-13 15:50:40'),
(17, 'DOB', 2, '2016-05-31', '2016-07-31', '2016-09-13 15:50:40'),
(18, 'Interested', 2, '10000011', '11111111', '2016-09-15 07:03:27'),
(19, 'Name', 2, 'test2', 'test', '2016-09-16 09:02:30'),
(20, 'Interested', 2, '11111111', '11111101', '2016-09-17 05:54:56'),
(21, 'Gender', 2, 'female', 'male', '2016-09-17 05:55:06'),
(22, 'Name', 2, 'test', 'test2', '2016-09-17 06:11:14'),
(23, 'Interested', 2, '11111101', '11111111', '2016-09-17 06:15:26'),
(24, 'Password', 2, 'test2', 'test', '2016-09-17 09:35:29'),
(25, 'Interested', 2, '11111111', '00111111', '2016-09-17 12:57:10'),
(26, 'Interested', 2, '00111111', '11111111', '2016-09-17 13:02:26'),
(27, 'Name', 2, 'test2', 'test', '2016-09-21 09:37:02'),
(28, 'Name', 2, 'test', 'me', '2016-09-21 09:47:10'),
(29, 'Interested', 2, '11111111', '01111111', '2016-09-22 16:10:38'),
(30, 'Interested', 2, '01111111', '11111111', '2016-09-22 16:29:28'),
(31, 'Interested', 4, '01111100', '11111111', '2016-09-23 13:49:44'),
(32, 'Interested', 2, '11111111', '01111111', '2016-09-27 07:57:57'),
(33, 'Interested', 2, '01111111', '11111111', '2016-09-27 07:58:12'),
(34, 'Interested', 2, '11111111', '11001011', '2016-09-29 09:02:08'),
(35, 'Interested', 2, '11001011', '11111111', '2016-09-29 09:18:51'),
(36, 'Interested', 2, '11111111', '01010101', '2016-09-29 09:29:27'),
(37, 'Interested', 2, '01010101', '00000000', '2016-09-29 13:37:40'),
(38, 'Interested', 2, '00000000', '11111111', '2016-09-29 13:38:22'),
(39, 'Interested', 2, '11111111', '00000111', '2016-09-29 14:26:23'),
(40, 'Interested', 2, '00000111', '00000011', '2016-09-29 14:26:56'),
(41, 'Interested', 2, '00000011', '10000011', '2016-09-29 14:31:59'),
(42, 'Interested', 2, '10000011', '11110011', '2016-09-29 16:25:46'),
(43, 'Interested', 2, '11110011', '00000000', '2016-09-30 04:17:34'),
(44, 'Interested', 2, '00000000', '10000000', '2016-09-30 16:32:06'),
(45, 'Interested', 2, '10000000', '00000000', '2016-09-30 16:40:25'),
(46, 'Interested', 2, '00000000', '11111111', '2016-09-30 16:41:07'),
(47, 'Interested', 3, '11000000', '11111111', '2016-09-30 18:11:01'),
(48, 'Interested', 2, '11111111', '01111111', '2016-10-06 18:16:17'),
(49, 'Interested', 2, '01111111', '11111111', '2016-10-06 18:22:25'),
(50, 'Interested', 2, '11111111', '10001111', '2016-10-07 05:50:50'),
(51, 'Interested', 2, '10001111', '11111111', '2016-10-07 11:08:59'),
(52, 'Interested', 25, '00000000', '00101011', '2016-10-07 12:01:19'),
(53, 'Interested', 26, '00000000', '11000111', '2016-10-07 12:07:42'),
(54, 'Interested', 2, '11111111', '11111101', '2016-10-09 16:08:11'),
(55, 'Interested', 27, '00000000', '10111100', '2016-10-09 16:30:54'),
(56, 'Interested', 2, '11111101', '11111111', '2016-10-10 08:02:44'),
(57, 'Interested', 28, '00000000', '11010000', '2016-10-10 08:16:15'),
(58, 'Interested', 29, '00000000', '11101000', '2016-10-11 04:27:04'),
(59, 'Interested', 29, '11101000', '11101010', '2016-10-11 04:27:40'),
(60, 'Interested', 2, '11111111', '00101101', '2016-10-30 04:55:09'),
(61, 'Interested', 2, '00101101', '00100101', '2016-11-01 00:14:33'),
(62, 'Interested', 2, '00100101', '11111111', '2016-11-01 01:45:20'),
(63, 'Interested', 2, '11111111', '01100111', '2016-11-04 12:27:04'),
(64, 'Interested', 2, '01100111', '11111000', '2016-11-09 16:49:53'),
(65, 'Interested', 2, '11111000', '11111110', '2016-11-09 16:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `deletegroup`
--

DROP TABLE IF EXISTS `deletegroup`;
CREATE TABLE IF NOT EXISTS `deletegroup` (
  `DeleteID` int(10) NOT NULL AUTO_INCREMENT,
  `WhatDelete` varchar(20) NOT NULL,
  `WhatID` int(10) NOT NULL,
  `DeleteTime` datetime NOT NULL,
  `UserID` int(10) NOT NULL,
  PRIMARY KEY (`DeleteID`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deletegroup`
--

INSERT INTO `deletegroup` (`DeleteID`, `WhatDelete`, `WhatID`, `DeleteTime`, `UserID`) VALUES
(3, 'Ask', 10, '2016-08-26 09:50:16', 2),
(2, 'Ask', 17, '2016-08-26 07:00:34', 2),
(4, 'Ask', 9, '2016-08-26 09:50:20', 2),
(5, 'Ask', 17, '2016-08-26 09:53:46', 2),
(6, 'Ask', 9, '2016-08-27 13:52:45', 2),
(7, 'Ask', 12, '2016-08-27 14:07:47', 2),
(8, 'Ask', 17, '2016-08-27 14:16:30', 2),
(9, 'Ask', 17, '2016-08-27 14:16:33', 2),
(10, 'Ask', 17, '2016-08-27 14:16:34', 2),
(11, 'Ask', 17, '2016-08-27 14:16:34', 2),
(12, 'Ask', 17, '2016-08-27 14:16:34', 2),
(13, 'Ask', 17, '2016-08-27 14:16:35', 2),
(14, 'Ask', 17, '2016-08-27 14:16:35', 2),
(15, 'Ask', 19, '2016-08-27 14:18:18', 2),
(16, 'Ask', 19, '2016-08-27 14:18:18', 2),
(17, 'Ask', 19, '2016-08-27 14:18:18', 2),
(18, 'Ask', 19, '2016-08-27 14:18:18', 2),
(19, 'Ask', 19, '2016-08-27 14:18:19', 2),
(20, 'Ask', 19, '2016-08-27 14:18:19', 2),
(21, 'Ask', 19, '2016-08-27 14:18:19', 2),
(22, 'Ask', 19, '2016-08-27 14:18:35', 2),
(23, 'Ask', 19, '2016-08-27 14:18:37', 2),
(24, 'Ask', 19, '2016-08-27 14:18:37', 2),
(25, 'Ask', 19, '2016-08-27 14:18:38', 2),
(26, 'Ask', 19, '2016-08-27 14:18:39', 2),
(27, 'Ask', 19, '2016-08-27 14:18:41', 2),
(28, 'Ask', 19, '2016-08-27 14:18:45', 2),
(29, 'Ask', 19, '2016-08-27 14:18:47', 2),
(30, 'Ask', 19, '2016-08-27 14:18:48', 2),
(31, 'Ask', 19, '2016-08-27 14:19:23', 2),
(32, 'Ask', 20, '2016-08-28 06:36:26', 2),
(33, 'Ask', 21, '2016-09-09 11:30:22', 2),
(34, 'Ask', 26, '2016-09-15 16:23:55', 2),
(35, 'Ask', 41, '2016-09-16 04:56:03', 2),
(36, 'Ask', 38, '2016-09-16 04:56:04', 2),
(37, 'Ask', 39, '2016-09-16 04:56:06', 2),
(38, 'Ask', 40, '2016-09-16 04:56:07', 2),
(39, 'Ask', 37, '2016-09-16 04:56:07', 2),
(40, 'Ask', 42, '2016-09-16 04:56:09', 2),
(41, 'Ask', 36, '2016-09-16 04:56:10', 2),
(42, 'Ask', 35, '2016-09-16 04:56:11', 2),
(43, 'Ask', 32, '2016-09-16 04:56:12', 2),
(44, 'Ask', 33, '2016-09-16 04:56:15', 2),
(45, 'Ask', 34, '2016-09-16 04:56:16', 2),
(46, 'Ask', 31, '2016-09-16 04:56:17', 2),
(47, 'Ask', 30, '2016-09-16 04:56:18', 2),
(48, 'Ask', 29, '2016-09-16 04:56:25', 2),
(49, 'Ask', 28, '2016-09-16 04:56:26', 2),
(50, 'Ask', 27, '2016-09-16 04:56:27', 2),
(51, 'Ask', 25, '2016-09-16 04:56:28', 2),
(52, 'Ask', 24, '2016-09-16 04:56:29', 2),
(53, 'Ask', 23, '2016-09-16 04:56:34', 2),
(54, 'Ask', 22, '2016-09-16 04:56:36', 2),
(55, 'Ask', 19, '2016-09-16 04:56:37', 2),
(56, 'Ask', 17, '2016-09-16 04:56:38', 2),
(57, 'Ask', 14, '2016-09-16 04:56:38', 2),
(58, 'Ask', 13, '2016-09-16 04:56:39', 2),
(59, 'Ask', 12, '2016-09-16 04:56:40', 2),
(60, 'Ask', 54, '2016-09-17 06:15:04', 2),
(61, 'Ask', 10, '2016-09-17 13:54:03', 2),
(62, 'Ask', 57, '2016-09-18 03:36:13', 2),
(63, 'Ask', 63, '2016-09-18 03:36:14', 2),
(64, 'Ask', 60, '2016-09-18 03:36:17', 2),
(65, 'Ask', 58, '2016-09-18 03:36:18', 2),
(66, 'Ask', 47, '2016-09-18 06:04:39', 2),
(67, 'Ask', 62, '2016-09-18 06:08:54', 2),
(68, 'Ask', 65, '2016-09-22 05:47:19', 2),
(69, 'Ask', 55, '2016-09-22 09:40:09', 2),
(70, 'Ask', 66, '2016-09-24 11:37:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `discussionask`
--

DROP TABLE IF EXISTS `discussionask`;
CREATE TABLE IF NOT EXISTS `discussionask` (
  `AskID` int(10) NOT NULL AUTO_INCREMENT,
  `NewsID` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `AskQuestion` varchar(500) NOT NULL,
  `AskTime` datetime NOT NULL,
  `DiscussionStatus` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`AskID`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussionask`
--

INSERT INTO `discussionask` (`AskID`, `NewsID`, `UserID`, `AskQuestion`, `AskTime`, `DiscussionStatus`) VALUES
(31, 9, 2, 'check ajax last', '2016-09-16 04:51:27', 1),
(30, 9, 2, 'check for ajax', '2016-09-16 04:50:43', 1),
(29, 9, 2, 'ajax get', '2016-09-16 04:49:49', 1),
(6, 9, 14, 'check for social by user test11@gmail.com\r\n', '2016-08-23 11:54:30', 0),
(7, 9, 14, 'check for social by user test11@gmail.com 2', '2016-08-23 11:59:15', 0),
(8, 9, 14, 'hi i am monark', '2016-08-23 12:13:41', 0),
(9, 9, 2, 'check 2 ', '2016-08-23 15:48:13', 0),
(10, 9, 2, 'check 3 for disabled', '2016-08-23 15:48:48', 1),
(11, 9, 2, 'df', '2016-08-23 17:02:32', 0),
(12, 9, 2, 'dfdfdfdfd', '2016-08-23 17:03:28', 1),
(13, 9, 2, 'dfdfdfdffdfdfdfdfdfdf', '2016-08-23 17:03:42', 1),
(14, 9, 2, 'dfdfdfdfdfdfdf', '2016-08-23 17:04:17', 1),
(15, 2, 2, 'check for ent just fun', '2016-08-23 18:19:07', 0),
(16, 8, 2, 'check for newdid ', '2016-08-24 07:01:38', 0),
(17, 9, 2, 'Check for show to vijay', '2016-08-24 13:35:37', 1),
(18, 89, 2, 'hi', '2016-08-25 08:52:08', 0),
(19, 9, 2, 'Check In edge ', '2016-08-27 14:17:05', 1),
(20, 9, 2, 'check to show umang', '2016-08-28 06:36:00', 1),
(21, 9, 2, 'check to show ankit', '2016-09-09 11:30:18', 1),
(22, 9, 2, 'check for ajax', '2016-09-15 16:20:31', 1),
(23, 9, 2, 'check for ajax', '2016-09-15 16:20:47', 1),
(24, 9, 2, 'check for ajax', '2016-09-15 16:21:22', 1),
(25, 9, 2, 'check for ajax', '2016-09-15 16:21:28', 1),
(26, 9, 2, 'check for ajax', '2016-09-15 16:22:15', 1),
(27, 9, 2, 'check for ajax get ', '2016-09-15 17:10:11', 1),
(28, 9, 2, 'ajax get', '2016-09-16 04:48:38', 1),
(32, 9, 2, 'check ajax last', '2016-09-16 04:51:28', 1),
(33, 9, 2, 'check ajax last', '2016-09-16 04:51:28', 1),
(34, 9, 2, 'check ajax last', '2016-09-16 04:51:28', 1),
(35, 9, 2, 'check for ajax', '2016-09-16 04:52:25', 1),
(36, 9, 2, 'check ajax', '2016-09-16 04:54:14', 1),
(37, 9, 2, '', '2016-09-16 04:54:40', 1),
(38, 9, 2, '', '2016-09-16 04:54:41', 1),
(39, 9, 2, '', '2016-09-16 04:54:41', 1),
(40, 9, 2, '', '2016-09-16 04:54:41', 1),
(41, 9, 2, '', '2016-09-16 04:54:41', 1),
(42, 9, 2, '', '2016-09-16 04:55:16', 1),
(43, 9, 2, 'check ajax', '2016-09-16 06:34:35', 0),
(44, 9, 2, 'check ajax', '2016-09-16 06:34:51', 0),
(45, 9, 2, 'dsfdsf', '2016-09-16 06:36:15', 0),
(46, 9, 2, 'dsfdsf', '2016-09-16 06:36:16', 0),
(47, 9, 2, 'dsfdsfsdfsdfdfsf', '2016-09-16 06:36:40', 1),
(48, 9, 2, 'www', '2016-09-16 06:36:58', 0),
(49, 9, 2, 'sdfsdf', '2016-09-16 06:38:13', 0),
(50, 9, 2, 'check ajax load', '2016-09-16 06:39:01', 0),
(51, 9, 2, 'check for sleep', '2016-09-16 06:39:50', 0),
(52, 9, 2, 'check for sleep 2', '2016-09-16 06:40:51', 0),
(53, 8, 2, 'check for ajax', '2016-09-16 06:42:32', 0),
(54, 8, 2, 'check for ajax last', '2016-09-16 07:25:09', 1),
(55, 9, 2, 'check for parth', '2016-09-16 08:55:58', 1),
(56, 9, 2, 'check 42', '2016-09-16 13:59:52', 0),
(57, 9, 2, 'check 43', '2016-09-16 14:01:10', 1),
(58, 9, 2, 'check 44', '2016-09-17 05:53:50', 0),
(59, 8, 2, 'check for ajax', '2016-09-17 06:14:41', 0),
(60, 9, 2, 'check 45', '2016-09-17 11:20:09', 1),
(61, 9, 2, 'check 45', '2016-09-17 11:20:09', 0),
(62, 9, 2, 'check 45', '2016-09-17 11:21:31', 1),
(63, 9, 2, 'check 46', '2016-09-17 11:21:42', 1),
(64, 9, 2, 'check 51', '2016-09-18 18:25:17', 0),
(65, 9, 2, 'BY monark dedakiya just for checking by test@gmail.com on mystand at 4:26', '2016-09-21 10:56:59', 1),
(66, 10, 2, 'check for first ', '2016-09-24 11:37:42', 1),
(67, 9, 2, 'check for front end', '2016-10-09 08:58:09', 0),
(68, 23, 2, 'What are the statistics of the polling?', '2016-10-10 10:29:39', 0),
(69, 23, 2, 'Who won Florida?\r\n', '2016-10-10 10:30:00', 0),
(70, 23, 2, 'when trump is going to take charge?', '2016-10-10 10:30:20', 0),
(71, 24, 2, 'is it ok?\r\n', '2016-10-11 04:21:49', 0),
(72, 23, 2, 'check', '2016-10-11 04:32:21', 0),
(73, 14, 2, 'f*ck dat shit yo\r\n', '2016-10-26 06:13:02', 0),
(74, 21, 2, 'hello', '2017-02-09 12:10:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

DROP TABLE IF EXISTS `logindetails`;
CREATE TABLE IF NOT EXISTS `logindetails` (
  `LoginDetailsID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `IPaddress` varchar(15) NOT NULL,
  `BlockStatus` int(2) NOT NULL,
  `LoginTime` datetime NOT NULL,
  PRIMARY KEY (`LoginDetailsID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`LoginDetailsID`, `UserID`, `IPaddress`, `BlockStatus`, `LoginTime`) VALUES
(1, 2, '27.251.37.55', 0, '2016-09-12 17:35:52'),
(2, 2, '27.251.37.55', 0, '2016-09-12 17:37:11'),
(3, 23, '27.251.37.55', 11, '2016-09-13 07:43:50'),
(4, 23, '27.251.37.55', 10, '2016-09-13 07:45:50'),
(5, 23, '27.251.37.55', 10, '2016-09-13 07:46:18'),
(6, 23, '27.251.37.55', 0, '2016-09-13 07:46:45'),
(7, 2, '27.251.37.55', 0, '2016-09-13 15:49:10'),
(8, 2, '27.251.37.55', 0, '2016-09-15 07:00:22'),
(9, 2, '27.251.37.55', 0, '2016-09-15 07:03:13'),
(10, 2, '27.251.37.55', 0, '2016-09-15 13:51:44'),
(11, 2, '27.251.37.55', 0, '2016-09-15 16:20:15'),
(12, 2, '27.251.37.55', 0, '2016-09-15 17:02:33'),
(13, 2, '27.251.37.55', 0, '2016-09-15 17:09:37'),
(14, 2, '27.251.37.55', 0, '2016-09-16 04:21:29'),
(15, 2, '27.251.37.55', 0, '2016-09-16 06:34:28'),
(16, 2, '27.251.37.55', 0, '2016-09-16 08:52:57'),
(17, 2, '27.251.37.55', 0, '2016-09-16 11:11:10'),
(18, 2, '27.251.37.55', 0, '2016-09-16 13:59:43'),
(19, 2, '27.251.37.55', 0, '2016-09-17 05:53:16'),
(20, 2, '27.251.37.55', 0, '2016-09-17 06:06:58'),
(21, 2, '27.251.37.55', 0, '2016-09-17 06:09:41'),
(22, 2, '27.251.37.55', 0, '2016-09-17 09:35:18'),
(23, 2, '27.251.37.55', 0, '2016-09-17 10:09:57'),
(24, 2, '27.251.37.55', 0, '2016-09-17 11:34:57'),
(25, 2, '27.251.37.55', 0, '2016-09-17 13:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `newsdetails`
--

DROP TABLE IF EXISTS `newsdetails`;
CREATE TABLE IF NOT EXISTS `newsdetails` (
  `NewsID` int(11) NOT NULL AUTO_INCREMENT,
  `Headline` varchar(100) NOT NULL,
  `HeadImage` varchar(100) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `PollingQuestion` varchar(100) NOT NULL,
  `NewsURL` text NOT NULL,
  `NewsStatus` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`NewsID`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsdetails`
--

INSERT INTO `newsdetails` (`NewsID`, `Headline`, `HeadImage`, `Category`, `PollingQuestion`, `NewsURL`, `NewsStatus`) VALUES
(2, 'Google shutdown project ARA ', 'Images\\News\\NEWS-1-COVER.jpg', 'Tech', 'Do you think it is right move?', 'http://thenextweb.com/gadgets/2016/09/04/lets-just-admit-googles-project-ara-terrible-idea-move/', 0),
(3, 'check politics', '', 'Politics', 'check Politics?', '', 0),
(4, 'Check sport', '', 'Sports', 'check sports?', '', 0),
(5, 'check tech', '', 'Tech', 'check tech?', '', 0),
(6, 'check money', '', 'Money', 'check money?', '', 0),
(7, 'check science', '', 'Science', 'check science?', '', 0),
(8, 'check terrosit', '', 'Terrorist', 'check terrorist?', '', 0),
(9, 'check social', '', 'Social', 'check social?', '', 0),
(10, 'Carry Minati added new video', '', 'Entrainment', 'is it funny?', 'https://www.youtube.com', 0),
(11, 'Indian gov put ban on 1000 and 500 rupee note', 'Images\\News\\2.jpg', 'Money', 'is it right move by Mr. Modi?', 'http://timesofindia.indiatimes.com/pm-modis-address-to-the-nation/liveblog/55315325.cms', 0),
(12, 'Ishaat Hussain to replace Mistry as TCS chairman', 'Images\\News\\3.jpg', 'Money', 'Ishaat Hussain is right choice?', 'http://timesofindia.indiatimes.com/business/india-business/Tata-Sons-replaces-Cyrus-Mistry-as-TCS-chief/articleshow/55345362.cms', 0),
(13, 'Craze for selfie with Rs 2,000 note catches on', 'Images\\News\\4.jpg', 'Entrainment', 'Have you take selfie with 2000 note?', 'http://timesofindia.indiatimes.com/city/chennai/Craze-for-selfie-with-Rs-2000-note-catches-on-in-Chennai/articleshow/55348479.cms', 0),
(14, 'Trump is a friend'' of India, but is he a friend of Indian H1B workers?', 'Images\\News\\5.jpg', 'Politics', 'Is he a friend of Indian H1B workers?', 'http://timesofindia.indiatimes.com/united-states-elections-2016-us-elections-news-results-polls/Trump-is-a-friend-of-India-but-is-he-a-friend-of-Indian-H1B-workers/articleshow/55331112.cms', 0),
(15, 'Deepika Padukone: Quintessential desi girl', 'Images\\News\\6.jpg', 'Entrainment', 'Are you fan of Deepika?', 'http://timesofindia.indiatimes.com/entertainment/hindi/bollywood/Pics-Deepika-Padukone-undergoes-shocking-transformation-for-Iranian-filmmaker-Majid-Majidi/photostory/55347782.cms', 0),
(16, ' Yuvraj Singh-Hazel Keech host pre-wedding bash', 'Images\\News\\7.jpg', 'Sports', 'Are they best couple in indian cricket team?', 'http://timesofindia.indiatimes.com/entertainment/hindi/bollywood/bollywood-news/Pics-Yuvraj-Singh-Hazel-Keech-host-pre-wedding-bash/articleshow/55345390.cms', 0),
(17, 'Arbaaz Khan and Malaika Arora come together to celebrate sonâ€™s birthday', 'Images\\News\\8.jpg', 'Entrainment', 'will They come together again?', 'http://timesofindia.indiatimes.com/entertainment/hindi/bollywood/bollywood-news/Pics-Arbaaz-Khan-and-Malaika-Arora-come-together-to-celebrate-sons-birthday/articleshow/55345615.cms', 0),
(18, 'First look of ''Badrinath Ki Dulhania'' is out!', 'Images\\News\\9.jpg', 'Entrainment', 'Is it looking interesting?', 'http://timesofindia.indiatimes.com/entertainment/latest-hindi-movie-news-bollywood-movies-news-updates/bollywood/bollywood-news/BT-EXCLUSIVE-First-look-of-Badrinath-Ki-Dulhania-is-out/articleshow/55332254.cms', 0),
(19, 'India v England, 1st Test, Day 2: Stokes, Bairstow lead England to 450/6 at lunch', 'Images\\News\\10.jpg', 'Sports', 'Will india win this match?', 'http://timesofindia.indiatimes.com/sports/cricket/england-in-india-2016/India-v-England-1st-Test-Day-2-Stokes-Bairstow-lead-England-to-450/6-at-lunch/articleshow/55347708.cms', 0),
(20, 'Researchers show how a targeted drug overcomes suppressive immune cells', 'Images\\News\\11.jpg', 'Science', 'Is it looking interesting?', 'https://www.sciencedaily.com/releases/2016/11/161109140708.htm', 0),
(21, 'Chance find following heavy rainfall: Blind species of fish discovered in Kurdistan', 'Images\\News\\12.jpg', 'Science', 'world is changing or not?', 'https://www.sciencedaily.com/releases/2016/11/161108123818.htm', 0),
(22, 'RBI’s new Rs 2000 note has no GPS-nano chip, contrary to rumours', 'Images\\News\\13.jpeg', 'Tech', 'Do you heard this rumours?', 'http://indianexpress.com/article/technology/tech-news-technology/nope-rs-2000-note-does-not-have-a-gps-nano-chip-inside-it/', 0),
(23, 'Donald Trumpâ€™s victory: Questions raised over Facebook, Twitterâ€™s role', 'Images\\News\\14.jpg', 'Social', 'Social media help us to express our idea?', 'http://indianexpress.com/article/technology/social/donald-trumps-victory-questions-raised-over-facebook-twitters-role/', 0),
(24, 'Met Police arrest man in Stockport in anti-terrorism operation', 'Images\\News\\15.jpg', 'Terrorist', 'Is it good allow police to arrest people on the basis of terrorism?', 'http://www.manchestereveningnews.co.uk/news/greater-manchester-news/terrorism-police-arrest-stockport-live-12152119', 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsreader`
--

DROP TABLE IF EXISTS `newsreader`;
CREATE TABLE IF NOT EXISTS `newsreader` (
  `NewsReaderID` int(6) NOT NULL AUTO_INCREMENT,
  `NewsID` int(11) NOT NULL,
  `UserID` int(10) NOT NULL,
  `Time` datetime NOT NULL,
  PRIMARY KEY (`NewsReaderID`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsreader`
--

INSERT INTO `newsreader` (`NewsReaderID`, `NewsID`, `UserID`, `Time`) VALUES
(1, 3, 2, '2016-09-11 13:00:02'),
(2, 3, 2, '2016-08-11 07:28:28'),
(3, 3, 2, '2016-08-11 07:29:26'),
(4, 3, 2, '2016-08-11 07:33:10'),
(5, 3, 2, '2016-08-11 07:36:15'),
(6, 3, 2, '2016-08-11 07:36:21'),
(7, 3, 2, '2016-08-11 07:37:36'),
(8, 3, 2, '2016-08-11 07:37:53'),
(9, 3, 2, '2016-08-11 07:38:07'),
(10, 3, 2, '2016-08-11 07:38:08'),
(11, 3, 2, '2016-08-11 07:38:14'),
(12, 3, 2, '2016-08-11 07:38:29'),
(13, 3, 2, '2016-08-11 07:38:35'),
(14, 3, 2, '2016-08-11 07:41:21'),
(15, 3, 2, '2016-08-11 07:41:38'),
(16, 3, 2, '2016-08-11 07:41:45'),
(17, 2, 2, '2016-08-11 07:41:50'),
(18, 2, 3, '2016-08-11 07:44:47'),
(19, 9, 2, '2016-08-11 13:15:07'),
(20, 7, 2, '2016-08-11 13:43:14'),
(21, 3, 2, '2016-08-11 13:52:49'),
(22, 9, 2, '2016-08-11 13:52:52'),
(23, 2, 2, '2016-08-11 13:52:59'),
(24, 2, 2, '2016-08-11 13:53:04'),
(25, 2, 2, '2016-08-11 13:53:43'),
(26, 2, 2, '2016-08-11 13:53:53'),
(27, 9, 2, '2016-08-11 14:04:13'),
(28, 9, 2, '2016-08-11 14:04:20'),
(29, 4, 2, '2016-08-11 14:04:41'),
(30, 7, 2, '2016-08-11 14:05:57'),
(31, 5, 2, '2016-08-11 14:06:04'),
(32, 8, 2, '2016-08-11 14:08:09'),
(33, 9, 2, '2016-08-11 15:59:59'),
(34, 3, 2, '2016-08-11 16:00:14'),
(35, 3, 2, '2016-08-11 16:00:35'),
(36, 9, 2, '2016-08-11 16:01:50'),
(37, 6, 4, '2016-08-11 16:04:13'),
(38, 7, 4, '2016-08-11 16:04:19'),
(39, 6, 4, '2016-08-11 16:05:10'),
(40, 6, 4, '2016-08-11 16:07:12'),
(41, 5, 4, '2016-08-11 16:14:21'),
(42, 4, 4, '2016-08-11 16:14:28'),
(43, 4, 4, '2016-08-11 16:20:29'),
(44, 5, 4, '2016-08-11 16:20:51'),
(45, 3, 4, '2016-08-11 16:39:19'),
(46, 6, 4, '2016-08-11 16:39:29'),
(47, 0, 5, '2016-08-11 16:52:30'),
(48, 5, 5, '2016-08-11 17:19:33'),
(49, 2, 5, '2016-08-11 17:26:09'),
(50, 2, 5, '2016-08-11 17:26:21'),
(51, 3, 5, '2016-08-11 17:51:28'),
(52, 2, 5, '2016-08-11 18:02:18'),
(53, 2, 7, '2016-08-11 18:03:43'),
(54, 2, 2, '2016-08-12 14:05:31'),
(55, 6, 2, '2016-08-12 14:06:12'),
(56, 6, 2, '2016-08-12 14:06:21'),
(57, 6, 2, '2016-08-12 15:59:06'),
(58, 2, 2, '2016-08-12 15:59:35'),
(59, 7, 2, '2016-08-12 16:02:33'),
(60, 2, 2, '2016-08-13 17:48:33'),
(61, 9, 2, '2016-08-21 06:55:44'),
(62, 9, 2, '2016-08-21 18:38:00'),
(63, 7, 2, '2016-08-22 11:34:26'),
(64, 2, 2, '2016-08-22 11:34:31'),
(65, 2, 2, '2016-08-22 14:42:45'),
(66, 9, 2, '2016-08-23 11:22:34'),
(67, 9, 14, '2016-08-23 11:54:03'),
(68, 8, 14, '2016-08-23 12:08:57'),
(69, 9, 14, '2016-08-23 12:09:30'),
(70, 9, 2, '2016-08-23 12:13:55'),
(71, 2, 2, '2016-08-24 06:19:01'),
(72, 5, 2, '2016-08-25 09:48:55'),
(73, 9, 2, '2016-08-25 17:14:01'),
(74, 9, 2, '2016-08-26 06:22:00'),
(75, 9, 2, '2016-08-26 06:22:29'),
(76, 9, 2, '2016-08-26 07:13:26'),
(77, 4, 2, '2016-08-29 09:47:16'),
(78, 8, 19, '2016-08-29 09:57:49'),
(79, 7, 19, '2016-08-29 09:57:59'),
(80, 6, 19, '2016-08-29 09:58:15'),
(81, 2, 2, '2016-09-06 14:04:51'),
(82, 2, 2, '2016-09-06 14:10:07'),
(83, 2, 21, '2016-09-12 06:01:24'),
(84, 4, 23, '2016-09-13 07:50:22'),
(85, 9, 2, '2016-09-17 06:20:22'),
(86, 9, 2, '2016-09-17 06:20:22'),
(87, 4, 2, '2016-09-21 11:29:07'),
(88, 2, 2, '2016-09-21 11:29:13'),
(89, 9, 2, '2016-09-21 11:40:44'),
(90, 9, 2, '2016-09-22 08:48:01'),
(91, 10, 2, '2016-09-23 05:25:49'),
(92, 10, 2, '2016-09-23 05:25:58'),
(93, 10, 2, '2016-09-24 11:19:20'),
(94, 10, 2, '2016-09-25 12:13:54'),
(95, 4, 2, '2016-10-06 18:01:03'),
(96, 9, 2, '2016-10-07 05:50:26'),
(97, 2, 2, '2016-10-07 05:51:08'),
(98, 10, 27, '2016-10-09 16:32:10'),
(99, 8, 2, '2016-10-10 07:52:50'),
(100, 8, 2, '2016-10-10 08:02:26'),
(101, 9, 2, '2016-10-10 08:09:59'),
(102, 2, 2, '2016-10-10 08:10:12'),
(103, 2, 2, '2016-10-10 08:10:45'),
(104, 24, 2, '2016-10-10 10:27:41'),
(105, 23, 2, '2016-10-10 10:45:05'),
(106, 24, 2, '2016-10-11 04:03:37'),
(107, 24, 2, '2016-10-11 04:19:25'),
(108, 24, 2, '2016-10-11 04:21:14'),
(109, 24, 29, '2016-10-11 04:28:39'),
(110, 24, 2, '2016-10-25 11:39:52'),
(111, 24, 2, '2016-10-25 12:02:36'),
(112, 24, 2, '2016-10-30 04:51:43'),
(113, 24, 2, '2016-11-04 12:28:40'),
(114, 19, 2, '2016-11-09 16:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `pollans`
--

DROP TABLE IF EXISTS `pollans`;
CREATE TABLE IF NOT EXISTS `pollans` (
  `PollAnsID` int(10) NOT NULL AUTO_INCREMENT,
  `NewsID` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `PollPoint` int(1) NOT NULL,
  `PollTime` datetime NOT NULL,
  PRIMARY KEY (`PollAnsID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pollans`
--

INSERT INTO `pollans` (`PollAnsID`, `NewsID`, `UserID`, `PollPoint`, `PollTime`) VALUES
(1, 5, 2, 0, '2016-09-22 09:34:42'),
(2, 9, 2, 1, '2016-09-22 09:36:36'),
(3, 8, 2, 0, '2016-09-22 09:38:37'),
(4, 6, 2, 1, '2016-09-22 09:45:23'),
(5, 4, 2, 0, '2016-09-22 09:46:58'),
(6, 3, 2, 0, '2016-09-22 09:48:08'),
(7, 2, 2, 1, '2016-09-22 09:48:22'),
(8, 7, 2, 1, '2016-09-22 10:36:42'),
(9, 2, 3, 1, '2016-09-22 13:19:28'),
(10, 2, 14, 1, '2016-09-22 14:01:12'),
(11, 10, 2, 0, '2016-09-22 16:47:38'),
(12, 10, 4, 0, '2016-09-23 13:49:51'),
(13, 9, 4, 0, '2016-09-23 13:50:00'),
(14, 8, 4, 1, '2016-09-23 13:50:05'),
(15, 7, 4, 1, '2016-09-23 13:50:09'),
(16, 6, 4, 0, '2016-09-23 13:50:14'),
(17, 2, 4, 0, '2016-09-23 13:50:20'),
(18, 3, 4, 0, '2016-09-23 13:50:55'),
(19, 2, 18, 1, '2016-09-23 13:51:48'),
(20, 24, 2, 0, '2016-10-25 11:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `reportgroup`
--

DROP TABLE IF EXISTS `reportgroup`;
CREATE TABLE IF NOT EXISTS `reportgroup` (
  `ReportID` int(10) NOT NULL AUTO_INCREMENT,
  `WhatReport` varchar(15) NOT NULL,
  `UserID` int(10) NOT NULL,
  `WhatID` int(10) NOT NULL,
  `ReportTime` datetime NOT NULL,
  PRIMARY KEY (`ReportID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reportgroup`
--

INSERT INTO `reportgroup` (`ReportID`, `WhatReport`, `UserID`, `WhatID`, `ReportTime`) VALUES
(15, 'News', 2, 6, '2016-11-06 18:04:37'),
(14, 'News', 2, 7, '2016-11-02 07:38:55'),
(13, 'Ask', 2, 6, '2016-10-31 13:41:11'),
(12, 'Ask', 2, 7, '2016-10-31 14:17:51'),
(11, 'News', 3, 8, '2016-09-30 18:11:12'),
(9, 'News', 2, 10, '2016-09-30 17:21:56'),
(10, 'News', 2, 3, '2016-09-30 18:09:00'),
(16, 'News', 27, 10, '2016-11-09 16:32:21'),
(17, 'News', 28, 10, '2016-11-10 08:16:25'),
(18, 'News', 29, 24, '2016-11-11 04:29:15'),
(19, 'News', 2, 22, '2016-11-11 04:32:55'),
(20, 'News', 2, 24, '2016-12-04 12:29:26'),
(21, 'News', 2, 23, '2017-01-24 09:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE IF NOT EXISTS `userinfo` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `DOB` date NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `OTP` int(4) NOT NULL DEFAULT '0',
  `Interested` varchar(8) NOT NULL DEFAULT '0',
  `BlockStatus` smallint(2) NOT NULL DEFAULT '11',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`UserID`, `Email`, `Name`, `Password`, `Gender`, `DOB`, `Phone`, `OTP`, `Interested`, `BlockStatus`) VALUES
(2, 'test@gmail.com', 'me', 'test', 'male', '2016-07-31', '9825098251', 1341, '11111110', 0),
(3, 'test1@gmail.com', 'test', 'test', 'male', '2016-01-01', '9825011297', 2556, '11111111', 0),
(4, 'test2@gmail.com', 'test', 'testnew', 'male', '2016-01-01', '9825011297', 7410, '11111111', 0),
(5, 'test3@gmail.com', 'test', 'test', 'male', '2016-01-01', '9825098250', 6681, '11110000', 0),
(6, 'sushantchandra.roy2015@vit.ac.in', 'SUSHANT', '123456', 'male', '1996-12-27', '8056060453', 7609, '109', 0),
(7, 'monark@gmail.com', 'monark', 'monark', 'male', '1998-05-31', '9825098250', 1202, '11111000', 0),
(8, 'monarkdedakiya@gmail.com', 'Moanrk', 'monark', 'male', '1998-05-31', '9825011297', 1241, '11111100', 0),
(9, 'test5@gmail.com', 'test', 'hi', 'male', '1998-05-31', '9825098250', 6383, '00010000', 0),
(10, 'monark2@gmail.com', 'monark', 'monark', 'male', '1998-05-31', '9825098250', 6109, '11100000', 0),
(11, 'gautamchar@gmail.com', 'Gautam char', 'gautam', 'male', '1997-01-13', '9825098250', 5150, '11000000', 0),
(12, 'test9@gmail.com', 'test', 'monark', 'male', '1998-05-31', '9825098250', 6160, '11111000', 0),
(13, 'test10@gmail.com', 'test', 'monark', 'male', '1998-05-31', '9825011297', 9806, '00000000', 0),
(14, 'test11@gmail.com', 'test', 'test', 'male', '1998-05-31', '9825011297', 3944, '11111111', 0),
(15, 'test12@gmail.com', 'test', 'monark', 'male', '1998-05-31', '9825098250', 8302, '0', 0),
(16, 'test14', 'test', 'monark', 'male', '1998-05-31', '98250', 7979, '0', 0),
(17, 'suparagyagmail.com', 'suparagya', 'test', 'male', '1997-08-26', '9825098250', 6291, '11111110', 0),
(18, 'desaiparth.pareshkumar2015@vit.ac.in', 'parth', 'parth2', 'male', '1997-10-28', '9825098250', 8030, '11110000', 0),
(19, 'test50@gmail.com', 'test', 'test', 'male', '1997-05-31', '9825098250', 5236, '11111111', 0),
(20, 'test52@gmail.com', 'test', 'test', 'male', '1998-05-31', '9825098250', 2632, '00000000', 0),
(21, 'test34@gmail.com', 'test4', 'test', 'male', '1998-05-31', '9825098250', 3757, '10000000', 0),
(22, 'test99@gmail.com', 'test2', 'test', 'male', '1998-05-31', '9825098250', 3913, '11111111', 0),
(23, 'test23@gmail.com', 'test', 'test', 'male', '1998-06-30', '9825011297', 2084, '11111111', 0),
(24, 'test24@gmail.com', 'test', 'testhack', 'male', '1998-05-31', '98825', 2402, '0', 11),
(25, 'test71@gmail.com', 'test', 'test', 'male', '1998-05-31', '9825098250', 9558, '00101011', 0),
(26, 'test72@gmail.com', 'test72', 'test', 'male', '1995-02-22', '9876543210', 4404, '11000111', 0),
(27, 'ravitejawoonnaw@gmail.com', 'raviteja', 'raviteja', 'male', '1998-02-04', '9790724745', 6651, '10111100', 0),
(28, 'nandhini.rohini@gmail.com', 'Nandhini', '2341', 'female', '1976-12-03', '893232421', 8332, '11010000', 0),
(29, 'test67@gmail.com', 'Check', 'shrey', 'male', '1998-05-31', '9825098250', 3771, '11101010', 11);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
