<?php

class M_relokasi extends CI_Model {

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
}