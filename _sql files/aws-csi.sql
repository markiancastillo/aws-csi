-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 08:14 AM
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
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `accessID` int(11) NOT NULL,
  `accessRole` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`accessID`, `accessRole`) VALUES
(1, 'Administrator'),
(2, 'User (Elevated)'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL,
  `accountUN` varchar(150) NOT NULL,
  `accountPW` varchar(300) NOT NULL,
  `accountAccess` tinyint(4) NOT NULL COMMENT '1-administrator; 2-elevated user; 3-user',
  `accountStatus` tinyint(5) NOT NULL COMMENT '1-active; 2-pending; 0-inactive',
  `userID` int(11) NOT NULL COMMENT 'Specifies who owns the account'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `accountUN`, `accountPW`, `accountAccess`, `accountStatus`, `userID`) VALUES
(1, 'admin@mail.com', '12345', 3, 1, 1),
(2, 'example@example.com', '$2y$10$FtCpvMlFiQyMvzEThycOoeZd0PBdXr/e8aErCupdF/rUoPwbAS5xi', 3, 2, 2),
(3, 'antonio@mail.com', '$2y$10$unzGJA.WK.NPcxSB.CPYnOHPOxfJ6jQ0Jib4hIqclExW/DiJ1Setq', 3, 1, 3),
(4, 'mail@example.com', '$2y$10$lmPiSB5lTY6epDEG1kQM6OuD1a.z6oGk1x5Y/I7dxYGW6UlAskEO.', 3, 1, 4),
(5, 'screenshotlayerapi@mail.com', '$2y$10$tM2fqOHQ/BemNqvTLzaleO2iX.w9x.U7ZhxZgAp4HghB0YjeLI9Oi', 3, 1, 5),
(6, '$2y$10$VmrvYkcpawgGgrf0AQBklu6XtOiIpzGHhZeFhGUImyTWIm5MN3Z8m', '$2y$10$yMnaeWMlwpV0m3tmW/V30.S3VONujFqSS7XmN.q9393yBHOs6vhcy', 3, 1, 6),
(7, 'john.doe@mail.com', '$2y$10$ktJr/gALDk1iN/znj593duLJTTwXclq1uiuACe3/RdiE.ZQTCAjn6', 3, 1, 7),
(8, '$2y$10$wnuF9xxVItfzndaGxZ3kBu2malbmzl2Y3iagJXzC/3ubxxNdMXEye', '$2y$10$4pArefxAmzAtTGN6oYwMUObSyb4Rfldqi9OSEFF1.fIxN7toyctYC', 3, 1, 8),
(9, '$2y$10$yNUAN4AVUY0iC0oiUPErMOyCOveNuvjeyfClblEocoLbCnR7SdOsS', '$2y$10$hgP6dVBvE6ywFkGpGkE/k.YhbLNvaEenudub1/Ic1thbCt.5qWh/G', 1, 1, 9),
(10, '$2y$10$cYp/UA5Uvp9inoJIW/tZo.wx0SDKKX5KP.T7zSBiOHmNm3/3qioye', '$2y$10$g9T2KD.VDok.Uw58KEWEL.TSIaWj0jFu6c4uZoj8AxJmvcSv6ceha', 3, 0, 10),
(11, '$2y$10$oB0Csioz9dxhSqtDvCpIP.4nLUXCYVbNrasg8V1svATLKJTGViXbm', '$2y$10$jrQ5WHRS4kLjoyX5kaGiQObiGfG7u96OAGSSBslC7YDgx6fWs8BD6', 3, 1, 11),
(12, '$2y$10$gQ6b4uwBYm.Y84SQLWAtdeJEeHJDhSQKnIhzvpZxSVdJuhZy5LIPm', '$2y$10$VT04BvlZ6I282c1yxctPM.30OTGi/a9qPdhOX/oKIto2Z/XQyxIPC', 3, 1, 12),
(13, '$2y$10$.GStvL2.Cg94NxLJOyJ3He3Kg7kLLKlvUqqG/jXxq20adlCV/xxB6', '$2y$10$Jr.wfHuZtDbgJvpfTaoVkO3MAQrbDfDaQg04S.3EcrOE7UCfXhG8S', 3, 1, 13),
(14, '$2y$10$cLqhYkJTlnR1eOKzh355A.6.sF4pNUKZyeLRTW1SBaz07PkQN/R0a', '$2y$10$R8Z6O6RoKlJqRWZFHt1m7elA3giTuhpyI6It1onpo.wnQmyQBvLKa', 3, 1, 14),
(15, '$2y$10$gU8b2u3HT1WuQHxC3hf61uyUJBePIBKT1SVpPM.Lzr0scsCmNCjka', '$2y$10$68Rsk8tcV1qperAtf6sv1.OwOkM6sMca1WKmS3yFKTDHFPfbqKpgC', 3, 1, 15),
(16, '$2y$10$p0boFG74U8mFL64wys0m1.KK/INTPpEWwe4220gYc90Bc/ojApN.S', '$2y$10$IqxrYax1GDY1OpOieZmDy..QaYXHtkfUBglLJ8d0VwF815P0p.auC', 3, 1, 16),
(17, '$2y$10$1tAMLxyr/MPpJUFmQZC9yOqt6Ip0b3kdlglUbYpUUpYI6sc8ct2lq', '$2y$10$xL/BZNMilYNu9dRfPW2lleSY8TkwLGjspo3ZKMMpmA7N6OUNmwEq.', 3, 1, 17),
(18, '$2y$10$jYcPMX0TcB7ygrAoom4UYOrEh2.tIYZq2XcYn.alcx15yvBnOoAIq', '$2y$10$MQvmY8ZwEQ6s75tKp3YlcO/8FXZuUAdRzsXNDpYkq6AsDgM7uam3O', 3, 1, 18),
(19, '$2y$10$QtRZstRn4Ab6BH/6oz1xTOivP6ONpNpcvthwekWplt0E0p/jAbJzC', '$2y$10$ccIfzpwDewJH9Wrza36QM.hQbZOMnH/GogF/hmDdVn04hQxIbLmwy', 3, 1, 19);

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
  `projectID` int(11) DEFAULT NULL COMMENT 'FK that connects data from projects',
  `userID` int(11) NOT NULL COMMENT 'FK that connects the users table; determines ownership of the record'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costsavings`
--

INSERT INTO `costsavings` (`csID`, `csCause`, `csSteps`, `csDate`, `csSavings`, `csInitial`, `csFinal`, `teamID`, `techID`, `envID`, `typeID`, `projectID`, `userID`) VALUES
(1, 'lorem', 'ipsum', '2018-07-03', '20.00', '120.00', '100.00', 5, 2, 3, 3, 0, 9),
(2, 'test input 2', 'test input 2', '2018-07-03', '50.00', '250.00', '200.00', 5, 2, 1, 3, 0, 9),
(3, 'test ', 'test', '2018-07-03', '80.00', '200.00', '120.00', 2, 1, 2, 2, 0, 9),
(4, 'hello', 'world', '2018-06-29', '150.00', '1200.00', '1050.00', 4, 2, 1, 2, 0, 9),
(5, 'test', 'test', '2018-06-26', '20.00', '100.00', '80.00', 4, 1, 2, 4, 0, 9),
(192, 'lorem ipsum', 'lorem ipsum', '2018-01-01', '80.00', '200.00', '120.00', 1, 1, 1, 1, 0, 5),
(193, 'lorem ipsum', 'lorem ipsum', '2018-01-04', '100.00', '200.00', '100.00', 4, 2, 2, 2, 0, 2),
(194, 'lorem ipsum', 'lorem ipsum', '2018-01-07', '120.00', '200.00', '80.00', 4, 2, 1, 3, 0, 3),
(195, 'lorem ipsum', 'lorem ipsum', '2018-01-08', '70.00', '200.00', '130.00', 1, 2, 1, 2, 0, 1),
(196, 'lorem ipsum', 'lorem ipsum', '2018-01-12', '50.00', '170.00', '120.00', 3, 1, 2, 2, 0, 1),
(197, 'lorem ipsum', 'lorem ipsum', '2018-01-13', '50.00', '200.00', '150.00', 2, 1, 3, 1, 0, 4),
(198, 'lorem ipsum', 'lorem ipsum', '2018-01-13', '100.00', '220.00', '120.00', 2, 1, 1, 1, 0, 6),
(199, 'lorem ipsum', 'lorem ipsum', '2018-01-14', '100.00', '300.00', '200.00', 2, 1, 1, 1, 0, 2),
(200, 'lorem ipsum', 'lorem ipsum', '2018-01-16', '120.00', '200.00', '80.00', 4, 1, 2, 2, 0, 1),
(201, 'lorem ipsum', 'lorem ipsum', '2018-01-18', '80.00', '200.00', '120.00', 3, 1, 2, 3, 0, 2),
(202, 'lorem ipsum', 'lorem ipsum', '2018-01-20', '60.00', '200.00', '140.00', 1, 2, 3, 4, 0, 4),
(203, 'lorem ipsum', 'lorem ipsum', '2018-01-21', '100.00', '300.00', '200.00', 4, 1, 3, 2, 0, 7),
(204, 'lorem ipsum', 'lorem ipsum', '2018-01-21', '20.00', '100.00', '80.00', 1, 1, 1, 1, 0, 8),
(205, 'lorem ipsum', 'lorem ipsum', '2018-01-21', '50.00', '100.00', '50.00', 5, 2, 2, 1, 0, 6),
(206, 'lorem ipsum', 'lorem ipsum', '2018-01-22', '60.00', '200.00', '120.00', 1, 2, 1, 2, 0, 3),
(207, 'lorem ipsum', 'lorem ipsum', '2018-01-26', '80.00', '200.00', '120.00', 3, 1, 1, 3, 0, 4),
(208, 'lorem ipsum', 'lorem ipsum', '2018-01-27', '80.00', '200.00', '120.00', 2, 2, 1, 1, 0, 7),
(209, 'lorem ipsum', 'lorem ipsum', '2018-01-27', '120.00', '400.00', '280.00', 4, 2, 2, 1, 0, 2),
(210, 'lorem ipsum', 'lorem ipsum', '2018-02-03', '80.00', '200.00', '120.00', 1, 2, 2, 1, 0, 7),
(211, 'lorem ipsum', 'lorem ipsum', '2018-02-05', '100.00', '200.00', '100.00', 4, 2, 1, 2, 0, 1),
(212, 'lorem ipsum', 'lorem ipsum', '2018-02-07', '120.00', '200.00', '80.00', 4, 2, 1, 3, 0, 1),
(213, 'lorem ipsum', 'lorem ipsum', '2018-02-11', '70.00', '200.00', '130.00', 2, 2, 2, 2, 0, 3),
(214, 'lorem ipsum', 'lorem ipsum', '2018-02-12', '80.00', '200.00', '120.00', 3, 2, 2, 2, 0, 4),
(215, 'lorem ipsum', 'lorem ipsum', '2018-02-12', '80.00', '200.00', '120.00', 2, 1, 1, 1, 0, 8),
(216, 'lorem ipsum', 'lorem ipsum', '2018-02-13', '100.00', '220.00', '120.00', 2, 2, 1, 1, 0, 2),
(217, 'lorem ipsum', 'lorem ipsum', '2018-02-14', '120.00', '300.00', '180.00', 2, 1, 3, 1, 0, 2),
(218, 'lorem ipsum', 'lorem ipsum', '2018-02-16', '120.00', '200.00', '80.00', 4, 1, 2, 2, 0, 1),
(219, 'lorem ipsum', 'lorem ipsum', '2018-02-18', '80.00', '200.00', '120.00', 3, 1, 2, 3, 0, 2),
(220, 'lorem ipsum', 'lorem ipsum', '2018-02-19', '60.00', '200.00', '140.00', 2, 2, 3, 4, 0, 9),
(221, 'lorem ipsum', 'lorem ipsum', '2018-02-22', '100.00', '300.00', '200.00', 4, 1, 2, 2, 0, 6),
(222, 'lorem ipsum', 'lorem ipsum', '2018-02-22', '120.00', '200.00', '80.00', 2, 2, 3, 1, 0, 4),
(223, 'lorem ipsum', 'lorem ipsum', '2018-02-23', '50.00', '100.00', '50.00', 5, 2, 2, 2, 0, 9),
(224, 'lorem ipsum', 'lorem ipsum', '2018-02-24', '60.00', '200.00', '140.00', 2, 1, 1, 2, 0, 4),
(225, 'lorem ipsum', 'lorem ipsum', '2018-02-25', '100.00', '210.00', '110.00', 3, 1, 1, 3, 0, 2),
(226, 'lorem ipsum', 'lorem ipsum', '2018-02-26', '210.00', '160.00', '50.00', 2, 2, 1, 1, 0, 1),
(227, 'lorem ipsum', 'lorem ipsum', '2018-02-26', '120.00', '400.00', '280.00', 4, 1, 1, 2, 0, 2),
(228, 'lorem ipsum', 'lorem ipsum', '2018-03-02', '80.00', '200.00', '120.00', 2, 1, 2, 1, 0, 4),
(229, 'lorem ipsum', 'lorem ipsum', '2018-03-03', '100.00', '200.00', '100.00', 4, 1, 1, 2, 0, 2),
(230, 'lorem ipsum', 'lorem ipsum', '2018-03-03', '120.00', '200.00', '80.00', 4, 2, 2, 3, 0, 1),
(231, 'lorem ipsum', 'lorem ipsum', '2018-03-04', '70.00', '200.00', '130.00', 2, 2, 1, 1, 0, 1),
(232, 'lorem ipsum', 'lorem ipsum', '2018-03-05', '50.00', '200.00', '150.00', 3, 2, 2, 3, 0, 2),
(233, 'lorem ipsum', 'lorem ipsum', '2018-03-07', '100.00', '200.00', '100.00', 2, 1, 2, 1, 0, 3),
(234, 'lorem ipsum', 'lorem ipsum', '2018-03-11', '100.00', '220.00', '120.00', 2, 2, 2, 1, 0, 3),
(235, 'lorem ipsum', 'lorem ipsum', '2018-03-12', '120.00', '300.00', '180.00', 2, 2, 3, 1, 0, 4),
(236, 'lorem ipsum', 'lorem ipsum', '2018-03-13', '120.00', '200.00', '80.00', 4, 2, 2, 2, 0, 5),
(237, 'lorem ipsum', 'lorem ipsum', '2018-03-16', '80.00', '200.00', '120.00', 2, 1, 2, 3, 0, 6),
(238, 'lorem ipsum', 'lorem ipsum', '2018-03-17', '60.00', '200.00', '140.00', 1, 2, 3, 4, 0, 1),
(239, 'lorem ipsum', 'lorem ipsum', '2018-03-18', '110.00', '300.00', '190.00', 4, 2, 2, 2, 0, 2),
(240, 'lorem ipsum', 'lorem ipsum', '2018-03-20', '20.00', '200.00', '180.00', 2, 1, 3, 1, 0, 3),
(241, 'lorem ipsum', 'lorem ipsum', '2018-03-21', '150.00', '200.00', '50.00', 5, 2, 2, 2, 0, 2),
(242, 'lorem ipsum', 'lorem ipsum', '2018-03-21', '160.00', '200.00', '40.00', 2, 1, 1, 2, 0, 5),
(243, 'lorem ipsum', 'lorem ipsum', '2018-03-22', '100.00', '210.00', '110.00', 1, 2, 2, 3, 0, 1),
(244, 'lorem ipsum', 'lorem ipsum', '2018-03-24', '210.00', '160.00', '50.00', 2, 1, 1, 1, 0, 2),
(245, 'lorem ipsum', 'lorem ipsum', '2018-03-25', '120.00', '200.00', '80.00', 4, 2, 1, 2, 0, 3),
(246, 'lorem ipsum', 'lorem ipsum', '2018-03-26', '120.00', '400.00', '280.00', 2, 2, 1, 2, 0, 3),
(247, 'lorem ipsum', 'lorem ipsum', '2018-03-27', '20.00', '100.00', '80.00', 4, 1, 1, 2, 0, 5),
(248, 'lorem ipsum', 'lorem ipsum', '2018-04-15', '150.00', '300.00', '150.00', 1, 2, 2, 3, 0, 2),
(249, 'lorem ipsum', 'lorem ipsum', '2018-04-17', '100.00', '200.00', '100.00', 1, 1, 2, 1, 0, 2),
(250, 'lorem ipsum', 'lorem ipsum', '2018-04-21', '100.00', '220.00', '120.00', 2, 2, 2, 1, 0, 1),
(251, 'lorem ipsum', 'lorem ipsum', '2018-04-22', '120.00', '300.00', '180.00', 2, 1, 2, 1, 0, 2),
(252, 'lorem ipsum', 'lorem ipsum', '2018-04-23', '120.00', '200.00', '80.00', 4, 1, 2, 2, 0, 1),
(253, 'lorem ipsum', 'lorem ipsum', '2018-04-26', '80.00', '200.00', '120.00', 2, 1, 2, 3, 0, 1),
(254, 'lorem ipsum', 'lorem ipsum', '2018-04-27', '60.00', '200.00', '140.00', 1, 2, 3, 4, 0, 3),
(255, 'lorem ipsum', 'lorem ipsum', '2018-04-28', '110.00', '300.00', '190.00', 4, 1, 1, 2, 0, 4),
(256, 'lorem ipsum', 'lorem ipsum', '2018-04-28', '20.00', '200.00', '180.00', 2, 1, 1, 1, 0, 1),
(257, 'lorem ipsum', 'lorem ipsum', '2018-05-01', '80.00', '200.00', '120.00', 1, 2, 2, 1, 0, 2),
(258, 'lorem ipsum', 'lorem ipsum', '2018-05-02', '100.00', '200.00', '100.00', 4, 2, 1, 2, 0, 3),
(259, 'lorem ipsum', 'lorem ipsum', '2018-05-05', '80.00', '200.00', '120.00', 4, 2, 1, 3, 0, 2),
(260, 'lorem ipsum', 'lorem ipsum', '2018-05-06', '70.00', '200.00', '130.00', 2, 2, 2, 2, 0, 4),
(261, 'lorem ipsum', 'lorem ipsum', '2018-05-07', '80.00', '200.00', '120.00', 3, 2, 2, 2, 0, 1),
(262, 'lorem ipsum', 'lorem ipsum', '2018-05-08', '80.00', '200.00', '120.00', 2, 1, 3, 1, 0, 7),
(263, 'lorem ipsum', 'lorem ipsum', '2018-05-11', '120.00', '220.00', '100.00', 2, 2, 1, 1, 0, 6),
(264, 'lorem ipsum', 'lorem ipsum', '2018-05-11', '120.00', '300.00', '180.00', 2, 1, 3, 1, 0, 2),
(265, 'lorem ipsum', 'lorem ipsum', '2018-05-16', '20.00', '200.00', '180.00', 4, 1, 2, 2, 0, 2),
(266, 'lorem ipsum', 'lorem ipsum', '2018-05-17', '80.00', '200.00', '120.00', 3, 1, 2, 3, 4, 3),
(267, 'lorem ipsum', 'lorem ipsum', '2018-05-18', '160.00', '200.00', '40.00', 2, 2, 3, 4, 0, 1),
(268, 'lorem ipsum', 'lorem ipsum', '2018-05-19', '100.00', '200.00', '100.00', 4, 1, 2, 2, 0, 1),
(269, 'lorem ipsum', 'lorem ipsum', '2018-05-22', '120.00', '200.00', '80.00', 2, 2, 3, 1, 0, 2),
(270, 'lorem ipsum', 'lorem ipsum', '2018-05-22', '50.00', '100.00', '50.00', 5, 2, 2, 2, 0, 3),
(271, 'lorem ipsum', 'lorem ipsum', '2018-05-23', '60.00', '200.00', '140.00', 2, 1, 1, 2, 0, 5),
(272, 'lorem ipsum', 'lorem ipsum', '2018-05-24', '80.00', '100.00', '80.00', 3, 2, 1, 3, 4, 3),
(273, 'lorem ipsum', 'lorem ipsum', '2018-05-27', '40.00', '160.00', '120.00', 2, 2, 1, 1, 0, 1),
(274, 'lorem ipsum', 'lorem ipsum', '2018-05-27', '120.00', '400.00', '280.00', 4, 1, 1, 2, 0, 2),
(275, 'lorem ipsum', 'lorem ipsum', '2018-06-05', '20.00', '200.00', '180.00', 2, 1, 2, 2, 0, 2),
(276, 'lorem ipsum', 'lorem ipsum', '2018-06-08', '80.00', '200.00', '120.00', 3, 2, 2, 3, 1, 3),
(277, 'lorem ipsum', 'lorem ipsum', '2018-06-08', '60.00', '100.00', '40.00', 2, 2, 2, 4, 0, 1),
(278, 'lorem ipsum', 'lorem ipsum', '2018-06-13', '100.00', '200.00', '100.00', 2, 1, 2, 2, 0, 2),
(279, 'lorem ipsum', 'lorem ipsum', '2018-06-14', '120.00', '200.00', '80.00', 2, 2, 3, 1, 0, 3),
(280, 'lorem ipsum', 'lorem ipsum', '2018-06-14', '50.00', '100.00', '50.00', 1, 2, 2, 2, 0, 5),
(281, 'lorem ipsum', 'lorem ipsum', '2018-06-16', '60.00', '200.00', '140.00', 2, 1, 1, 2, 0, 2),
(282, 'lorem ipsum', 'lorem ipsum', '2018-06-21', '100.00', '200.00', '100.00', 3, 2, 1, 3, 4, 3),
(283, 'lorem ipsum', 'lorem ipsum', '2018-06-25', '40.00', '260.00', '220.00', 2, 2, 1, 1, 0, 3),
(284, 'lorem ipsum', 'lorem ipsum', '2018-06-26', '20.00', '100.00', '80.00', 4, 2, 1, 1, 0, 1),
(285, 'lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque viverra augue eu lobortis mattis. Cras vel mi faucibus, gravida est a, facilisis sem.', '2018-07-05', '20.00', '100.00', '80.00', 3, 1, 1, 3, 4, 9),
(286, 'test edit of data', 'test edit of data', '2018-07-08', '70.00', '250.00', '180.00', 4, 1, 1, 4, 0, 9),
(287, 'test add of data', 'test add of ', '2018-07-09', '60.00', '230.00', '170.00', 5, 2, 1, 3, 0, 9),
(288, 'test input 2', 'test input 2', '2018-07-09', '20.00', '120.00', '100.00', 5, 2, 1, 1, 0, 9),
(289, 'sample input with default values', 'sample input with default values', '2018-07-16', '130.00', '650.00', '520.00', 5, 2, 2, 4, 3, 9),
(290, 'test input 2 with default values', 'test input 2 with default values', '2018-07-16', '50.00', '440.00', '390.00', 3, 2, 1, 4, 1, 9),
(291, 'sample input from the index page', 'sample input from the index page', '2018-07-16', '40.00', '190.00', '150.00', 3, 1, 3, 3, 1, 14),
(292, 'test input with 0 value final cost', 'test input with 0 value final cost', '2018-07-18', '120.00', '120.00', '0.00', 6, 2, 1, 2, 2, 9),
(293, 'wwwwwwwwwwwwww', 'wwwwwwwwwwwwwww', '2018-07-30', '40.00', '200.00', '160.00', 3, 2, 1, 3, 4, 9),
(294, 'qqqqqqqqq', 'qqqqwwwwwq', '2018-07-30', '35.00', '200.00', '165.00', 5, 2, 3, 1, 3, 9),
(295, 'test input for project dropdown 2', 'test input for dropdown 2', '2018-07-30', '70.00', '250.00', '180.00', 6, 1, 3, 4, 1, 9),
(296, 'test input - project with logs', 'test input - project with logs', '2018-07-30', '90.00', '300.00', '210.00', 1, 2, 1, 4, 5, 9),
(297, 'test input - projects with logs', 'test input - projects with logs', '2018-07-30', '90.00', '300.00', '210.00', 1, 2, 1, 4, 5, 9),
(298, 'pppppppppppppp', 'pppppppppppppp', '2018-07-30', '80.00', '100.00', '20.00', 3, 2, 1, 3, 3, 9),
(299, 'test for proj input with logs', 'test for proj input with logs', '2018-07-30', '90.00', '300.00', '210.00', 1, 2, 1, 4, 3, 9),
(300, 'test add for view page', 'test add for view page', '2018-07-30', '130.00', '800.00', '670.00', 2, 2, 1, 3, 1, 9),
(301, 'test input 2 for view', 'test input 2 for view', '2018-07-30', '60.00', '200.00', '140.00', 6, 1, 2, 4, 5, 9),
(302, 'test input 3 for view', 'test input 3 for view', '2018-07-30', '30.00', '200.00', '170.00', 4, 2, 1, 3, 4, 9),
(303, '1234567890', '1234567890', '2018-08-01', '50.00', '500.00', '450.00', 1, 2, 2, 2, 6, 9),
(304, 'qwwwwe', 'qqqqqqqqwwwwe', '2018-08-01', '50.00', '150.00', '100.00', 4, 2, 1, 3, 4, 14);

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
(5, 'My Team'),
(6, 'New Team');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logID` int(11) NOT NULL,
  `logDate` datetime NOT NULL,
  `logUser` varchar(100) NOT NULL,
  `logEvent` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logID`, `logDate`, `logUser`, `logEvent`) VALUES
(1, '2018-07-09 09:41:16', 'Mark Castillo', 'Logged in into the system.'),
(2, '2018-07-09 09:43:40', 'Mark Castillo', 'Logged out of the system.'),
(3, '2018-07-09 09:43:54', 'Mark Castillo', 'Logged in into the system.'),
(4, '2018-07-09 10:10:40', 'Mark Castillo', 'Updated the information of record #2'),
(5, '2018-07-09 11:05:15', 'Mark Castillo', 'Updated record #2 of environments from \'QA\' to \'Quality Assurance\''),
(6, '2018-07-09 11:08:47', 'Mark Castillo', 'Updated record #2 of environments from \'Quality Assurance\' to \'QA\''),
(7, '2018-07-09 11:09:24', 'Mark Castillo', 'Updated record #4 of journey teams from \'Testing\' to \'Testing 1\''),
(8, '2018-07-09 11:09:42', 'Mark Castillo', 'Updated record #4 of journey teams from \'Testing 1\' to \'Testing\''),
(9, '2018-07-09 11:10:18', 'Mark Castillo', 'Added a new journey team: New Team'),
(10, '2018-07-09 11:14:54', 'Mark Castillo', 'Updated record #4 of savings types from \'Optimization\' to \'Optimizations\''),
(11, '2018-07-09 11:15:09', 'Mark Castillo', 'Updated record #4 of savings types from \'Optimizations\' to \'Optimization\''),
(12, '2018-07-09 11:19:21', 'Mark Castillo', 'Added a new cost savings entry dated: 2018-07-08, with a total savings of $55'),
(13, '2018-07-09 11:37:20', 'Mark Castillo', 'Added a new cost savings entry dated 2018-07-09, with a total savings of $60'),
(14, '2018-07-09 11:39:52', 'Mark Castillo', 'Updated the information of record #286'),
(15, '2018-07-09 11:56:43', 'Mark Castillo', 'Updated the information of cost savings record #285'),
(16, '2018-07-09 12:00:51', 'Mark Castillo', 'Added a new cost savings entry dated 2018-07-09, with a total savings of $20'),
(17, '2018-07-10 08:05:38', 'Ashton Foreman', 'Logged in into the system'),
(18, '2018-07-10 08:35:12', 'Mark Castillo', 'Updated the information of cost savings record #287'),
(19, '2018-07-10 15:25:50', 'Ashton Foreman', 'Logged in into the system'),
(20, '2018-07-11 06:50:18', 'Mark Castillo', 'Logged in into the system'),
(21, '2018-07-11 07:06:00', 'Mark Castillo', 'Logged out of the system'),
(22, '2018-07-11 07:09:11', 'Henry Moose', 'Logged in into the system'),
(23, '2018-07-11 07:09:20', 'Henry Moose', 'Logged out of the system'),
(24, '2018-07-11 07:09:20', ' ', 'Logged out of the system'),
(25, '2018-07-11 07:09:28', 'Mark Castillo', 'Logged in into the system'),
(26, '2018-07-11 08:57:29', 'Ashton Foreman', 'Logged in into the system'),
(27, '2018-07-11 13:53:35', 'Ashton Foreman', 'Logged out of the system'),
(28, '2018-07-11 13:53:35', ' ', 'Logged out of the system'),
(29, '2018-07-11 13:53:54', 'Ashton Foreman', 'Logged in into the system'),
(30, '2018-07-11 13:54:13', 'Ashton Foreman', 'Logged out of the system'),
(31, '2018-07-11 13:54:24', 'Ashton Foreman', 'Logged in into the system'),
(32, '2018-07-11 13:54:30', 'Ashton Foreman', 'Logged out of the system'),
(33, '2018-07-16 11:33:49', 'Ashton Foreman', 'Logged in into the system'),
(34, '2018-07-16 15:08:16', 'Mark Castillo', 'Updated their account information.'),
(35, '2018-07-16 15:10:25', 'Mark Castillo', 'Added a new cost savings entry dated 2018-07-16, with a total savings of $130'),
(36, '2018-07-16 15:10:45', 'Mark Castillo', 'Updated their account information.'),
(37, '2018-07-16 15:11:36', 'Mark Castillo', 'Added a new cost savings entry dated 2018-07-16, with a total savings of $50'),
(38, '2018-07-16 15:21:09', 'Ashton Foreman', 'Added a new cost savings entry dated 2018-07-16, with a total savings of $40'),
(39, '2018-07-16 15:22:25', 'Ashton Foreman', 'Updated their account information.'),
(40, '2018-07-18 14:25:47', 'Mark Castillo', 'Added a new cost savings entry dated 2018-07-18, with a total savings of $120'),
(41, '2018-07-23 18:11:34', 'Mark Castillo', 'Logged in into the system'),
(42, '2018-07-25 07:58:30', 'Ashton Foreman', 'Logged in into the system'),
(43, '2018-07-25 13:42:06', 'Ashton Foreman', 'Logged in into the system'),
(44, '2018-07-25 14:59:05', 'Mark Castillo', 'Changed the access level of Ashton Foreman from 3 to 2'),
(45, '2018-07-26 09:37:56', 'Mark Castillo', 'Archived Antonio Akyatpanaog\'s account (account ID #3)'),
(46, '2018-07-26 09:59:02', 'Mark Castillo', 'Archived Darrell Brady\'s account (account ID #16)'),
(47, '2018-07-26 10:28:13', 'Mark Castillo', ''),
(48, '2018-07-26 10:32:39', 'Mark Castillo', 'Archived Darrell Brady\'s account (account ID #16)'),
(49, '2018-07-26 10:47:42', 'Ashton Foreman', 'Logged in into the system'),
(50, '2018-07-26 11:01:22', 'Mark Castillo', 'Logged out of the system'),
(51, '2018-07-26 11:01:30', 'Mark Castillo', 'Logged in into the system'),
(52, '2018-07-26 11:09:58', 'Mark Castillo', 'Changed the access level of Ashton Foreman from 2 to 3'),
(53, '2018-07-26 11:14:19', 'Ashton Foreman', 'Logged out of the system'),
(54, '2018-07-26 11:19:44', 'Mark Castillo', 'Logged out of the system'),
(55, '2018-07-26 11:19:51', 'Mark Castillo', 'Logged in into the system'),
(56, '2018-07-26 11:22:12', 'Mark Castillo', 'Logged out of the system'),
(57, '2018-07-26 11:22:18', 'Mark Castillo', 'Logged in into the system'),
(58, '2018-07-26 11:22:35', 'Mark Castillo', ''),
(59, '2018-07-26 11:22:44', 'Mark Castillo', 'Logged out of the system'),
(60, '2018-07-26 11:23:05', 'Mark Castillo', 'Logged in into the system'),
(61, '2018-07-26 11:24:40', 'Mark Castillo', 'Archived Antonio Akyatpanaog\'s account (account ID #10)'),
(62, '2018-07-26 11:24:53', 'Mark Castillo', ''),
(63, '2018-07-27 14:06:18', 'Ashton Foreman', 'Logged in into the system'),
(64, '2018-07-30 09:55:50', 'Mark Castillo', 'Added a new cost savings entry dated 2018-07-30, with a total savings of $40'),
(65, '2018-07-30 13:31:39', 'Mark Castillo', 'Added a new cost savings entry dated 2018-07-30, with a total savings of $35'),
(66, '2018-07-30 13:35:04', 'Mark Castillo', 'Updated their account information.'),
(67, '2018-07-30 13:50:08', 'Mark Castillo', 'Added a new cost savings entry dated 2018-07-30, with a total savings of $70'),
(68, '2018-07-30 14:13:36', 'Mark Castillo', 'Added a new cost savings entry for the project , with a total savings of $90'),
(69, '2018-07-30 14:14:38', 'Mark Castillo', 'Added a new cost savings entry for the project , with a total savings of $90'),
(70, '2018-07-30 14:15:21', 'Mark Castillo', 'Added a new cost savings entry for the project , with a total savings of $80'),
(71, '2018-07-30 14:16:22', 'Mark Castillo', 'Added a new cost savings entry for the project Project 3, with a total savings of $90'),
(72, '2018-07-30 14:27:29', 'Mark Castillo', 'Added a new cost savings entry for the project Project 1, with a total savings of $130'),
(73, '2018-07-30 14:28:33', 'Mark Castillo', 'Added a new cost savings entry for the project Project 5, with a total savings of $60'),
(74, '2018-07-30 14:29:12', 'Mark Castillo', 'Added a new cost savings entry for the project Project 4, with a total savings of $30'),
(75, '2018-07-30 14:50:42', 'Mark Castillo', 'Added a new project: Project ABC'),
(76, '2018-07-30 14:52:07', 'Mark Castillo', 'Added a new project: Project ABC'),
(77, '2018-07-31 11:07:33', 'Mark Castillo', 'Updated record #3 of projects from \'Project 3\' to \'Project 3 Test\''),
(78, '2018-08-01 13:56:44', 'Mark Castillo', 'Added a new project: Project 6'),
(79, '2018-08-01 14:04:32', 'Mark Castillo', 'Added a new cost savings entry for the project Project ABC, with a total savings of $50'),
(80, '2018-08-01 14:05:40', 'Mark Castillo', 'Logged out of the system'),
(81, '2018-08-01 14:05:49', 'Ashton Foreman', 'Logged in into the system'),
(82, '2018-08-01 14:06:29', 'Ashton Foreman', 'Added a new cost savings entry for the project Project 4, with a total savings of $50'),
(83, '2018-08-01 14:06:48', 'Ashton Foreman', 'Logged out of the system'),
(84, '2018-08-01 14:06:56', 'Mark Castillo', 'Logged in into the system'),
(85, '2018-08-01 14:08:32', 'Mark Castillo', 'Updated record #1 of projects from \'Project 1\' to \'Project 1\'');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projectID` int(11) NOT NULL,
  `projectName` varchar(100) NOT NULL,
  `projectDescription` varchar(300) NOT NULL,
  `projectStatus` tinyint(4) NOT NULL COMMENT '1-active; 2-something..; etc.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectID`, `projectName`, `projectDescription`, `projectStatus`) VALUES
(1, 'Project 1', 'Hello World 123', 1),
(2, 'Project 2', 'hesoyam', 1),
(3, 'Project 3 Test', 'Test update for project information', 1),
(4, 'Project 4', '12345', 1),
(5, 'Project 5', '54321', 1),
(6, 'Project ABC', 'This is a test input using the add form', 1),
(7, 'Project 6', 'Testing for the project status default on adding a new record', 1);

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
  `userLN` varchar(100) NOT NULL,
  `envID` int(11) DEFAULT NULL,
  `teamID` int(11) DEFAULT NULL,
  `techID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userFN`, `userLN`, `envID`, `teamID`, `techID`) VALUES
(1, 'Mark', 'Castillo', NULL, NULL, NULL),
(2, 'Mark', 'Castillo', NULL, NULL, NULL),
(3, 'Antonio', 'Akyatpanaog', NULL, NULL, NULL),
(4, 'Mark Ian', 'Castillo', NULL, NULL, NULL),
(5, 'Screenshot', 'API', NULL, NULL, NULL),
(6, 'Jane', 'Doe', NULL, NULL, NULL),
(7, 'John', 'Doe', NULL, NULL, NULL),
(8, 'Lorem', 'Ipsum', NULL, NULL, NULL),
(9, 'Mark', 'Castillo', 1, 0, 2),
(10, 'Antonio', 'Akyatpanaog', NULL, NULL, NULL),
(11, 'Cameron', 'Leblanc', NULL, NULL, NULL),
(12, 'Rebecca', 'Winters', NULL, NULL, NULL),
(13, 'Maliha', 'Crowther', NULL, NULL, NULL),
(14, 'Ashton', 'Foreman', 1, 4, 2),
(15, 'Tahlia', 'Jeffery', NULL, NULL, NULL),
(16, 'Darrell', 'Brady', NULL, NULL, NULL),
(17, 'Devan', 'Moses', NULL, NULL, NULL),
(18, 'Nela', 'Hopper', NULL, NULL, NULL),
(19, 'Henry', 'Moose', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`accessID`);

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
  ADD KEY `costsavings_ibfk_5` (`userID`);

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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projectID`);

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
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `accessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `costsavings`
--
ALTER TABLE `costsavings`
  MODIFY `csID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `environments`
--
ALTER TABLE `environments`
  MODIFY `envID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `journeyteams`
--
ALTER TABLE `journeyteams`
  MODIFY `teamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  ADD CONSTRAINT `costsavings_ibfk_5` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
