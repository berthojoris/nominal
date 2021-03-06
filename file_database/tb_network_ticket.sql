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
/*Table structure for table `tb_network_ticket` */

CREATE TABLE `tb_network_ticket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `network_status` varchar(100) DEFAULT NULL,
  `id_jarkom` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_creator` varchar(100) NOT NULL,
  `last_check` varchar(200) DEFAULT NULL,
  `status_ticket` varchar(200) DEFAULT NULL,
  `incident_number` varchar(200) DEFAULT NULL,
  `description` text,
  `notes` text,
  `ip_wan` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `nama_uker` varchar(100) DEFAULT NULL,
  `provider_jarkom` varchar(100) DEFAULT NULL,
  `permasalahan` varchar(200) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
