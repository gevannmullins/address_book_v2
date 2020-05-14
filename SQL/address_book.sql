-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2020 at 12:34 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `address_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `nickname` varchar(200) DEFAULT NULL,
  `date_created` varchar(200) DEFAULT NULL,
  `date_updated` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `surname`, `nickname`, `date_created`, `date_updated`) VALUES
(1, 'gevann', 'mullins', 'gman', '05-05-2020', ''),
(10, 'caron', 'mullins', 'wifey', '2020-05-12 21:08:52', '2020-05-12 21:08:52'),
(11, 'caron', 'mullins', 'wifey', '2020-05-12 21:09:04', '2020-05-12 21:09:04'),
(12, 'jenna', 'mullins', 'jgirl', '2020-05-14 07:28:30', '2020-05-14 07:28:30'),
(13, 'test', 'test', 'the tester', '2020-05-14 07:34:07', '2020-05-14 07:34:07'),
(14, 'test2', 'tester2', 'test', '2020-05-14 07:35:59', '2020-05-14 07:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `id` int(10) NOT NULL,
  `contact_id` int(10) NOT NULL,
  `contact_type` varchar(200) NOT NULL,
  `contact_value` varchar(200) NOT NULL,
  `date_created` varchar(200) NOT NULL,
  `date_updated` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`id`, `contact_id`, `contact_type`, `contact_value`, `date_created`, `date_updated`) VALUES
(1, 1, 'phone', '0123456789', '05-05-2020', '05-05-2020'),
(2, 1, 'address', '107 botma street', '05-05-2020', '05-05-2020'),
(6, 1, 'email', 'gevann.mullins@gmail.com', '07-05-2020', '07-05-2020'),
(7, 10, 'Select an option', '12345678', '2020-05-14 11:10:10', '2020-05-14 11:10:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`id`,`contact_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
