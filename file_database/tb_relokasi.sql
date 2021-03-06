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
  `req_doc_file` varchar(100) DEFAULT NULL,
  `req_doc_no` varchar(50) DEFAULT NULL,
  `req_doc_date` date DEFAULT NULL,
  `work_order_file` varchar(100) DEFAULT NULL,
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
  `remote_type_old` varchar(45) DEFAULT NULL,
  `remote_type_new` varchar(45) DEFAULT NULL,
  `region_name_old` varchar(50) DEFAULT NULL,
  `region_name_new` varchar(50) DEFAULT NULL,
  `network_type_old` varchar(50) DEFAULT NULL,
  `network_type_new` varchar(50) DEFAULT NULL,
  `remote_latitude_old` varchar(50) DEFAULT NULL,
  `remote_longitude_old` varchar(50) DEFAULT NULL,
  `remote_latitude_new` varchar(50) DEFAULT NULL,
  `remote_longitude_new` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jarkom` (`id_jarkom`),
  CONSTRAINT `tb_relokasi_ibfk_1` FOREIGN KEY (`id_jarkom`) REFERENCES `tb_jarkom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;