<?php
class M_excel_import extends CI_Model
{
	function select_remote()
	{
		$this->db->order_by('ip_lan', 'ASC');
		$query = $this->db->get('tb_dump_remote');
		return $query;
	}

	function insert_remote($data)
	{
		$this->db->empty_table('tb_dump_remote');
		$this->db->insert_batch('tb_dump_remote', $data);
	}
	
	function insert_remote_new($data)
	{
		$this->db->empty_table('tb_remote_insert');
		$this->db->insert_batch('tb_remote_insert', $data);
	}

	function check()
	{
		$data = $this->db->query("SELECT a.ip_lan as ip_dump, b.* FROM tb_dump_remote a
								LEFT JOIN tb_remote b ON b.ip_lan=a.ip_lan 
								ORDER BY a.ip_lan ASC")->result();
		return $data;
	}


	function valid()
	{
		$query = $this->db->query("SELECT a.ip_lan
								FROM tb_dump_remote a
								INNER JOIN tb_remote b ON b.ip_lan=a.ip_lan 
								ORDER BY a.ip_lan ASC")->result();
		$data = array();
		foreach ($query as $key) {
			$data[] = $key->ip_lan;
		}
		$datavalid = $this->db->select('*')
						  ->from('tb_dump_remote')
						  ->where_in('ip_lan',$data)
						  ->get()
						  ->result();

		return $datavalid;
	}

	function invalid()
	{
		$data = $this->db->query("SELECT a.ip_lan as ip_dump, b.* FROM tb_dump_remote a
								INNER JOIN tb_remote b ON b.ip_lan=a.ip_lan 
								ORDER BY a.ip_lan ASC")->result();
		return $data;
	}

	function get_data_new()
	{
		$data = $this->db->select('*')
						  ->from('tb_dump_remote')
						  ->get()
						  ->result();

		return $data;
	}
}
