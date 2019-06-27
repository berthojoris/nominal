<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weathermap extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_watch','m_dashboard'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		//$data['page'] = 'home';
		//$this->template->views('home',$data);
		//redirect('Dashboard/All_Kanwil');
		if ($this->session->userdata('role')==10) {
            redirect('Dashboard/Dash_Prov');
        }else{
			redirect('Dashboard/All_Kanwil');
		}
	}

	function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

	function pscf_core(){
		$data['page'] = 'pscf-core';
		$data['title'] = 'PSCF Weathermap';

		//echo "<iframe height="300px" width="100%" src="demo_iframe.htm" name="iframe_a"></iframe>";
		$this->template->views('weathermap/pscf',$data);
	}

}

