CREATE DATABASE  IF NOT EXISTS `truigone_truscan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `truigone_truscan`;
-- MySQL dump 10.13  Distrib 5.5.31, for Linux (x86_64)
--
-- Host: localhost    Database: truigone_truscan
-- ------------------------------------------------------
-- Server version	5.5.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tsindv`
--

DROP TABLE IF EXISTS `tsindv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsindv` (
  `tsIndvId` int(11) NOT NULL AUTO_INCREMENT,
  `tsIndvUN` varchar(45) NOT NULL COMMENT 'user name',
  `tsIndvP` varchar(255) NOT NULL COMMENT 'pass',
  `tsIndvCt` varchar(150) NOT NULL DEFAULT '0' COMMENT 'products scanned, saved',
  `tsIndvAct` varchar(5) NOT NULL COMMENT 'active account',
  `tsIndvLastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tsIndvFN` varchar(45) NOT NULL COMMENT 'first name',
  `tsIndvLN` varchar(45) NOT NULL COMMENT 'last name',
  `tsIndvEM` varchar(255) NOT NULL COMMENT 'email',
  `tsIndvSU` varchar(5) NOT NULL,
  PRIMARY KEY (`tsIndvId`),
  UNIQUE KEY `tsIndvId_UNIQUE` (`tsIndvId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsindv`
--

LOCK TABLES `tsindv` WRITE;
/*!40000 ALTER TABLE `tsindv` DISABLE KEYS */;
INSERT INTO `tsindv` VALUES (1,'eric','eric','0','1','2013-04-24 15:45:58','Eric','Gould','supergis@icloud.com','1'),(2,'bob','bob','0','1','2013-04-24 15:45:58','Bob','Smith','bob@example.com','0'),(3,'eric','jones','0','1','0000-00-00 00:00:00','Eric','Jones','eric@example.com','0'),(4,'adam','adam','0','1','0000-00-00 00:00:00','Adam','Martin','adam.martin@etoolsrus.com','1');
/*!40000 ALTER TABLE `tsindv` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-09 10:19:14
