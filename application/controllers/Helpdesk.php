<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_Helpdesk'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

/*     public function index()
	{
		

	} */
	
    public function reqRoute()
	{
		$data['page']  = 'Request Routing';
        $data['title'] = 'Request Routing';
		$this->template->views('helpdesk/req_routing',$data);
	}
}

?>
