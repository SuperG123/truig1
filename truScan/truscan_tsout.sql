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
-- Table structure for table `tsout`
--

DROP TABLE IF EXISTS `tsout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsout` (
  `tsOutId` int(11) NOT NULL AUTO_INCREMENT,
  `tsOutSku` varchar(255) NOT NULL,
  `tsOutUpc` varchar(255) DEFAULT NULL,
  `tsOutSource` varchar(255) DEFAULT NULL,
  `tsOutPrice` varchar(255) DEFAULT NULL,
  `tsOutQty` varchar(45) DEFAULT NULL,
  `tsOutLoc` varchar(45) DEFAULT NULL,
  `tsOutDesc1` varchar(255) DEFAULT NULL,
  `tsOutDesc2` varchar(255) DEFAULT NULL,
  `tsOutCost` varchar(45) DEFAULT NULL,
  `tsOutUnit` varchar(45) DEFAULT NULL,
  `tsOutOM` varchar(45) DEFAULT NULL,
  `tsOutCata1` varchar(45) DEFAULT NULL,
  `tsOutCata2` varchar(45) DEFAULT NULL,
  `tsOutCata3` varchar(45) DEFAULT NULL,
  `tsOutCata4` varchar(45) DEFAULT NULL,
  `tsOutWeight` varchar(45) DEFAULT NULL,
  `tsOutDims` varchar(45) DEFAULT NULL,
  `tsOutVendNum` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tsOutId`),
  UNIQUE KEY `tsOutId_UNIQUE` (`tsOutId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsout`
--

LOCK TABLES `tsout` WRITE;
/*!40000 ALTER TABLE `tsout` DISABLE KEYS */;
INSERT INTO `tsout` VALUES (15,'BC2149','885911085076','BobCo','25.40','5','B102','28PC SCREWDRIVING SET','DEWALT IMPACT READY','15.40','EACH','---','ACCPW','SCRWD','SET','---','---','---','bob123'),(16,'DW8250','885911036580','TRU','6.08','10','B105','Flap Disc 4-1/2\" 40X Z/A','DeWALT T27 Z/A          >','4.02','EACH','---','ABRAS','DISC','4.5','FLAP','---','---','DW8250'),(17,'456','654654',NULL,'500','1','1','this is a cool new product','---',NULL,'---','---','New Prod 1','---','---','---','1','1x1x1','MK161');
/*!40000 ALTER TABLE `tsout` ENABLE KEYS */;
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
