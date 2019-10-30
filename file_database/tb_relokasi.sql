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
  `kode_jarkom` varchar(100) DEFAULT NULL,
  `id_remote_old` int(10) NOT NULL,
  `id_remote_new` int(10) NOT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `no_doc` varchar(255) DEFAULT NULL,
  `reason` varchar(50) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `no_sik` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jarkom` (`id_jarkom`),
  CONSTRAINT `tb_relokasi_ibfk_1` FOREIGN KEY (`id_jarkom`) REFERENCES `tb_jarkom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
