<?php

class M_watch extends CI_Model {

    function get_main_branch($where) {
		
		$data = $this->db->select('b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update')
								 ->from('v_all_remote b')
								 //->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.kode_op','asc')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 //->like('a.event',$where)
								 ->where('b.kode_tipe_uker',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();
		//var_dump($data);
		
    	
		return $data;
    }

    function get_branch_by_type($where) {
		
		$data = $this->db->select('b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update')
								 ->from('v_all_remote b')
								 //->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.kode_op','asc')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 //->like('a.event',$where)
								 ->where($where)
								 // ->limit(100,0)
								 ->get()
								 ->result();
		//var_dump($data);
		
    	
		return $data;
    }
	
	 function get_sub_branch($where) {
		
		$data = $this->db->select('b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update')
								 ->from('v_all_remote b')
								 ->where('kode_op',1)
								 //->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 //->like('a.event',$where)
								 ->where('b.kode_tipe_uker',$where)
								 ->limit(100,0)
								 ->get()
								 ->result();
		//var_dump($data);
		
    	
		return $data;
    }
	
	function get_priority_atm($where) {
		
		$sql_onAll = "SELECT b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update FROM v_all_remote b WHERE 
		b.id_remote IN (SELECT id_remote FROM tb_atm_prioritas GROUP BY id_remote) ORDER BY b.status ASC, b.last_update ASC, b.nama_remote ASC;";
		$data = $this->db->query($sql_onAll)->result();
		/*
		$data = $this->db->select('b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update')
								 ->from('v_all_remote b')
								 //->join('tb_atm_prioritas c','b.id_remote=c.id_remote','right')
								 ->order_by('b.status','asc')
								 ->order_by('b.last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 //->like('a.event',$where)
								 ->where_in('b.id_remote', 'SELECT id_remote FROM tb_atm_prioritas GROUP BY id_remote')
								 //->where('b.kode_tipe_uker',$where)
								 ->where('b.kode_op','1')
								 
								 //->limit(100,0)
								 ->get()
								 ->result();
		*/
		//var_dump($data);
		
    	
		return $data;
    }
}