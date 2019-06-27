<?php

class M_hosts extends CI_Model {

    function getIpHosts($segment,$in)
    {
        $q_kanwil = "SELECT CONCAT('".$segment."',ip_host) as ip_addr, host_apps FROM tb_ip_host WHERE ip_host IN (".$in.");";
        $result = $this->db->query($q_kanwil)->result();
        return $result;
        //var_dump($q_kanwil) ;
    }
    
    
}
