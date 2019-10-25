<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller 
{

    public function __construct() {

		parent::__construct();
        $this->load->library('session');
    }

    public function getRelokasiDataCustom()
    {
        $filter_ip = $_POST['filter_ip'];
        $filter_provider = $_POST['filter_provider'];
        $filter_remote_name = $_POST['filter_remote_name'];
        $filter_doc_number = $_POST['filter_doc_number'];
        $filter_status = $_POST['filter_status'];
        $filter_pic = $_POST['filter_pic'];
        $filter_order_date = $_POST['filter_order_date'];
        $filter_live_target = $_POST['filter_live_target'];
    }

    public function getRelokasiData()
    {
        header('Content-Type: application/json');
        $sql = "SELECT * FROM tb_relokasi ORDER BY id DESC";
        $query = $this->db->query($sql)->result();
        $temp = [];
        foreach($query as $data) {
            $sql2 = "SELECT nama_remote FROM tb_remote WHERE id_remote = ".$data->id_remote_old;
            $remote_old = $this->db->query($sql2)->row();
            $sql3 = "SELECT nama_remote FROM tb_remote WHERE id_remote = ".$data->id_remote_new;
            $remote_new = $this->db->query($sql3)->row();
            array_push($temp, [
                'id' => $data->id,
                'id_jarkom' => $data->id_jarkom,
                'id_remote_old' => $data->id_remote_old,
                'nama_remote_old' => $remote_old->nama_remote,
                'id_remote_new' => $data->id_remote_new,
                'nama_remote_new' => $remote_new->nama_remote,
                'alamat' => $data->alamat,
                'file_url' => $data->file_url,
                'no_doc' => $data->no_doc,
                'reason' => $data->reason,
                'status' => $data->status,
                'due_date' => $data->due_date,
                'pic' => $data->pic,
                'no_sik' => $data->no_sik,
            ]);
        }
        $output = [
            'draw' => 0,
            'recordsTotal' => count($query),
            'recordsFiltered' => count($query),
            'data' => $temp
        ];
        echo json_encode($output);
    }

    public function getProvider()
    {
        $sql = "SELECT kode_provider, nama_provider FROM tb_provider";
        $query = $this->db->query($sql)->result();
        echo json_encode($query);
    }

    public function getRemoteByNameSelect2()
    {
        $strName = $_POST['name'];
        $sql = "SELECT
            `tb_remote`.`id_remote`,
            `tb_remote`.`nama_remote`,
            `tb_remote`.`kode_tipe_uker`,
            `tb_tipe_uker`.`tipe_uker`,
            `tb_remote`.`alamat_uker`,
            `tb_remote`.`kode_kanca`,
            `tb_kanca`.`nama_kanca`,
            `tb_kanwil`.`kode_kanwil`,
            `tb_kanwil`.`nama_kanwil`
        FROM
            `tb_remote`
            INNER JOIN `tb_tipe_uker`
                ON (
                    `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
                )
            INNER JOIN `tb_kanca`
                ON (
                    `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
                )
            INNER JOIN `tb_kanwil`
                ON (
                    `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
                )
        WHERE (
                `tb_remote`.`nama_remote` like '%$strName%'
            )";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->id_remote,
				"text" => $key->nama_remote
            ];
            array_push($data, $newdata);
        }
        echo json_encode($data);
    }

    public function filterIp()
    {
        $strFind = $_POST['name'];
        $sql = "SELECT * FROM v_filter_sik WHERE `kode_jarkom` like '%$strFind%' or `ip_wan` like '%$strFind%' or `nama_remote` like '%$strFind%'";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->id_jarkom,
				"text" => $key->ip_wan." / ".$key->kode_jarkom." / ".$key->nickname_provider
            ];
            array_push($data, $newdata);
        }
        echo json_encode($data);
    }

    public function filterRemote()
    {
        $strFind = $_POST['name'];
        $sql = "SELECT * FROM v_filter_sik WHERE `nama_remote` like '%$strFind%'";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->id_remote_new,
				"text" => $key->nama_remote
            ];
            array_push($data, $newdata);
        }
        echo json_encode($data);
    }

    public function filterNoDoc()
    {
        $strFind = $_POST['name'];
        $sql = "SELECT * FROM v_filter_sik WHERE `no_doc` like '%$strFind%'";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->no_doc,
				"text" => $key->no_doc
            ];
            array_push($data, $newdata);
        }
        echo json_encode($data);
    }

    public function filterPIC()
    {
        $strFind = $_POST['name'];
        $sql = "SELECT * FROM v_filter_sik WHERE `pic` like '%$strFind%'";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->pic,
				"text" => $key->pic
            ];
            array_push($data, $newdata);
        }
        echo json_encode($data);
    }

    public function searchByIpAddressSelect2()
    {
        $ip_network = $_POST['ip_network'];
        $sql = "SELECT
            `tb_jarkom`.`id` AS `id_jarkom`,
            `tb_jarkom`.`kode_jarkom`,
            `tb_jarkom`.`ip_wan`,
            `tb_jarkom`.`kode_jenis_jarkom`,
            `tb_jenis_jarkom`.`jenis_jarkom` AS `network_type`,
            `tb_spk`.`no_spk`,
            `tb_remote`.`ip_lan`,
            `tb_tipe_uker`.`tipe_uker` AS `remote_type`,
            `tb_remote`.`nama_remote` AS `remote_name`,
            `tb_kanwil`.`nama_kanwil` AS `region`,
            `tb_remote`.`alamat_uker` AS `remote_address`,
            `tb_provider`.`nickname_provider`
        FROM
            `tb_jarkom`
            INNER JOIN `tb_jenis_jarkom`
                ON (
                    `tb_jarkom`.`kode_jenis_jarkom` = `tb_jenis_jarkom`.`kode_jenis_jarkom`
                )
            INNER JOIN `tb_remote`
                ON (
                    `tb_jarkom`.`id_remote` = `tb_remote`.`id_remote`
                )
            INNER JOIN `tb_provider`
                ON (
                    `tb_jarkom`.`kode_provider` = `tb_provider`.`kode_provider`
                )
            INNER JOIN `tb_spk`
                ON (
                    `tb_jarkom`.`id_spk` = `tb_spk`.`id_spk`
                )
            INNER JOIN `tb_tipe_uker`
                ON (
                    `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
                )
            INNER JOIN `tb_kanca`
                ON (
                    `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
                )
            INNER JOIN `tb_kanwil`
                ON (
                    `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
                )
        WHERE (
                `tb_jarkom`.`ip_wan` like '%$ip_network%' or `tb_jarkom`.`kode_jarkom` like '%$ip_network%' or `tb_provider`.`nickname_provider` like '%$ip_network%'
            )";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->kode_jarkom,
				"text" => $key->ip_wan." / ".$key->kode_jarkom." / ".$key->nickname_provider
            ];
            array_push($data, $newdata);
        }
        echo json_encode($data);
    }

    public function searchByIpAddress()
    {
        $ip_network = $_POST['ip_network'];
        $sql = "SELECT
            `tb_jarkom`.`id` AS `id_jarkom`,
            `tb_jarkom`.`kode_jarkom`,
            `tb_jarkom`.`ip_wan`,
            `tb_jarkom`.`kode_jenis_jarkom`,
            `tb_jenis_jarkom`.`jenis_jarkom` AS `network_type`,
            `tb_spk`.`no_spk`,
            `tb_remote`.`ip_lan`,
            `tb_tipe_uker`.`tipe_uker` AS `remote_type`,
            `tb_remote`.`id_remote`,
            `tb_remote`.`nama_remote` AS `remote_name`,
            `tb_kanwil`.`nama_kanwil` AS `region`,
            `tb_remote`.`alamat_uker` AS `remote_address`
        FROM
            `tb_jarkom`
            INNER JOIN `tb_jenis_jarkom`
                ON (
                    `tb_jarkom`.`kode_jenis_jarkom` = `tb_jenis_jarkom`.`kode_jenis_jarkom`
                )
            INNER JOIN `tb_remote`
                ON (
                    `tb_jarkom`.`id_remote` = `tb_remote`.`id_remote`
                )
            INNER JOIN `tb_provider`
                ON (
                    `tb_jarkom`.`kode_provider` = `tb_provider`.`kode_provider`
                )
            INNER JOIN `tb_spk`
                ON (
                    `tb_jarkom`.`id_spk` = `tb_spk`.`id_spk`
                )
            INNER JOIN `tb_tipe_uker`
                ON (
                    `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
                )
            INNER JOIN `tb_kanca`
                ON (
                    `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
                )
            INNER JOIN `tb_kanwil`
                ON (
                    `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
                )
        WHERE (
                `tb_jarkom`.`ip_wan` = ? or `tb_jarkom`.`kode_jarkom` = ?
            )";
        $query = $this->db->query($sql, [$ip_network, $ip_network]);
        if ($query->num_rows() > 0) {
            $output = [
                'code' => 200,
                'data' => $query->row()
            ];
        } else {
            $output = [
                'code' => 404,
                'data' => ''
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($output);
    }
    
    public function getremotebyname()
    {
        $strName = $_POST['name'];
        $sql = "SELECT
            `tb_remote`.`id_remote`,
            `tb_remote`.`nama_remote`,
            `tb_remote`.`kode_tipe_uker`,
            `tb_tipe_uker`.`tipe_uker`,
            `tb_remote`.`alamat_uker`,
            `tb_remote`.`kode_kanca`,
            `tb_kanca`.`nama_kanca`,
            `tb_kanwil`.`kode_kanwil`,
            `tb_kanwil`.`nama_kanwil`
        FROM
            `tb_remote`
            INNER JOIN `tb_tipe_uker`
                ON (
                    `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
                )
            INNER JOIN `tb_kanca`
                ON (
                    `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
                )
            INNER JOIN `tb_kanwil`
                ON (
                    `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
                )
        WHERE (
                `tb_remote`.`id_remote` = ?
            );
        
        ";
        $query = $this->db->query($sql, [$strName]);
        if ($query->num_rows() > 0) {
            $output = [
                'code' => 200,
                'data' => $query->row()
            ];
        } else {
            $output = [
                'code' => 404,
                'data' => ''
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($output);
    }
}
