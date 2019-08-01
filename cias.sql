-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2019 at 05:22 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cias`
--

-- --------------------------------------------------------

--
-- Table structure for table `mqtt_logs`
--

CREATE TABLE `mqtt_logs` (
  `id` int(11) DEFAULT NULL,
  `topic` text,
  `payload` blob,
  `received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `sensor`
-- (See below for the actual view)
--
CREATE TABLE `sensor` (
`projectId` varchar(32)
,`projectName` varchar(32)
,`userId` varchar(32)
,`projectDesc` varchar(32)
,`sensorId` varchar(32)
,`sensor1Name` varchar(32)
,`sensor1Value` int(32)
,`sensor2Name` varchar(32)
,`sensor2Value` int(32)
,`sensor3Name` varchar(32)
,`sensor3Value` int(32)
,`sensor4Name` varchar(32)
,`sensor4Value` int(32)
,`dateTime` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE `tbl_project` (
  `projectId` varchar(32) NOT NULL,
  `userId` varchar(32) NOT NULL,
  `projectName` varchar(32) NOT NULL,
  `projectDesc` varchar(32) NOT NULL,
  `apiKey` varchar(32) NOT NULL,
  `sensorId` varchar(32) NOT NULL,
  `sensor1Name` varchar(32) NOT NULL DEFAULT 'none',
  `sensor2Name` varchar(32) NOT NULL DEFAULT 'none',
  `sensor3Name` varchar(32) NOT NULL DEFAULT 'none',
  `sensor4Name` varchar(32) NOT NULL DEFAULT 'none',
  `updateDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`projectId`, `userId`, `projectName`, `projectDesc`, `apiKey`, `sensorId`, `sensor1Name`, `sensor2Name`, `sensor3Name`, `sensor4Name`, `updateDate`, `createDate`) VALUES
('id_5d3712f22d648', '1', 'vnbvbnvn', 'dsasdasdsa', 'gw00kk0c0s8g80cs480gwg4wo04sk4ss', 'id_5d3712f22d644', 'asd', 'none', 'none', 'none', '2019-07-28 23:02:36', '2019-07-23 21:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sensor`
--

CREATE TABLE `tbl_sensor` (
  `sensorId` varchar(32) NOT NULL,
  `sensor1Value` int(32) NOT NULL DEFAULT '0',
  `sensor2Value` int(32) NOT NULL DEFAULT '0',
  `sensor3Value` int(32) NOT NULL DEFAULT '0',
  `sensor4Value` int(32) NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sensor`
--

INSERT INTO `tbl_sensor` (`sensorId`, `sensor1Value`, `sensor2Value`, `sensor3Value`, `sensor4Value`, `dateTime`) VALUES
('id_5d3718f8422d6', 12, 23, 32, 13, '2019-07-30 07:21:39'),
('id_5d3718f8422d6', 43, 32, 23, 12, '2019-07-30 07:21:39'),
('id_5d3718f8422d6', 23, 23, 21, 21, '2019-07-30 07:21:57'),
('id_5d3718f8422d6', 43, 4, 4, 4, '2019-07-30 07:22:34'),
('id_5d3718f8422d6', 300, 300, 300, 300, '2019-07-30 07:27:09'),
('id_5d3718f8422d6', 10, 20, 30, 20, '2019-07-30 07:55:18'),
('id_5d3718f8422d6', 120, 100, 50, 200, '2019-07-30 07:55:46'),
('id_5d3718f8422d6', 50, 50, 50, 50, '2019-07-31 13:45:26'),
('id_5d3718f8422d6', 70, 70, 70, 70, '2019-07-31 15:54:35'),
('id_5d3718f8422d6', 300, 300, 300, 300, '2019-07-31 15:58:06'),
('id_5d3718f8422d6', 10, 10, 10, 10, '2019-07-31 16:00:46'),
('id_5d3718f8422d6', 100, 200, 300, 400, '2019-08-01 07:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `api_key`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
('0zx', 'admin@admin.com', '$2y$10$SAvFim22ptA9gHVORtIaru1dn9rhgerJlJCPxRNA02MjQaJnkxawq', 'nivar', NULL, 1, 'g04owk0oo4coogw8ocoswswww4kkg4kwc8wosw0o', 1, '2019-07-22 21:33:37', 1, '2019-08-01 19:30:04');

-- --------------------------------------------------------

--
-- Structure for view `sensor`
--
DROP TABLE IF EXISTS `sensor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sensor`  AS  select `tbl_project`.`projectId` AS `projectId`,`tbl_project`.`projectName` AS `projectName`,`tbl_project`.`userId` AS `userId`,`tbl_project`.`projectDesc` AS `projectDesc`,`tbl_project`.`sensorId` AS `sensorId`,`tbl_project`.`sensor1Name` AS `sensor1Name`,`tbl_sensor`.`sensor1Value` AS `sensor1Value`,`tbl_project`.`sensor2Name` AS `sensor2Name`,`tbl_sensor`.`sensor2Value` AS `sensor2Value`,`tbl_project`.`sensor3Name` AS `sensor3Name`,`tbl_sensor`.`sensor3Value` AS `sensor3Value`,`tbl_project`.`sensor4Name` AS `sensor4Name`,`tbl_sensor`.`sensor4Value` AS `sensor4Value`,`tbl_sensor`.`dateTime` AS `dateTime` from (`tbl_project` join `tbl_sensor` on((`tbl_sensor`.`sensorId` = `tbl_project`.`sensorId`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`projectId`),
  ADD UNIQUE KEY `id` (`projectId`) USING BTREE;

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sensor`
--
ALTER TABLE `tbl_sensor`
  ADD KEY `sensorId` (`sensorId`),
  ADD KEY `sensorId_2` (`sensorId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userId` (`userId`),
  ADD UNIQUE KEY `apiId` (`api_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
