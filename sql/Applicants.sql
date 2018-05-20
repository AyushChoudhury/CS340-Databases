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
-- Table structure for table `Applicants`
--

CREATE TABLE `Applicants` (
  `ApplicantID` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Pass` varchar(32) NOT NULL,
  `Birthdate` date NOT NULL,
  `Skills` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Applicants`
--

INSERT INTO `Applicants` (`ApplicantID`, `Name`, `Email`, `Pass`, `Birthdate`, `Skills`) VALUES
(11, 'Bob Smith', 'bob@email.com', 'password', '1996-05-01', 'Computera'),
(12, 'Steve Johnson', 'steve@email.com', 'password', '1996-05-01', 'Building'),
(13, 'Guy Fieri', 'guy@email.com', 'password', '1996-05-01', 'Communication, Cooking'),
(15, 'John Cena', 'cena@invisible.com', 'ucantseeme', '1980-07-06', 'Wrestling'),
(44, 'Barack Obama', 'barack@email.gov', 'yeswecan', '1961-08-01', 'Communication, Presidentiality');

--
-- Triggers `Applicants`
--
DELIMITER $$
CREATE TRIGGER `deleteApplicantInformation` AFTER DELETE ON `Applicants` FOR EACH ROW BEGIN
IF old.ApplicantID IS NOT NULL THEN
DELETE FROM Applications
WHERE ApplicantID = old.ApplicantID;
DELETE FROM Feedback
WHERE ApplicantID = old.ApplicantID;
END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Applicants`
--
ALTER TABLE `Applicants`
  ADD PRIMARY KEY (`ApplicantID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
