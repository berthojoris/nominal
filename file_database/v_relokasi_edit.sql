CREATE
    VIEW `v_relokasi_edit` 
    AS
(SELECT
    `v_relokasi_list`.`id_relokasi`            AS `id_relokasi`,
    `v_relokasi_list`.`id_jarkom`              AS `id_jarkom`,
    `v_relokasi_list`.`kode_jarkom`            AS `kode_jarkom`,
    `v_relokasi_list`.`id_contract`            AS `id_contract`,
    `v_relokasi_list`.`id_remote_old`          AS `id_remote_old`,
    `v_relokasi_list`.`id_remote_new`          AS `id_remote_new`,
    `v_relokasi_list`.`reason`                 AS `reason`,
    `v_relokasi_list`.`status`                 AS `status`,
    `v_relokasi_list`.`due_date`               AS `due_date`,
    `v_relokasi_list`.`pic`                    AS `pic`,
    `v_relokasi_list`.`ip_wan_old`             AS `ip_wan_old`,
    `v_relokasi_list`.`ip_wan_new`             AS `ip_wan_new`,
    `v_relokasi_list`.`req_doc_file`           AS `req_doc_file`,
    `v_relokasi_list`.`req_doc_no`             AS `req_doc_no`,
    `v_relokasi_list`.`req_doc_date`           AS `req_doc_date`,
    `v_relokasi_list`.`work_order_file`        AS `work_order_file`,
    `v_relokasi_list`.`work_order_no`          AS `work_order_no`,
    `v_relokasi_list`.`type_relocate`          AS `type_relocate`,
    `v_relokasi_list`.`network_id_old`         AS `network_id_old`,
    `v_relokasi_list`.`network_id_new`         AS `network_id_new`,
    `v_relokasi_list`.`ip_lan_old`             AS `ip_lan_old`,
    `v_relokasi_list`.`ip_lan_new`             AS `ip_lan_new`,
    `v_relokasi_list`.`remote_name_old`        AS `remote_name_old`,
    `v_relokasi_list`.`remote_name_new`        AS `remote_name_new`,
    `v_relokasi_list`.`remote_latitude_old`    AS `remote_latitude_old`,
    `v_relokasi_list`.`remote_longitude_old`   AS `remote_longitude_old`,
    `v_relokasi_list`.`remote_latitude_new`    AS `remote_latitude_new`,
    `v_relokasi_list`.`remote_longitude_new`   AS `remote_longitude_new`,
    `v_relokasi_list`.`address_old`            AS `address_old`,
    `v_relokasi_list`.`address_new`            AS `address_new`,
    `v_relokasi_list`.`distance`               AS `distance`,
    `v_relokasi_list`.`remote_type_old`        AS `remote_type_old`,
    `v_relokasi_list`.`remote_type_new`        AS `remote_type_new`,
    `v_relokasi_list`.`nickname_provider`      AS `nickname_provider`,
    `v_relokasi_list`.`region_name_old`        AS `region_name_old`,
    `v_relokasi_list`.`region_name_new`        AS `region_name_new`,
    `v_relokasi_list`.`network_type_old`       AS `network_type_old`,
    `v_relokasi_list`.`network_type_new`       AS `network_type_new`,
    `tb_jenis_jarkom`.`jenis_jarkom` AS `network_type`,
    `tb_kanwil`.`nama_kanwil`        AS `region`,
    `tb_spk`.`no_spk`                AS `no_spk`,
    `tb_tipe_uker`.`singkatan`       AS `singkatan`
FROM (((((((`tb_jarkom`
JOIN `v_relokasi_list`
    ON ((`tb_jarkom`.`id` = `v_relokasi_list`.`id_jarkom`)))
JOIN `tb_jenis_jarkom`
    ON ((`tb_jarkom`.`kode_jenis_jarkom` = `tb_jenis_jarkom`.`kode_jenis_jarkom`)))
JOIN `tb_spk`
    ON ((`tb_jarkom`.`id_spk` = `tb_spk`.`id_spk`)))
JOIN `tb_remote`
    ON ((`tb_jarkom`.`id_remote` = `tb_remote`.`id_remote`)))
JOIN `tb_kanca`
    ON ((`tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`)))
JOIN `tb_kanwil`
    ON ((`tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`)))
JOIN `tb_tipe_uker`
    ON ((`tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`))));