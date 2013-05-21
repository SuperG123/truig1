CREATE DATABASE  IF NOT EXISTS `truigone_truscan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `truigone_truscan`;
--
-- Table structure for table `tsdat`
--
DROP TABLE IF EXISTS `tsdat`;

CREATE TABLE `tsdat` (
  `tsId` int(11) NOT NULL AUTO_INCREMENT,
  `tsSku` varchar(255) NOT NULL,
  `tsUpc` varchar(255) DEFAULT '---',
  `tsSource` varchar(255) DEFAULT NULL,
  `tsPrice` varchar(150) DEFAULT NULL,
  `tsDesc1` longtext,
  `tsDesc2` longtext,
  `tsDesc3` longtext,
  `tsCost` varchar(45) DEFAULT NULL,
  `tsUnit` varchar(45) DEFAULT NULL,
  `tsOM` varchar(45) DEFAULT NULL,
  `tsCata1` varchar(255) DEFAULT NULL,
  `tsCata2` varchar(255) DEFAULT NULL,
  `tsCata3` varchar(255) DEFAULT NULL,
  `tsWeight` varchar(45) DEFAULT NULL,
  `tsDims` varchar(45) DEFAULT NULL,
  `tsVendNum` varchar(45) DEFAULT NULL,
  `tsCata4` varchar(255) DEFAULT NULL,
  `tsSrcSku` varchar(150) NOT NULL,
  PRIMARY KEY (`tsId`),
  UNIQUE KEY `tsId_UNIQUE` (`tsId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;