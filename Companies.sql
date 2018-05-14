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
-- Table structure for table `Companies`
--

CREATE TABLE `Companies` (
  `CompanyID` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Pass` varchar(32) NOT NULL,
  `Description` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Companies`
--

INSERT INTO `Companies` (`CompanyID`, `Name`, `Email`, `Pass`, `Description`) VALUES
(1, 'Example Corp', 'examplecorp@email.com', 'emailpass', 'Example Corp is an example corporation.'),
(2, 'Life Corp', 'life@email.com', 'life', 'Looking for talented writers.'),
(4, 'Engineering Corp', 'engineering@email.com', 'engineering', 'We\'re looking for talented engineers.'),
(11, 'Luthor Industries', 'lex@email.com', 'pass', 'Luthor Industries specializes in killing Superman.'),
(23, 'Painting Inc.', 'painting@email.com', 'password', 'Looking for painters.');

--
-- Triggers `Companies`
--
DELIMITER $$
CREATE TRIGGER `deleteCompanyInformation` AFTER DELETE ON `Companies` FOR EACH ROW BEGIN
IF old.CompanyID IS NOT NULL THEN
DELETE FROM CreatedBy
WHERE CompanyID = old.CompanyID;
DELETE FROM Locations
WHERE CompanyID = old.CompanyID;
END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Companies`
--
ALTER TABLE `Companies`
  ADD PRIMARY KEY (`CompanyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
