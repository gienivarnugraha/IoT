-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2019 at 12:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

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
,`topic` varchar(32)
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
  `apiKey` varchar(40) NOT NULL,
  `topic` varchar(32) NOT NULL,
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

INSERT INTO `tbl_project` (`projectId`, `userId`, `projectName`, `projectDesc`, `apiKey`, `topic`, `sensor1Name`, `sensor2Name`, `sensor3Name`, `sensor4Name`, `updateDate`, `createDate`) VALUES
('id_5d3712f22d648', '1', 'bangkai', 'huihuihui', 'gw00kk0c0s8g80cs480gwg4wo04sk4ss', 'topic_5d3718f8422d6', 'sensor1', 'sensor2', 'sensor3', 'sensor4', '2019-08-13 20:16:47', '2019-07-23 21:00:18'),
('id_5d49865732593', 'id_5d497ebd35e7f', 'DHT', 'ini adalah project iot untuk men', '0w0kwc4s4s4k8gos88oc4cwokw4s48o0', 'topic_5d49865732774', 'Temperature', 'Humidity', '', '', '2019-08-14 05:49:15', '2019-08-06 20:53:27');

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
  `topic` varchar(32) NOT NULL,
  `sensor1Value` int(32) NOT NULL DEFAULT '0',
  `sensor2Value` int(32) NOT NULL DEFAULT '0',
  `sensor3Value` int(32) NOT NULL DEFAULT '0',
  `sensor4Value` int(32) NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sensor`
--

INSERT INTO `tbl_sensor` (`topic`, `sensor1Value`, `sensor2Value`, `sensor3Value`, `sensor4Value`, `dateTime`) VALUES
('topic_5d3718f8422d6', 12, 23, 32, 13, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 43, 32, 23, 12, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 23, 23, 21, 21, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 43, 4, 4, 4, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 300, 300, 300, 300, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 10, 20, 30, 20, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 120, 100, 50, 200, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 50, 50, 50, 50, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 70, 70, 70, 70, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 300, 300, 300, 300, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 10, 10, 10, 10, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 100, 200, 300, 400, '2019-08-13 13:13:15'),
('topic_5d3718f8422d6', 60, 70, 80, 90, '2019-08-13 13:43:44'),
('topic_5d3718f8422d6', 90, 80, 70, 60, '2019-08-13 13:44:47'),
('topic_5d3718f8422d6', 100, 120, 130, 150, '2019-08-13 13:45:27'),
('topic_5d3718f8422d6', 200, 210, 220, 230, '2019-08-13 14:00:00'),
('topic_5d3718f8422d6', 100, 100, 100, 100, '2019-08-13 17:00:00'),
('topic_5d52c74241570', 100, 100, 100, 100, '2019-08-13 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `api_key` varchar(40) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `api_key`, `createdDtm`) VALUES
('1', 'admin@admin.com', '$2y$10$SAvFim22ptA9gHVORtIaru1dn9rhgerJlJCPxRNA02MjQaJnkxawq', 'nivar', '8gggcwccsc4o04ccs4s8cc04s8sw40wwco4s0gw0', '2019-07-22 21:33:37'),
('id_5d497ebd35e7f', 'dita@gmail.com', '$2y$10$FyazxMSRSobJTgtBgOLlQuF9DoOrh52gZQjHZy0ShrRONMeIRK62i', 'Dita', 'gsg4g00k8csss0oso0w8w4ow0ogo80g0kggk88oc', '2019-08-06 20:21:02'),
('id_5d52c72259aa3', 'asd@asd', '$2y$10$btnl7soBQ1bhsy1BLAiZJO3BfOnGYt2Q28RPNUV3y3i2FGPfCjMx.', 'Udara', '0kgwo4g8o4sskow0g0w40owwkg0wgwo04cwcgcgs', '2019-08-13 21:20:18');

-- --------------------------------------------------------

--
-- Structure for view `sensor`
--
DROP TABLE IF EXISTS `sensor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sensor`  AS  select `tbl_project`.`projectId` AS `projectId`,`tbl_project`.`projectName` AS `projectName`,`tbl_project`.`userId` AS `userId`,`tbl_project`.`projectDesc` AS `projectDesc`,`tbl_project`.`topic` AS `topic`,`tbl_project`.`sensor1Name` AS `sensor1Name`,`tbl_sensor`.`sensor1Value` AS `sensor1Value`,`tbl_project`.`sensor2Name` AS `sensor2Name`,`tbl_sensor`.`sensor2Value` AS `sensor2Value`,`tbl_project`.`sensor3Name` AS `sensor3Name`,`tbl_sensor`.`sensor3Value` AS `sensor3Value`,`tbl_project`.`sensor4Name` AS `sensor4Name`,`tbl_sensor`.`sensor4Value` AS `sensor4Value`,`tbl_sensor`.`dateTime` AS `dateTime` from (`tbl_project` join `tbl_sensor` on((`tbl_sensor`.`topic` = `tbl_project`.`topic`))) ;

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
  ADD KEY `sensorId` (`topic`),
  ADD KEY `sensorId_2` (`topic`);

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
