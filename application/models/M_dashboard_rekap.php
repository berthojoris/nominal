
<?php

class M_dashboard_rekap extends CI_Model {

    function get_remote($kanca,$tipe_uker) {
		$this->db->select("count(id_remote) as total");
		$this->db->from('tb_remote');
		$this->db->where('tb_remote.kode_kanca',$kanca);
		$this->db->where('tb_remote.kode_tipe_uker',$tipe_uker);
		$this->db->where_not_in('tb_remote.kode_op','0');
		$data=$this->db->get()->result();
    	
		//var_dump($data[0]->total);
		return $data[0]->total;
    }

    function query($what, $table, $where) {
               
        $querystring = "Select $what from $table where $where";
        //echo $querystring;
        $query = $this->db->query($querystring);
        return $query->result();
        
    }

}




?>