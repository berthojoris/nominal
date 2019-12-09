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