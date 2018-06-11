-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 04:40 PM
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

INSERT INTO `accounts` (`accountID`, `accountUN`, `accountPW`, `accountStatus`, `userID`) VALUES
(1, 'admin@mail.com', '12345', 1, 1),
(2, 'example@example.com', '$2y$10$FtCpvMlFiQyMvzEThycOoeZd0PBdXr/e8aErCupdF/rUoPwbAS5xi', 2, 2),
(3, 'antonio@mail.com', '$2y$10$unzGJA.WK.NPcxSB.CPYnOHPOxfJ6jQ0Jib4hIqclExW/DiJ1Setq', 2, 3),
(4, 'mail@example.com', '$2y$10$lmPiSB5lTY6epDEG1kQM6OuD1a.z6oGk1x5Y/I7dxYGW6UlAskEO.', 1, 4),
(5, 'screenshotlayerapi@mail.com', '$2y$10$tM2fqOHQ/BemNqvTLzaleO2iX.w9x.U7ZhxZgAp4HghB0YjeLI9Oi', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `costsavings`
--

CREATE TABLE `costsavings` (
  `csID` int(11) NOT NULL,
  `csCause` varchar(1000) NOT NULL COMMENT 'Description for the root cause of the problem',
  `csSteps` varchar(1000) NOT NULL COMMENT 'Description for the steps taken in resolving the problem',
  `csActor` varchar(100) NOT NULL,
  `csDate` date NOT NULL,
  `csSavings` decimal(10,2) NOT NULL COMMENT 'The final total cost of the savings from the initial and final input (computed automatically)',
  `csInitial` decimal(10,2) NOT NULL COMMENT 'The initial cost input',
  `csFinal` decimal(10,2) NOT NULL COMMENT 'The final cost input after the steps taken ',
  `teamID` int(11) NOT NULL COMMENT 'FK that connects data from journeyteams',
  `techID` int(11) NOT NULL COMMENT 'FK that connects data from technologies',
  `envID` int(11) NOT NULL COMMENT 'FK that connects data from environments',
  `typeID` int(11) NOT NULL COMMENT 'FK that connects data from savingtypes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costsavings`
--

INSERT INTO `costsavings` (`csID`, `csCause`, `csSteps`, `csActor`, `csDate`, `csSavings`, `csInitial`, `csFinal`, `teamID`, `techID`, `envID`, `typeID`) VALUES
(1, 'Sample input 1', 'Sample input 1', 'Mark Castillo', '2018-06-01', '40.00', '250.00', '210.00', 1, 1, 1, 1),
(2, 'Test input 2', 'Test input 2', 'Mark Castillo', '2018-06-01', '75.00', '150.00', '75.00', 4, 2, 2, 2),
(3, 'Sample text input for the new cost savings data.', 'Sample text input for the solution implemented.', 'Mark Castillo', '2018-06-04', '100.00', '250.00', '150.00', 4, 1, 2, 3),
(4, 'lorem ipsum', 'lorem ipsum', 'Mark Castillo*', '2018-06-05', '100.00', '200.00', '100.00', 4, 2, 1, 3),
(5, 'details ', 'solutions', 'Mark Castillo*', '2018-06-05', '60.00', '260.00', '200.00', 2, 2, 1, 1),
(6, 'lorem ipsum', 'lorem ipsum', 'Mark Castillo*', '2018-06-04', '50.00', '120.00', '70.00', 3, 1, 2, 3),
(7, 'hello world', 'hello world', 'Antonio Akyatpanaog', '2018-06-04', '50.00', '150.00', '100.00', 1, 2, 3, 3),
(8, 'lorem ipsum', 'lorem ipsum', 'Juan Dela Cruz', '2018-06-01', '40.00', '90.00', '50.00', 4, 1, 1, 3),
(9, 'lorem ipsum', 'lorem ipsum', 'Juan Dela Cruz', '2018-05-31', '50.00', '120.00', '70.00', 5, 2, 2, 1),
(10, 'test input', 'test input', 'Antonio Akyatpanaog', '2018-05-31', '150.00', '300.00', '150.00', 2, 2, 2, 3),
(11, 'lorem ipsum', 'lorem ipsum', 'Mark Castillo*', '2018-06-05', '80.00', '200.00', '120.00', 1, 1, 1, 1),
(12, 'hesoyam', 'hesoyam', 'Juan Dela Cruz', '2018-06-06', '120.00', '300.00', '180.00', 1, 2, 2, 2),
(13, 'Slight bugs in the code', 'Fixed the remaining bugs in the code and redesigned the layout and various other elements of the design. Lorem ipsum dolor sit amet.', 'Antonio Akyatpanaog', '2018-06-08', '150.00', '250.00', '100.00', 5, 2, 1, 4),
(14, 'lorem ipsum dolor', 'lorem ipsum dolor', 'Juan Dela Cruz', '2018-06-08', '24.50', '150.00', '125.50', 1, 2, 1, 1);

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
(4, 'Testing'),
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
(3, 'Reconfiguration'),
(4, 'Optimizatio');

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

INSERT INTO `users` (`userID`, `userFN`, `userLN`) VALUES
(1, 'Mark', 'Castillo'),
(2, 'Mark', 'Castillo'),
(3, 'Antonio', 'Akyatpanaog'),
(4, 'Mark Ian', 'Castillo'),
(5, 'Screenshot', 'API');

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
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `costsavings`
--
ALTER TABLE `costsavings`
  MODIFY `csID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `technologies`
--
ALTER TABLE `technologies`
  MODIFY `techID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
