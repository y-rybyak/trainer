-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 06:12 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trainer`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `intId` int(11) NOT NULL AUTO_INCREMENT,
  `varLogin` varchar(255) NOT NULL,
  `varPasswordHash` varchar(256) NOT NULL,
  PRIMARY KEY (`intId`),
  UNIQUE KEY `intId` (`intId`,`varLogin`),
  UNIQUE KEY `varLogin` (`varLogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`intId`, `varLogin`, `varPasswordHash`) VALUES
(1, 'ihaveabomb', '60d0b59714dcfc8918e9fafea1ac3815');

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `intId` int(11) NOT NULL AUTO_INCREMENT,
  `intUserId` int(11) NOT NULL,
  `english` varchar(256) NOT NULL,
  `russian` varchar(256) NOT NULL,
  `german` varchar(256) NOT NULL,
  `ukrainian` varchar(256) NOT NULL,
  PRIMARY KEY (`intId`),
  KEY `intUserId` (`intUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`intId`, `intUserId`, `english`, `russian`, `german`, `ukrainian`) VALUES
(1, 1, 'mother', 'мать', 'die mutter', 'мати'),
(2, 1, 'father', 'отец', 'der vatter', 'тато');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `words`
--
ALTER TABLE `words`
  ADD CONSTRAINT `words_ibfk_1` FOREIGN KEY (`intUserId`) REFERENCES `user` (`intId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
