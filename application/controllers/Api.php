<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller 
{
    public function getremote($ip)
    {
        $sql = "SELECT
            `tb_jarkom`.`ip_wan`,
            `tb_jarkom`.`id_remote`,
            `tb_spk`.`no_spk`,
            `tb_remote`.`ip_lan`,
            `tb_jenis_jarkom`.`jenis_jarkom`,
            `tb_remote`.`nama_remote`,
            `tb_tipe_uker`.`tipe_uker`,
            `tb_remote`.`alamat_uker`
        FROM
            `tb_jarkom`
            INNER JOIN `tb_remote`
            ON (
                `tb_jarkom`.`id_remote` = `tb_remote`.`id_remote`
            )
            INNER JOIN `tb_spk`
            ON (
                `tb_jarkom`.`id_spk` = `tb_spk`.`id_spk`
            )
            INNER JOIN `tb_jenis_jarkom`
            ON (
                `tb_jarkom`.`kode_jenis_jarkom` = `tb_jenis_jarkom`.`kode_jenis_jarkom`
            )
            INNER JOIN `tb_tipe_uker`
            ON (
                `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
            )
                WHERE ip_wan = ?
        ";
        $query = $this->db->query($sql, [$ip]);
        $output = [
            'code' => 200,
            'data' => $query->result_array()
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }
}
