# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: brian
# Generation Time: 2011-01-17 05:12:58 +0800
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table contact
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) DEFAULT NULL,
  `budget1` int(11) DEFAULT NULL,
  `budget2` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ping1` int(11) DEFAULT NULL,
  `ping2` int(11) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `rooms1` int(11) DEFAULT NULL,
  `rooms2` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `car` int(1) DEFAULT NULL,
  `city` int(2) DEFAULT NULL,
  `plan` int(1) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `month` int(2) DEFAULT NULL,
  `day` int(2) DEFAULT NULL,
  `time` varchar(5) DEFAULT NULL,
  `uses` int(1) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` (`id`,`property_id`,`budget1`,`budget2`,`name`,`ping1`,`ping2`,`tel`,`rooms1`,`rooms2`,`email`,`car`,`city`,`plan`,`year`,`month`,`day`,`time`,`uses`,`other`,`content`,`created`)
VALUES
	(1,1,10,20,'測試人員',1,5,'0934123456',3,5,'test@test.com',0,1,1,2010,12,31,'13:00',1,'','希望能有好房子可以買','2010-12-14 04:16:46'),
	(2,1,300,500,'測試人員',100,200,'0933123456',5,10,'test@test.com',0,11,2,2010,12,31,'01:00',2,'','','2010-12-14 04:52:05'),
	(3,1,123,456,'測試人員',50,200,'0933123456',1,1,'test@test.com',0,1,2,2011,1,1,'13:00',9,'養蚊子','','2010-12-14 04:53:39'),
	(4,1,1,2,'測試人員',3,5,'(02)26834456',3,4,'test@test.com',0,7,1,2011,1,1,'13:00',4,'','測試信件','2010-12-15 03:21:51'),
	(5,3,1,2,'測試人員',3,5,'(02)26834456',3,4,'test@test.com',0,1,1,2011,1,5,'13:00',2,'','','2010-12-15 03:26:07'),
	(6,3,1,2,'測試人員',3,5,'(02)26834456',3,4,'test@test.com',0,1,4,2011,1,5,'13:00',5,'','','2010-12-15 03:27:37'),
	(7,3,1,2,'測試人員',3,5,'(02)26834456',3,4,'test@test.com',0,3,1,2010,1,1,'01:00',7,'','','2010-12-15 03:31:32');

/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table property
# ------------------------------------------------------------

DROP TABLE IF EXISTS `property`;

CREATE TABLE `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `property` WRITE;
/*!40000 ALTER TABLE `property` DISABLE KEYS */;
INSERT INTO `property` (`id`,`name`,`img`,`keyword`,`description`,`email`)
VALUES
	(1,'金騰行館','cont_t_01.jpg','房屋,捷運,中山國小,時尚精品','國際新墅新生第涵仰綻賞文山敦品文藝春秋理性與感性南京雙子星金富天廈2 美立方歐洲帝圖21City世紀花園廣場臨沂帝國大樓富寓金騰行館敦南苑易享家水岸Sofa','dars94@gmail.com'),
	(3,'測試建案','2010122204403525.jpg','TEST','wawawawawawawa','dars@dars.idv.tw');

/*!40000 ALTER TABLE `property` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
