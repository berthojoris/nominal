<?php

class M_user extends CI_Model {

    private $table = "user";

    function cek($username, $password) {
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        return $this->db->get("tb_user");
    }

}
