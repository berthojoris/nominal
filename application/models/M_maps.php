<?php

class M_maps extends CI_Model {

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
	
	function getListJenisUkerAll()
    {
        $q_jenisuker = "SELECT kode_tipe_uker, tipe_uker FROM tb_tipe_uker;";
        $result = $this->db->query($q_jenisuker)->result();
        return $result;
    }
    
    function getListJenisUker($where)
    {
        $q_jenisuker = "SELECT CAST(kode_tipe_uker AS UNSIGNED) as kode_tipe_uker, tipe_uker FROM tb_tipe_uker ".$where." ORDER BY kode_tipe_uker;";
        $result = $this->db->query($q_jenisuker)->result();
        return $result;
    }
    
    function getListProvider()
    {
        $q_provider = "SELECT kode_provider, nama_provider, nickname_provider FROM tb_provider;";
        $result = $this->db->query($q_provider)->result();
        return $result;
    }
	
	function getCenterMap($kanwil)
    {
        $q_center = "SELECT kode_kanwil, latitude, longitude FROM tb_kanwil_centermap WHERE kode_kanwil='".$kanwil."';";
        $result = $this->db->query($q_center)->result();
        return $result;
    }
	
	function getCenterMapRemote($kanca)
    {
        $q_center = "SELECT kode_kanca, latitude, longitude FROM tb_remote WHERE kode_uker='".$kanca."';";
        $result = $this->db->query($q_center)->result();
        return $result;
    }
    
    function getAllUker()
    {
        $q_all = "SELECT a.`kode_uker`, a.`ip_lan`, a.`kode_tipe_uker`, IFNULL(c.`status`,1) as `status`,  a.`latitude`, a.`longtitude`
                  FROM `tb_remote` a
                  LEFT JOIN `tb_remote_status` c ON a.`ip_lan` = c.`ip_lan`;";
        $result = $this->db->query($q_all)->result();
        return $result; 
    }
	
	function viewLocationAll()
    {
		/*
        $q_all = "SELECT a.`kode_uker`,a.`nama_remote`, a.`ip_lan`, a.`kode_tipe_uker`, g.`tipe_uker`, IFNULL(c.`status`,1) as `status`,  a.`latitude`, a.`longitude`
                  FROM `tb_remote` a  
                  LEFT JOIN `tb_remote_status` c ON a.`id_remote` = c.`id_remote`
                  LEFT JOIN `tb_kanca` d ON a.kode_kanca = d.kode_kanca 
                  LEFT JOIN `tb_jarkom` e ON a.id_remote = e.id_remote
                  LEFT JOIN `tb_provider` f ON e.kode_provider = f.kode_provider
				  LEFT JOIN `tb_tipe_uker` g ON a.`kode_tipe_uker` = g.`kode_tipe_uker`;";
		*/
		$q_all = "SELECT kode_uker, nama_remote, ip_lan, latitude, 
longitude, kode_tipe_uker, tipe_uker, `status`
FROM v_all_remote;";
        $result = $this->db->query($q_all)->result();
        return $result; 
    }
    
    function viewLocation($where)
    {
		$q_all = "SELECT id_remote, kode_uker, nama_remote, ip_lan, latitude, longitude, kode_tipe_uker, tipe_uker, `status`
					FROM v_all_remote ".$where.";";
		/*
        $q_all = "SELECT a.`kode_uker`,a.`nama_remote`, a.`ip_lan`, a.`kode_tipe_uker`, g.`tipe_uker`, IFNULL(c.`status`,1) as `status`,  a.`latitude`, a.`longitude`
                  FROM `tb_remote` a  
                  LEFT JOIN `tb_remote_status` c ON a.`id_remote` = c.`id_remote`
                  LEFT JOIN `tb_kanca` d ON a.kode_kanca = d.kode_kanca 
                  LEFT JOIN `tb_jarkom` e ON a.id_remote = e.id_remote
                  LEFT JOIN `tb_provider` f ON e.kode_provider = f.kode_provider
				  LEFT JOIN `tb_tipe_uker` g ON a.`kode_tipe_uker` = g.`kode_tipe_uker` ".$where.";";
		*/		  
        $result = $this->db->query($q_all)->result();
        return $result; 
    }
	
	function getLocationInduk($idremote)
	{
		$q_all = "SELECT a.latitude, a.longitude FROM tb_remote a 
		WHERE kode_uker = (SELECT b.kode_kanca FROM tb_remote b WHERE b.id_remote = ".$idremote.");";
					
		$result = $this->db->query($q_all)->result();
        return $result;
	}
}
