CREATE
    VIEW `nominal`.`v_all_remote` 
    AS
(SELECT
  `a`.`id_remote`          AS `id_remote`,
  `a`.`nama_remote`        AS `nama_remote`,
  `a`.`last_update_l`      AS `last_update`,
  `a`.`last_polled_l`      AS `last_polled`,
  `a`.`status_rec_date_l`  AS `status_rec_date`,
  `a`.`status_fail_date_l` AS `status_fail_date`,
  `a`.`latency_l`          AS `latency`,
  `a`.`latitude`           AS `latitude`,
  `a`.`longitude`          AS `longitude`,
  `e`.`keterangan`         AS `keterangan`,
  `c`.`pic_pinca`          AS `pic_pinca`,
  `c`.`pic_spo`            AS `pic_spo`,
  `c`.`pet_it`             AS `pet_it`,
  `a`.`pic_uko`            AS `pic_uko`,
  `d`.`pic_kanwil`         AS `pic_kanwil`,
  `a`.`alamat_uker`        AS `alamat_uker`,
  `a`.`telp_uker`          AS `telp_uker`,
  `b`.`kode_tipe_uker`     AS `kode_tipe_uker`,
  `b`.`tipe_uker`          AS `tipe_uker`,
  `c`.`nama_kanca`         AS `nama_kanca`,
  `c`.`kode_kanca`         AS `kode_kanca`,
  `d`.`nama_kanwil`        AS `nama_kanwil`,
  `d`.`kode_kanwil`        AS `kode_kanwil`,
  `a`.`kode_uker`          AS `kode_uker`,
  `a`.`ip_lan`             AS `ip_lan`,
  `a`.`ip_monitoring`      AS `ip_monitoring`,
  `a`.`kode_op`            AS `kode_op_asli`,
  `a`.`status_l`           AS `status_asli`,
  `a`.`status_l`           AS `status_onoff`,
  `a`.`status_alarm`       AS `status_alarm`,
  `a`.`id_alarm_type`      AS `id_alarm_type`,
  `a`.`notes_alarm`        AS `notes_alarm`,
  (CASE WHEN (`a`.`status_l` = 3) THEN 3 WHEN (`a`.`status_l` = 1) THEN 1 ELSE 10 END) AS `status`,
  (CASE WHEN (`a`.`status_l` = 3) THEN 'ONLINE' WHEN (((`a`.`status_l` = 1) AND (`b`.`kode_tipe_uker` IN (6,8,9,10,11,12,13))) OR (`a`.`kode_op` = 2)) THEN 'NOP' WHEN (`a`.`status_l` = 1) THEN 'OFFLINE' ELSE 'UNKNOWN' END) AS `status_name`,
  (CASE WHEN (`a`.`status_l` = 3) THEN 2 WHEN (((`a`.`status_l` = 1) AND (`b`.`kode_tipe_uker` IN (6,8,9,10,11,12,13))) OR (`a`.`kode_op` = 2)) THEN 3 WHEN (`a`.`status_l` = 1) THEN 1 ELSE 4 END) AS `kode_sorting`,
  (CASE WHEN ((`a`.`kode_op` = 1) AND (`b`.`kode_tipe_uker` IN (6,8,9,10,11,12,13))) THEN 2 WHEN (`a`.`kode_op` = 1) THEN 1 WHEN (`a`.`kode_op` = 2) THEN 2 ELSE 2 END) AS `kode_op`
FROM ((((`tb_remote` `a`
      LEFT JOIN `tb_tipe_uker` `b`
        ON ((`b`.`kode_tipe_uker` = `a`.`kode_tipe_uker`)))
     LEFT JOIN `tb_kanca` `c`
       ON ((`c`.`kode_kanca` = `a`.`kode_kanca`)))
    LEFT JOIN `tb_kanwil` `d`
      ON ((`d`.`kode_kanwil` = `c`.`kode_kanwil`)))
   LEFT JOIN `tb_op` `e`
     ON ((`e`.`kode_op` = `a`.`kode_op`)))
WHERE (`a`.`kode_op` IN(1,2))
ORDER BY (CASE WHEN(`a`.`status_l` = 3)THEN 2 WHEN(((`a`.`status_l` = 1)
                                                    AND (`b`.`kode_tipe_uker` IN(6,8,9,10,11,12,13)))
                                                    OR (`a`.`kode_op` = 2))THEN 3 WHEN(`a`.`status_l` = 1)THEN 1 ELSE 4 END));
