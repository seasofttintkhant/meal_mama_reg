-- MySQL dump 10.14  Distrib 5.5.56-MariaDB, for Linux (x86_64)
--
-- Host: kidzmeal-dbs-dev.cv2rhbewazki.ap-northeast-1.rds.amazonaws.com    Database: kidzmeal_pro_dev
-- ------------------------------------------------------
-- Server version	5.7.12

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date` varchar(10) NULL,
  `title` varchar(256) NOT NULL,
  `top_page_title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(64) NULL,
  `tag` varchar(256) NULL,
  `description` text NULL,
  `main_image` varchar(64) NULL,
  `thumbnail` varchar(64) NULL,
  `published` int(1) NOT NULL DEFAULT '0',
  `published_date` int(11) DEFAULT NULL,
  `deleted_flag` int(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE `article_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) NOT NULL,
  `kinder_user_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deleted_flag` int(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `averages`
--

DROP TABLE IF EXISTS `averages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `averages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gender` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `weight_min` float DEFAULT NULL,
  `weight_max` float DEFAULT NULL,
  `height_min` float DEFAULT NULL,
  `height_max` float DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `body_logs`
--

DROP TABLE IF EXISTS `body_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `body_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) NOT NULL,
  `kinder_user_id` int(11) NOT NULL,
  `kid_id` bigint(20) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `memo` text,
  `deleted_flag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `classrooms`
--

DROP TABLE IF EXISTS `classrooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT NULL,
  `kinder_user_id` int(11) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` text,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kids`
--

DROP TABLE IF EXISTS `kids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT NULL,
  `kinder_user_id` int(11) DEFAULT NULL,
  `code` varchar(11) DEFAULT NULL,
  `link_code` varchar(10) DEFAULT NULL,
  `link_code_use` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `prefecture` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `phone` varchar(48) DEFAULT NULL,
  `fax` varchar(48) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `classroom` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `allergies` varchar(1024) DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `menu_type` int(5) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kinders`
--

DROP TABLE IF EXISTS `kinders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kinders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `kinder_user_id` int(11) DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `prefecture` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `remark` varchar(2048) DEFAULT NULL,
  `share_growth_log` int(1) NOT NULL DEFAULT '1',
  `service` int(11) NOT NULL DEFAULT '0' COMMENT '0: Non service; 1: Buono; 2: Eibun',
  `shisetsu_id` int(11) NOT NULL DEFAULT '0',
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu_uploading_histories`
--

DROP TABLE IF EXISTS `menu_uploading_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_uploading_histories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT NULL,
  `kinder_user_id` int(11) DEFAULT NULL,
  `file_name` varchar(64) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `success_count` int(11) DEFAULT NULL,
  `failure_count` int(11) DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT NULL,
  `kinder_user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `timezone` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL DEFAULT '0',
  `dishnames` varchar(512) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `comment` text,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `message_delivery`
--

DROP TABLE IF EXISTS `message_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_delivery` (
  `message_delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `kid_id` int(11) NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`message_delivery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `message_master`
--

DROP TABLE IF EXISTS `message_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_master` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `kindergarten_id` int(11) DEFAULT NULL,
  `kinder_user_id` int(11) DEFAULT NULL,
  `kindergarten_class_id` int(11) DEFAULT NULL,
  `message_title` varchar(255) DEFAULT NULL,
  `message_body` text,
  `message_sent` tinyint(4) DEFAULT '0',
  `sent_date` int(11) DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification_delivery`
--

DROP TABLE IF EXISTS `notification_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_delivery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `notification_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=559 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `sent_status` int(1) NOT NULL DEFAULT '0',
  `sent_date` int(11) DEFAULT NULL,
  `deleted_flag` int(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recommended_menus`
--

DROP TABLE IF EXISTS `recommended_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recommended_menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `kondate_2_id` int(11) NOT NULL DEFAULT '0',
  `deleted_flag` int(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service_mealtypes`
--

DROP TABLE IF EXISTS `service_mealtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_mealtypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT NULL,
  `mealtype_id` int(11) DEFAULT NULL,
  `mealtype_name` varchar(128) DEFAULT NULL,
  `m_category_id` int(11) NOT NULL DEFAULT '0',
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service_timezones`
--

DROP TABLE IF EXISTS `service_timezones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_timezones` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT NULL,
  `timezone_id` int(11) DEFAULT NULL,
  `timezone_name` varchar(128) DEFAULT NULL,
  `hour` varchar(2) DEFAULT NULL,
  `minute` varchar(2) DEFAULT NULL,
  `m_timezone_id` int(11) NOT NULL DEFAULT '0',
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) DEFAULT NULL,
  `value` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `system_messages`
--

DROP TABLE IF EXISTS `system_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reply_message_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `sender_id` int(11) NOT NULL DEFAULT '0',
  `receiver_id` int(11) NOT NULL DEFAULT '0',
  `sent_date` int(11) DEFAULT NULL,
  `deleted_flag` int(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tayoris`
--

DROP TABLE IF EXISTS `tayoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tayoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT NULL,
  `kinder_user_id` int(11) DEFAULT NULL,
  `kbn` tinyint(4) DEFAULT NULL,
  `method` int(1) NOT NULL DEFAULT '1',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_img` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header` text COLLATE utf8_unicode_ci,
  `body_img` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `footer_img` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer` text COLLATE utf8_unicode_ci,
  `pdf` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `deleted_flag` tinyint(1) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_flag` int(1) NOT NULL DEFAULT '0',
  `kinder` varchar(256) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-02  9:22:21

CREATE TABLE `push_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT 0,
  `title` varchar(256) DEFAULT NULL,
  `body` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nutrition_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kinder_id` int(11) DEFAULT 0,
  `mealtype_id` int(11) DEFAULT 0,
  `values` text NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
