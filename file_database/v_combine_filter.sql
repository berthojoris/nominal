CREATE
    VIEW `v_combine_filter` 
    AS
(SELECT
    `tb_relokasi`.`id` AS `id_relokasi`,
    `tb_relokasi`.`id_jarkom`,
    `tb_jarkom`.`kode_jarkom`,
    `tb_jarkom`.`ip_wan`,
    `tb_relokasi`.`id_remote_old`,
    `tb_remote`.`nama_remote` AS `nama_remote_old`,
    `tb_relokasi`.`id_remote_new`,
    `v_all_remote`.`nama_remote` AS `nama_remote_new`,
    `tb_relokasi`.`alamat`,
    `tb_relokasi`.`file_url`,
    `tb_relokasi`.`no_doc`,
    `tb_relokasi`.`reason`,
    `tb_relokasi`.`status`,
    `tb_relokasi`.`due_date`,
    `tb_relokasi`.`pic`,
    `tb_relokasi`.`no_sik`
FROM
    `tb_relokasi`
    INNER JOIN `tb_jarkom`
        ON (
            `tb_relokasi`.`id_jarkom` = `tb_jarkom`.`id`
        )
    INNER JOIN `tb_remote`
        ON (
            `tb_remote`.`id_remote` = `tb_relokasi`.`id_remote_old`
        )
    INNER JOIN `v_all_remote`
        ON (
            `v_all_remote`.`id_remote` = `tb_relokasi`.`id_remote_new`
        )
    ORDER BY id_relokasi DESC);