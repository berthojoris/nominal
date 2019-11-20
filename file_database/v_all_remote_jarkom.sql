SELECT
    `a`.`id_remote`          AS `id_remote`,
    `a`.`nama_remote`        AS `nama_remote`,
    (CASE WHEN (`f`.`kode_jenis_jarkom` = 3) THEN `a`.`status_rec_date_l` ELSE `e`.`status_rec_date_l` END) AS `status_rec_date_l`,
    (CASE WHEN (`f`.`kode_jenis_jarkom` = 3) THEN `a`.`status_fail_date_l` ELSE `e`.`status_fail_date_l` END) AS `status_fail_date_l`,
    (CASE WHEN (`f`.`kode_jenis_jarkom` = 3) THEN `a`.`status_l` ELSE `e`.`status_l` END) AS `status_l`,
    `e`.`status_l`           AS `status_jarkom`,
    `a`.`status_rec_date_l`  AS `status_rec_date`,
    `a`.`status_fail_date_l` AS `status_fail_date`,
    `a`.`last_polled_l`      AS `last_polled`,
    `a`.`latitude`           AS `latitude`,
    `a`.`longitude`          AS `longitude`,
    `b`.`kode_tipe_uker`     AS `kode_tipe_uker`,
    `b`.`tipe_uker`          AS `tipe_uker`,
    `c`.`nama_kanca`         AS `nama_kanca`,
    `d`.`nama_kanwil`        AS `nama_kanwil`,
    `a`.`kode_uker`          AS `kode_uker`,
    `a`.`ip_lan`             AS `ip_lan`,
    `a`.`subnet`             AS `subnet`,
    `a`.`ip_monitoring`      AS `ip_monitoring`,
    `e`.`id`                 AS `id_jarkom`,
    `e`.`kode_jarkom`        AS `kode_jarkom`,
    `e`.`used_status`        AS `used_status`,
    `e`.`brisat`             AS `brisat`,
    `e`.`bandwidth`          AS `bandwidth`,
    `e`.`notes_alarm`        AS `notes_alarm`,
    `e`.`id_alarm_type`      AS `id_alarm_type`,
    `e`.`status_alarm`       AS `status_alarm`,
    `g`.`nama_provider`      AS `nama_provider`,
    `f`.`kode_jenis_jarkom`  AS `kode_jenis_jarkom`,
    `g`.`kode_provider`      AS `kode_provider`,
    `g`.`nickname_provider`  AS `nickname_provider`,
    `a`.`keterangan`         AS `keterangan`,
    (CASE WHEN (`e`.`brisat` = '1') THEN 'BRISAT' WHEN (`e`.`brisat` = '0') THEN `f`.`jenis_jarkom` WHEN (`e`.`brisat` = '2') THEN 'JUPITER' END) AS `jenis_jarkom`,
    (CASE WHEN (`e`.`brisat` = '1') THEN 'YES' WHEN (`e`.`brisat` = '0') THEN 'NO' WHEN ((`e`.`brisat` = '2') AND (`e`.`brisat_batch` = 'A')) THEN 'JUPITER FASE A' WHEN ((`e`.`brisat` = '2') AND (`e`.`brisat_batch` = 'B')) THEN 'JUPITER FASE B' END) AS `brisat_name`,
    `a`.`kode_op`            AS `kode_op`,
    (CASE WHEN (`f`.`kode_jenis_jarkom` = 3) THEN `a`.`status_l` ELSE `e`.`status_l` END) AS `status`,
    (CASE WHEN ((`a`.`status_l` = 3) AND (`f`.`kode_jenis_jarkom` = 3)) THEN 'ONLINE' WHEN (`e`.`status_l` = 3) THEN 'ONLINE' WHEN ((`a`.`kode_op` = 2) OR ((`a`.`status_l` = 1) AND (`b`.`kode_tipe_uker` IN (10,6,11,13)))) THEN 'NOP' WHEN ((`a`.`status_l` = 1) AND (`f`.`kode_jenis_jarkom` = 3)) THEN 'OFFLINE' WHEN (`e`.`status_l` = 1) THEN 'OFFLINE' ELSE 'UNKNOWN' END) AS `status_name`,
    `e`.`ip_wan`             AS `ip_wan`,
    `c`.`kode_kanca`         AS `kode_kanca`,
    `d`.`kode_kanwil`        AS `kode_kanwil`,
    `a`.`alamat_uker`        AS `alamat_uker`,
    `e`.`id_spk`             AS `id_spk`,
    `f`.`jenis_jarkom`       AS `media`,
    `e`.`brisat_batch`       AS `brisat_batch`
FROM ((((((`tb_remote` `a`
          LEFT JOIN `tb_tipe_uker` `b`
            ON ((`b`.`kode_tipe_uker` = `a`.`kode_tipe_uker`)))
         LEFT JOIN `tb_kanca` `c`
           ON ((`c`.`kode_kanca` = `a`.`kode_kanca`)))
        LEFT JOIN `tb_kanwil` `d`
          ON ((`d`.`kode_kanwil` = `c`.`kode_kanwil`)))
       LEFT JOIN `tb_jarkom` `e`
         ON ((`e`.`id_remote` = `a`.`id_remote`)))
      LEFT JOIN `tb_jenis_jarkom` `f`
        ON ((`f`.`kode_jenis_jarkom` = `e`.`kode_jenis_jarkom`)))
     LEFT JOIN `tb_provider` `g`
       ON ((`g`.`kode_provider` = `e`.`kode_provider`)))
WHERE (`a`.`kode_op` IN(1,2))