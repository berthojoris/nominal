CREATE TABLE `tb_relokasi_fileupload` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `relokasi_id` int(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  `folder` varchar(30) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_relokasi` (`relokasi_id`),
  CONSTRAINT `fk_relokasi` FOREIGN KEY (`relokasi_id`) REFERENCES `tb_relokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;