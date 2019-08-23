-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2019 at 10:42 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jaimecon_mymedlist_2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `caregiverpatientlist`
--

CREATE TABLE `caregiverpatientlist` (
  `userid` int(11) NOT NULL,
  `listid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `caregiverpatientlist`
--

INSERT INTO `caregiverpatientlist` (`userid`, `listid`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `listid` int(11) NOT NULL,
  `medid` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dose` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `units` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `healthCareProvider` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `updatedTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedUserid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`listid`, `medid`, `name`, `dose`, `units`, `frequency`, `type`, `date`, `healthCareProvider`, `comment`, `instructions`, `timestamp`, `userid`, `updatedTimestamp`, `updatedUserid`) VALUES
(2, 8, 'Ginseng', '1 tablet ', '100mg', '3', '5', '2018-12-12', 'Shoppers Drug Mart', 'For Nutrients', 'Take with Water', '2018-12-12 10:39:30', 1, '2019-08-22 20:39:33', 1),
(1, 3, 'ColdFx', '1 tablet', '100mg', '3', '5', '2018-12-12', 'Shoppers Drug Mart', 'For Nutrients', 'Take with Water', '2018-12-12 10:30:16', 1, '2019-08-22 20:39:33', 1),
(1, 11, 'Advil', '1 tablet', '50mg', '3', '5', '2018-12-12', 'Shoppers Drug Mart', 'For Headaches', 'Take with Water', '2018-12-12 10:51:22', 2, '2019-08-22 20:40:16', 1),
(3, 13, 'Tylenol', '1 tablet', '10mg', '3', '5', '2018-12-12', 'Shoppers Drug Mart', 'For Back Pain', 'Take with Water', '2018-12-12 10:58:16', 4, '2019-08-22 20:40:49', 4),
(4, 18, 'qaswqw', '2', '100mg', '3', '5', '2018-12-17', 'rer', 'rer', 'rerer', '2018-12-17 17:24:36', 5, '2019-08-22 20:41:17', 5),
(1, 2, 'Durezol', '1 drop', '50mg', '3', '5', '2018-12-12', 'Dr. T', 'For eye', 'For right eye', '2019-08-20 17:18:28', 2, '2019-08-22 20:40:16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `medlist`
--

CREATE TABLE `medlist` (
  `listid` int(11) NOT NULL,
  `medid` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dose` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `units` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `healthCareProvider` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medlist`
--

INSERT INTO `medlist` (`listid`, `medid`, `name`, `dose`, `units`, `frequency`, `type`, `date`, `healthCareProvider`, `comment`, `instructions`, `timestamp`, `userid`) VALUES
(1, 1, 'Fish Oil', '1000mg', '50mg', '3', '5', '2018-12-12', 'Shoppers Drug Mart', 'For Nutrients ', 'Take with Water', '2019-08-20 21:15:51', 2),
(1, 4, 'Liposic Drops', '2 drops', '10mg', '3', '5', '2018-12-12', 'Dr. T', 'For eyes', 'For Left and Right eye', '2019-08-20 22:12:30', 2),
(1, 5, 'Vitamin D3', '1 tablet', '10mg', '3', '5', '2018-12-12', 'Shoppers Drug Mart', 'For Nutrients', 'Take with Water', '2019-08-20 21:17:06', 2),
(2, 6, 'Tylenol', '1 tablet', '10mg', '4', '5', '2018-12-12', 'Shoppers Drug Mart', 'For Back Pain', 'Take with Water', '2019-08-22 20:32:43', 1),
(2, 7, 'Vigamox', '1 drop', '50mg', '3', '5', '2018-12-12', 'Dr. Bill', 'For eye Infection', 'For Left eye', '2019-08-22 20:32:57', 1),
(2, 9, 'Prednisolone', '1 drop', '5mg', '4', '6', '2018-12-12', 'Dr. Bill', 'For eye', 'For Right eye ', '2019-08-22 20:33:12', 1),
(2, 10, 'Dexilant', '1 capsule', '10mg', '3', '6', '2018-12-12', 'Dr. Bill', 'For Digestion', 'Take with Water', '2019-08-22 20:33:25', 1),
(3, 12, 'APO-ATORVASTATIN', '1 tablet', '20mg', '3', '6', '2018-12-12', 'Dr. Armo', 'For Chloesterol', 'Take with Water', '2019-08-22 20:33:43', 4),
(3, 14, 'RATIO-DOMPERIDONE', '1 tablet', '10mg', '4', '6', '2018-12-12', 'Dr. Armo', 'For Acid Reflux', 'Take after meals', '2019-08-22 20:33:56', 4),
(3, 15, 'Combigan', '1 drop', '5mg', '3', '5', '2018-12-12', 'Dr. Armo', 'For eye pressure', 'For Right eye', '2019-08-22 20:34:09', 4),
(3, 16, 'Dexilant', '1 capsule', '30mg', '3', '6', '2018-12-12', 'Dr. Armo', 'For Digestion', 'Take with water', '2019-08-22 20:34:24', 4),
(4, 19, 'Dale DeServe', 'asaqs', '50mg', '4', '5', '2018-12-17', 'lkjkj', 'hkjhk', 'kjhkjhk', '2019-08-22 20:34:38', 5),
(1, 23, 'Vitamin C', '1 tablet', '50mg', '3', '5', '2019-08-20', 'Dr. Swift', 'can skip', 'take with water', '2019-08-20 21:54:02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `medvalue`
--

CREATE TABLE `medvalue` (
  `type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `value` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medvalue`
--

INSERT INTO `medvalue` (`type`, `code`, `value`) VALUES
('role', 1, 'Patient'),
('role', 2, 'Caregiver'),
('freq', 3, 'Once a day'),
('freq', 4, '2 times a day'),
('type', 5, 'Over-the-counter'),
('type', 6, 'Prescribed');

-- --------------------------------------------------------

--
-- Table structure for table `patientlist`
--

CREATE TABLE `patientlist` (
  `userid` int(11) NOT NULL,
  `listid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patientlist`
--

INSERT INTO `patientlist` (`userid`, `listid`) VALUES
(2, 1),
(3, 2),
(4, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `firstName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `firstName`, `lastName`, `username`, `password`, `email`, `timestamp`) VALUES
(1, 'Mary', 'Smith', 'msmith', 'user02', 'msmith@gmail.com', '2018-12-12 14:31:26'),
(2, 'John', 'Smith', 'jsmith', 'user01', 'jsmith@gmail.com', '2018-12-12 14:37:10'),
(3, 'Alex', 'Smith', 'asmith', 'user03', 'asmith@gmail.com', '2018-12-12 14:39:55'),
(4, 'Fred', 'Jones', 'fjones', 'user04', 'fj@gmail.com', '2018-12-12 15:53:26'),
(5, 'Wasim', 'Singh', 'w.singh@jupiter-spotless.', 'w.singh@jupiter-spotless.', 'w.singh@jupiter-spotless.com', '2018-12-17 22:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `userid` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`userid`, `role`) VALUES
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medlist`
--
ALTER TABLE `medlist`
  ADD PRIMARY KEY (`medid`);

--
-- Indexes for table `patientlist`
--
ALTER TABLE `patientlist`
  ADD PRIMARY KEY (`listid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medlist`
--
ALTER TABLE `medlist`
  MODIFY `medid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `patientlist`
--
ALTER TABLE `patientlist`
  MODIFY `listid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
