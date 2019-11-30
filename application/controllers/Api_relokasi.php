<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_relokasi extends CI_Controller 
{

    public function __construct() {

		parent::__construct();
        $this->load->library('session');
        $this->load->library('customlibrary');
    }

    public function getRelokasiDataFilter()
    {
        header('Content-Type: application/json');

        $filter_ip_wan = $this->session->userdata('filter_ip_wan');
        $filter_provider = $this->session->userdata('filter_provider');
        $filter_ip_lan = $this->session->userdata('filter_ip_lan');
        $filter_wo_no = $this->session->userdata('filter_wo_no');
        $filter_remote_name = $this->session->userdata('filter_remote_name');
        $filter_req_doc_no = $this->session->userdata('filter_req_doc_no');
        $filter_status = $this->session->userdata('filter_status');
        $filter_pic = $this->session->userdata('filter_pic');
        $filter_order_date = $this->session->userdata('filter_order_date');
        $filter_live_target = $this->session->userdata('filter_live_target');

        $this->customlibrary->select('*');

        if($filter_ip_wan != '-') {
            $this->customlibrary->like('ip_wan_new', $filter_ip_wan)->or_like('ip_wan_old', $filter_ip_wan);
        }
        
        if($filter_provider != '-') {
            $this->customlibrary->like('nickname_provider', $filter_provider);
        }

        if($filter_ip_lan != '-') {
            $this->customlibrary->like('ip_lan_new', $filter_ip_lan)->or_like('ip_lan_old', $filter_ip_lan);
        }

        if($filter_wo_no != '-') {
            $this->customlibrary->like('work_order_no', $filter_wo_no);
        }

        if($filter_remote_name != '-') {
            $this->customlibrary->like('remote_name_new', $filter_remote_name)->or_like('remote_name_old', $filter_remote_name);
        }

        if($filter_req_doc_no != '-') {
            $this->customlibrary->like('req_doc_no', $filter_req_doc_no);
        }

        if($filter_status != '-') {
            $this->customlibrary->like('status', $filter_status);
        }

        if($filter_pic != '-') {
            $this->customlibrary->like('pic', $filter_pic);
        }

        if($filter_order_date != '-') {
            $this->customlibrary->like('req_doc_date', $filter_order_date);
        }

        if($filter_live_target != '-') {
            $this->customlibrary->like('due_date', $filter_live_target);
        }
        
        $this->customlibrary->from('v_relokasi_edit');
        echo $this->customlibrary->generate();
    }

    public function getRelokasiData()
    {
        header('Content-Type: application/json');
        $this->customlibrary->select('*');
        $this->customlibrary->from('v_relokasi_list');
        echo $this->customlibrary->generate();
    }

    public function getDetail($id)
    {
        header('Content-Type: application/json');
        $sql = "SELECT * FROM v_relokasi_list WHERE id_relokasi = ?";
        $query = $this->db->query($sql, [$id]);
        if(empty($query->row())) {
            echo json_encode([
                'code' => 404,
                'data' => null
            ]);
        } else {
            echo json_encode([
                'code' => 200,
                'data' => $query->row()
            ]);
        }
    }

    public function getProvider()
    {
        $sql = "SELECT kode_provider, nama_provider, nickname_provider FROM tb_provider";
        $query = $this->db->query($sql)->result();
        echo json_encode($query);
    }

    public function getRemoteByNameFilter()
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
                "id" => $key->nama_remote,
				"text" => $key->nama_remote
            ];
            array_push($data, $newdata);
        }
        echo json_encode($data);
    }

    public function getRemoteByNameSelect2()
    {
        $strName = $_POST['name'];
        $sql = "SELECT
            `tb_remote`.`id_remote`,
            `tb_remote`.`nama_remote`,
            `tb_remote`.`kode_tipe_uker`,
            `tb_remote`.`latitude`,
            `tb_remote`.`longitude`,
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

    public function searchUpdate()
    {
        $param = $_POST['ip_network'];
        $sql = "SELECT * FROM v_all_remote_jarkom WHERE `ip_lan` like '%$param%'";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->id_jarkom,
				"text" => $key->ip_lan." / ".$key->kode_jarkom." / ".$key->jenis_jarkom." / ".$key->tipe_uker
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
                `tb_remote`.`ip_lan` like '%$ip_network%' or
                `tb_jarkom`.`kode_jarkom` like '%$ip_network%'
            )";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->id_jarkom,
				"text" => $key->ip_lan." / ".$key->kode_jarkom." / ".$key->network_type." / ".$key->remote_type
            ];
            array_push($data, $newdata);
        }
        echo json_encode($data);
    }

    public function findAllRemoteJarkom()
    {
        $jarkomID = $_POST['id_jarkom'];
        $sql = "SELECT * FROM v_all_remote_jarkom WHERE id_jarkom = ?";
        $query = $this->db->query($sql, [$jarkomID]);
        $output = [
            'code' => 200,
            'data' => $query->row()
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function searchByIpAddress()
    {
        $id_jarkom = $_POST['id_jarkom'];
        $sql = "SELECT
            `tb_jarkom`.`id` AS `id_jarkom`,
            `tb_jarkom`.`kode_jarkom`,
            `tb_jarkom`.`ip_wan`,
            `tb_jarkom`.`kode_jenis_jarkom`,
            `tb_jarkom`.`id_contract`,
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
                `tb_jarkom`.`ip_wan` = ? or `tb_jarkom`.`id` = ?
            )";
        $query = $this->db->query($sql, [$id_jarkom, $id_jarkom]);
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
            `tb_remote`.`ip_lan`,
            `tb_remote`.`latitude`,
            `tb_remote`.`longitude`,
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
        $sql = "SELECT * FROM v_relokasi_edit WHERE id_jarkom = ?";
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
