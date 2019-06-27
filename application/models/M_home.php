<?php

class M_home extends CI_Model {

    private $table = "v_all_remote_jarkom";

    function search($what) {
        $this->db->like('nama_remote', $what);
		$this->db->or_like('kode_uker', $what);
		$this->db->or_like('ip_lan', $what);
		$this->db->or_like('ip_wan', $what);
		$this->db->order_by('kode_tipe_uker', 'ASC');
		$this->db->limit(10);
        return $this->db->get("v_all_remote_jarkom")->result();
    }
	function search_count($what) {
        $this->db->like('nama_remote', $what);
		$this->db->or_like('kode_uker', $what);
		$this->db->or_like('ip_lan', $what);
		$this->db->or_like('ip_wan', $what);
        return $this->db->count_all_results("v_all_remote_jarkom");
    }
	function count_status_remote_on_all() {
		$select = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote 		
    				WHERE status = '3'
					AND kode_op IN (1,2)";
		$data =  $this->db->query($select)->result();
        return $data;
    }
	function count_status_remote_off_op() {
		$select = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote 		
    				WHERE status='1' 
					AND kode_op = '1'
					AND kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$data =  $this->db->query($select)->result();
        return $data;
    }
	/* function count_status_remote_op_all() {
		$select = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote 		
    				WHERE kode_kanwil = '$kanwil'
					AND kode_op = '1'
					AND kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$data =  $this->db->query($select)->result();
        return $data;
    } */
	
	
	//JARKOM
	function count_status_jarkom_on_all() {
		$select = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote_jarkom 		
    				WHERE status = '3'
					AND kode_op IN (1,2)";
		$data =  $this->db->query($select)->result();
        return $data;
    }
	function count_status_jarkom_off_op() {
		$select = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote_jarkom 		
    				WHERE status='1' 
					AND kode_op = '1'
					AND kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$data =  $this->db->query($select)->result();
        return $data;
    }
	/* function count_status_jarkom_op_off() {
		$select = "SELECT COUNT(a.id_remote) as total
    				FROM v_all_remote_jarkom a
					LEFT JOIN tb_remote_status b ON b.ip_lan=a.ip_wan 
    				WHERE a.kode_kanca IN (SELECT kode_kanca FROM tb_kanca )
					AND b.status=1
					AND (a.kode_tipe_uker NOT IN (6,8,9,10,11,12,13)
					AND a.kode_op=1)";
		$data =  $this->db->query($select)->result();
        return $data;
    } */
	
	
	

}
