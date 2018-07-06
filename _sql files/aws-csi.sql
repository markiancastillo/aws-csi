-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2018 at 08:33 AM
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
  `csDate` date NOT NULL,
  `csSavings` decimal(10,2) NOT NULL COMMENT 'The final total cost of the savings from the initial and final input (computed automatically)',
  `csInitial` decimal(10,2) NOT NULL COMMENT 'The initial cost input',
  `csFinal` decimal(10,2) NOT NULL COMMENT 'The final cost input after the steps taken ',
  `teamID` int(11) NOT NULL COMMENT 'FK that connects data from journeyteams',
  `techID` int(11) NOT NULL COMMENT 'FK that connects data from technologies',
  `envID` int(11) NOT NULL COMMENT 'FK that connects data from environments',
  `typeID` int(11) NOT NULL COMMENT 'FK that connects data from savingtypes',
  `userID` int(11) NOT NULL COMMENT 'FK that connects the users table; determines ownership of the record'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costsavings`
--

INSERT INTO `costsavings` (`csID`, `csCause`, `csSteps`, `csDate`, `csSavings`, `csInitial`, `csFinal`, `teamID`, `techID`, `envID`, `typeID`, `userID`) VALUES
(1, 'lorem', 'ipsum', '2018-07-03', '20.00', '120.00', '100.00', 5, 2, 3, 3, 9),
(2, 'test input 2', ' ', '2018-07-03', '50.00', '250.00', '200.00', 5, 2, 1, 3, 9),
(3, 'test ', 'test', '2018-07-03', '80.00', '200.00', '120.00', 2, 1, 2, 2, 9),
(4, 'hello', 'world', '2018-06-29', '150.00', '1200.00', '1050.00', 4, 2, 1, 2, 9),
(5, 'test', 'test', '2018-06-26', '20.00', '100.00', '80.00', 4, 1, 2, 4, 9),
(192, 'lorem ipsum', 'lorem ipsum', '2018-01-01', '80.00', '200.00', '120.00', 1, 1, 1, 1, 5),
(193, 'lorem ipsum', 'lorem ipsum', '2018-01-04', '100.00', '200.00', '100.00', 4, 2, 2, 2, 2),
(194, 'lorem ipsum', 'lorem ipsum', '2018-01-07', '120.00', '200.00', '80.00', 4, 2, 1, 3, 3),
(195, 'lorem ipsum', 'lorem ipsum', '2018-01-08', '70.00', '200.00', '130.00', 1, 2, 1, 2, 1),
(196, 'lorem ipsum', 'lorem ipsum', '2018-01-12', '50.00', '170.00', '120.00', 3, 1, 2, 2, 1),
(197, 'lorem ipsum', 'lorem ipsum', '2018-01-13', '50.00', '200.00', '150.00', 2, 1, 3, 1, 4),
(198, 'lorem ipsum', 'lorem ipsum', '2018-01-13', '100.00', '220.00', '120.00', 2, 1, 1, 1, 6),
(199, 'lorem ipsum', 'lorem ipsum', '2018-01-14', '100.00', '300.00', '200.00', 2, 1, 1, 1, 2),
(200, 'lorem ipsum', 'lorem ipsum', '2018-01-16', '120.00', '200.00', '80.00', 4, 1, 2, 2, 1),
(201, 'lorem ipsum', 'lorem ipsum', '2018-01-18', '80.00', '200.00', '120.00', 3, 1, 2, 3, 2),
(202, 'lorem ipsum', 'lorem ipsum', '2018-01-20', '60.00', '200.00', '140.00', 1, 2, 3, 4, 4),
(203, 'lorem ipsum', 'lorem ipsum', '2018-01-21', '100.00', '300.00', '200.00', 4, 1, 3, 2, 7),
(204, 'lorem ipsum', 'lorem ipsum', '2018-01-21', '20.00', '100.00', '80.00', 1, 1, 1, 1, 8),
(205, 'lorem ipsum', 'lorem ipsum', '2018-01-21', '50.00', '100.00', '50.00', 5, 2, 2, 1, 6),
(206, 'lorem ipsum', 'lorem ipsum', '2018-01-22', '60.00', '200.00', '120.00', 1, 2, 1, 2, 3),
(207, 'lorem ipsum', 'lorem ipsum', '2018-01-26', '80.00', '200.00', '120.00', 3, 1, 1, 3, 4),
(208, 'lorem ipsum', 'lorem ipsum', '2018-01-27', '80.00', '200.00', '120.00', 2, 2, 1, 1, 7),
(209, 'lorem ipsum', 'lorem ipsum', '2018-01-27', '120.00', '400.00', '280.00', 4, 2, 2, 1, 2),
(210, 'lorem ipsum', 'lorem ipsum', '2018-02-03', '80.00', '200.00', '120.00', 1, 2, 2, 1, 7),
(211, 'lorem ipsum', 'lorem ipsum', '2018-02-05', '100.00', '200.00', '100.00', 4, 2, 1, 2, 1),
(212, 'lorem ipsum', 'lorem ipsum', '2018-02-07', '120.00', '200.00', '80.00', 4, 2, 1, 3, 1),
(213, 'lorem ipsum', 'lorem ipsum', '2018-02-11', '70.00', '200.00', '130.00', 2, 2, 2, 2, 3),
(214, 'lorem ipsum', 'lorem ipsum', '2018-02-12', '80.00', '200.00', '120.00', 3, 2, 2, 2, 4),
(215, 'lorem ipsum', 'lorem ipsum', '2018-02-12', '80.00', '200.00', '120.00', 2, 1, 1, 1, 8),
(216, 'lorem ipsum', 'lorem ipsum', '2018-02-13', '100.00', '220.00', '120.00', 2, 2, 1, 1, 2),
(217, 'lorem ipsum', 'lorem ipsum', '2018-02-14', '120.00', '300.00', '180.00', 2, 1, 3, 1, 2),
(218, 'lorem ipsum', 'lorem ipsum', '2018-02-16', '120.00', '200.00', '80.00', 4, 1, 2, 2, 1),
(219, 'lorem ipsum', 'lorem ipsum', '2018-02-18', '80.00', '200.00', '120.00', 3, 1, 2, 3, 2),
(220, 'lorem ipsum', 'lorem ipsum', '2018-02-19', '60.00', '200.00', '140.00', 2, 2, 3, 4, 9),
(221, 'lorem ipsum', 'lorem ipsum', '2018-02-22', '100.00', '300.00', '200.00', 4, 1, 2, 2, 6),
(222, 'lorem ipsum', 'lorem ipsum', '2018-02-22', '120.00', '200.00', '80.00', 2, 2, 3, 1, 4),
(223, 'lorem ipsum', 'lorem ipsum', '2018-02-23', '50.00', '100.00', '50.00', 5, 2, 2, 2, 9),
(224, 'lorem ipsum', 'lorem ipsum', '2018-02-24', '60.00', '200.00', '140.00', 2, 1, 1, 2, 4),
(225, 'lorem ipsum', 'lorem ipsum', '2018-02-25', '100.00', '210.00', '110.00', 3, 1, 1, 3, 2),
(226, 'lorem ipsum', 'lorem ipsum', '2018-02-26', '210.00', '160.00', '50.00', 2, 2, 1, 1, 1),
(227, 'lorem ipsum', 'lorem ipsum', '2018-02-26', '120.00', '400.00', '280.00', 4, 1, 1, 2, 2),
(228, 'lorem ipsum', 'lorem ipsum', '2018-03-02', '80.00', '200.00', '120.00', 2, 1, 2, 1, 4),
(229, 'lorem ipsum', 'lorem ipsum', '2018-03-03', '100.00', '200.00', '100.00', 4, 1, 1, 2, 2),
(230, 'lorem ipsum', 'lorem ipsum', '2018-03-03', '120.00', '200.00', '80.00', 4, 2, 2, 3, 1),
(231, 'lorem ipsum', 'lorem ipsum', '2018-03-04', '70.00', '200.00', '130.00', 2, 2, 1, 1, 1),
(232, 'lorem ipsum', 'lorem ipsum', '2018-03-05', '50.00', '200.00', '150.00', 3, 2, 2, 3, 2),
(233, 'lorem ipsum', 'lorem ipsum', '2018-03-07', '100.00', '200.00', '100.00', 2, 1, 2, 1, 3),
(234, 'lorem ipsum', 'lorem ipsum', '2018-03-11', '100.00', '220.00', '120.00', 2, 2, 2, 1, 3),
(235, 'lorem ipsum', 'lorem ipsum', '2018-03-12', '120.00', '300.00', '180.00', 2, 2, 3, 1, 4),
(236, 'lorem ipsum', 'lorem ipsum', '2018-03-13', '120.00', '200.00', '80.00', 4, 2, 2, 2, 5),
(237, 'lorem ipsum', 'lorem ipsum', '2018-03-16', '80.00', '200.00', '120.00', 2, 1, 2, 3, 6),
(238, 'lorem ipsum', 'lorem ipsum', '2018-03-17', '60.00', '200.00', '140.00', 1, 2, 3, 4, 1),
(239, 'lorem ipsum', 'lorem ipsum', '2018-03-18', '110.00', '300.00', '190.00', 4, 2, 2, 2, 2),
(240, 'lorem ipsum', 'lorem ipsum', '2018-03-20', '20.00', '200.00', '180.00', 2, 1, 3, 1, 3),
(241, 'lorem ipsum', 'lorem ipsum', '2018-03-21', '150.00', '200.00', '50.00', 5, 2, 2, 2, 2),
(242, 'lorem ipsum', 'lorem ipsum', '2018-03-21', '160.00', '200.00', '40.00', 2, 1, 1, 2, 5),
(243, 'lorem ipsum', 'lorem ipsum', '2018-03-22', '100.00', '210.00', '110.00', 1, 2, 2, 3, 1),
(244, 'lorem ipsum', 'lorem ipsum', '2018-03-24', '210.00', '160.00', '50.00', 2, 1, 1, 1, 2),
(245, 'lorem ipsum', 'lorem ipsum', '2018-03-25', '120.00', '200.00', '80.00', 4, 2, 1, 2, 3),
(246, 'lorem ipsum', 'lorem ipsum', '2018-03-26', '120.00', '400.00', '280.00', 2, 2, 1, 2, 3),
(247, 'lorem ipsum', 'lorem ipsum', '2018-03-27', '20.00', '100.00', '80.00', 4, 1, 1, 2, 5),
(248, 'lorem ipsum', 'lorem ipsum', '2018-04-15', '150.00', '300.00', '150.00', 1, 2, 2, 3, 2),
(249, 'lorem ipsum', 'lorem ipsum', '2018-04-17', '100.00', '200.00', '100.00', 1, 1, 2, 1, 2),
(250, 'lorem ipsum', 'lorem ipsum', '2018-04-21', '100.00', '220.00', '120.00', 2, 2, 2, 1, 1),
(251, 'lorem ipsum', 'lorem ipsum', '2018-04-22', '120.00', '300.00', '180.00', 2, 1, 2, 1, 2),
(252, 'lorem ipsum', 'lorem ipsum', '2018-04-23', '120.00', '200.00', '80.00', 4, 1, 2, 2, 1),
(253, 'lorem ipsum', 'lorem ipsum', '2018-04-26', '80.00', '200.00', '120.00', 2, 1, 2, 3, 1),
(254, 'lorem ipsum', 'lorem ipsum', '2018-04-27', '60.00', '200.00', '140.00', 1, 2, 3, 4, 3),
(255, 'lorem ipsum', 'lorem ipsum', '2018-04-28', '110.00', '300.00', '190.00', 4, 1, 1, 2, 4),
(256, 'lorem ipsum', 'lorem ipsum', '2018-04-28', '20.00', '200.00', '180.00', 2, 1, 1, 1, 1),
(257, 'lorem ipsum', 'lorem ipsum', '2018-05-01', '80.00', '200.00', '120.00', 1, 2, 2, 1, 2),
(258, 'lorem ipsum', 'lorem ipsum', '2018-05-02', '100.00', '200.00', '100.00', 4, 2, 1, 2, 3),
(259, 'lorem ipsum', 'lorem ipsum', '2018-05-05', '80.00', '200.00', '120.00', 4, 2, 1, 3, 2),
(260, 'lorem ipsum', 'lorem ipsum', '2018-05-06', '70.00', '200.00', '130.00', 2, 2, 2, 2, 4),
(261, 'lorem ipsum', 'lorem ipsum', '2018-05-07', '80.00', '200.00', '120.00', 3, 2, 2, 2, 1),
(262, 'lorem ipsum', 'lorem ipsum', '2018-05-08', '80.00', '200.00', '120.00', 2, 1, 3, 1, 7),
(263, 'lorem ipsum', 'lorem ipsum', '2018-05-11', '120.00', '220.00', '100.00', 2, 2, 1, 1, 6),
(264, 'lorem ipsum', 'lorem ipsum', '2018-05-11', '120.00', '300.00', '180.00', 2, 1, 3, 1, 2),
(265, 'lorem ipsum', 'lorem ipsum', '2018-05-16', '20.00', '200.00', '180.00', 4, 1, 2, 2, 2),
(266, 'lorem ipsum', 'lorem ipsum', '2018-05-17', '80.00', '200.00', '120.00', 3, 1, 2, 3, 3),
(267, 'lorem ipsum', 'lorem ipsum', '2018-05-18', '160.00', '200.00', '40.00', 2, 2, 3, 4, 1),
(268, 'lorem ipsum', 'lorem ipsum', '2018-05-19', '100.00', '200.00', '100.00', 4, 1, 2, 2, 1),
(269, 'lorem ipsum', 'lorem ipsum', '2018-05-22', '120.00', '200.00', '80.00', 2, 2, 3, 1, 2),
(270, 'lorem ipsum', 'lorem ipsum', '2018-05-22', '50.00', '100.00', '50.00', 5, 2, 2, 2, 3),
(271, 'lorem ipsum', 'lorem ipsum', '2018-05-23', '60.00', '200.00', '140.00', 2, 1, 1, 2, 5),
(272, 'lorem ipsum', 'lorem ipsum', '2018-05-24', '80.00', '100.00', '80.00', 3, 2, 1, 3, 3),
(273, 'lorem ipsum', 'lorem ipsum', '2018-05-27', '40.00', '160.00', '120.00', 2, 2, 1, 1, 1),
(274, 'lorem ipsum', 'lorem ipsum', '2018-05-27', '120.00', '400.00', '280.00', 4, 1, 1, 2, 2),
(275, 'lorem ipsum', 'lorem ipsum', '2018-06-05', '20.00', '200.00', '180.00', 2, 1, 2, 2, 2),
(276, 'lorem ipsum', 'lorem ipsum', '2018-06-08', '80.00', '200.00', '120.00', 3, 2, 2, 3, 3),
(277, 'lorem ipsum', 'lorem ipsum', '2018-06-08', '60.00', '100.00', '40.00', 2, 2, 2, 4, 1),
(278, 'lorem ipsum', 'lorem ipsum', '2018-06-13', '100.00', '200.00', '100.00', 2, 1, 2, 2, 2),
(279, 'lorem ipsum', 'lorem ipsum', '2018-06-14', '120.00', '200.00', '80.00', 2, 2, 3, 1, 3),
(280, 'lorem ipsum', 'lorem ipsum', '2018-06-14', '50.00', '100.00', '50.00', 1, 2, 2, 2, 5),
(281, 'lorem ipsum', 'lorem ipsum', '2018-06-16', '60.00', '200.00', '140.00', 2, 1, 1, 2, 2),
(282, 'lorem ipsum', 'lorem ipsum', '2018-06-21', '100.00', '200.00', '100.00', 3, 2, 1, 3, 3),
(283, 'lorem ipsum', 'lorem ipsum', '2018-06-25', '40.00', '260.00', '220.00', 2, 2, 1, 1, 3),
(284, 'lorem ipsum', 'lorem ipsum', '2018-06-26', '20.00', '100.00', '80.00', 4, 2, 1, 1, 1),
(285, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque viverra augue eu lobortis mattis. Cras vel mi faucibus, gravida est a, facilisis sem.', '2018-07-05', '20.00', '100.00', '80.00', 3, 1, 1, 3, 9);

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
  ADD KEY `costsavings_ibfk_4` (`typeID`),
  ADD KEY `userID` (`userID`);

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
  MODIFY `csID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

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
  ADD CONSTRAINT `costsavings_ibfk_4` FOREIGN KEY (`typeID`) REFERENCES `savingtypes` (`typeID`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `costsavings_ibfk_5` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
