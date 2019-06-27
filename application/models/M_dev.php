<?php

class M_dev extends CI_Model {

    function getStatusKanca() {
        $data = $this->db->select('a.id_remote, c.nama_remote, c.ip_lan, a.`status`, a.last_update')
        			->from('tb_remote_status_dev a')
        			//->join('tb_jenis_jarkom b','b.kode_jenis_jarkom = a.kode_jenis_jarkom','left')
        			->join('tb_remote c','a.id_remote = c.id_remote','left')
        			->where('c.kode_tipe_uker',2)
        			->order_by('a.`status`','asc')
        			->order_by('a.last_update','asc')
        			->get()->result();
        return $data;
    }
}
