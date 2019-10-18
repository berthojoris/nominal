<?php

class M_relokasi extends CI_Model {

    function data($number, $offset){
		return $this->db->get('tb_relokasi', $number, $offset)->result();		
    }
    
    function jumlah_data(){
		return $this->db->get('tb_relokasi')->num_rows();
	}
}