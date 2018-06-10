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
-- Table structure for table `Applications`
--

CREATE TABLE `Applications` (
  `ApplicationID` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `ResumeCV` varchar(16384) NOT NULL,
  `CoverLetter` mediumtext NOT NULL,
  `ApplicantID` int(11) NOT NULL,
  `PositionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Applications`
--

INSERT INTO `Applications` (`ApplicationID`, `dateCreated`, `ResumeCV`, `CoverLetter`, `ApplicantID`, `PositionID`) VALUES
(12, '0000-00-00 00:00:00', 'Resume text goes here.', 'Cover letter goes here.', 44, 110),
(20, '0000-00-00 00:00:00', 'This is my fantastic resume.', 'This is why I know I\'m qualified for the job.', 12, 110),
(21, '2018-05-27 20:23:24', 'resume', 'cover letter', 46, 110),
(22, '2018-05-27 20:28:08', 'resume!', 'cover letter goes here!', 46, 121),
(23, '2018-06-05 19:20:51', 'Cloud Strife\r\n\r\njob 1\r\n\r\nSOLDIER                                                 When I started - present\r\nShinra Crop                             ', 'To whom it may concern,\r\n\r\nI writing to express my strong interest in the \"Writer\" position at Avalanche *wink*. I have a bunch of experience doing Shinra\'s dirty work for the last few years, but I\'m not sure I can read or write.  Contact me at my email Cloud_Strife777@gmail.com. ', 58, 110);

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
DELIMITER $$
CREATE TRIGGER `increment_app_count` AFTER INSERT ON `Applications` FOR EACH ROW BEGIN
IF new.PositionID IS NOT NULL THEN
	UPDATE Positions P
	SET P.app_count = P.app_count+1
	WHERE P.PositionID = new.PositionID;
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
  ADD KEY `Applications_ibfk_1` (`ApplicantID`),
  ADD KEY `Applications_ibfk_2` (`PositionID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Applications`
--
ALTER TABLE `Applications`
  ADD CONSTRAINT `Applications_ibfk_1` FOREIGN KEY (`ApplicantID`) REFERENCES `Applicants` (`ApplicantID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Applications_ibfk_2` FOREIGN KEY (`PositionID`) REFERENCES `Positions` (`PositionID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
