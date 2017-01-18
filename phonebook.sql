-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2013 at 07:45 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `phoneauthuser`
--

CREATE TABLE IF NOT EXISTS `phoneauthuser` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `phoneauthuser`
--

INSERT INTO `phoneauthuser` (`Id`, `Username`, `Password`) VALUES
(1, 'admin', 'admin'),
(2, 'ameya', 'ameya');

-- --------------------------------------------------------

--
-- Table structure for table `phoneinfo`
--

CREATE TABLE IF NOT EXISTS `phoneinfo` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `User_Id` int(3) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Contact_Number` varchar(15) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `phoneinfo`
--

INSERT INTO `phoneinfo` (`Id`, `User_Id`, `FirstName`, `LastName`, `Contact_Number`) VALUES
(1, 1, 'Indrayani', 'Sakpal', '9769090703'),
(2, 1, 'Gauri', 'Rane', '9892990158'),
(3, 2, 'Aditya', 'Ghorpade', '9870500041'),
(4, 2, 'Prajakta', 'Rane', '9867782207'),
(5, 1, 'Ameya', 'Jadhav', '9757108081'),
(7, 1, 'Chaitanya', 'Gadve', '9561486462'),
(8, 2, 'Ritesh', 'Rasam', '9892862643'),
(9, 2, 'Abhishek', 'Chavhan', '7738305350'),
(12, 1, 'Priyanka', 'Sanghvi', '9870849219'),
(13, 2, 'Saurabh', 'Kalyankar', '9920134079'),
(15, 2, 'Pallavi', 'Parab', '9969512020');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
