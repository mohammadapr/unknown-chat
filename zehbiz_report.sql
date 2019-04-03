-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2018 at 11:24 AM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zehbiz_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `chat_id_send` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `chat_id_receive` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `connected` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `chat_id` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `command` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `state` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `chat_id`, `username`, `type`, `command`, `state`) VALUES
(1, '56107266', 'mapr74', NULL, '', '0'),
(2, '96561290', 'Younes_salmanzade', NULL, '239585977', '0'),
(3, '231585237', NULL, NULL, 'قطع مکالمه', '0'),
(4, '90544392', 'Amnasrollahi', NULL, 'حتما', '0'),
(5, '60193786', 'mahsaaa_pornamaz', NULL, 'Khobam', '0'),
(6, '117938940', 'Mm_ghanbari', NULL, 'قطع مکالمه', '0'),
(7, '84959420', 'nothing', NULL, 'سلام', '0'),
(8, '777000', 'nothing', NULL, 'Hello, MAPR. You are using a version of Telegram that is no longer supported and will be disabled so', '0'),
(9, '437061877', 'Mahta001', NULL, '/start', '0'),
(10, '80300421', 'Mohammad_sepehri', NULL, 'تایید', '0'),
(11, '44988495', 'Hadiss5', NULL, 'او عكس بده', '0'),
(12, '191816586', 'mohammadlllm', NULL, '/start', '0'),
(13, '465323307', 'uni136', NULL, '231585237', '0'),
(14, '-211716183', 'nothing', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
