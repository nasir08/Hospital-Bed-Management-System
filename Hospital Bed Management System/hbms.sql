-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2014 at 02:27 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hbms`
--
CREATE DATABASE IF NOT EXISTS `hbms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hbms`;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE IF NOT EXISTS `beds` (
  `bed_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(150) NOT NULL,
  `ward` varchar(150) NOT NULL,
  PRIMARY KEY (`bed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bed_id`, `type`, `ward`) VALUES
(1, 'Manual', 'Paediatric'),
(2, 'Semi-Electric', 'Accidents And Emergency'),
(3, 'Full-Electric', 'Psychiatric'),
(4, 'Bariatric', 'Orthopaedic'),
(5, 'Low Bed', 'Critical Care'),
(6, 'Manual', 'Postnatal'),
(7, 'Semi-Electric', 'Pregnancy');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `pat_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(150) NOT NULL,
  `blood_group` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  PRIMARY KEY (`pat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`pat_id`, `name`, `age`, `sex`, `blood_group`, `phone`) VALUES
(1, 'Ayofe Adeleke', 21, 'Male', 'A+', '08077424593'),
(2, 'Adesanya Ayodeji', 22, 'Male', 'O-', '08077424593'),
(3, 'Kazeem Adekunle', 33, 'Male', 'A+', '08077424593'),
(4, 'Lato Solomon', 29, 'Female', 'O+', '08077424593'),
(5, 'Ayofe Malik', 19, 'Male', 'A+', '08077424593'),
(6, 'Obi Adaobi', 46, 'Female', 'O-', '08077424593'),
(7, 'Ayoyinka Omotoso', 12, 'Transexual', 'A+', '08077424593'),
(8, 'Kit Harington', 27, 'Transexual', 'A+', '+5517657643'),
(10, 'Atinuke', 12, 'Other', 'A+', '0989976689');

-- --------------------------------------------------------

--
-- Table structure for table `pat_to_bed`
--

CREATE TABLE IF NOT EXISTS `pat_to_bed` (
  `pat_id` bigint(20) NOT NULL,
  `bed_id` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pat_to_bed`
--

INSERT INTO `pat_to_bed` (`pat_id`, `bed_id`) VALUES
(1, 'none'),
(2, '1'),
(3, 'none'),
(4, '0'),
(5, '2'),
(6, 'none'),
(7, '3'),
(8, '0'),
(10, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `uname` varchar(150) NOT NULL,
  `pword` varchar(150) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `uname`, `pword`) VALUES
(1, 'Obi Adaobi', 'ada', 'ada');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
