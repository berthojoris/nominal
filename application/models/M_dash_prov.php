<?php

class M_dash_prov extends CI_Model {

    function dash_prov()
    {
        $data = $this->db->query("SELECT * FROM v_dash_prov")->result();
        return $data;
    }

    function dash_prov_jupiter()
    {
    	$data = $this->db->query("SELECT * FROM v_dash_jupiter")->result();
    	return $data;
    }
	
	
	

}
