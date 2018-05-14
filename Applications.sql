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
-- Table structure for table `Applications`
--

CREATE TABLE `Applications` (
  `ApplicationID` int(11) NOT NULL,
  `ResumeCV` varchar(16384) NOT NULL,
  `CoverLetter` mediumtext NOT NULL,
  `ApplicantID` int(11) NOT NULL,
  `PositionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Applications`
--

INSERT INTO `Applications` (`ApplicationID`, `ResumeCV`, `CoverLetter`, `ApplicantID`, `PositionID`) VALUES
(12, 'Resume text goes here.', 'Cover letter goes here.', 44, 110),
(13, 'Another resume!', 'This is my cover letter text.', 11, 118),
(14, 'My CV rocks!', 'This is my awesome cover letter.', 13, 120),
(15, 'RESUME', 'COVER LETTER', 15, 119),
(20, 'This is my fantastic resume.', 'This is why I know I\'m qualified for the job.', 12, 110);

--
-- Triggers `Applications`
--
DELIMITER $$
CREATE TRIGGER `deleteApplicationReferences` AFTER DELETE ON `Applications` FOR EACH ROW BEGIN
IF old.ApplicationID IS NOT NULL THEN
DELETE FROM Reference
WHERE ApplicationID = old.ApplicationID;
END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Applications`
--
ALTER TABLE `Applications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `application_delete` (`ApplicantID`),
  ADD KEY `position_application_delete` (`PositionID`) USING BTREE;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Applications`
--
ALTER TABLE `Applications`
  ADD CONSTRAINT `Applications_ibfk_1` FOREIGN KEY (`ApplicantID`) REFERENCES `Applicants` (`ApplicantID`),
  ADD CONSTRAINT `Applications_ibfk_2` FOREIGN KEY (`PositionID`) REFERENCES `Positions` (`PositionID`),
  ADD CONSTRAINT `application_delete` FOREIGN KEY (`ApplicantID`) REFERENCES `Applicants` (`ApplicantID`) ON DELETE CASCADE,
  ADD CONSTRAINT `position_appli_delete` FOREIGN KEY (`PositionID`) REFERENCES `Positions` (`PositionID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
