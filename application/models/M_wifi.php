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

	function InputChatImage($id='',$commnent='')
	{
		$cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$id)
                                 ->get()->result();

        if ($cek[0]->status_complaint==1) {
            $this->db->set('status_complaint',2)->where('id',$id)->update('tb_wifi_complaint');
        }

        $data  = array(
            'comment' => $commnent,
            'id_wifi_complaint' => $id,
            'user_create' => $this->session->userdata('username'),
            'create_at' => date('Y-m-d H:i:s')
        );

        $return = $this->db->insert('tb_wifi_comment',$data);
        if ($return) {
            $return = true;
        }else{
            $return = false;
        }

        return $return;
	}

}
