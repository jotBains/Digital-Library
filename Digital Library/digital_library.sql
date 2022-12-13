-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2022 at 12:51 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_resource`
--

DROP TABLE IF EXISTS `borrowed_resource`;
CREATE TABLE IF NOT EXISTS `borrowed_resource` (
  `ID` varchar(40) NOT NULL,
  `bookNo` varchar(40) NOT NULL,
  `starting_date` date NOT NULL,
  `due_date` date NOT NULL,
  `total_cost` int(11) NOT NULL,
  `extended_due_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowed_resource`
--

INSERT INTO `borrowed_resource` (`ID`, `bookNo`, `starting_date`, `due_date`, `total_cost`, `extended_due_date`) VALUES
('3', '6', '2022-05-27', '2022-05-30', 40, NULL),
('1', '9', '2022-05-28', '2022-05-31', 40, NULL),
('1', '5', '2022-05-28', '2022-05-31', 40, NULL),
('1', '4', '2022-05-28', '2022-05-31', 40, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
CREATE TABLE IF NOT EXISTS `resource` (
  `bookNo` tinyint(40) NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(40) NOT NULL,
  `title` varchar(40) NOT NULL,
  `author` varchar(40) NOT NULL,
  `publisher` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `cost_per_day` bigint(40) NOT NULL,
  `extended_cost` bigint(40) NOT NULL,
  PRIMARY KEY (`bookNo`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`bookNo`, `ISBN`, `title`, `author`, `publisher`, `status`, `cost_per_day`, `extended_cost`) VALUES
(4, '123', 'IT', 'jon', 'uow', 'available', 5, 10),
(5, '1234', 'art', 'jot', 'bains', 'borrowed', 6, 12),
(6, '12', 'paint', 'IT', ' jot', 'borrowed', 60, 6),
(8, '123', 'game', 'bains', ' rmit', ' borrowed', 5, 6),
(9, '123', 'database', ' ram', 'ramnath', 'available', 5, 6),
(10, '12345', 'milk', ' mr bas', ' uow', ' available', 23, 34);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE IF NOT EXISTS `userinfo` (
  `ID` int(40) NOT NULL AUTO_INCREMENT,
  `Email` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `password_MD5` varchar(40) NOT NULL,
  `userType` varchar(40) NOT NULL DEFAULT 'Borrower',
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`ID`, `Email`, `name`, `Surname`, `password_MD5`, `userType`, `phone`) VALUES
(1, 'charnjot2000@gmail.com', 'charnjot', 'singh', '123456', 'Borrower', '23456789'),
(2, 'jot2000@gmail.com', 'jot', 'bains', '123456', 'Librarian', '23456789'),
(3, 'charnjot200@gmail.com', 'charnjot singh', 'singh', '123456', 'Borrower', '0421501869'),
(9, 'charnjot80@gmail.com', 'charnjot singh', 'ram', '123456', 'Borrower', '0421501869'),
(10, 'charnjot20@gmail.com', 'charnjot singh', 'ram', '123456', 'Borrower', '0421501869');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
