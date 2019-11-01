<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_relokasi extends CI_Controller 
{

    public function __construct() {

		parent::__construct();
        $this->load->library('session');
        $this->load->library('datatables');
    }

    public function getRelokasiDataFilter()
    {
        header('Content-Type: application/json');

        $filter_ip = $this->session->userdata('filter_ip');
        $filter_provider = $this->session->userdata('filter_provider');
        $filter_remote_name = $this->session->userdata('filter_remote_name');
        $filter_doc_number = $this->session->userdata('filter_doc_number');
        $filter_status = $this->session->userdata('filter_status');
        $filter_pic = $this->session->userdata('filter_pic');
        $filter_order_date = $this->session->userdata('filter_order_date');
        $filter_live_target = $this->session->userdata('filter_live_target');

        $this->datatables->select('*');

        if($filter_ip != '-') {
            $this->datatables->like('kode_jarkom', $filter_ip)->or_like('ip_wan', $filter_ip);
        }

        if($filter_provider != '-') {
            $this->datatables->like('status', $filter_provider);
        }
        
        if($filter_remote_name != '-') {
            $this->datatables->like('nama_remote_old', $filter_remote_name)->or_like('nama_remote_new', $filter_remote_name);
        }

        if($filter_doc_number != '-') {
            $this->datatables->like('no_doc', $filter_doc_number);
        }

        if($filter_status != '-') {
            $this->datatables->like('status', $filter_status);
        }

        if($filter_pic != '-') {
            $this->datatables->like('pic', $filter_pic);
        }

        if($filter_order_date != '-') {
            $this->datatables->like('due_date', $filter_order_date);
        }
        
        $this->datatables->from('v_combine_filter');
        echo $this->datatables->generate();
    }

    public function getRelokasiData()
    {
        header('Content-Type: application/json');
        $this->datatables->select('*');
        $this->datatables->from('v_relokasi_list');
        echo $this->datatables->generate();
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
            `tb_provider`.`nickname_provider`,
            `tb_tipe_uker`.`singkatan`
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
                `tb_jarkom`.`ip_wan` like '%$ip_network%' or `tb_jarkom`.`kode_jarkom` like '%$ip_network%' or `tb_provider`.`nickname_provider` like '%$ip_network%' or `tb_tipe_uker`.`singkatan` like '%$ip_network%'
            )";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->kode_jarkom,
				"text" => $key->ip_wan." / ".$key->kode_jarkom." / ".$key->nickname_provider." / ".$key->singkatan
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

    public function searchById()
    {
        $id = $_POST['id'];
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
            `tb_remote`.`alamat_uker` AS `remote_address`,
            `tb_relokasi`.`id` AS `id_relokasi`,
            `tb_relokasi`.`id_jarkom`,
            `tb_relokasi`.`id_remote_old`,
            `tb_relokasi`.`id_remote_new`,
            `tb_relokasi`.`alamat`,
            `tb_relokasi`.`file_url`,
            `tb_relokasi`.`no_doc`,
            `tb_relokasi`.`reason`,
            `tb_relokasi`.`status`,
            `tb_relokasi`.`due_date`,
            `tb_relokasi`.`pic`,
            `tb_relokasi`.`no_sik`,
            `tb_provider`.`nickname_provider`,
            `v_all_remote`.`nama_remote` AS `nama_remote_new`,
            `v_all_remote`.`alamat_uker` AS `alamat_uker_new`,
            `v_all_remote`.`tipe_uker` AS `tipe_uker_new`,
            `v_all_remote`.`nama_kanwil` AS `nama_kanwil_new`
        FROM
            `tb_jarkom`
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
        INNER JOIN `tb_provider`
            ON (
                `tb_jarkom`.`kode_provider` = `tb_provider`.`kode_provider`
            )
        INNER JOIN `tb_tipe_uker`
            ON (
                `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
            )
        INNER JOIN `tb_kanca`
            ON (
                `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
            )
        INNER JOIN `tb_relokasi`
            ON (
                `tb_relokasi`.`id_jarkom` = `tb_jarkom`.`id`
            )
        INNER JOIN `v_all_remote`
            ON (
                `tb_relokasi`.`id_remote_new` = `v_all_remote`.`id_remote`
            )
        INNER JOIN `tb_kanwil`
            ON (
                `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
            )    
        WHERE (
                `id_jarkom` = ?
            )";
        $query = $this->db->query($sql, [$id]);
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
