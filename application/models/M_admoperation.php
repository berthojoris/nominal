<?php

class M_admoperation extends CI_Model {

    function getData()
    {
        $sql = "SELECT * FROM tb_relokasi";
        $process = $this->db->query($sql);
        return $process->result();
    }

}