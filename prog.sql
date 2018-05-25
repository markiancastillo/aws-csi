-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2018 at 07:41 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prog`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL,
  `accountUN` varchar(150) NOT NULL,
  `accountPW` varchar(300) NOT NULL,
  `accountStatus` tinyint(5) NOT NULL COMMENT '1-active; 2-pending; 0-inactive',
  `userID` int(11) NOT NULL COMMENT 'Specifies who owns the account'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `costsavings`
--

CREATE TABLE `costsavings` (
  `csID` int(11) NOT NULL,
  `csDesc` varchar(1000) NOT NULL,
  `csActor` varchar(100) NOT NULL,
  `csDate` date NOT NULL,
  `csSavings` decimal(10,2) NOT NULL,
  `csInitial` varchar(200) NOT NULL COMMENT 'image path for the initial screenshot',
  `csFinal` varchar(200) NOT NULL COMMENT 'image path for the final screenshot',
  `teamID` int(11) NOT NULL COMMENT 'FK that connects data from journeyteams',
  `techID` int(11) NOT NULL COMMENT 'FK that connects data from technologies',
  `envID` int(11) NOT NULL COMMENT 'FK that connects data from environments',
  `typeID` int(11) NOT NULL COMMENT 'FK that connects data from savingtypes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costsavings`
--


-- --------------------------------------------------------

--
-- Table structure for table `environments`
--

CREATE TABLE `environments` (
  `envID` int(11) NOT NULL,
  `envName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `environments`
--

INSERT INTO `environments` (`envID`, `envName`) VALUES
(1, 'Development'),
(2, 'Quality Assurance'),
(3, 'Production');

-- --------------------------------------------------------

--
-- Table structure for table `journeyteams`
--

CREATE TABLE `journeyteams` (
  `teamID` int(11) NOT NULL,
  `teamName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journeyteams`
--

INSERT INTO `journeyteams` (`teamID`, `teamName`) VALUES
(1, 'CEP'),
(2, 'DHC'),
(3, 'Memories'),
(4, 'Test'),
(5, 'My Team');

-- --------------------------------------------------------

--
-- Table structure for table `savingtypes`
--

CREATE TABLE `savingtypes` (
  `typeID` int(11) NOT NULL,
  `typeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savingtypes`
--

INSERT INTO `savingtypes` (`typeID`, `typeName`) VALUES
(1, 'Cleanup'),
(2, 'Right Sizing'),
(3, 'Reconfiguration');

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE `technologies` (
  `techID` int(11) NOT NULL,
  `techName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `technologies`
--

INSERT INTO `technologies` (`techID`, `techName`) VALUES
(1, 'ELB'),
(2, 'AWS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userFN` varchar(100) NOT NULL,
  `userLN` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `costsavings`
--
ALTER TABLE `costsavings`
  ADD PRIMARY KEY (`csID`),
  ADD KEY `envID` (`envID`),
  ADD KEY `teamID` (`teamID`),
  ADD KEY `costsavings_ibfk_3` (`techID`),
  ADD KEY `costsavings_ibfk_4` (`typeID`);

--
-- Indexes for table `environments`
--
ALTER TABLE `environments`
  ADD PRIMARY KEY (`envID`);

--
-- Indexes for table `journeyteams`
--
ALTER TABLE `journeyteams`
  ADD PRIMARY KEY (`teamID`);

--
-- Indexes for table `savingtypes`
--
ALTER TABLE `savingtypes`
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`techID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `costsavings`
--
ALTER TABLE `costsavings`
  MODIFY `csID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `environments`
--
ALTER TABLE `environments`
  MODIFY `envID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `journeyteams`
--
ALTER TABLE `journeyteams`
  MODIFY `teamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `savingtypes`
--
ALTER TABLE `savingtypes`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `technologies`
--
ALTER TABLE `technologies`
  MODIFY `techID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `costsavings`
--
ALTER TABLE `costsavings`
  ADD CONSTRAINT `costsavings_ibfk_1` FOREIGN KEY (`envID`) REFERENCES `environments` (`envID`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `costsavings_ibfk_2` FOREIGN KEY (`teamID`) REFERENCES `journeyteams` (`teamID`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `costsavings_ibfk_3` FOREIGN KEY (`techID`) REFERENCES `technologies` (`techID`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `costsavings_ibfk_4` FOREIGN KEY (`typeID`) REFERENCES `savingtypes` (`typeID`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
