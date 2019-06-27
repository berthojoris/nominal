<?php

class M_configure extends CI_Model {

    function getJarkom($id_jarkom)
	{
		$remote = $this->db->select('*')->from('v_all_remote_jarkom')->where('id_jarkom',$id_jarkom)->limit(10)->get()->result();
		
		return $remote;
	}
	
	function getSavedConfig($id_jarkom)
	{
		$remote = $this->db->select('*')->from('tb_config')
					->where('id_jarkom',$id_jarkom)
					->where('status',null)
					->get()->result();
		
		return $remote;
	}
	
	function saveInsertConfig($id_jarkom,$script)
	{
		$data = array(
		   'id_jarkom' => $id_jarkom,
		   'script' => $script,
		   'create_at' => date("Y-m-d H:i:s", time()),
		   'user_create' => $this->session->userdata('username')
		);

		$insert = $this->db->insert('tb_config', $data);
				
		return($insert);
	}
	
	function saveUpdateConfig($id_jarkom,$script)
	{
		$data = array(
		   'script' => $script,
		   'create_at' => date("Y-m-d H:i:s", time()),
		   'user_create' => $this->session->userdata('username')
		);
		
		$this->db->where('id_jarkom', $id_jarkom);
		$this->db->where('status', null);
		$update = $this->db->update('tb_config', $data);
		
		//$this->db->insert('tb_config', $data);
				
		return($update);
	}
}
