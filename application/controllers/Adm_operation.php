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

    public function downloadFile($fileName)
    {
        force_download('./filesUpload/'.$fileName, NULL);
    }

    public function relokasi()
    {
        $this->load->database();
		$jumlah_data = $this->m_relokasi->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/adm_operation/relokasi/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
        $from = $this->uri->segment(3);
        
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
        
        $data = [
            'conditionjs'  => site_url()."/custom/relokasi.js"
        ];
        $data['title'] = 'Relokasi';
        $data['page'] = 'Relokasi';
        $data['relokasi'] = $this->m_relokasi->data($config['per_page'], $from);
        $this->template->views('adm_operation/relokasi', $data);
    }

    public function saverelokasi()
    {
        $randomName = $this->randomString();

        $this->form_validation->set_rules('ip_address_network_id','IP Address or Network ID','required');
        $this->form_validation->set_rules('reason','Reason','required');
        $this->form_validation->set_rules('doc_number','DOC Number','required');
        $this->form_validation->set_rules('pic_in_charge','PIC In Charge','required');
        $this->form_validation->set_rules('live_target','Live Target','required');
        $this->form_validation->set_rules('remote_name','Remote Name','required');
        $this->form_validation->set_rules('remote_address_new','New Remote Address','required');
        $this->form_validation->set_rules('ip_wan_new','New Remote Name','required');

        if($this->form_validation->run() != false) {
            
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
                        'ip_address_network_id' => $this->input->post('ip_address_network_id'),
                        'reason' => $this->input->post('reason'),
                        'doc_number' => $this->input->post('doc_number'),
                        'file_upload' => $newName,
                        'pic' => $this->input->post('pic_in_charge'),
                        'live_target' => $this->input->post('live_target'),
                        'ip_wan' => $this->input->post('ip_wan'),
                        'remote_name' => $this->input->post('remote_name'),
                        'remote_address' => $this->input->post('remote_address'),
                    ];
                    $this->db->insert('tb_relokasi', $insert);
    
                    $this->session->set_flashdata('notif_success', 'Relokasi has been created');
                } else {
                    $this->session->set_flashdata('notif_error', 'Failed to save. Reload page and try again');
                }
            }
		} else {
			$this->session->set_flashdata('notif_error', 'Validation form error. Please check again');
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