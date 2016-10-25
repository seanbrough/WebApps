-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2016 at 03:50 AM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vcard`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `company_addr` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `state` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `first_name`, `last_name`, `company_name`, `title`, `company_addr`, `city`, `state`, `zip`, `phone`, `website`, `email`, `user_id`) VALUES
(1, 'Karl', 'Klonowski', 'Rossi, Michael M', 'Customer Manager', '76 Brooks St #9', 'Flemington', 'NJ', '08822', '908-877-6135', 'http://www.rossimichaelm.com', '', 1),
(2, 'Tonette', 'Wenner', 'Northwest Publishing', 'Branch Manager ', '4545 Courthouse Rd', 'Westbury', 'NY', '11590', '516-968-6051', 'http://www.northwestpublishing.com', '', 2),
(3, 'Amber', 'Monarrez', 'Branford Wire & Mfg Co', 'Operations Manager', '14288 Foster Ave #4121', 'Jenkintown', 'PA', '19046', '215-934-8655', 'http://www.branfordwiremfgco.com', '', 3),
(4, 'Shenika', 'Seewald', 'East Coast Marketing', 'Marketing Director ', '4 Otis St', 'Van Nuys', 'CA', '91405', '818-423-4007', 'http://www.eastcoastmarketing.com', '', 4),
(5, 'Delmy', 'Ahle', 'Wye Technologies Inc', 'Technical Engineer', '65895 S 16th St', 'Providence', 'RI', '02909', '401-458-2547', 'http://www.wyetechnologiesinc.com', '', 5),
(6, 'Deeanna', 'Juhas', 'Healy, George W Iv', 'Advertising Manager', 'Healy, George W Iv', 'Huntingdon Valley', 'PA', '19006', '215-211-9589', 'http://www.healygeorgewiv.com', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(10) UNSIGNED NOT NULL,
  `color` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `make_date` datetime NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `color`, `make_date`, `user_id`) VALUES
(1, 'black', '2016-10-06 04:20:28', 1),
(2, 'white', '2016-10-05 02:24:32', 2),
(3, 'blue', '2016-10-07 04:26:37', 2),
(4, 'green', '2016-10-07 07:41:42', 3),
(5, 'white', '2016-10-08 16:15:41', 4),
(6, 'red', '2016-10-08 18:32:35', 5),
(7, 'rgb(182,192,25)', '2016-10-08 18:26:33', 5),
(8, 'rgb(125,132,25)', '2016-10-08 04:20:36', 6);

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE `share` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_id` int(10) UNSIGNED NOT NULL,
  `to_id` int(10) UNSIGNED NOT NULL,
  `card_id` int(10) UNSIGNED NOT NULL,
  `share_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `share`
--

INSERT INTO `share` (`id`, `from_id`, `to_id`, `card_id`, `share_date`) VALUES
(2, 1, 2, 1, '2016-10-18 11:21:05'),
(3, 3, 4, 4, '2016-10-14 07:30:16'),
(4, 1, 3, 1, '2016-10-18 17:18:35'),
(5, 1, 5, 1, '2016-10-17 15:17:42'),
(6, 3, 5, 4, '2016-10-12 15:22:11'),
(7, 6, 4, 8, '2016-10-18 19:16:31'),
(8, 5, 2, 6, '2016-10-13 14:17:11'),
(9, 2, 1, 3, '2016-10-12 16:24:13'),
(10, 4, 6, 5, '2016-10-14 18:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `signup_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `signup_date`) VALUES
(1, 'karl_klonowski@yahoo.com', '3dd42d3c61395af719ac060051b03c64', '2016-10-02 06:27:43'),
(2, 'twenner@aol.com', '3dd42d3c61395af719ac060051b03c64', '2016-10-03 06:23:29'),
(3, 'amber_monarrez@monarrez.org', '3dd42d3c61395af719ac060051b03c64', '2016-10-03 12:12:39'),
(4, 'shenika@gmail.com', '3dd42d3c61395af719ac060051b03c64', '2016-10-04 02:15:34'),
(5, 'delmy.ahle@hotmail.com', '3dd42d3c61395af719ac060051b03c64', '2016-10-05 04:39:27'),
(6, 'deeanna_juhas@gmail.com', '3dd42d3c61395af719ac060051b03c64', '2016-10-05 13:17:14'),
(26, 'r', '90d143d9561cc0db4c6cc0cfc8563008', '2016-10-21 05:00:17'),
(27, 'tr', '29a18e06db18d5c094bf47105d83d144', '2016-10-23 01:03:43'),
(28, 't', '3088fd4b9f475801c9a07f40a487b9b7', '2016-10-25 02:03:46'),
(29, 'g', '939485424f1e9a4d14de1cf02805bad7', '2016-10-25 02:29:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Foreign_key` (`user_id`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_id` (`from_id`),
  ADD KEY `to_id` (`to_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `share`
--
ALTER TABLE `share`
  ADD CONSTRAINT `fk_5` FOREIGN KEY (`card_id`) REFERENCES `info` (`id`),
  ADD CONSTRAINT `fk_3` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_4` FOREIGN KEY (`to_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
