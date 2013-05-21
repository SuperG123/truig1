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
-- Table structure for table `tsnew`
--

DROP TABLE IF EXISTS `tsnew`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsnew` (
  `tsNewId` int(11) NOT NULL AUTO_INCREMENT,
  `tsNewSku` varchar(255) DEFAULT NULL,
  `tsNewUpc` varchar(255) DEFAULT NULL,
  `tsNewCt` varchar(255) DEFAULT NULL,
  `tsNewLoc` varchar(255) DEFAULT NULL,
  `tsNewVendor` varchar(255) DEFAULT NULL,
  `tsNewCreation` datetime DEFAULT NULL,
  `tsNewPrice` varchar(45) DEFAULT NULL,
  `tsNewCata` varchar(150) DEFAULT NULL,
  `tsNewDesc` longtext,
  `tsNewWeight` varchar(45) DEFAULT NULL,
  `tsNewDims` varchar(45) DEFAULT NULL,
  `tsNewCost` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tsNewId`),
  UNIQUE KEY `tsNewId_UNIQUE` (`tsNewId`),
  UNIQUE KEY `tsNewSku_UNIQUE` (`tsNewSku`),
  UNIQUE KEY `tsNewUpc_UNIQUE` (`tsNewUpc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsnew`
--

LOCK TABLES `tsnew` WRITE;
/*!40000 ALTER TABLE `tsnew` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsnew` ENABLE KEYS */;
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
