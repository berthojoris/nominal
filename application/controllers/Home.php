<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_dashboard','m_home'));
		
		$this->load->helper('form');
        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		$data['page'] = 'home';
        $data['title'] = 'Nominal Search Menu';
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;
		
		$remote_on_all = $this->m_home->count_status_remote_on_all();
		$data_on_all =  json_decode(json_encode($remote_on_all),true);
		$on_all = $data_on_all[0]['total'];
		
		$remote_off_op = $this->m_home->count_status_remote_off_op();
		$data_off_op =  json_decode(json_encode($remote_off_op),true);
		$off_op = $data_off_op[0]['total'];
		
		$data['percentage_online_remote']=number_format(($on_all/($on_all+$off_op)*100),2);
		
		
		$jarkom_on_all= $this->m_home->count_status_jarkom_on_all();
		$data_on_all =  json_decode(json_encode($jarkom_on_all),true);
		$on_all = $data_on_all[0]['total'];
		
		$remote_off_op= $this->m_home->count_status_jarkom_off_op();
		$data_off_op =  json_decode(json_encode($remote_off_op),true);
		$off_op = $data_off_op[0]['total'];
		
		//echo "=============".$op_on."-".$nop_on."-".$op_of;
		$data['percentage_online_jarkom']=number_format(($on_all/($on_all+$off_op)*100),2);
		
		
		if(isset($_POST['search'])){
					
			$search = $_POST['search'];
			$data['search'] = $search;
			$data['found']= $this->m_home->search($search);
			$data['found_count']= $this->m_home->search_count($search);
			
		}
		
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $start), 4);
		$data['time']=$total_time.' seconds.';
		
		$this->template->views('Home/home',$data);
	}
}

