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
        $data = [
            'conditionjs'  => site_url()."/custom/relokasi.js"
        ];
        $data['title'] = 'Relokasi';
        $data['page'] = 'Relokasi';
        $this->template->views('adm_operation/relokasi', $data);
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

            $allowedExt = ["image/jpeg","application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/zip","application/x-rar-compressed","application/pdf","application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","text/csv"];

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
                
                $this->db->insert('tb_relokasi_update', $insert);

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