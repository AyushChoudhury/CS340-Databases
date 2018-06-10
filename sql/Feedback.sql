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
-- Table structure for table `Feedback`
--

CREATE TABLE `Feedback` (
  `FeedbackID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Comment` varchar(256) NOT NULL,
  `ApplicantID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Feedback`
--

INSERT INTO `Feedback` (`FeedbackID`, `Rating`, `Comment`, `ApplicantID`, `CompanyID`) VALUES
(2, 4, 'nice!', 46, 3),
(3, 5, 'Awesome!', 55, 3),
(4, 4, 'This is my feedback!', 55, 3),
(5, 4, 'I had a great experience with O13!', 55, 3),
(6, 1, 'Overly ambitious executives. Retirement benefits were very underwhelming. Also created an all powerful alien clone that tried to destroy the planet.', 58, 1),
(7, 3, 'EVIL...', 58, 6),
(8, 5, 'Totally awesome!! Great worker safety! Haha just kidding everyone but me and the boss died (spoiler alert!)', 58, 2),
(9, 1, 'bad', 47, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `Feedback_ibfk_1` (`ApplicantID`),
  ADD KEY `Feedback_ibfk_2` (`CompanyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD CONSTRAINT `Feedback_ibfk_1` FOREIGN KEY (`ApplicantID`) REFERENCES `Applicants` (`ApplicantID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Feedback_ibfk_2` FOREIGN KEY (`CompanyID`) REFERENCES `Companies` (`CompanyID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
