-- MySQL dump 10.13  Distrib 5.1.63, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: imuyunco_muyundb
-- ------------------------------------------------------
-- Server version	5.1.63-0+squeeze1

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
-- Table structure for table `tbl_a_vip`
--

DROP TABLE IF EXISTS `tbl_a_vip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_a_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(7) NOT NULL,
  `growthline` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_a_vip`
--

LOCK TABLES `tbl_a_vip` WRITE;
/*!40000 ALTER TABLE `tbl_a_vip` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_a_vip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_article`
--

DROP TABLE IF EXISTS `tbl_c_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldcat_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `filename` varchar(127) DEFAULT NULL,
  `wordcount` int(11) NOT NULL,
  `srclang_id` int(11) NOT NULL,
  `tgtlang_id` int(11) NOT NULL,
  `starttime` datetime DEFAULT NULL,
  `comptime` datetime DEFAULT NULL,
  `edittime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_article`
--

LOCK TABLES `tbl_c_article` WRITE;
/*!40000 ALTER TABLE `tbl_c_article` DISABLE KEYS */;
INSERT INTO `tbl_c_article` VALUES (18,0,16,NULL,31,0,1,NULL,NULL,'2012-08-15 17:15:56'),(17,0,15,NULL,7,0,1,'2012-08-13 16:51:03','2012-08-13 16:51:40','2012-08-13 16:50:31'),(19,0,17,NULL,4,1,0,NULL,NULL,'2012-08-17 21:59:30');
/*!40000 ALTER TABLE `tbl_c_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_comm`
--

DROP TABLE IF EXISTS `tbl_c_comm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_comm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `sendtime` datetime NOT NULL,
  `read` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_comm`
--

LOCK TABLES `tbl_c_comm` WRITE;
/*!40000 ALTER TABLE `tbl_c_comm` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c_comm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_complaint`
--

DROP TABLE IF EXISTS `tbl_c_complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_complaint` (
  `order_id` int(11) NOT NULL,
  `remark` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_complaint`
--

LOCK TABLES `tbl_c_complaint` WRITE;
/*!40000 ALTER TABLE `tbl_c_complaint` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c_complaint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_coupon`
--

DROP TABLE IF EXISTS `tbl_c_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `discount` double NOT NULL,
  `referral` int(11) NOT NULL,
  `present` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_coupon`
--

LOCK TABLES `tbl_c_coupon` WRITE;
/*!40000 ALTER TABLE `tbl_c_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_evaluation`
--

DROP TABLE IF EXISTS `tbl_c_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_evaluation` (
  `user_id` int(11) NOT NULL,
  `valuator_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `evaluation` text NOT NULL,
  `score` int(11) NOT NULL,
  `evaluatetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_evaluation`
--

LOCK TABLES `tbl_c_evaluation` WRITE;
/*!40000 ALTER TABLE `tbl_c_evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_express`
--

DROP TABLE IF EXISTS `tbl_c_express`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `price` int(11) NOT NULL,
  `trackingnum` varchar(31) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_express`
--

LOCK TABLES `tbl_c_express` WRITE;
/*!40000 ALTER TABLE `tbl_c_express` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c_express` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_group`
--

DROP TABLE IF EXISTS `tbl_c_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_group`
--

LOCK TABLES `tbl_c_group` WRITE;
/*!40000 ALTER TABLE `tbl_c_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_invoice`
--

DROP TABLE IF EXISTS `tbl_c_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org` varchar(31) NOT NULL,
  `titile` varchar(31) NOT NULL,
  `content_id` int(11) NOT NULL,
  `applytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_invoice`
--

LOCK TABLES `tbl_c_invoice` WRITE;
/*!40000 ALTER TABLE `tbl_c_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_msg`
--

DROP TABLE IF EXISTS `tbl_c_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(31) NOT NULL,
  `theme` varchar(31) NOT NULL,
  `content` text NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `remark` text NOT NULL,
  `finishtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_msg`
--

LOCK TABLES `tbl_c_msg` WRITE;
/*!40000 ALTER TABLE `tbl_c_msg` DISABLE KEYS */;
INSERT INTO `tbl_c_msg` VALUES (1,'钟嘉聪','13480205903','zhongjiacong@gmail.com','我有建议','我的建议是...',100003,'你去答案饭吧','2012-08-15 17:27:52');
/*!40000 ALTER TABLE `tbl_c_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_order`
--

DROP TABLE IF EXISTS `tbl_c_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(31) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `express_id` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `audit` int(11) NOT NULL DEFAULT '0',
  `submittime` datetime NOT NULL,
  `paytime` datetime DEFAULT NULL,
  `deliverytime` datetime DEFAULT NULL,
  `remark` text NOT NULL,
  `orderstate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_order`
--

LOCK TABLES `tbl_c_order` WRITE;
/*!40000 ALTER TABLE `tbl_c_order` DISABLE KEYS */;
INSERT INTO `tbl_c_order` VALUES (17,'17',100008,0,0,'2012-08-17 21:59:30',0,'2012-08-17 21:59:30','2012-08-17 21:59:36',NULL,'',0),(16,'ali翻译01',100016,0,0,'2012-08-15 17:15:56',1,'2012-08-15 17:15:56','2012-08-15 17:16:17',NULL,'麻烦尽快翻译~',0),(15,'第一单',100001,0,0,'2012-08-13 16:50:31',1,'2012-08-13 16:50:31','2012-08-13 16:50:34','2012-08-13 16:51:40','锟斤拷',0);
/*!40000 ALTER TABLE `tbl_c_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_recharge`
--

DROP TABLE IF EXISTS `tbl_c_recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `way` int(11) NOT NULL DEFAULT '0',
  `amount` varchar(31) NOT NULL,
  `audit` int(11) NOT NULL DEFAULT '0',
  `edittime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_recharge`
--

LOCK TABLES `tbl_c_recharge` WRITE;
/*!40000 ALTER TABLE `tbl_c_recharge` DISABLE KEYS */;
INSERT INTO `tbl_c_recharge` VALUES (1,100001,0,'100',1,'2012-08-13 07:43:22'),(2,100001,0,'200',1,'2012-08-13 07:45:32'),(3,100001,0,'200',0,'2012-08-13 07:45:34'),(4,100001,2,'-1.2',1,'2012-08-13 07:46:36'),(5,100001,2,'-1.08',1,'2012-08-13 14:59:39'),(6,100001,2,'-0.96',1,'2012-08-13 16:12:32'),(7,100001,2,'0',1,'2012-08-13 16:37:20'),(8,100001,2,'0',1,'2012-08-13 16:41:04'),(9,100001,2,'0',1,'2012-08-13 16:50:34'),(10,100002,0,'34',0,'2012-08-15 13:42:59'),(11,100016,2,'0',1,'2012-08-15 17:16:17'),(12,100001,0,'200',0,'2012-08-15 19:17:50'),(13,100008,2,'-0.84',1,'2012-08-17 21:59:36');
/*!40000 ALTER TABLE `tbl_c_recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_sentence`
--

DROP TABLE IF EXISTS `tbl_c_sentence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_sentence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interpreter_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `sentencenum` int(11) NOT NULL,
  `original` text NOT NULL,
  `translation` text NOT NULL,
  `edittime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_sentence`
--

LOCK TABLES `tbl_c_sentence` WRITE;
/*!40000 ALTER TABLE `tbl_c_sentence` DISABLE KEYS */;
INSERT INTO `tbl_c_sentence` VALUES (10,0,18,0,'我么么呢而恶魔吗，的 飒飒大空间大伤口拉动山，吗！你翻译吧！！！','','2012-08-15 17:15:56'),(11,0,19,0,'fgfg','','2012-08-17 21:59:30'),(9,100012,17,0,'进口量假两件。','Income number two pieces.','2012-08-13 16:50:31');
/*!40000 ALTER TABLE `tbl_c_sentence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_term`
--

DROP TABLE IF EXISTS `tbl_c_term`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interpreter_id` int(11) NOT NULL,
  `sentence_id` int(11) NOT NULL,
  `termnum` int(11) NOT NULL,
  `original` text NOT NULL,
  `translation` text NOT NULL,
  `edittime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_term`
--

LOCK TABLES `tbl_c_term` WRITE;
/*!40000 ALTER TABLE `tbl_c_term` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c_term` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_c_user`
--

DROP TABLE IF EXISTS `tbl_c_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_c_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountcat_id` int(11) NOT NULL DEFAULT '0',
  `privilege_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(31) NOT NULL,
  `loginpassword` varchar(40) NOT NULL,
  `paypassword` varchar(40) NOT NULL,
  `nickname` varchar(31) NOT NULL,
  `realname` varchar(15) NOT NULL,
  `gender_id` int(11) NOT NULL DEFAULT '0',
  `birthday` date NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `introduce` text NOT NULL,
  `address` text NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '0',
  `verifycode` varchar(20) NOT NULL,
  `registertime` datetime NOT NULL,
  `lastlogintime` datetime NOT NULL,
  `pushtoken` varchar(64) DEFAULT NULL,
  `session_id` varchar(160) DEFAULT NULL,
  `company` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100022 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_c_user`
--

LOCK TABLES `tbl_c_user` WRITE;
/*!40000 ALTER TABLE `tbl_c_user` DISABLE KEYS */;
INSERT INTO `tbl_c_user` VALUES (100001,0,5,'zhongjiacong@gmail.com','53ae2fc6cf0b62b3ec601f8e5e8187629137794f','','zhongjiacong','',2,'1970-01-01','13480205903','','','','',1,'','2012-07-09 21:13:50','2012-08-17 02:32:59','','2_MX4xNjkzNzg4Mn5-VGh1IEF1ZyAxNiAwMzoyNjoxNSBQRFQgMjAxMn4wLjAzNDIwNDMwNH4',''),(100002,0,0,'184492896@qq.com','10470c3b4b1fed12c3baac014be15fac67c6e815','','184492896','',0,'0000-00-00','110','','','','',1,'','2012-07-09 23:01:28','2012-08-19 13:57:28',NULL,'1_MX4xNjkzNzg4Mn5-V2VkIEF1ZyAxNSAyMjo1ODowMCBQRFQgMjAxMn4wLjQzMTMyNDU0fg',''),(100003,0,1,'service@muyun.com','53ae2fc6cf0b62b3ec601f8e5e8187629137794f','','service','',0,'0000-00-00','13480205903','','','','',1,'','2012-07-10 14:07:42','2012-08-15 17:26:47',NULL,NULL,''),(100004,0,0,'29519260@qq.com','0a8ed381d3e00b45aa418ad317b08ad0286384e2','','29519260','',0,'0000-00-00','13824436126','','','','',1,'','2012-07-10 17:09:19','2012-07-10 17:09:19',NULL,NULL,''),(100005,0,0,'ciiry@live.cn','15cfb8c5208a294c905798906259f24d019473c3','','ciiry','',0,'0000-00-00','13552134931','','','','',1,'cd98f00b204e9800','2012-07-10 17:11:37','2012-07-10 17:11:37',NULL,NULL,''),(100006,0,0,'cydhx@163.com','15e56bc016048b50323204244ef2125cc411d904','','cydhx','',0,'0000-00-00','15172491806','','','','',1,'ecf8427e','2012-07-10 17:21:01','2012-07-10 17:21:01',NULL,NULL,''),(100007,0,0,'taoxiance@dxwsoft.com','952d37e87ad687178d9ddc6ee3a03c92bf1f6549','','taoxiance','',0,'0000-00-00','15904262199','','','','',1,'0998ecf8427e','2012-07-10 17:33:01','2012-07-10 17:33:01',NULL,NULL,''),(100008,0,2,'384114771@qq.com','10470c3b4b1fed12c3baac014be15fac67c6e815','','384114771','',0,'0000-00-00','13450228963','','','','',1,'4e9800998ecf8427e','2012-07-16 22:25:31','2012-08-17 21:58:26',NULL,NULL,''),(100010,0,0,'','','','','',0,'0000-00-00','','','','','',0,'','2012-08-11 17:03:03','0000-00-00 00:00:00',NULL,'2_MX4xNjkzNzg4Mn5-V2VkIEF1ZyAxNSAwODozMDo1MSBQRFQgMjAxMn4wLjY4NzE3MzJ-',''),(100011,0,0,'iddmbr@gmail.com','3299ae4ae1db5099a9350df9344da5cefe4a9a1a','','iddmbr','',0,'0000-00-00','15902053571','','','','',1,'a6cab4a563d4dff3f52d','2012-08-12 22:22:49','2012-08-17 12:41:12','','1_MX4xNjkzNzg4Mn43NC4xMjUuMTc4LjMwflRodSBBdWcgMTYgMDQ6MDQ6MzEgUERUIDIwMTJ-MC4xMzIyNDk0N34',''),(100012,0,2,'zhongjiacong@outlook.com','53ae2fc6cf0b62b3ec601f8e5e8187629137794f','','zhongjiacong','',0,'1970-01-01','13480205903','','','','',1,'f7a7e73ec83fc9d600d7','2012-08-12 22:23:10','2012-08-16 14:24:16','','1_MX4xNjkzNzg4Mn5-VGh1IEF1ZyAxNiAwMDo0MTozOCBQRFQgMjAxMn4wLjUyMjYxMDh-',''),(100013,0,0,'172367155@qq.com','53ae2fc6cf0b62b3ec601f8e5e8187629137794f','','172367155','',0,'0000-00-00','13480205903','','','','',1,'cf8f356efddfb40e6','2012-08-14 21:00:55','2012-08-16 14:25:41','','2_MX4xNjkzNzg4Mn4xMTMuMTA4LjEzMy40Mn5UaHUgQXVnIDE2IDAzOjQzOjUxIFBEVCAyMDEyfjAuNzM1OTg3M34',''),(100014,0,0,'lancy1014@gmail.com','b3fb23062beff9a821890d6e92110c60f1e7f8d8','','lancy1014','',0,'0000-00-00','15902063569','','','','',1,'a70cc2a16994e75c4','2012-08-14 21:13:50','2012-08-17 17:39:07','54ff7879bb43ea083f67208151321046e0641ce21f0d028f67058863e25af3f4','1_MX4xNjkzNzg4Mn4xMTYuMjUzLjgxLjIxflR1ZSBBdWcgMTQgMTA6MzM6MTAgUERUIDIwMTJ-MC43ODQ4MDA2fg',''),(100015,0,0,'184492896@sina.com','10470c3b4b1fed12c3baac014be15fac67c6e815','','184492896','',0,'0000-00-00','13430294454','','','','',1,'cf140c39cf28b7a','2012-08-15 13:53:11','2012-08-15 13:53:11','',NULL,''),(100016,0,5,'eric.gzmy@foxmail.com','4a127a71fefe60d41f947d0a70c459fbd49f139d','','eric.gzmy','',0,'1970-01-01','13580392452','','','','',1,'978063105baa8aa3d7df','2012-08-15 17:11:20','2012-08-16 16:49:59',NULL,'2_MX4xNjkzNzg4Mn4xMTMuMTA4LjEzMy40Mn5UaHUgQXVnIDE2IDAzOjQ2OjEyIFBEVCAyMDEyfjAuMDEyNzk0ODUyfg',''),(100017,0,0,'zhongjiacong@126.com','53ae2fc6cf0b62b3ec601f8e5e8187629137794f','','zhongjiacong','',0,'0000-00-00','13480205903','','','','',1,'d4c6d9d1e2d0ce63c11d','2012-08-15 19:14:13','2012-08-15 19:14:55',NULL,NULL,''),(100019,0,0,'lijhong3@mail2.sysu.edu.cn','10470c3b4b1fed12c3baac014be15fac67c6e815','','lijhong3','',0,'0000-00-00','13580523356','','','','',1,'4f72dbef610ef4782a0b','2012-08-16 18:23:46','2012-08-17 14:26:50',NULL,'2_MX4xNjkzNzg4Mn5-VGh1IEF1ZyAxNiAwNDowODoxNSBQRFQgMjAxMn4wLjI4NzQyMzl-',''),(100020,0,0,'omegaleedh@gmail.com','10470c3b4b1fed12c3baac014be15fac67c6e815','','omegaleedh','',0,'0000-00-00','13580523356','','','','',1,'56c12ce3a21d8017c45e','2012-08-16 18:27:33','2012-08-16 18:29:18',NULL,NULL,''),(100021,0,0,'sysy@mail.com','cf14070f39472ea4c0e0d8823a9b713ee0926df9','','sysy','',0,'0000-00-00','13800138000','','','','',0,'d02431f426aa5bcc9082','2012-08-19 14:37:54','2012-08-19 14:37:54',NULL,NULL,'');
/*!40000 ALTER TABLE `tbl_c_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_i_sysintro`
--

DROP TABLE IF EXISTS `tbl_i_sysintro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_i_sysintro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_i_sysintro`
--

LOCK TABLES `tbl_i_sysintro` WRITE;
/*!40000 ALTER TABLE `tbl_i_sysintro` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_i_sysintro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_u_couponbag`
--

DROP TABLE IF EXISTS `tbl_u_couponbag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_u_couponbag` (
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `gettime` datetime NOT NULL,
  `usetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_u_couponbag`
--

LOCK TABLES `tbl_u_couponbag` WRITE;
/*!40000 ALTER TABLE `tbl_u_couponbag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_u_couponbag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_u_fieldclassify`
--

DROP TABLE IF EXISTS `tbl_u_fieldclassify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_u_fieldclassify` (
  `classifyobject_id` int(11) NOT NULL,
  `fieldcategory_id` int(11) NOT NULL,
  `interpreter_id` int(11) NOT NULL,
  `price` varchar(31) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_u_fieldclassify`
--

LOCK TABLES `tbl_u_fieldclassify` WRITE;
/*!40000 ALTER TABLE `tbl_u_fieldclassify` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_u_fieldclassify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_u_friend`
--

DROP TABLE IF EXISTS `tbl_u_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_u_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fans_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fansfollow` (`fans_id`,`follow_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_u_friend`
--

LOCK TABLES `tbl_u_friend` WRITE;
/*!40000 ALTER TABLE `tbl_u_friend` DISABLE KEYS */;
INSERT INTO `tbl_u_friend` VALUES (1,100011,100011,0,'2012-08-14 00:00:00'),(2,100011,100014,0,'2012-08-14 00:00:00'),(3,100014,100011,0,'2012-08-14 00:00:00'),(4,100014,100014,0,'2012-08-14 00:00:00'),(5,100014,100013,0,'2012-08-14 00:00:00'),(6,100014,100010,0,'2012-08-14 00:00:00'),(16,100001,100013,0,'2012-08-16 21:01:34'),(8,100013,100001,0,'2012-08-15 00:00:00'),(17,100001,100003,0,'2012-08-16 21:03:56'),(10,100016,100001,0,'2012-08-15 00:00:00'),(11,100016,100010,0,'2012-08-15 00:00:00'),(12,100013,100016,0,'2012-08-15 00:00:00'),(13,100002,100010,0,'2012-08-16 00:00:00'),(14,100011,100013,0,'2012-08-16 00:00:00'),(15,100011,100016,0,'2012-08-16 00:00:00');
/*!40000 ALTER TABLE `tbl_u_friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_u_spreadtable`
--

DROP TABLE IF EXISTS `tbl_u_spreadtable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_u_spreadtable` (
  `article_id` int(11) NOT NULL,
  `price` varchar(31) NOT NULL,
  `translator_id` int(11) DEFAULT NULL,
  UNIQUE KEY `articleprice` (`article_id`,`translator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_u_spreadtable`
--

LOCK TABLES `tbl_u_spreadtable` WRITE;
/*!40000 ALTER TABLE `tbl_u_spreadtable` DISABLE KEYS */;
INSERT INTO `tbl_u_spreadtable` VALUES (17,'0.84',100012),(18,'3.72',NULL),(19,'0.48',NULL);
/*!40000 ALTER TABLE `tbl_u_spreadtable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_u_staff`
--

DROP TABLE IF EXISTS `tbl_u_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_u_staff` (
  `user_id` int(11) NOT NULL,
  `onworktime` time NOT NULL,
  `offworktime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_u_staff`
--

LOCK TABLES `tbl_u_staff` WRITE;
/*!40000 ALTER TABLE `tbl_u_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_u_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_u_userlang`
--

DROP TABLE IF EXISTS `tbl_u_userlang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_u_userlang` (
  `user_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  UNIQUE KEY `userlang` (`user_id`,`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_u_userlang`
--

LOCK TABLES `tbl_u_userlang` WRITE;
/*!40000 ALTER TABLE `tbl_u_userlang` DISABLE KEYS */;
INSERT INTO `tbl_u_userlang` VALUES (100001,1),(100011,0),(100012,0),(100012,1),(100013,0),(100014,0),(100015,0),(100016,0),(100016,1),(100017,0),(100018,1),(100019,0),(100019,1),(100020,1),(100021,0);
/*!40000 ALTER TABLE `tbl_u_userlang` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-08-20 18:24:05
