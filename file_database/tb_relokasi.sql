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
  `id_jarkom` int(10) NOT NULL,
  `id_remote_old` int(10) NOT NULL,
  `id_remote_new` int(10) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `due_date` date DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `ip_wan_old` varchar(45) DEFAULT NULL,
  `ip_wan_new` varchar(45) DEFAULT NULL,
  `req_doc_file` varchar(255) DEFAULT NULL,
  `req_doc_no` varchar(50) DEFAULT NULL,
  `req_doc_date` date DEFAULT NULL,
  `work_order_file` varchar(255) DEFAULT NULL,
  `work_order_no` varchar(50) DEFAULT NULL,
  `type_relocate` varchar(45) DEFAULT NULL,
  `network_id_old` varchar(30) DEFAULT NULL,
  `network_id_new` varchar(30) DEFAULT NULL,
  `ip_lan_old` varchar(45) DEFAULT NULL,
  `ip_lan_new` varchar(45) DEFAULT NULL,
  `remote_name_old` varchar(200) DEFAULT NULL,
  `remote_name_new` varchar(200) DEFAULT NULL,
  `address_old` varchar(255) DEFAULT NULL,
  `address_new` varchar(255) DEFAULT NULL,
  `distance` varchar(50) DEFAULT NULL,
  `remote_type` varchar(45) DEFAULT NULL,
  `region_name_old` varchar(50) DEFAULT NULL,
  `region_name_new` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jarkom` (`id_jarkom`),
  CONSTRAINT `tb_relokasi_ibfk_1` FOREIGN KEY (`id_jarkom`) REFERENCES `tb_jarkom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
