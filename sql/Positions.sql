-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: Jun 09, 2018 at 03:18 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_choudhay`
--

-- --------------------------------------------------------

--
-- Table structure for table `Positions`
--

CREATE TABLE `Positions` (
  `PositionID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `Industry` varchar(32) NOT NULL,
  `EmployeeType` varchar(32) NOT NULL,
  `Location` varchar(128) NOT NULL,
  `Salary` decimal(9,2) NOT NULL,
  `SkillsWanted` varchar(128) NOT NULL,
  `Description` varchar(256) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `app_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Positions`
--

INSERT INTO `Positions` (`PositionID`, `StartDate`, `Industry`, `EmployeeType`, `Location`, `Salary`, `SkillsWanted`, `Description`, `CompanyID`, `app_count`) VALUES
(110, '2018-05-01', 'Writing', 'Writer', 'Corvallis, OR', '5000.00', 'Writing', 'We are looking for talented young writers.', 2, 2),
(121, '2018-06-01', 'Writing', 'Writer', 'Albany, OR', '5000.00', 'Writing', 'We are looking for a talented student writer.', 1, 1),
(122, '2018-08-01', 'Electrical Engineering', 'Electrical Computer Engineer', 'Beaverton, OR', '15000.00', 'Assembly, Coding', 'Electrical computer stuff', 1, 0),
(123, '2019-01-01', 'Evil', 'Supervillain', 'New York City', '9999999.99', 'Villainry', 'Doing EVIL', 6, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Positions`
--
ALTER TABLE `Positions`
  ADD PRIMARY KEY (`PositionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
