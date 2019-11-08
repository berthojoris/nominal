CREATE
    VIEW `v_relokasi_list` 
    AS
(SELECT
    `tb_relokasi`.`id` AS `id_relokasi`,
    `tb_relokasi`.`id_jarkom`,
    `tb_jarkom`.`kode_jarkom`,
    `tb_jarkom`.`id_contract`,
    `tb_relokasi`.`reason`,
    `tb_relokasi`.`status`,
    `tb_relokasi`.`due_date`,
    `tb_relokasi`.`pic`,
    `tb_relokasi`.`ip_wan_old`,
    `tb_relokasi`.`ip_wan_new`,
    `tb_relokasi`.`req_doc_file`,
    `tb_relokasi`.`req_doc_no`,
    `tb_relokasi`.`req_doc_date`,
    `tb_relokasi`.`work_order_file`,
    `tb_relokasi`.`work_order_no`,
    `tb_relokasi`.`type_relocate`,
    `tb_relokasi`.`network_id_old`,
    `tb_relokasi`.`network_id_new`,
    `tb_relokasi`.`ip_lan_old`,
    `tb_relokasi`.`ip_lan_new`,
    `tb_relokasi`.`remote_name_old`,
    `tb_relokasi`.`remote_name_new`,
    `tb_relokasi`.`address_old`,
    `tb_relokasi`.`address_new`,
    `tb_relokasi`.`remote_type`,
    `tb_provider`.`nickname_provider`
FROM
    `tb_relokasi`
    INNER JOIN `tb_jarkom`
        ON (
            `tb_relokasi`.`id_jarkom` = `tb_jarkom`.`id`
        )
    INNER JOIN `tb_remote`
        ON (
            `tb_relokasi`.`id_remote_old` = `tb_remote`.`id_remote`
        )
    INNER JOIN `tb_provider`
        ON (
            `tb_jarkom`.`kode_provider` = `tb_provider`.`kode_provider`
        ));