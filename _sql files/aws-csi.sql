-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 04:26 AM
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
-- Database: `aws-csi`
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
(5, 'screenshotlayerapi@mail.com', '$2y$10$tM2fqOHQ/BemNqvTLzaleO2iX.w9x.U7ZhxZgAp4HghB0YjeLI9Oi', 1, 5),
(6, '$2y$10$VmrvYkcpawgGgrf0AQBklu6XtOiIpzGHhZeFhGUImyTWIm5MN3Z8m', '$2y$10$yMnaeWMlwpV0m3tmW/V30.S3VONujFqSS7XmN.q9393yBHOs6vhcy', 1, 6),
(7, 'john.doe@mail.com', '$2y$10$ktJr/gALDk1iN/znj593duLJTTwXclq1uiuACe3/RdiE.ZQTCAjn6', 1, 7),
(8, '$2y$10$wnuF9xxVItfzndaGxZ3kBu2malbmzl2Y3iagJXzC/3ubxxNdMXEye', '$2y$10$4pArefxAmzAtTGN6oYwMUObSyb4Rfldqi9OSEFF1.fIxN7toyctYC', 1, 8),
(9, '$2y$10$yNUAN4AVUY0iC0oiUPErMOyCOveNuvjeyfClblEocoLbCnR7SdOsS', '$2y$10$hgP6dVBvE6ywFkGpGkE/k.YhbLNvaEenudub1/Ic1thbCt.5qWh/G', 1, 9),
(10, '$2y$10$cYp/UA5Uvp9inoJIW/tZo.wx0SDKKX5KP.T7zSBiOHmNm3/3qioye', '$2y$10$g9T2KD.VDok.Uw58KEWEL.TSIaWj0jFu6c4uZoj8AxJmvcSv6ceha', 1, 10),
(11, '$2y$10$oB0Csioz9dxhSqtDvCpIP.4nLUXCYVbNrasg8V1svATLKJTGViXbm', '$2y$10$jrQ5WHRS4kLjoyX5kaGiQObiGfG7u96OAGSSBslC7YDgx6fWs8BD6', 1, 11),
(12, '$2y$10$gQ6b4uwBYm.Y84SQLWAtdeJEeHJDhSQKnIhzvpZxSVdJuhZy5LIPm', '$2y$10$VT04BvlZ6I282c1yxctPM.30OTGi/a9qPdhOX/oKIto2Z/XQyxIPC', 1, 12),
(13, '$2y$10$.GStvL2.Cg94NxLJOyJ3He3Kg7kLLKlvUqqG/jXxq20adlCV/xxB6', '$2y$10$Jr.wfHuZtDbgJvpfTaoVkO3MAQrbDfDaQg04S.3EcrOE7UCfXhG8S', 1, 13),
(14, '$2y$10$cLqhYkJTlnR1eOKzh355A.6.sF4pNUKZyeLRTW1SBaz07PkQN/R0a', '$2y$10$R8Z6O6RoKlJqRWZFHt1m7elA3giTuhpyI6It1onpo.wnQmyQBvLKa', 1, 14),
(15, '$2y$10$gU8b2u3HT1WuQHxC3hf61uyUJBePIBKT1SVpPM.Lzr0scsCmNCjka', '$2y$10$68Rsk8tcV1qperAtf6sv1.OwOkM6sMca1WKmS3yFKTDHFPfbqKpgC', 1, 15),
(16, '$2y$10$p0boFG74U8mFL64wys0m1.KK/INTPpEWwe4220gYc90Bc/ojApN.S', '$2y$10$IqxrYax1GDY1OpOieZmDy..QaYXHtkfUBglLJ8d0VwF815P0p.auC', 1, 16),
(17, '$2y$10$1tAMLxyr/MPpJUFmQZC9yOqt6Ip0b3kdlglUbYpUUpYI6sc8ct2lq', '$2y$10$xL/BZNMilYNu9dRfPW2lleSY8TkwLGjspo3ZKMMpmA7N6OUNmwEq.', 1, 17),
(18, '$2y$10$jYcPMX0TcB7ygrAoom4UYOrEh2.tIYZq2XcYn.alcx15yvBnOoAIq', '$2y$10$MQvmY8ZwEQ6s75tKp3YlcO/8FXZuUAdRzsXNDpYkq6AsDgM7uam3O', 1, 18);

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
(14, 'lorem ipsum dolor', 'lorem ipsum dolor', 'Juan Dela Cruz', '2018-06-08', '24.50', '150.00', '125.50', 1, 2, 1, 1),
(15, 'thereisnospoon', 'thereisnospoon', 'Mark Castillo*', '2018-06-13', '150.00', '300.00', '150.00', 4, 2, 2, 1),
(16, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-01-22', '60.00', '180.00', '120.00', 1, 1, 1, 1),
(17, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-01-23', '150.00', '200.00', '50.00', 3, 2, 2, 4),
(18, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-01-24', '100.00', '200.00', '100.00', 1, 2, 1, 3),
(19, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-01-25', '120.00', '300.00', '180.00', 3, 1, 3, 2),
(20, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-01-26', '60.00', '180.00', '120.00', 2, 2, 2, 4),
(21, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-01-28', '120.00', '300.00', '180.00', 3, 1, 3, 2),
(22, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-02-19', '50.00', '180.00', '130.00', 3, 2, 1, 3),
(23, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-02-20', '100.00', '200.00', '100.00', 2, 2, 1, 4),
(24, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-02-21', '60.00', '180.00', '120.00', 2, 2, 1, 3),
(25, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-02-22', '80.00', '200.00', '80.00', 3, 2, 2, 2),
(26, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-02-23', '100.00', '300.00', '200.00', 1, 2, 3, 4),
(27, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-02-26', '100.00', '200.00', '100.00', 1, 2, 1, 3),
(28, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-03-09', '50.00', '180.00', '130.00', 3, 2, 1, 3),
(29, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-03-12', '200.00', '350.00', '150.00', 1, 2, 3, 1),
(30, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-03-13', '100.00', '200.00', '100.00', 3, 2, 2, 4),
(31, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-03-14', '100.00', '200.00', '100.00', 1, 2, 1, 3),
(32, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-03-15', '120.00', '300.00', '180.00', 3, 1, 3, 2),
(33, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-03-16', '60.00', '180.00', '120.00', 2, 2, 2, 4),
(34, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-04-16', '70.00', '200.00', '130.00', 3, 2, 3, 4),
(35, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-04-17', '100.00', '200.00', '100.00', 1, 1, 3, 3),
(36, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-04-18', '60.00', '180.00', '120.00', 2, 2, 3, 2),
(37, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-04-19', '80.00', '200.00', '80.00', 3, 2, 2, 2),
(38, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-04-20', '100.00', '300.00', '200.00', 1, 2, 3, 4),
(39, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-04-21', '60.00', '180.00', '120.00', 2, 2, 1, 3),
(40, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-03-12', '200.00', '350.00', '150.00', 1, 2, 3, 1),
(41, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-03-13', '100.00', '200.00', '100.00', 3, 2, 2, 4),
(42, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-03-14', '100.00', '200.00', '100.00', 1, 2, 1, 3),
(43, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-03-15', '120.00', '300.00', '180.00', 3, 1, 3, 2),
(44, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-03-16', '60.00', '180.00', '120.00', 2, 2, 2, 4),
(45, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-05-12', '200.00', '350.00', '150.00', 1, 2, 3, 1),
(46, 'lorem ipsum dolor', 'lorem ipsum', 'Mark Castillo', '2018-05-13', '100.00', '200.00', '100.00', 3, 2, 2, 4),
(47, 'lorem ipsum dolor', 'lorem ipsum', 'Juan dela Cruz', '2018-05-14', '100.00', '200.00', '100.00', 1, 2, 1, 3),
(48, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-05-15', '120.00', '300.00', '180.00', 3, 1, 3, 2),
(49, 'lorem ipsum dolor', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-05-16', '60.00', '180.00', '120.00', 2, 2, 2, 4),
(50, 'lorem ipsum', 'lorem ipsum', 'Juan Dela Cruz', '2018-06-13', '120.00', '600.00', '480.00', 3, 1, 3, 4),
(51, 'lorem ipsum', 'lorem ipsum', 'Antonio Akyatpanaog', '2018-06-13', '100.00', '300.00', '200.00', 2, 1, 3, 2),
(52, 'lorem ipsum dolor', 'lorem ipsum dolor', 'Mark Ian Castillo', '2018-06-19', '70.00', '350.00', '280.00', 4, 1, 1, 3),
(53, 'the quick brown fox jumps over the lazy dog', 'the quick brown fox jumps over the lazy dog', 'Juan Dela Cruz', '2018-06-19', '88.88', '188.88', '100.00', 2, 2, 2, 3),
(54, 'lorem ipsum', 'lorem ipsum', 'John Doe', '2018-06-26', '150.00', '500.00', '350.00', 1, 2, 2, 3),
(55, 'something', 'something', 'Jane Doe', '2018-06-26', '30.00', '450.00', '420.00', 2, 1, 2, 2),
(56, 'lorem ipsum', 'lorem ipsum', 'Mark Castillo', '2018-06-26', '40.00', '250.00', '210.00', 3, 2, 3, 4),
(57, 'lorem ipsum', 'lorem ipsum', 'Juan Dela Cruz', '2018-06-25', '40.00', '200.00', '160.00', 4, 1, 2, 1),
(58, 'hello world', 'hello world', 'John Doe', '2018-06-25', '25.00', '100.00', '75.00', 1, 1, 2, 2),
(59, 'lorem ipsum', 'lorem ipsum', 'Jane Doe', '2018-06-25', '40.00', '140.00', '100.00', 2, 2, 2, 3),
(60, 'hello world', 'hello world', 'Mark Castillo', '2018-06-26', '40.00', '220.00', '180.00', 3, 2, 1, 2);

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
(2, 'QA'),
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
(4, 'Optimization');

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
(5, 'Screenshot', 'API'),
(6, 'Jane', 'Doe'),
(7, 'John', 'Doe'),
(8, 'Lorem', 'Ipsum'),
(9, 'Mark', 'Castillo'),
(10, 'Antonio', 'Akyatpanaog'),
(11, 'Cameron', 'Leblanc'),
(12, 'Rebecca', 'Winters'),
(13, 'Maliha', 'Crowther'),
(14, 'Ashton', 'Foreman'),
(15, 'Tahlia', 'Jeffery'),
(16, 'Darrell', 'Brady'),
(17, 'Devan', 'Moses'),
(18, 'Nela', 'Hopper');

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
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `costsavings`
--
ALTER TABLE `costsavings`
  MODIFY `csID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
