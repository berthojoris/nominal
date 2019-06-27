<?php

class M_EventReport extends CI_Model {


	public function delete($query=null,$data=null)
	{
		if($data==null)
		{
			$process = $this->db->query($query);
		}else{
			$process = $this->db->query($query,$data);
		}

		return $process;
	}

	public function update_table($query=null,$data=null)
	{
		if($data==null)
		{
			$process = $this->db->query($query);
		}else{
			$process = $this->db->query($query,$data);
		}

		return $process;
	}


	public function insert_table($query=null,$data=null)
	{
		$process = $this->db->query($query,$data);
		return $process;
	}


	public function getDataEvent($query=null,$data=null)
	{
		if($data==null)
		{
			$process = $this->db->query($query);
		}else{
			$process = $this->db->query($query,$data);
		}

		return $process->result();

		/*$process = $this->db->query($query);
		return $process->result();*/
	}

	public function getDataTypeReport()
	{
		$qstr = "SELECT * FROM tb_type_report";
		$process=$this->db->query($qstr);
		return $process->result();
	}

	public function getDataStatus()
	{
		$qstr = "SELECT *FROM tb_status_report";
		$process=$this->db->query($qstr);
		return $process->result();
	}

	public function getDataEnginer($parameter)
	{
		$qstr = "SELECT * FROM tb_user WHERE nama like '%$parameter%' and role=1 ";
		$process=$this->db->query($qstr);
		return $process->result();
	}

	public function getNewDataEnginer()
	{
		$qstr = "SELECT * FROM tb_escalate";
		$process=$this->db->query($qstr);
		return $process->result();
	}

	public function getOptionLocation($parameter)
	{
		$qstr = "SELECT * FROM tb_kota WHERE name like '%$parameter%'";
		$process=$this->db->query($qstr);
		return $process->result();
	}

	public function getDataOperator($parameter)
	{
		$qstr = "SELECT * FROM tb_user WHERE nama like '%$parameter%'";
		$process=$this->db->query($qstr);
		return $process->result();
	}

	public function getDataAttachment($id_event)
	{
		$qstr = "SELECT * FROM tb_files WHERE id_event = ?";
		$process=$this->db->query($qstr,[$id_event]);
		return $process->result();
	}

	public function getLinkAttachment($id_files)
	{
		$qstr = "SELECT * FROM tb_files WHERE id_files = ?";
		$process=$this->db->query($qstr,[$id_files]);
		return $process->result();
		//return $qstr;
	}

	public function getUpdateLinkAttachment($id_event)
	{
		$qstr = "SELECT * FROM tb_files WHERE id_event = ?";
		$process=$this->db->query($qstr,[$id_event]);
		return $process->result();
		//return $qstr;
	}

	public function deleteDataAttachment($id_files)
	{
		$qstr = "DELETE FROM tb_files WHERE id_files = ?";
		$process=$this->db->query($qstr,[$id_files]);
		return $process;
	}

}

?>