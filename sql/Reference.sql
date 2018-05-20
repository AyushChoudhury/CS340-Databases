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
-- Table structure for table `Reference`
--

CREATE TABLE `Reference` (
  `ApplicationID` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `PhoneNumber` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Reference`
--

INSERT INTO `Reference` (`ApplicationID`, `Name`, `Email`, `PhoneNumber`) VALUES
(14, 'Bruce Wayne', 'batman@email.com', '666-666-6666'),
(20, 'Elon Musk', 'musk@email.com', '777-777-7777'),
(13, 'Mahatma Gandhi', 'gandhi@email.com', '888-888-8888'),
(15, 'Nelson Mandela', 'mandela@email.com', '999-999-9999'),
(12, 'Snoop Dogg', 'dogg@email.com', '555-555-5555');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Reference`
--
ALTER TABLE `Reference`
  ADD PRIMARY KEY (`Name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Reference`
--
ALTER TABLE `Reference`
  ADD CONSTRAINT `Reference_ibfk_1` FOREIGN KEY (`ApplicationID`) REFERENCES `Applications` (`ApplicationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
