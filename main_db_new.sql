CREATE DATABASE  IF NOT EXISTS `TwitterGoggles` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `TwitterGoggles`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: TwitterGoggles
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Table structure for table `entities`
--

DROP TABLE IF EXISTS `entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entities` (
  `entity_id` int(11) NOT NULL,
  `linkedTo` varchar(10) DEFAULT NULL,
  `linkedID` bigint(20) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entities`
--

LOCK TABLES `entities` WRITE;
/*!40000 ALTER TABLE `entities` DISABLE KEYS */;
/*!40000 ALTER TABLE `entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entities_values`
--

DROP TABLE IF EXISTS `entities_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entities_values` (
  `entities_values_id` int(11) NOT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `key` varchar(45) DEFAULT NULL,
  `val` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`entities_values_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entities_values`
--

LOCK TABLES `entities_values` WRITE;
/*!40000 ALTER TABLE `entities_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `entities_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_metadata`
--

DROP TABLE IF EXISTS `search_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_metadata` (
  `search_id` int(11) NOT NULL,
  `completed_in` float DEFAULT NULL,
  `max_id` bigint(20) DEFAULT NULL,
  `max_id_str` varchar(45) DEFAULT NULL,
  `next_results` text,
  `query` varchar(100) DEFAULT NULL,
  `refresh_url` text,
  `count` int(11) DEFAULT NULL,
  `since_id` int(11) DEFAULT NULL,
  `since_id_str` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_metadata`
--

LOCK TABLES `search_metadata` WRITE;
/*!40000 ALTER TABLE `search_metadata` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `status_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `search_id` varchar(45) DEFAULT NULL,
  `id_str` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `text` varchar(130) DEFAULT NULL,
  `source` text,
  `truncated` int(11) DEFAULT NULL,
  `in_reply_to_status_id` bigint(20) DEFAULT NULL,
  `in_reply_to_status_id_str` varchar(45) DEFAULT NULL,
  `in_reply_to_screen_name` varchar(45) DEFAULT NULL,
  `contributors` varchar(45) DEFAULT NULL,
  `retweet_count` int(11) DEFAULT NULL,
  `favorite_count` int(11) DEFAULT NULL,
  `favorited` int(11) DEFAULT NULL,
  `lang` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_metadata`
--

DROP TABLE IF EXISTS `status_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_metadata` (
  `idstatus_metadata` int(11) NOT NULL,
  `status_id` bigint(20) DEFAULT NULL,
  `result_type` varchar(45) DEFAULT NULL,
  `iso_language_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idstatus_metadata`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_metadata`
--

LOCK TABLES `status_metadata` WRITE;
/*!40000 ALTER TABLE `status_metadata` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `id_str` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `screen_name` varchar(45) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `url` text,
  `protected` int(11) DEFAULT NULL,
  `followers_count` int(11) DEFAULT NULL,
  `friends_count` int(11) DEFAULT NULL,
  `listed_count` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `favorites_count` int(11) DEFAULT NULL,
  `utc_offset` int(11) DEFAULT NULL,
  `time_zone` varchar(45) DEFAULT NULL,
  `geo_enabled` int(11) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `stauses_count` int(11) DEFAULT NULL,
  `lang` varchar(45) DEFAULT NULL,
  `contributors_enabled` int(11) DEFAULT NULL,
  `is_translator` int(11) DEFAULT NULL,
  `is_translation_enabled` int(11) DEFAULT NULL,
  `profile_background_color` varchar(6) DEFAULT NULL,
  `profile_background_image_url` text,
  `profile_background_image_url_https` text,
  `profile_background_tile` int(11) DEFAULT NULL,
  `profile_image_url` text,
  `profile_image_url_https` text,
  `profile_banner_url` text,
  `profile_link_color` varchar(6) DEFAULT NULL,
  `profile_sidebar_border_color` varchar(6) DEFAULT NULL,
  `profile_sidebar_fill_color` varchar(6) DEFAULT NULL,
  `profile_text_color` varchar(6) DEFAULT NULL,
  `profile_use_background_image` int(11) DEFAULT NULL,
  `default_profile` int(11) DEFAULT NULL,
  `default_profile_image` int(11) DEFAULT NULL,
  `following` int(11) DEFAULT NULL,
  `follow_request_sent` int(11) DEFAULT NULL,
  `notifications` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-30 18:35:59
