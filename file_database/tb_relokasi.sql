/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.19 : Database - nominal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_relokasi` */

CREATE TABLE `tb_relokasi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip_address_network_id` varchar(100) NOT NULL,
  `reason` text,
  `doc_number` varchar(100) DEFAULT NULL,
  `file_upload` varchar(100) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `live_target` date DEFAULT NULL,
  `ip_wan` varchar(100) DEFAULT NULL,
  `remote_name` varchar(100) DEFAULT NULL,
  `remote_address` text,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
