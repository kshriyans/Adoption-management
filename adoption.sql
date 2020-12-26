-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 01:36 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adoption`
--

-- --------------------------------------------------------

--
-- Table structure for table `adopted`
--

CREATE TABLE `adopted` (
  `Child_id` int(5) UNSIGNED NOT NULL,
  `Parent_id` int(5) DEFAULT NULL,
  `Child_name` varchar(20) DEFAULT NULL,
  `Parent_Name` varchar(20) DEFAULT NULL,
  `Child_Gender` varchar(6) DEFAULT NULL,
  `Weight` float(7,4) DEFAULT NULL,
  `Blood_group` varchar(20) DEFAULT NULL,
  `Height` float(7,4) DEFAULT NULL,
  `Marital_status` varchar(3) DEFAULT NULL,
  `DOA` date DEFAULT NULL,
  `Address` varchar(20) DEFAULT NULL,
  `Reg_id` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adopted`
--

INSERT INTO `adopted` (`Child_id`, `Parent_id`, `Child_name`, `Parent_Name`, `Child_Gender`, `Weight`, `Blood_group`, `Height`, `Marital_status`, `DOA`, `Address`, `Reg_id`) VALUES
(4, NULL, 'Ram', NULL, '2', 45.0000, 'Bposi', 134.0000, NULL, '2020-12-26', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `Child_id` int(5) UNSIGNED NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Age` int(20) NOT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `Weight` float(7,4) DEFAULT NULL,
  `Height` float(7,4) DEFAULT NULL,
  `Blood_group` varchar(20) DEFAULT NULL,
  `Photo` varchar(225) DEFAULT NULL,
  `Reg_id` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`Child_id`, `Name`, `DOB`, `Age`, `Gender`, `Weight`, `Height`, `Blood_group`, `Photo`, `Reg_id`) VALUES
(1, 'Skr', '2000-05-01', 20, '2', 35.0000, 143.0000, 'Oposit', '/assets/img/godschild/20201226073826_1608964706.jpg', 1),
(2, 'Skr1', '2000-05-01', 20, '2', 35.0000, 165.0000, 'Oposit', '/assets/img/godschild/20201226084745_1608968865.jpg', 1),
(5, 'Jack Churn', '2013-05-09', 7, '2', 32.0000, 143.0000, 'Bposit', '/assets/img/godschild/20201226085255_1608969175.png', 1),
(6, 'Killer Que', '2006-07-01', 14, '2', 56.0000, 154.0000, 'ABnega', '/assets/img/godschild/20201226090344_1608969824.jpg', 1),
(7, 'Shyam', '2000-05-01', 20, '1', 36.0000, 165.0000, 'Oposit', '/assets/img/godschild/20201226090725_1608970045.jpg', 1),
(8, 'Futureis', '2001-03-05', 19, '2', 32.0000, 134.0000, 'Anegat', '/assets/img/godschild/20201226091854_1608970734.jpg', 1),
(9, 'Birju', '2013-05-09', 7, '1', 33.0000, 142.0000, 'Bnegative', '/assets/img/godschild/20201226122734_1608982054.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `displays`
--

CREATE TABLE `displays` (
  `Reg_id` int(5) UNSIGNED NOT NULL,
  `Child_id` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `Event_id` int(5) UNSIGNED NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Winner` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`Event_id`, `Name`, `Date`, `Winner`) VALUES
(1, '', '2020-12-26', 'Jack Churn'),
(2, '', '2020-12-26', 'Jack Churn'),
(3, 'Dancing', '2020-12-26', 'Jack Churn');

-- --------------------------------------------------------

--
-- Table structure for table `hasoa`
--

CREATE TABLE `hasoa` (
  `Reg_id` int(5) NOT NULL,
  `Child_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasoe`
--

CREATE TABLE `hasoe` (
  `Reg_id` int(5) NOT NULL,
  `Event_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasof`
--

CREATE TABLE `hasof` (
  `Reg_id` int(5) NOT NULL,
  `Faculty_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasos`
--

CREATE TABLE `hasos` (
  `Reg_id` int(5) NOT NULL,
  `ID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hassl`
--

CREATE TABLE `hassl` (
  `Id` int(5) NOT NULL,
  `Username` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `UserId` int(10) UNSIGNED NOT NULL,
  `UserType` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Username`, `Password`, `UserId`, `UserType`) VALUES
('hlingaraj0', 'toor', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `Regid` int(5) UNSIGNED NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Phone_number` varchar(10) DEFAULT NULL,
  `Address` varchar(20) DEFAULT NULL,
  `Reg_Date` date DEFAULT NULL,
  `Email_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`Regid`, `Name`, `Phone_number`, `Address`, `Reg_Date`, `Email_id`) VALUES
(1, 'Dhanya Ks', '9972877295', 'Sakaleshpur Main Bra', '2020-12-25', 'hlingaraj0');

-- --------------------------------------------------------

--
-- Table structure for table `participated`
--

CREATE TABLE `participated` (
  `Child_id` int(5) NOT NULL,
  `Event_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shortlisted`
--

CREATE TABLE `shortlisted` (
  `ID` int(5) UNSIGNED NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `Marital_status` varchar(15) DEFAULT NULL,
  `Address` varchar(20) DEFAULT NULL,
  `Aadhar` varchar(10) DEFAULT NULL,
  `Voting_id` varchar(20) DEFAULT NULL,
  `Job` varchar(30) DEFAULT NULL,
  `Blood_group` varchar(10) DEFAULT NULL,
  `Income` decimal(13,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adopted`
--
ALTER TABLE `adopted`
  ADD PRIMARY KEY (`Child_id`),
  ADD KEY `Reg_id` (`Reg_id`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`Child_id`),
  ADD KEY `Reg_id` (`Reg_id`);

--
-- Indexes for table `displays`
--
ALTER TABLE `displays`
  ADD KEY `Reg_id` (`Reg_id`),
  ADD KEY `Child_id` (`Child_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`Event_id`);

--
-- Indexes for table `hasoa`
--
ALTER TABLE `hasoa`
  ADD PRIMARY KEY (`Reg_id`),
  ADD KEY `Reg_id` (`Reg_id`),
  ADD KEY `Child_id` (`Child_id`);

--
-- Indexes for table `hasoe`
--
ALTER TABLE `hasoe`
  ADD KEY `Reg_id` (`Reg_id`),
  ADD KEY `Event_id` (`Event_id`);

--
-- Indexes for table `hasof`
--
ALTER TABLE `hasof`
  ADD KEY `Reg_id` (`Reg_id`),
  ADD KEY `Faculty_id` (`Faculty_id`);

--
-- Indexes for table `hasos`
--
ALTER TABLE `hasos`
  ADD KEY `Reg_id` (`Reg_id`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `hassl`
--
ALTER TABLE `hassl`
  ADD KEY `Id` (`Id`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`Regid`);

--
-- Indexes for table `participated`
--
ALTER TABLE `participated`
  ADD KEY `Child_id` (`Child_id`),
  ADD KEY `Event_id` (`Event_id`);

--
-- Indexes for table `shortlisted`
--
ALTER TABLE `shortlisted`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adopted`
--
ALTER TABLE `adopted`
  MODIFY `Child_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `Child_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `Event_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `Regid` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shortlisted`
--
ALTER TABLE `shortlisted`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `displays`
--
ALTER TABLE `displays`
  ADD CONSTRAINT `Child_id` FOREIGN KEY (`Child_id`) REFERENCES `child` (`Child_id`),
  ADD CONSTRAINT `Reg_id` FOREIGN KEY (`Reg_id`) REFERENCES `organisation` (`Regid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
