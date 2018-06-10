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
-- Table structure for table `Companies`
--

CREATE TABLE `Companies` (
  `CompanyID` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Pass` varchar(70) NOT NULL,
  `Description` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Companies`
--

INSERT INTO `Companies` (`CompanyID`, `Name`, `Email`, `Pass`, `Description`) VALUES
(1, 'Shinra Corp', 'shinraco@gmail.com', 'i6s5yd1vtpu1je59|4e599320be6f970792ed87bf2b09b50288735603ac5d65a663', 'We drain the planet of it natural resources'),
(2, 'Avalanche', 'avalanche@gmail.com', 's880001bcluwibbf|bf1dde78035d552df1edf08d6af4ba9f225e378e559f8dc531', 'We destroy shinra factories to stop them from draining the planet of its natural resources'),
(3, 'Organization XIII', 'oxiii@gmail.com', 'do2mj4e5mo9hb3gl|cc683930e6b3443c63dcfdccb4739f1da818e5f594c78b6446', 'Just a bunch of Nobodies'),
(4, 'Ayush', 'ayush838@gmail.com', '9ogvv5sajjdxs3c4|d2532f7fcc4f6f3aa4de4534b7bad32ddf7959b09808f2010f', ''),
(5, 'Me', 'Nah@woow.goduckyourself.god', 'ebl39i151z0t0rfk|b737a5efcb0700fbc66dac7bee7bd7cc543c2a3c04d39b096a', 'hey nice website I guess'),
(6, 'EVIL Corp', 'evil@email.com', 'ez1z2aieejj15932|c45d012f63b0a0e168f5ee4e7ed4dd60b06b29b1a5e7271046', 'evil');

--
-- Triggers `Companies`
--
DELIMITER $$
CREATE TRIGGER `deleteCompanyInformation` AFTER DELETE ON `Companies` FOR EACH ROW BEGIN
IF old.CompanyID IS NOT NULL THEN

DELETE FROM Positions
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
