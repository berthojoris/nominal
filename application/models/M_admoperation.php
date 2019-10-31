<?php

class M_admoperation extends CI_Model {

    function insert($alldata) {
		$insert = [
            'id_jarkom' => $this->input->post('id_jarkom'),
            'id_remote_old' => $this->input->post('xxxxxxxxxxxxxx'),
            'id_remote_new' => $this->input->post('xxxxxxxxxxxxxx'),
            'reason' => $this->input->post('xxxxxxxxxxxxxx'),
            'status' => $this->input->post('xxxxxxxxxxxxxx'),
            'due_date' => $this->input->post('xxxxxxxxxxxxxx'),
            'pic' => $this->input->post('xxxxxxxxxxxxxx'),
            'ip_wan_old' => $this->input->post('xxxxxxxxxxxxxx'),
            'ip_wan_new' => $this->input->post('xxxxxxxxxxxxxx'),
            'req_doc_file' => $this->input->post('xxxxxxxxxxxxxx'),
            'req_doc_no' => $this->input->post('xxxxxxxxxxxxxx'),
            'work_order_file' => $this->input->post('xxxxxxxxxxxxxx'),
            'work_order_no' => $this->input->post('xxxxxxxxxxxxxx'),
            'type_relocate' => $this->input->post('xxxxxxxxxxxxxx'),
            'network_id_old' => $this->input->post('xxxxxxxxxxxxxx'),
            'network_id_new' => $this->input->post('xxxxxxxxxxxxxx'),
            'ip_lan_old' => $this->input->post('xxxxxxxxxxxxxx'),
            'ip_lan_new' => $this->input->post('xxxxxxxxxxxxxx'),
            'remote_name_old' => $this->input->post('xxxxxxxxxxxxxx'),
            'remote_name_new' => $this->input->post('xxxxxxxxxxxxxx'),
            'address_old' => $this->input->post('xxxxxxxxxxxxxx'),
            'address_new' => $this->input->post('xxxxxxxxxxxxxx'),
            'remote_type' => $this->input->post('xxxxxxxxxxxxxx')
        ];
        
        if($this->db->insert('tb_relokasi_update', $insert)) {
            return "created";
        } else {
            return "failed";
        }
    }

}