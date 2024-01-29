-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 27, 2024 at 07:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tuska_university_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `adminUsername` varchar(255) DEFAULT NULL,
  `adminPassword` varchar(255) DEFAULT NULL,
  `adminEmail` varchar(255) DEFAULT NULL,
  `adminRole` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `adminUsername`, `adminPassword`, `adminEmail`, `adminRole`) VALUES
(3, 'adminregisrar', 'password', 'jamain31@gmail.com', 'registrar'),
(4, 'adminregistrar', 'password', 'jamain31@gmail.com', 'registrar');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourses`
--

CREATE TABLE `tblcourses` (
  `courseID` int(11) NOT NULL,
  `courseName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourses`
--

INSERT INTO `tblcourses` (`courseID`, `courseName`) VALUES
(5, 'CST 499 Capstone for Computer Software Technology');

-- --------------------------------------------------------

--
-- Table structure for table `tblfields`
--

CREATE TABLE `tblfields` (
  `fieldID` int(11) NOT NULL,
  `fieldName` varchar(255) NOT NULL,
  `semesterID` int(11) DEFAULT NULL,
  `courseID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfields`
--

INSERT INTO `tblfields` (`fieldID`, `fieldName`, `semesterID`, `courseID`) VALUES
(3, 'Computer Software Technology', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblsemesters`
--

CREATE TABLE `tblsemesters` (
  `semesterID` int(11) NOT NULL,
  `courseID` int(11) DEFAULT NULL,
  `semesterName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsemesters`
--

INSERT INTO `tblsemesters` (`semesterID`, `courseID`, `semesterName`) VALUES
(1, NULL, 'Summer'),
(2, NULL, 'Spring'),
(3, NULL, 'Winter');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentcourses`
--

CREATE TABLE `tblstudentcourses` (
  `studentID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `studentID` int(11) NOT NULL,
  `studentFirstName` varchar(255) DEFAULT NULL,
  `studentLastName` varchar(255) DEFAULT NULL,
  `studentPhoneNumber` varchar(20) DEFAULT NULL,
  `studentEmail` varchar(255) DEFAULT NULL,
  `studentPassword` varchar(255) DEFAULT NULL,
  `fieldName` varchar(255) DEFAULT NULL,
  `studentAddress` varchar(255) DEFAULT NULL,
  `semesterName` varchar(255) DEFAULT NULL,
  `courseName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`studentID`, `studentFirstName`, `studentLastName`, `studentPhoneNumber`, `studentEmail`, `studentPassword`, `fieldName`, `studentAddress`, `semesterName`, `courseName`) VALUES
(2, 'Jamain', 'Hughes', '205-267-9618', 'jamain31@gmail.com', 'password', 'Computer Software Technology', '1234567', 'Summer', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `tblcourses`
--
ALTER TABLE `tblcourses`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `tblfields`
--
ALTER TABLE `tblfields`
  ADD PRIMARY KEY (`fieldID`),
  ADD KEY `semesterID` (`semesterID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `tblsemesters`
--
ALTER TABLE `tblsemesters`
  ADD PRIMARY KEY (`semesterID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `tblstudentcourses`
--
ALTER TABLE `tblstudentcourses`
  ADD PRIMARY KEY (`studentID`,`courseID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcourses`
--
ALTER TABLE `tblcourses`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblfields`
--
ALTER TABLE `tblfields`
  MODIFY `fieldID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblsemesters`
--
ALTER TABLE `tblsemesters`
  MODIFY `semesterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblfields`
--
ALTER TABLE `tblfields`
  ADD CONSTRAINT `tblfields_ibfk_1` FOREIGN KEY (`semesterID`) REFERENCES `tblsemesters` (`semesterID`),
  ADD CONSTRAINT `tblfields_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `tblcourses` (`courseID`);

--
-- Constraints for table `tblsemesters`
--
ALTER TABLE `tblsemesters`
  ADD CONSTRAINT `tblsemesters_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `tblcourses` (`courseID`);

--
-- Constraints for table `tblstudentcourses`
--
ALTER TABLE `tblstudentcourses`
  ADD CONSTRAINT `tblstudentcourses_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `tblstudents` (`studentID`),
  ADD CONSTRAINT `tblstudentcourses_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `tblcourses` (`courseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
