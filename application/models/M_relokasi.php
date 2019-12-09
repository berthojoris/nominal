<?php

class M_relokasi extends CI_Model {

	public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
		$this->load->library('relokasiapi');
	}

	function getRelokasiDataFilter()
	{
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

        $this->relokasiapi->select('*');

        if($filter_ip_wan != '-') {
            $this->relokasiapi->like('ip_wan_new', $filter_ip_wan)->or_like('ip_wan_old', $filter_ip_wan);
        }
        
        if($filter_provider != '-') {
            $this->relokasiapi->like('nickname_provider', $filter_provider);
        }

        if($filter_ip_lan != '-') {
            $this->relokasiapi->like('ip_lan_new', $filter_ip_lan)->or_like('ip_lan_old', $filter_ip_lan);
        }

        if($filter_wo_no != '-') {
            $this->relokasiapi->like('work_order_no', $filter_wo_no);
        }

        if($filter_remote_name != '-') {
            $this->relokasiapi->like('remote_name_new', $filter_remote_name)->or_like('remote_name_old', $filter_remote_name);
        }

        if($filter_req_doc_no != '-') {
            $this->relokasiapi->like('req_doc_no', $filter_req_doc_no);
        }

        if($filter_status != '-') {
            $this->relokasiapi->like('status', $filter_status);
        }

        if($filter_pic != '-') {
            $this->relokasiapi->like('pic', $filter_pic);
        }

        if($filter_order_date != '-') {
            $this->relokasiapi->like('req_doc_date', $filter_order_date);
        }

        if($filter_live_target != '-') {
            $this->relokasiapi->like('due_date', $filter_live_target);
        }
        
        $this->relokasiapi->from('v_relokasi_edit');
        echo $this->relokasiapi->generate();
	}

	function getDetail($id)
	{
		$sql = "SELECT * FROM v_relokasi_list WHERE id_relokasi = ?";
        $query = $this->db->query($sql, [$id]);
        if(empty($query->row())) {
            return json_encode([
                'code' => 404,
                'data' => null
            ]);
        } else {
            return json_encode([
                'code' => 200,
                'data' => $query->row()
            ]);
        }
	}

	function getRelokasiData()
	{
		$this->relokasiapi->select('*');
        $this->relokasiapi->from('v_relokasi_edit');
        return $this->relokasiapi->generate();
	}

	function getRemoteByNameFilter($strName)
	{
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
		return $data;
	}

	function getRemoteByNameSelect2($strName)
	{
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
		return $data;
	}

	function searchUpdate($param)
	{
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
		return $data;
	}

	function findAllRemoteJarkom($jarkomID)
	{
		$sql = "SELECT * FROM v_all_remote_jarkom WHERE id_jarkom = ?";
        $query = $this->db->query($sql, [$jarkomID]);
        $output = [
            'code' => 200,
            'data' => $query->row()
		];
		return $output;
	}

	function searchByIpAddress($id_jarkom)
	{
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
		return $output;
	}

	function getProvider()
	{
		$sql = "SELECT kode_provider, nama_provider, nickname_provider FROM tb_provider";
        return $this->db->query($sql)->result();
	}
	
	function getRemoteByName($name)
	{
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
        $query = $this->db->query($sql, [$name]);
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
		return $output;
	}

	function searchById($id)
	{
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
		return $output;
	}

	function data($number, $offset) 
	{
		return $this->db->order_by("id", "desc")->get('tb_relokasi', $number, $offset)->result();		
	}

	function jumlah_data() 
	{
		return $this->db->get('tb_relokasi')->num_rows();
	}

	function insertData($relokasi, $jarkom, $jarkomHistory, $idJarkom)
	{
		$this->db->trans_begin();

        $this->db->insert('tb_relokasi', $relokasi);
        $this->db->insert('tb_jarkom_history', $jarkomHistory);

        $this->db->where('id', $idJarkom);
        $this->db->update('tb_jarkom', $jarkom);

        if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "FAILED";
        } else {
			$this->db->trans_commit();
			return "SUCCESS";
        }
	}

	function updateData($id_relokasi, $update, $id_jarkom, $updateJarkomData, $id_network, $jarkomHistoryData, $id_remote_new, $remoteUpdate)
	{
		$this->db->trans_begin();

        $this->db->where('id', $id_relokasi);
        $this->db->update('tb_relokasi', $update);

        $this->db->where('id', $id_jarkom);
        $this->db->update('tb_jarkom', $updateJarkomData);

        $this->db->where('kode_jarkom', $id_network);
        $this->db->update('tb_jarkom_history', $jarkomHistoryData);

        $this->db->where('id_remote', $id_remote_new);
        $this->db->update('tb_remote', $remoteUpdate);

        if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "FAILED";
        } else {
			$this->db->trans_commit();
			return "SUCCESS";
        }
	}

	function showDetail($id)
	{
		$sql = "SELECT * FROM v_relokasi_edit WHERE id_relokasi = ?";
		$query = $this->db->query($sql, [$id]);
		return $query;
	}

	function getJarkom($id)
	{
		$sqlJarkom = "SELECT * FROM tb_jarkom WHERE id = ?";
        return $this->db->query($sqlJarkom, [$id])->row();
	}
}