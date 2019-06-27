<?php
class M_master extends CI_Model {

	function GetData_Project($start='',$length='',$search='')
	{
		if ($search) {
			$data = $this->db->query("
								SELECT * FROM tb_project
								WHERE nama_project LIKE '%$search%'
								OR keterangan LIKE'%$search%'
								LIMIT $start,$length")
							 ->result();
		}else{
			$data = $this->db->query("
								SELECT * FROM tb_project
								LIMIT $start,$length")
							 ->result();
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

	function GetData_SPK($start='',$length='',$search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT a.*,b.nama_provider,c.nama_project FROM tb_spk a
								LEFT JOIN tb_provider b ON b.kode_provider=a.kode_provider
								LEFT JOIN tb_project c ON c.id_project=a.id_project
								WHERE a.no_spk LIKE '%$search%'
								OR b.nama_provider LIKE '%$search%'
								OR c.nama_project LIKE '%$search%'
								LIMIT $start,$length")
							 ->result();
		}else{
			$data = $this->db->query("SELECT a.*,b.nama_provider,c.nama_project FROM tb_spk a
								LEFT JOIN tb_provider b ON b.kode_provider=a.kode_provider
								LEFT JOIN tb_project c ON c.id_project=a.id_project
								LIMIT $start,$length")
							 ->result();
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
								ORDER BY a.start_at DESC
								LIMIT $start,$length")
							 ->result();
		}else{
			$data = $this->db->query("SELECT a.*,b.alarm_type FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								ORDER BY a.start_at DESC
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

	function GetData_AlarmRemote($id_remote='',$start='',$length='',$search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT a.*,b.alarm_type FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.id_remote = $id_remote
								AND ISNULL(a.id_jarkom)
								AND ( a.remote_name LIKE '%$search%'
								OR a.remote_type LIKE '%$search%'
								OR a.region LIKE '%$search%'
								OR a.main_branch LIKE '%$search%'
								OR a.branch_code LIKE '%$search%'
								OR a.ip_address LIKE '%$search%'
								OR a.provider LIKE '%$search%'
								OR a.jenis_jarkom LIKE '%$search%'
								OR b.alarm_type LIKE '%$search%' )
								ORDER BY a.start_at DESC
								LIMIT $start,$length")
							 ->result();
		}else{
			$data = $this->db->query("SELECT a.*,b.alarm_type FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.id_remote = $id_remote
								AND ISNULL(a.id_jarkom)
								ORDER BY a.start_at DESC
								LIMIT $start,$length")
							 ->result();
		}

		return $data;
	}


	function CountData_AlarmRemote($id_remote='',$search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT COUNT(a.id) as total FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.id_remote = $id_remote
								AND ISNULL(a.id_jarkom)
								AND ( a.remote_name LIKE '%$search%'
								OR a.remote_type LIKE '%$search%'
								OR a.region LIKE '%$search%'
								OR a.main_branch LIKE '%$search%'
								OR a.branch_code LIKE '%$search%'
								OR a.ip_address LIKE '%$search%'
								OR a.provider LIKE '%$search%'
								OR a.jenis_jarkom LIKE '%$search%'
								OR b.alarm_type LIKE '%$search%' )
								OR b.alarm_type LIKE '%$search%'")
							 ->result();
		}else{
			$data = $this->db->query("SELECT COUNT(a.id) as total FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.id_remote = $id_remote
								AND ISNULL(a.id_jarkom)")
							 ->result();
		}
		
		return $data[0]->total;
	}

	function GetData_AlarmJarkom($id_jarkom='',$start='',$length='',$search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT a.*,b.alarm_type FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.id_jarkom = $id_jarkom
								AND ISNULL(a.id_jarkom)
								AND ( a.remote_name LIKE '%$search%'
								OR a.remote_type LIKE '%$search%'
								OR a.region LIKE '%$search%'
								OR a.main_branch LIKE '%$search%'
								OR a.branch_code LIKE '%$search%'
								OR a.ip_address LIKE '%$search%'
								OR a.provider LIKE '%$search%'
								OR a.jenis_jarkom LIKE '%$search%'
								OR b.alarm_type LIKE '%$search%' )
								ORDER BY a.start_at DESC
								LIMIT $start,$length")
							 ->result();
		}else{
			$data = $this->db->query("SELECT a.*,b.alarm_type FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.id_jarkom = $id_jarkom
								ORDER BY a.start_at DESC
								LIMIT $start,$length")
							 ->result();
		}

		return $data;
	}


	function CountData_AlarmJarkom($id_jarkom='',$search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT COUNT(a.id) as total FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.id_jarkom = $id_jarkom
								AND ISNULL(a.id_jarkom)
								AND ( a.remote_name LIKE '%$search%'
								OR a.remote_type LIKE '%$search%'
								OR a.region LIKE '%$search%'
								OR a.main_branch LIKE '%$search%'
								OR a.branch_code LIKE '%$search%'
								OR a.ip_address LIKE '%$search%'
								OR a.provider LIKE '%$search%'
								OR a.jenis_jarkom LIKE '%$search%'
								OR b.alarm_type LIKE '%$search%' )
								OR b.alarm_type LIKE '%$search%'
								ORDER BY a.start_at DESC")
							 ->result();
		}else{
			$data = $this->db->query("SELECT COUNT(a.id) as total FROM tb_alarm a
								LEFT JOIN tb_alarm_type b ON b.id = a.id_alarm_type
								WHERE a.id_jarkom = $id_jarkom
								ORDER BY a.start_at DESC")
							 ->result();
		}
		
		return $data[0]->total;
	}

	function GetAlarm($id='')
	{
		$data = $this->db->select('*')
						->from('tb_alarm')
						->where('id',$id)
						->order_by('start_at','desc')
						->limit(1)
						->get()->result();
    	return $data;
	}

	function GetAlarmById($id='',$kode='')
	{
		if ($kode=='R') {
			$data = $this->db->select('*')
						->from('tb_alarm')
						->where('id_remote',$id)
						->order_by('start_at','desc')
						->where('current_state != ',9)
						->where('current_state != ',10)
						->limit(1)
						->get()->result();
		}else{
			$data = $this->db->select('*')
						->from('tb_alarm')
						->where('id_jarkom',$id)
						->where('current_state != ',9)
						->where('current_state != ',10)
						->order_by('start_at','desc')
						->limit(1)
						->get()->result();
		}
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