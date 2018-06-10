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
-- Table structure for table `Applicants`
--

CREATE TABLE `Applicants` (
  `ApplicantID` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Pass` varchar(70) NOT NULL,
  `Birthdate` date NOT NULL,
  `Skills` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Applicants`
--

INSERT INTO `Applicants` (`ApplicantID`, `Name`, `Email`, `Pass`, `Birthdate`, `Skills`) VALUES
(12, 'Steve Johnson', 'steve@email.com', 'password', '1996-05-01', 'Building'),
(13, 'Guy Fieri', 'guy@email.com', 'password', '1996-05-01', 'Communication, Cooking'),
(15, 'John Cena', 'cena@invisible.com', 'ucantseeme', '1980-07-06', 'Wrestling'),
(44, 'Barack Obama', 'barack@email.gov', 'yeswecan', '1961-08-01', 'Communication, Presidentiality'),
(45, 'test', 'test@test', '??D4???@iD?M^R??|5c9a7ceb441537a', '2009-09-09', 'test'),
(46, 'Omeed Habibelahian', 'habibelo@oregonstate.edu', 'fuxq6m718g417na4|a21c58ca505ae3fa7edea4b5f8d7c7514d219702ce521fea43', '1995-09-26', 'skillz'),
(47, 'Shreyans Khunteta', 'shrey@gmail.com', 'dvdpa43u4yfyswj7|11776274e1aa44b8a340110440b1babf60df86848c81b2019d', '1996-06-16', 'Computer Science, Shitposting'),
(48, 'Shreyans Khunteta', 'shrey1@gmail.com', 'mijajkrrhbxcx2be|a75f8a85199ec079dbe954f97c390ba443aa6f068a2c13381d', '1996-07-16', 'Computer Science, Shitposting'),
(49, 'Ayush', 'choudhay@oregonstate.edu', 'k0fw2b605qjivut4|beae3e7b4becc82548c87218267c8bcac594220956f76d2af2', '1998-04-18', 'pure awesomeness'),
(50, 'Shrey', 'khuntets@gmail.com', '2ub4gtjkk76d5qal|07d012cadcee7e11f36739223f77e462abc22dae7fb76628c7', '7200-07-07', 'Computer Science, Shitposting'),
(51, 'Ayush', 'ayush838@gmail.com', '0vvefod2rt2td4gh|41c73148ca92158d540c85a575fab6e6dc6b78e2df86214ad1', '1998-04-18', 'extreme good looks'),
(52, 'Shrey', 'shrey2@gmail.com', '4hb0bqgldvnkl3d0|9d92726131126553d85f6d936efd8ed4ee265bf6b76d17b129', '1996-07-16', 'Computer Science, Shitposting'),
(53, 'John Smith', 'johnsmith@gmail.com', 'yeiquv4mt26eg34y|0b38900c6e582e8c41e759a29a6e54f1511dc21763183b816c', '1987-09-19', 'Computer Science'),
(54, 'Bill Johnson', 'billjohnson@gmail.com', '3whbsckwep297heo|31450d7b7b5b13cbd34be0995a6ae7a384053e8719f12dc32e', '1993-08-24', 'Music'),
(55, 'Omeed Habibelahian', 'omeed.habibelahian@gmail.com', 'zchjl2efhz4uzsyg|ad29d28d67acea9b9f85bfc81a831f190991b2878f2d16fcdf', '1995-09-26', 'SKILLZ'),
(56, 'Thomas', 'test@example.com', 'vt8zmpf2m5zlzkke|3d343a68d9de2650a44fc7a4d2ca8bff3beeb54276db5c50d5', '0009-11-12', 'CS, JS'),
(57, 'Alex Morefield', 'ayy@lmao.net', 'yfzvp93dhcdem9be|7f90f8cbd46f81daea7be55e16fe71071b85ec970a7757840c', '1996-10-18', 'Eating,Breathing,Walking(sort of)'),
(58, 'Cloud Strife', 'Could_Strife777@gmail.com', '8qpzz2zj6c92yj16|2423d7cb74ab524ad6669a919f72ad1858ff0a46289090aae9', '1997-09-20', 'Mercenary, Omnislash, I\'ll bring my own oversized sword'),
(59, 'Unemployed', 'unemployed@email.com', '04r3tv91v7mctwic|4b79ee148600dd9801817f6ce5bcef3ecf5fbe71ac10bdd092', '1111-01-01', 'Being broke');

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
