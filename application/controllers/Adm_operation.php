<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm_operation extends CI_Controller {
    
    public function __construct() 
    {
		parent::__construct();
        $this->load->library('session');
		if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function relokasi()
    {
        $data['title'] = 'Relokasi';
        $data['page'] = 'Relokasi';
        $this->template->views('adm_operation/relokasi', $data);
    }
    
}