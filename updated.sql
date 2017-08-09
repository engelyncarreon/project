-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: ntu1
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `admin_announcement`
--

DROP TABLE IF EXISTS `admin_announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_announcement` (
  `admina_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `student` enum('Yes','No') NOT NULL DEFAULT 'No',
  `instructor` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`admina_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_announcement`
--

LOCK TABLES `admin_announcement` WRITE;
/*!40000 ALTER TABLE `admin_announcement` DISABLE KEYS */;
INSERT INTO `admin_announcement` VALUES (1,1,142,'No','Yes'),(2,1,168,'Yes','No'),(3,1,168,'Yes','No'),(4,1,168,'Yes','No'),(5,1,168,'Yes','No'),(6,1,168,'Yes','No'),(7,1,168,'Yes','No'),(8,1,175,'Yes','No'),(9,1,175,'No','Yes'),(10,1,175,'Yes','No'),(11,1,175,'No','Yes'),(12,1,177,'Yes','No'),(13,1,177,'No','Yes'),(14,1,177,'Yes','No'),(15,1,177,'No','Yes'),(16,1,179,'Yes','No'),(17,1,179,'No','Yes'),(18,1,180,'Yes','Yes'),(19,1,180,'Yes','Yes'),(20,1,184,'Yes','Yes'),(21,1,199,'Yes','No'),(22,1,238,'Yes','No'),(23,1,238,'Yes','No'),(24,1,238,'Yes','No');
/*!40000 ALTER TABLE `admin_announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminenroll_notification`
--

DROP TABLE IF EXISTS `adminenroll_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminenroll_notification` (
  `enroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`enroll_id`),
  KEY `studz_idx` (`student_id`),
  KEY `notic_idx` (`notification_id`),
  KEY `coun_idx` (`course_id`),
  CONSTRAINT `coun` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE,
  CONSTRAINT `notic` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`) ON UPDATE CASCADE,
  CONSTRAINT `studz` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminenroll_notification`
--

LOCK TABLES `adminenroll_notification` WRITE;
/*!40000 ALTER TABLE `adminenroll_notification` DISABLE KEYS */;
INSERT INTO `adminenroll_notification` VALUES (8,3,163,'read',267),(9,2,197,'unread',260),(10,2,198,'unread',262);
/*!40000 ALTER TABLE `adminenroll_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminlogin`
--

DROP TABLE IF EXISTS `adminlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminlogin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `id_admin_UNIQUE` (`id_admin`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `password_UNIQUE` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminlogin`
--

LOCK TABLES `adminlogin` WRITE;
/*!40000 ALTER TABLE `adminlogin` DISABLE KEYS */;
INSERT INTO `adminlogin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','Loakan Road, Baguio City Economic Zone, PEZA\r\nBaguio City');
/*!40000 ALTER TABLE `adminlogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminregister_notification`
--

DROP TABLE IF EXISTS `adminregister_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminregister_notification` (
  `regnoti_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  PRIMARY KEY (`regnoti_id`),
  KEY `noti_id_idx` (`notification_id`),
  KEY `registrion_id_idx` (`registration_id`),
  CONSTRAINT `registrion_id` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`registration_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminregister_notification`
--

LOCK TABLES `adminregister_notification` WRITE;
/*!40000 ALTER TABLE `adminregister_notification` DISABLE KEYS */;
INSERT INTO `adminregister_notification` VALUES (1,64,183,'unread'),(2,65,205,'unread'),(3,67,206,'unread'),(4,74,207,'unread');
/*!40000 ALTER TABLE `adminregister_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminreport_status`
--

DROP TABLE IF EXISTS `adminreport_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminreport_status` (
  `report_statusid` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `status` enum('read','unread') NOT NULL,
  `read_by` int(11) DEFAULT '0',
  PRIMARY KEY (`report_statusid`),
  KEY `read_idx` (`read_by`),
  CONSTRAINT `read` FOREIGN KEY (`read_by`) REFERENCES `adminlogin` (`id_admin`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminreport_status`
--

LOCK TABLES `adminreport_status` WRITE;
/*!40000 ALTER TABLE `adminreport_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `adminreport_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `reply_to` int(11) DEFAULT '0',
  `show` enum('show','hide') NOT NULL DEFAULT 'show',
  `course_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `coud_idx` (`course_id`),
  KEY `reply_idx` (`reply_to`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (36,'asdd',0,'show',265,1,'2017-08-03 04:13:44'),(37,'awrsxdfchgvbknjl',0,'show',262,1,'2017-08-03 17:25:04'),(38,'xfgchvghb',0,'show',262,2,'2017-08-04 06:30:49'),(39,'gvhbjnk',0,'show',262,3,'2017-08-04 13:55:46'),(40,'asdasd',0,'show',262,4,'2017-08-04 14:05:39'),(41,'asdsa',0,'show',262,5,'2017-08-04 14:08:41'),(42,'asdsa',0,'show',262,6,'2017-08-04 14:09:18'),(43,'asdsa',0,'show',262,7,'2017-08-04 14:09:57'),(44,'asdsa',0,'show',262,8,'2017-08-04 14:10:16'),(45,'asdasd',44,'show',262,9,'2017-08-04 14:10:22'),(46,'Finished\r\n',36,'show',265,2,'2017-08-04 14:13:10'),(47,'Hello\r\n',45,'show',262,10,'2017-08-04 14:13:46'),(48,'asdasdasdas',0,'show',260,1,'2017-08-07 17:17:53'),(49,'Yes\r\n',48,'show',260,2,'2017-08-07 17:18:23'),(50,'gcfhgvjhbk',49,'show',260,3,'2017-08-07 17:20:32'),(51,'asdasasdds',48,'show',260,4,'2017-08-07 17:21:03'),(52,'asdas',48,'show',260,5,'2017-08-07 17:21:46'),(53,'asdasasdsad',48,'show',260,6,'2017-08-07 17:23:01');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `course_instr` int(11) NOT NULL,
  `course_category` text NOT NULL,
  `course_price` double NOT NULL,
  `course_overview` text NOT NULL,
  `course_learning` text NOT NULL,
  `course_desc` text NOT NULL,
  `course_duration` int(11) NOT NULL,
  `course_requirement` text NOT NULL,
  `course_imageurl` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `courses_id_UNIQUE` (`course_id`),
  KEY `instr_id_idx` (`course_instr`),
  CONSTRAINT `instr_id` FOREIGN KEY (`course_instr`) REFERENCES `instructor` (`instructor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (256,'asdas',5,'asdasda ',231,'asdsa','asdas','asd',123,'nbnbm','../../nmbvc'),(257,'bnmnb',5,'nmbmnbmn ',3465,'mnbmnbmn','bnmbnm','nbmnb',435435,'bmmnb','uploads/courseimage/f4faf28db5151a58ae93ffdfed06afcf9d06f44d.png'),(258,'bnmnb',5,'nmbmnbmn ',3465,'mnbmnbmn','bnmbnm','nbmnb',435435,'bmmnb','uploads/courseimage/0f0c78f70e04a8bbade2455ebc0112283c894403.png'),(259,'bnmnb',5,'nmbmnbmn ',3465,'mnbmnbmn','bnmbnm','nbmnb',435435,'bmmnb','uploads/courseimage/a35a009bd316be6a8bce77154b8bb89e714e3ada.png'),(260,'bnmnbmnm,',5,'nmbmnbmn ',3465,'mnbmnbmn','bnmbnm','nbmnb',435435,'bmmnb','uploads/courseimage/48054e1bf2c6dc942caa2405a3053401868ffbee.png'),(261,'n',5,'bmn ',12,'mnbnmbnm','mbbmm',' bmnbm',12,'mb','uploads/courseimage/0e0e23b28dd1ebaf140a03f222de24e4261b6e2e.jpg'),(262,'nbnm',5,'bmnbmn ',123,'mnb','mnbmnbmn','nmbmnb',121,'bmbm','uploads/courseimage/933b0673733efc0e25542b7b7ec6712939b112a5.jpg'),(263,'hggkgh',5,'jgjhg ',221,'jhghjg','jhgjhg','hjjhg',12,'hjghj','uploads/courseimage/02e296d40ef40346a11406941c125587cb73d0e7.jpg'),(264,'hello',5,'nmn ',12,'mnbmnbm','nbmnb','1nmbmnbnm',12,'mnbm','uploads/courseimage/ce4360cf47d79a068fbdc39a2eb449c69295adc1.jpg'),(265,'bmn',5,'nmbmn ',213,'nmbbm','bmnbmn','nbmb',12,'bmnb','uploads/courseimage/4d963a4c2ce8f8f3d5bd557bbb0167c9a3905f54.jpg'),(266,'asd',5,'nbmbm ',12312,'nbb','mbmb','nbmnb',12,'mbm\r\n','uploads/courseimage/3b141f2c51b2c4414aab5dc7855dffae8198830e.jpg'),(267,'bv',5,'bvnb ',23,'n nmbbmnbnmbm','bmnbmb','mmnb',2112,'bnmbm','uploads/courseimage/5ebe1627a0cc23b101da45ac4d98a2551d87bb4f.jpg'),(268,'mbmnb',5,'bmnbmn ',21,'mnbnbm','bmnbmn','nmbnmnm',12,'mnbm','uploads/courseimage/0ba85baead4fe79164505bcacec5db41314a41a4.jpg'),(269,'mn',5,'mn ',12,'mnnm','mnm','nmmn',12,'nmm','uploads/courseimage/0eee3ed309e80ce7330df2b83f0b6cbd5b4a081d.jpg'),(270,'asdas',5,'asdas ',123,'gvgvhg','ghhgh','saddas',12,'chgh','uploads/courseimage/f138c7bd781b1c8a3e2d251e447497fc4e8bd4dd.png'),(271,'dxcfvgbmn',5,'gfchvbnj ',12,'sdfghjcvb','nmgfcvbn','1212',1212,'xdgcfvb','uploads/courseimage/07a1d493912d9ec483dd5e473c73573125fb9d2a.png');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(45) DEFAULT NULL,
  `rating` varchar(45) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`feedback_id`),
  UNIQUE KEY `feedback_id_UNIQUE` (`feedback_id`),
  KEY `studentid_idx` (`student_id`),
  KEY `courseid_idx` (`course_id`),
  CONSTRAINT `courseid` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE,
  CONSTRAINT `studentid` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instr_answer`
--

DROP TABLE IF EXISTS `instr_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instr_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `registrationquestion_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `df_idx` (`instructor_id`),
  KEY `cv_idx` (`registrationquestion_id`),
  CONSTRAINT `cv` FOREIGN KEY (`registrationquestion_id`) REFERENCES `registrationquestion` (`regq_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `df` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instr_answer`
--

LOCK TABLES `instr_answer` WRITE;
/*!40000 ALTER TABLE `instr_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `instr_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructor` (
  `instructor_id` int(11) NOT NULL AUTO_INCREMENT,
  `instr_lastName` varchar(45) NOT NULL,
  `instr_firstName` varchar(45) NOT NULL,
  `instr_username` varchar(45) NOT NULL,
  `instr_password` varchar(45) NOT NULL,
  `instr_email` varchar(45) NOT NULL,
  `instr_address` varchar(45) NOT NULL,
  `instr_contactno` bigint(1) NOT NULL,
  `instr_gender` enum('Male','Female') NOT NULL,
  `instr_age` int(3) NOT NULL,
  `instr_status` enum('Activate','Deactivate') NOT NULL DEFAULT 'Activate',
  PRIMARY KEY (`instructor_id`),
  UNIQUE KEY `instructor_id_UNIQUE` (`instructor_id`),
  UNIQUE KEY `instr_username_UNIQUE` (`instr_username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor`
--

LOCK TABLES `instructor` WRITE;
/*!40000 ALTER TABLE `instructor` DISABLE KEYS */;
INSERT INTO `instructor` VALUES (5,'Baucas','Marinel','nel','04302cff8599fa2681112f5a7a044760','nenl@ne.com','mn',987889909,'Female',23,'Activate'),(6,'Carreon','Engelyn','enge','dd077ba32e93c70fa5cb97fabe1d5cfb','enge@sample.com','Aurora Hill',91298377898,'Female',20,'Activate');
/*!40000 ALTER TABLE `instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_comment`
--

DROP TABLE IF EXISTS `instructor_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructor_comment` (
  `instructor_commentid` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  PRIMARY KEY (`instructor_commentid`),
  KEY `innstry_idx` (`instructor_id`),
  KEY `comm_idx` (`comment_id`),
  CONSTRAINT `comm` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `innstry` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_comment`
--

LOCK TABLES `instructor_comment` WRITE;
/*!40000 ALTER TABLE `instructor_comment` DISABLE KEYS */;
INSERT INTO `instructor_comment` VALUES (1,5,46),(2,5,49),(3,5,50),(4,5,51),(5,5,52),(6,5,53);
/*!40000 ALTER TABLE `instructor_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_evaluationcriteria`
--

DROP TABLE IF EXISTS `instructor_evaluationcriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructor_evaluationcriteria` (
  `evaluation_id` int(11) NOT NULL AUTO_INCREMENT,
  `criteria` text NOT NULL,
  `subcategories` int(11) DEFAULT '0',
  PRIMARY KEY (`evaluation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_evaluationcriteria`
--

LOCK TABLES `instructor_evaluationcriteria` WRITE;
/*!40000 ALTER TABLE `instructor_evaluationcriteria` DISABLE KEYS */;
INSERT INTO `instructor_evaluationcriteria` VALUES (8,'$criteria',0),(9,'asdsada',0),(16,'vnbmn,m',8),(17,'asfdas',0),(18,'asdasda',9),(19,'asdasda',9),(20,'asdasda',9),(21,'asdasda',9),(22,'asdasda',9),(23,'asdasda',9),(24,'asdasda',9),(25,'asdasdas',8),(26,'asdasdas',8),(27,'asdasdas',8),(28,'asdasd',16),(29,'asdasd',16),(30,'asdasd',9),(31,'asdasd',9),(32,'asdasd',9),(33,'asdasd',9),(34,'asdasd',9),(35,'asdasd',9),(36,'asdasd',9),(37,'asdasd',9),(38,'asdasd',9),(39,'asdasd',9),(40,'asdasd',9),(41,'asdasd',9),(42,'asdasd',9),(43,'asdasd',9),(44,'asdasd',9),(45,'asdasd',9),(46,'asdasd',9),(47,'asdasd',9),(48,'asdasd',9),(49,'asdasd',9),(50,'heeloo',16),(51,'heeloo',16),(52,'asdasasd',16),(53,'asdsa',16),(54,'asdasd',8),(55,'asdsas',16),(56,'asdasd',0),(57,'xgfchg',56),(58,'xgfchg',56);
/*!40000 ALTER TABLE `instructor_evaluationcriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_evaluationrating`
--

DROP TABLE IF EXISTS `instructor_evaluationrating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructor_evaluationrating` (
  `evaluation_ratingid` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation_id` int(11) NOT NULL,
  `student` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`evaluation_ratingid`),
  KEY `evl_idx` (`evaluation_id`),
  KEY `stud_idx` (`student`),
  KEY `adm_idx` (`admin`),
  CONSTRAINT `adm` FOREIGN KEY (`admin`) REFERENCES `adminlogin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `eval` FOREIGN KEY (`evaluation_id`) REFERENCES `instructor_evaluationcriteria` (`evaluation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `st` FOREIGN KEY (`student`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_evaluationrating`
--

LOCK TABLES `instructor_evaluationrating` WRITE;
/*!40000 ALTER TABLE `instructor_evaluationrating` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructor_evaluationrating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructorsystem_noti`
--

DROP TABLE IF EXISTS `instructorsystem_noti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructorsystem_noti` (
  `instr_noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `notificationstatus` enum('read','unread') NOT NULL DEFAULT 'unread',
  PRIMARY KEY (`instr_noti_id`),
  KEY `instr_qid_idx` (`instructor_id`),
  KEY `noti_qid_idx` (`notification_id`),
  KEY `admin_idx` (`admin_id`),
  CONSTRAINT `admin` FOREIGN KEY (`admin_id`) REFERENCES `adminlogin` (`id_admin`) ON UPDATE CASCADE,
  CONSTRAINT `instr_qid` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON UPDATE CASCADE,
  CONSTRAINT `noti_qid` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructorsystem_noti`
--

LOCK TABLES `instructorsystem_noti` WRITE;
/*!40000 ALTER TABLE `instructorsystem_noti` DISABLE KEYS */;
INSERT INTO `instructorsystem_noti` VALUES (10,5,145,1,'read'),(11,6,145,1,'read'),(12,5,143,1,'read'),(13,6,143,1,'read'),(14,5,143,1,'read'),(15,6,143,1,'read'),(16,5,143,1,'read'),(17,6,143,1,'read'),(18,5,143,1,'read'),(19,5,151,1,'read'),(20,6,151,1,'read'),(21,5,153,1,'read'),(22,6,153,1,'read'),(23,5,154,1,'read'),(24,6,154,1,'read'),(25,5,155,1,'read'),(26,6,155,1,'read'),(27,5,156,1,'read'),(28,6,156,1,'read'),(29,5,158,1,'read'),(30,6,158,1,'read'),(31,5,159,1,'read'),(32,6,159,1,'read'),(33,5,160,1,'read'),(34,6,160,1,'read'),(35,5,164,1,'read'),(36,6,164,1,'read'),(37,5,175,1,'read'),(38,6,175,1,'read'),(39,5,177,1,'read'),(40,6,177,1,'read'),(41,5,177,1,'read'),(42,6,177,1,'read'),(43,5,179,1,'read'),(44,6,179,1,'read'),(45,5,180,1,'read'),(46,6,180,1,'read'),(47,5,180,1,'read'),(48,6,180,1,'read'),(49,5,184,1,'read'),(50,6,184,1,'read');
/*!40000 ALTER TABLE `instructorsystem_noti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecture`
--

DROP TABLE IF EXISTS `lecture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lecture` (
  `lecture_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `lecture_seq` varchar(45) NOT NULL,
  `lecture_name` varchar(45) NOT NULL,
  `lecture_details` text NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `urlname` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `filetype` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`lecture_id`),
  KEY `lesson_id_idx` (`lesson_id`)
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecture`
--

LOCK TABLES `lecture` WRITE;
/*!40000 ALTER TABLE `lecture` DISABLE KEYS */;
INSERT INTO `lecture` VALUES (304,608,'1','mnmnb','nbmnbmnbnmbnm',NULL,NULL,NULL),(305,607,'1','bnmnbm','bmbmbm',NULL,NULL,NULL),(306,609,'1','nmbmn','bnmbmnbmn',NULL,NULL,NULL),(307,607,'2','mn,mn',',mnm,n,mn',NULL,NULL,NULL),(311,607,'3','as','nbm',NULL,NULL,NULL),(312,616,'1','jkjhkjhk','hkjhkjhk','uploads/image/9655fd078b66134e38052b7ce267c665042c1b7d.jpg','Penguins.jpg','image'),(313,616,'2','mhbhmb','mnbmm',NULL,NULL,NULL),(314,617,'1','bnm','bmnbmnbm',NULL,NULL,NULL),(315,618,'1','Mnan','mnmnmnmb','uploads/video/c9dfc8310de4506d52bec6dd895223d7c1eefb77.mp4','Casper (1995) - U.K. Theatrical Trailer.mp4','Video'),(316,619,'1','nbnmb','mbnmbmn',NULL,NULL,NULL),(317,620,'1','nbmn','mnbmnm',NULL,NULL,NULL),(318,621,'1','nbmb','bmnbmn',NULL,NULL,NULL),(319,622,'1','mn','mnm','uploads/image/b48b35d1342e86a2ab6dfcbdbb27a6dc70dffe3a.jpg','Lighthouse.jpg','image'),(320,622,'2','asdas','asd',NULL,NULL,NULL),(321,623,'1','MAD','MAD',NULL,NULL,NULL),(322,624,'1','asdas','asdsadasd',NULL,NULL,NULL),(323,617,'2','asdas','adasasd',NULL,NULL,NULL),(324,617,'3','Lesosn','llklk',NULL,NULL,NULL),(325,617,'4','Lesosn','llklk',NULL,NULL,NULL),(326,617,'5','Lesosn','llklk',NULL,NULL,NULL),(327,617,'6','Lesosn','llklk',NULL,NULL,NULL),(328,617,'7','Lesosn','llklk',NULL,NULL,NULL),(329,616,'3','Lecture',' asdasda','uploads/video/e25112d7a73a1d2d43099155b12f70cd3e756d1e.mp4','ã€GOSICKã€‘å…ˆè¡Œãƒ—ãƒ­ãƒ¢ãƒ¼ã‚·ãƒ§ãƒ³æ˜ åƒ.mp4','Video'),(330,620,'2','sfsafasfas','asdadas','uploads/video/3f6f950734585b171403994d8b9e6fa77602dcb7.mp4','[ENG SUBS] Sword Art Online 2nd Trailer.mp4','Video'),(331,618,'2','Mnan','mnmnmasd','uploads/video/dbb72ea8f225ebc4b62a1123846da19c5a40221d.mp4','Kaichou wa Maid-sama PV Subbed.mp4','Video'),(332,618,'3','asd','asdasd','uploads/video/a6d1686703313a7fe6fe106259bffe3910a5bb37.mp4','[ENG SUBS] Sword Art Online 2nd Trailer.mp4','Video'),(333,609,'2','asda','asdasd',NULL,NULL,NULL),(334,610,'1','asdsa','asdasdasd',NULL,NULL,NULL),(336,628,'1','asd','asdasd',NULL,NULL,NULL),(337,618,'4','gcfhvgjbk','vhgjhbknj','uploads/video/827ff3fe4f53b74f006bd3544ee400f8f5c342b2.mp4','[ENG SUBS] Sword Art Online 2nd Trailer.mp4','Video');
/*!40000 ALTER TABLE `lecture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons` (
  `lesson_id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `lesson_seq` int(11) NOT NULL,
  `lesson_name` varchar(45) NOT NULL,
  PRIMARY KEY (`lesson_id`),
  UNIQUE KEY `lesson_id_UNIQUE` (`lesson_id`),
  KEY `lesson_idx` (`course_id`),
  CONSTRAINT `lesson` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=629 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (607,260,1,'asdas'),(608,256,1,'nbb,'),(609,260,2,',,mnmmnbmn'),(610,260,3,'nbmnbm'),(616,262,1,'knn,m'),(617,263,1,'mnm,n'),(618,265,1,'nbmnb'),(619,266,1,'mnmm,n'),(620,267,1,'asd'),(621,268,1,'mmbmn'),(622,269,1,'mn'),(623,266,2,'Mad'),(624,263,2,'adasd'),(625,258,1,'asda'),(626,260,4,'fghjk'),(628,256,2,'vbmn,m');
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `Message` text CHARACTER SET utf8 NOT NULL,
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (142,NULL,' mnbmbmnbm','subjectsam'),(143,NULL,'asdasd ','subjectasd'),(144,NULL,'nel ','subjectnel'),(145,NULL,'asd','subjectas'),(146,NULL,'asdasd ','subjectasd'),(147,NULL,'asdasd ','subjectasd'),(148,NULL,'asdasd ','subjectasd'),(149,NULL,'asdasd','subjectasd'),(150,NULL,'asdasd','subjectasd'),(151,NULL,'asdasd asd','subjectasd'),(152,NULL,'asdasd asd','subjectasd'),(153,NULL,' asdsad','CATHERine'),(154,NULL,'mklnasdnlasndlk ','HELL'),(155,NULL,'asdsa ','subjectasd'),(156,NULL,'HELLLOOOLOOLOLOOOLO ','Hel'),(157,NULL,' x cvbnmmathjm,lkmn MATHANAMANA','hallejua'),(158,NULL,'BVNBVHJHB ','HGFDXFYCGHJK'),(159,NULL,'jgkjgjhgkgjkj ','kjkkgkgk'),(160,NULL,'CERBERUS ','HOUND '),(161,NULL,'Marinel Baucas has enroll','Enroll'),(162,NULL,'Marinel Baucas has enrollasd','Enroll'),(163,NULL,'Marinel Baucas has enroll bv','Enroll'),(164,NULL,'man ','hello'),(165,NULL,'nbmbmnbm ','asdas'),(166,NULL,'mn,mn,m','mnm,n'),(167,NULL,'mn, ','mm,n,'),(168,NULL,'asd ','asd'),(169,NULL,'asd ','asd'),(170,NULL,'asd ','asd'),(171,NULL,'asd ','asd'),(172,NULL,'asd ','asd'),(173,NULL,'asd ','asd'),(174,NULL,'asd ','asd'),(175,NULL,'asm as','asdman'),(176,NULL,'asm as','asdman'),(177,NULL,'ertdfygh ','mnbmn'),(178,NULL,'ertdfygh ','mnbmn'),(179,NULL,'Man ','Man'),(180,NULL,' asdasd','Student  asdsdasd: '),(181,NULL,' asdasd','Student  asdsdasd: '),(182,NULL,'mnm man has sign-up as a instructor','Registration'),(183,NULL,'mbmbm mnmn has sign-up as a instructor','Registration'),(184,NULL,'For sale ','Avon'),(185,NULL,'Ho\r\n ','Hello'),(186,NULL,' hello\r\n','Heelo'),(187,NULL,'Ho\r\n ','Hello'),(188,NULL,'SAmple  ','SAmp'),(189,NULL,' sad','subject'),(190,NULL,'mnm ','man'),(191,NULL,'mnm ','man'),(192,NULL,'mnm ','man'),(193,NULL,'mnm ','man'),(194,NULL,'mnm ','man'),(195,NULL,'mnm ','man'),(196,NULL,'mnm ','man'),(197,NULL,'mera mera has enroll bnmnbmnm,','Enroll'),(198,NULL,'mera mera has enroll nbnm','Enroll'),(199,NULL,'HI ','HELLO'),(200,NULL,'HI ','HiHello'),(201,NULL,'HI ','HiHello'),(202,NULL,'HHEELLLLLLO ','HELLO'),(203,NULL,'HHEELLLLLLO ','HELLO'),(204,NULL,'cvbnm,. ','cvnbm,'),(205,NULL,'nbvb vcbmn has sign-up as a instructor','Registration'),(206,NULL,'nbm, vnmb has sign-up as a instructor','Registration'),(207,NULL,'gvhbn cbv nm has sign-up as a instructor','Registration'),(208,NULL,'heelo','sup'),(209,NULL,'mnbmn ','bnm'),(210,NULL,'nkn ','ann'),(211,NULL,'MAKE WAY ','HELLO'),(212,NULL,'This is to announce that new lesson has been added innmnm','Hello'),(213,NULL,'Heelo musta na?\r\n ','HELLO'),(214,NULL,'Good Day ','Hello'),(215,NULL,'sdfghkj ','Hello'),(216,NULL,'may I ask something? ','Hello'),(217,NULL,'may I ask something? ','Hello'),(218,NULL,'may I ask something? ','Hello'),(219,NULL,'Say Something ','Hi'),(220,NULL,'Smarrt?','Hi '),(221,NULL,'Smarrt?','Hi '),(222,NULL,'Smarrt?','Hi '),(223,NULL,'Siup? ','Sup?'),(224,NULL,'Siup? ','Sup?'),(225,NULL,'Siup? ','Sup?'),(226,NULL,'Siup? ','Sup?'),(227,NULL,'asd ','asd'),(228,NULL,'HIGO ','HO'),(229,NULL,'qdfgvhbjnkm ','xfcgvhbn'),(230,NULL,'cfvghbjnkm ','dfcgvhbjn'),(231,NULL,'sdfgcvhbjnkm ','xdfvhbjnkASXCGVHBN'),(232,NULL,'waserdf ','dtcfvgbh'),(233,NULL,'srdfch ','xdcfgvhb'),(234,NULL,'hi ','Hello'),(235,NULL,' asd','make way'),(236,NULL,'xcghvjbkjnlk ','xdgfchkjl;'),(237,NULL,'mnbnm ','hi'),(238,NULL,'announeent\r\n ','Helelo'),(239,NULL,'announeent\r\n ','Helelo'),(240,NULL,'announeent\r\n ','Helelo'),(241,NULL,'xgcvb,n ','gvjhbj'),(242,NULL,'xgcvb,n ','gvjhbj'),(243,NULL,'gvhkj ','sdgfhgjh');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `questions` varchar(45) NOT NULL,
  PRIMARY KEY (`quest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'\nWhat animal do you like?'),(2,'what is the middle name of your mother?'),(3,'what is the name of your elementary school?'),(4,'What is yout favorite song?'),(5,'what is the name of your province?'),(6,'who is your best friend in high school?');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_choices`
--

DROP TABLE IF EXISTS `quiz_choices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_choices` (
  `quiz_choicesid` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `choices` varchar(45) NOT NULL,
  `answer` enum('wrong','correct') NOT NULL DEFAULT 'wrong',
  `points` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`quiz_choicesid`),
  KEY `q_idx` (`quiz_id`),
  CONSTRAINT `q` FOREIGN KEY (`quiz_id`) REFERENCES `quiz_question` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_choices`
--

LOCK TABLES `quiz_choices` WRITE;
/*!40000 ALTER TABLE `quiz_choices` DISABLE KEYS */;
INSERT INTO `quiz_choices` VALUES (185,240,'asdasd','correct',2.5),(188,241,'asdasd','wrong',0),(194,242,'asdasd','correct',1.6666666666667),(198,243,'Hekki','correct',5),(199,243,'gvbh','correct',5),(200,243,'hi','wrong',0),(206,243,'$asda','wrong',0),(207,243,'asd','wrong',0),(208,243,'asd','wrong',0),(209,243,'asd','wrong',0),(210,243,'asd','wrong',0),(211,243,'asd','wrong',0),(212,243,'as1','wrong',0),(213,243,'asd2','wrong',0),(222,238,'MNMN','correct',3.3333333333333),(223,238,'asdasd','correct',3.3333333333333),(224,238,'asd','wrong',0),(225,238,'asd','correct',3.3333333333333),(227,244,'asdasd','correct',2.5),(228,244,'asdasda','correct',2.5),(230,246,'aasda','correct',5),(231,246,'asddas','wrong',0);
/*!40000 ALTER TABLE `quiz_choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_question`
--

DROP TABLE IF EXISTS `quiz_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_question` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `lecture_id` int(11) NOT NULL,
  `Question` text NOT NULL,
  `quiztype` enum('radio','identification','checkbox','video') NOT NULL DEFAULT 'radio',
  `quiz_seq` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `description` text,
  PRIMARY KEY (`quiz_id`),
  KEY `ll_idx` (`lecture_id`),
  CONSTRAINT `ll` FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`lecture_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_question`
--

LOCK TABLES `quiz_question` WRITE;
/*!40000 ALTER TABLE `quiz_question` DISABLE KEYS */;
INSERT INTO `quiz_question` VALUES (237,315,'asd','video',1,5,'dxgfchvjkj'),(238,315,'asd','checkbox',2,10,''),(239,315,'Video','video',3,5,'asdsad'),(240,315,'asdas','checkbox',4,5,''),(241,315,'Hello','checkbox',5,60,''),(242,315,'asdas','checkbox',6,5,''),(243,315,'whaa','checkbox',7,10,''),(244,306,'asdas','checkbox',1,5,''),(245,304,'nbmn,m','video',1,5,'Video'),(246,304,'asd','checkbox',2,5,'');
/*!40000 ALTER TABLE `quiz_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_studentanswer`
--

DROP TABLE IF EXISTS `quiz_studentanswer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_studentanswer` (
  `quiz_scoreid` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `student_answer` varchar(100) NOT NULL,
  PRIMARY KEY (`quiz_scoreid`),
  KEY `bvn_idx` (`quiz_id`),
  KEY `student_idx` (`student_id`),
  CONSTRAINT `bvn` FOREIGN KEY (`quiz_id`) REFERENCES `quiz_question` (`quiz_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `student` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Answer of students and also their points depending what answer they chose';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_studentanswer`
--

LOCK TABLES `quiz_studentanswer` WRITE;
/*!40000 ALTER TABLE `quiz_studentanswer` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_studentanswer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_video`
--

DROP TABLE IF EXISTS `quiz_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `videourl` varchar(100) CHARACTER SET utf8 NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `points` int(11) DEFAULT '0',
  `check` enum('Not Yet','Done') NOT NULL DEFAULT 'Not Yet',
  `video_name` varchar(100) NOT NULL,
  PRIMARY KEY (`video_id`),
  KEY `quis_idx` (`quiz_id`),
  KEY `studb_idx` (`student_id`),
  CONSTRAINT `quis` FOREIGN KEY (`quiz_id`) REFERENCES `quiz_question` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `studb` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_video`
--

LOCK TABLES `quiz_video` WRITE;
/*!40000 ALTER TABLE `quiz_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration` (
  `registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_lastName` varchar(45) NOT NULL,
  `user_firstName` varchar(45) NOT NULL,
  `user_username` varchar(45) NOT NULL,
  `user_password` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_address` varchar(45) NOT NULL,
  `user_contactno` bigint(1) NOT NULL,
  `user_gender` enum('Male','Female') NOT NULL,
  `user_age` int(3) NOT NULL,
  `user_status` enum('Accepted','Declined','Pending') NOT NULL DEFAULT 'Pending',
  `typeOfuser` enum('Student','Instructor') NOT NULL,
  `resume` varchar(100) DEFAULT NULL,
  `resume_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`registration_id`),
  UNIQUE KEY `user_username` (`user_username`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration`
--

LOCK TABLES `registration` WRITE;
/*!40000 ALTER TABLE `registration` DISABLE KEYS */;
INSERT INTO `registration` VALUES (61,'nbmn','mnbmb','12','412566367c67448b599d1b7666f8ccfc','mn@man.com','mn,',123,'Male',12,'Pending','Instructor','',''),(63,'man','mnm','nmnmn','c20ad4d76fe97759aa27a0c99bff6710','12@n.com','12',121234567,'Male',12,'Pending','Instructor','',''),(64,'mnmn','mbmbm','mnbm','c20ad4d76fe97759aa27a0c99bff6710','12@n.com','12',12234567,'Female',12,'Pending','Instructor','',''),(65,'vcbmn','nbvb','25','c20ad4d76fe97759aa27a0c99bff6710','asfdghb@dsgfhj.com','cvb',123454678,'Female',12,'Pending','Instructor','',''),(67,'vnmb','nbm,','vcbnm','c20ad4d76fe97759aa27a0c99bff6710','bvnnb@yiu.com','bnvnbvn',124657,'Female',12,'Pending','Instructor','',''),(72,'ZSFXCVBMN,','qeaszfdxgchvjbh','qsdfghj','c20ad4d76fe97759aa27a0c99bff6710','asfdghb@dsgfhj.com','XFCHGVJHBKJNL',123456,'Female',123,'Pending','Instructor','uploads/file/9d6de6636c31eec33ee41a9e4af94c355dcaf82f.docx','ref.docx'),(74,'cbv nm','gvhbn','dgchvb','c20ad4d76fe97759aa27a0c99bff6710','xcvb@asdf.com','dfcgvhj',324356,'Female',2,'Pending','Instructor','uploads/file/bc4db2e5ccaa3aec2ffc452e85b25d2d7afdf90d.docx','Sunday-School.docx');
/*!40000 ALTER TABLE `registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrationquestion`
--

DROP TABLE IF EXISTS `registrationquestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrationquestion` (
  `regq_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(45) NOT NULL,
  PRIMARY KEY (`regq_id`),
  KEY `reg_idx` (`registration_id`),
  KEY `question_idx` (`question_id`),
  CONSTRAINT `question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`quest_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `reg` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`registration_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrationquestion`
--

LOCK TABLES `registrationquestion` WRITE;
/*!40000 ALTER TABLE `registrationquestion` DISABLE KEYS */;
INSERT INTO `registrationquestion` VALUES (21,61,1,'dog'),(22,63,1,'dog'),(23,64,1,'dog'),(24,65,2,'sads'),(25,67,1,'xgfcgvhbj'),(26,72,1,'ASDS'),(27,74,1,'cvbmn,.');
/*!40000 ALTER TABLE `registrationquestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report` text NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_lastName` varchar(45) NOT NULL,
  `stud_firstName` varchar(45) NOT NULL,
  `stud_username` varchar(45) NOT NULL,
  `stud_password` varchar(45) NOT NULL,
  `stud_address` varchar(45) NOT NULL,
  `stud_email` varchar(45) NOT NULL,
  `stud_contactno` bigint(1) NOT NULL,
  `stud_gender` enum('Male','Female') NOT NULL,
  `stud_age` int(3) NOT NULL,
  `stud_status` enum('Activate','Deactivate') NOT NULL DEFAULT 'Activate',
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `idstudent_UNIQUE` (`student_id`),
  UNIQUE KEY `username_UNIQUE` (`stud_username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (2,'mera','mera','mera','72040091d72fd4543a9c44442680580a','meraasd',' mail@mail.com',345678934567845,'Female',23,'Activate'),(3,'Baucas','Marinel','nel','04302cff8599fa2681112f5a7a044760','Balakbak','mail@maail.com',1243565769,'Female',23,'Activate'),(13,'marinel','marinel','marinel','9933b5ea0e32cdf091cc92e3229f7071','asdas','nel@marinel.cmo',2112452,'Female',12,'Activate'),(14,'mar','marm','mar','5fa9db2e335ef69a4eeb9fe7974d61f4','mar','mar@yahoo.com',1234567,'Female',12,'Activate');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_answer`
--

DROP TABLE IF EXISTS `student_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_answer` (
  `student_answerid` int(11) NOT NULL AUTO_INCREMENT,
  `registrationquestion_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`student_answerid`),
  KEY `ste_idx` (`student_id`),
  KEY `we_idx` (`registrationquestion_id`),
  CONSTRAINT `ste` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `we` FOREIGN KEY (`registrationquestion_id`) REFERENCES `registrationquestion` (`regq_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_answer`
--

LOCK TABLES `student_answer` WRITE;
/*!40000 ALTER TABLE `student_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_comment`
--

DROP TABLE IF EXISTS `student_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_comment` (
  `stud_commentid` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  PRIMARY KEY (`stud_commentid`),
  KEY `vb_idx` (`student_id`),
  KEY `coomm_idx` (`comment_id`),
  CONSTRAINT `coomm` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vb` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_comment`
--

LOCK TABLES `student_comment` WRITE;
/*!40000 ALTER TABLE `student_comment` DISABLE KEYS */;
INSERT INTO `student_comment` VALUES (27,3,36),(28,3,37),(29,3,38),(30,3,39),(31,3,40),(32,3,41),(33,3,42),(34,3,43),(35,3,44),(36,3,40),(37,3,47),(38,3,48);
/*!40000 ALTER TABLE `student_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_lessonchecker`
--

DROP TABLE IF EXISTS `student_lessonchecker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_lessonchecker` (
  `checker_id` int(11) NOT NULL AUTO_INCREMENT,
  `lecture_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lecture_status` enum('Finished','Not Yet') NOT NULL DEFAULT 'Not Yet',
  PRIMARY KEY (`checker_id`),
  KEY `stud_idx` (`student_id`),
  KEY `le_idx` (`lecture_id`),
  CONSTRAINT `le` FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`lecture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stud` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COMMENT='Status of each lecture if it is finished or not';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_lessonchecker`
--

LOCK TABLES `student_lessonchecker` WRITE;
/*!40000 ALTER TABLE `student_lessonchecker` DISABLE KEYS */;
INSERT INTO `student_lessonchecker` VALUES (13,314,3,'Not Yet'),(14,323,3,'Not Yet'),(15,324,3,'Not Yet'),(16,325,3,'Not Yet'),(17,326,3,'Not Yet'),(18,327,3,'Not Yet'),(19,328,3,'Not Yet'),(20,322,3,'Not Yet'),(21,315,3,'Finished'),(22,305,3,'Finished'),(23,307,3,'Finished'),(24,311,3,'Finished'),(25,306,3,'Finished'),(30,313,3,'Finished'),(31,329,2,'Not Yet'),(32,329,3,'Finished'),(33,317,3,'Finished'),(34,330,3,'Finished'),(35,331,3,'Not Yet'),(36,332,3,'Not Yet'),(38,337,3,'Not Yet');
/*!40000 ALTER TABLE `student_lessonchecker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentcourse`
--

DROP TABLE IF EXISTS `studentcourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentcourse` (
  `student_courseid` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `lessonstatus` enum('Ongoing','Finished') NOT NULL,
  `paymentStatus` enum('Paid','Not Yet Paid') NOT NULL DEFAULT 'Not Yet Paid',
  PRIMARY KEY (`student_courseid`),
  KEY `student_id_idx` (`student_id`),
  KEY `course_idx` (`course_id`),
  KEY `lesson_id_idx` (`lesson_id`),
  CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE,
  CONSTRAINT `lesson_id` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentcourse`
--

LOCK TABLES `studentcourse` WRITE;
/*!40000 ALTER TABLE `studentcourse` DISABLE KEYS */;
INSERT INTO `studentcourse` VALUES (52,3,256,608,'Ongoing','Not Yet Paid'),(53,3,260,607,'Ongoing','Paid'),(54,3,262,616,'Ongoing','Paid'),(59,3,266,619,'Ongoing','Not Yet Paid'),(60,3,267,620,'Ongoing','Paid'),(61,2,260,607,'Ongoing','Not Yet Paid'),(62,2,262,616,'Ongoing','Not Yet Paid'),(63,3,263,617,'Finished','Not Yet Paid'),(64,2,263,617,'Ongoing','Not Yet Paid'),(65,3,265,618,'Finished','Paid');
/*!40000 ALTER TABLE `studentcourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentsystem_noti`
--

DROP TABLE IF EXISTS `studentsystem_noti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentsystem_noti` (
  `stud_noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `notification_status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `to` enum('student','admin') NOT NULL DEFAULT 'student',
  PRIMARY KEY (`stud_noti_id`),
  KEY `noti_idx` (`notification_id`),
  KEY `studq_idx` (`student_id`),
  KEY `admiqnwe_idx` (`admin_id`),
  CONSTRAINT `adminas` FOREIGN KEY (`admin_id`) REFERENCES `adminlogin` (`id_admin`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `noti` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `studq` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentsystem_noti`
--

LOCK TABLES `studentsystem_noti` WRITE;
/*!40000 ALTER TABLE `studentsystem_noti` DISABLE KEYS */;
INSERT INTO `studentsystem_noti` VALUES (64,2,142,1,'read','student'),(65,3,142,1,'read','student'),(66,13,142,1,'unread','student'),(67,14,142,1,'unread','student'),(68,2,164,1,'read','student'),(69,3,164,1,'read','student'),(70,13,164,1,'unread','student'),(71,14,164,1,'unread','student'),(72,2,166,1,'read','student'),(73,3,166,1,'read','student'),(74,13,166,1,'unread','student'),(75,14,166,1,'unread','student'),(76,2,167,1,'read','student'),(77,3,167,1,'read','student'),(78,13,167,1,'unread','student'),(79,14,167,1,'unread','student'),(80,2,168,1,'read','student'),(81,3,168,1,'read','student'),(82,13,168,1,'unread','student'),(83,14,168,1,'unread','student'),(84,2,168,1,'read','student'),(85,3,168,1,'read','student'),(86,13,168,1,'unread','student'),(87,14,168,1,'unread','student'),(88,2,168,1,'read','student'),(89,3,168,1,'read','student'),(90,13,168,1,'unread','student'),(91,14,168,1,'unread','student'),(92,2,168,1,'read','student'),(93,3,168,1,'read','student'),(94,13,168,1,'unread','student'),(95,14,168,1,'unread','student'),(96,2,168,1,'read','student'),(97,3,168,1,'read','student'),(98,13,168,1,'unread','student'),(99,14,168,1,'unread','student'),(100,2,168,1,'read','student'),(101,3,168,1,'read','student'),(102,13,168,1,'unread','student'),(103,14,168,1,'unread','student'),(104,2,168,1,'read','student'),(105,3,168,1,'read','student'),(106,13,168,1,'unread','student'),(107,14,168,1,'unread','student'),(108,2,175,1,'read','student'),(109,3,175,1,'read','student'),(110,13,175,1,'unread','student'),(111,14,175,1,'unread','student'),(112,2,175,1,'read','student'),(113,3,175,1,'read','student'),(114,13,175,1,'unread','student'),(115,14,175,1,'unread','student'),(116,2,177,1,'read','student'),(117,3,177,1,'read','student'),(118,13,177,1,'unread','student'),(119,14,177,1,'unread','student'),(120,2,177,1,'read','student'),(121,3,177,1,'read','student'),(122,13,177,1,'unread','student'),(123,14,177,1,'unread','student'),(124,2,179,1,'read','student'),(125,3,179,1,'read','student'),(126,13,179,1,'unread','student'),(127,14,179,1,'unread','student'),(128,2,180,1,'read','student'),(129,3,180,1,'read','student'),(130,13,180,1,'unread','student'),(131,14,180,1,'unread','student'),(132,2,180,1,'read','student'),(133,3,180,1,'read','student'),(134,13,180,1,'unread','student'),(135,14,180,1,'unread','student'),(136,2,184,1,'read','student'),(137,3,184,1,'read','student'),(138,13,184,1,'unread','student'),(139,14,184,1,'unread','student'),(140,2,199,1,'read','student'),(141,3,199,1,'read','student'),(142,13,199,1,'unread','student'),(143,14,199,1,'unread','student'),(144,2,238,1,'unread','student'),(145,3,238,1,'read','student'),(146,13,238,1,'unread','student'),(147,14,238,1,'unread','student'),(148,2,238,1,'unread','student'),(149,3,238,1,'read','student'),(150,13,238,1,'unread','student'),(151,14,238,1,'unread','student'),(152,2,238,1,'unread','student'),(153,3,238,1,'read','student'),(154,13,238,1,'unread','student'),(155,14,238,1,'unread','student');
/*!40000 ALTER TABLE `studentsystem_noti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacherannouncement`
--

DROP TABLE IF EXISTS `teacherannouncement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacherannouncement` (
  `announce_id` int(11) NOT NULL AUTO_INCREMENT,
  `instr_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  PRIMARY KEY (`announce_id`),
  KEY `instr_idx` (`instr_id`),
  KEY `stud_idx` (`student_id`),
  KEY `noti_q_idx` (`notification_id`),
  CONSTRAINT `instr` FOREIGN KEY (`instr_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `noti_q` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`) ON UPDATE CASCADE,
  CONSTRAINT `stud_q` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacherannouncement`
--

LOCK TABLES `teacherannouncement` WRITE;
/*!40000 ALTER TABLE `teacherannouncement` DISABLE KEYS */;
INSERT INTO `teacherannouncement` VALUES (1,5,3,189,267,'read'),(2,5,3,190,256,'read'),(3,5,3,190,256,'read'),(4,5,3,190,256,'read'),(5,5,3,190,256,'read'),(6,5,3,190,256,'read'),(7,5,3,190,256,'read'),(8,5,3,190,256,'read'),(9,5,2,200,260,'read'),(10,5,2,200,260,'read'),(11,5,2,202,260,'read'),(12,5,2,202,260,'read'),(13,5,3,204,267,'read'),(14,5,2,209,260,'read'),(15,5,3,212,260,'read'),(16,5,2,212,260,'read'),(17,5,3,213,260,'read'),(18,5,2,213,260,'read'),(19,5,3,216,267,'read'),(20,5,3,216,267,'read'),(21,5,3,216,267,'read'),(22,5,3,219,267,'read'),(23,5,3,220,267,'read'),(24,5,3,220,267,'read'),(25,5,3,220,267,'read'),(26,5,3,223,267,'read'),(27,5,3,223,267,'read'),(28,5,3,223,267,'read'),(29,5,3,223,267,'read'),(30,5,3,168,267,'read'),(31,5,3,232,267,'read'),(32,5,3,233,267,'read'),(33,5,3,199,262,'read'),(34,5,2,199,262,'unread'),(35,5,3,235,262,'read'),(36,5,2,235,262,'unread'),(37,5,3,236,262,'read'),(38,5,2,236,262,'unread'),(39,5,3,237,265,'read'),(40,5,3,241,256,'unread'),(41,5,3,241,256,'unread'),(42,5,3,243,256,'unread');
/*!40000 ALTER TABLE `teacherannouncement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `ORNumber` varchar(45) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `paymentmethod` varchar(45) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `studoi_idx` (`student_id`),
  KEY `coursa_idx` (`course_id`),
  CONSTRAINT `coursa` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE,
  CONSTRAINT `studoi` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (3,'nb',3,256,231,'CASH'),(4,' mn nbnmbnm',3,256,231,'mnbmn'),(5,'123as',3,256,123,'CASh'),(6,'nbnmb',3,256,231,'nbmn'),(7,'nmbmn',3,256,231,'bmnbmn'),(8,'nmbmn',3,256,231,'bmnbmn'),(9,'nmbmn',3,256,231,'bmnbmn'),(10,' mnmnm',3,256,231,'nmm'),(11,'nbnm',3,256,231,'mnbm12'),(12,'nn',3,256,231,'mnm'),(13,'u98o',3,256,231,',nkjn,'),(14,'nbmb',3,260,3465,'mnbm');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ntu1'
--

--
-- Dumping routines for database 'ntu1'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-09 19:45:57
