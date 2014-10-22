-- MySQL dump 10.13  Distrib 5.5.32, for Win32 (x86)
--
-- Host: localhost    Database: connectmu
-- ------------------------------------------------------
-- Server version	5.5.32

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
-- Table structure for table `connection`
--

DROP TABLE IF EXISTS `connection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connection` (
  `user_id` int(100) NOT NULL,
  `conn_id` int(100) NOT NULL,
  `type` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `date` date NOT NULL,
  KEY `user_id` (`user_id`,`conn_id`),
  KEY `conn_id` (`conn_id`),
  CONSTRAINT `connection_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  CONSTRAINT `connection_ibfk_2` FOREIGN KEY (`conn_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This contains connection information.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connection`
--

LOCK TABLES `connection` WRITE;
/*!40000 ALTER TABLE `connection` DISABLE KEYS */;
/*!40000 ALTER TABLE `connection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `festival`
--

DROP TABLE IF EXISTS `festival`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `festival` (
  `user_id` int(100) NOT NULL,
  `fest_id` int(100) NOT NULL DEFAULT '0',
  `fest_name` varchar(255) NOT NULL,
  `venue` varchar(125) NOT NULL,
  `start-date` date NOT NULL,
  `end-date` date NOT NULL,
  `branch` varchar(30) NOT NULL,
  PRIMARY KEY (`fest_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `festival_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This holds information related to festival details.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `festival`
--

LOCK TABLES `festival` WRITE;
/*!40000 ALTER TABLE `festival` DISABLE KEYS */;
/*!40000 ALTER TABLE `festival` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `user_id` int(100) NOT NULL,
  `job_id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `salary` int(7) NOT NULL,
  `venue` varchar(255) NOT NULL,
  PRIMARY KEY (`job_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `job_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This hold generic information about JOB and is the master table.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_offcampus`
--

DROP TABLE IF EXISTS `job_offcampus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_offcampus` (
  `job_id` int(100) NOT NULL,
  `branch` varchar(55) NOT NULL,
  `year` int(5) NOT NULL,
  `experience` int(5) NOT NULL,
  `position` varchar(125) NOT NULL,
  KEY `job_id` (`job_id`),
  CONSTRAINT `job_offcampus_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This hold off-campus job detail.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_offcampus`
--

LOCK TABLES `job_offcampus` WRITE;
/*!40000 ALTER TABLE `job_offcampus` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_offcampus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_oncampus`
--

DROP TABLE IF EXISTS `job_oncampus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_oncampus` (
  `job_id` int(100) NOT NULL,
  `type` int(2) NOT NULL,
  `college` varchar(55) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `year` int(5) NOT NULL,
  KEY `job_id` (`job_id`),
  CONSTRAINT `job_oncampus_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This holds on-campus details.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_oncampus`
--

LOCK TABLES `job_oncampus` WRITE;
/*!40000 ALTER TABLE `job_oncampus` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_oncampus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `user_id` int(100) NOT NULL,
  `reciever_id` int(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  KEY `user_id` (`user_id`,`reciever_id`),
  KEY `reciever_id` (`reciever_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`reciever_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This hold message and conversation.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploads` (
  `user_id` int(100) NOT NULL,
  `upload_id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(125) NOT NULL,
  `type` int(2) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `year` int(5) NOT NULL,
  `college` varchar(125) NOT NULL,
  PRIMARY KEY (`upload_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This holds uploads information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploads`
--

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_detail`
--

DROP TABLE IF EXISTS `user_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_detail` (
  `user_id` int(100) NOT NULL,
  `DOB` date NOT NULL,
  `DOJ` date NOT NULL,
  `address` varchar(256) NOT NULL,
  `interest` varchar(256) NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='It hold personal information.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_detail`
--

LOCK TABLES `user_detail` WRITE;
/*!40000 ALTER TABLE `user_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is User information table.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `user_id` int(100) NOT NULL,
  `type` int(2) NOT NULL,
  `college` varchar(100) NOT NULL,
  `stream` varchar(30) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `year` int(5) NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_type_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This contains user type information.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-21 21:51:14
