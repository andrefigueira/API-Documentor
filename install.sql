-- Create syntax for TABLE 'calls'
CREATE TABLE `calls` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) unsigned NOT NULL,
  `uri` varchar(256) NOT NULL DEFAULT '',
  `name` varchar(256) NOT NULL,
  `description` varchar(2048) NOT NULL DEFAULT '',
  `method` tinyint(1) NOT NULL,
  `auth` tinyint(1) NOT NULL,
  `response` text NOT NULL,
  `parameters` text NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `categoryID` (`categoryID`),
  CONSTRAINT `calls_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'categories'
CREATE TABLE `categories` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL DEFAULT '',
  `description` varchar(1024) NOT NULL DEFAULT '',
  `position` tinyint(11) NOT NULL,
  `addedDate` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'users'
CREATE TABLE `users` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(512) NOT NULL DEFAULT '',
  `email` varchar(1024) NOT NULL DEFAULT '',
  `password` varchar(1024) NOT NULL DEFAULT '',
  `addedDate` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`ID`, `username`, `email`, `password`, `addedDate`)
VALUES
	(5, 'admin', 'user@website.com', '$1$n8CTiI49$yyjgidx4jSdJGn1rW1xXP.', '2013-05-16 16:29:27');


INSERT INTO `categories` (`ID`, `name`, `description`, `position`, `addedDate`)
VALUES
	(0, 'Uncategorised', 'Categories which do not pertain to a particular category', 0, '2013-05-17 11:58:50');
