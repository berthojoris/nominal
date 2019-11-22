CREATE
    VIEW `v_relokasi_list` 
    AS
(SELECT
    `tb_relokasi`.`id`                AS `id_relokasi`,
    `tb_relokasi`.`id_jarkom`         AS `id_jarkom`,
    `tb_relokasi`.`id_remote_old`     AS `id_remote_old`,
    `tb_relokasi`.`id_remote_new`     AS `id_remote_new`,
    `tb_jarkom`.`kode_jarkom`         AS `kode_jarkom`,
    `tb_jarkom`.`id_contract`         AS `id_contract`,
    `tb_relokasi`.`reason`            AS `reason`,
    `tb_relokasi`.`status`            AS `status`,
    `tb_relokasi`.`due_date`          AS `due_date`,
    `tb_relokasi`.`pic`               AS `pic`,
    `tb_relokasi`.`ip_wan_old`        AS `ip_wan_old`,
    `tb_relokasi`.`ip_wan_new`        AS `ip_wan_new`,
    `tb_relokasi`.`req_doc_file`      AS `req_doc_file`,
    `tb_relokasi`.`req_doc_no`        AS `req_doc_no`,
    `tb_relokasi`.`req_doc_date`      AS `req_doc_date`,
    `tb_relokasi`.`work_order_file`   AS `work_order_file`,
    `tb_relokasi`.`work_order_no`     AS `work_order_no`,
    `tb_relokasi`.`type_relocate`     AS `type_relocate`,
    `tb_relokasi`.`network_id_old`    AS `network_id_old`,
    `tb_relokasi`.`network_id_new`    AS `network_id_new`,
    `tb_relokasi`.`ip_lan_old`        AS `ip_lan_old`,
    `tb_relokasi`.`ip_lan_new`        AS `ip_lan_new`,
    `tb_relokasi`.`remote_name_old`   AS `remote_name_old`,
    `tb_relokasi`.`remote_name_new`   AS `remote_name_new`,
    `tb_relokasi`.`address_old`       AS `address_old`,
    `tb_relokasi`.`address_new`       AS `address_new`,
    `tb_relokasi`.`distance`          AS `distance`,
    `tb_relokasi`.`remote_type_old`   AS `remote_type_old`,
    `tb_relokasi`.`remote_type_new`   AS `remote_type_new`,
    `tb_relokasi`.`region_name_old`   AS `region_name_old`,
    `tb_relokasi`.`region_name_new`   AS `region_name_new`,
    `tb_relokasi`.`network_type_old`  AS `network_type_old`,
    `tb_relokasi`.`network_type_new`  AS `network_type_new`,
    `tb_relokasi`.`remote_latitude_old`  AS `remote_latitude_old`,
    `tb_relokasi`.`remote_longitude_old`  AS `remote_longitude_old`,
    `tb_relokasi`.`remote_latitude_new`  AS `remote_latitude_new`,
    `tb_relokasi`.`remote_longitude_new`  AS `remote_longitude_new`,
    `tb_provider`.`nickname_provider` AS `nickname_provider`
FROM (((`tb_relokasi`
JOIN `tb_jarkom`
    ON ((`tb_relokasi`.`id_jarkom` = `tb_jarkom`.`id`)))
JOIN `tb_remote`
    ON ((`tb_relokasi`.`id_remote_old` = `tb_remote`.`id_remote`)))
JOIN `tb_provider`
    ON ((`tb_jarkom`.`kode_provider` = `tb_provider`.`kode_provider`))));