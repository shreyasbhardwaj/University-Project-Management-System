-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2019 at 03:30 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskmgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `AssignID` int(11) NOT NULL,
  `teacherID` varchar(50) NOT NULL,
  `studentID` varchar(50) NOT NULL,
  `DOA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`AssignID`, `teacherID`, `studentID`, `DOA`, `status`) VALUES
(10, 'ajay882', 'chetan123', '0000-00-00 00:00:00', 0),
(11, 'ajay882', 'pooja123', '0000-00-00 00:00:00', 0),
(12, 'malathi123', 'ram090', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projectconfig`
--

CREATE TABLE `projectconfig` (
  `projectid` int(10) NOT NULL,
  `teacherid` varchar(20) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projectconfig`
--

INSERT INTO `projectconfig` (`projectid`, `teacherid`, `studentid`, `status`) VALUES
(5, 'ajay882', 'chetan123', 40),
(4, 'ajay882', 'chetan123', 30),
(2, 'ajay882', 'chetan123', 30),
(2, 'ajay882', 'pooja123', 30),
(4, 'ajay882', 'pooja123', 0),
(5, 'ajay882', 'pooja123', 40);

-- --------------------------------------------------------

--
-- Table structure for table `projectdetail`
--

CREATE TABLE `projectdetail` (
  `projectID` int(11) NOT NULL,
  `projectName` varchar(60) NOT NULL,
  `teacherID` varchar(50) NOT NULL,
  `ProjectDescription` varchar(200) NOT NULL,
  `LastDate` date NOT NULL,
  `pot` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projectdetail`
--

INSERT INTO `projectdetail` (`projectID`, `projectName`, `teacherID`, `ProjectDescription`, `LastDate`, `pot`) VALUES
(2, 'SRS', 'ajay882', '																																													srs																																													', '2019-05-16', 30),
(4, 'project design', 'ajay882', '						kj														', '2019-05-19', 30),
(5, 'final submittion', 'ajay882', '			jk							', '2019-05-29', 40);

-- --------------------------------------------------------

--
-- Table structure for table `studentprofile`
--

CREATE TABLE `studentprofile` (
  `FirstName` varchar(20) NOT NULL,
  `Last` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `Photo` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `Father` varchar(20) NOT NULL,
  `UserID` varchar(29) NOT NULL,
  `Department` varchar(11) NOT NULL,
  `Semester` varchar(11) NOT NULL,
  `Active` int(1) NOT NULL,
  `extra1` varchar(10) NOT NULL,
  `extra2` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentprofile`
--

INSERT INTO `studentprofile` (`FirstName`, `Last`, `Gender`, `Address`, `Photo`, `mobile`, `Father`, `UserID`, `Department`, `Semester`, `Active`, `extra1`, `extra2`) VALUES
('admin', 'admin', 'other', '', '', '', '', 'admin', 'admin', '', 1, 'a', ''),
('AJAY', 'DHOOT', 'male', 'BEAWAR', 'admenu.html.txt', '9414668882', '', 'ajay882', 'MCA', '25000', 1, 't', 'Lecturer'),
('CHETAN', 'SAMARIYA', 'male', 'BEAWAR', 'logintest.php', '7742666090', 'MADAN', 'chetan123', 'MCA', '1', 0, 's', ''),
('malathi', 'kumari', '', 'Bikaner', '', '8811432567', '', 'malathi123', 'MBA', '60000', 1, 't', 'Lecturer'),
('pooja', 'singh', 'female', 'jaipur', '', '1122334455', 'xxx', 'pooja123', 'MCA', '1', 0, 's', ''),
('ram', 'singh', 'male', 'jaipur', '', '9414009956', 'xxx', 'ram090', 'MBA', '2', 0, 's', '');

-- --------------------------------------------------------

--
-- Table structure for table `tskattch`
--

CREATE TABLE `tskattch` (
  `attid` int(11) NOT NULL,
  `projectid` varchar(50) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `atfilen` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tskattch`
--

INSERT INTO `tskattch` (`attid`, `projectid`, `studentid`, `atfilen`, `date`) VALUES
(1, '2', 'chetan123', 'assets/images/upload/img6.jpg', '2019-05-20 17:23:47'),
(2, '2', 'chetan123', 'assets/images/upload/img7.jpg', '2019-05-20 17:23:47'),
(3, '4', 'chetan123', 'assets/images/upload/img3.jpg', '2019-05-20 17:49:13'),
(4, '4', 'chetan123', 'assets/images/upload/img7.jpg', '2019-05-20 17:49:13'),
(5, '5', 'chetan123', 'assets/images/upload/img3.jpg', '2019-05-20 18:18:51'),
(6, '5', 'pooja123', 'assets/images/upload/img6.jpg', '2019-05-20 18:59:16'),
(7, '5', 'pooja123', 'assets/images/upload/img7.jpg', '2019-05-20 18:59:16'),
(8, '2', 'pooja123', 'assets/images/upload/img5.jpg', '2019-05-20 18:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `userloginfor`
--

CREATE TABLE `userloginfor` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userloginfor`
--

INSERT INTO `userloginfor` (`username`, `password`) VALUES
('admin', 'admin'),
('ajay882', 'admin'),
('chetan123', 'admin'),
('malathi123', 'admin'),
('pooja123', 'admin'),
('ram090', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`AssignID`);

--
-- Indexes for table `projectdetail`
--
ALTER TABLE `projectdetail`
  ADD PRIMARY KEY (`projectID`);

--
-- Indexes for table `studentprofile`
--
ALTER TABLE `studentprofile`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `tskattch`
--
ALTER TABLE `tskattch`
  ADD PRIMARY KEY (`attid`);

--
-- Indexes for table `userloginfor`
--
ALTER TABLE `userloginfor`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
  MODIFY `AssignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `projectdetail`
--
ALTER TABLE `projectdetail`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tskattch`
--
ALTER TABLE `tskattch`
  MODIFY `attid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
