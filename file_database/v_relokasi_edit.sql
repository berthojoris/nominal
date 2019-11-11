CREATE
    VIEW `v_relokasi_edit` 
    AS
(SELECT
    `v_relokasi_list`.`id_relokasi`,
    `v_relokasi_list`.`id_jarkom`,
    `v_relokasi_list`.`kode_jarkom`,
    `v_relokasi_list`.`id_contract`,
    `v_relokasi_list`.`reason`,
    `v_relokasi_list`.`status`,
    `v_relokasi_list`.`due_date`,
    `v_relokasi_list`.`pic`,
    `v_relokasi_list`.`ip_wan_old`,
    `v_relokasi_list`.`ip_wan_new`,
    `v_relokasi_list`.`req_doc_file`,
    `v_relokasi_list`.`req_doc_no`,
    `v_relokasi_list`.`req_doc_date`,
    `v_relokasi_list`.`work_order_file`,
    `v_relokasi_list`.`work_order_no`,
    `v_relokasi_list`.`type_relocate`,
    `v_relokasi_list`.`network_id_old`,
    `v_relokasi_list`.`network_id_new`,
    `v_relokasi_list`.`ip_lan_old`,
    `v_relokasi_list`.`ip_lan_new`,
    `v_relokasi_list`.`remote_name_old`,
    `v_relokasi_list`.`remote_name_new`,
    `v_relokasi_list`.`address_old`,
    `v_relokasi_list`.`address_new`,
    `v_relokasi_list`.`distance`,
    `v_relokasi_list`.`remote_type_old`,
    `v_relokasi_list`.`remote_type_new`,
    `v_relokasi_list`.`nickname_provider`,
    `v_relokasi_list`.`region_name_old`,
    `v_relokasi_list`.`region_name_new`,
    `tb_jenis_jarkom`.`jenis_jarkom` AS `network_type`,
    `tb_kanwil`.`nama_kanwil` AS `region`,
    `tb_spk`.`no_spk`,
    `tb_tipe_uker`.`singkatan`
FROM
    `tb_jarkom`
    INNER JOIN `v_relokasi_list`
        ON (
            `tb_jarkom`.`id` = `v_relokasi_list`.`id_jarkom`
        )
    INNER JOIN `tb_jenis_jarkom`
        ON (
            `tb_jarkom`.`kode_jenis_jarkom` = `tb_jenis_jarkom`.`kode_jenis_jarkom`
        )
    INNER JOIN `tb_spk`
        ON (
            `tb_jarkom`.`id_spk` = `tb_spk`.`id_spk`
        )
    INNER JOIN `tb_remote`
        ON (
            `tb_jarkom`.`id_remote` = `tb_remote`.`id_remote`
        )
    INNER JOIN `tb_kanca`
        ON (
            `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
        )
    INNER JOIN `tb_kanwil`
        ON (
            `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
        )
    INNER JOIN `tb_tipe_uker`
        ON (
            `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
        )
);
