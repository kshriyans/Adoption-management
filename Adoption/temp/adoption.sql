-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2020 at 11:23 AM
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
  `Child_id` varchar(5) NOT NULL,
  `Parent_id` varchar(5) DEFAULT NULL,
  `Child_name` varchar(10) DEFAULT NULL,
  `Parent_Name` varchar(10) DEFAULT NULL,
  `Child_Gender` varchar(6) DEFAULT NULL,
  `Weight` float(7,4) DEFAULT NULL,
  `Blood_group` varchar(5) DEFAULT NULL,
  `Height` float(7,4) DEFAULT NULL,
  `Marital_status` varchar(3) DEFAULT NULL,
  `DOA` date DEFAULT NULL,
  `Address` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `Child_id` varchar(5) NOT NULL,
  `Name` varchar(10) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `Weight` float(7,4) DEFAULT NULL,
  `Height` float(7,4) DEFAULT NULL,
  `Blood_group` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `displays`
--

CREATE TABLE `displays` (
  `Reg_id` varchar(5) NOT NULL,
  `Child_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `Event_id` varchar(5) NOT NULL,
  `Name` varchar(10) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Winner` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasoa`
--

CREATE TABLE `hasoa` (
  `Reg_id` varchar(5) NOT NULL,
  `Child_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasoe`
--

CREATE TABLE `hasoe` (
  `Reg_id` varchar(5) NOT NULL,
  `Event_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasof`
--

CREATE TABLE `hasof` (
  `Reg_id` varchar(5) NOT NULL,
  `Faculty_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasos`
--

CREATE TABLE `hasos` (
  `Reg_id` varchar(5) NOT NULL,
  `ID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hassl`
--

CREATE TABLE `hassl` (
  `Id` varchar(5) NOT NULL,
  `Username` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Username` varchar(10) NOT NULL,
  `Password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `Regid` varchar(5) NOT NULL,
  `Name` varchar(10) DEFAULT NULL,
  `Phone_number` varchar(10) DEFAULT NULL,
  `Address` varchar(20) DEFAULT NULL,
  `Reg_Date` date DEFAULT NULL,
  `Email_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `participated`
--

CREATE TABLE `participated` (
  `Child_id` varchar(5) NOT NULL,
  `Event_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shortlisted`
--

CREATE TABLE `shortlisted` (
  `ID` varchar(5) NOT NULL,
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
  ADD PRIMARY KEY (`Child_id`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`Child_id`);

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
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Username`);

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
-- Constraints for dumped tables
--

--
-- Constraints for table `displays`
--
ALTER TABLE `displays`
  ADD CONSTRAINT `displays_ibfk_1` FOREIGN KEY (`Reg_id`) REFERENCES `organisation` (`Regid`),
  ADD CONSTRAINT `displays_ibfk_2` FOREIGN KEY (`Child_id`) REFERENCES `child` (`Child_id`);

--
-- Constraints for table `hasoa`
--
ALTER TABLE `hasoa`
  ADD CONSTRAINT `hasoa_ibfk_1` FOREIGN KEY (`Reg_id`) REFERENCES `organisation` (`Regid`),
  ADD CONSTRAINT `hasoa_ibfk_2` FOREIGN KEY (`Child_id`) REFERENCES `adopted` (`Child_id`);

--
-- Constraints for table `hasoe`
--
ALTER TABLE `hasoe`
  ADD CONSTRAINT `hasoe_ibfk_1` FOREIGN KEY (`Reg_id`) REFERENCES `organisation` (`Regid`),
  ADD CONSTRAINT `hasoe_ibfk_2` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`);

--
-- Constraints for table `hasof`
--
ALTER TABLE `hasof`
  ADD CONSTRAINT `hasof_ibfk_1` FOREIGN KEY (`Reg_id`) REFERENCES `organisation` (`Regid`);

--
-- Constraints for table `hasos`
--
ALTER TABLE `hasos`
  ADD CONSTRAINT `hasos_ibfk_1` FOREIGN KEY (`Reg_id`) REFERENCES `organisation` (`Regid`),
  ADD CONSTRAINT `hasos_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `shortlisted` (`ID`);

--
-- Constraints for table `hassl`
--
ALTER TABLE `hassl`
  ADD CONSTRAINT `hassl_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `shortlisted` (`ID`),
  ADD CONSTRAINT `hassl_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `login` (`Username`);

--
-- Constraints for table `participated`
--
ALTER TABLE `participated`
  ADD CONSTRAINT `participated_ibfk_1` FOREIGN KEY (`Child_id`) REFERENCES `child` (`Child_id`),
  ADD CONSTRAINT `participated_ibfk_2` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
