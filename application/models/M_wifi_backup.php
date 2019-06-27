<?php

class M_wifi extends CI_Model {

	function GetData_Complaint($start='',$length='',$search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT * FROM v_complaint_wifi
								WHERE complaint_name LIKE '%$search%'
								OR status LIKE '%$search%'
								ORDER BY id DESC
								LIMIT $start,$length")
							 ->result();
		}else{
			$data = $this->db->query("SELECT * FROM v_complaint_wifi ORDER BY id DESC LIMIT $start,$length")->result();
		}

		return $data;
	}


	function CountData_Complaint($search='')
	{
		if ($search) {
			$data = $this->db->query("SELECT COUNT(id) as total FROM v_complaint_wifi
								WHERE complaint_name LIKE '%$search%'
								OR status LIKE '%$search%'")
							 ->result();
		}else{
			$data = $this->db->select('COUNT(id) as total')->from('v_complaint_wifi')->get()->result();
		}
		
		return $data[0]->total;
	}

}
