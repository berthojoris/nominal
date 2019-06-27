SET sql_mode = '';
TRUNCATE TABLE tb_remote_status_dump;
INSERT INTO tb_remote_status_dump (id_remote, kode_uker, tid_atm, ip_lan, `status`, last_update, `status_fail_date`, `status_rec_date`)
SELECT a.id_remote, a.kode_uker, c.tid_atm, a.ip_lan, b.`status`, now(), b.status_fail_date, b.status_rec_date 
FROM tb_remote a
LEFT JOIN (SELECT CONCAT(SUBSTRING_INDEX(hostname,'.',3),'.1') as `hostname`, `status`, status_fail_date, status_rec_date FROM `host` WHERE disabled <> 'on' GROUP BY hostname) b 
ON CONCAT(SUBSTRING_INDEX(a.ip_lan,'.',3),'.1') = CONCAT(SUBSTRING_INDEX(b.hostname,'.',3),'.1') 
LEFT JOIN tb_atm c ON CONCAT(SUBSTRING_INDEX(b.hostname,'.',3),'.1') = CONCAT(SUBSTRING_INDEX(c.ip_atm,'.',3),'.1') GROUP BY a.id_remote, a.ip_lan;

RENAME TABLE `tb_remote_status` TO `tb_remote_status_`, `tb_remote_status_dump` TO `tb_remote_status`;
RENAME TABLE `tb_remote_status_` TO `tb_remote_status_dump`;
