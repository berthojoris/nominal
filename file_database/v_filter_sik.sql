CREATE
    VIEW `v_filter_sik` 
    AS
(SELECT
    `tb_relokasi`.`id`,
    `tb_relokasi`.`id_jarkom`,
    `tb_jarkom`.`kode_jarkom`,
    `tb_jarkom`.`ip_wan`,
    `tb_provider`.`nickname_provider`,
    `tb_relokasi`.`id_remote_new`,
    `tb_remote`.`nama_remote`,
    `tb_relokasi`.`no_doc`,
    `tb_relokasi`.`pic`
FROM
    `tb_relokasi`
INNER JOIN `tb_jarkom`
    ON (
        `tb_relokasi`.`id_jarkom` = `tb_jarkom`.`id`
    )
INNER JOIN `tb_remote`
    ON (
        `tb_relokasi`.`id_remote_new` = `tb_remote`.`id_remote`
    )
INNER JOIN `tb_provider`
    ON (
        `tb_jarkom`.`kode_provider` = `tb_provider`.`kode_provider`
    ));
