<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dev extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model(array('m_dev'));
        $this->load->library('session');
        $this->load->library('curl');
        if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		if ($this->session->userdata('role')==10) {
            redirect('Dash_Provider');
        }else{
			redirect('Dashboard/All_Kanwil');
		}
	}

    function monitorKanca()
    {
        $data['page']  = 'dev';
        $data['title'] = 'monitor kaca';
        $this->template->views('Dev/monkanca',$data);
    }

	function dataMonitorKanca()
    {
        $data["data"] = $this->m_dev->getStatusKanca();
        echo json_encode($data);
    }
}

