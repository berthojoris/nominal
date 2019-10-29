<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm_operation extends CI_Controller {
    
    public function __construct() 
    {
		parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('url'));
        $this->load->model('m_relokasi');
        $this->load->helper('download');
		if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function download($fileName)
    {
        force_download('./filesUpload/'.$fileName, NULL);
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

            // die($filter_provider);

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
        $randomName = $this->randomString();

        if(!file_exists($_FILES['file_upload']['tmp_name']) || !is_uploaded_file($_FILES['file_upload']['tmp_name'])) {
            $newName = 'default.jpg';
        } else {
            $originalName   = $_FILES['file_upload']['name'];
            $originalType   = $_FILES['file_upload']['type'];
            $originalSize   = $_FILES['file_upload']['size'];
            $extension      = array_map('strrev', explode(".", strrev($originalName)));

            $allowedExt = [
                "image/jpeg",
                "image/png",
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/pdf",
                "application/vnd.ms-excel",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                "text/csv",
                "application/octet-stream"
            ];

            if(in_array($originalType, $allowedExt)) {

                $config['upload_path']      = './filesUpload/';
                $config['allowed_types']    = 'pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv';
                $config['max_size']         = 10240;
                $config['overwrite']        = true;
                $config['file_name']        = $randomName;
                $config['file_ext_tolower'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_upload')) {
                    $this->session->set_flashdata('notif_error', 'Upload file error. Reload page or contact your administrator');
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $newName = $randomName.".".$extension[0];
                
                $insert = [
                    'id_jarkom' => $this->input->post('id_jarkom'),
                    'id_remote_old' => $this->input->post('id_remote_old'),
                    'id_remote_new' => $this->input->post('remote_name_new'),
                    'alamat' => $this->input->post('remote_address'),
                    'file_url' => $newName,
                    'no_doc' => $this->input->post('doc_number'),
                    'reason' => $this->input->post('reason'),
                    'status' => $this->input->post('status'),
                    'due_date' => $this->input->post('live_target'),
                    'pic' => $this->input->post('pic_in_charge'),
                    'no_sik' => '-',
                ];
                
                $this->db->insert('tb_relokasi', $insert);

                $this->session->set_flashdata('notif_success', 'Relokasi has been created');
            } else {
                $this->session->set_flashdata('notif_error', 'Validation fail. Please check your input');
            }
        }

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
