-- MySQL dump 10.16  Distrib 10.1.9-MariaDB, for osx10.6 (i386)
--
-- Host: localhost    Database: fishwafmanage
-- ------------------------------------------------------
-- Server version	10.1.9-MariaDB

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
-- Table structure for table `block_default`
--

DROP TABLE IF EXISTS `block_default`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `block_default` (
  `sqli` varchar(8192) DEFAULT NULL,
  `file_extension` varchar(8192) DEFAULT NULL,
  `file_length` int(11) DEFAULT NULL,
  `caidao` varchar(8192) DEFAULT NULL,
  `url_length` int(11) DEFAULT NULL,
  `body_length` int(11) DEFAULT NULL,
  `uri_list` varchar(8192) DEFAULT NULL,
  `except_extension` varchar(8192) DEFAULT NULL,
  `file_content` varchar(8192) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block_default`
--

LOCK TABLES `block_default` WRITE;
/*!40000 ALTER TABLE `block_default` DISABLE KEYS */;
INSERT INTO `block_default` VALUES ('select,|,|,|from','.js,|,|,|.css,|,|,|.html',2048000,'eval,|,|,|assert,|,|,|base64',2803,4096000,'','','eval,|,|,|assert,|,|,|base64');
/*!40000 ALTER TABLE `block_default` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `block_diy`
--

DROP TABLE IF EXISTS `block_diy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `block_diy` (
  `url_content` varchar(8192) DEFAULT NULL,
  `body_content` varchar(8192) DEFAULT NULL,
  `header_content` varchar(8192) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block_diy`
--

LOCK TABLES `block_diy` WRITE;
/*!40000 ALTER TABLE `block_diy` DISABLE KEYS */;
INSERT INTO `block_diy` VALUES ('','','');
/*!40000 ALTER TABLE `block_diy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocked_ip_by_delay_rule`
--

DROP TABLE IF EXISTS `blocked_ip_by_delay_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocked_ip_by_delay_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `rule` varchar(32) NOT NULL,
  `time` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocked_ip_by_delay_rule`
--

LOCK TABLES `blocked_ip_by_delay_rule` WRITE;
/*!40000 ALTER TABLE `blocked_ip_by_delay_rule` DISABLE KEYS */;
INSERT INTO `blocked_ip_by_delay_rule` VALUES (2,'42.42.42.42','limit per 10 seconds','1489742274');
/*!40000 ALTER TABLE `blocked_ip_by_delay_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delay_block`
--

DROP TABLE IF EXISTS `delay_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delay_block` (
  `limit_per_10_seconds` int(11) NOT NULL,
  `limit_for_block` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delay_block`
--

LOCK TABLES `delay_block` WRITE;
/*!40000 ALTER TABLE `delay_block` DISABLE KEYS */;
INSERT INTO `delay_block` VALUES (50,10);
/*!40000 ALTER TABLE `delay_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `global_config`
--

DROP TABLE IF EXISTS `global_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_config` (
  `real_ip` varchar(32) NOT NULL,
  `real_port` varchar(16) NOT NULL,
  `is_open` int(11) NOT NULL,
  `white_ip` int(11) NOT NULL,
  `black_ip` int(11) NOT NULL,
  `sqli` int(11) NOT NULL,
  `file_extension` int(11) NOT NULL,
  `file_content` int(11) NOT NULL,
  `file_length` int(11) NOT NULL,
  `caidao` int(11) NOT NULL,
  `url_length` int(11) NOT NULL,
  `body_length` int(11) NOT NULL,
  `whiteuri` int(11) NOT NULL,
  `url_content` int(11) NOT NULL,
  `body_content` int(11) NOT NULL,
  `limit_per_10_seconds` int(11) NOT NULL,
  `limit_for_block` int(11) NOT NULL,
  `blocked_ip` int(11) NOT NULL,
  `xss_protection` int(11) NOT NULL,
  `dummy_protection` int(11) NOT NULL,
  `is_debug` int(11) NOT NULL,
  `csrf_protection` int(11) NOT NULL,
  `header_content` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `global_config`
--

LOCK TABLES `global_config` WRITE;
/*!40000 ALTER TABLE `global_config` DISABLE KEYS */;
INSERT INTO `global_config` VALUES ('127.0.0.1','8080',1,0,0,1,1,0,0,1,1,0,0,0,0,0,0,0,0,0,1,0,0);
/*!40000 ALTER TABLE `global_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip_rule`
--

DROP TABLE IF EXISTS `ip_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ip_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(1024) NOT NULL,
  `ip` varchar(8192) NOT NULL,
  `type` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_rule`
--

LOCK TABLES `ip_rule` WRITE;
/*!40000 ALTER TABLE `ip_rule` DISABLE KEYS */;
INSERT INTO `ip_rule` VALUES (5,'/admin','127.0.0.1','white'),(6,'/','22.22.22.22','black'),(9,'/','44.44.44.44','black');
/*!40000 ALTER TABLE `ip_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `rule` varchar(32) NOT NULL,
  `time` varchar(64) NOT NULL,
  `type` varchar(16) NOT NULL,
  `request` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,'123.123.123.123','sqli','1489916631','block','GET /page.php?id=1 select HTTP/1.1\r\nHost: www.test.com\r\nUser-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36\r\n\r\n');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$ZOnvEbOSsexdNhFXnrV5I.NDWWlehAxVdV9Ngjnenmm3U8d1liyki');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-21 15:02:56
