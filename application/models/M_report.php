<?php

class M_report extends CI_Model {

    function getListKanwil()
    {
        $q_kanwil = "SELECT kode_kanwil, nama_kanwil
                  FROM tb_kanwil ORDER BY kode_kanwil;";
        $result = $this->db->query($q_kanwil)->result();
        return $result;
    }
    
    function getListKanca($in)
    {
        $q_kanca = "SELECT kode_kanca, nama_kanca
                  FROM tb_kanca WHERE kode_kanwil IN(".$in.") ORDER BY nama_kanca;";
        $result = $this->db->query($q_kanca)->result();
        return $result;
    }
    
    function getListJenisUker()
    {
        $q_jenisuker = "SELECT kode_tipe_uker, tipe_uker FROM tb_tipe_uker;";
        $result = $this->db->query($q_jenisuker)->result();
        return $result;
    }
        
    function data_uker_all($per_page,$start,$where)
    {
    	$query = "SELECT a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op, GREATEST(b.status_fail_date,b.status_rec_date) as last_update_status
		FROM tb_remote a 
		LEFT JOIN tb_remote_status b ON b.ip_lan = a.ip_lan
		LEFT JOIN tb_tipe_uker c ON c.kode_tipe_uker = a.kode_tipe_uker
		LEFT JOIN tb_kanca d ON d.kode_kanca = a.kode_kanca
		LEFT JOIN tb_kanwil e ON e.kode_kanwil = d.kode_kanwil
		LEFT JOIN tb_op f ON f.kode_op = a.kode_op
		WHERE a.kode_op IN(1,2) ".$where." ORDER BY b.`status`, c.tipe_uker LIMIT ".$per_page." OFFSET ".($start-1).";";
					
		$data = $this->db->query($query)->result();
    	//echo $query;
		return $data;
    }
	
	function jumlah_uker_all($where)
    {
		//$this->db->select('count(id_remote) as total');
		//$this->db->from('tb_remote');
		///this->db->where_not_in('kode_op',array(0));
    	//$data = $this->db->get()->result();
    	//var_dump($data[0]->total);
		$query = "SELECT a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op
		FROM tb_remote a 
		LEFT JOIN tb_remote_status b ON b.ip_lan = a.ip_lan
		LEFT JOIN tb_tipe_uker c ON c.kode_tipe_uker = a.kode_tipe_uker
		LEFT JOIN tb_kanca d ON d.kode_kanca = a.kode_kanca
		LEFT JOIN tb_kanwil e ON e.kode_kanwil = d.kode_kanwil
		LEFT JOIN tb_op f ON f.kode_op = a.kode_op
		WHERE a.kode_op IN(1,2) ".$where." ORDER BY b.`status`, c.tipe_uker ";
		$data = $this->db->query($query)->num_rows();
					
		//$data = $this->db->query($query)->result();
		
    	return $data;
    }

    
}
