<?php
class M_master extends CI_Model {

	function GetData_Project($search='')
	{
		if ($search) {
			$data = $this->db->query("
								SELECT * FROM tb_project
								WHERE nama_project LIKE '%$search%'
								OR keterangan LIKE'%$search%'")
							 ->result();
		}else{
			$data = $this->db->select('*')->from('tb_project')->get()->result();
		}

		return $data;
	}


	function CountData_Project($search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT COUNT(id_project) as total FROM tb_project
								WHERE nama_project LIKE '%$search%'
								OR keterangan LIKE'%$search%'")
							 ->result();
		}else{
			$data = $this->db->select('COUNT(id_project) as total')->from('tb_project')->get()->result();
		}
		
		return $data[0]->total;
	}

	function GetData_SPK($search='')
	{
		if ($search) {
			$data = $this->db->query("
								SELECT * FROM tb_project
								WHERE nama_project LIKE '%$search%'
								OR keterangan LIKE'%$search%'")
							 ->result();
		}else{
			$data = $this->db->select('*')->from('tb_project')->get()->result();
		}

		return $data;
	}


	function CountData_SPK($search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT COUNT(id_project) as total FROM tb_project
								WHERE nama_project LIKE '%$search%'
								OR keterangan LIKE'%$search%'")
							 ->result();
		}else{
			$data = $this->db->select('COUNT(id_project) as total')->from('tb_project')->get()->result();
		}
		
		return $data[0]->total;
	}

	function GetData_Alarm($start='',$length='',$search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT a.*,b.alarm_type FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.remote_name LIKE '%$search%'
								OR a.remote_type LIKE '%$search%'
								OR a.region LIKE '%$search%'
								OR a.main_branch LIKE '%$search%'
								OR a.branch_code LIKE '%$search%'
								OR a.ip_address LIKE '%$search%'
								OR a.provider LIKE '%$search%'
								OR a.jenis_jarkom LIKE '%$search%'
								OR b.alarm_type LIKE '%$search%'
								ORDER BY a.start_at ASC
								LIMIT $start,$length")
							 ->result();
		}else{
			$data = $this->db->query("SELECT a.*,b.alarm_type FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								ORDER BY a.start_at ASC
								LIMIT $start,$length")
							 ->result();
		}

		return $data;
	}


	function CountData_Alarm($search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT COUNT(a.id) as total FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.remote_name LIKE '%$search%'
								OR a.remote_type LIKE '%$search%'
								OR a.region LIKE '%$search%'
								OR a.main_branch LIKE '%$search%'
								OR a.branch_code LIKE '%$search%'
								OR a.ip_address LIKE '%$search%'
								OR a.provider LIKE '%$search%'
								OR a.jenis_jarkom LIKE '%$search%'
								OR b.alarm_type LIKE '%$search%'")
							 ->result();
		}else{
			$data = $this->db->query("SELECT COUNT(a.id) as total FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type")
							 ->result();
		}
		
		return $data[0]->total;
	}

	function GetAlarm($id='')
	{
		$data = $this->db->select('*')
						->from('tb_alarm')
						->where('id',$id)
						->get()->result();
    	return $data;
	}

	function GetNote($id='')
	{
		$data = $this->db->select('*')
						->from('tb_alarm_notes')
						->where('id_alarm',$id)
						->get()->result();
    	return $data;
	}

}
?>