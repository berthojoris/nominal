<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_cacti extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model(array('m_dashboard'));

        //$this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		//if ($this->session->userdata('role')==10) {
        //    redirect('Dashboard/Dash_Prov');
        //}else{
		//	redirect('Dashboard/All_Kanwil');
		//}
		
		
		
	}
}

