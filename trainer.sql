SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";

CREATE TABLE IF NOT EXISTS `dictionary` (
  `intId` int(11) NOT NULL AUTO_INCREMENT,
  `intUserId` int(11) NOT NULL,
  `english` varchar(255) NOT NULL,
  `russian` varchar(255) NOT NULL,
  PRIMARY KEY (`intId`),
  KEY `intUserId` (`intUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `guess` (
  `varGuess` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user` (
  `intId` int(11) NOT NULL AUTO_INCREMENT,
  `varLogin` varchar(255) NOT NULL,
  `varPasswordHash` varchar(256) NOT NULL,
  PRIMARY KEY (`intId`),
  UNIQUE KEY `intId` (`intId`,`varLogin`),
  UNIQUE KEY `varLogin` (`varLogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `user` (`intId`, `varLogin`, `varPasswordHash`) VALUES
(1, 'ihaveabomb', '60d0b59714dcfc8918e9fafea1ac3815');

CREATE TABLE IF NOT EXISTS `words` (
  `intId` int(11) NOT NULL AUTO_INCREMENT,
  `intUserId` int(11) NOT NULL,
  `english` varchar(256) NOT NULL,
  `russian` varchar(256) NOT NULL,
  PRIMARY KEY (`intId`),
  KEY `intUserId` (`intUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `words` (`intId`, `intUserId`, `english`, `russian`) VALUES
(1, 1, 'cat', 'кот'),
(2, 1, 'forest', 'лес'),
(3, 1, 'sword', 'меч');

ALTER TABLE `dictionary`
  ADD CONSTRAINT `dictionary_ibfk_1` FOREIGN KEY (`intUserId`) REFERENCES `user` (`intId`);

ALTER TABLE `words`
  ADD CONSTRAINT `words_ibfk_1` FOREIGN KEY (`intUserId`) REFERENCES `user` (`intId`);
