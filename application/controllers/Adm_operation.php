<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm_operation extends CI_Controller {
    
    public function __construct() 
    {
		parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('url'));
        $this->load->model('m_admoperation');
        $this->load->helper('download');
        $this->load->helper('form');
        $this->load->helper('directory');
		if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function download($fileName)
    {
        $year = date('Y');
        force_download('./filesUpload/sik/'.$year.'/'.$fileName, NULL);
    }

    public function relokasi()
    {
        if($this->input->method(TRUE) == "POST") {
            add_js('relokasi_filter.js');
            $this->session->unset_userdata('filter_ip');
            $this->session->unset_userdata('filter_provider');
            $this->session->unset_userdata('filter_remote_name');
            $this->session->unset_userdata('filter_doc_number');
            $this->session->unset_userdata('filter_status');
            $this->session->unset_userdata('filter_pic');
            $this->session->unset_userdata('filter_order_date');
            $this->session->unset_userdata('filter_live_target');

            $filter_ip = (!empty($_POST['filter_ip'])) ? $_POST['filter_ip'] : '-';
            $filter_remote_name = (!empty($_POST['filter_remote_name'])) ? $_POST['filter_remote_name'] : '-';
            $filter_provider = (!empty($_POST['filter_provider'])) ? $_POST['filter_provider'] : '-';
            $filter_doc_number = (!empty($_POST['filter_doc_number'])) ? $_POST['filter_doc_number'] : '-';
            $filter_status = (!empty($_POST['filter_status'])) ? $_POST['filter_status'] : '-';
            $filter_pic = (!empty($_POST['filter_pic'])) ? $_POST['filter_pic'] : '-';
            $filter_order_date = (!empty($_POST['filter_order_date'])) ? $_POST['filter_order_date'] : '-';
            $filter_live_target = (!empty($_POST['filter_live_target'])) ? $_POST['filter_live_target'] : '-';

            $this->session->set_userdata('filter_ip', $filter_ip);
            $this->session->set_userdata('filter_provider', $filter_provider);
            $this->session->set_userdata('filter_remote_name', $filter_remote_name);
            $this->session->set_userdata('filter_doc_number', $filter_doc_number);
            $this->session->set_userdata('filter_status', $filter_status);
            $this->session->set_userdata('filter_pic', $filter_pic);
            $this->session->set_userdata('filter_order_date', $filter_order_date);
            $this->session->set_userdata('filter_live_target', $filter_live_target);

            $data['title'] = 'Relokasi';
            $data['page'] = 'Relokasi';
            $this->template->views('adm_operation/relokasi_filter', $data);
        } else {
            add_js('relokasi.js');
            $data['title'] = 'Relokasi';
            $data['page'] = 'Relokasi';
            $this->template->views('adm_operation/relokasi', $data);
        }
    }

    public function saverelokasi()
    {
        $year = date('Y');
        
        $checkFolder = directory_map('./filesUpload/sik/'.$year);
        if(!is_array($checkFolder)) {
            mkdir('./filesUpload/sik/'.$year, 0777, TRUE);
        }

        $config['upload_path']      = './filesUpload/sik/'.$year.'/';
        $config['allowed_types']    = 'pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv';
        $config['max_size']         = '10240';
        $config['overwrite']        = true;
        $config['file_ext_tolower'] = true;
        $config['encrypt_name']     = true;
        $config['remove_spaces']    = true;

        $this->load->library('upload',$config);

        $data = [];

        for ($i=1; $i <=2 ; $i++) {
            if(!empty($_FILES['file_upload_'.$i]['name'])){
                if(!$this->upload->do_upload('file_upload_'.$i)) {
                    array_push($data, [
                        'error' => $this->upload->display_errors(),
                        'file_name' => $this->upload->data()['file_name']
                    ]);
                } else {
                    array_push($data, [
                        'error' => null,
                        'file_name' => $this->upload->data()['file_name']
                    ]);
                }
            }
        }

        $insert = [
            'id_jarkom' => $this->input->post('id_jarkom'),
            'id_remote_old' => $this->input->post('id_remote_old'),
            'id_remote_new' => $this->input->post('remote_name_new'),
            'reason' => $this->input->post('reason'),
            'status' => $this->input->post('status'),
            'due_date' => $this->input->post('live_target'),
            'pic' => $this->input->post('pic'),
            'ip_wan_old' => $this->input->post('ip_wan_old'),
            'ip_wan_new' => $this->input->post('ip_wan_new'),
            'req_doc_file' => $data[0]['file_name'],
            'req_doc_no' => $this->input->post('req_doc_no'),
            'work_order_file' => $data[1]['file_name'],
            'work_order_no' => $this->input->post('work_order_no'),
            'type_relocate' => $this->input->post('type'),
            'network_id_old' => $this->input->post('network_id_old'),
            'network_id_new' => $this->input->post('network_id_new'),
            'ip_lan_old' => $this->input->post('ip_lan_old'),
            'ip_lan_new' => $this->input->post('ip_lan_new'),
            'remote_name_old' => $this->input->post('remote_name_old'),
            'remote_name_new' => $this->input->post('remote_name_new_val'),
            'address_old' => $this->input->post('remote_address_old'),
            'address_new' => $this->input->post('remote_address_new'),
            'remote_type' => $this->input->post('remote_type_new')
        ];

        if($this->db->insert('tb_relokasi', $insert)) {
            $this->session->set_flashdata('notif_success', 'Relokasi has been created');
        } else {
            $this->session->set_flashdata('notif_error', 'Data has not been created');
        }

        $this->session->set_flashdata('notif_success', 'Relokasi has been created');

        redirect($_SERVER['HTTP_REFERER']);
    }

    function randomString($length = 16) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}
