-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 13, 2018 at 10:34 PM
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
-- Table structure for table `CreatedBy`
--

CREATE TABLE `CreatedBy` (
  `PositionID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `ContactInfo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CreatedBy`
--

INSERT INTO `CreatedBy` (`PositionID`, `CompanyID`, `ContactInfo`) VALUES
(110, 4, '111-111-1111'),
(118, 1, '222-222-2222'),
(119, 2, '111-111-1112'),
(119, 11, '111-111-1122'),
(121, 23, '121-121-1212');

--
-- Triggers `CreatedBy`
--
DELIMITER $$
CREATE TRIGGER `deleteCreatedByPosition` AFTER DELETE ON `CreatedBy` FOR EACH ROW BEGIN
IF old.PositionID IS NOT NULL THEN
DELETE FROM Positions
WHERE PositionID = old.PositionID;
END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CreatedBy`
--
ALTER TABLE `CreatedBy`
  ADD PRIMARY KEY (`PositionID`,`CompanyID`),
  ADD KEY `created_by_delete` (`CompanyID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CreatedBy`
--
ALTER TABLE `CreatedBy`
  ADD CONSTRAINT `CreatedBy_ibfk_1` FOREIGN KEY (`PositionID`) REFERENCES `Positions` (`PositionID`),
  ADD CONSTRAINT `CreatedBy_ibfk_2` FOREIGN KEY (`CompanyID`) REFERENCES `Companies` (`CompanyID`),
  ADD CONSTRAINT `created_by_delete` FOREIGN KEY (`CompanyID`) REFERENCES `Companies` (`CompanyID`) ON DELETE CASCADE,
  ADD CONSTRAINT `position_created_by_delete` FOREIGN KEY (`PositionID`) REFERENCES `Positions` (`PositionID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
