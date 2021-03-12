-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2019 at 09:12 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mhsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

CREATE TABLE IF NOT EXISTS `allocation` (
  `allocationID` int(5) NOT NULL DEFAULT '0',
  `fromDate` date DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `applicationID` int(5) DEFAULT NULL,
  `unitNo` int(5) DEFAULT NULL,
  PRIMARY KEY (`allocationID`),
  KEY `applicationID` (`applicationID`),
  KEY `unitNo` (`unitNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `applicantID` int(5) NOT NULL DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  `monthlyIncome` decimal(8,2) DEFAULT NULL,
  `userID` int(5) DEFAULT NULL,
  `paySlip` longblob,
  PRIMARY KEY (`applicantID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`applicantID`, `email`, `monthlyIncome`, `userID`, `paySlip`) VALUES
(1, 'rickytan@gmail.com', 3500.00, 1, NULL),
(2, 'tantan@gmail.com', 2800.00, 3, NULL),
(3, 'tester@gmail.com', 50000.00, 4, NULL),
(4, 'app@gmail.com', 1234.00, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `applicationID` int(5) NOT NULL DEFAULT '0',
  `applicationDate` date DEFAULT NULL,
  `requiredMonth` int(5) DEFAULT NULL,
  `requiredYear` int(5) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `applicantID` int(5) DEFAULT NULL,
  `residenceID` int(5) DEFAULT NULL,
  `favourite` tinyint(1) DEFAULT NULL,
  `appealed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`applicationID`),
  KEY `applicantID` (`applicantID`,`residenceID`),
  KEY `residenceID` (`residenceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationID`, `applicationDate`, `requiredMonth`, `requiredYear`, `status`, `applicantID`, `residenceID`, `favourite`, `appealed`) VALUES
(1, '2019-11-22', 1, 2, 'New', 1, 2, 1, 0),
(2, '2019-11-12', 4, 4, 'Approved', 2, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `housingofficer`
--

CREATE TABLE IF NOT EXISTS `housingofficer` (
  `staffID` int(5) NOT NULL DEFAULT '0',
  `userID` int(5) DEFAULT NULL,
  PRIMARY KEY (`staffID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `housingofficer`
--

INSERT INTO `housingofficer` (`staffID`, `userID`) VALUES
(1, 2),
(2, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `residence`
--

CREATE TABLE IF NOT EXISTS `residence` (
  `residenceID` int(5) NOT NULL DEFAULT '0',
  `residenceName` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `numUnits` int(50) DEFAULT NULL,
  `sizePerUnit` int(50) DEFAULT NULL,
  `monthlyRental` decimal(8,2) DEFAULT NULL,
  `image` longblob,
  `staffID` int(5) DEFAULT NULL,
  PRIMARY KEY (`residenceID`),
  KEY `staffID` (`staffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `residence`
--

INSERT INTO `residence` (`residenceID`, `residenceName`, `address`, `numUnits`, `sizePerUnit`, `monthlyRental`, `image`, `staffID`) VALUES
(1, 'Flora Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 12, 800, 1300.00, NULL, 1),
(2, 'Avenue Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 12, 1200, 1500.00, NULL, 1),
(3, 'Genting Residence', '2, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 19, 12, 12.00, NULL, 1),
(4, 'A Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 0, 800, 865.00, NULL, 1),
(5, 'B Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 15, 544, 646.00, NULL, 1),
(6, 'C Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 1, 765, 644.00, NULL, 1),
(7, 'D Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 4, 655, 434.00, NULL, 1),
(8, 'E Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 6, 654, 3434.00, NULL, 1),
(9, 'F Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 1, 734, 5554.00, NULL, 1),
(10, 'G Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 777, 743, 3531.00, NULL, 1),
(11, 'H Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 23, 345, 12315.00, NULL, 1),
(12, 'I Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 11, 855, 1231.00, NULL, 1),
(13, 'J Residence', '1, Jalan Kepong A3/12, Metro Prima, 52100 Kepong, Kuala Lumpur.', 9, 754, 1233.00, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `unitNo` int(5) NOT NULL DEFAULT '0',
  `availability` tinyint(1) DEFAULT NULL,
  `residenceID` int(5) DEFAULT NULL,
  PRIMARY KEY (`unitNo`),
  KEY `residenceID` (`residenceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unitNo`, `availability`, `residenceID`) VALUES
(1, 1, 1),
(2, 0, 1),
(3, 1, 2),
(4, 1, 2),
(5, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(5) NOT NULL DEFAULT '0',
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fullname` varchar(30) DEFAULT NULL,
  `userType` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `fullname`, `userType`) VALUES
(1, 'ricky', '575d7546a23d1c2952dc044104293462', 'Ricky Tan', 'Applicant'),
(2, 'officer', 'f611cd1f8f91638960d2d20b29f5c9ba', 'First Officer', 'HousingOfficer'),
(3, 'tan', '38040d2bbad2296223c15c51fb7dcf8e', 'TanTan', 'Applicant'),
(4, 'Tester', 'cc03e747a6afbbcbf8be7668acfebee5', 'test123', 'Applicant'),
(5, 'ho_officer', '762097f801698400e2bb434de53f5548', 'HO Officer', 'HousingOfficer'),
(6, 'User1', '6ad14ba9986e3615423dfca256d04e3f', 'User1', 'HousingOfficer'),
(7, 'app', 'db71ba971de545590a39e7dfa51ded2f', 'App', 'Applicant');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocation`
--
ALTER TABLE `allocation`
  ADD CONSTRAINT `allocation_ibfk_1` FOREIGN KEY (`applicationID`) REFERENCES `application` (`applicationID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allocation_ibfk_2` FOREIGN KEY (`unitNo`) REFERENCES `unit` (`unitNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`applicantID`) REFERENCES `applicant` (`applicantID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`residenceID`) REFERENCES `residence` (`residenceID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `housingofficer`
--
ALTER TABLE `housingofficer`
  ADD CONSTRAINT `housingofficer_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `residence`
--
ALTER TABLE `residence`
  ADD CONSTRAINT `residence_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `housingofficer` (`staffID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`residenceID`) REFERENCES `residence` (`residenceID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
