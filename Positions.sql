-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 13, 2018 at 10:35 PM
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
-- Database: `cs340_habibelo`
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
  `Description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Positions`
--

INSERT INTO `Positions` (`PositionID`, `StartDate`, `Industry`, `EmployeeType`, `Location`, `Salary`, `SkillsWanted`, `Description`) VALUES
(110, '2018-05-01', 'Writing', 'Writer', 'Corvallis, OR', '5000.00', 'Writing', 'We are looking for talented young writers.'),
(118, '2018-06-02', 'Writing', 'Writer', 'Portland, OR', '10000.00', 'Writing', 'We are looking for talented young writers!'),
(119, '2018-07-03', 'Sports', 'Statistician', 'Portland, OR', '50000.00', 'Math, Statistics, Communication', 'We\'re looking for a statistician for our organization!'),
(120, '2018-06-18', 'Life', 'Sidekick', 'New York, NY', '4000.00', 'Sidekick', 'We need a sidekick.'),
(121, '2018-06-01', 'Writing', 'Writer', 'Albany, OR', '5000.00', 'Writing', 'We are looking for a talented student writer.');

--
-- Triggers `Positions`
--
DELIMITER $$
CREATE TRIGGER `deletePositionInformation` AFTER DELETE ON `Positions` FOR EACH ROW BEGIN
IF old.PositionID IS NOT NULL THEN
DELETE FROM Applications
WHERE PositionID = old.PositionID;
DELETE FROM CreatedBy
WHERE PositionID = old.PositionID;
END IF;
END
$$
DELIMITER ;

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
